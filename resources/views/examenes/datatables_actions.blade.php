@can('Ver Examens')
    <a href="{{ route('examenes.show', $id) }}" data-toggle="tooltip" title="Ver" class='btn btn-default btn-sm'>
        <i class="fa fa-eye"></i>
    </a>
@endcan

@can('Editar Examens')
    @if($examen->estado_id == \App\Models\ExamenEstado::INGRESADO ||
        $examen->estado_id == \App\Models\ExamenEstado::SOLICITADO)
        <a href="{{ route('examenes.edit', $id) }}" data-toggle="tooltip" title="Editar" class='btn btn-outline-info btn-sm'>
            <i class="fa fa-edit"></i>
        </a>
    @endif
@endcan

@can('Eliminar Examens')
    @if($examen->estado_id == \App\Models\ExamenEstado::INGRESADO ||
        $examen->estado_id == \App\Models\ExamenEstado::SOLICITADO)
            <a href="#" onclick="deleteItemDt(this)" data-id="{{$id}}" data-toggle="tooltip" title="Eliminar" class='btn btn-outline-danger btn-sm'>
                <i class="fa fa-trash-alt"></i>
            </a>
    @endif

<form action="{{ route('examenes.destroy', $id)}}" method="POST" id="delete-form{{$id}}">
    @method('DELETE')
    @csrf
</form>
@endcan
