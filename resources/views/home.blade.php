<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <!-- Banner Utama dengan Efek Animasi dan Latar Belakang Video -->
    <section class="relative text-black py-20 px-8 text-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <video autoplay loop muted class="absolute top-0 left-0 w-full h-full object-cover z-0">
            <source src="your-video-path.mp4" type="video/mp4">
        </video>
        
        <!-- Logo/Gambar di atas judul -->
        <div class="z-1 relative mb-2"> <!-- Menyesuaikan margin bawah lebih kecil -->
            <img src="{{ asset('img/LogoSLC.png') }}" alt="SkyLinkCalc Logo" 
                class="mx-auto object-contain animate-pulse hover:animate-spin transition-all duration-300 filter drop-shadow-lg"
                style="max-width: 100%; width: 20rem; height: 20rem; margin-bottom: 1rem;"> <!-- Menggunakan max-width agar responsif dan menyesuaikan margin-bottom -->
        </div>
        
        <h1 class="text-5xl font-extrabold mb-4 tracking-wide animate__animated animate__fadeIn animate__delay-1s z-10 relative">SkyLinkCalc</h1>
        <h1 class="text-5xl font-extrabold mb-4 tracking-wide animate__animated animate__fadeIn animate__delay-1s z-10 relative">Perhitungan Satelit Praktis</h1>
        <p class="text-lg max-w-3xl mx-auto mb-6 z-10 relative">Selamat datang di SkyLinkCalc! Aplikasi ini membantu Anda menghitung berbagai parameter orbit satelit, menyimpan riwayat perhitungan, dan menghubungi tim pengembang jika dibutuhkan.</p>
        <p class="text-md max-w-xl mx-auto z-10 relative">Solusi cepat dan efisien untuk mendukung studi atau proyek berbasis sistem komunikasi satelit.</p>
        <button class="bg-yellow-500 text-black px-6 py-3 rounded-full hover:bg-yellow-600 transform hover:scale-105 transition duration-300 mt-6">Mulai Perhitungan</button>
    </section>


    <!-- Penjelasan Fitur -->
    <section class="py-16 px-6 bg-gray-50 text-black">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-4xl font-semibold mb-6 text-indigo-800">Fitur Unggulan</h2>
            <p class="text-lg mb-6">Berikut beberapa fitur yang tersedia di SkyLinkCalc untuk menunjang kebutuhan analisis Anda:</p>
        </div>

        <!-- Fitur Utama -->
        <div class="flex flex-wrap justify-center gap-8">
            <!-- Kalkulator Parameter -->
            <div class="w-full sm:w-1/2 lg:w-1/3 bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-300 mb-6">
                <h3 class="text-xl font-semibold mb-2 text-indigo-600">🧮 Kalkulator Parameter</h3>
                <p>Hitung kecepatan dan waktu parameter berdasarkan parameter satelit secara cepat dan akurat.</p>
                <button class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transform hover:scale-105 transition duration-300">Hitung Sekarang</button>
            </div>

            <!-- Riwayat Perhitungan -->
            <div class="w-full sm:w-1/2 lg:w-1/3 bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-300 mb-6">
                <h3 class="text-xl font-semibold mb-2 text-indigo-600">📊 Riwayat Perhitungan</h3>
                <p>Lihat data input dan hasil perhitungan sebelumnya untuk keperluan pencatatan dan analisis.</p>
                <button onclick="window.location.href='{{ route('history') }}'" class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transform hover:scale-105 transition duration-300">Lihat Riwayat</button>
            </div>

            <!-- Contact Form -->
            <div class="w-full sm:w-1/2 lg:w-1/3 bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105 duration-300 mb-6">
                <h3 class="text-xl font-semibold mb-2 text-indigo-600">📩 Hubungi Kami</h3>
                <form action="{{ url('/contact') }}" method="POST" class="space-y-6 text-left">
                    @csrf
                    <div>
                        <label for="nama" class="block font-semibold mb-2">Nama:</label>
                        <input type="text" name="nama" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="email" class="block font-semibold mb-2">Email:</label>
                        <input type="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="pesan" class="block font-semibold mb-2">Pesan:</label>
                        <textarea name="pesan" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="bg-yellow-500 text-black px-6 py-3 rounded-full hover:bg-yellow-600 transition duration-200 transform hover:scale-105">Kirim</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-500 text-black py-6 mt-10">
        <div class="max-w-4xl mx-auto text-center flex justify-between items-center">
            <!-- Social Media Icons -->
            <div class="flex space-x-6">
                <a href="#" class="text-white text-2xl hover:text-gray-300">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-white text-2xl hover:text-gray-300">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white text-2xl hover:text-gray-300">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex space-x-6">
                <a href="#" class="text-white hover:text-gray-300">Home</a>
                <a href="#" class="text-white hover:text-gray-300">About Us</a>
                <a href="#contact-us" class="text-white hover:text-gray-300">Contact</a>
            </div>
        </div>

        <!-- Created by Text -->
        <div class="text-center mt-4 text-gray-600">
            <p>Created by <strong class="text-black">Kelompok Website OrbitCalc</strong> | © 2025</p>
        </div>
    </footer>

</x-layout>