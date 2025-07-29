<x-layout>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyLinkCal - Perhitungan Satelit Praktis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
            max-width: 100vw;
            margin: 0;
            padding: 0;
        }

        /* Container fixes */
        .container-full-width {
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
        }

        .max-w-7xl {
            max-width: 100%;
            width: 100%;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .max-w-7xl {
                max-width: 1280px;
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .max-w-7xl {
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

        .max-w-5xl {
            max-width: 100%;
            width: 100%;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .max-w-5xl {
                max-width: 1024px;
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        .max-w-4xl {
            max-width: 100%;
            width: 100%;
            margin: 0 auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        @media (min-width: 640px) {
            .max-w-4xl {
                max-width: 896px;
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
        }

        /* Fix hero logo container */
        .hero-logo-container {
            width: 120px;
            height: 120px;
            margin: 0 auto 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        @media (min-width: 768px) {
            .hero-logo-container {
                width: 160px;
                height: 160px;
            }
        }

        /* Fix why choose us image */
        .why-choose-image {
            max-width: 100%;
            margin: 0 auto;
            padding: 1rem;
        }

        .circle-animation {
            width: 280px;
            height: 280px;
            margin: 0 auto;
            position: relative;
        }

        @media (min-width: 640px) {
            .circle-animation {
                width: 320px;
                height: 320px;
            }
        }

        @media (min-width: 768px) {
            .circle-animation {
                width: 384px;
                height: 384px;
            }
        }

        /* Mobile responsive improvements */
        @media (max-width: 640px) {
            .hover\:scale-105:hover {
                transform: none;
            }
            
            .hover\:-translate-y-2:hover {
                transform: none;
            }
            
            .animate-pulse {
                animation: none;
            }
            
            .animate-bounce {
                animation: none;
            }
        }

        /* Ensure all sections stay within viewport */
        section {
            width: 100%;
            max-width: 100vw;
            overflow-x: hidden;
        }

        /* Fix grid overflow issues */
        .grid {
            width: 100%;
            max-width: 100%;
        }

        /* Responsive background pattern */
        .bg-pattern {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .bg-pattern .grid {
            height: 100%;
            width: 100%;
        }

        /* Better button sizing for mobile */
        .mobile-button {
            font-size: 0.875rem;
            padding: 0.75rem 1.5rem;
        }

        @media (min-width: 640px) {
            .mobile-button {
                font-size: 1rem;
                padding: 0.75rem 2rem;
            }
        }

        /* Fix modal responsive */
        .modal-container {
            margin: 1rem;
            max-width: calc(100vw - 2rem);
        }

        @media (min-width: 640px) {
            .modal-container {
                margin: 0;
                max-width: 28rem;
            }
        }
    </style>
</head>
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
               
                    <!-- Feature 1: Calculator -->
              
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8"> <div class="grid grid-cols-1 md:grid-cols-2 gap-8"> <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-blue-200 hover:-translate-y-2">
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
                        <!-- <a href="{{ route('history') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-full font-semibold transition transform hover:scale-105 flex items-center justify-center">
        Lihat Riwayat -->
                        </a>
                        @auth
                            <a href="{{ route('history') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-full font-semibold transition transform hover:scale-105 flex items-center justify-center">Lihat Riwayat</a>
                        @else
                            <button onclick="openAuthModal()" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-full font-semibold transition transform hover:scale-105 flex items-center justify-center">
                                Lihat Riwayat
                            </button>
                        @endauth

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
                    <div class="mx-auto relative">
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

            function openAuthModal() {
                document.getElementById('authModal').classList.remove('hidden');
                showLogin();
            }

            function closeAuthModal() {
                document.getElementById('authModal').classList.add('hidden');
            }

            function showLogin() {
                document.getElementById('loginForm').classList.remove('hidden');
                document.getElementById('registerForm').classList.add('hidden');
            }

            function showRegister() {
                document.getElementById('registerForm').classList.remove('hidden');
                document.getElementById('loginForm').classList.add('hidden');
            }
        </script>
        <!-- Modal Login/Register -->
        <div id="authModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 relative">
                <button onclick="closeAuthModal()" class="absolute top-3 right-3 text-gray-500 hover:text-red-500 text-xl">&times;</button>
                
                <div id="loginForm">
                    <h2 class="text-2xl font-bold mb-4">Login</h2>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="email" name="email" placeholder="Email" required class="w-full mb-4 p-3 border rounded">
                        <input type="password" name="password" placeholder="Password" required class="w-full mb-4 p-3 border rounded">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
                    </form>
                    <p class="text-sm mt-4 text-gray-600">Belum punya akun? <button onclick="showRegister()" class="text-blue-600 hover:underline">Daftar</button></p>
                </div>

                <div id="registerForm" class="hidden">
                    <h2 class="text-2xl font-bold mb-4">Daftar</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="text" name="name" placeholder="Nama" required class="w-full mb-4 p-3 border rounded">
                        <input type="email" name="email" placeholder="Email" required class="w-full mb-4 p-3 border rounded">
                        <input type="password" name="password" placeholder="Password" required class="w-full mb-4 p-3 border rounded">
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required class="w-full mb-4 p-3 border rounded">
                        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Daftar</button>
                    </form>
                    <p class="text-sm mt-4 text-gray-600">Sudah punya akun? <button onclick="showLogin()" class="text-blue-600 hover:underline">Login</button></p>
                </div>
            </div>
        </div>

    </body>
</x-layout>