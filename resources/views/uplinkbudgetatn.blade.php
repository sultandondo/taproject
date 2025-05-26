<x-layout>
    <x-slot:title>Uplink & Downlink Budget Calculator</x-slot>
    
    <!-- Uplink Section -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Uplink</h1>
        
        <!-- Ground Station Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4 text-white bg-blue-500 p-2 rounded">Ground Station</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Station Transmitter Power Output (watts):</label>
                    <input type="number" step="any" id="tx_powerwatts_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter power in watts">
                    
                    
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700 mb-1">Power in dBW:</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="tx_powerdbw_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="tx_powerdbw_up" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Power in dBm:</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="tx_powerdbm_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" readonly>
                    <button type="button" id="tx_power_dbw" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Stn. Total Transmission Line Losses (dB):</label>
                    <input type="number" step="any" id="trlinelosses_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter line losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Antenna Gain (dBi):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="antennaagain_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter antenna gain in dBi">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Station EIRP (dBW):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="eirp_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" readonly>
                </div>
            </div>
        </div>

        <!-- Uplink Path Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4 text-white bg-blue-500 p-2 rounded">Uplink Path</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Station Antenna Pointing Losses (dB):</label>
                    <input type="number" step="any" id="pointinglosses_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter pointing losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Gnd-to-S/C Antenna Polarization Losses (dB):</label>
                    <input type="number" step="any" id="polarizationlosses_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter polarization losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Path Loss (dB):</label>
                    <input type="number" step="any" id="pathlosss_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter path loss in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Atmospheric Losses (dB):</label>
                    <input type="number" step="any" id="atmosphericlosses_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter atmospheric losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ionospheric Losses (dB):</label>
                    <input type="number" step="any" id="ionosphericlosses_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter ionospheric losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Rain Losses (dB):</label>
                    <input type="number" step="any" id="rainlosses_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter rain losses in dB">
                </div>
                
                <div class="mb-4 md:col-span-2 lg:col-span-3">
                    <label class="block font-medium mb-1 text-gray-700">Isotropic Signal Level at Spacecraft (dBW):</label>
                    <input type="number" step="any" id="signallevel_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold text-lg" readonly>
                </div>
            </div>
        </div>

        <!-- Spacecraft Alternative Signal Analysis Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4 text-white bg-blue-500 p-2 rounded">Spacecraft Alternative Signal Analysis Method (SNR Computation):</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Antenna Pointing Loss (dB):</label>
                    <input type="number" step="any" id="scpointingloss_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter spacecraft pointing loss">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Antenna Gain (dBi):</label>
                    <input type="number" step="any" id="scantennagain_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter spacecraft antenna gain">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Total Transmission Line Losses (dB):</label>
                    <input type="number" step="any" id="sclinelosses_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter spacecraft line losses">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Effective Noise Temperature (K):</label>
                    <input type="number" step="any" id="scnoisetemp_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter noise temperature">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Figure of Merit (G/T) (dB/K):</label>
                    <input type="number" step="any" id="scgtratio_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Signal Power at Spacecraft LNA Input (dBW):</label>
                    <input type="number" step="any" id="scsignalpower_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Receiver Bandwidth (Hz):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="scbandwidth_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter receiver bandwidth">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Receiver Noise Power (Pn = kTB) (dBW):</label>
                    <input type="number" step="any" id="scnoisepower_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Signal-to-Noise Power Ratio at G.S. Rcvr (dB):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="snrratio_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Analog or Digital System Required S/N (dB):</label>
                    <input type="number" step="any" id="requiredsnr_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter required S/N">
                </div>
                
                <div class="mb-4 md:col-span-2">
                    <label class="block font-medium mb-1 text-gray-700">System Link Margin (dB):</label>
                    <input type="number" step="any" id="linkmargin_up" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold text-lg">
                </div>
            </div>
        </div>
    </div>

     <!-- Downlink Section -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Downlink</h1>
        
        <!-- Spacecraft Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4 text-white bg-blue-500 p-2 rounded">Spacecraft</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Transmitter Power Output (watts):</label>
                    <input type="number" step="any" id="sc_powerwatts_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter power in watts">
                    
                    
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700 mb-1">Power in dBW:</label>
                    <input type="number" step="any" id="sc_powerdbw_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="sc_powerdbw_down" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Power in dBm:</label>
                    <input type="number" step="any" id="sc_powerdbm_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" readonly>
                    <button type="button" id="sc_powerdbm_down" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Total Transmission Line Losses (dB):</label>
                    <input type="number" step="any" id="sclinelosses_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter line losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Antenna Gain (dBi):</label>
                    <input type="number" step="any" id="scantennaagain_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter antenna gain in dBi">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft EIRP (dBW):</label>
                    <input type="number" step="any" id="sceirp_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" readonly>
                </div>
            </div>
        </div>

        <!-- Downlink Path Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4 text-white bg-blue-500 p-2 rounded">Downlink Path</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Antenna Pointing Losses (dB):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="scpointinglosses_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter pointing losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">S/C-to-Ground Antenna Polarization Losses (dB):</label>
                    <input type="number" step="any" id="polarizationlosses_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter polarization losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Path Loss (dB):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="pathlosss_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter path loss in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Atmospheric Losses (dB):</label>
                    <input type="number" step="any" id="atmosphericlosses_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter atmospheric losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ionospheric Losses (dB):</label>
                    <input type="number" step="any" id="ionosphericlosses_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter ionospheric losses in dB">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Rain Losses (dB):</label>
                    <input type="number" step="any" id="rainlosses_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter rain losses in dB">
                </div>
                
                <div class="mb-4 md:col-span-2 lg:col-span-3">
                    <label class="block font-medium mb-1 text-gray-700">Isotropic Signal Level at Ground Station (dBW):</label>
                    <input type="number" step="any" id="signallevel_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold text-lg" readonly>
                </div>
            </div>
        </div>

        <!-- Ground Station Alternative Signal Analysis Section -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4 text-white bg-blue-500 p-2 rounded">Ground Station Alternative Signal Analysis Method (SNR Method):</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Station Antenna Pointing Loss (dB):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="gspointingloss_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter ground station pointing loss">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Station Antenna Gain (dBi):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="gsantennagain_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter ground station antenna gain">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Station Total Transmission Line Losses (dB):</label>
                    <input type="number" step="any" id="gslinelosses_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter ground station line losses">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Station Effective Noise Temperature (K):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="gsnoisetemp_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter noise temperature">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Station Figure of Merit (G/T) (dB/K):</label>
                    <div class="h-6 mt-0"></div>
                    <input type="number" step="any" id="gsgtratio_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Signal Power at Ground Station LNA Input (dBW):</label>
                    <input type="number" step="any" id="gssignalpower_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Ground Station Receiver Bandwidth (Hz):</label>
                    <input type="number" step="any" id="gsbandwidth_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter receiver bandwidth">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">G.S. Receiver Noise Power (Pn = kTB) (dBW):</label>
                    <input type="number" step="any" id="gsnoisepower_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Signal-to-Noise Power Ratio at G.S. Rcvr (dB):</label>
                    <input type="number" step="any" id="snrratio_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold">
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Analog or Digital System Required S/N (dB):</label>
                    <input type="number" step="any" id="requiredsnr_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Enter required S/N">
                </div>
                
                <div class="mb-4 md:col-span-2">
                    <label class="block font-medium mb-1 text-gray-700">System Link Margin (dB):</label>
                    <input type="number" step="any" id="linkmargin_down" class="w-full p-3 border border-yellow-400 rounded-lg bg-yellow-100 text-yellow-800 cursor-not-allowed font-bold text-lg">
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to handle calculations remains the same as before
    </script>
</x-layout>
