<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExamenGrupoAPIRequest;
use App\Http\Requests\API\UpdateExamenGrupoAPIRequest;
use App\Models\ExamenGrupo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ExamenGrupoController
 * @package App\Http\Controllers\API
 */

class ExamenGrupoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ExamenGrupo.
     * GET|HEAD /examenGrupos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ExamenGrupo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $examenGrupos = $query->get();

        return $this->sendResponse($examenGrupos->toArray(), 'Examen Grupos retrieved successfully');
    }

    /**
     * Store a newly created ExamenGrupo in storage.
     * POST /examenGrupos
     *
     * @param CreateExamenGrupoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateExamenGrupoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ExamenGrupo $examenGrupo */
        $examenGrupo = ExamenGrupo::create($input);

        return $this->sendResponse($examenGrupo->toArray(), 'Examen Grupo guardado exitosamente');
    }

    /**
     * Display the specified ExamenGrupo.
     * GET|HEAD /examenGrupos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ExamenGrupo $examenGrupo */
        $examenGrupo = ExamenGrupo::find($id);

        if (empty($examenGrupo)) {
            return $this->sendError('Examen Grupo no encontrado');
        }

        return $this->sendResponse($examenGrupo->toArray(), 'Examen Grupo retrieved successfully');
    }

    /**
     * Update the specified ExamenGrupo in storage.
     * PUT/PATCH /examenGrupos/{id}
     *
     * @param int $id
     * @param UpdateExamenGrupoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamenGrupoAPIRequest $request)
    {
        /** @var ExamenGrupo $examenGrupo */
        $examenGrupo = ExamenGrupo::find($id);

        if (empty($examenGrupo)) {
            return $this->sendError('Examen Grupo no encontrado');
        }

        $examenGrupo->fill($request->all());
        $examenGrupo->save();

        return $this->sendResponse($examenGrupo->toArray(), 'ExamenGrupo actualizado con éxito');
    }

    /**
     * Remove the specified ExamenGrupo from storage.
     * DELETE /examenGrupos/{id}
     *
     * @param int $id
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
            return $this->sendError('Examen Grupo no encontrado');
        }

        $examenGrupo->delete();

        return $this->sendSuccess('Examen Grupo deleted successfully');
    }
}
