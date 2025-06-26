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
            position: relative; /* Ini penting agar absolute positioning tombol X bekerja relatif terhadapnya */
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 600px;
            max-height: 80vh; /* Tinggi maksimum popup, sisanya akan menggulir */
            display: flex; /* Gunakan flexbox untuk layout header dan body */
            flex-direction: column; /* Susun header dan body secara vertikal */
            animation: fadeInScale 0.3s ease-out;
        }
        
        /* Gaya untuk header popup yang tidak akan menggulir */
        .popup-header {
            padding: 20px 30px 10px; /* Padding untuk header */
            border-bottom: 1px solid #eee; /* Garis bawah pada header */
            position: relative; /* Penting untuk posisi absolut tombol X */
            flex-shrink: 0; /* Pastikan header tidak menyusut */
        }

        .popup-header h3 {
            margin-top: 0; /* Hapus margin top yang mungkin mengganggu */
            color: #2c3e50;
            padding-bottom: 0; /* Hapus padding-bottom default dari h3 di sini */
        }

        /* Gaya untuk tombol tutup (X) */
        .close-popup-btn {
            position: absolute; /* Tetap absolute relatif terhadap popup-header */
            top: 15px;    /* Sesuaikan posisi vertikal dari atas popup-header */
            right: 15px;  /* Sesuaikan posisi horizontal dari kanan popup-header */
            font-size: 24px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: color 0.2s ease;
            z-index: 1001; /* Pastikan tombol di atas konten popup */
            background-color: white; /* Memberikan latar belakang */
            border-radius: 50%; /* Membuat tombol lingkaran */
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2); /* Memberikan sedikit bayangan */
        }

        .close-popup-btn:hover {
            color: #000;
        }

        /* Gaya untuk body popup yang akan menggulir */
        .popup-body {
            padding: 20px 30px 30px; /* Padding untuk konten body */
            overflow-y: auto; /* Ini yang memungkinkan konten body discroll */
            flex-grow: 1; /* Biarkan body mengisi sisa ruang yang tersedia */
        }

        .formula {
            background-color: #f5f5f5;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
            margin: 15px 0;
            font-family: 'Cambria Math', 'Times New Roman', serif;
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
                <h3 class="text-lg font-bold text-center text-gray-800 mb-3">Uplink and Downlink:</h3>

                <div class="overflow-hidden rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-3 font-bold bg-blue-600 text-white py-3 text-base text-center">
                        <div>Elevation Angle:</div>
                        <div>Loss:</div>
                        <div>Unit:</div>
                    </div>

                    <div class="text-base bg-gray-50">
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>0°</div>
                            <div>10.2</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>2.5°</div>
                            <div>4.6</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>5°</div>
                            <div>2.1</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>10°</div>
                            <div>1.1</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>30°</div>
                            <div>0.4</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>45°</div>
                            <div>0.3</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 text-center">
                            <div>90°</div>
                            <div>0.0</div>
                            <div>dB</div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('attmosionos.store', ['id' => $dataId]) }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label for="min_elevation_angle" class="block font-medium mb-2 text-gray-700">Min. Elev. Angle:</label>
                            <input
                                type="number"
                                name="min_elevation_angle"
                                id="min_elevation_angle"
                                step="0.1"
                                min="0"
                                max="90"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                value=""
                                required
                                oninput="updateAtmosphericLoss()"
                                placeholder="Enter angle"
                            >
                            <span class="input-unit right-3">deg.</span>
                        </div>

                        <div class="relative">
                            <label for="loss_determined_atmospheric" class="block font-medium mb-2 text-gray-700">Loss Determined:</label>
                            <input
                                type="text"
                                name="loss_determined_atmospheric"
                                id="loss_determined_atmospheric"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pr-16"
                                value=""
                                readonly
                            >
                            <button type="button" id="la_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
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
                            style="background-color: #e6f4e1; color:rgb(22, 101, 52); border-color: #81c784;">0.0 dB</span>
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
                                        value=""
                                        oninput="updateUplinkIonosphericLoss()"
                                        placeholder="{{ $data->frekuensi ?? '' }}" step="any" value="{{ $data->frekuensi ?? '' }}" readonly>

                                    
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
                                        value=""
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
                            style="background-color: #e6f4e1; color:rgb(22, 101, 52); border-color: #81c784;">0.0 dB</span>
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
                                        value=""
                                        oninput="updateDownlinkIonosphericLoss()"
                                        placeholder="{{ $data->frekuensi_downlink?? '' }}" step="any" value="{{ $data->frekuensi_downlink ?? '' }}" readonly>
        
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
                                        value=""
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
                <a href="/calc/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Previous Page
                </a>
                {{-- If you have a next page, uncomment and adjust the link below --}}
                {{-- <a href="/next-page/{{$dataId}}" class="inline-flex items-center justify- Pelajaran selanjutnya px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                    Next Page <i class="fas fa-arrow-right ml-2"></i>
                </a> --}}
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
                            Sinyal satelit yang melewati atmosfer bumi akan mengalami redaman atau kehilangan daya akibat penyerapan oleh gas-gas atmosfer seperti uap air dan oksigen. Besarnya kehilangan ini sangat bergantung pada sudut elevasi (elevation angle) dan frekuensi sinyal.
                        </p>
                        <ul class="param-list">
                            <li><strong>Min. Elev. Angle:</strong> Sudut elevasi minimum antena bumi terhadap satelit. Semakin rendah sudut elevasi, semakin panjang jalur sinyal melalui atmosfer, dan semakin besar kehilangan yang terjadi.</li>
                            <li><strong>Loss Determined:</strong> Nilai kehilangan daya (dalam dB) yang dihitung berdasarkan sudut elevasi yang diberikan, menggunakan tabel lookup atau interpolasi.</li>
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
                        Nilai kehilangan atmosfer ditentukan berdasarkan tabel lookup dan interpolasi linear dari data empiris.<br>
                        Untuk $\text{Min. Elev. Angle} < 2.5^\circ$, $\text{Loss} = 4.6 \text{ dB}$.<br>
                        Untuk sudut elevasi $\ge 2.5^\circ$, nilai diambil dari tabel lookup berikut:<br>
                        <table style="width:100%; border-collapse: collapse; margin-top: 10px;">
                            <thead>
                                <tr style="background-color: #f2f2f2;">
                                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Elevation Angle ($^\circ$)</th>
                                    <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Loss (dB)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">0</td><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">10.2</td></tr>
                                <tr><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">2.5</td><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">4.6</td></tr>
                                <tr><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">5</td><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">2.1</td></tr>
                                <tr><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">10</td><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">1.1</td></tr>
                                <tr><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">30</td><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">0.4</td></tr>
                                <tr><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">45</td><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">0.3</td></tr>
                                <tr><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">90</td><td style="border: 1px solid #ddd; padding: 8px; text-align: center;">0.0</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Kehilangan atmosfer terjadi karena penyerapan sinyal oleh molekul oksigen dan uap air di atmosfer bumi. Semakin rendah sudut elevasi, sinyal harus menempuh jalur yang lebih panjang melalui atmosfer padat, menyebabkan kehilangan yang lebih besar. Pada $90^\circ$ (zenith), kehilangan minimal karena jalur terpendek melalui atmosfer.</p>
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
         * Calculates the atmospheric loss based on the given minimum elevation angle
         * using a lookup table and interpolation logic similar to the provided Excel formula.
         *
         * @param {number} minElevationAngle - The minimum elevation angle in degrees.
         * @returns {number} The calculated loss in dB, rounded to one decimal place.
         */
        function calculateAtmosphericLoss(minElevationAngle) {
            // Define the lookup table data from your image
            const elevationAngles = [0, 2.5, 5, 10, 30, 45, 90];
            const losses = [10.2, 4.6, 2.1, 1.1, 0.4, 0.3, 0.0];

            // Get the value of B8 from the table, which is elevationAngles[1] (2.5 degrees)
            const B8_elevationAngle = elevationAngles[1]; // 2.5

            // Excel formula: IF(D21 < B8, 4.6, ...)
            if (minElevationAngle < B8_elevationAngle) {
                // The value 4.6 is hardcoded in the Excel formula for this condition.
                return 4.6;
            } else {
                // Excel formula: INDEX(D6:D18, MATCH(D21, B6:B18, 1), 1)

                let matchIndex = -1;
                // The MATCH function with type 1 finds the largest value that is less than or equal to lookup_value.
                // We need to iterate through elevationAngles to find this.
                for (let i = 0; i < elevationAngles.length; i++) {
                    if (minElevationAngle >= elevationAngles[i]) {
                        matchIndex = i;
                    } else {
                        // Since the elevationAngles are sorted, we can break once we exceed minElevationAngle
                        break;
                    }
                }

                if (matchIndex !== -1) {
                    // Return the corresponding loss from the losses array
                    // Round to one decimal place as seen in your example data
                    return parseFloat(losses[matchIndex].toFixed(1));
                } else {
                    console.warn("Could not find a matching elevation angle for lookup.");
                    return 0.0; // Default or error handling
                }
            }
        }

        /**
         * Updates the "Loss Determined" input field for Atmospheric Loss
         * based on the "Min. Elev. Angle" input.
         */
        function updateAtmosphericLoss() {
            const minElevationAngleInput = document.getElementById('min_elevation_angle');
            const lossDeterminedInput = document.getElementById('loss_determined_atmospheric');

            const minElevationAngle = parseFloat(minElevationAngleInput.value);

            if (!isNaN(minElevationAngle)) {
                const calculatedLoss = calculateAtmosphericLoss(minElevationAngle);
                lossDeterminedInput.value = calculatedLoss;
            } else {
                lossDeterminedInput.value = ''; // Clear if input is not a valid number
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
            updateAtmosphericLoss();
            updateUplinkIonosphericLoss();
            updateDownlinkIonosphericLoss();

            // Re-render MathJax on load for all popups
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        });

        // POP UP Logic
        // Fungsi umum untuk membuka pop-up
        function openPopup(popupId) {
            // Tutup semua popup lain yang mungkin terbuka, untuk memastikan hanya satu popup yang terlihat
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none'); 
            
            document.getElementById(popupId).style.display = "flex";
            // Penting: Setelah membuka, jika MathJax dimuat, render ulang rumus matematika
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        // Event listener for "Apa itu Perhitungan Atmospheric & Ionospheric Losses?"
        document.getElementById('info_atmoss_ionoss_general_btn').onclick = () => {
            openPopup('popup_atmoss_ionoss_general');
        };

        // Event listener for "Lihat Detail" buttons
        document.getElementById('la_popup_btn').onclick = () => {
            openPopup('la_popup');
        };
        document.getElementById('uplink_detail_btn').onclick = () => {
            openPopup('uplink_detail_popup');
        };
        document.getElementById('downlink_detail_btn').onclick = () => {
            openPopup('downlink_detail_popup');
        };

        // Fungsi untuk menutup semua popup
        document.querySelectorAll('.close-popup-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            };
        });
    </script>

    {{-- Script for MathJax --}}
    <script>
        // Konfigurasi MathJax (sesuaikan jika perlu)
        window.MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']], // Untuk rumus inline seperti $x^2$
                displayMath: [['$$', '$$'], ['\\[', '\\]']], // Untuk rumus blok seperti $$E=mc^2$$
                processEscapes: true, // Memungkinkan \$ untuk menampilkan tanda dolar literal
                tags: "ams" // Untuk penomoran persamaan (opsional)
            },
            options: {
                ignoreHtmlClass: "tex2jax_ignore", // Kelas yang diabaikan untuk pemrosesan matematika
                processHtmlClass: "tex2jax_process" // Kelas yang secara spesifik diproses untuk matematika
            },
            loader: {
                load: ['[tex]/ams'] // Memuat ekstensi AMS math
            }
        };
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</x-layout>