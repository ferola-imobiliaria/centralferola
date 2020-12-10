<?php

namespace App;

use App\Scopes\UserEditScope;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_short',
        'email',
        'username',
        'cpf',
        'creci',
        'phone',
        'profile',
        'team_id',
        'password',
        'password_change',
        'photo',
        'last_login_at'
    ];

    //Definindo valor padrão para os atributos
    protected $attributes = [
        'password_change' => 1,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function booted()
    {
        static::creating(function (Model $model) {
            $model->uuid = Str::uuid();
        });
    }

    public function productions()
    {
        return $this->hasMany(Production::class, 'user_id', 'id');
    }

    public function pointsTableInfo()
    {
        return $this->hasMany(PointsTableInfo::class, 'user_id', 'id');
    }

    public function informatives()
    {
        return $this->hasMany(Informative::class, 'user_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function commissions()
    {
        return $this->hasMany(CommissionsControl::class, 'user_id', 'id');
    }

    public function getLastLoginAtAttribute($value)
    {
        if (!is_null($value)) {
            return Carbon::parse($value)->format('d/m/Y \à\s H\hi');
        }

        return "Nunca acessou";
    }
}
