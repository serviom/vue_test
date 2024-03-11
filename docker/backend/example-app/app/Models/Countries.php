<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{

    protected $table = 'user_countries';

    protected $fillable = [
        'name',
        'code',
        'flag',
        'prefix'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
