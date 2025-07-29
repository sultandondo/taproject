<x-layout>
    <x-slot:title>Simulasi Hardware</x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Styling for readonly inputs */
        input[readonly] {
            background-color: #e6f4e1; /* Lighter green */
            color: #166534; /* Darker green text */
            border-color: #81c784; /* Green border */
            cursor: not-allowed;
            font-weight: 500;
        }

        /* Ensure input focus styles are prominent */
        input[type="number"]:focus,
        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3B82F6; /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* blue-500 with opacity */
        }

        /* Styling for input with error */
        input.input-error {
            border-color: #ef4444; /* red-500 */
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.5); /* red-500 with opacity */
        }


        /* Adjust labels for full visibility when not in sections */
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

        /* Specific styles for new layout */
        .input-group > div {
            margin-bottom: 1rem; /* Add some space between vertically stacked inputs */
        }
        .input-group > div:last-child {
            margin-bottom: 0; /* No margin after the last one in the group */
        }

        /* Ensured consistent input height */
        input[type="number"],
        input[type="text"] {
            height: 48px; /* Tailwind's p-3 usually results in this height */
            padding-right: 0.75rem; /* p-3 default */
        }

        /* Gaya untuk pembungkus input dan unit */
        .input-with-unit-wrapper {
            display: flex; /* Menggunakan flexbox untuk mensejajarkan input dan unit */
            align-items: center; /* Pusatkan vertikal */
            gap: 0.5rem; /* Jarak antara input dan unit */
        }

        /* Gaya untuk unit teks di luar input */
        .unit-text {
            color: #4B5563; /* gray-700 */
            font-size: 0.875rem; /* text-sm */
            font-weight: 500; /* Medium font weight */
            min-width: 40px; /* Memberikan lebar minimum agar tidak terlalu mepet jika teks unit pendek */
            text-align: left; /* Biarkan teks unit rata kiri */
        }

        /* --- RESPONSIVE ADJUSTMENTS --- */
        /* For screens smaller than 'sm' (640px) */
        @media (max-width: 639px) {
            .flex-row-sm-up { /* Change from flex-row to flex-col on small screens */
                flex-direction: column;
                gap: 1rem; /* Add vertical gap */
            }
            .flex-row-sm-up > div { /* Make inner divs full width */
                width: 100% !important;
            }
            .space-x-6-sm-up { /* Remove horizontal space on small screens */
                margin-left: 0 !important;
                margin-right: 0 !important;
                gap: 1rem; /* Add vertical gap */
            }
        }

        /* For screens smaller than 'md' (768px) */
        @media (max-width: 767px) {
            .px-4.sm\:px-6.lg\:px-8 { /* Adjust overall padding for smaller screens */
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .max-w-3xl { /* Limit max-width to be more flexible */
                max-width: 100%;
            }
            .text-3xl.sm\:text-4xl { /* Adjust heading size */
                font-size: 2rem; /* text-2xl */
            }
            .text-lg { /* Adjust paragraph size */
                font-size: 1rem; /* text-base */
            }
            .flex-col-md-up { /* New class for horizontal flex items to stack vertically */
                flex-direction: column;
                gap: 1rem; /* Add vertical gap */
            }
            .flex-col-md-up > div {
                width: 100% !important;
            }
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

        /* Style untuk kolom uplink dan downlink */
        .uplink-downlink-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .uplink-downlink-grid {
                grid-template-columns: 1fr;
            }
        }

        .uplink-section {
            background-color: #fef2f2; /* red-50 slightly modified */
            border: 1px solid #fca5a5; /* red-300 */
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .downlink-section {
            background-color: #f0f9ff; /* sky-50 */
            border: 1px solid #7dd3fc; /* sky-300 */
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .uplink-section h4 {
            color: #dc2626; /* red-600 */
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-align: center;
        }

        .downlink-section h4 {
            color: #0284c7; /* sky-600 */
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-align: center;
        }

        /* Style untuk frequency grid */
        .frequency-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .frequency-grid {
                grid-template-columns: 1fr;
            }
        }

        .frequency-uplink-section {
            background-color: #fef2f2; /* red-50 slightly modified */
            border: 1px solid #fca5a5; /* red-300 */
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .frequency-downlink-section {
            background-color: #f0f9ff; /* sky-50 */
            border: 1px solid #7dd3fc; /* sky-300 */
            border-radius: 0.5rem;
            padding: 1rem;
        }

        .frequency-uplink-section h4 {
            color: #dc2626; /* red-600 */
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-align: center;
        }

        .frequency-downlink-section h4 {
            color: #0284c7; /* sky-600 */
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-align: center;
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl transform transition-all duration-300 hover:shadow-3xl border-t-8 border-blue-600">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                    <i class="text-blue-600"></i> Simulasi Hardware
                </h1>
                <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                    Masukkan parameter untuk simulasi hardware (Input, Loss, dan Output)
                </p>

                {{-- "Apa itu Simulasi Hardware?" button --}}
                <div class="mb-6 text-right animate__animated animate__fadeInUp">
                    <button type="button" id="info_hardware_general_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">
                        Apa itu Simulasi Hardware? <i class="fas fa-info-circle ml-1"></i>
                    </button>
                </div>

                {{-- Pastikan $dataId dilewatkan dari controller, contoh: return view('simulationhardware', ['dataId' => $id]); --}}
                <form method="POST" action="{{ route('arduino', $dataId) }}">
                    @csrf {{-- Tambahkan CSRF token untuk Laravel --}}
                    {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}"> --}}

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Tx (INPUT)</h2>
                        <div class="relative mb-6">
                            <div class="text-center text-gray-500 italic">
                                </div>
                        </div>

                        {{-- Frequency Grid - Uplink dan Downlink --}}
                        <div class="frequency-grid mb-4">
                            {{-- Frequency Uplink Section --}}
                            <div class="frequency-uplink-section">
                                <h4>Uplink Frequency</h4>
                                <div class="relative">
                                    <label for="frequency_tx_uplink" class="block font-medium mb-2 text-gray-700">Frequency:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="1" id="frequency_tx_uplink" name="frequency_tx_uplink"
                                            class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" value="{{ $data->frekuensi ?? '' }}" readonly>
                                        <span class="unit-text">MHz</span>
                                    </div>
                                    <button type="button" id="frequency_tx_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                </div>
                            </div>

                            {{-- Frequency Downlink Section --}}
                            <div class="frequency-downlink-section">
                                <h4>Downlink Frequency</h4>
                                <div class="relative">
                                    <label for="frequency_tx_downlink" class="block font-medium mb-2 text-gray-700">Frequency:</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="1" id="frequency_tx_downlink" name="frequency_tx_downlink"
                                            class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" value="{{ $data->frekuensi_downlink ?? '' }}" readonly>
                                        <span class="unit-text">MHz</span>
                                    </div>
                                   <button type="button" id="frequency_tx_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>                                    
                                </div>
                            </div>
                        </div>

                        {{-- Input Power Grid - Uplink dan Downlink --}}
                        <div class="frequency-grid mb-4">
                            {{-- Input Power Uplink Section --}}
                            <div class="frequency-uplink-section">
                                <h4>Uplink Input Power</h4>
                                <div class="relative">
                                    <label for="dbm_tx_uplink" class="block font-medium mb-2 text-gray-700">Input Power (dBm):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="0.001" id="dbm_tx_uplink" name="dbm_tx_uplink"
                                            class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                            placeholder="Masukkan nilai" min="0" max="30">
                                        <span class="unit-text">dBm</span>
                                    </div>
                                    <div id="dbm-uplink-warning" class="text-red-600 text-sm mt-1 hidden">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Daya input antara 0 - 30 dBm.
                                    </div>
                                </div>
                            </div>

                            {{-- Input Power Downlink Section --}}
                            <div class="frequency-downlink-section">
                                <h4>Downlink Input Power</h4>
                                <div class="relative">
                                    <label for="dbm_tx_downlink" class="block font-medium mb-2 text-gray-700">Input Power (dBm):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="0.001" id="dbm_tx_downlink" name="dbm_tx_downlink"
                                            class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                            placeholder="Masukkan nilai" min="0" max="30">
                                        <span class="unit-text">dBm</span>
                                    </div>
                                    <div id="dbm-downlink-warning" class="text-red-600 text-sm mt-1 hidden">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Daya input antara 0 - 30 dBm.
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END Input Power Grid --}}

                    </div>

                    <div class="bg-red-50 p-6 rounded-lg border border-red-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">FSL/LOSS (INPUT)</h2>
                        <div class="relative mb-6">
                            <div class="text-center text-gray-500 italic">
                                </div>
                        </div>

                        {{-- Uplink dan Downlink Total Loss --}}
                        <div class="uplink-downlink-grid">
                            {{-- Uplink Section --}}
                            <div class="uplink-section">
                                <h4>Uplink</h4>
                                <div class="relative">
                                    <label for="total_loss_uplink" class="block font-medium mb-2 text-gray-700">Total Loss (dB):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="0.001" name="path_loss" id="total_loss_uplink"
                                            class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" value="{{ $data->path_loss ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                    <button type="button" id="total_loss_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                </div>
                            </div>

                            {{-- Downlink Section --}}
                            <div class="downlink-section">
                                <h4>Downlink</h4>
                                <div class="relative">
                                    <label for="total_loss_downlink" class="block font-medium mb-2 text-gray-700">Total Loss (dB):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="number" step="0.001" name="path_loss_downlink" id="total_loss_downlink"
                                            class="w-full p-3 border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" value="{{ $data->path_loss_downlink ?? '' }}" readonly>
                                        <span class="unit-text">dB</span>
                                    </div>
                                    <button type="button" id="total_loss_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-6 rounded-lg border border-green-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Rx (OUTPUT)</h2>
                        <div class="relative mb-6">
                            <div class="text-center text-gray-500 italic">
                                </div>
                        </div>

                        {{-- Uplink dan Downlink Received Power --}}
                        <div class="uplink-downlink-grid">
                            {{-- Uplink Section --}}
                            <div class="uplink-section">
                                <h4>Uplink</h4>
                                <div class="relative">
                                    <label for="received_power_rx_uplink" class="block font-medium mb-2 text-gray-700">Power Receive (dBm):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="text" name="received_power_rx_uplink" id="received_power_rx_uplink"
                                            class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                            placeholder="Hasil Daya" readonly>
                                        <span class="unit-text">dBm</span>
                                    </div>
                                    <button type="button" id="received_power_rx_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                </div>
                            </div>

                            {{-- Downlink Section --}}
                            <div class="downlink-section">
                                <h4>Downlink</h4>
                                <div class="relative">
                                    <label for="received_power_rx_downlink" class="block font-medium mb-2 text-gray-700">Power Receive (dBm):</label>
                                    <div class="input-with-unit-wrapper">
                                        <input type="text" name="received_power_rx_downlink" id="received_power_rx_downlink"
                                            class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                            placeholder="Hasil Daya" readonly>
                                        <span class="unit-text">dBm</span>
                                    </div>
                                    <button type="button" id="received_power_rx_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class=""></i> Kirim ke Arduino
                    </button>
                </form>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
                    </a>
                    {{-- Anda bisa menambahkan link halaman selanjutnya di sini jika diperlukan --}}
                    {{-- <a href="/next-page/{{ $dataId ?? 'default_id' }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                        Halaman Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- New Popup for general Hardware Simulation explanation --}}
    <div id="popup_hardware_general" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Tentang Simulasi Hardware</h3>
            </div>
            <div class="popup-body">
                <div class="explanation-content">
                    <div class="section">
                        <h4 class="section-title">Transmitter (Tx) Input</h4>
                        <p class="section-content">
                            Ini adalah bagian di mana Anda akan memasukkan parameter yang berkaitan dengan sumber sinyal atau pemancar. Ini termasuk frekuensi operasional dan daya input awal yang dihasilkan oleh pemancar.
                        </p>
                        <ul class="param-list">
                            <li><strong>Frekuensi Uplink:</strong> Rentang frekuensi sinyal uplink yang akan disimulasikan.</li>
                            <li><strong>Frekuensi Downlink:</strong> Rentang frekuensi sinyal downlink yang akan disimulasikan.</li>
                            <li><strong>Daya Input (dBm):</strong> Daya awal sinyal yang dihasilkan, diukur dalam dBm (decibel-milliwatt). Ini adalah input utama untuk perhitungan daya yang diterima.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">FSL/Loss (Input)</h4>
                        <p class="section-content">
                            Bagian ini digunakan untuk memasukkan semua jenis kehilangan daya yang mungkin terjadi pada jalur transmisi. Ini adalah faktor-faktor yang akan mengurangi kekuatan sinyal dari pemancar hingga penerima.
                        </p>
                        <ul class="param-list">
                            <li><strong>Total Loss Uplink (dB):</strong> Representasi total kehilangan daya pada jalur uplink (dari terminal ke satelit).</li>
                            <li><strong>Total Loss Downlink (dB):</strong> Representasi total kehilangan daya pada jalur downlink (dari satelit ke terminal).</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Receiver (Rx) Output</h4>
                        <p class="section-content">
                            Ini adalah bagian output yang menunjukkan hasil simulasi, yaitu daya sinyal yang diterima setelah semua kehilangan diperhitungkan.
                        </p>
                        <ul class="param-list">
                            <li><strong>Daya yang diterima Uplink (dBm):</strong> Daya sinyal akhir yang berhasil sampai ke penerima pada jalur uplink.</li>
                            <li><strong>Daya yang diterima Downlink (dBm):</strong> Daya sinyal akhir yang berhasil sampai ke penerima pada jalur downlink.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Catatan Penggunaan</h4>
                        <p class="section-content">
                            Untuk melihat rumus dan penjelasan detail dari setiap perhitungan spesifik, silakan klik tombol "Lihat Detail" yang tersedia di samping setiap kolom hasil.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Popups for calculation details --}}
    {{-- dbw_tx_popup Dihapus --}}

    {{-- Popup for Frequency Uplink --}}
    <div id="frequency_tx_uplink_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Frekuensi Uplink</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai <strong>Frekuensi Uplink</strong> ($f_{uplink}$) diambil dari input "Frekuensi Uplink" pada halaman "Frekuensi".
                        <br><br>
                        <strong>Notasi Matematis:</strong><br>
                        $f_{uplink} = \text{Frekuensi dalam MHz}$
                        <br>
                        <strong>Dimana:</strong><br>
                        • $f_{uplink}$ = Frekuensi sinyal uplink dalam MHz<br>
                        • MHz = Megahertz ($10^6$ Hz)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    <strong></strong>Frekuensi Uplink</strong> adalah frekuensi sinyal yang digunakan untuk transmisi dari stasiun bumi ke satelit. Ini adalah parameter dasar yang mempengaruhi perhitungan *path loss* dan desain antena.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Popup for Frequency Downlink --}}
    <div id="frequency_tx_downlink_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Frekuensi Downlink</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai <strong>Frekuensi Downlink</strong> ($f_{downlink}$) diambil dari input "Frekuensi Downlink" pada halaman "Frekuensi".
                        <br><br>
                        <strong>Notasi Matematis:</strong><br>
                        $f_{downlink} = \text{Frekuensi dalam MHz}$
                        <br>
                        <strong>Dimana:</strong><br>
                        • $f_{downlink}$ = Frekuensi sinyal downlink dalam MHz<br>
                        • MHz = Megahertz ($10^6$ Hz)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    <strong>Frekuensi Downlink</strong> adalah frekuensi sinyal yang digunakan untuk transmisi dari satelit ke stasiun bumi. Sama seperti uplink, ini adalah parameter dasar yang mempengaruhi perhitungan *path loss* dan desain antena.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="dbm_tx_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Daya Input (dBm)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $P_{dBm} \text{ (Input Langsung)}$
                        Dimana:<br>
                        $P_{dBm}$ = Daya dalam desibel-milliwatt yang dimasukkan
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    <strong>dBm</strong>adalah satuan ukuran daya yang dinyatakan dalam desibel (dB) relatif terhadap 1 milliwatt (mW). Ini umumnya digunakan untuk mengukur daya sinyal dalam komunikasi nirkabel dan serat optik. Anda dapat memasukkan nilai dBm secara langsung.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="total_loss_uplink_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Total Loss Uplink (dB)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai <strong>Total Loss Uplink</strong> ($L_{total\_uplink}$) diambil dari perhitungan pada halaman "Frekuensi" yang mencakup Free Space Loss dan semua komponen kehilangan lainnya.
                        <br>
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    <strong>Total Loss Uplink</strong> adalah akumulasi semua kehilangan daya sinyal yang terjadi selama transmisi dari terminal pengirim ke satelit. Nilai ini dihitung secara komprehensif pada halaman "Frekuensi" dan mencakup berbagai komponen kehilangan yang mempengaruhi kualitas sinyal uplink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="total_loss_downlink_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Total Loss Downlink (dB)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai <strong>Total Loss Downlink</strong> ($L_{total\_downlink}$) diambil dari perhitungan pada halaman "Frekuensi" yang mencakup Free Space Loss dan semua komponen kehilangan lainnya.
                        <br>
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    <strong>Total Loss Downlink</strong> adalah akumulasi semua kehilangan daya sinyal yang terjadi selama transmisi dari satelit ke terminal penerima. Nilai ini dihitung secara komprehensif pada halaman "Frekuensi" dan mencakup berbagai komponen kehilangan yang mempengaruhi kualitas sinyal downlink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="received_power_rx_uplink_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Daya yang Diterima Uplink (dBm)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $P_{Rx\_Uplink\_dBm} = P_{Tx\_dBm} - L_{Total\_Uplink}$
                        <br>
                        <strong>Dimana:</strong><br>
                        • $P_{Rx\_Uplink\_dBm}$ = Daya yang diterima Uplink dalam dBm<br>
                        • $P_{Tx\_dBm}$ = Daya Input Transmitter dalam dBm<br>
                        • $L_{Total\_Uplink}$ = Total Loss Uplink dalam dB<br><br>
                        <strong>(Catatan: Hasil dalam dBm karena dBm - dB = dBm)</strong>
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    <strong>Daya yang diterima</strong> pada jalur uplink dihitung dengan mengurangkan total loss uplink dari daya input transmitter uplink. Karena daya input uplink dalam dBm dikurangi dengan loss dalam dB, hasilnya akan dalam satuan dBm. Ini sesuai dengan prinsip bahwa dBm - dB = dBm.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="received_power_rx_downlink_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Daya yang Diterima Downlink (dBm)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $P_{Rx\_Downlink\_dBm} = P_{Tx\_dBm} - L_{Total\_Downlink}$
                        <br>
                        <strong>Dimana:</strong><br>
                        • $P_{Rx\_Downlink\_dBm}$ = Daya yang diterima Downlink dalam dBm<br>
                        • $P_{Tx\_dBm}$ = Daya Input Transmitter dalam dBm<br>
                        • $L_{Total\_Downlink}$ = Total Loss Downlink dalam dB<br><br>
                        <strong>(Catatan: Hasil dalam dBm karena dBm - dB = dBm)</strong>
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    <strong>Daya yang diterima</strong> pada jalur downlink dihitung dengan mengurangkan total loss downlink dari daya input transmitter downlink. Karena daya input downlink dalam dBm dikurangi dengan loss dalam dB, hasilnya akan dalam satuan dBm. Ini sesuai dengan prinsip bahwa dBm - dB = dBm.</p>
                </div>
            </div>
        </div>
    </div>

   <script>
        // Function to calculate and update received power untuk uplink dan downlink
        function updateReceivedPowerUplink() {
            const dbmTxUplinkInput = document.getElementById('dbm_tx_uplink');
            const totalLossUplinkInput = document.getElementById('total_loss_uplink');
            const receivedPowerRxUplinkOutput = document.getElementById('received_power_rx_uplink');

            const powerTxUplink_dBm = parseFloat(dbmTxUplinkInput.value);
            const totalLossUplink = parseFloat(totalLossUplinkInput.value);

            const isDbmTxUplinkValidForCalc = !isNaN(powerTxUplink_dBm) && powerTxUplink_dBm >= 0 && powerTxUplink_dBm <= 30;    
            const isTotalLossUplinkValidForCalc = !isNaN(totalLossUplink) && totalLossUplink;

            if (isDbmTxUplinkValidForCalc && isTotalLossUplinkValidForCalc) {
                // Rumus: dBm - dB = dBm (langsung tanpa konversi -30)
                const receivedPower_dBm = powerTxUplink_dBm - totalLossUplink;
                receivedPowerRxUplinkOutput.value = receivedPower_dBm.toFixed(2);
            } else {
                receivedPowerRxUplinkOutput.value = '';
            }
        }

        function updateReceivedPowerDownlink() {
            const dbmTxDownlinkInput = document.getElementById('dbm_tx_downlink');
            const totalLossDownlinkInput = document.getElementById('total_loss_downlink');
            const receivedPowerRxDownlinkOutput = document.getElementById('received_power_rx_downlink');

            const powerTxDownlink_dBm = parseFloat(dbmTxDownlinkInput.value);
            const totalLossDownlink = parseFloat(totalLossDownlinkInput.value);

            const isDbmTxDownlinkValidForCalc = !isNaN(powerTxDownlink_dBm) && powerTxDownlink_dBm >= 0 && powerTxDownlink_dBm <= 30;    
            const isTotalLossDownlinkValidForCalc = !isNaN(totalLossDownlink) && totalLossDownlink;

            if (isDbmTxDownlinkValidForCalc && isTotalLossDownlinkValidForCalc) {
                // Rumus: dBm - dB = dBm (langsung tanpa konversi -30)
                const receivedPower_dBm = powerTxDownlink_dBm - totalLossDownlink;
                receivedPowerRxDownlinkOutput.value = receivedPower_dBm.toFixed(2);
            } else {
                receivedPowerRxDownlinkOutput.value = '';
            }
        }

        /**
         * Generic function to validate an input against a min/max range.
         * Applies/removes error styling and shows/hides warning message.
         * @param {HTMLElement} inputElement The input DOM element.
         * @param {HTMLElement} warningElement The warning message DOM element.
         * @param {number} minVal The minimum allowed value.
         * @param {number} maxVal The maximum allowed value.
         * @param {string} warningMessage The message to display if validation fails.
         * @returns {boolean} True if valid, false otherwise.
         */
        function validateInputRange(inputElement, warningElement, minVal, maxVal, warningMessage) {
            const value = parseFloat(inputElement.value);
            const rawValue = inputElement.value.trim();

            let isValid = true;

            if (rawValue === '') {
                // If the input is empty, hide warning and remove error styling
                warningElement.classList.add('hidden');
                inputElement.classList.remove('input-error');
                inputElement.classList.add('border-gray-300', 'focus:border-blue-400', 'focus:ring-blue-400');
                return true;
            }

            if (value < minVal || value > maxVal || isNaN(value)) {
                warningElement.textContent = warningMessage;
                warningElement.classList.remove('hidden');
                inputElement.classList.remove('border-gray-300', 'focus:border-blue-400', 'focus:ring-blue-400');
                inputElement.classList.add('input-error');
                isValid = false;
            } else {
                warningElement.classList.add('hidden');
                inputElement.classList.remove('input-error');
                inputElement.classList.add('border-gray-300', 'focus:border-blue-400', 'focus:ring-blue-400');
            }
            return isValid;
        }

        // Specific validation functions for each input (these are for readonly, but kept for consistency)
        function validateFrequencyUplink() {
            const input = document.getElementById('frequency_tx_uplink');
            let warning = document.getElementById('frequency-uplink-warning');
            if (!warning) {
                warning = document.createElement('div');
                warning.id = 'frequency-uplink-warning';
                warning.className = 'text-red-600 text-sm mt-1 hidden';
                warning.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> Frekuensi harus dalam rentang yang valid.';
                input.parentNode.appendChild(warning);
            }
            // For readonly inputs, we don't typically validate user input, but you can
            // add checks if the pre-filled value might be invalid.
            return true; // Always true for readonly for now
        }

        function validateFrequencyDownlink() {
            const input = document.getElementById('frequency_tx_downlink');
            let warning = document.getElementById('frequency-downlink-warning');
            if (!warning) {
                warning = document.createElement('div');
                warning.id = 'frequency-downlink-warning';
                warning.className = 'text-red-600 text-sm mt-1 hidden';
                warning.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> Frekuensi harus dalam rentang yang valid.';
                input.parentNode.appendChild(warning);
            }
            return true; // Always true for readonly for now
        }

        function validateDbmTxUplink() {
            const input = document.getElementById('dbm_tx_uplink');
            const warning = document.getElementById('dbm-uplink-warning');
            return validateInputRange(input, warning, 0, 30, 'Daya input antara 0 - 30 dBm.');
        }

        function validateDbmTxDownlink() {
            const input = document.getElementById('dbm_tx_downlink');
            const warning = document.getElementById('dbm-downlink-warning');
            return validateInputRange(input, warning, 0, 30, 'Daya input antara 0 - 30 dBm.');
        }

        function validateTotalLossUplink() {
            const input = document.getElementById('total_loss_uplink');
            let warning = document.getElementById('total-loss-uplink-warning');
            if (!warning) {
                warning = document.createElement('div');
                warning.id = 'total-loss-uplink-warning';
                warning.className = 'text-red-600 text-sm mt-1 hidden';
                warning.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> Total Loss harus dalam rentang yang valid.';
                input.parentNode.appendChild(warning);
            }
            return true; // Always true for readonly for now
        }

        function validateTotalLossDownlink() {
            const input = document.getElementById('total_loss_downlink');
            let warning = document.getElementById('total-loss-downlink-warning');
            if (!warning) {
                warning = document.createElement('div');
                warning.id = 'total-loss-downlink-warning';
                warning.className = 'text-red-600 text-sm mt-1 hidden';
                warning.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i> Total Loss harus dalam rentang yang valid.';
                input.parentNode.appendChild(warning);
            }
            return true; // Always true for readonly for now
        }

        // Function to load simulation data - this is now pulling from PHP variables
        function loadSimulationData() {
            // No need to set values here explicitly, as they are now set by Blade:
            // value="{{ $data->frekuensi ?? '' }}"
            // value="{{ $data->path_loss ?? '' }}"
            // The purpose of this function in the original code seems to have been
            // to populate with default or fetched data, which Blade handles now.
            // However, we still call updateReceivedPower to calculate initial output.
            updateReceivedPowerUplink();
            updateReceivedPowerDownlink();
        }

        // POP UP Logic
        function openPopup(popupId) {
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            document.getElementById(popupId).style.display = "flex";
            
            // Force MathJax to re-render the popup content
            setTimeout(() => {
                if (typeof MathJax !== 'undefined' && MathJax.typesetPromise) {
                    MathJax.typesetPromise([document.getElementById(popupId)]).catch((err) => {
                        console.log('MathJax error:', err);
                    });
                }
            }, 100);
        }

        // Event listener for the "What is Hardware Simulation?" button
        document.getElementById('info_hardware_general_btn').onclick = () => {
            openPopup('popup_hardware_general');
        };

        // Event listeners for "Lihat Detail" buttons
        // Corrected IDs for frequency detail buttons
        document.getElementById('frequency_tx_uplink_popup_btn').onclick = () => {
            openPopup('frequency_tx_uplink_popup');
        };
        document.getElementById('frequency_tx_downlink_popup_btn').onclick = () => {
            openPopup('frequency_tx_downlink_popup');
        };
        // The original HTML had 'dbm_tx_uplink_popup_btn' and 'dbm_tx_downlink_popup_btn'
        // for frequency details. I've updated the HTML to match the popup IDs.
        // If you intended to have a single popup for both uplink/downlink input power,
        // then the original button IDs and this listener for 'dbm_tx_popup' would be correct.
        // I've commented out the original dbm_tx_popup_btn and created separate ones in HTML
        // to align with the distinct frequency popups.
        
        // If 'dbm_tx_popup' is intended for a generic input power explanation,
        // you would need to add a button for it specifically, or reuse one.
        // For now, let's make sure the correct popups open for the current HTML structure.
        // The HTML for dbm_tx_uplink/downlink *input power* does not have a "Lihat Detail" button.
        // I've added a generic 'dbm_tx_popup' button for explanation of input power concept.
        // If you want specific popups for Uplink Input Power and Downlink Input Power,
        // you'd need to add separate popup divs for them (e.g., 'dbm_tx_uplink_detail_popup').
        
        // Let's assume 'dbm_tx_popup' is for a generic explanation.
        // If you want to put a "Lihat Detail" button next to "Input Power (dBm):"
        // you would need to add its ID to the HTML. For example:
        // <button type="button" id="input_power_general_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
        // And then its event listener here:
        // document.getElementById('input_power_general_popup_btn').onclick = () => {
        //     openPopup('dbm_tx_popup');
        // };

        document.getElementById('total_loss_uplink_popup_btn').onclick = () => {
            openPopup('total_loss_uplink_popup');
        };
        document.getElementById('total_loss_downlink_popup_btn').onclick = () => {
            openPopup('total_loss_downlink_popup');
        };
        document.getElementById('received_power_rx_uplink_popup_btn').onclick = () => {
            openPopup('received_power_rx_uplink_popup');
        };
        document.getElementById('received_power_rx_downlink_popup_btn').onclick = () => {
            openPopup('received_power_rx_downlink_popup');
        };

        // Function to close all popups
        document.querySelectorAll('.close-popup-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            };
        });

        // Event listener for form submission
        document.querySelector('form').addEventListener('submit', function(event) {
            let formIsValid = true;

            // Validation for input fields (read-only fields generally don't need input validation)
            formIsValid = validateDbmTxUplink() && formIsValid;
            formIsValid = validateDbmTxDownlink() && formIsValid;
            
            // For read-only fields, their 'validation' is more about the source of data.
            // If they are filled from backend (e.g., $data->frekuensi), assume they are valid.
            // If you still want to run some range checks on these pre-filled values,
            // you'd need to modify validateFrequencyUplink/Downlink and validateTotalLossUplink/Downlink
            // to actually check the numeric value, not just return true.

            if (!formIsValid) {
                event.preventDefault();
                alert('Terdapat kesalahan input. Mohon periksa kembali semua bidang yang ditandai.');
            }
        });

        // Initialize fields and add event listeners when the DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            loadSimulationData(); // Call to populate initial calculated output values

            // Add event listeners for dynamic input fields
            document.getElementById('dbm_tx_uplink').addEventListener('input', () => {
                validateDbmTxUplink();
                updateReceivedPowerUplink();
            });
            
            document.getElementById('dbm_tx_downlink').addEventListener('input', () => {
                validateDbmTxDownlink();
                updateReceivedPowerDownlink();
            });

            // Re-run calculations if readonly values somehow change (e.g., via browser dev tools)
            // or if the page loads with initial $data values.
            // For robust behavior, calling updateReceivedPowerUplink/Downlink on DOMContentLoaded is good.
            updateReceivedPowerUplink();
            updateReceivedPowerDownlink();

            // MathJax typesetting for initially visible content
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        });

        // Add a separate load listener for MathJax typesetting
        window.addEventListener('load', () => {
            // Ensure all MathJax elements are typeset, especially after dynamic content loads
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        });

        // Configuration for MathJax
        window.MathJax = {
            tex: {
                // Corrected inlineMath delimiters to avoid conflict with natural commas in text
                // You can use \ ( and \ ) for inline LaTeX as well:
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