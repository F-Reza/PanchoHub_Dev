<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurents extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
