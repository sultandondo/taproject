<x-layout>
    <x-slot:title>Form Receiver</x-slot>
    <div class="container mx-auto px-4 py-8">
        
        <!-- Uplink Section -->
        <h2 class="text-2xl font-bold mb-6 text-center">Uplink</h2>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <form method="POST" action="{{ route('receiver.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <!-- Cable Losses -->
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Cable or Waveguide ("Line") Losses:</label>
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide Type:</label>
                    <input type="text" name="cabletype_uprec" id="cabletype_uprec" class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Cable/Guide Loss per meter (dB):</label>
                    <input type="number" step="any" name="typecable" id="typecable" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Masukkan Nilai Loss per meter">
                </div>

                <!-- Line Lengths -->
                <div class="flex justify-start space-x-6 items-center mb-4">
                    <div class="w-1/3">
                        <label for="alength_uprec" class="block font-medium text-gray-700 mb-1">Line A Length (meter):</label>
                        <input type="number" step="any" id="alength_uprec" name="alength_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai Line A">
                    </div>

                    <div class="w-1/3">
                        <label for="blength_uprec" class="block font-medium text-gray-700 mb-1">Line B Length (meter):</label>
                        <input type="number" step="any" id="blength_uprec" name="blength_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai Line B">
                    </div>

                    <div class="w-1/3">
                        <label for="clength_uprec" class="block font-medium text-gray-700 mb-1">Line C Length (meter):</label>
                        <input type="number" step="any" id="clength_uprec" name="clength_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai Line C">
                    </div>
                </div>

                <!-- Loss Calculations -->
                <div class="flex justify-start space-x-6 items-center mb-4">
                    <div class="w-1/3">
                        <label for="la_uprec" class="block font-medium text-gray-700 mb-1">LA (dB):</label>
                        <input type="text" id="la_uprec" name="la_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="Hasil LA" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        <button type="button" id="la_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                    </div>

                    <div class="w-1/3">
                        <label for="lb_uprec" class="block font-medium text-gray-700 mb-1">LB (dB):</label>
                        <input type="text" id="lb_uprec" name="lb_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed"  placeholder="Hasil LB" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                      <button type="button" id="lb_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                    </div>

                    <div class="w-1/3">
                        <label for="lc_uprec" class="block font-medium text-gray-700 mb-1">LC (dB):</label>
                        <input type="text" id="lc_uprec" name="lc_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed"  placeholder="Hasil LC" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                        <button type="button" id="lc_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                    </div>
                </div>

                <!-- Bandpass Filter and Other Losses -->
                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Bandpass Filter Insertion Loss (LBPF):</label>
                    <input type="number" step="any" name="lbpf_uprec" id="lbpf_uprec" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Insertion Loss of Other In-Line Devices (Lother):</label>
                    <input type="number" step="any" name="lother_uprec" id="lother_uprec" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <!-- Connectors and Final Calculations -->
                <div class="w-1/3 mb-4">
                    <label for="connect_uprec" class="block font-medium text-gray-700 mb-1">Number of In-Line Connectors:</label>
                    <input type="number" step="any" id="connect_uprec" name="connect_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai" oninput="calculateTotalConnector()">
                </div>

                <div class="w-1/3 mb-4">
                    <label for="totconnect_uprec" class="block font-medium text-grey-700 mb-1">Total Penurunan Daya (Connector):</label>
                    <input type="text" id="totconnect_uprec" name="totconnect_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed"  placeholder="Hasil Total Connector" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="totconnect_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-grey-700 mb-1">Total In-Line Losses from Antenna to LNA (dB):</label>
                    <input type="number" step="any" name="antenna to lna_uprec" id="antenna to lna_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="antenna_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-grey-700 mb-1">Transmission Line Coefficient (α):</label>
                    <input type="number" step="any" name="tranlincoe_uprec" id="tranlincoe_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                   <button type="button" id="tranlincoe_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Antenna or "Sky" Temperature: (Ta):</label>
                    <input type="number" step="any" name="antemper_uprec" id="antemper_uprec" class="border border-gray-300 p-3 w-full rounded bg-white">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Spacecraft Temperature: (To):</label>
                    <input type="number" step="any" name="spactemp_uprec" id="spactemp_uprec" class="border border-gray-300 p-3 w-full rounded bg-white">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">LNA Temperature: (TLNA):</label>
                    <input type="number" step="any" name="tlna_uprec" id="tlna_uprec" class="border border-gray-300 p-3 w-full rounded bg-white">
                </div>

                <!-- LNA Gain Input -->
                <div class="w-1/3 mb-4">
                    <label for="lnagain_uprec" class="block font-medium text-gray-700 mb-1">LNA Gain:</label>
                    <input type="number" step="any" id="lnagain_uprec" name="lnagain_uprec" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" placeholder="Masukkan Nilai" oninput="calculateGLNA()">
                </div>

                <!-- GLNA Output (Readonly) -->
                <div class="w-1/3 mb-4">
                    <label for="glna_uprec" class="block font-medium text-grey-700 mb-1">GLNA:</label>
                    <input type="text" id="glna_uprec" name="glna_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="Hasil Total Connector" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="glna_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>

                <div id="2ndstagetemp_uprec_container" class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">2nd Stage Temperature (T2ndStage):</label>
                    <input type="number" name="2ndstagetemp_uprec" id="2ndstagetemp_uprec" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0">
                </div>

                <div class="w-1/3 mb-4">
                    <label for="ts_uprec" class="block font-medium text-grey-700 mb-1">System Noise Temperature (Ts):</label>
                    <input type="text" id="ts_uprec" name="ts_uprec" class="w-full p-3 border border-green-300 rounded-lg bg-green-100 text-green-700 cursor-not-allowed" placeholder="Hasil Total Connector" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                    <button type="button" id="ts_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
                </div>


                <!-- Downlink Receiver -->
    </div>
    <h2 class="text-2xl font-bold mb-6 text-center">Downlink</h2>
    <div class="bg-white shadow-lg rounded-lg p-6">
        <form method="GET" action="">

        <!-- Cable Losses -->
        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">Cable or Waveguide ("Line") Losses:</label>
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide Type:</label>
            <input type="text" name="cabletype_downrec" id="cabletype_downrec" class="border border-gray-300 p-3 w-full rounded bg-gray-50">
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">Cable/Guide Loss per meter (dB):</label>
            <input type="number" step="any" name="typecable_downrec" id="typecable_downrec" class="border border-gray-300 p-3 w-full rounded bg-gray-50" placeholder="Masukkan Nilai Loss per meter">
        </div>

        <!-- Line Lengths -->
        <div class="flex justify-start space-x-6 items-center mb-4">
            <div class="w-1/3">
                <label for="alength_downrec" class="block font-medium text-gray-700 mb-1">Line A Length (meter):</label>
                <input type="number" step="any" id="alength_downrec" name="alength_downrec" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Nilai Line A" oninput="calculateTotalLossDownlink()">
            </div>
            <div class="w-1/3">
                <label for="blength_downrec" class="block font-medium text-gray-700 mb-1">Line B Length (meter):</label>
                <input type="number" step="any" id="blength_downrec" name="blength_downrec" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Nilai Line B" oninput="calculateTotalLossDownlink()">
            </div>
            <div class="w-1/3">
                <label for="clength_downrec" class="block font-medium text-gray-700 mb-1">Line C Length (meter):</label>
                <input type="number" step="any" id="clength_downrec" name="clength_downrec" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Nilai Line C" oninput="calculateTotalLossDownlink()">
            </div>
        </div>

        <!-- Loss Calculations -->
        <div class="flex justify-start space-x-6 items-center mb-4">
            <div class="w-1/3">
                <label for="la_downrec" class="block font-medium text-gray-700 mb-1">LA (dB):</label>
                <input type="text" id="la_downrec" name="la_downrec" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed" placeholder="Hasil LA" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
               <button type="button" id="la_downrec_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>
            <div class="w-1/3">
                <label for="lb_downrec" class="block font-medium text-gray-700 mb-1">LB (dB):</label>
                <input type="text" id="lb_downrec" name="lb_downrec" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed" placeholder="Hasil LB" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="lb_downrec_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>
            <div class="w-1/3">
                <label for="lc_downrec" class="block font-medium text-gray-700 mb-1">LC (dB):</label>
                <input type="text" id="lc_downrec" name="lc_downrec" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed" placeholder="Hasil LC" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="lc_downrec_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>
        </div>

        <!-- Bandpass Filter and Other Losses -->
        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">Bandpass Filter Insertion Loss (LBPF):</label>
            <input type="number" step="any" name="lbpf_downrec" id="lbpf_downrec" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" oninput="calculateTotalLossDownlink()">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">Insertion Loss of Other In-Line Devices (Lother):</label>
            <input type="number" step="any" name="lother_downrec" id="lother_downrec" class="border border-gray-300 p-3 w-full rounded bg-gray-50" min="0" oninput="calculateTotalLossDownlink()">
        </div>

        <!-- Connectors and Final Calculations -->
        <div class="w-1/3 mb-4">
            <label for="connect_downrec" class="block font-medium text-gray-700 mb-1">Number of In-Line Connectors:</label>
            <input type="number" step="any" id="connect_downrec" name="connect_downrec" class="w-full p-3 border border-gray-300 rounded-lg" oninput="calculateTotalConnectorDownlink()">
        </div>

        <div class="w-1/3 mb-4">
            <label for="totconnect_downrec" class="block font-medium text-gray-700 mb-1">Total Penurunan Daya (Connector):</label>
            <input type="text" id="totconnect_downrec" name="totconnect_downrec" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed" placeholder="Hasil Total Connector" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
            <button type="button" id="totconnect_downrec_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">Total In-Line Losses from Antenna to LNA (dB):</label>
            <input type="number" step="any" name="antenna_to_lna_downrec" id="antenna_to_lna_downrec" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
            <button type="button" id="antenna_downrec_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">Transmission Line Coefficient (α):</label>
            <input type="number" step="any" name="tranlincoe_downrec" id="tranlincoe_downrec" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
            <button type="button" id="tranlincoe_downrec_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">Antenna or "Sky" Temperature: (Ta):</label>
            <input type="number" step="any" name="antemper_downrec" id="antemper_downrec" class="border border-gray-300 p-3 w-full rounded bg-white">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">Spacecraft Temperature: (To):</label>
            <input type="number" step="any" name="spactemp_downrec" id="spactemp_downrec" class="border border-gray-300 p-3 w-full rounded bg-white">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1 text-gray-700">LNA Temperature: (TLNA):</label>
            <input type="number" step="any" name="tlna_downrec" id="tlna_downrec" class="border border-gray-300 p-3 w-full rounded bg-white">
        </div>

        <!-- LNA Gain Input -->
        <div class="w-1/3 mb-4">
            <label for="lnagain_downrec" class="block font-medium text-gray-700 mb-1">LNA Gain:</label>
            <input type="number" step="any" id="lnagain_downrec" name="lnagain_downrec" class="w-full p-3 border border-gray-300 rounded-lg" oninput="calculateGLNADownlink()">
        </div>

        <!-- GLNA Output (Readonly) -->
        <div class="w-1/3 mb-4">
            <label for="glna_downrec" class="block font-medium text-gray-700 mb-1">GLNA:</label>
            <input type="text" id="glna_downrec" name="glna_downrec" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed" placeholder="Hasil Total Connector" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
            <button type="button" id="glna_downrec_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
        </div> 

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide D Type</label>
                <input type="text" step="any" name="dtype_downrec" id="dtype_downrec" class="border border-gray-300 p-3 w-full rounded bg-white">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide D Length (m):</label>
                <input type="number" step="any" name="dloss_length_downrec" id="dloss_length_downrec" class="border border-gray-300 p-3 w-full rounded bg-white" oninput="calculateDLossDownlink()">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Cable/Waveguide D Loss (°K per meter):</label>
                <input type="number" step="any" name="dloss_per_meter_downrec" id="dloss_per_meter_downrec" class="border border-gray-300 p-3 w-full rounded bg-white" oninput="calculateDLossDownlink()">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Total Cable/Waveguide D Loss:</label>
                <input type="number" name="dloss_result_downrec" id="dloss_result_downrec" class="border border-gray-300 p-3 w-full rounded bg-gray-50" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
                <button type="button" id="dloss_downrec_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1 text-gray-700">Communications Receiver Front End Temperature (TComRcvr):</label>
                <input type="number" step="any" name="tcomrcvr_downrec" id="tcomrcvr_downrec" class="border border-gray-300 p-3 w-full rounded bg-white">
            </div>

            <div class="w-1/3 mb-4">
                <label for="ts_downrec" class="block font-medium text-gray-700 mb-1">System Noise Temperature (Ts):</label>
                <input type="number" id="ts_downrec" name="ts_downrec" class="w-full p-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-700 cursor-not-allowed" placeholder="Hasil Total Connector" readonly style="background-color: #e6f4e1; color:rgb(0, 0, 0); border-color: #81c784;">
               <button type="button" id="ts_downrec_popup_btn" class="text-blue-500 mt-2">Lihat Detail</button>
            </div>
                        
                        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 w-full">Simpan</button>
                    </form>
                </div>
            </form>
        </div>
    </div>

<!-- Pop-up untuk Uplink -->
<!-- LA Pop-up -->
<div id="la_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail LA (dB)</h3>
        <p class="formula"><span id="la_formula"></span></p>
        <div id="la_popup_content"></div>
    </div>
</div>

<!-- LB Pop-up -->
<div id="lb_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail LB (dB)</h3>
        <p class="formula"><span id="lb_formula"></span></p>
        <div id="lb_popup_content"></div>
    </div>
</div>

<!-- LC Pop-up -->
<div id="lc_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail LC (dB)</h3>
        <p class="formula"><span id="lc_formula"></span></p>
        <div id="lc_popup_content"></div>
    </div>
</div>

<!-- Total Connector Loss Pop-up -->
<div id="totconnect_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Penurunan Daya (Connector)</h3>
        <p class="formula"><span id="totconnect_formula"></span></p>
        <div id="totconnect_popup_content"></div>
    </div>
</div>

<!-- Total In-Line Losses Pop-up -->
<div id="antenna_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total In-Line Losses dari Antena ke LNA (dB)</h3>
        <p class="formula"><span id="antenna_formula"></span></p>
        <div id="antenna_popup_content"></div>
    </div>
</div>

<!-- Transmission Line Coefficient Pop-up -->
<div id="tranlincoe_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Koefisien Transmisi (α)</h3>
        <p class="formula"><span id="tranlincoe_formula"></span></p>
        <div id="tranlincoe_popup_content"></div>
    </div>
</div>

<!-- GLNA Pop-up -->
<div id="glna_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail GLNA</h3>
        <p class="formula"><span id="glna_formula"></span></p>
        <div id="glna_popup_content"></div>
    </div>
</div>

<!-- Ts Pop-up -->
<div id="ts_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Suhu Noise Sistem (Ts)</h3>
        <p class="formula"><span id="ts_formula"></span></p>
        <div id="ts_popup_content"></div>
    </div>
</div>

<!-- Pop-up untuk Downlink -->
<!-- LA Downlink Pop-up -->
<div id="la_downrec_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail LA (dB)</h3>
        <p class="formula"><span id="la_downrec_formula"></span></p>
        <div id="la_downrec_popup_content"></div>
    </div>
</div>

<!-- LB Downlink Pop-up -->
<div id="lb_downrec_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail LB (dB)</h3>
        <p class="formula"><span id="lb_downrec_formula"></span></p>
        <div id="lb_downrec_popup_content"></div>
    </div>
</div>

<!-- LC Downlink Pop-up -->
<div id="lc_downrec_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail LC (dB)</h3>
        <p class="formula"><span id="lc_downrec_formula"></span></p>
        <div id="lc_downrec_popup_content"></div>
    </div>
</div>

<!-- Total Connector Loss Downlink Pop-up -->
<div id="totconnect_downrec_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Penurunan Daya (Connector)</h3>
        <p class="formula"><span id="totconnect_downrec_formula"></span></p>
        <div id="totconnect_downrec_popup_content"></div>
    </div>
</div>

<!-- Total In-Line Losses Downlink Pop-up -->
<div id="antenna_downrec_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total In-Line Losses dari Antena ke LNA (dB)</h3>
        <p class="formula"><span id="antenna_downrec_formula"></span></p>
        <div id="antenna_downrec_popup_content"></div>
    </div>
</div>

<!-- Transmission Line Coefficient Downlink Pop-up -->
<div id="tranlincoe_downrec_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Koefisien Transmisi (α)</h3>
        <p class="formula"><span id="tranlincoe_downrec_formula"></span></p>
        <div id="tranlincoe_downrec_popup_content"></div>
    </div>
</div>

<!-- GLNA Downlink Pop-up -->
<div id="glna_downrec_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail GLNA</h3>
        <p class="formula"><span id="glna_downrec_formula"></span></p>
        <div id="glna_downrec_popup_content"></div>
    </div>
</div>

<!-- D Loss Downlink Pop-up -->
<div id="dloss_downrec_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Total Cable/Waveguide D Loss</h3>
        <p class="formula"><span id="dloss_downrec_formula"></span></p>
        <div id="dloss_downrec_popup_content"></div>
    </div>
</div>

<!-- Ts Downlink Pop-up -->
<div id="ts_downrec_popup" class="popup-window">
    <div class="popup-content">
        <span class="close-popup-btn">&times;</span>
        <h3>Detail Suhu Noise Sistem (Ts)</h3>
        <p class="formula"><span id="ts_downrec_formula"></span></p>
        <div id="ts_downrec_popup_content"></div>
    </div>
</div>

<!-- Tambahkan CSS untuk Pop-up -->
<style>
    .popup-window {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        position: relative;
        background-color: white;
        padding: 20px 30px 30px 30px;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        width: 80%;
        max-width: 600px;
        max-height: 80vh;
        overflow-y: auto;
    }

    .close-popup-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        font-weight: bold;
        color: #555;
        cursor: pointer;
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
    }
    </style>

    <!-- Script -->
    <script>
        
     //script uplink
        
    // Fungsi perhitungan utama
function calculateTotalLossComponent() {
    // Mengambil nilai dari form
    const cableLoss = parseFloat(document.getElementById("typecable").value) || 0;
    const aLength = parseFloat(document.getElementById("alength_uprec").value) || 0;
    const bLength = parseFloat(document.getElementById("blength_uprec").value) || 0;
    const cLength = parseFloat(document.getElementById("clength_uprec").value) || 0;

    // Menghitung loss untuk setiap line
    const la = aLength * cableLoss;
    const lb = bLength * cableLoss;
    const lc = cLength * cableLoss;

    // Menampilkan hasil perhitungan
    document.getElementById("la_uprec").value = la.toFixed(2);
    document.getElementById("lb_uprec").value = lb.toFixed(2);
    document.getElementById("lc_uprec").value = lc.toFixed(2);

    // Memperbarui perhitungan total loss
    calculateTotalLossFinal();
}

// Fungsi untuk menghitung total loss dari konektor
function calculateTotalConnector() {
    const connectorValue = parseFloat(document.getElementById('connect_uprec').value) || 0;
    const totalLoss = connectorValue * 0.05; // Loss per konektor = 0.05 dB
    document.getElementById('totconnect_uprec').value = totalLoss.toFixed(2);
    calculateTotalLossFinal();
}

// Fungsi untuk menghitung total loss keseluruhan
function calculateTotalLossFinal() {
    // Mengambil semua nilai loss
    const la = parseFloat(document.getElementById('la_uprec').value) || 0;
    const lb = parseFloat(document.getElementById('lb_uprec').value) || 0;
    const lc = parseFloat(document.getElementById('lc_uprec').value) || 0;
    const lbpf = parseFloat(document.getElementById('lbpf_uprec').value) || 0;
    const lother = parseFloat(document.getElementById('lother_uprec').value) || 0;
    const totconnect = parseFloat(document.getElementById('totconnect_uprec').value) || 0;

    // Menghitung total loss
    const total = la + lb + lc + lbpf + lother + totconnect;

    // Menampilkan hasil
    document.getElementById('antenna to lna_uprec').value = total.toFixed(2);

    // Hitung koefisien transmisi
    calculateTransmissionCoefficient();
}

// Fungsi untuk menghitung koefisien transmisi
function calculateTransmissionCoefficient() {
    const totalLossDb = parseFloat(document.getElementById('antenna to lna_uprec').value) || 0;

    // Hitung koefisien transmisi (α) berdasarkan total loss
    if (totalLossDb !== 0) {
        const coefficient = Math.pow(10, -totalLossDb / 10);
        document.getElementById('tranlincoe_uprec').value = coefficient.toFixed(4);
    } else {
        document.getElementById('tranlincoe_uprec').value = "0.00";  // Perbaikan: Nilai default seharusnya 1 jika tidak ada loss
    }
    
    // Hitung Ts setelah koefisien transmisi diperbarui
    calculateTs();
}

// Fungsi untuk menghitung GLNA dari gain LNA
function calculateGLNA() {
    const lnagainInput = document.getElementById('lnagain_uprec');
    const glnaOutput = document.getElementById('glna_uprec');

    const lnagain = parseFloat(lnagainInput.value) || 0;

    // Konversi dari dB ke nilai numerik
    if (!isNaN(lnagain)) {
        const glna = Math.pow(10, lnagain / 10);
        glnaOutput.value = glna.toFixed(2);
    } else {
        glnaOutput.value = "1.00";  // Perbaikan: Nilai default seharusnya 1 bukan 0
    }
    
    // Perbarui Ts ketika GLNA berubah
    calculateTs();
}

// Fungsi untuk menghitung Suhu Noise Sistem (Ts)
function calculateTs() {
    // Mengambil semua nilai yang diperlukan
    const alpha = parseFloat(document.getElementById('tranlincoe_uprec').value) || 1; // Default 1 jika tidak ada
    const ta = parseFloat(document.getElementById('antemper_uprec').value) || 0;
    const to = parseFloat(document.getElementById('spactemp_uprec').value) || 0;
    const tlna = parseFloat(document.getElementById('tlna_uprec').value) || 0;
    
    // Coba ambil elemen 2nd stage temperature
    let t2ndInput = document.getElementById('2ndstagetemp_uprec');
    // Jika tidak ditemukan, mungkin karena konflik ID dengan div
    if (!t2ndInput || t2ndInput.tagName !== 'INPUT') {
        // Coba cari input di dalam div dengan ID yang sama
        const div2ndStage = document.getElementById('2ndstagetemp_uprec');
        if (div2ndStage) {
            t2ndInput = div2ndStage.querySelector('input');
        }
    }
    
    const t2nd = t2ndInput ? (parseFloat(t2ndInput.value) || 0) : 0;
    const glna = parseFloat(document.getElementById('glna_uprec').value) || 1;  // Default 1, bukan 0

    // Log debug untuk memverifikasi input nilai
    console.log("Menghitung Ts dengan nilai:", {
        alpha, ta, to, tlna, t2nd, glna
    });

    // Rumus perhitungan Ts = (Ta * α) + (To * (1-α)) + TLNA + (T2ndStage / GLNA)
    let ts = 0;
    
    if (glna > 0) {  // Hindari pembagian dengan nol
        ts = (ta * alpha) + (to * (1 - alpha)) + tlna + (t2nd / glna);
    } else if (t2nd > 0) {
        // Jika GLNA = 0 tapi T2ndStage > 0, tandai sebagai error
        document.getElementById('ts_uprec').value = "Error: GLNA tidak boleh nol";
        console.error("Error: Pembagian dengan nol (GLNA = 0)");
        return;
    } else {
        // Jika T2ndStage = 0, abaikan bagian terakhir dari rumus
        ts = (ta * alpha) + (to * (1 - alpha)) + tlna;
    }
    
    // Menampilkan hasil
    document.getElementById('ts_uprec').value = ts.toFixed(2);
    
    // Log hasil untuk debugging
    console.log("Hasil perhitungan Ts:", ts);
}

// Inisialisasi perhitungan dan menyiapkan event listener saat DOM siap
document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM fully loaded, menginisialisasi kalkulator");
    
    // Inisialisasi nilai default untuk koefisien transmisi
    if (!document.getElementById("tranlincoe_uprec").value) {
        document.getElementById("tranlincoe_uprec").value = "1.0000";
    }
    
    // Inisialisasi nilai default untuk total losses
    if (!document.getElementById("antenna to lna_uprec").value) {
        document.getElementById("antenna to lna_uprec").value = "0.00";
    }

    // Menyiapkan event listener untuk perhitungan kabel
    ["typecable", "alength_uprec", "blength_uprec", "clength_uprec"].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            console.log(`Menyiapkan listener untuk ${id}`);
            el.addEventListener("input", calculateTotalLossComponent);
        } else {
            console.warn(`Elemen dengan id ${id} tidak ditemukan`);
        }
    });

    // Menyiapkan event listener untuk parameter loss lainnya
    ["lbpf_uprec", "lother_uprec"].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            console.log(`Menyiapkan listener untuk ${id}`);
            el.addEventListener("input", calculateTotalLossFinal);
        } else {
            console.warn(`Elemen dengan id ${id} tidak ditemukan`);
        }
    });

    // Menyiapkan event listener untuk konektor
    const connectorInput = document.getElementById("connect_uprec");
    if (connectorInput) {
        console.log("Menyiapkan listener untuk connect_uprec");
        connectorInput.addEventListener("input", calculateTotalConnector);
    } else {
        console.warn("Elemen dengan id connect_uprec tidak ditemukan");
    }

    // Menyiapkan event listener untuk gain LNA
    const lnaGainInput = document.getElementById("lnagain_uprec");
    if (lnaGainInput) {
        console.log("Menyiapkan listener untuk lnagain_uprec");
        lnaGainInput.addEventListener("input", calculateGLNA);
    } else {
        console.warn("Elemen dengan id lnagain_uprec tidak ditemukan");
    }

    // Menyiapkan event listener untuk input perhitungan Ts
    ["antemper_uprec", "spactemp_uprec", "tlna_uprec"].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            console.log(`Menyiapkan listener untuk ${id}`);
            el.addEventListener("input", calculateTs);
        } else {
            console.warn(`Elemen dengan id ${id} tidak ditemukan`);
        }
    });
    
    // Khusus untuk 2ndstagetemp_uprec, coba cari dengan cara berbeda
    let t2ndInput = document.getElementById('2ndstagetemp_uprec');
    if (t2ndInput && t2ndInput.tagName === 'INPUT') {
        console.log("Menyiapkan listener untuk 2ndstagetemp_uprec");
        t2ndInput.addEventListener("input", calculateTs);
    } else {
        // Coba cari input di dalam div dengan ID yang sama
        const div2ndStage = document.getElementById('2ndstagetemp_uprec');
        if (div2ndStage) {
            t2ndInput = div2ndStage.querySelector('input');
            if (t2ndInput) {
                console.log("Menyiapkan listener untuk input 2nd stage temperature");
                t2ndInput.addEventListener("input", calculateTs);
            } else {
                console.warn("Input 2nd stage temperature tidak ditemukan");
            }
        } else {
            console.warn("Elemen dengan id 2ndstagetemp_uprec tidak ditemukan");
        }
    }

// Menjalankan perhitungan awal untuk memastikan nilai ditampilkan
    try {
        calculateTotalLossComponent();
        calculateGLNA();
        calculateTs();
        console.log("Perhitungan awal selesai");
    } catch (error) {
        console.error("Error selama perhitungan awal:", error);
    }
});

    // script downlink
    
// Downlink functions with fixes
function calculateTotalLossDownlink() {
    // Mengambil nilai dari form input
    const cableLoss = parseFloat(document.getElementById("typecable_downrec").value) || 0;
    const aLength = parseFloat(document.getElementById("alength_downrec").value) || 0;
    const bLength = parseFloat(document.getElementById("blength_downrec").value) || 0;
    const cLength = parseFloat(document.getElementById("clength_downrec").value) || 0;

    // Menghitung loss untuk setiap line (LA, LB, LC)
    const la = aLength * cableLoss;
    const lb = bLength * cableLoss;
    const lc = cLength * cableLoss;

    // Tampilkan hasil perhitungan di kolom LA, LB, LC
    document.getElementById("la_downrec").value = la.toFixed(2);
    document.getElementById("lb_downrec").value = lb.toFixed(2);
    document.getElementById("lc_downrec").value = lc.toFixed(2);

    // Lanjutkan perhitungan untuk total loss
    calculateTotalLossFinalDownlink();
}

// Fungsi untuk menghitung total loss dari konektor untuk Downlink
function calculateTotalConnectorDownlink() {
    const connectorValue = parseFloat(document.getElementById('connect_downrec').value) || 0;
    const totalLoss = connectorValue * 0.05; // Loss per konektor = 0.05 dB
    document.getElementById('totconnect_downrec').value = totalLoss.toFixed(2);
    calculateTotalLossFinalDownlink();
}

// Fungsi untuk menghitung total loss keseluruhan untuk Downlink
function calculateTotalLossFinalDownlink() {
    // Mengambil semua nilai loss untuk Downlink
    const la = parseFloat(document.getElementById('la_downrec').value) || 0;
    const lb = parseFloat(document.getElementById('lb_downrec').value) || 0;
    const lc = parseFloat(document.getElementById('lc_downrec').value) || 0;
    const lbpf = parseFloat(document.getElementById('lbpf_downrec').value) || 0;
    const lother = parseFloat(document.getElementById('lother_downrec').value) || 0;
    const totconnect = parseFloat(document.getElementById('totconnect_downrec').value) || 0;

    // Menghitung total loss untuk Downlink
    const total = la + lb + lc + lbpf + lother + totconnect;

    // Menampilkan hasil total loss
    document.getElementById('antenna_to_lna_downrec').value = total.toFixed(2);

    // Hitung koefisien transmisi untuk Downlink
    calculateTransmissionCoefficientDownlink();
}

// Fungsi untuk menghitung koefisien transmisi (α) untuk Downlink
function calculateTransmissionCoefficientDownlink() {
    const totalLossDb = parseFloat(document.getElementById('antenna_to_lna_downrec').value) || 0;

    if (totalLossDb !== 0) {
        const coefficient = Math.pow(10, -totalLossDb / 10);
        document.getElementById('tranlincoe_downrec').value = coefficient.toFixed(4);
    } else {
        document.getElementById('tranlincoe_downrec').value = "0.00";
    }

    calculateTsDownlink();
}

// Fungsi untuk menghitung GLNA dari gain LNA untuk Downlink
function calculateGLNADownlink() {
    const lnagainInput = document.getElementById('lnagain_downrec');
    const glnaOutput = document.getElementById('glna_downrec');

    const lnagain = parseFloat(lnagainInput.value) || 0;

    // Konversi dari dB ke nilai numerik
    if (!isNaN(lnagain)) {
        const glna = Math.pow(10, lnagain / 10);
        glnaOutput.value = glna.toFixed(2);
    } else {
        glnaOutput.value = "1.00";
    }
    
    // Perbarui Ts ketika GLNA berubah
    calculateTsDownlink();
}

// Fungsi untuk menghitung Cable/Waveguide D Loss untuk Downlink
function calculateDLossDownlink() {
    // Mengambil nilai panjang kabel/waveguide (meter) dan loss per meter
    const length = parseFloat(document.getElementById('dloss_length_downrec').value) || 0;
    const lossPerMeter = parseFloat(document.getElementById('dloss_per_meter_downrec').value) || 0;

    // Menghitung total D Loss dengan rumus: Length * Loss per Meter
    const totalLoss = length * lossPerMeter;

    // Menampilkan hasil total D Loss
    document.getElementById('dloss_result_downrec').value = totalLoss.toFixed(2);
    
    // Recalculate Ts whenever D loss changes
    calculateTsDownlink();
}

// DIPERBAIKI: Fungsi yang direvisi untuk menghitung System Noise Temperature (Ts) untuk Downlink
function calculateTsDownlink() {
    const alpha = parseFloat(document.getElementById('tranlincoe_downrec').value) || 1;
    const ta = parseFloat(document.getElementById('antemper_downrec').value) || 0;
    const to = parseFloat(document.getElementById('spactemp_downrec').value) || 0;
    const tlna = parseFloat(document.getElementById('tlna_downrec').value) || 0;
    const tcomRcvr = parseFloat(document.getElementById('tcomrcvr_downrec').value) || 0;
    const dLoss = parseFloat(document.getElementById('dloss_result_downrec').value) || 0;
    let glna = parseFloat(document.getElementById('glna_downrec').value) || 1;

    let ts = 0;

    // Menghitung Ts berdasarkan rumus yang benar
    // Ta*α+To*(1-α)+TLNA+(TComRvcr/(GLNA/(10^(Cable/Waveguide D Loss/10))))
    if (glna > 0) {
        // Menghitung faktor reduksi gain karena D Loss: 10^(dLoss/10)
        const dLossFactor = Math.pow(10, dLoss/10);
        
        // GLNA efektif setelah memperhitungkan D Loss
        const effectiveGLNA = glna / dLossFactor;
        
        // Formula untuk downlink Ts dengan D Loss yang benar
        ts = (ta * alpha) + (to * (1 - alpha)) + tlna + (tcomRcvr / effectiveGLNA);
    } else {
        // Kasus GLNA = 0 (tidak mungkin dalam praktik, tapi ada untuk mencegah pembagian dengan nol)
        ts = (ta * alpha) + (to * (1 - alpha)) + tlna;
    }

    // Menampilkan hasil perhitungan Ts
    document.getElementById('ts_downrec').value = ts.toFixed(2);
}

// Set up all the event listeners when the document is loaded
document.addEventListener("DOMContentLoaded", function() {
    // Initialize uplink calculations if needed
    
    // Set initial values for read-only fields
    document.getElementById('tranlincoe_downrec').value = "1.0000";
    document.getElementById('antenna_to_lna_downrec').value = "0.00";
    
    // Set up event listeners for cable/waveguide input fields
    const cableInputs = ["typecable_downrec", "alength_downrec", "blength_downrec", "clength_downrec"];
    cableInputs.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener("input", calculateTotalLossDownlink);
        }
    });
    
    // Set up event listeners for other loss inputs
    const otherLossInputs = ["lbpf_downrec", "lother_downrec"];
    otherLossInputs.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener("input", calculateTotalLossFinalDownlink);
        }
    });
    
    // Set up connector input event listener
    const connectorInput = document.getElementById("connect_downrec");
    if (connectorInput) {
        connectorInput.addEventListener("input", calculateTotalConnectorDownlink);
    }
    
    // Set up LNA gain input event listener
    const lnaGainInput = document.getElementById("lnagain_downrec");
    if (lnaGainInput) {
        lnaGainInput.addEventListener("input", calculateGLNADownlink);
    }
    
    // Set up D Loss calculation inputs
    const dLossInputs = ["dloss_length_downrec", "dloss_per_meter_downrec"];
    dLossInputs.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener("input", calculateDLossDownlink);
        }
    });
    
    // Set up temperature inputs
    const tempInputs = ["antemper_downrec", "spactemp_downrec", "tlna_downrec", "tcomrcvr_downrec"];
    tempInputs.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener("input", calculateTsDownlink);
        }
    });
    
    // Run initial calculations
    try {
        calculateTotalLossDownlink();
        calculateGLNADownlink();
        calculateDLossDownlink();
        calculateTsDownlink();
    } catch (error) {
        console.error("Error during initial downlink calculations:", error);
    }
});

// Fungsi untuk perhitungan Uplink dan Downlink secara bersamaan
document.addEventListener('DOMContentLoaded', function () {
    // Bind input events untuk Uplink
    document.querySelectorAll("#typecable, #alength_uprec, #blength_uprec, #clength_uprec").forEach(function (el) {
        el.addEventListener("input", calculateTotalLossComponent);
    });

    document.querySelector("#connect_uprec").addEventListener("input", calculateTotalConnector);

    // Bind input events untuk Downlink
    document.querySelectorAll("#typecable_downrec, #alength_downrec, #blength_downrec, #clength_downrec").forEach(function (el) {
        el.addEventListener("input", calculateTotalLossComponentDownlink);
    });

    document.querySelector("#connect_downrec").addEventListener("input", calculateTotalConnectorDownlink);
});

// POP-UP 

// ========== KONFIGURASI POPUP UPLINK ==========
document.addEventListener("DOMContentLoaded", function() {
    // Buat array pasangan ID tombol popup dan ID popup
    const popupPairs = [
        // Popup Uplink
        { buttonId: 'la_popup_btn', popupId: 'la_popup', inputId: 'la_uprec', formulaId: 'la_formula', 
          formula: "LA = Panjang Kabel × Loss per meter", 
          detailFunc: (val) => {
            const length = parseFloat(document.getElementById("alength_uprec").value) || 0;
            const loss = parseFloat(document.getElementById("typecable").value) || 0;
            return `<p>Panjang Kabel A = ${length} meter</p><p>Loss per meter = ${loss} dB/meter</p><p>LA = ${length} × ${loss} = ${val} dB</p>`;
          }
        },
        { buttonId: 'lb_popup_btn', popupId: 'lb_popup', inputId: 'lb_uprec', formulaId: 'lb_formula', 
          formula: "LB = Panjang Kabel × Loss per meter", 
          detailFunc: (val) => {
            const length = parseFloat(document.getElementById("blength_uprec").value) || 0;
            const loss = parseFloat(document.getElementById("typecable").value) || 0;
            return `<p>Panjang Kabel B = ${length} meter</p><p>Loss per meter = ${loss} dB/meter</p><p>LB = ${length} × ${loss} = ${val} dB</p>`;
          }
        },
        { buttonId: 'lc_popup_btn', popupId: 'lc_popup', inputId: 'lc_uprec', formulaId: 'lc_formula', 
          formula: "LC = Panjang Kabel × Loss per meter", 
          detailFunc: (val) => {
            const length = parseFloat(document.getElementById("clength_uprec").value) || 0;
            const loss = parseFloat(document.getElementById("typecable").value) || 0;
            return `<p>Panjang Kabel C = ${length} meter</p><p>Loss per meter = ${loss} dB/meter</p><p>LC = ${length} × ${loss} = ${val} dB</p>`;
          }
        },
        { buttonId: 'totconnect_popup_btn', popupId: 'totconnect_popup', inputId: 'totconnect_uprec', formulaId: 'totconnect_formula', 
          formula: "L<sub>connector</sub> = Jumlah Konektor × 0,05 dB", 
          detailFunc: (val) => {
            const connectors = parseFloat(document.getElementById("connect_uprec").value) || 0;
            return `<p>Jumlah Konektor = ${connectors}</p><p>Loss per konektor = 0,05 dB</p><p>L<sub>connector</sub> = ${connectors} × 0,05 = ${val} dB</p>`;
          }
        },
        { buttonId: 'antenna_popup_btn', popupId: 'antenna_popup', inputId: 'antenna to lna_uprec', formulaId: 'antenna_formula', 
          formula: "L<sub>total</sub> = LA + LB + LC + L<sub>BPF</sub> + L<sub>other</sub> + L<sub>connector</sub>", 
          detailFunc: (val) => {
            const la = parseFloat(document.getElementById("la_uprec").value) || 0;
            const lb = parseFloat(document.getElementById("lb_uprec").value) || 0;
            const lc = parseFloat(document.getElementById("lc_uprec").value) || 0;
            const lbpf = parseFloat(document.getElementById("lbpf_uprec").value) || 0;
            const lother = parseFloat(document.getElementById("lother_uprec").value) || 0;
            const connector = parseFloat(document.getElementById("totconnect_uprec").value) || 0;
            return `<p>LA = ${la} dB</p><p>LB = ${lb} dB</p><p>LC = ${lc} dB</p><p>L<sub>BPF</sub> = ${lbpf} dB</p><p>L<sub>other</sub> = ${lother} dB</p><p>L<sub>connector</sub> = ${connector} dB</p><p>L<sub>total</sub> = ${la} + ${lb} + ${lc} + ${lbpf} + ${lother} + ${connector} = ${val} dB</p>`;
          }
        },
        { buttonId: 'tranlincoe_popup_btn', popupId: 'tranlincoe_popup', inputId: 'tranlincoe_uprec', formulaId: 'tranlincoe_formula', 
          formula: "α = 10<sup>(-L<sub>total</sub> / 10)</sup>", 
          detailFunc: (val) => {
            const loss = parseFloat(document.getElementById("antenna to lna_uprec").value) || 0;
            return `<p>L<sub>total</sub> = ${loss} dB</p><p>α = 10<sup>(-${loss} / 10)</sup> = ${val}</p>`;
          }
        },
        { buttonId: 'glna_popup_btn', popupId: 'glna_popup', inputId: 'glna_uprec', formulaId: 'glna_formula', 
          formula: "G<sub>LNA</sub> = 10<sup>(Gain<sub>LNA</sub> / 10)</sup>", 
          detailFunc: (val) => {
            const gain = parseFloat(document.getElementById("lnagain_uprec").value) || 0;
            return `<p>Gain<sub>LNA</sub> = ${gain} dB</p><p>G<sub>LNA</sub> = 10<sup>(${gain} / 10)</sup> = ${val}</p>`;
          }
        },
        { buttonId: 'ts_popup_btn', popupId: 'ts_popup', inputId: 'ts_uprec', formulaId: 'ts_formula', 
          formula: "T<sub>s</sub> = (T<sub>a</sub> × α) + (T<sub>o</sub> × (1 - α)) + T<sub>LNA</sub> + (T<sub>2ndStage</sub> / G<sub>LNA</sub>)", 
          detailFunc: (val) => {
            const alpha = parseFloat(document.getElementById("tranlincoe_uprec").value) || 0;
            const ta = parseFloat(document.getElementById("antemper_uprec").value) || 0;
            const to = parseFloat(document.getElementById("spactemp_uprec").value) || 0;
            const tlna = parseFloat(document.getElementById("tlna_uprec").value) || 0;
            const t2nd = parseFloat(document.getElementById("2ndstagetemp_uprec").value) || 0;
            const glna = parseFloat(document.getElementById("glna_uprec").value) || 1;
            
            const part1 = ta * alpha;
            const part2 = to * (1 - alpha);
            const part3 = tlna;
            const part4 = t2nd / glna;
            
            return `<p>T<sub>a</sub> = ${ta} K</p><p>α = ${alpha}</p><p>T<sub>o</sub> = ${to} K</p><p>T<sub>LNA</sub> = ${tlna} K</p><p>T<sub>2ndStage</sub> = ${t2nd} K</p><p>G<sub>LNA</sub> = ${glna}</p><p>T<sub>s</sub> = (${ta} × ${alpha}) + (${to} × (1 - ${alpha})) + ${tlna} + (${t2nd} / ${glna})</p><p>T<sub>s</sub> = ${part1.toFixed(2)} + ${part2.toFixed(2)} + ${part3} + ${part4.toFixed(2)} = ${val} K</p>`;
          }
        },
        
        // Popup Downlink
        { buttonId: 'la_downrec_popup_btn', popupId: 'la_downrec_popup', inputId: 'la_downrec', formulaId: 'la_downrec_formula', 
          formula: "LA = Panjang Kabel × Loss per meter", 
          detailFunc: (val) => {
            const length = parseFloat(document.getElementById("alength_downrec").value) || 0;
            const loss = parseFloat(document.getElementById("typecable_downrec").value) || 0;
            return `<p>Panjang Kabel A = ${length} meter</p><p>Loss per meter = ${loss} dB/meter</p><p>LA = ${length} × ${loss} = ${val} dB</p>`;
          }
        },
        { buttonId: 'lb_downrec_popup_btn', popupId: 'lb_downrec_popup', inputId: 'lb_downrec', formulaId: 'lb_downrec_formula', 
          formula: "LB = Panjang Kabel × Loss per meter", 
          detailFunc: (val) => {
            const length = parseFloat(document.getElementById("blength_downrec").value) || 0;
            const loss = parseFloat(document.getElementById("typecable_downrec").value) || 0;
            return `<p>Panjang Kabel B = ${length} meter</p><p>Loss per meter = ${loss} dB/meter</p><p>LB = ${length} × ${loss} = ${val} dB</p>`;
          }
        },
        { buttonId: 'lc_downrec_popup_btn', popupId: 'lc_downrec_popup', inputId: 'lc_downrec', formulaId: 'lc_downrec_formula', 
          formula: "LC = Panjang Kabel × Loss per meter", 
          detailFunc: (val) => {
            const length = parseFloat(document.getElementById("clength_downrec").value) || 0;
            const loss = parseFloat(document.getElementById("typecable_downrec").value) || 0;
            return `<p>Panjang Kabel C = ${length} meter</p><p>Loss per meter = ${loss} dB/meter</p><p>LC = ${length} × ${loss} = ${val} dB</p>`;
          }
        },
        { buttonId: 'totconnect_downrec_popup_btn', popupId: 'totconnect_downrec_popup', inputId: 'totconnect_downrec', formulaId: 'totconnect_downrec_formula', 
          formula: "L<sub>connector</sub> = Jumlah Konektor × 0,05 dB", 
          detailFunc: (val) => {
            const connectors = parseFloat(document.getElementById("connect_downrec").value) || 0;
            return `<p>Jumlah Konektor = ${connectors}</p><p>Loss per konektor = 0,05 dB</p><p>L<sub>connector</sub> = ${connectors} × 0,05 = ${val} dB</p>`;
          }
        },
        { buttonId: 'antenna_downrec_popup_btn', popupId: 'antenna_downrec_popup', inputId: 'antenna_to_lna_downrec', formulaId: 'antenna_downrec_formula', 
          formula: "L<sub>total</sub> = LA + LB + LC + L<sub>BPF</sub> + L<sub>other</sub> + L<sub>connector</sub>", 
          detailFunc: (val) => {
            const la = parseFloat(document.getElementById("la_downrec").value) || 0;
            const lb = parseFloat(document.getElementById("lb_downrec").value) || 0;
            const lc = parseFloat(document.getElementById("lc_downrec").value) || 0;
            const lbpf = parseFloat(document.getElementById("lbpf_downrec").value) || 0;
            const lother = parseFloat(document.getElementById("lother_downrec").value) || 0;
            const connector = parseFloat(document.getElementById("totconnect_downrec").value) || 0;
            return `<p>LA = ${la} dB</p><p>LB = ${lb} dB</p><p>LC = ${lc} dB</p><p>L<sub>BPF</sub> = ${lbpf} dB</p><p>L<sub>other</sub> = ${lother} dB</p><p>L<sub>connector</sub> = ${connector} dB</p><p>L<sub>total</sub> = ${la} + ${lb} + ${lc} + ${lbpf} + ${lother} + ${connector} = ${val} dB</p>`;
          }
        },
        { buttonId: 'tranlincoe_downrec_popup_btn', popupId: 'tranlincoe_downrec_popup', inputId: 'tranlincoe_downrec', formulaId: 'tranlincoe_downrec_formula', 
          formula: "α = 10<sup>(-L<sub>total</sub> / 10)</sup>", 
          detailFunc: (val) => {
            const loss = parseFloat(document.getElementById("antenna_to_lna_downrec").value) || 0;
            return `<p>L<sub>total</sub> = ${loss} dB</p><p>α = 10<sup>(-${loss} / 10)</sup> = ${val}</p>`;
          }
        },
        { buttonId: 'glna_downrec_popup_btn', popupId: 'glna_downrec_popup', inputId: 'glna_downrec', formulaId: 'glna_downrec_formula', 
          formula: "G<sub>LNA</sub> = 10<sup>(Gain<sub>LNA</sub> / 10)</sup>", 
          detailFunc: (val) => {
            const gain = parseFloat(document.getElementById("lnagain_downrec").value) || 0;
            return `<p>Gain<sub>LNA</sub> = ${gain} dB</p><p>G<sub>LNA</sub> = 10<sup>(${gain} / 10)</sup> = ${val}</p>`;
          }
        },
        { buttonId: 'dloss_downrec_popup_btn', popupId: 'dloss_downrec_popup', inputId: 'dloss_result_downrec', formulaId: 'dloss_downrec_formula', 
          formula: "D<sub>loss</sub> = Panjang Kabel × Loss per meter", 
          detailFunc: (val) => {
            const length = parseFloat(document.getElementById("dloss_length_downrec").value) || 0;
            const loss = parseFloat(document.getElementById("dloss_per_meter_downrec").value) || 0;
            return `<p>Panjang Kabel D = ${length} meter</p><p>Loss per meter = ${loss} dB/meter</p><p>D<sub>loss</sub> = ${length} × ${loss} = ${val} dB</p>`;
          }
        },
        { buttonId: 'ts_downrec_popup_btn', popupId: 'ts_downrec_popup', inputId: 'ts_downrec', formulaId: 'ts_downrec_formula', 
          formula: "T<sub>s</sub> = (T<sub>a</sub> × α) + (T<sub>o</sub> × (1 - α)) + T<sub>LNA</sub> + (T<sub>ComRcvr</sub> / (G<sub>LNA</sub> / 10<sup>(D<sub>loss</sub> / 10)</sup>))", 
          detailFunc: (val) => {
            const alpha = parseFloat(document.getElementById("tranlincoe_downrec").value) || 0;
            const ta = parseFloat(document.getElementById("antemper_downrec").value) || 0;
            const to = parseFloat(document.getElementById("spactemp_downrec").value) || 0;
            const tlna = parseFloat(document.getElementById("tlna_downrec").value) || 0;
            const tComRcvr = parseFloat(document.getElementById("tcomrcvr_downrec").value) || 0;
            const glna = parseFloat(document.getElementById("glna_downrec").value) || 1;
            const dLoss = parseFloat(document.getElementById("dloss_result_downrec").value) || 0;
            
            const dLossFactor = Math.pow(10, dLoss/10);
            const effectiveGLNA = glna / dLossFactor;
            
            const part1 = ta * alpha;
            const part2 = to * (1 - alpha);
            const part3 = tlna;
            const part4 = tComRcvr / effectiveGLNA;
            
            return `<p>T<sub>a</sub> = ${ta} K</p><p>α = ${alpha}</p><p>T<sub>o</sub> = ${to} K</p><p>T<sub>LNA</sub> = ${tlna} K</p><p>T<sub>ComRcvr</sub> = ${tComRcvr} K</p><p>G<sub>LNA</sub> = ${glna}</p><p>D<sub>loss</sub> = ${dLoss} dB</p><p>G<sub>LNA</sub> Efektif = ${glna} / 10<sup>(${dLoss} / 10)</sup> = ${effectiveGLNA.toFixed(4)}</p><p>T<sub>s</sub> = (${ta} × ${alpha}) + (${to} × (1 - ${alpha})) + ${tlna} + (${tComRcvr} / ${effectiveGLNA.toFixed(4)})</p><p>T<sub>s</sub> = ${part1.toFixed(2)} + ${part2.toFixed(2)} + ${part3} + ${part4.toFixed(2)} = ${val} K</p>`;
          }
        }
    ];
    
    // Untuk setiap pasangan popup, tambahkan event listener untuk tombol
    popupPairs.forEach(pair => {
        const button = document.getElementById(pair.buttonId);
        if (button) {
            button.addEventListener('click', function() {
                openDetailPopup(pair.popupId, pair.inputId, pair.formulaId, pair.formula, pair.detailFunc);
            });
        }
    });
    
    // Tambahkan event listener untuk tombol tutup pada semua popup
    document.querySelectorAll('.close-popup-btn').forEach(button => {
        button.addEventListener('click', function() {
            closeAllPopups();
        });
    });
});

// Fungsi untuk membuka popup detail
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
    
    // Tampilkan popup
    popup.style.display = "flex";
}

// Fungsi untuk menutup semua popup
function closeAllPopups() {
    document.querySelectorAll('.popup-window').forEach(popup => {
        popup.style.display = "none";
    });
}

</script>
</x-layout>