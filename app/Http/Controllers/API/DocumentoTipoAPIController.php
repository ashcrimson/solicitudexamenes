<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDocumentoTipoAPIRequest;
use App\Http\Requests\API\UpdateDocumentoTipoAPIRequest;
use App\Models\DocumentoTipo;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DocumentoTipoController
 * @package App\Http\Controllers\API
 */

class DocumentoTipoAPIController extends AppBaseController
{
    /**
     * Display a listing of the DocumentoTipo.
     * GET|HEAD /documentoTipos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $query = DocumentoTipo::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $documentoTipos = $query->get();

        return $this->sendResponse($documentoTipos->toArray(), 'Documento Tipos retrieved successfully');
    }

    /**
     * Store a newly created DocumentoTipo in storage.
     * POST /documentoTipos
     *
     * @param CreateDocumentoTipoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentoTipoAPIRequest $request)
    {
        $input = $request->all();

        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::create($input);

        return $this->sendResponse($documentoTipo->toArray(), 'Documento Tipo guardado exitosamente');
    }

    /**
     * Display the specified DocumentoTipo.
     * GET|HEAD /documentoTipos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            return $this->sendError('Documento Tipo no encontrado');
        }

        return $this->sendResponse($documentoTipo->toArray(), 'Documento Tipo retrieved successfully');
    }

    /**
     * Update the specified DocumentoTipo in storage.
     * PUT/PATCH /documentoTipos/{id}
     *
     * @param int $id
     * @param UpdateDocumentoTipoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentoTipoAPIRequest $request)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            return $this->sendError('Documento Tipo no encontrado');
        }

        $documentoTipo->fill($request->all());
        $documentoTipo->save();

        return $this->sendResponse($documentoTipo->toArray(), 'DocumentoTipo actualizado con éxito');
    }

    /**
     * Remove the specified DocumentoTipo from storage.
     * DELETE /documentoTipos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            return $this->sendError('Documento Tipo no encontrado');
        }

        $documentoTipo->delete();

        return $this->sendSuccess('Documento Tipo deleted successfully');
    }
}
