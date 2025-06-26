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
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl transform transition-all duration-300 hover:shadow-3xl border-t-8 border-blue-600">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                    <i class="text-blue-600"></i> Simulasi Hardware
                </h1>
                <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                    Masukkan parameter untuk simulasi hardware (Input, Loss, dan Output).
                </p>

                {{-- "Apa itu Simulasi Hardware?" button --}}
                <div class="mb-6 text-right animate__animated animate__fadeInUp">
                    <button type="button" id="info_hardware_general_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">
                        Apa itu Simulasi Hardware? <i class="fas fa-info-circle ml-1"></i>
                    </button>
                </div>

                {{-- Pastikan $dataId dilewatkan dari controller, contoh: return view('simulationhardware', ['dataId' => $id]); --}}
                <form method="POST" action="{{ route('simulationhardware.store', $dataId ?? 'default_id') }}">
                    @csrf {{-- Tambahkan CSRF token untuk Laravel --}}
                    {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? '' }}"> --}}

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Tx (INPUT)</h2>
                        <div class="relative mb-6">
                            <div class="text-center text-gray-500 italic">
                                </div>
                        </div>

                        <div class="relative mb-4">
                            <label for="frequency_tx" class="block font-medium mb-2 text-gray-700">Frekuensi (5-6000 MHz):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="1" id="frequency_tx" name="frequency_tx"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Masukkan nilai Frekuensi" min="5" max="6000">
                                <span class="unit-text">MHz</span>
                            </div>
                            <div id="frequency-warning" class="text-red-600 text-sm mt-1 hidden">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Nilai frekuensi harus antara 5 dan 6000 MHz.
                            </div>
                        </div>

                        <div class="input-group flex flex-col md:flex-row md:space-x-6">
                            <div class="relative w-full md:w-1/3">
                                <label for="watt_tx" class="block font-medium mb-2 text-gray-700">Daya Input (Watt):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="0.001" id="watt_tx" name="watt_tx"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                        placeholder="Masukkan nilai Watt" min="0" max="1">
                                    <span class="unit-text">W</span>
                                </div>
                                <div id="watt-warning" class="text-red-600 text-sm mt-1 hidden">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Daya input harus antara 0 dan 1 Watt.
                                </div>
                            </div>

                            <div class="relative w-full md:w-1/3">
                                <label for="dbw_tx" class="block font-medium mb-2 text-gray-700">Daya Input (dBW):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="dbw_tx" name="dbw_tx"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil dBW" readonly>
                                    <span class="unit-text">dBW</span>
                                </div>
                                <button type="button" id="dbw_tx_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="relative w-full md:w-1/3">
                                <label for="dbm_tx" class="block font-medium mb-2 text-gray-700">Daya Input (dBm):</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="dbm_tx" name="dbm_tx"
                                        class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                        placeholder="Hasil dBm" readonly>
                                    <span class="unit-text">dBm</span>
                                </div>
                                <button type="button" id="dbm_tx_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-red-50 p-6 rounded-lg border border-red-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">FSL/LOSS (INPUT)</h2>
                        <div class="relative mb-6">
                            <div class="text-center text-gray-500 italic">
                                </div>
                        </div>

                        <div class="relative mt-4">
                            <label for="total_loss" class="block font-medium mb-2 text-gray-700">Total Loss (Dari hitungan web) (dB):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="0.001" name="total_loss" id="total_loss"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                    placeholder="Masukkan nilai Total Loss" min="0" max="95.25">
                                <span class="unit-text">dB</span>
                            </div>
                            <div id="total-loss-warning" class="text-red-600 text-sm mt-1 hidden">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Total loss harus antara 0 dan 95.25 dB.
                            </div>
                            <button type="button" id="total_loss_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>
                    </div>

                    <div class="bg-green-50 p-6 rounded-lg border border-green-200 shadow-sm mb-6">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Rx (OUTPUT)</h2>
                        <div class="relative mb-6">
                            <div class="text-center text-gray-500 italic">
                                </div>
                        </div>

                        <div class="relative mt-4">
                            <label for="received_power_rx" class="block font-medium mb-2 text-gray-700">Daya yang diterima (dBW):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="text" name="received_power_rx" id="received_power_rx"
                                    class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm"
                                    placeholder="Hasil Daya yang Diterima" readonly>
                                <span class="unit-text">dBW</span>
                            </div>
                            <button type="button" id="received_power_rx_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class=""></i> Hitung & Simpan
                    </button>
                </form>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('history') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
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
                            <li><strong>Frekuensi (5-6000 MHz):</strong> Rentang frekuensi sinyal yang akan disimulasikan.</li>
                            <li><strong>Daya Input (Watt, dBW, dBm):</strong> Daya awal sinyal yang dihasilkan, dapat diukur dalam Watt, dBW (decibel-watt), atau dBm (decibel-milliwatt).</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">FSL/Loss (Input)</h4>
                        <p class="section-content">
                            Bagian ini digunakan untuk memasukkan semua jenis kehilangan daya yang mungkin terjadi pada jalur transmisi. Ini adalah faktor-faktor yang akan mengurangi kekuatan sinyal dari pemancar hingga penerima.
                        </p>
                        <ul class="param-list">
                            <li><strong>Total Loss (Dari hitungan web) (dB):</strong> Representasi total kehilangan daya yang dihitung dari berbagai faktor (seperti kehilangan jalur, kehilangan konektor, dll.) yang mungkin didapatkan dari perhitungan eksternal atau modul lain.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Receiver (Rx) Output</h4>
                        <p class="section-content">
                            Ini adalah bagian output yang menunjukkan hasil simulasi, yaitu daya sinyal yang diterima setelah semua kehilangan diperhitungkan.
                        </p>
                        <ul class="param-list">
                            <li><strong>Daya yang diterima (dBW):</strong> Daya sinyal akhir yang berhasil sampai ke penerima setelah melalui proses transmisi dan mengalami berbagai kehilangan.</li>
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
    <div id="dbw_tx_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Daya Input (dBW)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{dBW} = 10 \times \log_{10}(\text{Watt})$$
                        Dimana:<br>
                        $P_{dBW}$ = Daya dalam desibel-watt<br>
                        Watt = Daya dalam watt
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    dBW adalah satuan ukuran daya yang dinyatakan dalam desibel (dB) relatif terhadap 1 watt. Ini sering digunakan dalam telekomunikasi untuk menyatakan daya transmit. Setiap kenaikan 3 dBW berarti daya berlipat ganda, dan setiap kenaikan 10 dBW berarti daya berlipat 10 kali.</p>
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
                        $$P_{dBm} = P_{dBW} + 30$$
                        Atau<br>
                        $$P_{dBm} = 10 \times \log_{10}(\text{mW})$$
                        Dimana:<br>
                        $P_{dBm}$ = Daya dalam desibel-milliwatt<br>
                        $P_{dBW}$ = Daya dalam desibel-watt<br>
                        mW = Daya dalam milliwatt
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    dBm adalah satuan ukuran daya yang dinyatakan dalam desibel (dB) relatif terhadap 1 milliwatt (mW). Ini umumnya digunakan untuk mengukur daya sinyal dalam komunikasi nirkabel dan serat optik. Konversi dari dBW ke dBm adalah menambahkan 30 karena 1 Watt = 1000 mW, dan $10 \log_{10}(1000) = 30$.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="total_loss_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Total Loss (dB)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Konseptual:</strong><br>
                        $$\text{Total Loss} = \text{Loss}_{FSL} + \text{Loss}_{Cable} + \text{Loss}_{Connector} + \text{Loss}_{Other} + ...$$
                        Dimana:<br>
                        $\text{Loss}_{FSL}$ = Free Space Loss (kehilangan ruang bebas)<br>
                        $\text{Loss}_{Cable}$ = Kehilangan kabel/waveguide<br>
                        $\text{Loss}_{Connector}$ = Kehilangan konektor<br>
                        $\text{Loss}_{Other}$ = Kehilangan lain-lain (filter, perangkat, dll.)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Total Loss adalah akumulasi semua kehilangan daya sinyal yang terjadi selama transmisi dari pemancar ke penerima. Ini bisa termasuk Free Space Loss (FSL), kehilangan pada kabel atau waveguide, kehilangan pada konektor, dan kehilangan-kehilangan lain yang disebabkan oleh komponen-komponen pasif atau aktif di sepanjang jalur sinyal. Nilai ini sangat penting untuk akurasi perhitungan Link Budget.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="received_power_rx_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Daya yang Diterima (dBW)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Konseptual:</strong><br>
                        $$P_{Rx} = P_{Tx} - L_{Total}$$
                        Dimana:<br>
                        $P_{Rx}$ = Daya yang diterima (Received Power)<br>
                        $P_{Tx}$ = Daya Input Transmitter<br>
                        $L_{Total}$ = Total Loss (dari semua sumber kehilangan)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Daya yang diterima ($P_{Rx}$) adalah ukuran kekuatan sinyal yang berhasil mencapai input penerima. Ini dihitung dengan mengambil daya input awal dari pemancar ($P_{Tx}$) dan menguranginya dengan semua total kehilangan daya ($L_{Total}$) yang terjadi di sepanjang jalur transmisi. Daya yang diterima yang memadai sangat krusial untuk memastikan komunikasi yang handal dan berkualitas.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function for power conversion (Watt to dBW and dBm)
        function updatePowerFields(wattId, dbwId, dbmId) {
            const wattInput = document.getElementById(wattId);
            const dbwOutput = document.getElementById(dbwId);
            const dbmOutput = document.getElementById(dbmId);

            const watt = parseFloat(wattInput.value);

            // Only update if watt is a valid number within the allowed range
            // The specific validation for the input field itself is handled by validateWattTx()
            if (!isNaN(watt) && watt >= 0 && watt <= 1) {
                const dbw = (watt === 0) ? -Infinity : 10 * Math.log10(watt); // Handle log(0) for dBW
                const dbm = (watt === 0) ? -Infinity : dbw + 30; // Handle log(0) for dBm

                dbwOutput.value = isFinite(dbw) ? dbw.toFixed(3) : '-Infinity';
                dbmOutput.value = isFinite(dbm) ? dbm.toFixed(3) : '-Infinity';
            } else {
                dbwOutput.value = '';
                dbmOutput.value = '';
            }
        }

        // Function to calculate and update received power
        function updateReceivedPower() {
            const wattTxInput = document.getElementById('watt_tx');
            const totalLossInput = document.getElementById('total_loss');
            const receivedPowerRxOutput = document.getElementById('received_power_rx');

            const wattTx = parseFloat(wattTxInput.value);
            const totalLoss = parseFloat(totalLossInput.value);

            // Check if values are valid before calculation
            // These individual validations are now tied to their respective input fields
            const isWattTxValidForCalc = !isNaN(wattTx) && wattTx >= 0 && wattTx <= 1;
            const isTotalLossValidForCalc = !isNaN(totalLoss) && totalLoss >= 0 && totalLoss <= 95.25;

            if (isWattTxValidForCalc && isTotalLossValidForCalc) {
                const powerTx_dBW = (wattTx === 0) ? -Infinity : 10 * Math.log10(wattTx);

                if (isFinite(powerTx_dBW)) {
                    const receivedPower_dBW = powerTx_dBW - totalLoss;
                    receivedPowerRxOutput.value = receivedPower_dBW.toFixed(3);
                } else {
                    receivedPowerRxOutput.value = '-Infinity';
                }
            } else {
                receivedPowerRxOutput.value = '';
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
            const rawValue = inputElement.value.trim(); // Get raw value to check if empty

            let isValid = true;

            // If the input is empty, hide the warning and clear error styling
            if (rawValue === '') {
                warningElement.classList.add('hidden');
                inputElement.classList.remove('input-error');
                inputElement.classList.add('border-gray-300', 'focus:border-blue-400', 'focus:ring-blue-400');
                return true; // Consider empty as "not yet invalid"
            }

            // If not empty, proceed with numerical validation
            if (isNaN(value) || value < minVal || value > maxVal) {
                warningElement.textContent = warningMessage;
                warningElement.classList.remove('hidden'); // Show the warning
                inputElement.classList.remove('border-gray-300', 'focus:border-blue-400', 'focus:ring-blue-400');
                inputElement.classList.add('input-error'); // Add error styling
                isValid = false;
            } else {
                warningElement.classList.add('hidden'); // Hide the warning
                inputElement.classList.remove('input-error'); // Remove error styling
                inputElement.classList.add('border-gray-300', 'focus:border-blue-400', 'focus:ring-blue-400'); // Restore normal styling
            }
            return isValid;
        }

        // Specific validation functions for each input
        function validateFrequency() {
            const input = document.getElementById('frequency_tx');
            const warning = document.getElementById('frequency-warning');
            return validateInputRange(input, warning, 5, 6000, 'Nilai frekuensi harus antara 5 dan 6000 MHz.');
        }

        function validateWattTx() {
            const input = document.getElementById('watt_tx');
            const warning = document.getElementById('watt-warning');
            return validateInputRange(input, warning, 0, 1, 'Daya input harus antara 0 dan 1 Watt.');
        }

        function validateTotalLoss() {
            const input = document.getElementById('total_loss');
            const warning = document.getElementById('total-loss-warning');
            return validateInputRange(input, warning, 0, 95.25, 'Total loss harus antara 0 dan 95.25 dB.');
        }


        // Function to load simulation data (placeholder for actual backend fetch)
        function loadSimulationData() {
            // This function now only loads data without triggering immediate warnings
            const simulationData = {
                frequency_tx: null,
                watt_tx: null,
                total_loss: null
            };

            document.getElementById('frequency_tx').value = simulationData.frequency_tx || '';
            document.getElementById('watt_tx').value = simulationData.watt_tx || '';
            document.getElementById('total_loss').value = simulationData.total_loss || '';

            // Update calculated fields based on initial/loaded values
            updatePowerFields('watt_tx', 'dbw_tx', 'dbm_tx');
            updateReceivedPower();
            
            // No initial validation calls here. Warnings will appear on user interaction.
        }

        // POP UP Logic
        // General function to open a popup
        function openPopup(popupId) {
            // Close all other open popups
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');

            document.getElementById(popupId).style.display = "flex";
            // Important: After opening, if MathJax is loaded, re-render math formulas
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        // Event listener for the "What is Hardware Simulation?" button
        document.getElementById('info_hardware_general_btn').onclick = () => {
            openPopup('popup_hardware_general');
        };

        // Event listeners for "Lihat Detail" buttons
        document.getElementById('dbw_tx_popup_btn').onclick = () => {
            openPopup('dbw_tx_popup');
        };
        document.getElementById('dbm_tx_popup_btn').onclick = () => {
            openPopup('dbm_tx_popup');
        };
        document.getElementById('total_loss_popup_btn').onclick = () => {
            openPopup('total_loss_popup');
        };
        document.getElementById('received_power_rx_popup_btn').onclick = () => {
            openPopup('received_power_rx_popup');
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

            // Run all validations on submit, forcing warnings to show if invalid or empty
            formIsValid = validateFrequency() && formIsValid;
            formIsValid = validateWattTx() && formIsValid;
            formIsValid = validateTotalLoss() && formIsValid;

            // If any validation fails, prevent form submission
            if (!formIsValid) {
                event.preventDefault();
                alert('Terdapat kesalahan input. Mohon periksa kembali semua bidang yang ditandai.'); // Alert revised
            }
        });


        // Initialize fields and add event listeners when the DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            loadSimulationData(); // Load initial data (without immediate validation warnings)

            // Add event listeners for frequency (real-time validation on input)
            document.getElementById('frequency_tx').addEventListener('input', validateFrequency);

            // Add event listeners for watt_tx (real-time validation on input)
            document.getElementById('watt_tx').addEventListener('input', () => {
                validateWattTx(); // Validate Watt first
                updatePowerFields('watt_tx', 'dbw_tx', 'dbm_tx');
                updateReceivedPower();
            });

            // Add event listeners for total_loss (real-time validation on input)
            document.getElementById('total_loss').addEventListener('input', () => {
                validateTotalLoss(); // Validate Total Loss first
                updateReceivedPower();
            });
        });

        // Add a separate load listener for MathJax typesetting
        window.addEventListener('load', () => {
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
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