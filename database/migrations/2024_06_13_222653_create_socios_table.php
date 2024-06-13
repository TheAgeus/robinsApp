<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->string("nombre");
            $table->binary("comprobanteDomicilioPdf");
            $table->binary("actaNacimientoPdf");
            $table->binary("inePdf");
            $table->binary("actaMatrimonioPdf");
            $table->binary("constanciaSituacionFiscalPdf");

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socios');
    }
};
