<x-layout>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>History - Satellite Link Budget</title>
        {{-- Tailwind CSS CDN (Pastikan ini terhubung atau Anda menggunakan proses build) --}}
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        {{-- Font Awesome CDN (untuk ikon) --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+zQNH5Tt+g/LOQ+wVzL9Sg/oD/o3q1D6V6tN1O/Q6J5p7U+N7B1E9C+oG0/1/6T07m+6J8pQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- Alpine.js CDN --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        {{-- MathJax CDN Configuration and Loading --}}
        {{-- Gunakan versi MathJax 3.x.x karena lebih modern dan kompatibel --}}
        <script>
            window.MathJax = {
                tex: {
                    inlineMath: [['$', '$'], ['\\(', '\\)']] // Mengizinkan $...$ untuk inline math
                },
                svg: {
                    fontCache: 'global' // Meningkatkan performa rendering SVG
                },
                options: {
                    ignoreHtmlClass: 'non-math', // Kelas HTML yang MathJax akan abaikan
                    processHtmlClass: 'math-content', // Kelas HTML yang MathJax akan proses
                    menuSettings: { zoom: "Double-Click", zscale: "150%" }, // Optional: Zoom on double-click
                }
            };
        </script>
        {{-- Memuat MathJax library --}}
        <script type="text/javascript" id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

        <style>
            /* Custom scrollbar for tab navigation */
            .custom-scrollbar::-webkit-scrollbar {
                height: 8px;
            }
            .custom-scrollbar::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #d8b4fe; /* purple-300 */
                border-radius: 10px;
            }
            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #c084fc; /* purple-400 */
            }

            /* Ensure math content has proper spacing and display */
            .math-content .flex-col strong {
                display: block; /* Make the strong tag take its own line for better separation */
                margin-bottom: 0.25rem; /* Small space below label */
            }
            .math-content .flex-col span {
                display: block; /* Ensure value is on its own line after label */
                padding-left: 0.5rem; /* Indent value slightly */
            }

            /* Optional: Gaya untuk konten MathJax agar tidak ada 'breaking' yang aneh */
            .math-content {
                word-wrap: break-word; /* Memastikan teks panjang pecah baris */
                overflow-wrap: break-word;
            }
        </style>
    </head>
    <body class="bg-gray-100 font-sans antialiased">
        <section class="relative min-h-[50vh] flex items-center justify-center overflow-hidden pt-16 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-white shadow-lg">
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

            <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-5xl mx-auto py-12">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-4 drop-shadow-2xl">
                    History
                </h1>
                <h2 class="text-2xl md:text-4xl font-semibold text-purple-200 mb-6 tracking-wide">
                    Riwayat Perhitungan Satelit Anda
                </h2>
                <p class="text-lg md:text-xl text-purple-100 max-w-3xl mx-auto leading-relaxed opacity-90">
                    Jelajahi dan kelola semua perhitungan link budget satelit yang telah Anda lakukan dengan mudah.
                </p>
            </div>
        </section>

        <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl font-extrabold mb-12 text-center text-gray-900">Detail Riwayat Perhitungan</h2>

                @forelse($data as $item)
                <div class="bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 mb-12 border border-purple-100 overflow-hidden">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                        <div class="mb-8"> {{-- Anda bisa menghapus semua kelas flex jika Anda selalu ingin mereka stack --}}
                            <h3 class="text-3xl font-bold text-gray-800">Perhitungan Ke {{ $loop->iteration }}</h3>
                            <h5 class="text-xl font-bold text-gray-800 mt-2">pada {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</h5> {{-- Tambahkan margin top jika perlu jarak --}}
                        </div>
                            <div class="flex flex-wrap gap-3 mt-4 md:mt-0 justify-end">
                            <a href="{{ route('animasi.show', ['id' => $item->id]) }}" class="inline-flex items-center px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white text-base font-semibold rounded-full shadow-lg transition transform hover:scale-105 hover:shadow-xl">
                                <i class="fas fa-play-circle mr-2"></i> Lihat Animasi
                            </a>
                        </div>
                    </div>

                    <div x-data="{ openTab: 'orbit' }" class="mb-8">
                        {{-- Tabs Navigation (These buttons would ideally be changed to accordion buttons with data-accordion-target matching the panel IDs) --}}
                        <div class="flex flex-wrap border-b border-gray-200 -mb-px text-sm md:text-base overflow-x-auto custom-scrollbar pb-2">
                            <button @click="openTab = 'orbit'" :class="{ 'border-purple-600 text-purple-600': openTab === 'orbit', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'orbit' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Parameter Orbit
                            </button>
                            <button @click="openTab = 'uplink_geo'" :class="{ 'border-purple-600 text-purple-600': openTab === 'uplink_geo', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'uplink_geo' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Uplink Geolocation & Azimuth
                            </button>
                            <button @click="openTab = 'downlink_geo'" :class="{ 'border-purple-600 text-purple-600': openTab === 'downlink_geo', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'downlink_geo' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Downlink Geolocation & Azimuth
                            </button>
                            <button @click="openTab = 'freq_path'" :class="{ 'border-purple-600 text-purple-600': openTab === 'freq_path', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'freq_path' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Frekuensi & Path Loss
                            </button>
                            <button @click="openTab = 'uplink_tx'" :class="{ 'border-purple-600 text-purple-600': openTab === 'uplink_tx', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'uplink_tx' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Uplink Transmitter
                            </button>
                            <button @click="openTab = 'downlink_tx'" :class="{ 'border-purple-600 text-purple-600': openTab === 'downlink_tx', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'downlink_tx' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Downlink Transmitter
                            </button>
                            <button @click="openTab = 'uplink_rx'" :class="{ 'border-purple-600 text-purple-600': openTab === 'uplink_rx', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'uplink_rx' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Uplink Receiver
                            </button>
                            <button @click="openTab = 'downlink_rx'" :class="{ 'border-purple-600 text-purple-600': openTab === 'downlink_rx', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'downlink_rx' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Downlink Receiver
                            </button>
                            <button @click="openTab = 'antenna_details'" :class="{ 'border-purple-600 text-purple-600': openTab === 'antenna_details', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'antenna_details' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Antenna Gain
                            </button>
                            <button @click="openTab = 'antenna_pointing'" :class="{ 'border-purple-600 text-purple-600': openTab === 'antenna_pointing', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'antenna_pointing' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Antenna Pointing Losses
                            </button>
                            <button @click="openTab = 'polarization_losses'" :class="{ 'border-purple-600 text-purple-600': openTab === 'polarization_losses', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'polarization_losses' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Antenna Polarization Losses
                            </button>
                            <button @click="openTab = 'atmospheric_losses'" :class="{ 'border-purple-600 text-purple-600': openTab === 'atmospheric_losses', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'atmospheric_losses' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Atmospheric & Ionospheric Losses
                            </button>
                            <button @click="openTab = 'uplink_budget'" :class="{ 'border-purple-600 text-purple-600': openTab === 'uplink_budget', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'uplink_budget' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Uplink Budget
                            </button>
                            <button @click="openTab = 'downlink_budget'" :class="{ 'border-purple-600 text-purple-600': openTab === 'downlink_budget', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'downlink_budget' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                Downlink Budget
                            </button>
                            <button @click="openTab = 'summary'" :class="{ 'border-purple-600 text-purple-600': openTab === 'summary', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': openTab !== 'summary' }"
                                class="inline-flex items-center justify-center py-3 px-4 text-center border-b-2 font-medium focus:outline-none transition-colors duration-200 whitespace-nowrap">
                                System Summary
                            </button>
                        </div>

                        {{-- Tab Content --}}
                        <div class="mt-8 p-6 bg-gray-50 rounded-lg shadow-inner border border-gray-100">

                            {{-- Orbit Parameters --}}
                            <div id="panel-orbit" x-show="openTab === 'orbit'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Parameter Orbit
                                    <a href="{{ route('calc.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                   
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <div class="flex flex-col"><strong class="text-gray-800">Jenis Orbit:</strong> <span>{{ $item->jenis_orbit ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Inklinasi:</strong> <span>${{ $item->inklinasi ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Apogee:</strong> <span>{{ $item->apogee ?? '-' }} km</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Perigee:</strong> <span>{{ $item->perigee ?? '-' }} km</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Eccentricity ($e$):</strong> <span>${{ $item->eccentricity ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Argument of Perigee ($\omega$):</strong> <span>${{ $item->argumenop ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">R.A.A.N ($\Omega$):</strong> <span>${{ $item->raan ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Sudut Elevasi:</strong> <span>${{ $item->elevasi ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Mean Orbit Altitude:</strong> <span>{{ $item->altitude ?? '-' }} km</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Mean Orbit Radius:</strong> <span>{{ $item->radius ?? '-' }} km</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Slant Range:</strong> <span>{{ $item->slant_range ?? '-' }} km</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">True Anomaly:</strong> <span>${{ $item->mean_anomaly ?? '-' }}$&deg;</span></div>
                                </div>
                            </div>

                            {{-- Uplink Geolocation & Azimuth --}}
                            <div id="panel-azimuth-uplink" x-show="openTab === 'uplink_geo'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Uplink Geolocation & Azimuth
                                 <a href="{{ route('calcazimuth.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">User Location</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">User Latitude:</strong> <span>${{ $item->userlat_up ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">User Longitude:</strong> <span>${{ $item->userlong_up ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Spacecraft Slot Longitude:</strong> <span>${{ $item->spaceslot_up ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Slant Range to User:</strong> <span>{{ $item->slantrangetouser_up_input ?? '-' }} km</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">User Elevation Angle:</strong> <span>${{ $item->userelevationangel_up_input ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Earth Central Angle:</strong> <span>${{ $item->earthcentralangle_up_input ?? '-' }}$&deg;</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Intermediate Calculations</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Latitude Uplink:</strong> <span>${{ $item->latitude_up ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">In N. Hem?:</strong> <span>{{ $item->innhem_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">NOT In N. Hem?:</strong> <span>{{ $item->innhem2_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">$\Delta$ Longitude Uplink:</strong> <span>${{ $item->longitude_up ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">East of Sat:</strong> <span>{{ $item->eastofsat_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">NOT East of Sat:</strong> <span>{{ $item->eastofsat2_up ?? '-' }}</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Quadrant Results</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NE (Sat. in Quad):</strong> <span>{{ $item->sat_in_quad_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NE (Quad. Result):</strong> <span>{{ $item->quad_result_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NE (Angle Range):</strong> <span>{{ $item->quad_angle_range_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SE (Sat. in Quad):</strong> <span>{{ $item->sat_in_quad_value_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SE (Quad. Result):</strong> <span>{{ $item->quad_result_value_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SE (Angle Range):</strong> <span>{{ $item->quad_angle_range_value_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SW (Sat. in Quad):</strong> <span>{{ $item->sat_in_quad_value2_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SW (Quad. Result):</strong> <span>{{ $item->quad_result_value2_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SW (Angle Range):</strong> <span>{{ $item->quad_angle_range_value2_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NW (Sat. in Quad):</strong> <span>{{ $item->sat_in_quad_value3_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NW (Quad. Result):</strong> <span>{{ $item->quad_result_value3_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NW (Angle Range):</strong> <span>{{ $item->quad_angle_range_value3_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Uplink AzimuthCalc:</strong> <span>${{ $item->azimuthcalc_up ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Uplink Azimuth Result:</strong> <span>${{ $item->azimuthresult_up ?? '-' }}$</span></div>
                                </div>
                            </div>

                            {{-- Downlink Geolocation & Azimuth --}}
                            <div id="panel-azimuth-downlink" x-show="openTab === 'downlink_geo'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Downlink Geolocation & Azimuth
                                    <a href="{{ route('calcazimuth.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">User Location</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">User Latitude:</strong> <span>${{ $item->userlat_down ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">User Longitude:</strong> <span>${{ $item->userlong_down ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Spacecraft Slot Longitude:</strong> <span>${{ $item->spaceslot_down ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Slant Range to User:</strong> <span>{{ $item->slantrangetouser_down_input ?? '-' }} km</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">User Elevation Angle:</strong> <span>${{ $item->userelevationangel_down_input ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Earth Central Angle:</strong> <span>${{ $item->earthcentralangle_down_input ?? '-' }}$&deg;</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Intermediate Calculations</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Latitude Downlink:</strong> <span>${{ $item->latitude_down ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">In N. Hem?:</strong> <span>{{ $item->innhem_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">NOT In N. Hem?:</strong> <span>{{ $item->innhem2_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">$\Delta$ Longitude:</strong> <span>${{ $item->longitude_down ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">East of Sat:</strong> <span>{{ $item->eastofsat_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">NOT East of Sat:</strong> <span>{{ $item->eastofsat2_down ?? '-' }}</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Quadrant Results</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NE (Sat. in Quad):</strong> <span>{{ $item->sat_in_quad_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NE (Quad. Result):</strong> <span>{{ $item->quad_result_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NE (Angle Range):</strong> <span>{{ $item->quad_angle_range_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SE (Sat. in Quad):</strong> <span>{{ $item->sat_in_quad_value_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SE (Quad. Result):</strong> <span>{{ $item->quad_result_value_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SE (Angle Range):</strong> <span>{{ $item->quad_angle_range_value_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SW (Sat. in Quad):</strong> <span>{{ $item->sat_in_quad_value2_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SW (Quad. Result):</strong> <span>{{ $item->quad_result_value2_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad SW (Angle Range):</strong> <span>{{ $item->quad_angle_range_value2_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NW (Sat. in Quad):</strong> <span>{{ $item->sat_in_quad_value3_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NW (Quad. Result):</strong> <span>{{ $item->quad_result_value3_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Quad NW (Angle Range):</strong> <span>{{ $item->quad_angle_range_value3_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Downlink AzimuthCalc:</strong> <span>${{ $item->azimuthcalc_down ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Downlink Azimuth Result:</strong> <span>${{ $item->azimuthresult_down ?? '-' }}$</span></div>
                                </div>
                            </div>

                            {{-- Frequency & Path Loss --}}
                            <div id="panel-frekuensi" x-show="openTab === 'freq_path'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Frekuensi & Path Loss
                                  <a href="{{ route('frek.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Uplink Parameters</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Uplink Frekuensi:</strong> <span>{{ $item->frekuensi ?? '-' }} Hz</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Wavelength ($\lambda$) Uplink:</strong> <span>${{ $item->panjang_gelombang ?? '-' }}$ m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Path Loss Uplink:</strong> <span>{{ $item->path_loss ?? '-' }} dB</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Downlink Parameters</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Downlink Frekuensi:</strong> <span>{{ $item->frekuensi_downlink ?? '-' }} Hz</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Wavelength ($\lambda$) Downlink:</strong> <span>${{ $item->panjang_gelombang_downlink ?? '-' }}$ m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Path Loss Downlink:</strong> <span>{{ $item->path_loss_downlink ?? '-' }} dB</span></div>
                                </div>
                            </div>

                            {{-- Uplink Transmitter Details --}}
                            <div id="panel-transmitter-uplink" x-show="openTab === 'uplink_tx'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Uplink Transmitter 
                                 <a href="{{ route('transmitter.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Transmitter Power</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Transmitter Power (Watts):</strong> <span>{{ $item->watt_up ?? '-' }} Watt</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Transmitter Power (dBW):</strong> <span>{{ $item->dbw_up ?? '-' }} dBW</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Transmitter Power (dBm):</strong> <span>{{ $item->dbm_up ?? '-' }} dBm</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Line Losses</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line A Length:</strong> <span>{{ $item->alength_up ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line B Length:</strong> <span>{{ $item->blength_up ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line C Length:</strong> <span>{{ $item->clength_up ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total Line Length (A+B+C):</strong> <span>{{ $item->totlength_up ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable/Waveguide Type:</strong> <span>{{ $item->cabletype_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable/Waveguide Loss:</strong> <span>{{ $item->guideloss_up ?? '-' }} dB/m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total Cable Loss:</strong> <span>{{ $item->totalloss_up ?? '-' }} dB</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Additional Losses</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Number of In-Line Connectors:</strong> <span>{{ $item->connect_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total Connector Loss:</strong> <span>{{ $item->totconnect_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Filter Insertion Losses:</strong> <span>{{ $item->filter_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Device Name:</strong> <span>{{ $item->device_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Device Loss:</strong> <span>{{ $item->devicee_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna Mismatch Losses:</strong> <span>{{ $item->atn_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total Line Losses:</strong> <span>{{ $item->totlinelosses_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total RF Power Delivered to Antenna:</strong> <span>{{ $item->totpowerdeliv_up ?? '-' }} dBW</span></div>
                                </div>
                            </div>

                            {{-- Downlink Transmitter Details --}}
                            <div id="panel-transmitter-downlink" x-show="openTab === 'downlink_tx'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Downlink Transmitter 
                                    <a href="{{ route('transmitter.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                   
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Transmitter Power</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Transmitter Power (Watts):</strong> <span>{{ $item->watt_down ?? '-' }} Watt</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Transmitter Power (dBW):</strong> <span>{{ $item->dbw_down ?? '-' }} dBW</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Transmitter Power (dBm):</strong> <span>{{ $item->dbm_down ?? '-' }} dBm</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Line Losses</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line A Length:</strong> <span>{{ $item->alength_down ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line B Length:</strong> <span>{{ $item->blength_down ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line C Length:</strong> <span>{{ $item->clength_down ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total Line Length (A+B+C):</strong> <span>{{ $item->totlength_down ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable/Waveguide Type:</strong> <span>{{ $item->cabletype_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable/Waveguide Loss:</strong> <span>{{ $item->guideloss_down ?? '-' }} dB/m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total Cable Loss:</strong> <span>{{ $item->totalloss_down ?? '-' }} dB</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Additional Losses</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Number of In-Line Connectors:</strong> <span>{{ $item->connect_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total Connector Loss:</strong> <span>{{ $item->totconnect_down ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Filter Insertion Losses:</strong> <span>{{ $item->filter_down ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Device Name:</strong> <span>{{ $item->device_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Device Loss:</strong> <span>{{ $item->devicee_down ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna Mismatch Losses:</strong> <span>{{ $item->atn_down ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total Line Losses:</strong> <span>{{ $item->totlinelosses_down ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total RF Power Delivered to Antenna:</strong> <span>{{ $item->totrfpowerdeliv_down ?? '-' }} dBW</span></div>
                                </div>
                            </div>

                            {{-- Uplink Receiver Details --}}
                            <div id="panel-receiver-uplink" x-show="openTab === 'uplink_rx'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Uplink Receiver 
                                    <a href="{{ route('receiver.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                 
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Transmission Line Losses</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable or Waveguide Type:</strong> <span>{{ $item->cabletype_uprec ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable/Guide Loss/meter:</strong> <span>{{ $item->typecable ?? '-' }} dB/m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line A Length:</strong> <span>{{ $item->alength_uprec ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line B Length:</strong> <span>{{ $item->blength_uprec ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line C Length:</strong> <span>{{ $item->clength_uprec ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">L<sub>A</sub>:</strong> <span>${{ $item->la_uprec ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">L<sub>B</sub>:</strong> <span>${{ $item->lb_uprec ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">L<sub>C</sub>:</strong> <span>${{ $item->lc_uprec ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Bandpass Filter Insertion Loss ($L_{BPF}$):</strong> <span>${{ $item->lbpf_uprec ?? '-' }}$ dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Insertion Loss of Other In-Line Devices ($L_{other}$):</strong> <span>${{ $item->lother_uprec ?? '-' }}$ dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Number of In-Line Connectors:</strong> <span>{{ $item->connect_uprec ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total of Power Loss (Connector):</strong> <span>{{ $item->totconnect_uprec ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total In-Line Losses from Antenna to LNA:</strong> <span>{{ $item->antenna_to_lna_uprec ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Transmission Line Coefficient:</strong> <span>{{ $item->tranlincoe_uprec ?? '-' }}</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Noise Temperature & Gain</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna or "Sky" Temperature:</strong> <span>{{ $item->antemper_uprec ?? '-' }} K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Spacecraft Temperature:</strong> <span>{{ $item->spactemp_uprec ?? '-' }} K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">LNA Temperature ($T_{LNA}$):</strong> <span>${{ $item->tlna_uprec ?? '-' }}$ K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">LNA Gain:</strong> <span>{{ $item->lnagain_uprec ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">G<sub>LNA</sub>:</strong> <span>${{ $item->glna_uprec ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">2nd Stage Temperature ($T_{2ndStage}$):</strong> <span>${{ $item->secondstagetemp_uprec ?? '-' }}$ K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">System Noise Temperature ($T_s$):</strong> <span>${{ $item->ts_uprec ?? '-' }}$ K</span></div>
                                </div>
                            </div>

                            {{-- Downlink Receiver Details --}}
                            <div id="panel-receiver-downlink" x-show="openTab === 'downlink_rx'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Downlink Receiver 
                                    <a href="{{ route('receiver.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                  
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Transmission Line Losses (Antenna to LNA)</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable or Waveguide Type:</strong> <span>{{ $item->cabletype_downrec ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable/Guide Loss/meter:</strong> <span>{{ $item->typecable_downrec ?? '-' }} dB/m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line A Length:</strong> <span>{{ $item->alength_downrec ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line B Length:</strong> <span>{{ $item->blength_downrec ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Line C Length:</strong> <span>{{ $item->clength_downrec ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">L<sub>A</sub>:</strong> <span>${{ $item->la_downrec ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">L<sub>B</sub>:</strong> <span>${{ $item->lb_downrec ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">L<sub>C</sub>:</strong> <span>${{ $item->lc_downrec ?? '-' }}$</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Bandpass Filter Insertion Loss ($L_{BPF}$):</strong> <span>${{ $item->lbpf_downrec ?? '-' }}$ dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Insertion Loss of Other In-Line Devices ($L_{other}$):</strong> <span>${{ $item->lother_downrec ?? '-' }}$ dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Number of In-Line Connectors:</strong> <span>{{ $item->connect_downrec ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total of Power Loss (Connector):</strong> <span>{{ $item->totconnect_downrec ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total In-Line Losses from Antenna to LNA:</strong> <span>{{ $item->antenna_to_lna_downrec ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Transmission Line Coefficient:</strong> <span>{{ $item->tranlincoe_downrec ?? '-' }}</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Noise Temperature & Gain</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna or "Sky" Temperature:</strong> <span>{{ $item->antemper_downrec ?? '-' }} K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Ground Station Feedline Temperature:</strong> <span>{{ $item->spactemp_downrec ?? '-' }} K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">LNA Temperature ($T_{LNA}$):</strong> <span>${{ $item->tlna_downrec ?? '-' }}$ K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">LNA Gain:</strong> <span>{{ $item->lnagain_downrec ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">G<sub>LNA</sub>:</strong> <span>{{ $item->glna_downrec ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable/Waveguide D Type:</strong> <span>{{ $item->dtype_downrec ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable/Waveguide D Length:</strong> <span>{{ $item->dloss_length_downrec ?? '-' }} m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cable/Waveguide D Loss/meter:</strong> <span>{{ $item->dloss_per_meter_downrec ?? '-' }} dB/m</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Total Cable/Waveguide D Loss:</strong> <span>{{ $item->dloss_result_downrec ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Communications Receiver Front End Temperature ($T_{ComRcvr}$):</strong> <span>${{ $item->tcomrcvr_downrec ?? '-' }}$ K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">System Noise Temperature ($T_s$):</strong> <span>${{ $item->ts_downrec ?? '-' }}$ K</span></div>
                                </div>
                            </div>

                            {{-- Antenna Details (Uplink & Downlink) --}}
                            <div id="panel-antenna-gain" x-show="openTab === 'antenna_details'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Antenna Gain
                                    <a href="{{ route('antennagain.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                              
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Uplink Ground Station</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Type:</strong> <span>{{ $item->jenis_polarizationgrounds_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna Type (Optional):</strong> <span>{{ $item->jenis_antenagrounds_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Gain:</strong> <span>{{ $item->gain_manual_upgrounds ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Beamwidth:</strong> <span>${{ $item->beamwidth_manual_upgrounds ?? '-' }}$&deg;</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Uplink Spacecraft</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Type:</strong> <span>{{ $item->jenis_polarizationspacecraft_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna Type (Optional):</strong> <span>{{ $item->jenis_antenaspacecraft_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Gain:</strong> <span>{{ $item->gain_manual_upspacecraft ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Beamwidth:</strong> <span>${{ $item->beamwidth_manual_upspacecraft ?? '-' }}$&deg;</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Downlink Ground Station</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Type:</strong> <span>{{ $item->jenis_polarizationgrounds_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna Type (Optional):</strong> <span>{{ $item->jenis_antenagrounds_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Gain:</strong> <span>{{ $item->gain_manual_downgrounds ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Beamwidth:</strong> <span>${{ $item->beamwidth_manual_downgrounds ?? '-' }}$&deg;</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Downlink Spacecraft</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Type:</strong> <span>{{ $item->jenis_polarizationspacecraft_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna Type (Optional):</strong> <span>{{ $item->jenis_antenaspacecraft_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Gain:</strong> <span>{{ $item->gain_manual_downspacecraft ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Beamwidth:</strong> <span>${{ $item->beamwidth_manual_downspacecraft ?? '-' }}$&deg;</span></div>
                                </div>
                            </div>

                            {{-- Antenna Pointing Losses --}}
                            <div id="panel-antenna-pointing-loss" x-show="openTab === 'antenna_pointing'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Antenna Pointing Losses
                                    <a href="{{ route('annpoinloss.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                        
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Uplink Ground Station</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Type:</strong> <span>{{ $item->jenis_polarizationgrounds_up_poin ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Estimated Pointing Error ($\theta_1$):</strong> <span>${{ $item->estimedpointingerror_upgrounds_θ1_poin ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna Roll-Off:</strong> <span>{{ $item->annrolloff_upgrounds_poin ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Approx. Antenna Pointing Loss:</strong> <span>{{ $item->approxannpoinloss_upgrounds_poin ?? '-' }} dB</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Uplink Spacecraft</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Type:</strong> <span>{{ $item->jenis_polarizationspacecraft_up_poin ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Angle between S/C antenna symmetry axis and vector from S/C to gnd. station ($\theta_2$):</strong> <span>${{ $item->upspacecraft_θ2_poin ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Calculation Formulas:</strong> <span>{{ $item->calculation_formulas_upspacecraft_poin ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Approx. Antenna Pointing Loss:</strong> <span>{{ $item->approxannpoinloss_upspacecraft_poin ?? '-' }} dB</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Downlink Spacecraft</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Type:</strong> <span>{{ $item->jenis_polarizationspacecraft_down_poin ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Angle between S/C antenna symmetry axis and vector from S/C to gnd. station ($\theta_3$):</strong> <span>${{ $item->downspacecraft_θ3_poin ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Calculation Formulas:</strong> <span>{{ $item->calculation_formulas_downspacecraft_poin ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Approx. Antenna Pointing Loss:</strong> <span>{{ $item->approxannpoinloss_downspacecraft_poin ?? '-' }} dB</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Downlink Ground Station</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Type:</strong> <span>{{ $item->jenis_polarizationgrounds_down_poin ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Estimated Pointing Error ($\theta_4$):</strong> <span>${{ $item->estimedpointingerror_downgrounds_θ4_poin ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna Roll-Off:</strong> <span>{{ $item->annrolloff_downgrounds_poin ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Approx. Antenna Pointing Loss:</strong> <span>{{ $item->approxannpoinloss_downgrounds_poin ?? '-' }} dB</span></div>
                                </div>
                            </div>

                            {{-- Polarization Losses --}}
                            <div id="panel-polarization-loss" x-show="openTab === 'polarization_losses'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                   Antenna Polarization Loss
                                 <a href="{{ route('annpolaloss.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Uplink</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Axial ratio of Tx Antenna (Ant. #1):</strong> <span>{{ $item->axtxantenna_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Axial ratio (Ant. #1):</strong> <span>{{ $item->axialratio1_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Axial ratio of Rx Antenna (Ant. #2):</strong> <span>{{ $item->axrxantenna_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Axial ratio (Ant. #2):</strong> <span>{{ $item->axialratio2_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Angle ($\theta$) between antennas (degrees):</strong> <span>${{ $item->degrees_up ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Angle ($\theta$) between antennas (radians):</strong> <span>${{ $item->radians_up ?? '-' }}$ rad</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Loss:</strong> <span>{{ $item->polarizationloss_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Loss Result:</strong> <span>{{ $item->hasilpolarizationloss_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cross Pol. Power Fraction:</strong> <span>{{ $item->crosspolpowerfraction_up ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cross Pol. Power Fraction (dB):</strong> <span>{{ $item->dbcrosspolpowerfraction_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cross Polarization Isolation:</strong> <span>{{ $item->crosspolarizationisolation_up ?? '-' }}</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Downlink</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Axial ratio of Tx Antenna (Ant. #1):</strong> <span>{{ $item->axtxantenna_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Axial ratio (Ant. #1):</strong> <span>{{ $item->axialratio1_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Axial ratio of Rx Antenna (Ant. #2):</strong> <span>{{ $item->axrxantenna_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Axial ratio (Ant. #2):</strong> <span>{{ $item->axialratio2_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Angle ($\theta$) between antennas (degrees):</strong> <span>${{ $item->degrees_down ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Angle ($\theta$) between antennas (radians):</strong> <span>${{ $item->radians_down ?? '-' }}$ rad</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Loss:</strong> <span>{{ $item->polarizationloss_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Polarization Loss Result:</strong> <span>{{ $item->hasilpolarizationloss_down ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cross Pol. Power Fraction:</strong> <span>{{ $item->crosspolpowerfraction_down ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cross Pol. Power Fraction (dB):</strong> <span>{{ $item->dbcrosspolpowerfraction_down ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Cross Polarization Isolation:</strong> <span>{{ $item->crosspolarizationisolation_down ?? '-' }}</span></div>
                                </div>
                            </div>

                            {{-- Atmospheric & Ionospheric Losses --}}
                            <div id="panel-atmospheric-ionospheric" x-show="openTab === 'atmospheric_losses'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Atmospheric & Ionospheric Losses
                              <a href="{{ route('attmosionos.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <div class="flex flex-col"><strong class="text-gray-800">Min. Elevation Angle:</strong> <span>${{ $item->min_elevation_angle ?? '-' }}$&deg;</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Loss Determined:</strong> <span>{{ $item->loss_determined_atmospheric ?? '-' }}</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Uplink Loss Ionosphere:</strong> <span>{{ $item->uplink_loss_ionosphere ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Downlink Loss Ionosphere:</strong> <span>{{ $item->downlink_loss_ionosphere ?? '-' }} dB</span></div>
                                </div>
                            </div>

                            {{-- Uplink Link Budget Calculation --}}
                            <div id="panel-updownlink-budget-uplink" x-show="openTab === 'uplink_budget'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Uplink Budget 
                                    <a href="{{ route('updownlinkbudgetatn.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                        
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Ground Station Transmitter</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">GS Transmitter Power Output:</strong> <span>{{ $item->tx_powerwatts_up ?? '-' }} Watt</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Power in dBW:</strong> <span>{{ $item->tx_powerdbw_up ?? '-' }} dBW</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Power in dBm:</strong> <span>{{ $item->tx_powerdbm_up ?? '-' }} dBm</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">GS Total Transmission Line Losses:</strong> <span>{{ $item->trlinelosses_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Antenna Gain:</strong> <span>{{ $item->antennaagain_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">GS EIRP:</strong> <span>{{ $item->eirp_up ?? '-' }} dBW</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Path and Attenuation Losses</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">GS Antenna Pointing Losses:</strong> <span>{{ $item->pointinglosses_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Gnd-to-S/C Antenna Polarization Losses:</strong> <span>{{ $item->polarizationlosses_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Path Loss:</strong> <span>{{ $item->pathlosss_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Atmospheric Losses:</strong> <span>{{ $item->atmosphericlosses_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Ionospheric Losses:</strong> <span>{{ $item->ionosphericlosses_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Rain Losses:</strong> <span>{{ $item->rainlosses_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Isotropic Signal Level at Spacecraft:</strong> <span>{{ $item->signallevel_up ?? '-' }} dBW</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Spacecraft Receiver</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Sc Antenna Pointing Loss:</strong> <span>{{ $item->scpointingloss_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Sc Antenna Gain:</strong> <span>{{ $item->scantennagain_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Sc Total Transmission Line Losses:</strong> <span>{{ $item->sclinelosses_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Sc Effective Noise Temperature:</strong> <span>{{ $item->scnoisetemp_up ?? '-' }} K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Sc Figure of Merit (G/T):</strong> <span>{{ $item->scgtratio_up ?? '-' }} dB/K</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Signal Power at Spacecraft LNA Input:</strong> <span>{{ $item->scsignalpower_up ?? '-' }} dBm</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Sc Receiver Bandwidth:</strong> <span>{{ $item->scbandwidth_up ?? '-' }} Hz</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Sc Receiver Noise Power ($P_n = kTB$):</strong> <span>{{ $item->scnoisepower_up ?? '-' }} dBW</span></div>

                                    <h5 class="lg:col-span-3 font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Final Link Metrics</h5>
                                    <div class="flex flex-col"><strong class="text-gray-800">Signal-to-Noise Power Ratio at S/C Rcvr:</strong> <span>{{ $item->snrratio_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">Analog or Digital System Required S/N:</strong> <span>{{ $item->requiredsnr_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col font-bold text-purple-700 text-xl"> {{-- Highlight Link Margin --}}
                                        <strong class="text-purple-800">System Link Margin:</strong>
                                        <span>{{ $item->linkmargin_up ?? '-' }} dB</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Downlink Link Budget Calculation --}}
                            <div id="panel-updownlink-budget-downlink" x-show="openTab === 'downlink_budget'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    Downlink Budget 
                                <a href="{{ route('updownlinkbudgetatn.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-4 text-gray-700 text-lg">

                                    {{-- Section: Spacecraft Transmitter --}}
                                    <div class="lg:col-span-3">
                                        <h5 class="font-semibold text-gray-900 text-xl mt-4 mb-2 border-b border-gray-200 pb-1">Spacecraft Transmitter</h5>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Sc Transmitter Power Output:</strong>
                                        <span>{{ $item->sc_powerwatts_down ?? '-' }} Watt</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Power in dBW:</strong>
                                        <span>{{ $item->sc_powerdbw_down ?? '-' }} dBW</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Power in dBm:</strong>
                                        <span>{{ $item->sc_powerdbm_down ?? '-' }} dBm</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Sc Total Transmission Line Losses:</strong>
                                        <span>{{ $item->sclinelosses_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Sc Antenna Gain:</strong>
                                        <span>{{ $item->scantennaagain_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Sc EIRP:</strong>
                                        <span>{{ $item->sceirp_down ?? '-' }} dBW</span>
                                    </div>

                                    {{-- Section: Path and Attenuation Losses --}}
                                    <div class="lg:col-span-3">
                                        <h5 class="font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Path and Attenuation Losses</h5>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Sc Antenna Pointing Losses:</strong>
                                        <span>{{ $item->scpointinglosses_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">S/C-to-Ground Antenna Polarization Losses:</strong>
                                        <span>{{ $item->polarizationlosses_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Path Loss:</strong>
                                        <span>{{ $item->pathlosss_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Atmospheric Losses:</strong>
                                        <span>{{ $item->atmosphericlosses_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Ionospheric Losses:</strong>
                                        <span>{{ $item->ionosphericlosses_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Rain Losses:</strong>
                                        <span>{{ $item->rainlosses_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Isotropic Signal Level at Ground Station:</strong>
                                        <span>{{ $item->signallevel_down ?? '-' }} dBW</span>
                                    </div>

                                    {{-- Section: Ground Station Receiver --}}
                                    <div class="lg:col-span-3">
                                        <h5 class="font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Ground Station Receiver</h5>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">GS Antenna Pointing Loss:</strong>
                                        <span>{{ $item->gspointingloss_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">GS Antenna Gain:</strong>
                                        <span>{{ $item->gsantennagain_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">GS Total Transmission Line Losses:</strong>
                                        <span>{{ $item->gslinelosses_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">GS Effective Noise Temperature:</strong>
                                        <span>{{ $item->gsnoisetemp_down ?? '-' }} K</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">GS Figure of Merit (G/T):</strong>
                                        <span>{{ $item->gsgtratio_down ?? '-' }} dB/K</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Signal Power at Ground Station LNA Input:</strong>
                                        <span>{{ $item->gssignalpower_down ?? '-' }} dBm</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">GS Receiver Bandwidth:</strong>
                                        <span>{{ $item->gsbandwidth_down ?? '-' }} Hz</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">GS Receiver Noise Power ($P_n = kTB$):</strong>
                                        <span>{{ $item->gsnoisepower_down ?? '-' }} dBW</span>
                                    </div>

                                    {{-- Section: Final Link Metrics --}}
                                    <div class="lg:col-span-3">
                                        <h5 class="font-semibold text-gray-900 text-xl mt-6 mb-2 border-b border-gray-200 pb-1">Final Link Metrics</h5>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Signal-to-Noise Power Ratio at GS Rcvr:</strong>
                                        <span>{{ $item->snrratio_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col">
                                        <strong class="text-gray-800">Analog or Digital System Required S/N:</strong>
                                        <span>{{ $item->requiredsnr_down ?? '-' }} dB</span>
                                    </div>
                                    <div class="flex flex-col font-bold text-purple-700 text-xl"> {{-- Highlight Link Margin --}}
                                        <strong class="text-purple-800">System Link Margin:</strong>
                                        <span>{{ $item->linkmargin_down ?? '-' }} dB</span>
                                    </div>
                                </div>
                            </div>

                            {{-- System Summary --}}
                             <div x-show="openTab === 'summary'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" style="display: none;" class="math-content">
                                <h4 class="text-2xl font-bold text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 flex justify-between items-center">
                                    System Summary
                                    <a href="{{ route('systemsummary.show', ['id' => $item->id]) }}" target="_blank" class="ml-4 text-purple-500 hover:text-purple-700 text-sm font-normal flex items-center">
                                        <i class="fas fa-external-link-alt mr-2"></i> Detail
                                    </a>
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-gray-700 text-lg">
                                    <div class="flex flex-col"><strong class="text-gray-800">S/N Uplink:</strong> <span>{{ $item->snrratio_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col"><strong class="text-gray-800">S/N Downlink:</strong> <span>{{ $item->snrratio_down ?? '-' }} dB</span></div>
                                    <div class="flex flex-col font-bold text-purple-700 text-xl"><strong class="text-purple-800">Final Uplink Link Margin:</strong> <span>{{ $item->linkmargin_up ?? '-' }} dB</span></div>
                                    <div class="flex flex-col font-bold text-purple-700 text-xl"><strong class="text-purple-800">Final Downlink Link Margin:</strong> <span>{{ $item->linkmargin_down ?? '-' }} dB</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center p-12 bg-white rounded-lg shadow-md border border-gray-200">
                    <p class="text-xl text-gray-600">Tidak ada riwayat perhitungan yang ditemukan.</p>
                    <p class="mt-4 text-lg text-gray-500">Mulai hitung link budget satelit Anda sekarang!</p>
                </div>
                @endforelse
            </div>
        </section>
    </body>
</x-layout>

<script>
    // Alpine.js init script, pastikan ini di bawah tag script MathJax jika MathJax memproses elemen yang dikelola Alpine.
    // Namun untuk kasus ini, MathJax memproses konten DOM setelah dimuat, jadi posisinya tidak terlalu sensitif.
    document.addEventListener('alpine:init', () => {
        Alpine.data('tabs', () => ({
            openTab: 'orbit', // Default open tab
            init() {
                // Ketika tab berubah, instruksikan MathJax untuk me-render ulang konten tab yang baru
                this.$watch('openTab', (newTab) => {
                    if (window.MathJax) {
                        // Pastikan MathJax memproses ulang elemen yang baru terlihat
                        MathJax.typesetPromise();
                    }
                });
                // Initial typeset for the first tab on page load
                MathJax.typesetPromise();
            }
        }));
    });
</script>