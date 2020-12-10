<?php

namespace App;

use App\Scopes\InformativesTeamScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informative extends Model
{
    use HasFactory;

    protected $table = 'informatives';

    protected static function booted()
    {
        static::addGlobalScope(new InformativesTeamScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
