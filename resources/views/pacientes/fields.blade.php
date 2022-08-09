<div class="row" id="paciente-fields">

    <div class="form-group col-sm-12">

        <div class="form-group col-sm-3">
            {!! Form::label('documento_tipo', 'Tipo de Documento:') !!}
            <multiselect v-model="documentoTipo" :options="documentoTipos" label="nombre" placeholder="Seleccione uno...">
            </multiselect>
            <input type="hidden" name="documento_tipo_id" :value="documentoTipo ? documentoTipo.id : null">
        </div>

    </div>

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
    <div class="form-group row col-sm-6">
        {!! Form::label('primer_nombre', 'Nombres:', ['class' => 'col-sm-2']) !!}
        <div class="col-sm-5">
            {!! Form::text('primer_nombre', null, ['id' => 'primer_nombre','class' => 'form-control','maxlength' => 255]) !!}
        </div>
        <div class="col-sm-5">
            {!! Form::text('segundo_nombre', null, ['id' => 'segundo_nombre','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>

{{--    <!-- Segundo Nombre Field -->--}}
{{--    <div class="form-group col-sm-3">--}}
{{--        {!! Form::label('segundo_nombre', 'Segundo Nombre:') !!}--}}
{{--        {!! Form::text('segundo_nombre', null, ['id' => 'segundo_nombre','class' => 'form-control','maxlength' => 255]) !!}--}}
{{--    </div>--}}

    <!-- Fecha Nac Field -->
    <div class="form-group row col-sm-6">
        {!! Form::label('fecha_nac', 'Fecha Nac:', ['class' => 'col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::date('fecha_nac', null, ['v-model' => 'fecha_nac','id' => 'fecha_nac','class' => 'form-control','id'=>'fecha_nac']) !!}
        </div>
    </div>

    <!-- Apellido Paterno Field -->
    <div class="form-group row col-sm-6">
        {!! Form::label('apellido_paterno', 'Apellidos:', ['class' => 'col-sm-2']) !!}
        <div class="col-sm-5">
            {!! Form::text('apellido_paterno', null, ['id' => 'apellido_paterno','class' => 'form-control','maxlength' => 255]) !!}
        </div>
        <div class="col-sm-5">
            {!! Form::text('apellido_materno', null, ['id' => 'apellido_materno','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>

{{--    <!-- Apellido Materno Field -->--}}
{{--    <div class="form-group col-sm-3">--}}
{{--        {!! Form::label('apellido_materno', 'Apellido Materno:') !!}--}}
{{--        {!! Form::text('apellido_materno', null, ['id' => 'apellido_materno','class' => 'form-control','maxlength' => 255]) !!}--}}
{{--    </div>--}}

    <div class="form-group row col-sm-6">
        {!! Form::label('sexo', 'Sexo:', ['class' => 'col-sm-2']) !!}<br>
        <div class="col-sm-10">
            <input type="checkbox" data-toggle="toggle" data-size="normal" data-on="M" data-off="F" data-style="ios" name="sexo" id="sexo"
                   value="1"
                {{($rema->sexo ?? null)=="M" || ($paciente->sexo ?? $examen->paciente->sexo ?? null)=="M"  ? 'checked' : '' }}>
        </div>
    </div>

    <!-- telefono Field -->
    <div class="form-group row col-sm-6">
        {!! Form::label('telefono', 'Telefono:', ['class' => 'col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::text('telefono', null, ['id' => 'telefono','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>


    <div class="form-group row col-sm-6">
        <label class="col-sm-2">Edad</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" readonly v-model="edad" value="0">
        </div>
    </div>

    <!-- Direccion Field -->
    <div class="form-group row col-sm-6">
        {!! Form::label('direccion', 'Dirección:', ['class' => 'col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::text('direccion', null, ['id' => 'direccion','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>

       <!-- Desc Servicio Field -->
    <div class="form-group row col-sm-6">
        {!! Form::label('descserv', 'Descripción Servicio:', ['class' => 'col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::text('descserv', null, ['id' => 'descserv','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>

       <!-- Desc Servicio Field -->
    <div class="form-group row col-sm-6">
        {!! Form::label('codserv', 'Código Servicio:', ['class' => 'col-sm-2']) !!}
        <div class="col-sm-10">
            {!! Form::text('codserv', null, ['id' => 'codserv','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>

    <!-- familiar_responsable Field -->
    <!-- <div class="form-group col-sm-12">
        {!! Form::label('familiar_responsable', 'Familiar Responsable:') !!}
        {!! Form::text('familiar_responsable', null, ['id' => 'familiar_responsable','class' => 'form-control','maxlength' => 255]) !!}
    </div>
 -->

    <div class="form-group row col-sm-6">
        {!! Form::label('tipo_solicitud', 'Tipo Solicitud:', ['class' => 'col-sm-2']) !!}
        <div class="col-sm-10">
            <select class="form-control" name="tipo_solicitud" id="tipo_solicitud">
                <option value="">Seleccione ...</option>
                <option value="ambulatiorio">AMBULATORIO</option>
                <option value="hospitalizado">HOSPITALIZADO</option>
            </select>
        </div>
    </div>

    <input type="hidden" name="inghosp" id="inghosp">

    <div class="form-group row col-sm-6">
        <label class="col-sm-2">Ubicación:</label>
        <div class="col-sm-10">
            {!! Form::text('codubic', null, ['id' => 'codubic','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>

    <div class="form-group row col-sm-6">
        <label class="col-sm-2">Piso:</label>
        <div class="col-sm-10">
            {!! Form::text('nropiso', null, ['id' => 'nropiso','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>

    <div class="form-group row col-sm-6">
        <label class="col-sm-2" for="nropieza">Pieza:</label>
        <div class="col-sm-10">
            {!! Form::text('nropieza', null, ['id' => 'nropieza','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>

    <div class="form-group row col-sm-6">
        <label class="col-sm-2" for="tipocama">Cama:</label>
        <div class="col-sm-10">
            {!! Form::text('tipocama', null, ['id' => 'tipocama','class' => 'form-control','maxlength' => 255]) !!}
        </div>
    </div>

</div>

@push('scripts')
<script>


    const vmPacienteFields = new Vue({
        el: '#paciente-fields',
        name: 'paciente-fields',
        created() {

            @if(request()->rut)
                this.getDatosPaciente();
                @endif
            this.calcularEdad(this.fecha_nac);

            this.ocultarBotonBuscar;
            this.tituloSegunTipoDocumento;
        },
        data: {
            loading : false,
            fecha_nac : @json($examen->paciente->fecha_nac ?? null),
            edad : 0,

            rut: false,
            otro_doc: false,

            documentoTipos: @json(\App\Models\DocumentoTipo::all() ?? []),
            documentoTipo: @json(\App\Models\DocumentoTipo::where('id', old('documento_tipo_id', $examen->paciente->documento_tipo_id ?? 2 ?? null))->first() ?? null)
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
                        // alertWarning('Rut No Encontrado');
                    }else{
                        $("#dv_run").val(paciente.dv_run);
                        $("#apellido_paterno").val(paciente.apellido_paterno);
                        $("#apellido_materno").val(paciente.apellido_materno);
                        $("#primer_nombre").val(paciente.primer_nombre);
                        $("#segundo_nombre").val(paciente.segundo_nombre);
                        $("#fecha_nac").val(paciente.fecha_nac);
                        this.fecha_nac = paciente.fecha_nac;

                        if(typeof paciente["hosp"] === 'undefined'){

                            // if (typeof paciente.ultimo_examen === 'undefined'){
                            //     alertWarning('Paciente no hospitalizado');
                            // }else {

                                $("#codserv").val(paciente.ultimo_examen.codserv);
                                $("#descserv").val(paciente.ultimo_examen.descserv);
                                $("#nropiso").val(paciente.ultimo_examen.nropiso);
                                $("#nropieza").val(paciente.ultimo_examen.nropieza);
                                $("#nrocama").val(paciente.ultimo_examen.nrocama);
                                $("#codubic").val(paciente.ultimo_examen.codubic);

                                if (paciente.ultimo_examen.inghosp) {
                                    $("#tipo_solicitud").val('hospitalizado');
                                } else {
                                    $("#tipo_solicitud").val('ambulatiorio');
                                }

                            // }


                        }else {


                            $("#codserv").val(paciente["hosp"].codserv);
                            $("#descserv").val(paciente["hosp"].descserv);
                            $("#nropiso").val(paciente["hosp"].nropiso);
                            $("#nropieza").val(paciente["hosp"].nropieza);
                            $("#nrocama").val(paciente["hosp"].nrocama);
                            $("#codubic").val(paciente.ultimo_examen.codubic);

                            if (paciente.ultimo_examen.inghosp) {
                                $("#tipo_solicitud").val('hospitalizado');
                            } else {
                                $("#tipo_solicitud").val('ambulatiorio');
                            }

                            var descserv = paciente["hosp"].descserv || null;


                            // if (!descserv){
                            //     alertWarning('Paciente no hospitalizado');
                            // }
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
                    // alertWarning('Rut No Encontrado');
                    this.loading = false;
                }
            },
            calcularEdad(fecha){
                if (fecha){
                    var years = moment().diff(fecha, 'years',false);
                    this.edad = years;
                }
            },
        },
        computed: {
            ocultarBotonBuscar() {
                if (this.documentoTipo) {
                    if (this.documentoTipo.id == 1) {
                        return false;
                    } else if (this.documentoTipo.id == 2) {
                        return true;
                    } else if (this.documentoTipo.id == 3) {
                        return false;
                    } else if (this.documentoTipo.id == 4) {
                        return false;
                    }
                }
                return false;
            },
            tituloSegunTipoDocumento() {
                if (this.documentoTipo) {
                    if (this.documentoTipo.id == 1) {
                        return 'NN';
                    } else if (this.documentoTipo.id == 2) {
                        return 'RUT';
                    } else if (this.documentoTipo.id == 3) {
                        return 'PASAPORTE';
                    } else if (this.documentoTipo.id == 4) {
                        return 'RECIEN NACIDO';
                    }
                }
                return 'NN';
            },
        },
        watch:{
            fecha_nac (fecha){
                if (fecha){
                    this.calcularEdad(fecha)
                }
            },
            rut(val) {
                if (val) {
                    this.otro_doc = false;
                }
            },
            otro_doc(val) {
                if (val) {
                    this.rut = false;
                }
            },
        }
    });
</script>
@endpush
