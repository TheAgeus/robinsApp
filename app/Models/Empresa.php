<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombreEmpresa',
        'regimenEmpresa',
        'rfcEmpresa',
        'domicilioFiscalEmpresa',
        'nombreRepresentanteEmpresa'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function socios()
    {
        return $this->hasMany(Socio::class);
    }
    
    public function numeroSocios()
    {
        return $this->socios()->count();
    }
}
