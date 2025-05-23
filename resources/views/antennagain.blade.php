<x-layout>
    <x-slot:title>Antenna Gain</x-slot>
    <div class="container mx-auto px-4 py-8">
        
        <!-- Uplink Section -->
        <h2 class="text-2xl font-bold mb-6 text-center">Uplink Antenna Sistem</h2>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form method="POST" action="/antenna-gain" id="antennaForm">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <!-- Ground Station Section -->
                <div class="mb-8">
                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700 text-lg">Ground Station:</label>
                    </div>

                    <!-- Polarization Selection -->
                    <div class="mb-6">
                        <label for="jenis_polarizationgrounds_up" class="block font-medium mb-2 text-gray-700">Jenis Polarization:</label>
                        <select name="jenis_polarizationgrounds_up" id="jenis_polarizationgrounds_up" onchange="handlePolarizationChange('grounds', 'up')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="RHCP">RHCP</option>
                            <option value="LHCP">LHCP</option>
                            <option value="Linear">Linear</option>
                        </select>
                    </div>

                    <!-- Antenna Type Selection -->
                    <div class="mb-4">
                        <label for="jenis_antenagrounds_up" class="block font-medium mb-1 text-gray-700">Jenis Antena:</label>
                        <select name="jenis_antenagrounds_up" id="jenis_antenagrounds_up" onchange="handleAntennaChangeGroundsUplinkEnhanced()" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="">-- Pilih Antena --</option>
                            <option value="Yagi" {{ request('jenis_antenagrounds_up') == 'Yagi' ? 'selected' : '' }}>Yagi</option>
                            <option value="Helix" {{ request('jenis_antenagrounds_up') == 'Helix' ? 'selected' : '' }}>Helix</option>
                            <option value="Parabolic Reflector" {{ request('jenis_antenagrounds_up') == 'Parabolic' ? 'selected' : '' }}>Parabolic Reflector</option>
                            <option value="User Defined" {{ request('jenis_antenagrounds_up') == 'UserDefined' ? 'selected' : '' }}>User Defined</option>
                        </select>
                    </div>

                    <!-- Yagi Antenna Fields -->
                    <div id="yagi_fields_grounds" style="display: none;">
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Boom Length (λ):</label>
                            <input type="number" name="boomblength_upgrounds" id="boomblength_upgrounds" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label for="optimumelements_upgrounds" class="block font-medium mb-1 text-gray-700">Optimum Elements (n):</label>
                            <input type="text" name="optimumelements_upgrounds" id="optimumelements_upgrounds" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>

                        <div class="mb-4">
                            <label for="maximumgain_upgrounds" class="block font-medium mb-1 text-gray-700">Maximum Gain (dBiC):</label>
                            <input type="text" name="maximumgain_upgrounds" id="maximumgain_upgrounds" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>

                        <div class="mb-4">
                            <label for="beamwidth_upgrounds1" class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                            <input type="text" name="beamwidth_upgrounds1" id="beamwidth_upgrounds1" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>

                        <div class="mb-4">
                            <label for="antennalength_upgrounds" class="block font-medium mb-1 text-gray-700">Antenna Length (meters):</label>
                            <input type="text" name="antennalength_upgrounds" id="antennalength_upgrounds" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>
                    </div>

                    <!-- Helix Antenna Fields -->
                    <div id="helix_fields_grounds" style="display: none;">
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Turns (n):</label>
                            <input type="number" name="turns_upgrounds" id="turns_upgrounds" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Turn Spacing (λ):</label>
                            <input type="number" name="turnspacing_upgrounds" id="turnspacing_upgrounds" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Circumference (λ):</label>
                            <input type="number" name="circumference_upgrounds" id="circumference_upgrounds" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label for="gain_upantenna_grounds1" class="block font-medium mb-1 text-gray-700">Gain (dBiC):</label>
                            <input type="text" name="gain_upantenna_grounds1" id="gain_upantenna_grounds1" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>

                        <div class="mb-4">
                            <label for="beamwidth_upgrounds_helix" class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                            <input type="text" name="beamwidth_upgrounds_helix" id="beamwidth_upgrounds_helix" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>

                        <div class="mb-4">
                            <label for="antennalength_upgrounds_helix" class="block font-medium mb-1 text-gray-700">Antenna Length (meters):</label>
                            <input type="text" name="antennalength_upgrounds_helix" id="antennalength_upgrounds_helix" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>
                    </div>

                    <!-- Parabolic Reflector Fields -->
                    <div id="parabolic_fields_grounds" style="display: none;">
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Diameter (m):</label>
                            <input type="number" name="diameter_upgrounds" id="diameter_upgrounds" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Aperture Efficiency:</label>
                            <input type="number" name="aperatureeffiviency_upgrounds" id="aperatureeffiviency_upgrounds" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" max="1" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label for="gain_upantenna_grounds2" class="block font-medium mb-1 text-gray-700">Gain (dBiC):</label>
                            <input type="text" name="gain_upantenna_grounds2" id="gain_upantenna_grounds2" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>

                        <div class="mb-4">
                            <label for="beamwidth_upgrounds2" class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                            <input type="text" name="beamwidth_upgrounds2" id="beamwidth_upgrounds2" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>

                        <div class="mb-4">
                            <label for="antennalength_upgrounds_parabolic" class="block font-medium mb-1 text-gray-700">Antenna Length (meters):</label>
                            <input type="text" name="antennalength_upgrounds_parabolic" id="antennalength_upgrounds_parabolic" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>
                    </div>

                    <!-- User Defined Fields for Ground Station -->
                    <div id="user_defined_fields_grounds" style="display: none;">
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <h4 class="font-semibold text-blue-800 mb-2">Input Manual - Ground Station</h4>
                            <p class="text-sm text-blue-600">Masukkan spesifikasi antena secara manual</p>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Gain (dBiC):</label>
                            <input type="number" name="gain_manual_grounds" id="gain_manual_grounds" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain dalam dBiC">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                            <input type="number" name="beamwidth_manual_grounds" id="beamwidth_manual_grounds" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dalam derajat">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Antenna Type Name:</label>
                            <input type="text" name="antenna_name_grounds" id="antenna_name_grounds" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Nama tipe antena (opsional)">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Additional Notes:</label>
                            <textarea name="notes_grounds" id="notes_grounds" rows="3" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Catatan tambahan tentang antena (opsional)"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Spacecraft Section -->
                <div class="mb-8">
                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700 text-lg">Spacecraft:</label>
                    </div>

                    <!-- Polarization Selection -->
                    <div class="mb-6">
                        <label for="jenis_polarizationspacecraft_up" class="block font-medium mb-2 text-gray-700">Jenis Polarization:</label>
                        <select name="jenis_polarizationspacecraft_up" id="jenis_polarizationspacecraft_up" onchange="handlePolarizationChange('spacecraft', 'up')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="RHCP">RHCP</option>
                            <option value="LHCP">LHCP</option>
                            <option value="Linear">Linear</option>
                        </select>
                    </div>

                    <!-- Antenna Type Selection -->
                    <div class="mb-4">
                        <label for="jenis_antenaspacecraft_up" class="block font-medium mb-1 text-gray-700">Jenis Antena:</label>
                        <select name="jenis_antenaspacecraft_up" id="jenis_antenaspacecraft_up" onchange="handleAntennaChangeSpacecraftUplinkEnhanced()" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="">-- Pilih Antena --</option>
                            <option value="Monopol" {{ request('jenis_antenaspacecraft_up') == 'Monopol' ? 'selected' : '' }}>Monopol</option>
                            <option value="Dipol" {{ request('jenis_antenaspacecraft_up') == 'Dipol' ? 'selected' : '' }}>Dipol</option>
                            <option value="Patch" {{ request('jenis_antenaspacecraft_up') == 'Patch' ? 'selected' : '' }}>Patch</option>
                            <option value="Parabolic Reflector" {{ request('jenis_antenaspacecraft_up') == 'ParabolicReflector' ? 'selected' : '' }}>Parabolic Reflector</option>
                            <option value="Other (User Defined)" {{ request('jenis_antenaspacecraft_up') == 'Other' ? 'selected' : '' }}>Other (User Defined)</option>
                        </select>
                    </div>

                    <!-- Standard Antenna Fields -->
                    <div id="standard_fields_spacecraft" style="display: none;">
                        <div id="dishdiameter_upspacecraft" class="mb-4" style="display: none;">
                            <label class="block font-medium mb-1 text-gray-700">Dish Diameter (m):</label>
                            <input type="number" name="dishdiameter_upspacecraft" id="dishdiameter_upspacecraft_input" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.01">
                        </div>

                        <div id="dishaperatureeffiviency_upspacecraft" class="mb-4" style="display: none;">
                            <label class="block font-medium mb-1 text-gray-700">Dish Aperture Efficiency:</label>
                            <input type="number" name="dishaperatureeffiviency_upspacecraft" id="dishaperatureeffiviency_upspacecraft_input" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" max="1" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label for="gain_upantenna_spacecraft1" class="block font-medium mb-1 text-gray-700">Gain (dBiC):</label>
                            <input type="text" name="gain_upantenna_spacecraft1" id="gain_upantenna_spacecraft1" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>

                        <div class="mb-4">
                            <label for="beamwidth_upspacecraft1" class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                            <input type="text" name="beamwidth_upspacecraft1" id="beamwidth_upspacecraft1" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        </div>
                    </div>

                    <!-- User Defined Fields for Spacecraft -->
                    <div id="user_defined_fields_spacecraft" style="display: none;">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <h4 class="font-semibold text-green-800 mb-2">Input Manual - Spacecraft</h4>
                            <p class="text-sm text-green-600">Masukkan spesifikasi antena secara manual</p>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Gain (dBiC):</label>
                            <input type="number" name="gain_manual_spacecraft" id="gain_manual_spacecraft" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain dalam dBiC">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                            <input type="number" name="beamwidth_manual_spacecraft" id="beamwidth_manual_spacecraft" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dalam derajat">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Antenna Type Name:</label>
                            <input type="text" name="antenna_name_spacecraft" id="antenna_name_spacecraft" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Nama tipe antena (opsional)">
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Additional Notes:</label>
                            <textarea name="notes_spacecraft" id="notes_spacecraft" rows="3" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Catatan tambahan tentang antena (opsional)"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Polarization Loss Warning -->
                <div id="polarization_warning" class="mb-6" style="display: none;">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Polarization Mismatch Warning</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p id="polarization_warning_text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full font-semibold">Simpan Data Antena</button>
            </form>
        </div>
    </div>

    <script>
        // Initialize form on page load
        document.addEventListener('DOMContentLoaded', function() {
            handleAntennaChangeGroundsUplink();
            handleAntennaChangeSpacecraftUplink();
            checkPolarizationMismatch();
            
            // Add event listeners for automatic calculations
            setupEventListeners();
        });

        function handleAntennaChangeGroundsUplink() {
            const antennaType = document.getElementById('jenis_antenagrounds_up').value;
            
            // Hide all antenna-specific fields
            document.getElementById('yagi_fields_grounds').style.display = 'none';
            document.getElementById('helix_fields_grounds').style.display = 'none';
            document.getElementById('parabolic_fields_grounds').style.display = 'none';
            document.getElementById('user_defined_fields_grounds').style.display = 'none';
            
            // Show relevant fields based on selection
            switch(antennaType) {
                case 'Yagi':
                    document.getElementById('yagi_fields_grounds').style.display = 'block';
                    break;
                case 'Helix':
                    document.getElementById('helix_fields_grounds').style.display = 'block';
                    break;
                case 'Parabolic Reflector':
                    document.getElementById('parabolic_fields_grounds').style.display = 'block';
                    break;
                case 'User Defined':
                    document.getElementById('user_defined_fields_grounds').style.display = 'block';
                    break;
            }
            
            // Trigger calculations if needed
            calculateAntennaParameters('grounds');
        }

        function handleAntennaChangeSpacecraftUplink() {
            const antennaType = document.getElementById('jenis_antenaspacecraft_up').value;
            
            // Hide all fields first
            document.getElementById('standard_fields_spacecraft').style.display = 'none';
            document.getElementById('user_defined_fields_spacecraft').style.display = 'none';
            document.getElementById('dishdiameter_upspacecraft').style.display = 'none';
            document.getElementById('dishaperatureeffiviency_upspacecraft').style.display = 'none';
            
            // Show relevant fields based on selection
            switch(antennaType) {
                case 'Monopol':
                case 'Dipol':
                case 'Patch':
                    document.getElementById('standard_fields_spacecraft').style.display = 'block';
                    break;
                case 'Parabolic Reflector':
                    document.getElementById('standard_fields_spacecraft').style.display = 'block';
                    document.getElementById('dishdiameter_upspacecraft').style.display = 'block';
                    document.getElementById('dishaperatureeffiviency_upspacecraft').style.display = 'block';
                    break;
                case 'Other (User Defined)':
                    document.getElementById('user_defined_fields_spacecraft').style.display = 'block';
                    break;
            }
            
            // Trigger calculations if needed
            calculateAntennaParameters('spacecraft');
        }

        function handlePolarizationChange(section, link) {
            checkPolarizationMismatch();
        }

        function checkPolarizationMismatch() {
            const groundsPolarization = document.getElementById('jenis_polarizationgrounds_up').value;
            const spacecraftPolarization = document.getElementById('jenis_polarizationspacecraft_up').value;
            const warningDiv = document.getElementById('polarization_warning');
            const warningText = document.getElementById('polarization_warning_text');
            
            if (groundsPolarization !== spacecraftPolarization) {
                let lossAmount = '';
                
                if ((groundsPolarization === 'RHCP' && spacecraftPolarization === 'LHCP') ||
                    (groundsPolarization === 'LHCP' && spacecraftPolarization === 'RHCP')) {
                    lossAmount = 'infinite loss (complete signal loss)';
                } else if ((groundsPolarization === 'Linear' && (spacecraftPolarization === 'RHCP' || spacecraftPolarization === 'LHCP')) ||
                          ((groundsPolarization === 'RHCP' || groundsPolarization === 'LHCP') && spacecraftPolarization === 'Linear')) {
                    lossAmount = '3 dB loss';
                }
                
                warningText.textContent = `Polarization mismatch detected! Ground Station (${groundsPolarization}) and Spacecraft (${spacecraftPolarization}) polarizations don't match. This will result in ${lossAmount}.`;
                warningDiv.style.display = 'block';
            } else {
                warningDiv.style.display = 'none';
            }
        }

        function calculateAntennaParameters(section) {
            if (section === 'grounds') {
                const antennaType = document.getElementById('jenis_antenagrounds_up').value;
                
                if (antennaType === 'Yagi') {
                    calculateYagiParameters();
                } else if (antennaType === 'Helix') {
                    calculateHelixParameters();
                } else if (antennaType === 'Parabolic Reflector') {
                    calculateParabolicParameters('grounds');
                }
            } else if (section === 'spacecraft') {
                const antennaType = document.getElementById('jenis_antenaspacecraft_up').value;
                
                if (antennaType === 'Parabolic Reflector') {
                    calculateParabolicParameters('spacecraft');
                } else if (['Monopol', 'Dipol', 'Patch'].includes(antennaType)) {
                    calculateStandardAntennaParameters(antennaType);
                }
            }
        }

        function calculateYagiParameters() {
            const boomLength = parseFloat(document.getElementById('boomblength_upgrounds').value);
            
            if (!isNaN(boomLength) && boomLength > 0) {
                // Simplified Yagi calculations
                const optimumElements = Math.round(0.445 * Math.pow(boomLength, 0.77));
                const maxGain = 10 * Math.log10(optimumElements) + 5.5;
                const beamwidth = 180 / (Math.PI * Math.sqrt(Math.pow(10, maxGain/10)));
                const frequency = 2400; // MHz, default frequency
                const wavelength = 300 / frequency; // in meters
                const antennaLength = boomLength * wavelength;
                
                document.getElementById('optimumelements_upgrounds').value = optimumElements;
                document.getElementById('maximumgain_upgrounds').value = maxGain.toFixed(2);
                document.getElementById('beamwidth_upgrounds1').value = beamwidth.toFixed(2);
                document.getElementById('antennalength_upgrounds').value = antennaLength.toFixed(3);
            }
        }

        function calculateHelixParameters() {
            const turns = parseFloat(document.getElementById('turns_upgrounds').value);
            const turnSpacing = parseFloat(document.getElementById('turnspacing_upgrounds').value);
            const circumference = parseFloat(document.getElementById('circumference_upgrounds').value);
            
            if (!isNaN(turns) && !isNaN(turnSpacing) && !isNaN(circumference) && 
                turns > 0 && turnSpacing > 0 && circumference > 0) {
                
                // Helix antenna calculations
                const gain = 11 + 10 * Math.log10(turns * Math.pow(turnSpacing, 2) * Math.pow(circumference, 2));
                
                // Beamwidth calculation for helix antenna (approximate)
                const beamwidth = 52 / Math.sqrt(turns * turnSpacing * circumference);
                
                // Antenna length calculation
                const frequency = 2400; // MHz, default frequency
                const wavelength = 300 / frequency; // in meters
                const antennaLength = turns * turnSpacing * wavelength;
                
                document.getElementById('gain_upantenna_grounds1').value = gain.toFixed(2);
                document.getElementById('beamwidth_upgrounds_helix').value = beamwidth.toFixed(2);
                document.getElementById('antennalength_upgrounds_helix').value = antennaLength.toFixed(3);
            }
        }

        function calculateParabolicParameters(section) {
            const diameterField = section === 'grounds' ? 'diameter_upgrounds' : 'dishdiameter_upspacecraft_input';
            const efficiencyField = section === 'grounds' ? 'aperatureeffiviency_upgrounds' : 'dishaperatureeffiviency_upspacecraft_input';
            
            const diameter = parseFloat(document.getElementById(diameterField).value);
            const efficiency = parseFloat(document.getElementById(efficiencyField).value);
            const frequency = 2400; // MHz, you might want to make this configurable
            
            if (!isNaN(diameter) && !isNaN(efficiency) && diameter > 0 && efficiency > 0) {
                // Parabolic antenna gain calculation
                const wavelength = 300 / frequency; // in meters
                const gain = 10 * Math.log10(efficiency * Math.pow((Math.PI * diameter / wavelength), 2));
                const beamwidth = 70 * wavelength / diameter; // degrees
                
                // For parabolic antenna, the antenna length is typically the diameter
                const antennaLength = diameter;
                
                if (section === 'grounds') {
                    document.getElementById('gain_upantenna_grounds2').value = gain.toFixed(2);
                    document.getElementById('beamwidth_upgrounds2').value = beamwidth.toFixed(2);
                    document.getElementById('antennalength_upgrounds_parabolic').value = antennaLength.toFixed(3);
                } else {
                    document.getElementById('gain_upantenna_spacecraft1').value = gain.toFixed(2);
                    document.getElementById('beamwidth_upspacecraft1').value = beamwidth.toFixed(2);
                }
            }
        }

        function calculateStandardAntennaParameters(antennaType) {
            // Standard antenna gain values (approximate)
            let gain = 0;
            let beamwidth = 360; // degrees
            
            switch(antennaType) {
                case 'Monopol':
                    gain = 2.15; // dBi
                    beamwidth = 360;
                    break;
                case 'Dipol':
                    gain = 2.15; // dBi
                    beamwidth = 78;
                    break;
                case 'Patch':
                    gain = 6; // dBi (typical)
                    beamwidth = 65;
                    break;
            }
            
            document.getElementById('gain_upantenna_spacecraft1').value = gain.toFixed(2);
            document.getElementById('beamwidth_upspacecraft1').value = beamwidth.toFixed(2);
        }

        function setupEventListeners() {
            // Yagi calculations
            const boomLengthField = document.getElementById('boomblength_upgrounds');
            if (boomLengthField) {
                boomLengthField.addEventListener('input', calculateYagiParameters);
            }
            
            // Helix calculations
            const helixFields = ['turns_upgrounds', 'turnspacing_upgrounds', 'circumference_upgrounds'];
            helixFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('input', calculateHelixParameters);
                }
            });
            
            // Parabolic calculations - Ground Station
            const parabolicGroundsFields = ['diameter_upgrounds', 'aperatureeffiviency_upgrounds'];
            parabolicGroundsFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('input', function() {
                        calculateParabolicParameters('grounds');
                    });
                }
            });
            
            // Parabolic calculations - Spacecraft
            const parabolicSpacecraftFields = ['dishdiameter_upspacecraft_input', 'dishaperatureeffiviency_upspacecraft_input'];
            parabolicSpacecraftFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) {
                    field.addEventListener('input', function() {
                        calculateParabolicParameters('spacecraft');
                    });
                }
            });
        }

        // Form validation before submit
        document.getElementById('antennaForm').addEventListener('submit', function(e) {
            const groundsAntenna = document.getElementById('jenis_antenagrounds_up').value;
            const spacecraftAntenna = document.getElementById('jenis_antenaspacecraft_up').value;
            
            // Validate Ground Station User Defined inputs
            if (groundsAntenna === 'User Defined') {
                const gainManual = document.getElementById('gain_manual_grounds').value;
                const beamwidthManual = document.getElementById('beamwidth_manual_grounds').value;
                
                if (!gainManual || !beamwidthManual) {
                    e.preventDefault();
                    alert('Mohon lengkapi Gain dan Beamwidth untuk Ground Station User Defined!');
                    return false;
                }
            }
            
            // Validate Spacecraft User Defined inputs
            if (spacecraftAntenna === 'Other (User Defined)') {
                const gainManual = document.getElementById('gain_manual_spacecraft').value;
                const beamwidthManual = document.getElementById('beamwidth_manual_spacecraft').value;
                
                if (!gainManual || !beamwidthManual) {
                    e.preventDefault();
                    alert('Mohon lengkapi Gain dan Beamwidth untuk Spacecraft User Defined!');
                    return false;
                }
            }
            
            return true;
        });

        // Helper function to reset all calculated fields
        function resetCalculatedFields(section) {
            if (section === 'grounds') {
                // Reset Yagi fields
                document.getElementById('optimumelements_upgrounds').value = '';
                document.getElementById('maximumgain_upgrounds').value = '';
                document.getElementById('beamwidth_upgrounds1').value = '';
                document.getElementById('antennalength_upgrounds').value = '';
                
                // Reset Helix fields
                document.getElementById('gain_upantenna_grounds1').value = '';
                document.getElementById('beamwidth_upgrounds_helix').value = '';
                document.getElementById('antennalength_upgrounds_helix').value = '';
                
                // Reset Parabolic fields
                document.getElementById('gain_upantenna_grounds2').value = '';
                document.getElementById('beamwidth_upgrounds2').value = '';
                document.getElementById('antennalength_upgrounds_parabolic').value = '';
            } else if (section === 'spacecraft') {
                document.getElementById('gain_upantenna_spacecraft1').value = '';
                document.getElementById('beamwidth_upspacecraft1').value = '';
            }
        }

        // Enhanced antenna change handlers with field reset
        function handleAntennaChangeGroundsUplinkEnhanced() {
            resetCalculatedFields('grounds');
            handleAntennaChangeGroundsUplink();
        }

        function handleAntennaChangeSpacecraftUplinkEnhanced() {
            resetCalculatedFields('spacecraft');
            handleAntennaChangeSpacecraftUplink();
        }
    </script>
</x-layout>