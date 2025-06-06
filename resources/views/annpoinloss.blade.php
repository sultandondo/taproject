<x-layout>
    <x-slot:title>Antenna Pointing Loss</x-slot>
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="fas fa-satellite-dish mr-2 text-blue-600"></i> Perhitungan Parameter Antenna Pointing Loss
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Masukkan parameter Antenna Pointing Loss untuk uplink dan downlink.
            </p>

            <h2 class="text-2xl font-bold mb-6 text-center text-black-600">Uplink Antenna Sistem</h2>
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <form method="POST" action="{{ route('annpoinloss.store', ['id' => $dataId]) }}" id="antennaForm_poin">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="mb-8">
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700 text-lg">Ground Station (Uplink):</label>
                        </div>

                        <div class="mb-6">
                            <label for="jenis_polarizationgrounds_up_poin" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                            <select name="jenis_polarizationgrounds_up_poin" id="jenis_polarizationgrounds_up_poin" onchange="handlePolarizationChange('grounds', 'up')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                                <option value="RHCP">RHCP</option>
                                <option value="LHCP">LHCP</option>
                                <option value="Linear">Linear</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Frekuensi Uplink (MHz):</label>
                            <input type="number" name="frequency_upgrounds_poin" id="frequency_upgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.01" value="" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ) (m):</label>
                            <input type="number" name="wavelength_upgrounds_poin" id="wavelength_upgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.001" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" value="">
                            <button type="button" onclick="showWavelengthDetail('up')" class="text-blue-500 mt-2">Lihat Detail Perhitungan</button>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Gain Antena (dBiC):</label>
                            <input type="number" name="gain_upgrounds_poin" id="gain_upgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain antena dari perhitungan sebelumnya" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                            <input type="number" name="beamwidth_upgrounds_poin" id="beamwidth_upgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dari perhitungan sebelumnya" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Estimated Pointing Error (θ1) (°):</label>
                            <input type="number" name="estimedpointingerror_upgrounds_θ1_poin" id="estimedpointingerror_upgrounds_θ1_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan estimasi kesalahan pointing dalam derajat" required>
                        </div>

                        <div class="mb-4">
                            <label for="approxannpoinloss_upgrounds_poin" class="block font-medium mb-1 text-gray-700">Approx. Antenna Pointing Loss (dB):</label>
                            <input type="text" name="approxannpoinloss_upgrounds_poin" id="approxannpoinloss_upgrounds_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                            <button type="button" onclick="showPointingLossDetail('upgrounds')" class="text-blue-500 mt-2">Lihat Detail Perhitungan</button>
                        </div>

                        <div class="mb-4">
                            <label for="annrolloff_upgrounds_poin" class="block font-medium mb-1 text-gray-700">Antenna Roll-Off (dB):</label>
                            <input type="text" name="annrolloff_upgrounds_poin" id="annrolloff_upgrounds_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                            <button type="button" onclick="showRollOffDetail('upgrounds')" class="text-blue-500 mt-2">Lihat Detail Perhitungan</button>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700 text-lg">Wahana Antariksa (Uplink):</label>
                        </div>
                        <div class="mb-6">
                            <label for="jenis_polarizationspacecraft_up_poin" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                            <select name="jenis_polarizationspacecraft_up_poin" id="jenis_polarizationspacecraft_up_poin" onchange="handlePolarizationChange('spacecraft', 'up')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                                <option value="RHCP">RHCP</option>
                                <option value="LHCP">LHCP</option>
                                <option value="Linear">Linear</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Gain Antena (dBiC):</label>
                            <input type="number" name="gain_upspacecraft_poin" id="gain_upspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain antena dari perhitungan sebelumnya" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                            <input type="number" name="beamwidth_upspacecraft_poin" id="beamwidth_upspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dari perhitungan sebelumnya" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Angle between S/C antenna symmetry axis and vector from S/C to gnd. station (θ2) (°):</label>
                            <input type="number" name="upspacecraft_θ2_poin" id="upspacecraft_θ2_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan sudut dalam derajat" required>
                        </div>

                        <div class="mb-4">
                            <label for="approxannpoinloss_upspacecraft_poin" class="block font-medium mb-1 text-gray-700">Approx. Antenna Pointing Loss (dB):</label>
                            <input type="text" name="approxannpoinloss_upspacecraft_poin" id="approxannpoinloss_upspacecraft_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                            <button type="button" onclick="showPointingLossDetail('upspacecraft')" class="text-blue-500 mt-2">Lihat Detail Perhitungan</button>
                        </div>

                        <div class="mb-4">
                            <label for="calculation_formulas_upspacecraft_poin" class="block font-medium mb-1 text-gray-700">Calculation Formulas:</label>
                            <input type="text" name="calculation_formulas_upspacecraft_poin" id="calculation_formulas_upspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" placeholder="Rumus perhitungan akan ditampilkan di sini">
                            <button type="button" onclick="showCalculationFormulasDetail('upspacecraft')" class="text-blue-500 mt-2">Lihat Detail</button>
                        </div>
                    </div>

                    <div id="polarization_warning_up_poin" class="mb-6" style="display: none;">
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Peringatan Ketidaksesuaian Polarisasi (Uplink)</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p id="polarization_warning_text_up_poin"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <h2 class="text-2xl font-bold mb-6 text-center text-black-600">Downlink Antenna Sistem</h2>
            <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                <div class="mb-8">
                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700 text-lg">Ground Station (Downlink):</label>
                    </div>

                    <div class="mb-6">
                        <label for="jenis_polarizationgrounds_down_poin" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                        <select name="jenis_polarizationgrounds_down_poin" id="jenis_polarizationgrounds_down_poin" onchange="handlePolarizationChange('grounds', 'down')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="RHCP">RHCP</option>
                            <option value="LHCP">LHCP</option>
                            <option value="Linear">Linear</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Frekuensi Downlink (MHz):</label>
                        <input type="number" name="frequency_downgrounds_poin" id="frequency_downgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.01" value="" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ) (m):</label>
                        <input type="number" name="wavelength_downgrounds_poin" id="wavelength_downgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" step="0.001" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" value="">
                        <button type="button" onclick="showWavelengthDetail('down')" class="text-blue-500 mt-2">Lihat Detail Perhitungan</button>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Gain Antena (dBiC):</label>
                        <input type="number" name="gain_downgrounds_poin" id="gain_downgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain antena dari perhitungan sebelumnya" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                        <input type="number" name="beamwidth_downgrounds_poin" id="beamwidth_downgrounds_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dari perhitungan sebelumnya" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Angle between S/C antenna symmetry axis and vector from S/C to gnd. station (θ3) (°):</label>
                        <input type="number" name="upgrounds_θ3_poin" id="upgrounds_θ3_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan sudut dalam derajat" required>
                    </div>

                    <div class="mb-4">
                        <label for="approxannpoinloss_downgrounds_poin" class="block font-medium mb-1 text-gray-700">Approx. Antenna Pointing Loss (dB):</label>
                        <input type="text" name="approxannpoinloss_downgrounds_poin" id="approxannpoinloss_downgrounds_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        <button type="button" onclick="showPointingLossDetail('downgrounds')" class="text-blue-500 mt-2">Lihat Detail Perhitungan</button>
                    </div>

                    <div class="mb-4">
                        <label for="annrolloff_downgrounds_poin" class="block font-medium mb-1 text-gray-700">Antenna Roll-Off (dB):</label>
                        <input type="text" name="annrolloff_downgrounds_poin" id="annrolloff_downgrounds_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        <button type="button" onclick="showRollOffDetail('downgrounds')" class="text-blue-500 mt-2">Lihat Detail Perhitungan</button>
                    </div>
                </div>

                <div class="mb-8">
                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700 text-lg">Wahana Antariksa (Downlink):</label>
                    </div>

                    <div class="mb-6">
                        <label for="jenis_polarizationspacecraft_down_poin" class="block font-medium mb-2 text-gray-700">Jenis Polarisasi:</label>
                        <select name="jenis_polarizationspacecraft_down_poin" id="jenis_polarizationspacecraft_down_poin" onchange="handlePolarizationChange('spacecraft', 'down')" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                            <option value="RHCP">RHCP</option>
                            <option value="LHCP">LHCP</option>
                            <option value="Linear">Linear</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Gain Antena (dBiC):</label>
                        <input type="number" name="gain_downspacecraft_poin" id="gain_downspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan gain antena dari perhitungan sebelumnya" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Beamwidth (°):</label>
                        <input type="number" name="beamwidth_downspacecraft_poin" id="beamwidth_downspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan beamwidth dari perhitungan sebelumnya" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-1 text-gray-700">Estimated Pointing Error (θ4) (°):</label>
                        <input type="number" name="downspacecraft_θ4_poin" id="downspacecraft_θ4_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" step="0.01" placeholder="Masukkan estimasi kesalahan pointing dalam derajat" required>
                    </div>

                    <div class="mb-4">
                        <label for="approxannpoinloss_downspacecraft_poin" class="block font-medium mb-1 text-gray-700">Approx. Antenna Pointing Loss (dB):</label>
                        <input type="text" name="approxannpoinloss_downspacecraft_poin" id="approxannpoinloss_downspacecraft_poin" step="0.01" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        <button type="button" onclick="showPointingLossDetail('downspacecraft')" class="text-blue-500 mt-2">Lihat Detail Perhitungan</button>
                    </div>

                    <div class="mb-4">
                        <label for="calculation_formulas_downspacecraft_poin" class="block font-medium mb-1 text-gray-700">Calculation Formulas:</label>
                        <input type="text" name="calculation_formulas_downspacecraft_poin" id="calculation_formulas_downspacecraft_poin" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" placeholder="Rumus perhitungan akan ditampilkan di sini">
                        <button type="button" onclick="showCalculationFormulasDetail('downspacecraft')" class="text-blue-500 mt-2">Lihat Detail</button>
                    </div>
                </div>

                <div id="polarization_warning_down_poin" class="mb-6" style="display: none;">
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Peringatan Ketidaksesuaian Polarisasi (Downlink)</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p id="polarization_warning_text_down_poin"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg w-full transition duration-150 ease-in-out">
                    Hitung & Simpan Parameter Antenna Pointing Loss
                </button>
            </div>
        </div>
    </div>

    <div id="wavelengthPopup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn" onclick="closeWavelengthPopup()">&times;</span>
            <h3 id="wavelength-popup-title">Detail Perhitungan Panjang Gelombang</h3>
            <div id="wavelength-popup-content-body">
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    λ = c / f<br>
                    Dimana:<br>
                    λ = Panjang gelombang (meter)<br>
                    c = Kecepatan cahaya (~300.000.000 m/s)<br>
                    f = Frekuensi (Hz)
                </div>
                <div class="input-values">
                    <strong>Nilai Input:</strong><br>
                    <span id="freq-input-display">Frekuensi = Belum diisi MHz</span>
                </div>
                <div class="result-values">
                    <strong>Hasil Perhitungan:</strong><br>
                    <span id="wavelength-result-display">Panjang Gelombang (λ) = Belum dihitung meter</span>
                </div>
                <p><strong>Penjelasan:</strong><br>
                Panjang gelombang adalah jarak antara titik-titik yang berurutan dari suatu gelombang yang memiliki fasa yang sama. Parameter ini sangat penting dalam desain antena karena dimensi fisik antena seringkali merupakan kelipatan dari panjang gelombang.</p>
            </div>
        </div>
    </div>

    <div id="rollOffPopup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn" onclick="closeRollOffPopup()">&times;</span>
            <h3 id="roll-off-popup-title">Detail Perhitungan Antenna Roll-Off</h3>
            <div id="roll-off-popup-content-body">
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Roll-Off = -25log(θ/θ3dB)<br>
                    Dimana:<br>
                    θ = Sudut off-axis (derajat)<br>
                    θ3dB = Half-power beamwidth (derajat)<br>
                    Roll-Off = Antenna roll-off loss (dB)
                </div>
                <div class="input-values">
                    <strong>Nilai Input:</strong><br>
                    <span id="roll-off-angle-display">Sudut = Belum diisi °</span><br>
                    <span id="roll-off-beamwidth-display">Beamwidth = Belum diisi °</span>
                </div>
                <div class="result-values">
                    <strong>Hasil Perhitungan:</strong><br>
                    <span id="roll-off-result-display">Antenna Roll-Off = Belum dihitung dB</span>
                </div>
                <p><strong>Penjelasan:</strong><br>
                Antenna roll-off menggambarkan penurunan gain antena ketika sinyal datang dari arah yang tidak tepat pada axis utama antena. Berbeda dengan pointing loss, roll-off lebih menggambarkan karakteristik pola radiasi antena.</p>
            </div>
        </div>
    </div>
    <div id="pointingLossPopup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn" onclick="closePointingLossPopup()">&times;</span>
            <h3 id="pointing-loss-popup-title">Detail Perhitungan Antenna Pointing Loss</h3>
            <div id="pointing-loss-popup-content-body">
                <div class="formula">
                    <strong>Rumus Perhitungan:</strong><br>
                    Loss = -12 × (θ / θ3dB)²<br>
                    Dimana:<br>
                    θ = Sudut pointing error (derajat)<br>
                    θ3dB = Half-power beamwidth (derajat)<br>
                    Loss = Antenna pointing loss (dB)
                </div>
                <div class="input-values">
                    <strong>Nilai Input:</strong><br>
                    <span id="pointing-error-display">Pointing Error = Belum diisi °</span><br>
                    <span id="beamwidth-display">Beamwidth = Belum diisi °</span>
                </div>
                <div class="result-values">
                    <strong>Hasil Perhitungan:</strong><br>
                    <span id="pointing-loss-result-display">Antenna Pointing Loss = Belum dihitung dB</span>
                </div>
                <p><strong>Penjelasan:</strong><br>
                Antenna pointing loss terjadi ketika antena tidak diarahkan tepat ke target. Semakin besar sudut kesalahan pointing dibandingkan dengan beamwidth antena, semakin besar loss yang terjadi.</p>
            </div>
        </div>
    </div>

    <style>
        .popup-window { 
            display: none; 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background-color: rgba(0,0,0,0.7); 
            z-index: 1000; 
            justify-content: center; 
            align-items: center; 
        }
        .popup-content { 
            position: relative; 
            background-color: white; 
            padding: 20px 30px 30px 30px; 
            border-radius: 8px; 
            box-shadow: 0 0 20px rgba(0,0,0,0.3); 
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
            overflow-wrap: break-word; 
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
        .input-values { 
            background-color: #e3f2fd; 
            padding: 10px 15px; 
            border-radius: 5px; 
            border-left: 4px solid #2196F3; 
            margin: 15px 0; 
        }
        .result-values { 
            background-color: #e8f5e8; 
            padding: 10px 15px; 
            border-radius: 5px; 
            border-left: 4px solid #4CAF50; 
            margin: 15px 0; 
        }
    </style>

    <script>
        // Fungsi untuk menghitung panjang gelombang
        function calculateWavelength(linkDirection) {
            const freqField = document.getElementById(`frequency_${linkDirection}grounds_poin`);
            const wavelengthField = document.getElementById(`wavelength_${linkDirection}grounds_poin`);
            if (!freqField || !wavelengthField) return;

            const frequency = parseFloat(freqField.value);
            if (!isNaN(frequency) && frequency > 0) {
                const wavelength = 300 / frequency; // c = 300 Mm/s (kecepatan cahaya disesuaikan untuk f dalam MHz)
                wavelengthField.value = wavelength.toFixed(6);
            } else {
                wavelengthField.value = '';
            }
        }

        // Fungsi untuk menghitung antenna pointing loss
        function calculatePointingLoss(section) {
            let pointingErrorField, beamwidthField, lossField;
            
            if (section === 'upgrounds') {
                pointingErrorField = document.getElementById('estimedpointingerror_upgrounds_θ1_poin');
                beamwidthField = document.getElementById('beamwidth_upgrounds_poin');
                lossField = document.getElementById('approxannpoinloss_upgrounds_poin');
            } else if (section === 'upspacecraft') {
                pointingErrorField = document.getElementById('upspacecraft_θ2_poin');
                beamwidthField = document.getElementById('beamwidth_upspacecraft_poin');
                lossField = document.getElementById('approxannpoinloss_upspacecraft_poin');
            } else if (section === 'downgrounds') {
                pointingErrorField = document.getElementById('upgrounds_θ3_poin');
                beamwidthField = document.getElementById('beamwidth_downgrounds_poin');
                lossField = document.getElementById('approxannpoinloss_downgrounds_poin');
            } else if (section === 'downspacecraft') {
                pointingErrorField = document.getElementById('downspacecraft_θ4_poin');
                beamwidthField = document.getElementById('beamwidth_downspacecraft_poin');
                lossField = document.getElementById('approxannpoinloss_downspacecraft_poin');
            }

            if (!pointingErrorField || !beamwidthField || !lossField) return;

            const pointingError = parseFloat(pointingErrorField.value);
            const beamwidth = parseFloat(beamwidthField.value);

            if (!isNaN(pointingError) && !isNaN(beamwidth) && beamwidth > 0) {
                // Formula: Loss = -12 * (θ / θ3dB)²
                const loss = -12 * Math.pow(pointingError / beamwidth, 2);
                lossField.value = loss.toFixed(3);
            } else {
                lossField.value = '';
            }
        }

        // Fungsi untuk menghitung antenna roll-off
        function calculateRollOff(section) {
            let angleField, beamwidthField, rollOffField;
            
            if (section === 'upgrounds') {
                angleField = document.getElementById('estimedpointingerror_upgrounds_θ1_poin');
                beamwidthField = document.getElementById('beamwidth_upgrounds_poin');
                rollOffField = document.getElementById('annrolloff_upgrounds_poin');
            } else if (section === 'downgrounds') {
                angleField = document.getElementById('upgrounds_θ3_poin');
                beamwidthField = document.getElementById('beamwidth_downgrounds_poin');
                rollOffField = document.getElementById('annrolloff_downgrounds_poin');
            }

            if (!angleField || !beamwidthField || !rollOffField) return;

            const angle = parseFloat(angleField.value);
            const beamwidth = parseFloat(beamwidthField.value);

            if (!isNaN(angle) && !isNaN(beamwidth) && beamwidth > 0) {
                // Formula: Roll-Off = -25 * log10(θ / θ3dB)
                const rollOff = -25 * Math.log10(angle / beamwidth);
                rollOffField.value = rollOff.toFixed(3);
            } else {
                rollOffField.value = '';
            }
        }

        // Fungsi untuk menampilkan detail calculation formulas
        function showCalculationFormulasDetail(section) {
            // Placeholder function - akan diimplementasikan nanti
            alert(`Detail calculation formulas untuk ${section} akan ditampilkan di sini`);
        }
        function showRollOffDetail(section) {
            let angleField, beamwidthField, rollOffField;
            
            if (section === 'upgrounds') {
                angleField = document.getElementById('estimedpointingerror_upgrounds_θ1_poin');
                beamwidthField = document.getElementById('beamwidth_upgrounds_poin');
                rollOffField = document.getElementById('annrolloff_upgrounds_poin');
            } else if (section === 'downgrounds') {
                angleField = document.getElementById('upgrounds_θ3_poin');
                beamwidthField = document.getElementById('beamwidth_downgrounds_poin');
                rollOffField = document.getElementById('annrolloff_downgrounds_poin');
            }
            
            const angleVal = angleField?.value || 'Belum diisi';
            const beamwidthVal = beamwidthField?.value || 'Belum diisi';
            const rollOffVal = rollOffField?.value || 'Belum dihitung';
            
            document.getElementById('roll-off-angle-display').textContent = `Sudut = ${angleVal} °`;
            document.getElementById('roll-off-beamwidth-display').textContent = `Beamwidth = ${beamwidthVal} °`;
            document.getElementById('roll-off-result-display').textContent = `Antenna Roll-Off = ${rollOffVal} dB`;
            
            document.getElementById('rollOffPopup').style.display = 'flex';
        }

        // Fungsi untuk menutup popup roll-off
        function closeRollOffPopup() {
            document.getElementById('rollOffPopup').style.display = 'none';
        }
        function showPointingLossDetail(section) {
            let pointingErrorField, beamwidthField, lossField;
            
            if (section === 'upgrounds') {
                pointingErrorField = document.getElementById('estimedpointingerror_upgrounds_θ1_poin');
                beamwidthField = document.getElementById('beamwidth_upgrounds_poin');
                lossField = document.getElementById('approxannpoinloss_upgrounds_poin');
            } else if (section === 'upspacecraft') {
                pointingErrorField = document.getElementById('upspacecraft_θ2_poin');
                beamwidthField = document.getElementById('beamwidth_upspacecraft_poin');
                lossField = document.getElementById('approxannpoinloss_upspacecraft_poin');
            } else if (section === 'downgrounds') {
                pointingErrorField = document.getElementById('upgrounds_θ3_poin');
                beamwidthField = document.getElementById('beamwidth_downgrounds_poin');
                lossField = document.getElementById('approxannpoinloss_downgrounds_poin');
            } else if (section === 'downspacecraft') {
                pointingErrorField = document.getElementById('downspacecraft_θ4_poin');
                beamwidthField = document.getElementById('beamwidth_downspacecraft_poin');
                lossField = document.getElementById('approxannpoinloss_downspacecraft_poin');
            }
            
            const pointingErrorVal = pointingErrorField?.value || 'Belum diisi';
            const beamwidthVal = beamwidthField?.value || 'Belum diisi';
            const lossVal = lossField?.value || 'Belum dihitung';
            
            document.getElementById('pointing-error-display').textContent = `Pointing Error = ${pointingErrorVal} °`;
            document.getElementById('beamwidth-display').textContent = `Beamwidth = ${beamwidthVal} °`;
            document.getElementById('pointing-loss-result-display').textContent = `Antenna Pointing Loss = ${lossVal} dB`;
            
            document.getElementById('pointingLossPopup').style.display = 'flex';
        }

        // Fungsi untuk menutup popup panjang gelombang
        function closeWavelengthPopup() {
            document.getElementById('wavelengthPopup').style.display = 'none';
        }

        // Fungsi untuk menutup popup pointing loss
        function closePointingLossPopup() {
            document.getElementById('pointingLossPopup').style.display = 'none';
        }

        // Fungsi untuk handle perubahan polarisasi
        function handlePolarizationChange(section, linkDirection) {
            checkPolarizationMismatch(linkDirection);
        }

        // Fungsi untuk mengecek ketidaksesuaian polarisasi
        function checkPolarizationMismatch(linkDirection) {
            const groundsPolarizationEl = document.getElementById(`jenis_polarizationgrounds_${linkDirection}_poin`);
            const spacecraftPolarizationEl = document.getElementById(`jenis_polarizationspacecraft_${linkDirection}_poin`);
            const warningDiv = document.getElementById(`polarization_warning_${linkDirection}_poin`);
            const warningText = document.getElementById(`polarization_warning_text_${linkDirection}_poin`);

            if (!groundsPolarizationEl || !spacecraftPolarizationEl || !warningDiv || !warningText) return;

            const groundsPolarization = groundsPolarizationEl.value;
            const spacecraftPolarization = spacecraftPolarizationEl.value;

            if (groundsPolarization && spacecraftPolarization && groundsPolarization !== spacecraftPolarization) {
                let lossAmount = '';
                let mismatchType = '';
                if ((groundsPolarization === 'RHCP' && spacecraftPolarization === 'LHCP') ||
                    (groundsPolarization === 'LHCP' && spacecraftPolarization === 'RHCP')) {
                    lossAmount = 'sangat tinggi (potensi >20 dB atau kehilangan sinyal total)';
                    mismatchType = 'Circular Mismatch (Beda Arah Putar)';
                } else if ((groundsPolarization === 'Linear' && (spacecraftPolarization === 'RHCP' || spacecraftPolarization === 'LHCP')) ||
                           ((groundsPolarization === 'RHCP' || groundsPolarization === 'LHCP') && spacecraftPolarization === 'Linear')) {
                    lossAmount = 'sekitar 3 dB';
                    mismatchType = 'Linear vs Circular Mismatch';
                } else {
                    lossAmount = 'tidak terdefinisi (kemungkinan tidak ada masalah jika salah satu tidak dipilih)';
                    mismatchType = 'Kombinasi Tidak Umum';
                }
                warningText.innerHTML = `<strong>${mismatchType}:</strong> Polarisasi Stasiun Bumi (${groundsPolarization}) dan Wahana Antariksa (${spacecraftPolarization}) tidak cocok. Ini dapat mengakibatkan kehilangan daya sinyal sebesar ${lossAmount}.`;
                warningDiv.style.display = 'block';
            } else {
                warningDiv.style.display = 'none';
            }
        }

        // Setup event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Initial setup
            ['up', 'down'].forEach(ld => {
                checkPolarizationMismatch(ld);
            });

            // Input frekuensi memicu kalkulasi panjang gelombang
            const freqUpgrounds = document.getElementById('frequency_upgrounds_poin');
            if (freqUpgrounds) {
                freqUpgrounds.addEventListener('input', () => calculateWavelength('up'));
            }
            const freqDowngrounds = document.getElementById('frequency_downgrounds_poin');
            if (freqDowngrounds) {
                freqDowngrounds.addEventListener('input', () => calculateWavelength('down'));
            }

            // Polarization change listeners
            const polarizationGroundsUp = document.getElementById('jenis_polarizationgrounds_up_poin');
            if (polarizationGroundsUp) {
                polarizationGroundsUp.addEventListener('change', () => handlePolarizationChange('grounds', 'up'));
            }
            const polarizationSpacecraftUp = document.getElementById('jenis_polarizationspacecraft_up_poin');
            if (polarizationSpacecraftUp) {
                polarizationSpacecraftUp.addEventListener('change', () => handlePolarizationChange('spacecraft', 'up'));
            }
            const polarizationGroundsDown = document.getElementById('jenis_polarizationgrounds_down_poin');
            if (polarizationGroundsDown) {
                polarizationGroundsDown.addEventListener('change', () => handlePolarizationChange('grounds', 'down'));
            }
            const polarizationSpacecraftDown = document.getElementById('jenis_polarizationspacecraft_down_poin');
            if (polarizationSpacecraftDown) {
                polarizationSpacecraftDown.addEventListener('change', () => handlePolarizationChange('spacecraft', 'down'));
            }

            // Event listeners for pointing loss and roll-off calculations (Uplink Ground Station)
            const estimedpointingerrorUpgrounds = document.getElementById('estimedpointingerror_upgrounds_θ1_poin');
            const beamwidthUpgrounds = document.getElementById('beamwidth_upgrounds_poin');
            if (estimedpointingerrorUpgrounds) {
                estimedpointingerrorUpgrounds.addEventListener('input', () => {
                    calculatePointingLoss('upgrounds');
                    calculateRollOff('upgrounds'); // Recalculate roll-off when pointing error changes
                });
            }
            if (beamwidthUpgrounds) {
                beamwidthUpgrounds.addEventListener('input', () => {
                    calculatePointingLoss('upgrounds');
                    calculateRollOff('upgrounds'); // Recalculate both when beamwidth changes
                });
            }

            // Event listeners for pointing loss (Uplink Spacecraft)
            const upspacecraftTheta2 = document.getElementById('upspacecraft_θ2_poin');
            const beamwidthUpspacecraft = document.getElementById('beamwidth_upspacecraft_poin');
            if (upspacecraftTheta2) {
                upspacecraftTheta2.addEventListener('input', () => calculatePointingLoss('upspacecraft'));
            }
            if (beamwidthUpspacecraft) {
                beamwidthUpspacecraft.addEventListener('input', () => calculatePointingLoss('upspacecraft'));
            }

            // Event listeners for pointing loss and roll-off calculations (Downlink Ground Station)
            const upgroundsTheta3 = document.getElementById('upgrounds_θ3_poin'); // This ID seems misnamed, it should probably be `estimedpointingerror_downgrounds_θ3_poin`
            const beamwidthDowngrounds = document.getElementById('beamwidth_downgrounds_poin');
            if (upgroundsTheta3) {
                upgroundsTheta3.addEventListener('input', () => {
                    calculatePointingLoss('downgrounds');
                    calculateRollOff('downgrounds'); // Recalculate roll-off when pointing error changes
                });
            }
            if (beamwidthDowngrounds) {
                beamwidthDowngrounds.addEventListener('input', () => {
                    calculatePointingLoss('downgrounds');
                    calculateRollOff('downgrounds'); // Recalculate both when beamwidth changes
                });
            }

            // Event listeners for pointing loss (Downlink Spacecraft)
            const downspacecraftTheta4 = document.getElementById('downspacecraft_θ4_poin');
            const beamwidthDownspacecraft = document.getElementById('beamwidth_downspacecraft_poin');
            if (downspacecraftTheta4) {
                downspacecraftTheta4.addEventListener('input', () => calculatePointingLoss('downspacecraft'));
            }
            if (beamwidthDownspacecraft) {
                beamwidthDownspacecraft.addEventListener('input', () => calculatePointingLoss('downspacecraft'));
            }


            // Form validation
            document.getElementById('antennaForm_poin').addEventListener('submit', function(e) {
                let formIsValid = true;
                const requiredFields = [
                    'frequency_upgrounds_poin',
                    'gain_upgrounds_poin',
                    'beamwidth_upgrounds_poin',
                    'estimedpointingerror_upgrounds_θ1_poin',
                    'gain_upspacecraft_poin',
                    'beamwidth_upspacecraft_poin',
                    'upspacecraft_θ2_poin',
                    'frequency_downgrounds_poin',
                    'gain_downgrounds_poin',
                    'beamwidth_downgrounds_poin',
                    'upgrounds_θ3_poin',
                    'gain_downspacecraft_poin',
                    'beamwidth_downspacecraft_poin',
                    'downspacecraft_θ4_poin'
                ];

                requiredFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (!field || !field.value || parseFloat(field.value) < 0) {
                        alert(`Mohon isi field ${fieldId.replace(/_/g, ' ')} dengan nilai yang valid!`);
                        e.preventDefault();
                        formIsValid = false;
                        return;
                    }
                });

                if (!formIsValid) return;

                // Validasi khusus untuk nilai beamwidth harus > 0
                const beamwidthFields = [
                    'beamwidth_upgrounds_poin',
                    'beamwidth_upspacecraft_poin',
                    'beamwidth_downgrounds_poin',
                    'beamwidth_downspacecraft_poin'
                ];

                beamwidthFields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    if (field && parseFloat(field.value) <= 0) {
                        alert(`Beamwidth harus lebih besar dari 0!`);
                        e.preventDefault();
                        formIsValid = false;
                        return;
                    }
                });
            });
        });

        // Tutup popup jika klik di luar konten atau tekan Escape
        document.addEventListener('click', function(e) {
            if (e.target.id === 'wavelengthPopup') {
                closeWavelengthPopup();
            }
            if (e.target.id === 'pointingLossPopup') {
                closePointingLossPopup();
            }
            if (e.target.id === 'rollOffPopup') {
                closeRollOffPopup();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeWavelengthPopup();
                closePointingLossPopup();
                closeRollOffPopup();
            }
        });
    </script>
</x-layout>