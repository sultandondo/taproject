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
        Schema::create('data', function (Blueprint $table) {
        //database GEO
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Menambahkan foreign key
            $table->string('jenis_orbit')->nullable();
            $table->double('inklinasi')->nullable(); 
            $table->double('userlat_up')->nullable();
            $table->double('userlong_up')->nullable();
            $table->double('spaceslot_up')->nullable();
            $table->double('slantrangetouser_up_input')->nullable();
            $table->double('userelevationangel_up_input')->nullable();
            $table->double('userazimuthangle_up_input')->nullable();
            $table->double('earthcentralangle_up_input')->nullable();

            $table->double('userlat_down')->nullable();
            $table->double('userlong_down')->nullable();
            $table->double('spaceslot_down')->nullable();
            $table->double('slantrangetouser_down_input')->nullable();
            $table->double('userelevationangel_down_input')->nullable();
            $table->double('userazimuthangle_down_input')->nullable();
            $table->double('earthcentralangle_down_input')->nullable();

            //Database LEO & MEO
            $table->double('ketinggian')->nullable();
            $table->double('apogee')->nullable();
            $table->double('perigee')->nullable();
            $table->double('eccentricity')->nullable();
            $table->double('argumenop')->nullable();
            $table->double('raan')->nullable();
            $table->double('elevasi')->nullable();
            $table->double('altitude')->nullable();
            $table->double('radius')->nullable();
            $table->double('slant_range')->nullable();

            // Database Frekuensi
            $table->string('frekuensi_satuan')->nullable();
            $table->double('frekuensi')->nullable();
            $table->double('panjang_gelombang')->nullable();
            $table->double('path_loss')->nullable();
            $table->double('frekuensi_downlink')->nullable();
            $table->double('panjang_gelombang_downlink')->nullable();
            $table->double('path_loss_downlink')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
