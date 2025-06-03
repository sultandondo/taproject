<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <title>SkyLinkCal - Modern Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

      body {
          font-family: 'Inter', sans-serif;
      }

      .text-gradient {
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
          background-clip: text;
      }

      .navbar-bg {
          background: rgba(51, 65, 85, 0.95);
          backdrop-filter: blur(20px);
          border-bottom: 1px solid rgba(148, 163, 184, 0.1);
      }

      .nav-link {
          position: relative;
          transition: all 0.3s ease;
      }

      .nav-link::after {
          content: '';
          position: absolute;
          bottom: -2px;
          left: 0;
          width: 0;
          height: 2px;
          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
          transition: width 0.3s ease;
      }

      .nav-link:hover::after {
          width: 100%;
      }

      .nav-link:hover {
          color: #667eea;
          transform: translateY(-1px);
      }

      .logo-container {
          transition: all 0.3s ease;
      }

      .logo-container:hover {
          transform: scale(1.05);
      }

      .mobile-menu {
          background: rgba(51, 65, 85, 0.98);
          backdrop-filter: blur(20px);
          transform: translateX(-100%);
          transition: transform 0.3s ease;
      }

      .mobile-menu.active {
          transform: translateX(0);
      }

      .hamburger {
          display: flex;
          flex-direction: column;
          cursor: pointer;
          transition: all 0.3s ease;
      }

      .hamburger span {
          width: 25px;
          height: 3px;
          background: white;
          margin: 3px 0;
          transition: 0.3s;
          border-radius: 2px;
      }

      .hamburger.active span:nth-child(1) {
          transform: rotate(-45deg) translate(-5px, 6px);
      }

      .hamburger.active span:nth-child(2) {
          opacity: 0;
      }

      .hamburger.active span:nth-child(3) {
          transform: rotate(45deg) translate(-5px, -6px);
      }
    </style>

</head>
<body class="h-full">
<div class="min-h-full">

<x-navbar></x-navbar>
  
<x-header></x-header>

    <main>
      <div>
        {{ $slot }}
      </div>
    </main>
    <section id="contact">
    <footer class="bg-gray-900 text-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 flex items-center justify-center">
                            <img src="{{ asset('img/LogoSLC.png') }}" alt="Logo SkyLinkCal" class="w-full h-full object-contain">
                        </div>
                        <span class="font-bold text-2xl">SkyLinkCal</span>
                    </div>
                    <p class="text-gray-400 max-w-md mb-6">
                        Platform ini dikembangkan untuk mempermudah perhitungan parameter link budget satelit.
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
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('calc.show', ['id' => 0]) }}" class="text-gray-400 hover:text-white transition">Calculate</a></li>
                        <li><a href="{{ route('about.us') }}" class="text-gray-400 hover:text-white transition">About Us</a></li>
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
                            <span class="text-gray-400">+62 812 3192 0800</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-blue-500"></i>
                            <span class="text-gray-400">Telkom University, Indonesia</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        © 2025 <strong class="text-white">Kelompok Website OrbitCal</strong>. All rights reserved.
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
    </section>
</body>
</html>