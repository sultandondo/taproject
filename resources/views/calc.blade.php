<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        /* Custom styles for animations and appearance */
        .input-unit {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280; /* gray-500 */
            font-size: 0.875rem; /* text-sm */
            pointer-events: none; /* Make sure it doesn't block input clicks */
        }

        /* Styling for readonly inputs */
        input[readonly] {
            background-color: #e6f4e1; /* Lighter green */
            color: #166534; /* Darker green text */
            border-color: #81c784; /* Green border */
            cursor: not-allowed;
            font-weight: 500;
        }

        /* Ensure input focus styles are prominent */
        input[type="number"]:focus,
        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3B82F6; /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* blue-500 with opacity */
        }

        /* Adjust labels for full visibility when not in sections */
        .form-section-label {
            display: block;
            font-weight: bold;
            color: #1F2937; /* gray-800 */
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #E5E7EB; /* gray-200 */
        }

        /* Popup Styles */
        .popup-window {
            display: none; 
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            position: relative;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: fadeInScale 0.3s ease-out;
        }
        .close-popup-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 32px;
            font-weight: bold;
            color: #6B7280;
            cursor: pointer;
            transition: color 0.2s ease;
        }
        .close-popup-btn:hover {
            color: #1F2937;
        }
        .popup-content h3 {
            margin-top: 0;
            font-size: 1.75rem;
            font-weight: bold;
            color: #1F2937;
            border-bottom: 1px solid #E5E7EB;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .popup-content h4 { /* Style for h4 within popup */
            font-size: 1.25rem;
            font-weight: bold;
            color: #374151;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .popup-content p {
            margin: 10px 0;
            line-height: 1.6;
            color: #374151;
            font-size: 1rem;
        }
        .popup-content p.formula {
            background-color: #f0fdf4;
            padding: 15px 20px;
            border-radius: 8px;
            border-left: 5px solid #34D399;
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace;
            font-size: 1.1rem;
            color: #065F46;
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .popup-content ul { /* Style for ul within popup */
            list-style-type: disc;
            margin-left: 1.25rem; /* Equivalent to ml-5 */
            margin-bottom: 1rem; /* Equivalent to mb-4 */
            color: #374151;
        }
        .popup-content ul li {
            margin-bottom: 0.5rem;
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Styling untuk pesan error */
.error-message {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: none;
}

.input-error {
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1) !important;
}

.input-valid {
    border-color: #16a34a !important;
    box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1) !important;
}
    </style>

    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="fas fa-satellite mr-2 text-blue-600"></i> Perhitungan Parameter Orbit
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Pilih jenis orbit dan masukkan parameter untuk mendapatkan hasil perhitungan yang akurat.
            </p>

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded animate__animated animate__shakeX">
                    <p class="font-bold">Terjadi Kesalahan!</p>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('data.store', ['id' => $dataId]) }}" class="space-y-6">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm">
                    <label for="jenis_orbit" class="block font-bold mb-2 text-blue-800 text-lg">
                        <i class="fas fa-globe-americas mr-2"></i> Pilih Jenis Orbit:
                    </label>
                    @php
                        $selectedOrbit = old('jenis_orbit', $data->jenis_orbit ?? request('jenis_orbit'));
                    @endphp

                    <select required name="jenis_orbit" id="jenis_orbit" onchange="handleOrbitChange()"
                            class="border border-blue-300 p-3 w-full rounded-lg bg-white shadow-sm text-gray-800
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                        <option value="">-- Pilih Orbit --</option>
                        <option value="LEO" {{ $selectedOrbit == 'LEO' ? 'selected' : '' }}>Low Earth Orbit (LEO)</option>
                        <option value="MEO" {{ $selectedOrbit == 'MEO' ? 'selected' : '' }}>Medium Earth Orbit (MEO)</option>
                        <option value="GEO" {{ $selectedOrbit == 'GEO' ? 'selected' : '' }}>Geosynchronous Earth Orbit (GEO)</option>
                    </select>

                    <div class="mt-4 text-right">
                        <button type="button" id="info_perbit_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Apa itu perhitungan Orbit? <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>
                </div>

                <div id="orbitFields" class="space-y-6" style="display: none;">

                    <label class="form-section-label text-purple-700"><i class="fas fa-ruler-combined mr-2"></i> Parameter Orbit Umum</label>

                    <div id="apogee_field" class="mb-4 relative">
    <label class="block font-medium mb-1 text-gray-700">Apogee (km):</label>
    <input type="number" 
           name="apogee" 
           id="apogee" 
           value="{{ old('apogee', $data->apogee ?? request('apogee')) }}" 
           class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" 
           min="200" 
           max="2000" 
           step="0.1" 
           placeholder="{{ $data->apogee ?? 'Masukkan nilai antara 200-2000 km' }}">
    <span class="input-unit">km</span>
    <div id="apogee-error" class="error-message">
        <i class="fas fa-exclamation-triangle"></i> 
        <span id="apogee-error-text"></span>
    </div>
</div>

                    <div id="perigee_field" class="mb-4 relative">
    <label class="block font-medium mb-1 text-gray-700">Perigee (km):</label>
    <input type="number" 
           name="perigee" 
           id="perigee" 
           value="{{ old('perigee') ?? request('perigee') }}" 
           class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" 
           min="200" 
           max="2000" 
           step="0.1" 
           placeholder="{{ $data->perigee ?? 'Masukkan nilai antara 200-2000 km' }}">
    <span class="input-unit">km</span>
    <div id="perigee-error" class="error-message">
        <i class="fas fa-exclamation-triangle"></i> 
        <span id="perigee-error-text"></span>
    </div>
</div>

                    <div id="eccentricity_field" class="mb-4">
                        <label for="eccentricity" class="block font-medium mb-1 text-gray-700">Eccentricity (e):</label>
                        <input type="text" name="eccentricity" id="eccentricity" value="{{ old('eccentricity') ?? request('eccentricity') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50"placeholder="{{ $data->eccentricity ?? '' }}" readonly>
                        <button type="button" id="popup_eccentricity_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <div id="argumenop_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Argument of Perigee (ω):</label>
                        <input type="number" name="argumenop" id="argumenop" value="{{ old('argumenop') ?? request('argumenop') }}" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0"placeholder="{{ $data->argumenop ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>

                    <div id="raan_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">R.A.A.N (Ω):</label>
                        <input type="number" name="raan" id="raan" value="{{ old('raan') ?? request('raan') }}" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0"placeholder="{{ $data->raan ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>

                    <div id="meananomaly_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">True Anomaly (M):</label>
                        <input type="number" name="mean_anomaly" id="mean_anomaly" value="{{ old('mean_anomaly') ?? request('mean_anomaly') }}" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->mean_anomaly ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>


                    <div id="inklinasi_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Sudut Inklinasi (°):</label>
                        <input type="number" name="inklinasi" id="inklinasi" value="{{ old('inklinasi') ?? request('inklinasi') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->inklinasi ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>

                    <div id="altitude_field" class="mb-4">
                        <label for="altitude" class="block font-medium mb-1 text-gray-700">Mean Orbit Altitude:</label>
                        <input type="number" name="altitude" id="altitude" value="{{ old('altitude') ?? request('altitude') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" readonly placeholder="{{ $data->altitude ?? '' }}">
                        <button type="button" id="popup_altitude_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <div id="radius_field" class="mb-4">
                        <label for="radius" class="block font-medium mb-1 text-gray-700">Mean Orbit Radius:</label>
                        <input type="text" name="radius" id="radius" value="{{ old('radius') ?? request('radius') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly placeholder="{{ $data->radius ?? '' }}">
                        <button type="button" id="popup_radius_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <div id="smageo_field" class="mb-4 relative">
                        <label for="smageo" class="block font-medium mb-1 text-gray-700">Semi Major Axis GEO:</label>
                        <input type="text" name="smageo" id="smageo" value="42164.156" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" readonly>
                        <span class="input-unit">km</span>
                        <button type="button" id="popup_semi_major_axis_geo_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>
                    
                    <div id="geostan_field" class="mb-4 relative">
                        <label for="geostan" class="block font-medium mb-1 text-gray-700">Geostasionary Altitude:</label>
                        <input type="text" name="geostan" id="geostan" value="35786.019" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" readonly>
                        <span class="input-unit">km</span>
                        <button type="button" id="popup_geostan_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>


                    <div id="ree_field" class="mb-4 relative">
                        <label for="re_geo" class="block font-medium mb-1 text-gray-700">Radius Bumi (Re):</label>
                        <input type="text" name="re_geo" id="re_geo" value="6378" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" readonly >
                        <span class="input-unit">km</span>
                        <button type="button" id="popup_re_geo_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <div id="re_field" class="mb-4 relative">
                        <label for="re_leomeo" class="block font-medium mb-1 text-gray-700">Radius Bumi (Re):</label>
                        <input type="text" name="re_leomeo" id="re_leomeo" value="6378" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" readonly>
                        <span class="input-unit">km</span>
                        <button type="button" id="popup_re_leomeo_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    {{-- NEWLY ADDED/RESTORED: elevasi and slant_range fields for LEO/MEO --}}
                    <div id="elevasi_field" class="mb-4 relative">
                        <label for="elevasi" class="block font-medium mb-1 text-gray-700">Sudut Elevasi (°):</label>
                        <input type="number" name="elevasi" id="elevasi" value="{{ old('elevasi') ?? request('elevasi') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->elevasi ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>

                    <div id="slant_range_field" class="mb-4">
                        <label for="slant_range" class="block font-medium mb-1 text-gray-700">Slant Range (km):</label>
                        <input type="number" name="slant_range" id="slant_range" value="{{ old('slant_range') ?? request('slant_range') }}" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" readonly placeholder="{{ $data->slant_range ?? '' }}">
                        <button type="button" id="popup_slant_range_leomeo_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <label id="geoEarthStationLabel" class="form-section-label text-green-700" style="display: none;"><i class="fas fa-map-marker-alt mr-2"></i> Parameter Stasiun Bumi (GEO)</label>
                    <div id="Latitude_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Latitude (°):</label>
                        <input type="number" name="latitude" id="latitude" value="{{ old('latitude') ?? request('latitude') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->latitude ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>

                    <div id="Longitude_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Longitude (°):</label>
                        <input type="number" name="longitude" id="longitude" value="{{ old('longitude') ?? request('longitude') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->longitude ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>

                    <div id="spclong_field" class="mb-4 relative"> 
                        <label class="block font-medium mb-1 text-gray-700">Spacecraft Slot (Longitude) (°):</label>
                        <input type="number" name="spclong" id="spclong" value="{{ old('spclong') ?? request('spclong') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->spacelot_up ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>

                    <div id="azimuth_field" class="mb-4 relative">
                        <label for="azimuth" class="block font-medium mb-1 text-gray-700">Sudut Azimuth (°):</label>
                        <input type="number" name="azimuth" id="azimuth" value="{{ old('azimuth') ?? request('azimuth') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->azimuth ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>

                    <div id="sudutpusatbumi_field" class="mb-4 relative">
                        <label for="sudutpusatbumi" class="block font-medium mb-1 text-gray-700">Sudut Pusat Bumi (°):</label>
                        <input type="number" name="sudutpusatbumi" id="sudutpusatbumi" value="{{ old('sudutpusatbumi') ?? request('sudutpusatbumi') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->sudutpusatbumi ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>

                    <label id="uplinkLabel" class="form-section-label text-red-700" style="display: none;"><i class="fas fa-arrow-up mr-2"></i> Uplink Parameters (GEO)</label>

                    <div id="uplinkgeo_up_label" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">UPLINK INPUTS:</label>
                    </div>
                    <div id="userlat_up_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">User Latitude (°):</label>
                        <input type="number" name="userlat_up" id="userlat_up" value="{{ old('userlat_up') ?? request('userlat_up') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->userlat_up ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>
                    <div id="userlong_up_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">User Longitude (°):</label>
                        <input type="number" name="userlong_up" id="userlong_up" value="{{ old('userlong_up') ?? request('userlong_up') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->userlong_up ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>
                    <div id="spaceslot_up_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Spacecraft Slot (Longitude) (°):</label>
                        <input type="number" name="spaceslot_up" id="spaceslot_up" value="{{ old('spaceslot_up') ?? request('spaceslot_up') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->spacelot_up ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200">

                        <div id="slantrangetouser_up_field" class="mb-4">
                            <label for="slantrangetouser_up_input" class="block font-medium mb-1 text-gray-700">Slant Range to User (km):</label>
                            <input type="number" name="slantrangetouser_up" id="slantrangetouser_up_input" value="{{ old('slantrangetouser_up') ?? request('slantrangetouser_up') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly placeholder="{{ $data->slantrangetouser_up ?? '' }}">
                            <button type="button" id="popup_slantrangetouser_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        <div id="userelevationangel_up_field" class="mb-4">
                            <label for="userelevationangel_up_input" class="block font-medium mb-1 text-gray-700">User Elevation Angle (°):</label>
                            <input type="number" name="userelevationangel_up" id="userelevationangel_up_input" value="{{ old('userelevationangel_up') ?? request('userelevationangel_up') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly placeholder="{{ $data->userelevationangel_up ?? '' }}">
                            <button type="button" id="popup_userelevationangel_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        <div id="userazimuthangle_up_field" class="mb-4">
                            <label for="userazimuthangle_up_input" class="block font-medium mb-1 text-gray-700">User Azimuth Angle (°):</label>
                            <input type="number" name="userazimuthangle_up" id="userazimuthangle_up_input" value="{{ old('userazimuthangle_up') ?? request('userazimuthangle_up') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly placeholder="{{ $data->userazimuthangle_up ?? '' }}">
                            <button type="button" id="popup_userazimuthangle_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        <div id="earthcentralangle_up_field" class="mb-4">
                            <label for="earthcentralangle_up_input" class="block font-medium mb-1 text-gray-700">Earth Central Angle (°):</label>
                            <input type="number" name="earthcentralangle_up" id="earthcentralangle_up_input" value="{{ old('earthcentralangle_up') ?? request('earthcentralangle_up') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly placeholder="{{ $data->earthcentralangle_up ?? '' }}">
                            <button type="button" id="popup_earthcentralangle_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                    </div>

                    <label id="downlinkLabel" class="form-section-label text-blue-700" style="display: none;"><i class="fas fa-arrow-down mr-2"></i> Downlink Parameters (GEO)</label>

                    <div id="downlinkgeo_down_label" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">DOWNLINK INPUTS:</label>
                    </div>
                    <div id="userlat_down_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">User Latitude (°):</label>
                        <input type="number" name="userlat_down" id="userlat_down" value="{{ old('userlat_down') ?? request('userlat_down') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->userlat_down ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>
                    <div id="userlong_down_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">User Longitude (°):</label>
                        <input type="number" name="userlong_down" id="userlong_down" value="{{ old('userlong_down') ?? request('userlong_down') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->userlong_down ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>
                    <div id="spaceslot_down_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Spacecraft Slot (Longitude) (°):</label>
                        <input type="number" name="spaceslot_down" id="spaceslot_down" value="{{ old('spaceslot_down') ?? request('spaceslot_down') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50 pr-12" min="0" placeholder="{{ $data->spacelot_down ?? '' }}">
                        <span class="input-unit">°</span>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200">

                        <div id="slantrangetouser_down_field" class="mb-4">
                            <label for="slantrangetouser_down_input" class="block font-medium mb-1 text-gray-700">Slant Range to User (km):</label>
                            <input type="number" name="slantrangetouser_down" id="slantrangetouser_down_input" value="{{ old('slantrangetouser_down') ?? request('slantrangetouser_down') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly placeholder="{{ $data->slantrangetouser_down ?? '' }}">
                            <button type="button" id="popup_slantrangetouser_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        <div id="userelevationangel_down_field" class="mb-4">
                            <label for="userelevationangel_down_input" class="block font-medium mb-1 text-gray-700">User Elevation Angle (°):</label>
                            <input type="number" name="userelevationangel_down" id="userelevationangel_down_input" value="{{ old('userelevationangel_down') ?? request('userelevationangel_down') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly placeholder="{{ $data->userelevationangel_down ?? '' }}">
                            <button type="button" id="popup_userelevationangel_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        <div id="userazimuthangle_down_field" class="mb-4">
                            <label for="userazimuthangle_down_input" class="block font-medium mb-1 text-gray-700">User Azimuth Angle (°):</label>
                            <input type="number" name="userazimuthangle_down" id="userazimuthangle_down_input" value="{{ old('userazimuthangle_down') ?? request('userazimuthangle_down') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly placeholder="{{ $data->userazimuthangle_down ?? '' }}">
                            <button type="button" id="popup_userazimuthangle_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        <div id="earthcentralangle_down_field" class="mb-4">
                            <label for="earthcentralangle_down_input" class="block font-medium mb-1 text-gray-700">Earth Central Angle (°):</label>
                            <input type="number" name="earthcentralangle_down" id="earthcentralangle_down_input" value="{{ old('earthcentralangle_down') ?? request('earthcentralangle_down') }}" step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly placeholder="{{ $data->earthcentralangle_down ?? '' }}">
                            <button type="button" id="popup_earthcentralangle_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i> Hitung & Simpan
                </button>
            </form>
        </div>
    </div>

    {{-- Popups for Formulas --}}

    <div id="popup_perbit" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Tentang Perhitungan Parameter Orbit</h3>
            <p class="formula">Perhitungan parameter orbit ini mencakup berbagai jenis orbit satelit dan parameter terkaitnya.</p>
            {{-- Content will be dynamically inserted by JavaScript --}}
        </div>
    </div>

    <div id="popup_eccentricity" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Eccentricity (e)</h3>
            <p class="formula">e = (r<sub>a</sub> - r<sub>p</sub>) / (r<sub>a</sub> + r<sub>p</sub>)</p>
            <p>r<sub>a</sub> (Apogee Altitude + Radius Bumi) = <span id="apogee_val_e"></span> km<br>r<sub>p</sub> (Perigee Altitude + Radius Bumi) = <span id="perigee_val_e"></span> km<br>e = (<span id="ra_val_e"></span> - <span id="rp_val_e"></span>) / (<span id="ra_val_e_2"></span> + <span id="rp_val_e_2"></span>) = <span id="hasil_eccentricity"></span></p>
        </div>
    </div>

    {{-- Pop-up Radius Bumi (Re) for LEO/MEO --}}
    <div id="popup_re_leomeo" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Radius Bumi (Re) LEO/MEO</h3>
            <p class="formula">R<sub>e</sub> = 6378 km (Konstanta)</p>
            <p>Radius Bumi (Re) adalah jarak rata-rata dari pusat Bumi ke permukaan Bumi. Nilai ini adalah radius khatulistiwa Bumi yang umum digunakan dalam perhitungan orbit satelit LEO (Low Earth Orbit) dan MEO (Medium Earth Orbit).</p>
            <p>Dalam perhitungan orbit, Radius Bumi sangat penting karena merupakan titik referensi dari pusat Bumi untuk semua ketinggian satelit. Ketika ketinggian satelit diukur dari permukaan Bumi (misalnya apogee dan perigee), Radius Bumi ditambahkan untuk mendapatkan jarak total dari pusat Bumi, yang merupakan parameter kunci dalam hukum gerak orbital.</p>
            <p>Nilai radius Bumi yang digunakan dalam perhitungan ini adalah <strong>6378 km</strong>.</p>
        </div>
    </div>


    {{-- Pop-up Radius Bumi (Re) for GEO --}}
    <div id="popup_re_geo" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Radius Bumi (Re)</h3>
            <p class="formula">R<sub>e</sub> = 6378 km (Konstanta)</p>
            <p>Radius Bumi (Re) adalah jarak rata-rata dari pusat Bumi ke permukaan Bumi. Nilai ini digunakan dalam perhitungan orbit satelit di berbagai jenis orbit, yaitu:</p>
            <ul>
                <li><strong>LEO (Low Earth Orbit):</strong> Radius Bumi (Re) digunakan dalam menghitung parameter orbit di sekitar Bumi yang berada pada ketinggian rendah, sekitar 160 - 2,000 km.</li>
                <li><strong>MEO (Medium Earth Orbit):</strong> Digunakan untuk satelit dengan ketinggian orbit antara 2,000 km dan 35,786 km.</li>
                <li><strong>GEO (Geostationary Earth Orbit):</strong> Bumi diperlakukan sebagai pusat referensi dengan radius tetap 6378 km, digunakan untuk satelit yang berada pada ketinggian 35,786 km.</li>
            </ul>
            <p>Nilai radius Bumi yang digunakan dalam perhitungan ini adalah <strong>6378 km</strong> untuk semua jenis orbit di atas, yang merupakan nilai standar yang berlaku secara internasional.</p>
        </div>
    </div>



    <div id="popup_altitude" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Mean Orbit Altitude</h3>
            <p class="formula">Altitude<sub>mean</sub> = (Apogee + Perigee) / 2</p>
            <p>Apogee = <span id="apogee_val_alt"></span> km<br>Perigee = <span id="perigee_val_alt"></span> km<br>Altitude<sub>mean</sub> = (<span id="apogee_val_alt_2"></span> + <span id="perigee_val_alt_2"></span>) / 2 = <span id="hasil_altitude"></span> km</p>
        </div>
    </div>

    <div id="popup_radius" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Mean Orbit Radius</h3>
            <p class="formula">Orbit Radius<sub>mean</sub> = Altitude<sub>mean</sub> + R<sub>e</sub></p>
            <p>Altitude<sub>mean</sub> = <span id="altitude_val_rad"></span> km<br>R<sub>e</sub> (Radius Bumi) = <span id="re_val_rad"></span> km<br>Radius<sub>mean</sub> = <span id="altitude_val_rad_2"></span> + <span id="re_val_rad_2"></span> = <span id="hasil_radius"></span> km</p>
        </div>
    </div>

    <div id="popup_semi_major_axis_geo" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Semi Major Axis GEO</h3>
            <p class="formula">a = R<sub>e</sub> + h<sub>GEO</sub></p>
            <ul>
                <li>a = Semi Major Axis</li>
                <li>R<sub>e</sub> = Radius Bumi (6378 km)</li>
                <li>h<sub>GEO</sub> = Ketinggian GEO dari permukaan Bumi (35786 km)</li>
            </ul>
            <p>Semi Major Axis untuk orbit Geostasioner (GEO) adalah konstanta yang tetap, dihitung sebagai jumlah dari Radius Bumi (Re) dan ketinggian nominal orbit GEO dari permukaan Bumi.</p>
            <p>Nilai Sumbu Major Axis GEO adalah <strong><span id="smageo_val_popup"></span> km</strong>.</p>
        </div>
    </div>

    <div id="popup_geostan" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Geostationary Altitude</h3>
            <p class="formula">h<sub>GEO</sub> = a - R<sub>e</sub></p>
            <ul>
                <li>h<sub>GEO</sub> = Ketinggian Geostasioner dari permukaan Bumi</li>
                <li>a = Semi Major Axis GEO (42164.156 km)</li>
                <li>R<sub>e</sub> = Radius Bumi (6378 km)</li>
            </ul>
            <p>Ketinggian Geostasioner (Geostationary Altitude) adalah ketinggian di atas permukaan Bumi di mana sebuah satelit dapat mempertahankan posisi relatif tetap terhadap suatu titik di khatulistiwa Bumi. Ini dihitung dengan mengurangkan Radius Bumi (Re) dari Semi Major Axis GEO.</p>
            <p>Nilai Ketinggian Geostasioner adalah <strong><span id="geostan_val_popup"></span> km</strong>.</p>
        </div>
    </div>

    <div id="popup_slant_range_leomeo" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Slant Range (LEO/MEO)</h3>
            <p class="formula">Slant Range (d) = R<sub>e</sub> &radic;((r/R<sub>e</sub>)&sup2; - cos&sup2;(E)) - R<sub>e</sub> sin(E)</p>
            <p>R<sub>e</sub> (Radius Bumi) = <span id="re_leomeo_val_sr"></span> km<br>r (Mean Orbit Radius) = <span id="radius_val_sr"></span> km<br>E (Sudut Elevasi) = <span id="elevasi_val_sr"></span> °<br>d = <span id="hasil_slant_range_leomeo"></span> km</p>
        </div>
    </div>

    <div id="popup_slantrangetouser_up" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Slant Range to User (Uplink GEO)</h3>
            <p class="formula">d = &radic;(r&sup2; + R<sub>e</sub>&sup2; - 2 r R<sub>e</sub> cos(&alpha;))</p>
            <p>r (Semi Major Axis GEO) = <span id="smageo_val_sr_up"></span> km<br>R<sub>e</sub> (Radius Bumi) = <span id="re_geo_val_sr_up"></span> km<br>&alpha; (Earth Central Angle) = <span id="eca_val_sr_up"></span> °<br>d = <span id="hasil_slantrangetouser_up"></span> km</p>
        </div>
    </div>

    <div id="popup_userelevationangel_up" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus User Elevation Angle (Uplink GEO)</h3>
            <p class="formula">E = arctan((cos(&alpha;) - R<sub>e</sub>/r) / sin(&alpha;))</p>
            <p>r (Semi Major Axis GEO) = <span id="smageo_val_el_up"></span> km<br>R<sub>e</sub> (Radius Bumi) = <span id="re_geo_val_el_up"></span> km<br>&alpha; (Earth Central Angle) = <span id="eca_val_el_up"></span> °<br>E = <span id="hasil_userelevationangel_up"></span> °</p>
        </div>
    </div>

    <div id="popup_userazimuthangle_up" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus User Azimuth Angle (Uplink GEO)</h3>
            <p class="formula">A = arctan(tan(&Delta;&lambda;) / sin(&phi;<sub>L</sub>)) (untuk LSA, koreksi kuadran diperlukan)</p>
            <p>&phi;<sub>L</sub> (User Latitude) = <span id="userlat_val_az_up"></span> °<br>&Delta;&lambda; (Longitude Difference) = (<span id="spaceslot_val_az_up"></span> - <span id="userlong_val_az_up"></span>) °<br>A = <span id="hasil_userazimuthangle_up"></span> °</p>
        </div>
    </div>

    <div id="popup_earthcentralangle_up" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Earth Central Angle (Uplink GEO)</h3>
            <p class="formula">&alpha; = arccos(cos(&phi;<sub>L</sub>) cos(&Delta;&lambda;))</p>
            <p>&phi;<sub>L</sub> (User Latitude) = <span id="userlat_val_eca_up"></span> °<br>&Delta;&lambda; (Longitude Difference) = (<span id="userlong_val_eca_up"></span> - <span id="spaceslot_val_eca_up"></span>) °<br>&alpha; = <span id="hasil_earthcentralangle_up"></span> °</p>
        </div>
    </div>

    <div id="popup_slantrangetouser_down" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Slant Range to User (Downlink GEO)</h3>
            <p class="formula">d = &radic;(r&sup2; + R<sub>e</sub>&sup2; - 2 r R<sub>e</sub> cos(&alpha;))</p>
            <p>r (Semi Major Axis GEO) = <span id="smageo_val_sr_down"></span> km<br>R<sub>e</sub> (Radius Bumi) = <span id="re_geo_val_sr_down"></span> km<br>&alpha; (Earth Central Angle) = <span id="eca_val_sr_down"></span> °<br>d = <span id="hasil_slantrangetouser_down"></span> km</p>
        </div>
    </div>

    <div id="popup_userelevationangel_down" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus User Elevation Angle (Downlink GEO)</h3>
            <p class="formula">E = arctan((cos(&alpha;) - R<sub>e</sub>/r) / sin(&alpha;))</p>
            <p>r (Semi Major Axis GEO) = <span id="smageo_val_el_down"></span> km<br>R<sub>e</sub> (Radius Bumi) = <span id="re_geo_val_el_down"></span> km<br>&alpha; (Earth Central Angle) = <span id="eca_val_el_down"></span> °<br>E = <span id="hasil_userelevationangel_down"></span> °</p>
        </div>
    </div>

    <div id="popup_userazimuthangle_down" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus User Azimuth Angle (Downlink GEO)</h3>
            <p class="formula">A = arctan(tan(&Delta;&lambda;) / sin(&phi;<sub>L</sub>)) (untuk LSA, koreksi kuadran diperlukan)</p>
            <p>&phi;<sub>L</sub> (User Latitude) = <span id="userlat_val_az_down"></span> °<br>&Delta;&lambda; (Longitude Difference) = (<span id="spaceslot_val_az_down"></span> - <span id="userlong_val_az_down"></span>) °<br>A = <span id="hasil_userazimuthangle_down"></span> °</p>
        </div>
    </div>

    <div id="popup_earthcentralangle_down" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Earth Central Angle (Downlink GEO)</h3>
            <p class="formula">&alpha; = arccos(cos(&phi;<sub>L</sub>) cos(&Delta;&lambda;))</p>
            <p>&phi;<sub>L</sub> (User Latitude) = <span id="userlat_val_eca_down"></span> °<br>&Delta;&lambda; (Longitude Difference) = (<span id="userlong_val_eca_down"></span> - <span id="spaceslot_val_eca_down"></span>) °<br>&alpha; = <span id="hasil_earthcentralangle_down"></span> °</p>
        </div>
    </div>


    <script>
        // Fungsi untuk mereset nilai inputan dan hasil perhitungan
        function resetForm() {
            const inputs = document.querySelectorAll('#orbitFields input');
            inputs.forEach(input => {
                // Jangan reset input readonly yang punya value default (seperti Re, SMA GEO)
                if (input.readOnly && (input.id === 're_geo' || input.id === 'smageo' || input.id === 're_leomeo' || input.id === 'geostan')) { 
                    // Do nothing
                } else {
                    input.value = '';
                }
            });
            // Tidak mereset dropdown jenis_orbit di sini
        }

        // Helper function to safely parse float
        function getVal(id) {
            const el = document.getElementById(id);
            return el ? (parseFloat(el.value) || 0) : 0;
        }

        // Helper function to set output value
        function setOutput(id, value, precision = 2) {
            const el = document.getElementById(id);
            if (el) {
                el.value = !isNaN(value) ? value.toFixed(precision) : '';
            }
        }
        // Fungsi untuk menangani perubahan jenis orbit
        function handleOrbitChange() {
            const orbit = document.getElementById('jenis_orbit').value;
            const orbitFieldsContainer = document.getElementById('orbitFields');

            // Get all individual field divs by their IDs
            const apogeeField = document.getElementById('apogee_field');
            const perigeeField = document.getElementById('perigee_field');
            const inklinasiField = document.getElementById('inklinasi_field');
            const eccentricityField = document.getElementById('eccentricity_field');
            const argumenopField = document.getElementById('argumenop_field');
            const raanField = document.getElementById('raan_field');
            const meananomalyField = document.getElementById('meananomaly_field');
            const altitudeField = document.getElementById('altitude_field');
            const radiusField = document.getElementById('radius_field');
            const reeGeoField = document.getElementById('ree_field'); // Radius Bumi untuk GEO
            const smageoField = document.getElementById('smageo_field'); // Semi Major Axis GEO (now unique)
            const geostanField = document.getElementById('geostan_field'); // Geostationary Altitude
            const reLeoMeoField = document.getElementById('re_field'); // Radius Bumi untuk LEO/MEO

            // GEO-specific input fields (within "Parameter Stasiun Bumi (GEO)" section)
            const geoEarthStationLabel = document.getElementById('geoEarthStationLabel');
            const latitudeField = document.getElementById('Latitude_field');
            const longitudeField = document.getElementById('Longitude_field');
            const spclongField = document.getElementById('spclong_field');
            const elevasiField = document.getElementById('elevasi_field'); 
            const slantRangeField = document.getElementById('slant_range_field'); 
            const azimuthField = document.getElementById('azimuth_field');
            const sudutpusatbumiField = document.getElementById('sudutpusatbumi_field');

            // Uplink and Downlink sections (GEO-specific)
            const uplinkLabel = document.getElementById('uplinkLabel');
            const uplinkInputs = document.querySelectorAll('#uplinkgeo_up_label, #userlat_up_field, #userlong_up_field, #spaceslot_up_field, #slantrangetouser_up_field, #userelevationangel_up_field, #userazimuthangle_up_field, #earthcentralangle_up_field');
            
            const downlinkLabel = document.getElementById('downlinkLabel');
            const downlinkInputs = document.querySelectorAll('#downlinkgeo_down_label, #userlat_down_field, #userlong_down_field, #spaceslot_down_field, #slantrangetouser_down_field, #userelevationangel_down_field, #userazimuthangle_down_field, #earthcentralangle_down_field');
            
            // Reset all input values
            resetForm();

            // --- BARIS PENTING: BERSIHKAN LOCAL STORAGE SAAT ORBIT BERUBAH ---
            localStorage.removeItem('slantRangeLEOMEO');
            localStorage.removeItem('slantRangeGEOUplink');
            localStorage.removeItem('slantRangeGEODownlink');
            localStorage.removeItem('lastSelectedOrbit');
            // --- AKHIR BARIS PENTING ---

            // Set all fields to display: none by default
            const allFields = [
                apogeeField, perigeeField, inklinasiField, eccentricityField, 
                argumenopField, raanField, meananomalyField, 
                altitudeField, radiusField, reeGeoField, 
                smageoField, // Now only one instance of smageoField
                geostanField, // Added geostanField here
                reLeoMeoField, latitudeField, longitudeField, spclongField, 
                elevasiField, slantRangeField, azimuthField, sudutpusatbumiField,
                geoEarthStationLabel, uplinkLabel, downlinkLabel
            ];
            allFields.forEach(field => { if(field) field.style.display = 'none'; });
            uplinkInputs.forEach(input => input.style.display = 'none');
            downlinkInputs.forEach(input => input.style.display = 'none');

            // Reset readonly status for all inputs
            const allInputs = document.querySelectorAll('input[type="number"], input[type="text"]');
            allInputs.forEach(input => {
                if (!['re_geo', 'smageo', 're_leomeo', 'geostan', 'eccentricity', 'altitude', 'radius', 'slant_range', 'slantrangetouser_up_input', 'userelevationangel_up_input', 'userazimuthangle_up_input', 'earthcentralangle_up_input', 'slantrangetouser_down_input', 'userelevationangel_down_input', 'userazimuthangle_down_input', 'earthcentralangle_down_input'].includes(input.id)) {
                    input.readOnly = false;
                }
            });

            if (orbit) {
                orbitFieldsContainer.style.display = 'block';

                if (orbit === 'LEO' || orbit === 'MEO') {
                    // Show LEO/MEO specific input fields
                    apogeeField.style.display = 'block';
                    perigeeField.style.display = 'block';
                    inklinasiField.style.display = 'block';
                    eccentricityField.style.display = 'block';
                    argumenopField.style.display = 'block';
                    raanField.style.display = 'block';
                    meananomalyField.style.display = 'block'; // SHOW Mean Anomaly for LEO/MEO
                    altitudeField.style.display = 'block';
                    radiusField.style.display = 'block';
                    reLeoMeoField.style.display = 'block'; // Re for LEO/MEO
                    
                    // Slant range related fields for LEO/MEO
                    elevasiField.style.display = 'block'; // Elevation is general for LEO/MEO slant range
                    slantRangeField.style.display = 'block'; // Slant range output for LEO/MEO

                    // Hide GEO-specific fields
                    smageoField.style.display = 'none'; // HIDE Semi Major Axis GEO
                    geostanField.style.display = 'none'; // HIDE Geostationary Altitude
                    reeGeoField.style.display = 'none'; // HIDE Radius Bumi GEO (only show Re LEO/MEO)


                    // Attach event listeners for LEO/MEO specific calculations
                    document.getElementById('apogee').addEventListener('input', calculateMeanOrbitAltitude);
                    document.getElementById('perigee').addEventListener('input', calculateMeanOrbitAltitude);
                    document.getElementById('elevasi').addEventListener('input', calculateSlantRange);
                    document.getElementById('apogee').addEventListener('input', calculateEccentricity);
                    document.getElementById('perigee').addEventListener('input', calculateEccentricity);

                    // Panggil fungsi perhitungan awal agar nilai tersimpan di localStorage
                    calculateMeanOrbitAltitude(); // Ini akan memicu calculateMeanOrbitRadius and calculateSlantRange
                    calculateEccentricity();
                    calculateSlantRange(); 

                } else if (orbit === 'GEO') {
                    // Show GEO specific read-only fields
                    reeGeoField.style.display = 'block'; // Re for GEO
                    smageoField.style.display = 'block'; // SMA for GEO (now uniquely here)
                    geostanField.style.display = 'block'; // Show Geostationary Altitude
                    
                    // Set GEO specific values and make readonly
                    document.getElementById('inklinasi').value = 0;
                    document.getElementById('inklinasi').readOnly = true;
                    document.getElementById('altitude').value = 35786; // Default GEO altitude
                    document.getElementById('radius').value = 42164.156; // Default GEO radius
                    document.getElementById('eccentricity').value = 0; // Default GEO eccentricity
                    document.getElementById('eccentricity').readOnly = true;


                    // Hide LEO/MEO specific fields for GEO
                    apogeeField.style.display = 'none';
                    perigeeField.style.display = 'none';
                    altitudeField.style.display = 'none';
                    radiusField.style.display = 'none';
                    reLeoMeoField.style.display = 'none';
                    eccentricityField.style.display = 'none';
                    argumenopField.style.display = 'none';
                    raanField.style.display = 'none';
                    meananomalyField.style.display = 'none'; // HIDE Mean Anomaly for GEO
                    elevasiField.style.display = 'none'; // Elevasi LEO/MEO tidak relevan di sini
                    slantRangeField.style.display = 'none'; // Slant Range LEO/MEO tidak relevan di sini


                    // Show GEO Earth Station Parameters
                    geoEarthStationLabel.style.display = 'none';
                    latitudeField.style.display = 'none';
                    longitudeField.style.display = 'none';
                    spclongField.style.display = 'none';
                    azimuthField.style.display = 'none';
                    sudutpusatbumiField.style.display = 'none';

                    // Show Uplink and Downlink sections
                    uplinkLabel.style.display = 'block';
                    uplinkInputs.forEach(input => input.style.display = 'block');
                    downlinkLabel.style.display = 'block';
                    downlinkInputs.forEach(input => input.style.display = 'block');
                }
            } else {
                orbitFieldsContainer.style.display = 'none';
            }
        }

        // Fungsi validasi untuk Apogee dan Perigee
function validateApogeePerigee() {
    const apogeeInput = document.getElementById('apogee');
    const perigeeInput = document.getElementById('perigee');
    const apogeeError = document.getElementById('apogee-error');
    const perigeeError = document.getElementById('perigee-error');
    const apogeeErrorText = document.getElementById('apogee-error-text');
    const perigeeErrorText = document.getElementById('perigee-error-text');
    
    if (!apogeeInput || !perigeeInput) return; // Guard untuk memastikan element ada
    
    const apogeeValue = parseFloat(apogeeInput.value);
    const perigeeValue = parseFloat(perigeeInput.value);
    
    let apogeeValid = true;
    let perigeeValid = true;
    
    // Reset styling
    apogeeInput.classList.remove('input-error', 'input-valid');
    perigeeInput.classList.remove('input-error', 'input-valid');
    if (apogeeError) apogeeError.style.display = 'none';
    if (perigeeError) perigeeError.style.display = 'none';
    
    // Validasi Apogee
    if (apogeeInput.value !== '') {
        if (isNaN(apogeeValue) || apogeeValue < 200 || apogeeValue > 2000) {
            apogeeValid = false;
            apogeeInput.classList.add('input-error');
            if (apogeeError) {
                apogeeError.style.display = 'block';
                if (apogeeValue < 200) {
                    apogeeErrorText.textContent = 'Nilai apogee tidak boleh kurang dari 200 km';
                } else if (apogeeValue > 2000) {
                    apogeeErrorText.textContent = 'Nilai apogee tidak boleh lebih dari 2000 km';
                } else {
                    apogeeErrorText.textContent = 'Masukkan nilai yang valid';
                }
            }
        } else {
            apogeeInput.classList.add('input-valid');
        }
    }
    
    // Validasi Perigee
    if (perigeeInput.value !== '') {
        if (isNaN(perigeeValue) || perigeeValue < 200 || perigeeValue > 2000) {
            perigeeValid = false;
            perigeeInput.classList.add('input-error');
            if (perigeeError) {
                perigeeError.style.display = 'block';
                if (perigeeValue < 200) {
                    perigeeErrorText.textContent = 'Nilai perigee tidak boleh kurang dari 200 km';
                } else if (perigeeValue > 2000) {
                    perigeeErrorText.textContent = 'Nilai perigee tidak boleh lebih dari 2000 km';
                } else {
                    perigeeErrorText.textContent = 'Masukkan nilai yang valid';
                }
            }
        } else {
            perigeeInput.classList.add('input-valid');
        }
    }
    
    // Validasi bahwa perigee tidak boleh lebih besar dari apogee
    if (apogeeValid && perigeeValid && apogeeInput.value !== '' && perigeeInput.value !== '') {
        if (perigeeValue >= apogeeValue) {
            perigeeValid = false;
            perigeeInput.classList.remove('input-valid');
            perigeeInput.classList.add('input-error');
            if (perigeeError) {
                perigeeError.style.display = 'block';
                perigeeErrorText.textContent = 'Nilai perigee harus lebih kecil dari apogee';
            }
        }
    }
    
    return apogeeValid && perigeeValid;
}


        // Fungsi untuk menghitung Mean Orbit Altitude
        function calculateMeanOrbitAltitude() {
            const apogee = parseFloat(document.getElementById('apogee').value) || 0;
            const perigee = parseFloat(document.getElementById('perigee').value) || 0;

            if (apogee > 0 && perigee > 0) {
                const meanAltitude = (apogee + perigee) / 2;
                document.getElementById('altitude').value = meanAltitude.toFixed(2);
                calculateMeanOrbitRadius();
            } else {
                document.getElementById('altitude').value = '';
                document.getElementById('radius').value = ''; // Clear radius if altitude is cleared
            }
            calculateSlantRange(); // Recalculate slant range when altitude/radius changes
        }

        // Fungsi untuk menghitung Mean Orbit Radius
        function calculateMeanOrbitRadius() {
            const meanOrbitAltitude = parseFloat(document.getElementById('altitude').value) || 0;
            let radiusBumi = 6378; // Default for LEO/MEO

            if (meanOrbitAltitude > 0 && radiusBumi > 0) {
                const meanOrbitRadius = meanOrbitAltitude + radiusBumi;
                document.getElementById('radius').value = meanOrbitRadius.toFixed(2);
            } else {
                document.getElementById('radius').value = '';
            }
        }

        // Fungsi untuk menghitung Slant Range (LEO/MEO)
        function calculateSlantRange() {
            const orbitType = document.getElementById('jenis_orbit').value;
            if (orbitType === 'GEO') return; // Only for LEO/MEO

            let radiusBumi = parseFloat(document.getElementById('re_leomeo').value) || 6378; // Use the specific Re for LEO/MEO
            const meanOrbitRadius = parseFloat(document.getElementById('radius').value) || 0;
            const sudutElevasi = parseFloat(document.getElementById('elevasi').value) || 0; // This is a general elevation, used for LEO/MEO Slant Range

            if (meanOrbitRadius > 0 && sudutElevasi >= 0) {
                const sudutElevasiRadian = sudutElevasi * (Math.PI / 180);
                const term1 = Math.pow(meanOrbitRadius / radiusBumi, 2);
                const term2 = Math.pow(Math.cos(sudutElevasiRadian), 2);
                const innerPart = term1 - term2;

                if (innerPart < 0) {
                    document.getElementById('slant_range').value = 'Error';
                    localStorage.removeItem('slantRangeLEOMEO');
                    return;
                }
                const slantRange = radiusBumi * (Math.sqrt(innerPart) - Math.sin(sudutElevasiRadian));
                document.getElementById('slant_range').value = slantRange.toFixed(2); // Changed to 2 decimal places

                // --- SIMPAN KE LOCAL STORAGE UNTUK LEO/MEO ---
                localStorage.setItem('lastSelectedOrbit', orbitType);
                localStorage.setItem('slantRangeLEOMEO', slantRange.toFixed(2));

            } else {
                document.getElementById('slant_range').value = '';
                localStorage.removeItem('slantRangeLEOMEO');
            }
        }

        // Fungsi untuk menghitung Eccentricity LEO/MEO
        function calculateEccentricity() {
            const orbitType = document.getElementById('jenis_orbit').value;

            if (orbitType === 'LEO' || orbitType === 'MEO') {
                const apogee = parseFloat(document.getElementById('apogee').value) || 0;
                const perigee = parseFloat(document.getElementById('perigee').value) || 0;
                const re = parseFloat(document.getElementById('re_leomeo').value) || 6378;

                if (apogee > 0 && perigee > 0) {
                    const ra = apogee + re; // Jarak apogee dari pusat Bumi
                    const rp = perigee + re; // Jarak perigee dari pusat Bumi
                    const numerator = ra - rp;
                    const denominator = ra + rp;

                    if (denominator !== 0) {
                        const eccentricity = numerator / denominator;
                        document.getElementById('eccentricity').value = eccentricity.toFixed(6);
                    } else {
                        document.getElementById('eccentricity').value = 'Error';
                    }
                } else {
                    document.getElementById('eccentricity').value = '';
                }
            } else if (orbitType === 'GEO') { // Set eccentricity to 0 for GEO
                document.getElementById('eccentricity').value = 0;
            } else {
                document.getElementById('eccentricity').value = '';
            }
        }

        // --- Perhitungan UPLINK GEO ---
        function calculateSlantRangeToUser() {
            const semiMajorAxisGEO = parseFloat(document.getElementById("smageo").value) || 42164.156;
            const radiusBumi = parseFloat(document.getElementById("re_geo").value) || 6378;
            const earthCentralAngle = parseFloat(document.getElementById("earthcentralangle_up_input").value); // No || 0 here

            if (isNaN(earthCentralAngle) || earthCentralAngle === 0) { // Check for 0 or NaN
                document.getElementById('slantrangetouser_up_input').value = "";
                localStorage.removeItem('slantRangeGEOUplink');
                return;
            }

            const earthCentralAngleRadians = earthCentralAngle * (Math.PI / 180);
            const slantRangeToUser = Math.sqrt(
                Math.pow(semiMajorAxisGEO, 2) + Math.pow(radiusBumi, 2) -
                (2 * semiMajorAxisGEO * radiusBumi * Math.cos(earthCentralAngleRadians))
            );
            document.getElementById('slantrangetouser_up_input').value = slantRangeToUser.toFixed(2);

            // --- SIMPAN KE LOCAL STORAGE UNTUK GEO UPLINK ---
            localStorage.setItem('lastSelectedOrbit', 'GEO');
            localStorage.setItem('slantRangeGEOUplink', slantRangeToUser.toFixed(2));
        }

        function calculateElevationAngleUplink() {
            const earthCentralAngle = parseFloat(document.getElementById('earthcentralangle_up_input').value); // No || 0 here
            const re = parseFloat(document.getElementById('re_geo').value) || 6378;
            const semiMajorAxisGeo = parseFloat(document.getElementById('smageo').value) || 42164.156;

            if (isNaN(earthCentralAngle) || earthCentralAngle === 0) { // Check for 0 or NaN
                document.getElementById('userelevationangel_up_input').value = "";
                return;
            }

            const earthCentralAngleRad = earthCentralAngle * (Math.PI / 180);
            const cosECA = Math.cos(earthCentralAngleRad);
            const sinECA = Math.sin(earthCentralAngleRad);

            const numerator = cosECA - (re / semiMajorAxisGeo);
            const denominator = sinECA;

            if (Math.abs(denominator) < 1e-9) { // Avoid division by very small numbers
                if (numerator > 0) {
                    document.getElementById('userelevationangel_up_input').value = "90.00";
                } else {
                    document.getElementById('userelevationangel_up_input').value = "Error"; // Or handle as an invalid angle
                }
                return;
            }

            const elevationAngle = (180 / Math.PI) * Math.atan2(numerator, denominator); // Using atan2 for quadrant handling
            document.getElementById('userelevationangel_up_input').value = elevationAngle.toFixed(2);
        }

        function calculateUserAzimuthAngleUplink() {
            const userLatitude = parseFloat(document.getElementById('userlat_up').value); // No || 0 here
            const userLongitude = parseFloat(document.getElementById('userlong_up').value); // No || 0 here
            const spacecraftLongitude = parseFloat(document.getElementById('spaceslot_up').value); // No || 0 here

            if (isNaN(userLatitude) || isNaN(userLongitude) || isNaN(spacecraftLongitude)) {
                document.getElementById('userazimuthangle_up_input').value = "";
                return;
            }
            // Add a check to prevent division by zero in certain edge cases
            if (userLatitude === 0 && userLongitude === spacecraftLongitude) {
                   document.getElementById('userazimuthangle_up_input').value = "N/A"; // Or 90/270 depending on convention
                   return;
            }

            const latRad = userLatitude * (Math.PI / 180);
            const longDiffRad = (spacecraftLongitude - userLongitude) * (Math.PI / 180);

            const numeratorAz = Math.sin(longDiffRad);
            const denominatorAz = (Math.tan(latRad) * Math.cos(longDiffRad)) - Math.sin(latRad); // Corrected this part to standard azimuth formula

            // Handle edge cases for division by zero or indeterminate forms
            if (Math.abs(denominatorAz) < 1e-9 && Math.abs(numeratorAz) < 1e-9) {
                document.getElementById('userazimuthangle_up_input').value = "N/A"; // Or handle as specific direction (e.g., North if latitude is 0)
                return;
            }
            
            // Standard formula often involves atan2(sin(delta_lambda), cos(phi_L)*tan(phi_S) - sin(phi_L)*cos(delta_lambda))
            // Given GEO is fixed at Phi_S=0, it simplifies.
            // Simplified formula based on common GEO azimuth calculations:
            const aziNumerator = Math.sin(longDiffRad);
            const aziDenominator = Math.tan(latRad) * Math.cos(longDiffRad);
            // This is a common simplified form for GEO, assuming satellite is on equator
            const azimuthAngleRad = Math.atan2(Math.sin(longDiffRad), Math.cos(latRad) * Math.tan(0) - Math.sin(latRad) * Math.cos(longDiffRad)); // tan(0) is 0
            // This simplifies to atan2(sin(delta_lambda), -sin(phi_L)*cos(delta_lambda))
            
            const azimuthAngleDeg = (azimuthAngleRad * (180 / Math.PI) + 360) % 360;

            document.getElementById('userazimuthangle_up_input').value = azimuthAngleDeg.toFixed(2);
        }


        function calculateEarthCentralAngleUplink() {
            const userLatitude = parseFloat(document.getElementById('userlat_up').value); // No || 0 here
            const userLongitude = parseFloat(document.getElementById('userlong_up').value); // No || 0 here
            const spacecraftLongitude = parseFloat(document.getElementById('spaceslot_up').value); // No || 0 here

            if (isNaN(userLatitude) || isNaN(userLongitude) || isNaN(spacecraftLongitude)) {
                document.getElementById('earthcentralangle_up_input').value = "";
                return;
            }

            const latitudeInRadians = userLatitude * (Math.PI / 180);
            const longitudeDifferenceInRadians = (userLongitude - spacecraftLongitude) * (Math.PI / 180);

            let cosArgument = Math.cos(latitudeInRadians) * Math.cos(longitudeDifferenceInRadians);
            cosArgument = Math.min(1, Math.max(-1, cosArgument)); // Clamp to ensure valid arccos input

            const earthCentralAngle = (180 / Math.PI) * Math.acos(cosArgument);

            document.getElementById('earthcentralangle_up_input').value = earthCentralAngle.toFixed(3);
        }

        // Event listeners for UPLINK GEO calculations
        document.addEventListener("DOMContentLoaded", function () {
            const uplinkInputs = ['userlat_up', 'userlong_up', 'spaceslot_up'];
            uplinkInputs.forEach(function (id) {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', function () {
                        calculateEarthCentralAngleUplink();
                        calculateSlantRangeToUser();
                        calculateElevationAngleUplink();
                        calculateUserAzimuthAngleUplink();
                    });
                }
            });
        }); 

        // --- Perhitungan DOWNLINK GEO ---
        function calculateSlantRangeToUserDownlink() {
            const semiMajorAxisGEO = parseFloat(document.getElementById("smageo").value) || 42164.156;
            const radiusBumi = parseFloat(document.getElementById("re_geo").value) || 6378;
            const earthCentralAngle = parseFloat(document.getElementById("earthcentralangle_down_input").value); // No || 0 here

            if (isNaN(earthCentralAngle) || earthCentralAngle === 0) { // Check for 0 or NaN
                document.getElementById('slantrangetouser_down_input').value = "";
                localStorage.removeItem('slantRangeGEODownlink');
                return;
            }

            const earthCentralAngleRadians = earthCentralAngle * (Math.PI / 180);
            const slantRangeToUserDownlink = Math.sqrt(
                Math.pow(semiMajorAxisGEO, 2) + Math.pow(radiusBumi, 2) -
                (2 * semiMajorAxisGEO * radiusBumi * Math.cos(earthCentralAngleRadians))
            );
            document.getElementById('slantrangetouser_down_input').value = slantRangeToUserDownlink.toFixed(4);

            // --- SIMPAN KE LOCAL STORAGE UNTUK GEO DOWNLINK ---
            localStorage.setItem('lastSelectedOrbit', 'GEO');
            localStorage.setItem('slantRangeGEODownlink', slantRangeToUserDownlink.toFixed(4));
        }

        function calculateElevationAngleDownlink() {
            const earthCentralAngle = parseFloat(document.getElementById('earthcentralangle_down_input').value); // No || 0 here
            const re = parseFloat(document.getElementById('re_geo').value) || 6378;
            const semiMajorAxisGeo = parseFloat(document.getElementById('smageo').value) || 42164.156;

            if (isNaN(earthCentralAngle) || earthCentralAngle === 0) { // Check for 0 or NaN
                document.getElementById('userelevationangel_down_input').value = "";
                return;
            }

            const earthCentralAngleRad = earthCentralAngle * (Math.PI / 180);
            const cosECA = Math.cos(earthCentralAngleRad);
            const sinECA = Math.sin(earthCentralAngleRad);

            const numerator = cosECA - (re / semiMajorAxisGeo);
            const denominator = sinECA;

            if (Math.abs(denominator) < 1e-9) { // Avoid division by very small numbers
                if (numerator > 0) {
                    document.getElementById('userelevationangel_down_input').value = "90.00";
                } else {
                    document.getElementById('userelevationangel_down_input').value = "Error";
                }
                return;
            }

            const elevationAngle = (180 / Math.PI) * Math.atan2(numerator, denominator); // Using atan2
            document.getElementById('userelevationangel_down_input').value = elevationAngle.toFixed(2);
        }

        function calculateUserAzimuthAngleDownlink() {
            const userLatitude = parseFloat(document.getElementById('userlat_down').value); // No || 0 here
            const userLongitude = parseFloat(document.getElementById('userlong_down').value); // No || 0 here
            const spacecraftLongitude = parseFloat(document.getElementById('spaceslot_down').value); // No || 0 here

            if (isNaN(userLatitude) || isNaN(userLongitude) || isNaN(spacecraftLongitude)) {
                document.getElementById('userazimuthangle_down_input').value = "";
                return;
            }
            // Add a check to prevent division by zero in certain edge cases
            if (userLatitude === 0 && userLongitude === spacecraftLongitude) {
                   document.getElementById('userazimuthangle_down_input').value = "N/A";
                   return;
            }

            const latRad = userLatitude * (Math.PI / 180);
            const longDiffRad = (spacecraftLongitude - userLongitude) * (Math.PI / 180);

            const numeratorAz = Math.sin(longDiffRad);
            const denominatorAz = (Math.tan(latRad) * Math.cos(longDiffRad)) - Math.sin(latRad); // Corrected this part to standard azimuth formula

            if (Math.abs(denominatorAz) < 1e-9 && Math.abs(numeratorAz) < 1e-9) {
                document.getElementById('userazimuthangle_down_input').value = "N/A";
                return;
            }

            const azimuthAngleRad = Math.atan2(numeratorAz, denominatorAz);
            let azimuthAngleDeg = (azimuthAngleRad * (180 / Math.PI) + 360) % 360;

            document.getElementById('userazimuthangle_down_input').value = azimuthAngleDeg.toFixed(2);
        }

        function calculateEarthCentralAngleDownlink() {
            const userLatitude = parseFloat(document.getElementById('userlat_down').value); // No || 0 here
            const userLongitude = parseFloat(document.getElementById('userlong_down').value); // No || 0 here
            const spacecraftLongitude = parseFloat(document.getElementById('spaceslot_down').value); // No || 0 here

            if (isNaN(userLatitude) || isNaN(userLongitude) || isNaN(spacecraftLongitude)) {
                document.getElementById('earthcentralangle_down_input').value = "";
                return;
            }

            const latitudeInRadians = userLatitude * (Math.PI / 180);
            const longitudeDifferenceInRadians = (userLongitude - spacecraftLongitude) * (Math.PI / 180);

            let cosArgument = Math.cos(latitudeInRadians) * Math.cos(longitudeDifferenceInRadians);
            cosArgument = Math.min(1, Math.max(-1, cosArgument)); // Clamp to ensure valid arccos input

            const earthCentralAngle = (180 / Math.PI) * Math.acos(cosArgument);

            document.getElementById('earthcentralangle_down_input').value = earthCentralAngle.toFixed(3);
        }

        // Event listeners for DOWNLINK GEO calculations
        document.addEventListener("DOMContentLoaded", function () {
            const downlinkInputs = ['userlat_down', 'userlong_down', 'spaceslot_down'];
            downlinkInputs.forEach(function (id) {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', function () {
                        calculateEarthCentralAngleDownlink();
                        calculateSlantRangeToUserDownlink();
                        calculateElevationAngleDownlink();
                        calculateUserAzimuthAngleDownlink();
                    });
                }
            });
        });

        // Validasi sebelum submit form
document.querySelector('form').addEventListener('submit', function(e) {
    const orbitType = document.getElementById('jenis_orbit').value;
    if (orbitType === 'LEO' || orbitType === 'MEO') {
        if (!validateApogeePerigee()) {
            e.preventDefault();
            alert('Mohon perbaiki nilai Apogee dan Perigee sebelum melanjutkan.');
            return false;
        }
    }
});

        // Initialize display based on existing value (if page reloads with selected orbit)
        document.addEventListener('DOMContentLoaded', function() {
            handleOrbitChange(); // Initial setup of form fields based on selected orbit (or default)

             // Attach validation event listeners
    const apogeeInput = document.getElementById('apogee');
    const perigeeInput = document.getElementById('perigee');
    const elevasiInput = document.getElementById('elevasi');
    
    if (apogeeInput) {
        apogeeInput.addEventListener('input', function() {
            validateApogeePerigee();
            calculateMeanOrbitAltitude();
            calculateEccentricity();
        });
        apogeeInput.addEventListener('blur', validateApogeePerigee);
    }
    if (perigeeInput) {
        perigeeInput.addEventListener('input', function() {
            validateApogeePerigee();
            calculateMeanOrbitAltitude();
            calculateEccentricity();
        });
        perigeeInput.addEventListener('blur', validateApogeePerigee);
    }
    
    if (elevasiInput) {
        elevasiInput.addEventListener('input', calculateSlantRange);
    }
        });

        // --- General Popup Logic ---
        function openPopup(id) {
            document.getElementById(id).style.display = "flex";
        }

        document.querySelectorAll('.close-popup-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            };
        });

        // Helper to update popup content (rumus dan nilai)
        // This helper is for popups that have a <p class="formula"> and then another <p> for inputs/results
        function updatePopupContent(popupId, formulaText, contentHtml) {
            const popup = document.getElementById(popupId);
            if (!popup) return;
            
            const formulaElement = popup.querySelector('.formula');
            // Selects all direct child elements of popup-content, excluding the formula and close button
            const elementsToRemove = popup.querySelectorAll('.popup-content > *:not(.formula):not(.close-popup-btn):not(h3)');
            elementsToRemove.forEach(el => el.remove());

            if (formulaElement) formulaElement.innerHTML = formulaText;

            // Add new dynamic content by parsing HTML string
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = contentHtml;
            // Insert all child nodes from tempDiv to the popup content after the formula
            if (formulaElement) {
                while (tempDiv.firstChild) {
                    formulaElement.parentNode.insertBefore(tempDiv.firstChild, formulaElement.nextSibling);
                }
            } else {
                // Fallback: If formulaElement not found, just append to popup-content (less ideal but works)
                while (tempDiv.firstChild) {
                    popup.querySelector('.popup-content').appendChild(tempDiv.firstChild);
                }
            }
        }

        // --- Popup Button Click Handlers ---

        //Penjelasan Perhitungan Orbit Popup (Updated)
        document.getElementById('info_perbit_btn').onclick = () => {
            const popup = document.getElementById('popup_perbit');
            if (!popup) return;

            // The contentHtml already clears previous content inside updatePopupContent
            const contentHtml = `
            <p>Aplikasi ini dirancang untuk membantu Anda menghitung parameter kunci yang terkait dengan berbagai jenis orbit satelit, memberikan pemahaman yang lebih dalam tentang karakteristik setiap orbit.</p>

            
            <ul class="list-disc ml-5 mb-4">
                <li><strong>Low Earth Orbit (LEO):</strong> Orbit rendah Bumi, dengan ketinggian antara 160 km hingga 2.000 km di atas permukaan Bumi. Umumnya digunakan untuk pencitraan, observasi Bumi, dan konstelasi internet.</li>
                <li><strong>Medium Earth Orbit (MEO):</strong> Orbit menengah Bumi, dengan ketinggian antara 2.000 km hingga 35.786 km. Sering digunakan untuk sistem navigasi global (seperti GPS) dan beberapa layanan komunikasi.</li>
                <li><strong>Geosynchronous Earth Orbit (GEO):</strong> Orbit geostasioner, pada ketinggian 35.786 km di atas ekuator Bumi. Satelit di orbit ini tampak diam relatif terhadap satu titik di permukaan Bumi, ideal untuk siaran televisi dan komunikasi satelit.</li>
            </ul>

            <h4>Parameter Umum Orbit (Relevan untuk LEO, MEO, dan GEO):</h4>
            <p>Parameter ini mendefinisikan bentuk, ukuran, dan orientasi orbit:</p>
            <ul class="list-disc ml-5 mb-4">
                <li><strong>Ketinggian (h):</strong> Jarak satelit dari permukaan Bumi (dalam km).</li>
                <li><strong>Apogee (ra):</strong> Titik terjauh satelit dari pusat Bumi dalam orbit elips (dalam km).</li>
                <li><strong>Perigee (rp):</strong> Titik terdekat satelit dari pusat Bumi dalam orbit elips (dalam km).</li>
                <li><strong>Eccentricity (e):</strong> Ukuran "kelonjongan" orbit. Nilai e=0 untuk orbit lingkaran sempurna, dan 0 < e < 1 untuk orbit elips.</li>
                <li><strong>Argument of Perigee (omega):</strong> Orientasi orbit di bidangnya, diukur dari Node Menaik (Ascending Node) ke perigee (dalam derajat).</li>
                <li><strong>Right Ascension of the Ascending Node (R.A.A.N atau Omega):</strong> Orientasi bidang orbit di ruang angkasa, diukur dari arah titik Aries ke Node Menaik (dalam derajat).</li>
                <li><strong>Mean Anomaly (M):</strong> Posisi sudut satelit pada waktu tertentu dalam orbit (dalam derajat).</li>
                <li><strong>Sudut Inklinasi (i):</strong> Kemiringan bidang orbit relatif terhadap bidang ekuator Bumi (dalam derajat). Untuk orbit GEO idealnya i=0 derajat.</li>
                <li><strong>Mean Orbit Altitude (havg):</strong> Ketinggian rata-rata satelit dari permukaan Bumi, dihitung dari apogee dan perigee (dalam km).</li>
                <li><strong>Mean Orbit Radius (ravg):</strong> Jarak rata-rata satelit dari pusat Bumi, dihitung dari Mean Orbit Altitude ditambahkan Radius Bumi (dalam km).</li>
                <li><strong>Radius Bumi (Re):</strong> Radius standar Bumi yang digunakan sebagai referensi (konstanta, Re = 6378 km).</li>
            </ul>

            <h4>Parameter Tambahan Khusus untuk LEO dan MEO:</h4>
            <p>Untuk orbit LEO dan MEO, parameter berikut sering digunakan untuk analisis ground station:</p>
            <ul class="list-disc ml-5 mb-4">
                <li><strong>Sudut Elevasi (E):</strong> Sudut vertikal dari garis horizontal di stasiun Bumi ke arah satelit (dalam derajat). Ini adalah input untuk perhitungan Slant Range.</li>
                <li><strong>Slant Range (d):</strong> Jarak langsung (garis pandang) dari stasiun Bumi ke satelit (dalam km).</li>
            </ul>

            <h4>Parameter Tambahan Khusus untuk GEO:</h4>
            <p>Untuk orbit GEO yang unik (tetap di atas satu titik ekuator), perhitungan mencakup detail posisi stasiun Bumi dan perhitungan terkait komunikasi uplink/downlink:</p>
            <ul class="list-disc ml-5 mb-4">
                <li><strong>Semi Major Axis GEO (a_GEO):</strong> Jarak rata-rata dari pusat Bumi ke satelit pada orbit GEO. Ini adalah nilai konstan (~42164.156 km).</li>
                <li><strong>Geostationary Altitude (h_GEO):</strong> Ketinggian nominal satelit GEO dari permukaan Bumi. Ini adalah nilai konstan (~35786 km).</li>
                <li><strong>Latitude Stasiun Bumi (Phi_L):</strong> Garis lintang geografis stasiun Bumi (dalam derajat).</li>
                <li><strong>Longitude Stasiun Bumi (Lambda_L):</strong> Garis bujur geografis stasiun Bumi (dalam derajat).</li>
                <li><strong>Spacecraft Slot (Longitude) (Lambda_s):</strong> Garis bujur tempat satelit GEO berada di atas ekuator (dalam derajat).</li>
                <li><strong>Sudut Azimuth (SAS):</strong> Arah horizontal antena dari stasiun Bumi ke satelit, diukur searah jarum jam dari utara (dalam derajat).</li>
                <li><strong>Sudut Pusat Bumi (Salpha):</strong> Sudut di pusat Bumi antara stasiun Bumi dan proyeksi satelit di ekuator (dalam derajat). Ini adalah parameter kunci untuk perhitungan jarak dan sudut di GEO.</li>
                <li><strong>Uplink Parameters:</strong> Meliputi Slant Range ke User, User Elevation Angle, User Azimuth Angle, dan Earth Central Angle untuk jalur transmisi dari pengguna ke satelit.</li>
                <li><strong>Downlink Parameters:</strong> Meliputi Slant Range ke User, User Elevation Angle, User Azimuth Angle, dan Earth Central Angle untuk jalur transmisi dari satelit ke pengguna.</li>
            </ul>
            <p>Aplikasi ini akan secara otomatis menampilkan atau menyembunyikan parameter input dan hasil perhitungan yang relevan berdasarkan jenis orbit yang Anda pilih, untuk memastikan fokus pada data yang diperlukan.</p>
           
            <h4>Parameter Tambahan Khusus untuk GEO:</h4>
            <p>Untuk orbit GEO yang unik (tetap di atas satu titik ekuator), perhitungan mencakup detail posisi stasiun Bumi dan perhitungan terkait komunikasi uplink/downlink:</p>
            <ul class="list-disc ml-5 mb-4">
                <li><strong>Semi Major Axis GEO (a_GEO):</strong> Jarak rata-rata dari pusat Bumi ke satelit pada orbit GEO. Ini adalah nilai konstan (~42164.156 km).</li>
                <li><strong>Geostationary Altitude (h_GEO):</strong> Ketinggian nominal satelit GEO dari permukaan Bumi. Ini adalah nilai konstan (~35786 km).</li>
                <li><strong>Latitude Stasiun Bumi (Phi_L):</strong> Garis lintang geografis stasiun Bumi (dalam derajat).</li>
                <li><strong>Longitude Stasiun Bumi (Lambda_L):</strong> Garis bujur geografis stasiun Bumi (dalam derajat).</li>
                <li><strong>Spacecraft Slot (Longitude) (Lambda_s):</strong> Garis bujur tempat satelit GEO berada di atas ekuator (dalam derajat).</li>
                <li><strong>Sudut Azimuth (SAS):</strong> Arah horizontal antena dari stasiun Bumi ke satelit, diukur searah jarum jam dari utara (dalam derajat).</li>
                <li><strong>Sudut Pusat Bumi (Salpha):</strong> Sudut di pusat Bumi antara stasiun Bumi dan proyeksi satelit di ekuator (dalam derajat). Ini adalah parameter kunci untuk perhitungan jarak dan sudut di GEO.</li>
                <li><strong>Uplink Parameters:</strong> Meliputi Slant Range ke User, User Elevation Angle, User Azimuth Angle, dan Earth Central Angle untuk jalur transmisi dari pengguna ke satelit.</li>
                <li><strong>Downlink Parameters:</strong> Meliputi Slant Range ke User, User Elevation Angle, User Azimuth Angle, dan Earth Central Angle untuk jalur transmisi dari satelit ke pengguna.</li>
            </ul>
            
            `;
            
            updatePopupContent('popup_perbit', `Perhitungan parameter orbit ini mencakup berbagai jenis orbit satelit dan parameter terkaitnya.`, contentHtml);
            openPopup('popup_perbit');
        };

        // Eccentricity Popup
        document.getElementById('popup_eccentricity_btn').onclick = () => {
            const apogee = getVal('apogee');
            const perigee = getVal('perigee');
            const re_leomeo = getVal('re_leomeo'); // Using LEO/MEO Re for this
            const ra = apogee + re_leomeo;
            const rp = perigee + re_leomeo;
            const eccentricity = (ra + rp !== 0) ? (ra - rp) / (ra + rp) : 'Error'; // Avoid division by zero

            updatePopupContent('popup_eccentricity',
                `e = (r<sub>a</sub> - r<sub>p</sub>) / (r<sub>a</sub> + r<sub>p</sub>)`,
                `r<sub>a</sub> (Apogee Altitude + Radius Bumi) = ${apogee.toFixed(2)} + ${re_leomeo.toFixed(2)} = ${ra.toFixed(2)} km<br>r<sub>p</sub> (Perigee Altitude + Radius Bumi) = ${perigee.toFixed(2)} + ${re_leomeo.toFixed(2)} = ${rp.toFixed(2)} km<br>e = ${typeof eccentricity === 'number' ? eccentricity.toFixed(6) : eccentricity}`
            );
            openPopup('popup_eccentricity');
        };

        //Radius Bumi GEO 
        document.getElementById('popup_re_geo_btn').onclick = () => {
            const re_geo_val = getVal('re_geo');
            const formulaContent = `R<sub>e</sub> = 6378 km (Konstanta)`;
            const explanationContent = `Radius Bumi (Re) adalah jarak rata-rata dari pusat Bumi ke permukaan Bumi. Nilai ini digunakan dalam perhitungan orbit satelit di berbagai jenis orbit, yaitu:<ul><li><strong>LEO (Low Earth Orbit):</strong> Radius Bumi (Re) digunakan dalam menghitung parameter orbit di sekitar Bumi yang berada pada ketinggian rendah, sekitar 160 - 2,000 km.</li><li><strong>MEO (Medium Earth Orbit):</strong> Digunakan untuk satelit dengan ketinggian orbit antara 2,000 km dan 35,786 km.</li><li><strong>GEO (Geostationary Earth Orbit):</strong> Bumi diperlakukan sebagai pusat referensi dengan radius tetap 6378 km, digunakan untuk satelit yang berada pada ketinggian 35,786 km.</li></ul><p>Nilai radius Bumi yang digunakan dalam perhitungan ini adalah <strong>${re_geo_val.toFixed(2)} km</strong> untuk semua jenis orbit di atas, yang merupakan nilai standar yang berlaku secara internasional.</p>`;
            
            updatePopupContent('popup_re_geo', formulaContent, explanationContent);
            openPopup('popup_re_geo');
        };

        // Mean Orbit Altitude Popup
        document.getElementById('popup_altitude_btn').onclick = () => {
            const apogee = getVal('apogee');
            const perigee = getVal('perigee');
            const meanAltitude = (apogee + perigee) / 2;
            updatePopupContent('popup_altitude',
                `Altitude<sub>mean</sub> = (Apogee + Perigee) / 2`,
                `Apogee = ${apogee.toFixed(2)} km<br>Perigee = ${perigee.toFixed(2)} km<br>Altitude<sub>mean</sub> = (${apogee.toFixed(2)} + ${perigee.toFixed(2)}) / 2 = ${meanAltitude.toFixed(2)} km`
            );
            openPopup('popup_altitude');
        };

        // Mean Orbit Radius Popup
        document.getElementById('popup_radius_btn').onclick = () => {
            const altitude = getVal('altitude');
            const re_leomeo_val = getVal('re_leomeo'); // Use the value from the Re LEO/MEO input
            const meanOrbitRadius = altitude + re_leomeo_val;
            updatePopupContent('popup_radius',
                `Radius<sub>mean</sub> = Altitude<sub>mean</sub> + R<sub>e</sub>`,
                `Altitude<sub>mean</sub> = ${altitude.toFixed(2)} km<br>R<sub>e</sub> (Radius Bumi) = ${re_leomeo_val.toFixed(2)} km<br>Radius<sub>mean</sub> = ${altitude.toFixed(2)} + ${re_leomeo_val.toFixed(2)} = ${meanOrbitRadius.toFixed(2)} km`
            );
            openPopup('popup_radius');
        };

        // Semi Major Axis GEO Popup
        document.getElementById('popup_semi_major_axis_geo_btn').onclick = () => {
            const re_geo_val = getVal('re_geo');
            const smageo_val = getVal('smageo');
            const geo_altitude = 35786; // Fixed GEO altitude for calculation

            const formulaContent = `a = R<sub>e</sub> + h<sub>GEO</sub>`;
            const explanationContent = `
                <ul>
                    <li>a = Semi Major Axis</li>
                    <li>R<sub>e</sub> = Radius Bumi (6378 km)</li>
                    <li>h<sub>GEO</sub> = Ketinggian GEO dari permukaan Bumi (35786 km)</li>
                </ul>
                <p>Semi Major Axis untuk orbit Geostasioner (GEO) adalah konstanta yang tetap, dihitung sebagai jumlah dari Radius Bumi (Re) dan ketinggian nominal orbit GEO dari permukaan Bumi.</p>
                <p>Nilai Sumbu Major Axis GEO adalah <strong>${smageo_val.toFixed(3)} km</strong>.</p>
            `;
            updatePopupContent('popup_semi_major_axis_geo', formulaContent, explanationContent);
            openPopup('popup_semi_major_axis_geo');
        };

        // NEWLY ADDED: Geostationary Altitude Popup
        document.getElementById('popup_geostan_btn').onclick = () => {
            const smageo_val = getVal('smageo');
            const re_geo_val = getVal('re_geo');
            const calculated_geostan = smageo_val - re_geo_val; // This calculates 42164.156 - 6378 = 35786.156

            const formulaContent = `h<sub>GEO</sub> = a - R<sub>e</sub>`;
            const explanationContent = `
                <ul>
                    <li>h<sub>GEO</sub> = Ketinggian Geostasioner dari permukaan Bumi</li>
                    <li>a = Semi Major Axis GEO (${smageo_val.toFixed(3)} km)</li>
                    <li>R<sub>e</sub> = Radius Bumi (${re_geo_val.toFixed(2)} km)</li>
                </ul>
                <p>Perhitungan: ${smageo_val.toFixed(3)} km - ${re_geo_val.toFixed(2)} km = ${calculated_geostan.toFixed(3)} km</p>
                <p>Ketinggian Geostasioner (Geostationary Altitude) adalah ketinggian di atas permukaan Bumi di mana sebuah satelit dapat mempertahankan posisi relatif tetap terhadap suatu titik di khatulistiwa Bumi. Ini dihitung dengan mengurangkan Radius Bumi (Re) dari Semi Major Axis GEO.</p>
                <p>Nilai Ketinggian Geostasioner adalah <strong>${calculated_geostan.toFixed(0)} km</strong> (dibulatkan).</p>
            `;
            updatePopupContent('popup_geostan', formulaContent, explanationContent);
            openPopup('popup_geostan');
        };


        // Radius Bumi (Re_leomeo) Popup
        document.getElementById('popup_re_leomeo_btn').onclick = () => {
            const re_leomeo_val = getVal('re_leomeo');
            const formulaContent = `R<sub>e</sub> = 6378 km (Konstanta)`;
            const explanationContent = `Radius Bumi (Re) adalah jarak rata-rata dari pusat Bumi ke permukaan Bumi. Nilai ini adalah radius khatulistiwa Bumi yang umum digunakan dalam perhitungan orbit satelit LEO (Low Earth Orbit) dan MEO (Medium Earth Orbit).<p>Dalam perhitungan orbit, Radius Bumi sangat penting karena merupakan titik referensi dari pusat Bumi untuk semua ketinggian satelit. Ketika ketinggian satelit diukur dari permukaan Bumi (misalnya apogee dan perigee), Radius Bumi ditambahkan untuk mendapatkan jarak total dari pusat Bumi, yang merupakan parameter kunci dalam hukum gerak orbital.</p><p>Nilai radius Bumi yang digunakan dalam perhitungan ini adalah <strong>${re_leomeo_val.toFixed(2)} km</strong>.</p>`;
            
            updatePopupContent('popup_re_leomeo', formulaContent, explanationContent);
            openPopup('popup_re_leomeo');
        };

        // Slant Range (LEO/MEO) Popup
        document.getElementById('popup_slant_range_leomeo_btn').onclick = () => {
            const re_leomeo = getVal('re_leomeo');
            const radius = getVal('radius');
            const elevasi = getVal('elevasi');
            let slantRange = document.getElementById('slant_range').value; // Get the raw value including 'Error'

            updatePopupContent('popup_slant_range_leomeo',
                `d = R<sub>e</sub> &radic;((r/R<sub>e</sub>)&sup2; - cos&sup2;(E)) - R<sub>e</sub> sin(E)`,
                `R<sub>e</sub> (Radius Bumi) = ${re_leomeo.toFixed(2)} km<br>r (Mean Orbit Radius) = ${radius.toFixed(2)} km<br>E (Sudut Elevasi) = ${elevasi.toFixed(2)} °<br>d = ${slantRange} km`
            );
            openPopup('popup_slant_range_leomeo');
        };

        // Slant Range to User (Uplink GEO) Popup
        document.getElementById('popup_slantrangetouser_up_btn').onclick = () => {
            const smageo = getVal('smageo');
            const re_geo = getVal('re_geo');
            const earthCentralAngle = getVal('earthcentralangle_up_input');
            const slantRange = getVal('slantrangetouser_up_input');

            updatePopupContent('popup_slantrangetouser_up',
                `d = &radic;(r&sup2; + R<sub>e</sub>&sup2; - 2 r R<sub>e</sub> cos(&alpha;))`,
                `r (Semi Major Axis GEO) = ${smageo.toFixed(3)} km<br>R<sub>e</sub> (Radius Bumi) = ${re_geo.toFixed(2)} km<br>&alpha; (Earth Central Angle) = ${earthCentralAngle.toFixed(2)} °<br>d = ${slantRange.toFixed(2)} km`
            );
            openPopup('popup_slantrangetouser_up');
        };

        // User Elevation Angle (Uplink GEO) Popup
        document.getElementById('popup_userelevationangel_up_btn').onclick = () => {
            const smageo = getVal('smageo');
            const re_geo = getVal('re_geo');
            const earthCentralAngle = getVal('earthcentralangle_up_input');
            const elevationAngle = getVal('userelevationangel_up_input');

            updatePopupContent('popup_userelevationangel_up',
                `E = arctan((cos(&alpha;) - R<sub>e</sub>/r) / sin(&alpha;))`,
                `r (Semi Major Axis GEO) = ${smageo.toFixed(3)} km<br>R<sub>e</sub> (Radius Bumi) = ${re_geo.toFixed(2)} km<br>&alpha; (Earth Central Angle) = ${earthCentralAngle.toFixed(2)} °<br>E = ${elevationAngle.toFixed(2)} °`
            );
            openPopup('popup_userelevationangel_up');
        };

        // User Azimuth Angle (Uplink GEO) Popup
        document.getElementById('popup_userazimuthangle_up_btn').onclick = () => {
            const userlat = getVal('userlat_up');
            const userlong = getVal('userlong_up');
            const spaceslot = getVal('spaceslot_up');
            const azimuthAngle = document.getElementById('userazimuthangle_up_input').value; // Get raw value for 'N/A'
            const longDiff = spaceslot - userlong;

            updatePopupContent('popup_userazimuthangle_up',
                `A = arctan(tan(&Delta;&lambda;) / sin(&phi;<sub>L</sub>)) (Koreksi kuadran diperlukan)`,
                `&phi;<sub>L</sub> (User Latitude) = ${userlat.toFixed(2)} °<br>&Delta;&lambda; (Longitude Difference) = (${spaceslot.toFixed(2)} - ${userlong.toFixed(2)}) = ${longDiff.toFixed(2)} °<br>A = ${azimuthAngle} °`
            );
            openPopup('popup_userazimuthangle_up');
        };

        // Earth Central Angle (Uplink GEO) Popup
        document.getElementById('popup_earthcentralangle_up_btn').onclick = () => {
            const userlat = getVal('userlat_up');
            const userlong = getVal('userlong_up');
            const spaceslot = getVal('spaceslot_up');
            const earthCentralAngle = getVal('earthcentralangle_up_input');
            const longDiff = userlong - spaceslot;

            updatePopupContent('popup_earthcentralangle_up',
                `&alpha; = arccos(cos(&phi;<sub>L</sub>) cos(&Delta;&lambda;))`,
                `&phi;<sub>L</sub> (User Latitude) = ${userlat.toFixed(2)} °<br>&Delta;&lambda; (Longitude Difference) = (${userlong.toFixed(2)} - ${spaceslot.toFixed(2)}) = ${longDiff.toFixed(2)} °<br>&alpha; = ${earthCentralAngle.toFixed(2)} °`
            );
            openPopup('popup_earthcentralangle_up');
        };

        // Slant Range to User (Downlink GEO) Popup
        document.getElementById('popup_slantrangetouser_down_btn').onclick = () => {
            const smageo = getVal('smageo');
            const re_geo = getVal('re_geo');
            const earthCentralAngle = getVal('earthcentralangle_down_input');
            const slantRange = getVal('slantrangetouser_down_input');

            updatePopupContent('popup_slantrangetouser_down',
                `d = &radic;(r&sup2; + R<sub>e</sub>&sup2; - 2 r R<sub>e</sub> cos(&alpha;))`,
                `r (Semi Major Axis GEO) = ${smageo.toFixed(3)} km<br>R<sub>e</sub> (Radius Bumi) = ${re_geo.toFixed(2)} km<br>&alpha; (Earth Central Angle) = ${earthCentralAngle.toFixed(2)} °<br>d = ${slantRange.toFixed(2)} km`
            );
            openPopup('popup_slantrangetouser_down');
        };

        // User Elevation Angle (Downlink GEO) Popup
        document.getElementById('popup_userelevationangel_down_btn').onclick = () => {
            const smageo = getVal('smageo');
            const re_geo = getVal('re_geo');
            const earthCentralAngle = getVal('earthcentralangle_down_input');
            const elevationAngle = getVal('userelevationangel_down_input');

            updatePopupContent('popup_userelevationangel_down',
                `E = arctan((cos(&alpha;) - R<sub>e</sub>/r) / sin(&alpha;))`,
                `r (Semi Major Axis GEO) = ${smageo.toFixed(3)} km<br>R<sub>e</sub> (Radius Bumi) = ${re_geo.toFixed(2)} km<br>&alpha; (Earth Central Angle) = ${earthCentralAngle.toFixed(2)} °<br>E = ${elevationAngle.toFixed(2)} °`
            );
            openPopup('popup_userelevationangel_down');
        };

        // User Azimuth Angle (Downlink GEO) Popup
        document.getElementById('popup_userazimuthangle_down_btn').onclick = () => {
            const userlat = getVal('userlat_down');
            const userlong = getVal('userlong_down');
            const spaceslot = getVal('spaceslot_down');
            const azimuthAngle = getVal('userazimuthangle_down_input');
            const longDiff = spaceslot - userlong;

            updatePopupContent('popup_userazimuthangle_down',
                `A = arctan(tan(&Delta;&lambda;) / sin(&phi;<sub>L</sub>)) (Koreksi kuadran diperlukan)`,
                `&phi;<sub>L</sub> (User Latitude) = ${userlat.toFixed(2)} °<br>&Delta;&lambda; (Longitude Difference) = (${spaceslot.toFixed(2)} - ${userlong.toFixed(2)}) = ${longDiff.toFixed(2)} °<br>A = ${azimuthAngle.toFixed(2)} °`
            );
            openPopup('popup_userazimuthangle_down');
        };

        // Earth Central Angle (Downlink GEO) Popup
        document.getElementById('popup_earthcentralangle_down_btn').onclick = () => {
            const userlat = getVal('userlat_down');
            const userlong = getVal('userlong_down');
            const spaceslot = getVal('spaceslot_down');
            const earthCentralAngle = getVal('earthcentralangle_down_input');
            const longDiff = userlong - spaceslot;

            updatePopupContent('popup_earthcentralangle_down',
                `&alpha; = arccos(cos(&phi;<sub>L</sub>) cos(&Delta;&lambda;))`,
                `&phi;<sub>L</sub> (User Latitude) = ${userlat.toFixed(2)} °<br>&Delta;&lambda; (Longitude Difference) = (${userlong.toFixed(2)} - ${spaceslot.toFixed(2)}) = ${longDiff.toFixed(2)} °<br>&alpha; = ${earthCentralAngle.toFixed(2)} °`
            );
            openPopup('popup_earthcentralangle_down');
        };

    </script>

</x-layout>