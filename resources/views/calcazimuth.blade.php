<x-layout>
    <x-slot:title>Kalkulator Satelit</x-slot>

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
            position: relative; /* Ini penting agar absolute positioning tombol X bekerja relatif terhadapnya */
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
            font-size: 14px; /* Added font size for better readability */
        }

        .popup-content p {
            margin: 8px 0;
            line-height: 1.5;
            color: #374151; /* Added for consistency */
        }

        /* Keyframes for animation */
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

        /* Table styling for better visual */
        table th, table td {
            vertical-align: middle;
            padding: 1rem;
        }
        table input[type="text"],
        table input[type="number"] {
            padding: 0.5rem;
            height: auto;
        }

        /* Style for the degree symbol wrapper */
        .input-with-unit {
            display: flex;
            align-items: center;
        }

        .input-with-unit input {
            flex-grow: 1;
            /* Ensure no extra padding that overlaps with the unit */
            padding-right: 0.5rem; 
        }

        .input-with-unit .unit {
            margin-left: 0.5rem; /* Space between input and unit */
            font-weight: 500;
            color: #166534; /* Darker green text, matching input text color */
        }

        /* Styling for the new azimuth explanation popup content */
        .azimuth-explanation {
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
            color: #4A5568;
        }
        .azimuth-explanation .section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }
        .azimuth-explanation .section:last-child {
            border-bottom: none;
        }
        .azimuth-explanation .section-title {
            color: #2C5282;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border-left: 5px solid #4299E1;
            padding-left: 1rem;
        }
        .azimuth-explanation .section-content {
            text-align: justify;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }
        .azimuth-explanation .param-title {
            color: #2D3748;
            font-size: 1rem;
            font-weight: 600;
            margin: 1.25rem 0 0.5rem 0;
        }
        .azimuth-explanation .param-list {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }
        .azimuth-explanation .param-list li {
            margin-bottom: 0.4rem;
            line-height: 1.6;
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                    <i class="text-blue-600"></i> Kalkulator Azimuth
                </h1>
                <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                    Hasil Azimuth untuk Arah Antena Satelit Anda.
                </p>

                {{-- "Apa itu Kalkulator Azimuth?" button --}}
                <div class="mb-6 text-right animate__animated animate__fadeInUp">
                    <button type="button" id="info_azimuth_general_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">
                        Apa itu Kalkulator Azimuth? <i class="fas fa-info-circle ml-1"></i>
                    </button>
                </div>

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

                {{-- Uplink Section --}}
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                    <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Uplink</h2>
                    <form method="POST" action="{{ route('calcazimuth.store', ['id' => $dataId]) }}" id="uplinkForm">
                        @csrf
                        <input type="hidden" name="user_id" value="1">

                        <div class="input-group">
                            <div class="relative">
                                <label for="latitude_up" class="block font-medium text-gray-700 mb-2">Latitude:</label>
                                <div class="input-with-unit">
                                    <input type="number" id="latitude_up" name="latitude_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->userlat_up ?? '' }}" step="any" value="{{ $data->userlat_up ?? '' }}" readonly>
                                    <span class="unit">°</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="innhem_up" class="block font-medium text-gray-700 mb-2">In N. Hem?:</label>
                                <div class="input-with-unit">
                                    <input type="text" id="innhem_up" name="innhem_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed text-center text-xl" readonly>
                                    <span class="unit"></span> {{-- No unit for this field, but keep the structure --}}
                                </div>
                                <button type="button" id="innhem_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="innhem2_up" class="block font-medium text-gray-700 mb-2">In S. Hem?:</label>
                                <div class="input-with-unit">
                                    <input type="text" id="innhem2_up" name="innhem2_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed text-center text-xl" readonly>
                                    <span class="unit"></span>
                                </div>
                                <button type="button" id="innhem2_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="longitude_up" class="block font-medium text-gray-700 mb-2">Δ Longitude:</label>
                                <div class="input-with-unit">
                                    <input type="number" id="longitude_up" name="longitude_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->userlong_up - $data->spaceslot_up ?? '' }}" step="any" value="{{ $data->userlong_up - $data->spaceslot_up ?? '' }}" readonly>
                                    <span class="unit">°</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="eastofsat_up" class="block font-medium text-gray-700 mb-2">East of Satellite:</label>
                                <div class="input-with-unit">
                                    <input type="text" id="eastofsat_up" name="eastofsat_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed text-center text-xl" readonly>
                                    <span class="unit"></span>
                                </div>
                                <button type="button" id="eastofsat_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="eastofsat2_up" class="block font-medium text-gray-700 mb-2">West of Satellite:</label>
                                <div class="input-with-unit">
                                    <input type="text" id="eastofsat2_up" name="eastofsat2_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed text-center text-xl" readonly>
                                    <span class="unit"></span>
                                </div>
                                <button type="button" id="eastofsat2_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <div class="mt-8">
                            <div class="overflow-x-auto">
                                <table class="w-full bg-yellow-50 rounded-lg shadow-inner">
                                    <thead>
                                        <tr>
                                            <th class="p-3 text-left text-gray-700 font-medium bg-blue-200 rounded-tl-lg"></th>
                                            <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200">Satellite. in Quad?</th>
                                            <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200">Quad. Result:</th>
                                            <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200 rounded-tr-lg">Quad. Angle Range:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-200">
                                            <td class="p-3 font-medium text-gray-700">Quad NE</td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="sat_in_quad_up" name="sat_in_quad_up" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block text-xl" placeholde="❌" readonly>
                                                    <span class="unit"></span>
                                                </div>
                                                <button type="button" id="sat_in_quad_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="quad_result_up" name="quad_result_up" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="❌" readonly>
                                                    <span class="unit">°</span>
                                                </div>
                                                <button type="button" id="quad_result_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="quad_angle_range_up" name="quad_angle_range_up" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="0 to 90" readonly>
                                                    <span class="unit">°</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <td class="p-3 font-medium text-gray-700">Quad SE</td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="sat_in_quad_value_up" name="sat_in_quad_value_up" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block text-xl" placeholder="❌" readonly>
                                                    <span class="unit"></span>
                                                </div>
                                                <button type="button" id="sat_in_quad_value_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="quad_result_value_up" name="quad_result_value_up" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="❌" readonly>
                                                    <span class="unit">°</span>
                                                </div>
                                                <button type="button" id="quad_result_value_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="quad_angle_range_value_up" name="quad_angle_range_value_up" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="90 to 180" readonly>
                                                    <span class="unit">°</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <td class="p-3 font-medium text-gray-700">Quad SW</td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="sat_in_quad_value2_up" name="sat_in_quad_value2_up" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block text-xl" placeholder="❌"readonly>
                                                    <span class="unit"></span>
                                                </div>
                                                <button type="button" id="sat_in_quad_value2_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="quad_result_value2_up" name="quad_result_value2_up" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="❌"readonly>
                                                    <span class="unit">°</span>
                                                </div>
                                                <button type="button" id="quad_result_value2_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="quad_angle_range_value2_up" name="quad_angle_range_value2_up" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="180 to 270" readonly>
                                                    <span class="unit">°</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-3 font-medium text-gray-700">Quad NW</td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="sat_in_quad_value3_up" name="sat_in_quad_value3_up" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block text-xl" placeholder="❌"readonly>
                                                    <span class="unit"></span>
                                                </div>
                                                <button type="button" id="sat_in_quad_value3_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="quad_result_value3_up" name="quad_result_value3_up" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="❌" readonly>
                                                    <span class="unit">°</span>
                                                </div>
                                                <button type="button" id="quad_result_value3_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <div class="input-with-unit justify-center">
                                                    <input type="text" id="quad_angle_range_value3_up" name="quad_angle_range_value3_up" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="270 to 360" readonly>
                                                    <span class="unit">°</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="relative mt-8">
                                <label for="azimuthcalc_up" class="block font-medium text-gray-700 mb-2">AzimuthCalc:</label>
                                <div class="input-with-unit">
                                    <input type="number" id="azimuthcalc_up" name="azimuthcalc_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit">°</span>
                                </div>
                                <button type="button" id="azimuthcalc_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="azimuthresult_up" class="block font-medium text-gray-700 mb-2">Azimuth Result:</label>
                                <div class="input-with-unit">
                                    <input type="number" id="azimuthresult_up" name="azimuthresult_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                    <span class="unit">°</span>
                                </div>
                                <button type="button" id="azimuthresult_up_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Downlink Section --}}
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm">
                    <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Downlink</h2>
                    <form method="GET" action="">

                        <div class="input-group">
                            <div class="relative">
                                <label for="latitude_down" class="block font-medium text-gray-700 mb-2">Latitude:</label>
                                <div class="input-with-unit">
                                    <input type="number" id="latitude_down" name="latitude_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->userlat_down ?? '' }}" step="any" value="{{ $data->userlat_down ?? '' }}" readonly>
                                    <span class="unit">°</span>
                                </div>
                            </div>

                            <div class="relative">
                                <label for="innhem_down" class="block font-medium text-gray-700 mb-2">In N. Hem?:</label>
                                <div class="input-with-unit">
                                    <input type="text" id="innhem_down" name="innhem_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed text-center text-xl" readonly>
                                    <span class="unit"></span>
                                </div>
                                <button type="button" id="innhem_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition<button type="button" id="innhem_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                           </div>

                           <div class="relative">
                               <label for="innhem2_down" class="block font-medium text-gray-700 mb-2">In S. Hem?:</label>
                               <div class="input-with-unit">
                                   <input type="text" id="innhem2_down" name="innhem2_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed text-center text-xl" readonly>
                                   <span class="unit"></span>
                               </div>
                               <button type="button" id="innhem2_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                           </div>

                           <div class="relative">
                               <label for="longitude_down" class="block font-medium text-gray-700 mb-2">Δ Longitude:</label>
                               <div class="input-with-unit">
                                   <input type="number" id="longitude_down" name="longitude_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->userlong_down - $data->spaceslot_down ?? '' }}" step="any" value="{{ $data->userlong_down - $data->spaceslot_down ?? '' }}" readonly>
                                   <span class="unit">°</span>
                               </div>
                           </div>

                           <div class="relative">
                               <label for="eastofsat_down" class="block font-medium text-gray-700 mb-2">East of Satellite:</label>
                               <div class="input-with-unit">
                                   <input type="text" id="eastofsat_down" name="eastofsat_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed text-center text-xl" readonly>
                                   <span class="unit"></span>
                               </div>
                               <button type="button" id="eastofsat_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                           </div>

                           <div class="relative">
                               <label for="eastofsat2_down" class="block font-medium text-gray-700 mb-2">West of Satellite:</label>
                               <div class="input-with-unit">
                                   <input type="text" id="eastofsat2_down" name="eastofsat2_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed text-center text-xl" readonly>
                                   <span class="unit"></span>
                               </div>
                               <button type="button" id="eastofsat2_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                           </div>
                       </div>

                       <div class="mt-8">
                           <div class="overflow-x-auto">
                               <table class="w-full bg-yellow-50 rounded-lg shadow-inner">
                                   <thead>
                                       <tr>
                                           <th class="p-3 text-left text-gray-700 font-medium bg-blue-200 rounded-tl-lg"></th>
                                           <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200">Satellite. in Quad?</th>
                                           <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200">Quad. Result:</th>
                                           <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200 rounded-tr-lg">Quad. Angle Range:</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <tr class="border-b border-gray-200">
                                           <td class="p-3 font-medium text-gray-700">Quad NE</td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="sat_in_quad_down" name="sat_in_quad_down" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block text-xl" placeholder="❌" readonly>
                                                   <span class="unit"></span>
                                               </div>
                                               <button type="button" id="sat_in_quad_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                           </td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="quad_result_down" name="quad_result_down" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="❌" readonly>
                                                   <span class="unit">°</span>
                                               </div>
                                               <button type="button" id="quad_result_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                           </td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="quad_angle_range_down" name="quad_angle_range_down" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="0 to 90" readonly>
                                                   <span class="unit">°</span>
                                               </div>
                                           </td>
                                       </tr>
                                       <tr class="border-b border-gray-200">
                                           <td class="p-3 font-medium text-gray-700">Quad SE</td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="sat_in_quad_value_down" name="sat_in_quad_value_down" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block text-xl" placeholder="❌" readonly>
                                                   <span class="unit"></span>
                                               </div>
                                               <button type="button" id="sat_in_quad_value_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                           </td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="quad_result_value_down" name="quad_result_value_down" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="❌" readonly>
                                                   <span class="unit">°</span>
                                               </div>
                                               <button type="button" id="quad_result_value_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                           </td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="quad_angle_range_value_down" name="quad_angle_range_value_down" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="90 to 180" readonly>
                                                   <span class="unit">°</span>
                                               </div>
                                           </td>
                                       </tr>
                                       <tr class="border-b border-gray-200">
                                           <td class="p-3 font-medium text-gray-700">Quad SW</td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="sat_in_quad_value2_down" name="sat_in_quad_value2_down" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block text-xl" placeholder="❌" readonly>
                                                   <span class="unit"></span>
                                               </div>
                                               <button type="button" id="sat_in_quad_value2_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                           </td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="quad_result_value2_down" name="quad_result_value2_down" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="❌" readonly>
                                                   <span class="unit">°</span>
                                               </div>
                                               <button type="button" id="quad_result_value2_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                           </td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="quad_angle_range_value2_down" name="quad_angle_range_value2_down" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="180 to 270" readonly>
                                                   <span class="unit">°</span>
                                               </div>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td class="p-3 font-medium text-gray-700">Quad NW</td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="sat_in_quad_value3_down" name="sat_in_quad_value3_down" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block text-xl" placeholder="❌" readonly>
                                                   <span class="unit"></span>
                                               </div>
                                               <button type="button" id="sat_in_quad_value3_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                           </td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="quad_result_value3_down" name="quad_result_value3_down" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="❌" readonly>
                                                   <span class="unit">°</span>
                                               </div>
                                               <button type="button" id="quad_result_value3_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                           </td>
                                           <td class="p-3 text-center">
                                               <div class="input-with-unit justify-center">
                                                   <input type="text" id="quad_angle_range_value3_down" name="quad_angle_range_down" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="270 to 360" readonly>
                                                   <span class="unit">°</span>
                                               </div>
                                           </td>
                                       </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>

                       <div class="input-group">
                           <div class="relative mt-8">
                               <label for="azimuthcalc_down" class="block font-medium text-gray-700 mb-2">AzimuthCalc:</label>
                               <div class="input-with-unit">
                                   <input type="number" id="azimuthcalc_down" name="azimuthcalc_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                   <span class="unit">°</span>
                               </div>
                               <button type="button" id="azimuthcalc_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                           </div>

                           <div class="relative">
                               <label for="azimuthresult_down" class="block font-medium text-gray-700 mb-2">Azimuth Result:</label>
                               <div class="input-with-unit">
                                   <input type="number" id="azimuthresult_down" name="azimuthresult_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                   <span class="unit">°</span>
                               </div>
                               <button type="button" id="azimuthresult_down_popup_btn_trigger" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                           </div>
                       </div>
                   </form>
               </div>

               <button type="submit" form="uplinkForm" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-6">
                   <i class=""></i> Hitung & Simpan
               </button>
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

   {{-- New Popup for general Azimuth explanation --}}
   <div id="popup_azimuth_general" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Tentang Kalkulator Azimuth</h3>
           </div>
           <div class="popup-body">
               <div class="azimuth-explanation">
                   <div class="section">
                       <h4 class="section-title">Apa itu Azimuth?</h4>
                       <p class="section-content">
                           Dalam konteks komunikasi satelit, <strong>Azimuth</strong> adalah sudut horizontal dari suatu titik referensi (biasanya utara geografis) searah jarum jam ke arah objek yang diamati (dalam hal ini, satelit). Azimuth diukur dalam derajat, berkisar dari 0° hingga 360°.
                       </p>
                   </div>

                   <div class="section">
                       <h4 class="section-title">Mengapa Azimuth Penting?</h4>
                       <p class="section-content">
                           Perhitungan Azimuth sangat penting untuk <strong>menginstal dan mengarahkan antena satelit</strong> (seperti parabola) dengan benar. Tanpa Azimuth yang akurat, antena tidak akan dapat menerima atau mengirim sinyal dari/ke satelit target secara optimal, yang akan mengakibatkan kualitas sinyal yang buruk atau bahkan tidak ada koneksi sama sekali.
                       </p>
                   </div>

                   <div class="section">
                       <h4 class="section-title">Parameter Utama dalam Perhitungan Azimuth</h4>
                       <ul class="param-list">
                           <li><strong>Latitude:</strong> Garis lintang lokasi stasiun bumi Anda. Ini menunjukkan seberapa jauh utara atau selatan Anda dari khatulistiwa.</li>
                           <li><strong>Δ Longitude (Delta Longitude):</strong> Perbedaan garis bujur antara lokasi stasiun bumi Anda dan posisi garis bujur satelit geostasioner. Nilai ini sangat penting karena satelit geostasioner "diam" di atas khatulistiwa pada bujur tertentu.</li>
                           <li><strong>In N. Hem?:</strong> Indikator apakah lokasi Anda berada di Belahan Bumi Utara (nilai 1 (✅)) atau Belahan Bumi Selatan (nilai 0(❌)).</li>
                           <li><strong>In S. Hem?:</strong> Negasi dari "In N. Hem?", artinya apakah lokasi Anda berada di Belahan Bumi Utara (yaitu, di Belahan Bumi Selatan).</li>
                           <li><strong>East of Satellite:</strong> Indikator apakah lokasi Anda berada di sebelah Timur (nilai 1 (✅)) atau Barat (nilai 0(❌)) dari posisi satelit.</li>
                           <li><strong>West of Satellite:</strong> Negasi dari "East of Satellite", artinya apakah lokasi Anda berada di sebelah Barat satelit.</li>
                           <li><strong>AzimuthCalc:</strong> Ini adalah nilai Azimuth dasar yang dihitung dari parameter Latitude dan Δ Longitude. Nilai ini biasanya berada dalam rentang -90° hingga +90° dan memerlukan penyesuaian kuadran untuk mendapatkan Azimuth akhir yang benar (0°-360°).</li>
                       </ul>
                   </div>

                   <div class="section">
                       <h4 class="section-title">Penyesuaian Kuadran</h4>
                       <p class="section-content">
                           Karena Azimuth adalah sudut 360° dari utara, AzimuthCalc saja tidak cukup. Sistem menggunakan kombinasi logika Boolean (AND) dari `In N. Hem?`, `In S. Hem?`, `East of Satellite`, dan `West of Satellite` untuk menentukan kuadran mana lokasi Anda berada relatif terhadap satelit. Kemudian, nilai AzimuthCalc dasar disesuaikan dengan kuadran tersebut:
                       </p>
                       <ul class="param-list">
                           <li><strong>Quad NE (North-East):</strong> Jika Anda di Belahan Selatan dan Barat satelit. Rentang Azimuth: 0° - 90°.</li>
                           <li><strong>Quad SE (South-East):</strong> Jika Anda di Belahan Utara dan Barat satelit. Rentang Azimuth: 90° - 180°.</li>
                           <li><strong>Quad SW (South-West):</strong> Jika Anda di Belahan Utara dan Timur satelit. Rentang Azimuth: 180° - 270°.</li>
                           <li><strong>Quad NW (North-West):</strong> Jika Anda di Belahan Selatan dan Timur satelit. Rentang Azimuth: 270° - 360°.</li>
                       </ul>
                       <p class="section-content">
                           <strong>Azimuth Result</strong> adalah hasil akhir dari penjumlahan kontribusi Azimuth dari keempat kuadran, yang akan memberikan sudut arah antena yang benar dalam skala 0° hingga 360°.
                       </p>
                   </div>

                   <div class="section">
                       <h4 class="section-title">Uplink dan Downlink</h4>
                       <p class="section-content">
                           Perhitungan Azimuth adalah simetris untuk jalur <strong>Uplink</strong> (dari stasiun bumi ke satelit) dan <strong>Downlink</strong> (dari satelit ke stasiun bumi) jika lokasi stasiun bumi adalah sama. Oleh karena itu, prinsip perhitungan yang sama diterapkan pada kedua bagian.
                       </p>
                   </div>
               </div>
           </div>
       </div>
   </div>

   {{-- Popups untuk detail perhitungan --}}
   {{-- Popups untuk detail perhitungan - Semua pop-up detail akan menggunakan struktur ini --}}
   <div id="innhem_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail In Northern Hemisphere? (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{IF(Latitude} \geq 0, \text{THEN 1, ELSE 0)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Field ini menentukan posisi geografis stasiun bumi terhadap garis ekuator. Latitude positif ($ \geq 0 $) berarti lokasi berada di belahan bumi utara (northern hemisphere), sedangkan latitude negatif ($ < 0 $) berarti lokasi di belahan bumi selatan (southern hemisphere). Nilai 1 (✅) menunjukkan Belahan Utara, dan 0 (❌) menunjukkan Belahan Selatan. Informasi ini krusial untuk menentukan kuadran posisi satelit relatif terhadap stasiun bumi.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="innhem2_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail In Southern Hemisphere? (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{(In S. Hem)} = \text{IF(In N. Hem} = 0, \text{THEN 1, ELSE 0)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                    Ini adalah nilai kebalikan dari field "In N. Hem?". Jika stasiun bumi berada di belahan utara (In N. Hem = 1 (✅)), maka "In S. Hem?" akan bernilai 0 (❌). Sebaliknya, jika stasiun bumi di belahan selatan (In N. Hem = 0 (❌)), maka "In S. Hem?" akan bernilai 1 (✅). Field ini digunakan dalam operasi logika AND untuk menentukan kuadran posisi satelit.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="eastofsat_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail East of Satellite? (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{IF(Δ Longitude} \geq 0, \text{THEN 1, ELSE 0)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Field ini menunjukkan posisi stasiun bumi relatif terhadap satelit dalam arah horizontal (bujur). Δ Longitude (Delta Longitude) adalah selisih   bujur antara stasiun bumi dengan satelit. Jika Δ Longitude positif ($ \geq 0 $), artinya stasiun bumi berada di sebelah timur satelit (East of Satellite = 1 (✅)). Jika negatif ($ < 0 $), stasiun bumi di sebelah barat satelit (East of Satellite = 0 (❌)).</p>
               </div>
           </div>
       </div>
   </div>

   <div id="eastofsat2_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail West of Satellite? (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{(West of Satellite)} = \text{IF(East of Satellite} = 0, \text{THEN 1, ELSE 0)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Nilai kebalikan dari "East of Satellite". Jika stasiun bumi di timur satelit (East of Satellite = 1 (✅)), maka "West of Satellite?" akan bernilai 0 (❌). Jika stasiun bumi di barat satelit (East of Satellite = 0 (❌)), maka "West of Satellite?" akan bernilai 1 (✅). Field ini penting untuk menentukan kuadran NE dan SE yang membutuhkan kondisi "West of Satellite" (stasiun bumi di barat satelit).</p>
               </div>
           </div>
       </div>
   </div>

   <div id="azimuthcalc_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Azimuth Calculation (Nilai Dasar) (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$57.29578 \times \text{ATAN}(\text{SIN}(\Delta \text{Longitude} / 57.29578) / (-\text{SIN(Latitude} / 57.29578) \times \text{COS}(\Delta \text{Longitude} / 57.29578)))$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Ini adalah perhitungan Azimuth Dasar menggunakan rumus trigonometri. Nilai ini adalah sudut mentah yang kemudian akan disesuaikan dan dikombinasikan dengan logika kuadran untuk mendapatkan Azimuth Result akhir dalam rentang 0°-360°. Konstanta 57.29578 digunakan untuk konversi unit antara derajat dan radian dalam rumus ini.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="sat_in_quad_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Satelit di Kuadran NE (Timur Laut)? (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{AND(In S. Hem, West of Satellite)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                  Kuadran NE (North-East) terjadi ketika stasiun bumi berada di <strong>Belahan Bumi Selatan</strong> (In S. Hem = 1 (✅)) DAN di <strong>Barat satelit</strong> (West of Satellite = 1 (✅)). Operasi AND menghasilkan 1 (✅) hanya jika kedua kondisi bernilai 1 (✅). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="quad_result_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Kuadran NE (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Satellite in Quad NE} \times |\text{AzimuthCalc Dasar}|$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                  Jika satelit berada di kuadran NE (Satellite in Quad NE = 1 (✅)), maka kontribusi kuadran ini terhadap Azimuth Result akhir adalah nilai absolut dari AzimuthCalc Dasar. Kuadran NE memiliki rentang 0°-90° dari utara.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="sat_in_quad_value_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Satelit di Kuadran SE (Tenggara)? (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{AND(In N. Hem, West of Satellite)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Kuadran SE (South-East) terjadi ketika stasiun bumi berada di <strong>Belahan Bumi Utara</strong> (In N. Hem = 1 (✅)) DAN di <strong>Barat satelit</strong> (West of Satellite = 1 (✅)). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="quad_result_value_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Kuadran SE (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Satellite in Quad SE} \times (180 - |\text{AzimuthCalc Dasar}|)$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Untuk kuadran SE, kontribusi azimuth dihitung dengan rumus $(180 - |\text{AzimuthCalc Dasar}|)$ jika Satellite in Quad SE bernilai 1 (✅). Kuadran SE mencakup rentang 90°-180° dari utara.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="sat_in_quad_value2_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Satelit di Kuadran SW (Barat Daya)? (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{AND(In N. Hem, East of Satellite)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Kuadran SW (South-West) terjadi ketika stasiun bumi berada di <strong>Belahan Bumi Utara</strong> (In N. Hem = 1 (✅)) DAN di <strong>Timur satelit</strong> (East of Satellite = 1 (✅)). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="quad_result_value2_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Kuadran SW (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Satellite in Quad SW} \times (180 + |\text{AzimuthCalc Dasar}|)$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Untuk kuadran SW, kontribusi azimuth dihitung dengan rumus $(180 + |\text{AzimuthCalc Dasar}|)$ jika Satellite in Quad SW bernilai 1 (✅). Kuadran SW mencakup rentang 180°-270° dari utara.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="sat_in_quad_value3_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Satelit di Kuadran NW (Barat Laut)? (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{AND(In S. Hem, East of Satellite)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Kuadran NW (North-West) terjadi ketika stasiun bumi berada di <strong>Belahan Bumi Selatan</strong> (In S. Hem = 1 (✅)) DAN di <strong>Timur satelit</strong> (East of Satellite = 1 (✅)). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="quad_result_value3_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Kuadran NW (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Satellite in Quad NW} \times (360 - |\text{AzimuthCalc Dasar}|)$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Untuk kuadran NW, kontribusi azimuth dihitung dengan rumus $(360 - |\text{AzimuthCalc Dasar}|)$ jika Satellite in Quad NW bernilai 1 (✅). Kuadran NW mencakup rentang 270°-360° dari utara.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="azimuthresult_up_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Akhir Azimuth (Uplink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Quad NE Result + Quad SE Result + Quad SW Result + Quad NW Result}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Azimuth akhir adalah total penjumlahan kontribusi dari keempat kuadran (NE, SE, SW, NW). Karena dalam setiap skenario hanya satu kuadran yang aktif (memiliki nilai Satellite in Quad = 1 (✅)), maka hanya satu kontribusi kuadran yang akan bernilai non-nol, sehingga memberikan azimuth akhir yang benar dalam rentang 0°-360°.</p>
               </div>
           </div>
       </div>
   </div>

   {{-- Downlink Popups --}}
   <div id="innhem_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail In Northern Hemisphere? (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{IF(Latitude} \geq 0, \text{THEN 1, ELSE 0)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Field ini menentukan posisi geografis stasiun bumi terhadap garis ekuator. Latitude positif ($ \geq 0 $) berarti lokasi berada di belahan bumi utara (northern hemisphere), sedangkan latitude negatif ($ < 0 $) berarti lokasi di belahan bumi selatan (southern hemisphere). Nilai 1 (✅) menunjukkan Belahan Utara, dan 0 (❌) menunjukkan Belahan Selatan.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="innhem2_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail In Southern Hemisphere? (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{(In S. Hem)} = \text{IF(In N. Hem} = 0, \text{THEN 1, ELSE 0)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Ini adalah nilai kebalikan dari field "In N. Hem?". Jika stasiun bumi berada di belahan utara (In N. Hem = 1 (✅)), maka "In S. Hem?" akan bernilai 0 (❌). Sebaliknya, jika stasiun bumi di belahan selatan (In N. Hem = 0 (❌)), maka "In S. Hem?" akan bernilai 1 (✅). Field ini digunakan dalam operasi logika AND untuk menentukan kuadran posisi satelit.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="eastofsat_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail East of Satellite? (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{IF(Δ Longitude} \geq 0, \text{THEN 1, ELSE 0)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Field ini menunjukkan posisi stasiun bumi relatif terhadap satelit dalam arah horizontal (bujur). Δ Longitude (Delta Longitude) adalah selisih bujur antara stasiun bumi dengan satelit. Jika Δ Longitude positif ($ \geq 0 $), artinya stasiun bumi berada di sebelah timur satelit (East of Satellite = 1 (✅)). Jika negatif ($ < 0 $), stasiun bumi di sebelah barat satelit (East of Satellite = 0 (❌)).</p>
               </div>
           </div>
       </div>
   </div>

   <div id="eastofsat2_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail West of Satellite? (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{(West of Satellite)} = \text{IF(East of Satellite} = 0, \text{THEN 1, ELSE 0)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Nilai kebalikan dari "East of Satellite". Jika stasiun bumi di timur satelit (East of Satellite = 1 (✅)), maka "West of Satellite?" akan bernilai 0 (❌). Jika stasiun bumi di barat satelit (East of Satellite = 0 (❌)), maka "West of Satellite?" akan bernilai 1 (✅). Field ini penting untuk menentukan kuadran NE dan SE yang membutuhkan kondisi "West of Satellite" (stasiun bumi di barat satelit).</p>
               </div>
           </div>
       </div>
   </div>

   <div id="azimuthcalc_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Azimuth Calculation (Nilai Dasar) (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$57.29578 \times \text{ATAN}(\text{SIN}(\Delta \text{Longitude} / 57.29578) / (-\text{SIN(Latitude} / 57.29578) \times \text{COS}(\Delta \text{Longitude} / 57.29578)))$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Ini adalah perhitungan Azimuth Dasar menggunakan rumus trigonometri. Nilai ini adalah sudut mentah yang kemudian akan disesuaikan dan dikombinasikan dengan logika kuadran untuk mendapatkan Azimuth Result akhir dalam rentang 0°-360°. Konstanta 57.29578 digunakan untuk konversi unit antara derajat dan radian dalam rumus ini.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="sat_in_quad_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Satelit di Kuadran NE (Timur Laut)? (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                      $$\text{AND(In S. Hem, West of Satellite)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Kuadran NE (North-East) terjadi ketika stasiun bumi berada di <strong>Belahan Bumi Selatan</strong> (In S. Hem = 1 (✅)) DAN di <strong>Barat satelit</strong> (West of Satellite = 1 (✅)). Operasi AND menghasilkan 1 (✅) hanya jika kedua kondisi bernilai 1 (✅). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="quad_result_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Kuadran NE (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Satellite in Quad NE} \times |\text{AzimuthCalc Dasar}|$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Jika satelit berada di kuadran NE (Satellite in Quad NE = 1 (✅)), maka kontribusi kuadran ini terhadap Azimuth Result akhir adalah nilai absolut dari AzimuthCalc Dasar. Kuadran NE memiliki rentang 0°-90° dari utara.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="sat_in_quad_value_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Satelit di Kuadran SE (Tenggara)? (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{AND(In N. Hem, West of Satellite)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Kuadran SE (South-East) terjadi ketika stasiun bumi berada di <strong>Belahan Bumi Utara</strong> (In N. Hem = 1 (✅)) DAN di <strong>Barat satelit</strong> (West of Satellite = 1 (✅)). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="quad_result_value_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Kuadran SE (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Satellite in Quad SE} \times (180 - |\text{AzimuthCalc Dasar}|)$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Untuk kuadran SE, kontribusi azimuth dihitung dengan rumus $(180 - |\text{AzimuthCalc Dasar}|)$ jika Satellite in Quad SE bernilai 1 (✅). Kuadran SE mencakup rentang 90°-180° dari utara.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="sat_in_quad_value2_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Satelit di Kuadran SW (Barat Daya)? (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{AND(In N. Hem, East of Satellite)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Kuadran SW (South-West) terjadi ketika stasiun bumi berada di <strong>Belahan Bumi Utara</strong> (In N. Hem = 1 (✅)) DAN di <strong>Timur satelit</strong> (East of Satellite = 1 (✅)). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="quad_result_value2_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Kuadran SW (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Satellite in Quad SW} \times (180 + |\text{AzimuthCalc Dasar}|)$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Untuk kuadran SW, kontribusi azimuth dihitung dengan rumus $(180 + |\text{AzimuthCalc Dasar}|)$ jika Satellite in Quad SW bernilai 1 (✅). Kuadran SW mencakup rentang 180°-270° dari utara.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="sat_in_quad_value3_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Satelit di Kuadran NW (Barat Laut)? (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{AND(In S. Hem, East of Satellite)}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Kuadran NW (North-West) terjadi ketika stasiun bumi berada di <strong>Belahan Bumi Selatan</strong> (In S. Hem = 1 (✅)) DAN di <strong>Timur satelit</strong> (East of Satellite = 1 (✅)). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="quad_result_value3_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Kuadran NW (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Satellite in Quad NW} \times (360 - |\text{AzimuthCalc Dasar}|)$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Untuk kuadran NW, kontribusi azimuth dihitung dengan rumus $(360 - |\text{AzimuthCalc Dasar}|)$ jika Satellite in Quad NW bernilai 1 (✅). Kuadran NW mencakup rentang 270°-360° dari utara.</p>
               </div>
           </div>
       </div>
   </div>

   <div id="azimuthresult_down_popup" class="popup-window">
       <div class="popup-content">
           <div class="popup-header">
               <span class="close-popup-btn">&times;</span> <h3>Detail Hasil Akhir Azimuth (Downlink)</h3>
           </div>
           <div class="popup-body">
               <div>
                   <div class="formula">
                       <strong>Rumus Perhitungan:</strong><br>
                       $$\text{Quad NE Result + Quad SE Result + Quad SW Result + Quad NW Result}$$
                   </div>
                   <p><strong>Penjelasan:</strong><br>
                   Azimuth akhir adalah total penjumlahan kontribusi dari keempat kuadran (NE, SE, SW, NW). Karena dalam setiap skenario hanya satu kuadran yang aktif (memiliki nilai Satellite in Quad = 1 (✅)), maka hanya satu kontribusi kuadran yang akan bernilai non-nol, sehingga memberikan azimuth akhir yang benar dalam rentang 0°-360°.</p>
               </div>
           </div>
       </div>
   </div>

   <script>
       // Fungsi untuk membuka pop-up
       function openPopup(popupId) {
           // Tutup semua popup lain yang mungkin terbuka
           document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
           
           document.getElementById(popupId).style.display = "flex";
           // Render ulang rumus matematika jika MathJax tersedia
           if (typeof MathJax !== 'undefined') {
               MathJax.typesetPromise();
           }
       }

       // Fungsi untuk menutup semua pop-up
       document.querySelectorAll('.close-popup-btn').forEach(btn => {
           btn.onclick = () => {
               document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
           };
       });

       document.addEventListener('DOMContentLoaded', function() {
           // Event listener untuk tombol "Apa itu Kalkulator Azimuth?"
           document.getElementById('info_azimuth_general_btn').onclick = () => {
               openPopup('popup_azimuth_general');
           };

           // Event listeners untuk semua tombol "Lihat Detail"
           // Uplink
           document.getElementById('innhem_up_popup_btn_trigger').onclick = () => openPopup('innhem_up_popup');
           document.getElementById('innhem2_up_popup_btn_trigger').onclick = () => openPopup('innhem2_up_popup');
           document.getElementById('eastofsat_up_popup_btn_trigger').onclick = () => openPopup('eastofsat_up_popup');
           document.getElementById('eastofsat2_up_popup_btn_trigger').onclick = () => openPopup('eastofsat2_up_popup');
           document.getElementById('azimuthcalc_up_popup_btn_trigger').onclick = () => openPopup('azimuthcalc_up_popup');
           document.getElementById('sat_in_quad_up_popup_btn_trigger').onclick = () => openPopup('sat_in_quad_up_popup');
           document.getElementById('quad_result_up_popup_btn_trigger').onclick = () => openPopup('quad_result_up_popup');
           document.getElementById('sat_in_quad_value_up_popup_btn_trigger').onclick = () => openPopup('sat_in_quad_value_up_popup');
           document.getElementById('quad_result_value_up_popup_btn_trigger').onclick = () => openPopup('quad_result_value_up_popup');
           document.getElementById('sat_in_quad_value2_up_popup_btn_trigger').onclick = () => openPopup('sat_in_quad_value2_up_popup');
           document.getElementById('quad_result_value2_up_popup_btn_trigger').onclick = () => openPopup('quad_result_value2_up_popup');
           document.getElementById('sat_in_quad_value3_up_popup_btn_trigger').onclick = () => openPopup('sat_in_quad_value3_up_popup');
           document.getElementById('quad_result_value3_up_popup_btn_trigger').onclick = () => openPopup('quad_result_value3_up_popup');
           document.getElementById('azimuthresult_up_popup_btn_trigger').onclick = () =>document.getElementById('azimuthresult_up_popup_btn_trigger').onclick = () => openPopup('azimuthresult_up_popup');

           // Downlink
           document.getElementById('innhem_down_popup_btn_trigger').onclick = () => openPopup('innhem_down_popup');
           document.getElementById('innhem2_down_popup_btn_trigger').onclick = () => openPopup('innhem2_down_popup');
           document.getElementById('eastofsat_down_popup_btn_trigger').onclick = () => openPopup('eastofsat_down_popup');
           document.getElementById('eastofsat2_down_popup_btn_trigger').onclick = () => openPopup('eastofsat2_down_popup');
           document.getElementById('azimuthcalc_down_popup_btn_trigger').onclick = () => openPopup('azimuthcalc_down_popup');
           document.getElementById('sat_in_quad_down_popup_btn_trigger').onclick = () => openPopup('sat_in_quad_down_popup');
           document.getElementById('quad_result_down_popup_btn_trigger').onclick = () => openPopup('quad_result_down_popup');
           document.getElementById('sat_in_quad_value_down_popup_btn_trigger').onclick = () => openPopup('sat_in_quad_value_down_popup');
           document.getElementById('quad_result_value_down_popup_btn_trigger').onclick = () => openPopup('quad_result_value_down_popup');
           document.getElementById('sat_in_quad_value2_down_popup_btn_trigger').onclick = () => openPopup('sat_in_quad_value2_down_popup');
           document.getElementById('quad_result_value2_down_popup_btn_trigger').onclick = () => openPopup('quad_result_value2_down_popup');
           document.getElementById('sat_in_quad_value3_down_popup_btn_trigger').onclick = () => openPopup('sat_in_quad_value3_down_popup');
           document.getElementById('quad_result_value3_down_popup_btn_trigger').onclick = () => openPopup('quad_result_value3_down_popup');
           document.getElementById('azimuthresult_down_popup_btn_trigger').onclick = () => openPopup('azimuthresult_down_popup');
       });

       // Fungsi calculateAzimuthBase: Menghitung nilai dasar azimuth (hasil ATAN)
       // Fungsi ini TIDAK lagi melakukan penyesuaian kuadran lengkap.
       // Penyesuaian kuadran dilakukan di fungsi calculateUplink/Downlink
       // untuk menjumlahkan Quad Result.
       function calculateAzimuthBase(latitude, longitude) {
           const DEG_TO_RAD_FACTOR = 57.29578; 

           const latDivFactor = latitude / DEG_TO_RAD_FACTOR;
           const longDivFactor = longitude / DEG_TO_RAD_FACTOR;

           const numerator = Math.sin(longDivFactor);
           const denominator = -Math.sin(latDivFactor) * Math.cos(longDivFactor);

           if (Math.abs(denominator) < 1e-10) {
               if (Math.abs(numerator) < 1e-10) {
                   return 0; 
               }
               // Dalam konteks rumus dasar ATAN, jika penyebut nol, hasilnya bisa +/- 90.
               // Kita kembalikan nilai ini agar nanti bisa diolah di logika kuadran.
               return (longitude >= 0) ? 90 : -90; // Untuk kasus di ekuator atau bujur yang sama
           }

           let result = DEG_TO_RAD_FACTOR * Math.atan(numerator / denominator);
           return result;
       }

       // Fungsi AND
       function AND(a, b) {
           return a && b;
       }

       // Fungsi untuk mengkonversi nilai boolean ke simbol
       function booleanToSymbol(value) {
           return value ? '✅' : '❌';
       }

       // JavaScript untuk perhitungan UPLINK
       document.addEventListener('DOMContentLoaded', function() {
           const latitudeUpInput = document.getElementById('latitude_up');
           const longitudeUpInput = document.getElementById('longitude_up');

           latitudeUpInput.addEventListener('input', calculateUplink);
           longitudeUpInput.addEventListener('input', calculateUplink);

           function calculateUplink() {
               const latitude = parseFloat(latitudeUpInput.value) || 0;
               const longitude = parseFloat(longitudeUpInput.value) || 0;

               const innhemUpValue = latitude >= 0 ? 1 : 0;
               document.getElementById('innhem_up').value = booleanToSymbol(innhemUpValue);

               const innhem2UpValue = !innhemUpValue ? 1 : 0;
               document.getElementById('innhem2_up').value = booleanToSymbol(innhem2UpValue);

               const eastofSatUpValue = longitude >= 0 ? 1 : 0;
               document.getElementById('eastofsat_up').value = booleanToSymbol(eastofSatUpValue);

               const eastofSat2UpValue = !eastofSatUpValue ? 1 : 0;
               document.getElementById('eastofsat2_up').value = booleanToSymbol(eastofSat2UpValue);

               // AzimuthCalc akan menjadi nilai dasar (0-90)
               const baseAzimuthCalcValue = calculateAzimuthBase(latitude, longitude);
               document.getElementById('azimuthcalc_up').value = baseAzimuthCalcValue.toFixed(3);

               // Perhitungan Kuadran
               const satInQuadNE = AND(innhem2UpValue, eastofSat2UpValue) ? 1 : 0;
               const quadResultNE = satInQuadNE * Math.abs(baseAzimuthCalcValue);
               document.getElementById('sat_in_quad_up').value = booleanToSymbol(satInQuadNE);
               // Pastikan hanya menampilkan angka di dalam input, unit di luar
               document.getElementById('quad_result_up').value = quadResultNE.toFixed(3);

               const satInQuadSE = AND(innhemUpValue, eastofSat2UpValue) ? 1 : 0;
               const quadResultSE = satInQuadSE * (180 - Math.abs(baseAzimuthCalcValue));
               document.getElementById('sat_in_quad_value_up').value = booleanToSymbol(satInQuadSE);
               document.getElementById('quad_result_value_up').value = quadResultSE.toFixed(3);

               const satInQuadSW = AND(innhemUpValue, eastofSatUpValue) ? 1 : 0;
               const quadResultSW = satInQuadSW * (180 + Math.abs(baseAzimuthCalcValue));
               document.getElementById('sat_in_quad_value2_up').value = booleanToSymbol(satInQuadSW);
               document.getElementById('quad_result_value2_up').value = quadResultSW.toFixed(3);

               const satInQuadNW = AND(innhem2UpValue, eastofSatUpValue) ? 1 : 0;
               const quadResultNW = satInQuadNW * (360 - Math.abs(baseAzimuthCalcValue));
               document.getElementById('sat_in_quad_value3_up').value = booleanToSymbol(satInQuadNW);
               document.getElementById('quad_result_value3_up').value = quadResultNW.toFixed(3);

               // Azimuth Result adalah penjumlahan dari semua Quad Result
               const finalAzimuthResult = quadResultNE + quadResultSE + quadResultSW + quadResultNW;
               document.getElementById('azimuthresult_up').value = finalAzimuthResult.toFixed(3);

               // Update text for angle ranges (only need to remove '°' from value attribute)
               // These values are static, so no need to recalculate them in JS unless their logic changes
               document.getElementById('quad_angle_range_up').value = "0 to 90";
               document.getElementById('quad_angle_range_value_up').value = "90 to 180";
               document.getElementById('quad_angle_range_value2_up').value = "180 to 270";
               document.getElementById('quad_angle_range_value3_up').value = "270 to 360";
           }

           calculateUplink();
       });

       // JavaScript untuk perhitungan DOWNLINK
       document.addEventListener('DOMContentLoaded', function() {
           const latitudeDownInput = document.getElementById('latitude_down');
           const longitudeDownInput = document.getElementById('longitude_down');

           latitudeDownInput.addEventListener('input', calculateDownlink);
           longitudeDownInput.addEventListener('input', calculateDownlink);

           function calculateDownlink() {
               const latitude = parseFloat(latitudeDownInput.value) || 0;
               const longitude = parseFloat(longitudeDownInput.value) || 0;

               const innhemDownValue = latitude >= 0 ? 1 : 0;
               document.getElementById('innhem_down').value = booleanToSymbol(innhemDownValue);

               const innhem2DownValue = !innhemDownValue ? 1 : 0;
               document.getElementById('innhem2_down').value = booleanToSymbol(innhem2DownValue);

               const eastofSatDownValue = longitude >= 0 ? 1 : 0;
               document.getElementById('eastofsat_down').value = booleanToSymbol(eastofSatDownValue);

               const eastofSat2DownValue = !eastofSatDownValue ? 1 : 0;
               document.getElementById('eastofsat2_down').value = booleanToSymbol(eastofSat2DownValue);

               // AzimuthCalc akan menjadi nilai dasar (0-90)
               const baseAzimuthCalcValue = calculateAzimuthBase(latitude, longitude);
               document.getElementById('azimuthcalc_down').value = baseAzimuthCalcValue.toFixed(3);

               // Perhitungan Kuadran
               const satInQuadNE = AND(innhem2DownValue, eastofSat2DownValue) ? 1 : 0;
               const quadResultNE = satInQuadNE * Math.abs(baseAzimuthCalcValue);
               document.getElementById('sat_in_quad_down').value = booleanToSymbol(satInQuadNE);
               // Pastikan hanya menampilkan angka di dalam input, unit di luar
               document.getElementById('quad_result_down').value = quadResultNE.toFixed(3);

               const satInQuadSE = AND(innhemDownValue, eastofSat2DownValue) ? 1 : 0;
               const quadResultSE = satInQuadSE * (180 - Math.abs(baseAzimuthCalcValue));
               document.getElementById('sat_in_quad_value_down').value = booleanToSymbol(satInQuadSE);
               document.getElementById('quad_result_value_down').value = quadResultSE.toFixed(3);

               const satInQuadSW = AND(innhemDownValue, eastofSatDownValue) ? 1 : 0;
               const quadResultSW = satInQuadSW * (180 + Math.abs(baseAzimuthCalcValue));
               document.getElementById('sat_in_quad_value2_down').value = booleanToSymbol(satInQuadSW);
               document.getElementById('quad_result_value2_down').value = quadResultSW.toFixed(3);

               const satInQuadNW = AND(innhem2DownValue, eastofSatDownValue) ? 1 : 0;
               const quadResultNW = satInQuadNW * (360 - Math.abs(baseAzimuthCalcValue));
               document.getElementById('sat_in_quad_value3_down').value = booleanToSymbol(satInQuadNW);
               document.getElementById('quad_result_value3_down').value = quadResultNW.toFixed(3);

               // Azimuth Result adalah penjumlahan dari semua Quad Result
               const finalAzimuthResult = quadResultNE + quadResultSE + quadResultSW + quadResultNW;
               document.getElementById('azimuthresult_down').value = finalAzimuthResult.toFixed(3);

               // Update text for angle ranges (only need to remove '°' from value attribute)
               // These values are static, so no need to recalculate them in JS unless their logic changes
               document.getElementById('quad_angle_range_down').value = "0 to 90";
               document.getElementById('quad_angle_range_value_down').value = "90 to 180";
               document.getElementById('quad_angle_range_value2_down').value = "180 to 270";
               document.getElementById('quad_angle_range_value3_down').value = "270 to 360";
           }

           calculateDownlink();
       });

       // Pastikan MathJax dimuat dan di-typeset ulang ketika DOMContentLoaded
       document.addEventListener('DOMContentLoaded', () => {
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