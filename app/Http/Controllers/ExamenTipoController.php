<?php

namespace App\Http\Controllers;

use App\DataTables\ExamenTipoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExamenTipoRequest;
use App\Http\Requests\UpdateExamenTipoRequest;
use App\Models\ExamenTipo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExamenTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Examen Tipos')->only(['show']);
        $this->middleware('permission:Crear Examen Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Examen Tipos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Examen Tipos')->only(['destroy']);
    }

    /**
     * Display a listing of the ExamenTipo.
     *
     * @param ExamenTipoDataTable $examenTipoDataTable
     * @return Response
     */
    public function index(ExamenTipoDataTable $examenTipoDataTable)
    {
        return $examenTipoDataTable->render('examen_tipos.index');
    }

    /**
     * Show the form for creating a new ExamenTipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('examen_tipos.create');
    }

    /**
     * Store a newly created ExamenTipo in storage.
     *
     * @param CreateExamenTipoRequest $request
     *
     * @return Response
     */
    public function store(CreateExamenTipoRequest $request)
    {
        $input = $request->all();

        /** @var ExamenTipo $examenTipo */
        $examenTipo = ExamenTipo::create($input);

        $examenTipo->muestras()->sync($request->muestras ?? []);

        Flash::success('Examen Tipo guardado exitosamente.');

        return redirect(route('examenTipos.index'));
    }

    /**
     * Display the specified ExamenTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ExamenTipo $examenTipo */
        $examenTipo = ExamenTipo::find($id);

        if (empty($examenTipo)) {
            Flash::error('Examen Tipo no encontrado');

            return redirect(route('examenTipos.index'));
        }

        return view('examen_tipos.show')->with('examenTipo', $examenTipo);
    }

    /**
     * Show the form for editing the specified ExamenTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ExamenTipo $examenTipo */
        $examenTipo = ExamenTipo::find($id);

        if (empty($examenTipo)) {
            Flash::error('Examen Tipo no encontrado');

            return redirect(route('examenTipos.index'));
        }

        return view('examen_tipos.edit')->with('examenTipo', $examenTipo);
    }

    /**
     * Update the specified ExamenTipo in storage.
     *
     * @param  int              $id
     * @param UpdateExamenTipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamenTipoRequest $request)
    {
        /** @var ExamenTipo $examenTipo */
        $examenTipo = ExamenTipo::find($id);

        if (empty($examenTipo)) {
            Flash::error('Examen Tipo no encontrado');

            return redirect(route('examenTipos.index'));
        }

        $examenTipo->fill($request->all());
        $examenTipo->save();

        $examenTipo->muestras()->sync($request->muestras ?? []);

        Flash::success('Examen Tipo actualizado con éxito.');

        return redirect(route('examenTipos.index'));
    }

    /**
     * Remove the specified ExamenTipo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ExamenTipo $examenTipo */
        $examenTipo = ExamenTipo::find($id);

        if (empty($examenTipo)) {
            Flash::error('Examen Tipo no encontrado');

            return redirect(route('examenTipos.index'));
        }

        $examenTipo->delete();

        Flash::success('Examen Tipo deleted successfully.');

        return redirect(route('examenTipos.index'));
    }
}
