<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Class Diagnostico
 * @package App\Models
 * @version October 15, 2021, 10:41 am CST
 *
 * @property \Illuminate\Database\Eloquent\Collection $examenes
 * @property string $codigo
 * @property string $nombre
 */
class Diagnostico extends Model
{
    use SoftDeletes;

    public $table = 'diagnosticos';

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
        'codigo' => 'string',
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'codigo' => 'required|string|max:255',
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
        return $this->hasMany(\App\Models\Examene::class, 'diagnostico_id');
    }

    public function getTextAttribute(){
        return $this->codigo.' / '.$this->nombre;
    }
}
