<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class ExamenGrupo
 * @package App\Models
 * @version December 3, 2021, 5:33 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $examenTipos
 * @property string $nombre
 */
class ExamenGrupo extends Model
{
    use SoftDeletes;

    public $table = 'examen_grupos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function tipos()
    {
        return $this->hasMany(\App\Models\ExamenTipo::class, 'grupo_id');
    }
}
