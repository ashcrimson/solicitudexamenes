<?php

namespace App\Http\Controllers;

use App\DataTables\DocumentoTipoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDocumentoTipoRequest;
use App\Http\Requests\UpdateDocumentoTipoRequest;
use App\Models\DocumentoTipo;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DocumentoTipoController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Documento Tipos')->only(['show']);
        $this->middleware('permission:Crear Documento Tipos')->only(['create','store']);
        $this->middleware('permission:Editar Documento Tipos')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Documento Tipos')->only(['destroy']);
    }

    /**
     * Display a listing of the DocumentoTipo.
     *
     * @param DocumentoTipoDataTable $documentoTipoDataTable
     * @return Response
     */
    public function index(DocumentoTipoDataTable $documentoTipoDataTable)
    {
        return $documentoTipoDataTable->render('documento_tipos.index');
    }

    /**
     * Show the form for creating a new DocumentoTipo.
     *
     * @return Response
     */
    public function create()
    {
        return view('documento_tipos.create');
    }

    /**
     * Store a newly created DocumentoTipo in storage.
     *
     * @param CreateDocumentoTipoRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentoTipoRequest $request)
    {
        $input = $request->all();

        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::create($input);

        Flash::success('Documento Tipo guardado exitosamente.');

        return redirect(route('documentoTipos.index'));
    }

    /**
     * Display the specified DocumentoTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            Flash::error('Documento Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        return view('documento_tipos.show')->with('documentoTipo', $documentoTipo);
    }

    /**
     * Show the form for editing the specified DocumentoTipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            Flash::error('Documento Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        return view('documento_tipos.edit')->with('documentoTipo', $documentoTipo);
    }

    /**
     * Update the specified DocumentoTipo in storage.
     *
     * @param  int              $id
     * @param UpdateDocumentoTipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentoTipoRequest $request)
    {
        /** @var DocumentoTipo $documentoTipo */
        $documentoTipo = DocumentoTipo::find($id);

        if (empty($documentoTipo)) {
            Flash::error('Documento Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        $documentoTipo->fill($request->all());
        $documentoTipo->save();

        Flash::success('Documento Tipo actualizado con éxito.');

        return redirect(route('documentoTipos.index'));
    }

    /**
     * Remove the specified DocumentoTipo from storage.
     *
     * @param  int $id
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
            Flash::error('Documento Tipo no encontrado');

            return redirect(route('documentoTipos.index'));
        }

        $documentoTipo->delete();

        Flash::success('Documento Tipo deleted successfully.');

        return redirect(route('documentoTipos.index'));
    }
}
