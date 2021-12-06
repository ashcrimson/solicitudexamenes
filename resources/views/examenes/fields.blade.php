<style>
    .card-title {
        font-size: 1.0rem;
    }
    .table td, .table th {
        padding: 0.1rem;
    }
    .table tr th,td{
        font-size: 12px;
    }
</style>

<div class="col-12">
    <div class="card card-secondary ">
        <div class="card-header py-1 px-3">
            <h3 class="card-title">Información Paciente</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="form-row">
                @include('pacientes.fields')
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<div class="container-fluid">
    <div class="content-header">

        <div class="container-fluid">

            <div class="container" style="margin-top: 20px;">
                <div class="row">
                    @foreach($grupos as $grupo)
                    <div class="col-4">
                        <div class="card">
                            <h3 class="card-title titulocarta" style="text-align: center;">{{$grupo->nombre}}</h3>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Código</th>
                                    <th scope="col"></th>
                                    <th scope="col">Examen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($grupo->tipos as $tipo)

                                    <tr>
                                        <td>{{ $tipo->codigo }}</td>
                                        <td>
                                            <div >
                                                <input type="checkbox"  id="customCheck1" >
                                                <label for="customCheck1"></label>
                                            </div>
                                        </td>
                                        <td>{{ $tipo->nombre }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::label('name', 'Diagnostico:') !!}
                    <a class="success" data-toggle="modal" href="#modal-form-roles" tabindex="1000">nuevo</a>
                    {!!
                        Form::select(
                            'diagnosticos[]',
                            select(\App\Models\Diagnostico::class,'nombre','id',null)
                            , null
                            , ['id'=>'diagnosticos','class' => 'form-control listbox']
                        )
                    !!}
                </div>
                <!-- Notas Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('notas', 'Notas:') !!}
                    {!! Form::text('notas', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Programacion Field -->
                <div class="form-group col-sm-6">
                    <label for="hora_de_llamada">Programación:</label>
                    <input class="form-control" name="hora_de_llamada" type="datetime-local" id="hora_de_llamada">
                </div>
            </div>



        </div><!-- /.container-fluid -->


    </div>
