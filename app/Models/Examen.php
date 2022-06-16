<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Examen
 * @package App\Models
 * @version January 30, 2022, 6:01 pm CST
 *
 * @property \App\Models\User $userSolicita
 * @property \App\Models\Diagnostico $diagnostico
 * @property \App\Models\Paciente $paciente
 * @property \App\Models\User $userRealiza
 * @property \App\Models\ExamenEstado $estado
 * @property \Illuminate\Database\Eloquent\Collection $tipos
 * @property integer $paciente_id
 * @property integer $diagnostico_id
 * @property string|\Carbon\Carbon $fecha_programa
 * @property integer $user_solicita
 * @property integer $user_realiza
 * @property string|\Carbon\Carbon $fecha_realiza
 * @property string $rutina_urgencia
 * @property string $notas
 * @property string $id_ext
 * @property string $tipo_ext
 * @property integer $estado_id
 */
class Examen extends Model
{
    use SoftDeletes;

    public $table = 'examenes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'paciente_id',
        'diagnostico_id',
        'fecha_programa',
        'user_solicita',
        'user_realiza',
        'fecha_realiza',
        'rutina_urgencia',
        'notas',
        'estado_id',
        'descserv',
        'ingreso',
        'inghosp',
        'nrocama',
        'codubic',
        'nropiso',
        'nropieza',
        'tipocama',
        'codserv',
        'codinst',
        'descinst',
        'id_ext',
        'tipo_ext',
        'tipo_solicitud',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'paciente_id' => 'integer',
        'diagnostico_id' => 'integer',
        'fecha_programa' => 'datetime',
        'user_solicita' => 'integer',
        'user_realiza' => 'integer',
        'fecha_realiza' => 'datetime',
        'rutina_urgencia' => 'string',
        'notas' => 'string',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'diagnostico_id' => 'nullable',
        'rutina_urgencia' => 'nullable|string|max:255',
        'notas' => 'nullable|string',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userSolicita()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_solicita');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function diagnostico()
    {
        return $this->belongsTo(\App\Models\Diagnostico::class, 'diagnostico_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function paciente()
    {
        return $this->belongsTo(\App\Models\Paciente::class, 'paciente_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userRealiza()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_realiza');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function estado()
    {
        return $this->belongsTo(\App\Models\ExamenEstado::class, 'estado_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function tipos()
    {
        return $this->belongsToMany(\App\Models\ExamenTipo::class, 'tipos_has_examen','examen_id','tipo_id')
            ->withPivot('muestra_id');
    }

    public function getMuestrasStringAttribute()
    {
        $muestras = [];

        foreach ($this->tipos as $index => $tipo) {
            $muestras[$tipo->pivot->muestra_id] = $tipo->pivot->muestra_id;
        }

        sort($muestras);

        return implode(',',$muestras);
    }
}
