<x-layout>
    <x-slot:title>Antenna Polarization Loss</x-slot>

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

        .code-block {
            background-color: #f5f5f5;
            padding: 12px 15px;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
            margin: 15px 0;
            font-family: monospace;
            white-space: pre-wrap;
            overflow-x: auto;
            font-weight: 500;
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
        /* Keyframes from calc.blade.php, needed if you want the animation */
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

        /* Specific style for section labels, including the new spacing */
        .form-section-label {
            display: block;
            font-weight: bold;
            color: #1F2937; /* gray-800 */
            margin-bottom: 1rem;
            margin-top: 1.5rem; /* Standard top margin for labels after a section */
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #E5E7EB; /* gray-200 */
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                    <i class="fas fa-satellite-dish mr-2 text-blue-600"></i> Perhitungan Parameter
                    <p class="mr- text-blue-600"></p> Antenna Polarization Loss
                </h1>
                <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                    Masukkan nilai-nilai untuk menghitung Polarization Loss dan Cross Polarization Coupling/Isolation.
                </p>
                <form method="POST" action="{{ route('annpolaloss.store', ['id' => $dataId]) }}" id="">
                
                    @csrf
                    <input type="hidden" name="user_id" value="1">

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Uplink Parameters</h2>
                        <h3 class="form-section-label">Co-Polarization Loss:</h3>

                        <div class="input-group">
                            <div class="relative">
                                <label for="axtxantenna_up" class="block font-medium mb-2 text-gray-700">Axial ratio of Tx Antenna (Ant. #1):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="axtxantenna_up" id="axtxantenna_up" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan nilai">
                                    <span class="unit-text">dB</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="axialratio1_up" class="block font-medium mb-2 text-gray-700">Axial ratio (Ant. #1):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="axialratio1_up" id="axialratio1_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text"></span>
                                </div>
                                <button type="button" id="axialratio1_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="axrxantenna_up" class="block font-medium mb-2 text-gray-700">Axial ratio of Rx Antenna (Ant. #2):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="axrxantenna_up" id="axrxantenna_up" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan nilai">
                                    <span class="unit-text">dB</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="axialratio2_up" class="block font-medium mb-2 text-gray-700">Axial ratio (Ant. #2):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="axialratio2_up" id="axialratio2_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text"></span>
                                </div>
                                <button type="button" id="axialratio2_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="degrees_up" class="block font-medium mb-2 text-gray-700">Polarization Angle &theta; between antennas:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="degrees_up" id="degrees_up" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan nilai">
                                    <span class="unit-text">Degrees</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="radians_up" class="block font-medium mb-2 text-gray-700">Polarization Angle &theta; between antennas:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="radians_up" id="radians_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text">Radians</span>
                                </div>
                                <button type="button" id="radians_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="polarizationloss_up" class="block font-medium mb-2 text-gray-700">Polarization Loss:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="polarizationloss_up" id="polarizationloss_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text"></span>
                                </div>
                                <button type="button" id="polarizationloss_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="hasilpolarizationloss_up" class="block font-medium mb-2 text-gray-700">Hasil Polarization Loss:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="hasilpolarizationloss_up" id="hasilpolarizationloss_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="hasilpolarizationloss_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Added mt-6 for spacing here --}}
                        <h3 class="form-section-label mt-6">Cross Polarization Coupling/Isolation:</h3>
                        <div class="input-group">
                            <div class="relative">
                                <label for="crosspolpowerfraction_up" class="block font-medium mb-2 text-gray-700">Cross Pol. Power Fraction:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="crosspolpowerfraction_up" id="crosspolpowerfraction_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text"></span>
                                </div>
                                <button type="button" id="crosspolpowerfraction_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="dbcrosspolpowerfraction_up" class="block font-medium mb-2 text-gray-700">Cross Pol. Power Fraction:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="dbcrosspolpowerfraction_up" id="dbcrosspolpowerfraction_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="dbcrosspolpowerfraction_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="crosspolarizationisolation_up" class="block font-medium mb-2 text-gray-700">Cross Polarization Isolation:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="crosspolarizationisolation_up" id="crosspolarizationisolation_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="crosspolarizationisolation_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Downlink Parameters</h2>
                        <h3 class="form-section-label">Co-Polarization Loss:</h3>

                        <div class="input-group">
                            <div class="relative">
                                <label for="axtxantenna_down" class="block font-medium mb-2 text-gray-700">Axial ratio of Tx Antenna (Ant. #1):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="axtxantenna_down" id="axtxantenna_down" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan nilai">
                                    <span class="unit-text">dB</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="axialratio1_down" class="block font-medium mb-2 text-gray-700">Axial ratio (Ant. #1):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="axialratio1_down" id="axialratio1_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text"></span>
                                </div>
                                <button type="button" id="axialratio1_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="axrxantenna_down" class="block font-medium mb-2 text-gray-700">Axial ratio of Rx Antenna (Ant. #2):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="axrxantenna_down" id="axrxantenna_down" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan nilai">
                                    <span class="unit-text">dB</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="axialratio2_down" class="block font-medium mb-2 text-gray-700">Axial ratio (Ant. #2):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="axialratio2_down" id="axialratio2_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text"></span>
                                </div>
                                <button type="button" id="axialratio2_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="degrees_down" class="block font-medium mb-2 text-gray-700">Polarization Angle &theta; between antennas:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="degrees_down" id="degrees_down" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan nilai">
                                    <span class="unit-text">Degrees</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="radians_down" class="block font-medium mb-2 text-gray-700">Polarization Angle &theta; between antennas:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="radians_down" id="radians_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text">Radians</span>
                                </div>
                                <button type="button" id="radians_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="polarizationloss_down" class="block font-medium mb-2 text-gray-700">Polarization Loss:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="polarizationloss_down" id="polarizationloss_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text"></span>
                                </div>
                                <button type="button" id="polarizationloss_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="hasilpolarizationloss_down" class="block font-medium mb-2 text-gray-700">Hasil Polarization Loss:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="hasilpolarizationloss_down" id="hasilpolarizationloss_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="hasilpolarizationloss_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Added mt-6 for spacing here --}}
                        <h3 class="form-section-label mt-6">Cross Polarization Coupling/Isolation:</h3>
                        <div class="input-group">
                            <div class="relative">
                                <label for="crosspolpowerfraction_down" class="block font-medium mb-2 text-gray-700">Cross Pol. Power Fraction:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="crosspolpowerfraction_down" id="crosspolpowerfraction_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text"></span>
                                </div>
                                <button type="button" id="crosspolpowerfraction_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="dbcrosspolpowerfraction_down" class="block font-medium mb-2 text-gray-700">Cross Pol. Power Fraction:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="dbcrosspolpowerfraction_down" id="dbcrosspolpowerfraction_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="dbcrosspolpowerfraction_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>

                            <div class="relative">
                                <label for="crosspolarizationisolation_down" class="block font-medium mb-2 text-gray-700">Cross Polarization Isolation:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="crosspolarizationisolation_down" id="crosspolarizationisolation_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="crosspolarizationisolation_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                                    Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Hitung & Simpan
                    </button>
                </form>
                <div class="flex justify-between mt-6">
                    <a href="/annpoinloss/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
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

        <div id="popupWindow" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3 id="popupTitle">Detail Perhitungan</h3>
                <div id="popupContent">
                    </div>
            </div>
        </div>
    </div>

    <script>
        function safeParseFloat(value) {
            // Returns null for empty strings or non-numeric values, otherwise returns the parsed float.
            const parsed = parseFloat(value);
            return value === '' || isNaN(parsed) ? null : parsed;
        }

        function calculateUplink() {
            // Inputs
            const axtxantenna_up = safeParseFloat(document.getElementById('axtxantenna_up').value);
            const axrxantenna_up = safeParseFloat(document.getElementById('axrxantenna_up').value);
            const degrees_up = safeParseFloat(document.getElementById('degrees_up').value);

            // Output elements
            const axialratio1_up_el = document.getElementById('axialratio1_up');
            const axialratio2_up_el = document.getElementById('axialratio2_up');
            const radians_up_el = document.getElementById('radians_up');
            const polarizationloss_up_el = document.getElementById('polarizationloss_up');
            const hasilpolarizationloss_up_el = document.getElementById('hasilpolarizationloss_up');
            const crosspolpowerfraction_up_el = document.getElementById('crosspolpowerfraction_up');
            const dbcrosspolpowerfraction_up_el = document.getElementById('dbcrosspolpowerfraction_up');
            const crosspolarizationisolation_up_el = document.getElementById('crosspolarizationisolation_up');

            // --- Calculation for Axial Ratio 1 (Ant. #1) ---
            let axialratio1_up = null;
            if (axtxantenna_up !== null && axtxantenna_up >= 0) {
                axialratio1_up = Math.pow(10, axtxantenna_up / 20);
                axialratio1_up_el.value = axialratio1_up.toFixed(4);
            } else {
                axialratio1_up_el.value = '';
            }

            // --- Calculation for Axial Ratio 2 (Ant. #2) ---
            let axialratio2_up = null;
            if (axrxantenna_up !== null && axrxantenna_up >= 0) {
                axialratio2_up = Math.pow(10, axrxantenna_up / 20);
                axialratio2_up_el.value = axialratio2_up.toFixed(4);
            } else {
                axialratio2_up_el.value = '';
            }

            // --- Calculation for Radians ---
            let radians_up = null;
            if (degrees_up !== null && degrees_up >= 0) {
                radians_up = degrees_up * (Math.PI / 180);
                radians_up_el.value = radians_up.toFixed(4);
            } else {
                radians_up_el.value = '';
            }

            // --- Calculation for Polarization Loss and dependents ---
            let polarizationloss_up = null;
            if (axialratio1_up !== null && axialratio2_up !== null && radians_up !== null) {
                const numerator = (1 - Math.pow(axialratio1_up, 2)) * (1 - Math.pow(axialratio2_up, 2)) * Math.cos(2 * radians_up) + 4 * axialratio1_up * axialratio2_up;
                const denominator = (1 + Math.pow(axialratio1_up, 2)) * (1 + Math.pow(axialratio2_up, 2));

                polarizationloss_up = 0.5 * (1 + numerator / denominator);
                polarizationloss_up = Math.min(Math.max(polarizationloss_up, 1e-12), 1); // clamp to avoid log of zero or negative
                polarizationloss_up_el.value = polarizationloss_up.toFixed(6);

                const hasilpolarizationloss_up = -10 * Math.log10(polarizationloss_up);
                hasilpolarizationloss_up_el.value = hasilpolarizationloss_up.toFixed(4);

                const crosspolpowerfraction_up = 1 - polarizationloss_up;
                crosspolpowerfraction_up_el.value = crosspolpowerfraction_up.toFixed(6);

                const dbcrosspolpowerfraction_up = 10 * Math.log10(crosspolpowerfraction_up > 0 ? crosspolpowerfraction_up : 1e-12);
                dbcrosspolpowerfraction_up_el.value = dbcrosspolpowerfraction_up.toFixed(4);

                const crosspolarizationisolation_up = hasilpolarizationloss_up - dbcrosspolpowerfraction_up;
                crosspolarizationisolation_up_el.value = crosspolarizationisolation_up.toFixed(4);

            } else {
                // Clear all dependent outputs if main polarization loss inputs are not ready
                polarizationloss_up_el.value = '';
                hasilpolarizationloss_up_el.value = '';
                crosspolpowerfraction_up_el.value = '';
                dbcrosspolpowerfraction_up_el.value = '';
                crosspolarizationisolation_up_el.value = '';
            }
        }


        function calculateDownlink() {
            // Inputs
            const axtxantenna_down = safeParseFloat(document.getElementById('axtxantenna_down').value);
            const axrxantenna_down = safeParseFloat(document.getElementById('axrxantenna_down').value);
            const degrees_down = safeParseFloat(document.getElementById('degrees_down').value);

            // Output elements
            const axialratio1_down_el = document.getElementById('axialratio1_down');
            const axialratio2_down_el = document.getElementById('axialratio2_down');
            const radians_down_el = document.getElementById('radians_down');
            const polarizationloss_down_el = document.getElementById('polarizationloss_down');
            const hasilpolarizationloss_down_el = document.getElementById('hasilpolarizationloss_down');
            const crosspolpowerfraction_down_el = document.getElementById('crosspolpowerfraction_down');
            const dbcrosspolpowerfraction_down_el = document.getElementById('dbcrosspolpowerfraction_down');
            const crosspolarizationisolation_down_el = document.getElementById('crosspolarizationisolation_down');

            // --- Calculation for Axial Ratio 1 (Ant. #1) ---
            let axialratio1_down = null;
            if (axtxantenna_down !== null && axtxantenna_down >= 0) {
                axialratio1_down = Math.pow(10, axtxantenna_down / 20);
                axialratio1_down_el.value = axialratio1_down.toFixed(4);
            } else {
                axialratio1_down_el.value = '';
            }

            // --- Calculation for Axial Ratio 2 (Ant. #2) ---
            let axialratio2_down = null;
            if (axrxantenna_down !== null && axrxantenna_down >= 0) {
                axialratio2_down = Math.pow(10, axrxantenna_down / 20);
                axialratio2_down_el.value = axialratio2_down.toFixed(4);
            } else {
                axialratio2_down_el.value = '';
            }

            // --- Calculation for Radians ---
            let radians_down = null;
            if (degrees_down !== null && degrees_down >= 0) {
                radians_down = degrees_down * (Math.PI / 180);
                radians_down_el.value = radians_down.toFixed(4);
            } else {
                radians_down_el.value = '';
            }

            // --- Calculation for Polarization Loss and dependents ---
            let polarizationloss_down = null;
            if (axialratio1_down !== null && axialratio2_down !== null && radians_down !== null) {
                const numerator = (1 - Math.pow(axialratio1_down, 2)) * (1 - Math.pow(axialratio2_down, 2)) * Math.cos(2 * radians_down) + 4 * axialratio1_down * axialratio2_down;
                const denominator = (1 + Math.pow(axialratio1_down, 2)) * (1 + Math.pow(axialratio2_down, 2));

                polarizationloss_down = 0.5 * (1 + numerator / denominator);
                polarizationloss_down = Math.min(Math.max(polarizationloss_down, 1e-12), 1);
                polarizationloss_down_el.value = polarizationloss_down.toFixed(6);

                const hasilpolarizationloss_down = -10 * Math.log10(polarizationloss_down);
                hasilpolarizationloss_down_el.value = hasilpolarizationloss_down.toFixed(4);

                const crosspolpowerfraction_down = 1 - polarizationloss_down;
                crosspolpowerfraction_down_el.value = crosspolpowerfraction_down.toFixed(6);

                const dbcrosspolpowerfraction_down = 10 * Math.log10(crosspolpowerfraction_down > 0 ? crosspolpowerfraction_down : 1e-12);
                dbcrosspolpowerfraction_down_el.value = dbcrosspolpowerfraction_down.toFixed(4);

                const crosspolarizationisolation_down = hasilpolarizationloss_down - dbcrosspolpowerfraction_down;
                crosspolarizationisolation_down_el.value = crosspolarizationisolation_down.toFixed(4);

            } else {
                // Clear all dependent outputs if main polarization loss inputs are not ready
                polarizationloss_down_el.value = '';
                hasilpolarizationloss_down_el.value = '';
                crosspolpowerfraction_down_el.value = '';
                dbcrosspolpowerfraction_down_el.value = '';
                crosspolarizationisolation_down_el.value = '';
            }
        }

        // Popup Functions (unchanged)
        function showPopup(title, content) {
            document.getElementById('popupTitle').textContent = title;
            document.getElementById('popupContent').innerHTML = content;
            document.getElementById('popupWindow').style.display = 'flex';
        }

        function hidePopup() {
            document.getElementById('popupWindow').style.display = 'none';
        }

        // Detail information for each field (only formula and explanation - unchanged)
        const detailContent = {
            axialratio1_up: function() {
                return `
                    <div class="code-block">Axial Ratio = 10<sup>(Axial Ratio in dB / 20)</sup></div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Axial ratio adalah perbandingan antara komponen major dan minor dari polarisasi elips. Nilai ini dihitung dari nilai axial ratio dalam dB, menggunakan rumus konversi.</p>
                        <p>Semakin mendekati 1, semakin mendekati polarisasi sirkular. Semakin besar nilainya, semakin mendekati polarisasi linear.</p>
                    </div>
                `;
            },
            axialratio2_up: function() {
                return `
                    <div class="code-block">Axial Ratio = 10<sup>(Axial Ratio in dB / 20)</sup></div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Axial ratio adalah perbandingan antara komponen major dan minor dari polarisasi elips. Nilai ini dihitung dari nilai axial ratio dalam dB, menggunakan rumus konversi.</p>
                        <p>Semakin mendekati 1, semakin mendekati polarisasi sirkular. Semakin besar nilainya, semakin mendekati polarisasi linear.</p>
                    </div>
                `;
            },
            radians_up: function() {
                return `
                    <div class="code-block">Radians = Degrees &times; (&pi; / 180)</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi sudut polarisasi dari derajat ke radian untuk digunakan dalam perhitungan matematis. Konversi ini menggunakan rumus:</p>
                        <p>Sudut polarisasi adalah sudut antara dua antena yang mempengaruhi seberapa baik mereka dapat berkomunikasi. Sudut 0° berarti polarisasi sempurna, sementara 90° berarti polarisasi yang sepenuhnya cross-polarized.</p>
                    </div>
                `;
            },
            polarizationloss_up: function() {
                return `
                    <div class="code-block">PL = 0.5 &times; (1 + [(1-r&#178;₁)(1-r&#178;₂)cos(2&theta;) + 4r₁r₂] / [(1+r&#178;₁)(1+r&#178;₂)])</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Polarization Loss menunjukkan seberapa baik dua antena dengan polarisasi berbeda dapat berkomunikasi. Nilai ini dihitung menggunakan rumus:</p>
                        <p>di mana:</p>
                        <p>r₁ = Axial Ratio antena #1</p>
                        <p>r₂ = Axial Ratio antena #2</p>
                        <p>&theta; = Sudut polarisasi (dalam radian)</p>
                        <p>Nilai ini berkisar antara 0 dan 1, di mana 1 menunjukkan tidak ada kerugian polarisasi dan 0 menunjukkan kerugian polarisasi total.</p>
                    </div>
                `;
            },
            hasilpolarizationloss_up: function() {
                return `
                    <div class="code-block">PL (dB) = -10 &times; log₁₀(PL)</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi polarization loss dari nilai linear ke desibel (dB) untuk memudahkan perbandingan dan analisis. Konversi menggunakan rumus:</p>
                        <p>Nilai dalam dB akan negatif karena polarisasi loss mewakili pengurangan daya. Semakin besar nilai negatifnya, semakin besar kerugian polarisasi.</p>
                    </div>
                `;
            },
            crosspolpowerfraction_up: function() {
                return `
                    <div class="code-block">Cross Pol. Power Fraction = 1 - Polarization Loss</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Cross Polarization Power Fraction adalah fraksi daya yang ditransfer ke polarisasi yang berlawanan. Ini dihitung sebagai:</p>
                        <p>Nilai ini berkisar antara 0 dan 1, di mana 0 berarti tidak ada transfer daya ke polarisasi silang, dan 1 berarti semua daya ditransfer ke polarisasi silang.</p>
                    </div>
                `;
            },
            dbcrosspolpowerfraction_up: function() {
                return `
                    <div class="code-block">Cross Pol. Power Fraction (dB) = 10 &times; log₁₀(Cross Pol. Power Fraction)</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi Cross Polarization Power Fraction dari nilai linear ke desibel (dB). Konversi menggunakan rumus:</p>
                        <p>Nilai dalam dB biasanya negatif karena Cross Pol. Power Fraction biasanya kurang dari 1. Semakin rendah nilai dB-nya, semakin sedikit daya yang ditransfer ke polarisasi silang.</p>
                    </div>
                `;
            },
            crosspolarizationisolation_up: function() {
                return `
                    <div class="code-block">XPI (dB) = Polarization Loss (dB) - Cross Pol. Power Fraction (dB)</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Cross Polarization Isolation mengukur seberapa baik sebuah sistem dapat memisahkan sinyal dengan polarisasi yang berbeda. Ini dihitung sebagai:</p>
                        <p>Nilai yang lebih tinggi menunjukkan isolasi yang lebih baik antara polarisasi yang berbeda. Umumnya, nilai di atas 20 dB dianggap baik untuk sistem komunikasi satelit.</p>
                    </div>
                `;
            },

            // Downlink Details
            axialratio1_down: function() {
                return `
                    <div class="code-block">Axial Ratio = 10<sup>(Axial Ratio in dB / 20)</sup></div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Axial ratio adalah perbandingan antara komponen major dan minor dari polarisasi elips. Nilai ini dihitung dari nilai axial ratio dalam dB, menggunakan rumus konversi.</p>
                        <p>Semakin mendekati 1, semakin mendekati polarisasi sirkular. Semakin besar nilainya, semakin mendekati polarisasi linear.</p>
                    </div>
                `;
            },
            axialratio2_down: function() {
                return `
                    <div class="code-block">Axial Ratio = 10<sup>(Axial Ratio in dB / 20)</sup></div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Axial ratio adalah perbandingan antara komponen major dan minor dari polarisasi elips. Nilai ini dihitung dari nilai axial ratio dalam dB, menggunakan rumus konversi.</p>
                        <p>Semakin mendekati 1, semakin mendekati polarisasi sirkular. Semakin besar nilainya, semakin mendekati polarisasi linear.</p>
                    </div>
                `;
            },
            radians_down: function() {
                return `
                    <div class="code-block">Radians = Degrees &times; (&pi; / 180)</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi sudut polarisasi dari derajat ke radian untuk digunakan dalam perhitungan matematis. Konversi ini menggunakan rumus:</p>
                        <p>Sudut polarisasi adalah sudut antara dua antena yang mempengaruhi seberapa baik mereka dapat berkomunikasi. Sudut 0° berarti polarisasi sempurna, sementara 90° berarti polarisasi yang sepenuhnya cross-polarized.</p>
                    </div>
                `;
            },
            polarizationloss_down: function() {
                return `
                    <div class="code-block">PL = 0.5 &times; (1 + [(1-r&#178;₁)(1-r&#178;₂)cos(2&theta;) + 4r₁r₂] / [(1+r&#178;₁)(1+r&#178;₂)])</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Polarization Loss menunjukkan seberapa baik dua antena dengan polarisasi berbeda dapat berkomunikasi. Nilai ini dihitung menggunakan rumus:</p>
                        <p>di mana:</p>
                        <p>r₁ = Axial Ratio antena #1</p>
                        <p>r₂ = Axial Ratio antena #2</p>
                        <p>&theta; = Sudut polarisasi (dalam radian)</p>
                        <p>Nilai ini berkisar antara 0 dan 1, di mana 1 menunjukkan tidak ada kerugian polarisasi dan 0 menunjukkan kerugian polarisasi total.</p>
                    </div>
                `;
            },
            hasilpolarizationloss_down: function() {
                return `
                    <div class="code-block">PL (dB) = -10 &times; log₁₀(PL)</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi polarization loss dari nilai linear ke desibel (dB) untuk memudahkan perbandingan dan analisis. Konversi menggunakan rumus:</p>
                        <p>Nilai dalam dB akan negatif karena polarisasi loss mewakili pengurangan daya. Semakin besar nilai negatifnya, semakin besar kerugian polarisasi.</p>
                    </div>
                `;
            },
            crosspolpowerfraction_down: function() {
                return `
                    <div class="code-block">Cross Pol. Power Fraction = 1 - Polarization Loss</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Cross Polarization Power Fraction adalah fraksi daya yang ditransfer ke polarisasi yang berlawanan. Ini dihitung sebagai:</p>
                        <p>Nilai ini berkisar antara 0 dan 1, di mana 0 berarti tidak ada transfer daya ke polarisasi silang, dan 1 berarti semua daya ditransfer ke polarisasi silang.</p>
                    </div>
                `;
            },
            dbcrosspolpowerfraction_down: function() {
                return `
                    <div class="code-block">Cross Pol. Power Fraction (dB) = 10 &times; log₁₀(Cross Pol. Power Fraction)</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi Cross Polarization Power Fraction dari nilai linear ke desibel (dB). Konversi menggunakan rumus:</p>
                        <p>Nilai dalam dB biasanya negatif karena Cross Pol. Power Fraction biasanya kurang dari 1. Semakin rendah nilai dB-nya, semakin sedikit daya yang ditransfer ke polarisasi silang.</p>
                    </div>
                `;
            },
            crosspolarizationisolation_down: function() {
                return `
                    <div class="code-block">XPI (dB) = Polarization Loss (dB) - Cross Pol. Power Fraction (dB)</div>
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Cross Polarization Isolation mengukur seberapa baik sebuah sistem dapat memisahkan sinyal dengan polarisasi yang berbeda. Ini dihitung sebagai:</p>
                        <p>Nilai yang lebih tinggi menunjukkan isolasi yang lebih baik antara polarisasi yang berbeda. Umumnya, nilai di atas 20 dB dianggap baik untuk sistem komunikasi satelit.</p>
                    </div>
                `;
            }
        };

        // Add input event listeners for Uplink inputs
        ['axtxantenna_up', 'axrxantenna_up', 'degrees_up'].forEach(id => {
            document.getElementById(id).addEventListener('input', calculateUplink);
        });

        // Add input event listeners for Downlink inputs
        ['axtxantenna_down', 'axrxantenna_down', 'degrees_down'].forEach(id => {
            document.getElementById(id).addEventListener('input', calculateDownlink);
        });

        // Add click event listeners for all detail buttons
        document.querySelectorAll('button[id$="_btn"]').forEach(button => {
            button.addEventListener('click', function() {
                const fieldId = this.id.replace('_btn', '');
                let title = '';
                const labelElement = document.querySelector(`label[for="${fieldId}"]`);
                if (labelElement) {
                    title = labelElement.textContent.replace(':', '').trim();
                } else {
                    const inputElement = document.getElementById(fieldId);
                    if (inputElement && inputElement.previousElementSibling && inputElement.previousElementSibling.tagName === 'LABEL') {
                        title = inputElement.previousElementSibling.textContent.replace(':', '').trim();
                    } else {
                        title = fieldId.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    }
                }

                if (detailContent[fieldId]) {
                    showPopup(title, detailContent[fieldId]());
                } else {
                    showPopup(title, `<p>Detail informasi untuk ${title} belum tersedia.</p>`);
                }
            });
        });

        // Add click event for close button
        document.querySelector('.close-popup-btn').addEventListener('click', hidePopup);

        // Close popup if user clicks outside of popup content
        document.getElementById('popupWindow').addEventListener('click', function(event) {
            if (event.target === this) {
                hidePopup();
            }
        });

        // Initial state on page load: clear all outputs
        document.addEventListener('DOMContentLoaded', () => {
            // These calls will now properly clear inputs if no value is present
            calculateUplink();
            calculateDownlink();
        });
    </script>
</x-layout>