<x-layout>
    <x-slot:title>Form Transmitter</x-slot>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-center">Uplink</h2>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-start space-x-6 items-center">
                <!-- Input Watt for Uplink -->
                <div class="w-1/3">
                    <label for="watt_up" class="block font-medium text-gray-700 mb-1">Transmitter Power (Watt):</label>
                    <input type="number" id="watt_up" name="watt_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan nilai Watt" oninput="calculatePowerUp()">
                </div>

                <!-- Output dBW for Uplink -->
                <div class="w-1/3">
                    <label for="dbw_up" class="block font-medium text-gray-700 mb-1">Transmitter Power (dBW):</label>
                    <input type="text" id="dbw_up" name="dbw_up"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil dBW" readonly>
                </div>

                <!-- Output dBm for Uplink -->
                <div class="w-1/3">
                    <label for="dbm_up" class="block font-medium text-gray-700 mb-1">Transmitter Power (dBm):</label>
                    <input type="text" id="dbm_up" name="dbm_up"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil dBm" readonly>
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
                    placeholder="Hasil Total Length" readonly>
            </div>

            <div id="cabletype_up" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide Type:</label>
                <input type="text" name="cabletype_up" id="cabletype_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
            </div>

            <!-- Input untuk Cable/Waveguide Loss per meter -->
            <div class="flex justify-start space-x-6 items-center mb-4">
                <div class="w-1/3">
                    <label for="guideloss_up" class="block font-medium text-gray-700 mb-1">Cable/Waveguide Loss (dB/m):</label>
                    <input type="number" id="guideloss_up" name="guideloss_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Loss/meter" oninput="calculateTotalLossUp()">
                </div>

                <!-- Output Total Cable Loss -->
                <div class="w-1/3">
                    <label for="totalloss_up" class="block font-medium text-gray-700 mb-1">Total Cable Loss (dB):</label>
                    <input type="text" id="totalloss_up" name="totalloss_up"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil Total Loss" readonly>
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
                </div>

                <div class="w-1/3">
                    <label for="totconnect_up" class="block font-medium text-gray-700 mb-1">Total Penurunan Daya</label>
                    <input type="text" id="totconnect_up" name="totconnect_up"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil Total Connector" readonly>
                </div>
            </div>

            <div id="filter_up" class="mb-4">
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
                <div id="devicee_up" class="mb-4">
                <input type="number" name="devicee_up" id="devicee_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>
            </div>

            <div id="atn_up" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Antenna Mismatch Losses:</label>
                <input type="number" name="atn_up" id="atn_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
            </div>
        
            <div id="totlinelosses_up" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total Line Losses (dB):</label>
                    <input type="number" name="totlinelosses_up" id="totlinelosses_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" readonly>
                 </div>

                 <div id="totpowerdeliv_up" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total Power Deliver to Antenna (dBW):</label>
                    <input type="number" name="totpowerdeliv_up" id="totpowerdeliv_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" readonly>
                 </div>

        </div>
        <h2 class="text-2xl font-bold mb-6 text-center">Downlink</h2>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-start space-x-6 items-center">
                <!-- Input Watt for Downlink -->
                <div class="w-1/3">
                    <label for="watt_down" class="block font-medium text-gray-700 mb-1">Transmitter Power (Watt):</label>
                    <input type="number" id="watt_down" name="watt_down"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan nilai Watt" oninput="calculatePowerDown()">
                </div>

                <!-- Output dBW for Downlink -->
                <div class="w-1/3">
                    <label for="dbw_down" class="block font-medium text-gray-700 mb-1">Transmitter Power (dBW):</label>
                    <input type="text" id="dbw_down" name="dbw_down"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil dBW" readonly>
                </div>

                <!-- Output dBm for Downlink -->
                <div class="w-1/3">
                    <label for="dbm_down" class="block font-medium text-gray-700 mb-1">Transmitter Power (dBm):</label>
                    <input type="text" id="dbm_down" name="dbm_down"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil dBm" readonly>
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
                    placeholder="Hasil Total Length" readonly>
            </div>

            <div id="cabletype_down" class="mb-4">
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
                </div>

                <!-- Output Total Cable Loss -->
                <div class="w-1/3">
                    <label for="totalloss_down" class="block font-medium text-gray-700 mb-1">Total Cable Loss (dB):</label>
                    <input type="text" id="totalloss_down" name="totalloss_down"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil Total Loss" readonly>
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
                </div>

                <div class="w-1/3">
                    <label for="totconnect_down" class="block font-medium text-gray-700 mb-1">Total Penurunan Daya</label>
                    <input type="text" id="totconnect_down" name="totconnect_down"
                        class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Hasil Total Connector" readonly>
                </div>
            </div>

            <div id="filter_down" class="mb-4">
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
                <div id="devicee_down" class="mb-4">
                <input type="number" name="devicee_down" id="devicee_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>
            </div>

            <div id="atn_down" class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Antenna Mismatch Losses:</label>
                <input type="number" name="atn_down" id="atn_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
            </div>
        
            <div id="totlinelosses_down" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total Line Losses (dB):</label>
                    <input type="number" name="totlinelosses_down" id="totlinelosses_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" readonly>
                 </div>

                 <div id="totpowerdeliv_down" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total RF Power Deliver to Antenna (dBW):</label>
                    <input type="number" name="totrfrpowerdeliv_down" id="totrfpowerdeliv_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" readonly>
                 </div>
        </div>
    </div>

    {{-- JavaScript Perhitungan --}}

        <script>
       // Fungsi untuk menghitung dBW dan dBm untuk Uplink
function calculatePowerUp() {
    const watt = parseFloat(document.getElementById('watt_up').value);
    if (!isNaN(watt) && watt > 0) {
        const dbw = 10 * Math.log10(watt);  // Menghitung dBW
        const dbm = dbw + 30;  // Menghitung dBm

        document.getElementById('dbw_up').value = dbw.toFixed(2);  // Menampilkan dBW untuk Uplink
        document.getElementById('dbm_up').value = dbm.toFixed(2);  // Menampilkan dBm untuk Uplink
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
    document.getElementById('totlength_up').value = totlength_up.toFixed(2);  // Menampilkan total panjang
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
    document.getElementById('totalloss_up').value = totalloss_up.toFixed(2);  // Menampilkan Total Cable Loss untuk Uplink

    // Menghitung Total Line Losses Uplink
    calculateTotalLineLossesUp(totalloss_up);
}

// Fungsi untuk menghitung Total Cable Loss Downlink
function calculateTotalLossDown() {
    const guideloss_down = parseFloat(document.getElementById('guideloss_down').value) || 0;
    const totlength_down = parseFloat(document.getElementById('totlength_down').value) || 0;

    const totalloss_down = guideloss_down * totlength_down;
    document.getElementById('totalloss_down').value = totalloss_down.toFixed(2);  // Menampilkan Total Cable Loss untuk Downlink

    // Menghitung Total Line Losses Downlink
    calculateTotalLineLossesDown(totalloss_down);
}

// Fungsi untuk menghitung Total Line Losses Uplink
function calculateTotalLineLossesUp(totalloss_up) {
    const totalConnectorLoss_up = parseFloat(document.getElementById('totconnect_up').value || 0);
    const filterLoss_up = parseFloat(document.getElementById('filter_up').value || 0);
    const otherInlineLoss_up = parseFloat(document.getElementById('devicee_up').value || 0);
    const antennaMismatchLoss_up = parseFloat(document.getElementById('atn_up').value || 0);

    const totalLineLosses_up = totalloss_up + totalConnectorLoss_up + filterLoss_up + otherInlineLoss_up + antennaMismatchLoss_up;
    document.getElementById('totlinelosses_up').value = totalLineLosses_up.toFixed(2);  // Menampilkan Total Line Losses untuk Uplink

    // Menghitung Total Power Delivered to Antenna Uplink
    const transmitterPower_up = parseFloat(document.getElementById('watt_up').value) || 0;
    if (transmitterPower_up > 0) {
        const dbw_up = 10 * Math.log10(transmitterPower_up);
        const totalPowerDelivered_up = dbw_up - totalLineLosses_up;
        document.getElementById('totpowerdeliv_up').value = totalPowerDelivered_up.toFixed(2);  // Menampilkan total power delivered Uplink
    }
}

// Fungsi untuk menghitung Total Line Losses Downlink
function calculateTotalLineLossesDown(totalloss_down) {
    const totalConnectorLoss_down = parseFloat(document.getElementById('totconnect_down').value || 0);
    const filterLoss_down = parseFloat(document.getElementById('filter_down').value || 0);
    const otherInlineLoss_down = parseFloat(document.getElementById('devicee_down').value || 0);
    const antennaMismatchLoss_down = parseFloat(document.getElementById('atn_down').value || 0);

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

// Fungsi untuk menghitung total penurunan daya berdasarkan jumlah connector untuk Uplink
function calculateTotalConnectorUp() {
    const connect_up = parseFloat(document.getElementById('connect_up').value) || 0;
    const totalloss_up = connect_up * 0.05;
    document.getElementById('totconnect_up').value = totalloss_up.toFixed(2);  // Menampilkan total penurunan daya untuk Uplink
}

// Fungsi untuk menghitung total penurunan daya berdasarkan jumlah connector untuk Downlink
function calculateTotalConnectorDown() {
    const connect_down = parseFloat(document.getElementById('connect_down').value) || 0;
    const totalloss_down = connect_down * 0.05;
    document.getElementById('totconnect_down').value = totalloss_down.toFixed(2);  // Menampilkan total penurunan daya untuk Downlink
}


        </script>
</x-layout> 
