<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class ExamenEstados
 * @package App\Models
 * @version December 3, 2021, 5:34 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $examenes
 * @property string $nombre
 */
class ExamenEstados extends Model
{
    use SoftDeletes;

    public $table = 'examen_estados';
    
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
    public function examenes()
    {
        return $this->hasMany(\App\Models\Examene::class, 'estado_id');
    }
}
