@include('layouts.plugins.select2')

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

