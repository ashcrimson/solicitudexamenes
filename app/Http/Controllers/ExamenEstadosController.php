<?php

namespace App\Http\Controllers;

use App\DataTables\ExamenEstadosDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExamenEstadosRequest;
use App\Http\Requests\UpdateExamenEstadosRequest;
use App\Models\ExamenEstado;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExamenEstadosController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Examen Estados')->only(['show']);
        $this->middleware('permission:Crear Examen Estados')->only(['create','store']);
        $this->middleware('permission:Editar Examen Estados')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Examen Estados')->only(['destroy']);
    }

    /**
     * Display a listing of the ExamenEstado.
     *
     * @param ExamenEstadosDataTable $examenEstadosDataTable
     * @return Response
     */
    public function index(ExamenEstadosDataTable $examenEstadosDataTable)
    {
        return $examenEstadosDataTable->render('examen_estados.index');
    }

    /**
     * Show the form for creating a new ExamenEstado.
     *
     * @return Response
     */
    public function create()
    {
        return view('examen_estados.create');
    }

    /**
     * Store a newly created ExamenEstado in storage.
     *
     * @param CreateExamenEstadosRequest $request
     *
     * @return Response
     */
    public function store(CreateExamenEstadosRequest $request)
    {
        $input = $request->all();

        /** @var ExamenEstado $examenEstados */
        $examenEstados = ExamenEstado::create($input);

        Flash::success('Examen Estados guardado exitosamente.');

        return redirect(route('examenEstados.index'));
    }

    /**
     * Display the specified ExamenEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ExamenEstado $examenEstados */
        $examenEstados = ExamenEstado::find($id);

        if (empty($examenEstados)) {
            Flash::error('Examen Estados no encontrado');

            return redirect(route('examenEstados.index'));
        }

        return view('examen_estados.show')->with('examenEstados', $examenEstados);
    }

    /**
     * Show the form for editing the specified ExamenEstado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ExamenEstado $examenEstados */
        $examenEstados = ExamenEstado::find($id);

        if (empty($examenEstados)) {
            Flash::error('Examen Estados no encontrado');

            return redirect(route('examenEstados.index'));
        }

        return view('examen_estados.edit')->with('examenEstados', $examenEstados);
    }

    /**
     * Update the specified ExamenEstado in storage.
     *
     * @param  int              $id
     * @param UpdateExamenEstadosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamenEstadosRequest $request)
    {
        /** @var ExamenEstado $examenEstados */
        $examenEstados = ExamenEstado::find($id);

        if (empty($examenEstados)) {
            Flash::error('Examen Estados no encontrado');

            return redirect(route('examenEstados.index'));
        }

        $examenEstados->fill($request->all());
        $examenEstados->save();

        Flash::success('Examen Estados actualizado con éxito.');

        return redirect(route('examenEstados.index'));
    }

    /**
     * Remove the specified ExamenEstado from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ExamenEstado $examenEstados */
        $examenEstados = ExamenEstado::find($id);

        if (empty($examenEstados)) {
            Flash::error('Examen Estados no encontrado');

            return redirect(route('examenEstados.index'));
        }

        $examenEstados->delete();

        Flash::success('Examen Estados deleted successfully.');

        return redirect(route('examenEstados.index'));
    }
}
