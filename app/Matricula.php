<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Matricula
 *
 * @property $id
 * @property $Estado
 * @property $evidencia_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Evidencia $evidencia
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Matricula extends Model
{
    
    // static $rules = [
	// 	'No' => 'required',
	// 	'AreadeTrabajo' => 'required',
    //     'evidencia_id' => 'required',
	// 	'evidencia_id' => 'required',
	// 	'evidencia_id' => 'required',
	// 	'evidencia_id' => 'required',
	// 	'evidencia_id' => 'required',

    // ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    // protected $fillable = ['Estado','evidencia_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function evidencia()
    {
        return $this->hasOne('App\Evidencia', 'id', 'evidencia_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
