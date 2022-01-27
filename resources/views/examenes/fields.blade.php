
@include('layouts.plugins.select2')

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


<div id="fieldsExamen">

    <div class="row">
        @foreach($grupos as $grupo)
            <div class="col-6">
                <div class="card">
                    <h3 class="card-title titulocarta" style="text-align: center;">{{$grupo->nombre}}</h3>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Examen</th>
                            <th scope="col">Muestras</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($grupo->tipos as $tipo)

                            <tr>
                                <td>

                                    <div >

                                        <input type="checkbox"  id="tipo{{$tipo->id}}" name="tipos[{{$tipo->id}}]" value="{{$tipo->id}}"
                                            {{in_array($tipo->id,isset($examen) ? $examen->tipos->pluck('id')->toArray() : []) ? 'checked' : ''}}
                                        >

                                        <label for="tipo{{$tipo->id}}">
                                            {{ $tipo->codigo }} - {{ $tipo->nombre }}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <select name="muestras[{{$tipo->id}}]" id="">
                                        @foreach($tipo->muestras as $muestra)
                                            <option value="{{$muestra->id}}">
                                                {{$muestra->text}}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

    <div class="form-group col-sm-6">
        <select-diagnostico
            label="Diagnostico"
            v-model="diagnostico" >

        </select-diagnostico>
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

@push('scripts')
<script>
    const app = new Vue({
        el: '#fieldsExamen',
        name: '#fieldsExamen',
        created() {

        },
        data: {
            diagnostico : @json($examen->diagnostico ?? null),
        },
        methods: {

        }
    });
</script>
@endpush
