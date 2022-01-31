@include('layouts.plugins.select2')

<div class="form-row">

    <!-- Grupo Id Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('grupo_id','Grupo:') !!}
        {!!
            Form::select(
                'grupo_id',
                select(\App\Models\ExamenGrupo::class,'nombre','id',null,null)
                , null
                , ['id'=>'models','class' => 'form-control select2-simple','multiple','style'=>'width: 100%']
            )
        !!}
    </div>

    <!-- Codigo Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('codigo', 'Codigo:') !!}
        {!! Form::text('codigo', null, ['class' => 'form-control','maxlength' => 45,'maxlength' => 45,'maxlength' => 45]) !!}
    </div>

    <!-- Nombre Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('rutina_emergencia','Rutina Emergencia:') !!}
        {!!
            Form::select(
                'rutina_emergencia',
                [
                    'rutina' =>'rutina',
                    'emergencia' =>'emergencia',
                    'ambas' =>'ambas',
                ]
                , null
                , ['id'=>'rutina_emergencias','class' => 'form-control','style'=>'width: 100%']
            )
        !!}
    </div>

    <div class="form-group col-sm-12">
        {!! Form::label('name', 'Muestras:') !!}
        {!!
            Form::select(
                'muestras[]',
                select(\App\Models\Muestra::class,'text','id',null)
                , null
                , ['class' => 'form-control duallistbox','multiple']
            )
        !!}
    </div>


</div>

@push('scripts')
<script>
    const app = new Vue({
        el: '#camposTipoExamen',
        created() {

        },
        data: {

        },
        methods: {

        }
    });
</script>
@endpush
