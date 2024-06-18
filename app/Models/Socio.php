<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable= [
        'empresa_id',
        'nombre',
        'comprobanteDomicilioPdf',
        'actaNacimientoPdf',
        'inePdf',
        'actaMatrimonioPdf',
        'constanciaSituacionFiscalPdf'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

}
