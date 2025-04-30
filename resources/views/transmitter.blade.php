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
                        placeholder="Masukkan Nilai Line A Length" oninput="calculateTotalLength(); calculateTotalLoss()">
                </div>

                <div class="w-1/3">
                    <label for="blength_up" class="block font-medium text-gray-700 mb-1">Line B Length:</label>
                    <input type="number" id="blength_up" name="blength_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Line B Length" oninput="calculateTotalLength(); calculateTotalLoss()">
                </div>

                <div class="w-1/3">
                    <label for="clength_up" class="block font-medium text-gray-700 mb-1">Line C Length:</label>
                    <input type="number" id="clength_up" name="clength_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai Line C Length" oninput="calculateTotalLength(); calculateTotalLoss()">
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
                        placeholder="Masukkan Nilai Loss/meter" oninput="calculateTotalLoss()">
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
                    <input type="number" id="connect_up" name="connect_up"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        placeholder="Masukkan Nilai" oninput="calculateTotalConnector()">
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
                <div id="device_up" class="mb-4">
                <input type="number" name="device_up" id="device_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
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

        // Perhitungan Total Length 
        function calculateTotalLength() {
            // Ambil nilai dari input
            const aLength_up = parseFloat(document.getElementById('alength_up').value) || 0;
            const bLength_up = parseFloat(document.getElementById('blength_up').value) || 0;
            const cLength_up = parseFloat(document.getElementById('clength_up').value) || 0;

            // Hitung total panjang
            const totalLength = aLength_up + bLength_up + cLength_up;

            // Tampilkan hasil perhitungan pada input totlength
            document.getElementById('totlength_up').value = totalLength.toFixed(2); // Menampilkan dengan dua angka desimal
        }

        // Fungsi untuk menghitung total penurunan daya berdasarkan jumlah connector
        function calculateTotalConnector() {
            // Ambil nilai dari input "Jumlah In-Line Connectors"
            const connectors = parseFloat(document.getElementById('connect_up').value) || 0;

            // Hitung total penurunan daya (dB) menggunakan rumus
            const totalLoss = connectors * 0.05;  // 0.05 dB per connector

            // Tampilkan hasil perhitungan pada input "Total Penurunan Daya"
            document.getElementById('totconnect_up').value = totalLoss.toFixed(2); // Menampilkan dengan dua angka desimal
        }

        // Fungsi untuk menghitung Total Cable Loss (dB)
         function calculateTotalLoss() {
            // Ambil nilai input "Cable/Waveguide Loss per meter"
            const guideloss_up = parseFloat(document.getElementById('guideloss_up').value) || 0;

            // Ambil nilai Total Line Length
            const totlength_up = parseFloat(document.getElementById('totlength_up').value) || 0;

            // Hitung Cable Wave Guide/Meter (dB)
            const totalloss_up = guideloss_up * totlength_up;

            // Tampilkan hasil perhitungan pada input "Total Loss (dB)"
            document.getElementById('totalloss_up').value = totalloss_up.toFixed(2); // Menampilkan dengan dua angka desimal

            // Perhitungan Total Line Losses
            const totalLineLosses = totalloss_up; // Total line losses sama dengan total cable loss
            document.getElementById('totlinelosses_up').value = totalLineLosses.toFixed(2);

            // Perhitungan Total Power Delivered to Antenna
            const transmitterPower = parseFloat(document.getElementById('watt_up').value) || 0;
            if (transmitterPower > 0) {
                const dbw = 10 * Math.log10(transmitterPower); // Menghitung dBW
                const totalPowerDelivered = dbw - totalLineLosses; // Total power to antenna
                document.getElementById('totpowerdeliv_up').value = totalPowerDelivered.toFixed(2);
            }
        }

    </script>
</x-layout> 
