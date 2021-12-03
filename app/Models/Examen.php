<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Examen
 * @package App\Models
 * @version December 3, 2021, 5:34 pm CST
 *
 * @property \App\Models\User $userSolicita
 * @property \App\Models\Diagnostico $diagnostico
 * @property \App\Models\Paciente $paciente
 * @property \App\Models\User $userRealiza
 * @property \App\Models\ExamenEstado $estado
 * @property \Illuminate\Database\Eloquent\Collection $examenTipos
 * @property integer $paciente_id
 * @property integer $diagnostico_id
 * @property string|\Carbon\Carbon $fecha_programa
 * @property integer $user_solicita
 * @property integer $user_realiza
 * @property string|\Carbon\Carbon $fecha_realiza
 * @property string $notas
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
        'notas',
        'estado_id'
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
        'notas' => 'string',
        'estado_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'paciente_id' => 'required',
        'diagnostico_id' => 'required',
        'fecha_programa' => 'nullable',
        'user_solicita' => 'required',
        'user_realiza' => 'required',
        'fecha_realiza' => 'nullable',
        'notas' => 'nullable|string',
        'estado_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
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
    public function examenTipos()
    {
        return $this->belongsToMany(\App\Models\ExamenTipo::class, 'tipos_has_examen');
    }
}
