<?php

namespace App\Http\Controllers;

use App\DataTables\ExamenDataTable;
use App\DataTables\Scopes\ScopeExamenDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExamenRequest;
use App\Http\Requests\UpdateExamenRequest;
use App\Models\Examen;
use App\Models\ExamenEstado;
use App\Models\ExamenGrupo;
use App\Models\ExamenTipo;
use App\Models\Paciente;
use Carbon\Carbon;
use Exception;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class ExamenController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Examens')->only(['show']);
        $this->middleware('permission:Crear Examens')->only(['create','store']);
        $this->middleware('permission:Editar Examens')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Examens')->only(['destroy']);
    }

    /**
     * Display a listing of the Examen.
     *
     * @param ExamenDataTable $examenDataTable
     * @return Response
     */
    public function index(ExamenDataTable $examenDataTable, Request $request)
    {
        $scope = new ScopeExamenDataTable();
        $scope->estados = $request->get('estados') ?? [
          ExamenEstado::INGRESADO,
          ExamenEstado::SOLICITADO,
          ExamenEstado::PROGRAMADO,
          ExamenEstado::REALIZADO,
          ExamenEstado::ANULADO,
        ];
        $examenDataTable->addScope($scope);

        $estados = ExamenEstado::all();

        return $examenDataTable->render('examenes.laboratorio.index', compact('estados'));
    }

    public function listUser(ExamenDataTable $examenDataTable)
    {
        return $examenDataTable->render('examenes.index');
    }

    /**
     * Show the form for creating a new Examen.
     *
     * @return Response
     */
    public function create(Request $request)
    {

        $id_ext = $request->get('id_ext');
        $tipo_ext = $request->get('tipo_ext');

        $clases = ['rutina', 'urgencia'];

        foreach ($clases as $index => $clase) {


            $grupos[$clase] = ExamenGrupo::with(['tipos' => function ($q) use ($clase){

                if ($clase!='ambas'){

                    $q->where('rutina_urgencia',$clase)
                        ->orWhere('rutina_urgencia','ambas')
                        ->with('muestras');
                }

            }])->get();
        }


        return view('examenes.create',compact('grupos', 'id_ext','tipo_ext'));
    }

    /**
     * Store a newly created Examen in storage.
     *
     * @param CreateExamenRequest $request
     *
     * @return Response
     */
    public function store(CreateExamenRequest $request)
    {

        try {
            DB::beginTransaction();

            $this->procesaStore($request);

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();


        Flash::success('Examen guardado exitosamente.');

        return redirect(route('examenes.index'));
    }

    public function procesaStore(CreateExamenRequest $request)
    {

        /**
         * @var Paciente $paciente
         */
        $paciente = $this->creaOactualizaPaciente($request);

        $request->merge([
            'paciente_id' => $paciente->id,
            'user_solicita' => auth()->user()->id,
            'estado_id' => ExamenEstado::INGRESADO
        ]);

        /** @var Examen $examen */
        $examen = Examen::create($request->all());

        $tipos = $this->getTipos($request);


        $examen->tipos()->sync($tipos);

    }

    /**
     * Display the specified Examen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Examen $examen */
        $examen = Examen::find($id);

        if (empty($examen)) {
            Flash::error('Examen no encontrado');

            return redirect(route('examenes.index'));
        }

        return view('examenes.show')->with('examen', $examen);
    }

    /**
     * Show the form for editing the specified Examen.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Examen $examen */
        $examen = Examen::find($id);

        if (empty($examen)) {
            Flash::error('Examen no encontrado');

            return redirect(route('examenes.index'));
        }

        $examen = $this->addAttributos($examen);

        $clases = ['rutina', 'urgencia'];

        foreach ($clases as $index => $clase) {


            $grupos[$clase] = ExamenGrupo::with(['tipos' => function ($q) use ($clase){

                if ($clase!='ambas'){

                    $q->where('rutina_urgencia',$clase)
                        ->orWhere('rutina_urgencia','ambas')
                        ->with('muestras');
                }

            }])->get();
        }


        return view('examenes.edit',compact('examen','grupos'));
    }

    /**
     * Update the specified Examen in storage.
     *
     * @param  int              $id
     * @param UpdateExamenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamenRequest $request)
    {
        /** @var Examen $examen */
        $examen = Examen::find($id);

        if (empty($examen)) {
            Flash::error('Examen no encontrado');

            return redirect(route('examenes.index'));
        }


        try {
            DB::beginTransaction();

            $this->procesaUpdate($request,$examen);

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();



        Flash::success('Examen actualizado con éxito.');

        return redirect(route('examenes.index'));
    }


    public function procesaUpdate(UpdateExamenRequest $request,Examen $examen)
    {

        /**
         * @var Paciente $paciente
         */
        $paciente = $this->creaOactualizaPaciente($request);

        $request->merge([
            'paciente_id' => $paciente->id,
//            'user_solicita' => auth()->user()->id,
//            'estado_id' => ExamenEstado::INGRESADO
        ]);

        $examen->fill($request->all());
        $examen->save();

        $examen->tipos()->sync($request->tipos ?? []);

    }

    /**
     * Remove the specified Examen from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Examen $examen */
        $examen = Examen::find($id);

        if (empty($examen)) {
            Flash::error('Examen no encontrado');

            return redirect(route('examenes.index'));
        }

        try {
            DB::beginTransaction();

            $estadoExamen = null;

            if ($examen->estado_id == ExamenEstado::INGRESADO) {
                $estadoExamen = ExamenEstado::ANULADO;
            } else if ($examen->estado_id == ExamenEstado::SOLICITADO) {
                $estadoExamen = ExamenEstado::ELIMINADO;
            } else {
                $estadoExamen = ExamenEstado::ANULADO;
            }

            $examen->fill([
                'estado_id' => $estadoExamen,
            ]);
            $examen->save();

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();

        Flash::success('Examen deleted successfully.');

        return redirect(route('examenes.index'));
    }

    public function creaOactualizaPaciente($request)
    {
        $paciente = Paciente::updateOrCreate([
            'run' => $request->run,
            'dv_run' => $request->dv_run,

        ],[
            'run' => $request->run,
            'fecha_nac' => $request->fecha_nac,
            'dv_run' => $request->dv_run,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'primer_nombre' => $request->primer_nombre,
            'segundo_nombre' => $request->segundo_nombre,

            'sexo' => $request->sexo ? 'M' : 'F',

            'direccion' => $request->direccion,
            'familiar_responsable' => $request->familiar_responsable,
            'telefono' => $request->telefono,
            'telefono2' => $request->telefono2,
            'prevision_id' => $request->prevision_id,
            'clave' => $request->clave,
            'movil_envia' => $request->movil_envia,

        ]);

        return $paciente;
    }

    public function addAttributos(Examen $examen)
    {

        $examen->setAttribute("run" ,$examen->paciente->run);
        $examen->setAttribute("dv_run" ,$examen->paciente->dv_run);
        $examen->setAttribute("apellido_paterno" ,$examen->paciente->apellido_paterno);
        $examen->setAttribute("apellido_materno" ,$examen->paciente->apellido_materno);
        $examen->setAttribute("primer_nombre" ,$examen->paciente->primer_nombre);
        $examen->setAttribute("segundo_nombre" ,$examen->paciente->segundo_nombre);
        $examen->setAttribute("fecha_nac" ,Carbon::parse($examen->paciente->fecha_nac)->format('Y-m-d'));
        $examen->setAttribute("sexo" ,$examen->paciente->sexo == 'M' ? 1 : 0);

        $examen->setAttribute("direccion" ,$examen->paciente->direccion);
        $examen->setAttribute("familiar_responsable" ,$examen->paciente->familiar_responsable);
        $examen->setAttribute("telefono" ,$examen->paciente->telefono);
        $examen->setAttribute("telefono2" ,$examen->paciente->telefono2);


        return $examen;
    }

    public function getTipos($request)
    {
        $tipos = [];

        if ($request->tipos){

            $mustras = $request->muestras ?? [];

            foreach ($request->tipos as $index => $tipo) {
                $muestra = $mustras[$tipo] ?? null;

                if ($muestra){
                    $tipos[$tipo] = ['muestra_id' => $muestra];
                }
            }
        }

        return $tipos;
    }

}
