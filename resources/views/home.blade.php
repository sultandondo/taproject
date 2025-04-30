<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <!-- Banner Utama -->
    <section class="text-black py-20 px-8 text-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <h1 class="text-4xl font-bold mb-6">OrbitCalc - Perhitungan Satelit Praktis & Akurat</h1>
        <p class="text-lg max-w-3xl mx-auto mb-6">Selamat datang di OrbitCalc! Aplikasi ini membantu Anda menghitung berbagai parameter orbit satelit, menyimpan riwayat perhitungan, dan menghubungi tim pengembang jika dibutuhkan.</p>
        <p class="text-md max-w-xl mx-auto">Solusi cepat dan efisien untuk mendukung studi atau proyek berbasis sistem komunikasi satelit.</p>
    </section>

    <!-- Penjelasan Fitur -->
    <section class="py-16 px-6 bg-gray-50 text-black">
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h2 class="text-3xl font-semibold mb-6">Fitur Unggulan</h2>
            <p class="text-lg mb-6">Berikut beberapa fitur yang tersedia di OrbitCalc untuk menunjang kebutuhan analisis Anda:</p>
        </div>

        <!-- Fitur Utama -->
        <div class="flex flex-wrap justify-center gap-8">
            <!-- Kalkulator Orbit -->
            <div class="w-full sm:w-1/2 lg:w-1/3 bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105 duration-300 mb-6">
                <h3 class="text-xl font-semibold mb-2">🧮 Kalkulator Orbit</h3>
                <p>Hitung kecepatan dan waktu orbit berdasarkan parameter satelit secara cepat dan akurat.</p>
            </div>

            <!-- Riwayat Perhitungan -->
            <div class="w-full sm:w-1/2 lg:w-1/3 bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition transform hover:scale-105 duration-300 mb-6">
                <h3 class="text-xl font-semibold mb-2">📊 Riwayat Perhitungan</h3>
                <p>Lihat data input dan hasil perhitungan sebelumnya untuk keperluan pencatatan dan analisis.</p>
            </div>
        </div>
    </section>

    <!-- Footer Contact Us -->
    <footer class="bg-gray-200 text-black py-12 px-6 mt-10">
        <section id="contact-us" class="max-w-xl mx-auto text-center">
            <h2 class="text-2xl font-bold mb-4">Hubungi Kami</h2>
            <p class="mb-6">Kami terbuka untuk pertanyaan, kritik, maupun saran terkait pengembangan OrbitCalc.</p>
            <form action="{{ url('/contact') }}" method="POST" class="space-y-6 text-left max-w-md mx-auto">
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
        </section>
    </footer>
</x-layout>