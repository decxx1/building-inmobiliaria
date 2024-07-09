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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            //ubicación
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->string('neighborhood', 60)->nullable();
            $table->string('address', 100);
            //map
            $table->decimal('lat', 9, 6);
            $table->decimal('lng', 9, 6);
            //property
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            // $table->decimal('price_usd', 12, 2)->nullable();
            $table->boolean('is_price_dollar')->default(true);
            $table->decimal('price_property', 12, 2)->nullable();
            $table->boolean('price_hidden')->default(false);
            $table->text('description');
            //uso interno
            // $table->decimal('appraisal_usd', 12, 2)->nullable();
            // $table->decimal('appraisal_ars', 12, 2)->nullable();
            // $table->text('note')->nullable();
            //options
            $table->boolean('active')->default(true);
            //company
            $table->unsignedBigInteger('seller_id')->nullable();
            //services
            $table->decimal('price_usd_m2', 12, 2)->nullable();
            $table->decimal('price_ars_m2', 12, 2)->nullable();
            $table->integer('superficie_cubierta');
            $table->integer('superficie_total');
            //features
            $table->enum('aire_acondicionado', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('dormitorios', ['Indistinto', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10 o más']);
            $table->enum('amoblado', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('internet', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->unsignedBigInteger('antiquity_id')->nullable();
            $table->enum('piscina', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('hipoteca', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('plantas', ['Indistinto', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10 o más'])->default('Indistinto');
            $table->enum('banos', ['Indistinto', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10 o más']);
            $table->enum('barrio_privado', ['Indistinto', 'Si', 'No', 'Semi privado'])->default('Indistinto');
            $table->enum('cable', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('telefono', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('calefaccion_central', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('zona_escolar', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('ambientes', ['Indistinto', 'Monoambiente', '2', '3', '4', '5', '6 o más'])->default('Indistinto');
            $table->enum('mascotas', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('cochera', ['Indistinto', 'Garage', 'Garage/Cochera', 'Garage doble', 'Cochera pasante', 'Sin cochera'])->default('Indistinto');
            $table->enum('expensas', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('conservacion', ['Indistinto', 'Excelente', 'Muy bueno', 'Bueno', 'Regular'])->default('Indistinto');
            $table->enum('financiacion', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('permuta', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('agua', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('gas', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('luz', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            $table->enum('cloacas', ['Indistinto', 'Si', 'No'])->default('Indistinto');
            //status
            $table->timestamps();
            // Definir las relaciones
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('province_id')->references('id')->on('provinces');
            // $table->foreign('zone_id')->references('id')->on('zones');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('antiquity_id')->references('id')->on('antiquities');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
