@foreach($examen->tipos as $tipo)
    <span class="badge badge-info">
        {{$tipo->text}}
    </span>
@endforeach
