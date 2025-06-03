<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    // Menampilkan daftar data
    public function show()
{
    $data = Data::with('user')->get();
    //$title = 'History Page'; // Set the title or dynamic value here
    return view('history', compact('data'));
}

    public function showCalcForm($id)
{
    // dd($id);
    if ($id == 0) {
        return view('calc', ['title'=> 'Lets Calculate Orbit!', 'dataId' => $id,]);
    } else {
        $data = Data::findOrFail($id);
        
        return view('calc', [
            'title'=> 'Lets Calculate Frekuensi!',
            'data' => $data,
            'dataId' => $id,
            'userId' => $data->user_id
        ]);
    }
}
    public function showFrekuensiForm($id)
{
    $data = Data::findOrFail($id);
    
    return view('frek', [
        'title'=> 'Lets Calculate Frekuensi!',
        'data' => $data,
        'dataId' => $id,
        'userId' => $data->user_id
    ]);
}

// Method untuk menampilkan form transmitter dengan data yang sudah ada
public function showTransmitterForm($id)
{
    $data = Data::findOrFail($id);
    return view('transmitter', [
        'title'=> 'Lets Calculate Frekuensi!',
        'data' => $data,
        'dataId' => $id,
        'userId' => $data->user_id
    ]);
}

// Method untuk menampilkan form receiver dengan data yang sudah ada
public function showReceiverForm($id)
{
    $data = Data::findOrFail($id);
    return view('receiver', [
        'title'=> 'Lets Calculate Frekuensi!',
        'data' => $data,
        'dataId' => $id,
        'userId' => $data->user_id
    ]);
}

public function showAzimuthForm($id)
{
    $data = Data::findOrFail($id);
    return view('calcazimuth', [
        'title'=> 'Lets Calculate Frekuensi!',
        'data' => $data,
        'dataId' => $id,
        'userId' => $data->user_id
    ]);
}

    public function showAntennagain($id)
{
    $data = Data::findOrFail($id);
    
    return view('antennagain', [
        'title'=> 'Lets Calculate Antenagain!',
        'data' => $data,
        'dataId' => $id,
        'userId' => $data->user_id
    ]);
}

public function showAntennaPointingLoss($id)
{
    $data = Data::findOrFail($id);
    
    return view('annpoinloss', [
        'title'=> 'Lets Calculate Antenna Pointing Loss!',
        'data' => $data,
        'dataId' => $id,
        'userId' => $data->user_id
    ]);
}

public function showAnnpolaloss($id)
{
    $data = Data::findOrFail($id);
    
    return view('annpolaloss', [
        'title'=> 'Lets Calculate Antenna Polararization Loss !',
        'data' => $data,
        'dataId' => $id,
        'userId' => $data->user_id
    ]);
}

public function showAtmosIonos($id)
{
    $data = Data::findOrFail($id);
    
    return view('atnmosionos', [
        'title'=> 'Lets Calculate Antenagain!',
        'data' => $data,
        'dataId' => $id,
        'userId' => $data->user_id
    ]);
}

    // Menampilkan form untuk membuat data baru
    public function create()
    {
        return view('data.create');
    }

    // Menyimpan data Orbit
    public function store(Request $request, $id)
    {
        
        // dd($request->all());
        $validated = $request->validate([
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
        if ($id == 0) {
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

            return redirect()->route('frek.show', ['id' => $data->id])->with('success', 'Data berhasil ditambahkan');
        } else {
            $data = Data::findOrFail($id);
            $data->update(array_merge($data->toArray(), $validated));
            return redirect()->route('frek.show', ['id' => $data->id])->with('success', 'Data berhasil ditambahkan');
        }
    }

    //Menyimpan data Frekuensi
        public function store_frek(Request $request, $id)
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
        $data = Data::findOrFail($id);
        $data->update([
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

        return redirect()->route('transmitter.show', ['id' => $data->id])->with('success', 'Data berhasil ditambahkan');
    }

    
    // Menyimpan data Transmitter
    public function store_transmitter(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'watt_up' => 'nullable|numeric',
            'dbw_up' => 'nullable|numeric',
            'dbm_up' => 'nullable|numeric',
            'alength_up' => 'nullable|numeric',
            'blength_up' => 'nullable|numeric',
            'clength_up' => 'nullable|numeric',
            'totlength_up' => 'nullable|numeric',
            'cabletype_up' => 'nullable|string',
            'guideloss_up' => 'nullable|numeric',
            'totalloss_up' => 'nullable|numeric',
            'connect_up' => 'nullable|numeric',
            'totconnect_up' => 'nullable|numeric',
            'filter_up' => 'nullable|numeric',
            'device_up' => 'nullable|string',
            'devicee_up' => 'nullable|numeric',
            'atn_up' => 'nullable|numeric',
            'totlinelosses_up' => 'nullable|numeric',
            'totpowerdeliv_up' => 'nullable|numeric',
            
    
            'watt_down' => 'nullable|numeric',
            'dbw_down' => 'nullable|numeric',
            'dbm_down' => 'nullable|numeric',
            'alength_down' => 'nullable|numeric',
            'blength_down' => 'nullable|numeric',
            'clength_down' => 'nullable|numeric',
            'totlength_down' => 'nullable|numeric',
            'cabletype_down' => 'nullable|string',
            'guideloss_down' => 'nullable|numeric',
            'totalloss_down' => 'nullable|numeric',
            'connect_down' => 'nullable|numeric',
            'totconnect_down' => 'nullable|numeric',
            'filter_down' => 'nullable|numeric',
            'device_down' => 'nullable|string',
            'devicee_down' => 'nullable|numeric',
            'atn_down' => 'nullable|numeric',
            'totlinelosses_down' => 'nullable|numeric',
            'totrfpowerdeliv_down' => 'nullable|numeric',

            // validasi kolom lainnya sesuai kebutuhan
        ]);

        // Data::create($request->all());
        $data = Data::findOrFail($id);
        $data->update([
            'user_id' => $request->user_id,
            'watt_up' => $request->input('watt_up'),
            'dbw_up' => $request->input('dbw_up'),
            'dbm_up' => $request->input('dbm_up'),
            'alength_up' => $request->input('alength_up'),
            'blength_up' => $request->input('blength_up'),
            'clength_up' => $request->input('clength_up'),
            'totlength_up' => $request->input('totlength_up'),
            'cabletype_up' => $request->input('cabletype_up'),
            'guideloss_up' => $request->input('guideloss_up'),
            'totalloss_up' => $request->input('totalloss_up'),
            'connect_up' => $request->input('connect_up'),
            'totconnect_up' => $request->input('totconnect_up'),
            'filter_up' => $request->input('filter_up'),
            'device_up' => $request->input('device_up'),
            'devicee_up' => $request->input('devicee_up'),
            'atn_up' => $request->input('atn_up'),
            'totlinelosses_up' => $request->input('totlinelosses_up'),
            'totpowerdeliv_up' => $request->input('totpowerdeliv_up'),

            'watt_down' => $request->input('watt_down'),
            'dbw_down' => $request->input('dbw_down'),
            'dbm_down' => $request->input('dbm_down'),
            'alength_down' => $request->input('alength_down'),
            'blength_down' => $request->input('blength_down'),
            'clength_down' => $request->input('clength_down'),
            'totlength_down' => $request->input('totlength_down'),
            'cabletype_down' => $request->input('cabletype_down'),
            'guideloss_down' => $request->input('guideloss_down'),
            'totalloss_down' => $request->input('totalloss_down'),
            'connect_down' => $request->input('connect_down'),
            'totconnect_down' => $request->input('totconnect_down'),
            'filter_down' => $request->input('filter_down'),
            'device_down' => $request->input('device_down'),
            'devicee_down' => $request->input('devicee_down'),
            'atn_down' => $request->input('atn_down'),
            'totlinelosses_down' => $request->input('totlinelosses_down'),
            'totrfpowerdeliv_down' => $request->input('totrfpowerdeliv_down'),

            // Field lainnya
        ]);

        return redirect()->route('receiver.show', ['id' => $data->id])->with('success', 'Data berhasil ditambahkan');
    }

    //Menyimpan data Receiver
    public function store_receiver(Request $request, $id)
    {
    
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'cabletype_uprec'=> 'nullable|string',
            'typecable'=> 'nullable|numeric',
            'alength_uprec'=> 'nullable|numeric',
            'blength_uprec'=> 'nullable|numeric',
            'clength_uprec'=> 'nullable|numeric',
            'la_uprec'=> 'nullable|numeric',
            'lb_uprec'=> 'nullable|numeric',
            'lb_uprec'=> 'nullable|numeric',
            'lc_uprec'=> 'nullable|numeric',
            'lbpf_uprec'=> 'nullable|numeric',
            'lother_uprec'=> 'nullable|numeric',
            'connect_uprec'=> 'nullable|numeric',
            'totconnect_uprec'=> 'nullable|numeric',
            'antenna to lna_uprec'=> 'nullable|numeric',
            'tranlincoe_uprec'=> 'nullable|numeric',
            'antemper_uprec'=> 'nullable|numeric',
            'spactemp_uprec'=> 'nullable|numeric',
            'tlna_uprec'=> 'nullable|numeric',
            'lnagain_uprec'=> 'nullable|numeric',
            'glna_uprec'=> 'nullable|numeric',
            '2ndstagetemp_uprec'=> 'nullable|numeric',
            'ts_uprec'=> 'nullable|numeric',

            'cabletype_downrec'=> 'nullable|string',
            'typecable_downrec'=> 'nullable|numeric',
            'alength_downrec'=> 'nullable|numeric',
            'blength_downrec'=> 'nullable|numeric',
            'clength_downrec'=> 'nullable|numeric',
            'la_downrec'=> 'nullable|numeric',
            'lb_downrec'=> 'nullable|numeric',
            'lc_downrec'=> 'nullable|numeric',
            'lbpf_downrec'=> 'nullable|numeric',
            'lother_downrec'=> 'nullable|numeric',
            'connect_downrec'=> 'nullable|numeric',
            'totconnect_downrec'=> 'nullable|numeric',
            'antenna_to_lna_downrec'=> 'nullable|numeric',
            'tranlincoe_downrec'=> 'nullable|numeric',
            'antemper_downrec'=> 'nullable|numeric',
            'spactemp_downrec'=> 'nullable|numeric',
            'tlna_downrec'=> 'nullable|numeric',
            'lnagain_downrec'=> 'nullable|numeric',
            'glna_downrec'=> 'nullable|numeric',
            'dtype_downrec'=> 'nullable|string',
            'dloss_length_downrec'=> 'nullable|numeric',
            'dloss_per_meter_downrec'=> 'nullable|numeric',
            'dloss_result_downrec'=> 'nullable|numeric',
            'tcomrcvr_downrec'=> 'nullable|numeric',
            'ts_downrec'=> 'nullable|numeric',



            // validasi kolom lainnya sesuai kebutuhan
        ]);

        // Data::create($request->all());
        
        $data = Data::findOrFail($id);
        $data->update([
            'user_id' => $request->user_id,
            'cabletype_uprec' => $request->input('cabletype_uprec'),
            'typecable' => $request->input('typecable'),
            'alength_uprec' => $request->input('alength_uprec'),
            'blength_uprec' => $request->input('blength_uprec'),
            'clength_uprec' => $request->input('clength_uprec'),
            'la_uprec' => $request->input('la_uprec'),
            'lb_uprec' => $request->input('lb_uprec'),
            'lc_uprec' => $request->input('lc_uprec'),
            'lbpf_uprec' => $request->input('lbpf_uprec'),
            'lother_uprec' => $request->input('lother_uprec'),
            'connect_uprec' => $request->input('connect_uprec'),
            'totconnect_uprec' => $request->input('totconnect_uprec'),
            'antenna to lna_uprec' => $request->input('antenna to lna_uprec'),
            'tranlincoe_uprec' => $request->input('tranlincoe_uprec'),
            'antemper_uprec' => $request->input('antemper_uprec'),
            'spactemp_uprec' => $request->input('spactemp_uprec'),
            'tlna_uprec' => $request->input('tlna_uprec'),
            'lnagain_uprec' => $request->input('lnagain_uprec'),
            'glna_uprec' => $request->input('glna_uprec'),
            '2ndstagetemp_uprec' => $request->input('2ndstagetemp_uprec'),
            'ts_uprec' => $request->input('ts_uprec'),

            'cabletype_downrec' => $request->input('cabletype_downrec'),
            'typecable_downrec' => $request->input('typecable_downrec'),
            'alength_downrec' => $request->input('alength_downrec'),
            'blength_downrec' => $request->input('blength_downrec'),
            'clength_downrec' => $request->input('clength_downrec'),
            'la_downrec' => $request->input('la_downrec'),
            'lb_downrec' => $request->input('lb_downrec'),
            'lc_downrec' => $request->input('lc_downrec'),
            'lbpf_downrec' => $request->input('lbpf_downrec'),
            'lother_downrec' => $request->input('lother_downrec'),
            'connect_downrec' => $request->input('connect_downrec'),
            'totconnect_downrec' => $request->input('totconnect_downrec'),
            'antenna_to_lna_downrec' => $request->input('antenna_to_lna_downrec'),
            'tranlincoe_downrec' => $request->input('tranlincoe_downrec'),
            'antemper_downrec' => $request->input('antemper_downrec'),
            'spactemp_downrec' => $request->input('spactemp_downrec'),
            'tlna_downrec' => $request->input('tlna_downrec'),
            'lnagain_downrec' => $request->input('lnagain_downrec'),
            'glna_uprec' => $request->input('glna_uprec'),
            'dtype_downrec' => $request->input('dtype_downrec'),
            'dloss_length_downrec' => $request->input('dloss_length_downrec'),
            'dloss_per_meter_downrec' => $request->input('dloss_per_meter_downrec'),
            'dloss_result_downrec' => $request->input('dloss_result_downrec'),
            'tcomrcvr_downrec' => $request->input('tcomrcvr_downrec'),
            'ts_downrec' => $request->input('ts_downrec'),


            // Field lainnya
        ]);

        return redirect()->route('antennagain.show', ['id' => $data->id])->with('success', 'Data berhasil ditambahkan');
    }

     //Menyimpan data Frekuensi
        public function store_calcazimuth(Request $request)
    {
    
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'latitude_up'=> 'nullable|numeric',
            'innhem_up'=> 'nullable|numeric',
            'innhem2_up'=> 'nullable|numeric',
            'longitude_up'=> 'nullable|numeric',
            'eastofsat_up'=> 'nullable|numeric',
            'eastofsat2_up'=> 'nullable|numeric',
            'sat_in_quad_up'=> 'nullable|numeric',
            'quad_result_up'=> 'nullable|numeric',
            'quad_angle_range_up'=> 'nullable|numeric',
            'sat_in_quad_value_up'=> 'nullable|numeric',
            'quad_result_value_up'=> 'nullable|numeric',
            'quad_angle_range_value_up'=> 'nullable|numeric',
            'sat_in_quad_value2_up'=> 'nullable|numeric',
            'quad_result_value2_up'=> 'nullable|numeric',
            'quad_angle_range_value2_up'=> 'nullable|numeric',
            'sat_in_quad_value3_up'=> 'nullable|numeric',
            'quad_result_value3_up'=> 'nullable|numeric',
            'quad_angle_range_value3_up'=> 'nullable|numeric',
            'azimuthcalc_up'=> 'nullable|numeric',
            'azimuthresult_up'=> 'nullable|numeric',

            'latitude_down'=> 'nullable|numeric',
            'innhem_down'=> 'nullable|numeric',
            'innhem2_down'=> 'nullable|numeric',
            'longitude_down'=> 'nullable|numeric',
            'eastofsat_down'=> 'nullable|numeric',
            'eastofsat2_down'=> 'nullable|numeric',
            'sat_in_quad_down'=> 'nullable|numeric',
            'quad_result_down'=> 'nullable|numeric',
            'quad_angle_range_down'=> 'nullable|numeric',
            'sat_in_quad_value_down'=> 'nullable|numeric',
            'quad_result_value_down'=> 'nullable|numeric',
            'quad_angle_range_value_down'=> 'nullable|numeric',
            'sat_in_quad_value2_down'=> 'nullable|numeric',
            'quad_result_value2_down'=> 'nullable|numeric',
            'quad_angle_range_value2_down'=> 'nullable|numeric',
            'sat_in_quad_value3_down'=> 'nullable|numeric',
            'quad_result_value3_down'=> 'nullable|numeric',
            'quad_angle_range_value3_down'=> 'nullable|numeric',
            'azimuthcalc_down'=> 'nullable|numeric',
            'azimuthresult_down'=> 'nullable|numeric',
            // validasi kolom lainnya sesuai kebutuhan
        ]);

        // Data::create($request->all());
        
        $data = Data::create([
            'user_id' => $request->user_id,
            'latitude_up' => $request->input('latitude_up'),
            'innhem_up' => $request->input('innhem_up'),
            'innhem2_up' => $request->input('innhem2_up'),
            'longitude_up' => $request->input('longitude_up'),
            'eastofsat_up' => $request->input('eastofsat_up'),
            'eastofsat2_up' => $request->input('eastofsat2_up'),
            'sat_in_quad_up' => $request->input('sat_in_quad_up'),
            'quad_result_up' => $request->input('quad_result_up'),
            'quad_angle_range_up' => $request->input('quad_angle_range_up'),
            'sat_in_quad_value_up' => $request->input('sat_in_quad_value_up'),
            'quad_result_value_up' => $request->input('quad_result_value_up'),
            'quad_angle_range_value_up' => $request->input('quad_angle_range_value_up'),
            'sat_in_quad_value2_up' => $request->input('sat_in_quad_value2_up'),
            'quad_result_value2_up' => $request->input('quad_result_value2_up'),
            'quad_angle_range_value2_up' => $request->input('quad_angle_range_value2_up'),
            'sat_in_quad_value3_up' => $request->input('sat_in_quad_value3_up'),
            'quad_result_value3_up' => $request->input('quad_result_value3_up'),
            'quad_angle_range_value3_up' => $request->input('quad_angle_range_value3_up'),
            'azimuthcalc_up' => $request->input('azimuthcalc_up'),
            'azimuthresult_up' => $request->input('azimuthresult_up'),

            'latitude_down' => $request->input('latitude_down'),
            'innhem_down' => $request->input('innhem_down'),
            'innhem2_down' => $request->input('innhem2_down'),
            'longitude_down' => $request->input('longitude_down'),
            'eastofsat_down' => $request->input('eastofsat_down'),
            'eastofsat2_down' => $request->input('eastofsat2_down'),
            'sat_in_quad_down' => $request->input('sat_in_quad_down'),
            'quad_result_down' => $request->input('quad_result_down'),
            'quad_angle_range_down' => $request->input('quad_angle_range_down'),
            'sat_in_quad_value_down' => $request->input('sat_in_quad_value_down'),
            'quad_result_value_down' => $request->input('quad_result_value_down'),
            'quad_angle_range_value_down' => $request->input('quad_angle_range_value_down'),
            'sat_in_quad_value2_down' => $request->input('sat_in_quad_value2_down'),
            'quad_result_value2_down' => $request->input('quad_result_value2_down'),
            'quad_angle_range_value2_down' => $request->input('quad_angle_range_value2_down'),
            'sat_in_quad_value3_down' => $request->input('sat_in_quad_value3_down'),
            'quad_result_value3_down' => $request->input('quad_result_value3_down'),
            'quad_angle_range_value3_down' => $request->input('quad_angle_range_value3_down'),
            'azimuthcalc_down' => $request->input('azimuthcalc_down'),
            'azimuthresult_down' => $request->input('azimuthresult_down'),
            // Field lainnya
        ]);

        return redirect()->route('calcazimuth.show')->with('success', 'Data berhasil ditambahkan');
    }

    //Menyimpan data Antenna Polarization Loss
        public function store_annpolaloss(Request $request)
    {
    
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'axtxantenna_up'=> 'nullable|numeric',
            'axialratio1_up'=> 'nullable|numeric',
            'axrxantenna_up'=> 'nullable|numeric',
            'axialratio2_up'=> 'nullable|numeric',
            'degrees_up'=> 'nullable|numeric',
            'radians_up'=> 'nullable|numeric',
            'polarizationloss_up'=> 'nullable|numeric',
            'hasilpolarizationloss_up'=> 'nullable|numeric',
            'crosspolpowerfraction_up'=> 'nullable|numeric',
            'dbcrosspolpowerfraction_up'=> 'nullable|numeric',
            'crosspolarizationisolation_up'=> 'nullable|numeric',

            'axtxantenna_down'=> 'nullable|numeric',
            'axialratio1_down'=> 'nullable|numeric',
            'axrxantenna_down'=> 'nullable|numeric',
            'axialratio2_down'=> 'nullable|numeric',
            'degrees_down'=> 'nullable|numeric',
            'radians_down'=> 'nullable|numeric',
            'polarizationloss_down'=> 'nullable|numeric',
            'hasilpolarizationloss_down'=> 'nullable|numeric',
            'crosspolpowerfraction_down'=> 'nullable|numeric',
            'dbcrosspolpowerfraction_down'=> 'nullable|numeric',
            'crosspolarizationisolation_down'=> 'nullable|numeric',

            // validasi kolom lainnya sesuai kebutuhan
        ]);

        // Data::create($request->all());
        
        $data = Data::create([
            'user_id' => $request->user_id,
            'axtxantenna_up' => $request->input('axtxantenna_up'),
            'axialratio1_up' => $request->input('axialratio1_up'),
            'axrxantenna_up' => $request->input('axrxantenna_up'),
            'axialratio2_up' => $request->input('axialratio2_up'),
            'degrees_up' => $request->input('degrees_up'),
            'radians_up' => $request->input('radians_up'),
            'polarizationloss_up' => $request->input('polarizationloss_up'),
            'hasilpolarizationloss_up' => $request->input('hasilpolarizationloss_up'),
            'crosspolpowerfraction_up' => $request->input('crosspolpowerfraction_up'),
            'dbcrosspolpowerfraction_up' => $request->input('dbcrosspolpowerfraction_up'),
            'crosspolarizationisolation_up' => $request->input('crosspolarizationisolation_up'),

            'axtxantenna_down' => $request->input('axtxantenna_down'),
            'axialratio1_down' => $request->input('axialratio1_down'),
            'axrxantenna_down' => $request->input('axrxantenna_down'),
            'axialratio2_down' => $request->input('axialratio2_down'),
            'degrees_down' => $request->input('degrees_down'),
            'radians_down' => $request->input('radians_down'),
            'polarizationloss_down' => $request->input('polarizationloss_down'),
            'hasilpolarizationloss_down' => $request->input('hasilpolarizationloss_down'),
            'crosspolpowerfraction_down' => $request->input('crosspolpowerfraction_down'),
            'dbcrosspolpowerfraction_down' => $request->input('dbcrosspolpowerfraction_down'),
            'crosspolarizationisolation_down' => $request->input('crosspolarizationisolation_down'),


            // Field lainnya
        ]);

        return redirect()->route('annpolaloss.show')->with('success', 'Data berhasil ditambahkan');
    }

    //GainAntenna
      public function store_antennagain(Request $request, $id)
    {

        $data = Data::findOrFail($id);
        return redirect()->route('annpoinloss.show', ['id' => $data->id])->with('success', 'Data berhasil ditambahkan');
    }

    //Antenna Pointing Loss
    public function store_annpoinloss(Request $request, $id)
    {

        $data = Data::findOrFail($id);
        return redirect()->route('annpolaloss.show', ['id' => $data->id])->with('success', 'Data berhasil ditambahkan');
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
