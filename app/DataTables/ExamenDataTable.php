<?php

namespace App\DataTables;

use App\Models\Examen;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ExamenDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

       return $dataTable->addColumn('action', function(Examen $examen){

                 $id = $examen->id;

                 return view('examenes.datatables_actions',compact('examen','id'))->render();
             })
           ->editColumn('paciente.nombre_completo',function (Examen $examen){

               return $examen->paciente->nombre_completo;

           })
           ->editColumn('muestras',function (Examen $examen){

               return $examen->muestras_string;

           })
             ->editColumn('id',function (Examen $examen){

                 return $examen->id;

                 //se debe crear la vista modal_detalles
                 //return view('examenes.modal_detalles',compact('examen'))->render();

             })
             ->rawColumns(['action','id']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Examen $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Examen $model)
    {
        return $model->newQuery()->with(['paciente','diagnostico','estado','userSolicita']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->ajax([
                'data' => "function(data) { formatDataDataTables($('#formFiltersDatatables').serializeArray(), data);   }"
            ])
            ->parameters([
                'dom'     => '
                                    <"row mb-2"
                                        <"col-sm-12 col-md-6" B>
                                        <"col-sm-12 col-md-6" f>
                                    >
                                    rt
                                    <"row"
                                        <"col-sm-6 order-2 order-sm-1" ip>
                                        <"col-sm-6 order-1 order-sm-2 text-right" l>

                                    >',
                'order'   => [[0, 'desc']],
                'language' => ['url' => asset('js/SpanishDataTables.json')],
                //'scrollX' => false,
                'responsive' => true,
                'stateSave' => true,
                'buttons' => [
                    //['extend' => 'create', 'text' => '<i class="fa fa-plus"></i> <span class="d-none d-sm-inline">Crear</span>'],
                    ['extend' => 'print', 'text' => '<i class="fa fa-print"></i> <span class="d-none d-sm-inline">Imprimir</span>'],
                    //['extend' => 'reload', 'text' => '<i class="fa fa-sync-alt"></i> <span class="d-none d-sm-inline">Recargar</span>'],
                    ['extend' => 'reset', 'text' => '<i class="fa fa-undo"></i> <span class="d-none d-sm-inline">Reiniciar</span>'],
                    ['extend' => 'export', 'text' => '<i class="fa fa-download"></i> <span class="d-none d-sm-inline">Exportar</span>'],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('paciente')->name('paciente.nombre_completo')->data('paciente.nombre_completo')
                ->searchable(false)->orderable(false),
            Column::make('diagnostico')->name('diagnostico.nombre')->data('diagnostico.nombre'),
            Column::make('Medico')->name('userSolicita.name')->data('user_solicita.name'),
            Column::make('muestras')->orderable(false)->searchable(false),
            Column::make('rutina_urgencia'),
            Column::make('estado')->data('estado.nombre')->name('estado.nombre'),


            Column::make('paciente.apellido_paterno')
                ->visible(false)
                ->exportable(false),
            Column::make('paciente.apellido_materno')
                ->visible(false)->exportable(false),
            Column::make('paciente.primer_nombre')
                ->visible(false)->exportable(false),
            Column::make('paciente.segundo_nombre')
                ->visible(false)->exportable(false),



        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'examensdatatable_' . time();
    }
}
