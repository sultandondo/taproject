<x-layout>
    <x-slot:title>Form Transmitter</x-slot>

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
            padding: 20px 30px 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            animation: fadeInScale 0.3s ease-out;
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
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Specific styles for new layout */
        .input-group > div {
            margin-bottom: 1rem; /* Add some space between vertically stacked inputs */
        }
        .input-group > div:last-child {
            margin-bottom: 0; /* No margin after the last one in the group */
        }
        
        /* Ensured consistent input height */
        input[type="number"],
        input[type="text"] {
            height: 48px; /* Tailwind's p-3 usually results in this height */
            padding-right: 0.75rem; /* p-3 default */
        }

        /* Gaya untuk pembungkus input dan unit */
        .input-with-unit-wrapper {
            display: flex; /* Menggunakan flexbox untuk mensejajarkan input dan unit */
            align-items: center; /* Pusatkan vertikal */
            gap: 0.5rem; /* Jarak antara input dan unit */
        }

        /* Gaya untuk unit teks di luar input */
        .unit-text {
            color: #4B5563; /* gray-700 */
            font-size: 0.875rem; /* text-sm */
            font-weight: 500; /* Medium font weight */
            min-width: 40px; /* Memberikan lebar minimum agar tidak terlalu mepet jika teks unit pendek */
            text-align: left; /* Biarkan teks unit rata kiri */
        }

        /* --- RESPONSIVE ADJUSTMENTS --- */
        /* For screens smaller than 'sm' (640px) */
        @media (max-width: 639px) {
            .flex-row-sm-up { /* Change from flex-row to flex-col on small screens */
                flex-direction: column;
                gap: 1rem; /* Add vertical gap */
            }
            .flex-row-sm-up > div { /* Make inner divs full width */
                width: 100% !important; /* Override w-1/3, w-1/2 */
            }
            .space-x-6-sm-up { /* Remove horizontal space on small screens */
                margin-left: 0 !important;
                margin-right: 0 !important;
                gap: 1rem; /* Add vertical gap */
            }
        }

        /* For screens smaller than 'md' (768px) */
        @media (max-width: 767px) {
            .px-4.sm\\:px-6.lg\\:px-8 { /* Adjust overall padding for smaller screens */
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .max-w-3xl { /* Limit max-width to be more flexible */
                max-width: 100%;
            }
            .text-3xl.sm\\:text-4xl { /* Adjust heading size */
                font-size: 2rem; /* text-2xl */
            }
            .text-lg { /* Adjust paragraph size */
                font-size: 1rem; /* text-base */
            }
            .flex-col-md-up { /* New class for horizontal flex items to stack vertically */
                flex-direction: column;
                gap: 1rem; /* Add vertical gap */
            }
            .flex-col-md-up > div {
                width: 100% !important;
            }
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl transform transition-all duration-300 hover:shadow-3xl border-t-8 border-blue-600">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                    <i class="fas fa-satellite-dish mr-2 text-blue-600"></i> Perhitungan Parameter Transmitter
                </h1>
                <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                    Masukkan parameter Transmitter untuk uplink dan downlink.
                </p>

                <form method="POST" action="{{ route('transmitter.store', $dataId)}}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Uplink</h2>
                        <div class="input-group flex flex-col md:flex-row md:space-x-6"> <div class="relative w-full md:w-1/3"> <label for="watt_up" class="block font-medium mb-2 text-gray-700">Transmitter Power (Watt):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" id="watt_up" name="watt_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan nilai Watt" oninput="calculatePowerUp()">
                                    <span class="unit-text">W</span>
                                </div>
                            </div>

                            <div class="relative w-full md:w-1/3"> <label for="dbw_up" class="block font-medium mb-2 text-gray-700">Transmitter Power (dBW):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="dbw_up" name="dbw_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil dBW" readonly>
                                    <span class="unit-text">dBW</span>
                                </div>
                                <button type="button" id="dbw_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative w-full md:w-1/3"> <label for="dbm_up" class="block font-medium mb-2 text-gray-700">Transmitter Power (dBm):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="dbm_up" name="dbm_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil dBm" readonly>
                                    <span class="unit-text">dBm</span>
                                </div>
                                <button type="button" id="dbm_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <p class="form-section-label">Cable or Waveguide ("Line") Losses:</p>

                        <div class="input-group flex flex-col md:flex-row md:space-x-6 items-start"> <div class="w-full md:w-1/3"> <label for="alength_up" class="block font-medium mb-2 text-gray-700">Line A Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" id="alength_up" name="alength_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan Nilai" oninput="calculateTotalLengthUp();">
                                    <span class="unit-text">m</span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/3"> <label for="blength_up" class="block font-medium mb-2 text-gray-700">Line B Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" id="blength_up" name="blength_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan Nilai" oninput="calculateTotalLengthUp();">
                                    <span class="unit-text">m</span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/3"> <label for="clength_up" class="block font-medium mb-2 text-gray-700">Line C Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" id="clength_up" name="clength_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan Nilai" oninput="calculateTotalLengthUp();">
                                    <span class="unit-text">m</span>
                                </div>
                            </div>
                        </div>

                        <div class="relative w-full md:w-1/3"> <label for="totlength_up" class="block font-medium mb-2 text-gray-700">Total Line Length (Line A+B+C):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="text" id="totlength_up" name="totlength_up"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                    placeholder="Hasil Total Length" readonly>
                                <span class="unit-text">m</span>
                            </div>
                            <button type="button" id="totlength_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="relative mt-4">
                            <label for="cabletype_up" class="block font-medium mb-2 text-gray-700">Cable/Waveguide Type:</label>
                            <input type="text" name="cabletype_up" id="cabletype_up" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm" placeholder="Jenis Kabel/Waveguide">
                        </div>

                        <div class="input-group flex flex-col md:flex-row md:space-x-6 items-start mt-4"> <div class="w-full md:w-1/2 relative"> <label for="guideloss_up" class="block font-medium mb-2 text-gray-700">Cable/Waveguide Loss (dB/m):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" id="guideloss_up" name="guideloss_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan Nilai" oninput="calculateTotalLossUp();">
                                    <span class="unit-text">dB/m</span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 relative"> <label for="totalloss_up" class="block font-medium mb-2 text-gray-700">Total Cable Loss (dB):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="totalloss_up" name="totalloss_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil Total Loss" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="totalloss_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <p class="form-section-label">Other Components in Line:</p>

                        <div class="input-group flex flex-col md:flex-row md:space-x-6 items-start"> <div class="w-full md:w-1/2 relative"> <label for="connect_up" class="block font-medium mb-2 text-gray-700">Number of In-Line Connectors:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="1" id="connect_up" name="connect_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Jumlah Konektor" oninput="calculateTotalConnectorUp();">
                                    <span class="unit-text">unit</span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 relative"> <label for="totconnect_up" class="block font-medium mb-2 text-gray-700">Total Connector Loss (dB):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="totconnect_up" name="totconnect_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil Total Connector Loss" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="totconnect_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <div class="relative mt-4">
                            <label for="filter_up" class="block font-medium mb-2 text-gray-700">Filter Insertion Losses (dB):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="0.001" name="filter_up" id="filter_up"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Masukkan Nilai" oninput="calculateTotalLineLossesUp()">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>

                        <p class="form-section-label">Other In Line Losses:</p>

                        <div class="input-group flex flex-col md:flex-row md:space-x-6"> <div class="relative w-full md:w-1/2"> <label for="device_up_name" class="block font-medium mb-2 text-gray-700">Device Name:</label>
                                <input type="text" name="device_up" id="device_up_name"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Masukkan nama device">
                            </div>
                            <div class="relative w-full md:w-1/2 mt-4 md:mt-0"> <label for="devicee_up" class="block font-medium mb-2 text-gray-700">Device Loss (dB):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" name="devicee_up" id="devicee_up"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan nilai" oninput="calculateTotalLineLossesUp()">
                                    <span class="unit-text">dB</span>
                                </div>
                            </div>
                        </div>

                        <div class="relative mt-4">
                            <label for="atn_up" class="block font-medium mb-2 text-gray-700">Antenna Mismatch Losses (dB):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="0.001" name="atn_up" id="atn_up"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Masukkan Nilai" oninput="calculateTotalLineLossesUp()">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>
                        
                        <div class="relative mt-4">
                            <label for="totlinelosses_up" class="block font-medium mb-2 text-gray-700">Total Line Losses (dB):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="totlinelosses_up" id="totlinelosses_up"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                    placeholder="Hasil Total Line Losses" readonly>
                                <span class="unit-text">dB</span>
                            </div>
                            <button type="button" id="totlinelosses_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="relative mt-4">
                            <label class="block font-medium mb-2 text-gray-700">Total Power Deliver to Antenna (dBW):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="totpowerdeliv_up" id="totpowerdeliv_up"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                    placeholder="Hasil Total Power Delivered" readonly>
                                <span class="unit-text">dBW</span>
                            </div>
                            <button type="button" id="totpowerdeliv_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Downlink</h2>
                        <div class="input-group flex flex-col md:flex-row md:space-x-6"> <div class="relative w-full md:w-1/3"> <label for="watt_down" class="block font-medium mb-2 text-gray-700">Transmitter Power (Watt):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" id="watt_down" name="watt_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan nilai Watt" oninput="calculatePowerDown()">
                                    <span class="unit-text">W</span>
                                </div>
                            </div>

                            <div class="relative w-full md:w-1/3"> <label for="dbw_down" class="block font-medium mb-2 text-gray-700">Transmitter Power (dBW):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="dbw_down" name="dbw_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil dBW" readonly>
                                    <span class="unit-text">dBW</span>
                                </div>
                                <button type="button" id="dbw_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative w-full md:w-1/3"> <label for="dbm_down" class="block font-medium mb-2 text-gray-700">Transmitter Power (dBm):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="dbm_down" name="dbm_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil dBm" readonly>
                                    <span class="unit-text">dBm</span>
                                </div>
                                <button type="button" id="dbm_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <p class="form-section-label">Cable or Waveguide ("Line") Losses:</p>

                        <div class="input-group flex flex-col md:flex-row md:space-x-6 items-start"> <div class="w-full md:w-1/3"> <label for="alength_down" class="block font-medium mb-2 text-gray-700">Line A Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" id="alength_down" name="alength_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan Nilai" oninput="calculateTotalLengthDown();">
                                    <span class="unit-text">m</span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/3"> <label for="blength_down" class="block font-medium mb-2 text-gray-700">Line B Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" id="blength_down" name="blength_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan Nilai" oninput="calculateTotalLengthDown();">
                                    <span class="unit-text">m</span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/3"> <label for="clength_down" class="block font-medium mb-2 text-gray-700">Line C Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" id="clength_down" name="clength_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan Nilai" oninput="calculateTotalLengthDown();">
                                    <span class="unit-text">m</span>
                                </div>
                            </div>
                        </div>

                        <div class="relative w-full md:w-1/3"> <label for="totlength_down" class="block font-medium mb-2 text-gray-700">Total Line Length (Line A+B+C):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="text" id="totlength_down" name="totlength_down"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                    placeholder="Hasil Total Length" readonly>
                                <span class="unit-text">m</span>
                            </div>
                            <button type="button" id="totlength_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="relative mt-4">
                            <label for="cabletype_down" class="block font-medium mb-2 text-gray-700">Cable/Waveguide Type:</label>
                            <input type="text" name="cabletype_down" id="cabletype_down" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm" placeholder="Jenis Kabel/Waveguide">
                        </div>

                        <div class="input-group flex flex-col md:flex-row md:space-x-6 items-start mt-4"> <div class="w-full md:w-1/2 relative"> <label for="guideloss_down" class="block font-medium mb-2 text-gray-700">Cable/Waveguide Loss (dB/m):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" id="guideloss_down" name="guideloss_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan Nilai" oninput="calculateTotalLossDown();">
                                    <span class="unit-text">dB/m</span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 relative"> <label for="totalloss_down" class="block font-medium mb-2 text-gray-700">Total Cable Loss (dB):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="totalloss_down" name="totalloss_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil Total Loss" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="totalloss_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>


                        <p class="form-section-label">Other Components in Line:</p>

                        <div class="input-group flex flex-col md:flex-row md:space-x-6 items-start"> <div class="w-full md:w-1/2 relative"> <label for="connect_down" class="block font-medium mb-2 text-gray-700">Number of In-Line Connectors:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="1" id="connect_down" name="connect_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Jumlah Konektor" oninput="calculateTotalConnectorDown();">
                                    <span class="unit-text">unit</span>
                                </div>
                            </div>

                            <div class="w-full md:w-1/2 relative"> <label for="totconnect_down" class="block font-medium mb-2 text-gray-700">Total Connector Loss (dB):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="totconnect_down" name="totconnect_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil Total Connector Loss" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="totconnect_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <div class="relative mt-4">
                            <label for="filter_down" class="block font-medium mb-2 text-gray-700">Filter Insertion Losses (dB):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="0.001" name="filter_down" id="filter_down"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Masukkan Nilai" oninput="calculateTotalLineLossesDown()">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>

                        <p class="form-section-label">Other In Line Losses:</p>

                        <div class="input-group flex flex-col md:flex-row md:space-x-6"> <div class="relative w-full md:w-1/2"> <label for="device_down_name" class="block font-medium mb-2 text-gray-700">Device Name:</label>
                                <input type="text" name="device_down" id="device_down_name"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Masukkan nama device">
                            </div>
                            <div class="relative w-full md:w-1/2 mt-4 md:mt-0"> <label for="devicee_down" class="block font-medium mb-2 text-gray-700">Device Loss (dB):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" name="devicee_down" id="devicee_down"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan nilai" oninput="calculateTotalLineLossesDown()">
                                    <span class="unit-text">dB</span>
                                </div>
                            </div>
                        </div>

                        <div class="relative mt-4">
                            <label for="atn_down" class="block font-medium mb-2 text-gray-700">Antenna Mismatch Losses (dB):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="0.001" name="atn_down" id="atn_down"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Masukkan Nilai" oninput="calculateTotalLineLossesDown()">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>
                        
                        <div class="relative mt-4">
                            <label for="totlinelosses_down" class="block font-medium mb-2 text-gray-700">Total Line Losses (dB):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="totlinelosses_down" id="totlinelosses_down"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                    placeholder="Hasil Total Line Losses" readonly>
                                <span class="unit-text">dB</span>
                            </div>
                            <button type="button" id="totlinelosses_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="relative mt-4">
                            <label class="block font-medium mb-2 text-gray-700">Total RF Power Deliver to Antenna (dBW):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="totrfrpowerdeliv_down" id="totrfpowerdeliv_down"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                    placeholder="Hasil Total RF Power Delivered" readonly>
                                <span class="unit-text">dBW</span>
                            </div>
                            <button type="button" id="totrfpowerdeliv_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Hitung Simpan
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
    </div>

    <div id="dbw_up_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Transmitter Power (dBW)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    dBW = 10 × log₁₀(Watt)<br>
                    Dimana:<br>
                    dBW = Daya dalam desibel-watt<br>
                    Watt = Daya dalam watt
                </div>
                <p><strong>Penjelasan:</strong><br>
                dBW adalah satuan ukuran daya yang dinyatakan dalam desibel (dB) relatif terhadap 1 watt. Ini sering digunakan dalam telekomunikasi untuk menyatakan daya transmit. Setiap kenaikan 3 dBW berarti daya berlipat ganda, dan setiap kenaikan 10 dBW berarti daya berlipat 10 kali.</p>
            </div>
        </div>
    </div>

    <div id="dbm_up_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Transmitter Power (dBm)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    dBm = dBW + 30<br>
                    Atau<br>
                    dBm = 10 × log₁₀(mW)<br>
                    Dimana:<br>
                    dBm = Daya dalam desibel-milliwatt<br>
                    dBW = Daya dalam desibel-watt<br>
                    mW = Daya dalam milliwatt
                </div>
                <p><strong>Penjelasan:</strong><br>
                dBm adalah satuan ukuran daya yang dinyatakan dalam desibel (dB) relatif terhadap 1 milliwatt (mW). Ini umumnya digunakan untuk mengukur daya sinyal dalam komunikasi nirkabel dan serat optik. Konversi dari dBW ke dBm adalah menambahkan 30 karena 1 Watt = 1000 mW, dan 10 log₁₀(1000) = 30.</p>
            </div>
        </div>
    </div>

    <div id="totlength_up_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Line Length</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Length = Line A Length + Line B Length + Line C Length<br>
                    Dimana:<br>
                    Line A, B, C Length = Panjang masing-masing segmen kabel/waveguide (meter)
                </div>
                <p><strong>Penjelasan:</strong><br>
                Total panjang line (kabel atau waveguide) adalah jumlah dari panjang setiap segmen yang digunakan untuk menghubungkan transmitter ke antena. Semakin panjang line, semakin besar potensi kehilangan sinyal (loss) yang terjadi.</p>
            </div>
        </div>
    </div>

    <div id="totalloss_up_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Cable Loss (dB)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Cable Loss = Cable/Waveguide Loss (dB/m) × Total Line Length (m)<br>
                    Dimana:<br>
                    Cable/Waveguide Loss = Kehilangan daya per meter (dB/m)<br>
                    Total Line Length = Total panjang kabel/waveguide (meter)
                </div>
                <p><strong>Penjelasan:</strong><br>
                Kehilangan daya pada kabel atau waveguide terjadi karena resistansi material dan efek dielektrik. Nilai ini biasanya diberikan dalam dB per meter. Total kehilangan adalah hasil kali kehilangan per meter dengan total panjang kabel.</p>
            </div>
        </div>
    </div>

    <div id="totconnect_up_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Connector Loss (dB)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Connector Loss = Number of In-Line Connectors × 0.05 dB<br>
                    Dimana:<br>
                    Number of In-Line Connectors = Jumlah konektor yang digunakan<br>
                    0.05 dB = Estimasi kehilangan daya per konektor
                </div>
                <p><strong>Penjelasan:</strong><br>
                Setiap konektor yang dipasang pada jalur transmisi akan menyebabkan sedikit kehilangan daya sinyal. Nilai 0.05 dB per konektor adalah estimasi umum, meskipun nilai sebenarnya bisa bervariasi tergantung jenis dan kualitas konektor.</p>
            </div>
        </div>
    </div>

    <div id="totlinelosses_up_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Line Losses (dB)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Line Losses = Total Cable Loss + Total Connector Loss + Filter Insertion Losses + Other In Line Losses + Antenna Mismatch Losses<br>
                    Dimana:<br>
                    Masing-masing komponen adalah nilai kehilangan daya dalam desibel (dB).
                </div>
                <p><strong>Penjelasan:</strong><br>
                Total kehilangan pada jalur transmisi (line losses) adalah jumlah dari semua kehilangan daya yang terjadi antara output transmitter dan input antena. Ini mencakup kehilangan pada kabel, konektor, filter, perangkat lain, dan ketidaksesuaian impedansi antena.</p>
            </div>
        </div>
    </div>

    <div id="totpowerdeliv_up_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Power Deliver to Antenna (dBW)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Power Delivered = Transmitter Power (dBW) - Total Line Losses (dB)<br>
                    Dimana:<br>
                    Transmitter Power (dBW) = Daya keluaran transmitter dalam dBW<br>
                    Total Line Losses (dB) = Total kehilangan daya pada jalur transmisi dalam dB
                </div>
                <p><strong>Penjelasan:</strong><br>
                Daya yang benar-benar sampai ke antena (sebelum dipancarkan) adalah daya output transmitter dikurangi semua kehilangan yang terjadi sepanjang jalur transmisi (kabel, konektor, filter, dll.). Nilai ini penting untuk menghitung Effective Isotropic Radiated Power (EIRP).</p>
            </div>
        </div>
    </div>

    <div id="dbw_down_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Transmitter Power (dBW)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    dBW = 10 × log₁₀(Watt)<br>
                    Dimana:<br>
                    dBW = Daya dalam desibel-watt<br>
                    Watt = Daya dalam watt
                </div>
                <p><strong>Penjelasan:</strong><br>
                dBW adalah satuan ukuran daya yang dinyatakan dalam desibel (dB) relatif terhadap 1 watt. Ini sering digunakan dalam telekomunikasi untuk menyatakan daya transmit. Setiap kenaikan 3 dBW berarti daya berlipat ganda, dan setiap kenaikan 10 dBW berarti daya berlipat 10 kali.</p>
            </div>
        </div>
    </div>

    <div id="dbm_down_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Transmitter Power (dBm)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    dBm = dBW + 30<br>
                    Atau<br>
                    dBm = 10 × log₁₀(mW)<br>
                    Dimana:<br>
                    dBm = Daya dalam desibel-milliwatt<br>
                    dBW = Daya dalam desibel-watt<br>
                    mW = Daya dalam milliwatt
                </div>
                <p><strong>Penjelasan:</strong><br>
                dBm adalah satuan ukuran daya yang dinyatakan dalam desibel (dB) relatif terhadap 1 milliwatt (mW). Ini umumnya digunakan untuk mengukur daya sinyal dalam komunikasi nirkabel dan serat optik. Konversi dari dBW ke dBm adalah menambahkan 30 karena 1 Watt = 1000 mW, dan 10 log₁₀(1000) = 30.</p>
            </div>
        </div>
    </div>

    <div id="totlength_down_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Line Length</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Length = Line A Length + Line B Length + Line C Length<br>
                    Dimana:<br>
                    Line A, B, C Length = Panjang masing-masing segmen kabel/waveguide (meter)
                </div>
                <p><strong>Penjelasan:</strong><br>
                Total panjang line (kabel atau waveguide) adalah jumlah dari panjang setiap segmen yang digunakan untuk menghubungkan transmitter ke antena. Semakin panjang line, semakin besar potensi kehilangan sinyal (loss) yang terjadi.</p>
            </div>
        </div>
    </div>

    <div id="totalloss_down_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Cable Loss (dB)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Cable Loss = Cable/Waveguide Loss (dB/m) × Total Line Length (m)<br>
                    Dimana:<br>
                    Cable/Waveguide Loss = Kehilangan daya per meter (dB/m)<br>
                    Total Line Length = Total panjang kabel/waveguide (meter)
                </div>
                <p><strong>Penjelasan:</strong><br>
                Kehilangan daya pada kabel atau waveguide terjadi karena resistansi material dan efek dielektrik. Nilai ini biasanya diberikan dalam dB per meter. Total kehilangan adalah hasil kali kehilangan per meter dengan total panjang kabel.</p>
            </div>
        </div>
    </div>

    <div id="totconnect_down_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Connector Loss (dB)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Connector Loss = Number of In-Line Connectors × 0.05 dB<br>
                    Dimana:<br>
                    Number of In-Line Connectors = Jumlah konektor yang digunakan<br>
                    0.05 dB = Estimasi kehilangan daya per konektor
                </div>
                <p><strong>Penjelasan:</strong><br>
                Setiap konektor yang dipasang pada jalur transmisi akan menyebabkan sedikit kehilangan daya sinyal. Nilai 0.05 dB per konektor adalah estimasi umum, meskipun nilai sebenarnya bisa bervariasi tergantung jenis dan kualitas konektor.</p>
            </div>
        </div>
    </div>

    <div id="totlinelosses_down_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Line Losses (dB)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Line Losses = Total Cable Loss + Total Connector Loss + Filter Insertion Losses + Other In Line Losses + Antenna Mismatch Losses<br>
                    Dimana:<br>
                    Masing-masing komponen adalah nilai kehilangan daya dalam desibel (dB).
                </div>
                <p><strong>Penjelasan:</strong><br>
                Total kehilangan pada jalur transmisi (line losses) adalah jumlah dari semua kehilangan daya yang terjadi antara output transmitter dan input antena. Ini mencakup kehilangan pada kabel, konektor, filter, perangkat lain, dan ketidaksesuaian impedansi antena.</p>
            </div>
        </div>
    </div>

    <div id="totrfpowerdeliv_down_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total RF Power Deliver to Antenna (dBW)</h3>
            <div>
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Total Power Delivered = Transmitter Power (dBW) - Total Line Losses (dB)<br>
                    Dimana:<br>
                    Transmitter Power (dBW) = Daya keluaran transmitter dalam dBW<br>
                    Total Line Losses (dB) = Total kehilangan daya pada jalur transmisi dalam dB
                </div>
                <p><strong>Penjelasan:</strong><br>
                Daya yang benar-benar sampai ke antena (sebelum dipancarkan) adalah daya output transmitter dikurangi semua kehilangan yang terjadi sepanjang jalur transmisi (kabel, konektor, filter, dll.). Nilai ini penting untuk menghitung Effective Isotropic Radiated Power (EIRP).</p>
            </div>
        </div>
    </div>

    {{-- JavaScript Perhitungan --}}
    <script>
        // Fungsi untuk menghitung dBW dan dBm untuk Uplink
        function calculatePowerUp() {
            const watt = parseFloat(document.getElementById('watt_up').value);
            if (!isNaN(watt) && watt > 0) {
                const dbw = 10 * Math.log10(watt); // Menghitung dBW
                const dbm = dbw + 30; // Menghitung dBm

                document.getElementById('dbw_up').value = dbw.toFixed(3); // Menampilkan dBW untuk Uplink
                document.getElementById('dbm_up').value = dbm.toFixed(3); // Menampilkan dBm untuk Uplink
            } else {
                document.getElementById('dbw_up').value = ''; // Kosongkan jika input invalid
                document.getElementById('dbm_up').value = ''; // Kosongkan jika input invalid
            }
            calculateTotalLineLossesUp(); // Recalculate total line losses and power delivered
        }

        // Fungsi untuk menghitung dBW dan dBm untuk Downlink
        function calculatePowerDown() {
            const watt = parseFloat(document.getElementById('watt_down').value);
            if (!isNaN(watt) && watt > 0) {
                const dbw = 10 * Math.log10(watt); // Menghitung dBW
                const dbm = dbw + 30; // Menghitung dBm

                document.getElementById('dbw_down').value = dbw.toFixed(3); // Menampilkan dBW untuk Downlink
                document.getElementById('dbm_down').value = dbm.toFixed(3); // Menampilkan dBm untuk Downlink
            } else {
                document.getElementById('dbw_down').value = ''; // Kosongkan jika input invalid
                document.getElementById('dbm_down').value = ''; // Kosongkan jika input invalid
            }
            calculateTotalLineLossesDown(); // Recalculate total line losses and power delivered
        }

        // Fungsi untuk menghitung Total Length Uplink
        function calculateTotalLengthUp() {
            const alength_up = parseFloat(document.getElementById('alength_up').value) || 0;
            const blength_up = parseFloat(document.getElementById('blength_up').value) || 0;
            const clength_up = parseFloat(document.getElementById('clength_up').value) || 0;

            const totlength_up = alength_up + blength_up + clength_up;
            document.getElementById('totlength_up').value = totlength_up.toFixed(3); // Menampilkan total panjang
            calculateTotalLossUp(); // Ensure cable loss is recalculated when length changes
        }

        // Fungsi untuk menghitung Total Length Downlink
        function calculateTotalLengthDown() {
            const alength_down = parseFloat(document.getElementById('alength_down').value) || 0;
            const blength_down = parseFloat(document.getElementById('blength_down').value) || 0;
            const clength_down = parseFloat(document.getElementById('clength_down').value) || 0;

            const totlength_down = alength_down + blength_down + clength_down;
            document.getElementById('totlength_down').value = totlength_down.toFixed(3); // Menampilkan total panjang
            calculateTotalLossDown(); // Ensure cable loss is recalculated when length changes
        }

        // Fungsi untuk menghitung Total Cable Loss Uplink
        function calculateTotalLossUp() {
            const guideloss_up = parseFloat(document.getElementById('guideloss_up').value) || 0;
            const totlength_up = parseFloat(document.getElementById('totlength_up').value) || 0;

            const totalloss_up = guideloss_up * totlength_up;
            document.getElementById('totalloss_up').value = totalloss_up.toFixed(3); // Menampilkan Total Cable Loss untuk Uplink
            calculateTotalLineLossesUp(); // Recalculate total line losses
        }

        // Fungsi untuk menghitung Total Cable Loss Downlink
        function calculateTotalLossDown() {
            const guideloss_down = parseFloat(document.getElementById('guideloss_down').value) || 0;
            const totlength_down = parseFloat(document.getElementById('totlength_down').value) || 0;

            const totalloss_down = guideloss_down * totlength_down;
            document.getElementById('totalloss_down').value = totalloss_down.toFixed(3); // Menampilkan Total Cable Loss untuk Downlink
            calculateTotalLineLossesDown(); // Recalculate total line losses
        }

        // Fungsi untuk menghitung Total Penurunan Daya Uplink (Connector Loss)
        function calculateTotalConnectorUp() {
            const connectors = parseFloat(document.getElementById('connect_up').value) || 0;
            const totalConnectorLoss_up = connectors * 0.05; // Assuming 0.05 dB loss per connector
            document.getElementById('totconnect_up').value = totalConnectorLoss_up.toFixed(3); // Menampilkan Total Penurunan Daya untuk Uplink
            calculateTotalLineLossesUp(); // Recalculate total line losses
        }

        // Fungsi untuk menghitung Total Penurunan Daya Downlink (Connector Loss)
        function calculateTotalConnectorDown() {
            const connectors = parseFloat(document.getElementById('connect_down').value) || 0;
            const totalConnectorLoss_down = connectors * 0.05; // Assuming 0.05 dB loss per connector
            document.getElementById('totconnect_down').value = totalConnectorLoss_down.toFixed(3); // Menampilkan Total Penurunan Daya untuk Downlink
            calculateTotalLineLossesDown(); // Recalculate total line losses
        }

        // Fungsi untuk menghitung Total Line Losses Uplink
        function calculateTotalLineLossesUp() {
            const totalCableLoss_up = parseFloat(document.getElementById('totalloss_up').value) || 0;
            const totalConnectorLoss_up = parseFloat(document.getElementById('totconnect_up').value) || 0;
            const filterLoss_up = parseFloat(document.getElementById('filter_up').value) || 0;
            const otherInlineLoss_up = parseFloat(document.getElementById('devicee_up').value) || 0;
            const antennaMismatchLoss_up = parseFloat(document.getElementById('atn_up').value) || 0;

            const totalLineLosses_up = totalCableLoss_up + totalConnectorLoss_up + filterLoss_up + otherInlineLoss_up + antennaMismatchLoss_up;
            document.getElementById('totlinelosses_up').value = totalLineLosses_up.toFixed(3); // Menampilkan Total Line Losses untuk Uplink

            // Fungsi untuk Menghitung Total Power Delivered to Antenna Uplink
            const transmitterPower_dbw_up = parseFloat(document.getElementById('dbw_up').value) || 0;
            const totalPowerDelivered_up = transmitterPower_dbw_up - totalLineLosses_up;
            document.getElementById('totpowerdeliv_up').value = totalPowerDelivered_up.toFixed(3); // Menampilkan total power delivered Uplink
        }

        // Fungsi untuk menghitung Total Line Losses Downlink
        function calculateTotalLineLossesDown() {
            const totalCableLoss_down = parseFloat(document.getElementById('totalloss_down').value) || 0;
            const totalConnectorLoss_down = parseFloat(document.getElementById('totconnect_down').value) || 0;
            const filterLoss_down = parseFloat(document.getElementById('filter_down').value) || 0;
            const otherInlineLoss_down = parseFloat(document.getElementById('devicee_down').value) || 0;
            const antennaMismatchLoss_down = parseFloat(document.getElementById('atn_down').value) || 0;

            const totalLineLosses_down = totalCableLoss_down + totalConnectorLoss_down + filterLoss_down + otherInlineLoss_down + antennaMismatchLoss_down;
            document.getElementById('totlinelosses_down').value = totalLineLosses_down.toFixed(3); // Menampilkan Total Line Losses untuk Downlink

            // Menghitung Total RF Power Delivered to Antenna Downlink
            const transmitterPower_dbw_down = parseFloat(document.getElementById('dbw_down').value) || 0;
            const totalPowerDelivered_down = transmitterPower_dbw_down - totalLineLosses_down;
            document.getElementById('totrfpowerdeliv_down').value = totalPowerDelivered_down.toFixed(3); // Menampilkan total power delivered Downlink
        }

        // Call calculation functions on page load to ensure initial values are correct
        document.addEventListener('DOMContentLoaded', () => {
            calculatePowerUp();
            calculateTotalLengthUp();
            calculateTotalLossUp();
            calculateTotalConnectorUp();
            calculateTotalLineLossesUp();

            calculatePowerDown();
            calculateTotalLengthDown();
            calculateTotalLossDown();
            calculateTotalConnectorDown();
            calculateTotalLineLossesDown();
        });

        // Add event listeners for all input fields that affect the calculations
        document.getElementById('watt_up').addEventListener('input', calculatePowerUp);
        document.getElementById('alength_up').addEventListener('input', calculateTotalLengthUp);
        document.getElementById('blength_up').addEventListener('input', calculateTotalLengthUp);
        document.getElementById('clength_up').addEventListener('input', calculateTotalLengthUp);
        document.getElementById('guideloss_up').addEventListener('input', calculateTotalLossUp);
        document.getElementById('connect_up').addEventListener('input', calculateTotalConnectorUp);
        document.getElementById('filter_up').addEventListener('input', calculateTotalLineLossesUp);
        document.getElementById('devicee_up').addEventListener('input', calculateTotalLineLossesUp);
        document.getElementById('atn_up').addEventListener('input', calculateTotalLineLossesUp);

        document.getElementById('watt_down').addEventListener('input', calculatePowerDown);
        document.getElementById('alength_down').addEventListener('input', calculateTotalLengthDown);
        document.getElementById('blength_down').addEventListener('input', calculateTotalLengthDown);
        document.getElementById('clength_down').addEventListener('input', calculateTotalLengthDown);
        document.getElementById('guideloss_down').addEventListener('input', calculateTotalLossDown);
        document.getElementById('connect_down').addEventListener('input', calculateTotalConnectorDown);
        document.getElementById('filter_down').addEventListener('input', calculateTotalLineLossesDown);
        document.getElementById('devicee_down').addEventListener('input', calculateTotalLineLossesDown);
        document.getElementById('atn_down').addEventListener('input', calculateTotalLineLossesDown);


        // POP UP Logic
        // Fungsi umum untuk membuka pop-up
        function openPopup(popupId) {
            document.getElementById(popupId).style.display = "flex";
        }

        // Event Listeners for all "Lihat Detail" buttons (Uplink)
        document.getElementById('dbw_up_popup_btn').onclick = () => {
            openPopup('dbw_up_popup');
        };
        document.getElementById('dbm_up_popup_btn').onclick = () => {
            openPopup('dbm_up_popup');
        };
        document.getElementById('totlength_up_popup_btn').onclick = () => {
            openPopup('totlength_up_popup');
        };
        document.getElementById('totalloss_up_popup_btn').onclick = () => {
            openPopup('totalloss_up_popup');
        };
        document.getElementById('totconnect_up_popup_btn').onclick = () => {
            openPopup('totconnect_up_popup');
        };
        document.getElementById('totlinelosses_up_popup_btn').onclick = () => {
            openPopup('totlinelosses_up_popup');
        };
        document.getElementById('totpowerdeliv_up_popup_btn').onclick = () => {
            openPopup('totpowerdeliv_up_popup');
        };

        // Event Listeners for all "Lihat Detail" buttons (Downlink)
        document.getElementById('dbw_down_popup_btn').onclick = () => {
            openPopup('dbw_down_popup');
        };
        document.getElementById('dbm_down_popup_btn').onclick = () => {
            openPopup('dbm_down_popup');
        };
        document.getElementById('totlength_down_popup_btn').onclick = () => {
            openPopup('totlength_down_popup');
        };
        document.getElementById('totalloss_down_popup_btn').onclick = () => {
            openPopup('totalloss_down_popup');
        };
        document.getElementById('totconnect_down_popup_btn').onclick = () => {
            openPopup('totconnect_down_popup');
        };
        document.getElementById('totlinelosses_down_popup_btn').onclick = () => {
            openPopup('totlinelosses_down_popup');
        };
        document.getElementById('totrfpowerdeliv_down_popup_btn').onclick = () => {
            openPopup('totrfpowerdeliv_down_popup');
        };

        // Fungsi tutup semua popup
        document.querySelectorAll('.close-popup-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            };
        });
    </script>
</x-layout>