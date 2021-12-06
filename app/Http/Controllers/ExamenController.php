<?php

namespace App\Http\Controllers;

use App\DataTables\ExamenDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExamenRequest;
use App\Http\Requests\UpdateExamenRequest;
use App\Models\Examen;
use App\Models\ExamenGrupo;
use App\Models\ExamenTipo;
use App\Models\Paciente;
use Carbon\Carbon;
use Flash;
use App\Http\Controllers\AppBaseController;
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
    public function index(ExamenDataTable $examenDataTable)
    {
        return $examenDataTable->render('examenes.laboratorio.index');
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
    public function create()
    {
        $grupos = ExamenGrupo::with('tipos')->get();

        return view('examenes.create',compact('grupos'));
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
        $input = $request->all();

        /** @var Examen $examen */
        $examen = Examen::create($input);

        Flash::success('Examen guardado exitosamente.');

        return redirect(route('examenes.index'));
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

        return view('examenes.edit')->with('examen', $examen);
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

        $examen->fill($request->all());
        $examen->save();

        Flash::success('Examen actualizado con éxito.');

        return redirect(route('examenes.index'));
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

        $examen->delete();

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

}
