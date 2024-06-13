<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
    public function socios()
    {
        return $this->hasMany(Socio::class);
    }
}
