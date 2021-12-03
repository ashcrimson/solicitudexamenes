<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateExamenTipoAPIRequest;
use App\Http\Requests\API\UpdateExamenTipoAPIRequest;
use App\Models\ExamenTipo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ExamenTipoController
 * @package App\Http\Controllers\API
 */

class ExamenTipoAPIController extends AppBaseController
{
    /**
     * Display a listing of the ExamenTipo.
     * GET|HEAD /examenTipos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = ExamenTipo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $examenTipos = $query->get();

        return $this->sendResponse($examenTipos->toArray(), 'Examen Tipos retrieved successfully');
    }

    /**
     * Store a newly created ExamenTipo in storage.
     * POST /examenTipos
     *
     * @param CreateExamenTipoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateExamenTipoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ExamenTipo $examenTipo */
        $examenTipo = ExamenTipo::create($input);

        return $this->sendResponse($examenTipo->toArray(), 'Examen Tipo guardado exitosamente');
    }

    /**
     * Display the specified ExamenTipo.
     * GET|HEAD /examenTipos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ExamenTipo $examenTipo */
        $examenTipo = ExamenTipo::find($id);

        if (empty($examenTipo)) {
            return $this->sendError('Examen Tipo no encontrado');
        }

        return $this->sendResponse($examenTipo->toArray(), 'Examen Tipo retrieved successfully');
    }

    /**
     * Update the specified ExamenTipo in storage.
     * PUT/PATCH /examenTipos/{id}
     *
     * @param int $id
     * @param UpdateExamenTipoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExamenTipoAPIRequest $request)
    {
        /** @var ExamenTipo $examenTipo */
        $examenTipo = ExamenTipo::find($id);

        if (empty($examenTipo)) {
            return $this->sendError('Examen Tipo no encontrado');
        }

        $examenTipo->fill($request->all());
        $examenTipo->save();

        return $this->sendResponse($examenTipo->toArray(), 'ExamenTipo actualizado con éxito');
    }

    /**
     * Remove the specified ExamenTipo from storage.
     * DELETE /examenTipos/{id}
     *
     * @param int $id
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
            return $this->sendError('Examen Tipo no encontrado');
        }

        $examenTipo->delete();

        return $this->sendSuccess('Examen Tipo deleted successfully');
    }
}
