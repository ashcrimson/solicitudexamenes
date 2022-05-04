<div class="form-row" id="paciente-fields">
    <!-- Run Field -->
    <div class="form-group col-sm-4">

{{--        {!! Form::label('run', 'Run:') !!}--}}
        <label v-text="tituloSegunTipoDocumento"></label>

        <div class="input-group ">

            {!! Form::text('run', request()->rut ?? null, ['id' => 'run','class' => 'form-control','maxlength' => 9]) !!}
            <div class="input-group-append" v-if="ocultarBotonBuscar">
                <button class="btn btn-outline-success" type="button" @click="getDatosPaciente()">
                    <span v-show="!loading" style="font-size: 12px; position: relative; bottom: 5px;">
                        <i class="fa fa-search"></i>
                    </span>
                    <span v-show="loading">
                        <i class="fa fa-sync fa-spin"></i>
                    </span>
                    <span style="font-size: 12px; position: relative; bottom: 5px;">
                    Consultar
                    </span>
                </button>
            </div>
        </div>


    </div>

    <!-- Dv Run Field -->
    <div class="form-group col-sm-2">
        <div  v-if="ocultarBotonBuscar">
            {!! Form::label('dv_run', 'Dv Run:') !!}
            {!! Form::text('dv_run', null, ['id' => 'dv_run','class' => 'form-control','maxlength' => 1]) !!}
        </div>
    </div>

    <div class="form-group col-sm-12" style="padding: 0px; margin: 0px"></div>

    <!-- Primer Nombre Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('primer_nombre', 'Primer Nombre:') !!}
        {!! Form::text('primer_nombre', null, ['id' => 'primer_nombre','class' => 'form-control','maxlength' => 255]) !!}
    </div>

    <!-- Segundo Nombre Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}
        {!! Form::text('segundo_nombre', null, ['id' => 'segundo_nombre','class' => 'form-control','maxlength' => 255]) !!}
    </div>

    <!-- Apellido Paterno Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('apellido_paterno', 'Apellido Paterno:') !!}
        {!! Form::text('apellido_paterno', null, ['id' => 'apellido_paterno','class' => 'form-control','maxlength' => 255]) !!}
    </div>

    <!-- Apellido Materno Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('apellido_materno', 'Apellido Materno:') !!}
        {!! Form::text('apellido_materno', null, ['id' => 'apellido_materno','class' => 'form-control','maxlength' => 255]) !!}
    </div>

    <!-- Fecha Nac Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('fecha_nac', 'Fecha Nac:') !!}
        {!! Form::date('fecha_nac', null, ['v-model' => 'fecha_nac','id' => 'fecha_nac','class' => 'form-control','id'=>'fecha_nac']) !!}
    </div>


    <div class="form-group col-sm-3">
        <label for="">Edad</label>
        <input type="text" class="form-control" readonly v-model="edad" value="0">
    </div>


    <div class="form-group col-sm-3">
        {!! Form::label('sexo', 'Sexo:') !!}<br>
        <input type="checkbox" data-toggle="toggle" data-size="normal" data-on="M" data-off="F" data-style="ios" name="sexo" id="sexo"
               value="1"
            {{($rema->sexo ?? null)=="M" || ($paciente->sexo ?? null)=="M"  ? 'checked' : '' }}>
    </div>



    <!-- telefono Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('telefono', 'Telefono:') !!}
        {!! Form::text('telefono', null, ['id' => 'telefono','class' => 'form-control','maxlength' => 255]) !!}
    </div>

    <!-- Direccion Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('direccion', 'Dirección:') !!}
        {!! Form::text('direccion', null, ['id' => 'direccion','class' => 'form-control','maxlength' => 255]) !!}
    </div>

       <!-- Desc Servicio Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('descserv', 'Descripción Servicio:') !!}
        {!! Form::text('descserv', null, ['id' => 'descserv','class' => 'form-control','maxlength' => 255]) !!}
    </div>

       <!-- Desc Servicio Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('codserv', 'Código Servicio:') !!}
        {!! Form::text('codserv', null, ['id' => 'codserv','class' => 'form-control','maxlength' => 255]) !!}
    </div>


    <!-- familiar_responsable Field -->
    <!-- <div class="form-group col-sm-12">
        {!! Form::label('familiar_responsable', 'Familiar Responsable:') !!}
        {!! Form::text('familiar_responsable', null, ['id' => 'familiar_responsable','class' => 'form-control','maxlength' => 255]) !!}
    </div>
 -->

    <div class="modal fade" id="modalElegirTipoDocumento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">
                        {{__('Elegir Tipo Documento')}}
                    </h4>
                    {{--                    <button type="button" class="close" @click.prevent="closeElegirTipoDOcumento()">--}}
                    {{--                        <span aria-hidden="true">&times;</span>--}}
                    {{--                    </button>--}}
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">

                        <div class="form-group col-sm-8">
                            <label for="hora_de_llamada">Tipo Documento:</label>
                            <multiselect v-model="tipoDocumento" :options="tiposDocumentos" label="nombre" placeholder="Seleccione uno" >
                            </multiselect>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    {{--                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="closeElegirTipoDOcumento()">{{__('Cerrar')}}</button>--}}
                    <button type="button" @click.prevent="saveElegirTipoDocumento()" class="btn btn-primary" >{{__('Guardar')}}</button>
                </div>
            </div>
        </div>
    </div>

</div>



@push('scripts')
<script>


    const vmPacienteFields = new Vue({
        el: '#paciente-fields',
        name: 'paciente-fields',
        created() {
            this.openModalElegirTipoDocumento();

            @if(request()->rut)
                this.getDatosPaciente();
                @endif
            this.calcularEdad(this.fecha_nac);

            this.ocultarBotonBuscar;
            this.tituloSegunTipoDocumento;
        },
        data: {
            loading : false,
            fecha_nac : @json($parte->fecha_nac ?? null),
            edad : 0,

            tiposDocumentos: [
                {
                    id: 1,
                    nombre: 'RUT'
                },
                {
                    id: 2,
                    nombre: 'OTRO'
                },
            ],
            tipoDocumento: null,
        },
        methods: {
            async getDatosPaciente(){

                logI('FN: getDatosPaciente');

                this.loading = true;

                let run = $("#run").val();

                let url = "{{route('get.datos.paciente')}}"+"?run="+run;

                try{
                    let res = await axios.get(url);
                    let paciente = res.data.data;

                    //si existe la isntancia de vue vmPreparacionFields
                    if (typeof vmPreparacionFields  !== 'undefined') {
                        vmPreparacionFields.setDatosPreparacion(paciente.ultima_preparacion)
                    }

                    logI('respuesta',res);

                    if (!paciente){
                        alertWarning('Rut No Encontrado');
                    }else{
                        $("#dv_run").val(paciente.dv_run);
                        $("#apellido_paterno").val(paciente.apellido_paterno);
                        $("#apellido_materno").val(paciente.apellido_materno);
                        $("#primer_nombre").val(paciente.primer_nombre);
                        $("#segundo_nombre").val(paciente.segundo_nombre);
                        $("#fecha_nac").val(paciente.fecha_nac);
                        this.fecha_nac = paciente.fecha_nac;

                        if(typeof paciente["hosp"] === 'undefined'){

                            if (typeof paciente.ultimo_examen === 'undefined'){
                                alertWarning('Paciente no hospitalizado');
                            }else {

                                $("#codserv").val(paciente.ultimo_examen.codserv);
                                $("#descserv").val(paciente.ultimo_examen.descserv);
                                $("#nropiso").val(paciente.ultimo_examen.nropiso);
                                $("#nropieza").val(paciente.ultimo_examen.nropieza);
                                $("#nrocama").val(paciente.ultimo_examen.nrocama);

                            }


                        }else {


                            $("#codserv").val(paciente["hosp"].codserv);
                            $("#descserv").val(paciente["hosp"].descserv);
                            $("#nropiso").val(paciente["hosp"].nropiso);
                            $("#nropieza").val(paciente["hosp"].nropieza);
                            $("#nrocama").val(paciente["hosp"].nrocama);

                            var descserv = paciente["hosp"].descserv || null;


                            if (!descserv){
                                alertWarning('Paciente no hospitalizado');
                            }
                        }

                        if (paciente.sexo=='M'){
                            $('#sexo').bootstrapToggle('on')
                        }else {

                            $("#sexo").bootstrapToggle('off');
                        }

                        // Si viene del API

                        if (typeof paciente['Telefono'] !== 'undefined'){
                            $("#telefono").val(paciente['Telefono']);
                            $("#direccion").val(paciente['Direccion']);
                        }

                        // Si viene de la BBDD
                        else {
                            $("#telefono").val(paciente['telefono']);
                            $("#direccion").val(paciente['direccion']);

                        }

                        $("#familiar_responsable").val(paciente.familiar_responsable);
                    }


                    this.loading = false;

                }catch (e) {
                    logW(e);
                    alertWarning('Rut No Encontrado');
                    this.loading = false;
                }
            },
            calcularEdad(fecha){
                if (fecha){
                    var years = moment().diff(fecha, 'years',false);
                    this.edad = years;
                }
            },
            openModalElegirTipoDocumento() {
                setTimeout(() => {
                    // this.itemDipVde = Object.assign({}, this.itemDipVdeDefault);
                    $("#modalElegirTipoDocumento").modal('show');
                }, 300);
            },
            closeElegirTipoDOcumento() {
                setTimeout(() => {
                    // this.itemDipVde = Object.assign({}, this.itemDipVdeDefault);
                    $("#modalElegirTipoDocumento").modal('hide');
                }, 300);
            },
            saveElegirTipoDocumento() {
                console.log(this.tipoDocumento)
                if (this.tipoDocumento) {
                    this.closeElegirTipoDOcumento();
                } else {
                    iziTe('Debe elegir un Tipo Documento!');
                }
            }
        },
        computed: {
            ocultarBotonBuscar() {
                if (this.tipoDocumento) {
                    if (this.tipoDocumento.id == 2) {
                        return false;
                    } else {
                        return true;
                    }
                }
                return false;
            },
            tituloSegunTipoDocumento() {
                if (this.tipoDocumento) {
                    if (this.tipoDocumento.id == 2) {
                        return 'Numero identificación';
                    } else {
                        return 'RUN';
                    }
                }
                return 'Numero identificación';
            },
        },
        watch:{
            fecha_nac (fecha){
                if (fecha){
                    this.calcularEdad(fecha)
                }
            },
        }
    });
</script>
@endpush
