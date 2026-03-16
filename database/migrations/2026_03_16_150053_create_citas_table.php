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
    Schema::create('citas', function (Blueprint $table) {

        $table->id();

        $table->string('numero_fuente')->nullable();

        $table->date('fecha');

        $table->time('hora_inicio');
        $table->time('hora_fin');

        $table->text('mensaje')->nullable();

        $table->enum('estado',[
            'programada',
            'modificada',
            'cancelada',
            'asistida',
            'no_asistida'
        ])->default('programada');

        $table->foreignId('patient_id')
            ->constrained('pacientes');

        $table->foreignId('created_by')
            ->constrained('users');

        $table->foreignId('updated_by')
            ->nullable()
            ->constrained('users');

        $table->foreignId('cancelled_by')
            ->nullable()
            ->constrained('users');

        $table->text('cancel_reason')->nullable();

        $table->softDeletes();
        $table->timestamps();

    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
