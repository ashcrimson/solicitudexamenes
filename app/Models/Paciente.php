<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Paciente
 * @package App\Models
 * @version December 3, 2021, 5:34 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $examenes
 * @property string $run
 * @property string $dv_run
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $nombre_completo
 * @property string $fecha_nac
 * @property string $sexo
 * @property string $sigla_grado
 * @property string $unid_rep_dot
 * @property integer $cond_alta_dot
 * @property string $direccion
 * @property string $familiar_responsable
 * @property string $telefono
 * @property string $telefono2
 * @property integer $documento_tipo_id
 */
class Paciente extends Model
{
    use SoftDeletes;

    public $table = 'pacientes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'run',
        'dv_run',
        'apellido_paterno',
        'apellido_materno',
        'primer_nombre',
        'segundo_nombre',
        'fecha_nac',
        'sexo',
        'sigla_grado',
        'unid_rep_dot',
        'cond_alta_dot',
        'direccion',
        'familiar_responsable',
        'telefono',
        'telefono2',
        'codserv',
        'descserv',
        'codubic',
        'nropiso',
        'nropieza',
        'tipocama',
        'numero_documento',
        'documento_tipo_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'run' => 'string',
        'dv_run' => 'string',
        'apellido_paterno' => 'string',
        'apellido_materno' => 'string',
        'primer_nombre' => 'string',
        'segundo_nombre' => 'string',
        'fecha_nac' => 'datetime:Y-m-d',
        'sexo' => 'string',
        'sigla_grado' => 'string',
        'unid_rep_dot' => 'string',
        'cond_alta_dot' => 'integer',
        'direccion' => 'string',
        'familiar_responsable' => 'string',
        'telefono' => 'string',
        'telefono2' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'run' => 'required|string|max:255',
        'dv_run' => 'required|string|max:255',
        'apellido_paterno' => 'required|string|max:255',
        'apellido_materno' => 'required|string|max:255',
        'primer_nombre' => 'required|string|max:255',
        'segundo_nombre' => 'required|string|max:255',
        'fecha_nac' => 'datetime:Y-m-d',
        'sexo' => 'required|string|max:255',
        'sigla_grado' => 'nullable|string|max:255',
        'unid_rep_dot' => 'nullable|string|max:255',
        'cond_alta_dot' => 'nullable|integer',
        'direccion' => 'nullable|string|max:255',
        'familiar_responsable' => 'nullable|string|max:255',
        'telefono' => 'nullable|string|max:255',
        'telefono2' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function examenes()
    {
        return $this->hasMany(\App\Models\Examen::class, 'paciente_id');
    }

    public function getNombreCompletoAttribute()
    {
        return $this->primer_nombre.' '.$this->segundo_nombre.' '.$this->apellido_paterno." ".$this->apellido_materno;
    }

    public function getRutCompletoAttribute()
    {
        return $this->run.'-'.$this->dv_run;
    }

    public function getEdadAttribute()
    {
        $fecha = Carbon::parse(fechaEn($this->fecha_nac));

        return $fecha->diffInYears(Carbon::now());
    }
}
