<?php

namespace App\Http\Controllers;

use App\DataTables\MuestraDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateMuestraRequest;
use App\Http\Requests\UpdateMuestraRequest;
use App\Models\Muestra;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class MuestraController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('permission:Ver Muestras')->only(['show']);
        $this->middleware('permission:Crear Muestras')->only(['create','store']);
        $this->middleware('permission:Editar Muestras')->only(['edit','update',]);
        $this->middleware('permission:Eliminar Muestras')->only(['destroy']);
    }

    /**
     * Display a listing of the Muestra.
     *
     * @param MuestraDataTable $muestraDataTable
     * @return Response
     */
    public function index(MuestraDataTable $muestraDataTable)
    {
        return $muestraDataTable->render('muestras.index');
    }

    /**
     * Show the form for creating a new Muestra.
     *
     * @return Response
     */
    public function create()
    {
        return view('muestras.create');
    }

    /**
     * Store a newly created Muestra in storage.
     *
     * @param CreateMuestraRequest $request
     *
     * @return Response
     */
    public function store(CreateMuestraRequest $request)
    {
        $input = $request->all();

        /** @var Muestra $muestra */
        $muestra = Muestra::create($input);

        Flash::success('Muestra guardado exitosamente.');

        return redirect(route('muestras.index'));
    }

    /**
     * Display the specified Muestra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Muestra $muestra */
        $muestra = Muestra::find($id);

        if (empty($muestra)) {
            Flash::error('Muestra no encontrado');

            return redirect(route('muestras.index'));
        }

        return view('muestras.show')->with('muestra', $muestra);
    }

    /**
     * Show the form for editing the specified Muestra.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Muestra $muestra */
        $muestra = Muestra::find($id);

        if (empty($muestra)) {
            Flash::error('Muestra no encontrado');

            return redirect(route('muestras.index'));
        }

        return view('muestras.edit')->with('muestra', $muestra);
    }

    /**
     * Update the specified Muestra in storage.
     *
     * @param  int              $id
     * @param UpdateMuestraRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMuestraRequest $request)
    {
        /** @var Muestra $muestra */
        $muestra = Muestra::find($id);

        if (empty($muestra)) {
            Flash::error('Muestra no encontrado');

            return redirect(route('muestras.index'));
        }

        $muestra->fill($request->all());
        $muestra->save();

        Flash::success('Muestra actualizado con éxito.');

        return redirect(route('muestras.index'));
    }

    /**
     * Remove the specified Muestra from storage.
     *
     * @param  int $id
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
            Flash::error('Muestra no encontrado');

            return redirect(route('muestras.index'));
        }

        $muestra->delete();

        Flash::success('Muestra deleted successfully.');

        return redirect(route('muestras.index'));
    }
}
