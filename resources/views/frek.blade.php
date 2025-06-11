<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        /* Hapus atau nonaktifkan .input-unit jika tidak lagi digunakan di dalam input */
        /* .input-unit {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
            font-size: 0.875rem;
            pointer-events: none;
            line-height: 1;
        } */

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

        /* Popup Styles (Copied from transmitter.blade.php for consistency) */
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
            padding: 20px 30px 30px;
            border-radius: 8px; /* Adjusted to match your calc.blade.php popups */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3); /* Adjusted */
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            /* Animation from calc.blade.php for consistency */
            animation: fadeInScale 0.3s ease-out;
        }
        .close-popup-btn {
            position: absolute;
            top: 10px; /* Adjusted */
            right: 15px; /* Adjusted */
            font-size: 24px; /* Adjusted */
            font-weight: bold;
            color: #555; /* Adjusted */
            cursor: pointer;
            transition: color 0.2s ease; /* Added for consistency */
        }

        .close-popup-btn:hover {
            color: #000; /* Adjusted */
        }

        .formula {
            background-color: #f5f5f5; /* Adjusted */
            padding: 10px 15px; /* Adjusted */
            border-radius: 5px; /* Adjusted */
            border-left: 4px solid #4CAF50; /* Adjusted */
            margin: 15px 0; /* Adjusted */
            font-family: 'Cambria Math', 'Times New Roman', serif;
        }

        .popup-content h3 {
            margin-top: 0;
            color: #2c3e50; /* Adjusted */
            border-bottom: 1px solid #eee; /* Adjusted */
            padding-bottom: 10px; /* Adjusted */
        }

        .popup-content p {
            margin: 8px 0; /* Adjusted */
            line-height: 1.5;
            color: #374151; /* Added for consistency */
        }
        /* Keyframes from calc.blade.php, needed if you want the animation */
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
            /* Hapus pr-16 dari kelas input di HTML, dan gunakan padding-right standar */
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
    </style>

    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="fas fa-wave-square mr-2 text-blue-600"></i> Perhitungan Frekuensi
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Masukkan nilai frekuensi dan parameter lainnya untuk mendapatkan hasil perhitungan panjang gelombang dan path loss.
            </p>

            <form method="POST" action="{{ route('frek.store', $dataId )}}">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

            {{-- Uplink Frekuensi --}}
            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Uplink Frekuensi</h2>

                <div class="input-group">
                    <div class="relative">
                        <label for="frekuensi" class="block font-medium mb-2 text-gray-700">Frekuensi:</label>
                        <div class="input-with-unit-wrapper"> {{-- Pembungkus baru --}}
                            <input type="number" step="0.001" name="frekuensi" id="frekuensi" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Frekuensi" oninput="hitungPerhitungan()">
                            <span class="unit-text">MHz</span> {{-- Unit di luar input --}}
                        </div>
                    </div>
                    <div class="relative">
                        <label for="panjang_gelombang" class="block font-medium mb-2 text-gray-700">Panjang Gelombang (λ):</label>
                        <div class="input-with-unit-wrapper"> {{-- Pembungkus baru --}}
                            <input type="text" name="panjang_gelombang" id="panjang_gelombang" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <span class="unit-text">Meter</span> {{-- Unit di luar input --}}
                        </div>
                        <button type="button" id="popup_lambda_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>
                    {{-- DISPLAY Slant Range dari halaman Orbit (Opsional) --}}
                    <div class="relative">
                        <label for="display_slant_range_uplink" class="block font-medium mb-2 text-gray-700">Slant Range Uplink (dari Orbit):</label>
                        <div class="input-with-unit-wrapper"> {{-- Pembungkus baru --}}
                            <input type="text" id="display_slant_range_uplink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm">
                            <span class="unit-text">km</span> {{-- Unit di luar input --}}
                        </div>
                    </div>
                    <div class="relative">
                        <label for="path_loss" class="block font-medium mb-2 text-gray-700">Path Loss:</label>
                        <div class="input-with-unit-wrapper"> {{-- Pembungkus baru --}}
                            <input type="text" name="path_loss" id="path_loss" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <span class="unit-text">dB</span> {{-- Unit di luar input --}}
                        </div>
                    <button type="button" id="popup_pathloss_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                    </button>
                    </div>
                </div>
            </div>

            {{-- Downlink Frekuensi --}}
            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                <h2 class="text-lg font-semibold mb-3 text-gray-800 text-center">Downlink Frekuensi</h2>

                <div class="input-group">
                    <div class="relative">
                        <label for="frekuensi_downlink" class="block font-medium mb-2 text-gray-700">Frekuensi:</label>
                        <div class="input-with-unit-wrapper"> {{-- Pembungkus baru --}}
                            <input type="number" step="0.001" name="frekuensi_downlink" id="frekuensi_downlink" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Frekuensi" oninput="hitungPerhitungan()">
                            <span class="unit-text">MHz</span> {{-- Unit di luar input --}}
                        </div>
                    </div>
                    <div class="relative">
                        <label for="panjang_gelombang_downlink" class="block font-medium mb-2 text-gray-700">Panjang Gelombang (λ):</label>
                        <div class="input-with-unit-wrapper"> {{-- Pembungkus baru --}}
                            <input type="text" name="panjang_gelombang_downlink" id="panjang_gelombang_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <span class="unit-text">Meter</span> {{-- Unit di luar input --}}
                        </div>
                        <button type="button" id="popup_lambda_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>
                    {{-- DISPLAY Slant Range dari halaman Orbit (Opsional) --}}
                    <div class="relative">
                        <label for="display_slant_range_downlink" class="block font-medium mb-2 text-gray-700">Slant Range Downlink (dari Orbit):</label>
                        <div class="input-with-unit-wrapper"> {{-- Pembungkus baru --}}
                            <input type="text" id="display_slant_range_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm">
                            <span class="unit-text">km</span> {{-- Unit di luar input --}}
                        </div>
                    </div>
                    <div class="relative">
                        <label for="path_loss_downlink" class="block font-medium mb-2 text-gray-700">Path Loss:</label>
                        <div class="input-with-unit-wrapper"> {{-- Pembungkus baru --}}
                            <input type="text" name="path_loss_downlink" id="path_loss_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                            <span class="unit-text">dB</span> {{-- Unit di luar input --}}
                        </div>
                    <button type="button" id="popup_pathloss_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                    </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <i class="fas fa-save mr-2"></i> Hitung & Simpan
            </button>
            </form>
            <div class="flex justify-between mt-6">
                <a href="/calc/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
                </a>

                {{-- Uncomment this if you have a next page
                <a href="/next-page/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                    Halaman Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
                --}}
            </div>
        </div>


        {{-- Popup Panjang Gelombang Uplink --}}
        <div id="popup_lambda_up" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Perhitungan Panjang Gelombang</h3>
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        λ = c / f<br>
                        Dimana:<br>
                        λ = Panjang gelombang (meter)<br>
                        c = Kecepatan cahaya (~299.8 m/s)<br>
                        f = Frekuensi (Hz)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Panjang gelombang adalah jarak antara titik-titik yang berurutan dari suatu gelombang yang memiliki fasa yang sama. Parameter ini sangat penting dalam desain antena karena dimensi fisik antena seringkali merupakan kelipatan dari panjang gelombang.</p>
                </div>
            </div>
        </div>

        {{-- Popup Path Loss Uplink --}}
        <div id="popup_pathloss_up" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Perhitungan Path Loss</h3>
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        L = 22 + 20 log₁₀((Slant Range * 1000) / Panjang Gelombang)<br>
                        Dimana:<br>
                        L = Path Loss (dB)<br>
                        Slant Range = Jarak miring antara Tx dan Rx (meter)<br>
                        Panjang Gelombang = λ (meter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Path loss (kehilangan jalur) adalah pengurangan kerapatan daya gelombang elektromagnetik saat merambat melalui ruang. Ini adalah faktor kunci dalam desain tautan komunikasi satelit, menunjukkan seberapa banyak daya sinyal yang hilang sebelum mencapai penerima. Rumus yang digunakan adalah variasi dari rumus Free-Space Path Loss (FSPL) yang memperhitungkan jarak (Slant Range) dan panjang gelombang sinyal.</p>
                </div>
            </div>
        </div>

        {{-- Popup Panjang Gelombang Downlink --}}
        <div id="popup_lambda_down" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Perhitungan Panjang Gelombang</h3>
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        λ = c / f<br>
                        Dimana:<br>
                        λ = Panjang gelombang (meter)<br>
                        c = Kecepatan cahaya (~299.8 m/s)<br>
                        f = Frekuensi (Hz)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Panjang gelombang adalah jarak antara titik-titik yang berurutan dari suatu gelombang yang memiliki fasa yang sama. Parameter ini sangat penting dalam desain antena karena dimensi fisik antena seringkali merupakan kelipatan dari panjang gelombang.</p>
                </div>
            </div>
        </div>

        {{-- Popup Path Loss Downlink --}}
        <div id="popup_pathloss_down" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Perhitungan Path Loss</h3>
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        L = 22 + 20 log₁₀((Slant Range * 1000) / Panjang Gelombang)<br>
                        Dimana:<br>
                        L = Path Loss (dB)<br>
                        Slant Range = Jarak miring antara Tx dan Rx (meter)<br>
                        Panjang Gelombang = λ (meter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Path loss (kehilangan jalur) adalah pengurangan kerapatan daya gelombang elektromagnetik saat merambat melalui ruang. Ini adalah faktor kunci dalam desain tautan komunikasi satelit, menunjukkan seberapa banyak daya sinyal yang hilang sebelum mencapai penerima. Rumus yang digunakan adalah variasi dari rumus Free-Space Path Loss (FSPL) yang memperhitungkan jarak (Slant Range) dan panjang gelombang sinyal.</p>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Perhitungan Panjang Gelombang dan Path Loss
        function hitungPerhitungan() {
            const frekuensi = parseFloat(document.getElementById('frekuensi').value);
            const frekuensi_downlink = parseFloat(document.getElementById('frekuensi_downlink').value);
            // Kecepatan cahaya efektif untuk rumus 299.8 / f (f dalam MHz)
            const c_effective = 299.8;

            // --- AMBIL NILAI DARI LOCAL STORAGE BERDASARKAN ORBIT YANG TERAKHIR DIPILIH ---
            const lastSelectedOrbit = localStorage.getItem('lastSelectedOrbit');
            let currentSlantRangeUplink = 0;
            let currentSlantRangeDownlink = 0;

            if (lastSelectedOrbit === 'LEO' || lastSelectedOrbit === 'MEO') {
                currentSlantRangeUplink = parseFloat(localStorage.getItem('slantRangeLEOMEO')) || 0;
                currentSlantRangeDownlink = parseFloat(localStorage.getItem('slantRangeLEOMEO')) || 0;
            } else if (lastSelectedOrbit === 'GEO') {
                currentSlantRangeUplink = parseFloat(localStorage.getItem('slantRangeGEOUplink')) || 0;
                currentSlantRangeDownlink = parseFloat(localStorage.getItem('slantRangeGEODownlink')) || 0;
            }

            // Tampilkan nilai slant range yang diambil dari localStorage ke input display
            if (document.getElementById('display_slant_range_uplink')) {
                document.getElementById('display_slant_range_uplink').value = currentSlantRangeUplink > 0 ? currentSlantRangeUplink.toFixed(3) : '';
            }
            if (document.getElementById('display_slant_range_downlink')) {
                document.getElementById('display_slant_range_downlink').value = currentSlantRangeDownlink > 0 ? currentSlantRangeDownlink.toFixed(3) : '';
            }
            // --- AKHIR PENGAMBILAN DARI LOCAL STORAGE ---


            // Perhitungan untuk uplink
            if (!isNaN(frekuensi) && frekuensi > 0 && currentSlantRangeUplink > 0) {
                const panjangGelombang = c_effective / frekuensi;
                document.getElementById('panjang_gelombang').value = panjangGelombang.toFixed(5); // 5 desimal
                
                const pathLoss = 22 + 20 * Math.log10((currentSlantRangeUplink * 1000) / panjangGelombang);
                document.getElementById('path_loss').value = pathLoss.toFixed(5); // 5 desimal
            } else {
                document.getElementById('panjang_gelombang').value = '';
                document.getElementById('path_loss').value = '';
            }

            // Perhitungan untuk downlink
            if (!isNaN(frekuensi_downlink) && frekuensi_downlink > 0 && currentSlantRangeDownlink > 0) {
                const panjangGelombangDownlink = c_effective / frekuensi_downlink;
                document.getElementById('panjang_gelombang_downlink').value = panjangGelombangDownlink.toFixed(5); // 5 desimal

                const pathLossDownlink = 22 + 20 * Math.log10((currentSlantRangeDownlink * 1000) / panjangGelombangDownlink);
                document.getElementById('path_loss_downlink').value = pathLossDownlink.toFixed(5); // 5 desimal
            } else {
                document.getElementById('panjang_gelombang_downlink').value = '';
                document.getElementById('path_loss_downlink').value = '';
            }
        }

        // Menambahkan event listener untuk input frekuensi dan downlink
        document.getElementById('frekuensi').addEventListener('input', hitungPerhitungan);
        document.getElementById('frekuensi_downlink').addEventListener('input', hitungPerhitungan);

        // Panggil hitungPerhitungan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', hitungPerhitungan);

        // --- Logika Popups ---
        // Fungsi umum untuk membuka pop-up
        function openPopup(popupId) {
            document.getElementById(popupId).style.display = "flex";
        }

        // Event listener untuk tombol "Lihat Detail" Panjang Gelombang Uplink
        document.getElementById('popup_lambda_up_btn').onclick = () => {
            openPopup('popup_lambda_up');
        };

        // Event listener untuk tombol "Lihat Detail" Path Loss Uplink
        document.getElementById('popup_pathloss_up_btn').onclick = () => {
            openPopup('popup_pathloss_up');
        };

        // Event listener untuk tombol "Lihat Detail" Panjang Gelombang Downlink
        document.getElementById('popup_lambda_down_btn').onclick = () => {
            openPopup('popup_lambda_down');
        };

        // Event listener untuk tombol "Lihat Detail" Path Loss Downlink
        document.getElementById('popup_pathloss_down_btn').onclick = () => {
            openPopup('popup_pathloss_down');
        };

        // Fungsi tutup semua popup (tetap sama)
        document.querySelectorAll('.close-popup-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            };
        });
    </script>
</x-layout>