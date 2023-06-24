<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class User
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $role
 * @property $remember_token
 * @property $created_at
 * @property $updated_at
 *
 * @property Evidencia[] $evidencias
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Model
{
    
    static $rules = [
		'name' => 'required||regex:/^[a-zA-Z\s]+$/',
		'email' => 'required||regex:/^[a-zA-Z\s]+$/',

    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    // protected $fillable = ['name','email','role'];


    protected $fillable = [
      'name',
      'email',
      'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
      'password',
      'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  public function setPasswordAttribute($password){
      $this->attributes['password'] = bcrypt($password);
  }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evidencias()
    {
        return $this->hasMany('App\Evidencia', 'user_id', 'id');
    }
    

}
