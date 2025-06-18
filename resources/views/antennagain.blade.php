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
            padding: 20px 30px 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: fadeInScale 0.3s ease-out;
            box-sizing: border-box;
            margin: 1rem;
        }
        .close-popup-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .close-popup-btn:hover {
            color: #000;
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

        .popup-content h3 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
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
            .input-with-unit-wrapper .unit-text {
                flex-shrink: 0; /* Prevent shrinking of the unit text */
                text-align: right; /* Align unit to the right */
                padding-left: 5px; /* Add a little padding to separate from input */
            }
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="fas fa-satellite-dish mr-2 text-blue-600"></i> Perhitungan Parameter Antenna Gain
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Masukkan parameter Antenna Gain untuk uplink dan downlink.
            </p>

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Uplink Antenna Sistem</h2>
            <div class="bg-blue-50 shadow-lg rounded-lg p-6 mb-8 border border-blue-200">
                <form method="POST" action="{{ route('antennagain.store', ['id' => $dataId]) }}" id="antennaForm">
                    @csrf
                    <input type="hidden" name="user_id" value="1">

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
                            <select name="jenis_antenagrounds_up" id="jenis_antenagrounds_up" onchange="handleAntennaChangeGrounds('up')" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
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
                                <input type="number" name="frequency_upgrounds" id="frequency_upgrounds" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" step="0.01" value="" required>
                                <span class="unit-text">MHz</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="wavelength_upgrounds" id="wavelength_upgrounds" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50" min="0" step="0.001" readonly value="">
                                <span class="unit-text">m</span>
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
                            <label for="jenis_antenaspacecraft_up" class="block font-medium mb-1 text-gray-700">Jenis Antena (Opsional):</label>
                            <select name="jenis_antenaspacecraft_up" id="jenis_antenaspacecraft_up" onchange="handleAntennaChangeSpacecraft('up')" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="">-- Pilih Jenis Antena --</option>
                                <option value="Monopole">Monopole Antenna</option>
                                <option value="Dipole">Dipole Antenna</option>
                                <option value="Patch">Patch Antenna</option>
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
                            <label for="jenis_antenagrounds_down" class="block font-medium mb-1 text-gray-700">Jenis Antena (Opsional):</label>
                            <select name="jenis_antenagrounds_down" id="jenis_antenagrounds_down" onchange="handleAntennaChangeGrounds('down')" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
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
                                <input type="number" name="frequency_downgrounds" id="frequency_downgrounds" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" step="0.01" value="" required>
                                <span class="unit-text">MHz</span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="wavelength_downgrounds" id="wavelength_downgrounds" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50" min="0" step="0.001" readonly value="">
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
                            <label for="jenis_antenaspacecraft_down" class="block font-medium mb-1 text-gray-700">Jenis Antena (Opsional):</label>
                            <select name="jenis_antenaspacecraft_down" id="jenis_antenaspacecraft_down" onchange="handleAntennaChangeSpacecraft('down')" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                <option value="">-- Pilih Jenis Antena --</option>
                                <option value="Monopole">Monopole Antenna</option>
                                <option value="Dipole">Dipole Antenna</option>
                                <option value="Patch">Patch Antenna</option>
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
                    <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Hitung & Simpan Parameter Antenna Gain
                    </button>
                </form>
                <div class="flex justify-between mt-6">
                    <a href="/receiver/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
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
    </div>

    <!-- Popup for wavelength detail -->
    <div id="wavelengthPopup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn" onclick="closeWavelengthPopup()">&times;</span>
            <h3 id="wavelength-popup-title">Detail Perhitungan Panjang Gelombang</h3>
            <div id="wavelength-popup-content-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        λ = c / f<br>
                        Dimana:<br>
                        λ = Panjang gelombang (meter)<br>
                        c = Kecepatan cahaya (~299.8 m/s)<br>
                        f = Frekuensi (Hz)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Panjang gelombang adalah jarak antara titik-titik yang berurutan dari suatu gelombang yang memiliki fasa yang sama. Parameter ini sangat penting dalam desain antena karena dimensi fisik antena seringkali merupakan kelipatan dari panjang gelombang.</p>
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
                const wavelength = 299.8 / frequency; // c = 299.8 m/s (kecepatan cahaya disesuaikan untuk f dalam MHz)
                wavelengthField.value = wavelength.toFixed(6);
            } else {
                wavelengthField.value = '';
            }
        }

        // The showWavelengthDetail function is modified to only show formula and explanation
        function showWavelengthDetail(linkDirection) {
            // No need to get frequency or wavelength values to display in the popup body
            // as per the new requirement, only formula and explanation are static.
            document.getElementById('wavelengthPopup').style.display = 'flex';
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
        }

        // Validasi form saat submit
        document.addEventListener('DOMContentLoaded', function() {
            // Setup event listeners
            setupEventListeners();
            
            // Initial setup
            ['up', 'down'].forEach(ld => {
                checkPolarizationMismatch(ld);
                handleAntennaChangeGrounds(ld);
                handleAntennaChangeSpacecraft(ld);
            });

            // Form validation
            document.getElementById('antennaForm').addEventListener('submit', function(e) {
                let formIsValid = true;
                ['up', 'down'].forEach(ld => {
                    // Validasi frekuensi ground station (harus diisi)
                    const freqField = document.getElementById(`frequency_${ld}grounds`);
                    if (!freqField || !freqField.value || parseFloat(freqField.value) <= 0) {
                        alert(`Mohon isi Frekuensi ${ld.toUpperCase()} Ground Station dengan nilai yang valid!`);
                        e.preventDefault();
                        formIsValid = false;
                        return;
                    }

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

        // Tutup popup jika klik di luar konten atau tekan Escape
        document.addEventListener('click', function(e) {
            if (e.target.id === 'wavelengthPopup') {
                closeWavelengthPopup();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeWavelengthPopup();
            }
        });
    </script>
</x-layout>