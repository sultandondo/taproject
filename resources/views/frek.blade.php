<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Frekuensi</h1>

        <form method="POST" action="{{ route('frek.store', $dataId )}}">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">


        {{-- Pilihan Satuan Frekuensi --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3 text-gray-800">Pilih Satuan Frekuensi</h2>
            <div class="mb-4">
                <label for="frekuensi_satuan" class="block font-medium mb-2 text-gray-700">Pilih Satuan Frekuensi:</label>
                <select name="frekuensi_satuan" id="frekuensi_satuan" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    <option value="GHz">GHz</option>
                    <option value="MHz">MHz</option>
                </select>
            </div>
        </div>

        {{-- Uplink Frekuensi --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-3 text-gray-800">Uplink Frekuensi</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="relative">
                    <label for="frekuensi" class="block font-medium mb-2 text-gray-700">Frekuensi:</label>
                    <div class="flex items-center">
                        <input type="text" name="frekuensi" id="frekuensi" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Frekuensi">
                        <!-- Menampilkan satuan frekuensi yang dipilih -->
                        <span id="frekuensi_satuan_display" class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">GHz</span>
                    </div>
                </div>
                <div class="relative">
                    <label for="panjang_gelombang" class="block font-medium mb-2 text-gray-700">Panjang Gelombang (λ):</label>
                    <div class="flex items-center">
                        <input type="text" name="panjang_gelombang" id="panjang_gelombang" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;"
                        placeholder="Hasil Panjang Gelombang">
                        <!-- Menambahkan satuan meters di dalam input -->
                        <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">Meter</span>
                    </div>
                  <button type="button" id="popup_lambda_up_btn" class="text-blue-500 mt-1 text-sm">Lihat Detail</button>
                </div>
                <div class="relative">
                    <label for="path_loss" class="block font-medium mb-2 text-gray-700">Path Loss:</label>
                    <div class="flex items-center">
                        <input type="text" name="path_loss" id="path_loss" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;"
                        placeholder="Hasil Path Loss">
                        <!-- Menambahkan satuan dB di dalam input -->
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
                        <input type="number" name="frekuensi_downlink" id="frekuensi_downlink" required class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Frekuensi">
                        <!-- Menampilkan satuan frekuensi yang dipilih -->
                        <span id="frekuensi_downlink_satuan_display" class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">GHz</span>
                    </div>
                </div>
                <div class="relative">
                    <label for="panjang_gelombang_downlink" class="block font-medium mb-2 text-gray-700">Panjang Gelombang (λ):</label>
                    <div class="flex items-center">
                        <input type="text" name="panjang_gelombang_downlink" id="panjang_gelombang_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" 
                        placeholder="Hasil Panjang Gelombang">
                        <!-- Menambahkan satuan meters di dalam input -->
                        <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">Meter</span>
                    </div>
                  <button type="button" id="popup_lambda_down_btn" class="text-blue-500 mt-1 text-sm">Lihat Detail</button>
                </div>
                <div class="relative">
                    <label for="path_loss_downlink" class="block font-medium mb-2 text-gray-700">Path Loss:</label>
                    <div class="flex items-center">
                        <input type="text" name="path_loss_downlink" id="path_loss_downlink" readonly class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none pr-16" style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;" 
                        placeholder="Hasil Path Loss">
                        <!-- Menambahkan satuan dB di dalam input -->
                        <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-gray-700">dB</span>
                    </div>
                <button type="button" id="popup_pathloss_down_btn" class="text-blue-500 mt-1 text-sm">Lihat Detail</button>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded-lg hover:bg-blue-600 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"onclick="window.location.href='{{ url('/transmitter') }}'">Simpan</button>
        </form>

        <!-- Popup Panjang Gelombang Uplink -->
        <div id="popup_lambda_up" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Panjang Gelombang (Uplink)</h3>
            <p class="formula">λ = c / f</p>
            <p>c = 299,792,458 m/s<br>f = <span id="frekuensi_up_text"></span> MHz<br>λ = <span id="hasil_lambda_up"></span> meter</p>
        </div>
        </div>

        <!-- Popup Path Loss Uplink -->
        <div id="popup_pathloss_up" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Path Loss (Uplink)</h3>
            <p class="formula">L = A + 20 log₁₀(f) + 20 log₁₀(d)</p>
            <p>A = <span id="konstanta_up"></span><br>f = <span id="frekuensi_up_text2"></span><br>d = 1 km<br>L = <span id="hasil_pathloss_up"></span> dB</p>
        </div>
        </div>

        <!-- Popup Panjang Gelombang Downlink -->
        <div id="popup_lambda_down" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Panjang Gelombang (Downlink)</h3>
            <p class="formula">λ = c / f</p>
            <p>c = 299,792,458 m/s<br>f = <span id="frekuensi_down_text"></span> MHz<br>λ = <span id="hasil_lambda_down"></span> meter</p>
        </div>
        </div>

        <!-- Popup Path Loss Downlink -->
        <div id="popup_pathloss_down" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Rumus Path Loss (Downlink)</h3>
            <p class="formula">L = A + 20 log₁₀(f) + 20 log₁₀(d)</p>
            <p>A = <span id="konstanta_down"></span><br>f = <span id="frekuensi_down_text2"></span><br>d = 1 km<br>L = <span id="hasil_pathloss_down"></span> dB</p>
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
                padding: 20px 30px 30px 30px;
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
        // Update satuan frekuensi di Uplink dan Downlink berdasarkan pilihan di atas
        document.getElementById('frekuensi_satuan').addEventListener('change', function() {
            const satuan = this.value;
            document.getElementById('frekuensi_satuan_display').textContent = satuan; // Update satuan di uplink
            document.getElementById('frekuensi_downlink_satuan_display').textContent = satuan; // Update satuan di downlink

            hitungPerhitungan();

        });

        // Perhitungan Panjang Gelombang dan Path Loss
        function hitungPerhitungan() {
            const frekuensi = parseFloat(document.getElementById('frekuensi').value);
            const frekuensi_downlink = parseFloat(document.getElementById('frekuensi_downlink').value);
            const satuan = document.getElementById('frekuensi_satuan').value;
            const jarak = 1; // Misal jarak 1 km
            const c = 299792458; // Kecepatan cahaya dalam m/s

        // Reset hasil perhitungan jika frekuensi kosong atau NaN
    if (isNaN(frekuensi) || frekuensi === '') {
        // Reset jika input kosong
        document.getElementById('panjang_gelombang').value = '';
        document.getElementById('path_loss').value = '';
    
    }

        // Reset hasil perhitungan jika frekuensi kosong atau NaN
    if (isNaN(frekuensi_downlink) || frekuensi_downlink === '') {
        // Reset jika input kosong
        document.getElementById('panjang_gelombang_downlink').value = '';
        document.getElementById('path_loss_downlink').value = '';
        
    }

            // Perhitungan untuk uplink
            if (frekuensi && satuan) {
                // Hitung Panjang Gelombang
                const panjangGelombang = c / (frekuensi * 1e6); // Menggunakan frekuensi dalam MHz, konversi ke Hz
                document.getElementById('panjang_gelombang').value = panjangGelombang.toFixed(3); // Membulatkan hingga 3 angka desimal

                // Hitung Path Loss
                let pathLoss;
                if (satuan === 'GHz') {
                    pathLoss = 92.45 + (20 * Math.log10(frekuensi)) + (20 * Math.log10(jarak));
                } else if (satuan === 'MHz') {
                    pathLoss = 32.4 + (20 * Math.log10(frekuensi)) + (20 * Math.log10(jarak));
                }
                document.getElementById('path_loss').value = pathLoss.toFixed(3); // Membulatkan hingga 3 angka desimal
            }


            // Perhitungan untuk downlink
                //Hitung Panjang Gelombang
            if (frekuensi_downlink && satuan) {
                const panjangGelombangDownlink = c / (frekuensi_downlink * 1e6); // Menggunakan frekuensi dalam MHz, konversi ke Hz
                document.getElementById('panjang_gelombang_downlink').value = panjangGelombangDownlink.toFixed(3); // Membulatkan hingga 3 angka desimal

                let pathLossDownlink;
                if (satuan === 'GHz') {
                    pathLossDownlink = 92.45 + (20 * Math.log10(frekuensi_downlink)) + (20 * Math.log10(jarak));
                } else if (satuan === 'MHz') {
                    pathLossDownlink = 32.4 + (20 * Math.log10(frekuensi_downlink)) + (20 * Math.log10(jarak));
                }
                document.getElementById('path_loss_downlink').value = pathLossDownlink.toFixed(3); // Membulatkan hingga 3 angka desimal
            }
        }

        // Menambahkan event listener untuk input frekuensi dan downlink
        document.getElementById('frekuensi').addEventListener('input', hitungPerhitungan);
        document.getElementById('frekuensi_downlink').addEventListener('input', hitungPerhitungan);

        // Set initial display
        document.getElementById('frekuensi_satuan').dispatchEvent(new Event('change'));

        // Fungsi untuk buka popup
    function openPopup(id) {
        document.getElementById(id).style.display = "flex";
    }

    // Fungsi tutup semua popup
    document.querySelectorAll('.close-popup-btn').forEach(btn => {
        btn.onclick = () => {
            document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
        };
    });

        // Bind tombol dengan logika perhitungan
        document.getElementById('popup_lambda_up_btn').onclick = () => {
            const f = parseFloat(document.getElementById('frekuensi').value) || 0;
            const lambda = 299792458 / (f * 1e6);
            document.getElementById('frekuensi_up_text').textContent = f;
            document.getElementById('hasil_lambda_up').textContent = lambda.toFixed(3);
            openPopup('popup_lambda_up');
        };

        document.getElementById('popup_pathloss_up_btn').onclick = () => {
            const f = parseFloat(document.getElementById('frekuensi').value) || 0;
            const satuan = document.getElementById('frekuensi_satuan').value;
            const A = satuan === "GHz" ? 92.45 : 32.4;
            const loss = A + 20 * Math.log10(f) + 20 * Math.log10(1);
            document.getElementById('frekuensi_up_text2').textContent = f;
            document.getElementById('konstanta_up').textContent = A;
            document.getElementById('hasil_pathloss_up').textContent = loss.toFixed(3);
            openPopup('popup_pathloss_up');
        };

        document.getElementById('popup_lambda_down_btn').onclick = () => {
            const f = parseFloat(document.getElementById('frekuensi_downlink').value) || 0;
            const lambda = 299792458 / (f * 1e6);
            document.getElementById('frekuensi_down_text').textContent = f;
            document.getElementById('hasil_lambda_down').textContent = lambda.toFixed(3);
            openPopup('popup_lambda_down');
        };

        document.getElementById('popup_pathloss_down_btn').onclick = () => {
            const f = parseFloat(document.getElementById('frekuensi_downlink').value) || 0;
            const satuan = document.getElementById('frekuensi_satuan').value;
            const A = satuan === "GHz" ? 92.45 : 32.4;
            const loss = A + 20 * Math.log10(f) + 20 * Math.log10(1);
            document.getElementById('frekuensi_down_text2').textContent = f;
            document.getElementById('konstanta_down').textContent = A;
            document.getElementById('hasil_pathloss_down').textContent = loss.toFixed(3);
            openPopup('popup_pathloss_down');
        };


    </script>
</x-layout>