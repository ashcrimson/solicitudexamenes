
@include('layouts.plugins.select2')

<style>
    .input-group-append {
        height: 30px;
    }

    .form-control {
        height: 30px;
    }
    .card-title {
        font-size: 1.0rem;
    }
    .table td, .table th {
        padding: 0.1rem;
    }
    .table tr th,td{
        font-size: 12px;
    }
    .muestras {
        height: 200px;
        overflow-y: scroll;
    }
    #paciente-fields{
        font-size: 12px;
    }

    select.form-control[multiple], select.form-control[size], textarea.form-control {
    height: 80px;
    }

    #fieldsExamen{
        font-size: 12px;
    }

    select.form-control {
        font-size: 12px;
    }

    .card-body {
        padding: 1rem;
    }
    button, input, optgroup, select, textarea{
        font-size: 10px;
    }
    .form-control{
        transition: none;
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

    <div class="form-group col-sm-12" style="font-size: 15px;">
        <label for="">Seleccione una opción</label>
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

    <div class="form-group col-sm-12 " v-if="gruposFiltrados.length != 0">
        <input class="form-control" type="text" v-model="searchQuery" placeholder="Ingrese Código o Descripcción para la busqueda...">
    </div>

    <div class="form-group col-sm-4 " v-for="grupo in gruposFiltrados">
        <div class="card muestras" >
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

                    <tr v-for="tipo in grupo.tipos" v-show="tiposFiltrados.includes(tipo.simple_text)">
                        <td>

                            <div style="font-size: 10px;">

                                <input type="checkbox"  :id="'tipo'+tipo.id" :name="'tipos['+tipo.id+']'" :value="tipo.id"
                                    v-model="tiposSeleccionados"
                                >

                                <label :for="'tipo'+tipo.id" >
                                    <span v-text="tipo.simple_text" :title="tooltipMostrar(tipo.codigo)"></span>
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

    <div class="form-group col-sm-12">

    </div>


    <div class="form-group col-sm-4" >
        <select-diagnostico
            label="Diagnostico"
            v-model="diagnostico" >

        </select-diagnostico>
    </div>

    <!-- Notas Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('notas', 'Notas:') !!}
        {!! Form::textarea('notas', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Programacion Field -->
    <div class="form-group col-sm-4">
        <label for="hora_de_llamada">Programación:</label>
        <input class="form-control" name="hora_de_llamada" type="datetime-local"  id="hora_de_llamada">
    </div>

    <input name="id_ext" type="hidden"  id="id_ext" value="{{ $id_ext ?? null }}">
    <input name="tipo_ext" type="hidden"  id="tipo_ext" value="{{ $tipo_ext ?? null }}">

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
            gruposRespaldo : @json($grupos ?? []),
            tiposSeleccionados : @json(isset($examen) ? $examen->tipos->pluck('id')->toArray() : []),//

            diagnostico : @json($examen->diagnostico ?? null),

            searchQuery: '',
        },
        methods: {
            tooltipMostrar(codigo) {
                if (codigo == 306992) {
                    return '-Influenza A, AH 1, A H3, -Influenza B, -Virus respiratorio sincicial A, B - Parainfluenza 1,' +
                        '2, 3,4 - Coronaviruz 229E, NL63, OC43, HKU1 - Metapneumovirus humano - Rhinovirus humano - Adenovirus' +
                        'Bocavirus humano - Chlamydophila pneumoniae - Legionella pneumophila - Mycoplasma pneumoniea';
                } else if (codigo == 306995) {
                    return 'Adenovirus, Citomegalovirus, Virus Epstein, Barr, Virus herpes simplex 1 y 2, Virus Varicella,' +
                        'Zoster, Enterovirus, Oarechovirus, Virus Herpes 6 y 7, Parvovirus B19';
                }
                return null;
            }
        },
        computed:{
            gruposFiltrados(){
                if (this.clase!=''){
                    return this.grupos[this.clase];
                }

                return [];
            },
            todosLosTipos(){
                let todos = [];
                this.gruposFiltrados.forEach(function (grupo){
                    grupo.tipos.forEach(function (tipo) {
                        todos.push(tipo.simple_text);
                    })

                })

                return todos;
            },
            tiposFiltrados(){
                if(this.searchQuery){
                    return this.todosLosTipos.filter((item)=>{
                        return this.searchQuery.toLowerCase().split(' ').every(v => item.toLowerCase().includes(v))
                    })
                }else{
                    return this.todosLosTipos;
                }
            },
        }
    });
</script>
@endpush
