@extends('layouts.app')

@section('title_page',__('Nuevo Examen'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{__('Nuevo Examen')}}</h1>
                </div>
                <div class="col ">
                    <a class="btn btn-outline-info float-right"
                       href="{{url()->previous()}}">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;
                        <span class="d-none d-sm-inline">{{__('Regresar')}}
                        </span>
                    </a>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <div class="container-fluid">

            @include('layouts.partials.request_errors')

            <div class="card">
                <div class="card-body">

                    @if($clase)
                    {!! Form::open(['route' => 'examenes.store','class' => 'wait-on-submit']) !!}
                        <div class="form-row">

                            @include('examenes.fields')

                            <!-- Submit Field -->
                            <div class="form-group col-sm-12 text-right">
                                <a href="{!! route('examenes.index') !!}" class="btn btn-outline-secondary">
                                    Cancelar
                                </a>
                                &nbsp;
                                <button type="submit" class="btn btn-outline-success">
                                    <i class="fa fa-floppy-o"></i> Guardar
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    @else
                        <div class="form-row">
                            <div class="col-sm-4">

                                <a href="{{route('examenes.create',['clase' => 'rutina'])}}" type="button" class="btn btn-outline-info">
                                    Rutina
                                </a>
                            </div>

                            <div class="col-sm-4">

                                <a href="{{route('examenes.create',['clase' => 'urgencia'])}}" type="button" class="btn btn-outline-warning">
                                    Urgencia
                                </a>

                            </div>




                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
