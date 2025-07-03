<x-layout>
    <x-slot:title>Antenna Gain Calculator</x-slot>

    {{-- Link to Font Awesome for icons and Animate.css for animations --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* General styles for readonly inputs */
        input[readonly] {
            background-color: #e6f4e1; /* Lighter green */
            color: #166534; /* Darker green text */
            border-color: #81c784; /* Green border */
            cursor: not-allowed;
            font-weight: 500;
        }

        /* Styles for input focus states */
        input[type="number"]:focus,
        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3B82F6; /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* blue-500 with opacity */
        }

        /* Styling for labels in form sections - not directly used in the provided Antenna Gain, but good to include for consistency */
        .form-section-label {
            display: block;
            font-weight: bold;
            color: #1F2937; /* gray-800 */
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #E5E7EB; /* gray-200 */
        }

        /* Basic styling for input groups */
        .input-group > div {
            margin-bottom: 1rem;
        }
        .input-group > div:last-child {
            margin-bottom: 0;
        }

        /* Consistent input height and padding */
        input[type="number"],
        input[type="text"] {
            height: 48px; /* Standard height for p-3 inputs */
        }

        /* Wrapper for input fields with units next to them */
        .input-with-unit-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem; /* Space between input and unit */
            flex-wrap: nowrap; /* Prevent wrapping by default */
        }
        .input-with-unit-wrapper input {
            flex-grow: 1; /* Allow input to take available space */
            min-width: 80px; /* Minimum width for input to be readable */
        }


        /* Styling for unit text */
        .unit-text {
            color: #4B5563; /* gray-700 */
            font-size: 0.875rem; /* text-sm */
            font-weight: 500; /* Medium font weight */
            white-space: nowrap; /* Prevent unit text from wrapping */
            flex-shrink: 0; /* Prevent shrinking of the unit text */
        }

        /* --- Popup Styles (Crucial Fixes for Overlay Behavior) --- */
        .popup-window {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
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
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            display: flex; /* Use flexbox for header and body layout */
            flex-direction: column; /* Stack header and body vertically */
            animation: fadeInScale 0.3s ease-out;
            box-sizing: border-box;
            margin: 1rem;
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
        
        /* Keyframes for popup animation */
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* --- Mobile Responsive Adjustments (max-width: 640px - Tailwind's 'sm' breakpoint) --- */
        @media (max-width: 640px) {
            /* Adjust main container padding */
            .container.mx-auto.px-4.py-8 {
                padding-left: 1rem;
                padding-right: 1rem;
                padding-top: 2rem;
                padding-bottom: 2rem;
            }
            /* Adjust main card padding */
            .bg-white.p-8 {
                padding: 1rem;
            }
            /* Force flex containers to stack vertically on small screens */
            .flex.flex-col.sm\:flex-row,
            .flex.justify-between.mt-6 { /* Also applies to navigation buttons */
                flex-direction: column !important; /* Force column layout */
                align-items: stretch !important; /* Stretch items to full width */
                gap: 1rem !important; /* Consistent vertical gap */
                space-x-0: true !important; /* Tailwind utility removal */
            }

            /* Ensure children of stacked flex containers take full width */
            .flex.justify-between.mt-6 a {
                width: 100% !important; /* Make navigation buttons full width */
                text-align: center;
            }
            /* Adjust font sizes for better readability on small screens */
            .text-3xl.sm\:text-4xl {
                font-size: 2rem;
            }
            .text-lg {
                font-size: 1rem;
            }
            /* Adjust button padding */
            .px-6.py-3 {
                padding: 0.75rem 1.5rem;
            }
            .bg-blue-600.px-8.py-4 {
                padding: 1rem 1.5rem;
            }
            /* Ensure input-with-unit-wrapper *doesn't* stack vertically, prioritize unit alignment */
            .input-with-unit-wrapper {
                flex-wrap: nowrap; /* Force no wrapping to keep unit on same line */
                justify-content: space-between; /* Distribute space between input and unit */
            }
            .input-with-unit-wrapper input {
                flex-grow: 1; /* Allow input to grow */
                min-width: 80px; /* Still maintain minimum width */
                max-width: calc(100% - 60px); /* Limit input width to leave space for unit (adjust 60px as needed) */
            }
        }

        /* Styles for the new antenna gain explanation popup content */
        .antenna-gain-explanation {
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
            color: #4A5568;
        }
        .antenna-gain-explanation .section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }
        .antenna-gain-explanation .section:last-child {
            border-bottom: none;
        }
        .antenna-gain-explanation .section-title {
            color: #2C5282;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border-left: 5px solid #4299E1;
            padding-left: 1rem;
        }
        .antenna-gain-explanation .section-content {
            text-align: justify;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }
        .antenna-gain-explanation .param-title {
            color: #2D3748;
            font-size: 1rem;
            font-weight: 600;
            margin: 1.25rem 0 0.5rem 0;
        }
        .antenna-gain-explanation .param-list {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }
        .antenna-gain-explanation .param-list li {
            margin-bottom: 0.4rem;
            line-height: 1.6;
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="text-blue-600"></i> Perhitungan Parameter Antenna Gain
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Masukkan parameter Antenna Gain untuk uplink dan downlink.
            </p>

            {{-- "Apa itu Perhitungan Antenna Gain?" button --}}
            <div class="mb-6 text-right animate__animated animate__fadeInUp">
                <button type="button" id="info_antenna_gain_general_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">
                    Apa itu Perhitungan Antenna Gain? <i class="fas fa-info-circle ml-1"></i>
                </button>
            </div>

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Uplink Antenna Sistem</h2>
            <div class="bg-blue-50 shadow-lg rounded-lg p-6 mb-8 border border-blue-200">
                <form method="POST" action="{{ route('antennagain.store', ['id' => $dataId]) }}" id="antennaForm">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->id() ?? 1}}">

                    <div class="mb-8">
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700 text-lg">Ground Station (Uplink):</label>
                        </div>

                        <div class="mb-6">
                            <label for="jenis_polarizationgrounds_up" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                            <select name="jenis_polarizationgrounds_up" id="jenis_polarizationgrounds_up" onchange="handlePolarizationChange('grounds', 'up')" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="RHCP">RHCP</option>
                                <option value="LHCP">LHCP</option>
                                <option value="Linear">Linear</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="jenis_antenagrounds_up" class="block font-medium mb-1 text-gray-700">Jenis Antena (Opsional):</label>
                            <select name="jenis_antenagrounds_up" id="jenis_antenagrounds_up" onchange="handleAntennaChangeGrounds('up')" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="">-- Pilih Jenis Antena --</option>
                                <option value="Yagi">Yagi Antenna</option>
                                <option value="Helix">Helix Antenna</option>
                                <option value="Parabolic">Parabolic Reflector</option>
                            </select>
                        </div>

                        <div id="calculator_link_upgrounds" class="mb-6" style="display: none;">
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                                <h4 class="font-semibold text-purple-800 mb-2">Kalkulator Khusus</h4>
                                <p class="text-sm text-purple-600 mb-3">Klik tombol di bawah untuk membuka kalkulator khusus, hitung parameter antena, lalu kembali ke sini untuk input manual:</p>
                                <a id="calculator_link_btn_upgrounds" href="#" target="_blank" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                    <span id="calculator_link_text_upgrounds">Buka Kalkulator</span> →
                                </a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Frekuensi Uplink:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="frequency_upgrounds" id="frequency_upgrounds" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->frekuensi ?? '' }}" step="any" value="{{ $data->frekuensi ?? '' }}" readonly>
                                <span class="unit-text">MHz</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ):</label>
                            <div class="input-with-unit-wrapper">
                               <input type="number" name="frequency_upgrounds" id="frequency_upgrounds" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->panjang_gelombang ?? '' }}" step="any" value="{{ $data->panjang_gelombang ?? '' }}" readonly>
                            </div>
                            <button type="button" onclick="showWavelengthDetail('up')" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail Perhitungan <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div id="user_defined_fields_upgrounds">
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-4">
                                <h4 class="font-semibold text-purple-800 mb-2">Input Manual - Ground Station (Uplink)</h4>
                                <p class="text-sm text-purple-600">Masukkan spesifikasi antena secara manual. Gunakan kalkulator khusus di atas untuk mendapatkan nilai.</p>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Gain:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" name="gain_manual_upgrounds" id="gain_manual_upgrounds" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" step="0.01" placeholder="Masukkan gain" required>
                                    <span class="unit-text">dBiC</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Beamwidth:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" name="beamwidth_manual_upgrounds" id="beamwidth_manual_upgrounds" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" step="0.01" placeholder="Masukkan beamwidth" required>
                                    <span class="unit-text">°</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700 text-lg">Spacecraft (Uplink):</label>
                        </div>
                        <div class="mb-6">
                            <label for="jenis_polarizationspacecraft_up" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                            <select name="jenis_polarizationspacecraft_up" id="jenis_polarizationspacecraft_up" onchange="handlePolarizationChange('spacecraft', 'up')" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="RHCP">RHCP</option>
                                <option value="LHCP">LHCP</option>
                                <option value="Linear">Linear</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="jenis_antenagrounds_up" class="block font-medium mb-1 text-gray-700">Jenis Antena (Opsional):</label>
                            <select name="jenis_antenagrounds_up" id="jenis_antenagrounds_up" onchange="handleAntennaChangeGrounds('up')" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="">-- Pilih Jenis Antena --</option>
                                <option value="Yagi">Yagi Antenna</option>
                                <option value="Helix">Helix Antenna</option>
                                <option value="Parabolic">Parabolic Reflector</option>
                            </select>
                        </div>

                        <div id="calculator_link_upspacecraft" class="mb-6" style="display: none;">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <h4 class="font-semibold text-green-800 mb-2">Kalkulator Khusus Spacecraft</h4>
                                <p class="text-sm text-green-600 mb-3">Klik tombol di bawah untuk membuka kalkulator khusus, hitung parameter antena, lalu kembali ke sini untuk input manual:</p>
                                <a id="calculator_link_btn_upspacecraft" href="#" target="_blank" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                    <span id="calculator_link_text_upspacecraft">Buka Kalkulator</span> →
                                </a>
                            </div>
                        </div>

                        <div id="user_defined_fields_upspacecraft">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                <h4 class="font-semibold text-green-800 mb-2">Input Manual - Spacecraft (Uplink)</h4>
                                <p class="text-sm text-green-600">Masukkan spesifikasi antena secara manual. Gunakan kalkulator khusus di atas untuk mendapatkan nilai.</p>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Gain:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" name="gain_manual_upspacecraft" id="gain_manual_upspacecraft" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" step="0.01" placeholder="Masukkan gain" required>
                                    <span class="unit-text">dBiC</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Beamwidth:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" name="beamwidth_manual_upspacecraft" id="beamwidth_manual_upspacecraft" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" step="0.01" placeholder="Masukkan beamwidth" required>
                                    <span class="unit-text">°</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="polarization_warning_up" class="mb-6" style="display: none;">
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
                                        <p id="polarization_warning_text_up"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>


            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Downlink Antenna Sistem</h2>
            <div class="bg-blue-50 shadow-lg rounded-lg p-6 mb-8 border border-blue-200">
                    <div class="mb-8">
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700 text-lg">Ground Station (Downlink):</label>
                        </div>

                        <div class="mb-6">
                            <label for="jenis_polarizationgrounds_down" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                            <select name="jenis_polarizationgrounds_down" id="jenis_polarizationgrounds_down" onchange="handlePolarizationChange('grounds', 'down')" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="RHCP">RHCP</option>
                                <option value="LHCP">LHCP</option>
                                <option value="Linear">Linear</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="jenis_antenagrounds_up" class="block font-medium mb-1 text-gray-700">Jenis Antena (Opsional):</label>
                            <select name="jenis_antenagrounds_up" id="jenis_antenagrounds_up" onchange="handleAntennaChangeGrounds('up')" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="">-- Pilih Jenis Antena --</option>
                                <option value="Yagi">Yagi Antenna</option>
                                <option value="Helix">Helix Antenna</option>
                                <option value="Parabolic">Parabolic Reflector</option>
                            </select>
                        </div>

                        <div id="calculator_link_downgrounds" class="mb-6" style="display: none;">
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                                <h4 class="font-semibold text-purple-800 mb-2">Kalkulator Khusus</h4>
                                <p class="text-sm text-purple-600 mb-3">Klik tombol di bawah untuk membuka kalkulator khusus, hitung parameter antena, lalu kembali ke sini untuk input manual:</p>
                                <a id="calculator_link_btn_downgrounds" href="#" target="_blank" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                    <span id="calculator_link_text_downgrounds">Buka Kalkulator</span> →
                                </a>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Frekuensi Downlink:</label>
                            <div class="input-with-unit-wrapper">
                                 <input type="number" name="frequency_upgrounds" id="frequency_upgrounds" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->frekuensi_downlink ?? '' }}" step="any" value="{{ $data->frekuensi_downlink ?? '' }}" readonly>
                                <span class="unit-text">MHz</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ):</label>
                            <div class="input-with-unit-wrapper">
                                 <input type="number" name="frequency_upgrounds" id="frequency_upgrounds" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->panjang_gelombang_downlink ?? '' }}" step="any" value="{{ $data->panjang_gelombang_downlink ?? '' }}" readonly>
                                <span class="unit-text">m</span>
                            </div>
                            <button type="button" onclick="showWavelengthDetail('down')" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail Perhitungan <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div id="user_defined_fields_downgrounds">
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 mb-4">
                                <h4 class="font-semibold text-purple-800 mb-2">Input Manual - Ground Station (Downlink)</h4>
                                <p class="text-sm text-purple-600">Masukkan spesifikasi antena secara manual. Gunakan kalkulator khusus di atas untuk mendapatkan nilai.</p>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Gain:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" name="gain_manual_downgrounds" id="gain_manual_downgrounds" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" step="0.01" placeholder="Masukkan gain" required>
                                    <span class="unit-text">dBiC</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Beamwidth:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" name="beamwidth_manual_downgrounds" id="beamwidth_manual_downgrounds" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" step="0.01" placeholder="Masukkan beamwidth" required>
                                    <span class="unit-text">°</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700 text-lg">Spacecraft (Downlink):</label>
                        </div>
                        <div class="mb-6">
                            <label for="jenis_polarizationspacecraft_down" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                            <select name="jenis_polarizationspacecraft_down" id="jenis_polarizationspacecraft_down" onchange="handlePolarizationChange('spacecraft', 'down')" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="RHCP">RHCP</option>
                                <option value="LHCP">LHCP</option>
                                <option value="Linear">Linear</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="jenis_antenagrounds_up" class="block font-medium mb-1 text-gray-700">Jenis Antena (Opsional):</label>
                            <select name="jenis_antenagrounds_up" id="jenis_antenagrounds_up" onchange="handleAntennaChangeGrounds('up')" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="">-- Pilih Jenis Antena --</option>
                                <option value="Yagi">Yagi Antenna</option>
                                <option value="Helix">Helix Antenna</option>
                                <option value="Parabolic">Parabolic Reflector</option>
                            </select>
                        </div>

                        <div id="calculator_link_downspacecraft" class="mb-6" style="display: none;">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <h4 class="font-semibold text-green-800 mb-2">Kalkulator Khusus Spacecraft</h4>
                                <p class="text-sm text-green-600 mb-3">Klik tombol di bawah untuk membuka kalkulator khusus, hitung parameter antena, lalu kembali ke sini untuk input manual:</p>
                                <a id="calculator_link_btn_downspacecraft" href="#" target="_blank" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                    <span id="calculator_link_text_downspacecraft">Buka Kalkulator</span> →
                                </a>
                            </div>
                        </div>

                        <div id="user_defined_fields_downspacecraft">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                <h4 class="font-semibold text-green-800 mb-2">Input Manual - Spacecraft (Downlink)</h4>
                                <p class="text-sm text-green-600">Masukkan spesifikasi antena secara manual. Gunakan kalkulator khusus di atas untuk mendapatkan nilai.</p>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Gain:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" name="gain_manual_downspacecraft" id="gain_manual_downspacecraft" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" step="0.01" placeholder="Masukkan gain" required>
                                    <span class="unit-text">dBiC</span>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Beamwidth:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" name="beamwidth_manual_downspacecraft" id="beamwidth_manual_downspacecraft" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" step="0.01" placeholder="Masukkan beamwidth" required>
                                    <span class="unit-text">°</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="polarization_warning_down" class="mb-6" style="display: none;">
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
                                        <p id="polarization_warning_text_down"></p>
                                    </div>
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

    {{-- New Popup for general Antenna Gain explanation (NO FORMULAS HERE) --}}
    <div id="popup_antenna_gain_general" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn" onclick="closeGeneralAntennaGainPopup()">&times;</span>
                <h3>Tentang Perhitungan Antenna Gain</h3>
            </div>
            <div class="popup-body antenna-gain-explanation">
                <div class="section">
                    <h4 class="section-title">Antenna Gain (Keuntungan Antena)</h4>
                    <p class="section-content">
                        <strong>Antenna gain</strong> adalah ukuran seberapa baik antena mengubah daya input menjadi gelombang radio yang terarah, atau seberapa baik antena menerima gelombang radio dari arah tertentu. Gain diukur dalam desibel-isotropik (<strong>dBi</strong>) atau desibel-circular (<strong>dBiC</strong>) jika polarisasi melingkar. Semakin tinggi gain, semakin terarah antena tersebut.
                    </p>
                    <p class="section-content">
                        Ini adalah parameter krusial dalam sistem komunikasi satelit, karena gain antena secara langsung memengaruhi kekuatan sinyal yang dipancarkan atau diterima. Antena dengan gain tinggi dapat mengirim dan menerima sinyal lebih jauh atau dengan daya yang lebih rendah, yang penting untuk efisiensi Link Budget.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Jenis Polarisasi</h4>
                    <p class="section-content">
                        Polarisasi mengacu pada orientasi medan listrik dari gelombang elektromagnetik. Dalam komunikasi satelit, kesesuaian polarisasi antara antena pengirim dan penerima sangat penting untuk meminimalkan kehilangan sinyal (polarization mismatch loss). Jenis polarisasi yang umum meliputi:
                        <ul class="param-list">
                            <li><strong>RHCP (Right-Hand Circular Polarization):</strong> Medan listrik berputar searah jarum jam saat dilihat dari sumber.</li>
                            <li><strong>LHCP (Left-Hand Circular Polarization):</strong> Medan listrik berputar berlawanan arah jarum jam saat dilihat dari sumber.</li>
                            <li><strong>Linear:</strong> Medan listrik bergetar pada satu bidang (vertikal atau horizontal).</li>
                        </ul>
                    </p>
                    <p class="section-content">
                        <strong>Peringatan Ketidaksesuaian Polarisasi:</strong> Jika polarisasi antena pengirim dan penerima tidak cocok (misalnya, RHCP dikirim dan LHCP diterima, atau circular dikirim dan linear diterima), akan terjadi kehilangan sinyal yang signifikan. Sistem akan memberikan peringatan jika ada ketidaksesuaian ini, mengindikasikan potensi kerugian daya sinyal yang besar.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Jenis Antena</h4>
                    <p class="section-content">
                        Jenis antena yang berbeda memiliki karakteristik gain dan beamwidth yang bervariasi. Beberapa jenis antena yang relevan dalam konteks ini meliputi:
                        <ul class="param-list">
                            <li><strong>Yagi Antenna:</strong> Antena directional yang baik untuk frekuensi VHF/UHF, sering digunakan di Ground Station.</li>
                            <li><strong>Helix Antenna:</strong> Antena yang menghasilkan polarisasi sirkular, ideal untuk aplikasi yang membutuhkan komunikasi dengan objek bergerak seperti satelit.</li>
                            <li><strong>Parabolic Reflector:</strong> Antena gain tinggi yang digunakan untuk jarak jauh, umum di Ground Station dan beberapa sistem satelit.</li>
                            <li><strong>Monopole Antenna:</strong> Antena omnidirectional, sering digunakan pada Spacecraft untuk cakupan luas.</li>
                            <li><strong>Dipole Antenna:</strong> Antena dasar yang relatif omnidirectional, juga bisa ditemukan pada Spacecraft.</li>
                            <li><strong>Patch Antenna:</strong> Antena kecil, datar, dan sering digunakan pada Spacecraft karena ukurannya yang ringkas.</li>
                        </ul>
                        Pengguna dapat memilih jenis antena opsional untuk mendapatkan panduan kalkulator eksternal yang relevan guna membantu dalam menentukan nilai Gain dan Beamwidth.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Frekuensi (Frequency)</h4>
                    <p class="section-content">
                        Frekuensi adalah jumlah osilasi gelombang per detik, diukur dalam <strong>MegaHertz (MHz)</strong>. Ini adalah parameter fundamental yang menentukan panjang gelombang.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Panjang Gelombang (Wavelength, λ)</h4>
                    <p class="section-content">
                        <strong>Panjang gelombang</strong> adalah jarak spasial satu siklus penuh gelombang. Ini berbanding terbalik dengan frekuensi dan dihitung menggunakan kecepatan cahaya. Panjang gelombang adalah faktor penting dalam desain fisik antena, karena dimensi antena seringkali dirancang sebagai fraksi atau kelipatan dari panjang gelombang.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Beamwidth (Lebar Berkas)</h4>
                    <p class="section-content">
                        <strong>Beamwidth</strong> adalah ukuran sudut di mana kekuatan sinyal yang dipancarkan atau diterima oleh antena jatuh ke setengah dari nilai maksimumnya (atau <strong>-3 dB</strong> dari maksimum). Beamwidth yang lebih kecil menunjukkan antena yang lebih directional dan fokus, sementara beamwidth yang lebih besar menunjukkan cakupan yang lebih luas.
                    </p>
                    <p class="section-content">
                        Dalam komunikasi satelit, beamwidth yang tepat sangat penting untuk memastikan sinyal ditargetkan secara akurat ke penerima atau mencakup area yang diinginkan di permukaan bumi.
                    </p>
                </div>

                <div class="section">
                    <h4 class="section-title">Uplink dan Downlink</h4>
                    <p class="section-content">
                        Semua parameter ini dipertimbangkan secara terpisah untuk jalur <strong>Uplink</strong> (transmisi dari Ground Station ke Spacecraft) dan <strong>Downlink</strong> (transmisi dari Spacecraft ke Ground Station). Hal ini karena antena yang digunakan di Ground Station dan Spacecraft, serta frekuensi yang digunakan, mungkin berbeda secara signifikan.
                    </p>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Fungsi untuk menghitung panjang gelombang
        function calculateWavelength(linkDirection) {
            const freqField = document.getElementById(`frequency_${linkDirection}grounds`);
            const wavelengthField = document.getElementById(`wavelength_${linkDirection}grounds`);
            if (!freqField || !wavelengthField) return;

            const frequency = parseFloat(freqField.value);
            if (!isNaN(frequency) && frequency > 0) {
                // Kecepatan cahaya dalam meter per detik, frekuensi dalam MHz, jadi dibagi 10^6
                const c = 299792458; // Speed of light in m/s
                const frequencyHz = frequency * 1e6; // Convert MHz to Hz
                const wavelength = c / frequencyHz; 
                wavelengthField.value = wavelength.toFixed(6);
            } else {
                wavelengthField.value = '';
            }
        }

        // The showWavelengthDetail function is modified to only show formula and explanation
        function showWavelengthDetail(linkDirection) {
            document.getElementById('wavelengthPopup').style.display = 'flex';
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise(); // Render MathJax when popup opens
            }
        }

        // Fungsi untuk menutup popup panjang gelombang
        function closeWavelengthPopup() {
            document.getElementById('wavelengthPopup').style.display = 'none';
        }

        // Fungsi untuk handle perubahan polarisasi
        function handlePolarizationChange(section, linkDirection) {
            checkPolarizationMismatch(linkDirection);
        }

        // Fungsi untuk mengecek ketidaksesuaian polarisasi
        function checkPolarizationMismatch(linkDirection) {
            const groundsPolarizationEl = document.getElementById(`jenis_polarizationgrounds_${linkDirection}`);
            const spacecraftPolarizationEl = document.getElementById(`jenis_polarizationspacecraft_${linkDirection}`);
            const warningDiv = document.getElementById(`polarization_warning_${linkDirection}`);
            const warningText = document.getElementById(`polarization_warning_text_${linkDirection}`);

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
                warningText.innerHTML = `<strong>${mismatchType}:</strong> Polarisasi Stasiun Bumi (${groundsPolarization}) dan Wahana Antariksa (${spacecraftPolarization}) tidak cocok. Ini dapat mengakibatkan kehilangan daya sinyal sebesar ${lossAmount}.`;
                warningDiv.style.display = 'block';
            } else {
                warningDiv.style.display = 'none';
            }
        }

        // Fungsi untuk handle perubahan antena grounds
        function handleAntennaChangeGrounds(linkDirection) {
            const antennaType = document.getElementById(`jenis_antenagrounds_${linkDirection}`)?.value;
            const calculatorLinkDiv = document.getElementById(`calculator_link_${linkDirection}grounds`);
            const calculatorLinkBtn = document.getElementById(`calculator_link_btn_${linkDirection}grounds`);
            const calculatorLinkText = document.getElementById(`calculator_link_text_${linkDirection}grounds`);
            
            if (!antennaType || antennaType === 'User Defined') {
                if (calculatorLinkDiv) calculatorLinkDiv.style.display = 'none';
                return;
            }
            
            // Show calculator link and set appropriate URL and text
            if (calculatorLinkDiv) calculatorLinkDiv.style.display = 'block';
            
            let calculatorUrl = '';
            let calculatorText = '';
            
            switch(antennaType) {
                case 'Yagi':
                    calculatorUrl = 'https://www.changpuak.ch/electronics/yagi_uda_antenna.php';
                    calculatorText = 'Kalkulator Yagi';
                    break;
                case 'Helix':
                    calculatorUrl = 'https://www.changpuak.ch/electronics/calc_12b.php';
                    calculatorText = 'Kalkulator Helix';
                    break;
                case 'Parabolic':
                    calculatorUrl = 'https://www.satsig.net/pointing/antenna-beamwidth-calculator.htm';
                    calculatorText = 'Kalkulator Parabolic';
                    break;
                default:
                    calculatorUrl = '#';
                    calculatorText = 'Kalkulator';
            }
            
            if (calculatorLinkBtn) calculatorLinkBtn.href = calculatorUrl;
            if (calculatorLinkText) calculatorLinkText.textContent = calculatorText;
        }

        // Fungsi untuk handle perubahan antena spacecraft
        function handleAntennaChangeSpacecraft(linkDirection) {
            const antennaType = document.getElementById(`jenis_antenaspacecraft_${linkDirection}`)?.value;
            const calculatorLinkDiv = document.getElementById(`calculator_link_${linkDirection}spacecraft`);
            const calculatorLinkBtn = document.getElementById(`calculator_link_btn_${linkDirection}spacecraft`);
            const calculatorLinkText = document.getElementById(`calculator_link_text_${linkDirection}spacecraft`);
            
            if (!antennaType || antennaType === 'User Defined') {
                if (calculatorLinkDiv) calculatorLinkDiv.style.display = 'none';
                return;
            }
            
            // Show calculator link and set appropriate URL and text
            if (calculatorLinkDiv) calculatorLinkDiv.style.display = 'block';
            
            let calculatorUrl = '';
            let calculatorText = '';
            
            switch(antennaType) {
                case 'Monopole':
                    calculatorUrl = 'https://www.changpuak.ch/electronics/lambda_4_gp.php';
                    calculatorText = 'Kalkulator Monopole';
                    break;
                case 'Dipole':
                    calculatorUrl = 'https://www.changpuak.ch/electronics/Dipole_straight.php';
                    calculatorText = 'Kalkulator Dipole';
                    break;
                case 'Patch':
                    calculatorUrl = 'https://www.changpuak.ch/electronics/Microstrip_Patch_Antenna_Calculator.php';
                    calculatorText = 'Kalkulator Patch';
                    break;
                case 'Parabolic':
                    calculatorUrl = 'https://www.satsig.net/pointing/antenna-beamwidth-calculator.htm';
                    calculatorText = 'Kalkulator Parabolic';
                    break;
                default:
                    calculatorUrl = '#';
                    calculatorText = 'Kalkulator';
            }
            
            if (calculatorLinkBtn) calculatorLinkBtn.href = calculatorUrl;
            if (calculatorLinkText) calculatorLinkText.textContent = calculatorText;
        }

        // Functions to open and close the general antenna gain explanation popup
        function openGeneralAntennaGainPopup() {
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none'); // Close all other popups
            document.getElementById('popup_antenna_gain_general').style.display = 'flex';
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        function closeGeneralAntennaGainPopup() {
            document.getElementById('popup_antenna_gain_general').style.display = 'none';
        }


        // Setup event listeners
        function setupEventListeners() {
            ['up', 'down'].forEach(ld => {
                // Input frekuensi memicu kalkulasi panjang gelombang
                const freqField = document.getElementById(`frequency_${ld}grounds`);
                if (freqField) {
                    freqField.addEventListener('input', () => calculateWavelength(ld));
                }

                // Selector Polarisasi
                const polarizationGrounds = document.getElementById(`jenis_polarizationgrounds_${ld}`);
                if(polarizationGrounds) {
                    polarizationGrounds.addEventListener('change', () => handlePolarizationChange('grounds', ld));
                }

                const polarizationSpacecraft = document.getElementById(`jenis_polarizationspacecraft_${ld}`);
                if(polarizationSpacecraft) {
                    polarizationSpacecraft.addEventListener('change', () => handlePolarizationChange('spacecraft', ld));
                }

                // Selector Jenis Antena
                const antennaGroundsSelect = document.getElementById(`jenis_antenagrounds_${ld}`);
                if(antennaGroundsSelect) {
                    antennaGroundsSelect.addEventListener('change', () => handleAntennaChangeGrounds(ld));
                }

                const antennaSpacecraftSelect = document.getElementById(`jenis_antenaspacecraft_${ld}`);
                if(antennaSpacecraftSelect) {
                    antennaSpacecraftSelect.addEventListener('change', () => handleAntennaChangeSpacecraft(ld));
                }
            });

            // Event listener for the general info button
            const infoAntennaGainBtn = document.getElementById('info_antenna_gain_general_btn');
            if (infoAntennaGainBtn) {
                infoAntennaGainBtn.addEventListener('click', openGeneralAntennaGainPopup);
            }

            // Close popups when clicking outside or pressing Escape
            document.addEventListener('click', function(e) {
                if (e.target.id === 'wavelengthPopup') {
                    closeWavelengthPopup();
                }
                if (e.target.id === 'popup_antenna_gain_general') {
                    closeGeneralAntennaGainPopup();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeWavelengthPopup();
                    closeGeneralAntennaGainPopup();
                }
            });
        }

        // Validasi form saat submit
        document.addEventListener('DOMContentLoaded', function() {
            // Setup event listeners
            setupEventListeners();
            
            // Initial setup
            ['up', 'down'].forEach(ld => {
                calculateWavelength(ld); // Ensure wavelength is calculated on load if frequency is present
                checkPolarizationMismatch(ld);
                handleAntennaChangeGrounds(ld);
                handleAntennaChangeSpacecraft(ld);
            });

            // Form validation
            document.getElementById('antennaForm').addEventListener('submit', function(e) {
                let formIsValid = true;
                ['up', 'down'].forEach(ld => {

                    // Validasi ground station user defined
                    const gainGrounds = document.getElementById(`gain_manual_${ld}grounds`);
                    const beamwidthGrounds = document.getElementById(`beamwidth_manual_${ld}grounds`);
                    if (!gainGrounds?.value || !beamwidthGrounds?.value || 
                        parseFloat(gainGrounds.value) < 0 || parseFloat(beamwidthGrounds.value) <= 0) {
                        alert(`Mohon lengkapi Gain (>=0) dan Beamwidth (>0) untuk Ground Station (${ld.toUpperCase()})!`);
                        e.preventDefault();
                        formIsValid = false;
                        return;
                    }

                    // Validasi spacecraft user defined
                    const gainSpacecraft = document.getElementById(`gain_manual_${ld}spacecraft`);
                    const beamwidthSpacecraft = document.getElementById(`beamwidth_manual_${ld}spacecraft`);
                    if (!gainSpacecraft?.value || !beamwidthSpacecraft?.value || 
                        parseFloat(gainSpacecraft.value) < 0 || parseFloat(beamwidthSpacecraft.value) <= 0) {
                        alert(`Mohon lengkapi Gain (>=0) dan Beamwidth (>0) untuk Spacecraft (${ld.toUpperCase()})!`);
                        e.preventDefault();
                        formIsValid = false;
                        return;
                    }
                });
            });
        });
    </script>

    {{-- Script for MathJax --}}
    <script>
        // Konfigurasi MathJax (sesuaikan jika perlu)
        window.MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']], // For inline formulas like $x^2$
                displayMath: [['$$', '$$'], ['\\[', '\\]']], // For block formulas like $$E=mc^2$$
                processEscapes: true, // Allows \$ to display literal dollar signs
                tags: "ams" // For equation numbering (optional)
            },
            options: {
                ignoreHtmlClass: "tex2jax_ignore", // Class to ignore for math processing
                processHtmlClass: "tex2jax_process" // Class to specifically process for math
            },
            loader: {
                load: ['[tex]/ams'] // Load AMS math extensions
            }
        };
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

</x-layout>