<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class ExamenTipo
 * @package App\Models
 * @version January 13, 2022, 9:12 pm CST
 *
 * @property \App\Models\ExamenGrupo $grupo
 * @property \Illuminate\Database\Eloquent\Collection $muestras
 * @property \Illuminate\Database\Eloquent\Collection $examenes
 * @property integer $grupo_id
 * @property string $codigo
 * @property string $nombre
 */
class ExamenTipo extends Model
{
    use SoftDeletes;

    public $table = 'examen_tipos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    protected $appends = ['text'];

    public $fillable = [
        'grupo_id',
        'codigo',
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'grupo_id' => 'integer',
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'grupo_id' => 'required',
        'codigo' => 'required|string|max:255',
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function grupo()
    {
        return $this->belongsTo(\App\Models\ExamenGrupo::class, 'grupo_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function muestras()
    {
        return $this->belongsToMany(\App\Models\Muestra::class, 'tipo_has_muestra','tipo_id','muestra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function examenes()
    {
        return $this->belongsToMany(\App\Models\Examen::class, 'tipos_has_examen','examen_id','tipo_id');
    }

    public function getTextAttribute()
    {
        return $this->codigo." / ".$this->nombre." (".$this->grupo->nombre.")";
    }
}
