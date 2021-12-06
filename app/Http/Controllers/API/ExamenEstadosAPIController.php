<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExamenEstadosAPIRequest;
use App\Http\Requests\API\UpdateExamenEstadosAPIRequest;
use App\Models\ExamenEstado;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ExamenEstadosController
 * @package App\Http\Controllers\API
 */

class ExamenEstadosAPIController extends AppBaseController
{
    /**
     * Display a listing of the ExamenEstado.
     * GET|HEAD /examenEstados
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ExamenEstado::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $examenEstados = $query->get();

        return $this->sendResponse($examenEstados->toArray(), 'Examen Estados retrieved successfully');
    }

    /**
     * Store a newly created ExamenEstado in storage.
     * POST /examenEstados
     *
     * @param CreateExamenEstadosAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateExamenEstadosAPIRequest $request)
    {
        $input = $request->all();

        /** @var ExamenEstado $examenEstados */
        $examenEstados = ExamenEstado::create($input);

        return $this->sendResponse($examenEstados->toArray(), 'Examen Estados guardado exitosamente');
    }

    /**
     * Display the specified ExamenEstado.
     * GET|HEAD /examenEstados/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ExamenEstado $examenEstados */
        $examenEstados = ExamenEstado::find($id);

        if (empty($examenEstados)) {
            return $this->sendError('Examen Estados no encontrado');
        }

        return $this->sendResponse($examenEstados->toArray(), 'Examen Estados retrieved successfully');
    }

    /**
     * Update the specified ExamenEstado in storage.
     * PUT/PATCH /examenEstados/{id}
     *
     * @param int $id
     * @param UpdateExamenEstadosAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamenEstadosAPIRequest $request)
    {
        /** @var ExamenEstado $examenEstados */
        $examenEstados = ExamenEstado::find($id);

        if (empty($examenEstados)) {
            return $this->sendError('Examen Estados no encontrado');
        }

        $examenEstados->fill($request->all());
        $examenEstados->save();

        return $this->sendResponse($examenEstados->toArray(), 'ExamenEstado actualizado con éxito');
    }

    /**
     * Remove the specified ExamenEstado from storage.
     * DELETE /examenEstados/{id}
     *
     * @param int $id
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
            return $this->sendError('Examen Estados no encontrado');
        }

        $examenEstados->delete();

        return $this->sendSuccess('Examen Estados deleted successfully');
    }
}
