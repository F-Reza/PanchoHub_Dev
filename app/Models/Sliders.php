<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}
