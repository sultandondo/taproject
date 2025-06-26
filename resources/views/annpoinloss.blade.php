<x-layout>
    <x-slot:title>Antenna Pointing Loss</x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
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
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
        .popup-content {
            position: relative;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            display: flex; /* Use flexbox for header and body layout */
            flex-direction: column; /* Stack header and body vertically */
            animation: fadeInScale 0.3s ease-out;
            box-sizing: border-box; /* Include padding in element's total width and height */
        }
        .popup-header {
            padding: 20px 30px 10px; /* Padding for header */
            border-bottom: 1px solid #eee; /* Bottom border for header */
            position: relative; /* Important for absolute positioning of close button */
            flex-shrink: 0; /* Prevent header from shrinking */
        }

        .popup-header h3 {
            margin-top: 0; /* Remove top margin */
            color: #2c3e50;
            padding-bottom: 0; /* Remove default padding-bottom from h3 */
        }

        .close-popup-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: color 0.2s ease;
            z-index: 1001; /* Ensure button is above popup content */
            background-color: white; /* Give background to the close button */
            border-radius: 50%; /* Make button circular */
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Add subtle shadow */
        }

        .close-popup-btn:hover {
            color: #000;
        }

        .popup-body {
            padding: 20px 30px 30px; /* Padding for the body content */
            overflow-y: auto; /* This makes the body content scrollable */
            flex-grow: 1; /* Allow the body to take up remaining space */
        }

        .formula {
            background-color: #f5f5f5;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
            margin: 15px 0;
            font-family: 'Cambria Math', 'Times New Roman', serif;
            overflow-wrap: break-word; /* Ensure long formulas wrap */
        }

        .popup-content p {
            margin: 8px 0;
            line-height: 1.5;
            color: #374151;
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        
        /* Specific styles for new layout */
        .input-group > div {
            margin-bottom: 1rem;
        }
        .input-group > div:last-child {
            margin-bottom: 0;
        }
        
        input[type="number"],
        input[type="text"],
        select { /* Added select for consistent height */
            height: 48px;
            padding-right: 0.75rem;
        }

        .input-with-unit-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .unit-text {
            color: #4B5563;
            font-size: 0.875rem;
            font-weight: 500;
            min-width: 40px;
            text-align: left;
        }

        /* Styles for the new explanation popup content */
        .explanation-content {
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
            color: #4A5568;
        }
        .explanation-content .section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }
        .explanation-content .section:last-child {
            border-bottom: none;
        }
        .explanation-content .section-title {
            color: #2C5282;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border-left: 5px solid #4299E1;
            padding-left: 1rem;
        }
        .explanation-content .section-content {
            text-align: justify;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }
        .explanation-content .param-title {
            color: #2D3748;
            font-size: 1rem;
            font-weight: 600;
            margin: 1.25rem 0 0.5rem 0;
        }
        .explanation-content .param-list {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }
        .explanation-content .param-list li {
            margin-bottom: 0.4rem;
            line-height: 1.6;
        }
    </style>

    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="text-blue-600"></i> Perhitungan Parameter Antenna Pointing Loss
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Masukkan parameter Antenna Pointing Loss untuk Uplink dan Downlink.
            </p>

            {{-- "Apa itu Perhitungan Antenna Pointing Loss?" button --}}
            <div class="mb-6 text-right animate__animated animate__fadeInUp">
                <button type="button" id="info_pointing_loss_general_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">
                    Apa itu Perhitungan Antenna Pointing Loss? <i class="fas fa-info-circle ml-1"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('annpoinloss.store', ['id' => $dataId]) }}" id="antennaForm_poin">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                {{-- Uplink Antenna Sistem (Gabungan dalam satu kolom biru) --}}
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                    <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Uplink Antenna Sistem</h2>
                    
                    {{-- Ground Station (Uplink) --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700 text-lg">Ground Station (Uplink):</label>
                    </div>

                    <div class="mb-6">
                        <label for="jenis_polarizationgrounds_up_poin" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                        <select name="jenis_polarizationgrounds_up_poin" id="jenis_polarizationgrounds_up_poin" onchange="handlePolarizationChange('grounds', 'up')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="RHCP">RHCP</option>
                            <option value="LHCP">LHCP</option>
                            <option value="Linear">Linear</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Frekuensi Uplink (MHz):</label>
                        <div class="input-with-unit-wrapper">
                             <input type="number" name="frequency_upgrounds" id="frequency_upgrounds" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->frekuensi ?? '' }}" step="any" value="{{ $data->frekuensi ?? '' }}" readonly>
                            <span class="unit-text">MHz</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ) (m):</label>
                        <div class="input-with-unit-wrapper">
                             <input type="number" name="frequency_upgrounds" id="frequency_upgrounds" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->panjang_gelombang ?? '' }}" step="any" value="{{ $data->panjang_gelombang ?? '' }}" readonly>
                            <span class="unit-text">m</span>
                        </div>
                        <button type="button" onclick="showWavelengthDetail('up')" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Gain Antena (dBiC):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="gain_upgrounds_poin" id="gain_upgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain antena dari perhitungan sebelumnya" required>
                            <span class="unit-text">dBiC</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="beamwidth_upgrounds_poin" id="beamwidth_upgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dari perhitungan sebelumnya" required>
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Estimated Pointing Error (θ1) (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="estimedpointingerror_upgrounds_θ1_poin" id="estimedpointingerror_upgrounds_θ1_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan estimasi kesalahan pointing dalam derajat" required>
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="annrolloff_upgrounds_poin" class="block font-medium mb-1 text-gray-700">Antenna Roll-Off (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="annrolloff_upgrounds_poin" id="annrolloff_upgrounds_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                            <span class="unit-text">°</span>
                        </div>
                        <button type="button" onclick="showRollOffDetail('upgrounds')" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                    </div>

                    <div class="mb-4">
                        <label for="approxannpoinloss_upgrounds_poin" class="block font-medium mb-1 text-gray-700">Approx. Antenna Pointing Loss (dB):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="approxannpoinloss_upgrounds_poin" id="approxannpoinloss_upgrounds_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                            <span class="unit-text">dB</span>
                        </div>
                        <button type="button" onclick="showPointingLossDetail('upgrounds')" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                    </div>

                    {{-- Spacecraft (Uplink) --}}
                    <div class="mb-4 mt-8"> {{-- Added mt-8 for spacing between sub-sections --}}
                        <label class="block font-medium mb-1 text-gray-700 text-lg">Spacecraft (Uplink):</label>
                    </div>

                    <div class="mb-6">
                        <label for="jenis_polarizationspacecraft_up_poin" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                        <select name="jenis_polarizationspacecraft_up_poin" id="jenis_polarizationspacecraft_up_poin" onchange="handlePolarizationChange('spacecraft', 'up')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="RHCP">RHCP</option>
                            <option value="LHCP">LHCP</option>
                            <option value="Linear">Linear</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Gain Antena (dBi):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="gain_upspacecraft_poin" id="gain_upspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain antena dari perhitungan sebelumnya" required>
                            <span class="unit-text">dBi</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="beamwidth_upspacecraft_poin" id="beamwidth_upspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dari perhitungan sebelumnya" required>
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Angle between S/C antenna symmetry axis and vector from S/C to gnd. station (θ2) (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="upspacecraft_θ2_poin" id="upspacecraft_θ2_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan sudut dalam derajat" required>
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Calculation Formulas (dB):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="calculation_formulas_upspacecraft_poin" id="calculation_formulas_upspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan nilai pointing loss manual" required>
                            <span class="unit-text">dB</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="approxannpoinloss_upspacecraft_poin" class="block font-medium mb-1 text-gray-700">Approx. Antenna Pointing Loss (dB):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="approxannpoinloss_upspacecraft_poin" id="approxannpoinloss_upspacecraft_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                            <span class="unit-text">dB</span>
                        </div>
                        <button type="button" onclick="showPointingLossDetail('upspacecraft')" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                    </div>
                </div> {{-- End of Uplink Antenna Sistem blue box --}}

                <div id="polarization_warning_up_poin" class="mb-6" style="display: none;">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Peringatan Ketidaksesuaian Polarisasi (Uplink)</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p id="polarization_warning_text_up_poin"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Downlink Antenna Sistem --}}
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                    <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Downlink Antenna Sistem</h2>
                    
                    {{-- Spacecraft (Downlink) Section --}}
                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700 text-lg">Spacecraft (Downlink):</label>
                    </div>

                    <div class="mb-6">
                        <label for="jenis_polarizationspacecraft_down_poin" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                        <select name="jenis_polarizationspacecraft_down_poin" id="jenis_polarizationspacecraft_down_poin" onchange="handlePolarizationChange('spacecraft', 'down')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="RHCP">RHCP</option>
                            <option value="LHCP">LHCP</option>
                            <option value="Linear">Linear</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Gain Antena (dBiC):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="gain_downspacecraft_poin" id="gain_downspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain antena dari perhitungan sebelumnya" required>
                            <span class="unit-text">dBiC</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="beamwidth_downspacecraft_poin" id="beamwidth_downspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dari perhitungan sebelumnya" required>
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Angle between S/C antenna symmetry axis and vector from S/C to gnd. station (θ3) (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="downspacecraft_θ3_poin" id="downspacecraft_θ3_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan sudut dalam derajat" required>
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Calculation Formulas (dB):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="calculation_formulas_downspacecraft_poin" id="calculation_formulas_downspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan nilai pointing loss manual" required>
                            <span class="unit-text">dB</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="approxannpoinloss_downspacecraft_poin" class="block font-medium mb-1 text-gray-700">Approx. Antenna Pointing Loss (dB):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="approxannpoinloss_downspacecraft_poin" id="approxannpoinloss_downspacecraft_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                            <span class="unit-text">dB</span>
                        </div>
                        <button type="button" onclick="showPointingLossDetail('downspacecraft')" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                    </div>

                    {{-- Ground Station (Downlink) Section --}}
                    <div class="mb-4 mt-8"> {{-- Added mt-8 for spacing --}}
                        <label class="block font-medium mb-1 text-gray-700 text-lg">Ground Station (Downlink):</label>
                    </div>

                    <div class="mb-6">
                        <label for="jenis_polarizationgrounds_down_poin" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                        <select name="jenis_polarizationgrounds_down_poin" id="jenis_polarizationgrounds_down_poin" onchange="handlePolarizationChange('grounds', 'down')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="RHCP">RHCP</option>
                            <option value="LHCP">LHCP</option>
                            <option value="Linear">Linear</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Frekuensi Downlink (MHz):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="frequency_upgrounds" id="frequency_upgrounds" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->frekuensi_downlink ?? '' }}" step="any" value="{{ $data->frekuensi_downlink ?? '' }}" readonly>
                            <span class="unit-text">MHz</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ) (m):</label>
                        <div class="input-with-unit-wrapper">
                             <input type="number" name="frequency_upgrounds" id="frequency_upgrounds" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->panjang_gelombang_downlink ?? '' }}" step="any" value="{{ $data->panjang_gelombang_downlink ?? '' }}" readonly>
                            <span class="unit-text">m</span>
                        </div>
                        <button type="button" onclick="showWavelengthDetail('down')" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Gain Antena (dBiC):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="gain_downgrounds_poin" id="gain_downgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain antena dari perhitungan sebelumnya" required>
                            <span class="unit-text">dBiC</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="beamwidth_downgrounds_poin" id="beamwidth_downgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dari perhitungan sebelumnya" required>
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Estimated Pointing Error (θ4) (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="number" name="estimedpointingerror_downgrounds_θ4_poin" id="estimedpointingerror_downgrounds_θ4_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan estimasi kesalahan pointing dalam derajat" required>
                            <span class="unit-text">°</span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="annrolloff_downgrounds_poin" class="block font-medium mb-1 text-gray-700">Antenna Roll-Off (°):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="annrolloff_downgrounds_poin" id="annrolloff_downgrounds_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                            <span class="unit-text">°</span>
                        </div>
                        <button type="button" onclick="showRollOffDetail('downgrounds')" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                    </div>

                    <div class="mb-4">
                        <label for="approxannpoinloss_downgrounds_poin" class="block font-medium mb-1 text-gray-700">Approx. Antenna Pointing Loss (dB):</label>
                        <div class="input-with-unit-wrapper">
                            <input type="text" name="approxannpoinloss_downgrounds_poin" id="approxannpoinloss_downgrounds_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly>
                            <span class="unit-text">dB</span>
                        </div>
                        <button type="button" onclick="showPointingLossDetail('downgrounds')" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                    </div>
                </div> {{-- End of Downlink Antenna Sistem blue box --}}

                <div id="polarization_warning_down_poin" class="mb-6" style="display: none;">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Peringatan Ketidaksesuaian Polarisasi (Downlink)</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p id="polarization_warning_text_down_poin"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <i class=""></i> Hitung & Simpan
                </button>
            </form>
            <div class="flex justify-between mt-6">
                <a href="/calc/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
                </a>

                {{-- Uncomment this if you have a next page
                <a href="/next-page/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                    Halaman Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
                --}}
            </div>
        </div>
    </div>

    {{-- Popups for details --}}
    <div id="wavelengthPopup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn" onclick="closeWavelengthPopup()">&times;</span>
                <h3>Detail Perhitungan Panjang Gelombang</h3>
            </div>
            <div class="popup-body" id="wavelength-popup-content-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$\lambda = \frac{c}{f}$$
                        Dimana:<br>
                        $\lambda$ = Panjang gelombang (meter)<br>
                        $c$ = Kecepatan cahaya ($\approx 299.792.458 \text{ m/s}$)<br>
                        $f$ = Frekuensi (Hertz)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Panjang gelombang adalah jarak antara titik-titik yang berurutan dari suatu gelombang yang memiliki fasa yang sama. Parameter ini sangat penting dalam desain antena karena dimensi fisik antena seringkali merupakan kelipatan dari panjang gelombang.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="rollOffPopup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn" onclick="closeRollOffPopup()">&times;</span>
                <h3>Detail Perhitungan Antenna Roll-Off</h3>
            </div>
            <div class="popup-body" id="roll-off-popup-content-body">
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    $$\text{Roll-Off} = 2 \times \left( \text{Estimated Pointing Error} \times \frac{79.76}{\text{Beamwidth}} \right)$$
                    Dimana:<br>
                    Estimated Pointing Error = Kesalahan pointing (derajat)<br>
                    Beamwidth = Half-power beamwidth (derajat)<br>
                    Roll-Off = Antenna roll-off (derajat)
                </div>
                <p><strong>Penjelasan:</strong><br>
                Antenna roll-off menggambarkan sudut off-axis yang dihitung berdasarkan kesalahan pointing dan karakteristik beamwidth antena. Parameter ini digunakan untuk menghitung pointing loss yang lebih akurat.</p>
            </div>
        </div>
    </div>

    <div id="pointingLossPopup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn" onclick="closePointingLossPopup()">&times;</span>
                <h3>Detail Perhitungan Antenna Pointing Loss</h3>
            </div>
            <div class="popup-body" id="pointing-loss-popup-content-body">
                <div class="formula">
                    {{-- Content will be dynamically updated by showPointingLossDetail function --}}
                    <strong>Rumus Perhitungan:</strong><br>
                    $$ \text{Untuk Ground Station:} $$
                    $$\text{Loss} = -10 \\times \\log_{10}\\left(3282.81 \\times \\left(\\frac{\\sin(\\text{RADIANS}(\\text{Roll-Off}))^2}{\\text{RADIANS}(\\text{Roll-Off})^2}\\right)\\right)$$
                    $$ \text{Untuk Spacecraft:} $$
                    $$\text{Loss} = \\text{Calculation Formulas (nilai manual)}$$
                    Dimana:<br>
                    Roll-Off = Antenna roll-off (derajat)<br>
                    Calculation Formulas = Nilai yang diinput manual (dB)<br>
                    Loss = Antenna pointing loss (dB)
                </div>
                <p><strong>Penjelasan:</strong><br>
                Antenna pointing loss terjadi ketika antena tidak diarahkan tepat ke target. Untuk Ground Station menggunakan rumus kompleks berdasarkan roll-off, sedangkan untuk Spacecraft menggunakan nilai manual dari Calculation Formulas.</p>
            </div>
        </div>
    </div>

    {{-- New Popup for general Antenna Pointing Loss explanation --}}
    <div id="popup_pointing_loss_general" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn" onclick="closeGeneralPointingLossPopup()">&times;</span>
                <h3>Tentang Perhitungan Antenna Pointing Loss</h3>
            </div>
            <div class="popup-body explanation-content">
                <div class="section">
                    <h4 class="section-title">Antenna Pointing Loss (Kehilangan Penjajaran Antena)</h4>
                    <p class="section-content">
                        <strong>Antenna pointing loss</strong> adalah pengurangan kekuatan sinyal yang terjadi ketika antena pengirim atau penerima tidak diarahkan (menunjuk) secara presisi ke target yang diinginkan. Dalam sistem komunikasi satelit, di mana antena seringkali memiliki <em>beamwidth</em> yang sangat sempit, sedikit kesalahan penjajaran dapat menyebabkan hilangnya sinyal secara signifikan. Menghitung kerugian ini sangat penting untuk akurasi Link Budget.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Jenis Polarisasi</h4>
                    <p class="section-content">
                        Meskipun pointing loss adalah tentang penjajaran fisik antena, <strong>polarisasi</strong> tetap menjadi faktor penting dalam kinerja sistem secara keseluruhan. Ketidaksesuaian polarisasi antara antena pengirim dan penerima akan menyebabkan kerugian tambahan yang independen dari pointing loss. Sistem akan memberikan peringatan jika polarisasi tidak cocok.
                        <ul class="param-list">
                            <li><strong>RHCP (Right-Hand Circular Polarization):</strong> Medan listrik berputar searah jarum jam.</li>
                            <li><strong>LHCP (Left-Hand Circular Polarization):</strong> Medan listrik berputar berlawanan arah jarum jam.</li>
                            <li><strong>Linear:</strong> Medan listrik bergetar pada satu bidang (vertikal atau horizontal).</li>
                        </ul>
                        <strong>Peringatan Ketidaksesuaian Polarisasi:</strong> Jika polarisasi tidak cocok, akan ada kerugian sinyal yang signifikan.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Frekuensi (Frequency) dan Panjang Gelombang (Wavelength, λ)</h4>
                    <p class="section-content">
                        <strong>Frekuensi</strong> sinyal (MHz) secara langsung memengaruhi <strong>panjang gelombang</strong>. Panjang gelombang ini, pada gilirannya, memengaruhi desain fisik antena dan, secara tidak langsung, <em>beamwidth</em> antena. Antena yang lebih besar relatif terhadap panjang gelombang biasanya memiliki <em>beamwidth</em> yang lebih sempit, membuatnya lebih sensitif terhadap kesalahan penjajaran.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Gain Antena dan Beamwidth</h4>
                    <p class="section-content">
                        <ul>
                            <li><strong>Gain Antena (dBi/dBiC):</strong> Mengukur kemampuan antena untuk fokus pada sinyal di arah tertentu. Antena dengan gain tinggi biasanya memiliki <em>beamwidth</em> yang sempit dan lebih rentan terhadap pointing loss.</li>
                            <li><strong>Beamwidth (°):</strong> Sudut di mana kekuatan sinyal turun ke setengah dari maksimum (-3 dB). Antena dengan <em>beamwidth</em> sempit membutuhkan penjajaran yang lebih presisi.</li>
                        </ul>
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Estimated Pointing Error (θ1, θ2, θ3, θ4)</h4>
                    <p class="section-content">
                        Ini adalah perkiraan kesalahan sudut antara arah yang dituju antena dan arah sebenarnya dari sinyal. Kesalahan ini bisa terjadi karena gerakan satelit, pergerakan stasiun bumi (pada platform bergerak), atau ketidakakuratan sistem penjajaran. Simbol (θ1, θ2, θ3, θ4) digunakan untuk membedakan kesalahan pointing di berbagai titik dalam jalur uplink dan downlink.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Antenna Roll-Off</h4>
                    <p class="section-content">
                        <strong>Antenna roll-off</strong> adalah metrik yang menggambarkan seberapa cepat gain antena menurun saat menjauh dari pusat berkas (beam). Ini digunakan sebagai bagian dari perhitungan untuk menentukan kehilangan penjajaran antena pada stasiun bumi.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Approx. Antenna Pointing Loss (Kerugian Penjajaran Antena Perkiraan)</h4>
                    <p class="section-content">
                        Ini adalah nilai akhir kerugian sinyal dalam dB akibat kesalahan penjajaran antena.
                        <ul class="param-list">
                            <li>Untuk <strong>Ground Station</strong>, nilai ini dihitung berdasarkan <strong>Antenna Roll-Off</strong>.</li>
                            <li>Untuk <strong>Spacecraft</strong>, nilai ini seringkali diambil dari data atau hasil pengukuran spesifik yang dimasukkan secara manual melalui "Calculation Formulas", karena <em>pointing error</em> satelit bisa jadi lebih kompleks dan spesifik.</li>
                        </ul>
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Uplink dan Downlink</h4>
                    <p class="section-content">
                        Pointing loss dihitung secara terpisah untuk jalur <strong>Uplink</strong> (transmisi dari Ground Station ke Spacecraft) dan <strong>Downlink</strong> (transmisi dari Spacecraft ke Ground Station). Hal ini karena antena dan kondisi penjajaran bisa berbeda untuk setiap arah transmisi.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Catatan Penggunaan</h4>
                    <p class="section-content">
                        Untuk melihat rumus dan penjelasan detail dari setiap perhitungan spesifik, silakan klik tombol "Lihat Detail" yang tersedia di samping setiap kolom hasil.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Konstanta kecepatan cahaya dalam m/s
        const SPEED_OF_LIGHT = 299792458;

        // Fungsi untuk menghitung panjang gelombang
        function calculateWavelength(linkDirection) {
            const freqField = document.getElementById(`frequency_${linkDirection}grounds_poin`);
            const wavelengthField = document.getElementById(`wavelength_${linkDirection}grounds_poin`);
            if (!freqField || !wavelengthField) return;

            const frequency = parseFloat(freqField.value);
            if (!isNaN(frequency) && frequency > 0) {
                const c = 299792458; // Speed of light in m/s
                const frequencyHz = frequency * 1e6; // Convert MHz to Hz
                const wavelength = c / frequencyHz;
                wavelengthField.value = wavelength.toFixed(6);
            } else {
                wavelengthField.value = '';
            }
        }

        // Fungsi untuk menampilkan detail wavelength
        function showWavelengthDetail(linkDirection) {
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none'); // Close other popups
            document.getElementById('wavelengthPopup').style.display = 'flex';
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        // Fungsi untuk menghitung antenna roll-off dengan rumus baru
        function calculateRollOff(section) {
            let angleField, beamwidthField, rollOffField;
            
            if (section === 'upgrounds') {
                angleField = document.getElementById('estimedpointingerror_upgrounds_θ1_poin');
                beamwidthField = document.getElementById('beamwidth_upgrounds_poin');
                rollOffField = document.getElementById('annrolloff_upgrounds_poin');
            } else if (section === 'downgrounds') {
                angleField = document.getElementById('estimedpointingerror_downgrounds_θ4_poin'); 
                beamwidthField = document.getElementById('beamwidth_downgrounds_poin');
                rollOffField = document.getElementById('annrolloff_downgrounds_poin');
            }

            if (!angleField || !beamwidthField || !rollOffField) return;

            const estimatedPointingError = parseFloat(angleField.value);
            const beamwidth = parseFloat(beamwidthField.value);

            if (!isNaN(estimatedPointingError) && !isNaN(beamwidth) && beamwidth > 0) {
                // Rumus baru: Roll-Off = 2 * (Estimated Pointing Error * (79.76 / Beamwidth))
                const rollOff = 2 * (estimatedPointingError * (79.76 / beamwidth));
                rollOffField.value = rollOff.toFixed(6);
            } else {
                rollOffField.value = '';
            }
        }

        // Fungsi untuk menghitung antenna pointing loss dengan rumus baru
        function calculatePointingLoss(section) {
            let lossField, rollOffField, calculationFormulasField;
            
            if (section === 'upgrounds') {
                lossField = document.getElementById('approxannpoinloss_upgrounds_poin');
                rollOffField = document.getElementById('annrolloff_upgrounds_poin');
            } else if (section === 'upspacecraft') {
                calculationFormulasField = document.getElementById('calculation_formulas_upspacecraft_poin');
                lossField = document.getElementById('approxannpoinloss_upspacecraft_poin');
            } else if (section === 'downgrounds') {
                lossField = document.getElementById('approxannpoinloss_downgrounds_poin');
                rollOffField = document.getElementById('annrolloff_downgrounds_poin');
            } else if (section === 'downspacecraft') {
                calculationFormulasField = document.getElementById('calculation_formulas_downspacecraft_poin');
                lossField = document.getElementById('approxannpoinloss_downspacecraft_poin');
            }

            if (!lossField) return;

            // Untuk Ground Station (upgrounds dan downgrounds)
            if (section.includes('grounds')) { // Simplified check for grounds
                if (!rollOffField) return;
                
                const rollOffValue = parseFloat(rollOffField.value);
                
                if (!isNaN(rollOffValue) && rollOffValue !== 0) {
                    const rollOffRadians = rollOffValue * (Math.PI / 180); // Convert to radians
                    const sinRollOff = Math.sin(rollOffRadians);
                    const numerator = sinRollOff * sinRollOff;
                    const denominator = rollOffRadians * rollOffRadians; // Use radians here
                    
                    if (denominator !== 0) {
                        const fraction = numerator / denominator;
                        // Pastikan argumen log10 tidak nol atau negatif
                        if (3282.81 * fraction > 0) {
                            const loss = -10 * Math.log10(3282.81 * fraction);
                            lossField.value = loss.toFixed(6);
                        } else {
                            lossField.value = 'Infinity'; // Atau pesan error lainnya
                        }
                    } else {
                        lossField.value = '';
                    }
                } else {
                    lossField.value = '';
                }
            }
            // Untuk Spacecraft (upspacecraft dan downspacecraft)
            else if (section.includes('spacecraft')) { // Simplified check for spacecraft
                if (!calculationFormulasField) return;
                
                const calculationValue = parseFloat(calculationFormulasField.value);
                
                if (!isNaN(calculationValue)) {
                    // Untuk Spacecraft, nilai loss langsung diambil dari Calculation Formulas
                    lossField.value = calculationValue.toFixed(6);
                } else {
                    lossField.value = '';
                }
            }
        }

        // Fungsi untuk menampilkan detail roll-off dengan rumus yang diperbarui
        function showRollOffDetail(section) {
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none'); // Close other popups
            document.getElementById('rollOffPopup').style.display = 'flex';
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        // Fungsi untuk menampilkan detail pointing loss dengan rumus yang diperbarui
        function showPointingLossDetail(section) {
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none'); // Close other popups
            let formulaHTML = '';
            
            if (section.includes('grounds')) { // Ground Station
                formulaHTML = `
                    <strong>Rumus Perhitungan (Ground Station):</strong><br>
                    $$\\text{Loss} = -10 \\times \\log_{10}\\left(3282.81 \\times \\left(\\frac{\\sin(\\text{RADIANS}(\\text{Roll-Off}))^2}{\\text{RADIANS}(\\text{Roll-Off})^2}\\right)\\right)$$
                    Dimana:<br>
                    Roll-Off = Antenna roll-off (derajat)<br>
                    Loss = Antenna pointing loss (dB)
                `;
            } else { // Spacecraft
                formulaHTML = `
                    <strong>Rumus Perhitungan (Spacecraft):</strong><br>
                    $$\\text{Loss} = \\text{Calculation Formulas (nilai manual)}$$
                    Dimana:<br>
                    Calculation Formulas = Nilai yang diinput manual (dB)<br>
                    Loss = Antenna pointing loss (dB)
                `;
            }
            
            document.querySelector('#pointingLossPopup .formula').innerHTML = formulaHTML;
            
            document.getElementById('pointingLossPopup').style.display = 'flex';
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        // Fungsi untuk menutup popup
        function closeWavelengthPopup() {
            document.getElementById('wavelengthPopup').style.display = 'none';
        }

        function closePointingLossPopup() {
            document.getElementById('pointingLossPopup').style.display = 'none';
        }

        function closeRollOffPopup() {
            document.getElementById('rollOffPopup').style.display = 'none';
        }

        // Fungsi untuk handle perubahan polarisasi
        function handlePolarizationChange(section, linkDirection) {
            checkPolarizationMismatch(linkDirection);
        }

        // Fungsi untuk mengecek ketidaksesuaian polarisasi
        function checkPolarizationMismatch(linkDirection) {
            const groundsPolarizationEl = document.getElementById(`jenis_polarizationgrounds_${linkDirection}_poin`);
            const spacecraftPolarizationEl = document.getElementById(`jenis_polarizationspacecraft_${linkDirection}_poin`);
            const warningDiv = document.getElementById(`polarization_warning_${linkDirection}_poin`);
            const warningText = document.getElementById(`polarization_warning_text_${linkDirection}_poin`);

            if (!groundsPolarizationEl || !spacecraftPolarizationEl || !warningDiv || !warningText) return;

            const groundsPolarization = groundsPolarizationEl.value;
            const spacecraftPolarization = spacecraftPolarizationEl.value;

            if (groundsPolarization && spacecraftPolarization && groundsPolarization !== spacecraftPolarization) {
                let lossAmount = '';
                let mismatchType = '';
                if ((groundsPolarization === 'RHCP' && spacecraftPolarization === 'LHCP') ||
                    (groundsPolarization === 'LHCP' && spacecraftPolarization === 'RHCP')) {
                    lossAmount = 'sangat tinggi (potensi >20 dB atau kehilangan sinyal total)';
                    mismatchType = 'Circular Mismatch (Beda Arah Putar)';
                } else if ((groundsPolarization === 'Linear' && (spacecraftPolarization === 'RHCP' || spacecraftPolarization === 'LHCP')) ||
                           ((groundsPolarization === 'RHCP' || groundsPolarization === 'LHCP') && spacecraftPolarization === 'Linear')) {
                    lossAmount = 'sekitar 3 dB';
                    mismatchType = 'Linear vs Circular Mismatch';
                } else {
                    lossAmount = 'tidak terdefinisi (kemungkinan tidak ada masalah jika salah satu tidak dipilih)';
                    mismatchType = 'Kombinasi Tidak Umum';
                }
                warningText.innerHTML = `<strong>${mismatchType}:</strong> Polarisasi Stasiun Bumi (${groundsPolarization}) dan Spacecraft (${spacecraftPolarization}) tidak cocok. Ini dapat mengakibatkan kehilangan daya sinyal sebesar ${lossAmount}.`;
                warningDiv.style.display = 'block';
            } else {
                warningDiv.style.display = 'none';
            }
        }

        // Functions to open and close the general pointing loss explanation popup
        function openGeneralPointingLossPopup() {
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none'); // Close all other popups
            document.getElementById('popup_pointing_loss_general').style.display = 'flex';
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        function closeGeneralPointingLossPopup() {
            document.getElementById('popup_pointing_loss_general').style.display = 'none';
        }

        // Setup event listeners yang diperbarui
        function setupEventListeners() {
            ['up', 'down'].forEach(ld => {
                // Input frekuensi memicu kalkulasi panjang gelombang
                const freqField = document.getElementById(`frequency_${ld}grounds_poin`);
                if (freqField) {
                    freqField.addEventListener('input', () => calculateWavelength(ld));
                }

                // Selector Polarisasi
                const polarizationGrounds = document.getElementById(`jenis_polarizationgrounds_${ld}_poin`);
                if(polarizationGrounds) {
                    polarizationGrounds.addEventListener('change', () => handlePolarizationChange('grounds', ld));
                }

                const polarizationSpacecraft = document.getElementById(`jenis_polarizationspacecraft_${ld}_poin`);
                if(polarizationSpacecraft) {
                    polarizationSpacecraft.addEventListener('change', () => handlePolarizationChange('spacecraft', ld));
                }

                // Event listeners for calculations
                if (ld === 'up') {
                    // Ground station uplink
                    const pointingErrorGrounds = document.getElementById('estimedpointingerror_upgrounds_θ1_poin');
                    const beamwidthGrounds = document.getElementById('beamwidth_upgrounds_poin');
                    if (pointingErrorGrounds) {
                        pointingErrorGrounds.addEventListener('input', () => {
                            calculateRollOff('upgrounds');
                            // Add a small delay to ensure roll-off is computed before pointing loss
                            setTimeout(() => calculatePointingLoss('upgrounds'), 10);
                        });
                    }
                    if (beamwidthGrounds) {
                        beamwidthGrounds.addEventListener('input', () => {
                            calculateRollOff('upgrounds');
                            setTimeout(() => calculatePointingLoss('upgrounds'), 10);
                        });
                    }

                    // Spacecraft uplink
                    const calculationFormulasSpacecraft = document.getElementById('calculation_formulas_upspacecraft_poin');
                    if (calculationFormulasSpacecraft) {
                        calculationFormulasSpacecraft.addEventListener('input', () => calculatePointingLoss('upspacecraft'));
                    }
                } else { // Downlink
                    // Ground station downlink
                    const pointingErrorGrounds = document.getElementById('estimedpointingerror_downgrounds_θ4_poin');
                    const beamwidthGrounds = document.getElementById('beamwidth_downgrounds_poin');
                    if (pointingErrorGrounds) {
                        pointingErrorGrounds.addEventListener('input', () => {
                            calculateRollOff('downgrounds');
                            setTimeout(() => calculatePointingLoss('downgrounds'), 10);
                        });
                    }
                    if (beamwidthGrounds) {
                        beamwidthGrounds.addEventListener('input', () => {
                            calculateRollOff('downgrounds');
                            setTimeout(() => calculatePointingLoss('downgrounds'), 10);
                        });
                    }

                    // Spacecraft downlink
                    const calculationFormulasSpacecraft = document.getElementById('calculation_formulas_downspacecraft_poin');
                    if (calculationFormulasSpacecraft) {
                        calculationFormulasSpacecraft.addEventListener('input', () => calculatePointingLoss('downspacecraft'));
                    }
                }
            });

            // Event listener for the general info button
            const infoPointingLossBtn = document.getElementById('info_pointing_loss_general_btn');
            if (infoPointingLossBtn) {
                infoPointingLossBtn.addEventListener('click', openGeneralPointingLossPopup);
            }

            // Close popups when clicking outside or pressing Escape
            document.addEventListener('click', function(e) {
                // Check if the click occurred inside any popup content
                if (e.target.closest('.popup-content')) return; 

                // Check if the click occurred on a button that opens a popup
                const isPopupButton = e.target.closest('button[onclick^="show"]');
                if (isPopupButton) return; // If it's a popup open button, don't close other popups

                // Close all popups if clicked outside and not on an open button
                closeWavelengthPopup();
                closeRollOffPopup();
                closePointingLossPopup();
                closeGeneralPointingLossPopup();
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeWavelengthPopup();
                    closeRollOffPopup();
                    closePointingLossPopup();
                    closeGeneralPointingLossPopup();
                }
            });
        }

        // Validasi form saat submit
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            
            // Initial calculations on load
            ['up', 'down'].forEach(ld => {
                checkPolarizationMismatch(ld);
                calculateWavelength(ld); // Ensure wavelengths are calculated on load if frequencies are pre-filled
                // Calculate roll-off and pointing loss for ground stations on load if inputs are pre-filled
                if (ld === 'up') {
                    calculateRollOff('upgrounds');
                    // Add a small delay for calculatePointingLoss to ensure roll-off is computed first
                    setTimeout(() => calculatePointingLoss('upgrounds'), 10);
                    // Also trigger pointing loss for spacecraft uplink
                    calculatePointingLoss('upspacecraft');
                } else { // Downlink
                    calculateRollOff('downgrounds');
                    // Add a small delay for calculatePointingLoss to ensure roll-off is computed first
                    setTimeout(() => calculatePointingLoss('downgrounds'), 10);
                    // Also trigger pointing loss for spacecraft downlink
                    calculatePointingLoss('downspacecraft');
                }
            });

            // Form validation
            document.getElementById('antennaForm_poin').addEventListener('submit', function(e) {
                let formIsValid = true;
                const requiredFields = [
                    'frequency_upgrounds_poin',
                    'gain_upgrounds_poin',
                    'beamwidth_upgrounds_poin',
                    'estimedpointingerror_upgrounds_θ1_poin',
                    'gain_upspacecraft_poin',
                    'beamwidth_upspacecraft_poin',
                    'upspacecraft_θ2_poin',
                    'calculation_formulas_upspacecraft_poin',
                    'frequency_downgrounds_poin',
                    'gain_downgrounds_poin',
                    'beamwidth_downgrounds_poin',
                    'estimedpointingerror_downgrounds_θ4_poin',
                    'gain_downspacecraft_poin',
                    'beamwidth_downspacecraft_poin',
                    'downspacecraft_θ3_poin',
                    'calculation_formulas_downspacecraft_poin'
                ];

                for (const fieldId of requiredFields) {
                    const field = document.getElementById(fieldId);
                    if (!field || field.value === '') { // Check for empty string
                        
                     
                    }
                    // Specific check for numerical fields that must be non-negative
                    if (['gain_upgrounds_poin', 'gain_upspacecraft_poin', 'gain_downgrounds_poin', 'gain_downspacecraft_poin', 
                         'frequency_upgrounds_poin', 'frequency_downgrounds_poin'].includes(fieldId) && parseFloat(field.value) < 0) {
                        alert(`Nilai untuk '${fieldId.replace(/_poin/g, '').replace(/_/g, ' ')}' tidak boleh negatif.`);
                        e.preventDefault();
                        formIsValid = false;
                        break;
                    }
                }

                if (!formIsValid) return;

                // Validasi khusus untuk nilai beamwidth harus > 0
                const beamwidthFields = [
                    'beamwidth_upgrounds_poin',
                    'beamwidth_upspacecraft_poin',
                    'beamwidth_downgrounds_poin',
                    'beamwidth_downspacecraft_poin'
                ];

                for (const fieldId of beamwidthFields) {
                    const field = document.getElementById(fieldId);
                    if (field && parseFloat(field.value) <= 0) {
                        alert(`Beamwidth (${fieldId.replace(/_poin/g, '').replace(/_/g, ' ')}) harus lebih besar dari 0!`);
                        e.preventDefault();
                        formIsValid = false;
                        break;
                    }
                }

                // Validasi khusus untuk angle fields (0-90 derajat)
                const angleFields = [
                    'estimedpointingerror_upgrounds_θ1_poin',
                    'upspacecraft_θ2_poin',
                    'downspacecraft_θ3_poin',
                    'estimedpointingerror_downgrounds_θ4_poin'
                ];

                for (const fieldId of angleFields) {
                    const field = document.getElementById(fieldId);
                    const value = parseFloat(field.value);
                    if (field && (isNaN(value) || value < 0 || value > 90)) {
                        alert(`Sudut (${fieldId.replace(/_poin/g, '').replace(/_/g, ' ')}' harus antara 0 dan 90 derajat.`);
                        e.preventDefault();
                        formIsValid = false;
                        break;
                    }
                }
            });
        });
    </script>
    {{-- MathJax Script --}}
    <script>
        window.MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']],
                displayMath: [['$$', '$$'], ['\\[', '\\]']],
                processEscapes: true,
                tags: "ams"
            },
            options: {
                ignoreHtmlClass: "tex2jax_ignore",
                processHtmlClass: "tex2jax_process"
            },
            loader: {
                load: ['[tex]/ams']
            }
        };
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

</x-layout>