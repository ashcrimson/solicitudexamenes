<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Muestra
 * @package App\Models
 * @version January 13, 2022, 9:13 pm CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $examenTipos
 * @property integer $codigo
 * @property string $nombre
 */
class Muestra extends Model
{
    use SoftDeletes;

    public $table = 'muestras';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $appends = ['text'];


    public $fillable = [
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
        'codigo' => 'integer',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required|integer',
        'nombre' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function examenTipos()
    {
        return $this->belongsToMany(\App\Models\ExamenTipo::class, 'tipo_has_muestra');
    }

    public function getTextAttribute()
    {
        return $this->codigo." - ".$this->nombre;
    }
}
