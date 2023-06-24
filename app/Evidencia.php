<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * Class Evidencia
 *
 * @property $id
 * @property $Nombre
 * @property $Apellido
 * @property $AnnoGraduado
 * @property $Direccion
 * @property $AreaTrabajo
 * @property $FotocopiaTitulo
 * @property $ActaSolicitud
 * @property $EdicionMaestria
 * @property $created_at
 * @property $updated_at
 *
 * @property Matricula[] $matriculas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Evidencia extends Model
{
    
    static $rules = [
		'Nombre' => 'required||regex:/^[a-zA-Z\s]+$/',
		'Apellido' => 'required||regex:/^[a-zA-Z\s]+$/',
		'AnnoGraduado' => 'required|numeric',
		'Direccion' => 'required||regex:/^[a-zA-Z\s]+$/',
		'AreaTrabajo' => 'required||regex:/^[a-zA-Z\s]+$/',
		// 'FotocopiaTitulo' => 'required',
		// 'ActaSolicitud' => 'required',
		'EdicionMaestria' => 'required|regex:/^\d+(?:-\d+)*$/',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre', 'Apellido', 'AnnoGraduado', 'Direccion', 'AreaTrabajo', 'EdicionMaestria', 'FotocopiaTitulo', 'ActaSolicitud', 'user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matriculas()
    {
        return $this->hasMany('App\Matricula', 'evidencia_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
