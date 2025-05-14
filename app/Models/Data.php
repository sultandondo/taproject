<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi secara massal (mass assignment)
    protected $fillable = [
        'user_id', 
        'jenis_orbit',
        'inklinasi',
        'userlat_up',
        'userlong_up',
        'spaceslot_up',
        'slantrangetouser_up_input',
        'userelevationangel_up_input',
        'userazimuthangle_up_input',
        'earthcentralangle_up_input',


        'userlat_down',
        'userlong_down',
        'spaceslot_down',
        'slantrangetouser_down_input',
        'userelevationangel_down_input',
        'userazimuthangle_down_input',
        'earthcentralangle_down_input',

        'ketinggian',
        'apogee',
        'perigee',
        'eccentricity',
        'argumenop',
        'raan',
        'elevasi',
        'altitude',
        'radius',
        'slant_range',
        
    //Untuk Frek
        'frekuensi_satuan',
        'frekuensi',
        'panjang_gelombang',
        'path_loss',
        'frekuensi_downlink',
        'panjang_gelombang_downlink',
        'path_loss_downlink',
    ];

    // Relasi ke tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
