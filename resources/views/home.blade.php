<x-layout>
    <body class="bg-gray-100">
    

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="grid grid-cols-8 gap-4 h-full">
                    <div class="bg-white/20 animate-pulse"></div>
                    <div class="bg-white/10 animate-pulse" style="animation-delay: 0.5s;"></div>
                    <div class="bg-white/20 animate-pulse" style="animation-delay: 1s;"></div>
                    <div class="bg-white/10 animate-pulse" style="animation-delay: 1.5s;"></div>
                    <div class="bg-white/20 animate-pulse" style="animation-delay: 2s;"></div>
                    <div class="bg-white/10 animate-pulse" style="animation-delay: 2.5s;"></div>
                    <div class="bg-white/20 animate-pulse" style="animation-delay: 3s;"></div>
                    <div class="bg-white/10 animate-pulse" style="animation-delay: 3.5s;"></div>
                </div>
            </div>

            <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto">
                <!-- Logo/Icon -->
                <div class="w-40 h-40 mx-auto bg-white/<div class="w-10 h-10 flex items-center justify-center>
                    <img src="{{ asset('img/LogoSLC.png') }}" alt="Logo SkyLinkCal" class="w-full h-full object-contain">
                </div>

                <!-- Main Heading -->
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6">
                    SkyLinkCal
                </h1>
                <h2 class="text-2xl md:text-4xl font-semibold text-white/90 mb-8">
                    Perhitungan Satelit Praktis
                </h2>

                <!-- Description -->
                <p class="text-lg md:text-xl text-white/80 max-w-3xl mx-auto mb-6 leading-relaxed">
                    Selamat datang di SkyLinkCal! Aplikasi yang membantu menghitung berbagai parameter satelit secara komprehensif, menyimpan riwayat perhitungan, dan menampilkan visualisasi.
                </p>
                <p class="text-md md:text-lg text-white/70 max-w-2xl mx-auto mb-12">
                    Solusi cepat dan efisien untuk mendukung studi, penelitian, atau proyek berbasis sistem komunikasi satelit.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('calc.show', ['id' => 0]) }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-full font-semibold transition transform hover:scale-105 flex items-center justify-center">
        Hitung Sekarang
                    </a>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <i class="fas fa-chevron-down text-white text-2xl"></i>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 px-4 sm:px-6 lg:px-8 bg-white">
            <div class="max-w-7xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Fitur <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Unggulan</span>
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Dilengkapi dengan teknologi terdepan untuk memberikan hasil perhitungan satelit yang presisi dan analisis mendalam
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1: Calculator -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-blue-200 hover:-translate-y-2">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-calculator text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Kalkulator Parameter</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Hitung link budget berdasarkan parameter satelit secara cepat dengan interface yang intuitif.
                        </p>
                        <a href="{{ route('calc.show', ['id' => 0]) }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-full font-semibold transition transform hover:scale-105 flex items-center justify-center">
        Hitung Sekarang
                        </a>
                    </div>

                    <!-- Feature 2: History -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-green-200 hover:-translate-y-2">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Riwayat Perhitungan</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Akses dan analisis data perhitungan sebelumnya untuk mendukung riset dan dokumentasi.
                        </p>
                        <a href="{{ route('history') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-full font-semibold transition transform hover:scale-105 flex items-center justify-center">
        Lihat Riwayat
                        </a>
                    </div>

                    <!-- Feature 3: Contact Form -->
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-purple-200 md:col-span-2 lg:col-span-1">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-envelope text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Hubungi Tim Ahli</h3>
                        
                        <form class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" placeholder="Masukkan nama Anda">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                <input type="email" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" placeholder="nama@email.com">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan</label>
                                <textarea class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" rows="4" placeholder="Tulis pertanyaan atau feedback Anda..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg font-semibold transition transform hover:scale-105">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">
                            Mengapa Memilih <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">SkyLinkCal?</span>
                        </h2>
                        <p class="text-xl text-gray-600 mb-8">
                            Platform SkyLinkCalculator ini dikembangkan untuk mempermudah perhitungan parameter link budget satelit
                        </p>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Komprehensif</h4>
                                    <p class="text-gray-600">Algoritma matematika serta interface yang disediakan dirancang untuk memenuhi kebutuhan perhitungan link budget satelit secara menyeluruh</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Interface Intuitif</h4>
                                    <p class="text-gray-600">Desain user-friendly yang memudahkan pengguna dari berbagai tingkat keahlian</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Visualisasi</h4>
                                    <p class="text-gray-600">Cakupan satelit divisualisasikan dalam format interaktif guna memberikan pengalaman pengguna yang informatif dan intuitif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="w-96 h-96 mx-auto relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full opacity-20 animate-pulse"></div>
                            <div class="absolute inset-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full opacity-30 animate-pulse" style="animation-delay: 1s;"></div>
                            <div class="absolute inset-8 bg-gradient-to-r from-blue-600 to-purple-700 rounded-full opacity-40 animate-pulse" style="animation-delay: 2s;"></div>
                            <div class="absolute inset-16 bg-white rounded-full flex items-center justify-center shadow-2xl">
                                <img src="{{ asset('img/LogoSLCBiru.png') }}" alt="Logo SkyLinkCal" class="w-37 h-37 object-contain">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        

        <!-- Back to Top Button -->
        <button id="backToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-110 opacity-0 invisible">
            <i class="fas fa-arrow-up"></i>
        </button>

        <script>
            // Mobile menu toggle
            const hamburger = document.getElementById('hamburger');
            const mobileMenu = document.getElementById('mobileMenu');
            
            hamburger.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                mobileMenu.classList.toggle('active');
            });
            
            // Close mobile menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('active');
                }
            });
            
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                    
                    // Close mobile menu after clicking
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('active');
                });
            });
            
            // Navbar scroll effect
            let lastScrollY = window.scrollY;
            
            window.addEventListener('scroll', () => {
                const navbar = document.querySelector('nav');
                
                if (window.scrollY > lastScrollY && window.scrollY > 100) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
                }
                
                lastScrollY = window.scrollY;
            });
        </script>
    </body>
</x-layout>