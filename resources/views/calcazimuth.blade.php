<x-layout>
    <x-slot:title>Kalkulator Satelit</x-slot>
    <div class="container mx-auto px-4 py-8">
        
        <!-- Bagian Uplink -->
        <h2 class="text-2xl font-bold mb-6 text-center">Uplink</h2>
        <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
            <form method="POST" action="{{ route('calcazimuth.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                
                <!-- Informasi Pengguna -->
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Pengguna adalah:</label>
                </div>

                <!-- Input Latitude dan Longitude -->
                <div class="mb-4">
                    <label for="latitude_up" class="block font-medium text-gray-700">Latitude:</label>
                    <input type="number" id="latitude_up" name="latitude_up" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Latitude" step="any">
                </div>
                <div class="w-1/3 mb-4">
                    <label for="innhem_up" class="block font-medium text-grey-700 mb-1">In N. Hem?:</label>
                    <input type="text" id="innhem_up" name="innhem_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="innhem_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
          
                    <input type="text" id="innhem2_up" name="innhem2_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="innhem2_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <div class="mb-4">
                    <label for="longitude_up" class="block font-medium text-gray-700">Δ Longitude:</label>
                    <input type="number" id="longitude_up" name="longitude_up" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Longitude" step="any">
                </div>

                 <div class="w-1/3 mb-4">
                    <label for="eastofsat_up" class="block font-medium text-grey-700 mb-1">East of Sat:</label>
                    <input type="text" id="eastofsat_up" name="eastofsat_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="eastofsat_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
          
                    <input type="text" id="eastofsat2_up" name="eastofsat2_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="eastofsat2_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <!-- Bagian Kuadran dengan Layout Tabel -->
                <div class="mt-8">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="p-3 text-left text-grey-700 font-medium"></th>
                                    <th class="p-3 text-center text-grey-700 font-medium underline">Sat. in Quad?</th>
                                    <th class="p-3 text-center text-grey-700 font-medium underline">Quad. Result:</th>
                                    <th class="p-3 text-center text-grey-700 font-medium underline">Quad. Angle Range:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-3 font-medium text-grey-700">Quad NE</td>
                                    <td class="p-3">
                                        <input type="text" id="sat_in_quad_up" name="sat_in_quad_up" 
                                            class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="sat_in_quad_up_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_result_up" name="quad_result_up" 
                                            class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0.000 °" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="quad_result_up_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_angle_range_up" name="quad_angle_range_up" 
                                            class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            value="0° to 90°" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <div class="h-8 mt-12"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-medium text-grey-700">Quad SE</td>
                                    <td class="p-3">
                                        <input type="text" id="sat_in_quad_value_up" name="sat_in_quad_value_up" 
                                            class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="1" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="sat_in_quad_value_up_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_result_value_up" name="quad_result_value_up" 
                                            class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0.000 °" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="quad_result_value_up_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_angle_range_value_up" name="quad_angle_range_value_up" 
                                            class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            value="90° to 180°" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <div class="h-8 mt-12"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-medium text-grey-700">Quad SW</td>
                                    <td class="p-3">
                                        <input type="text" id="sat_in_quad_value2_up" name="sat_in_quad_value2_up" 
                                            class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="sat_in_quad_value2_up_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_result_value2_up" name="quad_result_value2_up" 
                                            class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0.000 °" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="quad_result_value2_up_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_angle_range_value2_up" name="quad_angle_range_value2_up" 
                                            class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            value="180° to 270°" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <div class="h-8 mt-12"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-medium text-grey-700">Quad NW</td>
                                    <td class="p-3">
                                        <input type="text" id="sat_in_quad_value3_up" name="sat_in_quad_value3_up" 
                                            class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="sat_in_quad_value3_up_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_result_value3_up" name="quad_result_value3_up" 
                                            class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0.000 °" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="quad_result_value3_up_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_angle_range_value3_up" name="quad_angle_range_value3_up" 
                                            class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            value="270° to 360°" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <div class="h-8 mt-12"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-1/3 mb-4">
                    <label for="azimuthcalc_up" class="block font-medium text-grey-700 mb-1">AzimuthCalc:</label>
                    <input type="text" id="azimuthcalc_up" name="azimuthcalc_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="azimuthcalc_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
               
                <div class="w-1/3 mb-4">
                    <label for="azimuthresult_up" class="block font-medium text-grey-700 mb-1">Azimuth Result:</label>
                    <input type="text" id="azimuthresult_up" name="azimuthresult_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="azimuthresult_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
            </form>
        </div>

        <!-- Bagian Downlink -->
        <h2 class="text-2xl font-bold mb-6 text-center">Downlink</h2>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form method="GET" action="">
                <!-- Informasi Pengguna -->
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Pengguna adalah:</label>
                </div>

                 <div class="mb-4">
                    <label for="latitude_down" class="block font-medium text-gray-700">Latitude:</label>
                    <input type="number" id="latitude_down" name="latitude_down" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Latitude" step="any">
                </div>

                <div class="w-1/3 mb-4">
                    <label for="innhem_down" class="block font-medium text-grey-700 mb-1">In N. Hem?:</label>
                    <input type="text" id="innhem_down" name="innhem_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="innhem_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
          
                    <input type="text" id="innhem2_down" name="innhem2_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="innhem2_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <div class="mb-4">
                    <label for="longitude_down" class="block font-medium text-grey-700">Δ Longitude:</label>
                    <input type="number" id="longitude_down" name="longitude_down" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Longitude" step="any">
                </div>

                 <div class="w-1/3 mb-4">
                    <label for="eastofsat_down" class="block font-medium text-grey-700 mb-1">East of Sat:</label>
                    <input type="text" id="eastofsat_down" name="eastofsat_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="eastofsat_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
          
                    <input type="text" id="eastofsat2_down" name="eastofsat2_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="eastofsat2_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <!-- Bagian Kuadran dengan Layout Tabel -->
                <div class="mt-8">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="p-3 text-left text-grey-700 font-medium"></th>
                                    <th class="p-3 text-center text-grey-700 font-medium underline">Sat. in Quad?</th>
                                    <th class="p-3 text-center text-grey-700 font-medium underline">Quad. Result:</th>
                                    <th class="p-3 text-center text-grey-700 font-medium underline">Quad. Angle Range:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-3 font-medium text-grey-700">Quad NE</td> 
                                    <td class="p-3">
                                        <input type="text" id="sat_in_quad_down" name="sat_in_quad_down" 
                                            class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="sat_in_quad_down_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_result_down" name="quad_result_down" 
                                            class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0.000 °" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="quad_result_down_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_angle_range_down" name="quad_angle_range_down" 
                                            class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            value="0° to 90°" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <div class="h-8 mt-12"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-medium text-grey-700">Quad SE</td>
                                    <td class="p-3">
                                        <input type="text" id="sat_in_quad_value_down" name="sat_in_quad_value_down" 
                                            class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="1" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="sat_in_quad_value_down_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_result_value_down" name="quad_result_value_down" 
                                            class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0.000 °" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="quad_result_value_down_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_angle_range_value_down" name="quad_angle_range_value_down" 
                                            class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            value="90° to 180°" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <div class="h-8 mt-12"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-medium text-grey-700">Quad SW</td>
                                    <td class="p-3">
                                        <input type="text" id="sat_in_quad_value2_down" name="sat_in_quad_value2_down" 
                                            class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="sat_in_quad_value2_down_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_result_value2_down" name="quad_result_value2_down" 
                                            class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0.000 °" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="quad_result_value2_down_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_angle_range_value2_down" name="quad_angle_range_value2_down" 
                                            class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            value="180° to 270°" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <div class="h-8 mt-12"></div>    
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-medium text-grey-700">Quad NW</td>
                                    <td class="p-3">
                                        <input type="text" id="sat_in_quad_value3_down" name="sat_in_quad_value3_down" 
                                            class="w-20 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="sat_in_quad_value3_down_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_result_value3_down" name="quad_result_value3_down" 
                                            class="w-28 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            placeholder="0.000 °" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <button type="button" id="quad_result_value3_down_popup_btn" class="text-blue-500 mt-2 block mx-auto text-sm">Lihat Detail</button>
                                    </td>
                                    <td class="p-3">
                                        <input type="text" id="quad_angle_range_value3_down" name="quad_angle_range_value3_down" 
                                            class="w-32 p-2 text-center border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed mx-auto block" 
                                            value="270° to 360°" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                                        <div class="h-8 mt-12"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-1/3 mb-4">
                    <label for="azimuthcalc_down" class="block font-medium text-grey-700 mb-1">AzimuthCalc:</label>
                    <input type="text" id="azimuthcalc_down" name="azimuthcalc_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="azimuthcalc_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
               
                <div class="w-1/3 mb-4">
                    <label for="azimuthresult_down" class="block font-medium text-grey-700 mb-1">Azimuth Result:</label>
                    <input type="text" id="azimuthresult_down" name="azimuthresult_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="azimuthresult_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script untuk fungsionalitas popup dengan detail lengkap
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan semua tombol popup
            const popupButtons = document.querySelectorAll('[id$="_popup_btn"]');
            
            // Menambahkan event listener click ke setiap tombol
            popupButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Mendapatkan ID field input yang terkait dengan tombol
                    const inputId = this.id.replace('_popup_btn', '');
                    const inputField = document.getElementById(inputId);
                    
                    // Mendapatkan detail berdasarkan field ID
                    const detail = getFieldDetail(inputId);
                    
                    // Membuat konten popup
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
                    
                    // Membuat modal popup
                    createModal(detail.title, popupContent);
                });
            });
        });

        // Fungsi untuk mendapatkan detail setiap field
        function getFieldDetail(fieldId) {
            // Menentukan apakah uplink atau downlink
            const isUplink = fieldId.includes('_up');
            const isDownlink = fieldId.includes('_down');
            const prefix = isUplink ? '_up' : '_down';
            const section = isUplink ? 'Uplink' : 'Downlink';
            
            // Mendapatkan nilai input terkait
            const latitude = parseFloat(document.getElementById(`latitude${prefix}`).value) || 0;
            const longitude = parseFloat(document.getElementById(`longitude${prefix}`).value) || 0;
            
            const details = {
                // In Northern Hemisphere
                [`innhem${prefix}`]: {
                    title: `${section} - In Northern Hemisphere?`,
                    formula: 'IF(Latitude ≥ 0, MAKA 1, SELAIN ITU 0)',
                    inputs: `Latitude = ${latitude}°`,
                    result: `${latitude >= 0 ? 1 : 0} (${latitude >= 0 ? 'Ya, di Belahan Utara' : 'Tidak, di Belahan Selatan'})`,
                    explanation: `Field ini menentukan posisi geografis station atau user terhadap garis ekuator bumi. Latitude positif (≥ 0) berarti lokasi berada di belahan bumi utara (northern hemisphere), seperti Indonesia, Eropa, Amerika Utara. Latitude negatif (< 0) berarti lokasi di belahan bumi selatan (southern hemisphere), seperti Australia, Argentina bagian selatan, atau Afrika Selatan. Nilai 1 = Belahan Utara, 0 = Belahan Selatan. Informasi ini penting untuk menentukan kuadran posisi satelit relatif terhadap station earth.`
                },
                
                // NOT In Northern Hemisphere  
                [`innhem2${prefix}`]: {
                    title: `${section} - NOT In Northern Hemisphere`,
                    formula: 'NOT(In N. Hem) = IF(In N. Hem = 0, MAKA 1, SELAIN ITU 0)',
                    inputs: `In N. Hem = ${latitude >= 0 ? 1 : 0}`,
                    result: `${latitude >= 0 ? 0 : 1} (${latitude >= 0 ? 'Di Belahan Utara' : 'Di Belahan Selatan'})`,
                    explanation: `Ini adalah nilai kebalikan (negasi/NOT logic) dari field "In N. Hem". Jika station earth di belahan utara (In N. Hem = 1), maka NOT In N. Hem = 0. Sebaliknya, jika station earth di belahan selatan (In N. Hem = 0), maka NOT In N. Hem = 1. Field ini digunakan dalam operasi logika AND untuk menentukan kuadran satelit. Dalam logika Boolean: NOT 1 = 0, dan NOT 0 = 1.`
                },
                
                // East of Satellite
                [`eastofsat${prefix}`]: {
                    title: `${section} - East of Satellite?`,
                    formula: 'IF(Δ Longitude ≥ 0, MAKA 1, SELAIN ITU 0)',
                    inputs: `Δ Longitude = ${longitude}°`,
                    result: `${longitude >= 0 ? 1 : 0} (${longitude >= 0 ? 'Ya, di Timur satelit' : 'Tidak, di Barat satelit'})`,
                    explanation: `Field ini menunjukkan posisi station earth relatif terhadap satelit dalam arah horizontal (bujur). Δ Longitude (Delta Longitude) adalah selisih bujur antara station earth dengan satelit. Jika Δ Longitude positif (≥ 0), artinya station earth berada di sebelah timur satelit. Jika negatif (< 0), station earth di sebelah barat satelit. Contoh: jika satelit di 110°E dan station earth di 115°E, maka Δ Longitude = +5°, sehingga station earth di timur satelit (East of Sat = 1).`
                },
                
                // NOT East of Satellite
                [`eastofsat2${prefix}`]: {
                    title: `${section} - NOT East of Satellite`,
                    formula: 'NOT(East of Sat) = IF(East of Sat = 0, MAKA 1, SELAIN ITU 0)',
                    inputs: `East of Sat = ${longitude >= 0 ? 1 : 0}`,
                    result: `${longitude >= 0 ? 0 : 1} (${longitude >= 0 ? 'Di Timur satelit' : 'Di Barat satelit'})`,
                    explanation: `Nilai kebalikan dari "East of Sat" yang digunakan dalam operasi logika kuadran. Jika station earth di timur satelit (East of Sat = 1), maka NOT East of Sat = 0. Jika station earth di barat satelit (East of Sat = 0), maka NOT East of Sat = 1. Field ini penting untuk menentukan kuadran NE dan SE yang membutuhkan kondisi "NOT East of Sat" (station earth di barat satelit).`
                },
                
                // Azimuth Calculation
                [`azimuthcalc${prefix}`]: {
                    title: `${section} - Azimuth Calculation`,
                    formula: 'ATAN(SIN(Δ Longitude) / (-SIN(Latitude) × COS(Δ Longitude))) × 180/π',
                    inputs: `Latitude = ${latitude}°, Δ Longitude = ${longitude}°`,
                    result: `${calculateAzimuth(latitude, longitude).toFixed(3)}°`,
                    explanation: `Azimuth adalah sudut horizontal dari utara searah jarum jam menuju arah satelit yang dilihat dari station earth. Rumus menggunakan trigonometri spherical untuk menghitung sudut berdasarkan koordinat geografis. Input latitude dalam radian (latitude × π/180) dan Δ longitude dalam radian. Fungsi ATAN menghasilkan sudut dalam radian yang kemudian dikonversi ke derajat (× 180/π). Hasil negatif menunjukkan arah ke barat dari utara, positif ke timur dari utara. Nilai azimuth berkisar 0°-360° setelah penyesuaian kuadran.`
                },
                
                // Quadrant NE - Sat in Quad
                [`sat_in_quad${prefix}`]: {
                    title: `${section} - Satelit di Kuadran NE (Timur Laut)?`,
                    formula: 'AND(NOT(In N. Hem), NOT(East of Sat))',
                    inputs: `NOT(In N. Hem) = ${latitude >= 0 ? 0 : 1}, NOT(East of Sat) = ${longitude >= 0 ? 0 : 1}`,
                    result: `${(latitude < 0 && longitude < 0) ? 1 : 0} (${(latitude < 0 && longitude < 0) ? 'Ya' : 'Tidak'})`,
                    explanation: `Kuadran NE (North-East) terjadi ketika station earth berada di selatan ekuator (latitude < 0) DAN di barat satelit (longitude < 0). Dalam logika: AND(NOT(In N. Hem), NOT(East of Sat)). Operasi AND menghasilkan 1 hanya jika kedua kondisi bernilai 1. Contoh: station earth di Jakarta (-6.2°S, 106.8°E) dan satelit di 110°E, maka station earth di selatan DAN barat satelit = kuadran NE. Jika satelit berada di kuadran NE, maka azimuth akhir = nilai absolut dari azimuth calculation.`
                },
                
                // Quadrant NE - Result
                [`quad_result${prefix}`]: {
                    title: `${section} - Hasil Kuadran NE`,
                    formula: 'Sat in Quad NE × |Azimuth|',
                    inputs: `Sat in Quad = ${(latitude < 0 && longitude < 0) ? 1 : 0}, |Azimuth| = ${Math.abs(calculateAzimuth(latitude, longitude)).toFixed(3)}°`,
                    result: `${((latitude < 0 && longitude < 0) ? Math.abs(calculateAzimuth(latitude, longitude)) : 0).toFixed(3)}°`,
                    explanation: `Jika satelit berada di kuadran NE (Sat in Quad NE = 1), maka kontribusi kuadran ini terhadap azimuth akhir adalah nilai absolut dari azimuth calculation. Nilai absolut (|Azimuth|) digunakan untuk menghilangkan tanda negatif dan mendapatkan magnitude sudut. Kuadran NE memiliki rentang 0°-90° dari utara. Jika satelit tidak di kuadran NE (Sat in Quad NE = 0), maka kontribusi = 0. Perkalian dengan 0 menghasilkan 0, perkalian dengan 1 menghasilkan nilai azimuth itu sendiri.`
                },
                
                // Quadrant SE - Sat in Quad
                [`sat_in_quad_value${prefix}`]: {
                    title: `${section} - Satelit di Kuadran SE (Tenggara)?`,
                    formula: 'AND(In N. Hem, NOT(East of Sat))',
                    inputs: `In N. Hem = ${latitude >= 0 ? 1 : 0}, NOT(East of Sat) = ${longitude >= 0 ? 0 : 1}`,
                    result: `${(latitude >= 0 && longitude < 0) ? 1 : 0} (${(latitude >= 0 && longitude < 0) ? 'Ya' : 'Tidak'})`,
                    explanation: `Kuadran SE (South-East) terjadi ketika station earth berada di utara ekuator (latitude ≥ 0) DAN di barat satelit (longitude < 0). Logika: AND(In N. Hem, NOT(East of Sat)). Contoh: station earth di Manila (14.6°N, 121°E) dan satelit di 125°E, maka station earth di utara DAN barat satelit = kuadran SE. Kuadran SE mencakup area dari 90° sampai 180° (tenggara). Kondisi AND memastikan kedua syarat terpenuhi: posisi utara ekuator DAN barat dari satelit.`
                },
                
                // Quadrant SE - Result
                [`quad_result_value${prefix}`]: {
                    title: `${section} - Hasil Kuadran SE`,
                    formula: 'Sat in Quad SE × (180 - |Azimuth|)',
                    inputs: `Sat in Quad = ${(latitude >= 0 && longitude < 0) ? 1 : 0}, |Azimuth| = ${Math.abs(calculateAzimuth(latitude, longitude)).toFixed(3)}°`,
                    result: `${((latitude >= 0 && longitude < 0) ? (180 - Math.abs(calculateAzimuth(latitude, longitude))) : 0).toFixed(3)}°`,
                    explanation: `Untuk kuadran SE, azimuth akhir dihitung dengan rumus (180 - |Azimuth|). Rumus ini memetakan azimuth calculation ke rentang kuadran SE (90°-180°). Angka 180° adalah referensi arah selatan. Dengan mengurangi nilai absolut azimuth dari 180°, kita mendapatkan sudut dari arah selatan ke arah satelit, yang kemudian disesuaikan ke sistem azimuth 360°. Jika satelit tidak di kuadran SE, hasilnya 0 (tidak berkontribusi ke azimuth akhir).`
                },
                
                // Quadrant SW - Sat in Quad
                [`sat_in_quad_value2${prefix}`]: {
                    title: `${section} - Satelit di Kuadran SW (Barat Daya)?`,
                    formula: 'AND(In N. Hem, East of Sat)',
                    inputs: `In N. Hem = ${latitude >= 0 ? 1 : 0}, East of Sat = ${longitude >= 0 ? 1 : 0}`,
                    result: `${(latitude >= 0 && longitude >= 0) ? 1 : 0} (${(latitude >= 0 && longitude >= 0) ? 'Ya' : 'Tidak'})`,
                    explanation: `Kuadran SW (South-West) terjadi ketika station earth berada di utara ekuator (latitude ≥ 0) DAN di timur satelit (longitude ≥ 0). Logika: AND(In N. Hem, East of Sat). Contoh: station earth di Tokyo (35.7°N, 139.7°E) dan satelit di 110°E, maka station earth di utara DAN timur satelit = kuadran SW. Kuadran SW mencakup rentang 180°-270° (barat daya). Ini adalah kuadran yang paling umum untuk Asia Timur yang menggunakan satelit di posisi barat.`
                },
                
                // Quadrant SW - Result
                [`quad_result_value2${prefix}`]: {
                    title: `${section} - Hasil Kuadran SW`,
                    formula: 'Sat in Quad SW × (180 + |Azimuth|)',
                    inputs: `Sat in Quad = ${latitude >= 0 && longitude >= 0 ? 1 : 0}, |Azimuth| = ${Math.abs(calculateAzimuth(latitude, longitude)).toFixed(3)}°`,
                    result: `${((latitude >= 0 && longitude >= 0) ? (180 + Math.abs(calculateAzimuth(latitude, longitude))) : 0).toFixed(3)}°`,
                    explanation: `Untuk kuadran SW, azimuth akhir = (180 + |Azimuth|). Rumus ini memetakan azimuth calculation ke rentang kuadran SW (180°-270°). Base 180° merepresentasikan arah selatan, kemudian ditambah dengan nilai absolut azimuth untuk mendapatkan arah yang tepat di kuadran barat daya. Contoh: jika |Azimuth| = 45°, maka azimuth akhir = 180° + 45° = 225° (barat daya). Kuadran SW umum untuk wilayah Asia yang menggunakan satelit geostationary di sebelah barat.`
                },
                
                // Quadrant NW - Sat in Quad
                [`sat_in_quad_value3${prefix}`]: {
                    title: `${section} - Satelit di Kuadran NW (Barat Laut)?`,
                    formula: 'AND(NOT(In N. Hem), East of Sat)',
                    inputs: `NOT(In N. Hem) = ${latitude >= 0 ? 0 : 1}, East of Sat = ${longitude >= 0 ? 1 : 0}`,
                    result: `${(latitude < 0 && longitude >= 0) ? 1 : 0} (${(latitude < 0 && longitude >= 0) ? 'Ya' : 'Tidak'})`,
                    explanation: `Kuadran NW (North-West) terjadi ketika station earth berada di selatan ekuator (latitude < 0) DAN di timur satelit (longitude ≥ 0). Logika: AND(NOT(In N. Hem), East of Sat). Contoh: station earth di Sydney (-33.9°S, 151.2°E) dan satelit di 140°E, maka station earth di selatan DAN timur satelit = kuadran NW. Kuadran NW mencakup rentang 270°-360° (barat laut). Ini adalah kondisi yang jarang terjadi dalam komunikasi satelit karena keterbatasan coverage area.`
                },
                
                // Quadrant NW - Result
                [`quad_result_value3${prefix}`]: {
                    title: `${section} - Hasil Kuadran NW`,
                    formula: 'Sat in Quad NW × (360 - |Azimuth|)',
                    inputs: `Sat in Quad = ${(latitude < 0 && longitude >= 0) ? 1 : 0}, |Azimuth| = ${Math.abs(calculateAzimuth(latitude, longitude)).toFixed(3)}°`,
                    result: `${((latitude < 0 && longitude >= 0) ? (360 - Math.abs(calculateAzimuth(latitude, longitude))) : 0).toFixed(3)}°`,
                    explanation: `Untuk kuadran NW, azimuth akhir = (360 - |Azimuth|). Rumus ini memetakan azimuth calculation ke rentang kuadran NW (270°-360°). Base 360° merepresentasikan kembali ke arah utara, dikurangi nilai absolut azimuth untuk mendapatkan arah yang tepat di kuadran barat laut. Contoh: jika |Azimuth| = 30°, maka azimuth akhir = 360° - 30° = 330° (barat laut). Kuadran NW menghasilkan azimuth mendekati 360°/0° (utara).`
                },
                
                // Azimuth Result
                [`azimuthresult${prefix}`]: {
                    title: `${section} - Hasil Akhir Azimuth`,
                    formula: 'Quad NE + Quad SE + Quad SW + Quad NW',
                    inputs: `NE = ${((latitude < 0 && longitude < 0) ? Math.abs(calculateAzimuth(latitude, longitude)) : 0).toFixed(3)}°, SE = ${((latitude >= 0 && longitude < 0) ? (180 - Math.abs(calculateAzimuth(latitude, longitude))) : 0).toFixed(3)}°, SW = ${((latitude >= 0 && longitude >= 0) ? (180 + Math.abs(calculateAzimuth(latitude, longitude))) : 0).toFixed(3)}°, NW = ${((latitude < 0 && longitude >= 0) ? (360 - Math.abs(calculateAzimuth(latitude, longitude))) : 0).toFixed(3)}°`,
                    result: `${(
                        ((latitude < 0 && longitude < 0) ? Math.abs(calculateAzimuth(latitude, longitude)) : 0) +
                        ((latitude >= 0 && longitude < 0) ? (180 - Math.abs(calculateAzimuth(latitude, longitude))) : 0) +
                        ((latitude >= 0 && longitude >= 0) ? (180 + Math.abs(calculateAzimuth(latitude, longitude))) : 0) +
                        ((latitude < 0 && longitude >= 0) ? (360 - Math.abs(calculateAzimuth(latitude, longitude))) : 0)
                    ).toFixed(3)}°`,
                    explanation: `Azimuth akhir adalah penjumlahan kontribusi dari semua kuadran. Karena satelit hanya bisa berada di satu kuadran pada satu waktu, hanya satu kuadran yang akan aktif (memberikan kontribusi non-zero), sedangkan tiga kuadran lainnya berkontribusi 0. Sistem ini menggunakan prinsip superposisi dimana setiap kuadran memiliki rumus perhitungan azimuth yang spesifik untuk rentang sudutnya. Hasil akhir adalah azimuth dalam derajat (0°-360°) yang menunjukkan arah pointing antena dish dari station earth menuju satelit, diukur searah jarum jam dari arah utara geografis.`
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

        // Fungsi untuk membuat modal popup
        function createModal(title, content) {
            // Hapus modal yang sudah ada
            const existingModal = document.getElementById('detailModal');
            if (existingModal) {
                existingModal.remove();
            }
            
            // Buat modal baru dengan struktur sesuai contoh
            const modal = document.createElement('div');
            modal.id = 'detailModal';
            modal.className = 'popup-window';
            modal.style.display = 'flex';
            
            const modalContent = document.createElement('div');
            modalContent.className = 'popup-content';
            
            // Tombol close
            const closeBtn = document.createElement('span');
            closeBtn.className = 'close-popup-btn';
            closeBtn.innerHTML = '×';
            closeBtn.onclick = () => modal.remove();
            
            // Judul
            const titleElement = document.createElement('h3');
            titleElement.textContent = title;
            
            // Konten
            const contentDiv = document.createElement('div');
            contentDiv.innerHTML = content;
            
            modalContent.appendChild(closeBtn);
            modalContent.appendChild(titleElement);
            modalContent.appendChild(contentDiv);
            modal.appendChild(modalContent);
            document.body.appendChild(modal);
            
            // Tutup modal saat klik di luar
            modal.onclick = (e) => {
                if (e.target === modal) {
                    modal.remove();
                }
            };
        }

        // JavaScript untuk perhitungan UPLINK
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan elemen input untuk uplink
            const latitudeUpInput = document.getElementById('latitude_up');
            const longitudeUpInput = document.getElementById('longitude_up');
            
            // Mendapatkan semua field output terkait untuk uplink
            const innhemUp = document.getElementById('innhem_up');
            const innhem2Up = document.getElementById('innhem2_up');
            const eastofSatUp = document.getElementById('eastofsat_up');
            const eastofSat2Up = document.getElementById('eastofsat2_up');
            const satInQuadUp = document.getElementById('sat_in_quad_up');
            const quadResultUp = document.getElementById('quad_result_up');
            const satInQuadValueUp = document.getElementById('sat_in_quad_value_up');
            const quadResultValueUp = document.getElementById('quad_result_value_up');
            const satInQuadValue2Up = document.getElementById('sat_in_quad_value2_up');
            const quadResultValue2Up = document.getElementById('quad_result_value2_up');
            const satInQuadValue3Up = document.getElementById('sat_in_quad_value3_up');
            const quadResultValue3Up = document.getElementById('quad_result_value3_up');
            const azimuthCalcUp = document.getElementById('azimuthcalc_up');
            const azimuthResultUp = document.getElementById('azimuthresult_up');
            
            // Menambahkan event listener ke field input
            latitudeUpInput.addEventListener('input', calculateUplink);
            longitudeUpInput.addEventListener('input', calculateUplink);

            
            // Fungsi untuk menghitung semua parameter uplink
            function calculateUplink() {
                const latitude = parseFloat(latitudeUpInput.value) || 0;
                const longitude = parseFloat(longitudeUpInput.value) || 0;
                
                // Menghitung innhem_up - mengecek apakah di Belahan Utara
                const innhemUpValue = latitude >= 0 ? 1 : 0;
                innhemUp.value = innhemUpValue;
                
                // Menghitung innhem2_up - NOT dari innhem_up
                const innhem2UpValue = !innhemUpValue ? 1 : 0;
                innhem2Up.value = innhem2UpValue;
                
                // Menghitung eastofsat_up - mengecek apakah timur dari satelit
                const eastofSatUpValue = longitude >= 0 ? 1 : 0;
                eastofSatUp.value = eastofSatUpValue;
                
                // Menghitung eastofsat2_up - NOT dari eastofsat_up
                const eastofSat2UpValue = !eastofSatUpValue ? 1 : 0;
                eastofSat2Up.value = eastofSat2UpValue;
                
                // Menghitung azimuthcalc_up
                const azimuthCalcValue = calculateAzimuth(latitude, longitude);
                azimuthCalcUp.value = azimuthCalcValue.toFixed(3);
                
                // Menghitung nilai kuadran
                // Kuadran NE (Timur Laut)
                const satInQuadNE = AND(!innhemUpValue, !eastofSatUpValue) ? 1 : 0;
                satInQuadUp.value = satInQuadNE;
                const quadResultNE = satInQuadNE * Math.abs(azimuthCalcValue);
                quadResultUp.value = quadResultNE.toFixed(3) + " °";
                
                // Kuadran SE (Tenggara)
                const satInQuadSE = AND(innhemUpValue, !eastofSatUpValue) ? 1 : 0;
                satInQuadValueUp.value = satInQuadSE;
                const quadResultSE = satInQuadSE * (180 - Math.abs(azimuthCalcValue));
                quadResultValueUp.value = quadResultSE.toFixed(3) + " °";
                
                // Kuadran SW (Barat Daya)
                const satInQuadSW = AND(innhemUpValue, eastofSatUpValue) ? 1 : 0;
                satInQuadValue2Up.value = satInQuadSW;
                const quadResultSW = satInQuadSW * (180 + Math.abs(azimuthCalcValue));
                quadResultValue2Up.value = quadResultSW.toFixed(3) + " °";
                
                // Kuadran NW (Barat Laut)
                const satInQuadNW = AND(!innhemUpValue, eastofSatUpValue) ? 1 : 0;
                satInQuadValue3Up.value = satInQuadNW;
                const quadResultNW = satInQuadNW * (360 - Math.abs(azimuthCalcValue));
                quadResultValue3Up.value = quadResultNW.toFixed(3) + " °";
                
                // Menghitung hasil akhir azimuth - jumlah semua hasil kuadran
                const azimuthResult = quadResultNE + quadResultSE + quadResultSW + quadResultNW;
                azimuthResultUp.value = azimuthResult.toFixed(3) + " °";
            }
            
            // Perhitungan awal
            
        });

        // JavaScript untuk perhitungan DOWNLINK
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan elemen input untuk downlink
            const latitudeDownInput = document.getElementById('latitude_down');
            const longitudeDownInput = document.getElementById('longitude_down');
            
            // Menambahkan event listener ke field input downlink
            latitudeDownInput.addEventListener('input', calculateDownlink);
            longitudeDownInput.addEventListener('input', calculateDownlink);
            
            // Fungsi untuk menghitung semua parameter downlink
            function calculateDownlink() {
                const latitude = parseFloat(latitudeDownInput.value) || 0;
                const longitude = parseFloat(longitudeDownInput.value) || 0;
                
                // Menghitung innhem_down - mengecek apakah di Belahan Utara
                const innhemDownValue = latitude >= 0 ? 1 : 0;
                document.getElementById('innhem_down').value = innhemDownValue;
                
                // Menghitung innhem2_down - NOT dari innhem_down
                const innhem2DownValue = !innhemDownValue ? 1 : 0;
                document.getElementById('innhem2_down').value = innhem2DownValue;
                
                // Menghitung eastofsat_down - mengecek apakah timur dari satelit
                const eastofSatDownValue = longitude >= 0 ? 1 : 0;
                document.getElementById('eastofsat_down').value = eastofSatDownValue;
                
                // Menghitung eastofsat2_down - NOT dari eastofsat_down
                const eastofSat2DownValue = !eastofSatDownValue ? 1 : 0;
                document.getElementById('eastofsat2_down').value = eastofSat2DownValue;
                
                // Menghitung azimuthcalc_down
                const azimuthCalcValue = calculateAzimuth(latitude, longitude);
                document.getElementById('azimuthcalc_down').value = azimuthCalcValue.toFixed(3);
                
                // Menghitung nilai kuadran untuk downlink
                // Kuadran NE (Timur Laut)
                const satInQuadNE = AND(!innhemDownValue, !eastofSatDownValue) ? 1 : 0;
                document.getElementById('sat_in_quad_down').value = satInQuadNE;
                const quadResultNE = satInQuadNE * Math.abs(azimuthCalcValue);
                document.getElementById('quad_result_down').value = quadResultNE.toFixed(3) + " °";
                
                // Kuadran SE (Tenggara)
                const satInQuadSE = AND(innhemDownValue, !eastofSatDownValue) ? 1 : 0;
                document.getElementById('sat_in_quad_value_down').value = satInQuadSE;
                const quadResultSE = satInQuadSE * (180 - Math.abs(azimuthCalcValue));
                document.getElementById('quad_result_value_down').value = quadResultSE.toFixed(3) + " °";
                
                // Kuadran SW (Barat Daya)
                const satInQuadSW = AND(innhemDownValue, eastofSatDownValue) ? 1 : 0;
                document.getElementById('sat_in_quad_value2_down').value = satInQuadSW;
                const quadResultSW = satInQuadSW * (180 + Math.abs(azimuthCalcValue));
                document.getElementById('quad_result_value2_down').value = quadResultSW.toFixed(3) + " °";
                
                // Kuadran NW (Barat Laut)
                const satInQuadNW = AND(!innhemDownValue, eastofSatDownValue) ? 1 : 0;
                document.getElementById('sat_in_quad_value3_down').value = satInQuadNW;
                const quadResultNW = satInQuadNW * (360 - Math.abs(azimuthCalcValue));
                document.getElementById('quad_result_value3_down').value = quadResultNW.toFixed(3) + " °";
                
                // Menghitung hasil akhir azimuth - jumlah semua hasil kuadran
                const azimuthResult = quadResultNE + quadResultSE + quadResultSW + quadResultNW;
                document.getElementById('azimuthresult_down').value = azimuthResult.toFixed(3) + " °";
            }
            
            // Perhitungan awal untuk downlink
         
        });
       

        // Fungsi Helper
        
        // Fungsi AND 
        function AND(a, b) {
            return a && b;
        }
        
        // Menghitung Azimuth menggunakan rumus
        function calculateAzimuth(latitude, longitude) {
            // Konversi ke radian untuk fungsi matematika
            const latRad = latitude * Math.PI / 180;
            const longRad = longitude * Math.PI / 180;
            
            // Menghitung menggunakan rumus:
            // ATAN(SIN(longitude_rad)/((-SIN(latitude_rad)*COS(longitude_rad)))) * 180/PI
            const numerator = Math.sin(longRad);
            const denominator = -Math.sin(latRad) * Math.cos(longRad);
            
            // Menangani pembagian dengan nol
            if (Math.abs(denominator) < 1e-10) {
                return longitude > 0 ? 90 : -90;
            }
            
            let result = Math.atan(numerator / denominator) * 180 / Math.PI;
            
            // Menyesuaikan hasil berdasarkan kuadran
            if (denominator > 0) {
                result += 180;
            } else if (numerator < 0 && denominator < 0) {
                result += 360;
            }
            
            // Memastikan hasil berada dalam rentang 0-360
            if (result < 0) result += 360;
            if (result >= 360) result -= 360;
            
            return result;
        }
    </script>
    
    <!-- CSS untuk Pop-up -->
    <style>
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
            padding: 20px 30px 30px 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .close-popup-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
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
            font-size: 14px;
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
        }

        .popup-content strong {
            color: #2c3e50;
        }
    </style>
</x-layout>