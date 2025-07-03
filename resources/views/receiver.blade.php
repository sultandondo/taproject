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
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            display: flex; /* Use flexbox for header and body layout */
            flex-direction: column; /* Stack header and body vertically */
            animation: fadeInScale 0.3s ease-out;
            box-sizing: border-box;
            margin: 1rem;
        }

        /* Style for popup header that won't scroll */
        .popup-header {
            padding: 20px 30px 10px; /* Padding for header */
            border-bottom: 1px solid #eee; /* Bottom border on header */
            position: relative; /* Important for absolute positioning of close button */
            flex-shrink: 0; /* Prevent header from shrinking */
        }

        .popup-header h3 {
            margin-top: 0; /* Remove potential top margin from h3 */
            color: #2c3e50;
            padding-bottom: 0; /* Remove default padding-bottom from h3 here */
        }
        
        .close-popup-btn {
            position: absolute;
            top: 15px; /* Adjusted position */
            right: 15px; /* Adjusted position */
            font-size: 24px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: color 0.2s ease;
            z-index: 1001;
            background-color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .close-popup-btn:hover {
            color: #000;
        }

        /* Style for popup body that will scroll */
        .popup-body {
            padding: 20px 30px 30px; /* Padding for body content */
            overflow-y: auto; /* This allows the body content to scroll */
            flex-grow: 1; /* Allow body to take up remaining space */
        }

        /* New styles for the formula and definition box */
        .formula-definition-box {
            background-color: #f5f5f5;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 4px solid #4CAF50;
            margin: 15px 0; /* Margin only at top and bottom */
            font-family: 'Cambria Math', 'Times New Roman', serif;
        }

        .formula-definition-box .formula-title {
            font-weight: bold;
            color: #166534; /* Darker green */
            margin-bottom: 10px;
            font-size: 1em; /* Standard font size */
        }

        .formula-definition-box .formula-math {
            font-size: 1.2em; /* Larger math font */
            margin-bottom: 15px;
        }

        .formula-definition-box .definition-title {
            font-weight: bold;
            color: #374151;
            margin-top: 10px; /* Reduced top margin to keep it close to formula */
            margin-bottom: 5px;
        }
        
        .formula-definition-box ul {
            list-style-type: none; /* Remove default bullets */
            padding-left: 0;
        }

        .formula-definition-box ul li {
            margin-bottom: 5px;
            padding-left: 1.5em; /* Indent for custom bullet */
            position: relative;
        }

        .formula-definition-box ul li::before {
            content: '•'; /* Custom bullet point */
            color: #4CAF50; /* Green bullet */
            position: absolute;
            left: 0;
            top: 0;
        }

        /* Styling for the explanation section (outside the box) */
        .explanation-section {
            margin-top: 15px; /* Space between the box and explanation */
            padding-top: 10px; /* Padding for the explanation section */
            /* border-top: 1px solid #eee; */ /* Optional: a subtle line above explanation */
        }

        .explanation-section .explanation-title {
            font-weight: bold;
            color: #374151;
            margin-bottom: 5px;
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
        /* Styling for the new receiver explanation popup content */
        .receiver-explanation {
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
            color: #4A5568;
        }
        .receiver-explanation .section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }
        .receiver-explanation .section:last-child {
            border-bottom: none;
        }
        .receiver-explanation .section-title {
            color: #2C5282;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border-left: 5px solid #4299E1;
            padding-left: 1rem;
        }
        .receiver-explanation .section-content {
            text-align: justify;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }
        .receiver-explanation .param-title {
            color: #2D3748;
            font-size: 1rem;
            font-weight: 600;
            margin: 1.25rem 0 0.5rem 0;
        }
        .receiver-explanation .param-list {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }
        .receiver-explanation .param-list li {
            margin-bottom: 0.4rem;
            line-height: 1.6;
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                    <i class="text-blue-600"></i> Perhitungan Parameter Receiver
                </h1>
                <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                    Masukkan parameter receiver untuk uplink dan downlink.
                </p>

                {{-- "Apa itu Perhitungan Receiver?" button --}}
                <div class="mb-6 text-right animate__animated animate__fadeInUp">
                    <button type="button" id="info_receiver_general_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">
                        Apa itu Perhitungan Receiver? <i class="fas fa-info-circle ml-1"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('receiver.store', $dataId)}}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->id() ?? 1}}">

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Uplink</h2>
                        <div class="relative mb-6">
                            <div class="w-50 h-50 mx-auto">
                                <img src="{{ asset('img/upreceiver.png') }}" alt="Blok Diagram Uplink" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            <label class="block font-medium mb-2 text-gray-700">Cable or Waveguide ("Line") Losses:</label>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide Type:</label>
                                <input type="text" name="cabletype_uprec" id="cabletype_uprec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Tipe Kabel/Waveguide">
                            </div>
                            <div class="relative">
                                <label class="block font-medium mb-1 text-gray-700">Cable/Guide Loss/meter:</label>
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
                            <label for="totconnect_uprec" class="block font-medium text-gray-700 mb-1">Total of Power Loss (Connector):</label>
                            <div class="input-with-unit-wrapper">
                                <input type="text" id="totconnect_uprec" name="totconnect_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed"readonly>
                                <span class="unit-text">dB</span>
                            </div>
                            <button type="button" id="totconnect_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="mb-4 relative">
                            <label class="block font-medium mb-1 text-gray-700">Total In-Line Losses from Antenna to LNA:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="antenna_to_lna_uprec" id="antenna to lna_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly>
                                <span class="unit-text">dB</span>
                            </div>
                            <button type="button" id="antenna_popup_btn" class="text-blue-500 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                        </div>

                        <div class="mb-4 relative">
                            <label class="block font-medium mb-1 text-gray-700">Transmission Line Coefficient (α):</label>
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

                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-6">
                        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Downlink</h2>
                        <div class="relative mb-6">
                            <div class="w-50 h-50 mx-auto">
                                <img src="{{ asset('img/downreceiver.png') }}" alt="Blok Diagram Downlink" class="w-full h-full object-cover">
                            </div>
                        </div>
                        
                        <div class="input-group mb-4">
                            <label class="block font-medium mb-2 text-gray-700">Cable or Waveguide ("Line") Losses:</label>
                            <div class="mb-4">
                                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide Type:</label>
                                <input type="text" name="cabletype_downrec" id="cabletype_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Tipe Kabel/Waveguide">
                            </div>
                            <div class="relative">
                                <label class="block font-medium mb-1 text-gray-700">Cable/Guide Loss/meter:</label>
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
                            <label for="totconnect_downrec" class="block font-medium text-gray-700 mb-1">Total of Power Loss (Connector):</label>
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
                            <label class="block font-medium mb-1 text-gray-700">Transmission Line Coefficient (α):</label>
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
                            <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide D Loss/meter:</label>
                            <div class="input-with-unit-wrapper">
                                <input type="number" step="any" name="dloss_per_meter_downrec" id="dloss_per_meter_downrec" class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan Nilai" oninput="calculateDLossDownlink()">
                                <span class="unit-text">dB/m</span>
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
                    </div>
                        <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <i class=""></i> Hitung & Simpan
                            </button>
                        </form>
                        <div class="flex justify-between mt-6">
                            <a href="/calc/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
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

    <div id="la_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail LA (dB)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_A = \\text{Panjang Kabel A} \\times \\text{Loss per meter}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_A$: Total kehilangan daya pada Line A (dB)</li>
                        <li>Panjang Kabel A: Panjang fisik kabel atau waveguide Line A (meter)</li>
                        <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>LA adalah total kehilangan daya yang terjadi pada Line A (kabel atau waveguide) berdasarkan panjangnya dan redaman per meternya. Nilai ini merupakan kontribusi kehilangan daya dari segmen kabel pertama di jalur penerima.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="lb_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail LB (dB)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_B = \\text{Panjang Kabel B} \\times \\text{Loss per meter}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_B$: Total kehilangan daya pada Line B (dB)</li>
                        <li>Panjang Kabel B: Panjang fisik kabel atau waveguide Line B (meter)</li>
                        <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>LB adalah total kehilangan daya yang terjadi pada Line B (kabel atau waveguide) berdasarkan panjangnya dan redaman per meternya. Nilai ini merupakan kontribusi kehilangan daya dari segmen kabel kedua di jalur penerima.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="lc_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail LC (dB)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_C = \\text{Panjang Kabel C} \\times \\text{Loss per meter}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_C$: Total kehilangan daya pada Line C (dB)</li>
                        <li>Panjang Kabel C: Panjang fisik kabel atau waveguide Line C (meter)</li>
                        <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>LC adalah total kehilangan daya yang terjadi pada Line C (kabel atau waveguide) berdasarkan panjangnya dan redaman per meternya. Nilai ini merupakan kontribusi kehilangan daya dari segmen kabel ketiga di jalur penerima.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="totconnect_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Total of Power Loss (Connector)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_{\\text{connector}} = \\text{Jumlah Konektor} \\times 0.05 \\text{ dB}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_{\\text{connector}}$: Total kehilangan daya akibat konektor (dB)</li>
                        <li>Jumlah Konektor: Total konektor yang terpasang pada jalur transmisi</li>
                        <li>0.05 dB: Asumsi kehilangan daya per konektor</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>Setiap konektor pada jalur transmisi menyebabkan kehilangan daya kecil. Perhitungan ini mengasumsikan kerugian standar 0,05 dB per konektor, yang kemudian dijumlahkan berdasarkan total konektor.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="antenna_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Total In-Line Losses from Antenna to LNA (dB)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_{\\text{total line}} = L_{\\text{cable}} + L_{\\text{connector}} + L_{\\text{filter}} + L_{\\text{device}} + L_{\\text{mismatch}}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_{\\text{total line}}$: Total kehilangan daya pada jalur transmisi (dB)</li>
                        <li>$L_{\\text{cable}}$: Total kehilangan daya pada kabel atau waveguide (LA + LB + LC) (dB)</li>
                        <li>$L_{\\text{connector}}$: Total kehilangan daya akibat konektor (dB)</li>
                        <li>$L_{\\text{filter}}$: Kehilangan daya akibat filter bandpass (LBPF) (dB)</li>
                        <li>$L_{\\text{device}}$: Kehilangan daya akibat perangkat in-line lainnya (Lother) (dB)</li>
                        <li>$L_{\\text{mismatch}}$: Kehilangan daya akibat ketidaksesuaian impedansi antena (sering diabaikan jika cocok, atau diperhitungkan jika ada data spesifik) (dB)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>Ini adalah jumlah total semua kehilangan daya yang terjadi pada jalur sinyal dari antena hingga Low Noise Amplifier (LNA). Nilai ini krusial karena setiap kehilangan di sini akan langsung berkontribusi pada peningkatan noise sistem dan penurunan kualitas sinyal yang diterima. Ini adalah akumulasi dari semua redaman yang terjadi sebelum sinyal mencapai LNA.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="tranlincoe_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Koefisien Transmisi (α)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$\\alpha = 10^{(-\\frac{L_{\\text{total line}}}{10})}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$\\alpha$: Koefisien transmisi (tanpa satuan)</li>
                        <li>$L_{\\text{total line}}$: Total kehilangan daya pada jalur transmisi (dB)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>Koefisien transmisi ($\alpha$) adalah faktor yang menunjukkan seberapa banyak daya sinyal yang berhasil melewati jalur transmisi. Nilai 1 berarti tidak ada kehilangan (ideal), sedangkan nilai kurang dari 1 menunjukkan adanya redaman. Ini dihitung dari total kehilangan daya dalam desibel dan digunakan dalam perhitungan suhu noise sistem.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="glna_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail GLNA</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$G_{\\text{LNA}} = 10^{(\\frac{\\text{Gain}_{\\text{LNA}}}{10})}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$G_{\\text{LNA}}$: Gain LNA dalam rasio linier (tanpa satuan)</li>
                        <li>$\\text{Gain}_{\\text{LNA}}$: Gain LNA dalam desibel (dB)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>GLNA adalah gain Low Noise Amplifier (LNA) dalam rasio linier, yang dikonversi dari nilai desibel (dB). LNA adalah komponen penting yang memperkuat sinyal yang diterima tanpa menambahkan terlalu banyak noise, sehingga meningkatkan Signal-to-Noise Ratio (SNR) secara keseluruhan.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="ts_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Suhu Noise Sistem (Ts)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$T_s = (T_a \\times \\alpha) + (T_o \\times (1 - \\alpha)) + T_{\\text{LNA}} + (T_{\\text{2ndStage}} / G_{\\text{LNA}})$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$T_s$: Suhu Noise Sistem (Kelvin)</li>
                        <li>$T_a$: Suhu noise antena atau "langit" (Kelvin)</li>
                        <li>$\\alpha$: Koefisien transmisi (tanpa satuan)</li>
                        <li>$T_o$: Suhu fisik (ambient) dari komponen (Kelvin, umumnya 290 K)</li>
                        <li>$T_{\\text{LNA}}$: Suhu noise LNA (Kelvin)</li>
                        <li>$T_{\\text{2ndStage}}$: Suhu noise tahap kedua penerima (Kelvin)</li>
                        <li>$G_{\\text{LNA}}$: Gain LNA dalam rasio linier (tanpa satuan)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>Suhu Noise Sistem ($T_s$) adalah total noise termal yang dihasilkan oleh semua komponen dalam rantai penerima, direferensikan ke input receiver. Ini adalah metrik kritis untuk menentukan sensitivitas sistem penerima. Semakin rendah nilai $T_s$, semakin baik kemampuan receiver untuk mendeteksi sinyal lemah.</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Downlink Popups --}}
    <div id="la_downrec_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail LA (dB)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_A = \\text{Panjang Kabel A} \\times \\text{Loss per meter}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_A$: Total kehilangan daya pada Line A (dB)</li>
                        <li>Panjang Kabel A: Panjang fisik kabel atau waveguide Line A (meter)</li>
                        <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>LA adalah total kehilangan daya yang terjadi pada Line A (kabel atau waveguide) untuk downlink, berdasarkan panjangnya dan redaman per meternya. Ini adalah salah satu komponen kehilangan daya di jalur penerima downlink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="lb_downrec_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail LB (dB)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_B = \\text{Panjang Kabel B} \\times \\text{Loss per meter}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_B$: Total kehilangan daya pada Line B (dB)</li>
                        <li>Panjang Kabel B: Panjang fisik kabel atau waveguide Line B (meter)</li>
                        <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>LB adalah total kehilangan daya yang terjadi pada Line B (kabel atau waveguide) untuk downlink, berdasarkan panjangnya dan redaman per meternya. Ini adalah komponen kehilangan daya lainnya di jalur penerima downlink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="lc_downrec_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail LC (dB)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_C = \\text{Panjang Kabel C} \\times \\text{Loss per meter}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_C$: Total kehilangan daya pada Line C (dB)</li>
                        <li>Panjang Kabel C: Panjang fisik kabel atau waveguide Line C (meter)</li>
                        <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>LC adalah total kehilangan daya yang terjadi pada Line C (kabel atau waveguide) untuk downlink, berdasarkan panjangnya dan redaman per meternya. Ini adalah komponen kehilangan daya ketiga di jalur penerima downlink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="totconnect_downrec_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Total of Power Loss (Connector)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_{\\text{connector}} = \\text{Jumlah Konektor} \\times 0.05 \\text{ dB}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_{\\text{connector}}$: Total kehilangan daya akibat konektor (dB)</li>
                        <li>Jumlah Konektor: Total konektor yang terpasang pada jalur transmisi downlink</li>
                        <li>0.05 dB: Asumsi kehilangan daya per konektor</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>Serupa dengan uplink, setiap konektor pada jalur transmisi downlink juga menyebabkan kehilangan daya. Perhitungan ini mengasumsikan kerugian standar 0,05 dB per konektor dan menjumlahkannya.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="antenna_downrec_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Total In-Line Losses dari Antena ke LNA (dB)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$L_{\\text{total line}} = L_{\\text{cable}} + L_{\\text{connector}} + L_{\\text{filter}} + L_{\\text{device}} + L_{\\text{mismatch}}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$L_{\\text{total line}}$: Total kehilangan daya pada jalur transmisi downlink (dB)</li>
                        <li>$L_{\\text{cable}}$: Total kehilangan daya pada kabel atau waveguide (LA + LB + LC) (dB)</li>
                        <li>$L_{\\text{connector}}$: Total kehilangan daya akibat konektor (dB)</li>
                        <li>$L_{\\text{filter}}$: Kehilangan daya akibat filter bandpass (LBPF) (dB)</li>
                        <li>$L_{\\text{device}}$: Kehilangan daya akibat perangkat in-line lainnya (Lother) (dB)</li>
                        <li>$L_{\\text{mismatch}}$: Kehilangan daya akibat ketidaksesuaian impedansi antena (sering diabaikan jika cocok, atau diperhitungkan jika ada data spesifik) (dB)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>Ini adalah jumlah total semua kehilangan daya yang terjadi pada jalur sinyal downlink dari antena hingga Low Noise Amplifier (LNA). Akumulasi kehilangan ini mempengaruhi sensitivitas penerima dan perlu diminimalkan untuk kinerja optimal.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="tranlincoe_downrec_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Koefisien Transmisi (α)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$\\alpha = 10^{(-\\frac{L_{\\text{total line}}}{10})}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$\\alpha$: Koefisien transmisi (tanpa satuan)</li>
                        <li>$L_{\\text{total line}}$: Total kehilangan daya pada jalur transmisi downlink (dB)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>Koefisien transmisi ($\alpha$) adalah faktor yang menunjukkan seberapa banyak daya sinyal downlink yang berhasil melewati jalur transmisi. Nilai ini penting untuk menghitung suhu noise sistem yang efektif setelah mempertimbangkan semua redaman.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="glna_downrec_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail GLNA</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$G_{\\text{LNA}} = 10^{(\\frac{\\text{Gain}_{\\text{LNA}}}{10})}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$G_{\\text{LNA}}$: Gain LNA dalam rasio linier (tanpa satuan)</li>
                        <li>$\\text{Gain}_{\\text{LNA}}$: Gain LNA dalam desibel (dB)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>GLNA adalah gain Low Noise Amplifier (LNA) dalam rasio linier untuk downlink. LNA ini adalah bagian pertama dari rantai penerima downlink yang memperkuat sinyal lemah dari antena.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="dloss_downrec_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Total Cable/Waveguide D Loss</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$D_{\\text{loss}} = \\text{Panjang Kabel D} \\times \\text{Loss per meter}$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$D_{\\text{loss}}$: Total kehilangan daya pada Kabel/Waveguide D (dB)</li>
                        <li>Panjang Kabel D: Panjang fisik kabel atau waveguide Line D (meter)</li>
                        <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter untuk Line D (dB/meter)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>D_loss adalah total kehilangan daya yang terjadi pada Kabel/Waveguide D (bagian dari jalur transmisi downlink) berdasarkan panjang dan redaman per meternya.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="ts_downrec_popup" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Detail Suhu Noise Sistem (Ts)</h3>
            </div>
            <div class="popup-body">
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">$$T_s = (T_a \\times \\alpha) + (T_o \\times (1 - \\alpha)) + T_{\\text{LNA}} + (T_{\\text{ComRcvr}} / (G_{\\text{LNA}} / 10^{(\\frac{D_{\\text{loss}}}{10})}))$$</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>
                        <li>$T_s$: Suhu Noise Sistem (Kelvin)</li>
                        <li>$T_a$: Suhu noise antena atau "langit" (Kelvin)</li>
                        <li>$\\alpha$: Koefisien transmisi dari jalur antena ke LNA (tanpa satuan)</li>
                        <li>$T_o$: Suhu fisik (ambient) dari komponen (Kelvin, umumnya 290 K)</li>
                        <li>$T_{\\text{LNA}}$: Suhu noise LNA (Kelvin)</li>
                        <li>$T_{\\text{ComRcvr}}$: Suhu noise front end penerima komunikasi (Kelvin)</li>
                        <li>$G_{\\text{LNA}}$: Gain LNA dalam rasio linier (tanpa satuan)</li>
                        <li>$D_{\\text{loss}}$: Total kehilangan daya pada Kabel/Waveguide D (dB)</li>
                    </ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>Suhu Noise Sistem ($T_s$) untuk downlink adalah total noise termal yang dihasilkan oleh semua komponen dalam rantai penerima, termasuk efek redaman pada jalur transmisi setelah LNA (D_loss) yang memengaruhi gain efektif LNA. Nilai ini sangat penting untuk sensitivitas penerima downlink.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- New Popup for general Receiver explanation --}}
    <div id="popup_receiver_general" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span>
                <h3>Tentang Perhitungan Parameter Receiver</h3>
            </div>
            <div class="popup-body">
                <div class="receiver-explanation">
                    <div class="section">
                        <h4 class="section-title">Perhitungan Parameter Receiver</h4>
                        <p class="section-content">
                            Perhitungan parameter receiver sangat penting dalam desain dan analisis sistem komunikasi satelit, karena ini membantu menentukan seberapa baik stasiun bumi dapat menerima sinyal dari satelit. Fokus utama adalah pada tingkat noise yang diperkenalkan oleh komponen receiver.
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Cable or Waveguide ("Line") Losses</h4>
                        <p class="section-content">
                            Ini adalah kehilangan daya yang terjadi saat sinyal melewati kabel atau <strong>waveguide</strong> dari antena ke Low Noise Amplifier (LNA) atau komponen penerima awal lainnya. Ini mencakup:
                            <ul class="param-list">
                                <li><strong>Line A, B, C Length:</strong> Panjang masing-masing segmen kabel atau waveguide.</li>
                                <li><strong>Cable/Guide Loss per meter:</strong> Kehilangan daya per meter untuk jenis kabel/waveguide yang spesifik.</li>
                                <li><strong>LA, LB, LC:</strong> Total kehilangan daya di masing-masing segmen kabel.</li>
                            </ul>
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Other In-Line Devices Losses</h4>
                        <p class="section-content">
                            Selain kabel, ada komponen lain yang juga menyebabkan kehilangan daya sinyal dan mempengaruhi kinerja receiver:
                            <ul class="param-list">
                                <li><strong>Bandpass Filter Insertion Loss (LBPF):</strong> Kehilangan daya akibat penggunaan filter bandpass yang selektif.</li>
                                <li><strong>Insertion Loss of Other In-Line Devices (Lother):</strong> Kehilangan daya yang disebabkan oleh perangkat lain yang terhubung di jalur sinyal (misalnya, isolator, coupler).</li>
                                <li><strong>Number of In-Line Connectors:</strong> Jumlah konektor yang terpasang di jalur transmisi.</li>
                                <li><strong>Total of Power Loss (Connector):</strong> Total kehilangan daya yang disebabkan oleh semua konektor.</li>
                            </ul>
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Total In-Line Losses from Antenna to LNA</h4>
                        <p class="section-content">
                            Ini adalah jumlah total semua kehilangan daya yang terjadi pada jalur sinyal dari antena hingga Low Noise Amplifier (LNA). Nilai ini krusial karena setiap kehilangan di sini akan langsung berkontribusi pada peningkatan noise sistem.
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Transmission Line Coefficient (α)</h4>
                        <p class="section-content">
                            Koefisien transmisi ($\alpha$) adalah faktor yang menunjukkan seberapa banyak daya sinyal yang berhasil melewati jalur transmisi. Nilai 1 berarti tidak ada kehilangan (ideal), sedangkan nilai kurang dari 1 menunjukkan adanya redaman. Ini dihitung dari total kehilangan daya dalam desibel.
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Temperatures (Suhu Noise)</h4>
                        <p class="section-content">
                            Noise termal adalah sumber noise utama dalam sistem penerima. Perhitungan ini melibatkan beberapa suhu noise:
                            <ul class="param-list">
                                <li><strong>Antenna or "Sky" Temperature (Ta):</strong> Suhu noise yang diterima dari antena, mencerminkan noise dari langit atau lingkungan.</li>
                                <li><strong>Spacecraft Temperature (To):</strong> Suhu fisik (ambient) dari komponen, biasanya 290 Kelvin (suhu ruang).</li>
                                <li><strong>LNA Temperature (TLNA):</strong> Suhu noise yang dihasilkan oleh Low Noise Amplifier (LNA), komponen pertama yang sangat penting dalam rantai penerima. LNA yang baik memiliki suhu noise rendah.</li>
                                <li><strong>2nd Stage Temperature (T2ndStage) / Communications Receiver Front End Temperature (TComRcvr):</strong> Suhu noise dari tahap kedua penerima atau front end receiver komunikasi, yang menambahkan noise setelah LNA.</li>
                            </ul>
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">LNA Gain (GLNA)</h4>
                        <p class="section-content">
                            Ini adalah gain dari Low Noise Amplifier (LNA), yang diukur dalam desibel (dB) dan kemudian dikonversi ke rasio linier (GLNA). LNA adalah komponen kritis yang memperkuat sinyal yang sangat lemah dari antena tanpa menambahkan banyak noise, sehingga meningkatkan Signal-to-Noise Ratio (SNR).
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Cable/Waveguide D Loss (Downlink Specific)</h4>
                        <p class="section-content">
                            Untuk downlink, mungkin ada segmen kabel/waveguide tambahan (Line D) setelah LNA yang perlu diperhitungkan loss-nya. Ini dihitung dari panjang dan loss per meternya.
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">System Noise Temperature (Ts)</h4>
                        <p class="section-content">
                            Ini adalah parameter paling penting dalam perhitungan receiver. <strong>Suhu Noise Sistem (Ts)</strong> adalah total noise termal yang dihasilkan oleh semua komponen dalam rantai penerima (antena, jalur transmisi, LNA, dan tahap selanjutnya), direferensikan ke input receiver. Semakin rendah nilai Ts, semakin baik sensitivitas receiver.
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Uplink dan Downlink</h4>
                        <p class="section-content">
                            Semua parameter di atas dihitung secara terpisah untuk jalur <strong>Uplink</strong> (yang relevan untuk receiver di satelit) dan <strong>Downlink</strong> (yang relevan untuk receiver di stasiun bumi), karena karakteristik transmisi dan komponennya bisa berbeda untuk masing-masing arah.
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Catatan Penggunaan</h4>
                        <p class="section-content">
                            Untuk melihat rumus dan penjelasan detail dari setiap perhitungan spesifik, silakan klik tombol "Lihat Detail" yang tersedia di samping setiap kolom hasil.
                        </p>
                    </div>
                </div>
            </div>
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
                { buttonId: 'la_popup_btn', popupId: 'la_popup',
                  formula: "$$L_A = \\text{Panjang Kabel A} \\times \\text{Loss per meter}$$",
                  definitions: `
                      <li>$L_A$: Total kehilangan daya pada Line A (dB)</li>
                      <li>Panjang Kabel A: Panjang fisik kabel atau waveguide Line A (meter)</li>
                      <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                  `,
                  explanation: `LA adalah total kehilangan daya yang terjadi pada Line A (kabel atau waveguide) berdasarkan panjangnya dan redaman per meternya. Nilai ini merupakan kontribusi kehilangan daya dari segmen kabel pertama di jalur penerima.`
                },
                { buttonId: 'lb_popup_btn', popupId: 'lb_popup',
                  formula: "$$L_B = \\text{Panjang Kabel B} \\times \\text{Loss per meter}$$",
                  definitions: `
                      <li>$L_B$: Total kehilangan daya pada Line B (dB)</li>
                      <li>Panjang Kabel B: Panjang fisik kabel atau waveguide Line B (meter)</li>
                      <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                  `,
                  explanation: `LB adalah total kehilangan daya yang terjadi pada Line B (kabel atau waveguide) berdasarkan panjangnya dan redaman per meternya. Nilai ini merupakan kontribusi kehilangan daya dari segmen kabel kedua di jalur penerima.`
                },
                { buttonId: 'lc_popup_btn', popupId: 'lc_popup',
                  formula: "$$L_C = \\text{Panjang Kabel C} \\times \\text{Loss per meter}$$",
                  definitions: `
                      <li>$L_C$: Total kehilangan daya pada Line C (dB)</li>
                      <li>Panjang Kabel C: Panjang fisik kabel atau waveguide Line C (meter)</li>
                      <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                  `,
                  explanation: `LC adalah total kehilangan daya yang terjadi pada Line C (kabel atau waveguide) berdasarkan panjangnya dan redaman per meternya. Nilai ini merupakan kontribusi kehilangan daya dari segmen kabel ketiga di jalur penerima.`
                },
                { buttonId: 'totconnect_popup_btn', popupId: 'totconnect_popup',
                  formula: "$$L_{\\text{connector}} = \\text{Jumlah Konektor} \\times 0.05 \\text{ dB}$$",
                  definitions: `
                      <li>$L_{\\text{connector}}$: Total kehilangan daya akibat konektor (dB)</li>
                      <li>Jumlah Konektor: Total konektor yang terpasang pada jalur transmisi</li>
                      <li>0.05 dB: Asumsi kehilangan daya per konektor</li>
                  `,
                  explanation: `Setiap konektor pada jalur transmisi menyebabkan kehilangan daya kecil. Perhitungan ini mengasumsikan kerugian standar 0,05 dB per konektor, yang kemudian dijumlahkan berdasarkan total konektor.`
                },
                { buttonId: 'antenna_popup_btn', popupId: 'antenna_popup',
                  formula: "$$L_{\\text{total line}} = L_{\\text{cable}} + L_{\\text{connector}} + L_{\\text{filter}} + L_{\\text{device}} + L_{\\text{mismatch}}$$",
                  definitions: `
                      <li>$L_{\\text{total line}}$: Total kehilangan daya pada jalur transmisi (dB)</li>
                      <li>$L_{\\text{cable}}$: Total kehilangan daya pada kabel atau waveguide (LA + LB + LC) (dB)</li>
                      <li>$L_{\\text{connector}}$: Total kehilangan daya akibat konektor (dB)</li>
                      <li>$L_{\\text{filter}}$: Kehilangan daya akibat filter bandpass (LBPF) (dB)</li>
                      <li>$L_{\\text{device}}$: Kehilangan daya akibat perangkat in-line lainnya (Lother) (dB)</li>
                      <li>$L_{\\text{mismatch}}$: Kehilangan daya akibat ketidaksesuaian impedansi antena (sering diabaikan jika cocok, atau diperhitungkan jika ada data spesifik) (dB)</li>
                  `,
                  explanation: `Ini adalah jumlah total semua kehilangan daya yang terjadi pada jalur sinyal dari antena hingga Low Noise Amplifier (LNA). Nilai ini krusial karena setiap kehilangan di sini akan langsung berkontribusi pada peningkatan noise sistem dan penurunan kualitas sinyal yang diterima. Ini adalah akumulasi dari semua redaman yang terjadi sebelum sinyal mencapai LNA.`
                },
                { buttonId: 'tranlincoe_popup_btn', popupId: 'tranlincoe_popup',
                  formula: "$$\\alpha = 10^{(-\\frac{L_{\\text{total line}}}{10})}$$",
                  definitions: `
                      <li>$\\alpha$: Koefisien transmisi (tanpa satuan)</li>
                      <li>$L_{\\text{total line}}$: Total kehilangan daya pada jalur transmisi (dB)</li>
                  `,
                  explanation: `Koefisien transmisi ($\alpha$) adalah faktor yang menunjukkan seberapa banyak daya sinyal yang berhasil melewati jalur transmisi. Nilai 1 berarti tidak ada kehilangan (ideal), sedangkan nilai kurang dari 1 menunjukkan adanya redaman. Ini dihitung dari total kehilangan daya dalam desibel dan digunakan dalam perhitungan suhu noise sistem.`
                },
                { buttonId: 'glna_popup_btn', popupId: 'glna_popup',
                  formula: "$$G_{\\text{LNA}} = 10^{(\\frac{\\text{Gain}_{\\text{LNA}}}{10})}$$",
                  definitions: `
                      <li>$G_{\\text{LNA}}$: Gain LNA dalam rasio linier (tanpa satuan)</li>
                      <li>$\\text{Gain}_{\\text{LNA}}$: Gain LNA dalam desibel (dB)</li>
                  `,
                  explanation: `GLNA adalah gain Low Noise Amplifier (LNA) dalam rasio linier, yang dikonversi dari nilai desibel (dB). LNA adalah komponen penting yang memperkuat sinyal yang diterima tanpa menambahkan terlalu banyak noise, sehingga meningkatkan Signal-to-Noise Ratio (SNR) secara keseluruhan.`
                },
                { buttonId: 'ts_popup_btn', popupId: 'ts_popup',
                  formula: "$$T_s = (T_a \\times \\alpha) + (T_o \\times (1 - \\alpha)) + T_{\\text{LNA}} + (T_{\\text{2ndStage}} / G_{\\text{LNA}})$$",
                  definitions: `
                      <li>$T_s$: Suhu Noise Sistem (Kelvin)</li>
                      <li>$T_a$: Suhu noise antena atau "langit" (Kelvin)</li>
                      <li>$\\alpha$: Koefisien transmisi (tanpa satuan)</li>
                      <li>$T_o$: Suhu fisik (ambient) dari komponen (Kelvin, umumnya 290 K)</li>
                      <li>$T_{\\text{LNA}}$: Suhu noise LNA (Kelvin)</li>
                      <li>$T_{\\text{2ndStage}}$: Suhu noise tahap kedua penerima (Kelvin)</li>
                      <li>$G_{\\text{LNA}}$: Gain LNA dalam rasio linier (tanpa satuan)</li>
                  `,
                  explanation: `Suhu Noise Sistem ($T_s$) adalah total noise termal yang dihasilkan oleh semua komponen dalam rantai penerima, direferensikan ke input receiver. Ini adalah metrik kritis untuk menentukan sensitivitas sistem penerima. Semakin rendah nilai $T_s$, semakin baik kemampuan receiver untuk mendeteksi sinyal lemah.`
                },
                
                // Downlink Popups (using _downrec for IDs)
                { buttonId: 'la_downrec_popup_btn', popupId: 'la_downrec_popup',
                  formula: "$$L_A = \\text{Panjang Kabel A} \\times \\text{Loss per meter}$$",
                  definitions: `
                      <li>$L_A$: Total kehilangan daya pada Line A (dB)</li>
                      <li>Panjang Kabel A: Panjang fisik kabel atau waveguide Line A (meter)</li>
                      <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                  `,
                  explanation: `LA adalah total kehilangan daya yang terjadi pada Line A (kabel atau waveguide) untuk downlink, berdasarkan panjangnya dan redaman per meternya. Ini adalah salah satu komponen kehilangan daya di jalur penerima downlink.`
                },
                { buttonId: 'lb_downrec_popup_btn', popupId: 'lb_downrec_popup',
                  formula: "$$L_B = \\text{Panjang Kabel B} \\times \\text{Loss per meter}$$",
                  definitions: `
                      <li>$L_B$: Total kehilangan daya pada Line B (dB)</li>
                      <li>Panjang Kabel B: Panjang fisik kabel atau waveguide Line B (meter)</li>
                      <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                  `,
                  explanation: `LB adalah total kehilangan daya yang terjadi pada Line B (kabel atau waveguide) untuk downlink, berdasarkan panjangnya dan redaman per meternya. Ini adalah komponen kehilangan daya lainnya di jalur penerima downlink.`
                },
                { buttonId: 'lc_downrec_popup_btn', popupId: 'lc_downrec_popup',
                  formula: "$$L_C = \\text{Panjang Kabel C} \\times \\text{Loss per meter}$$",
                  definitions: `
                      <li>$L_C$: Total kehilangan daya pada Line C (dB)</li>
                      <li>Panjang Kabel C: Panjang fisik kabel atau waveguide Line C (meter)</li>
                      <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter (dB/meter)</li>
                  `,
                  explanation: `LC adalah total kehilangan daya yang terjadi pada Line C (kabel atau waveguide) untuk downlink, berdasarkan panjangnya dan redaman per meternya. Ini adalah komponen kehilangan daya ketiga di jalur penerima downlink.`
                },
                { buttonId: 'totconnect_downrec_popup_btn', popupId: 'totconnect_downrec_popup',
                  formula: "$$L_{\\text{connector}} = \\text{Jumlah Konektor} \\times 0.05 \\text{ dB}$$",
                  definitions: `
                      <li>$L_{\\text{connector}}$: Total kehilangan daya akibat konektor (dB)</li>
                      <li>Jumlah Konektor: Total konektor yang terpasang pada jalur transmisi downlink</li>
                      <li>0.05 dB: Asumsi kehilangan daya per konektor</li>
                  `,
                  explanation: `Serupa dengan uplink, setiap konektor pada jalur transmisi downlink juga menyebabkan kehilangan daya. Perhitungan ini mengasumsikan kerugian standar 0,05 dB per konektor dan menjumlahkannya.`
                },
                { buttonId: 'antenna_downrec_popup_btn', popupId: 'antenna_downrec_popup',
                  formula: "$$L_{\\text{total line}} = L_{\\text{cable}} + L_{\\text{connector}} + L_{\\text{filter}} + L_{\\text{device}} + L_{\\text{mismatch}}$$",
                  definitions: `
                      <li>$L_{\\text{total line}}$: Total kehilangan daya pada jalur transmisi downlink (dB)</li>
                      <li>$L_{\\text{cable}}$: Total kehilangan daya pada kabel atau waveguide (LA + LB + LC) (dB)</li>
                      <li>$L_{\\text{connector}}$: Total kehilangan daya akibat konektor (dB)</li>
                      <li>$L_{\\text{filter}}$: Kehilangan daya akibat filter bandpass (LBPF) (dB)</li>
                      <li>$L_{\\text{device}}$: Kehilangan daya akibat perangkat in-line lainnya (Lother) (dB)</li>
                      <li>$L_{\\text{mismatch}}$: Kehilangan daya akibat ketidaksesuaian impedansi antena (sering diabaikan jika cocok, atau diperhitungkan jika ada data spesifik) (dB)</li>
                  `,
                  explanation: `Ini adalah jumlah total semua kehilangan daya yang terjadi pada jalur sinyal downlink dari antena hingga Low Noise Amplifier (LNA). Akumulasi kehilangan ini mempengaruhi sensitivitas penerima dan perlu diminimalkan untuk kinerja optimal.`
                },
                { buttonId: 'tranlincoe_downrec_popup_btn', popupId: 'tranlincoe_downrec_popup',
                  formula: "$$\\alpha = 10^{(-\\frac{L_{\\text{total line}}}{10})}$$",
                  definitions: `
                      <li>$\\alpha$: Koefisien transmisi (tanpa satuan)</li>
                      <li>$L_{\\text{total line}}$: Total kehilangan daya pada jalur transmisi downlink (dB)</li>
                  `,
                  explanation: `Koefisien transmisi ($\alpha$) adalah faktor yang menunjukkan seberapa banyak daya sinyal downlink yang berhasil melewati jalur transmisi. Nilai ini penting untuk menghitung suhu noise sistem yang efektif setelah mempertimbangkan semua redaman.`
                },
                { buttonId: 'glna_downrec_popup_btn', popupId: 'glna_downrec_popup',
                  formula: "$$G_{\\text{LNA}} = 10^{(\\frac{\\text{Gain}_{\\text{LNA}}}{10})}$$",
                  definitions: `
                      <li>$G_{\\text{LNA}}$: Gain LNA dalam rasio linier (tanpa satuan)</li>
                      <li>$\\text{Gain}_{\\text{LNA}}$: Gain LNA dalam desibel (dB)</li>
                  `,
                  explanation: `GLNA adalah gain Low Noise Amplifier (LNA) dalam rasio linier untuk downlink. LNA ini adalah bagian pertama dari rantai penerima downlink yang memperkuat sinyal lemah dari antena.`
                },
                { buttonId: 'dloss_downrec_popup_btn', popupId: 'dloss_downrec_popup',
                  formula: "$$D_{\\text{loss}} = \\text{Panjang Kabel D} \\times \\text{Loss per meter}$$",
                  definitions: `
                      <li>$D_{\\text{loss}}$: Total kehilangan daya pada Kabel/Waveguide D (dB)</li>
                      <li>Panjang Kabel D: Panjang fisik kabel atau waveguide Line D (meter)</li>
                      <li>Loss per meter: Redaman spesifik kabel atau waveguide per meter untuk Line D (dB/meter)</li>
                  `,
                  explanation: `D_loss adalah total kehilangan daya yang terjadi pada Kabel/Waveguide D, yang merupakan segmen tambahan pada jalur transmisi downlink setelah LNA. Kehilangan ini berkontribusi pada total noise sistem dan mengurangi gain efektif setelah LNA.`
                },
                { buttonId: 'ts_downrec_popup_btn', popupId: 'ts_downrec_popup',
                  formula: "$$T_s = (T_a \\times \\alpha) + (T_o \\times (1 - \\alpha)) + T_{\\text{LNA}} + (T_{\\text{ComRcvr}} / (G_{\\text{LNA}} / 10^{(\\frac{D_{\\text{loss}}}{10})}))$$",
                  definitions: `
                      <li>$T_s$: Suhu Noise Sistem (Kelvin)</li>
                      <li>$T_a$: Suhu noise antena atau "langit" (Kelvin)</li>
                      <li>$\\alpha$: Koefisien transmisi dari jalur antena ke LNA (tanpa satuan)</li>
                      <li>$T_o$: Suhu fisik (ambient) dari komponen (Kelvin, umumnya 290 K)</li>
                      <li>$T_{\\text{LNA}}$: Suhu noise LNA (Kelvin)</li>
                      <li>$T_{\\text{ComRcvr}}$: Suhu noise front end penerima komunikasi (Kelvin)</li>
                      <li>$G_{\\text{LNA}}$: Gain LNA dalam rasio linier (tanpa satuan)</li>
                      <li>$D_{\\text{loss}}$: Total kehilangan daya pada Kabel/Waveguide D (dB)</li>
                  `,
                  explanation: `Suhu Noise Sistem ($T_s$) untuk downlink adalah total noise termal yang dihasilkan oleh semua komponen dalam rantai penerima, termasuk efek redaman pada jalur transmisi setelah LNA (D_loss) yang memengaruhi gain efektif LNA. Nilai ini sangat penting untuk sensitivitas penerima downlink.`
                }
            ];
            
            // Attach event listeners for popup buttons
            popupPairs.forEach(pair => {
                const button = document.getElementById(pair.buttonId);
                if (button) {
                    button.addEventListener('click', function() {
                        openDetailPopup(pair.popupId, pair.formula, pair.definitions, pair.explanation);
                    });
                }
            });
            
            // Attach event listeners for close buttons on all popups
            document.querySelectorAll('.close-popup-btn').forEach(button => {
                button.addEventListener('click', function() {
                    closeAllPopups();
                });
            });

            // Event listener for the new "Apa itu Perhitungan Receiver?" button
            document.getElementById('info_receiver_general_btn').onclick = () => {
                openPopup('popup_receiver_general');
            };
        });

        // Function to open a specific detail popup
        function openDetailPopup(popupId, formulaContent, definitionsContent, explanationContent) {
            // Close any other open popups first
            closeAllPopups();

            const popup = document.getElementById(popupId);
            if (!popup) return;
            
            // Construct the HTML for the formula and definitions box
            const formulaDefinitionHtml = `
                <div class="formula-definition-box">
                    <p class="formula-title">Rumus Perhitungan:</p>
                    <p class="formula-math">${formulaContent}</p>
                    <p class="definition-title">Dimana:</p>
                    <ul>${definitionsContent}</ul>
                </div>
                <div class="explanation-section">
                    <p class="explanation-title">Penjelasan:</p>
                    <p>${explanationContent}</p>
                </div>
            `;
            
            const popupBody = popup.querySelector('.popup-body');
            if (popupBody) {
                popupBody.innerHTML = formulaDefinitionHtml; // Set the entire content
            }
            
            // Show the popup
            popup.style.display = "flex";
            // Re-render MathJax after content is loaded
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        }

        // Function to open general info popup (without specific input/formula)
        function openPopup(popupId) {
            closeAllPopups(); // Close any other open popups
            const popup = document.getElementById(popupId);
            if (popup) {
                popup.style.display = "flex";
                if (typeof MathJax !== 'undefined') {
                    MathJax.typesetPromise();
                }
            }
        }

        // Function to close all popups
        function closeAllPopups() {
            document.querySelectorAll('.popup-window').forEach(popup => {
                popup.style.display = "none";
            });
        }
    </script>
    {{-- Script for MathJax --}}
    <script>
        // Konfigurasi MathJax (sesuaikan jika perlu)
        window.MathJax = {
            tex: {
                inlineMath: [['$', '$'], ['\\(', '\\)']], // Untuk rumus inline seperti $x^2$
                displayMath: [['$$', '$$'], ['\\[', '\\]']], // Untuk rumus blok seperti $$E=mc^2$$
                processEscapes: true, // Memungkinkan \$ untuk menampilkan tanda dolar literal
                tags: "ams" // Untuk penomoran persamaan (opsional)
            },
            options: {
                ignoreHtmlClass: "tex2jax_ignore", // Kelas yang diabaikan untuk pemrosesan matematika
                processHtmlClass: "tex2jax_process" // Kelas yang secara spesifik diproses untuk matematika
            },
            loader: {
                load: ['[tex]/ams'] // Memuat ekstensi AMS math
            }
        };
    </script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</x-layout>