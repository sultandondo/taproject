<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Parameter Orbit</h1>

        <form method="POST" action="{{ route('data.store') }}">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="mb-4">
                <label for="jenis_orbit" class="block font-medium mb-1 text-gray-700">Jenis Orbit:</label>
                <select name="jenis_orbit" id="jenis_orbit" onchange="handleOrbitChange()" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                    <option value="">-- Pilih Orbit --</option>
                    <option value="LEO" {{ request('jenis_orbit') == 'LEO' ? 'selected' : '' }}>LEO</option>
                    <option value="MEO" {{ request('jenis_orbit') == 'MEO' ? 'selected' : '' }}>MEO</option>
                    <option value="GEO" {{ request('jenis_orbit') == 'GEO' ? 'selected' : '' }}>GEO</option>
                </select>
            </div>

            <div id="orbitFields" style="display: none;">
                <div class="mb-4 relative">
                    <label for="ketinggian" class="block font-medium mb-1 text-gray-700">Ketinggian (km):</label>
                    <div class="relative">
                    <input type="text" name="ketinggian" id="ketinggian" class="border border-gray-300 p-3 w-full rounded bg-gray-50 pl-4 pr-12focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Ketinggian Orbit">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-700">km</span>
                </div>

                <div id="apogee_field" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Apogee (km):</label>
                    <input type="number" name="apogee" id="apogee" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="perigee_field" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Perigee (km):</label>
                    <input type="number" name="perigee" id="perigee" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="eccentricity_field" class="mb-4">
                    <label for="eccentricity" class="block font-medium mb-1 text-gray-700">Eccentricity (e):</label>
                    <input type="text" name="eccentricity" id="eccentricity" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                </div>
                
                <div id="argumenop_field" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Argument of Perigee(ω):</label>
                    <input type="number" name="argumenop" id="argumenop" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="raan_field" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">R.A.A.N (Ω):</label>
                    <input type="number" name="raan" id="raan" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="inklinasi_field" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Sudut Inklinasi (°):</label>
                    <input type="number" name="inklinasi" id="inklinasi" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="Latitude_field" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Latitude (°):</label>
                    <input type="number" name="latitude" id="latitude" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="Longitude_field" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Longitude (°):</label>
                    <input type="number" name="longitude" id="longitude" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="spclong_field" class="mb-4"> <label class="block font-medium mb-1 text-gray-700">Spacecraft Slot (Longitude) (°):</label>
                    <input type="number" name="spclong" id="spclong" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="elevasi_field" class="mb-4">
                    <label for="elevasi" class="block font-medium mb-1 text-gray-700">Sudut Elevasi (°):</label>
                    <input type="number" name="elevasi" id="elevasi" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="ree_field" class="mb-4"> <label for="re_geo" class="block font-medium mb-1 text-gray-700">Radius Bumi (Re) [km]:</label>
                    <input type="text" name="re_geo" id="re_geo" value="6378" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                </div>

                <div id="smageo_field" class="mb-4">
                    <label for="smageo" class="block font-medium mb-1 text-gray-700">Semi Major Axis GEO [km]:</label>
                    <input type="text" name="smageo" id="smageo" value="42164.156" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly> </div>

                <div id="re_field" class="mb-4"> <label for="re_leomeo" class="block font-medium mb-1 text-gray-700">Radius Bumi (Re) [km]:</label>
                    <input type="text" name="re_leomeo" id="re_leomeo" value="6378" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                </div>

                <div id="altitude_field" class="mb-4">
                    <label for="altitude" class="block font-medium mb-1 text-gray-700">Mean Orbit Altitude:</label>
                    <input type="number" name="altitude" id="altitude" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-red" min="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                </div>

                <div id="radius_field" class="mb-4">
                    <label for="radius" class="block font-medium mb-1 text-gray-700">Mean Orbit Radius:</label>
                    <input type="text" name="radius" id="radius" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                </div>

                <div id="slant_range_field" class="mb-4">
                    <label for="slant_range" class="block font-medium mb-1 text-gray-700">Slant Range (km):</label>
                    <input type="number" name="slant_range" id="slant_range" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                </div>

                <div id="azimuth_field" class="mb-4">
                    <label for="azimuth" class="block font-medium mb-1 text-gray-700">Sudut Azimuth (°):</label>
                    <input type="number" name="azimuth" id="azimuth" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="sudutpusatbumi_field" class="mb-4">
                    <label for="sudutpusatbumi" class="block font-medium mb-1 text-gray-700">Sudut Pusat Bumi (°):</label>
                    <input type="number" name="sudutpusatbumi" id="sudutpusatbumi" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="uplink_section">
                    <div id="uplinkgeo_up_label" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">UPLINK:</label>
                    </div>
                    <div id="userlat_up_field" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">User Latitude (°):</label>
                        <input type="number" name="userlat_up" id="userlat_up" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                    </div>
                    <div id="userlong_up_field" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">User Longitude (°):</label>
                        <input type="number" name="userlong_up" id="userlong_up" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                    </div>
                    <div id="spaceslot_up_field" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Spacecraft Slot (Longitude) (°):</label>
                        <input type="number" name="spaceslot_up" id="spaceslot_up" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                    </div>
                    <div id="slantrangetouser_up_field" class="mb-4">
                        <label for="slantrangetouser_up_input" class="block font-medium mb-1 text-gray-700">Slant Range to User (km):</label>
                        <input type="number" name="slantrangetouser_up" id="slantrangetouser_up_input" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    </div>
                    <div id="userelevationangel_up_field" class="mb-4">
                        <label for="userelevationangel_up_input" class="block font-medium mb-1 text-gray-700">User Elevation Angle (°):</label>
                        <input type="number" name="userelevationangel_up" id="userelevationangel_up_input" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    </div>
                    <div id="userazimuthangle_up_field" class="mb-4">
                        <label for="userazimuthangle_up_input" class="block font-medium mb-1 text-gray-700">User Azimuth Angle (°):</label>
                        <input type="number" name="userazimuthangle_up" id="userazimuthangle_up_input" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    </div>
                    <div id="earthcentralangle_up_field" class="mb-4">
                        <label for="earthcentralangle_up_input" class="block font-medium mb-1 text-gray-700">Earth Central Angle (°):</label>
                        <input type="number" name="earthcentralangle_up" id="earthcentralangle_up_input" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    </div>
                </div>

                <div id="downlink_section">
                    <div id="downlinkgeo_down_label" class="mb-4"> <label class="block font-medium mb-1 text-gray-700">DOWNLINK:</label>
                    </div>
                    <div id="userlat_down_field" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">User Latitude (°):</label>
                        <input type="number" name="userlat_down" id="userlat_down" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                    </div>
                    <div id="userlong_down_field" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">User Longitude (°):</label>
                        <input type="number" name="userlong_down" id="userlong_down" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                    </div>
                    <div id="spaceslot_down_field" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Spacecraft Slot (Longitude) (°):</label>
                        <input type="number" name="spaceslot_down" id="spaceslot_down" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                    </div>
                    <div id="slantrangetouser_down_field" class="mb-4">
                        <label for="slantrangetouser_down_input" class="block font-medium mb-1 text-gray-700">Slant Range to User (km):</label>
                        <input type="number" name="slantrangetouser_down" id="slantrangetouser_down_input" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    </div>
                    <div id="userelevationangel_down_field" class="mb-4">
                        <label for="userelevationangel_down_input" class="block font-medium mb-1 text-gray-700">User Elevation Angle (°):</label>
                        <input type="number" name="userelevationangel_down" id="userelevationangel_down_input" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    </div>
                    <div id="userazimuthangle_down_field" class="mb-4">
                        <label for="userazimuthangle_down_input" class="block font-medium mb-1 text-gray-700">User Azimuth Angle (°):</label>
                        <input type="number" name="userazimuthangle_down" id="userazimuthangle_down_input" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    </div>
                    <div id="earthcentralangle_down_field" class="mb-4">
                        <label for="earthcentralangle_down_input" class="block font-medium mb-1 text-gray-700">Earth Central Angle (°):</label>
                        <input type="number" name="earthcentralangle_down" id="earthcentralangle_down_input" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    </div>
                </div>

            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 w-full font-semibold text-lg" >Simpan</button>
        </form>
    </div>

<script>
    // Fungsi untuk mereset nilai inputan dan hasil perhitungan
    function resetForm() {
        document.getElementById('apogee').value = '';
        document.getElementById('perigee').value = '';
        document.getElementById('altitude').value = '';
        document.getElementById('radius').value = '';
        document.getElementById('slant_range').value = '';
        document.getElementById('eccentricity').value = '';
        document.getElementById('argumenop').value = '';
        document.getElementById('raan').value = '';
        document.getElementById('elevasi').value = '';
        document.getElementById('ketinggian').value = ''; // Ditambahkan untuk reset
        document.getElementById('inklinasi').value = ''; // Ditambahkan untuk reset
        document.getElementById('latitude').value = ''; // Ditambahkan untuk reset
        document.getElementById('longitude').value = ''; // Ditambahkan untuk reset
        document.getElementById('spclong').value = ''; // Ditambahkan untuk reset
        document.getElementById('azimuth').value = ''; // Ditambahkan untuk reset
        document.getElementById('sudutpusatbumi').value = ''; // Ditambahkan untuk reset

        // Reset Uplink fields
        document.getElementById('userlat_up').value = '';
        document.getElementById('userlong_up').value = '';
        document.getElementById('spaceslot_up').value = '';
        document.getElementById('slantrangetouser_up_input').value = '';
        document.getElementById('userelevationangel_up_input').value = '';
        document.getElementById('userazimuthangle_up_input').value = '';
        document.getElementById('earthcentralangle_up_input').value = '';

        // Reset Downlink fields
        document.getElementById('userlat_down').value = '';
        document.getElementById('userlong_down').value = '';
        document.getElementById('spaceslot_down').value = '';
        document.getElementById('slantrangetouser_down_input').value = '';
        document.getElementById('userelevationangel_down_input').value = '';
        document.getElementById('userazimuthangle_down_input').value = '';
        document.getElementById('earthcentralangle_down_input').value = '';
    }

    // Fungsi untuk menangani perubahan jenis orbit
    function handleOrbitChange() {
    const orbit = document.getElementById('jenis_orbit').value;
    const orbitFields = document.getElementById('orbitFields');

    // Dapatkan elemen fieldset umum
    const ketinggianField = document.getElementById('ketinggian').parentElement; // Mengambil div pembungkus
    const apogeeField = document.getElementById('apogee_field');
    const perigeeField = document.getElementById('perigee_field');
    const inklinasiField = document.getElementById('inklinasi_field');
    const eccentricityField = document.getElementById('eccentricity_field');
    const argumenopField = document.getElementById('argumenop_field');
    const raanField = document.getElementById('raan_field');
    const inklinasiInput = document.getElementById('inklinasi'); // Inputnya sendiri
    const latitudeGeoField = document.getElementById('Latitude_field'); // Khusus GEO
    const longitudeGeoField = document.getElementById('Longitude_field'); // Khusus GEO
    const spclongGeoField = document.getElementById('spclong_field'); // Khusus GEO (Earth Station Longitude)
    const elevasiField = document.getElementById('elevasi_field'); // Sudut Elevasi Field
    const slantRangeField = document.getElementById('slant_range_field'); // Slant Range Field
    const reeGeoField = document.getElementById('ree_field'); // Radius Bumi untuk GEO
    const smageoField = document.getElementById('smageo_field'); // Semi Major Axis GEO
    const reLeoMeoField = document.getElementById('re_field'); // Radius Bumi untuk LEO/MEO
    const altitudeField = document.getElementById('altitude_field');
    const radiusField = document.getElementById('radius_field');
    const azimuthGeoField = document.getElementById('azimuth_field'); // Khusus GEO
    const sudutpusatbumiGeoField = document.getElementById('sudutpusatbumi_field'); // Khusus GEO

    // Dapatkan elemen UPLINK dan DOWNLINK sections
    const uplinkSection = document.getElementById('uplink_section');
    const downlinkSection = document.getElementById('downlink_section');

    if (orbit) {
        resetForm(); // Panggil resetForm di awal
        orbitFields.style.display = 'block';

        // Sembunyikan semua field GEO-spesifik dan UPLINK/DOWNLINK secara default
        latitudeGeoField.style.display = 'none';
        longitudeGeoField.style.display = 'none';
        spclongGeoField.style.display = 'none';
        elevasiField.style.display = 'none'; // Sudut Elevasi disembunyikan
        slantRangeField.style.display = 'none'; // Slant Range disembunyikan
        azimuthGeoField.style.display = 'none';
        sudutpusatbumiGeoField.style.display = 'none';
         // Sembunyikan Re GEO
        uplinkSection.style.display = 'none';
        downlinkSection.style.display = 'none';

        // Tampilkan field umum LEO/MEO
        ketinggianField.style.display = 'block';
        apogeeField.style.display = 'block';
        perigeeField.style.display = 'block';
        inklinasiField.style.display = 'block';
        inklinasiInput.readOnly = false;
        elevasiField.style.display = 'block';
        reLeoMeoField.style.display = 'block'; // Tampilkan Re LEO/MEO
        altitudeField.style.display = 'block';
        radiusField.style.display = 'block';
        slantRangeField.style.display = 'block';
        eccentricityField.style.display = 'block';
        argumenopField.style.display = 'block';
        raanField.style.display = 'block';


        if (orbit === 'GEO') {
            // Sembunyikan field LEO/MEO yang tidak relevan untuk GEO
            apogeeField.style.display = 'none';
            perigeeField.style.display = 'none';
            ketinggianField.style.display = 'none'; // Ketinggian umum tidak dipakai jika Apogee/Perigee ada, atau untuk GEO sudah fix
            altitudeField.style.display = 'none'; // Untuk GEO, altitude fix
            radiusField.style.display = 'none'; // Untuk GEO, radius fix
            reLeoMeoField.style.display = 'none'; // Sembunyikan Re LEO/MEO

            // Tampilkan field khusus GEO
            latitudeGeoField.style.display = 'none'; // Tidak lagi ditampilkan untuk GEO
            longitudeGeoField.style.display = 'none'; // Tidak lagi ditampilkan untuk GEO
            spclongGeoField.style.display = 'none'; // Tidak lagi ditampilkan untuk GEO
            elevasiField.style.display = 'none'; // Tidak lagi ditampilkan untuk GEO
            slantRangeField.style.display = 'none'; // Tidak lagi ditampilkan untuk GEO
            eccentricityField.style.display = 'none';
            argumenopField.style.display = 'none';
            raanField.style.display = 'none';


            inklinasiInput.value = 0; // Untuk GEO, inklinasi idealnya 0
            inklinasiInput.readOnly = true;

            // Tampilkan UPLINK dan DOWNLINK sections untuk GEO
            uplinkSection.style.display = 'block';
            downlinkSection.style.display = 'block';
            
        } else { // LEO atau MEO
            // Pengaturan spesifik LEO/MEO sudah diatur di atas (default)
            // Pastikan inklinasi bisa diisi
            smageoField.style.display = 'none';
            reeGeoField.style.display = 'none';
        
            inklinasiInput.readOnly = false;
            // Tambahkan event listener untuk perhitungan altitude/radius LEO/MEO
            document.getElementById('apogee').addEventListener('input', calculateMeanOrbitAltitude);
            document.getElementById('perigee').addEventListener('input', calculateMeanOrbitAltitude);
        }
    } else {
        orbitFields.style.display = 'none';
        // Sembunyikan semua field jika tidak ada orbit dipilih
         if(uplinkSection) uplinkSection.style.display = 'none';
         if(downlinkSection) downlinkSection.style.display = 'none';
    }
}


    // Fungsi untuk menghitung Mean Orbit Altitude
    function calculateMeanOrbitAltitude() {
    const apogee = parseFloat(document.getElementById('apogee').value) || 0;
    const perigee = parseFloat(document.getElementById('perigee').value) || 0;

    // Cek apakah nilai Apogee dan Perigee valid
    if (apogee > 0 && perigee > 0) {
        const meanAltitude = (apogee + perigee) / 2;
        document.getElementById('altitude').value = meanAltitude.toFixed(2);  // Menampilkan hasil perhitungan

        // Panggil fungsi untuk menghitung Mean Orbit Radius setelah perhitungan Altitude
        calculateMeanOrbitRadius();
    } else {
        document.getElementById('altitude').value = '';  // Kosongkan jika input tidak valid
    }
}


    // Fungsi untuk menghitung Mean Orbit Radius
    function calculateMeanOrbitRadius() {
    const meanOrbitAltitude = parseFloat(document.getElementById('altitude').value) || 0;
    let radiusBumi = 0;

    const orbitType = document.getElementById('jenis_orbit').value;

    // Menentukan radius bumi sesuai jenis orbit
    switch (orbitType) {
        case 'LEO':
            radiusBumi = 6378; // Radius Bumi untuk LEO
            break;
        case 'MEO':
            radiusBumi = 6378; // Radius Bumi untuk MEO
            break;
        case 'GEO':
            radiusBumi = 6378; // Radius Bumi untuk GEO
            break;
        default:
            radiusBumi = 6378; // Default radius Bumi jika orbit tidak dipilih
            break;
    }

    // Cek apakah nilai Altitude dan Radius Bumi valid
    if (meanOrbitAltitude > 0 && radiusBumi > 0) {
        const meanOrbitRadius = meanOrbitAltitude + radiusBumi;  // Perhitungan radius orbit
        document.getElementById('radius').value = meanOrbitRadius.toFixed(2);  // Menampilkan hasil perhitungan
    } else {
        document.getElementById('radius').value = '';  // Kosongkan jika input tidak valid
    }
}

    // Fungsi untuk menghitung Slant Range
    function calculateSlantRange() {
        let radiusBumi = 0;
        const orbitType = document.getElementById('jenis_orbit').value;

        if (orbitType === 'GEO') {
            radiusBumi = parseFloat(document.getElementById('re_geo').value) || 6378;
        } else { // LEO or MEO
            radiusBumi = parseFloat(document.getElementById('re_leomeo').value) || 6378;
        }

        const meanOrbitRadius = parseFloat(document.getElementById('radius').value) || 0;
        const sudutElevasi = parseFloat(document.getElementById('elevasi').value) || 0;

        if (radiusBumi > 0 && meanOrbitRadius > 0 && sudutElevasi >= 0) {
            const sudutElevasiRadian = sudutElevasi * (Math.PI / 180); // Konversi ke radian yang benar
            const term1 = Math.pow(meanOrbitRadius / radiusBumi, 2);
            const term2 = Math.pow(Math.cos(sudutElevasiRadian), 2);
            const innerPart = term1 - term2;

            if (innerPart < 0) {
                document.getElementById('slant_range').value = 'Error'; // Error: Invalid Input
                return;
            }
            const slantRange = radiusBumi * (Math.sqrt(innerPart) - Math.sin(sudutElevasiRadian));
            document.getElementById('slant_range').value = slantRange.toFixed(2);
        } else {
            document.getElementById('slant_range').value = '';
        }
    }

    // Panggil perhitungan saat ada perubahan pada input terkait
    document.getElementById('elevasi').addEventListener('input', calculateSlantRange);
    // Event listener untuk radius dan altitude akan memicu calculateSlantRange jika diperlukan,
    // namun calculateSlantRange dipanggil secara eksplisit ketika elevasi berubah.
    // calculateMeanOrbitAltitude dan calculateMeanOrbitRadius akan memicu update radius yang mungkin relevan.

    // Panggil handleOrbitChange saat halaman dimuat untuk setup awal jika ada nilai orbit terpilih (mis. dari request)
    document.addEventListener('DOMContentLoaded', handleOrbitChange);

    
// Fungsi untuk menghitung Eccentricity LEO/MEO
function calculateEccentricity() {
    const orbitType = document.getElementById('jenis_orbit').value;
    
    // Hanya hitung eccentricity untuk LEO dan MEO
    if (orbitType === 'LEO' || orbitType === 'MEO') {
        const apogee = parseFloat(document.getElementById('apogee').value) || 0;
        const perigee = parseFloat(document.getElementById('perigee').value) || 0;
        const re = parseFloat(document.getElementById('re_leomeo').value) || 6378; // Radius Bumi
        
        // Cek apakah nilai Apogee dan Perigee valid
        if (apogee > 0 && perigee > 0) {
            // Perhitungan eccentricity dengan rumus yang diberikan
            const numerator = (apogee + re) - (perigee + re);
            const denominator = (apogee + re) + (perigee + re);
            
            if (denominator !== 0) {
                const eccentricity = numerator / denominator;
                document.getElementById('eccentricity').value = eccentricity.toFixed(6); // 6 desimal untuk presisi
            } else {
                document.getElementById('eccentricity').value = 'Error';
            }
        } else {
            document.getElementById('eccentricity').value = ''; // Kosongkan jika input tidak valid
        }
    }
}

// Event listener untuk menghitung eccentricity saat apogee atau perigee berubah
document.addEventListener('DOMContentLoaded', function() {
    // Panggil handleOrbitChange saat halaman dimuat
    handleOrbitChange();
    
    // Event listener untuk apogee
    document.getElementById('apogee').addEventListener('input', function() {
        calculateEccentricity();
        calculateMeanOrbitAltitude();
    });
    
    // Event listener untuk perigee  
    document.getElementById('perigee').addEventListener('input', function() {
        calculateEccentricity();
        calculateMeanOrbitAltitude();
    });
});



    //Perhitungan UPLINK GEO

    // Fungsi untuk menghitung Slant Range to User (km)
function calculateSlantRangeToUser() {
    // Mengambil nilai input dari form
    const semiMajorAxisGEO = parseFloat(document.getElementById("smageo").value) || 42164.156;  // Default untuk GEO (km)
    const radiusBumi = parseFloat(document.getElementById("re_geo").value) || 6378;  // Radius Bumi (km)
    const earthCentralAngle = parseFloat(document.getElementById("earthcentralangle_up_input").value) || 0;  // Earth Central Angle (°)

    // Validasi input
    if (isNaN(semiMajorAxisGEO) || isNaN(radiusBumi) || isNaN(earthCentralAngle)) {
        console.error("Input tidak valid, pastikan semua nilai diisi dengan benar.");
        return;  // Hentikan perhitungan jika input tidak valid
    }

    // Menghitung Slant Range with formula
    const earthCentralAngleRadians = earthCentralAngle / 57.29578;  // Mengkonversi derajat ke radian
    const slantRangeToUser = Math.sqrt(
        Math.pow(semiMajorAxisGEO, 2) + Math.pow(radiusBumi, 2) - 
        (2 * semiMajorAxisGEO * radiusBumi * Math.cos(earthCentralAngleRadians))
    );

    // Menampilkan hasil perhitungan Slant Range to User (km)
    document.getElementById('slantrangetouser_up_input').value = slantRangeToUser.toFixed(2);  // Pembulatan hasil menjadi 2 desimal
}

// Fungsi untuk menghitung User Elevation Angle (°) untuk Uplink
function calculateElevationAngleUplink() {
    const earthCentralAngle = parseFloat(document.getElementById('earthcentralangle_up_input').value) || 0;
    const re = parseFloat(document.getElementById('re_geo').value) || 6378;  // Radius Bumi dalam km (Re)
    const semiMajorAxisGeo = parseFloat(document.getElementById('smageo').value) || 42164.156;  // Semi Major Axis GEO dalam km

    // Periksa apakah input valid
    if (isNaN(earthCentralAngle) || earthCentralAngle <= 0) {
        console.error("Earth Central Angle harus lebih besar dari 0.");
        document.getElementById('userelevationangel_up_input').value = "Error"; // Menampilkan error
        return;
    }

    // Konversi Earth Central Angle ke radian
    const earthCentralAngleRad = earthCentralAngle / 57.29578;

    // Hitung nilai Cos dan Sin untuk Earth Central Angle
    const cosECA = Math.cos(earthCentralAngleRad);
    const sinECA = Math.sin(earthCentralAngleRad);

    // Menghitung numerator dan denominator
    const numerator = cosECA - (re / semiMajorAxisGeo);
    const denominator = sinECA;

    // Cek jika denominator 0 untuk menghindari pembagian dengan 0
    if (denominator === 0) {
        console.error("Denominator adalah 0. Periksa input Earth Central Angle.");
        document.getElementById('userelevationangel_up_input').value = "Error"; // Menampilkan error
        return;
    }

    // Hitung Elevation Angle dengan rumus yang sudah diberikan
    const elevationAngle = 57.29578 * Math.atan(numerator / denominator);

    // Tampilkan hasil perhitungan Elevation Angle
    document.getElementById('userelevationangel_up_input').value = elevationAngle.toFixed(2);  // Pembulatan 2 angka desimal
}

// Fungsi untuk menghitung Earth Central Angle (ECA) untuk Uplink
function calculateEarthCentralAngle() {
    // Ambil nilai dari input form
    const userLatitude = parseFloat(document.getElementById('userlat_up').value) || 0;
    const userLongitude = parseFloat(document.getElementById('userlong_up').value) || 0;
    const spacecraftLongitude = parseFloat(document.getElementById('spaceslot_up').value) || 0;

    // Konversi derajat ke radian (57.29578)
    const latitudeInRadians = userLatitude / 57.29578;
    const longitudeInRadians = (userLongitude - spacecraftLongitude) / 57.29578;

    // Hitung nilai Earth Central Angle (ECA)
    const earthCentralAngle = 57.29578 * Math.acos(Math.cos(latitudeInRadians) * Math.cos(longitudeInRadians));

    // Tampilkan hasil Earth Central Angle (dalam derajat)
    document.getElementById('earthcentralangle_up_input').value = earthCentralAngle.toFixed(3); // Pembulatan 3 desimal
}

// Event listener untuk menangani perubahan input (latitude, longitude, spacecraft longitude)
document.addEventListener("DOMContentLoaded", function () {
    const earthAngleInputs = ['userlat_up', 'userlong_up', 'spaceslot_up'];  // Input terkait Earth Central Angle

    earthAngleInputs.forEach(function (id) {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', function () {
                calculateEarthCentralAngle();  // Panggil fungsi perhitungan ECA saat input berubah
                calculateSlantRangeToUser();   // Panggil perhitungan Slant Range setelah ECA dihitung
                calculateElevationAngleUplink();  // Panggil perhitungan Elevation Angle setelah ECA dihitung
            });
        }
    });
});

// perhitungan DOWNLINK GEO

// Fungsi untuk menghitung Slant Range to User Downlink (km)
function calculateSlantRangeToUserDownlink() {
    // Mengambil nilai input dari form
    const semiMajorAxisGEO = parseFloat(document.getElementById("smageo").value) || 42164.156;  // Default untuk GEO (km)
    const radiusBumi = parseFloat(document.getElementById("re_geo").value) || 6378;  // Radius Bumi (km)
    const earthCentralAngle = parseFloat(document.getElementById("earthcentralangle_down_input").value) || 0;  // Earth Central Angle (°)

    // Validasi input
    if (isNaN(semiMajorAxisGEO) || isNaN(radiusBumi) || isNaN(earthCentralAngle)) {
        console.error("Input tidak valid, pastikan semua nilai diisi dengan benar.");
        return;  // Hentikan perhitungan jika input tidak valid
    }

    // Menghitung Slant Range with formula
    const earthCentralAngleRadians = earthCentralAngle / 57.29578;  // Mengkonversi derajat ke radian
    const slantRangeToUserDownlink = Math.sqrt(
        Math.pow(semiMajorAxisGEO, 2) + Math.pow(radiusBumi, 2) - 
        (2 * semiMajorAxisGEO * radiusBumi * Math.cos(earthCentralAngleRadians))
    );

    // Menampilkan hasil perhitungan Slant Range to User (km)
    document.getElementById('slantrangetouser_down_input').value = slantRangeToUserDownlink.toFixed(4);  // Pembulatan hasil menjadi 4 desimal
}

// Fungsi untuk menghitung User Elevation Angle Downlink (°)
function calculateElevationAngleDownlink() {
    const earthCentralAngle = parseFloat(document.getElementById('earthcentralangle_down_input').value) || 0;
    const re = parseFloat(document.getElementById('re_geo').value) || 6378;  // Radius Bumi dalam km (Re)
    const semiMajorAxisGeo = parseFloat(document.getElementById('smageo').value) || 42164.156;  // Semi Major Axis GEO dalam km

    // Periksa apakah input valid
    if (isNaN(earthCentralAngle) || earthCentralAngle <= 0) {
        console.error("Earth Central Angle harus lebih besar dari 0.");
        document.getElementById('userelevationangel_down_input').value = "Error"; // Menampilkan error
        return;
    }

    // Konversi Earth Central Angle ke radian
    const earthCentralAngleRad = earthCentralAngle / 57.29578;

    // Hitung nilai Cos dan Sin untuk Earth Central Angle
    const cosECA = Math.cos(earthCentralAngleRad);
    const sinECA = Math.sin(earthCentralAngleRad);

    // Menghitung numerator dan denominator
    const numerator = cosECA - (re / semiMajorAxisGeo);
    const denominator = sinECA;

    // Cek jika denominator 0 untuk menghindari pembagian dengan 0
    if (denominator === 0) {
        console.error("Denominator adalah 0. Periksa input Earth Central Angle.");
        document.getElementById('userelevationangel_down_input').value = "Error"; // Menampilkan error
        return;
    }

    // Hitung Elevation Angle dengan rumus yang sudah diberikan
    const elevationAngle = 57.29578 * Math.atan(numerator / denominator);

    // Tampilkan hasil perhitungan Elevation Angle
    document.getElementById('userelevationangel_down_input').value = elevationAngle.toFixed(2);  // Pembulatan 2 angka desimal
}

// Fungsi untuk menghitung Earth Central Angle (ECA) untuk Downlink
function calculateEarthCentralAngleDownlink() {
    // Ambil nilai dari input form
    const userLatitude = parseFloat(document.getElementById('userlat_down').value) || 0;
    const userLongitude = parseFloat(document.getElementById('userlong_down').value) || 0;
    const spacecraftLongitude = parseFloat(document.getElementById('spaceslot_down').value) || 0;

    // Konversi derajat ke radian (57.29578)
    const latitudeInRadians = userLatitude / 57.29578;
    const longitudeInRadians = (userLongitude - spacecraftLongitude) / 57.29578;

    // Hitung nilai Earth Central Angle (ECA)
    const earthCentralAngle = 57.29578 * Math.acos(Math.cos(latitudeInRadians) * Math.cos(longitudeInRadians));

    // Tampilkan hasil Earth Central Angle (dalam derajat)
    document.getElementById('earthcentralangle_down_input').value = earthCentralAngle.toFixed(3); // Pembulatan 3 desimal
}

// Event listener untuk menangani perubahan input (latitude, longitude, spacecraft longitude)
document.addEventListener("DOMContentLoaded", function () {
    const earthAngleInputs = ['userlat_down', 'userlong_down', 'spaceslot_down'];  // Input terkait Earth Central Angle

    earthAngleInputs.forEach(function (id) {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('input', function () {
                calculateEarthCentralAngleDownlink();  // Panggil fungsi perhitungan ECA saat input berubah
                calculateSlantRangeToUserDownlink();   // Panggil perhitungan Slant Range setelah ECA dihitung
                calculateElevationAngleDownlink();  // Panggil perhitungan Elevation Angle setelah ECA dihitung
            });
        }
    });
});


</script>

</x-layout>