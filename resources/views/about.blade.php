<x-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SkyLinkCal Team</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        /* Default body background set via Tailwind class on the <body> tag */
        body {
            font-family: 'Inter', sans-serif;
            /* No need for background-color here, it's handled by Tailwind's bg-gray-50 on the body tag */
        }

        /* --- Custom Background for Hero Section (already full-width) --- */
        .hero-custom-bg {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); /* Sesuaikan dengan home page */
    position: relative;
    overflow: hidden;
    }

        .hero-custom-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
            z-index: 1;
        }

        .hero-custom-bg::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 40% 60%, rgba(255, 255, 255, 0.05) 0%, transparent 20%);
            background-size: 200px 200px;
            opacity: 0.8;
            z-index: 2;
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

        .team-card {
            transition: all 0.4s ease;
            border: 1px solid #e5e7eb;
            position: relative;
            overflow: hidden;
        }

        .team-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .team-card:hover::before {
            left: 100%;
        }

        .team-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-color: #4f46e5; /* Tailwind indigo-600 */
        }

        .advisor-card {
            background: linear-gradient(135deg, #6D28D9 0%, #9333EA 100%);
            color: white;
        }

        .advisor-card:hover {
            background: linear-gradient(135deg, #5a20b8 0%, #7d29c8 100%);
        }

        .member-card {
            background: linear-gradient(135deg, #EC4899 0%, #F43F5E 100%);
            color: white;
        }

        .member-card:hover {
            background: linear-gradient(135deg, #d83d8b 0%, #e02f4f 100%);
        }

        .profile-image {
            transition: all 0.4s ease;
            position: relative;
        }

        .profile-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            box-shadow: 0 0 0 0px rgba(165, 180, 252, 0.6);
            transition: all 0.3s ease;
        }

        .team-card:hover .profile-image::after {
            box-shadow: 0 0 0 20px rgba(165, 180, 252, 0);
        }

        .btn-contact {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            color: white;
        }

        .btn-contact:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }

        .text-gradient {
            background: linear-gradient(135deg, #6D28D9 0%, #9333EA 100%) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
        }

        .hero-text-gradient-custom {
            background: linear-gradient(90deg, #FDBA74, #FCD34D, #FBBF24) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
        }

        .hero-button-dosen {
            background-color: #FBBF24 !important;
            color: #111827 !important;
            transition: all 0.3s ease;
        }
        .hero-button-dosen:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.4);
        }

        .hero-button-anggota {
            background-color: #EF4444 !important;
            color: #ffffff !important;
            transition: all 0.3s ease;
        }
        .hero-button-anggota:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(236, 72, 153, 0.4);
        }

        /* Adjusted: section backgrounds now apply padding themselves */
        .section-dosen-bg {
            background: linear-gradient(to bottom right, #f8fafc 0%, #eff6ff 100%);
        }

        .dosen-card-border {
            border-top: 8px solid #4f46e5;
        }

        /* Adjusted: section backgrounds now apply padding themselves */
        .section-anggota-bg {
            background: linear-gradient(to bottom right, #fdf2f8 0%, #fff1f2 100%);
        }

        .anggota-card-border {
            border-top: 8px solid #EC4899;
        }

        .hero-section-content {
            position: relative;
            z-index: 10;
        }
    </style>
</head>

<body class="bg-gray-50"> 
    

    <section class="relative min-h-screen flex items-center justify-center hero-custom-bg">
        <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto hero-section-content">
            <div class="mb-8 floating">
    <div class="w-40 h-40 mx-auto bg-white/<div class="w-10 h-10 flex items-center justify-center>
        <img src="{{ asset('img/LogoSLC.png') }}" alt="SkyLinkCal Logo" class="w-full h-full object-contain">
    </div>

</div>

            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 animate__animated animate__fadeInUp hero-text-gradient-custom">
                SkyLinkCal
            </h1>
            <h2 class="text-xl md:text-3xl font-semibold text-white/90 mb-8 animate__animated animate__fadeInUp animate__delay-1s">
                "We are a Team of Extraordinary People!"
            </h2>

            <p class="text-lg md:text-xl text-white/80 max-w-3xl mx-auto mb-12 leading-relaxed animate__animated animate__fadeInUp animate__delay-2s">
                Kenali lebih dekat dosen pembimbing dan anggota tim di balik pengembangan SkyLinkCal yang berdedikasi dalam menciptakan solusi inovatif komunikasi satelit.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center animate__animated animate__fadeInUp animate__delay-3s">
                <a href="#advisors" class="glass-effect hero-button-dosen px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/20 transition">
                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                    Dosen Pembimbing
                </a>
                <a href="#team" class="glass-effect hero-button-anggota px-8 py-4 rounded-full font-semibold text-lg hover:bg-white/20 transition">
                    <i class="fas fa-users mr-2"></i>
                    Anggota Kelompok
                </a>
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce z-10">
            <i class="fas fa-chevron-down text-white text-2xl"></i>
        </div>
    </section>

    <section id="advisors" class="py-20 section-dosen-bg px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto"> <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6" data-aos="fade-up">
                    Dosen <span class="text-gradient">Pembimbing</span> Kami
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Para ahli di bidang komunikasi satelit yang membimbing kami menciptakan solusi inovatif dan memberikan arahan strategis dalam pengembangan SkyLinkCal
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-5xl mx-auto">
                <div class="team-card advisor-card rounded-3xl p-8 text-center dosen-card-border" data-aos="fade-right">
                    <div class="relative mb-8">
                        <div class="w-40 h-40 mx-auto">
                            <img src="{{ asset('img/edwar.jpg') }}" alt="Edwar, S.T., M.T."
                                    class="profile-image w-full h-full rounded-full border-4 border-white object-cover shadow-lg">
                        </div>
                    </div>

                    <h3 class="text-3xl font-bold mb-2">Edwar, S.T., M.T.</h3>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 inline-block mb-3">
                        <p class="font-semibold">First Academic Advisor</p>
                    </div>
                    <p class="text-white/90 text-lg mb-2">Intelligent Communications and Network</p>
                    <p class="text-white/80 mb-8"></p>

                    <a href="mailto:edwarm@telkomuniversity.ac.id"
                        class="btn-contact inline-flex items-center gap-3 px-8 py-4 rounded-full text-lg font-semibold">
                        <i class="fas fa-envelope"></i>
                        Hubungi Dosen
                    </a>
                </div>

                <div class="team-card advisor-card rounded-3xl p-8 text-center dosen-card-border" data-aos="fade-left">
                    <div class="relative mb-8">
                        <div class="w-40 h-40 mx-auto">
                            <img src="{{ asset('img/dhoni.jpg') }}" alt="Dhoni Putra Setiawan, S.T., M.T., Ph.D."
                                    class="profile-image w-full h-full rounded-full border-4 border-white object-cover shadow-lg">
                        </div>
                    </div>

                    <h3 class="text-3xl font-bold mb-2">Dhoni Putra Setiawan, S.T., M.T., Ph.D.</h3>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 inline-block mb-3">
                        <p class="font-semibold">Second Academic Advisor</p>
                    </div>
                    <p class="text-white/90 text-lg mb-2">Intelligent Communications and Network</p>
                    <p class="text-white/80 mb-8"></p>

                    <a href="mailto:dhoni.setiawan@telkomuniversity.ac.id"
                        class="btn-contact inline-flex items-center gap-3 px-8 py-4 rounded-full text-lg font-semibold">
                        <i class="fas fa-envelope"></i>
                        Hubungi Dosen
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="py-20 section-anggota-bg px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto"> <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6" data-aos="fade-up">
                    Tim <span class="text-gradient">Pengembang</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Kami adalah mahasiswa yang bersemangat dalam mengembangkan solusi inovatif untuk komunikasi satelit dengan dedikasi tinggi dan kolaborasi yang solid
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="team-card member-card rounded-3xl p-8 text-center anggota-card-border" data-aos="zoom-in" data-aos-delay="100">
                    <div class="relative mb-6">
                        <div class="w-32 h-32 mx-auto">
                            <img src="{{ asset('img/luthfi.jpg') }}" alt="Muhammad Luthfi"
                                    class="profile-image w-full h-full rounded-full border-4 border-white object-cover shadow-lg">
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold mb-2">Muhammad Luthfi</h3>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 inline-block mb-3">
                        <p class="font-semibold text-sm">Alat Simulasi</p>
                    </div>
                    <p class="text-white/90 mb-2">1101210305</p>
                    <p class="text-white/80 text-sm mb-6">Specialist dalam pengembangan tools simulasi orbit satelit</p>

                    <a href="mailto:muhluthfii@student.telkomuniversity.ac.id"
                        class="btn-contact inline-flex items-center gap-2 px-6 py-3 rounded-full text-sm font-semibold">
                        <i class="fas fa-envelope"></i>
                        Contact
                    </a>
                </div>

                <div class="team-card member-card rounded-3xl p-8 text-center anggota-card-border" data-aos="zoom-in" data-aos-delay="200">
                    <div class="relative mb-6">
                        <div class="w-32 h-32 mx-auto">
                            <img src="{{ asset('img/iyan.png') }}" alt="Iyan Cahyana"
                                    class="profile-image w-full h-full rounded-full border-4 border-white object-cover shadow-lg">
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold mb-2">Iyan Cahyana</h3>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 inline-block mb-3">
                        <p class="font-semibold text-sm">Web Development</p>
                    </div>
                    <p class="text-white/90 mb-2">1101213082</p>
                    <p class="text-white/80 text-sm mb-6">Frontend developer dengan fokus pada user experience</p>

                    <a href="mailto:iyanchyna24@email.com"
                        class="btn-contact inline-flex items-center gap-2 px-6 py-3 rounded-full text-sm font-semibold">
                        <i class="fas fa-envelope"></i>
                        Contact
                    </a>
                </div>

                <div class="team-card member-card rounded-3xl p-8 text-center anggota-card-border" data-aos="zoom-in" data-aos-delay="300">
                    <div class="relative mb-6">
                        <div class="w-32 h-32 mx-auto">
                            <img src="{{ asset('img/sultan.jpg') }}" alt="Muhammad Sultan Pasha Dondo"
                                    class="profile-image w-full h-full rounded-full border-4 border-white object-cover shadow-lg">
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold mb-2">Muhammad Sultan Pasha Dondo</h3>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 inline-block mb-3">
                        <p class="font-semibold text-sm">Web Development</p>
                    </div>
                    <p class="text-white/90 mb-2">1101213142</p>
                    <p class="text-white/80 text-sm mb-6">Backend developer dengan expertise dalam database management</p>

                    <a href="mailto:muhsultanpasha@email.com"
                        class="btn-contact inline-flex items-center gap-2 px-6 py-3 rounded-full text-sm font-semibold">
                        <i class="fas fa-envelope"></i>
                        Contact
                    </a>
                </div>

                <div class="team-card member-card rounded-3xl p-8 text-center anggota-card-border" data-aos="zoom-in" data-aos-delay="400">
                    <div class="relative mb-6">
                        <div class="w-32 h-32 mx-auto">
                            <img src="{{ asset('img/maharddhika.jpg') }}" alt="Maharddhika Paramananda"
                                    class="profile-image w-full h-full rounded-full border-4 border-white object-cover shadow-lg">
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold mb-2">Maharddhika Paramananda</h3>
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 inline-block mb-3">
                        <p class="font-semibold text-sm">Animasi</p>
                    </div>
                    <p class="text-white/90 mb-2">1101213174</p>
                    <p class="text-white/80 text-sm mb-6">Motion graphics designer untuk visualisasi data satelit</p>

                    <a href="mailto:paramananda@student.telkomuniversity.ac.id"
                        class="btn-contact inline-flex items-center gap-2 px-6 py-3 rounded-full text-sm font-semibold">
                        <i class="fas fa-envelope"></i>
                        Contact
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto"> <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Misi & <span class="text-gradient">Visi</span> Kami
                    </h2>
                    <p class="text-xl text-gray-600 mb-8">
                        Berkomitmen untuk menghadirkan solusi perhitungan satelit yang akurat, efisien, dan mudah digunakan
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-target text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Misi</h4>
                                <p class="text-gray-600">Mengembangkan platform perhitungan satelit yang presisi untuk mendukung pendidikan dan penelitian dalam bidang komunikasi satelit</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-eye text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Visi</h4>
                                <p class="text-gray-600">Menjadi platform terdepan dalam tools perhitungan satelit yang inovatif dan terpercaya di Indonesia</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-heart text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">Nilai</h4>
                                <p class="text-gray-600">Integritas, inovasi, dan kolaborasi dalam setiap aspek pengembangan untuk menciptakan dampak positif</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative" data-aos="fade-left">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-8 text-white">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold mb-4">Pencapaian Tim</h3>
                            <p class="text-blue-100">Hasil kerja keras dan dedikasi kami</p>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2">100%</div>
                                <div class="text-blue-100 text-sm">Commitment</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2">6+</div>
                                <div class="text-blue-100 text-sm">Months Development</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2">50+</div>
                                <div class="text-blue-100 text-sm">Testing Hours</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold mb-2">1</div>
                                <div class="text-blue-100 text-sm">Dream Team</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for navigation buttons
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            });

            // Initialize AOS
            AOS.init({
                once: true,
                mirror: false,
                duration: 1000,
                easing: 'ease-out-back',
            });
        });
    </script>
</body>

</x-layout>
