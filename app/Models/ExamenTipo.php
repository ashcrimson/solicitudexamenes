<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class ExamenTipo
 * @package App\Models
 * @version December 3, 2021, 5:34 pm CST
 *
 * @property \App\Models\ExamenGrupo $grupo
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
        'codigo' => 'required|string|max:45',
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
    public function examenes()
    {
        return $this->belongsToMany(\App\Models\Examene::class, 'tipos_has_examen');
    }
}