<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyLinkCal - Perhitungan Satelit Praktis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .feature-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-color: #6366f1;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);
        }
        
        .stats-counter {
            font-family: 'Inter', monospace;
            font-weight: 700;
        }
        
        .satellite-orbit {
            position: absolute;
            width: 300px;
            height: 300px;
            border: 2px dashed rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: rotate 20s linear infinite;
        }
        
        .satellite {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: #fbbf24;
            border-radius: 50%;
            box-shadow: 0 0 20px #fbbf24;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 flex items-center justify-center">
    <img src="{{ asset('img/LogoSLC.png') }}" alt="Logo SkyLinkCal" class="w-full h-full object-contain">
</div>
                    <span class="font-bold text-xl text-gradient">SkyLinkCal</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition">Home</a>
                    <a href="#features" class="text-gray-700 hover:text-blue-600 font-medium transition">Features</a>
                    <a href="#contact" class="text-gray-700 hover:text-blue-600 font-medium transition">Contact</a>
                </div>
                <button class="md:hidden">
                    <i class="fas fa-bars text-gray-700"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden gradient-bg">
        
        
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
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate__animated animate__fadeInUp">
                SkyLinkCal
            </h1>
            <h2 class="text-2xl md:text-4xl font-semibold text-white/90 mb-8 animate__animated animate__fadeInUp animate__delay-1s">
                Perhitungan Satelit Praktis
            </h2>

            <!-- Description -->
            <p class="text-lg md:text-xl text-white/80 max-w-3xl mx-auto mb-6 leading-relaxed animate__animated animate__fadeInUp animate__delay-2s">
                Selamat datang di SkyLinkCal! Aplikasi yang membantu menghitung berbagai parameter satelit secara komprehensif, menyimpan riwayat perhitungan, dan menampilkan visualisasi.

            </p>
            <p class="text-md md:text-lg text-white/70 max-w-2xl mx-auto mb-12 animate__animated animate__fadeInUp animate__delay-3s">
                Solusi cepat dan efisien untuk mendukung studi, penelitian, atau proyek berbasis sistem komunikasi satelit.
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate__animated animate__fadeInUp animate__delay-4s">
                <button class="btn-primary text-white px-8 py-4 rounded-full font-semibold text-lg">
                    <i class="fas fa-calculator mr-2"></i>
                    Mulai Perhitungan
                </button>
                
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
                    Fitur <span class="text-gradient">Unggulan</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Dilengkapi dengan teknologi terdepan untuk memberikan hasil perhitungan satelit yang presisi dan analisis mendalam
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1: Calculator -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-sm">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-calculator text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kalkulator Parameter</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Hitung kecepatan dan waktu parameter berdasarkan parameter satelit secara cepat dan akurat dengan interface yang intuitif.
                    </p>
                    <div class="flex items-center justify-between">
                        <button class="btn-primary text-white px-6 py-3 rounded-full font-semibold hover:shadow-lg transition">
                            Hitung Sekarang
                        </button>
                        <div class="text-blue-500">
                            <i class="fas fa-arrow-right text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Feature 2: History -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-sm">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Riwayat Perhitungan</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Akses dan analisis data perhitungan sebelumnya dengan visualisasi grafik interaktif untuk mendukung riset dan dokumentasi.
                    </p>
                    <div class="flex items-center justify-between">
                        <button onclick="window.location.href='#'" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full font-semibold transition transform hover:scale-105">
                            Lihat Riwayat
                        </button>
                        <div class="text-green-500">
                            <i class="fas fa-arrow-right text-lg"></i>
                        </div>
                    </div>
                </div>

                <!-- Feature 3: Contact Form -->
                <div class="feature-card bg-white rounded-2xl p-8 shadow-sm md:col-span-2 lg:col-span-1">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Hubungi Tim Ahli</h3>
                    
                    <form action="/contact" method="POST" class="space-y-4">
                        <div>
                            <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" placeholder="nama@email.com" required>
                        </div>
                        <div>
                            <label for="pesan" class="block text-sm font-semibold text-gray-700 mb-2">Pesan</label>
                            <textarea name="pesan" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition" rows="4" placeholder="Tulis pertanyaan atau feedback Anda..." required></textarea>
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
                        Mengapa Memilih <span class="text-gradient">SkyLinkCal?</span>
                    </h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Platform terdepan untuk perhitungan satelit dengan teknologi canggih dan dukungan professional
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Akurasi Tinggi</h4>
                                <p class="text-gray-600">Algoritma matematika presisi dengan margin error minimal untuk hasil yang dapat diandalkan</p>
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
                                <h4 class="font-semibold text-gray-900 mb-2">Support Professional</h4>
                                <p class="text-gray-600">Tim ahli satelit siap membantu Anda dengan respon cepat dan solusi terpercaya</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-8 text-white">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-2">24/7</div>
                                <div class="text-blue-100">Support Available</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-2">1000+</div>
                                <div class="text-blue-100">Active Users</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-2">99.9%</div>
                                <div class="text-blue-100">Uptime</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold mb-2">5★</div>
                                <div class="text-blue-100">User Rating</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 rounded-lg flex items-center justify-center overflow-hidden">
    <img src="{{ asset('img/LogoSLC.png') }}" alt="Satellite Icon" class="w-full h-full object-cover">
</div>
                        <span class="font-bold text-2xl">SkyLinkCal</span>
                    </div>
                    <p class="text-gray-400 max-w-md mb-6">
                        Platform terdepan untuk perhitungan satelit profesional dengan teknologi canggih dan dukungan expert.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-lg mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition">Features</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="font-semibold text-lg mb-6">Contact Info</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-blue-500"></i>
                            <span class="text-gray-400">skylinkcalc25@gmail.com</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-blue-500"></i>
                            <span class="text-gray-400">+62 123 4567 890</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-blue-500"></i>
                            <span class="text-gray-400">Bandung, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        © 2025 <strong class="text-white">Kelompok Website OrbitCalc</strong>. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-110 opacity-0 invisible">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Back to top functionality
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Stats counter animation
        const counters = document.querySelectorAll('.stats-counter');
        const observerOptions = {
            threshold: 0.7
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.textContent.replace(/[^\d]/g, ''));
                    const increment = target / 100;
                    let current = 0;
                    
                    const updateCounter = () => {
                        if (current < target) {
                            current += increment;
                            counter.textContent = Math.floor(current) + (counter.textContent.includes('%') ? '%' : counter.textContent.includes('+') ? '+' : '');
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = counter.textContent;
                        }
                    };
                    
                    updateCounter();
                    observer.unobserve(counter);
                }
            });
        }, observerOptions);

        counters.forEach(counter => observer.observe(counter));
    </script>
</body>
</html>