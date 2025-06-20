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

            //Database Transmitter Uplink
            $table->double('watt_up')->nullable();
            $table->double('dbw_up')->nullable();
            $table->double('dbm_up')->nullable();
            $table->double('alength_up')->nullable();
            $table->double('blength_up')->nullable();
            $table->double('clength_up')->nullable();
            $table->double('totlength_up')->nullable();
            $table->string('cabletype_up')->nullable();
            $table->double('guideloss_up')->nullable();
            $table->double('totalloss_up')->nullable();
            $table->double('connect_up')->nullable();
            $table->double('totconnect_up')->nullable();
            $table->double('filter_up')->nullable();
            $table->string('device_up')->nullable();
            $table->double('devicee_up')->nullable();
            $table->double('atn_up')->nullable();
            $table->double('totlinelosses_up')->nullable();
            $table->double('totpowerdeliv_up')->nullable();
            
            //Databe Transmitter Downlink
            $table->double('watt_down')->nullable();
            $table->double('dbw_down')->nullable();
            $table->double('dbm_down')->nullable();
            $table->double('alength_down')->nullable();
            $table->double('blength_down')->nullable();
            $table->double('clength_down')->nullable();
            $table->double('totlength_down')->nullable();
            $table->string('cabletype_down')->nullable();
            $table->double('guideloss_down')->nullable();
            $table->double('totalloss_down')->nullable();
            $table->double('connect_down')->nullable();
            $table->double('totconnect_down')->nullable();
            $table->double('filter_down')->nullable();
            $table->string('device_down')->nullable();
            $table->double('devicee_down')->nullable();
            $table->double('atn_down')->nullable();
            $table->double('totlinelosses_down')->nullable();
            $table->double('totrfpowerdeliv_down')->nullable();

            //Database Receiver Uplink
            $table->string('cabletype_uprec')->nullable();
            $table->double('typecable')->nullable();
            $table->double('alength_uprec')->nullable();
            $table->double('blength_uprec')->nullable();
            $table->double('clength_uprec')->nullable();
            $table->double('la_uprec')->nullable();
            $table->double('lb_uprec')->nullable();
            $table->double('lc_uprec')->nullable();
            $table->double('lbpf_uprec')->nullable();
            $table->double('lother_uprec')->nullable();
            $table->double('connect_uprec')->nullable();
            $table->double('totconnect_uprec')->nullable();
            $table->double('antenna to lna_uprec')->nullable();
            $table->double('tranlincoe_uprec')->nullable();
            $table->double('antemper_uprec')->nullable();
            $table->double('spactemp_uprec')->nullable();
            $table->double('tlna_uprec')->nullable();
            $table->double('lnagain_uprec')->nullable();
            $table->double('glna_uprec')->nullable();
            $table->double('2ndstagetemp_uprec')->nullable();
            $table->double('ts_uprec')->nullable();

            //Database Receiver Downlink
            $table->string('cabletype_downrec')->nullable();
            $table->double('typecable_downrec')->nullable();
            $table->double('alength_downrec')->nullable();
            $table->double('blength_downrec')->nullable();
            $table->double('clength_downrec')->nullable();
            $table->double('la_downrec')->nullable();
            $table->double('lb_downrec')->nullable();
            $table->double('lc_downrec')->nullable();
            $table->double('lbpf_downrec')->nullable();
            $table->double('lother_downrec')->nullable();
            $table->double('connect_downrec')->nullable();
            $table->double('totconnect_downrec')->nullable();
            $table->double('antenna_to_lna_downrec')->nullable();
            $table->double('tranlincoe_downrec')->nullable();
            $table->double('antemper_downrec')->nullable();
            $table->double('spactemp_downrec')->nullable();
            $table->double('tlna_downrec')->nullable();
            $table->double('lnagain_downrec')->nullable();
            $table->double('glna_downrec')->nullable();
            $table->string('dtype_downrec')->nullable();
            $table->double('dloss_length_downrec')->nullable();
            $table->double('dloss_per_meter_downrec')->nullable();
            $table->double('dloss_result_downrec')->nullable();
            $table->double('tcomrcvr_downrec')->nullable();
            $table->double('ts_downrec')->nullable();

            //Database CalcAzimuth Uplink
            $table->double('latitude_up')->nullable();
            $table->double('innhem_up')->nullable();
            $table->double('innhem2_up')->nullable();
            $table->double('longitude_up')->nullable();
            $table->double('eastofsat_up')->nullable();
            $table->double('eastofsat2_up')->nullable();
            $table->double('sat_in_quad_up')->nullable();
            $table->double('quad_result_up')->nullable();
            $table->double('quad_angle_range_up')->nullable();
            $table->double('sat_in_quad_value_up')->nullable();
            $table->double('quad_result_value_up')->nullable();
            $table->double('quad_angle_range_value_up')->nullable();
            $table->double('sat_in_quad_value2_up')->nullable();
            $table->double('quad_result_value2_up')->nullable();
            $table->double('quad_angle_range_value2_up')->nullable();
            $table->double('sat_in_quad_value3_up')->nullable();
            $table->double('quad_result_value3_up')->nullable();
            $table->double('quad_angle_range_value3_up')->nullable();
            $table->double('azimuthcalc_up')->nullable();
            $table->double('azimuthresult_up')->nullable();
        

            //Database CalcAzimuth Downlink
            $table->double('latitude_down')->nullable();
            $table->double('innhem_down')->nullable();
            $table->double('innhem2_down')->nullable();
            $table->double('longitude_down')->nullable();
            $table->double('eastofsat_down')->nullable();
            $table->double('eastofsat2_down')->nullable();
            $table->double('sat_in_quad_down')->nullable();
            $table->double('quad_result_down')->nullable();
            $table->double('quad_angle_range_down')->nullable();
            $table->double('sat_in_quad_value_down')->nullable();
            $table->double('quad_result_value_down')->nullable();
            $table->double('quad_angle_range_value_down')->nullable();
            $table->double('sat_in_quad_value2_down')->nullable();
            $table->double('quad_result_value2_down')->nullable();
            $table->double('quad_angle_range_value2_down')->nullable();
            $table->double('sat_in_quad_value3_down')->nullable();
            $table->double('quad_result_value3_down')->nullable();
            $table->double('quad_angle_range_value3_down')->nullable();
            $table->double('azimuthcalc_down')->nullable();
            $table->double('azimuthresult_down')->nullable();

            //Database Antenna Polarization Loss Uplink
            $table->double('axtxantenna_up')->nullable();
            $table->double('axialratio1_up')->nullable();
            $table->double('axrxantenna_up')->nullable();
            $table->double('axialratio2_up')->nullable();
            $table->double('degrees_up')->nullable();
            $table->double('radians_up')->nullable();
            $table->double('polarizationloss_up')->nullable();
            $table->double('hasilpolarizationloss_up')->nullable();
            $table->double('crosspolpowerfraction_up')->nullable();
            $table->double('dbcrosspolpowerfraction_up')->nullable();
            $table->double('crosspolarizationisolation_up')->nullable();
            
            //Database Antenna Polarization Loss Downlink
            $table->double('axtxantenna_down')->nullable();
            $table->double('axialratio1_down')->nullable();
            $table->double('axrxantenna_down')->nullable();
            $table->double('axialratio2_down')->nullable();
            $table->double('degrees_down')->nullable();
            $table->double('radians_down')->nullable();
            $table->double('polarizationloss_down')->nullable();
            $table->double('hasilpolarizationloss_down')->nullable();
            $table->double('crosspolpowerfraction_down')->nullable();
            $table->double('dbcrosspolpowerfraction_down')->nullable();
            $table->double('crosspolarizationisolation_down')->nullable();

            //Database Antenna Gain
            $table->string('jenis_polarizationgrounds_up')->nullable();
            $table->string('jenis_antenagrounds_up')->nullable();
            $table->double('frequency_upgrounds')->nullable();
            $table->double('wavelength_upgrounds')->nullable();
            $table->double('gain_manual_upgrounds')->nullable();
            $table->double('beamwidth_manual_upgrounds')->nullable();
       
            $table->string('jenis_polarizationspacecraft_up')->nullable();
            $table->string('jenis_antenaspacecraft_up')->nullable();
            $table->double('gain_manual_upspacecraft')->nullable();
            $table->double('beamwidth_manual_upspacecraft')->nullable();
            
            $table->string('jenis_polarizationgrounds_down')->nullable();
            $table->string('jenis_antenagrounds_down')->nullable();
            $table->double('frequency_downgrounds')->nullable();
            $table->double('wavelength_downgrounds')->nullable();
            $table->double('gain_manual_downgrounds')->nullable();
            $table->double('beamwidth_manual_downgrounds')->nullable();
            
            $table->string('jenis_polarizationspacecraft_down')->nullable();
            $table->string('jenis_antenaspacecraft_down')->nullable();
            $table->double('gain_manual_downspacecraft')->nullable();
            $table->double('beamwidth_manual_downspacecraft')->nullable();
            
            //Database Antenna Pointing Loss
            $table->string('jenis_polarizationgrounds_up_poin')->nullable();
            $table->double('frequency_upgrounds_poin')->nullable();
            $table->double('wavelength_upgrounds_poin')->nullable();
            $table->double('gain_upgrounds_poin')->nullable();
            $table->double('beamwidth_upgrounds_poin')->nullable();
            $table->double('estimedpointingerror_upgrounds_θ1_poin')->nullable();
            $table->double('annrolloff_upgrounds_poin')->nullable();
            $table->double('approxannpoinloss_upgrounds_poin')->nullable();
            $table->string('jenis_polarizationspacecraft_up_poin')->nullable();
            $table->double('gain_upspacecraft_poin')->nullable();
            $table->double('beamwidth_upspacecraft_poin')->nullable();
            $table->double('upspacecraft_θ2_poin')->nullable();
            $table->double('calculation_formulas_upspacecraft_poin')->nullable();
            $table->double('approxannpoinloss_upspacecraft_poin')->nullable();
            $table->string('jenis_polarizationspacecraft_down_poin')->nullable();
            $table->double('gain_downspacecraft_poin')->nullable();
            $table->double('beamwidth_downspacecraft_poin')->nullable();
            $table->double('downspacecraft_θ3_poin')->nullable();
            $table->double('calculation_formulas_downspacecraft_poin')->nullable();
            $table->double('approxannpoinloss_downspacecraft_poin')->nullable();
            $table->string('jenis_polarizationgrounds_down_poin')->nullable();
            $table->double('frequency_downgrounds_poin')->nullable();
            $table->double('wavelength_downgrounds_poin')->nullable();
            $table->double('gain_downgrounds_poin')->nullable();
            $table->double('beamwidth_downgrounds_poin')->nullable();
            $table->double('upgrounds_θ4_poin')->nullable();
            $table->double('annrolloff_downgrounds_poin')->nullable();
            $table->double('approxannpoinloss_downgrounds_poin')->nullable();

            //Database AttmosIonos
            $table->double('min_elevation_angle')->nullable();
            $table->double('loss_determined_atmospheric')->nullable();
            $table->double('uplink_loss_determined_display')->nullable();
            $table->double('uplink_frequency')->nullable();
            $table->double('uplink_loss_ionosphere')->nullable();
            $table->double('downlink_loss_determined_display')->nullable();
            $table->double('downlink_frequency')->nullable();
            $table->double('downlink_loss_ionosphere')->nullable();

            //Database Uplink & Downlink Budget Atn
            $table->double('tx_powerwatts_up')->nullable();
            $table->double('tx_powerdbw_up')->nullable();
            $table->double('tx_powerdbm_up')->nullable();
            $table->double('trlinelosses_up')->nullable();
            $table->double('antennaagain_up')->nullable();
            $table->double('eirp_up')->nullable();
            $table->double('pointinglosses_up')->nullable();
            $table->double('polarizationlosses_up')->nullable();
            $table->double('pathlosss_up')->nullable();
            $table->double('atmosphericlosses_up')->nullable();
            $table->double('ionosphericlosses_up')->nullable();
            $table->double('rainlosses_up')->nullable();
            $table->double('signallevel_up')->nullable();
            $table->double('scpointingloss_up')->nullable();
            $table->double('scantennagain_up')->nullable();
            $table->double('sclinelosses_up')->nullable();
            $table->double('scnoisetemp_up')->nullable();
            $table->double('scgtratio_up')->nullable();
            $table->double('scsignalpower_up')->nullable();
            $table->double('scbandwidth_up')->nullable();
            $table->double('scnoisepower_up')->nullable();
            $table->double('snrratio_up')->nullable();
            $table->double('requiredsnr_up')->nullable();
            $table->double('linkmargin_up')->nullable();
            $table->double('sc_powerwatts_down')->nullable();
            $table->double('sc_powerdbw_down')->nullable();
            $table->double('sc_powerdbm_down')->nullable();
            $table->double('sclinelosses_down')->nullable();
            $table->double('scantennaagain_down')->nullable();
            $table->double('sceirp_down')->nullable();
            $table->double('scpointinglosses_down')->nullable();
            $table->double('polarizationlosses_down')->nullable();
            $table->double('pathlosss_down')->nullable();
            $table->double('atmosphericlosses_down')->nullable();
            $table->double('ionosphericlosses_down')->nullable();
            $table->double('rainlosses_down')->nullable();
            $table->double('signallevel_down')->nullable();
            $table->double('gspointingloss_down')->nullable();
            $table->double('gsantennagain_down')->nullable();
            $table->double('gslinelosses_down')->nullable();
            $table->double('gsnoisetemp_down')->nullable();
            $table->double('gsgtratio_down')->nullable();
            $table->double('gssignalpower_down')->nullable();
            $table->double('gsbandwidth_down')->nullable();
            $table->double('gsnoisepower_down')->nullable();
            $table->double('snrratio_down')->nullable();
            $table->double('requiredsnr_down')->nullable();
            $table->double('linkmargin_down')->nullable();


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
