<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        /* Shared styles with frequency.blade.php for consistency */
        input[readonly] {
            background-color: #e6f4e1; /* Lighter green */
            color: #166534; /* Darker green text */
            border-color: #81c784; /* Green border */
            cursor: not-allowed;
            font-weight: 500;
        }

        input[type="number"]:focus,
        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3B82F6; /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* blue-500 with opacity */
        }

        .form-section-label {
            display: block;
            font-weight: bold;
            color: #1F2937; /* gray-800 */
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #E5E7EB; /* gray-200 */
        }

        /* Popup Styles - Adjusted for consistency */
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
            border-radius: 8px; /* Adjusted to match frequency page */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); /* Adjusted */
            width: 80%;
            max-width: 600px;
            max-height: 80vh; /* Adjusted max height */
            display: flex; /* Use flexbox for header and body layout */
            flex-direction: column; /* Stack header and body vertically */
            animation: fadeInScale 0.3s ease-out;
        }

        /* Styles for popup header that won't scroll */
        .popup-header {
            padding: 20px 30px 10px; /* Padding for header */
            border-bottom: 1px solid #eee; /* Bottom border for header */
            position: relative; /* Important for absolute positioning of close button */
            flex-shrink: 0; /* Ensure header doesn't shrink */
        }

        .popup-header h3 {
            margin-top: 0;
            font-size: 1.75rem; /* Equivalent to text-3xl */
            font-weight: bold; /* Equivalent to font-bold */
            color: #2c3e50; /* Adjusted to match frequency page */
            padding-bottom: 0; /* Remove default h3 padding-bottom here */
        }

        /* Styles for close button (X) */
        .close-popup-btn {
            position: absolute;
            top: 15px; /* Adjusted */
            right: 15px; /* Adjusted */
            font-size: 24px; /* Adjusted */
            font-weight: bold;
            color: #555; /* Adjusted */
            cursor: pointer;
            transition: color 0.2s ease;
            z-index: 1001; /* Ensure button is above popup content */
            background-color: white; /* Give a background */
            border-radius: 50%; /* Make button circular */
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Add a slight shadow */
        }
        .close-popup-btn:hover {
            color: #000; /* Adjusted */
        }

        /* Styles for popup body that will scroll */
        .popup-body {
            padding: 20px 30px 30px; /* Padding for body content */
            overflow-y: auto; /* This enables scrolling for body content */
            flex-grow: 1; /* Allow body to fill available space */
        }

        .popup-content h4 { /* Style for h4 within popup */
            font-size: 1.25rem; /* text-xl */
            font-weight: bold;
            color: #374151;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .popup-content p {
            margin: 8px 0; /* Adjusted margin */
            line-height: 1.5; /* Adjusted line-height */
            color: #374151; /* Added for consistency */
            font-size: 1rem;
        }
        .popup-content .formula {
            background-color: #f5f5f5; /* Adjusted to match frequency page */
            padding: 10px 15px; /* Adjusted */
            border-radius: 5px; /* Adjusted */
            border-left: 4px solid #4CAF50; /* Adjusted */
            font-family: 'Cambria Math', 'Times New Roman', serif; /* Consistent font */
            font-size: 1.1rem;
            color: #333; /* Adjusted text color for formulas */
            overflow-x: auto;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .popup-content ul { /* Style for ul within popup */
            list-style-type: disc;
            margin-left: 1.25rem;
            margin-bottom: 1rem;
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

        /* Specific styles for input-with-unit-wrapper */
        .input-with-unit-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .unit-text {
            color: #4B5563; /* gray-700 */
            font-size: 0.875rem; /* text-sm */
            font-weight: 500; /* Medium font weight */
            min-width: 40px;
            text-align: left;
        }

        /* Adjust input padding to remove original input-unit space */
        input[type="number"],
        input[type="text"] {
            padding-right: 0.75rem; /* Standard p-3 padding */
        }

        /* Styles for the new "Apa itu perhitungan Orbit?" popup content */
        .orbit-explanation {
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
            color: #4A5568;
        }
        .orbit-explanation .section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }
        .orbit-explanation .section:last-child {
            border-bottom: none;
        }
        .orbit-explanation .section-title {
            color: #2C5282;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border-left: 5px solid #4299E1;
            padding-left: 1rem;
        }
        .orbit-explanation .section-content {
            text-align: justify;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }
        .orbit-explanation .orbit-definition {
            background-color: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .orbit-explanation .orbit-definition p {
            margin: 5px 0;
        }
        .orbit-explanation .param-title {
            color: #2D3748;
            font-size: 1rem;
            font-weight: 600;
            margin: 1.25rem 0 0.5rem 0;
        }
        .orbit-explanation .param-list {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }
        .orbit-explanation .param-list li {
            margin-bottom: 0.4rem;
            line-height: 1.6;
        }
        .orbit-explanation .subsection {
            margin-top: 15px;
            padding: 10px;
            background-color: #f1f3f4;
            border-radius: 4px;
        }
        .orbit-explanation .subsection-title {
            color: #2c3e50;
            font-size: 0.9rem; /* Smaller title for sub-sections */
            font-weight: bold;
            margin-bottom: 8px;
        }
    </style>

    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="text-blue-600"></i> Perhitungan Parameter Orbit
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
                <input type="hidden" name="user_id" value="1">

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

                    <label class="form-section-label text-purple-700"><i class=""></i> Parameter Orbit Umum</label>

                    <div id="apogee_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Apogee (km):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" 
                                name="apogee" 
                                id="apogee" 
                                value="{{  $data->apogee ?? '' }}" 
                                class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" 
                                min="200" 
                                max="2000" 
                                step="0.1" 
                                >
                            <span class="unit-text">km</span>
                        </div>
                        <div id="apogee-error" class="error-message">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <span id="apogee-error-text"></span>
                        </div>
                    </div>

                    <div id="perigee_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Perigee (km):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" 
                                name="perigee" 
                                id="perigee" 
                                value="{{  $data->perigee ?? '' }}" 
                                class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" 
                                min="200" 
                                max="2000" 
                                step="0.1" 
                                >
                            <span class="unit-text">km</span>
                        </div>
                        <div id="perigee-error" class="error-message">
                            <i class="fas fa-exclamation-triangle"></i> 
                            <span id="perigee-error-text"></span>
                        </div>
                    </div>

                    <div id="eccentricity_field" class="mb-4">
                        <label for="eccentricity" class="block font-medium mb-1 text-gray-700">Eccentricity (e):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="eccentricity" id="eccentricity" value="{{ old('eccentricity') ?? request('eccentricity') }}" step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50"placeholder="{{ $data->eccentricity ?? '' }}" readonly>
                            <span class="unit-text"></span>
                        </div>
                        <button type="button" id="popup_eccentricity_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <div id="argumenop_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Argument of Perigee (ω):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="argumenop" id="argumenop" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" step="0.01" value="{{ $data->argumenop ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div id="raan_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">R.A.A.N (Ω):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="raan" id="raan"  class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" step="0.01" value="{{ $data->raan ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div id="meananomaly_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">True Anomaly:</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="mean_anomaly" id="mean_anomaly"  class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" step="0.01" value="{{ $data->mean_anomaly ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div id="inklinasi_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Inclination(°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="inklinasi" id="inklinasi"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" value="{{ $data->inklinasi ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div id="altitude_field" class="mb-4">
                        <label for="altitude" class="block font-medium mb-1 text-gray-700">Mean Orbit Altitude:</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="altitude" id="altitude"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" readonly value="{{ $data->altitude ?? '' }}">
                            <span class="unit-text">km</span>
                        </div>
                        <button type="button" id="popup_altitude_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <div id="radius_field" class="mb-4">
                        <label for="radius" class="block font-medium mb-1 text-gray-700">Mean Orbit Radius:</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="radius" id="radius"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly value="{{ $data->radius ?? '' }}">
                            <span class="unit-text">km</span>
                        </div>
                        <button type="button" id="popup_radius_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <div id="smageo_field" class="mb-4 relative">
                        <label for="smageo" class="block font-medium mb-1 text-gray-700">Semi Major Axis GEO:</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="smageo" id="smageo" value="42164.156" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly>
                            <span class="unit-text">km</span>
                        </div>
                        <button type="button" id="popup_semi_major_axis_geo_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>
                    
                    <div id="geostan_field" class="mb-4 relative">
                        <label for="geostan" class="block font-medium mb-1 text-gray-700">Geostasionary Altitude:</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="geostan" id="geostan" value="35786.019" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly>
                            <span class="unit-text">km</span>
                        </div>
                        <button type="button" id="popup_geostan_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <div id="ree_field" class="mb-4 relative">
                        <label for="re_geo" class="block font-medium mb-1 text-gray-700">Earth Radius (Re):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="re_geo" id="re_geo" value="6378.14" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly >
                            <span class="unit-text">km</span>
                        </div>
                        <button type="button" id="popup_re_geo_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <div id="re_field" class="mb-4 relative">
                        <label for="re_leomeo" class="block font-medium mb-1 text-gray-700">Earth Radius (Re):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="re_leomeo" id="re_leomeo" value="6378.14" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly>
                            <span class="unit-text">km</span>
                        </div>
                        <button type="button" id="popup_re_leomeo_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    {{-- NEWLY ADDED/RESTORED: elevasi and slant_range fields for LEO/MEO --}}
                    <div id="elevasi_field" class="mb-4 relative">
                        <label for="elevasi" class="block font-medium mb-1 text-gray-700">Elevation Angle (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="elevasi" id="elevasi"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" value="{{ $data->elevasi ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div id="slant_range_field" class="mb-4">
                        <label for="slant_range" class="block font-medium mb-1 text-gray-700">Slant Range (km):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="slant_range" id="slant_range"  class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" readonly value="{{ $data->slant_range ?? '' }}">
                            <span class="unit-text">km</span>
                        </div>
                        <button type="button" id="popup_slant_range_leomeo_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>

                    <label id="geoEarthStationLabel" class="form-section-label text-green-700" style="display: none;"><i class="fas fa-map-marker-alt mr-2"></i> Parameter Stasiun Bumi (GEO)</label>
                    <div id="Latitude_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Latitude (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="latitude" id="latitude"  step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" value="{{ $data->latitude ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div id="Longitude_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Longitude (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="longitude" id="longitude"  step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" value="{{ $data->longitude ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div id="spclong_field" class="mb-4 relative"> 
                        <label class="block font-medium mb-1 text-gray-700">Spacecraft Slot (Longitude) (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="spclong" id="spclong"  step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" value="{{ $data->spacelot_up ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div id="azimuth_field" class="mb-4 relative">
                        <label for="azimuth" class="block font-medium mb-1 text-gray-700">Sudut Azimuth (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="azimuth" id="azimuth"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" value="{{ $data->azimuth ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div id="sudutpusatbumi_field" class="mb-4 relative">
                        <label for="sudutpusatbumi" class="block font-medium mb-1 text-gray-700">Earth Central Angle (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="sudutpusatbumi" id="sudutpusatbumi"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" min="0" value="{{ $data->sudutpusatbumi ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <label id="uplinkLabel" class="form-section-label text-red-700" style="display: none;"><i class="fas fa-arrow-up mr-2"></i> Uplink Parameters (GEO)</label>

                    <div id="uplinkgeo_up_label" class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">UPLINK INPUTS:</label>
                    </div>
                    <div id="userlat_up_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">User Latitude (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="userlat_up" id="userlat_up"  step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50"  value="{{ $data->userlat_up ?? '' }}">
                            
                            <span class="unit-text">°</span>
                        </div>
                    </div>
                    <div id="userlong_up_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">User Longitude (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="userlong_up" id="userlong_up"  step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50"  value="{{ $data->userlong_up ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>
                    <div id="spaceslot_up_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Spacecraft Slot (Longitude) (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="spaceslot_up" id="spaceslot_up"  step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50"  value="{{ $data->spacelot_up ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200">

                        <div id="slantrangetouser_up_field" class="mb-4">
                            <label for="slantrangetouser_up_input" class="block font-medium mb-1 text-gray-700">Slant Range to User (km):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="slantrangetouser_up_input" id="slantrangetouser_up_input"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly value="{{ $data->slantrangetouser_up_input ?? '' }}">
                                <span class="unit-text">km</span>
                            </div>
                            <button type="button" id="popup_slantrangetouser_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        <div id="userelevationangel_up_field" class="mb-4">
                            <label for="userelevationangel_up_input" class="block font-medium mb-1 text-gray-700">User Elevation Angle (°):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="userelevationangel_up_input" id="userelevationangel_up_input"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly value="{{ $data->userelevationangel_up_input ?? '' }}">
                                <span class="unit-text">°</span>
                            </div>
                            <button type="button" id="popup_userelevationangel_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        
                        <div id="earthcentralangle_up_field" class="mb-4">
                            <label for="earthcentralangle_up_input" class="block font-medium mb-1 text-gray-700">Earth Central Angle (°):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="earthcentralangle_up_input" id="earthcentralangle_up_input"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly value="{{ $data->earthcentralangle_up_input ?? '' }}">
                                <span class="unit-text">°</span>
                            </div>
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
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="userlat_down" id="userlat_down"  step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50"  value="{{ $data->userlat_down ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>
                    <div id="userlong_down_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">User Longitude (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="userlong_down" id="userlong_down"  step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50"  value="{{ $data->userlong_down ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>
                    <div id="spaceslot_down_field" class="mb-4 relative">
                        <label class="block font-medium mb-1 text-gray-700">Spacecraft Slot (Longitude) (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="spaceslot_down" id="spaceslot_down"  step="0.000001" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50"  value="{{ $data->spacelot_down ?? '' }}">
                            <span class="unit-text">°</span>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-200">

                        <div id="slantrangetouser_down_field" class="mb-4">
                            <label for="slantrangetouser_down_input" class="block font-medium mb-1 text-gray-700">Slant Range to User (km):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="slantrangetouser_down_input" id="slantrangetouser_down_input"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly value="{{ $data->slantrangetouser_down_input ?? '' }}">
                                <span class="unit-text">km</span>
                            </div>
                            <button type="button" id="popup_slantrangetouser_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        <div id="userelevationangel_down_field" class="mb-4">
                            <label for="userelevationangel_down_input" class="block font-medium mb-1 text-gray-700">User Elevation Angle (°):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="userelevationangel_down_input" id="userelevationangel_down_input"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly value="{{ $data->userelevationangel_down_input ?? '' }}">
                                <span class="unit-text">°</span>
                            </div>
                            <button type="button" id="popup_userelevationangel_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                        <div id="earthcentralangle_down_field" class="mb-4">
                            <label for="earthcentralangle_down_input" class="block font-medium mb-1 text-gray-700">Earth Central Angle (°):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="earthcentralangle_down_input" id="earthcentralangle_down_input"  step="0.01" class="border border-gray-300 p-3 w-full rounded-md bg-gray-50" readonly value="{{ $data->earthcentralangle_down_input ?? '' }}">
                                <span class="unit-text">°</span>
                            </div>
                            <button type="button" id="popup_earthcentralangle_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <button type="submit" name="action" value="next" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <i class=""></i> Hitung & Simpan
                </button>
                <button type="submit" name="action" value="normal_submit" id="azimuth_button" class="bg-green-600 text-white px-8 py-4 rounded-lg hover:bg-green-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-4" style="display: none;">
                    <i class=""></i> Hitung & Simpan lalu melihat hasil kalkulasi azimuth
                </button>
            </form>
        </div>
    </div>

    {{-- Popups for Formulas --}}

    {{-- New popup for general orbit explanation (no formulas) --}}
    <div id="popup_perbit" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Tentang Perhitungan Parameter Orbit</h3>
            </div>
            <div class="popup-body">
                <div class="orbit-explanation">
                    <div class="section">
                        <h4 class="section-title">Pengertian Orbit Satelit</h4>
                        <p class="section-content">
                            <strong>Orbit</strong> adalah lintasan yang dilalui satelit mengelilingi Bumi. Berdasarkan ketinggiannya, orbit satelit dibagi menjadi tiga kategori utama: 
                            <strong>Low Earth Orbit (LEO)</strong>, <strong>Medium Earth Orbit (MEO)</strong>, dan <strong>Geosynchronous Earth Orbit (GEO)</strong>. 
                            Setiap jenis orbit memiliki karakteristik dan parameter perhitungan yang berbeda sesuai dengan aplikasi dan kebutuhan misinya.
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Low Earth Orbit (LEO)</h4>
                        <div class="orbit-definition">
                            <p><strong>Definisi:</strong> Orbit rendah Bumi dengan ketinggian antara 160 km hingga 2.000 km di atas permukaan Bumi.</p>
                            <p><strong>Aplikasi:</strong> Pencitraan satelit, observasi Bumi, konstelasi internet, dan stasiun luar angkasa.</p>
                        </div>
                        
                        <h5 class="param-title">Parameter LEO:</h5>
                        <ul class="param-list">
                            <li><strong>Ketinggian (h):</strong> Jarak satelit dari permukaan Bumi (160-2.000 km)</li>
                            <li><strong>Apogee ($r_a$):</strong> Titik terjauh satelit dari pusat Bumi dalam orbit elips</li>
                            <li><strong>Perigee ($r_p$):</strong> Titik terdekat satelit dari pusat Bumi dalam orbit elips</li>
                            <li><strong>Eccentricity (e):</strong> Ukuran kelonjongan orbit (0 = lingkaran, 0 < e < 1 = elips)</li>
                            <li><strong>Sudut Inklinasi (i):</strong> Kemiringan bidang orbit terhadap ekuator Bumi</li>
                            <li><strong>Sudut Elevasi (E):</strong> Sudut vertikal dari stasiun Bumi ke satelit</li>
                            <li><strong>Slant Range (d):</strong> Jarak langsung dari stasiun Bumi ke satelit</li>
                            <li><strong>Mean Orbit Altitude (havg):</strong> Ketinggian rata-rata satelit dari permukaan Bumi</li>
                            <li><strong>Mean Orbit Radius (r_avg):</strong> Jarak rata-rata satelit dari pusat Bumi</li>
                            <li><strong>Radius Bumi ($R_e$):</strong> Radius rata-rata Bumi (6378.14 km)</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Medium Earth Orbit (MEO)</h4>
                        <div class="orbit-definition">
                            <p><strong>Definisi:</strong> Orbit menengah Bumi dengan ketinggian antara 2.000 km hingga 35.786 km di atas permukaan Bumi.</p>
                            <p><strong>Aplikasi:</strong> Sistem navigasi global (GPS, GLONASS, Galileo), dan beberapa layanan komunikasi.</p>
                        </div>
                        
                        <h5 class="param-title">Parameter MEO:</h5>
                        <ul class="param-list">
                            <li><strong>Ketinggian (h):</strong> Jarak satelit dari permukaan Bumi (2.000-35.786 km)</li>
                            <li><strong>Apogee ($r_a$):</strong> Titik terjauh satelit dari pusat Bumi dalam orbit elips</li>
                            <li><strong>Perigee ($r_p$):</strong> Titik terdekat satelit dari pusat Bumi dalam orbit elips</li>
                            <li><strong>Eccentricity (e):</strong> Ukuran kelonjongan orbit</li>
                            <li><strong>Sudut Inklinasi (i):</strong> Kemiringan bidang orbit terhadap ekuator Bumi</li>
                            <li><strong>Argument of Perigee (ω):</strong> Orientasi orbit dalam bidangnya</li>
                            <li><strong>Right Ascension ($\Omega$):</strong> Orientasi bidang orbit di ruang angkasa</li>
                            <li><strong>True Anomaly (M):</strong> Posisi sudut satelit pada waktu tertentu</li>
                            <li><strong>Sudut Elevasi (E):</strong> Sudut vertikal dari stasiun Bumi ke satelit</li>
                            <li><strong>Slant Range (d):</strong> Jarak langsung dari stasiun Bumi ke satelit</li>
                            <li><strong>Mean Orbit Altitude (havg):</strong> Ketinggian rata-rata satelit dari permukaan Bumi</li>
                            <li><strong>Mean Orbit Radius (r_avg):</strong> Jarak rata-rata satelit dari pusat Bumi</li>
                            <li><strong>Radius Bumi ($R_e$):</strong> Radius rata-rata Bumi (6378.14 km)</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Geosynchronous Earth Orbit (GEO)</h4>
                        <div class="orbit-definition">
                            <p><strong>Definisi:</strong> Orbit geostasioner pada ketinggian 35.786 km di atas ekuator Bumi. Satelit tampak diam relatif terhadap satu titik di permukaan Bumi.</p>
                            <p><strong>Aplikasi:</strong> Siaran televisi, komunikasi satelit, dan layanan internet satelit.</p>
                        </div>
                        
                        <h5 class="param-title">Parameter GEO:</h5>
                        <ul class="param-list">
                            <li><strong>Semi Major Axis ($a_{\text{GEO}}$):</strong> Jarak rata-rata dari pusat Bumi ke satelit (~42.164 km)</li>
                            <li><strong>Geostationary Altitude ($h_{\text{GEO}}$):</strong> Ketinggian nominal satelit GEO (~35.786 km)</li>
                            <li><strong>Radius Bumi ($R_e$):</strong> Radius rata-rata Bumi (6378.14 km)</li>
                            <li><strong>Latitude Stasiun Bumi ($\phi_L$):</strong> Garis lintang geografis stasiun Bumi</li>
                            <li><strong>Longitude Stasiun Bumi ($\lambda_L$):</strong> Garis bujur geografis stasiun Bumi</li>
                            <li><strong>Spacecraft Longitude ($\lambda_s$):</strong> Garis bujur satelit GEO di atas ekuator</li>
                            <li><strong>Sudut Azimuth (A):</strong> Arah horizontal antena dari stasiun Bumi ke satelit</li>
                            <li><strong>Sudut Pusat Bumi ($\alpha$):</strong> Sudut di pusat Bumi antara stasiun dan proyeksi satelit</li>
                            <li><strong>Sudut Elevasi: (E):</strong> Sudut vertikal dari stasiun Bumi ke satelit</li>
                            <li><strong>Slant Range: (d):</strong> Jarak langsung dari stasiun Bumi ke satelit</li>
                        </ul>
                        
                        <div class="subsection">
                            <h6 class="subsection-title">Parameter Uplink/Downlink (untuk GEO):</h6>
                            <ul class="param-list">
                                <li><strong>Uplink Parameters:</strong> Slant Range, Elevation Angle, Azimuth Angle, Earth Central Angle (dari pengguna ke satelit)</li>
                                <li><strong>Downlink Parameters:</strong> Slant Range, Elevation Angle, Azimuth Angle, Earth Central Angle (dari satelit ke pengguna)</li>
                            </ul>
                        </div>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Catatan Penggunaan</h4>
                        <p class="section-content">
                            Aplikasi ini akan secara otomatis menampilkan parameter input dan hasil perhitungan yang relevan 
                            berdasarkan jenis orbit yang Anda pilih. Konstanta yang digunakan: <strong>Radius Bumi ($R_e$) = 6.378 km</strong>.
                            Untuk melihat rumus dan penjelasan detail dari setiap perhitungan spesifik, silakan klik tombol "Lihat Detail" yang tersedia di samping setiap kolom hasil.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_eccentricity" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Eccentricity (e)</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$e = \frac{r_a - r_p}{r_a + r_p}$$
                    Dimana:<br>
                    $e$ = Eccentricity<br>
                    $r_a$ = Jarak apogee (titik terjauh satelit dari pusat bumi)<br>
                    $r_p$ = Jarak perigee (titik terdekat satelit dari pusat bumi)
                </div>
                <p><strong>Penjelasan:</strong><br>Eccentricity ($e$) adalah parameter yang menggambarkan seberapa elips suatu orbit. Nilai '$e$' berkisar antara 0 (untuk orbit lingkaran sempurna) hingga mendekati 1 (untuk orbit yang sangat elips).</p>
            </div>
        </div>
    </div>

    {{-- Pop-up Radius Bumi (Re) for LEO/MEO --}}
    <div id="popup_re_leomeo" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Radius Bumi ($R_e$) LEO/MEO</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$R_e = 6378.14 \text{ km (Konstanta)}$$
                </div>
                <p><strong>Penjelasan:</strong><br>Radius Bumi ($R_e$) adalah jarak rata-rata dari pusat Bumi ke permukaan Bumi. Nilai ini adalah radius khatulistiwa Bumi yang umum digunakan dalam perhitungan orbit satelit LEO (Low Earth Orbit) dan MEO (Medium Earth Orbit). Dalam perhitungan orbit, Radius Bumi sangat penting karena merupakan titik referensi dari pusat Bumi untuk semua ketinggian satelit. Ketika ketinggian satelit diukur dari permukaan Bumi (misalnya apogee dan perigee), Radius Bumi ditambahkan untuk mendapatkan jarak total dari pusat Bumi, yang merupakan parameter kunci dalam hukum gerak orbital.</p>
            </div>
        </div>
    </div>

    {{-- Pop-up Radius Bumi (Re) for GEO --}}
    <div id="popup_re_geo" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Radius Bumi ($R_e$) GEO</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$R_e = 6378.14 \text{ km (Konstanta)}$$
                </div>
                <p><strong>Penjelasan:</strong><br>Radius Bumi ($R_e$) adalah jarak rata-rata dari pusat Bumi ke permukaan Bumi. Nilai ini digunakan dalam perhitungan orbit satelit di berbagai jenis orbit, yaitu: LEO (Low Earth Orbit), MEO (Medium Earth Orbit), dan GEO (Geostationary Earth Orbit). Bumi diperlakukan sebagai pusat referensi dengan radius tetap 6378.14 km, digunakan untuk satelit yang berada pada ketinggian 35,786 km.</p>
            </div>
        </div>
    </div>

    <div id="popup_altitude" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Mean Orbit Altitude</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$\text{Altitude}_{\text{mean}} = \frac{\text{Apogee} + \text{Perigee}}{2}$$
                </div>
                <p><strong>Penjelasan:</strong><br>Mean Orbit Altitude (ketinggian orbit rata-rata) adalah rata-rata dari ketinggian apogee (titik terjauh dari Bumi) dan perigee (titik terdekat dari Bumi). Ini memberikan gambaran umum tentang ketinggian rata-rata satelit dari permukaan Bumi dalam orbit elips.</p>
            </div>
        </div>
    </div>

    <div id="popup_radius" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Mean Orbit Radius</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$\text{Orbit Radius}_{\text{mean}} = \text{Altitude}_{\text{mean}} + R_e$$
                </div>
                <p><strong>Penjelasan:</strong><br>Mean Orbit Radius (radius orbit rata-rata) adalah jarak rata-rata satelit dari pusat Bumi. Ini dihitung dengan menambahkan Radius Bumi ($R_e$) ke Mean Orbit Altitude. Ini merupakan parameter penting dalam perhitungan orbital dan hukum gerak Kepler.</p>
            </div>
        </div>
    </div>

    <div id="popup_semi_major_axis_geo" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Semi Major Axis GEO</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$a = R_e + h_{\text{GEO}}$$
                </div>
                <p><strong>Penjelasan:</strong><br>Semi Major Axis ($a$) untuk orbit Geostasioner (GEO) adalah jarak rata-rata dari pusat Bumi ke satelit. Untuk orbit GEO, nilai ini adalah konstanta karena satelit berada pada ketinggian yang relatif tetap di atas ekuator. $R_e$ adalah Radius Bumi, dan $h_{\text{GEO}}$ adalah ketinggian GEO dari permukaan Bumi.</p>
            </div>
        </div>
    </div>

    <div id="popup_geostan" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Geostationary Altitude</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$h_{\text{GEO}} = a - R_e$$
                </div>
                <p><strong>Penjelasan:</strong><br>Geostationary Altitude ($h_{\text{GEO}}$) adalah ketinggian di atas permukaan Bumi di mana sebuah satelit dapat mempertahankan posisi relatif tetap terhadap suatu titik di khatulistiwa Bumi. Ini dihitung dengan mengurangkan Radius Bumi ($R_e$) dari Semi Major Axis GEO ($a$).</p>
            </div>
        </div>
    </div>

    <div id="popup_slant_range_leomeo" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Slant Range (LEO/MEO)</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$d = R_e \\sqrt{\\left(\\frac{r}{R_e}\\right)^2 - \\cos^2(E)} - R_e \\sin(E)$$
                </div>
                <p><strong>Penjelasan:</strong><br>Slant Range ($d$) adalah jarak langsung atau jarak miring antara stasiun Bumi dan satelit. Ini merupakan faktor kunci dalam perhitungan anggaran tautan komunikasi satelit, karena kehilangan sinyal bergantung pada jarak ini. $R_e$ adalah Radius Bumi, $r$ adalah Mean Orbit Radius, dan $E$ adalah Sudut Elevasi dari stasiun Bumi ke satelit.</p>
            </div>
        </div>
    </div>

    <div id="popup_slantrangetouser_up" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Slant Range to User (Uplink GEO)</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$d = \\sqrt{r^2 + R_e^2 - 2 r R_e \\cos(\\alpha)}$$
                </div>
                <p><strong>Penjelasan:</strong><br>Slant Range to User ($d$) dalam konteks uplink GEO adalah jarak langsung antara pengguna di Bumi dan satelit Geostasioner. $r$ adalah Semi Major Axis GEO (jarak satelit dari pusat Bumi), $R_e$ adalah Radius Bumi, dan $\alpha$ adalah Earth Central Angle.</p>
            </div>
        </div>
    </div>

    <div id="popup_userelevationangel_up" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus User Elevation Angle (Uplink GEO)</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$E = \\arctan\\left(\\frac{\\cos(\\alpha) - R_e/r}{\\sin(\\alpha)}\\right)$$
                </div>
                <p><strong>Penjelasan:</strong><br>User Elevation Angle ($E$) adalah sudut vertikal dari stasiun Bumi ke satelit GEO. Ini penting untuk memastikan bahwa antena di stasiun Bumi diarahkan dengan benar ke satelit. $r$ adalah Semi Major Axis GEO, $R_e$ adalah Radius Bumi, dan $\alpha$ adalah Earth Central Angle.</p>
            </div>
        </div>
    </div>

    <div id="popup_earthcentralangle_up" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Earth Central Angle (Uplink GEO)</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$\\alpha = \\arccos(\\cos(\\phi_L) \\cos(\\Delta\\lambda))$$
                </div>
                <p><strong>Penjelasan:</strong><br>Earth Central Angle ($\alpha$) adalah sudut di pusat Bumi antara garis yang menghubungkan pusat Bumi ke stasiun Bumi dan garis yang menghubungkan pusat Bumi ke proyeksi satelit di ekuator. $\phi_L$ adalah Latitude Pengguna, dan $\Delta\\lambda$ adalah perbedaan Longitude antara pengguna dan satelit.`</p>
            </div>
        </div>
    </div>

    <div id="popup_slantrangetouser_down" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Slant Range to User (Downlink GEO)</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$d = \\sqrt{r^2 + R_e^2 - 2 r R_e \\cos(\\alpha)}$$
                </div>
                <p><strong>Penjelasan:</strong><br>Slant Range to User ($d$) dalam konteks downlink GEO adalah jarak langsung antara satelit Geostasioner dan pengguna di Bumi. $r$ adalah Semi Major Axis GEO (jarak satelit dari pusat Bumi), $R_e$ adalah Radius Bumi, dan $\alpha$ adalah Earth Central Angle.</p>
            </div>
        </div>
    </div>

    <div id="popup_userelevationangel_down" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus User Elevation Angle (Downlink GEO)</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$E = \\arctan\\left(\\frac{\\cos(\\alpha) - R_e/r}{\\sin(\\alpha)}\\right)$$
                </div>
                <p><strong>Penjelasan:</strong><br>User Elevation Angle ($E$) adalah sudut vertikal dari satelit GEO ke stasiun Bumi. Ini penting untuk memastikan bahwa antena di satelit diarahkan dengan benar ke penerima di Bumi. $r$ adalah Semi Major Axis GEO, $R_e$ adalah Radius Bumi, dan $\alpha$ adalah Earth Central Angle.`</p>
            </div>
        </div>
    </div>

    <div id="popup_earthcentralangle_down" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Earth Central Angle (Downlink GEO)</h3>
            </div>
            <div class="popup-body">
                <div class="formula">
                    $$\\alpha = \\arccos(\\cos(\\phi_L) \\cos(\\Delta\\lambda))$$
                </div>
                <p><strong>Penjelasan:</strong><br>Earth Central Angle ($\alpha$) adalah sudut di pusat Bumi antara garis yang menghubungkan pusat Bumi ke stasiun Bumi dan garis yang menghubungkan pusat Bumi ke proyeksi satelit di ekuator. $\phi_L$ adalah Latitude Pengguna, dan $\Delta\\lambda$ adalah perbedaan Longitude antara pengguna dan satelit.`</p>
            </div>
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
        function setOutput(id, value, precision = 1) {
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
            

            //Tombol untuk button azimuth
            const azimuthButton = document.getElementById('azimuth_button');
            // Reset all input values
            // resetForm();

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
                smageoField, 
                geostanField, 
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

                if (orbit === 'LEO') {
                    // Show LEO specific input fields
                    apogeeField.style.display = 'block';
                    perigeeField.style.display = 'block';
                    inklinasiField.style.display = 'block';
                    eccentricityField.style.display = 'block';
                    argumenopField.style.display = 'block';
                    raanField.style.display = 'block';
                    meananomalyField.style.display = 'block'; 
                    altitudeField.style.display = 'block';
                    radiusField.style.display = 'block';
                    reLeoMeoField.style.display = 'block';
                    
                    elevasiField.style.display = 'block'; 
                    slantRangeField.style.display = 'block';

                    // Hide GEO-specific fields
                    smageoField.style.display = 'none'; 
                    geostanField.style.display = 'none'; 
                    reeGeoField.style.display = 'none'; 
                    azimuthButton.style.display = 'none';
                    geoEarthStationLabel.style.display = 'none';
                    latitudeField.style.display = 'none';
                    longitudeField.style.display = 'none';
                    spclongField.style.display = 'none';
                    azimuthField.style.display = 'none';
                    sudutpusatbumiField.style.display = 'none';
                    uplinkLabel.style.display = 'none';
                    uplinkInputs.forEach(input => input.style.display = 'none');
                    downlinkLabel.style.display = 'none';
                    downlinkInputs.forEach(input => input.style.display = 'none');

                    // Set min/max for apogee/perigee for LEO
                    document.getElementById('apogee').min = "200";
                    document.getElementById('apogee').max = "2000";
                    document.getElementById('perigee').min = "200";
                    document.getElementById('perigee').max = "2000";
                    document.getElementById('apogee').placeholder = "Masukkan nilai antara 200-2000";
                    document.getElementById('perigee').placeholder = "Masukkan nilai antara 200-2000";

                    // Make eccentricity, altitude, radius readonly (calculated)
                    document.getElementById('eccentricity').readOnly = true; 
                    document.getElementById('altitude').readOnly = true;
                    document.getElementById('radius').readOnly = true;
                    document.getElementById('inklinasi').readOnly = false; // User can input inclination

                    // Attach event listeners for LEO specific calculations
                    document.getElementById('apogee').addEventListener('input', calculateMeanOrbitAltitude);
                    document.getElementById('perigee').addEventListener('input', calculateMeanOrbitAltitude);
                    document.getElementById('elevasi').addEventListener('input', calculateSlantRange);
                    document.getElementById('apogee').addEventListener('input', calculateEccentricity);
                    document.getElementById('perigee').addEventListener('input', calculateEccentricity);

                    calculateMeanOrbitAltitude();
                    calculateEccentricity();
                    calculateSlantRange();

                } else if (orbit === 'MEO') {
                    // Show MEO specific input fields
                    apogeeField.style.display = 'block';
                    perigeeField.style.display = 'block';
                    inklinasiField.style.display = 'block';
                    eccentricityField.style.display = 'block';
                    argumenopField.style.display = 'block';
                    raanField.style.display = 'block';
                    meananomalyField.style.display = 'block'; 
                    altitudeField.style.display = 'block';
                    radiusField.style.display = 'block';
                    reLeoMeoField.style.display = 'block';
                    
                    elevasiField.style.display = 'block'; 
                    slantRangeField.style.display = 'block';

                    // Hide GEO-specific fields
                    smageoField.style.display = 'none'; 
                    geostanField.style.display = 'none'; 
                    reeGeoField.style.display = 'none'; 
                    azimuthButton.style.display = 'none';
                    geoEarthStationLabel.style.display = 'none';
                    latitudeField.style.display = 'none';
                    longitudeField.style.display = 'none';
                    spclongField.style.display = 'none';
                    azimuthField.style.display = 'none';
                    sudutpusatbumiField.style.display = 'none';
                    uplinkLabel.style.display = 'none';
                    uplinkInputs.forEach(input => input.style.display = 'none');
                    downlinkLabel.style.display = 'none';
                    downlinkInputs.forEach(input => input.style.display = 'none');


                    // Set min/max for apogee/perigee for MEO
                    document.getElementById('apogee').min = "2001";
                    document.getElementById('apogee').max = "35786";
                    document.getElementById('perigee').min = "2001";
                    document.getElementById('perigee').max = "35786";
                    document.getElementById('apogee').placeholder = "Masukkan nilai antara 2001-35786";
                    document.getElementById('perigee').placeholder = "Masukkan nilai antara 2001-35786";

                    // Make eccentricity, altitude, radius readonly (calculated)
                    document.getElementById('eccentricity').readOnly = true;
                    document.getElementById('altitude').readOnly = true;
                    document.getElementById('radius').readOnly = true;
                    document.getElementById('inklinasi').readOnly = false; // User can input inclination

                    // Attach event listeners for MEO specific calculations
                    document.getElementById('apogee').addEventListener('input', calculateMeanOrbitAltitude);
                    document.getElementById('perigee').addEventListener('input', calculateMeanOrbitAltitude);
                    document.getElementById('elevasi').addEventListener('input', calculateSlantRange);
                    document.getElementById('apogee').addEventListener('input', calculateEccentricity);
                    document.getElementById('perigee').addEventListener('input', calculateEccentricity);

                    calculateMeanOrbitAltitude(); 
                    calculateEccentricity();
                    calculateSlantRange();

                } else if (orbit === 'GEO') {
                    // Show GEO specific read-only fields
                    reeGeoField.style.display = 'block'; 
                    smageoField.style.display = 'block'; 
                    geostanField.style.display = 'block'; 
                    azimuthButton.style.display = 'block';
                    
                    // Set GEO specific default values and make readonly
                    document.getElementById('inklinasi').value = 0;
                    document.getElementById('inklinasi').readOnly = true;
                    document.getElementById('altitude').value = 35786.019; // Default GEO altitude
                    document.getElementById('radius').value = 42164.156; // Default GEO radius
                    document.getElementById('eccentricity').value = 0; // Default GEO eccentricity
                    document.getElementById('eccentricity').readOnly = true;


                    // Hide LEO/MEO specific fields for GEO
                    apogeeField.style.display = 'none';
                    perigeeField.style.display = 'none';
                    argumenopField.style.display = 'none';
                    raanField.style.display = 'none';
                    meananomalyField.style.display = 'none'; 
                    elevasiField.style.display = 'none'; 
                    slantRangeField.style.display = 'none'; 
                    reLeoMeoField.style.display = 'none';

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

                    // Call calculations for GEO immediately after selecting it
                    calculateEarthCentralAngleUplink();
                    calculateSlantRangeToUser();
                    calculateElevationAngleUplink();
                    calculateUserAzimuthAngleUplink();

                    calculateEarthCentralAngleDownlink();
                    calculateSlantRangeToUserDownlink();
                    calculateElevationAngleDownlink();
                    calculateUserAzimuthAngleDownlink();
                }
                    
            } else {
                orbitFieldsContainer.style.display = 'none';
                azimuthButton.style.display = 'none';
            }
        }
                // Fungsi validasi untuk Apogee dan Perigee
            function validateApogeePerigee() {
            const orbitType = document.getElementById('jenis_orbit').value;
            const apogeeInput = document.getElementById('apogee');
            const perigeeInput = document.getElementById('perigee');
            const apogeeError = document.getElementById('apogee-error');
            const perigeeError = document.getElementById('perigee-error');
            const apogeeErrorText = document.getElementById('apogee-error-text');
            const perigeeErrorText = document.getElementById('perigee-error-text');
            
            if (!apogeeInput || !perigeeInput) return true;
            
            const apogeeValue = parseFloat(apogeeInput.value);
            const perigeeValue = parseFloat(perigeeInput.value);
            
            let minVal, maxVal;
            if (orbitType === 'LEO') {
                minVal = 200;
                maxVal = 2000;
            } else if (orbitType === 'MEO') {
                minVal = 2001;
                maxVal = 35786;
            } else {
                return true; 
            }

            let apogeeValid = true;
            let perigeeValid = true;
            
            // Reset styling
            apogeeInput.classList.remove('input-error', 'input-valid');
            perigeeInput.classList.remove('input-error', 'input-valid');
            if (apogeeError) apogeeError.style.display = 'none';
            if (perigeeError) perigeeError.style.display = 'none';
            
            // Validasi Apogee
            if (apogeeInput.value !== '') {
                if (isNaN(apogeeValue) || apogeeValue < minVal || apogeeValue > maxVal) {
                    apogeeValid = false;
                    apogeeInput.classList.add('input-error');
                    if (apogeeError) {
                        apogeeError.style.display = 'block';
                        if (isNaN(apogeeValue)) {
                            apogeeErrorText.textContent = 'Masukkan nilai yang valid';
                        } else if (apogeeValue < minVal) {
                            apogeeErrorText.textContent = `Nilai apogee tidak boleh kurang dari ${minVal} km`;
                        } else if (apogeeValue > maxVal) {
                            apogeeErrorText.textContent = `Nilai apogee tidak boleh lebih dari ${maxVal} km`;
                        }
                    }
                } else {
                    apogeeInput.classList.add('input-valid');
                }
            }
            
            // Validasi Perigee
            if (perigeeInput.value !== '') {
                if (isNaN(perigeeValue) || perigeeValue < minVal || perigeeValue > maxVal) {
                    perigeeValid = false;
                    perigeeInput.classList.add('input-error');
                    if (perigeeError) {
                        perigeeError.style.display = 'block';
                        if (isNaN(perigeeValue)) {
                            perigeeErrorText.textContent = 'Masukkan nilai yang valid';
                        } else if (perigeeValue < minVal) {
                            perigeeErrorText.textContent = `Nilai perigee tidak boleh kurang dari ${minVal} km`;
                        } else if (perigeeValue > maxVal) {
                            perigeeErrorText.textContent = `Nilai perigee tidak boleh lebih dari ${maxVal} km`;
                        }
                    }
                } else {
                    perigeeInput.classList.add('input-valid');
                }
            }
            
            // Validasi bahwa perigee tidak boleh lebih besar dari apogee
            if (apogeeValid && perigeeValid && apogeeInput.value !== '' && perigeeInput.value !== '') {
                if (perigeeValue > apogeeValue) { 
                    perigeeValid = false;
                    perigeeInput.classList.remove('input-valid');
                    perigeeInput.classList.add('input-error');
                    if (perigeeError) {
                        perigeeError.style.display = 'block';
                        perigeeErrorText.textContent = 'Nilai perigee tidak boleh lebih besar dari apogee';
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
                document.getElementById('altitude').value = meanAltitude.toFixed(1);
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
            let radiusBumi = 6378.14; // Default for LEO/MEO

            if (meanOrbitAltitude > 0 && radiusBumi > 0) {
                const meanOrbitRadius = meanOrbitAltitude + radiusBumi;
                document.getElementById('radius').value = meanOrbitRadius.toFixed(1);
            } else {
                document.getElementById('radius').value = '';
            }
        }

        // Fungsi untuk menghitung Slant Range (LEO/MEO)
        function calculateSlantRange() {
            const orbitType = document.getElementById('jenis_orbit').value;
            if (orbitType === 'GEO') return; // Only for LEO/MEO

            let radiusBumi = parseFloat(document.getElementById('re_leomeo').value) || 6378.14; // Use the specific Re for LEO/MEO
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
                const re = parseFloat(document.getElementById('re_leomeo').value) || 6378.14;

                if (apogee > 0 && perigee > 0) {
                    const ra = apogee + re; // Jarak apogee dari pusat Bumi
                    const rp = perigee + re; // Jarak perigee dari pusat Bumi
                    const numerator = ra - rp;
                    const denominator = ra + rp;

                    if (denominator !== 0) {
                        const eccentricity = numerator / denominator;
                        document.getElementById('eccentricity').value = eccentricity.toFixed(3);
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
            const radiusBumi = parseFloat(document.getElementById("re_geo").value) || 6378.14;
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
            document.getElementById('slantrangetouser_up_input').value = slantRangeToUser.toFixed(1);

            // --- SIMPAN KE LOCAL STORAGE UNTUK GEO UPLINK ---
            localStorage.setItem('lastSelectedOrbit', 'GEO');
            localStorage.setItem('slantRangeGEOUplink', slantRangeToUser.toFixed(2));
        }

        function calculateElevationAngleUplink() {
            const earthCentralAngle = parseFloat(document.getElementById('earthcentralangle_up_input').value); // No || 0 here
            const re = parseFloat(document.getElementById('re_geo').value) || 6378.14;
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
            document.getElementById('userelevationangel_up_input').value = elevationAngle.toFixed(1);
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

            document.getElementById('userazimuthangle_up_input').value = azimuthAngleDeg.toFixed(1);
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
            const radiusBumi = parseFloat(document.getElementById("re_geo").value) || 6378.14;
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
            document.getElementById('slantrangetouser_down_input').value = slantRangeToUserDownlink.toFixed(1);

            // --- SIMPAN KE LOCAL STORAGE UNTUK GEO DOWNLINK ---
            localStorage.setItem('lastSelectedOrbit', 'GEO');
            localStorage.setItem('slantRangeGEODownlink', slantRangeToUserDownlink.toFixed(2));
        }

        function calculateElevationAngleDownlink() {
            const earthCentralAngle = parseFloat(document.getElementById('earthcentralangle_down_input').value); // No || 0 here
            const re = parseFloat(document.getElementById('re_geo').value) || 6378.14;
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
            document.getElementById('userelevationangel_down_input').value = elevationAngle.toFixed(1);
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

            document.getElementById('userazimuthangle_down_input').value = azimuthAngleDeg.toFixed(1);
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
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            document.getElementById(id).style.display = "flex";
            // Ensure MathJax re-renders content when popup opens
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        document.querySelectorAll('.close-popup-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            };
        });

        // Helper to update popup content (rumus dan nilai)
        // This helper is for popups that have a <p class="formula"> and then another <p> for inputs/results
        function updatePopupContent(popupId, formulaText, explanationText) {
            const popup = document.getElementById(popupId);
            if (!popup) return;
            
            const formulaElement = popup.querySelector('.formula');
            const explanationElement = popup.querySelector('.popup-body > p:not(.formula)'); // Select the existing explanation paragraph

            if (formulaElement) formulaElement.innerHTML = formulaText;
            if (explanationElement) explanationElement.innerHTML = `<strong>Penjelasan:</strong><br>${explanationText}`;
             // Ensure MathJax re-renders new content
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        // --- Popup Button Click Handlers ---

        //Penjelasan Perhitungan Orbit Popup (Updated & Fixed)
        document.getElementById('info_perbit_btn').onclick = () => {
            const popup = document.getElementById('popup_perbit');
            if (!popup) return;

            // Clear previous content to ensure no duplication on re-open
            const popupBody = popup.querySelector('.popup-body');
            if (popupBody) {
                popupBody.innerHTML = `
                    <div class="orbit-explanation">
                        <div class="section">
                            <h4 class="section-title">Pengertian Orbit Satelit</h4>
                            <p class="section-content">
                                <strong>Orbit</strong> adalah lintasan yang dilalui satelit mengelilingi Bumi. Berdasarkan ketinggiannya, orbit satelit dibagi menjadi tiga kategori utama: 
                                <strong>Low Earth Orbit (LEO)</strong>, <strong>Medium Earth Orbit (MEO)</strong>, dan <strong>Geosynchronous Earth Orbit (GEO)</strong>. 
                                Setiap jenis orbit memiliki karakteristik dan parameter perhitungan yang berbeda sesuai dengan aplikasi dan kebutuhan misinya.
                            </p>
                        </div>

                        <div class="section">
                            <h4 class="section-title">Low Earth Orbit (LEO)</h4>
                            <div class="orbit-definition">
                                <p><strong>Definisi:</strong> Orbit rendah Bumi dengan ketinggian antara 160 km hingga 2.000 km di atas permukaan Bumi.</p>
                                <p><strong>Aplikasi:</strong> Pencitraan satelit, observasi Bumi, konstelasi internet, dan stasiun luar angkasa.</p>
                            </div>
                            
                            <h5 class="param-title">Parameter LEO:</h5>
                            <ul class="param-list">
                                <li><strong>Ketinggian (h):</strong> Jarak satelit dari permukaan Bumi (160-2.000 km)</li>
                                <li><strong>Apogee ($r_a$):</strong> Titik terjauh satelit dari pusat Bumi dalam orbit elips</li>
                                <li><strong>Perigee ($r_p$):</strong> Titik terdekat satelit dari pusat Bumi dalam orbit elips</li>
                                <li><strong>Eccentricity (e):</strong> Ukuran kelonjongan orbit (0 = lingkaran, 0 < e < 1 = elips)</li>
                                <li><strong>Sudut Inklinasi (i):</strong> Kemiringan bidang orbit terhadap ekuator Bumi</li>
                                <li><strong>Sudut Elevasi (E):</strong> Sudut vertikal dari stasiun Bumi ke satelit</li>
                                <li><strong>Slant Range (d):</strong> Jarak langsung dari stasiun Bumi ke satelit</li>
                                <li><strong>Mean Orbit Altitude (havg):</strong> Ketinggian rata-rata satelit dari permukaan Bumi</li>
                                <li><strong>Mean Orbit Radius (r_avg):</strong> Jarak rata-rata satelit dari pusat Bumi</li>
                                <li><strong>Radius Bumi ($R_e$):</strong> Radius rata-rata Bumi (6378.14 km)</li>
                            </ul>
                        </div>

                        <div class="section">
                            <h4 class="section-title">Medium Earth Orbit (MEO)</h4>
                            <div class="orbit-definition">
                                <p><strong>Definisi:</strong> Orbit menengah Bumi dengan ketinggian antara 2.000 km hingga 35.786 km di atas permukaan Bumi.</p>
                                <p><strong>Aplikasi:</strong> Sistem navigasi global (GPS, GLONASS, Galileo), dan beberapa layanan komunikasi.</p>
                            </div>
                            
                            <h5 class="param-title">Parameter MEO:</h5>
                            <ul class="param-list">
                                <li><strong>Ketinggian (h):</strong> Jarak satelit dari permukaan Bumi (2.000-35.786 km)</li>
                                <li><strong>Apogee ($r_a$):</strong> Titik terjauh satelit dari pusat Bumi dalam orbit elips</li>
                                <li><strong>Perigee ($r_p$):</strong> Titik terdekat satelit dari pusat Bumi dalam orbit elips</li>
                                <li><strong>Eccentricity (e):</strong> Ukuran kelonjongan orbit</li>
                                <li><strong>Sudut Inklinasi (i):</strong> Kemiringan bidang orbit terhadap ekuator Bumi</li>
                                <li><strong>Argument of Perigee (ω):</strong> Orientasi orbit dalam bidangnya</li>
                                <li><strong>Right Ascension ($\Omega$):</strong> Orientasi bidang orbit di ruang angkasa</li>
                                <li><strong>True Anomaly (M):</strong> Posisi sudut satelit pada waktu tertentu</li>
                                <li><strong>Sudut Elevasi (E):</strong> Sudut vertikal dari stasiun Bumi ke satelit</li>
                                <li><strong>Slant Range (d):</strong> Jarak langsung dari stasiun Bumi ke satelit</li>
                                <li><strong>Mean Orbit Altitude (havg):</strong> Ketinggian rata-rata satelit dari permukaan Bumi</li>
                                <li><strong>Mean Orbit Radius (r_avg):</strong> Jarak rata-rata satelit dari pusat Bumi</li>
                                <li><strong>Radius Bumi ($R_e$):</strong> Radius rata-rata Bumi (6378.14 km)</li>
                            </ul>
                        </div>

                        <div class="section">
                            <h4 class="section-title">Geosynchronous Earth Orbit (GEO)</h4>
                            <div class="orbit-definition">
                                <p><strong>Definisi:</strong> Orbit geostasioner pada ketinggian 35.786 km di atas ekuator Bumi. Satelit tampak diam relatif terhadap satu titik di permukaan Bumi.</p>
                                <p><strong>Aplikasi:</strong> Siaran televisi, komunikasi satelit, dan layanan internet satelit.</p>
                            </div>
                            
                            <h5 class="param-title">Parameter GEO:</h5>
                            <ul class="param-list">
                                <li><strong>Semi Major Axis ($a_{\text{GEO}}$):</strong> Jarak rata-rata dari pusat Bumi ke satelit (~42.164 km)</li>
                                <li><strong>Geostationary Altitude ($h_{\text{GEO}}$):</strong> Ketinggian nominal satelit GEO (~35.786 km)</li>
                                <li><strong>Radius Bumi ($R_e$):</strong> Radius rata-rata Bumi (6378.14 km)</li>
                                <li><strong>Latitude Stasiun Bumi ($\phi_L$):</strong> Garis lintang geografis stasiun Bumi</li>
                                <li><strong>Longitude Stasiun Bumi ($\lambda_L$):</strong> Garis bujur geografis stasiun Bumi</li>
                                <li><strong>Spacecraft Longitude ($\lambda_s$):</strong> Garis bujur satelit GEO di atas ekuator</li>
                                <li><strong>Sudut Azimuth (A):</strong> Arah horizontal antena dari stasiun Bumi ke satelit</li>
                                <li><strong>Sudut Pusat Bumi ($\alpha$):</strong> Sudut di pusat Bumi antara stasiun dan proyeksi satelit</li>
                                <li><strong>Sudut Elevasi: (E):</strong> Sudut vertikal dari stasiun Bumi ke satelit</li>
                                <li><strong>Slant Range: (d):</strong> Jarak langsung dari stasiun Bumi ke satelit</li>
                            </ul>
                            
                            <div class="subsection">
                                <h6 class="subsection-title">Parameter Uplink/Downlink (untuk GEO):</h6>
                                <ul class="param-list">
                                    <li><strong>Uplink Parameters:</strong> Slant Range, Elevation Angle, Azimuth Angle, Earth Central Angle (dari pengguna ke satelit)</li>
                                    <li><strong>Downlink Parameters:</strong> Slant Range, Elevation Angle, Azimuth Angle, Earth Central Angle (dari satelit ke pengguna)</li>
                                </ul>
                            </div>
                        </div>

                        <div class="section">
                            <h4 class="section-title">Catatan Penggunaan</h4>
                            <p class="section-content">
                                Aplikasi ini akan secara otomatis menampilkan parameter input dan hasil perhitungan yang relevan 
                                berdasarkan jenis orbit yang Anda pilih. Konstanta yang digunakan: <strong>Radius Bumi ($R_e$) = 6.378 km</strong>.
                                Untuk melihat rumus dan penjelasan detail dari setiap perhitungan spesifik, silakan klik tombol "Lihat Detail" yang tersedia di samping setiap kolom hasil.
                            </p>
                        </div>
                    </div>
                `;
            }
            openPopup('popup_perbit');
        };

        // Eccentricity Popup
        document.getElementById('popup_eccentricity_btn').onclick = () => {
            updatePopupContent('popup_eccentricity',
                `$$e = \\frac{r_a - r_p}{r_a + r_p}$$
                Dimana:<br>
                $e$ = Eccentricity<br>
                $r_a$ = Jarak apogee (titik terjauh satelit dari pusat bumi)<br>
                $r_p$ = Jarak perigee (titik terdekat satelit dari pusat bumi)`,
                `Eccentricity ($e$) adalah parameter yang menggambarkan seberapa elips suatu orbit. Nilai '$e$' berkisar antara 0 (untuk orbit lingkaran sempurna) hingga mendekati 1 (untuk orbit yang sangat elips).`
            );
            openPopup('popup_eccentricity');
        };

        //Radius Bumi GEO 
        document.getElementById('popup_re_geo_btn').onclick = () => {
            updatePopupContent('popup_re_geo', 
                `$$R_e = 6378.14 \\text{ km (Konstanta)}$$`,
                `Radius Bumi ($R_e$) adalah jarak rata-rata dari pusat Bumi ke permukaan Bumi. Nilai ini digunakan dalam perhitungan orbit satelit di berbagai jenis orbit, yaitu: LEO (Low Earth Orbit), MEO (Medium Earth Orbit), dan GEO (Geostationary Earth Orbit). Bumi diperlakukan sebagai pusat referensi dengan radius tetap 6378.14 km, digunakan untuk satelit yang berada pada ketinggian 35,786 km.`
            );
            openPopup('popup_re_geo');
        };

        // Mean Orbit Altitude Popup
        document.getElementById('popup_altitude_btn').onclick = () => {
            updatePopupContent('popup_altitude',
                `$$\\text{Altitude}_{\\text{mean}} = \\frac{\\text{Apogee} + \\text{Perigee}}{2}$$`,
                `Mean Orbit Altitude (ketinggian orbit rata-rata) adalah rata-rata dari ketinggian apogee (titik terjauh dari Bumi) dan perigee (titik terdekat dari Bumi). Ini memberikan gambaran umum tentang ketinggian rata-rata satelit dari permukaan Bumi dalam orbit elips.`
            );
            openPopup('popup_altitude');
        };

        // Mean Orbit Radius Popup
        document.getElementById('popup_radius_btn').onclick = () => {
            updatePopupContent('popup_radius',
                `$$\\text{Orbit Radius}_{\\text{mean}} = \\text{Altitude}_{\\text{mean}} + R_e$$`,
                `Mean Orbit Radius (radius orbit rata-rata) adalah jarak rata-rata satelit dari pusat Bumi. Ini dihitung dengan menambahkan Radius Bumi ($R_e$) ke Mean Orbit Altitude. Ini merupakan parameter penting dalam perhitungan orbital dan hukum gerak Kepler.`
            );
            openPopup('popup_radius');
        };

        // Semi Major Axis GEO Popup
        document.getElementById('popup_semi_major_axis_geo_btn').onclick = () => {
            updatePopupContent('popup_semi_major_axis_geo',
                `$$a = R_e + h_{\\text{GEO}}$$`,
                `Semi Major Axis ($a$) untuk orbit Geostasioner (GEO) adalah jarak rata-rata dari pusat Bumi ke satelit. Untuk orbit GEO, nilai ini adalah konstanta karena satelit berada pada ketinggian yang relatif tetap di atas ekuator. $R_e$ adalah Radius Bumi, dan $h_{\\text{GEO}}$ adalah ketinggian GEO dari permukaan Bumi.`
            );
            openPopup('popup_semi_major_axis_geo');
        };

        // NEWLY ADDED: Geostationary Altitude Popup
        document.getElementById('popup_geostan_btn').onclick = () => {
            updatePopupContent('popup_geostan',
                `$$h_{\\text{GEO}} = a - R_e$$`,
                `Geostationary Altitude ($h_{\\text{GEO}}$) adalah ketinggian di atas permukaan Bumi di mana sebuah satelit dapat mempertahankan posisi relatif tetap terhadap suatu titik di khatulistiwa Bumi. Ini dihitung dengan mengurangkan Radius Bumi ($R_e$) dari Semi Major Axis GEO ($a$).`
            );
            openPopup('popup_geostan');
        };


        // Radius Bumi (Re_leomeo) Popup
        document.getElementById('popup_re_leomeo_btn').onclick = () => {
            updatePopupContent('popup_re_leomeo', 
                `$$R_e = 6378.14 \\text{ km (Konstanta)}$$`,
                `Radius Bumi ($R_e$) adalah jarak rata-rata dari pusat Bumi ke permukaan Bumi. Nilai ini adalah radius khatulistiwa Bumi yang umum digunakan dalam perhitungan orbit satelit LEO (Low Earth Orbit) dan MEO (Medium Earth Orbit). Dalam perhitungan orbit, Radius Bumi sangat penting karena merupakan titik referensi dari pusat Bumi untuk semua ketinggian satelit. Ketika ketinggian satelit diukur dari permukaan Bumi (misalnya apogee dan perigee), Radius Bumi ditambahkan untuk mendapatkan jarak total dari pusat Bumi, yang merupakan parameter kunci dalam hukum gerak orbital.`
            );
            openPopup('popup_re_leomeo');
        };

        // Slant Range (LEO/MEO) Popup
        document.getElementById('popup_slant_range_leomeo_btn').onclick = () => {
            updatePopupContent('popup_slant_range_leomeo',
                `$$d = R_e \\sqrt{\\left(\\frac{r}{R_e}\\right)^2 - \\cos^2(E)} - R_e \\sin(E)$$`,
                `Slant Range ($d$) adalah jarak langsung atau jarak miring antara stasiun Bumi dan satelit. Ini merupakan faktor kunci dalam perhitungan anggaran tautan komunikasi satelit, karena kehilangan sinyal bergantung pada jarak ini. $R_e$ adalah Radius Bumi, $r$ adalah Mean Orbit Radius, dan $E$ adalah Sudut Elevasi dari stasiun Bumi ke satelit.`
            );
            openPopup('popup_slant_range_leomeo');
        };

        // Slant Range to User (Uplink GEO) Popup
        document.getElementById('popup_slantrangetouser_up_btn').onclick = () => {
            updatePopupContent('popup_slantrangetouser_up',
                `$$d = \\sqrt{r^2 + R_e^2 - 2 r R_e \\cos(\\alpha)}$$`,
                `Slant Range to User ($d$) dalam konteks uplink GEO adalah jarak langsung antara pengguna di Bumi dan satelit Geostasioner. $r$ adalah Semi Major Axis GEO (jarak satelit dari pusat Bumi), $R_e$ adalah Radius Bumi, dan $\alpha$ adalah Earth Central Angle.`
            );
            openPopup('popup_slantrangetouser_up');
        };

        // User Elevation Angle (Uplink GEO) Popup
        document.getElementById('popup_userelevationangel_up_btn').onclick = () => {
            updatePopupContent('popup_userelevationangel_up',
                `$$E = \\arctan\\left(\\frac{\\cos(\\alpha) - R_e/r}{\\sin(\\alpha)}\\right)$$`,
                `User Elevation Angle ($E$) adalah sudut vertikal dari stasiun Bumi ke satelit GEO. Ini penting untuk memastikan bahwa antena di stasiun Bumi diarahkan dengan benar ke satelit. $r$ adalah Semi Major Axis GEO, $R_e$ adalah Radius Bumi, dan $\alpha$ adalah Earth Central Angle.`
            );
            openPopup('popup_userelevationangel_up');
        };

        // Earth Central Angle (Uplink GEO) Popup
        document.getElementById('popup_earthcentralangle_up_btn').onclick = () => {
            updatePopupContent('popup_earthcentralangle_up',
                `$$\\alpha = \\arccos(\\cos(\\phi_L) \\cos(\\Delta\\lambda))$$`,
                `Earth Central Angle ($\alpha$) adalah sudut di pusat Bumi antara garis yang menghubungkan pusat Bumi ke stasiun Bumi dan garis yang menghubungkan pusat Bumi ke proyeksi satelit di ekuator. $\phi_L$ adalah Latitude Pengguna, dan $\Delta\\lambda$ adalah perbedaan Longitude antara pengguna dan satelit.`
            );
            openPopup('popup_earthcentralangle_up');
        };

        // Slant Range to User (Downlink GEO) Popup
        document.getElementById('popup_slantrangetouser_down_btn').onclick = () => {
            updatePopupContent('popup_slantrangetouser_down',
                `$$d = \\sqrt{r^2 + R_e^2 - 2 r R_e \\cos(\\alpha)}$$`,
                `Slant Range to User ($d$) dalam konteks downlink GEO adalah jarak langsung antara satelit Geostasioner dan pengguna di Bumi. $r$ adalah Semi Major Axis GEO (jarak satelit dari pusat Bumi), $R_e$ adalah Radius Bumi, dan $\alpha$ adalah Earth Central Angle.`
            );
            openPopup('popup_slantrangetouser_down');
        };

        // User Elevation Angle (Downlink GEO) Popup
        document.getElementById('popup_userelevationangel_down_btn').onclick = () => {
            updatePopupContent('popup_userelevationangel_down',
                `$$E = \\arctan\\left(\\frac{\\cos(\\alpha) - R_e/r}{\\sin(\\alpha)}\\right)$$`,
                `User Elevation Angle ($E$) adalah sudut vertikal dari satelit GEO ke stasiun Bumi. Ini penting untuk memastikan bahwa antena di satelit diarahkan dengan benar ke penerima di Bumi. $r$ adalah Semi Major Axis GEO, $R_e$ adalah Radius Bumi, dan $\alpha$ adalah Earth Central Angle.`
            );
            openPopup('popup_userelevationangel_down');
        };

        // Earth Central Angle (Downlink GEO) Popup
        document.getElementById('popup_earthcentralangle_down_btn').onclick = () => {
            updatePopupContent('popup_earthcentralangle_down',
                `$$\\alpha = \\arccos(\\cos(\\phi_L) \\cos(\\Delta\\lambda))$$`,
                `Earth Central Angle ($\alpha$) adalah sudut di pusat Bumi antara garis yang menghubungkan pusat Bumi ke stasiun Bumi dan garis yang menghubungkan pusat Bumi ke proyeksi satelit di ekuator. $\phi_L$ adalah Latitude Pengguna, dan $\Delta\\lambda$ adalah perbedaan Longitude antara pengguna dan satelit.`
            );
            openPopup('popup_earthcentralangle_down');
        };
    </script>

    {{-- Script for MathJax --}}
    <script>
        // Konfigurasi MathJax (sesuaikan jika perlu)
        window.MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']], // Untuk rumus inline seperti $x^2$
                displayMath: [['$$', '$$'], ['\\[', '\\]']], // Untuk rumus blok seperti $$E=mc^2$$
                processEscapes: true, // Memungkinkan \$ untuk menampilkan tanda dolar literal
                tags: "ams" // Untuk penomoran persamaan (opsional)
            },
            options: {
                ignoreHtmlClass: "tex2jax_ignore", // Kelas yang diabaikan untuk pemrosesan matematika
                processHtmlClass: "tex2jax_process" // Kelas yang secara spesifik diproses untuk matematika
            },
            loader: {
                load: ['[tex]/ams'] // Memuat ekstensi AMS math
            }
        };
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

</x-layout>