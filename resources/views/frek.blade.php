<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

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

        /* Popup Styles (Copied from transmitter.blade.php for consistency) */
        /* These styles are already in your original frekuensi.blade.php, ensuring consistency */
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
                <h2 class="text-lg font-semibold mb-3 text-gray-800">Uplink Frekuensi</h2>

                <div class="input-group">
                    <div class="relative">
                        <label for="frekuensi" class="block font-medium mb-2 text-gray-700">Frekuensi:</label>
                        <div class="flex items-center">
                            <input type="number" step="0.001" name="frekuensi" id="frekuensi" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Frekuensi">
                            <span id="frekuensi_satuan_display" class="input-unit">MHz</span>
                        </div>
                    </div>
                    <div class="relative">
                        <label for="panjang_gelombang" class="block font-medium mb-2 text-gray-700">Panjang Gelombang (λ):</label>
                        <div class="flex items-center">
                            <input type="text" name="panjang_gelombang" id="panjang_gelombang" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16">
                            <span class="input-unit">Meter</span>
                        </div>
                        <button type="button" id="popup_lambda_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>
                    {{-- DISPLAY Slant Range dari halaman Orbit (Opsional) --}}
                    <div class="relative">
                        <label for="display_slant_range_uplink" class="block font-medium mb-2 text-gray-700">Slant Range Uplink (dari Orbit):</label>
                        <input type="text" id="display_slant_range_uplink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pr-16">
                        <span class="input-unit">km</span>
                    </div>
                    <div class="relative">
                        <label for="path_loss" class="block font-medium mb-2 text-gray-700">Path Loss:</label>
                        <div class="flex items-center">
                            <input type="text" name="path_loss" id="path_loss" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16">
                            <span class="input-unit">dB</span>
                        </div>
                    <button type="button" id="popup_pathloss_up_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                        Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                    </button>
                    </div>
                </div>
            </div>

            {{-- Downlink Frekuensi --}}
            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                <h2 class="text-lg font-semibold mb-3 text-gray-800">Downlink Frekuensi</h2>

                <div class="input-group">
                    <div class="relative">
                        <label for="frekuensi_downlink" class="block font-medium mb-2 text-gray-700">Frekuensi:</label>
                        <div class="flex items-center">
                            <input type="number" step="0.001" name="frekuensi_downlink" id="frekuensi_downlink" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Frekuensi">
                            <span id="frekuensi_downlink_satuan_display" class="input-unit">MHz</span>
                        </div>
                    </div>
                    <div class="relative">
                        <label for="panjang_gelombang_downlink" class="block font-medium mb-2 text-gray-700">Panjang Gelombang (λ):</label>
                        <div class="flex items-center">
                            <input type="text" name="panjang_gelombang_downlink" id="panjang_gelombang_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16">
                            <span class="input-unit">Meter</span>
                        </div>
                        <button type="button" id="popup_lambda_down_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">
                            Lihat Detail <i class="fas fa-info-circle ml-1"></i>
                        </button>
                    </div>
                    {{-- DISPLAY Slant Range dari halaman Orbit (Opsional) --}}
                    <div class="relative">
                        <label for="display_slant_range_downlink" class="block font-medium mb-2 text-gray-700">Slant Range Downlink (dari Orbit):</label>
                        <input type="text" id="display_slant_range_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pr-16">
                        <span class="input-unit">km</span>
                    </div>
                    <div class="relative">
                        <label for="path_loss_downlink" class="block font-medium mb-2 text-gray-700">Path Loss:</label>
                        <div class="flex items-center">
                            <input type="text" name="path_loss_downlink" id="path_loss_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16">
                            <span class="input-unit">dB</span>
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
                <h3>Rumus Panjang Gelombang (Uplink)</h3>
                <p class="formula">λ = c / f</p>
                <p>c (Kecepatan Cahaya) = 299.8 (dalam km/s, atau 299,800,000 m/s untuk frekuensi dalam Hz)<br>f (Frekuensi) = <span id="frekuensi_up_text"></span> MHz<br>λ = <span id="hasil_lambda_up"></span> meter</p>
                <p><strong>Penjelasan:</strong> Panjang gelombang (λ) adalah jarak spasial satu siklus gelombang. Hubungannya dengan frekuensi (f) dan kecepatan cahaya (c) adalah $\lambda = c / f$. Dalam perhitungan ini, kecepatan cahaya disesuaikan untuk frekuensi dalam MHz, sehingga hasilnya dalam meter.</p>
            </div>
        </div>

        {{-- Popup Path Loss Uplink --}}
        <div id="popup_pathloss_up" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Path Loss (Uplink)</h3>
                <p class="formula">L = 20 log₁₀(d) + 20 log₁₀(f) + 92.45</p>
                <p>Atau dalam bentuk yang digunakan di sini:</p>
                <p class="formula">L = 22 + 20 log₁₀((Slant Range * 1000) / Panjang Gelombang)</p>
                <p>Slant Range = <span id="slant_range_up_text"></span> km<br>Panjang Gelombang = <span id="panjang_gelombang_up_text2"></span> meter<br>L = <span id="hasil_pathloss_up"></span> dB</p>
                <p><strong>Penjelasan:</strong> Path loss (kehilangan jalur) adalah pengurangan kerapatan daya gelombang elektromagnetik saat merambat melalui ruang. Ini adalah faktor kunci dalam desain tautan komunikasi satelit, menunjukkan seberapa banyak daya sinyal yang hilang sebelum mencapai penerima. Rumus yang digunakan adalah variasi dari rumus Free-Space Path Loss (FSPL) yang memperhitungkan jarak (Slant Range) dan panjang gelombang sinyal.</p>
            </div>
        </div>

        {{-- Popup Panjang Gelombang Downlink --}}
        <div id="popup_lambda_down" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Panjang Gelombang (Downlink)</h3>
                <p class="formula">λ = c / f</p>
                <p>c (Kecepatan Cahaya) = 299.8<br>f (Frekuensi) = <span id="frekuensi_down_text"></span> MHz<br>λ = <span id="hasil_lambda_down"></span> meter</p>
                <p><strong>Penjelasan:</strong> Panjang gelombang (λ) adalah jarak spasial satu siklus gelombang. Hubungannya dengan frekuensi (f) dan kecepatan cahaya (c) adalah $\lambda = c / f$. Dalam perhitungan ini, kecepatan cahaya disesuaikan untuk frekuensi dalam MHz, sehingga hasilnya dalam meter.</p>
            </div>
        </div>

        {{-- Popup Path Loss Downlink --}}
        <div id="popup_pathloss_down" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Path Loss (Downlink)</h3>
                <p class="formula">L = 20 log₁₀(d) + 20 log₁₀(f) + 92.45</p>
                <p>Atau dalam bentuk yang digunakan di sini:</p>
                <p class="formula">L = 22 + 20 log₁₀((Slant Range * 1000) / Panjang Gelombang)</p>
                <p>Slant Range = <span id="slant_range_down_text"></span> km<br>Panjang Gelombang = <span id="panjang_gelombang_down_text2"></span> meter<br>L = <span id="hasil_pathloss_down"></span> dB</p>
                <p><strong>Penjelasan:</strong> Path loss (kehilangan jalur) adalah pengurangan kerapatan daya gelombang elektromagnetik saat merambat melalui ruang. Ini adalah faktor kunci dalam desain tautan komunikasi satelit, menunjukkan seberapa banyak daya sinyal yang hilang sebelum mencapai penerima. Rumus yang digunakan adalah variasi dari rumus Free-Space Path Loss (FSPL) yang memperhitungkan jarak (Slant Range) dan panjang gelombang sinyal.</p>
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

            // Tampilkan nilai slant range yang diambil dari localStorage ke input display (OPSIONAL)
            if (document.getElementById('display_slant_range_uplink')) {
                document.getElementById('display_slant_range_uplink').value = currentSlantRangeUplink > 0 ? currentSlantRangeUplink.toFixed(2) : '';
            }
            if (document.getElementById('display_slant_range_downlink')) {
                document.getElementById('display_slant_range_downlink').value = currentSlantRangeDownlink > 0 ? currentSlantRangeDownlink.toFixed(2) : '';
            }
            // --- AKHIR PENGAMBILAN DARI LOCAL STORAGE ---


            // Reset hasil perhitungan jika frekuensi kosong atau NaN, ATAU SLANT RANGE TIDAK ADA/INVALID
            if (isNaN(frekuensi) || frekuensi === '' || isNaN(currentSlantRangeUplink) || currentSlantRangeUplink <= 0) {
                document.getElementById('panjang_gelombang').value = '';
                document.getElementById('path_loss').value = '';
            }

            // Reset hasil perhitungan jika frekuensi downlink kosong atau NaN, ATAU SLANT RANGE TIDAK ADA/INVALID
            if (isNaN(frekuensi_downlink) || frekuensi_downlink === '' || isNaN(currentSlantRangeDownlink) || currentSlantRangeDownlink <= 0) {
                document.getElementById('panjang_gelombang_downlink').value = '';
                document.getElementById('path_loss_downlink').value = '';
            }


            // Perhitungan untuk uplink
            if (frekuensi > 0 && currentSlantRangeUplink > 0) { // Pastikan frekuensi > 0 untuk menghindari NaN
                // RUMUS PANJANG GELOMBANG BARU: c_effective / frekuensi (dalam MHz)
                const panjangGelombang = c_effective / frekuensi;
                document.getElementById('panjang_gelombang').value = panjangGelombang.toFixed(3); // Menampilkan 3 desimal

                // Hitung Path Loss menggunakan rumus baru dan slant range dari local storage
                const pathLoss = 22 + 20 * Math.log10((currentSlantRangeUplink * 1000) / panjangGelombang);
                document.getElementById('path_loss').value = pathLoss.toFixed(3);
            }

            // Perhitungan untuk downlink
            if (frekuensi_downlink > 0 && currentSlantRangeDownlink > 0) { // Pastikan frekuensi > 0 untuk menghindari NaN
                // RUMUS PANJANG GELOMBANG BARU: c_effective / frekuensi (dalam MHz)
                const panjangGelombangDownlink = c_effective / frekuensi_downlink;
                document.getElementById('panjang_gelombang_downlink').value = panjangGelombangDownlink.toFixed(3); // Menampilkan 3 desimal

                // Hitung Path Loss menggunakan rumus baru dan slant range dari local storage
                const pathLossDownlink = 22 + 20 * Math.log10((currentSlantRangeDownlink * 1000) / panjangGelombangDownlink);
                document.getElementById('path_loss_downlink').value = pathLossDownlink.toFixed(3);
            }
        }

        // Menambahkan event listener untuk input frekuensi dan downlink
        document.getElementById('frekuensi').addEventListener('input', hitungPerhitungan);
        document.getElementById('frekuensi_downlink').addEventListener('input', hitungPerhitungan);

        // Panggil hitungPerhitungan saat halaman dimuat untuk memuat nilai dari local storage
        document.addEventListener('DOMContentLoaded', hitungPerhitungan);

        // --- Logika Popups (sudah disesuaikan untuk membaca Slant Range dari local storage) ---
        // Helper to update popup content (rumus dan nilai)
        function updatePopupContent(popupId, formulaText, contentHtml) {
            const popup = document.getElementById(popupId);
            if (!popup) return;
            
            const formulaElement = popup.querySelector('.formula');
            const existingContentPs = popup.querySelectorAll('.popup-content > p:not(.formula)'); 

            existingContentPs.forEach(p => p.remove());

            if (formulaElement) formulaElement.innerHTML = formulaText;

            const newContentP = document.createElement('p');
            newContentP.innerHTML = contentHtml;
            if (formulaElement) {
                formulaElement.parentNode.insertBefore(newContentP, formulaElement.nextSibling);
            } else {
                popup.querySelector('.popup-content').appendChild(newContentP);
            }
        }

        document.getElementById('popup_lambda_up_btn').onclick = () => {
            const f = parseFloat(document.getElementById('frekuensi').value) || 0;
            const c_effective_popup = 299.8;
            let lambda = 0;
            if (f > 0) {
                lambda = c_effective_popup / f;
            }
            // Update popup content using the helper
            updatePopupContent('popup_lambda_up',
                `λ = c / f`,
                `c (Kecepatan Cahaya) = ${c_effective_popup} (dalam km/s, atau 299,800,000 m/s untuk frekuensi dalam Hz)<br>f (Frekuensi) = ${f.toFixed(3)} MHz<br>λ = ${lambda.toFixed(3)} meter`
            );
            openPopup('popup_lambda_up');
        };

        document.getElementById('popup_pathloss_up_btn').onclick = () => {
            const lastSelectedOrbit = localStorage.getItem('lastSelectedOrbit');
            let slantRangeForPopup = 0;
            if (lastSelectedOrbit === 'LEO' || lastSelectedOrbit === 'MEO') {
                slantRangeForPopup = parseFloat(localStorage.getItem('slantRangeLEOMEO')) || 0;
            } else if (lastSelectedOrbit === 'GEO') {
                slantRangeForPopup = parseFloat(localStorage.getItem('slantRangeGEOUplink')) || 0;
            }

            const panjangGelombang = parseFloat(document.getElementById('panjang_gelombang').value) || 0;

            let loss = 0;
            if (panjangGelombang !== 0 && slantRangeForPopup > 0) {
                loss = 22 + 20 * Math.log10((slantRangeForPopup * 1000) / panjangGelombang);
            }
            // Update popup content using the helper
            updatePopupContent('popup_pathloss_up',
                `L = 22 + 20 log₁₀((Slant Range * 1000) / Panjang Gelombang)`,
                `Slant Range = ${slantRangeForPopup.toFixed(2)} km<br>Panjang Gelombang = ${panjangGelombang.toFixed(3)} meter<br>L = ${loss.toFixed(3)} dB`
            );
            openPopup('popup_pathloss_up');
        };

        document.getElementById('popup_lambda_down_btn').onclick = () => {
            const f = parseFloat(document.getElementById('frekuensi_downlink').value) || 0;
            const c_effective_popup = 299.8;
            let lambda = 0;
            if (f > 0) {
                lambda = c_effective_popup / f;
            }
            // Update popup content using the helper
            updatePopupContent('popup_lambda_down',
                `λ = c / f`,
                `c (Kecepatan Cahaya) = ${c_effective_popup}<br>f (Frekuensi) = ${f.toFixed(3)} MHz<br>λ = ${lambda.toFixed(3)} meter`
            );
            openPopup('popup_lambda_down');
        };

        document.getElementById('popup_pathloss_down_btn').onclick = () => {
            const lastSelectedOrbit = localStorage.getItem('lastSelectedOrbit');
            let slantRangeForPopup = 0;
            if (lastSelectedOrbit === 'LEO' || lastSelectedOrbit === 'MEO') {
                slantRangeForPopup = parseFloat(localStorage.getItem('slantRangeLEOMEO')) || 0;
            } else if (lastSelectedOrbit === 'GEO') {
                slantRangeForPopup = parseFloat(localStorage.getItem('slantRangeGEODownlink')) || 0;
            }

            const panjangGelombang = parseFloat(document.getElementById('panjang_gelombang_downlink').value) || 0;

            let loss = 0;
            if (panjangGelombang !== 0 && slantRangeForPopup > 0) {
                loss = 22 + 20 * Math.log10((slantRangeForPopup * 1000) / panjangGelombang);
            }
            // Update popup content using the helper
            updatePopupContent('popup_pathloss_down',
                `L = 22 + 20 log₁₀((Slant Range * 1000) / Panjang Gelombang)`,
                `Slant Range = ${slantRangeForPopup.toFixed(2)} km<br>Panjang Gelombang = ${panjangGelombang.toFixed(3)} meter<br>L = ${loss.toFixed(3)} dB`
            );
            openPopup('popup_pathloss_down');
        };


        // Fungsi untuk buka popup (tetap sama)
        function openPopup(id) {
            document.getElementById(id).style.display = "flex";
        }

        // Fungsi tutup semua popup (tetap sama)
        document.querySelectorAll('.close-popup-btn').forEach(btn => {
            btn.onclick = () => {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            };
        });
    </script>
</x-layout>