@extends('layouts.app')

@section('title_page',__('Mis Solicitudes'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mis Solicitudes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">


                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-success" data-toggle="modal"
                                    data-target="#modalNuevoExamen">
                                <i class="fa fa-plus"></i>
                                <span class="d-none d-sm-inline">{{__('Nuevo')}}</span>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalNuevoExamen" tabindex="-1" role="dialog"
                                 aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="modelTitleId">
                                                Seleccione una opción
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-row">
                                                <div class="col-sm-4">

                                                    <a href="{{route('examenes.nuevo','rutina')}}" type="button" class="btn btn-outline-info">
                                                        Rutina
                                                    </a>
                                                </div>

                                                <div class="col-sm-4">

                                                    <a href="{{route('examenes.nuevo','urgencia')}}" type="button" class="btn btn-outline-warning">
                                                        Urgencia
                                                    </a>

                                                </div>

                                                <div class="col-sm-4">
                                                    <a href="{{route('examenes.nuevo','ambas')}}" type="button" class="btn btn-outline-success">
                                                        ambas
                                                    </a>
                                                </div>



                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">

            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Filtros</h3>

                    <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @include('examenes.form_filters')
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card card-primary">
                <div class="card-body">
                        @include('examenes.table')
                </div>
            </div>
            <div class="text-center">

            </div>
        </div>
    </div>
@endsection

