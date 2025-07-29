<x-layout>
    <x-slot:title>Atmospheric and Ionospheric Losses</x-slot:title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* Custom styles for animations and appearance from calc.blade.php */
        .input-unit {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280; /* gray-500 */
            font-size: 0.875rem; /* text-sm */
            pointer-events: none; /* Make sure it doesn't block input clicks */
            display: flex; /* Ensure the unit is vertically centered */
            align-items: center; /* Ensure the unit is vertically centered */
            height: 100%; /* Ensure the unit is vertically centered within its parent */
        }

        /* Styling for readonly inputs from calc.blade.php */
        input[readonly] {
            background-color: #e6f4e1; /* Lighter green */
            color: #166534; /* Darker green text */
            border-color: #81c784; /* Green border */
            cursor: not-allowed;
            font-weight: 500;
        }

        /* Ensure input focus styles are prominent from calc.blade.php */
        input[type="number"]:focus,
        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3B82F6; /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* blue-500 with opacity */
        }

        /* Adjust labels for full visibility when not in sections from calc.blade.php */
        .form-section-label {
            display: block;
            font-weight: bold;
            color: #1F2937; /* gray-800 */
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #E5E7EB; /* gray-200 */
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
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 800px;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            animation: fadeInScale 0.3s ease-out;
        }
        
        /* Gaya untuk header popup yang tidak akan menggulir */
        .popup-header {
            padding: 20px 30px 10px;
            border-bottom: 1px solid #eee;
            position: relative;
            flex-shrink: 0;
        }

        .popup-header h3 {
            margin-top: 0;
            color: #2c3e50;
            padding-bottom: 0;
        }

        /* Gaya untuk tombol tutup (X) */
        .close-popup-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: color 0.2s ease;
            z-index: 1001;
            background-color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .close-popup-btn:hover {
            color: #000;
        }

        /* Gaya untuk body popup yang akan menggulir */
        .popup-body {
            padding: 20px 30px 30px;
            overflow-y: auto;
            flex-grow: 1;
        }

        .formula {
            background-color: #f5f5f5;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
            margin: 15px 0;
            font-family: 'Cambria Math', 'Times New Roman', serif;
        }
        
        .popup-content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .popup-content th, .popup-content td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        
        .popup-content p {
            margin: 8px 0;
            line-height: 1.5;
            color: #374151;
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* Styling for the new explanation popup content */
        .explanation-content {
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
            color: #4A5568;
        }
        .explanation-content .section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }
        .explanation-content .section:last-child {
            border-bottom: none;
        }
        .explanation-content .section-title {
            color: #2C5282;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border-left: 5px solid #4299E1;
            padding-left: 1rem;
        }
        .explanation-content .section-content {
            text-align: justify;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }
        .explanation-content .param-title {
            color: #2D3748;
            font-size: 1rem;
            font-weight: 600;
            margin: 1.25rem 0 0.5rem 0;
        }
        .explanation-content .param-list {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }
        .explanation-content .param-list li {
            margin-bottom: 0.4rem;
            line-height: 1.6;
        }
    </style>

    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="text-blue-600"></i> Atmospheric & Ionospheric Losses
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Menghitung dan menentukan kehilangan atmosfer dan ionosfer berdasarkan sudut elevasi dan frekuensi.
            </p>

            {{-- "Apa itu Perhitungan Atmoss & Ionoss?" button --}}
            <div class="mb-6 text-right animate__animated animate__fadeInUp">
                <button type="button" id="info_atmoss_ionoss_general_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">
                    Apa itu Perhitungan Atmospheric & Ionospheric Losses? <i class="fas fa-info-circle ml-1"></i>
                </button>
            </div>

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 animate__animated animate__fadeIn">Loss due to Atmospheric Gases</h2>

            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-8 animate__animated animate__fadeInUp">
                <h3 class="text-lg font-bold text-center text-gray-800 mb-3">Tabel Kehilangan Atmosfer</h3>

                {{-- The table from the user's image --}}
                <div class="overflow-x-auto rounded-lg border border-gray-200 mb-6">
                    <table class="w-full text-sm text-gray-700">
                        <thead class="bg-blue-600 text-white text-center">
                            <tr>
                                <th rowspan="2" class="p-3 border-b border-r border-blue-400">Frequency (GHz)</th>
                                <th colspan="6" class="p-3 border-b border-blue-400">Elevation Angle</th>
                            </tr>
                            <tr>
                                <th class="p-3 border-r border-blue-400">0°</th>
                                <th class="p-3 border-r border-blue-400">5°</th>
                                <th class="p-3 border-r border-blue-400">10°</th>
                                <th class="p-3 border-r border-blue-400">30°</th>
                                <th class="p-3 border-r border-blue-400">45°</th>
                                <th class="p-3">90°</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-50 text-center">
                            @php
                                $atmosphericData = [
                                    ['freq' => 1000, 'loss' => [10.17, 2.14, 1.12, 0.39, 0.28, 0.03]],
                                    ['freq' => 2000, 'loss' => [10.88, 2.31, 1.22, 0.42, 0.30, 0.03]],
                                    ['freq' => 4000, 'loss' => [11.36, 2.19, 1.14, 0.40, 0.28, 0.04]],
                                    ['freq' => 6000, 'loss' => [11.76, 2.18, 1.13, 0.39, 0.28, 0.04]],
                                    ['freq' => 12000, 'loss' => [15.08, 2.44, 1.26, 0.44, 0.31, 0.06]],
                                    ['freq' => 15000, 'loss' => [19.43, 2.95, 1.51, 0.53, 0.37, 0.08]],
                                    ['freq' => 20000, 'loss' => [61.28, 8.73, 4.47, 1.55, 1.10, 0.28]],
                                    ['freq' => 30000, 'loss' => [50.64, 7.18, 3.68, 1.28, 0.90, 0.24]],
                                    ['freq' => 41000, 'loss' => [94.81, 14.53, 7.47, 2.59, 1.83, 0.41]],
                                ];
                            @endphp
                            @foreach ($atmosphericData as $row)
                            <tr>
                                <td class="p-3 border-r border-gray-200">{{ $row['freq'] }}</td>
                                @foreach ($row['loss'] as $loss)
                                <td class="p-3 border-r border-gray-200">{{ $loss }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <form method="POST" action="{{ route('attmosionos.store', ['id' => $dataId]) }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->id() ?? 1}}">

                    {{-- Atmospheric Uplink Section --}}
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">Atmospheric Losses (Uplink)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label for="uplink_atmospheric_frequency" class="block font-medium mb-2 text-gray-700">Frequency:</label>
                            <input
                                type="number"
                                name="uplink_atmospheric_frequency"
                                id="uplink_atmospheric_frequency"
                                step="0.1"
                                min="1"
                                max="41"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                value="{{ old('uplink_frequency', $data->frekuensi ?? '') }}"
                                required
                                oninput="updateUplinkAtmosphericLoss()"
                                placeholder="{{ $data->frekuensi?? '' }}" readonly>
                            
                            <span class="input-unit right-3">GHz</span>
                        </div>
                        <div class="relative">
                            <label for="uplink_min_elevation_angle" class="block font-medium mb-2 text-gray-700">Min. Elev. Angle:</label>
                            <input
                                type="number"
                                name="uplink_min_elevation_angle"
                                id="uplink_min_elevation_angle"
                                step="0.1"
                                min="0"
                                max="90"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                value="{{ old('uplink_min_elevation_angle', $data->uplink_min_elevation_angle ?? '') }}"
                                required
                                oninput="updateUplinkAtmosphericLoss()"
                                placeholder="Enter angle"
                            >
                            <span class="input-unit right-3">deg.</span>
                        </div>
                        <div class="relative col-span-1 md:col-span-2">
                            <label for="uplink_loss_determined_atmospheric" class="block font-medium mb-2 text-gray-700">Loss Determined:</label>
                            <input
                                type="text"
                                name="uplink_loss_determined_atmospheric"
                                id="uplink_loss_determined_atmospheric"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pr-16"
                                value="{{ old('uplink_loss_determined_atmospheric', $data->uplink_loss_determined_atmospheric ?? '') }}"
                                readonly
                            >
                            <button type="button" id="uplink_la_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            <span class="input-unit right-3">dB</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 my-6"></div>

                    {{-- Atmospheric Downlink Section --}}
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">Atmospheric Losses (Downlink)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label for="downlink_atmospheric_frequency" class="block font-medium mb-2 text-gray-700">Frequency:</label>
                            <input
                                type="number"
                                name="downlink_atmospheric_frequency"
                                id="downlink_atmospheric_frequency"
                                step="0.1"
                                min="1"
                                max="41"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                value="{{ old('downlink_frequency', $data->frekuensi_downlink ?? '') }}"
                                required
                                oninput="updateDownlinkAtmosphericLoss()"
                                placeholder="{{ $data->frekuensi_downlink?? '' }}" readonly>
                            
                            <span class="input-unit right-3">GHz</span>
                        </div>
                        <div class="relative">
                            <label for="downlink_min_elevation_angle" class="block font-medium mb-2 text-gray-700">Min. Elev. Angle:</label>
                            <input
                                type="number"
                                name="downlink_min_elevation_angle"
                                id="downlink_min_elevation_angle"
                                step="0.1"
                                min="0"
                                max="90"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                value="{{ old('downlink_min_elevation_angle', $data->downlink_min_elevation_angle ?? '') }}"
                                required
                                oninput="updateDownlinkAtmosphericLoss()"
                                placeholder="Enter angle"
                            >
                            <span class="input-unit right-3">deg.</span>
                        </div>
                        <div class="relative col-span-1 md:col-span-2">
                            <label for="downlink_loss_determined_atmospheric" class="block font-medium mb-2 text-gray-700">Loss Determined:</label>
                            <input
                                type="text"
                                name="downlink_loss_determined_atmospheric"
                                id="downlink_loss_determined_atmospheric"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pr-16"
                                value="{{ old('downlink_loss_determined_atmospheric', $data->downlink_loss_determined_atmospheric ?? '') }}"
                                readonly
                            >
                            <button type="button" id="downlink_la_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            <span class="input-unit right-3">dB</span>
                        </div>
                    </div>
                
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm animate__animated animate__fadeInLeft">
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">Loss due to Ionosphere:</h3>
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">(Uplink)</h3>

                    <div class="mb-4 bg-pink-100 text-gray-800 font-medium py-2 px-3 rounded border border-pink-200">
                        <div class="flex justify-between items-center mb-2">
                            <span>Uplink Loss Determined:</span>
                            <span id="uplink_loss_determined_display" class="border border-gray-300 p-3 w-24 rounded bg-gray-50 text-center font-bold"
                            style="background-color: #e6f4e1; color:rgb(22, 101, 52); border-color: #81c784;">{{ $data->uplink_loss_determined_display ?? '0.0' }} dB</span>
                        </div>
                        <div class="text-right">
                            <button type="button" id="uplink_detail_btn" class="text-blue-500 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-lg border border-gray-200 mb-4">
                        <div class="grid grid-cols-2 bg-blue-600 text-white font-bold py-2 text-sm text-center">
                            <div class="border-r border-blue-400">Frequency:</div>
                            <div>Loss:</div>
                        </div>

                        <div class="text-sm">
                            <div class="grid grid-cols-2">
                                <div class="py-2 bg-gray-50 border-r border-gray-200 relative">
                                    <input
                                        type="number"
                                        name="uplink_frequency"
                                        id="uplink_frequency"
                                        step="0.1"
                                        min="0"
                                        class="w-full bg-blue-100 border border-blue-300 rounded text-center focus:outline-none focus:ring-2 focus:ring-blue-500 p-2"
                                        value="{{ old('uplink_frequency', $data->frekuensi ?? '') }}"
                                        oninput="updateUplinkIonosphericLoss()"
                                        placeholder="{{ $data->frekuensi ?? '' }}" readonly>
                                    
                                    <span class="input-unit right-3">MHz</span>
                                </div>
                                <div class="py-2 bg-gray-50 relative">
                                    <input
                                        type="number"
                                        name="uplink_loss_ionosphere"
                                        id="uplink_loss_ionosphere"
                                        step="0.1"
                                        min="0"
                                        class="w-full bg-blue-100 border border-blue-300 rounded text-center focus:outline-none focus:ring-2 focus:ring-blue-500 p-2"
                                        value="{{ old('uplink_loss_ionosphere', $data->uplink_loss_ionosphere ?? '') }}"
                                        oninput="updateUplinkIonosphericLoss()"
                                        placeholder="Input Nilai Loss"
                                    >
                                    <span class="input-unit right-3">dB</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <div class="inline-flex items-center bg-red-50 p-2 rounded-md shadow-sm">
                            <div class="w-0 h-0 border-l-4 border-r-4 border-b-4 border-l-transparent border-r-transparent border-b-red-500 mr-2"></div>
                            <p class="text-red-600 text-sm font-medium">
                                Link Model Operator Estimate Inserted Here.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm animate__animated animate__fadeInRight">
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">Loss due to Ionosphere:</h3>
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">(Downlink)</h3>
                    
                    <div class="mb-4 bg-pink-100 text-gray-800 font-medium py-2 px-3 rounded border border-pink-200">
                        <div class="flex justify-between items-center mb-2">
                            <span>Downlink Loss Determined:</span>
                            <span id="downlink_loss_determined_display" class="border border-gray-300 p-3 w-24 rounded bg-gray-50 text-center font-bold"
                            style="background-color: #e6f4e1; color:rgb(22, 101, 52); border-color: #81c784;">{{ $data->downlink_loss_determined_display ?? '0.0' }} dB</span>
                        </div>
                        <div class="text-right">
                            <button type="button" id="downlink_detail_btn" class="text-blue-500 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-lg border border-gray-200 mb-4">
                        <div class="grid grid-cols-2 bg-blue-600 text-white font-bold py-2 text-sm text-center">
                            <div class="border-r border-blue-400">Frequency:</div>
                            <div>Loss:</div>
                        </div>

                        <div class="text-sm">
                            <div class="grid grid-cols-2">
                                <div class="py-2 bg-gray-50 border-r border-gray-200 relative">
                                    <input
                                        type="number"
                                        name="downlink_frequency"
                                        id="downlink_frequency"
                                        step="0.1"
                                        min="0"
                                        class="w-full bg-blue-100 border border-blue-300 rounded text-center focus:outline-none focus:ring-2 focus:ring-blue-500 p-2"
                                        value="{{ old('downlink_frequency', $data->frekuensi_downlink ?? '') }}"
                                        oninput="updateDownlinkIonosphericLoss()"
                                        placeholder="{{ $data->frekuensi_downlink?? '' }}" readonly>
                                    <span class="input-unit right-3">MHz</span>
                                </div>
                                <div class="py-2 bg-gray-50 relative">
                                    <input
                                        type="number"
                                        name="downlink_loss_ionosphere"
                                        id="downlink_loss_ionosphere"
                                        step="0.1"
                                        min="0"
                                        class="w-full bg-blue-100 border border-blue-300 rounded text-center focus:outline-none focus:ring-2 focus:ring-blue-500 p-2"
                                        value="{{ old('downlink_loss_ionosphere', $data->downlink_loss_ionosphere ?? '') }}"
                                        oninput="updateDownlinkIonosphericLoss()"
                                        placeholder="Input Nilai Loss"
                                    >
                                    <span class="input-unit right-3">dB</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <div class="inline-flex items-center bg-red-50 p-2 rounded-md shadow-sm">
                            <div class="w-0 h-0 border-l-4 border-r-4 border-b-4 border-l-transparent border-r-transparent border-b-red-500 mr-2"></div>
                            <p class="text-red-600 text-sm font-medium">
                                Link Model Operator Estimate Inserted Here.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class=""></i> Hitung & Simpan
            </button>
            </form>
            <div class="flex justify-between mt-6">
                <a href="/annpolaloss/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
                </a>
            </div>
        </div>
    </div>

    {{-- New Popup for general Atmospheric and Ionospheric Losses explanation --}}
    <div id="popup_atmoss_ionoss_general" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Tentang Perhitungan Atmospheric & Ionospheric Losses</h3>
            </div>
            <div class="popup-body">
                <div class="explanation-content">
                    <div class="section">
                        <h4 class="section-title">Loss due to Atmospheric Gases (Kehilangan Akibat Gas Atmosfer)</h4>
                        <p class="section-content">
                            Sinyal satelit yang melewati atmosfer bumi akan mengalami redaman atau kehilangan daya akibat penyerapan oleh gas-gas atmosfer seperti uap air dan oksigen. Besarnya kehilangan ini sangat bergantung pada frekuensi dan sudut elevasi (elevation angle) sinyal.
                        </p>
                        <ul class="param-list">
                            <li><strong>Frequency (MHz):</strong> Frekuensi sinyal yang digunakan. Kehilangan atmosfer meningkat secara signifikan pada frekuensi yang lebih tinggi.</li>
                            <li><strong>Elevation Angle:</strong> Sudut elevasi antena bumi terhadap satelit. Semakin rendah sudut elevasi, semakin panjang jalur sinyal melalui atmosfer, dan semakin besar kehilangan yang terjadi.</li>
                            <li><strong>Loss Determined:</strong> Nilai kehilangan daya (dalam dB) yang dihitung berdasarkan frekuensi dan sudut elevasi yang diberikan, menggunakan tabel lookup dan interpolasi.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Loss due to Ionosphere (Kehilangan Akibat Ionosfer)</h4>
                        <p class="section-content">
                            Ionosfer adalah lapisan atmosfer atas yang terionisasi, yang dapat memengaruhi perambatan gelombang radio, terutama pada frekuensi yang lebih rendah. Efek yang paling signifikan adalah Faraday Rotation, yang menyebabkan rotasi polarisasi sinyal, dan absorpsi ionosfer.
                        </p>
                        <ul class="param-list">
                            <li><strong>Frequency (MHz):</strong> Frekuensi sinyal yang digunakan untuk uplink atau downlink. Kehilangan ionosfer berbanding terbalik dengan kuadrat frekuensi, artinya frekuensi yang lebih rendah akan mengalami kehilangan yang lebih besar.</li>
                            <li><strong>Loss (dB):</strong> Nilai kehilangan daya (dalam dB) yang terjadi akibat efek ionosfer pada frekuensi tersebut.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Uplink dan Downlink</h4>
                        <p class="section-content">
                            Perhitungan kehilangan atmosfer dan ionosfer harus dilakukan secara terpisah untuk jalur <strong>Uplink</strong> (dari stasiun bumi ke satelit) dan <strong>Downlink</strong> (dari satelit ke stasiun bumi), karena frekuensi yang digunakan untuk uplink dan downlink seringkali berbeda, yang akan memengaruhi besarnya kehilangan ionosfer. Kehilangan atmosfer biasanya dianggap sama untuk kedua arah pada sudut elevasi yang sama.
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Catatan Penggunaan</h4>
                        <p class="section-content">
                            Untuk detail rumus dan penjelasan lebih lanjut mengenai perhitungan spesifik, silakan klik tombol "Lihat Detail" yang tersedia di samping setiap kolom hasil.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Popups for calculation details --}}
    <div id="la_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Loss due to Atmospheric Gases</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        Nilai kehilangan atmosfer ditentukan berdasarkan interpolasi linear pada frekuensi dan pencarian nilai terdekat pada sudut elevasi, menggunakan tabel data empiris berikut:<br>
                        <table style="width:100%; border-collapse: collapse; margin-top: 10px;">
                            <thead>
                                <tr style="background-color: #f2f2f2;">
                                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Frequency (GHz)</th>
                                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">0°</th>
                                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">5°</th>
                                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">10°</th>
                                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">30°</th>
                                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">45°</th>
                                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">90°</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td class="p-3 border-r border-gray-200">1</td><td class="p-3 border-r border-gray-200">10.17</td><td class="p-3 border-r border-gray-200">2.14</td><td class="p-3 border-r border-gray-200">1.12</td><td class="p-3 border-r border-gray-200">0.39</td><td class="p-3 border-r border-gray-200">0.28</td><td class="p-3 border-r border-gray-200">0.03</td></tr>
                                <tr><td class="p-3 border-r border-gray-200">2</td><td class="p-3 border-r border-gray-200">10.88</td><td class="p-3 border-r border-gray-200">2.31</td><td class="p-3 border-r border-gray-200">1.22</td><td class="p-3 border-r border-gray-200">0.42</td><td class="p-3 border-r border-gray-200">0.30</td><td class="p-3 border-r border-gray-200">0.03</td></tr>
                                <tr><td class="p-3 border-r border-gray-200">4</td><td class="p-3 border-r border-gray-200">11.36</td><td class="p-3 border-r border-gray-200">2.19</td><td class="p-3 border-r border-gray-200">1.14</td><td class="p-3 border-r border-gray-200">0.40</td><td class="p-3 border-r border-gray-200">0.28</td><td class="p-3 border-r border-gray-200">0.04</td></tr>
                                <tr><td class="p-3 border-r border-gray-200">6</td><td class="p-3 border-r border-gray-200">11.76</td><td class="p-3 border-r border-gray-200">2.18</td><td class="p-3 border-r border-gray-200">1.13</td><td class="p-3 border-r border-gray-200">0.39</td><td class="p-3 border-r border-gray-200">0.28</td><td class="p-3 border-r border-gray-200">0.04</td></tr>
                                <tr><td class="p-3 border-r border-gray-200">12</td><td class="p-3 border-r border-gray-200">15.08</td><td class="p-3 border-r border-gray-200">2.44</td><td class="p-3 border-r border-gray-200">1.26</td><td class="p-3 border-r border-gray-200">0.44</td><td class="p-3 border-r border-gray-200">0.31</td><td class="p-3 border-r border-gray-200">0.06</td></tr>
                                <tr><td class="p-3 border-r border-gray-200">15</td><td class="p-3 border-r border-gray-200">19.43</td><td class="p-3 border-r border-gray-200">2.95</td><td class="p-3 border-r border-gray-200">1.51</td><td class="p-3 border-r border-gray-200">0.53</td><td class="p-3 border-r border-gray-200">0.37</td><td class="p-3 border-r border-gray-200">0.08</td></tr>
                                <tr><td class="p-3 border-r border-gray-200">20</td><td class="p-3 border-r border-gray-200">61.28</td><td class="p-3 border-r border-gray-200">8.73</td><td class="p-3 border-r border-gray-200">4.47</td><td class="p-3 border-r border-gray-200">1.55</td><td class="p-3 border-r border-gray-200">1.10</td><td class="p-3 border-r border-gray-200">0.28</td></tr>
                                <tr><td class="p-3 border-r border-gray-200">30</td><td class="p-3 border-r border-gray-200">50.64</td><td class="p-3 border-r border-gray-200">7.18</td><td class="p-3 border-r border-gray-200">3.68</td><td class="p-3 border-r border-gray-200">1.28</td><td class="p-3 border-r border-gray-200">0.90</td><td class="p-3 border-r border-gray-200">0.24</td></tr>
                                <tr><td class="p-3 border-r border-gray-200">41</td><td class="p-3 border-r border-gray-200">94.81</td><td class="p-3 border-r border-gray-200">14.53</td><td class="p-3 border-r border-gray-200">7.47</td><td class="p-3 border-r border-gray-200">2.59</td><td class="p-3 border-r border-gray-200">1.83</td><td class="p-3 border-r border-gray-200">0.41</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Kehilangan atmosfer terjadi karena penyerapan sinyal oleh molekul oksigen dan uap air di atmosfer bumi. Nilai kehilangan bergantung pada frekuensi dan jalur yang ditempuh sinyal. Semakin tinggi frekuensi dan semakin rendah sudut elevasi, sinyal harus menempuh jalur yang lebih panjang melalui atmosfer padat, menyebabkan kehilangan yang lebih besar. Pada 90° (zenith), kehilangan minimal karena jalur terpendek melalui atmosfer.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="uplink_detail_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Loss due to Ionosphere (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$\text{Loss}_{\text{ionosphere}} = \frac{K}{\text{Frequency}^2}$$
                        Dimana:<br>
                        $K$ = Konstanta (tergantung kondisi ionosfer, nilai standar yang sering digunakan adalah $8.1 \times 10^{14}$ untuk total electron content - TEC)<br>
                        $\text{Frequency}$ = Frekuensi sinyal dalam MHz<br><br>
                        (Namun, dalam formulir ini, nilai Loss ditentukan secara manual oleh operator berdasarkan frekuensi yang dimasukkan.)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Kehilangan ionosfer terutama disebabkan oleh efek Faraday Rotation dan absorpsi gelombang radio di lapisan ionosfer. Efek ini lebih dominan pada frekuensi yang lebih rendah (misalnya, di bawah 1 GHz) dan berkurang seiring dengan peningkatan frekuensi. Oleh karena itu, kehilangan berbanding terbalik dengan kuadrat frekuensi.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="downlink_detail_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Loss due to Ionosphere (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$\text{Loss}_{\text{ionosphere}} = \frac{K}{\text{Frequency}^2}$$
                        Dimana:<br>
                        $K$ = Konstanta (tergantung kondisi ionosfer, nilai standar yang sering digunakan adalah $8.1 \times 10^{14}$ untuk total electron content - TEC)<br>
                        $\text{Frequency}$ = Frekuensi sinyal dalam MHz<br><br>
                        (Namun, dalam formulir ini, nilai Loss ditentukan secara manual oleh operator berdasarkan frekuensi yang dimasukkan.)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Sama seperti uplink, kehilangan ionosfer pada downlink juga disebabkan oleh interaksi sinyal dengan ionosfer. Karena frekuensi downlink biasanya berbeda dengan uplink, nilai kehilangan ini perlu dihitung terpisah untuk memastikan akurasi Link Budget.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        /**
         * Calculates the atmospheric loss based on the given frequency and elevation angle.
         *
         * @param {number} freqGHz - The input frequency in GHz.
         * @param {number} elev - The input elevation angle in degrees.
         * @returns {number} The calculated loss in dB.
         */
        function calculateAtmosphericLoss(freqGHz, elev) {
            const frequenciesGHz = [1000, 2000, 4000, 6000, 12000, 15000, 20000, 30000, 41000];
            const elevationAngles = [0, 5, 10, 30, 45, 90];
            const lossGrid = [
                [10.17, 2.14, 1.12, 0.39, 0.28, 0.03],
                [10.88, 2.31, 1.22, 0.42, 0.30, 0.03],
                [11.36, 2.19, 1.14, 0.40, 0.28, 0.04],
                [11.76, 2.18, 1.13, 0.39, 0.28, 0.04],
                [15.08, 2.44, 1.26, 0.44, 0.31, 0.06],
                [19.43, 2.95, 1.51, 0.53, 0.37, 0.08],
                [61.28, 8.73, 4.47, 1.55, 1.10, 0.28],
                [50.64, 7.18, 3.68, 1.28, 0.90, 0.24],
                [94.81, 14.53, 7.47, 2.59, 1.83, 0.41],
            ];

            // Clamp the input values to the table range
            freqGHz = Math.max(frequenciesGHz[0], Math.min(frequenciesGHz[frequenciesGHz.length - 1], freqGHz));
            elev = Math.max(elevationAngles[0], Math.min(elevationAngles[elevationAngles.length - 1], elev));

            // Find the closest frequency indices for interpolation
            let i = 0;
            while (i < frequenciesGHz.length - 1 && frequenciesGHz[i + 1] < freqGHz) {
                i++;
            }
            const f1 = frequenciesGHz[i];
            const f2 = frequenciesGHz[i + 1] || f1;
            
            // Find the elevation angle index by finding the largest angle <= input elev
            let j = 0;
            while (j < elevationAngles.length - 1 && elevationAngles[j + 1] <= elev) {
                j++;
            }
            
            // Get the loss values for the selected elevation column
            const L1 = lossGrid[i][j];
            const L2 = (i + 1 < frequenciesGHz.length) ? lossGrid[i + 1][j] : L1;

            let finalLoss;
            if (f1 === f2) {
                // Exact frequency match, no interpolation needed
                finalLoss = L1;
            } else {
                // Perform linear interpolation for frequency
                const t_freq = (freqGHz - f1) / (f2 - f1);
                finalLoss = L1 + t_freq * (L2 - L1);
            }
            
            return parseFloat(finalLoss.toFixed(2));
        }

        /**
         * Updates the "Loss Determined" input field for Atmospheric Loss (Uplink).
         */
        function updateUplinkAtmosphericLoss() {
            const frequencyInput = document.getElementById('uplink_atmospheric_frequency');
            const elevationInput = document.getElementById('uplink_min_elevation_angle');
            const lossDeterminedInput = document.getElementById('uplink_loss_determined_atmospheric');

            const frequency = parseFloat(frequencyInput.value);
            const elevation = parseFloat(elevationInput.value);

            if (!isNaN(frequency) && !isNaN(elevation)) {
                const calculatedLoss = calculateAtmosphericLoss(frequency, elevation);
                lossDeterminedInput.value = calculatedLoss;
            } else {
                lossDeterminedInput.value = ''; // Clear if any input is not a valid number
            }
        }

        /**
         * Updates the "Loss Determined" input field for Atmospheric Loss (Downlink).
         */
        function updateDownlinkAtmosphericLoss() {
            const frequencyInput = document.getElementById('downlink_atmospheric_frequency');
            const elevationInput = document.getElementById('downlink_min_elevation_angle');
            const lossDeterminedInput = document.getElementById('downlink_loss_determined_atmospheric');

            const frequency = parseFloat(frequencyInput.value);
            const elevation = parseFloat(elevationInput.value);

            if (!isNaN(frequency) && !isNaN(elevation)) {
                const calculatedLoss = calculateAtmosphericLoss(frequency, elevation);
                lossDeterminedInput.value = calculatedLoss;
            } else {
                lossDeterminedInput.value = ''; // Clear if any input is not a valid number
            }
        }

        /**
         * Updates the "Uplink Loss Determined" display based on the Uplink Loss input.
         */
        function updateUplinkIonosphericLoss() {
            const uplinkLossInput = document.getElementById('uplink_loss_ionosphere');
            const uplinkLossDisplay = document.getElementById('uplink_loss_determined_display');

            const uplinkLoss = parseFloat(uplinkLossInput.value);

            if (!isNaN(uplinkLoss)) {
                uplinkLossDisplay.textContent = `${uplinkLoss.toFixed(1)} dB`;
            } else {
                uplinkLossDisplay.textContent = '0.0 dB'; // Default if input is not a valid number
            }
        }

        /**
         * Updates the "Downlink Loss Determined" display based on the Downlink Loss input.
         */
        function updateDownlinkIonosphericLoss() {
            const downlinkLossInput = document.getElementById('downlink_loss_ionosphere');
            const downlinkLossDisplay = document.getElementById('downlink_loss_determined_display');

            const downlinkLoss = parseFloat(downlinkLossInput.value);

            if (!isNaN(downlinkLoss)) {
                downlinkLossDisplay.textContent = `${downlinkLoss.toFixed(1)} dB`;
            } else {
                downlinkLossDisplay.textContent = '0.0 dB'; // Default if input is not a valid number
            }
        }

        // Call the functions once when the page loads to set the initial values
        document.addEventListener('DOMContentLoaded', () => {
            updateUplinkAtmosphericLoss();
            updateDownlinkAtmosphericLoss();
            updateUplinkIonosphericLoss();
            updateDownlinkIonosphericLoss();

            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        });

        // POP UP Logic
        function openPopup(popupId) {
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none'); 
            document.getElementById(popupId).style.display = "flex";
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        document.getElementById('info_atmoss_ionoss_general_btn').onclick = () => {
            openPopup('popup_atmoss_ionoss_general');
        };

        // Event listeners for the new atmospheric popup buttons
        document.getElementById('uplink_la_popup_btn').onclick = () => {
            openPopup('la_popup');
        };
        document.getElementById('downlink_la_popup_btn').onclick = () => {
            openPopup('la_popup');
        };

        document.getElementById('uplink_detail_btn').onclick = () => {
            openPopup('uplink_detail_popup');
        };
        document.getElementById('downlink_detail_btn').onclick = () => {
            openPopup('downlink_detail_popup');
        };

        document.querySelectorAll('.close-popup-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            };
        });
    </script>

    {{-- Script for MathJax --}}
    <script>
        window.MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']],
                displayMath: [['$$', '$$'], ['\\[', '\\]']],
                processEscapes: true,
                tags: "ams"
            },
            options: {
                ignoreHtmlClass: "tex2jax_ignore",
                processHtmlClass: "tex2jax_process"
            },
            loader: {
                load: ['[tex]/ams']
            }
        };
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</x-layout>