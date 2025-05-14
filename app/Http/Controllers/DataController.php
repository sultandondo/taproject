<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    // Menampilkan daftar data
    public function index()
    {
        $data = Data::with('user')->get();
        return view('data.index', compact('data'));
    }

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return view('data.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_orbit' => 'nullable|string',
            'inklinasi' => 'nullable|numeric',
            'userlat_up' => 'nullable|numeric',
            'userlong_up' => 'nullable|numeric',
            'spaceslot_up' => 'nullable|numeric',
            'slantrangetouser_up_input' => 'nullable|numeric',
            'userelevationangel_up_input' => 'nullable|numeric',
            'userazimuthangle_up_input' => 'nullable|numeric',
            'earthcentralangle_up_input' => 'nullable|numeric',


            'userlat_down' => 'nullable|numeric',
            'userlong_down' => 'nullable|numeric',
            'spaceslot_down' => 'nullable|numeric',
            'slantrangetouser_down_input' => 'nullable|numeric',
            'userelevationangel_down_input' => 'nullable|numeric',
            'userazimuthangle_down_input' => 'nullable|numeric',
            'earthcentralangle_down_input' => 'nullable|numeric',

            'ketinggian' => 'nullable|numeric',
            'apogee' => 'nullable|numeric',
            'perigee' => 'nullable|numeric',
            'eccentricity' => 'nullable|numeric',
            'argumenop' => 'nullable|numeric',
            'raan' => 'nullable|numeric',
            'elevasi' => 'nullable|numeric',
            'altitude' => 'nullable|numeric',
            'radius' => 'nullable|numeric',
            'slant_range' => 'nullable|numeric',
    
            

            // validasi kolom lainnya sesuai kebutuhan
        ]);

        // Data::create($request->all());
        
        $data = Data::create([
            'user_id' => $request->user_id,
            'jenis_orbit' => $request->input('jenis_orbit'),
            'inklinasi' => $request->input('inklinasi'),
            'userlat_up' => $request->input('userlat_up'),
            'userlong_up' => $request->input('userlong_up'),
            'spaceslot_up' => $request->input('spaceslot_up'),
            'slantrangetouser_up_input' => $request->input('slantrangetouser_up_input'),
            'userelevationangel_up_input' => $request->input('userelevationangel_up_input'),
            'userazimuthangle_up_input' => $request->input('userazimuthangle_up_input'),
            'earthcentralangle_up_input' => $request->input('earthcentralangle_up_input'),

            'userlat_down' => $request->input('userlat_down'),
            'userlong_down' => $request->input('userlong_down'),
            'spaceslot_down' => $request->input('spaceslot_down'),
            'slantrangetouser_down_input' => $request->input('slantrangetouser_down_input'),
            'userelevationangel_down_input' => $request->input('userelevationangel_down_input'),
            'userazimuthangle_down_input' => $request->input('userazimuthangle_down_input'),
            'earthcentralangle_down_input' => $request->input('earthcentralangle_down_input'),
            
            'ketinggian' => $request->input('ketinggian'),
            'apogee' => $request->input('apogee'),
            'perigee' => $request->input('perigee'),
            'eccentricity' => $request->input('eccentricity'),
            'argumenop' => $request->input('argumenop'),
            'raan' => $request->input('raan'),
            'elevasi' => $request->input('elevasi'),
            'altitude' => $request->input('altitude'),
            'radius' => $request->input('radius'),
            'slant_range' => $request->input('slant_range'),
            
            // Field lainnya
        ]);

        return redirect()->route('frek.show')->with('success', 'Data berhasil ditambahkan');
    }

        public function store_frek(Request $request)
    {
    
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'frekuensi_satuan'=> 'nullable|string',
            'frekuensi'=> 'nullable|numeric',
            'panjang_gelombang'=> 'nullable|numeric',
            'path_loss'=> 'nullable|numeric',
            'frekuensi_downlink'=> 'nullable|numeric',
            'panjang_gelombang_downlink'=> 'nullable|numeric',
            'path_loss_downlink'=> 'nullable|numeric',
            // validasi kolom lainnya sesuai kebutuhan
        ]);

        // Data::create($request->all());
        
        $data = Data::create([
            'user_id' => $request->user_id,
            'frekuensi_satuan' => $request->input('frekuensi_satuan'),
            'frekuensi' => $request->input('frekuensi'),
            'panjang_gelombang' => $request->input('panjang_gelombang'),
            'path_loss' => $request->input('path_loss'),
            'frekuensi_downlink' => $request->input('frekuensi_downlink'),
            'panjang_gelombang_downlink' => $request->input('panjang_gelombang_downlink'),
            'path_loss_downlink' => $request->input('path_loss_downlink'),

            // Field lainnya
        ]);

        return redirect()->route('transmitter.show')->with('success', 'Data berhasil ditambahkan');
    }

      public function store_transmitter(Request $request)
    {
    
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'frekuensi_satuan'=> 'nullable|string',
            'frekuensi'=> 'nullable|numeric',
            'panjang_gelombang'=> 'nullable|numeric',
            'path_loss'=> 'nullable|numeric',
            'frekuensi_downlink'=> 'nullable|numeric',
            'panjang_gelombang_downlink'=> 'nullable|numeric',
            'path_loss_downlink'=> 'nullable|numeric',
            // validasi kolom lainnya sesuai kebutuhan
        ]);

        // Data::create($request->all());
        
        $data = Data::create([
            'user_id' => $request->user_id,
            'frekuensi_satuan' => $request->input('frekuensi_satuan'),
            'frekuensi' => $request->input('frekuensi'),
            'panjang_gelombang' => $request->input('panjang_gelombang'),
            'path_loss' => $request->input('path_loss'),
            'frekuensi_downlink' => $request->input('frekuensi_downlink'),
            'panjang_gelombang_downlink' => $request->input('panjang_gelombang_downlink'),
            'path_loss_downlink' => $request->input('path_loss_downlink'),

            // Field lainnya
        ]);

        return redirect()->route('transmitter.show')->with('success', 'Data berhasil ditambahkan');
    }
    // Menampilkan form untuk mengedit data
    public function edit($id)
    {
        $data = Data::findOrFail($id);
        return view('data.edit', compact('data'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jenis_orbit' => 'required|string',
            'sudut_inklinasi' => 'required|numeric',
            // validasi kolom lainnya sesuai kebutuhan
        ]);

        $data = Data::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('data.index')->with('success', 'Data berhasil diperbarui');
    }

    // Menghapus data
    public function destroy($id)
    {
        $data = Data::findOrFail($id);
        $data->delete();

        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus');
    }
}
