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
            font-size: 14px; /* Added font size for better readability */
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
        table input[type="text"] {
            padding: 0.5rem;
            height: auto;
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                    <i class="fas fa-satellite-dish mr-2 text-blue-600"></i> Kalkulator Azimuth
                </h1>
                <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                    Hitung Azimuth untuk arah antena satelit Anda.
                </p>

                {{-- Uplink Section --}}
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                    <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Uplink</h2>
                    <form method="POST" action="{{ route('calcazimuth.store') }}" id="uplinkForm">
                        @csrf
                        <input type="hidden" name="user_id" value="1">

                        <div class="input-group">
                            <div class="relative">
                                <label for="latitude_up" class="block font-medium text-gray-700 mb-2">Latitude:</label>
                                <input type="number" id="latitude_up" name="latitude_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->userlat_up ?? '' }}" step="any" value="{{ $data->userlat_up ?? '' }}">
                            </div>

                            <div class="relative">
                                <label for="innhem_up" class="block font-medium text-gray-700 mb-2">In N. Hem?:</label>
                                <input type="text" id="innhem_up" name="innhem_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="innhem_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="innhem2_up" class="block font-medium text-gray-700 mb-2">NOT In N. Hem?:</label>
                                <input type="text" id="innhem2_up" name="innhem2_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="innhem2_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="longitude_up" class="block font-medium text-gray-700 mb-2">Δ Longitude:</label>
                                <input type="number" id="longitude_up" name="longitude_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->userlong_up - $data->spaceslot_up ?? '' }}" step="any" value="{{ $data->userlong_up - $data->spaceslot_up ?? '' }}">
                            </div>

                            <div class="relative">
                                <label for="eastofsat_up" class="block font-medium text-gray-700 mb-2">East of Sat:</label>
                                <input type="text" id="eastofsat_up" name="eastofsat_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="eastofsat_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="eastofsat2_up" class="block font-medium text-gray-700 mb-2">NOT East of Sat:</label>
                                <input type="text" id="eastofsat2_up" name="eastofsat2_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="eastofsat2_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <div class="mt-8">
                            <div class="overflow-x-auto">
                                <table class="w-full bg-yellow-50 rounded-lg shadow-inner">
                                    <thead>
                                        <tr>
                                            <th class="p-3 text-left text-gray-700 font-medium bg-blue-200 rounded-tl-lg"></th>
                                            <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200">Sat. in Quad?</th>
                                            <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200">Quad. Result:</th>
                                            <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200 rounded-tr-lg">Quad. Angle Range:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-200">
                                            <td class="p-3 font-medium text-gray-700">Quad NE</td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="sat_in_quad_up" name="sat_in_quad_up" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0" readonly>
                                                <button type="button" id="sat_in_quad_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_result_up" name="quad_result_up" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0.000 °" readonly>
                                                <button type="button" id="quad_result_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_angle_range_up" name="quad_angle_range_up" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="0° to 90°" readonly>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <td class="p-3 font-medium text-gray-700">Quad SE</td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="sat_in_quad_value_up" name="sat_in_quad_value_up" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="1" readonly>
                                                <button type="button" id="sat_in_quad_value_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_result_value_up" name="quad_result_value_up" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0.000 °" readonly>
                                                <button type="button" id="quad_result_value_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_angle_range_value_up" name="quad_angle_range_value_up" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="90° to 180°" readonly>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <td class="p-3 font-medium text-gray-700">Quad SW</td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="sat_in_quad_value2_up" name="sat_in_quad_value2_up" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0" readonly>
                                                <button type="button" id="sat_in_quad_value2_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_result_value2_up" name="quad_result_value2_up" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0.000 °" readonly>
                                                <button type="button" id="quad_result_value2_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_angle_range_value2_up" name="quad_angle_range_value2_up" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="180° to 270°" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-3 font-medium text-gray-700">Quad NW</td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="sat_in_quad_value3_up" name="sat_in_quad_value3_up" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0" readonly>
                                                <button type="button" id="sat_in_quad_value3_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_result_value3_up" name="quad_result_value3_up" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0.000 °" readonly>
                                                <button type="button" id="quad_result_value3_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_angle_range_value3_up" name="quad_angle_range_value3_up" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="270° to 360°" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="relative mt-8">
                                <label for="azimuthcalc_up" class="block font-medium text-gray-700 mb-2">AzimuthCalc:</label>
                                <input type="text" id="azimuthcalc_up" name="azimuthcalc_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="azimuthcalc_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="azimuthresult_up" class="block font-medium text-gray-700 mb-2">Azimuth Result:</label>
                                <input type="text" id="azimuthresult_up" name="azimuthresult_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="azimuthresult_up_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
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
                                <input type="number" id="latitude_down" name="latitude_down" class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->userlat_down ?? '' }}" step="any" value="{{ $data->userlat_down ?? '' }}">
                            </div>

                            <div class="relative">
                                <label for="innhem_down" class="block font-medium text-gray-700 mb-2">In N. Hem?:</label>
                                <input type="text" id="innhem_down" name="innhem_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="innhem_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="innhem2_down" class="block font-medium text-gray-700 mb-2">NOT In N. Hem?:</label>
                                <input type="text" id="innhem2_down" name="innhem2_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="innhem2_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="longitude_down" class="block font-medium text-gray-700 mb-2">Δ Longitude:</label>
                                <input type="number" id="longitude_down" name="longitude_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="{{ $data->userlong_down - $data->spaceslot_down ?? '' }}" step="any" value="{{ $data->userlong_down - $data->spaceslot_down ?? '' }}">
                            </div>

                            <div class="relative">
                                <label for="eastofsat_down" class="block font-medium text-gray-700 mb-2">East of Sat:</label>
                                <input type="text" id="eastofsat_down" name="eastofsat_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="eastofsat_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="eastofsat2_down" class="block font-medium text-gray-700 mb-2">NOT East of Sat:</label>
                                <input type="text" id="eastofsat2_down" name="eastofsat2_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="eastofsat2_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <div class="mt-8">
                            <div class="overflow-x-auto">
                                <table class="w-full bg-yellow-50 rounded-lg shadow-inner">
                                    <thead>
                                        <tr>
                                            <th class="p-3 text-left text-gray-700 font-medium bg-blue-200 rounded-tl-lg"></th>
                                            <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200">Sat. in Quad?</th>
                                            <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200">Quad. Result:</th>
                                            <th class="p-3 text-center text-gray-700 font-medium underline bg-blue-200 rounded-tr-lg">Quad. Angle Range:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b border-gray-200">
                                            <td class="p-3 font-medium text-gray-700">Quad NE</td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="sat_in_quad_down" name="sat_in_quad_down" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0" readonly>
                                                <button type="button" id="sat_in_quad_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_result_down" name="quad_result_down" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0.000 °" readonly>
                                                <button type="button" id="quad_result_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_angle_range_down" name="quad_angle_range_down" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="0° to 90°" readonly>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <td class="p-3 font-medium text-gray-700">Quad SE</td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="sat_in_quad_value_down" name="sat_in_quad_value_down" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="1" readonly>
                                                <button type="button" id="sat_in_quad_value_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_result_value_down" name="quad_result_value_down" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0.000 °" readonly>
                                                <button type="button" id="quad_result_value_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_angle_range_value_down" name="quad_angle_range_value_down" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="90° to 180°" readonly>
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <td class="p-3 font-medium text-gray-700">Quad SW</td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="sat_in_quad_value2_down" name="sat_in_quad_value2_down" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0" readonly>
                                                <button type="button" id="sat_in_quad_value2_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_result_value2_down" name="quad_result_value2_down" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0.000 °" readonly>
                                                <button type="button" id="quad_result_value2_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_angle_range_value2_down" name="quad_angle_range_value2_down" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="180° to 270°" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-3 font-medium text-gray-700">Quad NW</td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="sat_in_quad_value3_down" name="sat_in_quad_value3_down" class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0" readonly>
                                                <button type="button" id="sat_in_quad_value3_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_result_value3_down" name="quad_result_value3_down" class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" placeholder="0.000 °" readonly>
                                                <button type="button" id="quad_result_value3_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                            </td>
                                            <td class="p-3 text-center">
                                                <input type="text" id="quad_angle_range_value3_down" name="quad_angle_range_down" class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" value="270° to 360°" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="relative mt-8">
                                <label for="azimuthcalc_down" class="block font-medium text-gray-700 mb-2">AzimuthCalc:</label>
                                <input type="text" id="azimuthcalc_down" name="azimuthcalc_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="azimuthcalc_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative">
                                <label for="azimuthresult_down" class="block font-medium text-gray-700 mb-2">Azimuth Result:</label>
                                <input type="text" id="azimuthresult_down" name="azimuthresult_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <button type="button" id="azimuthresult_down_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <button type="submit" form="uplinkForm" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-6">
                    <i class="fas fa-save mr-2"></i> Hitung & Simpan
                </button>
                <div class="flex justify-between mt-6">
                    <a href="/frek/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
                </a>

                    {{-- Uncomment this if you have a next page
                    <a href="/next-page-url" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                        Halaman Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk fungsionalitas popup dengan detail lengkap
        document.addEventListener('DOMContentLoaded', function() {
            const popupButtons = document.querySelectorAll('[id$="_popup_btn"]');

            popupButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const inputId = this.id.replace('_popup_btn', '');
                    const detail = getFieldDetail(inputId);

                    const popupContent = `
                        <p class="formula">${detail.formula}</p>
                        <div>
                            <p><strong>Nilai Input:</strong></p>
                            <p>${detail.inputs}</p>
                            <p><strong>Hasil Perhitungan:</strong></p>
                            <p><strong>${detail.result}</strong></p>
                            ${detail.explanation ? `<p><strong>Penjelasan:</strong></p><p>${detail.explanation}</p>` : ''}
                        </div>
                    `;
                    createModal(detail.title, popupContent);
                });
            });
        });

        // Fungsi untuk mendapatkan detail setiap field
        function getFieldDetail(fieldId) {
            const isUplink = fieldId.includes('_up');
            const prefix = isUplink ? '_up' : '_down';
            const section = isUplink ? 'Uplink' : 'Downlink';

            const latitude = parseFloat(document.getElementById(`latitude${prefix}`).value) || 0;
            const longitude = parseFloat(document.getElementById(`longitude${prefix}`).value) || 0;

            // Hitung nilai-nilai dasar yang diperlukan
            const innhemValue = latitude >= 0 ? 1 : 0;
            const innhem2Value = !innhemValue ? 1 : 0; // NOT In N. Hem
            const eastofSatValue = longitude >= 0 ? 1 : 0;
            const eastofSat2Value = !eastofSatValue ? 1 : 0; // NOT East of Sat

            // PENTING: calculateAzimuth sekarang hanya memberikan nilai dasar (0-90) atau +/-
            const baseAzimuthCalcValue = calculateAzimuthBase(latitude, longitude);

            // Hitung nilai kuadran untuk digunakan di pop-up dan azimuthResult
            const quadNE_SatInQuad = AND(innhem2Value, eastofSat2Value) ? 1 : 0;
            const quadNE_Result = quadNE_SatInQuad * Math.abs(baseAzimuthCalcValue);

            const quadSE_SatInQuad = AND(innhemValue, eastofSat2Value) ? 1 : 0;
            const quadSE_Result = quadSE_SatInQuad * (180 - Math.abs(baseAzimuthCalcValue));

            const quadSW_SatInQuad = AND(innhemValue, eastofSatValue) ? 1 : 0;
            const quadSW_Result = quadSW_SatInQuad * (180 + Math.abs(baseAzimuthCalcValue));

            const quadNW_SatInQuad = AND(innhem2Value, eastofSatValue) ? 1 : 0;
            const quadNW_Result = quadNW_SatInQuad * (360 - Math.abs(baseAzimuthCalcValue));
            
            // Azimuth Result adalah penjumlahan semua hasil kuadran
            const finalAzimuthResult = quadNE_Result + quadSE_Result + quadSW_Result + quadNW_Result;


            const details = {
                // In Northern Hemisphere
                [`innhem${prefix}`]: {
                    title: `${section} - In Northern Hemisphere?`,
                    formula: 'IF(Latitude ≥ 0, MAKA 1, SELAIN ITU 0)',
                    inputs: `Latitude = ${latitude}°`,
                    result: `${innhemValue} (${innhemValue ? 'Ya, di Belahan Utara' : 'Tidak, di Belahan Selatan'})`,
                    explanation: `Field ini menentukan posisi geografis station atau user terhadap garis ekuator bumi. Latitude positif (≥ 0) berarti lokasi berada di belahan bumi utara (northern hemisphere), seperti Indonesia, Eropa, Amerika Utara. Latitude negatif (< 0) berarti lokasi di belahan bumi selatan (southern hemisphere), seperti Australia, Argentina bagian selatan, atau Afrika Selatan. Nilai 1 = Belahan Utara, 0 = Belahan Selatan. Informasi ini penting untuk menentukan kuadran posisi satelit relatif terhadap station earth.`
                },

                // NOT In Northern Hemisphere
                [`innhem2${prefix}`]: {
                    title: `${section} - NOT In Northern Hemisphere`,
                    formula: 'NOT(In N. Hem) = IF(In N. Hem = 0, MAKA 1, SELAIN ITU 0)',
                    inputs: `In N. Hem = ${innhemValue}`,
                    result: `${innhem2Value} (${innhem2Value ? 'Di Belahan Selatan' : 'Di Belahan Utara'})`,
                    explanation: `Ini adalah nilai kebalikan (negasi/NOT logic) dari field "In N. Hem". Jika station earth di belahan utara (In N. Hem = 1), maka NOT In N. Hem = 0. Sebaliknya, jika station earth di belahan selatan (In N. Hem = 0), maka NOT In N. Hem = 1. Field ini digunakan dalam operasi logika AND untuk menentukan kuadran posisi satelit.`
                },

                // East of Satellite
                [`eastofsat${prefix}`]: {
                    title: `${section} - East of Satellite?`,
                    formula: 'IF(Δ Longitude ≥ 0, MAKA 1, SELAIN ITU 0)',
                    inputs: `Δ Longitude = ${longitude}°`,
                    result: `${eastofSatValue} (${eastofSatValue ? 'Ya, di Timur satelit' : 'Tidak, di Barat satelit'})`,
                    explanation: `Field ini menunjukkan posisi station earth relatif terhadap satelit dalam arah horizontal (bujur). Δ Longitude (Delta Longitude) adalah selisih bujur antara station earth dengan satelit. Jika Δ Longitude positif (≥ 0), artinya station earth berada di sebelah timur satelit. Jika negatif (< 0), station earth di sebelah barat satelit. Contoh: jika satelit di 110°E dan station earth di 115°E, maka Δ Longitude = +5°, sehingga station earth di timur satelit (East of Sat = 1).`
                },

                // NOT East of Satellite
                [`eastofsat2${prefix}`]: {
                    title: `${section} - NOT East of Satellite`,
                    formula: 'NOT(East of Sat) = IF(East of Sat = 0, MAKA 1, SELAIN ITU 0)',
                    inputs: `East of Sat = ${eastofSatValue}`,
                    result: `${eastofSat2Value} (${eastofSat2Value ? 'Di Barat satelit' : 'Di Timur satelit'})`,
                    explanation: `Nilai kebalikan dari "East of Sat" yang digunakan dalam operasi logika kuadran. Jika station earth di timur satelit (East of Sat = 1), maka NOT East of Sat = 0. Jika station earth di barat satelit (East of Sat = 0), maka NOT East of Sat = 1. Field ini penting untuk menentukan kuadran NE dan SE yang membutuhkan kondisi "NOT East of Sat" (station earth di barat satelit).`
                },

                // Azimuth Calculation (Ini adalah perhitungan Azimuth Dasar)
                [`azimuthcalc${prefix}`]: {
                    title: `${section} - Azimuth Calculation (Nilai Dasar)`,
                    formula: '57,29578 * ATAN(SIN(Δ Longitude / 57,29578) / (-SIN(Latitude / 57,29578) * COS(Δ Longitude / 57,29578)))',
                    inputs: `Latitude = ${latitude}°, Δ Longitude = ${longitude}°`,
                    result: `${baseAzimuthCalcValue.toFixed(3)}°`,
                    explanation: `Ini adalah perhitungan Azimuth Dasar menggunakan rumus trigonometri. Nilai ini adalah sudut mentah yang kemudian akan disesuaikan dan dikombinasikan dengan logika kuadran untuk mendapatkan Azimuth Result akhir dalam rentang 0°-360°. Konstanta 57.29578 digunakan untuk konversi unit antara derajat dan radian dalam rumus ini.`
                },

                // Quadrant NE - Sat in Quad
                [`sat_in_quad${prefix}`]: {
                    title: `${section} - Satelit di Kuadran NE (Timur Laut)?`,
                    formula: 'AND(NOT(In N. Hem), NOT(East of Sat))',
                    inputs: `NOT(In N. Hem) = ${innhem2Value}, NOT(East of Sat) = ${eastofSat2Value}`,
                    result: `${quadNE_SatInQuad} (${quadNE_SatInQuad ? 'Ya' : 'Tidak'})`,
                    explanation: `Kuadran NE (North-East) terjadi ketika station earth berada di selatan ekuator (latitude < 0) DAN di barat satelit (longitude < 0). Dalam logika: AND(NOT(In N. Hem), NOT(East of Sat)). Operasi AND menghasilkan 1 hanya jika kedua kondisi bernilai 1. Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.`
                },

                // Quadrant NE - Result
                [`quad_result${prefix}`]: {
                    title: `${section} - Hasil Kuadran NE`,
                    formula: 'Sat in Quad NE × |AzimuthCalc Dasar|',
                    inputs: `Sat in Quad NE = ${quadNE_SatInQuad}, |AzimuthCalc Dasar| = ${Math.abs(baseAzimuthCalcValue).toFixed(3)}°`,
                    result: `${quadNE_Result.toFixed(3)}°`,
                    explanation: `Jika satelit berada di kuadran NE (Sat in Quad NE = 1), maka kontribusi kuadran ini terhadap Azimuth Result akhir adalah nilai absolut dari AzimuthCalc Dasar. Kuadran NE memiliki rentang 0°-90° dari utara.`
                },

                // Quadrant SE - Sat in Quad
                [`sat_in_quad_value${prefix}`]: {
                    title: `${section} - Satelit di Kuadran SE (Tenggara)?`,
                    formula: 'AND(In N. Hem, NOT(East of Sat))',
                    inputs: `In N. Hem = ${innhemValue}, NOT(East of Sat) = ${eastofSat2Value}`,
                    result: `${quadSE_SatInQuad} (${quadSE_SatInQuad ? 'Ya' : 'Tidak'})`,
                    explanation: `Kuadran SE (South-East) terjadi ketika station earth berada di utara ekuator (latitude ≥ 0) DAN di barat satelit (longitude < 0). Logika: AND(In N. Hem, NOT(East of Sat)). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.`
                },

                // Quadrant SE - Result
                [`quad_result_value${prefix}`]: {
                    title: `${section} - Hasil Kuadran SE`,
                    formula: 'Sat in Quad SE × (180 - |AzimuthCalc Dasar|)',
                    inputs: `Sat in Quad SE = ${quadSE_SatInQuad}, |AzimuthCalc Dasar| = ${Math.abs(baseAzimuthCalcValue).toFixed(3)}°`,
                    result: `${quadSE_Result.toFixed(3)}°`,
                    explanation: `Untuk kuadran SE, kontribusi azimuth dihitung dengan rumus (180 - |AzimuthCalc Dasar|). Kuadran SE mencakup rentang 90°-180° dari utara.`
                },

                // Quadrant SW - Sat in Quad
                [`sat_in_quad_value2${prefix}`]: {
                    title: `${section} - Satelit di Kuadran SW (Barat Daya)?`,
                    formula: 'AND(In N. Hem, East of Sat)',
                    inputs: `In N. Hem = ${innhemValue}, East of Sat = ${eastofSatValue}`,
                    result: `${quadSW_SatInQuad} (${quadSW_SatInQuad ? 'Ya' : 'Tidak'})`,
                    explanation: `Kuadran SW (South-West) terjadi ketika station earth berada di utara ekuator (latitude ≥ 0) DAN di timur satelit (longitude ≥ 0). Logika: AND(In N. Hem, East of Sat). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.`
                },

                // Quadrant SW - Result
                [`quad_result_value2${prefix}`]: {
                    title: `${section} - Hasil Kuadran SW`,
                    formula: 'Sat in Quad SW × (180 + |AzimuthCalc Dasar|)',
                    inputs: `Sat in Quad SW = ${quadSW_SatInQuad}, |AzimuthCalc Dasar| = ${Math.abs(baseAzimuthCalcValue).toFixed(3)}°`,
                    result: `${quadSW_Result.toFixed(3)}°`,
                    explanation: `Untuk kuadran SW, kontribusi azimuth dihitung dengan rumus (180 + |AzimuthCalc Dasar|). Kuadran SW mencakup rentang 180°-270° dari utara.`
                },

                // Quadrant NW - Sat in Quad
                [`sat_in_quad_value3${prefix}`]: {
                    title: `${section} - Satelit di Kuadran NW (Barat Laut)?`,
                    formula: 'AND(NOT(In N. Hem), East of Sat)',
                    inputs: `NOT(In N. Hem) = ${innhem2Value}, East of Sat = ${eastofSatValue}`,
                    result: `${quadNW_SatInQuad} (${quadNW_SatInQuad ? 'Ya' : 'Tidak'})`,
                    explanation: `Kuadran NW (North-West) terjadi ketika station earth berada di selatan ekuator (latitude < 0) DAN di timur satelit (longitude ≥ 0). Logika: AND(NOT(In N. Hem), East of Sat). Ini menentukan apakah kuadran ini berkontribusi pada Azimuth Result akhir.`
                },

                // Quadrant NW - Result
                [`quad_result_value3${prefix}`]: {
                    title: `${section} - Hasil Kuadran NW`,
                    formula: 'Sat in Quad NW × (360 - |AzimuthCalc Dasar|)',
                    inputs: `Sat in Quad NW = ${quadNW_SatInQuad}, |AzimuthCalc Dasar| = ${Math.abs(baseAzimuthCalcValue).toFixed(3)}°`,
                    result: `${quadNW_Result.toFixed(3)}°`,
                    explanation: `Untuk kuadran NW, kontribusi azimuth dihitung dengan rumus (360 - |AzimuthCalc Dasar|). Kuadran NW mencakup rentang 270°-360° dari utara.`
                },

                // Azimuth Result (SEKARANG ADALAH PENJUMLAHAN DARI KEEMPAT KUADRAN)
                [`azimuthresult${prefix}`]: {
                    title: `${section} - Hasil Akhir Azimuth`,
                    formula: 'Quad NE Result + Quad SE Result + Quad SW Result + Quad NW Result',
                    inputs: `NE = ${quadNE_Result.toFixed(3)}°, SE = ${quadSE_Result.toFixed(3)}°, SW = ${quadSW_Result.toFixed(3)}°, NW = ${quadNW_Result.toFixed(3)}°`,
                    result: `${finalAzimuthResult.toFixed(3)}°`,
                    explanation: `Azimuth akhir adalah total penjumlahan kontribusi dari keempat kuadran (NE, SE, SW, NW). Karena dalam setiap skenario hanya satu kuadran yang aktif (memiliki nilai Sat in Quad = 1), maka hanya satu kontribusi kuadran yang akan bernilai non-nol, sehingga memberikan azimuth akhir yang benar dalam rentang 0°-360°.`
                }
            };

            return details[fieldId] || {
                title: 'Field tidak dikenali',
                formula: 'N/A',
                inputs: 'N/A',
                result: 'N/A',
                explanation: ''
            };
        }

        // Fungsi untuk membuat modal popup (TIDAK BERUBAH)
        function createModal(title, content) {
            const existingModal = document.getElementById('detailModal');
            if (existingModal) {
                existingModal.remove();
            }

            const modal = document.createElement('div');
            modal.id = 'detailModal';
            modal.className = 'popup-window';
            modal.style.display = 'flex';

            const modalContent = document.createElement('div');
            modalContent.className = 'popup-content';

            const closeBtn = document.createElement('span');
            closeBtn.className = 'close-popup-btn';
            closeBtn.innerHTML = '×';
            closeBtn.onclick = () => modal.remove();

            const titleElement = document.createElement('h3');
            titleElement.textContent = title;

            const contentDiv = document.createElement('div');
            contentDiv.innerHTML = content;

            modalContent.appendChild(closeBtn);
            modalContent.appendChild(titleElement);
            modalContent.appendChild(contentDiv);
            modal.appendChild(modalContent);
            document.body.appendChild(modal);

            modal.onclick = (e) => {
                if (e.target === modal) {
                    modal.remove();
                }
            };
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
                document.getElementById('innhem_up').value = innhemUpValue;

                const innhem2UpValue = !innhemUpValue ? 1 : 0;
                document.getElementById('innhem2_up').value = innhem2UpValue;

                const eastofSatUpValue = longitude >= 0 ? 1 : 0;
                document.getElementById('eastofsat_up').value = eastofSatUpValue;

                const eastofSat2UpValue = !eastofSatUpValue ? 1 : 0;
                document.getElementById('eastofsat2_up').value = eastofSat2UpValue;

                // AzimuthCalc akan menjadi nilai dasar (0-90)
                const baseAzimuthCalcValue = calculateAzimuthBase(latitude, longitude);
                document.getElementById('azimuthcalc_up').value = baseAzimuthCalcValue.toFixed(3);

                // Perhitungan Kuadran
                const satInQuadNE = AND(innhem2UpValue, eastofSat2UpValue) ? 1 : 0;
                const quadResultNE = satInQuadNE * Math.abs(baseAzimuthCalcValue);
                document.getElementById('sat_in_quad_up').value = satInQuadNE;
                document.getElementById('quad_result_up').value = quadResultNE.toFixed(3) + " °";

                const satInQuadSE = AND(innhemUpValue, eastofSat2UpValue) ? 1 : 0;
                const quadResultSE = satInQuadSE * (180 - Math.abs(baseAzimuthCalcValue));
                document.getElementById('sat_in_quad_value_up').value = satInQuadSE;
                document.getElementById('quad_result_value_up').value = quadResultSE.toFixed(3) + " °";

                const satInQuadSW = AND(innhemUpValue, eastofSatUpValue) ? 1 : 0;
                const quadResultSW = satInQuadSW * (180 + Math.abs(baseAzimuthCalcValue));
                document.getElementById('sat_in_quad_value2_up').value = satInQuadSW;
                document.getElementById('quad_result_value2_up').value = quadResultSW.toFixed(3) + " °";

                const satInQuadNW = AND(innhem2UpValue, eastofSatUpValue) ? 1 : 0;
                const quadResultNW = satInQuadNW * (360 - Math.abs(baseAzimuthCalcValue));
                document.getElementById('sat_in_quad_value3_up').value = satInQuadNW;
                document.getElementById('quad_result_value3_up').value = quadResultNW.toFixed(3) + " °";

                // Azimuth Result adalah penjumlahan dari semua Quad Result
                const finalAzimuthResult = quadResultNE + quadResultSE + quadResultSW + quadResultNW;
                document.getElementById('azimuthresult_up').value = finalAzimuthResult.toFixed(3) + " °";
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
                document.getElementById('innhem_down').value = innhemDownValue;

                const innhem2DownValue = !innhemDownValue ? 1 : 0;
                document.getElementById('innhem2_down').value = innhem2DownValue;

                const eastofSatDownValue = longitude >= 0 ? 1 : 0;
                document.getElementById('eastofsat_down').value = eastofSatDownValue;

                const eastofSat2DownValue = !eastofSatDownValue ? 1 : 0;
                document.getElementById('eastofsat2_down').value = eastofSat2DownValue;

                // AzimuthCalc akan menjadi nilai dasar (0-90)
                const baseAzimuthCalcValue = calculateAzimuthBase(latitude, longitude);
                document.getElementById('azimuthcalc_down').value = baseAzimuthCalcValue.toFixed(3);

                // Perhitungan Kuadran
                const satInQuadNE = AND(innhem2DownValue, eastofSat2DownValue) ? 1 : 0;
                const quadResultNE = satInQuadNE * Math.abs(baseAzimuthCalcValue);
                document.getElementById('sat_in_quad_down').value = satInQuadNE;
                document.getElementById('quad_result_down').value = quadResultNE.toFixed(3) + " °";

                const satInQuadSE = AND(innhemDownValue, eastofSat2DownValue) ? 1 : 0;
                const quadResultSE = satInQuadSE * (180 - Math.abs(baseAzimuthCalcValue));
                document.getElementById('sat_in_quad_value_down').value = satInQuadSE;
                document.getElementById('quad_result_value_down').value = quadResultSE.toFixed(3) + " °";

                const satInQuadSW = AND(innhemDownValue, eastofSatDownValue) ? 1 : 0;
                const quadResultSW = satInQuadSW * (180 + Math.abs(baseAzimuthCalcValue));
                document.getElementById('sat_in_quad_value2_down').value = satInQuadSW;
                document.getElementById('quad_result_value2_down').value = quadResultSW.toFixed(3) + " °";

                const satInQuadNW = AND(innhem2DownValue, eastofSatDownValue) ? 1 : 0;
                const quadResultNW = satInQuadNW * (360 - Math.abs(baseAzimuthCalcValue));
                document.getElementById('sat_in_quad_value3_down').value = satInQuadNW;
                document.getElementById('quad_result_value3_down').value = quadResultNW.toFixed(3) + " °";

                // Azimuth Result adalah penjumlahan dari semua Quad Result
                const finalAzimuthResult = quadResultNE + quadResultSE + quadResultSW + quadResultNW;
                document.getElementById('azimuthresult_down').value = finalAzimuthResult.toFixed(3) + " °";
            }

            calculateDownlink();
        });


        // Fungsi Helper

        // Fungsi AND
        function AND(a, b) {
            return a && b;
        }

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
    </script>
</x-layout>