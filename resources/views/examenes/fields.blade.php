
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


<div id="fieldsExamen" class="form-row">

    <div class="form-group col-sm-12">
        <label for="">Seleccionte una opción</label>
        <br>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="rutina" v-model="clase" name="rutina_urgencia" class="custom-control-input" value="rutina">
            <label class="custom-control-label" for="rutina">Rutina</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="urgencia" v-model="clase" name="rutina_urgencia" class="custom-control-input" value="urgencia">
            <label class="custom-control-label" for="urgencia">Urgencia</label>
        </div>
    </div>

    <br>


    <div class="form-group col-sm-6" v-for="grupo in gruposFiltrados">
        <div class="card" >
            <h3 class="card-title titulocarta" style="text-align: center;">
                <span v-text="grupo.nombre"></span>
            </h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Examen</th>
                    <th scope="col">Muestras</th>
                </tr>
                </thead>
                <tbody>

                    <tr v-for="tipo in grupo.tipos">
                        <td>

                            <div >

                                <input type="checkbox"  :id="'tipo'+tipo.id" :name="'tipos['+tipo.id+']'" :value="tipo.id"
                                    v-model="tiposSeleccionados"
                                >

                                <label :for="'tipo'+tipo.id">
                                    <span v-text="tipo.codigo"></span> - <span v-text="tipo.nombre"></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <select :name="'muestras['+tipo.id+']'" id="">
                                <option v-for="muestra in tipo.muestras" :value="muestra.id">
                                    @{{ muestra.text }}
                                </option>
                            </select>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>


    <div class="form-group col-sm-12" style="padding: 0px; margin: 0px"></div>

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
            clase : @json($examen->rutina_urgencia ?? ''),
            grupos : @json($grupos ?? []),
            tiposSeleccionados : @json(isset($examen) ? $examen->tipos->pluck('id')->toArray() : []),//

            diagnostico : @json($examen->diagnostico ?? null),
        },
        methods: {


        },
        computed:{
            gruposFiltrados(){
                if (this.clase!=''){
                    return this.grupos[this.clase];
                }

                return [];
            }
        }


    });
</script>
@endpush
