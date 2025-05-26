<x-layout>
    <x-slot:title>About Us - SkyLinkCalc Team</x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom Styles for gradients and animations */
        .hero-wave {
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg"><path fill="%236366F1" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,208C384,192,480,128,576,106.7C672,85,768,107,864,138.7C960,171,1056,213,1152,208C1248,203,1344,150,1392,124.7L1440,99L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat center bottom / cover;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px; /* Adjust height of wave as needed */
            z-index: 0;
        }

        .hero-text-gradient {
            background: linear-gradient(90deg, #FDBA74, #FCD34D, #FBBF24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .member-card:hover .member-img {
            transform: scale(1.05);
            box-shadow: 0 0 0 5px rgba(255, 255, 255, 0.5), 0 0 0 10px rgba(251, 191, 36, 0.3); /* Subtle yellow border glow */
        }

        .member-card:hover .email-button {
            background: linear-gradient(to right, #6D28D9, #9333EA); /* Purple gradient on hover */
        }

        /* Custom pulse for the glow around images */
        @keyframes glowing-border {
            0% { box-shadow: 0 0 0 0px rgba(165, 180, 252, 0.6); }
            50% { box-shadow: 0 0 0 15px rgba(165, 180, 252, 0); }
            100% { box-shadow: 0 0 0 0px rgba(165, 180, 252, 0.6); }
        }
        .animate-glowing-border {
            animation: glowing-border 2.5s infinite ease-in-out;
        }

        /* Hero buttons subtle scale on hover */
        .hero-button-dosen:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.4);
        }
        .hero-button-anggota:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(236, 72, 153, 0.4);
        }

    </style>

    <div class="relative bg-gradient-to-br from-purple-700 to-indigo-800 py-24 px-4 text-center overflow-hidden">
        <div class="hero-wave z-0"></div>

        <div class="relative z-10">
            <img src="{{ asset('img/LogoSLC.png') }}" alt="SkyLinkCalc Logo" 
                class="mx-auto object-contain w-48 h-48 mb-6 
                       animate-pulse hover:animate-spin transition-all duration-500 filter drop-shadow-2xl">
            
            <h1 class="text-5xl sm:text-7xl font-extrabold mb-4 hero-text-gradient animate__animated animate__fadeInDown">
                SkyLinkCalc
            </h1>
            <p class="text-xl sm:text-2xl font-semibold mb-6 text-indigo-200 animate__animated animate__fadeInUp animate__delay-0.5s">
                "We are a Team of Extraordinary People!"
            </p>
            <p class="text-lg sm:text-xl text-gray-200 max-w-3xl mx-auto mb-10 animate__animated animate__fadeIn animate__delay-1s">
                Kenali lebih dekat dosen pembimbing dan anggota tim di balik pengembangan SkyLinkCalc yang berdedikasi ini.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-6 animate__animated animate__zoomIn animate__delay-1.5s">
                <a href="#dosen" class="hero-button-dosen bg-yellow-400 text-gray-900 font-bold text-xl px-10 py-5 rounded-full shadow-lg transition-all duration-300">
                    <i class="fas fa-chalkboard-teacher mr-3"></i> Dosen Pembimbing
                </a>
                <a href="#anggota" class="hero-button-anggota bg-rose-500 text-white font-bold text-xl px-10 py-5 rounded-full shadow-lg transition-all duration-300">
                    <i class="fas fa-users mr-3"></i> Anggota Kelompok
                </a>
            </div>
        </div>
    </div>

    <div id="dosen" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl sm:text-5xl font-extrabold text-center text-indigo-800 mb-6" data-aos="fade-up">
                Dosen Pembimbing Kami
            </h2>
            <p class="text-lg text-center text-gray-600 mb-16 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Para ahli di bidang komunikasi satelit yang membimbing kami menciptakan solusi inovatif.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-white rounded-3xl shadow-xl p-8 flex flex-col items-center text-center group transition-all duration-300 transform hover:scale-105 hover:shadow-2xl border-t-8 border-indigo-600" data-aos="fade-right">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-indigo-500 opacity-20 transform scale-110 animate-glowing-border"></div>
                        <img src="{{ asset('img/edwar.jpg') }}" alt="Edwar, S.T., M.T." 
                             class="w-40 h-40 rounded-full border-4 border-white object-cover relative z-10 transition-transform duration-300 group-hover:scale-105 member-img">
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">Edwar, S.T., M.T.</h3>
                    <p class="text-xl font-semibold text-indigo-700 mb-2">First Academic Advisor</p>
                    <p class="text-gray-600 text-lg mb-8">
                        Intelligent Communications and Network
                    </p>
                    <a href="mailto:edwarm@telkomuniversity.ac.id" 
                       class="email-button inline-flex items-center gap-3 bg-indigo-600 text-white px-8 py-4 rounded-full text-lg font-semibold shadow-md transition-all duration-300 hover:shadow-xl">
                        <i class="fas fa-envelope"></i> Hubungi Dosen
                    </a>
                </div>
                
                <div class="bg-white rounded-3xl shadow-xl p-8 flex flex-col items-center text-center group transition-all duration-300 transform hover:scale-105 hover:shadow-2xl border-t-8 border-indigo-600" data-aos="fade-left">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-indigo-500 opacity-20 transform scale-110 animate-glowing-border" style="animation-delay: 1s;"></div>
                        <img src="{{ asset('img/dhoni.jpg') }}" alt="Dhoni Putra Setiawan, S.T., M.T., Ph.D." 
                             class="w-40 h-40 rounded-full border-4 border-white object-cover relative z-10 transition-transform duration-300 group-hover:scale-105 member-img">
                    </div>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">Dhoni Putra Setiawan, S.T., M.T., Ph.D.</h3>
                    <p class="text-xl font-semibold text-indigo-700 mb-2">Second Academic Advisor</p>
                    <p class="text-gray-600 text-lg mb-8">
                         Intelligent Communications and Network
                    </p>
                    <a href="mailto:dhoni.setiawan@telkomuniversity.ac.id" 
                       class="email-button inline-flex items-center gap-3 bg-indigo-600 text-white px-8 py-4 rounded-full text-lg font-semibold shadow-md transition-all duration-300 hover:shadow-xl">
                        <i class="fas fa-envelope"></i> Hubungi Dosen
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="anggota" class="py-20 bg-gradient-to-br from-pink-50 to-rose-100 px-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl sm:text-5xl font-extrabold text-center text-rose-800 mb-6" data-aos="fade-up">
                Tim Pengembang
            </h2>
            <p class="text-lg text-center text-gray-600 mb-16 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Kami adalah mahasiswa yang bersemangat dalam mengembangkan solusi inovatif untuk komunikasi satelit.
            </p>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-3xl shadow-lg p-8 flex flex-col items-center text-center group transition-all duration-300 transform hover:scale-105 hover:shadow-xl border-t-8 border-pink-500" data-aos="zoom-in" data-aos-delay="300">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-pink-400 opacity-20 transform scale-110 animate-glowing-border" style="animation-delay: 0.5s;"></div>
                        <img src="{{ asset('img/luthfi.jpg') }}" alt="Muhammad Luthfi" 
                             class="w-36 h-36 rounded-full border-4 border-white object-cover shadow-md relative z-10 transition-transform duration-300 group-hover:scale-105 member-img">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">Muhammad Luthfi</h3>
                    <p class="text-lg font-medium text-pink-700 mb-2">Tools Simulation</p>
                    <p class="text-gray-600 mb-6">1101210305</p>
                    <a href="mailto:muhluthfii@student.telkomuniversity.ac.id" 
                       class="email-button inline-flex items-center gap-2 bg-pink-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-md transition-all duration-300 hover:shadow-xl">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </div>
                
                <div class="bg-white rounded-3xl shadow-lg p-8 flex flex-col items-center text-center group transition-all duration-300 transform hover:scale-105 hover:shadow-xl border-t-8 border-pink-500" data-aos="zoom-in" data-aos-delay="400">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-pink-400 opacity-20 transform scale-110 animate-glowing-border" style="animation-delay: 1s;"></div>
                        <img src="{{ asset('img/iyan.png') }}" alt="Iyan Cahyana" 
                             class="w-36 h-36 rounded-full border-4 border-white object-cover shadow-md relative z-10 transition-transform duration-300 group-hover:scale-105 member-img">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">Iyan Cahyana</h3>
                    <p class="text-lg font-medium text-pink-700 mb-2">Backend Developer</p>
                    <p class="text-gray-600 mb-6">1101213082</p>
                    <a href="mailto:iyanchyna24@email.com" 
                       class="email-button inline-flex items-center gap-2 bg-pink-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-md transition-all duration-300 hover:shadow-xl">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </div>
                
                <div class="bg-white rounded-3xl shadow-lg p-8 flex flex-col items-center text-center group transition-all duration-300 transform hover:scale-105 hover:shadow-xl border-t-8 border-pink-500" data-aos="zoom-in" data-aos-delay="500">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-pink-400 opacity-20 transform scale-110 animate-glowing-border" style="animation-delay: 1.5s;"></div>
                        <img src="{{ asset('img/sultan.jpg') }}" alt="Muhammad Sultan Pasha Dondo" 
                             class="w-36 h-36 rounded-full border-4 border-white object-cover shadow-md relative z-10 transition-transform duration-300 group-hover:scale-105 member-img">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">Muhammad Sultan Pasha Dondo</h3>
                    <p class="text-lg font-medium text-pink-700 mb-2">Fullstack Developer</p>
                    <p class="text-gray-600 mb-6">1101213142</p>
                    <a href="mailto:muhsultanpasha@email.com" 
                       class="email-button inline-flex items-center gap-2 bg-pink-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-md transition-all duration-300 hover:shadow-xl">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </div>
                
                <div class="bg-white rounded-3xl shadow-lg p-8 flex flex-col items-center text-center group transition-all duration-300 transform hover:scale-105 hover:shadow-xl border-t-8 border-pink-500" data-aos="zoom-in" data-aos-delay="600">
                    <div class="relative mb-6">
                        <div class="absolute inset-0 rounded-full bg-pink-400 opacity-20 transform scale-110 animate-glowing-border" style="animation-delay: 2s;"></div>
                        <img src="{{ asset('img/maharddhika.jpg') }}" alt="Maharddhika Paramananda" 
                             class="w-36 h-36 rounded-full border-4 border-white object-cover shadow-md relative z-10 transition-transform duration-300 group-hover:scale-105 member-img">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">Maharddhika Paramananda</h3>
                    <p class="text-lg font-medium text-pink-700 mb-2">Animations Result</p>
                    <p class="text-gray-600 mb-6">1101213174</p>
                    <a href="mailto:paramananda@student.telkomuniversity.ac.id" 
                       class="email-button inline-flex items-center gap-2 bg-pink-600 text-white px-6 py-3 rounded-full text-sm font-medium shadow-md transition-all duration-300 hover:shadow-xl">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll untuk tombol navigasi
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start' // Adjust to 'center' or 'end' if needed
                    });
                });
            });

            // Initialize AOS
            AOS.init({
                once: true, // whether animation should happen only once - default
                mirror: false, // whether elements should animate out while scrolling past them
                duration: 1000, // values from 0 to 3000, with step 50ms
                easing: 'ease-out-back', // default easing for AOS animations
            });
        });
    </script>
</x-layout>