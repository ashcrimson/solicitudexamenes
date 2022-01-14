<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMuestraAPIRequest;
use App\Http\Requests\API\UpdateMuestraAPIRequest;
use App\Models\Muestra;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MuestraController
 * @package App\Http\Controllers\API
 */

class MuestraAPIController extends AppBaseController
{
    /**
     * Display a listing of the Muestra.
     * GET|HEAD /muestras
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = Muestra::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $muestras = $query->get();

        return $this->sendResponse($muestras->toArray(), 'Muestras retrieved successfully');
    }

    /**
     * Store a newly created Muestra in storage.
     * POST /muestras
     *
     * @param CreateMuestraAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMuestraAPIRequest $request)
    {
        $input = $request->all();

        /** @var Muestra $muestra */
        $muestra = Muestra::create($input);

        return $this->sendResponse($muestra->toArray(), 'Muestra guardado exitosamente');
    }

    /**
     * Display the specified Muestra.
     * GET|HEAD /muestras/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Muestra $muestra */
        $muestra = Muestra::find($id);

        if (empty($muestra)) {
            return $this->sendError('Muestra no encontrado');
        }

        return $this->sendResponse($muestra->toArray(), 'Muestra retrieved successfully');
    }

    /**
     * Update the specified Muestra in storage.
     * PUT/PATCH /muestras/{id}
     *
     * @param int $id
     * @param UpdateMuestraAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMuestraAPIRequest $request)
    {
        /** @var Muestra $muestra */
        $muestra = Muestra::find($id);

        if (empty($muestra)) {
            return $this->sendError('Muestra no encontrado');
        }

        $muestra->fill($request->all());
        $muestra->save();

        return $this->sendResponse($muestra->toArray(), 'Muestra actualizado con éxito');
    }

    /**
     * Remove the specified Muestra from storage.
     * DELETE /muestras/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Muestra $muestra */
        $muestra = Muestra::find($id);

        if (empty($muestra)) {
            return $this->sendError('Muestra no encontrado');
        }

        $muestra->delete();

        return $this->sendSuccess('Muestra deleted successfully');
    }
}
