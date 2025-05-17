<x-layout>
    <x-slot:title>About Us - Satellite Link Budget</x-slot>

    <!-- Hero Section dengan Gradient Vibrant -->
    <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-indigo-600 py-16 px-4 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4 drop-shadow-md">About Us</h1>
        <div class="w-24 h-1 bg-yellow-400 mx-auto mb-8"></div>
        
        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3 drop-shadow-md">Kami adalah Tim yang Luar Biasa!</h2>
        <p class="text-lg sm:text-xl text-gray-100 max-w-3xl mx-auto mb-10">Kenali dosen pembimbing dan anggota kelompok kami</p>
        
        <!-- Tombol Navigasi dengan Warna Vibrant -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 sm:gap-8 mb-6">
            <a href="#dosen" class="bg-gradient-to-r from-amber-400 to-yellow-500 hover:from-amber-500 hover:to-yellow-600 text-gray-900 font-bold text-lg px-8 py-4 rounded-full shadow-lg hover:shadow-xl transform transition-all hover:-translate-y-1">
                Dosen Pembimbing
            </a>
            <a href="#anggota" class="bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-bold text-lg px-8 py-4 rounded-full shadow-lg hover:shadow-xl transform transition-all hover:-translate-y-1">
                Anggota Kelompok
            </a>
        </div>
    </div>

    <!-- Dosen Pembimbing Section dengan Warna Menarik -->
    <div id="dosen" class="py-20 bg-gradient-to-b from-indigo-50 to-white px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl sm:text-4xl font-bold text-center text-indigo-800 mb-4">Dosen Pembimbing</h2>
            <div class="w-32 h-1 bg-indigo-600 mx-auto mb-16"></div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Dosen 1 -->
                <div class="bg-gradient-to-br from-white to-indigo-50 rounded-2xl shadow-xl p-8 flex flex-col md:flex-row items-center gap-8 hover:shadow-2xl transition-shadow border-t-4 border-indigo-500">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full opacity-50 transform scale-105 animate-pulse"></div>
                        <img src="/img/edwar.jpg" alt="Edwar" class="w-36 h-36 rounded-full border-4 border-white object-cover relative z-10">
                    </div>
                    
                    <div class="text-center md:text-left">
                        <h3 class="text-2xl font-bold text-indigo-800">Edwar</h3>
                        <p class="text-lg text-indigo-600 font-medium">First Academic Advisor</p>
                        <p class="text-gray-600 mb-6">Telecommunication Transmission</p>
                        <a href="mailto:akhmad_hambali@email.com" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white px-6 py-3 rounded-full text-base font-medium transition-colors shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            Contact Advisor
                        </a>
                    </div>
                </div>
                
                <!-- Dosen 2 -->
                <div class="bg-gradient-to-br from-white to-indigo-50 rounded-2xl shadow-xl p-8 flex flex-col md:flex-row items-center gap-8 hover:shadow-2xl transition-shadow border-t-4 border-indigo-500">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full opacity-50 transform scale-105 animate-pulse"></div>
                        <img src="/img/dhoni.jpg" alt="Dhoni Putra Setiawan" class="w-36 h-36 rounded-full border-4 border-white object-cover relative z-10">
                    </div>
                    
                    <div class="text-center md:text-left">
                        <h3 class="text-2xl font-bold text-indigo-800">Dhoni Putra Setiawan</h3>
                        <p class="text-lg text-indigo-600 font-medium">Second Academic Advisor</p>
                        <p class="text-gray-600 mb-6">Telecommunication Transmission</p>
                        <a href="mailto:irfan_maulana@email.com" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white px-6 py-3 rounded-full text-base font-medium transition-colors shadow-md hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                            Contact Advisor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Anggota Kelompok Section dengan Design Vibrant -->
    <div id="anggota" class="py-20 bg-gradient-to-b from-rose-50 to-pink-100 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl sm:text-4xl font-bold text-center text-rose-800 mb-4">Anggota Kelompok</h2>
            <div class="w-32 h-1 bg-rose-500 mx-auto mb-16"></div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Anggota 1 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center hover:shadow-xl transition-all hover:-translate-y-2 border-t-4 border-pink-500">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-pink-400 to-rose-500 opacity-20 transform scale-110 animate-pulse"></div>
                        <img src="/img/luthfi.jpg" alt="Muhammad Luthfi" class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-md relative z-10">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-1">Muhammad Luthfi</h3>
                    <p class="text-lg text-pink-600 font-medium mb-1">Member of Team</p>
                    <p class="text-gray-600 mb-6">1101210305</p>
                    <a href="mailto:mluthfii16@email.com" class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white px-6 py-2 rounded-full text-sm font-medium transition-colors shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        Contact
                    </a>
                </div>
                
                <!-- Anggota 2 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center hover:shadow-xl transition-all hover:-translate-y-2 border-t-4 border-pink-500">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-pink-400 to-rose-500 opacity-20 transform scale-110 animate-pulse"></div>
                        <img src="{{ asset('img/iyan.png') }}" alt="Iyan Cahyana" class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-md relative z-10">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-1">Iyan Cahyana</h3>
                    <p class="text-lg text-pink-600 font-medium mb-1">Member of Team</p>
                    <p class="text-gray-600 mb-6">1101213082</p>
                    <a href="mailto:iyanchyna24@email.com" class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white px-6 py-2 rounded-full text-sm font-medium transition-colors shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        Contact
                    </a>
                </div>
                
                <!-- Anggota 3 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center hover:shadow-xl transition-all hover:-translate-y-2 border-t-4 border-pink-500">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-pink-400 to-rose-500 opacity-20 transform scale-110 animate-pulse"></div>
                        <img src="/img/sultan.jpg" alt="Muhammad Sultan Pasha Dondo" class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-md relative z-10">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-1">Muhammad Sultan Pasha Dondo</h3>
                    <p class="text-lg text-pink-600 font-medium mb-1">Member of Team</p>
                    <p class="text-gray-600 mb-6">1101213142</p>
                    <a href="mailto:muhsultanpasha@email.com" class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white px-6 py-2 rounded-full text-sm font-medium transition-colors shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        Contact
                    </a>
                </div>
                
                <!-- Anggota 4 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center hover:shadow-xl transition-all hover:-translate-y-2 border-t-4 border-pink-500">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-r from-pink-400 to-rose-500 opacity-20 transform scale-110 animate-pulse"></div>
                        <img src="/img/maharddhika.jpg" alt="Maharddhika Paramananda" class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-md relative z-10">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-1">Maharddhika Paramananda</h3>
                    <p class="text-lg text-pink-600 font-medium mb-1">Member of Team</p>
                    <p class="text-gray-600 mb-6">1101213174</p>
                    <a href="mailto:maharddhikaparamananda15@email.com" class="inline-flex items-center gap-2 bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white px-6 py-2 rounded-full text-sm font-medium transition-colors shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        Contact
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Script untuk Smooth Scrolling -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll untuk tombol navigasi
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            });
        });
    </script>

    <!-- Animasi Pulse untuk Foto Profil (opsi tambahan) -->
    <style>
        @keyframes pulse {
            0%, 100% {
                opacity: 0.2;
            }
            50% {
                opacity: 0.4;
            }
        }
        
        .animate-pulse {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</x-layout>