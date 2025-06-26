<x-layout>
    <x-slot:title>Uplink & Downlink Budget Calculator</x-slot:title>

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
        }
        .popup-content {
            position: relative;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 600px;
            max-height: 80vh; /* Tinggi maksimum popup, sisanya akan menggulir */
            display: flex; /* Gunakan flexbox untuk layout header dan body */
            flex-direction: column; /* Susun header dan body secara vertikal */
            animation: fadeInScale 0.3s ease-out;
        }

        /* Gaya untuk header popup yang tidak akan menggulir */
        .popup-header {
            padding: 20px 30px 10px; /* Padding untuk header */
            border-bottom: 1px solid #eee; /* Garis bawah pada header */
            position: relative; /* Penting untuk posisi absolut tombol X */
            flex-shrink: 0; /* Pastikan header tidak menyusut */
        }

        .popup-header h3 {
            margin-top: 0; /* Hapus margin top yang mungkin mengganggu */
            color: #2c3e50;
            padding-bottom: 0; /* Hapus padding-bottom default dari h3 di sini */
        }

        /* Gaya untuk tombol tutup (X) */
        .close-popup-btn {
            position: absolute; /* Tetap absolute relatif terhadap popup-header */
            top: 15px;    /* Sesuaikan posisi vertikal dari atas popup-header */
            right: 15px;  /* Sesuaikan posisi horizontal dari kanan popup-header */
            font-size: 24px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: color 0.2s ease;
            z-index: 1001; /* Pastikan tombol di atas konten popup */
            background-color: white; /* Memberikan latar belakang */
            border-radius: 50%; /* Membuat tombol lingkaran */
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Memberikan sedikit bayangan */
        }

        .close-popup-btn:hover {
            color: #000;
        }

        /* Gaya untuk body popup yang akan menggulir */
        .popup-body {
            padding: 20px 30px 30px; /* Padding untuk konten body */
            overflow-y: auto; /* Ini yang memungkinkan konten body discroll */
            flex-grow: 1; /* Biarkan body mengisi sisa ruang yang tersedia */
        }

        .formula {
            background-color: #f5f5f5;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
            margin: 15px 0;
            font-family: 'Cambria Math', 'Times New Roman', serif;
            font-size: 1rem;
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
        input[type="number"],
        input[type="text"] {
            height: 48px;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            box-sizing: border-box;
        }

        .form-field {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .form-field > div:first-child {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            height: 100%;
        }

        .form-field label {
            margin-bottom: 0;
            line-height: 1.25;
            min-height: 2.5em;
            display: flex;
            align-items: flex-end;
            font-weight: 500;
        }

        .input-with-unit-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
        }

        .input-with-unit-wrapper input {
            flex-grow: 1;
            min-width: 0;
        }

        .unit-text {
            color: #4B5563;
            font-size: 0.875rem;
            font-weight: 500;
            min-width: 40px;
            text-align: left;
            white-space: nowrap;
        }

        input[readonly] {
            height: 48px;
            padding: 0.75rem;
            box-sizing: border-box;
        }

        .detail-button-wrapper { /* info-icon-wrapper is removed */
            display: flex;
            justify-content: flex-start;
            margin-top: 0.5rem;
            align-self: flex-start;
        }

        .detail-button-wrapper button { /* info-icon-wrapper button is removed */
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            color: #3B82F6; /* blue-500 */
            font-size: 1rem; /* Adjust size as needed */
            transition: color 0.2s ease; /* Add transition for hover effect */
        }

        .detail-button-wrapper button:hover {
            color: #2563EB; /* blue-600 */
        }

        /* Ensure the labels are always aligned at the bottom of their available space,
            so the inputs below them start at a consistent vertical line */
        .form-field label {
            display: flex;
            align-items: flex-end;
        }

        /* Styling for the new explanation popup content */
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
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-5xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="text-blue-600"></i> Uplink & Downlink Budget Calculator
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Hitung parameter-parameter kunci untuk tautan komunikasi satelit Anda.
            </p>

            {{-- "Apa itu Perhitungan Uplink & Downlink Budget?" button --}}
            <div class="mb-6 text-right animate__animated animate__fadeInUp">
                <button type="button" id="info_budget_general_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">
                    Apa itu Perhitungan Uplink & Downlink Budget? <i class="fas fa-info-circle ml-1"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('updownlinkbudgetatn.store', ['id' => $dataId]) }}" id="updownlinkbudgetatn">
                @csrf

                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800 text-center">Uplink</h2>
                    
                    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-bold mb-4 text-white bg-blue-500 p-2 rounded">Ground Station</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station Transmitter Power Output: </label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="tx_powerwatts_up" name="tx_powerwatts_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->watt_up ?? '' }}" step="any" value="{{ $data->watt_up ?? '' }}" readonly>
                                        <span class="unit-text">watts</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Power in dBW:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="tx_powerdbw_up" name="tx_powerdbw_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_tx_powerdbw_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Power in dBm:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="tx_powerdbm_up" name="tx_powerdbm_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                        <span class="unit-text">dBm</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_tx_powerdbm_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Stn. Total Transmission Line Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="trlinelosses_up" name="trlinelosses_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->totlinelosses_up ?? '' }}" step="any" value="{{ $data->totlinelosses_up ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Antenna Gain:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="antennaagain_up" name="antennaagain_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->gain_manual_upgrounds ?? '' }}" step="any" value="{{ $data->gain_manual_upgrounds ?? '' }}" readonly>
                                        <span class="unit-text">dBi</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station EIRP:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="eirp_up" name="eirp_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_eirp_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-bold mb-4 text-white bg-blue-500 p-2 rounded">Uplink Path</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station Antenna Pointing Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="pointinglosses_up" name="pointinglosses_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->approxannpoinloss_upgrounds_poin ?? '' }}" step="any" value="{{ $data->approxannpoinloss_upgrounds_poin ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Gnd-to-S/C Antenna Polarization Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="polarizationlosses_up" name="polarizationlosses_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->hasilpolarizationloss_up ?? '' }}" step="any" value="{{ $data->hasilpolarizationloss_up ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Path Loss:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="pathlosss_up" name="pathlosss_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->path_loss ?? '' }}" step="any" value="{{ $data->path_loss ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_pathloss_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Atmospheric Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="atmosphericlosses_up" name="atmosphericlosses_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->loss_determined_atmospheric ?? '' }}" step="any" value="{{ $data->loss_determined_atmospheric ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ionospheric Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="ionosphericlosses_up" name="ionosphericlosses_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" 
                                        placeholder="{{ $data->uplink_loss_ionosphere ?? '' }}" step="any" value="{{ $data->uplink_loss_ionosphere ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Rain Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="rainlosses_up" name="rainlosses_up" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                                        placeholder="Enter rain losses">
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="md:col-span-2 lg:col-span-3 relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Isotropic Signal Level at Spacecraft:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="signallevel_up" name="signallevel_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold text-lg" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_signallevel_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-bold mb-4 text-white bg-blue-500 p-2 rounded">Spacecraft Alternative Signal Analysis Method (SNR Computation):</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Antenna Pointing Loss:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="scpointingloss_up" name="scpointingloss_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" 
                                        placeholder="{{ $data->approxannpoinloss_upspacecraft_poin ?? '' }}" step="any" value="{{ $data->approxannpoinloss_upspacecraft_poin ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Antenna Gain:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="scantennagain_up" name="scantennagain_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->gain_manual_upspacecraft ?? '' }}" step="any" value="{{ $data->gain_manual_upspacecraft ?? '' }}" readonly>
                                        <span class="unit-text">dBi</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Total Transmission Line Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="sclinelosses_up" name="sclinelosses_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" 
                                        placeholder="{{ $data->antenna_to_lna_uprec ?? '' }}" step="any" value="{{ $data->antenna_to_lna_uprec ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Effective Noise Temperature:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="scnoisetemp_up" name="scnoisetemp_up" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->ts_uprec ?? '' }}" step="any" value="{{ $data->ts_uprec ?? '' }}" readonly>
                                        <span class="unit-text">K</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Figure of Merit (G/T):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="scgtratio_up" name="scgtratio_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                        <span class="unit-text">dB/K</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_scgtratio_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Signal Power at Spacecraft LNA Input:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="scsignalpower_up" name="scsignalpower_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_scsignalpower_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Receiver Bandwidth:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="scbandwidth_up" name="scbandwidth_up" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter receiver bandwidth">
                                        <span class="unit-text">Hz</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Receiver Noise Power (Pn = kTB):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="scnoisepower_up" name="scnoisepower_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_scnoisepower_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Signal-to-Noise Power Ratio at S/C Rcvr:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="snrratio_up" name="snrratio_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_snrratio_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Analog or Digital System Required S/N:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="requiredsnr_up" name="requiredsnr_up" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter required S/N">
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="md:col-span-2 relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">System Link Margin:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="linkmargin_up" name="linkmargin_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold text-lg" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_linkmargin_up">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                    <h1 class="text-xl font-bold mb-4 text-gray-800 text-center">Downlink</h1>
                    
                    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-bold mb-4 text-white bg-blue-500 p-2 rounded">Spacecraft</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Transmitter Power Output:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="sc_powerwatts_down" name="sc_powerwatts_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->watt_down ?? '' }}" step="any" value="{{ $data->watt_down ?? '' }}" readonly>
                                        <span class="unit-text">watts</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Power in dBW:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="sc_powerdbw_down" name="sc_powerdbw_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_sc_powerdbw_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Power in dBm:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="sc_powerdbm_down" name="sc_powerdbm_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                        <span class="unit-text">dBm</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_sc_powerdbm_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Total Transmission Line Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="sclinelosses_down" name="sclinelosses_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->totlinelosses_down ?? '' }}" step="any" value="{{ $data->totlinelosses_down ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Antenna Gain:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="scantennaagain_down" name="scantennaagain_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->gain_manual_downspacecraft ?? '' }}" step="any" value="{{ $data->gain_manual_downspacecraft ?? '' }}" readonly>
                                        <span class="unit-text">dBi</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft EIRP:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="sceirp_down" name="sceirp_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_sceirp_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-bold mb-4 text-white bg-blue-500 p-2 rounded">Downlink Path</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Spacecraft Antenna Pointing Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="scpointinglosses_down" name="scpointinglosses_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->approxannpoinloss_downspacecraft_poin ?? '' }}" step="any" value="{{ $data->approxannpoinloss_downspacecraft_poin ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">S/C-to-Ground Antenna Polarization Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="polarizationlosses_down" name="polarizationlosses_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->hasilpolarizationloss_down ?? '' }}" step="any" value="{{ $data->hasilpolarizationloss_down ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Path Loss:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="pathlosss_down" name="pathlosss_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->path_loss_downlink ?? '' }}" step="any" value="{{ $data->path_loss_downlink ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_pathloss_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Atmospheric Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="atmosphericlosses_down" name="atmosphericlosses_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->loss_determined_atmospheric ?? '' }}" step="any" value="{{ $data->loss_determined_atmospheric ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ionospheric Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="ionosphericlosses_down" name="ionosphericlosses_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->downlink_loss_ionosphere ?? '' }}" step="any" value="{{ $data->downlink_loss_ionosphere ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Rain Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="rainlosses_down" name="rainlosses_down" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter rain losses">
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="md:col-span-2 lg:col-span-3 relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Isotropic Signal Level at Ground Station:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="signallevel_down" name="signallevel_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold text-lg" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_signallevel_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-bold mb-4 text-white bg-blue-500 p-2 rounded">Ground Station Alternative Signal Analysis Method (SNR Method):</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station Antenna Pointing Loss:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="gspointingloss_down" name="gspointingloss_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->approxannpoinloss_downgrounds_poin ?? '' }}" step="any" value="{{ $data->approxannpoinloss_downgrounds_poin ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station Antenna Gain:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="gsantennagain_down" name="gsantennagain_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->gain_manual_downgrounds ?? '' }}" step="any" value="{{ $data->gain_manual_downgrounds ?? '' }}" readonly>
                                        <span class="unit-text">dBi</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station Total Transmission Line Losses:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="gslinelosses_down" name="gslinelosses_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->antenna_to_lna_downrec ?? '' }}" step="any" value="{{ $data->antenna_to_lna_downrec ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station Effective Noise Temperature:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="gsnoisetemp_down" name="gsnoisetemp_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->ts_downrec ?? '' }}" step="any" value="{{ $data->ts_downrec ?? '' }}" readonly>
                                        <span class="unit-text">K</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station Figure of Merit (G/T):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="gsgtratio_down" name="gsgtratio_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                        <span class="unit-text">dB/K</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_gsgtratio_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Signal Power at Ground Station LNA Input:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="gssignalpower_down" name="gssignalpower_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_gssignalpower_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station Receiver Bandwidth:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="gsbandwidth_down" name="gsbandwidth_down" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter receiver bandwidth">
                                        <span class="unit-text">Hz</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Ground Station Receiver Noise Power (Pn = kTB):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="gsnoisepower_down" name="gsnoisepower_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold" readonly>
                                        <span class="unit-text">dBW</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_gsnoisepower_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Signal-to-Noise Power Ratio at Ground Station Rcvr:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="snrratio_down" name="snrratio_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_snrratio_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">Analog or Digital System Required S/N:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="requiredsnr_down" name="requiredsnr_down" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Enter required S/N">
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                {{-- Removed info icon button for input --}}
                            </div>
                            
                            <div class="md:col-span-2 relative form-field">
                                <div>
                                    <label class="block font-medium text-gray-700">System Link Margin:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="any" id="linkmargin_down" name="linkmargin_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold text-lg" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                </div>
                                <div class="detail-button-wrapper">
                                    <button type="button" id="btn_linkmargin_down">
                                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                    </button>
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

        {{-- Popups Definitions --}}
        
        {{-- General Explanation Popup for Uplink & Downlink Budget --}}
        <div id="popup_budget_general" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Apa itu Perhitungan Uplink & Downlink Budget?</h3>
                </div>
                <div class="popup-body">
                    <div class="explanation-content">
                        <div class="section">
                            <h4 class="section-title">Pengertian Link Budget</h4>
                            <p class="section-content">
                                Perhitungan Link Budget (Anggaran Tautan) adalah analisis sistematis dari semua keuntungan (gain) dan kerugian (loss) sinyal dalam jalur komunikasi, dari pemancar hingga penerima. Tujuannya adalah untuk memastikan bahwa kekuatan sinyal yang cukup (dan kualitas sinyal yang memadai) mencapai penerima untuk memulihkan informasi yang ditransmisikan dengan andal. Ini sangat penting dalam desain sistem komunikasi satelit untuk memprediksi kinerja dan memastikan margin yang memadai untuk mengatasi kondisi lingkungan yang tidak menguntungkan.
                            </p>
                        </div>

                        <div class="section">
                            <h4 class="section-title">Komponen Utama Link Budget</h4>
                            <p class="section-content">
                                Link Budget mempertimbangkan berbagai faktor yang memengaruhi kekuatan sinyal:
                                <ul class="param-list">
                                    <li><strong>Daya Pancar (Transmitter Power):</strong> Daya awal sinyal yang dihasilkan oleh pemancar (stasiun bumi atau satelit).</li>
                                    <li><strong>Kehilangan Jalur Transmisi (Transmission Line Losses):</strong> Kehilangan daya sinyal di kabel, waveguide, konektor, dan filter antara pemancar dan antena, atau antara antena dan penerima.</li>
                                    <li><strong>Gain Antena (Antenna Gain):</strong> Kemampuan antena untuk memfokuskan atau mengumpulkan energi radio ke atau dari arah tertentu.</li>
                                    <li><strong>Kerugian Penunjukan Antena (Antenna Pointing Losses):</strong> Kehilangan sinyal karena ketidaksejajaran sempurna antara antena pemancar dan penerima.</li>
                                    <li><strong>Kerugian Polarisasi (Polarization Losses):</strong> Kehilangan sinyal jika polarisasi gelombang yang dipancarkan dan diterima tidak cocok.</li>
                                    <li><strong>Kehilangan Jalur Ruang Bebas (Free Space Path Loss):</strong> Kehilangan daya sinyal yang paling signifikan, terjadi saat sinyal merambat melalui ruang hampa. Ini bergantung pada frekuensi dan jarak.</li>
                                    <li><strong>Kehilangan Atmosfer (Atmospheric Losses):</strong> Redaman sinyal oleh gas dan uap air di atmosfer Bumi.</li>
                                    <li><strong>Kehilangan Ionosfer (Ionospheric Losses):</strong> Redaman dan efek lain pada sinyal akibat interaksi dengan ionosfer Bumi (lebih relevan pada frekuensi rendah).</li>
                                    <li><strong>Kehilangan Hujan (Rain Losses):</strong> Redaman sinyal akibat penyerapan dan hamburan oleh tetesan hujan (terutama signifikan pada frekuensi tinggi).</li>
                                    <li><strong>Suhu Derau Efektif (Effective Noise Temperature):</strong> Ukuran total derau termal dalam sistem penerima.</li>
                                    <li><strong>Figure of Merit (G/T):</strong> Rasio gain antena terhadap suhu derau sistem, menunjukkan sensitivitas penerima.</li>
                                    <li><strong>Daya Sinyal pada Input LNA (Signal Power at LNA Input):</strong> Kekuatan sinyal yang tersedia di awal rantai penerima.</li>
                                    <li><strong>Bandwidth Penerima (Receiver Bandwidth):</strong> Rentang frekuensi yang diproses oleh penerima.</li>
                                    <li><strong>Daya Derau Penerima (Receiver Noise Power):</strong> Kekuatan derau termal yang dihasilkan dalam penerima (Pn = kTB).</li>
                                    <li><strong>Rasio Sinyal-ke-Derau (Signal-to-Noise Ratio - SNR):</strong> Perbandingan antara kekuatan sinyal yang diinginkan dan kekuatan derau latar belakang. Ini adalah indikator kualitas sinyal.</li>
                                    <li><strong>SNR yang Dibutuhkan (Required SNR):</strong> SNR minimum yang diperlukan untuk mencapai kinerja sistem yang dapat diterima.</li>
                                    <li><strong>Margin Tautan Sistem (System Link Margin):</strong> Cadangan kekuatan sinyal di atas ambang minimum yang diperlukan. Margin positif sangat penting untuk keandalan.</li>
                                </ul>
                            </p>
                        </div>

                        <div class="section">
                            <h4 class="section-title">Uplink dan Downlink</h4>
                            <p class="section-content">
                                Perhitungan Link Budget dibagi menjadi dua arah:
                                <ul class="param-list">
                                    <li><strong>Uplink:</strong> Jalur komunikasi dari Stasiun Bumi (Ground Station) ke Satelit (Spacecraft). Parameter seperti daya pemancar stasiun bumi, gain antena stasiun bumi, dan kerugian jalur menuju satelit dipertimbangkan. Kinerja uplink seringkali dibatasi oleh EIRP stasiun bumi dan G/T satelit.</li>
                                    <li><strong>Downlink:</strong> Jalur komunikasi dari Satelit (Spacecraft) ke Stasiun Bumi (Ground Station). Parameter seperti daya pemancar satelit, gain antena satelit, dan kerugian jalur menuju stasiun bumi dipertimbangkan. Kinerja downlink seringkali dibatasi oleh EIRP satelit dan G/T stasiun bumi.</li>
                                </ul>
                                Masing-masing jalur memiliki karakteristik dan potensi kerugian yang berbeda, sehingga perlu dianalisis secara terpisah untuk mendapatkan gambaran yang akurat tentang kinerja sistem komunikasi secara keseluruhan.
                            </p>
                        </div>

                        <div class="section">
                            <h4 class="section-title">Pentingnya Link Budget</h4>
                            <p class="section-content">
                                Link Budget sangat penting untuk:
                                <ul class="param-list">
                                    <li><strong>Desain Sistem:</strong> Menentukan spesifikasi komponen yang diperlukan (misalnya, daya pemancar, ukuran antena).</li>
                                    <li><strong>Prediksi Kinerja:</strong> Memperkirakan kualitas sinyal dan data yang akan diterima.</li>
                                    <li><strong>Analisis Keandalan:</strong> Memastikan adanya margin yang cukup untuk mengatasi fading dan interferensi.</li>
                                    <li><strong>Troubleshooting:</strong> Membantu mengidentifikasi potensi masalah dalam sistem komunikasi.</li>
                                </ul>
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
        </div>

        {{-- Uplink Popups (Formula and Explanation for Calculated Outputs) --}}
        {{-- These remain as they are for calculated outputs --}}

        <div id="popup_tx_powerdbw_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Power in dBW</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{dBW} = 10 \log_{10}(P_{\text{watts}})$$
                        Dimana:<br>
                        $P_{dBW}$ = Daya dalam dBW<br>
                        $P_{\text{watts}}$ = Daya dalam watt
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Daya dalam **dBW** (decibel-Watts) adalah satuan logaritmik yang digunakan untuk menyatakan daya sinyal relatif terhadap 1 watt. Ini sering digunakan dalam komunikasi satelit karena memudahkan perhitungan ketika daya sinyal dikalikan atau dibagi (menjadi penjumlahan atau pengurangan dalam skala dB).</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_tx_powerdbm_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Power in dBm</h3>
                </div>
                <div class="popup-body">
                    <div>
                        <div class="formula">
                            <strong>Rumus Perhitungan:</strong><br>
                            $$P_{dBm} = 10 \log_{10}(P_{\text{watts}} \times 1000)$$
                            Atau<br>
                            $$P_{dBm} = P_{dBW} + 30$$
                            Dimana:<br>
                            $P_{dBm}$ = Daya dalam dBm<br>
                            $P_{\text{watts}}$ = Daya dalam watt
                        </div>
                        <p><strong>Penjelasan:</strong><br>
                        Daya dalam **dBm** (decibel-milliwatts) adalah satuan logaritmik yang digunakan untuk menyatakan daya sinyal relatif terhadap 1 milliwatt. Ini sering digunakan dalam aplikasi RF berdaya rendah, seperti pada receiver.</p>
                        <p><strong>Sumber:</strong><br>
                        G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="popup_eirp_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Ground Station EIRP</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$\text{EIRP} = P_{tx\_dBW} - L_{\text{line}} + G_{\text{antenna}}$$
                        Dimana:<br>
                        $\text{EIRP}$ = Effective Isotropic Radiated Power (dBW)<br>
                        $P_{tx\_dBW}$ = Ground Station Transmitter Power Output (dBW)<br>
                        $L_{\text{line}}$ = Ground Stn. Total Transmission Line Losses (dB)<br>
                        $G_{\text{antenna}}$ = Antenna Gain (dBi)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **EIRP** (Effective Isotropic Radiated Power) adalah ukuran daya yang dipancarkan oleh antena ke arah tertentu, memperhitungkan daya input ke antena dan gain antena. Ini adalah parameter penting untuk menentukan kekuatan sinyal yang sampai ke satelit.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_pathloss_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Uplink Path Loss</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Umum untuk Path Loss (Free Space Path Loss):</strong><br>
                        $$L_{\text{path}} = 20 \log_{10}(f_{\text{MHz}}) + 20 \log_{10}(R_{\text{km}}) + 92.45$$
                        Atau dengan panjang gelombang:<br>
                        $$L_{\text{path}} = 20 \log_{10}\left(\frac{4 \pi d}{\lambda}\right)$$
                        Dimana:<br>
                        $L_{\text{path}}$ = Path Loss (dB)<br>
                        $f_{\text{MHz}}$ = Frekuensi dalam MHz<br>
                        $R_{\text{km}}$ = Jarak antara pemancar dan penerima dalam kilometer<br>
                        $d$ = Jarak antara pemancar dan penerima (meter)<br>
                        $\lambda$ = Panjang Gelombang (meter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Path Loss** adalah kehilangan daya sinyal saat merambat melalui ruang bebas. Ini adalah kerugian paling signifikan dalam tautan komunikasi satelit dan sangat bergantung pada frekuensi sinyal dan jarak antara pemancar dan penerima. Untuk kalkulator ini, nilai Path Loss dimasukkan secara manual berdasarkan perhitungan terpisah (misalnya, dari kalkulator frekuensi ke path loss).</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_signallevel_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Isotropic Signal Level at Spacecraft</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{sc} = \text{EIRP}_{\text{GS}} - L_{\text{pointing\_GS}} - L_{\text{pol}} - L_{\text{path}} - L_{\text{atm}} - L_{\text{ionos}} - L_{\text{rain}}$$
                        Dimana:<br>
                        $P_{sc}$ = Isotropic Signal Level at Spacecraft (dBW)<br>
                        $\text{EIRP}_{\text{GS}}$ = Ground Station EIRP (dBW)<br>
                        $L_{\text{pointing\_GS}}$ = Ground Station Antenna Pointing Losses (dB)<br>
                        $L_{\text{pol}}$ = Gnd-to-S/C Antenna Polarization Losses (dB)<br>
                        $L_{\text{path}}$ = Path Loss (dB)<br>
                        $L_{\text{atm}}$ = Atmospheric Losses (dB)<br>
                        $L_{\text{ionos}}$ = Ionospheric Losses (dB)<br>
                        $L_{\text{rain}}$ = Rain Losses (dB)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Level sinyal isotropik di satelit** adalah daya sinyal yang diterima oleh satelit, setelah memperhitungkan semua kerugian yang terjadi di sepanjang jalur uplink. Ini adalah indikator penting dari kekuatan sinyal yang tersedia untuk diproses oleh transponder satelit.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_scgtratio_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Spacecraft Figure of Merit (G/T)</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$G/T_{\text{sc}} = G_{\text{sc ant}} - L_{\text{sc line}} - 10 \log_{10}(T_{\text{noise sc}})$$
                        Dimana:<br>
                        $G/T_{\text{sc}}$ = Spacecraft Figure of Merit (dB/K)<br>
                        $G_{\text{sc ant}}$ = Spacecraft Antenna Gain (dBi)<br>
                        $L_{\text{sc line}}$ = Spacecraft Total Transmission Line Losses (dB)<br>
                        $T_{\text{noise sc}}$ = Spacecraft Effective Noise Temperature (K)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Figure of Merit (G/T)** adalah ukuran sensitivitas penerima satelit, menunjukkan seberapa baik satelit dapat menerima sinyal. Nilai G/T yang lebih tinggi menunjukkan penerima yang lebih sensitif.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_scsignalpower_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Signal Power at Spacecraft LNA Input</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{\text{rec sc}} = P_{\text{sc}} + G_{\text{sc ant}} - L_{\text{sc point}} - L_{\text{sc line}}$$
                        Dimana:<br>
                        $P_{\text{rec sc}}$ = Signal Power at Spacecraft LNA Input (dBW)<br>
                        $P_{\text{sc}}$ = Isotropic Signal Level at Spacecraft (dBW)<br>
                        $G_{\text{sc ant}}$ = Spacecraft Antenna Gain (dBi)<br>
                        $L_{\text{sc point}}$ = Spacecraft Antenna Pointing Loss (dB)<br>
                        $L_{\text{sc line}}$ = Spacecraft Total Transmission Line Losses (dB)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Daya sinyal pada input LNA** (Low Noise Amplifier) satelit adalah daya yang diterima oleh bagian pertama dari penerima satelit, setelah dikurangi kerugian penunjukan dan jalur transmisi internal satelit. Ini adalah tingkat sinyal yang relevan untuk perhitungan SNR.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_scnoisepower_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Spacecraft Receiver Noise Power (Pn = kTB)</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_n = 10 \log_{10}(k) + 10 \log_{10}(T_{\text{noise sc}}) + 10 \log_{10}(B_{\text{sc}})$$
                        Dimana:<br>
                        $P_n$ = Noise Power (dBW)<br>
                        $k$ = Konstanta Boltzmann ($1.38 \times 10^{-23}$ J/K atau $-228.6$ dBW/K/Hz)<br>
                        $T_{\text{noise sc}}$ = Spacecraft Effective Noise Temperature (K)<br>
                        $B_{\text{sc}}$ = Spacecraft Receiver Bandwidth (Hz)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Daya derau penerima** adalah daya derau termal yang dihasilkan dalam sistem penerima satelit. Ini merupakan faktor pembatas utama kinerja sistem komunikasi, karena derau bersaing dengan sinyal yang diinginkan.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_snrratio_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Signal-to-Noise Power Ratio at S/C Rcvr</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$\text{SNR} = P_{\text{rec sc}} - P_n$$
                        Dimana:<br>
                        $\text{SNR}$ = Signal-to-Noise Ratio (dB)<br>
                        $P_{\text{rec sc}}$ = Signal Power at Spacecraft LNA Input (dBW)<br>
                        $P_n$ = Spacecraft Receiver Noise Power (dBW)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Rasio sinyal-ke-derau (SNR)** adalah perbandingan antara kekuatan sinyal yang diinginkan dan kekuatan derau latar belakang. Ini adalah metrik kunci untuk kualitas sinyal: SNR yang lebih tinggi berarti sinyal yang lebih jelas dan lebih andal.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_linkmargin_up" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan System Link Margin (Uplink)</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$\text{Link Margin} = \text{SNR}_{\text{actual}} - \text{SNR}_{\text{required}}$$
                        Dimana:<br>
                        $\text{Link Margin}$ = System Link Margin (dB)<br>
                        $\text{SNR}_{\text{actual}}$ = Signal-to-Noise Power Ratio at S/C Rcvr (dB)<br>
                        $\text{SNR}_{\text{required}}$ = Analog or Digital System Required S/N (dB)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Margin tautan** adalah cadangan kekuatan sinyal yang tersedia di atas ambang minimum yang diperlukan untuk komunikasi yang andal. Margin tautan yang positif menunjukkan bahwa sistem memiliki kelebihan daya sinyal untuk mengatasi degradasi sinyal yang tidak terduga, seperti cuaca buruk atau fading. Margin yang lebih tinggi menunjukkan sistem yang lebih kuat.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        {{-- Downlink Popups (Formula and Explanation for Calculated Outputs) --}}
        {{-- These remain as they are for calculated outputs --}}

        <div id="popup_sc_powerdbw_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Power in dBW (Downlink)</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{dBW} = 10 \log_{10}(P_{\text{watts}})$$
                        Dimana:<br>
                        $P_{dBW}$ = Daya dalam dBW<br>
                        $P_{\text{watts}}$ = Daya dalam watt
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Daya dalam **dBW** (decibel-Watts) adalah satuan logaritmik yang digunakan untuk menyatakan daya sinyal relatif terhadap 1 watt. Ini sering digunakan dalam komunikasi satelit karena memudahkan perhitungan ketika daya sinyal dikalikan atau dibagi (menjadi penjumlahan atau pengurangan dalam skala dB).</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_sc_powerdbm_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Power in dBm (Downlink)</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{dBm} = 10 \log_{10}(P_{\text{watts}} \times 1000)$$
                        Atau<br>
                        $$P_{dBm} = P_{dBW} + 30$$
                        Dimana:<br>
                        $P_{dBm}$ = Daya dalam dBm<br>
                        $P_{\text{watts}}$ = Daya dalam watt
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Daya dalam **dBm** (decibel-milliwatts) adalah satuan logaritmik yang digunakan untuk menyatakan daya sinyal relatif terhadap 1 milliwatt. Ini sering digunakan dalam aplikasi RF berdaya rendah.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_sceirp_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Spacecraft EIRP (Downlink)</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$\text{EIRP}_{\text{sc}} = P_{\text{tx sc dBW}} - L_{\text{sc line tx}} + G_{\text{sc antenna tx}}$$
                        Dimana:<br>
                        $\text{EIRP}_{\text{sc}}$ = Spacecraft EIRP (dBW)<br>
                        $P_{\text{tx sc dBW}}$ = Spacecraft Transmitter Power Output (dBW)<br>
                        $L_{\text{sc line tx}}$ = Spacecraft Total Transmission Line Losses (dB)<br>
                        $G_{\text{sc antenna tx}}$ = Spacecraft Antenna Gain (dBi)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **EIRP** (Effective Isotropic Radiated Power) satelit adalah daya yang dipancarkan oleh antena satelit menuju Bumi. Ini adalah parameter penting untuk menentukan kekuatan sinyal yang akan diterima oleh stasiun bumi.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_pathloss_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Downlink Path Loss</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Umum untuk Path Loss (Free Space Path Loss):</strong><br>
                        $$L_{\text{path}} = 20 \log_{10}(f_{\text{MHz}}) + 20 \log_{10}(R_{\text{km}}) + 92.45$$
                        Atau dengan panjang gelombang:<br>
                        $$L_{\text{path}} = 20 \log_{10}\left(\frac{4 \pi d}{\lambda}\right)$$
                        Dimana:<br>
                        $L_{\text{path}}$ = Path Loss (dB)<br>
                        $f_{\text{MHz}}$ = Frekuensi dalam MHz<br>
                        $R_{\text{km}}$ = Jarak antara pemancar dan penerima dalam kilometer<br>
                        $d$ = Jarak antara pemancar dan penerima (meter)<br>
                        $\lambda$ = Panjang Gelombang (meter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Path Loss** adalah kehilangan daya sinyal saat merambat melalui ruang bebas. Ini adalah kerugian paling signifikan dalam tautan komunikasi satelit dan sangat bergantung pada frekuensi sinyal dan jarak antara pemancar dan penerima. Untuk kalkulator ini, nilai Path Loss dimasukkan secara manual berdasarkan perhitungan terpisah (misalnya, dari kalkulator frekuensi ke path loss).</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_signallevel_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Isotropic Signal Level at Ground Station</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{\text{gs}} = \text{EIRP}_{\text{sc}} - L_{\text{pointing sc}} - L_{\text{pol}} - L_{\text{path}} - L_{\text{atm}} - L_{\text{iono}} - L_{\text{rain}}$$
                        Dimana:<br>
                        $P_{\text{gs}}$ = Isotropic Signal Level at Ground Station (dBW)<br>
                        $\text{EIRP}_{\text{sc}}$ = Spacecraft EIRP (dBW)<br>
                        $L_{\text{pointing sc}}$ = Spacecraft Antenna Pointing Losses (dB)<br>
                        $L_{\text{pol}}$ = S/C-to-Ground Antenna Polarization Losses (dB)<br>
                        $L_{\text{path}}$ = Path Loss (dB)<br>
                        $L_{\text{atm}}$ = Atmospheric Losses (dB)<br>
                        $L_{\text{iono}}$ = Ionospheric Losses (dB)<br>
                        $L_{\text{rain}}$ = Rain Losses (dB)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Level sinyal isotropik di stasiun bumi** adalah daya sinyal yang diterima oleh stasiun bumi, setelah memperhitungkan semua kerugian yang terjadi di sepanjang jalur downlink. Ini adalah indikator penting dari kekuatan sinyal yang tersedia untuk diproses oleh penerima stasiun bumi.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_gsgtratio_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Ground Station Figure of Merit (G/T)</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$G/T_{\text{GS}} = G_{\text{gs ant}} - L_{\text{gs line}} - 10 \log_{10}(T_{\text{noise gs}})$$
                        Dimana:<br>
                        $G/T_{\text{GS}}$ = Ground Station Figure of Merit (dB/K)<br>
                        $G_{\text{gs ant}}$ = Ground Station Antenna Gain (dBi)<br>
                        $L_{\text{gs line}}$ = Ground Station Total Transmission Line Losses (dB)<br>
                        $T_{\text{noise gs}}$ = Ground Station Effective Noise Temperature (K)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Figure of Merit (G/T)** adalah ukuran sensitivitas penerima stasiun bumi, menunjukkan seberapa baik stasiun bumi dapat menerima sinyal dari satelit. Nilai G/T yang lebih tinggi menunjukkan penerima yang lebih sensitif.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_gssignalpower_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Signal Power at Ground Station LNA Input</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{\text{rec gs}} = P_{\text{gs}} + G_{\text{gs ant}} - L_{\text{gs point}} - L_{\text{gs line}}$$
                        Dimana:<br>
                        $P_{\text{rec gs}}$ = Signal Power at Ground Station LNA Input (dBW)<br>
                        $P_{\text{gs}}$ = Isotropic Signal Level at Ground Station (dBW)<br>
                        $G_{\text{gs ant}}$ = Ground Station Antenna Gain (dBi)<br>
                        $L_{\text{gs point}}$ = Ground Station Antenna Pointing Loss (dB)<br>
                        $L_{\text{gs line}}$ = Ground Station Total Transmission Line Losses (dB)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Daya sinyal pada input LNA** (Low Noise Amplifier) stasiun bumi adalah daya yang diterima oleh bagian pertama dari penerima stasiun bumi, setelah dikurangi kerugian penunjukan dan jalur transmisi internal stasiun bumi. Ini adalah tingkat sinyal yang relevan untuk perhitungan SNR.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_gsnoisepower_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan G.S. Receiver Noise Power (Pn = kTB)</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_n = 10 \log_{10}(k) + 10 \log_{10}(T_{\text{noise gs}}) + 10 \log_{10}(B_{\text{gs}})$$
                        Dimana:<br>
                        $P_n$ = Noise Power (dBW)<br>
                        $k$ = Konstanta Boltzmann ($1.38 \times 10^{-23}$ J/K atau $-228.6$ dBW/K/Hz)<br>
                        $T_{\text{noise gs}}$ = Ground Station Effective Noise Temperature (K)<br>
                        $B_{\text{gs}}$ = Ground Station Receiver Bandwidth (Hz)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Daya derau penerima** adalah daya derau termal yang dihasilkan dalam sistem penerima stasiun bumi. Ini merupakan faktor pembatas utama kinerja sistem komunikasi, karena derau bersaing dengan sinyal yang diinginkan.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_snrratio_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan Signal-to-Noise Power Ratio at G.S. Rcvr</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$\text{SNR} = P_{\text{rec gs}} - P_n$$
                        Dimana:<br>
                        $\text{SNR}$ = Signal-to-Noise Ratio (dB)<br>
                        $P_{\text{rec gs}}$ = Signal Power at Ground Station LNA Input (dBW)<br>
                        $P_n$ = G.S. Receiver Noise Power (dBW)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Rasio sinyal-ke-derau (SNR)** adalah perbandingan antara kekuatan sinyal yang diinginkan dan kekuatan derau latar belakang. Ini adalah metrik kunci untuk kualitas sinyal: SNR yang lebih tinggi berarti sinyal yang lebih jelas dan lebih andal.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

        <div id="popup_linkmargin_down" class="popup-window">
            <div class="popup-content">
                <div class="popup-header">
                    <span class="close-popup-btn">&times;</span>
                    <h3>Detail Perhitungan System Link Margin (Downlink)</h3>
                </div>
                <div class="popup-body">
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$\text{Link Margin} = \text{SNR}_{\text{actual}} - \text{SNR}_{\text{required}}$$
                        Dimana:<br>
                        $\text{Link Margin}$ = System Link Margin (dB)<br>
                        $\text{SNR}_{\text{actual}}$ = Signal-to-Noise Power Ratio at G.S. Rcvr (dB)<br>
                        $\text{SNR}_{\text{required}}$ = Analog or Digital System Required S/N (dB)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Margin tautan** adalah cadangan kekuatan sinyal yang tersedia di atas ambang minimum yang diperlukan untuk komunikasi yang andal. Margin tautan yang positif menunjukkan bahwa sistem memiliki kelebihan daya sinyal untuk mengatasi degradasi sinyal yang tidak terduga, seperti cuaca buruk atau fading. Margin yang lebih tinggi menunjukkan sistem yang lebih kuat.</p>
                    <p><strong>Sumber:</strong><br>
                    G. Maral and M. Bousquet, "Satellite Communications Systems: Systems, Techniques and Technology," Wiley, latest edition.</p>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Konstanta Boltzmann
        const K = 1.38e-23; // J/K
        const K_DBW = -228.6; // dBW/K/Hz (10 * log10(1.38e-23))

        // Fungsi umum untuk membuka pop-up
        function openPopup(popupId) {
            // Close all other open popups, to ensure only one popup is visible
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none'); 
            
            document.getElementById(popupId).style.display = "flex";
            // Important: After opening, if MathJax is loaded, re-render math formulas
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        // Fungsi umum untuk menutup pop-up
        document.querySelectorAll('.close-popup-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            };
        });

        // Event listener for the "Apa itu Perhitungan Uplink & Downlink Budget?" button
        document.getElementById('info_budget_general_btn').onclick = () => openPopup('popup_budget_general');

        // Event Listeners for all "Lihat Detail" buttons (for calculated outputs)
        document.getElementById('btn_tx_powerdbw_up').onclick = () => openPopup('popup_tx_powerdbw_up');
        document.getElementById('btn_tx_powerdbm_up').onclick = () => openPopup('popup_tx_powerdbm_up');
        document.getElementById('btn_eirp_up').onclick = () => openPopup('popup_eirp_up');
        document.getElementById('btn_pathloss_up').onclick = () => openPopup('popup_pathloss_up');
        document.getElementById('btn_signallevel_up').onclick = () => openPopup('popup_signallevel_up');
        document.getElementById('btn_scgtratio_up').onclick = () => openPopup('popup_scgtratio_up');
        document.getElementById('btn_scsignalpower_up').onclick = () => openPopup('popup_scsignalpower_up');
        document.getElementById('btn_scnoisepower_up').onclick = () => openPopup('popup_scnoisepower_up');
        document.getElementById('btn_snrratio_up').onclick = () => openPopup('popup_snrratio_up');
        document.getElementById('btn_linkmargin_up').onclick = () => openPopup('popup_linkmargin_up');

        document.getElementById('btn_sc_powerdbw_down').onclick = () => openPopup('popup_sc_powerdbw_down');
        document.getElementById('btn_sc_powerdbm_down').onclick = () => openPopup('popup_sc_powerdbm_down');
        document.getElementById('btn_sceirp_down').onclick = () => openPopup('popup_sceirp_down');
        document.getElementById('btn_pathloss_down').onclick = () => openPopup('popup_pathloss_down');
        document.getElementById('btn_signallevel_down').onclick = () => openPopup('popup_signallevel_down');
        document.getElementById('btn_gsgtratio_down').onclick = () => openPopup('popup_gsgtratio_down');
        document.getElementById('btn_gssignalpower_down').onclick = () => openPopup('popup_gssignalpower_down');
        document.getElementById('btn_gsnoisepower_down').onclick = () => openPopup('popup_gsnoisepower_down');
        document.getElementById('btn_snrratio_down').onclick = () => openPopup('popup_snrratio_down');
        document.getElementById('btn_linkmargin_down').onclick = () => openPopup('popup_linkmargin_down');

        // Removed all info icon buttons (e.g., btn_tx_powerwatts_up_info) as per request.
        // The buttons that remain are associated with calculated outputs and already have 'Lihat Detail' text.


        // Main Calculation Function
        function calculateUplinkDownlink() {
            // Uplink Calculations
            const txPowerWattsUp = parseFloat(document.getElementById('tx_powerwatts_up').value);
            const trLineLossesUp = parseFloat(document.getElementById('trlinelosses_up').value);
            const antennaGainUp = parseFloat(document.getElementById('antennaagain_up').value);
            const pointingLossesUp = parseFloat(document.getElementById('pointinglosses_up').value);
            const polarizationLossesUp = parseFloat(document.getElementById('polarizationlosses_up').value);
            const pathLossUp = parseFloat(document.getElementById('pathlosss_up').value);
            const atmosphericLossesUp = parseFloat(document.getElementById('atmosphericlosses_up').value);
            const ionosphericLossesUp = parseFloat(document.getElementById('ionosphericlosses_up').value);
            const rainLossesUp = parseFloat(document.getElementById('rainlosses_up').value);
            const scPointingLossUp = parseFloat(document.getElementById('scpointingloss_up').value);
            const scAntennaGainUp = parseFloat(document.getElementById('scantennagain_up').value);
            const scLineLossesUp = parseFloat(document.getElementById('sclinelosses_up').value);
            const scNoiseTempUp = parseFloat(document.getElementById('scnoisetemp_up').value);
            const scBandwidthUp = parseFloat(document.getElementById('scbandwidth_up').value);
            const requiredSnrUp = parseFloat(document.getElementById('requiredsnr_up').value);

            let txPowerDbwUp, txPowerDbmUp, eirpUp, signalLevelUp, scGtratioUp, scSignalPowerUp, scNoisePowerUp, snrRatioUp, linkMarginUp;

            if (!isNaN(txPowerWattsUp) && txPowerWattsUp > 0) {
                txPowerDbwUp = 10 * Math.log10(txPowerWattsUp);
                txPowerDbmUp = 10 * Math.log10(txPowerWattsUp * 1000);
            } else {
                txPowerDbwUp = NaN;
                txPowerDbmUp = NaN;
            }
            document.getElementById('tx_powerdbw_up').value = isNaN(txPowerDbwUp) ? '' : txPowerDbwUp.toFixed(3);
            document.getElementById('tx_powerdbm_up').value = isNaN(txPowerDbmUp) ? '' : txPowerDbmUp.toFixed(3);

            if (!isNaN(txPowerDbwUp) && !isNaN(trLineLossesUp) && !isNaN(antennaGainUp)) {
                eirpUp = txPowerDbwUp - trLineLossesUp + antennaGainUp;
            } else {
                eirpUp = NaN;
            }
            document.getElementById('eirp_up').value = isNaN(eirpUp) ? '' : eirpUp.toFixed(3);

            if (!isNaN(eirpUp) && !isNaN(pointingLossesUp) && !isNaN(polarizationLossesUp) && !isNaN(pathLossUp) && !isNaN(atmosphericLossesUp) && !isNaN(ionosphericLossesUp) && !isNaN(rainLossesUp)) {
                signalLevelUp = eirpUp - pointingLossesUp - polarizationLossesUp - pathLossUp - atmosphericLossesUp - ionosphericLossesUp - rainLossesUp;
            } else {
                signalLevelUp = NaN;
            }
            document.getElementById('signallevel_up').value = isNaN(signalLevelUp) ? '' : signalLevelUp.toFixed(3);

            if (!isNaN(scAntennaGainUp) && !isNaN(scLineLossesUp) && !isNaN(scNoiseTempUp) && scNoiseTempUp > 0) {
                scGtratioUp = scAntennaGainUp - scLineLossesUp - (10 * Math.log10(scNoiseTempUp));
            } else {
                scGtratioUp = NaN;
            }
            document.getElementById('scgtratio_up').value = isNaN(scGtratioUp) ? '' : scGtratioUp.toFixed(3);


            if (!isNaN(signalLevelUp) && !isNaN(scAntennaGainUp) && !isNaN(scPointingLossUp) && !isNaN(scLineLossesUp)) {
                scSignalPowerUp = signalLevelUp + scAntennaGainUp - scPointingLossUp - scLineLossesUp;
            } else {
                scSignalPowerUp = NaN;
            }
            document.getElementById('scsignalpower_up').value = isNaN(scSignalPowerUp) ? '' : scSignalPowerUp.toFixed(3);

            if (!isNaN(scNoiseTempUp) && scNoiseTempUp > 0 && !isNaN(scBandwidthUp) && scBandwidthUp > 0) {
                scNoisePowerUp = K_DBW + (10 * Math.log10(scNoiseTempUp)) + (10 * Math.log10(scBandwidthUp));
            } else {
                scNoisePowerUp = NaN;
            }
            document.getElementById('scnoisepower_up').value = isNaN(scNoisePowerUp) ? '' : scNoisePowerUp.toFixed(3);

            if (!isNaN(scSignalPowerUp) && !isNaN(scNoisePowerUp)) {
                snrRatioUp = scSignalPowerUp - scNoisePowerUp;
            } else {
                snrRatioUp = NaN;
            }
            document.getElementById('snrratio_up').value = isNaN(snrRatioUp) ? '' : snrRatioUp.toFixed(3);

            if (!isNaN(snrRatioUp) && !isNaN(requiredSnrUp)) {
                linkMarginUp = snrRatioUp - requiredSnrUp;
            } else {
                linkMarginUp = NaN;
            }
            document.getElementById('linkmargin_up').value = isNaN(linkMarginUp) ? '' : linkMarginUp.toFixed(3);

            // Downlink Calculations
            const scPowerWattsDown = parseFloat(document.getElementById('sc_powerwatts_down').value);
            const scLineLossesDown = parseFloat(document.getElementById('sclinelosses_down').value);
            const scAntennaGainDown = parseFloat(document.getElementById('scantennaagain_down').value);
            const scPointingLossesDown = parseFloat(document.getElementById('scpointinglosses_down').value);
            const polarizationLossesDown = parseFloat(document.getElementById('polarizationlosses_down').value);
            const pathLossDown = parseFloat(document.getElementById('pathlosss_down').value);
            const atmosphericLossesDown = parseFloat(document.getElementById('atmosphericlosses_down').value);
            const ionosphericLossesDown = parseFloat(document.getElementById('ionosphericlosses_down').value);
            const rainLossesDown = parseFloat(document.getElementById('rainlosses_down').value);
            const gsPointingLossDown = parseFloat(document.getElementById('gspointingloss_down').value);
            const gsAntennaGainDown = parseFloat(document.getElementById('gsantennagain_down').value);
            const gsLineLossesDown = parseFloat(document.getElementById('gslinelosses_down').value);
            const gsNoiseTempDown = parseFloat(document.getElementById('gsnoisetemp_down').value);
            const gsBandwidthDown = parseFloat(document.getElementById('gsbandwidth_down').value);
            const requiredSnrDown = parseFloat(document.getElementById('requiredsnr_down').value);

            let scPowerDbwDown, scPowerDbmDown, sceirpDown, signalLevelDown, gsGtratioDown, gsSignalPowerDown, gsNoisePowerDown, snrRatioDown, linkMarginDown;

            if (!isNaN(scPowerWattsDown) && scPowerWattsDown > 0) {
                scPowerDbwDown = 10 * Math.log10(scPowerWattsDown);
                scPowerDbmDown = 10 * Math.log10(scPowerWattsDown * 1000);
            } else {
                scPowerDbwDown = NaN;
                scPowerDbmDown = NaN;
            }
            document.getElementById('sc_powerdbw_down').value = isNaN(scPowerDbwDown) ? '' : scPowerDbwDown.toFixed(3);
            document.getElementById('sc_powerdbm_down').value = isNaN(scPowerDbmDown) ? '' : scPowerDbmDown.toFixed(3);

            if (!isNaN(scPowerDbwDown) && !isNaN(scLineLossesDown) && !isNaN(scAntennaGainDown)) {
                sceirpDown = scPowerDbwDown - scLineLossesDown + scAntennaGainDown;
            } else {
                sceirpDown = NaN;
            }
            document.getElementById('sceirp_down').value = isNaN(sceirpDown) ? '' : sceirpDown.toFixed(3);

            if (!isNaN(sceirpDown) && !isNaN(scPointingLossesDown) && !isNaN(polarizationLossesDown) && !isNaN(pathLossDown) && !isNaN(atmosphericLossesDown) && !isNaN(ionosphericLossesDown) && !isNaN(rainLossesDown)) {
                signalLevelDown = sceirpDown - scPointingLossesDown - polarizationLossesDown - pathLossDown - atmosphericLossesDown - ionosphericLossesDown - rainLossesDown;
            } else {
                signalLevelDown = NaN;
            }
            document.getElementById('signallevel_down').value = isNaN(signalLevelDown) ? '' : signalLevelDown.toFixed(3);

            if (!isNaN(gsAntennaGainDown) && !isNaN(gsLineLossesDown) && !isNaN(gsNoiseTempDown) && gsNoiseTempDown > 0) {
                gsGtratioDown = gsAntennaGainDown - gsLineLossesDown - (10 * Math.log10(gsNoiseTempDown));
            } else {
                gsGtratioDown = NaN;
            }
            document.getElementById('gsgtratio_down').value = isNaN(gsGtratioDown) ? '' : gsGtratioDown.toFixed(3);

            if (!isNaN(signalLevelDown) && !isNaN(gsAntennaGainDown) && !isNaN(gsPointingLossDown) && !isNaN(gsLineLossesDown)) {
                gsSignalPowerDown = signalLevelDown + gsAntennaGainDown - gsPointingLossDown - gsLineLossesDown;
            } else {
                gsSignalPowerDown = NaN;
            }
            document.getElementById('gssignalpower_down').value = isNaN(gsSignalPowerDown) ? '' : gsSignalPowerDown.toFixed(3);

            if (!isNaN(gsNoiseTempDown) && gsNoiseTempDown > 0 && !isNaN(gsBandwidthDown) && gsBandwidthDown > 0) {
                gsNoisePowerDown = K_DBW + (10 * Math.log10(gsNoiseTempDown)) + (10 * Math.log10(gsBandwidthDown));
            } else {
                gsNoisePowerDown = NaN;
            }
            document.getElementById('gsnoisepower_down').value = isNaN(gsNoisePowerDown) ? '' : gsNoisePowerDown.toFixed(3);

            if (!isNaN(gsSignalPowerDown) && !isNaN(gsNoisePowerDown)) {
                snrRatioDown = gsSignalPowerDown - gsNoisePowerDown;
            } else {
                snrRatioDown = NaN;
            }
            document.getElementById('snrratio_down').value = isNaN(snrRatioDown) ? '' : snrRatioDown.toFixed(3);

            if (!isNaN(snrRatioDown) && !isNaN(requiredSnrDown)) {
                linkMarginDown = snrRatioDown - requiredSnrDown;
            } else {
                linkMarginDown = NaN;
            }
            document.getElementById('linkmargin_down').value = isNaN(linkMarginDown) ? '' : linkMarginDown.toFixed(3);
        }

        // Add event listeners to all input fields to trigger recalculation on input
        document.querySelectorAll('#updownlinkbudgetatn input[type="number"]').forEach(input => {
            input.addEventListener('input', calculateUplinkDownlink);
        });
        
        // Initial calculation on page load
        document.addEventListener('DOMContentLoaded', () => {
            calculateUplinkDownlink();
            // Re-render MathJax on load for all popups
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        });
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