<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Frekuensi</h1>

        <form method="POST" action="{{ route('frek.store', $dataId )}}">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        {{-- Uplink Frekuensi --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3 text-gray-800">Uplink Frekuensi</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <label for="frekuensi" class="block font-medium mb-2 text-gray-700">Frekuensi:</label>
                    <div class="flex items-center">
                        <input type="number" step="0.001" name="frekuensi" id="frekuensi" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Frekuensi">
                        <span id="frekuensi_satuan_display" class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">MHz</span>
                    </div>
                </div>
                <div class="relative">
                    <label for="panjang_gelombang" class="block font-medium mb-2 text-gray-700">Panjang Gelombang (λ):</label>
                    <div class="flex items-center">
                        <input type="text" name="panjang_gelombang" id="panjang_gelombang" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;"
                        placeholder="Hasil Panjang Gelombang">
                        <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">Meter</span>
                    </div>
                    <button type="button" id="popup_lambda_up_btn" class="text-blue-500 mt-1 text-sm">Lihat Detail</button>
                </div>
                {{-- DISPLAY Slant Range dari halaman Orbit (Opsional) --}}
                <div class="relative">
                    <label for="display_slant_range_uplink" class="block font-medium mb-2 text-gray-700">Slant Range Uplink (dari Orbit):</label>
                    <input type="text" id="display_slant_range_uplink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" placeholder="Ambil dari Perhitungan Orbit">
                    <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">km</span>
                </div>
                <div class="relative">
                    <label for="path_loss" class="block font-medium mb-2 text-gray-700">Path Loss:</label>
                    <div class="flex items-center">
                        <input type="text" name="path_loss" id="path_loss" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;"
                        placeholder="Hasil Path Loss">
                        <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">dB</span>
                    </div>
                <button type="button" id="popup_pathloss_up_btn" class="text-blue-500 mt-1 text-sm">Lihat Detail</button>
                </div>
            </div>
        </div>

        {{-- Downlink Frekuensi --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3 text-gray-800">Downlink Frekuensi</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <label for="frekuensi_downlink" class="block font-medium mb-2 text-gray-700">Frekuensi:</label>
                    <div class="flex items-center">
                        <input type="number" step="0.001" name="frekuensi_downlink" id="frekuensi_downlink" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Frekuensi">
                        <span id="frekuensi_downlink_satuan_display" class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">MHz</span>
                    </div>
                </div>
                <div class="relative">
                    <label for="panjang_gelombang_downlink" class="block font-medium mb-2 text-gray-700">Panjang Gelombang (λ):</label>
                    <div class="flex items-center">
                        <input type="text" name="panjang_gelombang_downlink" id="panjang_gelombang_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;"
                        placeholder="Hasil Panjang Gelombang">
                        <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">Meter</span>
                    </div>
                    <button type="button" id="popup_lambda_down_btn" class="text-blue-500 mt-1 text-sm">Lihat Detail</button>
                </div>
                {{-- DISPLAY Slant Range dari halaman Orbit (Opsional) --}}
                <div class="relative">
                    <label for="display_slant_range_downlink" class="block font-medium mb-2 text-gray-700">Slant Range Downlink (dari Orbit):</label>
                    <input type="text" id="display_slant_range_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" placeholder="Ambil dari Perhitungan Orbit">
                    <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">km</span>
                </div>
                <div class="relative">
                    <label for="path_loss_downlink" class="block font-medium mb-2 text-gray-700">Path Loss:</label>
                    <div class="flex items-center">
                        <input type="text" name="path_loss_downlink" id="path_loss_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;"
                        placeholder="Hasil Path Loss">
                        <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">dB</span>
                    </div>
                <button type="button" id="popup_pathloss_down_btn" class="text-blue-500 mt-1 text-sm">Lihat Detail</button>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded-lg hover:bg-blue-600 w-full focus:outline-none focus:ring-2 focus:ring-blue-400">Simpan</button>
        </form>
        <div class="flex justify-center mt-4">
            <!-- Tombol Next di kiri -->
            <a href="/calc/{{$dataId}}" class="text-center bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">
                Halaman Sebelum
            </a>

            <!-- Tombol Previous di kanan -->
            <!-- <a href="/halaman-sebelumnya" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Next
            </a> -->
        </div>


        {{-- Popup Panjang Gelombang Uplink --}}
        <div id="popup_lambda_up" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Panjang Gelombang (Uplink)</h3>
                <p class="formula">λ = 299.8 / f</p>
                <p>c = 299.8<br>f = <span id="frekuensi_up_text"></span> MHz<br>λ = <span id="hasil_lambda_up"></span> meter</p>
            </div>
        </div>

        {{-- Popup Path Loss Uplink --}}
        <div id="popup_pathloss_up" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Path Loss (Uplink)</h3>
                <p class="formula">L = 22 + 20 log₁₀((Slant Range * 1000) / Panjang Gelombang)</p>
                <p>Slant Range = <span id="slant_range_up_text"></span> km<br>Panjang Gelombang = <span id="panjang_gelombang_up_text2"></span> meter<br>L = <span id="hasil_pathloss_up"></span> dB</p>
            </div>
        </div>

        {{-- Popup Panjang Gelombang Downlink --}}
        <div id="popup_lambda_down" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Panjang Gelombang (Downlink)</h3>
                <p class="formula">λ = 299.8 / f</p>
                <p>c = 299.8<br>f = <span id="frekuensi_down_text"></span> MHz<br>λ = <span id="hasil_lambda_down"></span> meter</p>
            </div>
        </div>

        {{-- Popup Path Loss Downlink --}}
        <div id="popup_pathloss_down" class="popup-window">
            <div class="popup-content">
                <span class="close-popup-btn">&times;</span>
                <h3>Rumus Path Loss (Downlink)</h3>
                <p class="formula">L = 22 + 20 log₁₀((Slant Range * 1000) / Panjang Gelombang)</p>
                <p>Slant Range = <span id="slant_range_down_text"></span> km<br>Panjang Gelombang = <span id="panjang_gelombang_down_text2"></span> meter<br>L = <span id="hasil_pathloss_down"></span> dB</p>
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
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            position: relative;
            background-color: white;
            padding: 20px 30px 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
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

        </style>
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
        document.getElementById('popup_lambda_up_btn').onclick = () => {
            const f = parseFloat(document.getElementById('frekuensi').value) || 0;
            // Kecepatan cahaya efektif untuk popup (299.8)
            const c_effective_popup = 299.8;
            let lambda = 0;
            if (f > 0) {
                lambda = c_effective_popup / f;
            }
            document.getElementById('frekuensi_up_text').textContent = f;
            document.getElementById('hasil_lambda_up').textContent = lambda.toFixed(3); // Menampilkan 3 desimal
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

            document.getElementById('slant_range_up_text').textContent = slantRangeForPopup.toFixed(2);
            document.getElementById('panjang_gelombang_up_text2').textContent = panjangGelombang.toFixed(3);
            document.getElementById('hasil_pathloss_up').textContent = loss.toFixed(3);
            openPopup('popup_pathloss_up');
        };

        document.getElementById('popup_lambda_down_btn').onclick = () => {
            const f = parseFloat(document.getElementById('frekuensi_downlink').value) || 0;
            // Kecepatan cahaya efektif untuk popup (299.8)
            const c_effective_popup = 299.8;
            let lambda = 0;
            if (f > 0) {
                lambda = c_effective_popup / f;
            }
            document.getElementById('frekuensi_down_text').textContent = f;
            document.getElementById('hasil_lambda_down').textContent = lambda.toFixed(3); // Menampilkan 3 desimal
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

            document.getElementById('slant_range_down_text').textContent = slantRangeForPopup.toFixed(2);
            document.getElementById('panjang_gelombang_down_text2').textContent = panjangGelombang.toFixed(3);
            document.getElementById('hasil_pathloss_down').textContent = loss.toFixed(3);
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