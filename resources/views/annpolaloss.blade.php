<x-layout>
    <x-slot:title>Antenna Polaritation Loss</x-slot>
    <div class="container mx-auto px-4 py-8">
     <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="fas fa-satellite-dish mr- text-blue-600"></i> Perhitungan Parameter 
                <p class=" mr- text-blue-600"></p> Antenna Polarization Loss
        
        <!-- Uplink Section -->
        <h2 class="text-2xl font-bold mb-6 text-center">Uplink</h2>
        <div class="bg-white shadow-lg rounded-lg p-6">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Co-Polarization Loss:</label>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Axial ratio of Tx Antenna (Ant. #1) in dB:</label>
                <input type="number" step="any" name="axtxantenna_up" id="axtxantenna_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" >
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Axial ratio (Ant. #1):</label>
                <input type="number" step="any" name="axialratio1_up" id="axialratio1_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="axialratio1_up_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Axial ratio of Rx Antenna (Ant. #2) in dB:</label>
                <input type="number" step="any" name="axrxantenna_up" id="axrxantenna_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" >
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Axial ratio (Ant. #2):</label>
                <input type="number" step="any" name="axialratio2_up" id="axialratio2_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="axialratio2_up_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Polarization Angle θ between antennas (Degrees):</label>
                <input type="number" step="any" name="degrees_up" id="degrees_up" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" >
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Polarization Angle θ between antennas (Radians):</label>
                <input type="number" step="any" name="radians_up" id="radians_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="radians_up_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div> 

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Polarization Loss:</label>
                <input type="number" step="any" name="polarizationloss_up" id="polarizationloss_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="polarizationloss_up_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Hasil Polarization Loss:</label>
                <input type="number" step="any" name="hasilpolarizationloss_up" id="hasilpolarizationloss_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="hasilpolarizationloss_up_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cross Polarization Coupling/Isolation:</label>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Cross Pol. Power Fraction:</label>
                <input type="number" step="any" name="crosspolpowerfraction_up" id="crosspolpowerfraction_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="crosspolpowerfraction_up_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Cross Pol. Power Fraction (dB):</label>
                <input type="number" step="any" name="dbcrosspolpowerfraction_up" id="dbcrosspolpowerfraction_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="dbcrosspolpowerfraction_up_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Cross Polarization Isolation (dB):</label>
                <input type="number" step="any" name="crosspolarizationisolation_up" id="crosspolarizationisolation_up" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="crosspolarizationisolation_up_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>
        </div>

        <!-- Downlink Section -->
        <h2 class="text-2xl font-bold mb-6 text-center mt-8">Downlink</h2>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Co-Polarization Loss:</label>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Axial ratio of Tx Antenna (Ant. #1) in dB:</label>
                <input type="number" step="any" name="axtxantenna_down" id="axtxantenna_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" >
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Axial ratio (Ant. #1):</label>
                <input type="number" step="any" name="axialratio1_down" id="axialratio1_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="axialratio1_down_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Axial ratio of Rx Antenna (Ant. #2) in dB:</label>
                <input type="number" step="any" name="axrxantenna_down" id="axrxantenna_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" >
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Axial ratio (Ant. #2):</label>
                <input type="number" step="any" name="axialratio2_down" id="axialratio2_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="axialratio2_down_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Polarization Angle θ between antennas (Degrees):</label>
                <input type="number" step="any" name="degrees_down" id="degrees_down" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" >
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Polarization Angle θ between antennas (Radians):</label>
                <input type="number" step="any" name="radians_down" id="radians_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="radians_down_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div> 

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Polarization Loss:</label>
                <input type="number" step="any" name="polarizationloss_down" id="polarizationloss_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="polarizationloss_down_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Hasil Polarization Loss:</label>
                <input type="number" step="any" name="hasilpolarizationloss_down" id="hasilpolarizationloss_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="hasilpolarizationloss_down_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cross Polarization Coupling/Isolation:</label>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Cross Pol. Power Fraction:</label>
                <input type="number" step="any" name="crosspolpowerfraction_down" id="crosspolpowerfraction_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="crosspolpowerfraction_down_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Cross Pol. Power Fraction (dB):</label>
                <input type="number" step="any" name="dbcrosspolpowerfraction_down" id="dbcrosspolpowerfraction_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="dbcrosspolpowerfraction_down_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-grey-700 mb-1">Cross Polarization Isolation (dB):</label>
                <input type="number" step="any" name="crosspolarizationisolation_down" id="crosspolarizationisolation_down" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="crosspolarizationisolation_down_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg w-full transition duration-150 ease-in-out">
                    Hitung & Simpan Parameter Antenna Polarization Loss
                </button>
        </div>
    </div>  

    <!-- Popup Container -->
    <div id="popupWindow" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3 id="popupTitle">Detail Perhitungan</h3>
            <div id="popupContent">
                <!-- Content will be filled dynamically -->
            </div>
        </div>
    </div>

    <script>
        function safeParseFloat(value) {
            const parsed = parseFloat(value);
            return isNaN(parsed) ? 0 : parsed;
        }

        function calculateUplink() {
            const axtxantenna_up = safeParseFloat(document.getElementById('axtxantenna_up').value);
            const axrxantenna_up = safeParseFloat(document.getElementById('axrxantenna_up').value);
            const degrees_up = safeParseFloat(document.getElementById('degrees_up').value);

            if (axtxantenna_up < 0 || axrxantenna_up < 0 || degrees_up < 0) {
                // Invalid input, clear outputs
                clearUplinkOutputs();
                return;
            }

            const axialratio1_up = Math.pow(10, axtxantenna_up / 20);
            const axialratio2_up = Math.pow(10, axrxantenna_up / 20);
            const radians_up = degrees_up * (Math.PI / 180);

            // Calculate polarizationloss_up according to formula, handle divide by zero if occurs
            const numerator = (1 - Math.pow(axialratio1_up, 2)) * (1 - Math.pow(axialratio2_up, 2)) * Math.cos(2 * radians_up) + 4 * axialratio1_up * axialratio2_up;
            const denominator = (1 + Math.pow(axialratio1_up, 2)) * (1 + Math.pow(axialratio2_up, 2));

            let polarizationloss_up = 0.5 * (1 + numerator / denominator);
            polarizationloss_up = Math.min(Math.max(polarizationloss_up, 1e-12), 1); // clamp to avoid log of zero or negative

            const hasilpolarizationloss_up = -10 * Math.log10(polarizationloss_up);
            const crosspolpowerfraction_up = 1 - polarizationloss_up;
            const dbcrosspolpowerfraction_up = 10 * Math.log10(crosspolpowerfraction_up > 0 ? crosspolpowerfraction_up : 1e-12);
            const crosspolarizationisolation_up = hasilpolarizationloss_up - dbcrosspolpowerfraction_up;

            document.getElementById('axialratio1_up').value = axialratio1_up.toFixed(4);
            document.getElementById('axialratio2_up').value = axialratio2_up.toFixed(4);
            document.getElementById('radians_up').value = radians_up.toFixed(4);
            document.getElementById('polarizationloss_up').value = polarizationloss_up.toFixed(6);
            document.getElementById('hasilpolarizationloss_up').value = hasilpolarizationloss_up.toFixed(4);
            document.getElementById('crosspolpowerfraction_up').value = crosspolpowerfraction_up.toFixed(6);
            document.getElementById('dbcrosspolpowerfraction_up').value = dbcrosspolpowerfraction_up.toFixed(4);
            document.getElementById('crosspolarizationisolation_up').value = crosspolarizationisolation_up.toFixed(4);
        }

        function clearUplinkOutputs() {
            const ids = ['axialratio1_up','axialratio2_up','radians_up','polarizationloss_up','hasilpolarizationloss_up','crosspolpowerfraction_up','dbcrosspolpowerfraction_up','crosspolarizationisolation_up'];
            ids.forEach(id => {
                document.getElementById(id).value = '';
            });
        }

        function calculateDownlink() {
            const axtxantenna_down = safeParseFloat(document.getElementById('axtxantenna_down').value);
            const axrxantenna_down = safeParseFloat(document.getElementById('axrxantenna_down').value);
            const degrees_down = safeParseFloat(document.getElementById('degrees_down').value);

            if (axtxantenna_down < 0 || axrxantenna_down < 0 || degrees_down < 0) {
                clearDownlinkOutputs();
                return;
            }

            const axialratio1_down = Math.pow(10, axtxantenna_down / 20);
            const axialratio2_down = Math.pow(10, axrxantenna_down / 20);
            const radians_down = degrees_down * (Math.PI / 180);

            const numerator = (1 - Math.pow(axialratio1_down, 2)) * (1 - Math.pow(axialratio2_down, 2)) * Math.cos(2 * radians_down) + 4 * axialratio1_down * axialratio2_down;
            const denominator = (1 + Math.pow(axialratio1_down, 2)) * (1 + Math.pow(axialratio2_down, 2));

            let polarizationloss_down = 0.5 * (1 + numerator / denominator);
            polarizationloss_down = Math.min(Math.max(polarizationloss_down, 1e-12), 1);

            const hasilpolarizationloss_down = -10 * Math.log10(polarizationloss_down);
            const crosspolpowerfraction_down = 1 - polarizationloss_down;
            const dbcrosspolpowerfraction_down = 10 * Math.log10(crosspolpowerfraction_down > 0 ? crosspolpowerfraction_down : 1e-12);
            const crosspolarizationisolation_down = hasilpolarizationloss_down - dbcrosspolpowerfraction_down;

            document.getElementById('axialratio1_down').value = axialratio1_down.toFixed(4);
            document.getElementById('axialratio2_down').value = axialratio2_down.toFixed(4);
            document.getElementById('radians_down').value = radians_down.toFixed(4);
            document.getElementById('polarizationloss_down').value = polarizationloss_down.toFixed(6);
            document.getElementById('hasilpolarizationloss_down').value = hasilpolarizationloss_down.toFixed(4);
            document.getElementById('crosspolpowerfraction_down').value = crosspolpowerfraction_down.toFixed(6);
            document.getElementById('dbcrosspolpowerfraction_down').value = dbcrosspolpowerfraction_down.toFixed(4);
            document.getElementById('crosspolarizationisolation_down').value = crosspolarizationisolation_down.toFixed(4);
        }

        function clearDownlinkOutputs() {
            const ids = ['axialratio1_down','axialratio2_down','radians_down','polarizationloss_down','hasilpolarizationloss_down','crosspolpowerfraction_down','dbcrosspolpowerfraction_down','crosspolarizationisolation_down'];
            ids.forEach(id => {
                document.getElementById(id).value = '';
            });
        }

        // Popup Functions
        function showPopup(title, content) {
            document.getElementById('popupTitle').textContent = title;
            document.getElementById('popupContent').innerHTML = content;
            document.getElementById('popupWindow').style.display = 'flex';
        }

        function hidePopup() {
            document.getElementById('popupWindow').style.display = 'none';
        }

        // Detail information for each field
        const detailContent = {
            // Uplink Details
            axialratio1_up: function() {
                const axtxantenna_up = safeParseFloat(document.getElementById('axtxantenna_up').value);
                const axialratio1_up = Math.pow(10, axtxantenna_up / 20);
                
                return `
                    <div class="code-block">Axial Ratio = 10<sup>(Axial Ratio in dB / 20)</sup></div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Axial ratio of Tx Antenna (Ant. #1) in dB = ${axtxantenna_up}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Axial Ratio = ${axialratio1_up.toFixed(4)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Axial ratio adalah perbandingan antara komponen major dan minor dari polarisasi elips. Nilai ini dihitung dari nilai axial ratio dalam dB, menggunakan rumus konversi.</p>
                        <p>Semakin mendekati 1, semakin mendekati polarisasi sirkular. Semakin besar nilainya, semakin mendekati polarisasi linear.</p>
                    </div>
                `;
            },
            axialratio2_up: function() {
                const axrxantenna_up = safeParseFloat(document.getElementById('axrxantenna_up').value);
                const axialratio2_up = Math.pow(10, axrxantenna_up / 20);
                
                return `
                    <div class="code-block">Axial Ratio = 10<sup>(Axial Ratio in dB / 20)</sup></div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Axial ratio of Rx Antenna (Ant. #2) in dB = ${axrxantenna_up}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Axial Ratio = ${axialratio2_up.toFixed(4)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Axial ratio adalah perbandingan antara komponen major dan minor dari polarisasi elips. Nilai ini dihitung dari nilai axial ratio dalam dB, menggunakan rumus konversi.</p>
                        <p>Semakin mendekati 1, semakin mendekati polarisasi sirkular. Semakin besar nilainya, semakin mendekati polarisasi linear.</p>
                    </div>
                `;
            },
            radians_up: function() {
                const degrees_up = safeParseFloat(document.getElementById('degrees_up').value);
                const radians_up = degrees_up * (Math.PI / 180);
                
                return `
                    <div class="code-block">Radians = Degrees × (π / 180)</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Polarization Angle θ (Degrees) = ${degrees_up}°</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Polarization Angle θ (Radians) = ${radians_up.toFixed(4)} rad</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi sudut polarisasi dari derajat ke radian untuk digunakan dalam perhitungan matematis. Konversi ini menggunakan rumus:</p>
                        <p>Sudut polarisasi adalah sudut antara dua antena yang mempengaruhi seberapa baik mereka dapat berkomunikasi. Sudut 0° berarti polarisasi sempurna, sementara 90° berarti polarisasi yang sepenuhnya cross-polarized.</p>
                    </div>
                `;
            },
            polarizationloss_up: function() {
                const axtxantenna_up = safeParseFloat(document.getElementById('axtxantenna_up').value);
                const axrxantenna_up = safeParseFloat(document.getElementById('axrxantenna_up').value);
                const degrees_up = safeParseFloat(document.getElementById('degrees_up').value);
                
                const axialratio1_up = Math.pow(10, axtxantenna_up / 20);
                const axialratio2_up = Math.pow(10, axrxantenna_up / 20);
                const radians_up = degrees_up * (Math.PI / 180);
                
                const numerator = (1 - Math.pow(axialratio1_up, 2)) * (1 - Math.pow(axialratio2_up, 2)) * Math.cos(2 * radians_up) + 4 * axialratio1_up * axialratio2_up;
                const denominator = (1 + Math.pow(axialratio1_up, 2)) * (1 + Math.pow(axialratio2_up, 2));
                const polarizationloss_up = 0.5 * (1 + numerator / denominator);
                
                return `
                    <div class="code-block">PL = 0.5 × (1 + [(1-r₁²)(1-r₂²)cos(2θ) + 4r₁r₂] / [(1+r₁²)(1+r₂²)])</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Axial Ratio (Ant. #1) = ${axialratio1_up.toFixed(4)}</p>
                        <p>Axial Ratio (Ant. #2) = ${axialratio2_up.toFixed(4)}</p>
                        <p>Polarization Angle θ (Radians) = ${radians_up.toFixed(4)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Polarization Loss = ${polarizationloss_up.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Polarization Loss menunjukkan seberapa baik dua antena dengan polarisasi berbeda dapat berkomunikasi. Nilai ini dihitung menggunakan rumus:</p>
                        <p>di mana:</p>
                        <p>r₁ = Axial Ratio antena #1</p>
                        <p>r₂ = Axial Ratio antena #2</p>
                        <p>θ = Sudut polarisasi (dalam radian)</p>
                        <p>Nilai ini berkisar antara 0 dan 1, di mana 1 menunjukkan tidak ada kerugian polarisasi dan 0 menunjukkan kerugian polarisasi total.</p>
                    </div>
                `;
            },
            hasilpolarizationloss_up: function() {
                const polarizationloss_up = safeParseFloat(document.getElementById('polarizationloss_up').value);
                const hasilpolarizationloss_up = -10 * Math.log10(polarizationloss_up);
                
                return `
                    <div class="code-block">PL (dB) = -10 × log₁₀(PL)</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Polarization Loss = ${polarizationloss_up.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Polarization Loss (dB) = ${hasilpolarizationloss_up.toFixed(4)} dB</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi polarization loss dari nilai linear ke desibel (dB) untuk memudahkan perbandingan dan analisis. Konversi menggunakan rumus:</p>
                        <p>Nilai dalam dB akan negatif karena polarisasi loss mewakili pengurangan daya. Semakin besar nilai negatifnya, semakin besar kerugian polarisasi.</p>
                    </div>
                `;
            },
            crosspolpowerfraction_up: function() {
                const polarizationloss_up = safeParseFloat(document.getElementById('polarizationloss_up').value);
                const crosspolpowerfraction_up = 1 - polarizationloss_up;
                
                return `
                    <div class="code-block">Cross Pol. Power Fraction = 1 - Polarization Loss</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Polarization Loss = ${polarizationloss_up.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Cross Pol. Power Fraction = ${crosspolpowerfraction_up.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Cross Polarization Power Fraction adalah fraksi daya yang ditransfer ke polarisasi yang berlawanan. Ini dihitung sebagai:</p>
                        <p>Nilai ini berkisar antara 0 dan 1, di mana 0 berarti tidak ada transfer daya ke polarisasi silang, dan 1 berarti semua daya ditransfer ke polarisasi silang.</p>
                    </div>
                `;
            },
            dbcrosspolpowerfraction_up: function() {
                const crosspolpowerfraction_up = safeParseFloat(document.getElementById('crosspolpowerfraction_up').value);
                const dbcrosspolpowerfraction_up = 10 * Math.log10(crosspolpowerfraction_up > 0 ? crosspolpowerfraction_up : 1e-12);
                
                return `
                    <div class="code-block">Cross Pol. Power Fraction (dB) = 10 × log₁₀(Cross Pol. Power Fraction)</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Cross Pol. Power Fraction = ${crosspolpowerfraction_up.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Cross Pol. Power Fraction (dB) = ${dbcrosspolpowerfraction_up.toFixed(4)} dB</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi Cross Polarization Power Fraction dari nilai linear ke desibel (dB). Konversi menggunakan rumus:</p>
                        <p>Nilai dalam dB biasanya negatif karena Cross Pol. Power Fraction biasanya kurang dari 1. Semakin rendah nilai dB-nya, semakin sedikit daya yang ditransfer ke polarisasi silang.</p>
                    </div>
                `;
            },
            crosspolarizationisolation_up: function() {
                const hasilpolarizationloss_up = safeParseFloat(document.getElementById('hasilpolarizationloss_up').value);
                const dbcrosspolpowerfraction_up = safeParseFloat(document.getElementById('dbcrosspolpowerfraction_up').value);
                const crosspolarizationisolation_up = hasilpolarizationloss_up - dbcrosspolpowerfraction_up;
                
                return `
                    <div class="code-block">XPI (dB) = Polarization Loss (dB) - Cross Pol. Power Fraction (dB)</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Polarization Loss (dB) = ${hasilpolarizationloss_up.toFixed(4)} dB</p>
                        <p>Cross Pol. Power Fraction (dB) = ${dbcrosspolpowerfraction_up.toFixed(4)} dB</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Cross Polarization Isolation (dB) = ${crosspolarizationisolation_up.toFixed(4)} dB</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Cross Polarization Isolation mengukur seberapa baik sebuah sistem dapat memisahkan sinyal dengan polarisasi yang berbeda. Ini dihitung sebagai:</p>
                        <p>Nilai yang lebih tinggi menunjukkan isolasi yang lebih baik antara polarisasi yang berbeda. Umumnya, nilai di atas 20 dB dianggap baik untuk sistem komunikasi satelit.</p>
                    </div>
                `;
            },
            
            // Downlink Details
            axialratio1_down: function() {
                const axtxantenna_down = safeParseFloat(document.getElementById('axtxantenna_down').value);
                const axialratio1_down = Math.pow(10, axtxantenna_down / 20);
                
                return `
                    <div class="code-block">Axial Ratio = 10<sup>(Axial Ratio in dB / 20)</sup></div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Axial ratio of Tx Antenna (Ant. #1) in dB = ${axtxantenna_down}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Axial Ratio = ${axialratio1_down.toFixed(4)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Axial ratio adalah perbandingan antara komponen major dan minor dari polarisasi elips. Nilai ini dihitung dari nilai axial ratio dalam dB, menggunakan rumus konversi.</p>
                        <p>Semakin mendekati 1, semakin mendekati polarisasi sirkular. Semakin besar nilainya, semakin mendekati polarisasi linear.</p>
                    </div>
                `;
            },
            axialratio2_down: function() {
                const axrxantenna_down = safeParseFloat(document.getElementById('axrxantenna_down').value);
                const axialratio2_down = Math.pow(10, axrxantenna_down / 20);
                
                return `
                    <div class="code-block">Axial Ratio = 10<sup>(Axial Ratio in dB / 20)</sup></div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Axial ratio of Rx Antenna (Ant. #2) in dB = ${axrxantenna_down}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Axial Ratio = ${axialratio2_down.toFixed(4)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Axial ratio adalah perbandingan antara komponen major dan minor dari polarisasi elips. Nilai ini dihitung dari nilai axial ratio dalam dB, menggunakan rumus konversi.</p>
                        <p>Semakin mendekati 1, semakin mendekati polarisasi sirkular. Semakin besar nilainya, semakin mendekati polarisasi linear.</p>
                    </div>
                `;
            },
            radians_down: function() {
                const degrees_down = safeParseFloat(document.getElementById('degrees_down').value);
                const radians_down = degrees_down * (Math.PI / 180);
                
                return `
                    <div class="code-block">Radians = Degrees × (π / 180)</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Polarization Angle θ (Degrees) = ${degrees_down}°</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Polarization Angle θ (Radians) = ${radians_down.toFixed(4)} rad</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi sudut polarisasi dari derajat ke radian untuk digunakan dalam perhitungan matematis. Konversi ini menggunakan rumus:</p>
                        <p>Sudut polarisasi adalah sudut antara dua antena yang mempengaruhi seberapa baik mereka dapat berkomunikasi. Sudut 0° berarti polarisasi sempurna, sementara 90° berarti polarisasi yang sepenuhnya cross-polarized.</p>
                    </div>
                `;
            },
            polarizationloss_down: function() {
                const axtxantenna_down = safeParseFloat(document.getElementById('axtxantenna_down').value);
                const axrxantenna_down = safeParseFloat(document.getElementById('axrxantenna_down').value);
                const degrees_down = safeParseFloat(document.getElementById('degrees_down').value);
                
                const axialratio1_down = Math.pow(10, axtxantenna_down / 20);
                const axialratio2_down = Math.pow(10, axrxantenna_down / 20);
                const radians_down = degrees_down * (Math.PI / 180);
                
                const numerator = (1 - Math.pow(axialratio1_down, 2)) * (1 - Math.pow(axialratio2_down, 2)) * Math.cos(2 * radians_down) + 4 * axialratio1_down * axialratio2_down;
                const denominator = (1 + Math.pow(axialratio1_down, 2)) * (1 + Math.pow(axialratio2_down, 2));
                const polarizationloss_down = 0.5 * (1 + numerator / denominator);
                
                return `
                    <div class="code-block">PL = 0.5 × (1 + [(1-r₁²)(1-r₂²)cos(2θ) + 4r₁r₂] / [(1+r₁²)(1+r₂²)])</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Axial Ratio (Ant. #1) = ${axialratio1_down.toFixed(4)}</p>
                        <p>Axial Ratio (Ant. #2) = ${axialratio2_down.toFixed(4)}</p>
                        <p>Polarization Angle θ (Radians) = ${radians_down.toFixed(4)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Polarization Loss = ${polarizationloss_down.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Polarization Loss menunjukkan seberapa baik dua antena dengan polarisasi berbeda dapat berkomunikasi. Nilai ini dihitung menggunakan rumus:</p>
                        <p>di mana:</p>
                        <p>r₁ = Axial Ratio antena #1</p>
                        <p>r₂ = Axial Ratio antena #2</p>
                        <p>θ = Sudut polarisasi (dalam radian)</p>
                        <p>Nilai ini berkisar antara 0 dan 1, di mana 1 menunjukkan tidak ada kerugian polarisasi dan 0 menunjukkan kerugian polarisasi total.</p>
                    </div>
                `;
            },
            hasilpolarizationloss_down: function() {
                const polarizationloss_down = safeParseFloat(document.getElementById('polarizationloss_down').value);
                const hasilpolarizationloss_down = -10 * Math.log10(polarizationloss_down);
                
                return `
                    <div class="code-block">PL (dB) = -10 × log₁₀(PL)</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Polarization Loss = ${polarizationloss_down.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Polarization Loss (dB) = ${hasilpolarizationloss_down.toFixed(4)} dB</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi polarization loss dari nilai linear ke desibel (dB) untuk memudahkan perbandingan dan analisis. Konversi menggunakan rumus:</p>
                        <p>Nilai dalam dB akan negatif karena polarisasi loss mewakili pengurangan daya. Semakin besar nilai negatifnya, semakin besar kerugian polarisasi.</p>
                    </div>
                `;
            },
            crosspolpowerfraction_down: function() {
                const polarizationloss_down = safeParseFloat(document.getElementById('polarizationloss_down').value);
                const crosspolpowerfraction_down = 1 - polarizationloss_down;
                
                return `
                    <div class="code-block">Cross Pol. Power Fraction = 1 - Polarization Loss</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Polarization Loss = ${polarizationloss_down.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Cross Pol. Power Fraction = ${crosspolpowerfraction_down.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Cross Polarization Power Fraction adalah fraksi daya yang ditransfer ke polarisasi yang berlawanan. Ini dihitung sebagai:</p>
                        <p>Nilai ini berkisar antara 0 dan 1, di mana 0 berarti tidak ada transfer daya ke polarisasi silang, dan 1 berarti semua daya ditransfer ke polarisasi silang.</p>
                    </div>
                `;
            },
            dbcrosspolpowerfraction_down: function() {
                const crosspolpowerfraction_down = safeParseFloat(document.getElementById('crosspolpowerfraction_down').value);
                const dbcrosspolpowerfraction_down = 10 * Math.log10(crosspolpowerfraction_down > 0 ? crosspolpowerfraction_down : 1e-12);
                
                return `
                    <div class="code-block">Cross Pol. Power Fraction (dB) = 10 × log₁₀(Cross Pol. Power Fraction)</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Cross Pol. Power Fraction = ${crosspolpowerfraction_down.toFixed(6)}</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Cross Pol. Power Fraction (dB) = ${dbcrosspolpowerfraction_down.toFixed(4)} dB</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Penjelasan:</div>
                        <p>Konversi Cross Polarization Power Fraction dari nilai linear ke desibel (dB). Konversi menggunakan rumus:</p>
                        <p>Nilai dalam dB biasanya negatif karena Cross Pol. Power Fraction biasanya kurang dari 1. Semakin rendah nilai dB-nya, semakin sedikit daya yang ditransfer ke polarisasi silang.</p>
                    </div>
                `;
            },
            crosspolarizationisolation_down: function() {
                const hasilpolarizationloss_down = safeParseFloat(document.getElementById('hasilpolarizationloss_down').value);
                const dbcrosspolpowerfraction_down = safeParseFloat(document.getElementById('dbcrosspolpowerfraction_down').value);
                const crosspolarizationisolation_down = hasilpolarizationloss_down - dbcrosspolpowerfraction_down;
                
                return `
                    <div class="code-block">XPI (dB) = Polarization Loss (dB) - Cross Pol. Power Fraction (dB)</div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Nilai Input:</div>
                        <p>Polarization Loss (dB) = ${hasilpolarizationloss_down.toFixed(4)} dB</p>
                        <p>Cross Pol. Power Fraction (dB) = ${dbcrosspolpowerfraction_down.toFixed(4)} dB</p>
                    </div>
                    
                    <div class="popup-section">
                        <div class="popup-section-title">Hasil Perhitungan:</div>
                        <p>Cross Polarization Isolation (dB) = ${crosspolarizationisolation_down.toFixed(4)} dB</p>
                    </div>
                    
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
                const fieldLabel = document.querySelector(`label[for="${fieldId}"]`) || 
                                  document.querySelector(`label:has(+ input#${fieldId})`) ||
                                  { textContent: fieldId };
                const title = fieldLabel.textContent.trim();
                
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
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            position: relative;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 550px;
            max-height: 85vh;
            overflow-y: auto;
        }

        .close-popup-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            font-weight: bold;
            color: #666;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            line-height: 1;
        }

        .close-popup-btn:hover {
            color: #000;
        }

        #popupTitle {
            font-size: 1.2rem;
            margin-top: 0;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 15px;
        }

        .code-block {
            background-color: #f5f5f5;
            padding: 12px 15px;
            border-radius: 5px;
            border-left: 4px solid #4caf50;
            margin: 15px 0;
            font-family: monospace;
            white-space: pre-wrap;
            overflow-x: auto;
            font-weight: 500;
        }

        .popup-content h3 {
            font-size: 1.1rem;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #333;
        }

        .popup-section {
            margin-bottom: 20px;
        }

        .popup-section-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .popup-content p {
            margin: 8px 0;
            line-height: 1.6;
            color: #333;
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
    </style>
</x-layout>