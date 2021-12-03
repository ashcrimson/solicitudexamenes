<?php

namespace App\Http\Controllers;

use App\DataTables\ExamenGrupoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateExamenGrupoRequest;
use App\Http\Requests\UpdateExamenGrupoRequest;
use App\Models\ExamenGrupo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ExamenGrupoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Examen Grupos')->only(['show']);
        $this->middleware('permission:Crear Examen Grupos')->only(['create','store']);
        $this->middleware('permission:Editar Examen Grupos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Examen Grupos')->only(['destroy']);
    }

    /**
     * Display a listing of the ExamenGrupo.
     *
     * @param ExamenGrupoDataTable $examenGrupoDataTable
     * @return Response
     */
    public function index(ExamenGrupoDataTable $examenGrupoDataTable)
    {
        return $examenGrupoDataTable->render('examen_grupos.index');
    }

    /**
     * Show the form for creating a new ExamenGrupo.
     *
     * @return Response
     */
    public function create()
    {
        return view('examen_grupos.create');
    }

    /**
     * Store a newly created ExamenGrupo in storage.
     *
     * @param CreateExamenGrupoRequest $request
     *
     * @return Response
     */
    public function store(CreateExamenGrupoRequest $request)
    {
        $input = $request->all();

        /** @var ExamenGrupo $examenGrupo */
        $examenGrupo = ExamenGrupo::create($input);

        Flash::success('Examen Grupo guardado exitosamente.');

        return redirect(route('examenGrupos.index'));
    }

    /**
     * Display the specified ExamenGrupo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ExamenGrupo $examenGrupo */
        $examenGrupo = ExamenGrupo::find($id);

        if (empty($examenGrupo)) {
            Flash::error('Examen Grupo no encontrado');

            return redirect(route('examenGrupos.index'));
        }

        return view('examen_grupos.show')->with('examenGrupo', $examenGrupo);
    }

    /**
     * Show the form for editing the specified ExamenGrupo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var ExamenGrupo $examenGrupo */
        $examenGrupo = ExamenGrupo::find($id);

        if (empty($examenGrupo)) {
            Flash::error('Examen Grupo no encontrado');

            return redirect(route('examenGrupos.index'));
        }

        return view('examen_grupos.edit')->with('examenGrupo', $examenGrupo);
    }

    /**
     * Update the specified ExamenGrupo in storage.
     *
     * @param  int              $id
     * @param UpdateExamenGrupoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamenGrupoRequest $request)
    {
        /** @var ExamenGrupo $examenGrupo */
        $examenGrupo = ExamenGrupo::find($id);

        if (empty($examenGrupo)) {
            Flash::error('Examen Grupo no encontrado');

            return redirect(route('examenGrupos.index'));
        }

        $examenGrupo->fill($request->all());
        $examenGrupo->save();

        Flash::success('Examen Grupo actualizado con éxito.');

        return redirect(route('examenGrupos.index'));
    }

    /**
     * Remove the specified ExamenGrupo from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ExamenGrupo $examenGrupo */
        $examenGrupo = ExamenGrupo::find($id);

        if (empty($examenGrupo)) {
            Flash::error('Examen Grupo no encontrado');

            return redirect(route('examenGrupos.index'));
        }

        $examenGrupo->delete();

        Flash::success('Examen Grupo deleted successfully.');

        return redirect(route('examenGrupos.index'));
    }
}
