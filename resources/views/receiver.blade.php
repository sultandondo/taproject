<x-layout>
    <x-slot:title>Form Receiver</x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* General styles for readonly inputs */
        input[readonly] {
            background-color: #e6f4e1; /* Lighter green */
            color: #166534; /* Darker green text */
            border-color: #81c784; /* Green border */
            cursor: not-allowed;
            font-weight: 500;
        }

        /* Styles for input focus states */
        input[type="number"]:focus,
        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3B82F6; /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* blue-500 with opacity */
        }

        /* Styling for labels in form sections */
        .form-section-label {
            display: block;
            font-weight: bold;
            color: #1F2937; /* gray-800 */
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #E5E7EB; /* gray-200 */
        }

        /* Basic styling for input groups */
        .input-group > div {
            margin-bottom: 1rem;
        }
        .input-group > div:last-child {
            margin-bottom: 0;
        }

        /* Consistent input height and padding */
        input[type="number"],
        input[type="text"] {
            height: 48px; /* Standard height for p-3 inputs */
            padding-right: 0.75rem; /* Default padding-right */
        }

        /* Wrapper for input fields with units next to them */
        .input-with-unit-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Styling for unit text */
        .unit-text {
            color: #4B5563; /* gray-700 */
            font-size: 0.875rem; /* text-sm */
            font-weight: 500; /* Medium font weight */
            min-width: 40px; /* Minimum width to prevent squishing */
            text-align: left;
        }

        /* --- Popup Styles (Crucial Fixes for Overlay Behavior) --- */
        .popup-window {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
        .popup-content {
            position: relative;
            background-color: white;
            padding: 20px 30px 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            animation: fadeInScale 0.3s ease-out;
            box-sizing: border-box;
            margin: 1rem;
        }
        .close-popup-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .close-popup-btn:hover {
            color: #000;
        }

        .formula {
            background-color: #f5f5f5;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
            margin: 15px 0;
            font-family: 'Cambria Math', 'Times New Roman', serif;
        }

        .popup-content h3 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .popup-content p {
            margin: 8px 0;
            line-height: 1.5;
            color: #374151;
        }

        /* Keyframes for popup animation */
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        /* --- Mobile Responsive Adjustments (max-width: 640px - Tailwind's 'sm' breakpoint) --- */
        @media (max-width: 640px) {
            /* Adjust main container padding */
            .container.mx-auto.px-4.py-8 {
                padding-left: 1rem;
                padding-right: 1rem;
                padding-top: 2rem;
                padding-bottom: 2rem;
            }
            /* Adjust main card padding */
            .bg-white.p-8 {
                padding: 1rem;
            }
            /* Ensure images don't overflow */
            .w-50.h-50.mx-auto img {
                max-width: 100%;
                height: auto;
            }
            /* Force flex containers to stack vertically on small screens */
            .flex.flex-col.sm\:flex-row,
            .flex.justify-between.mt-6 { /* Also applies to navigation buttons */
                flex-direction: column !important; /* Force column layout */
                align-items: stretch !important; /* Stretch items to full width */
                gap: 1rem !important; /* Consistent vertical gap */
                space-x-0: true !important; /* Tailwind utility removal */
            }

            /* Specific alignment for input/output fields on mobile */
            .flex.flex-col.sm\:flex-row.justify-start.space-y-4.sm\:space-y-0.sm\:space-x-6.items-center {
                align-items: flex-start !important; /* Align content to the left */
            }
            /* Ensure inputs and buttons inside take full width and align left */
            .flex.flex-col.sm\:flex-row > div {
                width: 100% !important; /* Ensure full width */
                margin-left: 0 !important; /* Reset inherited margins */
                margin-right: 0 !important; /* Reset inherited margins */
                text-align: left !important; /* Align content to the left (e.g., button detail link) */
            }

            /* Ensure children of stacked flex containers take full width */
            .flex.justify-between.mt-6 a {
                width: 100% !important; /* Make navigation buttons full width */
                text-align: center;
            }
            /* Adjust font sizes for better readability on small screens */
            .text-3xl.sm\:text-4xl {
                font-size: 2rem;
            }
            .text-lg {
                font-size: 1rem;
            }
            /* Adjust button padding */
            .px-6.py-3 {
                padding: 0.75rem 1.5rem;
            }
            .bg-blue-600.px-8.py-4 {
                padding: 1rem 1.5rem;
            }
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                    <i class="fas fa-satellite-dish mr-2 text-blue-600"></i> Perhitungan Parameter Receiver
                </h1>
                <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                    Masukkan parameter receiver untuk uplink dan downlink.
                </p>

                <form method="POST" action="{{ route('receiver.store', $dataId)}}">
                    @csrf
                    <input type="hidden" name="user_id" value="1">

                    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Uplink</h2>
                    <div class="relative mb-6">
                        <div class="w-50 h-50 mx-auto">
                            <img src="{{ asset('img/upreceiver.png') }}" alt="Blok Diagram Uplink" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <div class="input-group mb-4">
                            <label class="block font-medium mb-2 text-gray-700">Cable or Waveguide ("Line") Losses:</label>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide Type:</label>
                                <input type="text" name="cabletype_uprec" id="cabletype_uprec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Tipe Kabel/Waveguide">
                            </div>
                            <div class="relative">
                                <label class="block font-medium mb-1 text-gray-700">Cable/Guide Loss per meter:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="typecable" id="typecable" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai">
                                    <span class="unit-text">dB/m</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-start space-y-4 sm:space-y-0 sm:space-x-6 items-center mb-4">
                            <div class="w-full sm:w-1/3 relative">
                                <label for="alength_uprec" class="block font-medium text-gray-700 mb-1">Line A Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" id="alength_uprec" name="alength_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai">
                                    <span class="unit-text">meter</span>
                                </div>
                            </div>

                            <div class="w-full sm:w-1/3 relative">
                                <label for="blength_uprec" class="block font-medium text-gray-700 mb-1">Line B Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" id="blength_uprec" name="blength_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai">
                                    <span class="unit-text">meter</span>
                                </div>
                            </div>

                            <div class="w-full sm:w-1/3 relative">
                                <label for="clength_uprec" class="block font-medium text-gray-700 mb-1">Line C Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" id="clength_uprec" name="clength_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai">
                                    <span class="unit-text">meter</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-start space-y-4 sm:space-y-0 sm:space-x-6 items-center mb-4">
                            <div class="w-full sm:w-1/3 relative">
                                <label for="la_uprec" class="block font-medium text-gray-700 mb-1">LA:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="la_uprec" name="la_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="Hasil LA" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="la_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="w-full sm:w-1/3 relative">
                                <label for="lb_uprec" class="block font-medium text-gray-700 mb-1">LB:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="lb_uprec" name="lb_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="Hasil LB" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="lb_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>

                            <div class="w-full sm:w-1/3 relative">
                                <label for="lc_uprec" class="block font-medium text-gray-700 mb-1">LC:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="lc_uprec" name="lc_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="Hasil LC" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="lc_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Bandpass Filter Insertion Loss (LBPF):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="lbpf_uprec" id="lbpf_uprec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan Nilai">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Insertion Loss of Other In-Line Devices (Lother):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="lother_uprec" id="lother_uprec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan Nilai">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label for="connect_uprec" class="block font-medium text-gray-700 mb-1">Number of In-Line Connectors:</label>
                            <input type="number" step="any" id="connect_uprec" name="connect_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai" oninput="calculateTotalConnector()">
                        </div>

                        <div class="relative mb-4">
                            <label for="totconnect_uprec" class="block font-medium text-gray-700 mb-1">Total Penurunan Daya (Connector):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="text" id="totconnect_uprec" name="totconnect_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed"readonly>
                                <span class="unit-text">dB</span>
                            </div>
                            <button type="button" id="totconnect_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="mb-4 relative">
                            <label class="block font-medium text-gray-700 mb-1">Total In-Line Losses from Antenna to LNA:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="antenna_to_lna_uprec" id="antenna to lna_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text">dB</span>
                            </div>
                            <button type="button" id="antenna_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="mb-4 relative">
                            <label class="block font-medium text-gray-700 mb-1">Transmission Line Coefficient (α):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="tranlincoe_uprec" id="tranlincoe_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text"></span>
                            </div>
                            <button type="button" id="tranlincoe_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Antenna or "Sky" Temperature: (Ta):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="antemper_uprec" id="antemper_uprec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai">
                                <span class="unit-text">K</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Spacecraft Temperature: (To):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="spactemp_uprec" id="spactemp_uprec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai">
                                <span class="unit-text">K</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">LNA Temperature: (TLNA):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="tlna_uprec" id="tlna_uprec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai">
                                <span class="unit-text">K</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label for="lnagain_uprec" class="block font-medium text-gray-700 mb-1">LNA Gain:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" id="lnagain_uprec" name="lnagain_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai" oninput="calculateGLNA()">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label for="glna_uprec" class="block font-medium text-gray-700 mb-1">GLNA:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="text" id="glna_uprec" name="glna_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text"></span>
                            </div>
                            <button type="button" id="glna_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div id="2ndstagetemp_uprec_container" class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">2nd Stage Temperature (T2ndStage):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="2ndstagetemp_uprec" id="2ndstagetemp_uprec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan Nilai">
                                <span class="unit-text">K</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label for="ts_uprec" class="block font-medium text-gray-700 mb-1">System Noise Temperature (Ts):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="text" id="ts_uprec" name="ts_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text">K</span>
                            </div>
                            <button type="button" id="ts_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Downlink</h2>
                    <div class="relative mb-6">
                        <div class="w-50 h-50 mx-auto">
                            <img src="{{ asset('img/downreceiver.png') }}" alt="Blok Diagram Downlink" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <div class="input-group mb-4">
                            <label class="block font-medium mb-2 text-gray-700">Cable or Waveguide ("Line") Losses:</label>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide Type:</label>
                                <input type="text" name="cabletype_downrec" id="cabletype_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Tipe Kabel/Waveguide">
                            </div>
                            <div class="relative">
                                <label class="block font-medium mb-1 text-gray-700">Cable/Guide Loss per meter:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" name="typecable_downrec" id="typecable_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai">
                                    <span class="unit-text">dB/m</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-start space-y-4 sm:space-y-0 sm:space-x-6 items-center mb-4">
                            <div class="w-full sm:w-1/3 relative">
                                <label for="alength_downrec" class="block font-medium text-gray-700 mb-1">Line A Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" id="alength_downrec" name="alength_downrec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai" oninput="calculateTotalLossDownlink()">
                                    <span class="unit-text">meter</span>
                                </div>
                            </div>
                            <div class="w-full sm:w-1/3 relative">
                                <label for="blength_downrec" class="block font-medium text-gray-700 mb-1">Line B Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" id="blength_downrec" name="blength_downrec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai" oninput="calculateTotalLossDownlink()">
                                    <span class="unit-text">meter</span>
                                </div>
                            </div>
                            <div class="w-full sm:w-1/3 relative">
                                <label for="clength_downrec" class="block font-medium text-gray-700 mb-1">Line C Length:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="number" step="any" id="clength_downrec" name="clength_downrec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai" oninput="calculateTotalLossDownlink()">
                                    <span class="unit-text">meter</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-start space-y-4 sm:space-y-0 sm:space-x-6 items-center mb-4">
                            <div class="w-full sm:w-1/3 relative">
                                <label for="la_downrec" class="block font-medium text-gray-700 mb-1">LA:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="la_downrec" name="la_downrec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="Hasil LA" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="la_downrec_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                            <div class="w-full sm:w-1/3 relative">
                                <label for="lb_downrec" class="block font-medium text-gray-700 mb-1">LB:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="lb_downrec" name="lb_downrec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="Hasil LB" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="lb_downrec_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                            <div class="w-full sm:w-1/3 relative">
                                <label for="lc_downrec" class="block font-medium text-gray-700 mb-1">LC:</label>
                                <div class="input-with-unit-wrapper">
                                    <input type="text" id="lc_downrec" name="lc_downrec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="Hasil LC" readonly>
                                    <span class="unit-text">dB</span>
                                </div>
                                <button type="button" id="lc_downrec_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Bandpass Filter Insertion Loss (LBPF):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="lbpf_downrec" id="lbpf_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan Nilai" oninput="calculateTotalLossDownlink()">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Insertion Loss of Other In-Line Devices (Lother):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="lother_downrec" id="lother_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" min="0" placeholder="Masukkan Nilai" oninput="calculateTotalLossDownlink()">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label for="connect_downrec" class="block font-medium text-gray-700 mb-1">Number of In-Line Connectors:</label>
                            <input type="number" step="any" id="connect_downrec" name="connect_downrec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai" oninput="calculateTotalConnectorDownlink()">
                        </div>

                        <div class="relative mb-4">
                            <label for="totconnect_downrec" class="block font-medium text-gray-700 mb-1">Total Penurunan Daya (Connector):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="text" id="totconnect_downrec" name="totconnect_downrec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed"readonly>
                                <span class="unit-text">dB</span>
                            </div>
                            <button type="button" id="totconnect_downrec_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="mb-4 relative">
                            <label class="block font-medium mb-1 text-gray-700">Total In-Line Losses from Antenna to LNA:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="antenna_to_lna_downrec" id="antenna_to_lna_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text">dB</span>
                            </div>
                            <button type="button" id="antenna_downrec_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="mb-4 relative">
                            <label class="block font-medium text-gray-700 mb-1">Transmission Line Coefficient (α):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="tranlincoe_downrec" id="tranlincoe_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text"></span>
                            </div>
                            <button type="button" id="tranlincoe_downrec_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Antenna or "Sky" Temperature: (Ta):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="antemper_downrec" id="antemper_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai">
                                <span class="unit-text">K</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Spacecraft Temperature: (To):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="spactemp_downrec" id="spactemp_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai">
                                <span class="unit-text">K</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">LNA Temperature: (TLNA):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="tlna_downrec" id="tlna_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai">
                                <span class="unit-text">K</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label for="lnagain_downrec" class="block font-medium text-gray-700 mb-1">LNA Gain:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" id="lnagain_downrec" name="lnagain_downrec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai"oninput="calculateGLNADownlink()">
                                <span class="unit-text">dB</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label for="glna_downrec" class="block font-medium text-gray-700 mb-1">GLNA:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="text" id="glna_downrec" name="glna_downrec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text"></span>
                            </div>
                            <button type="button" id="glna_downrec_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide D Type</label>
                            <input type="text" step="any" name="dtype_downrec" id="dtype_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Jenis Kabel/Waveguide">
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide D Length:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="dloss_length_downrec" id="dloss_length_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai" oninput="calculateDLossDownlink()">
                                <span class="unit-text">m</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide D Loss per meter:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="dloss_per_meter_downrec" id="dloss_per_meter_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai" oninput="calculateDLossDownlink()">
                                <span class="unit-text">°K/m</span>
                            </div>
                        </div>

                        <div class="mb-4 relative">
                            <label class="block font-medium mb-1 text-gray-700">Total Cable/Waveguide D Loss:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" name="dloss_result_downrec" id="dloss_result_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text">dB</span>
                            </div>
                            <button type="button" id="dloss_downrec_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="relative mb-4">
                            <label class="block font-medium mb-1 text-gray-700">Communications Receiver Front End Temperature (TComRcvr):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="tcomrcvr_downrec" id="tcomrcvr_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai">
                                <span class="unit-text">K</span>
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label for="ts_downrec" class="block font-medium text-gray-700 mb-1">System Noise Temperature (Ts):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" id="ts_downrec" name="ts_downrec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text">K</span>
                            </div>
                            <button type="button" id="ts_downrec_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-save mr-2"></i> Hitung & Simpan Parameter Receiver
                    </button>
                    </div>
                </form>
                <div class="flex flex-col sm:flex-row justify-between mt-6 space-y-4 sm:space-y-0">
                    <a href="/transmitter/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
                    </a>

                    {{-- Uncomment this if you have a next page
                    <a href="/next-page/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                        Halaman Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    --}}
                </div>
            </div>
        </div>
    </div>

    <div id="la_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail LA (dB)</h3>
            <p class="formula"><span id="la_formula"></span></p>
            <div id="la_popup_content"></div>
        </div>
    </div>

    <div id="lb_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail LB (dB)</h3>
            <p class="formula"><span id="lb_formula"></span></p>
            <div id="lb_popup_content"></div>
        </div>
    </div>

    <div id="lc_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail LC (dB)</h3>
            <p class="formula"><span id="lc_formula"></span></p>
            <div id="lc_popup_content"></div>
        </div>
    </div>

    <div id="totconnect_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Penurunan Daya (Connector)</h3>
            <p class="formula"><span id="totconnect_formula"></span></p>
            <div id="totconnect_popup_content"></div>
        </div>
    </div>

    <div id="antenna_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total In-Line Losses from Antenna to LNA (dB)</h3>
            <p class="formula"><span id="antenna_formula"></span></p>
            <div id="antenna_popup_content"></div>
        </div>
    </div>

    <div id="tranlincoe_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Koefisien Transmisi (α)</h3>
            <p class="formula"><span id="tranlincoe_formula"></span></p>
            <div id="tranlincoe_popup_content"></div>
        </div>
    </div>

    <div id="glna_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail GLNA</h3>
            <p class="formula"><span id="glna_formula"></span></p>
            <div id="glna_popup_content"></div>
        </div>
    </div>

    <div id="ts_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Suhu Noise Sistem (Ts)</h3>
            <p class="formula"><span id="ts_formula"></span></p>
            <div id="ts_popup_content"></div>
        </div>
    </div>

    <div id="la_downrec_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail LA (dB)</h3>
            <p class="formula"><span id="la_downrec_formula"></span></p>
            <div id="la_downrec_popup_content"></div>
        </div>
    </div>

    <div id="lb_downrec_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail LB (dB)</h3>
            <p class="formula"><span id="lb_downrec_formula"></span></p>
            <div id="lb_downrec_popup_content"></div>
        </div>
    </div>

    <div id="lc_downrec_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail LC (dB)</h3>
            <p class="formula"><span id="lc_downrec_formula"></span></p>
            <div id="lc_downrec_popup_content"></div>
        </div>
    </div>

    <div id="totconnect_downrec_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Penurunan Daya (Connector)</h3>
            <p class="formula"><span id="totconnect_downrec_formula"></span></p>
            <div id="totconnect_downrec_popup_content"></div>
        </div>
    </div>

    <div id="antenna_downrec_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total In-Line Losses dari Antena ke LNA (dB)</h3>
            <p class="formula"><span id="antenna_downrec_formula"></span></p>
            <div id="antenna_downrec_popup_content"></div>
        </div>
    </div>

    <div id="tranlincoe_downrec_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Koefisien Transmisi (α)</h3>
            <p class="formula"><span id="tranlincoe_downrec_formula"></span></p>
            <div id="tranlincoe_downrec_popup_content"></div>
        </div>
    </div>

    <div id="glna_downrec_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail GLNA</h3>
            <p class="formula"><span id="glna_downrec_formula"></span></p>
            <div id="glna_downrec_popup_content"></div>
        </div>
    </div>

    <div id="dloss_downrec_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Total Cable/Waveguide D Loss</h3>
            <p class="formula"><span id="dloss_downrec_formula"></span></p>
            <div id="dloss_downrec_popup_content"></div>
        </div>
    </div>

    <div id="ts_downrec_popup" class="popup-window">
        <div class="popup-content">
            <span class="close-popup-btn">&times;</span>
            <h3>Detail Suhu Noise Sistem (Ts)</h3>
            <p class="formula"><span id="ts_downrec_formula"></span></p>
            <div id="ts_downrec_popup_content"></div>
        </div>
    </div>

    <script>
        // Uplink calculations
        function calculateTotalLossComponent() {
            const cableLoss = parseFloat(document.getElementById("typecable").value) || 0;
            const aLength = parseFloat(document.getElementById("alength_uprec").value) || 0;
            const bLength = parseFloat(document.getElementById("blength_uprec").value) || 0;
            const cLength = parseFloat(document.getElementById("clength_uprec").value) || 0;

            const la = aLength * cableLoss;
            const lb = bLength * cableLoss;
            const lc = cLength * cableLoss;

            document.getElementById("la_uprec").value = la.toFixed(2);
            document.getElementById("lb_uprec").value = lb.toFixed(2);
            document.getElementById("lc_uprec").value = lc.toFixed(2);
            calculateTotalLossFinal();
        }

        function calculateTotalConnector() {
            const connectorValue = parseFloat(document.getElementById('connect_uprec').value) || 0;
            const totalLoss = connectorValue * 0.05;
            document.getElementById('totconnect_uprec').value = totalLoss.toFixed(2);
            calculateTotalLossFinal();
        }

        function calculateTotalLossFinal() {
            const la = parseFloat(document.getElementById('la_uprec').value) || 0;
            const lb = parseFloat(document.getElementById('lb_uprec').value) || 0;
            const lc = parseFloat(document.getElementById('lc_uprec').value) || 0;
            const lbpf = parseFloat(document.getElementById('lbpf_uprec').value) || 0;
            const lother = parseFloat(document.getElementById('lother_uprec').value) || 0;
            const totconnect = parseFloat(document.getElementById('totconnect_uprec').value) || 0;

            const total = la + lb + lc + lbpf + lother + totconnect;
            document.getElementById('antenna to lna_uprec').value = total.toFixed(2);
            calculateTransmissionCoefficient();
        }

        function calculateTransmissionCoefficient() {
            const totalLossDb = parseFloat(document.getElementById('antenna to lna_uprec').value) || 0;
            let coefficient = 0;
            if (totalLossDb !== 0) {
                coefficient = Math.pow(10, -totalLossDb / 10);
            } else {
                coefficient = 1.0000; // If no loss, coefficient is 1 (no attenuation)
            }
            document.getElementById('tranlincoe_uprec').value = coefficient.toFixed(4);
            calculateTs();
        }

        function calculateGLNA() {
            const lnagain = parseFloat(document.getElementById('lnagain_uprec').value) || 0;
            let glna = 0;
            if (!isNaN(lnagain)) {
                glna = Math.pow(10, lnagain / 10);
            } else {
                glna = 1.00; // Default if no LNA gain input
            }
            document.getElementById('glna_uprec').value = glna.toFixed(2);
            calculateTs();
        }

        function calculateTs() {
            const alpha = parseFloat(document.getElementById('tranlincoe_uprec').value) || 1;
            const ta = parseFloat(document.getElementById('antemper_uprec').value) || 0;
            const to = parseFloat(document.getElementById('spactemp_uprec').value) || 0;
            const tlna = parseFloat(document.getElementById('tlna_uprec').value) || 0;
            const t2nd = parseFloat(document.getElementById('2ndstagetemp_uprec').value) || 0;
            const glna = parseFloat(document.getElementById('glna_uprec').value) || 1;

            let ts = 0;
            if (glna > 0) {
                ts = (ta * alpha) + (to * (1 - alpha)) + tlna + (t2nd / glna);
            } else if (t2nd > 0) {
                document.getElementById('ts_uprec').value = "Error: GLNA tidak boleh nol";
                return;
            } else {
                ts = (ta * alpha) + (to * (1 - alpha)) + tlna;
            }
            document.getElementById('ts_uprec').value = ts.toFixed(2);
        }

        // Downlink calculations
        function calculateTotalLossDownlink() {
            const cableLoss = parseFloat(document.getElementById("typecable_downrec").value) || 0;
            const alength = parseFloat(document.getElementById("alength_downrec").value) || 0;
            const blength = parseFloat(document.getElementById("blength_downrec").value) || 0;
            const clength = parseFloat(document.getElementById("clength_downrec").value) || 0;

            const la = alength * cableLoss;
            const lb = blength * cableLoss;
            const lc = clength * cableLoss;

            document.getElementById("la_downrec").value = la.toFixed(2);
            document.getElementById("lb_downrec").value = lb.toFixed(2);
            document.getElementById("lc_downrec").value = lc.toFixed(2);
            calculateTotalLossFinalDownlink();
        }

        function calculateTotalConnectorDownlink() {
            const connectorValue = parseFloat(document.getElementById('connect_downrec').value) || 0;
            const totalLoss = connectorValue * 0.05;
            document.getElementById('totconnect_downrec').value = totalLoss.toFixed(2);
            calculateTotalLossFinalDownlink();
        }

        function calculateTotalLossFinalDownlink() {
            const la = parseFloat(document.getElementById('la_downrec').value) || 0;
            const lb = parseFloat(document.getElementById('lb_downrec').value) || 0;
            const lc = parseFloat(document.getElementById('lc_downrec').value) || 0;
            const lbpf = parseFloat(document.getElementById('lbpf_downrec').value) || 0;
            const lother = parseFloat(document.getElementById('lother_downrec').value) || 0;
            const totconnect = parseFloat(document.getElementById('totconnect_downrec').value) || 0;

            const total = la + lb + lc + lbpf + lother + totconnect;
            document.getElementById('antenna_to_lna_downrec').value = total.toFixed(2);
            calculateTransmissionCoefficientDownlink();
        }

        function calculateTransmissionCoefficientDownlink() {
            const totalLossDb = parseFloat(document.getElementById('antenna_to_lna_downrec').value) || 0;
            let coefficient = 0;
            if (totalLossDb !== 0) {
                coefficient = Math.pow(10, -totalLossDb / 10);
            } else {
                coefficient = 1.0000;
            }
            document.getElementById('tranlincoe_downrec').value = coefficient.toFixed(4);
            calculateTsDownlink();
        }

        function calculateGLNADownlink() {
            const lnagain = parseFloat(document.getElementById('lnagain_downrec').value) || 0;
            let glna = 0;
            if (!isNaN(lnagain)) {
                glna = Math.pow(10, lnagain / 10);
            } else {
                glna = 1.00;
            }
            document.getElementById('glna_downrec').value = glna.toFixed(2);
            calculateTsDownlink();
        }

        function calculateDLossDownlink() {
            const length = parseFloat(document.getElementById('dloss_length_downrec').value) || 0;
            const lossPerMeter = parseFloat(document.getElementById('dloss_per_meter_downrec').value) || 0;

            const totalLoss = length * lossPerMeter;
            document.getElementById('dloss_result_downrec').value = totalLoss.toFixed(2);
            calculateTsDownlink();
        }

        function calculateTsDownlink() {
            const alpha = parseFloat(document.getElementById('tranlincoe_downrec').value) || 1;
            const ta = parseFloat(document.getElementById('antemper_downrec').value) || 0;
            const to = parseFloat(document.getElementById('spactemp_downrec').value) || 0;
            const tlna = parseFloat(document.getElementById('tlna_downrec').value) || 0;
            const tcomRcvr = parseFloat(document.getElementById('tcomrcvr_downrec').value) || 0;
            const dLoss = parseFloat(document.getElementById('dloss_result_downrec').value) || 0;
            let glna = parseFloat(document.getElementById('glna_downrec').value) || 1;

            let ts = 0;
            if (glna > 0) {
                const dLossFactor = Math.pow(10, dLoss / 10);
                const effectiveGLNA = glna / dLossFactor;
                ts = (ta * alpha) + (to * (1 - alpha)) + tlna + (tcomRcvr / effectiveGLNA);
            } else {
                ts = (ta * alpha) + (to * (1 - alpha)) + tlna;
            }
            document.getElementById('ts_downrec').value = ts.toFixed(2);
        }

        // --- Event Listeners and Initialization ---
        document.addEventListener("DOMContentLoaded", function() {
            // Set initial default values for read-only fields
            document.getElementById('tranlincoe_uprec').value = "1.0000";
            document.getElementById('antenna to lna_uprec').value = "0.00";
            document.getElementById('glna_uprec').value = "1.00";
            document.getElementById('ts_uprec').value = "0.00"; // Initialize Ts
            
            document.getElementById('tranlincoe_downrec').value = "1.0000";
            document.getElementById('antenna_to_lna_downrec').value = "0.00";
            document.getElementById('glna_downrec').value = "1.00";
            document.getElementById('dloss_result_downrec').value = "0.00";
            document.getElementById('ts_downrec').value = "0.00"; // Initialize Ts

            // Uplink Input Listeners
            const uplinkInputIds = [
                "typecable", "alength_uprec", "blength_uprec", "clength_uprec",
                "lbpf_uprec", "lother_uprec", "connect_uprec", "lnagain_uprec",
                "antemper_uprec", "spactemp_uprec", "tlna_uprec", "2ndstagetemp_uprec"
            ];
            uplinkInputIds.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener("input", () => {
                        // Re-run all relevant uplink calculations based on input changes
                        calculateTotalLossComponent(); // Updates LA, LB, LC, and calls calculateTotalLossFinal
                        calculateTotalConnector(); // Calls calculateTotalLossFinal
                        calculateTotalLossFinal(); // Calls calculateTransmissionCoefficient
                        calculateGLNA(); // Calls calculateTs
                        calculateTs(); // Ensure Ts is updated
                    });
                }
            });

            // Downlink Input Listeners
            const downlinkInputIds = [
                "typecable_downrec", "alength_downrec", "blength_downrec", "clength_downrec",
                "lbpf_downrec", "lother_downrec", "connect_downrec", "lnagain_downrec",
                "dloss_length_downrec", "dloss_per_meter_downrec",
                "antemper_downrec", "spactemp_downrec", "tlna_downrec", "tcomrcvr_downrec"
            ];
            downlinkInputIds.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener("input", () => {
                        // Re-run all relevant downlink calculations based on input changes
                        calculateTotalLossDownlink(); // Updates LA, LB, LC, and calls calculateTotalLossFinalDownlink
                        calculateTotalConnectorDownlink(); // Calls calculateTotalLossFinalDownlink
                        calculateTotalLossFinalDownlink(); // Calls calculateTransmissionCoefficientDownlink
                        calculateGLNADownlink(); // Calls calculateTsDownlink
                        calculateDLossDownlink(); // Calls calculateTsDownlink
                        calculateTsDownlink(); // Ensure Ts is updated
                    });
                }
            });

            // Initial calculations on page load
            try {
                calculateTotalLossComponent();
                calculateTotalConnector();
                calculateTotalLossFinal();
                calculateGLNA();
                calculateTs();

                calculateTotalLossDownlink();
                calculateTotalConnectorDownlink();
                calculateTotalLossFinalDownlink();
                calculateGLNADownlink();
                calculateDLossDownlink();
                calculateTsDownlink();
            } catch (error) {
                console.error("Error during initial calculations:", error);
            }

            // --- Popup Configuration ---
            const popupPairs = [
                // Uplink Popups
                { buttonId: 'la_popup_btn', popupId: 'la_popup', inputId: 'la_uprec', formulaId: 'la_formula',
                  formula: "LA = Panjang Kabel &times; Loss per meter",
                  detailFunc: (val) => {
                    const length = parseFloat(document.getElementById("alength_uprec").value);
                    const loss = parseFloat(document.getElementById("typecable").value);
                    if (isNaN(length) || isNaN(loss)) {
                        return "<p style='color: red;'>Masukkan nilai untuk Panjang Kabel A dan Loss per meter terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Panjang Kabel A: ${length} meter</li>
                            <li>Loss per meter: ${loss} dB/meter</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>LA = ${length} &times; ${loss} = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>LA adalah total kehilangan daya yang terjadi pada Line A (kabel atau waveguide) berdasarkan panjangnya dan redaman per meternya.</p>
                    `;
                  }
                },
                { buttonId: 'lb_popup_btn', popupId: 'lb_popup', inputId: 'lb_uprec', formulaId: 'lb_formula',
                  formula: "LB = Panjang Kabel &times; Loss per meter",
                  detailFunc: (val) => {
                    const length = parseFloat(document.getElementById("blength_uprec").value);
                    const loss = parseFloat(document.getElementById("typecable").value);
                    if (isNaN(length) || isNaN(loss)) {
                        return "<p style='color: red;'>Masukkan nilai untuk Panjang Kabel B dan Loss per meter terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Panjang Kabel B: ${length} meter</li>
                            <li>Loss per meter: ${loss} dB/meter</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>LB = ${length} &times; ${loss} = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>LB adalah total kehilangan daya yang terjadi pada Line B (kabel atau waveguide) berdasarkan panjangnya dan redaman per meternya.</p>
                    `;
                  }
                },
                { buttonId: 'lc_popup_btn', popupId: 'lc_popup', inputId: 'lc_uprec', formulaId: 'lc_formula',
                  formula: "LC = Panjang Kabel &times; Loss per meter",
                  detailFunc: (val) => {
                    const length = parseFloat(document.getElementById("clength_uprec").value);
                    const loss = parseFloat(document.getElementById("typecable").value);
                    if (isNaN(length) || isNaN(loss)) {
                        return "<p style='color: red;'>Masukkan nilai untuk Panjang Kabel C dan Loss per meter terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Panjang Kabel C: ${length} meter</li>
                            <li>Loss per meter: ${loss} dB/meter</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>LC = ${length} &times; ${loss} = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>LC adalah total kehilangan daya yang terjadi pada Line C (kabel atau waveguide) berdasarkan panjangnya dan redaman per meternya.</p>
                    `;
                  }
                },
                { buttonId: 'totconnect_popup_btn', popupId: 'totconnect_popup', inputId: 'totconnect_uprec', formulaId: 'totconnect_formula',
                  formula: "L<sub>connector</sub> = Jumlah Konektor &times; 0,05 dB",
                  detailFunc: (val) => {
                    const connectors = parseFloat(document.getElementById("connect_uprec").value);
                    if (isNaN(connectors)) {
                        return "<p style='color: red;'>Masukkan nilai untuk Jumlah Konektor terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Jumlah Konektor: ${connectors}</li>
                            <li>Loss per konektor: 0,05 dB</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>L<sub>connector</sub> = ${connectors} &times; 0,05 = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>Setiap konektor pada jalur transmisi menyebabkan kehilangan daya kecil. Perhitungan ini mengasumsikan kerugian standar 0,05 dB per konektor.</p>
                    `;
                  }
                },
                { buttonId: 'antenna_popup_btn', popupId: 'antenna_popup', inputId: 'antenna to lna_uprec', formulaId: 'antenna_formula',
                  formula: "L<sub>total</sub> = LA + LB + LC + L<sub>BPF</sub> + L<sub>other</sub> + L<sub>connector</sub>",
                  detailFunc: (val) => {
                    const la = parseFloat(document.getElementById("la_uprec").value);
                    const lb = parseFloat(document.getElementById("lb_uprec").value);
                    const lc = parseFloat(document.getElementById("lc_uprec").value);
                    const lbpf = parseFloat(document.getElementById("lbpf_uprec").value) || 0;
                    const lother = parseFloat(document.getElementById("lother_uprec").value) || 0;
                    const connector = parseFloat(document.getElementById("totconnect_uprec").value);
                    
                    if (isNaN(la) || isNaN(lb) || isNaN(lc) || isNaN(lbpf) || isNaN(lother) || isNaN(connector)) {
                        return "<p style='color: red;'>Lengkapi semua nilai loss yang terkait (LA, LB, LC, LBPF, Lother, Connector) terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>LA: ${la} dB</li>
                            <li>LB: ${lb} dB</li>
                            <li>LC: ${lc} dB</li>
                            <li>Loss Filter Bandpass (LBPF): ${lbpf} dB</li>
                            <li>Loss Perangkat In-Line Lainnya (Lother): ${lother} dB</li>
                            <li>Total Loss Konektor: ${connector} dB</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>L<sub>total</sub> = ${la} + ${lb} + ${lc} + ${lbpf} + ${lother} + ${connector} = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>Ini adalah jumlah total semua kehilangan daya yang terjadi pada jalur sinyal dari antena hingga Low Noise Amplifier (LNA), termasuk kehilangan kabel/waveguide, filter, perangkat lain, dan konektor. Nilai ini sangat penting untuk perhitungan budget tautan.</p>
                    `;
                  }
                },
                { buttonId: 'tranlincoe_popup_btn', popupId: 'tranlincoe_popup', inputId: 'tranlincoe_uprec', formulaId: 'tranlincoe_formula',
                  formula: "&alpha; = 10<sup>(-L<sub>total</sub> / 10)</sup>",
                  detailFunc: (val) => {
                    const loss = parseFloat(document.getElementById("antenna to lna_uprec").value);
                    if (isNaN(loss)) {
                        return "<p style='color: red;'>Hitung Total In-Line Losses terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Total In-Line Losses (L<sub>total</sub>): ${loss} dB</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>&alpha; = 10<sup>(-${loss} / 10)</sup> = ${val}</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>Koefisien transmisi (&alpha;) adalah faktor yang menunjukkan seberapa banyak daya sinyal yang melewati jalur transmisi. Nilai 1 berarti tidak ada kehilangan (ideal), sedangkan nilai kurang dari 1 menunjukkan adanya redaman. Ini dihitung dari total kehilangan daya dalam desibel.</p>
                    `;
                  }
                },
                { buttonId: 'glna_popup_btn', popupId: 'glna_popup', inputId: 'glna_uprec', formulaId: 'glna_formula',
                  formula: "G<sub>LNA</sub> = 10<sup>(Gain<sub>LNA</sub> / 10)</sup>",
                  detailFunc: (val) => {
                    const gain = parseFloat(document.getElementById("lnagain_uprec").value);
                    if (isNaN(gain)) {
                        return "<p style='color: red;'>Masukkan nilai LNA Gain terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Gain LNA: ${gain} dB</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>G<sub>LNA</sub> = 10<sup>(${gain} / 10)</sup> = ${val}</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>G<sub>LNA</sub> adalah gain Low Noise Amplifier (LNA) dalam rasio linier, yang dikonversi dari nilai desibel (dB). LNA adalah komponen penting yang memperkuat sinyal yang diterima tanpa menambahkan terlalu banyak noise.</p>
                    `;
                  }
                },
                { buttonId: 'ts_popup_btn', popupId: 'ts_popup', inputId: 'ts_uprec', formulaId: 'ts_formula',
                  formula: "T<sub>s</sub> = (T<sub>a</sub> &times; &alpha;) + (T<sub>o</sub> &times; (1 - &alpha;)) + T<sub>LNA</sub> + (T<sub>2ndStage</sub> / G<sub>LNA</sub>)",
                  detailFunc: (val) => {
                    const alpha = parseFloat(document.getElementById("tranlincoe_uprec").value);
                    const ta = parseFloat(document.getElementById("antemper_uprec").value);
                    const to = parseFloat(document.getElementById("spactemp_uprec").value);
                    const tlna = parseFloat(document.getElementById("tlna_uprec").value);
                    const t2nd = parseFloat(document.getElementById("2ndstagetemp_uprec").value);
                    const glna = parseFloat(document.getElementById("glna_uprec").value);
                    
                    if (isNaN(alpha) || isNaN(ta) || isNaN(to) || isNaN(tlna) || isNaN(t2nd) || isNaN(glna) || glna === 0) {
                        return "<p style='color: red;'>Lengkapi semua nilai suhu dan gain (Ta, To, TLNA, T2ndStage, GLNA) terlebih dahulu.</p>";
                    }
                    
                    const part1 = ta * alpha;
                    const part2 = to * (1 - alpha);
                    const part3 = tlna;
                    const part4 = t2nd / glna;
                    
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Suhu Antena (T<sub>a</sub>): ${ta} K</li>
                            <li>Koefisien Transmisi (&alpha;): ${alpha}</li>
                            <li>Suhu Ruang Angkasa (T<sub>o</sub>): ${to} K</li>
                            <li>Suhu LNA (T<sub>LNA</sub>): ${tlna} K</li>
                            <li>Suhu Tahap Kedua (T<sub>2ndStage</sub>): ${t2nd} K</li>
                            <li>Gain LNA (G<sub>LNA</sub>): ${glna}</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>T<sub>s</sub> = (${ta} &times; ${alpha}) + (${to} &times; (1 - ${alpha})) + ${tlna} + (${t2nd} / ${glna})</p>
                        <p>T<sub>s</sub> = ${part1.toFixed(2)} + ${part2.toFixed(2)} + ${part3} + ${part4.toFixed(2)} = ${val} K</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>Suhu Noise Sistem (T<sub>s</sub>) adalah total noise termal yang dihasilkan oleh semua komponen dalam rantai penerima, termasuk antena, jalur transmisi, LNA, dan tahap penerima selanjutnya. Nilai ini sangat penting untuk menentukan sensitivitas sistem penerima.</p>
                    `;
                  }
                },
                
                // Downlink Popups
                { buttonId: 'la_downrec_popup_btn', popupId: 'la_downrec_popup', inputId: 'la_downrec', formulaId: 'la_downrec_formula',
                  formula: "LA = Panjang Kabel &times; Loss per meter",
                  detailFunc: (val) => {
                    const length = parseFloat(document.getElementById("alength_downrec").value);
                    const loss = parseFloat(document.getElementById("typecable_downrec").value);
                    if (isNaN(length) || isNaN(loss)) {
                        return "<p style='color: red;'>Masukkan nilai untuk Panjang Kabel A dan Loss per meter terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Panjang Kabel A: ${length} meter</li>
                            <li>Loss per meter: ${loss} dB/meter</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>LA = ${length} &times; ${loss} = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>LA adalah total kehilangan daya yang terjadi pada Line A (kabel atau waveguide) untuk downlink, berdasarkan panjangnya dan redaman per meternya.</p>
                    `;
                  }
                },
                { buttonId: 'lb_downrec_popup_btn', popupId: 'lb_downrec_popup', inputId: 'lb_downrec', formulaId: 'lb_downrec_formula',
                  formula: "LB = Panjang Kabel &times; Loss per meter",
                  detailFunc: (val) => {
                    const length = parseFloat(document.getElementById("blength_downrec").value);
                    const loss = parseFloat(document.getElementById("typecable_downrec").value);
                    if (isNaN(length) || isNaN(loss)) {
                        return "<p style='color: red;'>Masukkan nilai untuk Panjang Kabel B dan Loss per meter terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Panjang Kabel B: ${length} meter</li>
                            <li>Loss per meter: ${loss} dB/meter</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>LB = ${length} &times; ${loss} = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>LB adalah total kehilangan daya yang terjadi pada Line B (kabel atau waveguide) untuk downlink, berdasarkan panjangnya dan redaman per meternya.</p>
                    `;
                  }
                },
                { buttonId: 'lc_downrec_popup_btn', popupId: 'lc_downrec_popup', inputId: 'lc_downrec', formulaId: 'lc_downrec_formula',
                  formula: "LC = Panjang Kabel &times; Loss per meter",
                  detailFunc: (val) => {
                    const length = parseFloat(document.getElementById("clength_downrec").value);
                    const loss = parseFloat(document.getElementById("typecable_downrec").value);
                    if (isNaN(length) || isNaN(loss)) {
                        return "<p style='color: red;'>Masukkan nilai untuk Panjang Kabel C dan Loss per meter terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Panjang Kabel C: ${length} meter</li>
                            <li>Loss per meter: ${loss} dB/meter</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>LC = ${length} &times; ${loss} = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>LC adalah total kehilangan daya yang terjadi pada Line C (kabel atau waveguide) untuk downlink, berdasarkan panjangnya dan redaman per meternya.</p>
                    `;
                  }
                },
                { buttonId: 'totconnect_downrec_popup_btn', popupId: 'totconnect_downrec_popup', inputId: 'totconnect_downrec', formulaId: 'totconnect_downrec_formula',
                  formula: "L<sub>connector</sub> = Jumlah Konektor &times; 0,05 dB",
                  detailFunc: (val) => {
                    const connectors = parseFloat(document.getElementById("connect_downrec").value);
                    if (isNaN(connectors)) {
                        return "<p style='color: red;'>Masukkan nilai untuk Jumlah Konektor terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Jumlah Konektor: ${connectors}</li>
                            <li>Loss per konektor: 0,05 dB</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>L<sub>connector</sub> = ${connectors} &times; 0,05 = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>Setiap konektor pada jalur transmisi downlink juga menyebabkan kehilangan daya kecil. Perhitungan ini mengasumsikan kerugian standar 0,05 dB per konektor.</p>
                    `;
                  }
                },
                { buttonId: 'antenna_downrec_popup_btn', popupId: 'antenna_downrec_popup', inputId: 'antenna_to_lna_downrec', formulaId: 'antenna_downrec_formula',
                  formula: "L<sub>total</sub> = LA + LB + LC + L<sub>BPF</sub> + L<sub>other</sub> + L<sub>connector</sub>",
                  detailFunc: (val) => {
                    const la = parseFloat(document.getElementById("la_downrec").value);
                    const lb = parseFloat(document.getElementById("lb_downrec").value);
                    const lc = parseFloat(document.getElementById("lc_downrec").value);
                    const lbpf = parseFloat(document.getElementById("lbpf_downrec").value) || 0;
                    const lother = parseFloat(document.getElementById("lother_downrec").value) || 0;
                    const connector = parseFloat(document.getElementById("totconnect_downrec").value);
                    
                    if (isNaN(la) || isNaN(lb) || isNaN(lc) || isNaN(lbpf) || isNaN(lother) || isNaN(connector)) {
                        return "<p style='color: red;'>Lengkapi semua nilai loss yang terkait (LA, LB, LC, LBPF, Lother, Connector) terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>LA: ${la} dB</li>
                            <li>LB: ${lb} dB</li>
                            <li>LC: ${lc} dB</li>
                            <li>Loss Filter Bandpass (LBPF): ${lbpf} dB</li>
                            <li>Loss Perangkat In-Line Lainnya (Lother): ${lother} dB</li>
                            <li>Total Loss Konektor: ${connector} dB</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>L<sub>total</sub> = ${la} + ${lb} + ${lc} + ${lbpf} + ${lother} + ${connector} = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>Ini adalah jumlah total semua kehilangan daya yang terjadi pada jalur sinyal downlink dari antena hingga Low Noise Amplifier (LNA), termasuk kehilangan kabel/waveguide, filter, perangkat lain, dan konektor. Nilai ini sangat penting untuk perhitungan budget tautan.</p>
                    `;
                  }
                },
                { buttonId: 'tranlincoe_downrec_popup_btn', popupId: 'tranlincoe_downrec_popup', inputId: 'tranlincoe_downrec', formulaId: 'tranlincoe_downrec_formula',
                  formula: "&alpha; = 10<sup>(-L<sub>total</sub> / 10)</sup>",
                  detailFunc: (val) => {
                    const loss = parseFloat(document.getElementById("antenna_to_lna_downrec").value);
                    if (isNaN(loss)) {
                        return "<p style='color: red;'>Hitung Total In-Line Losses terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Total In-Line Losses (L<sub>total</sub>): ${loss} dB</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>&alpha; = 10<sup>(-${loss} / 10)</sup> = ${val}</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>Koefisien transmisi (&alpha;) adalah faktor yang menunjukkan seberapa banyak daya sinyal downlink yang melewati jalur transmisi. Nilai 1 berarti tidak ada kehilangan (ideal), sedangkan nilai kurang dari 1 menunjukkan adanya redaman. Ini dihitung dari total kehilangan daya dalam desibel.</p>
                    `;
                  }
                },
                { buttonId: 'glna_downrec_popup_btn', popupId: 'glna_downrec_popup', inputId: 'glna_downrec', formulaId: 'glna_downrec_formula',
                  formula: "G<sub>LNA</sub> = 10<sup>(Gain<sub>LNA</sub> / 10)</sup>",
                  detailFunc: (val) => {
                    const gain = parseFloat(document.getElementById("lnagain_downrec").value);
                    if (isNaN(gain)) {
                        return "<p style='color: red;'>Masukkan nilai LNA Gain terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Gain LNA: ${gain} dB</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>G<sub>LNA</sub> = 10<sup>(${gain} / 10)</sup> = ${val}</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>G<sub>LNA</sub> adalah gain Low Noise Amplifier (LNA) dalam rasio linier untuk downlink, yang dikonversi dari nilai desibel (dB). LNA adalah komponen penting yang memperkuat sinyal yang diterima tanpa menambahkan terlalu banyak noise.</p>
                    `;
                  }
                },
                { buttonId: 'dloss_downrec_popup_btn', popupId: 'dloss_downrec_popup', inputId: 'dloss_result_downrec', formulaId: 'dloss_downrec_formula',
                  formula: "D<sub>loss</sub> = Panjang Kabel &times; Loss per meter",
                  detailFunc: (val) => {
                    const length = parseFloat(document.getElementById("dloss_length_downrec").value);
                    const loss = parseFloat(document.getElementById("dloss_per_meter_downrec").value);
                    if (isNaN(length) || isNaN(loss)) {
                        return "<p style='color: red;'>Masukkan nilai Panjang Kabel D dan Loss per meter terlebih dahulu.</p>";
                    }
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Panjang Kabel D: ${length} meter</li>
                            <li>Loss per meter: ${loss} dB/meter</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>D<sub>loss</sub> = ${length} &times; ${loss} = ${val} dB</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>D<sub>loss</sub> adalah total kehilangan daya yang terjadi pada Kabel/Waveguide D (bagian dari jalur transmisi downlink) berdasarkan panjang dan redaman per meternya.</p>
                    `;
                  }
                },
                { buttonId: 'ts_downrec_popup_btn', popupId: 'ts_downrec_popup', inputId: 'ts_downrec', formulaId: 'ts_downrec_formula',
                  formula: "T<sub>s</sub> = (T<sub>a</sub> &times; &alpha;) + (T<sub>o</sub> &times; (1 - &alpha;)) + T<sub>LNA</sub> + (T<sub>ComRcvr</sub> / (G<sub>LNA</sub> / 10<sup>(D<sub>loss</sub> / 10)</sup>))",
                  detailFunc: (val) => {
                    const alpha = parseFloat(document.getElementById("tranlincoe_downrec").value);
                    const ta = parseFloat(document.getElementById("antemper_downrec").value);
                    const to = parseFloat(document.getElementById("spactemp_downrec").value);
                    const tlna = parseFloat(document.getElementById("tlna_downrec").value);
                    const tComRcvr = parseFloat(document.getElementById("tcomrcvr_downrec").value);
                    const glna = parseFloat(document.getElementById("glna_downrec").value);
                    const dLoss = parseFloat(document.getElementById("dloss_result_downrec").value);
                    
                    if (isNaN(alpha) || isNaN(ta) || isNaN(to) || isNaN(tlna) || isNaN(tComRcvr) || isNaN(glna) || isNaN(dLoss) || glna === 0) {
                        return "<p style='color: red;'>Lengkapi semua nilai suhu, gain, dan D Loss yang terkait (Ta, To, TLNA, TComRcvr, GLNA, DLoss) terlebih dahulu.</p>";
                    }
                    
                    const dLossFactor = Math.pow(10, dLoss / 10);
                    const effectiveGLNA = glna / dLossFactor;
                    
                    const part1 = ta * alpha;
                    const part2 = to * (1 - alpha);
                    const part3 = tlna;
                    const part4 = tComRcvr / effectiveGLNA;
                    
                    return `
                        <p><strong>Parameter:</strong></p>
                        <ul>
                            <li>Suhu Antena (T<sub>a</sub>): ${ta} K</li>
                            <li>Koefisien Transmisi (&alpha;): ${alpha}</li>
                            <li>Suhu Ruang Angkasa (T<sub>o</sub>): ${to} K</li>
                            <li>Suhu LNA (T<sub>LNA</sub>): ${tlna} K</li>
                            <li>Suhu Front End Penerima Komunikasi (T<sub>ComRcvr</sub>): ${tComRcvr} K</li>
                            <li>Gain LNA (G<sub>LNA</sub>): ${glna}</li>
                            <li>Total Loss Kabel/Waveguide D (D<sub>loss</sub>): ${dLoss} dB</li>
                        </ul>
                        <p><strong>Perhitungan:</strong></p>
                        <p>G<sub>LNA</sub> Efektif = G<sub>LNA</sub> / 10<sup>(D<sub>loss</sub> / 10)</sup> = ${glna} / 10<sup>(${dLoss} / 10)</sup> = ${effectiveGLNA.toFixed(4)}</p>
                        <p>T<sub>s</sub> = (${ta} &times; ${alpha}) + (${to} &times; (1 - ${alpha})) + ${tlna} + (${tComRcvr} / ${effectiveGLNA.toFixed(4)})</p>
                        <p>T<sub>s</sub> = ${part1.toFixed(2)} + ${part2.toFixed(2)} + ${part3} + ${part4.toFixed(2)} = ${val} K</p>
                        <p><strong>Penjelasan:</strong></p>
                        <p>Suhu Noise Sistem (T<sub>s</sub>) untuk downlink adalah total noise termal dari semua komponen, termasuk efek redaman pada jalur transmisi setelah LNA yang memengaruhi gain efektif.</p>
                    `;
                  }
                }
            ];
            
            // Attach event listeners for popup buttons
            popupPairs.forEach(pair => {
                const button = document.getElementById(pair.buttonId);
                if (button) {
                    button.addEventListener('click', function() {
                        openDetailPopup(pair.popupId, pair.inputId, pair.formulaId, pair.formula, pair.detailFunc);
                    });
                }
            });
            
            // Attach event listeners for close buttons on all popups
            document.querySelectorAll('.close-popup-btn').forEach(button => {
                button.addEventListener('click', function() {
                    closeAllPopups();
                });
            });
        });

        // Function to open detail popup
        function openDetailPopup(popupId, inputId, formulaId, formula, detailFunc) {
            const popup = document.getElementById(popupId);
            if (!popup) return;
            
            const formulaElement = document.getElementById(formulaId);
            if (formulaElement) {
                formulaElement.innerHTML = formula;
            }
            
            const inputValue = document.getElementById(inputId).value;
            const detailContent = document.getElementById(popupId + '_content');
            if (detailContent) {
                detailContent.innerHTML = detailFunc(inputValue);
            }
            
            // Show the popup
            popup.style.display = "flex";
        }

        // Function to close all popups
        function closeAllPopups() {
            document.querySelectorAll('.popup-window').forEach(popup => {
                popup.style.display = "none";
            });
        }
    </script>
</x-layout>