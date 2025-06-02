<x-layout>
    <x-slot:title>Form Transmitter</x-slot>

    <div class="container mx-auto px-4 py-8">
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="fas fa-satellite-dish mr-2 text-blue-600"></i> Perhitungan Parameter Transmitter
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Masukkan parameter Transmitter untuk uplink dan downlink.
            </p>
    <h2 class="text-2xl font-bold mb-6 text-center">Uplink</h2>

    <form method="POST" action="{{ route('transmitter.store', $dataId)}}">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex justify-between space-x-4 items-start mb-4">
            <!-- Input Watt -->
            <div class="w-1/3 pt-0">
                <label for="watt_up" class="block font-medium text-gray-700 mb-1">Transmitter Power (Watt):</label>
                <input type="number" id="watt_up" name="watt_up"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                    placeholder="Masukkan nilai Watt" oninput="calculatePowerUp()">
                <div class="h-8 mt-2"></div>
            </div>

                <!-- Output dBW for Uplink -->
                <div class="w-1/3">
                    <label for="dbw_up" class="block font-medium text-gray-700 mb-1">Transmitter Power (dBW):</label>
                    <input type="text" id="dbw_up" name="dbw_up" 
                        class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" 
                        placeholder="Hasil dBW" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="dbw_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <!-- Output dBm for Uplink -->
                <div class="w-1/3">
                    <label for="dbm_up" class="block font-medium text-gray-700 mb-1">Transmitter Power (dBm):</label>
                    <input type="text" id="dbm_up" name="dbm_up"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil dBm" readonly  style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="dbm_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
            </div>

            <div id="cable" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cable or Waveguide ("Line") Losses:</label>
            </div>

            <!-- Input untuk Line A, B, dan C dalam tampilan horizontal -->
            <div class="flex justify-start space-x-6 items-center mb-4">
                <div class="w-1/3">
                    <label for="alength_up" class="block font-medium text-gray-700 mb-1">Line A Length:</label>
                    <input type="number" id="alength_up" name="alength_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Line A Length" oninput="calculateTotalLengthUp(); calculateTotalLossUp()">
                </div>

                <div class="w-1/3">
                    <label for="blength_up" class="block font-medium text-gray-700 mb-1">Line B Length:</label>
                    <input type="number" id="blength_up" name="blength_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Line B Length" oninput="calculateTotalLengthUp(); calculateTotalLossUp()">
                </div>

                <div class="w-1/3">
                    <label for="clength_up" class="block font-medium text-gray-700 mb-1">Line C Length:</label>
                    <input type="number" id="clength_up" name="clength_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Line C Length" oninput="calculateTotalLengthUp(); calculateTotalLossUp()">
                </div>
            </div>

            <div class="w-1/3">
                <label for="totlength_up" class="block font-medium text-gray-700 mb-1">Total Line Length (Line A+B+C):</label>
                <input type="text" id="totlength_up" name="totlength_up"
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                    placeholder="Hasil Total Length" readonly  style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totlength_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div id="cabletype_up" class="mt-4 mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide Type:</label>
                <input type="text" name="cabletype_up" id="cabletype_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
            </div>

            <!-- Input untuk Cable/Waveguide Loss per meter -->
            <div class="flex justify-start space-x-6 items-center mb-4">
                <div class="w-1/3 ">
                    <label for="guideloss_up" class="block font-medium text-gray-700 mb-1">Cable/Waveguide Loss (dB/m):</label>
                    <input type="number" id="guideloss_up" name="guideloss_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Loss/meter" oninput="calculateTotalLossUp()">
                        <div class="h-6 mt-2"></div>
                </div>

                <!-- Output Total Cable Loss -->
                <div class="w-1/3 ">
                    <label for="totalloss_up" class="block font-medium text-gray-700 mb-1">Total Cable Loss (dB):</label>
                    <input type="text" id="totalloss_up" name="totalloss_up"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil Total Loss" readonly  style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totalloss_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
            </div>


            <div id="otherscline_up" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Other Components in Line:</label>
            </div>

            <div class="flex justify-start space-x-6 items-center mb-4">
                <div class="w-1/3">
                    <label for="connect_up" class="block font-medium text-gray-700 mb-1">Number of In-Line Connectors:</label>
                    <input type="number" step="0.01" id="connect_up" name="connect_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai" oninput="calculateTotalConnectorUp()">
                        <div class="h-6 mt-2"></div>
                </div>

                <div class="w-1/3">
                    <label for="totconnect_up" class="block font-medium text-gray-700 mb-1">Total Penurunan Daya</label>
                    <input type="text" id="totconnect_up" name="totconnect_up"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil Total Connector" readonly  style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totconnect_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Filter Insertion Losses:</label>
                <input type="number" name="filter_up" id="filter_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
            </div>

            <div id="otherinline_up" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Other In Line Losses:</label>
            </div>

            <div id="device_up" class="mb-4">
                <div class="flex justify-start space-x-6 items-center"> {{-- Layout horizontal menggunakan flex --}}
                    <div class="w-1/3">
                        <label for="device_up" class="block font-medium mb-1 text-gray-700">Device:</label>
                        <input type="text" name="device_up" id="device_up"
                            class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50"
                            placeholder="Masukkan device" min="0">
                    </div>
                </div>
                <div class="mb-4">
                <input type="number" name="devicee_up" id="devicee_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Antenna Mismatch Losses:</label>
                <input type="number" name="atn_up" id="atn_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" oninput="calculateTotalLineLossesUp()">
            </div>
        
            <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total Line Losses (dB):</label>
                    <input type="number" name="totlinelosses_up" id="totlinelosses_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" readonly  style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totlinelosses_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                 </div>

                 <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total Power Deliver to Antenna (dBW):</label>
                    <input type="number" name="totpowerdeliv_up" id="totpowerdeliv_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" readonly  style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totpowerdeliv_up_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                 </div>

        </div>
        <h2 class="text-2xl font-bold mb-6 text-center">Downlink</h2>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-start space-x-6 items-center">
                <!-- Input Watt for Downlink -->
                <div class="w-1/3 pt-0">
                    <label for="watt_down" class="block font-medium text-gray-700 mb-1">Transmitter Power (Watt):</label>
                    <input type="number" id="watt_down" name="watt_down"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan nilai Watt" oninput="calculatePowerDown()">
                        <div class="h-6 mt-2"></div>
                </div>

                <!-- Output dBW for Downlink -->
                <div class="w-1/3">
                    <label for="dbw_down" class="block font-medium text-gray-700 mb-1">Transmitter Power (dBW):</label>
                    <input type="text" id="dbw_down" name="dbw_down"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil dBW" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="dbw_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <!-- Output dBm for Downlink -->
                <div class="w-1/3">
                    <label for="dbm_down" class="block font-medium text-gray-700 mb-1">Transmitter Power (dBm):</label>
                    <input type="text" id="dbm_down" name="dbm_down"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil dBm" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="dbm_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
            </div>
            <div id="cable" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cable or Waveguide ("Line") Losses:</label>
            </div>

            <!-- Input untuk Line A, B, dan C dalam tampilan horizontal -->
            <div class="flex justify-start space-x-6 items-center mb-4">
                <div class="w-1/3">
                    <label for="alength_down" class="block font-medium text-gray-700 mb-1">Line A Length:</label>
                    <input type="number" id="alength_down" name="alength_down"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Line A Length" oninput="calculateTotalLengthDown(); calculateTotalLossDown()">
                </div>

                <div class="w-1/3">
                    <label for="blength_down" class="block font-medium text-gray-700 mb-1">Line B Length:</label>
                    <input type="number" id="blength_down" name="blength_down"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Line B Length" oninput="calculateTotalLengthDown(); calculateTotalLossDown()">
                </div>

                <div class="w-1/3">
                    <label for="clength_down" class="block font-medium text-gray-700 mb-1">Line C Length:</label>
                    <input type="number" id="clength_down" name="clength_down"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Line C Length" oninput="calculateTotalLengthDown(); calculateTotalLossDown()">
                </div>
            </div>

            <div class="w-1/3">
                <label for="totlength_down" class="block font-medium text-gray-700 mb-1">Total Line Length (Line A+B+C):</label>
                <input type="text" id="totlength_down" name="totlength_down"
                    class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                    placeholder="Hasil Total Length" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totlength_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div id="cabletype_down" class="mt-4 mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide Type:</label>
                <input type="text" name="cabletype_down" id="cabletype_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
            </div>

            <!-- Input untuk Cable/Waveguide Loss per meter -->
            <div class="flex justify-start space-x-6 items-center mb-4">
                <div class="w-1/3">
                    <label for="guideloss_down" class="block font-medium text-gray-700 mb-1">Cable/Waveguide Loss (dB/m):</label>
                    <input type="number" id="guideloss_down" name="guideloss_down"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Loss/meter" oninput="calculateTotalLossDown()">
                        <div class="h-6 mt-2"></div>
                </div>

                <!-- Output Total Cable Loss -->
                <div class="w-1/3">
                    <label for="totalloss_down" class="block font-medium text-gray-700 mb-1">Total Cable Loss (dB):</label>
                    <input type="text" id="totalloss_down" name="totalloss_down"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil Total Loss" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totalloss_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
            </div>


            <div id="otherscline_down" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Other Components in Line:</label>
            </div>

            <div class="flex justify-start space-x-6 items-center mb-4">
                <div class="w-1/3">
                    <label for="connect_down" class="block font-medium text-gray-700 mb-1">Number of In-Line Connectors:</label>
                    <input type="number" step="0.01" id="connect_down" name="connect_down"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai" oninput="calculateTotalConnectorDown()">
                        <div class="h-6 mt-2"></div>
                </div>

                <div class="w-1/3">
                    <label for="totconnect_down" class="block font-medium text-gray-700 mb-1">Total Penurunan Daya:</label>
                    <input type="text" id="totconnect_down" name="totconnect_down"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil Total Connector" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totconnect_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Filter Insertion Losses:</label>
                <input type="number" name="filter_down" id="filter_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
            </div>

            <div id="otherinline_down" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Other In Line Losses:</label>
            </div>

            <div id="device_down" class="mb-4">
                <div class="flex justify-start space-x-6 items-center"> {{-- Layout horizontal menggunakan flex --}}
                    <div class="w-1/3">
                        <label for="device_down" class="block font-medium mb-1 text-gray-700">Device:</label>
                        <input type="text" name="device_down" id="device_down"
                            class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50"
                            placeholder="Masukkan device" min="0">
                    </div>
                </div>
                <div class="mb-4">
                <input type="number" name="devicee_down" id="devicee_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Antenna Mismatch Losses:</label>
                <input type="number" name="atn_down" id="atn_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0"oninput="calculateTotalLineLossesDown()">
            </div>
        
            <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total Line Losses (dB):</label>
                    <input type="number" name="totlinelosses_down" id="totlinelosses_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totlinelosses_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                 </div>

                 <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total RF Power Deliver to Antenna (dBW):</label>
                    <input type="number" name="totrfrpowerdeliv_down" id="totrfpowerdeliv_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totrfpowerdeliv_down_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                 </div>
                 <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 w-full"onclick="window.location.href='{{ url('/receiver') }}'">Simpan</button>
                 
                 <div class="flex justify-center mt-4">

                    <!-- Tombol Next di kiri -->
                    <a href="/frek/{{$dataId}}" class="text-center bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">
                        Halaman Sebelum
                    </a>

                    <!-- Tombol Previous di kanan -->
                    <!-- <a href="/halaman-sebelumnya" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Next
                    </a> -->
                </div>
        </div>
    </div>

    <!-- Pop-up untuk Uplink -->
<!-- dBW Pop-up -->
<div id="dbw_up_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail dBW</h3>
        <p class="formula"><span id="dbw_up_formula"></span></p>
        <div id="dbw_up_popup_content"></div>
    </div>
</div>

<!-- dBm Pop-up -->
<div id="dbm_up_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail dBm</h3>
        <p class="formula"><span id="dbm_up_formula"></span></p>
        <div id="dbm_up_popup_content"></div>
    </div>
</div>

<!-- Total Line Length Pop-up -->
<div id="totlength_up_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Line Length</h3>
        <p class="formula"><span id="totlength_up_formula"></span></p>
        <div id="totlength_up_popup_content"></div>
    </div>
</div>

<!-- Total Cable Loss Pop-up -->
<div id="totalloss_up_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Cable Loss (dB)</h3>
        <p class="formula"><span id="totalloss_up_formula"></span></p>
        <div id="totalloss_up_popup_content"></div>
    </div>
</div>

<!-- Total Penurunan Daya Pop-up -->
<div id="totconnect_up_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Penurunan Daya</h3>
        <p class="formula"><span id="totconnect_up_formula"></span></p>
        <div id="totconnect_up_popup_content"></div>
    </div>
</div>

<!-- Total Line Losses Pop-up -->
<div id="totlinelosses_up_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Line Losses (dB)</h3>
        <p class="formula"><span id="totlinelosses_up_formula"></span></p>
        <div id="totlinelosses_up_popup_content"></div>
    </div>
</div>

<!-- Total Power Deliver to Antenna Pop-up -->
<div id="totpowerdeliv_up_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Power Deliver to Antenna (dBW)</h3>
        <p class="formula"><span id="totpowerdeliv_up_formula"></span></p>
        <div id="totpowerdeliv_up_popup_content"></div>
    </div>
</div>


<!-- Pop-up untuk Downlink -->
<!-- dBW Pop-up -->
<div id="dbw_down_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail dBW</h3>
        <p class="formula"><span id="dbw_down_formula"></span></p>
        <div id="dbw_down_popup_content"></div>
    </div>
</div>

<!-- dBm Pop-up -->
<div id="dbm_down_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail dBm</h3>
        <p class="formula"><span id="dbm_down_formula"></span></p>
        <div id="dbm_down_popup_content"></div>
    </div>
</div>

<!-- Total Line Length Pop-up -->
<div id="totlength_down_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Line Length</h3>
        <p class="formula"><span id="totlength_down_formula"></span></p>
        <div id="totlength_down_popup_content"></div>
    </div>
</div>

<!-- Total Cable Loss Pop-up -->
<div id="totalloss_down_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Cable Loss (dB)</h3>
        <p class="formula"><span id="totalloss_down_formula"></span></p>
        <div id="totalloss_down_popup_content"></div>
    </div>
</div>

<!-- Total Penurunan Daya Pop-up -->
<div id="totconnect_down_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Penurunan Daya</h3>
        <p class="formula"><span id="totconnect_down_formula"></span></p>
        <div id="totconnect_down_popup_content"></div>
    </div>
</div>

<!-- Total Line Losses Pop-up -->
<div id="totlinelosses_down_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Line Losses (dB)</h3>
        <p class="formula"><span id="totlinelosses_down_formula"></span></p>
        <div id="totlinelosses_down_popup_content"></div>
    </div>
</div>

<!-- Total RF Power Deliver to Antenna Pop-up -->
<div id="totrfpowerdeliv_down_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total RF Power Deliver to Antenna (dBW)</h3>
        <p class="formula"><span id="totrfpowerdeliv_down_formula"></span></p>
        <div id="totrfpowerdeliv_down_popup_content"></div>
    </div>
</div>

<!-- Tambahkan CSS untuk Pop-up -->
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
    </style>

    {{-- JavaScript Perhitungan --}}

        <script>
       // Fungsi untuk menghitung dBW dan dBm untuk Uplink
function calculatePowerUp() {
    const watt = parseFloat(document.getElementById('watt_up').value);
    if (!isNaN(watt) && watt > 0) {
        const dbw = 10 * Math.log10(watt);  // Menghitung dBW
        const dbm = dbw + 30;  // Menghitung dBm

        document.getElementById('dbw_up').value = dbw.toFixed(5);  // Menampilkan dBW untuk Uplink
        document.getElementById('dbm_up').value = dbm.toFixed(5);  // Menampilkan dBm untuk Uplink
    } else {
        document.getElementById('dbw_up').value = '';  // Kosongkan jika input invalid
        document.getElementById('dbm_up').value = '';  // Kosongkan jika input invalid
    }
}

// Fungsi untuk menghitung dBW dan dBm untuk Downlink
function calculatePowerDown() {
    const watt = parseFloat(document.getElementById('watt_down').value);
    if (!isNaN(watt) && watt > 0) {
        const dbw = 10 * Math.log10(watt);  // Menghitung dBW
        const dbm = dbw + 30;  // Menghitung dBm

        document.getElementById('dbw_down').value = dbw.toFixed(2);  // Menampilkan dBW untuk Downlink
        document.getElementById('dbm_down').value = dbm.toFixed(2);  // Menampilkan dBm untuk Downlink
    } else {
        document.getElementById('dbw_down').value = '';  // Kosongkan jika input invalid
        document.getElementById('dbm_down').value = '';  // Kosongkan jika input invalid
    }
}

// Fungsi untuk menghitung Total Length Uplink
function calculateTotalLengthUp() {
    const alength_up = parseFloat(document.getElementById('alength_up').value) || 0;
    const blength_up = parseFloat(document.getElementById('blength_up').value) || 0;
    const clength_up = parseFloat(document.getElementById('clength_up').value) || 0;

    const totlength_up = alength_up + blength_up + clength_up;
    document.getElementById('totlength_up').value = totlength_up.toFixed(5);  // Menampilkan total panjang
}

// Fungsi untuk menghitung Total Length Downlink
function calculateTotalLengthDown() {
    const alength_down = parseFloat(document.getElementById('alength_down').value) || 0;
    const blength_down = parseFloat(document.getElementById('blength_down').value) || 0;
    const clength_down = parseFloat(document.getElementById('clength_down').value) || 0;

    const totlength_down = alength_down + blength_down + clength_down;
    document.getElementById('totlength_down').value = totlength_down.toFixed(2);  // Menampilkan total panjang
}

// Fungsi untuk menghitung Total Cable Loss Uplink
function calculateTotalLossUp() {
    const guideloss_up = parseFloat(document.getElementById('guideloss_up').value) || 0;
    const totlength_up = parseFloat(document.getElementById('totlength_up').value) || 0;

    const totalloss_up = guideloss_up * totlength_up;
    document.getElementById('totalloss_up').value = totalloss_up.toFixed(5);  // Menampilkan Total Cable Loss untuk Uplink

    // Menghitung Total Line Losses Uplink
    // calculateTotalLineLossesUp(totalloss_up);
}

// Fungsi untuk menghitung Total Cable Loss Downlink
function calculateTotalLossDown() {
    const guideloss_down = parseFloat(document.getElementById('guideloss_down').value) || 0;
    const totlength_down = parseFloat(document.getElementById('totlength_down').value) || 0;

    const totalloss_down = guideloss_down * totlength_down;
    document.getElementById('totalloss_down').value = totalloss_down.toFixed(2);  // Menampilkan Total Cable Loss untuk Downlink

    // Menghitung Total Line Losses Downlink
   // calculateTotalLineLossesDown(totalloss_down);
}

// Fungsi untuk menghitung Total Line Losses Uplink
function calculateTotalLineLossesUp() {
    const totalConnectorLoss_up = parseFloat(document.getElementById('totconnect_up').value || 0);
    const filterLoss_up = parseFloat(document.getElementById('filter_up').value || 0);
    const otherInlineLoss_up = parseFloat(document.getElementById('devicee_up').value || 0);
    const antennaMismatchLoss_up = parseFloat(document.getElementById('atn_up').value || 0);
    const totalloss_up = parseFloat(document.getElementById('totalloss_up').value ||0);

    const totalLineLosses_up = totalloss_up + totalConnectorLoss_up + filterLoss_up + otherInlineLoss_up + antennaMismatchLoss_up;
    document.getElementById('totlinelosses_up').value = totalLineLosses_up.toFixed(2);  // Menampilkan Total Line Losses untuk Uplink

    // Fungsi untuk Menghitung Total Power Delivered to Antenna Uplink
    const transmitterPower_up = parseFloat(document.getElementById('watt_up').value) || 0;
    if (transmitterPower_up > 0) {
        const dbw_up = 10 * Math.log10(transmitterPower_up);
        const totalPowerDelivered_up = dbw_up - totalLineLosses_up;
        document.getElementById('totpowerdeliv_up').value = totalPowerDelivered_up.toFixed(2);  // Menampilkan total power delivered Uplink
    }
}

// Fungsi untuk menghitung Total Line Losses Downlink
function calculateTotalLineLossesDown() {
    const totalConnectorLoss_down = parseFloat(document.getElementById('totconnect_down').value || 0);
    const filterLoss_down = parseFloat(document.getElementById('filter_down').value || 0);
    const otherInlineLoss_down = parseFloat(document.getElementById('devicee_down').value || 0);
    const antennaMismatchLoss_down = parseFloat(document.getElementById('atn_down').value || 0);
    const totalloss_down = parseFloat(document.getElementById('totalloss_down').value ||0);

    const totalLineLosses_down = totalloss_down + totalConnectorLoss_down + filterLoss_down + otherInlineLoss_down + antennaMismatchLoss_down;
    document.getElementById('totlinelosses_down').value = totalLineLosses_down.toFixed(2);  // Menampilkan Total Line Losses untuk Downlink

    // Menghitung Total RF Power Delivered to Antenna Downlink
    const transmitterPower_down = parseFloat(document.getElementById('watt_down').value) || 0;
    if (transmitterPower_down > 0) {
        const dbw_down = 10 * Math.log10(transmitterPower_down);
        const totalPowerDelivered_down = dbw_down - totalLineLosses_down;
        document.getElementById('totrfpowerdeliv_down').value = totalPowerDelivered_down.toFixed(2);  // Menampilkan total power delivered Downlink
    }
}
// Fungsi untuk menghitung Total Penurunan Daya Uplink
function calculateTotalConnectorUp() {
    const connectors = parseFloat(document.getElementById('connect_up').value) || 0;
    const totalConnectorLoss_up = connectors * 0.05;  // Menghitung Total Penurunan Daya
    document.getElementById('totconnect_up').value = totalConnectorLoss_up.toFixed(5);  // Menampilkan Total Penurunan Daya untuk Uplink
}
// Fungsi untuk menghitung Total Penurunan Daya Downlink
function calculateTotalConnectorDown() {
    const connectors = parseFloat(document.getElementById('connect_down').value) || 0;
    const totalConnectorLoss_down = connectors * 0.05;  // Menghitung Total Penurunan Daya
    document.getElementById('totconnect_down').value = totalConnectorLoss_down.toFixed(2);  // Menampilkan Total Penurunan Daya untuk Downlink
}

// POP UP

//POP UP UPLINK

document.addEventListener("DOMContentLoaded", function() {
    // Array pasangan tombol dan pop-up untuk Uplink dan Downlink
    const popupPairs = [
        // Popup dBW Uplink
        { buttonId: 'dbw_up_popup_btn', popupId: 'dbw_up_popup', inputId: 'dbw_up', formulaId: 'dbw_up_formula', 
          formula: "dBW = 10 × log10(Watt)", 
          detailFunc: (val) => {
            const watt = parseFloat(document.getElementById("watt_up").value) || 0;
            return `<p>Transmitter Power (Watt) = ${watt} W</p><p>dBW = 10 × log10(${watt}) = ${val} dBW</p>`;
          }
        },
        // Popup dBm Uplink
        { buttonId: 'dbm_up_popup_btn', popupId: 'dbm_up_popup', inputId: 'dbm_up', formulaId: 'dbm_up_formula', 
          formula: "dBm = dBW + 30", 
          detailFunc: (val) => {
            const dbw = parseFloat(document.getElementById("dbw_up").value) || 0;
            return `<p>dBW = ${dbw} dBW</p><p>dBm = ${dbw} + 30 = ${val} dBm</p>`;
          }
        },
        // Popup Total Line Length Uplink
        { buttonId: 'totlength_up_popup_btn', popupId: 'totlength_up_popup', inputId: 'totlength_up', formulaId: 'totlength_up_formula', 
          formula: "Total Length = Panjang Kabel A + Panjang Kabel B + Panjang Kabel C", 
          detailFunc: (val) => {
            const alength_up = parseFloat(document.getElementById("alength_up").value) || 0;
            const blength_up = parseFloat(document.getElementById("blength_up").value) || 0;
            const clength_up = parseFloat(document.getElementById("clength_up").value) || 0;
            return `<p>Panjang Kabel A = ${alength_up} meter</p><p>Panjang Kabel B = ${blength_up} meter</p><p>Panjang Kabel C = ${clength_up} meter</p><p>Total Length = ${alength_up} + ${blength_up} + ${clength_up} = ${val} meter</p>`;
          }
        },
        // Popup Total Cable Loss Uplink
        { buttonId: 'totalloss_up_popup_btn', popupId: 'totalloss_up_popup', inputId: 'totalloss_up', formulaId: 'totalloss_up_formula', 
          formula: "Total Loss = Loss per meter × Total Line Length", 
          detailFunc: (val) => {
            const loss_per_meter = parseFloat(document.getElementById("guideloss_up").value) || 0;
            const total_length = parseFloat(document.getElementById("totlength_up").value) || 0;
            return `<p>Loss per meter = ${loss_per_meter} dB/meter</p><p>Total Line Length = ${total_length} meter</p><p>Total Loss = ${loss_per_meter} × ${total_length} = ${val} dB</p>`;
          }
        },
        // Popup Total Penurunan Daya Uplink
        { buttonId: 'totconnect_up_popup_btn', popupId: 'totconnect_up_popup', inputId: 'totconnect_up', formulaId: 'totconnect_up_formula', 
          formula: "L<sub>connector</sub> = Jumlah Konektor × 0.05 dB", 
          detailFunc: (val) => {
            const connectors = parseFloat(document.getElementById("connect_up").value) || 0;
            return `<p>Jumlah Konektor = ${connectors}</p><p>Loss per konektor = 0.05 dB</p><p>L<sub>connector</sub> = ${connectors} × 0.05 = ${val} dB</p>`;
          }
        },
        // Popup Total Line Losses Uplink
        { buttonId: 'totlinelosses_up_popup_btn', popupId: 'totlinelosses_up_popup', inputId: 'totlinelosses_up', formulaId: 'totlinelosses_up_formula', 
          formula: "Total Line Losses = Total Cable Loss + Total Penurunan Daya", 
          detailFunc: (val) => {
            const totalloss_up = parseFloat(document.getElementById("totalloss_up").value) || 0;
            const totconnect_up = parseFloat(document.getElementById("totconnect_up").value) || 0;
            return `<p>Total Cable Loss = ${totalloss_up} dB</p><p>Total Penurunan Daya = ${totconnect_up} dB</p><p>Total Line Losses = ${totalloss_up} + ${totconnect_up} = ${val} dB</p>`;
          }
        },
        // Popup Total Power Delivered to Antenna Uplink
        { buttonId: 'totpowerdeliv_up_popup_btn', popupId: 'totpowerdeliv_up_popup', inputId: 'totpowerdeliv_up', formulaId: 'totpowerdeliv_up_formula', 
          formula: "Total Power Delivered = dBW - Total Line Losses", 
          detailFunc: (val) => {
            const dbw = parseFloat(document.getElementById("dbw_up").value) || 0;
            const totlinelosses_up = parseFloat(document.getElementById("totlinelosses_up").value) || 0;
            return `<p>dBW = ${dbw} dBW</p><p>Total Line Losses = ${totlinelosses_up} dB</p><p>Total Power Delivered = ${dbw} - ${totlinelosses_up} = ${val} dBW</p>`;
          }
        },
        // === DOWNLINK === //
        // Popup dBW Downlink
        { buttonId: 'dbw_down_popup_btn', popupId: 'dbw_down_popup', inputId: 'dbw_down', formulaId: 'dbw_down_formula', 
          formula: "dBW = 10 × log10(Watt)", 
          detailFunc: (val) => {
            const watt = parseFloat(document.getElementById("watt_down").value) || 0;
            return `<p>Transmitter Power (Watt) = ${watt} W</p><p>dBW = 10 × log10(${watt}) = ${val} dBW</p>`;
          }
        },
        // Popup dBm Downlink
        { buttonId: 'dbm_down_popup_btn', popupId: 'dbm_down_popup', inputId: 'dbm_down', formulaId: 'dbm_down_formula', 
          formula: "dBm = dBW + 30", 
          detailFunc: (val) => {
            const dbw = parseFloat(document.getElementById("dbw_down").value) || 0;
            return `<p>dBW = ${dbw} dBW</p><p>dBm = ${dbw} + 30 = ${val} dBm</p>`;
          }
        },
        // Popup Total Line Length Downlink
        { buttonId: 'totlength_down_popup_btn', popupId: 'totlength_down_popup', inputId: 'totlength_down', formulaId: 'totlength_down_formula', 
          formula: "Total Length = Panjang Kabel A + Panjang Kabel B + Panjang Kabel C", 
          detailFunc: (val) => {
            const alength_down = parseFloat(document.getElementById("alength_down").value) || 0;
            const blength_down = parseFloat(document.getElementById("blength_down").value) || 0;
            const clength_down = parseFloat(document.getElementById("clength_down").value) || 0;
            return `<p>Panjang Kabel A = ${alength_down} meter</p><p>Panjang Kabel B = ${blength_down} meter</p><p>Panjang Kabel C = ${clength_down} meter</p><p>Total Length = ${alength_down} + ${blength_down} + ${clength_down} = ${val} meter</p>`;
          }
        },
        // Popup Total Cable Loss Downlink
        { buttonId: 'totalloss_down_popup_btn', popupId: 'totalloss_down_popup', inputId: 'totalloss_down', formulaId: 'totalloss_down_formula', 
          formula: "Total Loss = Loss per meter × Total Line Length", 
          detailFunc: (val) => {
            const loss_per_meter = parseFloat(document.getElementById("guideloss_down").value) || 0;
            const total_length = parseFloat(document.getElementById("totlength_down").value) || 0;
            return `<p>Loss per meter = ${loss_per_meter} dB/meter</p><p>Total Line Length = ${total_length} meter</p><p>Total Loss = ${loss_per_meter} × ${total_length} = ${val} dB</p>`;
          }
        },
        // Popup Total Penurunan Daya Downlink
        { buttonId: 'totconnect_down_popup_btn', popupId: 'totconnect_down_popup', inputId: 'totconnect_down', formulaId: 'totconnect_down_formula', 
          formula: "L<sub>connector</sub> = Jumlah Konektor × 0.05 dB", 
          detailFunc: (val) => {
            const connectors = parseFloat(document.getElementById("connect_down").value) || 0;
            return `<p>Jumlah Konektor = ${connectors}</p><p>Loss per konektor = 0.05 dB</p><p>L<sub>connector</sub> = ${connectors} × 0.05 = ${val} dB</p>`;
          }
        },
        // Popup Total Line Losses Downlink
        { buttonId: 'totlinelosses_down_popup_btn', popupId: 'totlinelosses_down_popup', inputId: 'totlinelosses_down', formulaId: 'totlinelosses_down_formula', 
          formula: "Total Line Losses = Total Cable Loss + Total Penurunan Daya", 
          detailFunc: (val) => {
            const totalloss_down = parseFloat(document.getElementById("totalloss_down").value) || 0;
            const totconnect_down = parseFloat(document.getElementById("totconnect_down").value) || 0;
            return `<p>Total Cable Loss = ${totalloss_down} dB</p><p>Total Penurunan Daya = ${totconnect_down} dB</p><p>Total Line Losses = ${totalloss_down} + ${totconnect_down} = ${val} dB</p>`;
          }
        },
        // Popup Total RF Power Delivered to Antenna Downlink
        { buttonId: 'totrfpowerdeliv_down_popup_btn', popupId: 'totrfpowerdeliv_down_popup', inputId: 'totrfpowerdeliv_down', formulaId: 'totrfpowerdeliv_down_formula', 
          formula: "Total RF Power Delivered = dBW - Total Line Losses", 
          detailFunc: (val) => {
            const dbw = parseFloat(document.getElementById("dbw_down").value) || 0;
            const totlinelosses_down = parseFloat(document.getElementById("totlinelosses_down").value) || 0;
            return `<p>dBW = ${dbw} dBW</p><p>Total Line Losses = ${totlinelosses_down} dB</p><p>Total RF Power Delivered = ${dbw} - ${totlinelosses_down} = ${val} dBW</p>`;
          }
        }
    ];

    // Menambahkan event listener untuk tombol "Lihat Detail"
    popupPairs.forEach(pair => {
        const button = document.getElementById(pair.buttonId);
        if (button) {
            button.addEventListener('click', function() {
                openDetailPopup(pair.popupId, pair.inputId, pair.formulaId, pair.formula, pair.detailFunc);
            });
        }
    });
    
    // Menambahkan event listener untuk tombol tutup pada semua popup
    document.querySelectorAll('.close-popup-btn').forEach(button => {
        button.addEventListener('click', function() {
            closeAllPopups();
        });
    });
});

// Fungsi untuk membuka popup detail
function openDetailPopup(popupId, inputId, formulaId, formula, detailFunc) {
    const popup = document.getElementById(popupId);
    if (!popup) return;
    
    const formulaElement = document.getElementById(formulaId);
    if (formulaElement) {
        formulaElement.innerHTML = formula;
    }
    
    const inputValue = document.getElementById(inputId).value;
    const detailContent = document.getElementById(popupId + '_content');
    if (detailContent) {
        detailContent.innerHTML = detailFunc(inputValue);
    }
    
    // Tampilkan popup
    popup.style.display = "flex";
}

// Fungsi untuk menutup semua popup
function closeAllPopups() {
    document.querySelectorAll('.popup-window').forEach(popup => {
        popup.style.display = "none";
    });
}



        </script>
</x-layout> 
