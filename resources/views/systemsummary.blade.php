<x-layout>
    <x-slot:title>System Performance Summary - Input Mode</x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* Styling for readonly inputs (general, not for S/N or Link Margin values specifically) */
        input[readonly]:not(.sn-value-input) { /* Apply to all readonly EXCEPT S/N and Link Margin values and other new green values */
            background-color: #e6f4e1; /* Lighter green from Transmitter */
            color: #166534; /* Darker green text from Transmitter */
            border-color: #81c784; /* Green border from Transmitter */
            cursor: not-allowed;
            font-weight: 500;
        }

        /* Styling for editable inputs (default for most fields) */
        input[type="number"]:not(.sn-value-input),
        input[type="text"]:not(.sn-value-input) {
            background-color: #f0fdf4; /* Light green for editable inputs */
            color: #1f2937; /* Darker text */
            border: 1px solid #d1d5db; /* gray-300 from Tailwind form defaults */
            padding: 0.75rem; /* Consistent padding */
            border-radius: 0.5rem; /* Rounded corners */
            width: 100%;
            box-sizing: border-box;
            text-align: left; /* Default text alignment for most inputs - RATA KIRI */
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* subtle shadow */
            transition: all 0.15s ease-in-out;
            height: 48px; /* Consistent height */
        }

        /* Ensure input focus styles are prominent for all inputs */
        input[type="number"]:focus,
        input[type="text"]:focus {
            outline: none;
            border-color: #3B82F6; /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* blue-500 with opacity */
        }

        /* Adjust labels for full visibility when not in sections */
        .form-section-label {
            display: block;
            font-weight: bold;
            color: #1F2937; /* gray-800 */
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #E5E7EB; /* gray-200 */
        }

        /* Popup Styles (Copied from Transmitter) */
        .popup-window {
            display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.7); z-index: 1000;
            justify-content: center; align-items: center;
        }
        .popup-content {
            position: relative; background-color: white; border-radius: 8px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 80%; max-width: 600px; max-height: 80vh;
            display: flex; flex-direction: column; animation: fadeInScale 0.3s ease-out;
        }
        .popup-header {
            padding: 20px 30px 10px; border-bottom: 1px solid #eee; position: relative; flex-shrink: 0;
        }
        .popup-header h3 { margin-top: 0; color: #2c3e50; padding-bottom: 0; }
        .close-popup-btn {
            position: absolute; top: 15px; right: 15px; font-size: 1.5rem; font-weight: bold;
            color: #555; cursor: pointer; transition: color 0.2s ease; z-index: 1001;
            background-color: white; border-radius: 50%; width: 30px; height: 30px;
            display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .close-popup-btn:hover { color: #000; }
        .popup-body {
            padding: 20px 30px 30px; overflow-y: auto; flex-grow: 1;
        }
        .formula {
            background-color: #f5f5f5; padding: 10px 15px; border-radius: 5px; border-left: 4px solid #4CAF50;
            margin: 15px 0; font-family: 'Cambria Math', 'Times New Roman', serif;
        }
        .popup-content p { margin: 8px 0; line-height: 1.5; color: #374151; }
        @keyframes fadeInScale { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }

        /* General form row styling */
        .form-row {
            display: flex; flex-wrap: wrap; gap: 1rem; margin-bottom: 1rem; align-items: center;
        }
        .form-row > div { flex: 1; min-width: 250px; }
        .form-row label {
            margin-bottom: 0.5rem; font-weight: 500; color: #374151;
            display: flex; align-items: center; gap: 0.5rem;
        }

        /* Input with Unit Wrapper (for general inputs like Frequency) */
        .input-with-unit-wrapper {
            display: flex; align-items: center; gap: 0.5rem;
        }
        .input-with-unit-wrapper .unit-text {
            color: #4B5563; font-size: 0.875rem; font-weight: 500; min-width: 40px; text-align: left;
        }

        /* Section heading styles */
        .section-heading {
            background-color: #e0f2fe; color: #0c4a6e; font-weight: 700; padding: 0.75rem;
            border: 1px solid #bfdbfe; margin-top: 1.5rem; margin-bottom: 1rem;
            text-align: center; border-radius: 0.5rem;
        }

        /* Content block (image + form) */
        .content-block {
            display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem;
            align-items: flex-start; background-color: #eff6ff; padding: 1.5rem;
            border-radius: 0.75rem; border: 1px solid #bfdbfe;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        .content-block .image-container {
            flex: 1; min-width: 300px; text-align: center; padding: 0; border: none; background-color: transparent;
        }
        .content-block .image-container img {
            max-width: 100%; height: auto; display: block; margin: 0 auto; border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .content-block .form-container {
            flex: 2; min-width: 400px; overflow-x: auto;
        }

        /* --- SPECIFIC STYLES FOR S/N AND LINK MARGIN SECTIONS AND NEW GREEN FIELDS --- */
        .sn-link-margin-container {
            display: flex; /* Make S/N and Link Margin blocks side-by-side */
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
            gap: 2rem; /* Gap between the two main blocks */
            margin-bottom: 1rem; /* Space below this whole row */
            align-items: flex-start; /* Align contents to top */
            width: 100%; /* Take full width of parent */
        }

        .sn-link-margin-item {
            flex: 1; /* Each item takes equal space */
            min-width: 250px; /* Minimum width before wrapping */
            display: flex;
            flex-direction: column; /* Label on top, then value block, then detail row */
        }

        .sn-link-margin-item label {
            margin-bottom: 0.25rem; /* Closer to the value box */
            font-size: 1rem; /* Ensure readable label size */
            font-weight: 500;
        }

        /* Wrapper for the green input box and its external dB unit */
        .green-input-with-unit {
            display: flex;
            align-items: center;
            gap: 0.5rem; /* Space between input box and external dB */
            width: 100%; /* Make this wrapper take full width */
        }

        /* The actual green input box (the visual element) */
        .sn-value-box { /* Apply to SN, Link Margin, and other calculated values */
            display: flex;
            align-items: center;
            background-color: #e6f4e1; /* Green background as requested */
            border: 1px solid #81c784; /* Green border as requested */
            border-radius: 0.5rem;
            padding: 0.75rem; /* Padding inside the green box */
            height: 48px; /* Consistent height */
            font-weight: bold; /* Make text bold */
            color: #1f2937; /* Dark text for values */
            box-sizing: border-box;
            flex-grow: 1; /* Allow the box to grow */
            min-width: 100px; /* Minimum width for the box */
        }

        /* Input field inside the green box */
        /* These inputs are transparent and inherit styles from their green parent box */
        .sn-value-input {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            height: auto !important;
            text-align: left !important;
            color: inherit !important;
            font-weight: inherit !important;
            width: auto;
            flex-grow: 1;
        }
        
        .sn-value-input[readonly] {
            cursor: not-allowed; /* Change cursor for readonly green boxes */
        }

        /* dB unit text that is OUTSIDE the green box */
        .outside-unit-text {
            color: #1f2937; /* Darker text */
            font-size: 0.875rem; /* text-sm */
            font-weight: 500; /* Medium font weight */
            white-space: nowrap; /* Prevent "dB" from wrapping */
            flex-shrink: 0; /* Prevent from shrinking */
        }

        /* Detail button and status alignment for S/N and Link Margin */
        .detail-status-row {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Space out status and button */
            margin-top: 0.5rem; /* Space below the green box */
            width: 100%; /* Take full width of parent column */
        }

        /* Link Status Text Styling (MARGINAL LINK, NO LINK!, LINK CLOSES) */
        .link-status-text {
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            white-space: nowrap; /* Prevent text from wrapping */
            text-transform: uppercase;
        }
        .link-closes { color: #10b981; background-color: #ecfdf5; } /* Emerald */
        .marginal-link { color: #f59e0b; background-color: #fffbeb; } /* Amber */
        .no-link { color: #dc2626; background-color: #fef2f2; } /* Red */

        /* Responsive adjustments */
        @media (max-width: 900px) { /* Tablet & smaller */
            .content-block { flex-direction: column; align-items: center; padding: 1rem; }
            .content-block .image-container, .content-block .form-container { width: 100%; min-width: unset; }
            
            .form-row { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .form-row > div { width: 100%; min-width: unset; }

            .sn-link-margin-container { flex-direction: column; align-items: flex-start; gap: 1rem; } /* Stack S/N and Link Margin */
            .sn-link-margin-item { width: 100%; min-width: unset; }

            .green-input-with-unit { flex-wrap: wrap; } /* Allow input box and dB to wrap if needed */
            .sn-value-box { flex-grow: 1; } /* Ensure green boxes fill width */
            .outside-unit-text { width: 100%; text-align: left; margin-top: 0.25rem; } /* Stack dB below if wrapped */
            
            .detail-status-row { justify-content: space-between; } /* Maintain button/status separation */
        }

        @media (max-width: 767px) { /* Mobile */
            .px-4.sm\:px-6.lg\:px-8 { padding-left: 1rem; padding-right: 1rem; }
            .max-w-5xl { max-width: 100%; }
            .text-3xl.sm\:text-4xl { font-size: 2rem; }
            .text-lg { font-size: 1rem; }
            .detail-status-row { flex-direction: column; align-items: flex-start; gap: 0.25rem; } /* Stack button and status on small phones */
            .outside-unit-text { margin-top: 0.5rem; } /* More space if stacked on tiny screens */
        }

        /* Styling for the summary explanation popup content (copied from transmitter-explanation) */
        .summary-explanation {
            font-family: 'Inter', sans-serif;
            line-height: 1.8;
            color: #4A5568;
        }
        .summary-explanation .section {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #E2E8F0;
        }
        .summary-explanation .section:last-child {
            border-bottom: none;
        }
        .summary-explanation .section-title {
            color: #2C5282;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            border-left: 5px solid #4299E1;
            padding-left: 1rem;
        }
        .summary-explanation .section-content {
            text-align: justify;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }
        .summary-explanation .param-title {
            color: #2D3748;
            font-size: 1rem;
            font-weight: 600;
            margin: 1.25rem 0 0.5rem 0;
        }
        .summary-explanation .param-list {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1rem;
            padding-left: 0.5rem;
        }
        .summary-explanation .param-list li {
            margin-bottom: 0.4rem;
            line-height: 1.6;
        }
    </style>

    <div class="container mx-auto px-4 py-8">
        <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-5xl transform transition-all duration-300 hover:shadow-3xl border-t-8 border-blue-600">
                <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                    <i class="text-blue-600"></i> Input Data Ringkasan Kinerja Sistem
                </h1>
                <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                    Masukkan atau ubah parameter Link Budget untuk Uplink dan Downlink.
                </p>

                <div class="mb-6 text-right animate__animated animate__fadeInUp">
                    <button type="button" id="info_summary_general_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">
                        Apa itu Ringkasan Kinerja Sistem? <i class="fas fa-info-circle ml-1"></i>
                    </button>
                </div>

                <form action="{{ route('animasi.show', $dataId) }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->id() ?? 1}}">
                  

                    <div class="system-summary">
                        <div class="section-heading">
                            UPLINK SYSTEM
                        </div>
                        <div class="content-block">
                            <div class="image-container">
                                <img src="{{ asset('img/uplinksummary.png') }}" alt="Blok Diagram Uplink">
                            </div>
                            <div class="form-container">
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_frequency">Frequency:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.01" name="uplink_frequency" value="{{ number_format($data->frekuensi ?? 0, 2, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">MHz</span>
                                        </div>
                                        <button type="button" id="freq_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div></div> {{-- Empty div to maintain 2-column layout in this row --}}
                                </div>
                                <div class="sn-link-margin-container"> {{-- Main container for S/N and Link Margin side-by-side --}}
                                    <div class="sn-link-margin-item">
                                        <label for="uplink_sn_value">S/N Method:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_sn_value" id="uplink_sn_value" class="sn-value-input" value="{{ number_format($data->snrratio_up ?? 0, 1, '.', '') }}" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <div class="detail-status-row">
                                            <button type="button" id="sn_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                        </div>
                                    </div>
                                    <div class="sn-link-margin-item">
                                        <label for="uplink_sn_link_margin">Link Margin:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_sn_link_margin" id="uplink_sn_link_margin" class="sn-value-input" value="{{ number_format($data->linkmargin_up ?? 0, 1, '.', '') }}" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <div class="detail-status-row">
                                            <span id="uplink_sn_link_status" class="link-status-text"></span>
                                            <button type="button" id="linkmargin_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_brbpf">BRbpf (Used Only in S/N Calc.):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="1" name="uplink_brbpf" value="{{ number_format($data->scbandwidth_up ?? 0, 0, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">Hz</span>
                                        </div>
                                        <button type="button" id="brbpf_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_g_t">G/T:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_g_t" value="{{ number_format($data->scgtratio_up ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB/K</span>
                                        </div>
                                        <button type="button" id="gt_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_tsys">Tsys:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_tsys" value="{{ number_format($data->scnoisetemp_up ?? 0, 0, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">K</span>
                                        </div>
                                        <button type="button" id="tsys_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_t2nd_amp">T2nd Amp:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="1" name="uplink_t2nd_amp" value="{{ number_format($data->two_nd_stage_temp_uprec ?? 0, 0, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">K</span>
                                        </div>
                                        <button type="button" id="t2nd_amp_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_glna">GLNA:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_glna" value="{{ number_format($data->lnagain_uprec ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="glna_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_tlna">TLNA:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="1" name="uplink_tlna" value="{{ number_format($data->tlna_uprec ?? 0, 0, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">K</span>
                                        </div>
                                        <button type="button" id="tlna_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_ltotal_line">Ltotal line:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_ltotal_line" value="{{ number_format($data->antenna_to_lna_uprec ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="ltotalline_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_la">Line A (LA):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_la" value="{{ number_format($data->la_uprec ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="la_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_lrbpf">LRbpf:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_lrbpf" value="{{ number_format($data->lbpf_uprec ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="lrbpf_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_lb">Line B (LB):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_lb" value="{{ number_format($data->lb_uprec ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="lb_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_ltother">LTother:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_ltother" value="{{ number_format($data->lother_uprec ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="ltother_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_lc">Line C (LC):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_lc" value="{{ number_format($data->lc_uprec ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="lc_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                {{-- REMOVED: Other In-Line Device Type field (Uplink) --}}

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_receive_antenna_gr">Receive Antenna GR:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_receive_antenna_gr" value="{{ number_format($data->scantennagain_up ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="rx_ant_gr_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_receive_antenna_polarization">Receive Antenna Polarization:</label>
                                        <div class="sn-value-box"> {{-- Added sn-value-box --}}
                                            <input type="text" name="uplink_receive_antenna_polarization" value="{{ $data->jenis_polarizationgrounds_up ?? '' }}" class="sn-value-input" readonly>
                                        </div>
                                        <button type="button" id="rx_ant_polar_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_lp">Lp:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_lp" value="{{ number_format($data->pathlosss_up ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="lp_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_total_link_losses">Total Link Losses:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_total_link_losses"
                                                     value="{{ number_format( ($data->gspointingloss_up ?? 0) + ($data->polarizationlosses_up ?? 0) + ($data->pathlosss_up ?? 0) + ($data->atmosphericlosses_up ?? 0) + ($data->ionosphericlosses_up ?? 0) + ($data->rainlosses_up ?? 0) + ($data->scpointingloss_up ?? 0), 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="total_link_losses_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_eirpgs">EIRPgs:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_eirpgs" value="{{ number_format($data->eirp_up ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="eirpgs_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_gt_tx_antenna">GT (Transmit Antenna):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_gt_tx_antenna" value="{{ number_format($data->antennaagain_up ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="gt_tx_antenna_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_tx_antenna_polarization">Transmit Antenna Polarization:</label>
                                        <div class="sn-value-box"> {{-- Added sn-value-box --}}
                                            <input type="text" name="uplink_tx_antenna_polarization" value="{{ $data->jenis_polarizationgrounds_up ?? '' }}" class="sn-value-input" readonly>
                                        </div>
                                        <button type="button" id="tx_ant_polar_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_tx_ltotal_line">Transmit Antenna Ltotal line:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_tx_ltotal_line" value="{{ number_format($data->totlinelosses_up ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="tx_ltotalline_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_tx_lc">Line C (TX):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.01" name="uplink_tx_lc" value="{{ number_format(($data->guideloss_up ?? 0) * ($data->clength_up ?? 0), 2, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="tx_lc_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_tx_ltother">LTother (TX):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_tx_ltother" value="{{ number_format($data->devicee_up ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="tx_ltother_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                {{-- New: Other In-Line Losses --}}
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_other_losses">Other In-Line Losses (dB):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_other_losses" id="uplink_other_losses" value="{{ number_format(($data->atn_up ?? 0) + ($data->filter_up ?? 0) + (($data->connect_up ?? 0) * 0.05), 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="other_losses_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div></div> {{-- Empty div for alignment --}}
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_tx_lb">Line B (TX):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="uplink_tx_lb" value="{{ number_format(($data->guideloss_up ?? 0) * ($data->blength_up ?? 0), 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="tx_lb_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_ltbpf">LTbpf:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_ltbpf" value="{{ number_format($data->filter_up ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="ltbpf_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="uplink_tx_la">Line A (TX):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.01" name="uplink_tx_la" value="{{ number_format(($data->guideloss_up ?? 0) * ($data->alength_up ?? 0), 2, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="tx_la_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="uplink_ptx">PTx (Transmit Power):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="uplink_ptx" value="{{ number_format($data->watt_up ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="ptx_uplink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-heading">
                            DOWNLINK SYSTEM
                        </div>
                        <div class="content-block">
                            <div class="image-container">
                                <img src="{{ asset('img/downlinksummary.png') }}" alt="Blok Diagram Downlink">
                            </div>
                            <div class="form-container">
                                {{-- START REORDERED DOWNLINK FIELDS --}}

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_frequency">Frequency:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.01" name="downlink_frequency" id="frekuensi_downlink" value="{{ number_format($data->frekuensi_downlink ?? 0, 2, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">MHz</span>
                                        </div>
                                        <button type="button" id="freq_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div></div> {{-- Empty div for alignment --}}
                                </div>

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_htx">ηTx (hTx) (%):</label>
                                        <div class="input-with-unit-wrapper">
                                            <input type="number" step="0.1" name="downlink_htx" value="{{ number_format($data->effi_down ?? 0, 1, '.', '') }}" readonly>
                                            <span class="unit-text">%</span>
                                        </div>
                                        <button type="button" id="htx_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_tx_dc_pwr">Tx DC Pwr:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_tx_dc_pwr" id="downlink_tx_dc_pwr" class="sn-value-input" value="{{ number_format(($data->watt_down + $data->filter_down) ?? 0, 1, '.', '') }}" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="tx_dc_pwr_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_tx_dissipation">Tx Dissipation:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_tx_dissipation" id="downlink_tx_dissipation" class="sn-value-input" value="{{ number_format(($data->watt_down + $data->filter_down) - $data->watt_down ?? 0, 1, '.', '') }}" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="tx_dissipation_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_ptx">PTx:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_ptx" value="{{ number_format($data->watt_down ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="ptx_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_la">Line A (LA):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.0001" name="downlink_la" value="{{ number_format($data->la_downrec ?? 0, 4, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="la_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_ltxbpf">LTXbpf:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_ltxbpf" value="{{ number_format($data->filter_down ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="ltxbpf_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_lb">Line B (LB):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.0001" name="downlink_lb" value="{{ number_format($data->lb_downrec ?? 0, 4, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="lb_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_ltother">LTother:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_ltother" value="{{ number_format($data->devicee_down ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="ltother_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                
                                {{-- New: Device Name and Device Loss --}}
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_device_name">Device Name:</label>
                                        <div class="sn-value-box"> {{-- Added sn-value-box --}}
                                            <input type="text" name="downlink_device_name" id="downlink_device_name" value="{{ $data->device_down_name ?? '' }}" class="sn-value-input" readonly>
                                        </div>
                                        <button type="button" id="device_name_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_device_loss">Device Loss (dB):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_device_loss" id="downlink_device_loss" value="{{ number_format($data->devicee_down ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="device_loss_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_lc">Line C (LC):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="downlink_lc" value="{{ number_format($data->lc_downrec ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="lc_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_ltotal_line">Ltotal line:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="downlink_ltotal_line" value="{{ number_format($data->antenna_to_lna_downrec ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="ltotalline_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_tx_antenna_gt">GT (Transmit Antenna):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_tx_antenna_gt" value="{{ number_format($data->scantennagain_down ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="gt_tx_antenna_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_tx_antenna_polarization">Transmit Antenna Polarization:</label>
                                        <div class="sn-value-box"> {{-- Added sn-value-box --}}
                                            <input type="text" name="downlink_tx_antenna_polarization" value="{{ $data->jenis_polarizationspacecraft_down ?? '' }}" class="sn-value-input" readonly>
                                        </div>
                                        <button type="button" id="tx_ant_polar_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_eirpsc">EIRPS/C:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="downlink_eirpsc" value="{{ number_format($data->sceirp_down ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="eirpsc_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_total_link_losses">Total Link Losses:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="downlink_total_link_losses"
                                                     value="{{ number_format( ($data->gspointingloss_down ?? 0) + ($data->polarizationlosses_down ?? 0) + ($data->pathlosss_down ?? 0) + ($data->atmosphericlosses_down ?? 0) + ($data->ionosphericlosses_down ?? 0) + ($data->rainlosses_down ?? 0) + ($data->scpointingloss_down ?? 0), 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="total_link_losses_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_lp">LP:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="downlink_lp" value="{{ number_format($data->pathlosss_down ?? 0, 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="lp_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_gr">GR:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_gr" value="{{ number_format($data->scantennaagain_down ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="gr_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_rx_antenna_polarization">Receive Antenna Polarization:</label>
                                        <div class="sn-value-box"> {{-- Added sn-value-box --}}
                                            <input type="text" name="downlink_rx_antenna_polarization" value="{{ $data->jenis_polarizationgrounds_down ?? '' }}" class="sn-value-input" readonly>
                                        </div>
                                        <button type="button" id="rx_ant_polar_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_rx_lc">Line C (RX):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.0001" name="downlink_rx_lc" value="{{ number_format(($data->guideloss_down ?? 0) * ($data->clength_down ?? 0), 4, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="rx_lc_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_lrother">LRother:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_lrother" value="{{ number_format($data->lrother_down ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="lrother_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_rx_lb">Line B (RX):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.0001" name="downlink_rx_lb" value="{{ number_format(($data->blength_down ?? 0) * ($data->guideloss_down ?? 0), 4, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="rx_lb_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>

                                {{-- REMOVED: Other In-Line Device Type field (Downlink) --}}

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_lrbpf">LRbpf:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_lrbpf" value="{{ number_format($data->filter_down ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="lrbpf_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_rx_la">Line A (RX):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="downlink_rx_la" value="{{ number_format(($data->guideloss_down ?? 0) * ($data->alength_down ?? 0), 3, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="rx_la_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_ltotal">Ltotal:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.0001" name="downlink_ltotal" value="{{ number_format($data->ltotal_down ?? 0, 4, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="ltotal_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_tlna">TLNA:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="1" name="downlink_tlna" value="{{ number_format($data->tlna_downrec ?? 0, 0, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">K</span>
                                        </div>
                                        <button type="button" id="tlna_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_glna">GLNA:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.1" name="downlink_glna" value="{{ number_format($data->lnagain_downrec ?? 0, 1, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <button type="button" id="glna_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div class="relative">
                                        <label for="downlink_t2nd_amp">T2nd amp:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="1" name="downlink_t2nd_amp" value="{{ number_format($data->tcomrcvr_downrec ?? 0, 0, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">K</span>
                                        </div>
                                        <button type="button" id="t2nd_amp_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="relative">
                                        <label for="downlink_brbpf">BRbpf (Used only in S/N Calc.):</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="1" name="downlink_brbpf" value="{{ number_format($data->gsbandwidth_down ?? 0, 0, '.', '') }}" class="sn-value-input" readonly>
                                            </div>
                                            <span class="outside-unit-text">Hz</span>
                                        </div>
                                        <button type="button" id="brbpf_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 mt-2 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                    </div>
                                    <div></div> {{-- Empty div for alignment --}}
                                </div>

                                <div class="sn-link-margin-container"> {{-- S/N and Link Margin side-by-side --}}
                                    <div class="sn-link-margin-item">
                                        <label for="downlink_sn_value">S/N Method:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="downlink_sn_value" id="downlink_sn_value" class="sn-value-input" value="{{ number_format($data->snrratio_down ?? 0, 1, '.', '') }}" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <div class="detail-status-row">
                                            <button type="button" id="sn_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                        </div>
                                    </div>
                                    <div class="sn-link-margin-item">
                                        <label for="downlink_sn_link_margin">Link Margin:</label>
                                        <div class="green-input-with-unit">
                                            <div class="sn-value-box">
                                                <input type="number" step="0.001" name="downlink_sn_link_margin" id="downlink_sn_link_margin" class="sn-value-input" value="{{ number_format($data->linkmargin_down ?? 0, 1, '.', '') }}" readonly>
                                            </div>
                                            <span class="outside-unit-text">dB</span>
                                        </div>
                                        <div class="detail-status-row">
                                            <span id="downlink_sn_link_status" class="link-status-text"></span>
                                            <button type="button" id="linkmargin_downlink_popup_btn" class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors duration-200">Lihat Detail <i class="fas fa-info-circle ml-1"></i></button>
                                        </div>
                                    </div>
                                </div>
                                {{-- END REORDERED DOWNLINK FIELDS --}}
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-6">
                        <i class=""></i> Selesai & Lihat Visualisasi Perhitungan
                    </button>
                </form>

                <div class="flex justify-between mt-6">
                    <a href="/calc/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
                    </a>

                    {{-- Add a next page link if applicable --}}
                    {{-- <a href="/next-page/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                        Halaman Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Popup for general Summary explanation --}}
    <div id="popup_summary_general" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Tentang Halaman Input Ringkasan Kinerja Sistem</h3>
            </div>
            <div class="popup-body">
                <div class="summary-explanation">
                    <div class="section">
                        <h4 class="section-title">Ringkasan Kinerja Sistem</h4>
                        <p class="section-content">
                            Halaman ini menampilkan nilai-nilai kunci yang berkaitan dengan kinerja Link Budget untuk jalur **Uplink** (dari stasiun bumi ke satelit) dan **Downlink** (dari satelit ke stasiun bumi). Ini berfungsi sebagai antarmuka untuk melihat dan memahami hasil akhir dari perhitungan link komunikasi berdasarkan data yang Anda input sebelumnya.
                        </p>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Uplink System (Sistem Uplink)</h4>
                        <p class="section-content">
                            Bagian ini menyajikan parameter terkait kinerja transmisi dari stasiun bumi ke satelit. Setiap nilai adalah hasil perhitungan dari data yang Anda masukkan di halaman sebelumnya atau nilai standar sistem.
                        </p>
                        <p class="param-title">Parameter Utama yang Ditampilkan:</p>
                        <ul class="param-list">
                            <li><strong>Frequency:</strong> Frekuensi sinyal uplink yang digunakan.</li>
                            <li><strong>S/N Method:</strong> Rasio Sinyal terhadap Noise yang dihasilkan untuk uplink.</li>
                            <li><strong>Link Margin:</strong> Selisih antara S/N yang diterima dan S/N minimum yang dibutuhkan. Indikator kesehatan link.</li>
                            <li><strong>BRbpf:</strong> Bandwidth noise pada Bandpass Filter di sisi penerima uplink.</li>
                            <li><strong>G/T:</strong> Figure of Merit sistem penerima satelit untuk uplink.</li>
                            <li><strong>Tsys:</strong> Suhu noise sistem total penerima satelit untuk uplink.</li>
                            <li><strong>T2nd Amp:</strong> Suhu noise amplifier kedua pada jalur penerima uplink.</li>
                            <li><strong>GLNA:</strong> Gain Low Noise Amplifier di sisi penerima uplink.</li>
                            <li><strong>TLNA:</strong> Suhu noise Low Noise Amplifier di sisi penerima uplink.</li>
                            <li><strong>Ltotal line:</strong> Total kehilangan daya pada jalur transmisi penerima satelit.</li>
                            <li><strong>Line A/B/C (LA/LB/LC):</strong> Kehilangan daya pada setiap segmen kabel/jalur transmisi penerima satelit.</li>
                            <li><strong>LTother:</strong> Kehilangan daya tambahan lainnya di jalur transmisi penerima satelit.</li>
                            <li>**Receive Antenna GR:** Gain antena penerima di satelit.</li>
                            <li>**Receive Antenna Polarization:** Polarisasi antena penerima di satelit.</li>
                            <li>**Lp:** Kehilangan daya propagasi untuk jalur uplink.</li>
                            <li>**Total Link Losses:** Total kerugian pada keseluruhan link uplink.</li>
                            <li>**EIRPgs:** Effective Isotropic Radiated Power dari stasiun bumi.</li>
                            <li>**GT (Transmit Antenna):** Gain antena pemancar di stasiun bumi.</li>
                            <li>**Transmit Antenna Polarization:** Polarisasi antena pemancar di stasiun bumi.</li>
                            <li>**Transmit Antenna Ltotal line:** Total kehilangan daya pada jalur transmisi pemancar di stasiun bumi.</li>
                            <li>**Other In-Line Losses:** Kehilangan daya tambahan lainnya di jalur pemancar (gabungan Antenna Mismatch Losses, Filter Insertion Losses, dan Total Connector Loss).</li>
                            <li>**PTx (Transmit Power):** Daya output pemancar di stasiun bumi.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Downlink System (Sistem Downlink)</h4>
                        <p class="section-content">
                            Bagian ini menampilkan parameter terkait kinerja transmisi dari satelit ke stasiun bumi. Semua nilai adalah hasil perhitungan berdasarkan data yang Anda berikan.
                        </p>
                        <p class="param-title">Parameter Utama yang Ditampilkan:</p>
                        <ul class="param-list">
                            <li>**Frequency:** Frekuensi sinyal downlink yang digunakan.</li>
                            <li>**ηTx (hTx):** Efisiensi transfer daya pemancar satelit.</li>
                            <li>**Tx DC Pwr:** Daya DC yang dikonsumsi pemancar satelit.</li>
                            <li>**Tx Dissipation:** Daya disipasi panas pada pemancar satelit.</li>
                            <li>**PTx:** Daya output pemancar satelit.</li>
                            <li>**Line A (LA):** Kehilangan daya pada segmen kabel/jalur transmisi pemancar satelit.</li>
                            <li>**LTXbpf:** Kehilangan daya pada filter bandpass pemancar satelit.</li>
                            <li>**Line B (LB):** Kehilangan daya pada segmen kabel/jalur transmisi pemancar satelit.</li>
                            <li>**LTother:** Kehilangan daya tambahan lainnya di jalur pemancar satelit.</li>
                            <li>**Device Name:** Nama perangkat inline pada jalur transmisi satelit (misal: Diplexer, Isolator).</li>
                            <li>**Device Loss (dB):** Kehilangan daya yang disebabkan oleh perangkat in-line tersebut.</li>
                            <li>**Line C (LC):** Kehilangan daya pada segmen kabel/jalur transmisi pemancar satelit.</li>
                            <li>**Ltotal line:** Total kehilangan daya pada jalur transmisi pemancar satelit.</li>
                            <li>**GT (Transmit Antenna):** Gain antena pemancar di satelit.</li>
                            <li>**Transmit Antenna Polarization:** Polarisasi antena pemancar di satelit.</li>
                            <li>**EIRPS/C:** Effective Isotropic Radiated Power dari satelit.</li>
                            <li>**Total Link Losses:** Total kerugian pada keseluruhan link downlink.</li>
                            <li>**LP:** Kehilangan daya propagasi untuk jalur downlink.</li>
                            <li>**GR:** Gain antena penerima di stasiun bumi.</li>
                            <li>**Receive Antenna Polarization:** Polarisasi antena penerima di stasiun bumi.</li>
                            <li>**Line C (RX):** Kehilangan daya pada segmen kabel/jalur transmisi penerima stasiun bumi.</li>
                            <li>**LRother:** Kehilangan daya tambahan lainnya di jalur penerima stasiun bumi.</li>
                            <li>**Line B (RX):** Kehilangan daya pada segmen kabel/jalur transmisi penerima stasiun bumi.</li>
                            <li>**LRbpf:** Kehilangan daya pada filter bandpass penerima stasiun bumi.</li>
                            <li>**Line A (RX):** Kehilangan daya pada segmen kabel/jalur transmisi penerima stasiun bumi.</li>
                            <li>**Ltotal:** Total kerugian di sisi penerima stasiun bumi.</li>
                            <li>**TLNA:** Suhu noise Low Noise Amplifier di sisi penerima stasiun bumi.</li>
                            <li>**GLNA:** Gain Low Noise Amplifier di sisi penerima stasiun bumi.</li>
                            <li>**T2nd amp:** Suhu noise amplifier kedua pada jalur penerima stasiun bumi.</li>
                            <li>**BRbpf:** Bandwidth noise pada Bandpass Filter di sisi penerima stasiun bumi.</li>
                            <li>**S/N Method:** Rasio Sinyal terhadap Noise yang dihasilkan untuk downlink.</li>
                            <li>**Link Margin:** Selisih antara S/N yang diterima dan S/N minimum yang dibutuhkan untuk downlink.</li>
                        </ul>
                    </div>

                    <div class="section">
                        <h4 class="section-title">Catatan Penggunaan</h4>
                        <p class="section-content">
                            Setiap nilai yang ditampilkan di halaman ini adalah hasil dari perhitungan Link Budget berdasarkan input yang Anda berikan di halaman-halaman sebelumnya. Klik tombol "Lihat Detail" di samping setiap kolom untuk melihat rumus perhitungan dan penjelasan lebih lanjut mengenai nilai tersebut. Ini akan membantu Anda memahami bagaimana setiap parameter memengaruhi kinerja keseluruhan sistem komunikasi Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Popups for detailed explanations of Readonly Fields --}}

    {{-- Uplink Popups --}}
    <div id="popup_freq_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Uplink Frequency</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai Frekuensi Uplink ($frekuensi$) diambil dari input "Frekuensi Uplink" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Frekuensi Uplink** adalah frekuensi sinyal yang digunakan untuk transmisi dari stasiun bumi ke satelit. Ini adalah parameter dasar yang mempengaruhi perhitungan path loss dan desain antena.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_sn_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail S/N Method (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan S/N Ratio:</strong><br>
                        $$S/N = EIRP_{gs} + G/T_{sc} - L_{total} - k - BR_{bpf}$$
                        Dimana:<br>
                        **S/N** = Signal-to-Noise Ratio (dB)<br>
                        **EIRP_gs** = Effective Isotropic Radiated Power dari Ground Station (dBW)<br>
                        **G/T_sc** = Gain-to-Noise Temperature Ratio Satelit (dB/K)<br>
                        **L_total** = Total Link Losses Uplink (dB)<br>
                        **k** = Konstanta Boltzmann ($1.38 \times 10^{-23}$ J/K atau -228.6 dBW/K/Hz)<br>
                        **BR_bpf** = Bandwidth Noise Bandpass Filter (Hz)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **S/N (Signal-to-Noise) Ratio** mengukur kekuatan sinyal relatif terhadap noise. Nilai ini sangat penting untuk menentukan kualitas link komunikasi. Semakin tinggi S/N, semakin baik kualitas sinyal yang diterima. Perhitungan ini mempertimbangkan daya pancar, karakteristik penerima satelit, dan semua kerugian di jalur transmisi.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_linkmargin_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Link Margin (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$Link\ Margin = S/N_{received} - S/N_{required}$$
                        Dimana:<br>
                        **S/N_received** = S/N Ratio yang diterima (dB)<br>
                        **S/N_required** = S/N Ratio yang dibutuhkan (misal: 14.4 dB untuk Uplink)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Link Margin** adalah selisih antara S/N yang diterima dengan S/N minimum yang diperlukan agar komunikasi dapat berjalan dengan baik. Nilai positif menunjukkan bahwa link memiliki cadangan daya yang cukup untuk mengatasi fading atau kondisi link yang memburuk. Status "LINK CLOSES", "MARGINAL LINK", atau "NO LINK !" menunjukkan kondisi link berdasarkan margin ini.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_brbpf_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail BRbpf (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **BRbpf** ($scbandwidth\_up$) diambil dari input "Bandwidth pada Ground Station (Uplink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **BRbpf** (Bandwidth Noise pada Bandpass Filter) adalah lebar pita frekuensi di mana noise diukur pada sisi penerima. Ini secara langsung mempengaruhi jumlah noise yang diterima dan, oleh karena itu, S/N Ratio. Nilai ini digunakan dalam perhitungan S/N untuk mengkarakterisasi noise termal.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_gt_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail G/T (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **G/T** ($scgtratio\_up$) diambil dari input "Ground Station G/T (Uplink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **G/T** (Gain-to-Noise Temperature Ratio) adalah ukuran kinerja stasiun bumi atau satelit penerima. Ini adalah rasio antara gain antena (**G**) dan suhu noise sistem (**T_sys**). Semakin tinggi nilai G/T, semakin baik sensitivitas penerima.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tsys_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Tsys (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Tsys** ($scnoisetemp\_up$) diambil dari input "Noise Temp. Receiver (Uplink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Tsys** (System Noise Temperature) adalah total suhu noise yang dihasilkan oleh semua komponen dalam sistem penerima. Suhu noise ini berkontribusi terhadap noise termal yang mengganggu sinyal. Semakin rendah Tsys, semakin baik kinerja sistem penerima.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_t2nd_amp_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail T2nd Amp (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **T2nd Amp** ($two\_nd\_stage\_temp\_uprec$) diambil dari input "Suhu Noise Amplifier Kedua (Uplink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **T2nd Amp** (Temperature of the Second Amplifier) adalah suhu noise yang dihasilkan oleh amplifier kedua dalam rantai penerima. Ini adalah salah satu komponen yang berkontribusi pada total suhu noise sistem (Tsys).</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_glna_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail GLNA (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **GLNA** ($lnagain\_uprec$) diambil dari input "Gain LNA (Uplink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **GLNA** (Gain Low Noise Amplifier) adalah penguatan sinyal yang diberikan oleh Low Noise Amplifier. LNA diposisikan dekat dengan antena penerima untuk memperkuat sinyal yang lemah sambil meminimalkan penambahan noise.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tlna_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail TLNA (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **TLNA** ($tlna\_uprec$) diambil dari input "Suhu LNA (Uplink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **TLNA** (Temperature of Low Noise Amplifier) adalah suhu noise yang dihasilkan oleh Low Noise Amplifier. Ini merupakan komponen kunci dalam perhitungan total suhu noise sistem (Tsys), karena LNA adalah tahap pertama yang menerima sinyal lemah dan noise yang ditambahkan pada tahap ini sangat signifikan.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_ltotalline_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Ltotal line (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Ltotal line** ($antenna\_to\_lna\_uprec$) diambil dari input "Line Loss Rx (Antenna to LNA)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Ltotal line** adalah total kehilangan daya pada jalur transmisi antara antena penerima dan Low Noise Amplifier (LNA). Ini mencakup kehilangan pada kabel, konektor, dan komponen pasif lainnya di jalur tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_la_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line A (LA) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Line A (LA)** ($la\_uprec$) diambil dari input "Line A (Uplink Receiver)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line A (LA)** adalah kehilangan daya yang terjadi pada segmen pertama kabel atau waveguide di jalur penerima uplink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_lrbpf_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail LRbpf (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **LRbpf** ($lbpf\_uprec$) diambil dari input "BPF Loss Rec (Uplink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **LRbpf** (Loss of Receive Bandpass Filter) adalah kehilangan daya yang terjadi saat sinyal melewati filter bandpass pada sisi penerima uplink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_lb_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line B (LB) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Line B (LB)** ($lb\_uprec$) diambil dari input "Line B (Uplink Receiver)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line B (LB)** adalah kehilangan daya yang terjadi pada segmen kedua kabel atau waveguide di jalur penerima uplink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_ltother_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail LTother (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **LTother** ($lother\_uprec$) diambil dari input "Loss Other Components (Uplink Receiver)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **LTother** (Loss of Other Components) adalah kehilangan daya tambahan yang disebabkan oleh komponen lain di jalur penerima uplink, selain kabel, konektor, dan filter bandpass.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_lc_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line C (LC) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Line C (LC)** ($lc\_uprec$) diambil dari input "Line C (Uplink Receiver)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line C (LC)** adalah kehilangan daya yang terjadi pada segmen ketiga kabel atau waveguide di jalur penerima uplink.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- The 'Other In-Line Device Type' popup is removed as the field itself is removed.
         If you later re-add this field and need a popup for it, remember to re-create it. --}}

    <div id="popup_rx_ant_gr_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Receive Antenna GR (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Receive Antenna GR** ($scantennagain\_up$) diambil dari input "Gain Antena (Uplink Ground Station)" pada halaman "Antenna".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Receive Antenna GR** (Gain of Receive Antenna) adalah penguatan sinyal yang diberikan oleh antena penerima di satelit untuk jalur uplink. Ini adalah parameter kunci dalam menentukan seberapa efisien antena dapat menangkap sinyal yang dipancarkan.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_rx_ant_polar_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Receive Antenna Polarization (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Receive Antenna Polarization** ($jenis\_polarizationgrounds\_up$) diambil dari input "Jenis Polarisasi (Uplink Receiver)" pada halaman "Ground Station".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Polarisasi antena penerima** mengacu pada orientasi gelombang elektromagnetik yang dapat diterima oleh antena. Penting untuk dicocokkan dengan polarisasi antena pemancar untuk meminimalkan kerugian polarisasi.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_lp_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Lp (Path Loss) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Lp** ($pathlosss\_up$) diambil dari input "Path Loss (Uplink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Lp** (Path Loss) adalah kehilangan daya sinyal yang terjadi saat sinyal merambat melalui ruang bebas dari pemancar ke penerima. Ini adalah kerugian paling signifikan dalam Link Budget dan bergantung pada frekuensi serta jarak.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_total_link_losses_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Total Link Losses (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{total\_link} = L_{pointing\_gs} + L_{polarization} + L_{path} + L_{atmospheric} + L_{ionospheric} + L_{rain} + L_{pointing\_sc}$$
                        Dimana:<br>
                        **L_pointing_gs** = Ground Station Pointing Loss ($gspointingloss\_up$)<br>
                        **L_polarization** = Polarization Losses ($polarizationlosses\_up$)<br>
                        **L_path** = Path Loss ($pathlosss\_up$)<br>
                        **L_atmospheric** = Atmospheric Losses ($atmosphericlosses\_up$)<br>
                        **L_ionospheric** = Ionospheric Losses ($ionosphericlosses\_up$)<br>
                        **L_rain** = Rain Losses ($rainlosses\_up$)<br>
                        **L_pointing_sc** = Satellite Pointing Loss ($scpointingloss\_up$)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Total Link Losses** adalah penjumlahan dari semua kehilangan daya yang terjadi di sepanjang keseluruhan jalur uplink, dari pemancar stasiun bumi hingga penerima satelit. Ini mencakup path loss, kerugian atmosfer, kerugian polarisasi, dan kerugian penunjukan antena.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_eirpgs_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail EIRPgs (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **EIRPgs** ($eirp\_up$) diambil dari input "EIRP Ground Station (Uplink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **EIRPgs** (Effective Isotropic Radiated Power of Ground Station) adalah daya efektif yang dipancarkan oleh stasiun bumi ke segala arah secara isotropik (seragam). Ini memperhitungkan daya pemancar dan gain antena pengirim.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_gt_tx_antenna_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail GT (Transmit Antenna) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **GT (Transmit Antenna)** ($antennaagain\_up$) diambil dari input "Gain Antena (Uplink Transmit)" pada halaman "Antenna".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **GT (Gain of Transmit Antenna)** adalah penguatan sinyal yang diberikan oleh antena pemancar di stasiun bumi untuk jalur uplink. Ini adalah ukuran seberapa efektif antena mengarahkan daya ke arah yang diinginkan.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tx_ant_polar_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Transmit Antenna Polarization (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Transmit Antenna Polarization** ($jenis\_polarizationgrounds\_up$) diambil dari input "Jenis Polarisasi (Uplink Transmit)" pada halaman "Ground Station".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Polarisasi antena pemancar** mengacu pada orientasi gelombang elektromagnetik yang dipancarkan oleh antena. Pencocokan polarisasi antara antena pemancar dan penerima sangat penting untuk transmisi sinyal yang efisien.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tx_ltotalline_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Transmit Antenna Ltotal line (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{total\_line\_tx} = L_{cable\_tx} + L_{connector\_tx} + L_{filter\_tx} + L_{device\_tx} + L_{mismatch\_tx}$$
                        Dimana:<br>
                        **L_cable_tx** = Total Cable Loss Transmit ({{ number_format(($data->guideloss_up ?? 0) * (($data->alength_up ?? 0) + ($data->blength_up ?? 0) + ($data->clength_up ?? 0)), 3, '.', '') }} dB)<br>
                        **L_connector_tx** = Total Connector Loss Transmit ({{ number_format(($data->connect_up ?? 0) * 0.05, 3, '.', '') }} dB)<br>
                        **L_filter_tx** = Filter Insertion Losses Transmit ({{ number_format($data->filter_up ?? 0, 3, '.', '') }} dB)<br>
                        **L_device_tx** = Device Loss Transmit ({{ number_format($data->devicee_up ?? 0, 3, '.', '') }} dB)<br>
                        **L_mismatch_tx** = Antenna Mismatch Losses Transmit ({{ number_format($data->atn_up ?? 0, 3, '.', '') }} dB)<br><br>
                        Nilai-nilai ini diambil dari hasil perhitungan pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Transmit Antenna Ltotal line** adalah total kehilangan daya yang terjadi pada semua komponen antara output pemancar dan input antena di stasiun bumi untuk jalur uplink. Ini mencakup kabel, konektor, filter, perangkat in-line lainnya, dan kerugian ketidaksesuaian antena.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tx_lc_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line C (TX) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{C\_tx} = \text{Cable/Waveguide Loss (dB/m)} \times \text{Line C Length (m)}$$
                        Dimana:<br>
                        **Cable/Waveguide Loss** = {{ number_format($data->guideloss_up ?? 0, 3, '.', '') }} dB/m (dari Transmitter)<br>
                        **Line C Length** = {{ number_format($data->clength_up ?? 0, 3, '.', '') }} m (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line C (TX)** adalah kehilangan daya yang terjadi pada segmen ketiga kabel atau waveguide di jalur transmisi pemancar uplink. Nilai ini dihitung berdasarkan kehilangan per meter dari jenis kabel yang digunakan dan panjang segmen kabel tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tx_ltother_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail LTother (TX) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **LTother (TX)** ($devicee\_up$) diambil dari input "Device Loss (Uplink)" pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **LTother (TX)** adalah kehilangan daya tambahan yang disebabkan oleh perangkat lain (selain kabel, konektor, dan filter) yang terhubung pada jalur transmisi pemancar uplink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_other_losses_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Other In-Line Losses (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{other} = L_{mismatch} + L_{filter} + L_{connector}$$
                        Dimana:<br>
                        **L_mismatch** = Antenna Mismatch Losses ({{ number_format($data->atn_up ?? 0, 3, '.', '') }} dB)<br>
                        **L_filter** = Filter Insertion Losses ({{ number_format($data->filter_up ?? 0, 3, '.', '') }} dB)<br>
                        **L_connector** = Total Connector Loss ({{ number_format(($data->connect_up ?? 0) * 0.05, 3, '.', '') }} dB)<br><br>
                        Nilai-nilai ini diambil dari hasil perhitungan pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **"Other In-Line Losses"** adalah total kerugian daya yang berasal dari berbagai komponen pasif lainnya di jalur transmisi uplink, seperti kerugian ketidaksesuaian antena, kerugian penyisipan filter, dan kerugian konektor.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tx_lb_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line B (TX) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{B\_tx} = \text{Cable/Waveguide Loss (dB/m)} \times \text{Line B Length (m)}$$
                        Dimana:<br>
                        **Cable/Waveguide Loss** = {{ number_format($data->guideloss_up ?? 0, 3, '.', '') }} dB/m (dari Transmitter)<br>
                        **Line B Length** = {{ number_format($data->blength_up ?? 0, 3, '.', '') }} m (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line B (TX)** adalah kehilangan daya yang terjadi pada segmen kedua kabel atau waveguide di jalur transmisi pemancar uplink. Nilai ini dihitung berdasarkan kehilangan per meter dari jenis kabel yang digunakan dan panjang segmen kabel tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_ltbpf_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail LTbpf (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **LTbpf** ($filter\_up$) diambil dari input "Filter Insertion Losses (Uplink)" pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **LTbpf** (Loss of Transmit Bandpass Filter) adalah kehilangan daya yang terjadi saat sinyal melewati filter bandpass pada sisi pemancar uplink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tx_la_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line A (TX) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{A\_tx} = \text{Cable/Waveguide Loss (dB/m)} \times \text{Line A Length (m)}$$
                        Dimana:<br>
                        **Cable/Waveguide Loss** = {{ number_format($data->guideloss_up ?? 0, 3, '.', '') }} dB/m (dari Transmitter)<br>
                        **Line A Length** = {{ number_format($data->alength_up ?? 0, 3, '.', '') }} m (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line A (TX)** adalah kehilangan daya yang terjadi pada segmen pertama kabel atau waveguide di jalur transmisi pemancar uplink. Nilai ini dihitung berdasarkan kehilangan per meter dari jenis kabel yang digunakan dan panjang segmen kabel tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_ptx_uplink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail PTx (Transmit Power) (Uplink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **PTx** ($watt\_up$) diambil dari input "Transmitter Power (Watt)" yang dikonversi ke dB pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **PTx** (Transmit Power) adalah daya output yang dihasilkan oleh pemancar di stasiun bumi untuk jalur uplink, setelah dikurangi semua kehilangan internal pada pemancar itu sendiri.</p>
                </div>
            </div>
        </div>
    </div>


    {{-- Downlink Popups --}}
    <div id="popup_freq_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Downlink Frequency</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Frekuensi Downlink** ($frekuensi\_downlink$) diambil dari input "Frekuensi Downlink" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Frekuensi Downlink** adalah frekuensi sinyal yang digunakan untuk transmisi dari satelit ke stasiun bumi. Sama seperti uplink, ini adalah parameter dasar yang mempengaruhi perhitungan path loss dan desain antena.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_htx_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail ηTx (hTx) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **ηTx** ($effi\_down$) diambil dari input "Efisiensi Transmisi Satelit" pada halaman "Spacecraft".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **ηTx (hTx)** adalah efisiensi transfer daya dari pemancar di satelit. Ini mengindikasikan seberapa banyak daya DC yang diubah menjadi daya RF yang efektif.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tx_dc_pwr_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Tx DC Pwr (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{DC} = P_{Tx} + L_{Tx\_BPF}$$
                        Dimana:<br>
                        **P_Tx** = Transmitter Power ($watt\_down$) = {{ number_format($data->watt_down ?? 0, 1, '.', '') }} dB (dari Transmitter)<br>
                        **L_Tx_BPF** = LTXbpf ($filter\_down$) = {{ number_format($data->filter_down ?? 0, 1, '.', '') }} dB (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Tx DC Pwr** (Transmit DC Power) adalah total daya DC yang dikonsumsi oleh pemancar satelit untuk menghasilkan daya RF, termasuk kerugian pada filter bandpass pemancar.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tx_dissipation_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Tx Dissipation (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$P_{dissipation} = P_{DC} - P_{Tx}$$
                        Dimana:<br>
                        **P_DC** = Tx DC Pwr = {{ number_format(($data->watt_down + $data->filter_down) ?? 0, 1, '.', '') }} dB<br>
                        **P_Tx** = Transmitter Power ($watt\_down$) = {{ number_format($data->watt_down ?? 0, 1, '.', '') }} dB
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Tx Dissipation** adalah daya yang hilang sebagai panas dalam proses konversi daya DC menjadi daya RF oleh pemancar satelit. Ini menunjukkan inefisiensi dalam proses transmisi.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_ptx_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail PTx (Transmit Power) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **PTx** ($watt\_down$) diambil dari input "Transmitter Power (Watt)" yang dikonversi ke dB pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **PTx** (Transmit Power) adalah daya output yang dihasilkan oleh pemancar di satelit untuk jalur downlink, setelah dikurangi semua kehilangan internal pada pemancar itu sendiri.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_la_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line A (LA) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{A} = \text{Cable/Waveguide Loss (dB/m)} \times \text{Line A Length (m)}$$
                        Dimana:<br>
                        **Cable/Waveguide Loss** = {{ number_format($data->guideloss_down ?? 0, 3, '.', '') }} dB/m (dari Transmitter)<br>
                        **Line A Length** = {{ number_format($data->alength_down ?? 0, 3, '.', '') }} m (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line A (LA)** adalah kehilangan daya yang terjadi pada segmen pertama kabel atau waveguide di jalur transmisi downlink. Nilai ini dihitung berdasarkan kehilangan per meter dari jenis kabel yang digunakan dan panjang segmen kabel tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_ltxbpf_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail LTXbpf (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **LTXbpf** ($filter\_down$) diambil dari input "Filter Insertion Losses (Downlink)" pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **LTXbpf** (Loss of Transmit Bandpass Filter) adalah kehilangan daya yang terjadi saat sinyal melewati filter bandpass pada sisi pemancar downlink di satelit.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_lb_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line B (LB) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{B} = \text{Cable/Waveguide Loss (dB/m)} \times \text{Line B Length (m)}$$
                        Dimana:<br>
                        **Cable/Waveguide Loss** = {{ number_format($data->guideloss_down ?? 0, 3, '.', '') }} dB/m (dari Transmitter)<br>
                        **Line B Length** = {{ number_format($data->blength_down ?? 0, 3, '.', '') }} m (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line B (LB)** adalah kehilangan daya yang terjadi pada segmen kedua kabel atau waveguide di jalur transmisi downlink. Nilai ini dihitung berdasarkan kehilangan per meter dari jenis kabel yang digunakan dan panjang segmen kabel tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_ltother_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail LTother (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **LTother** ($devicee\_down$) diambil dari input "Device Loss (Downlink)" pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **LTother** (Loss of Other Components) adalah kehilangan daya tambahan yang disebabkan oleh perangkat lain (selain kabel, konektor, dan filter) yang terhubung pada jalur transmisi pemancar downlink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_device_name_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Device Name (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Device Name** ($device\_down\_name$) diambil dari input "Device Name (Downlink)" pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    Ini mengacu pada jenis perangkat lain yang terhubung secara in-line pada jalur sinyal downlink (misalnya, diplexer, isolator, atau attenuator), yang dapat menyebabkan kehilangan daya.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_device_loss_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Device Loss (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Device Loss** ($devicee\_down$) diambil dari input "Device Loss (Downlink)" pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Device Loss** adalah kehilangan daya yang disebabkan oleh perangkat in-line tertentu pada jalur sinyal downlink. Nilai ini biasanya spesifik untuk jenis perangkat tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_lc_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line C (LC) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{C} = \text{Cable/Waveguide Loss (dB/m)} \times \text{Line C Length (m)}$$
                        Dimana:<br>
                        **Cable/Waveguide Loss** = {{ number_format($data->guideloss_down ?? 0, 3, '.', '') }} dB/m (dari Transmitter)<br>
                        **Line C Length** = {{ number_format($data->clength_down ?? 0, 3, '.', '') }} m (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line C (LC)** adalah kehilangan daya yang terjadi pada segmen ketiga kabel atau waveguide di jalur transmisi downlink. Nilai ini dihitung berdasarkan kehilangan per meter dari jenis kabel yang digunakan dan panjang segmen kabel tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_ltotalline_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Ltotal line (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Ltotal line** ($antenna\_to\_lna\_downrec$) diambil dari input "Line Loss Tx (Antenna to LNA)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Ltotal line** adalah total kehilangan daya pada jalur transmisi antara antena pemancar dan LNA di satelit. Ini mencakup kehilangan pada kabel, konektor, dan komponen pasif lainnya di jalur tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_gt_tx_antenna_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail GT (Transmit Antenna) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **GT (Transmit Antenna)** ($scantennagain\_down$) diambil dari input "Gain Antena (Downlink Spacecraft)" pada halaman "Spacecraft".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **GT (Gain of Transmit Antenna)** adalah penguatan sinyal yang diberikan oleh antena pemancar di satelit untuk jalur downlink. Ini adalah ukuran seberapa efektif antena mengarahkan daya ke arah yang diinginkan.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tx_ant_polar_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Transmit Antenna Polarization (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Transmit Antenna Polarization** ($jenis\_polarizationspacecraft\_down$) diambil dari input "Jenis Polarisasi (Downlink Transmit)" pada halaman "Spacecraft".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Polarisasi antena pemancar** mengacu pada orientasi gelombang elektromagnetik yang dipancarkan oleh antena. Pencocokan polarisasi antara antena pemancar dan penerima sangat penting untuk transmisi sinyal yang efisien.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_eirpsc_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail EIRPS/C (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **EIRPS/C** ($sceirp\_down$) diambil dari input "EIRP Spacecraft (Downlink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **EIRPS/C** (Effective Isotropic Radiated Power of Spacecraft) adalah daya efektif yang dipancarkan oleh satelit ke segala arah secara isotropik. Ini memperhitungkan daya pemancar satelit dan gain antena pengirimnya.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_total_link_losses_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Total Link Losses (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{total\_link} = L_{pointing\_gs} + L_{polarization} + L_{path} + L_{atmospheric} + L_{ionospheric} + L_{rain} + L_{pointing\_sc}$$
                        Dimana:<br>
                        **L_pointing_gs** = Ground Station Pointing Loss ($gspointingloss\_down$)<br>
                        **L_polarization** = Polarization Losses ($polarizationlosses\_down$)<br>
                        **L_path** = Path Loss ($pathlosss\_down$)<br>
                        **L_atmospheric** = Atmospheric Losses ($atmosphericlosses\_down$)<br>
                        **L_ionospheric** = Ionospheric Losses ($ionosphericlosses\_down$)<br>
                        **L_rain** = Rain Losses ($rainlosses\_down$)<br>
                        **L_pointing_sc** = Satellite Pointing Loss ($scpointingloss\_down$)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Total Link Losses** adalah penjumlahan dari semua kehilangan daya yang terjadi di sepanjang keseluruhan jalur downlink, dari pemancar satelit hingga penerima stasiun bumi. Ini mencakup path loss, kerugian atmosfer, kerugian polarisasi, dan kerugian penunjukan antena.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_lp_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Lp (Path Loss) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Lp** ($pathlosss\_down$) diambil dari input "Path Loss (Downlink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Lp** (Path Loss) adalah kehilangan daya sinyal yang terjadi saat sinyal merambat melalui ruang bebas dari pemancar ke penerima. Ini adalah kerugian paling signifikan dalam Link Budget dan bergantung pada frekuensi serta jarak.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_gr_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail GR (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **GR** ($scantennaagain\_down$) diambil dari input "Gain Antena (Downlink Ground Station)" pada halaman "Antenna".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **GR** (Gain of Receive Antenna) adalah penguatan sinyal yang diberikan oleh antena penerima di stasiun bumi untuk jalur downlink. Ini adalah parameter kunci dalam menentukan seberapa efisien antena dapat menangkap sinyal yang dipancarkan.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_rx_ant_polar_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Receive Antenna Polarization (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Receive Antenna Polarization** ($jenis\_polarizationgrounds\_down$) diambil dari input "Jenis Polarisasi (Downlink Receiver)" pada halaman "Ground Station".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Polarisasi antena penerima** mengacu pada orientasi gelombang elektromagnetik yang dapat diterima oleh antena. Penting untuk dicocokkan dengan polarisasi antena pemancar untuk meminimalkan kerugian polarisasi.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_rx_lc_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line C (RX) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{C\_rx} = \text{Cable/Waveguide Loss (dB/m)} \times \text{Line C Length (m)}$$
                        Dimana:<br>
                        **Cable/Waveguide Loss** = {{ number_format($data->guideloss_down ?? 0, 3, '.', '') }} dB/m (dari Transmitter)<br>
                        **Line C Length** = {{ number_format($data->clength_down ?? 0, 3, '.', '') }} m (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line C (RX)** adalah kehilangan daya yang terjadi pada segmen ketiga kabel atau waveguide di jalur penerima downlink. Nilai ini dihitung berdasarkan kehilangan per meter dari jenis kabel yang digunakan dan panjang segmen kabel tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_lrother_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail LRother (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **LRother** ($lrother\_down$) diambil dari input "Loss Other Components (Downlink Receiver)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **LRother** (Loss of Other Components at Receiver) adalah kehilangan daya tambahan yang disebabkan oleh komponen lain di jalur penerima downlink, selain kabel, konektor, dan filter bandpass.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- The 'Other In-Line Device Type' popup is removed as the field itself is removed.
         If you later re-add this field and need a popup for it, remember to re-create it. --}}

    <div id="popup_rx_lb_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line B (RX) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{B\_rx} = \text{Cable/Waveguide Loss (dB/m)} \times \text{Line B Length (m)}$$
                        Dimana:<br>
                        **Cable/Waveguide Loss** = {{ number_format($data->guideloss_down ?? 0, 3, '.', '') }} dB/m (dari Transmitter)<br>
                        **Line B Length** = {{ number_format($data->blength_down ?? 0, 3, '.', '') }} m (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line B (RX)** adalah kehilangan daya yang terjadi pada segmen kedua kabel atau waveguide di jalur penerima downlink. Nilai ini dihitung berdasarkan kehilangan per meter dari jenis kabel yang digunakan dan panjang segmen kabel tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_lrbpf_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail LRbpf (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **LRbpf** ($filter\_down$) diambil dari input "Filter Insertion Losses (Downlink)" pada halaman "Transmitter".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **LRbpf** (Loss of Receive Bandpass Filter) adalah kehilangan daya yang terjadi saat sinyal melewati filter bandpass pada sisi penerima downlink.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_rx_la_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Line A (RX) (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Rumus Perhitungan:</strong><br>
                        $$L_{A\_rx} = \text{Cable/Waveguide Loss (dB/m)} \times \text{Line A Length (m)}$$
                        Dimana:<br>
                        **Cable/Waveguide Loss** = {{ number_format($data->guideloss_down ?? 0, 3, '.', '') }} dB/m (dari Transmitter)<br>
                        **Line A Length** = {{ number_format($data->alength_down ?? 0, 3, '.', '') }} m (dari Transmitter)
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Line A (RX)** adalah kehilangan daya yang terjadi pada segmen pertama kabel atau waveguide di jalur penerima downlink. Nilai ini dihitung berdasarkan kehilangan per meter dari jenis kabel yang digunakan dan panjang segmen kabel tersebut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_ltotal_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail Ltotal (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **Ltotal** ($ltotal\_down$) diambil dari input "Total Loss Receiver (Downlink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **Ltotal** adalah total kehilangan daya yang terjadi di sisi penerima downlink, termasuk kehilangan pada antena, jalur transmisi, dan komponen penerima lainnya sebelum sinyal diproses lebih lanjut.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_tlna_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail TLNA (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **TLNA** ($tlna\_downrec$) diambil dari input "Suhu LNA (Downlink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **TLNA** (Temperature of Low Noise Amplifier) adalah suhu noise yang dihasilkan oleh Low Noise Amplifier di sisi penerima downlink. Ini merupakan kontributor utama terhadap total suhu noise sistem (Tsys) penerima.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_glna_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail GLNA (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **GLNA** ($lnagain\_downrec$) diambil dari input "Gain LNA (Downlink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **GLNA** (Gain Low Noise Amplifier) adalah penguatan sinyal yang diberikan oleh Low Noise Amplifier di sisi penerima downlink. LNA berperan penting dalam memperkuat sinyal lemah yang diterima.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_t2nd_amp_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail T2nd Amp (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **T2nd Amp** ($tcomrcvr\_downrec$) diambil dari input "Suhu Noise Amplifier Kedua (Downlink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **T2nd Amp** (Temperature of the Second Amplifier) adalah suhu noise yang dihasilkan oleh amplifier kedua dalam rantai penerima downlink. Ini adalah salah satu komponen yang berkontribusi pada total suhu noise sistem (Tsys).</p>
                </div>
            </div>
        </div>
    </div>

    <div id="popup_brbpf_downlink" class="popup-window">
        <div class="popup-content">
            <div class="popup-header">
                <span class="close-popup-btn">&times;</span> <h3>Detail BRbpf (Downlink)</h3>
            </div>
            <div class="popup-body">
                <div>
                    <div class="formula">
                        <strong>Sumber Nilai:</strong><br>
                        Nilai **BRbpf** ($gsbandwidth\_down$) diambil dari input "Bandwidth pada Ground Station (Downlink)" pada halaman "Link Budget Calculation - Input Mode".
                    </div>
                    <p><strong>Penjelasan:</strong><br>
                    **BRbpf** (Bandwidth Noise pada Bandpass Filter) adalah lebar pita frekuensi di mana noise diukur pada sisi penerima downlink. Ini secara langsung mempengaruhi jumlah noise yang diterima dan, oleh karena itu, S/N Ratio. Nilai ini digunakan dalam perhitungan S/N untuk mengkarakterisasi noise termal.</p>
                </div>
            </div>
        </div>
    </div>


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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Function to open a specific popup
            function openPopup(popupId) {
                // Close all other popups first to ensure only one is visible
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
                
                const popup = document.getElementById(popupId);
                if (popup) {
                    popup.style.display = "flex";
                    // Re-render MathJax content within the newly opened popup
                    if (typeof MathJax !== 'undefined') {
                        MathJax.typesetPromise(popup); // Pass the specific element to typeset
                    }
                }
            }

            // Function to close all popups
            function closeAllPopups() {
                document.querySelectorAll('.popup-window').forEach(p => p.style.display = 'none');
            }

            // Event listener for the general summary explanation button
            document.getElementById('info_summary_general_btn').onclick = () => {
                openPopup('popup_summary_general');
            };

            // Event listeners for specific "Lihat Detail" buttons for Uplink S/N and Link Margin
            const snUplinkBtn = document.getElementById('sn_uplink_popup_btn');
            if (snUplinkBtn) {
                snUplinkBtn.onclick = () => openPopup('popup_sn_uplink');
            }

            const linkMarginUplinkBtn = document.getElementById('linkmargin_uplink_popup_btn');
            if (linkMarginUplinkBtn) {
                linkMarginUplinkBtn.onclick = () => openPopup('popup_linkmargin_uplink');
            }

            // Event listeners for specific "Lihat Detail" buttons for Downlink S/N and Link Margin
            const snDownlinkBtn = document.getElementById('sn_downlink_popup_btn');
            if (snDownlinkBtn) {
                snDownlinkBtn.onclick = () => openPopup('popup_sn_downlink');
            }

            const linkMarginDownlinkBtn = document.getElementById('linkmargin_downlink_popup_btn');
            if (linkMarginDownlinkBtn) {
                linkMarginDownlinkBtn.onclick = () => openPopup('popup_linkmargin_downlink');
            }

            // Add event listeners to all new "Lihat Detail" buttons for Uplink
            document.getElementById('freq_uplink_popup_btn').onclick = () => openPopup('popup_freq_uplink');
            document.getElementById('brbpf_uplink_popup_btn').onclick = () => openPopup('popup_brbpf_uplink');
            document.getElementById('gt_uplink_popup_btn').onclick = () => openPopup('popup_gt_uplink');
            document.getElementById('tsys_uplink_popup_btn').onclick = () => openPopup('popup_tsys_uplink');
            document.getElementById('t2nd_amp_uplink_popup_btn').onclick = () => openPopup('popup_t2nd_amp_uplink');
            document.getElementById('glna_uplink_popup_btn').onclick = () => openPopup('popup_glna_uplink');
            document.getElementById('tlna_uplink_popup_btn').onclick = () => openPopup('popup_tlna_uplink');
            document.getElementById('ltotalline_uplink_popup_btn').onclick = () => openPopup('popup_ltotalline_uplink');
            document.getElementById('la_uplink_popup_btn').onclick = () => openPopup('popup_la_uplink');
            document.getElementById('lrbpf_uplink_popup_btn').onclick = () => openPopup('popup_lrbpf_uplink');
            document.getElementById('lb_uplink_popup_btn').onclick = () => openPopup('popup_lb_uplink');
            document.getElementById('ltother_uplink_popup_btn').onclick = () => openPopup('popup_ltother_uplink');
            document.getElementById('lc_uplink_popup_btn').onclick = () => openPopup('popup_lc_uplink');
            // document.getElementById('other_device_type_uplink_popup_btn').onclick = () => openPopup('popup_other_device_type_uplink'); // REMOVED
            document.getElementById('rx_ant_gr_uplink_popup_btn').onclick = () => openPopup('popup_rx_ant_gr_uplink');
            document.getElementById('rx_ant_polar_uplink_popup_btn').onclick = () => openPopup('popup_rx_ant_polar_uplink');
            document.getElementById('lp_uplink_popup_btn').onclick = () => openPopup('popup_lp_uplink');
            document.getElementById('total_link_losses_uplink_popup_btn').onclick = () => openPopup('popup_total_link_losses_uplink');
            document.getElementById('eirpgs_uplink_popup_btn').onclick = () => openPopup('popup_eirpgs_uplink');
            document.getElementById('gt_tx_antenna_uplink_popup_btn').onclick = () => openPopup('popup_gt_tx_antenna_uplink');
            document.getElementById('tx_ant_polar_uplink_popup_btn').onclick = () => openPopup('popup_tx_ant_polar_uplink');
            document.getElementById('tx_ltotalline_uplink_popup_btn').onclick = () => openPopup('popup_tx_ltotalline_uplink');
            document.getElementById('tx_lc_uplink_popup_btn').onclick = () => openPopup('popup_tx_lc_uplink');
            document.getElementById('tx_ltother_uplink_popup_btn').onclick = () => openPopup('popup_tx_ltother_uplink');
            document.getElementById('other_losses_uplink_popup_btn').onclick = () => openPopup('popup_other_losses_uplink');
            document.getElementById('tx_lb_uplink_popup_btn').onclick = () => openPopup('popup_tx_lb_uplink');
            document.getElementById('ltbpf_uplink_popup_btn').onclick = () => openPopup('popup_ltbpf_uplink');
            document.getElementById('tx_la_uplink_popup_btn').onclick = () => openPopup('popup_tx_la_uplink');
            document.getElementById('ptx_uplink_popup_btn').onclick = () => openPopup('popup_ptx_uplink');


            // Add event listeners to all new "Lihat Detail" buttons for Downlink
            document.getElementById('freq_downlink_popup_btn').onclick = () => openPopup('popup_freq_downlink');
            document.getElementById('htx_downlink_popup_btn').onclick = () => openPopup('popup_htx_downlink');
            document.getElementById('tx_dc_pwr_downlink_popup_btn').onclick = () => openPopup('popup_tx_dc_pwr_downlink');
            document.getElementById('tx_dissipation_downlink_popup_btn').onclick = () => openPopup('popup_tx_dissipation_downlink');
            document.getElementById('ptx_downlink_popup_btn').onclick = () => openPopup('popup_ptx_downlink');
            document.getElementById('la_downlink_popup_btn').onclick = () => openPopup('popup_la_downlink');
            document.getElementById('ltxbpf_downlink_popup_btn').onclick = () => openPopup('popup_ltxbpf_downlink');
            document.getElementById('lb_downlink_popup_btn').onclick = () => openPopup('popup_lb_downlink');
            document.getElementById('ltother_downlink_popup_btn').onclick = () => openPopup('popup_ltother_downlink');
            document.getElementById('device_name_downlink_popup_btn').onclick = () => openPopup('popup_device_name_downlink');
            document.getElementById('device_loss_downlink_popup_btn').onclick = () => openPopup('popup_device_loss_downlink');
            document.getElementById('lc_downlink_popup_btn').onclick = () => openPopup('popup_lc_downlink');
            document.getElementById('ltotalline_downlink_popup_btn').onclick = () => openPopup('popup_ltotalline_downlink');
            document.getElementById('gt_tx_antenna_downlink_popup_btn').onclick = () => openPopup('popup_gt_tx_antenna_downlink');
            document.getElementById('tx_ant_polar_downlink_popup_btn').onclick = () => openPopup('popup_tx_ant_polar_downlink');
            document.getElementById('eirpsc_downlink_popup_btn').onclick = () => openPopup('popup_eirpsc_downlink');
            document.getElementById('total_link_losses_downlink_popup_btn').onclick = () => openPopup('popup_total_link_losses_downlink');
            document.getElementById('lp_downlink_popup_btn').onclick = () => openPopup('popup_lp_downlink');
            document.getElementById('gr_downlink_popup_btn').onclick = () => openPopup('popup_gr_downlink');
            document.getElementById('rx_ant_polar_downlink_popup_btn').onclick = () => openPopup('popup_rx_ant_polar_downlink');
            document.getElementById('rx_lc_downlink_popup_btn').onclick = () => openPopup('popup_rx_lc_downlink');
            document.getElementById('lrother_downlink_popup_btn').onclick = () => openPopup('popup_lrother_downlink');
            // document.getElementById('other_device_type_downlink_popup_btn').onclick = () => openPopup('popup_other_device_type_downlink'); // REMOVED
            document.getElementById('rx_lb_downlink_popup_btn').onclick = () => openPopup('popup_rx_lb_downlink');
            document.getElementById('lrbpf_downlink_popup_btn').onclick = () => openPopup('popup_lrbpf_downlink');
            document.getElementById('rx_la_downlink_popup_btn').onclick = () => openPopup('popup_rx_la_downlink');
            document.getElementById('ltotal_downlink_popup_btn').onclick = () => openPopup('popup_ltotal_downlink');
            document.getElementById('tlna_downlink_popup_btn').onclick = () => openPopup('popup_tlna_downlink');
            document.getElementById('glna_downlink_popup_btn').onclick = () => openPopup('popup_glna_downlink');
            document.getElementById('t2nd_amp_downlink_popup_btn').onclick = () => openPopup('popup_t2nd_amp_downlink');
            document.getElementById('brbpf_downlink_popup_btn').onclick = () => openPopup('popup_brbpf_downlink');

            // Add event listeners to all close buttons
            document.querySelectorAll('.close-popup-btn').forEach(btn => {
                btn.onclick = closeAllPopups;
            });

            // --- Link Margin Calculation and Status Update ---
            const uplinkSnValueInput = document.getElementById('uplink_sn_value');
            const uplinkLinkMarginInput = document.getElementById('uplink_sn_link_margin');
            const uplinkLinkStatusSpan = document.getElementById('uplink_sn_link_status');

            const downlinkSnValueInput = document.getElementById('downlink_sn_value');
            const downlinkLinkMarginInput = document.getElementById('downlink_sn_link_margin');
            const downlinkLinkStatusSpan = document.getElementById('downlink_sn_link_status');

            const requiredSnUplink = 14.4; // Example value, adjust as per your actual system requirements
            const requiredSnDownlink = 9.6; // Example value, adjust as per your actual system requirements

            function updateLinkMarginStatus(snValueInput, linkMarginInput, linkStatusSpan, requiredSn) {
                const snValue = parseFloat(snValueInput.value);
                let linkMargin = NaN;
                let statusText = '';
                let statusClass = '';

                if (!isNaN(snValue)) {
                    linkMargin = snValue - requiredSn;
                    linkMarginInput.value = linkMargin.toFixed(1);

                    if (linkMargin < 0) {
                        statusText = "NO LINK !";
                        statusClass = "no-link";
                    } else if (linkMargin < 6) {
                        statusText = "MARGINAL LINK";
                        statusClass = "marginal-link";
                    } else {
                        statusText = "LINK CLOSES";
                        statusClass = "link-closes";
                    }
                } else {
                    linkMarginInput.value = '';
                    statusText = '';
                    statusClass = '';
                }

                linkStatusSpan.textContent = statusText;
                linkStatusSpan.className = 'link-status-text';
                if (statusClass) {
                    linkStatusSpan.classList.add(statusClass);
                }
            }

            // --- Calculation for Downlink Tx DC Pwr and Tx Dissipation ---
            function calculateDownlinkTxPowers() {
                // These fields are now readonly, their values are directly from $data object
                // The values are calculated in backend or previous pages.
                // We just need to update the display if there's any dynamic change,
                // but since they're readonly and pre-filled, this function primarily ensures
                // consistency in display if any underlying data changes from non-JS sources (e.g. initial load).
                const ptx = parseFloat(document.querySelector('input[name="downlink_ptx"]').value);
                const ltxbpf = parseFloat(document.querySelector('input[name="downlink_ltxbpf"]').value);

                const txDcPwrOutput = document.getElementById('downlink_tx_dc_pwr');
                const txDissipationOutput = document.getElementById('downlink_tx_dissipation');

                if (!isNaN(ptx) && !isNaN(ltxbpf)) {
                    // Tx DC Pwr = PTx (dB) + LTXbpf (dB)
                    const txDcPwr = ptx + ltxbpf;
                    txDcPwrOutput.value = txDcPwr.toFixed(1);

                    // Tx Dissipation = Tx DC Pwr (dB) - PTx (dB)
                    const txDissipation = txDcPwr - ptx;
                    txDissipationOutput.value = txDissipation.toFixed(1);
                } else {
                    txDcPwrOutput.value = '';
                    txDissipationOutput.value = '';
                }
            }

            // --- Pemicu perhitungan saat halaman dimuat ---
            updateLinkMarginStatus(uplinkSnValueInput, uplinkLinkMarginInput, uplinkLinkStatusSpan, requiredSnUplink);
            updateLinkMarginStatus(downlinkSnValueInput, downlinkLinkMarginInput, downlinkLinkStatusSpan, requiredSnDownlink);
            
            calculateDownlinkTxPowers(); // Ensure this is run on load

            // MathJax rendering for popups on load
            if (typeof MathJax !== 'undefined') {
                MathJax.typesetPromise();
            }
        });
    </script>

</x-layout>