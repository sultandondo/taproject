<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Parameter Orbit</h1>

        <form method="GET" action="">
            @csrf

            <div class="mb-4">
                <label for="jenis_orbit" class="block font-medium mb-1 text-gray-700">Jenis Orbit:</label>
                <select name="jenis_orbit" id="jenis_orbit" onchange="handleOrbitChange()" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                    <option value="">-- Pilih Orbit --</option>
                    <option value="LEO" {{ request('jenis_orbit') == 'LEO' ? 'selected' : '' }}>LEO</option>
                    <option value="MEO" {{ request('jenis_orbit') == 'MEO' ? 'selected' : '' }}>MEO</option>
                    <option value="GEO" {{ request('jenis_orbit') == 'GEO' ? 'selected' : '' }}>GEO</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="jenis_Satuan" class="block font-medium mb-1 text-gray-700">Satuan:</label>
                <select name="jenis_Satuan" id="jenis_Satuan" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                    <option value="">-- Pilih Satuan --</option>
                    <option value="MHz">MHz</option>
                    <option value="GHz">GHz</option>
                </select>
            </div>

            <div id="nilai_field" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ):</label>
                <input type="number" name="nilai_field" id="nilai_field" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
            </div>

            <div id="orbitFields" style="display: none;">
                <div class="mb-4">
                    <label for="ketinggian" class="block font-medium mb-1 text-gray-700">Ketinggian (km):</label>
                    <input type="text" name="ketinggian" id="ketinggian" class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                </div>

                <div id="apogee_field" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Apogee (km):</label>
                    <input type="number" name="apogee" id="apogee" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="perigee_field" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Perigee (km):</label>
                    <input type="number" name="perigee" id="perigee" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
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

                <div id="elevasi_field" class="mb-4">
                    <label for="elevasi" class="block font-medium mb-1 text-gray-700">Sudut Elevasi (°):</label>
                    <input type="number" name="elevasi" id="elevasi" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="ree_field" class="mb-4">
                    <label for="re" class="block font-medium mb-1 text-gray-700">Radius Bumi (Re) [km]:</label>
                    <input type="text" name="re" id="re" value="6.378" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                </div>

                <div id="smageo_field" class="mb-4">
                    <label for="re" class="block font-medium mb-1 text-gray-700">Semi Major Axis GEO [km]:</label>
                    <input type="text" name="smageo" id="smageo" value="42.164,156" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                </div>

                <div id="re_field" class="mb-4">
                    <label for="re" class="block font-medium mb-1 text-gray-700">Radius Bumi (Re) [km]:</label>
                    <input type="text" name="re" id="re" value="6.378" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                </div>

                <div id="altitude_field" class="mb-4">
                    <label for="altitude" class="block font-medium mb-1 text-gray-700">Mean Orbit Altitude:</label>
                    <input type="number" name="altitude" id="altitude" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="radius_field" class="mb-4">
                    <label for="radius" class="block font-medium mb-1 text-gray-700">Mean Orbit Radius:</label>
                    <input type="number" name="radius" id="radius" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="slant_range_field" class="mb-4">
                    <label for="slant_range" class="block font-medium mb-1 text-gray-700">Slant Range (km):</label>
                    <input type="number" name="slant_range" id="slant_range" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="pathloss_field" class="mb-4">
                    <label for="pathloss" class="block font-medium mb-1 text-gray-700">Path Loss:</label>
                    <input type="number" name="pathloss" id="pathloss" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="azimuth_field" class="mb-4">
                    <label for="azimuth" class="block font-medium mb-1 text-gray-700">Sudut Azimuth (°):</label>
                    <input type="number" name="azimuth" id="azimuth" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div id="sudutpusatbumi_field" class="mb-4">
                    <label for="sudutpusatbumi" class="block font-medium mb-1 text-gray-700">Sudut Pusat Bumi (°):</label>
                    <input type="number" name="sudutpusatbumi" id="sudutpusatbumi" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 w-full font-semibold text-lg">Simpan</button>
        </form>
    </div>

    <script>
        function handleOrbitChange() {
            const orbit = document.getElementById('jenis_orbit').value;
            const orbitFields = document.getElementById('orbitFields');

            const apogee = document.getElementById('apogee_field');
            const perigee = document.getElementById('perigee_field');
            const azimuth = document.getElementById('azimuth_field');
            const inklinasi = document.getElementById('inklinasi');
            const inklinasiField = document.getElementById('inklinasi_field');

            const re = document.getElementById('re');
            const reField = document.getElementById('re_field');
            const altitudeField = document.getElementById('altitude_field');
            const radiusField = document.getElementById('radius_field');
            const pathlossField = document.getElementById('pathloss_field');
            const sudutpusatbumiField = document.getElementById('sudutpusatbumi_field');
            const smageoField = document.getElementById('smageo_field');
            const reeField = document.getElementById('ree_field');
            const latitudeField = document.getElementById('Latitude_field');
            const longitudeField = document.getElementById('Longitude_field');
            if (orbit) {
                orbitFields.style.display = 'block';

                if (orbit === 'GEO') {
                    
                    apogee.style.display = 'none';
                    perigee.style.display = 'none';
                    azimuth.style.display = 'block';
                    sudutpusatbumiField.style.display = 'block';
                    smageoField.style.display = 'block';
                    reeField.style.display = 'block';
                    latitudeField.style.display = 'block';
                    longitudeField.style.display = 'block';

                    inklinasi.value = 0;
                    inklinasi.readOnly = true;

                    reField.style.display = 'none';
                    altitudeField.style.display = 'none';
                    radiusField.style.display = 'none';
                    pathlossField.style.display = 'none';
                } else {
                    sudutpusatbumiField.style.display = 'none';
                    smageoField.style.display = 'none';
                    reeField.style.display = 'none';
                    latitudeField.style.display = 'none';
                    longitudeField.style.display = 'none';
                    apogee.style.display = 'block';
                    perigee.style.display = 'block';
                    azimuth.style.display = 'none';

                    inklinasi.value = '';
                    inklinasi.readOnly = false;

                    re.value = 6.378;
                    re.readOnly = true;
                    reField.style.display = 'block';
                    altitudeField.style.display = 'block';
                    radiusField.style.display = 'block';
                    pathlossField.style.display = 'block';
                
                }
            } else {
                orbitFields.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', handleOrbitChange);
    </script>
</x-layout>