<!-- Paciente Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paciente_id', 'Paciente Id:') !!}
    {!! Form::number('paciente_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Diagnostico Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diagnostico_id', 'Diagnostico Id:') !!}
    {!! Form::number('diagnostico_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Programa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_programa', 'Fecha Programa:') !!}
    {!! Form::date('fecha_programa', null, ['class' => 'form-control','id'=>'fecha_programa']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#fecha_programa').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- User Solicita Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_solicita', 'User Solicita:') !!}
    {!! Form::number('user_solicita', null, ['class' => 'form-control']) !!}
</div>

<!-- User Realiza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_realiza', 'User Realiza:') !!}
    {!! Form::number('user_realiza', null, ['class' => 'form-control']) !!}
</div>

<!-- Fecha Realiza Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fecha_realiza', 'Fecha Realiza:') !!}
    {!! Form::date('fecha_realiza', null, ['class' => 'form-control','id'=>'fecha_realiza']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#fecha_realiza').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Muestras Field -->
<div class="form-group col-sm-6">
    {!! Form::label('muestras', 'Muestras:') !!}
    {!! Form::text('muestras', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Rutina Urgencia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rutina_urgencia', 'Rutina Urgencia:') !!}
    {!! Form::text('rutina_urgencia', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Notas Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notas', 'Notas:') !!}
    {!! Form::textarea('notas', null, ['class' => 'form-control']) !!}
</div>

<!-- Estado Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('estado_id', 'Estado Id:') !!}
    {!! Form::number('estado_id', null, ['class' => 'form-control']) !!}
</div>
