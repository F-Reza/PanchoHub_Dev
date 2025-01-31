<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctors extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'dr_name',
        'category',
        'education_qualify',
        'current_servise',
        'spacialist',
        'chambers',
        'image',
    ];
    protected $casts = [
        'chambers' => 'array',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
