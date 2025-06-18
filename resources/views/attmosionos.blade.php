<x-layout>
    <x-slot:title>Atmospheric and Ionospheric Losses</x-slot:title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* Custom styles for animations and appearance from calc.blade.php */
        .input-unit {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280; /* gray-500 */
            font-size: 0.875rem; /* text-sm */
            pointer-events: none; /* Make sure it doesn't block input clicks */
        }

        /* Styling for readonly inputs from calc.blade.php */
        input[readonly] {
            background-color: #e6f4e1; /* Lighter green */
            color: #166534; /* Darker green text */
            border-color: #81c784; /* Green border */
            cursor: not-allowed;
            font-weight: 500;
        }

        /* Ensure input focus styles are prominent from calc.blade.php */
        input[type="number"]:focus,
        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3B82F6; /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5); /* blue-500 with opacity */
        }

        /* Adjust labels for full visibility when not in sections from calc.blade.php */
        .form-section-label {
            display: block;
            font-weight: bold;
            color: #1F2937; /* gray-800 */
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #E5E7EB; /* gray-200 */
        }
    </style>

    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl border-t-8 border-blue-600 transform transition-all duration-300 hover:shadow-3xl">
            <h1 class="text-3xl sm:text-4xl font-extrabold mb-4 text-center text-gray-800 animate__animated animate__fadeInDown">
                <i class="fas fa-cloud-sun-rain mr-2 text-blue-600"></i> Atmospheric and Ionospheric Losses
            </h1>
            <p class="text-center text-gray-600 mb-8 text-lg animate__animated animate__fadeInUp animate__delay-0.5s">
                Calculate and determine atmospheric and ionospheric losses based on elevation angle and frequency.
            </p>

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 animate__animated animate__fadeIn">Loss due to Atmospheric Gases</h2>

            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm mb-8 animate__animated animate__fadeInUp">
                <h3 class="text-lg font-bold text-center text-gray-800 mb-3">Uplink and Downlink:</h3>

                <div class="overflow-hidden rounded-lg border border-gray-200 mb-6">
                    <div class="grid grid-cols-3 font-bold bg-blue-600 text-white py-3 text-base text-center">
                        <div>Elevation Angle:</div>
                        <div>Loss:</div>
                        <div>Unit:</div>
                    </div>

                    <div class="text-base bg-gray-50">
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>0°</div>
                            <div>10.2</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>2.5°</div>
                            <div>4.6</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>5°</div>
                            <div>2.1</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>10°</div>
                            <div>1.1</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>30°</div>
                            <div>0.4</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 border-b border-gray-200 text-center">
                            <div>45°</div>
                            <div>0.3</div>
                            <div>dB</div>
                        </div>
                        <div class="grid grid-cols-3 py-2 text-center">
                            <div>90°</div>
                            <div>0.0</div>
                            <div>dB</div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('attmosionos.store', ['id' => $dataId]) }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="user_id" value="1">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label for="min_elevation_angle" class="block font-medium mb-2 text-gray-700">Min. Elev. Angle:</label>
                            <input
                                type="number"
                                name="min_elevation_angle"
                                id="min_elevation_angle"
                                step="0.1"
                                min="0"
                                max="90"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pl-4 pr-16 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                value=""
                                required
                                oninput="updateAtmosphericLoss()"
                                placeholder="Enter angle"
                            >
                            <span class="input-unit right-3">deg.</span>
                        </div>

                        <div class="relative">
                            <label for="loss_determined_atmospheric" class="block font-medium mb-2 text-gray-700">Loss Determined:</label>
                            <input
                                type="text"
                                name="loss_determined_atmospheric"
                                id="loss_determined_atmospheric"
                                class="border border-gray-300 p-3 w-full rounded-lg bg-gray-50 shadow-sm pr-16"
                                value=""
                                readonly
                            >
                            <span class="input-unit right-3">dB</span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm animate__animated animate__fadeInLeft">
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">Loss due to Ionosphere:</h3>
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">(Uplink):</h3>

                    <div class="mb-4 bg-pink-100 text-gray-800 font-medium py-2 px-3 rounded flex justify-between items-center border border-pink-200">
                        <span>Uplink Loss Determined:</span>
                        <span id="uplink_loss_determined_display" class="border border-gray-300 p-3 w-24 rounded bg-gray-50 text-center font-bold"
                        style="background-color: #e6f4e1; color:rgb(22, 101, 52); border-color: #81c784;">0.0 dB</span>
                    </div>

                    <div class="overflow-hidden rounded-lg border border-gray-200 mb-4">
                        <div class="grid grid-cols-2 bg-blue-600 text-white font-bold py-2 text-sm text-center">
                            <div class="border-r border-blue-400">Frequency:</div>
                            <div>Loss:</div>
                        </div>

                        <div class="text-sm">
                            <div class="grid grid-cols-2">
                                <div class="py-2 bg-gray-50 border-r border-gray-200 relative">
                                    <input
                                        type="number"
                                        name="uplink_frequency"
                                        id="uplink_frequency"
                                        step="0.1"
                                        min="0"
                                        class="w-full bg-blue-100 border border-blue-300 rounded text-center font-bold focus:outline-none focus:ring-2 focus:ring-blue-500 p-2"
                                        value=""
                                        oninput="updateUplinkIonosphericLoss()"
                                        placeholder="Freq."
                                    >
                                    <span class="input-unit right-3">MHz</span>
                                </div>
                                <div class="py-2 bg-green-200 font-bold relative">
                                    <input
                                        type="number"
                                        name="uplink_loss_ionosphere"
                                        id="uplink_loss_ionosphere"
                                        step="0.1"
                                        min="0"
                                        class="w-full bg-blue-100 border border-blue-300 rounded text-center font-bold focus:outline-none focus:ring-2 focus:ring-blue-500 p-2"
                                        value=""
                                        oninput="updateUplinkIonosphericLoss()"
                                        placeholder="Loss"
                                    >
                                    <span class="input-unit right-3">dB</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <div class="inline-flex items-center bg-red-50 p-2 rounded-md shadow-sm">
                            <div class="w-0 h-0 border-l-4 border-r-4 border-b-4 border-l-transparent border-r-transparent border-b-red-500 mr-2"></div>
                            <p class="text-red-600 text-sm font-medium">
                                Link Model Operator Estimate Inserted Here.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 shadow-sm animate__animated animate__fadeInRight">
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">Loss due to Ionosphere:</h3>
                    <h3 class="text-lg font-bold text-center text-gray-800 mb-3">(Downlink):</h3>
                    
                    <div class="mb-4 bg-pink-100 text-gray-800 font-medium py-2 px-3 rounded flex justify-between items-center border border-pink-200">
                        <span>Downlink Loss Determined:</span>
                        <span id="downlink_loss_determined_display" class="border border-gray-300 p-3 w-24 rounded bg-gray-50 text-center font-bold"
                        style="background-color: #e6f4e1; color:rgb(22, 101, 52); border-color: #81c784;">0.0 dB</span>
                    </div>

                    <div class="overflow-hidden rounded-lg border border-gray-200 mb-4">
                        <div class="grid grid-cols-2 bg-blue-600 text-white font-bold py-2 text-sm text-center">
                            <div class="border-r border-blue-400">Frequency:</div>
                            <div>Loss:</div>
                        </div>

                        <div class="text-sm">
                            <div class="grid grid-cols-2">
                                <div class="py-2 bg-gray-50 border-r border-gray-200 relative">
                                    <input
                                        type="number"
                                        name="downlink_frequency"
                                        id="downlink_frequency"
                                        step="0.1"
                                        min="0"
                                        class="w-full bg-blue-100 border border-blue-300 rounded text-center font-bold focus:outline-none focus:ring-2 focus:ring-blue-500 p-2"
                                        value=""
                                        oninput="updateDownlinkIonosphericLoss()"
                                        placeholder="Freq."
                                    >
                                    <span class="input-unit right-3">MHz</span>
                                </div>
                                <div class="py-2 bg-green-200 font-bold relative">
                                    <input
                                        type="number"
                                        name="downlink_loss_ionosphere"
                                        id="downlink_loss_ionosphere"
                                        step="0.1"
                                        min="0"
                                        class="w-full bg-blue-100 border border-blue-300 rounded text-center font-bold focus:outline-none focus:ring-2 focus:ring-blue-500 p-2"
                                        value=""
                                        oninput="updateDownlinkIonosphericLoss()"
                                        placeholder="Loss"
                                    >
                                    <span class="input-unit right-3">dB</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <div class="inline-flex items-center bg-red-50 p-2 rounded-md shadow-sm">
                            <div class="w-0 h-0 border-l-4 border-r-4 border-b-4 border-l-transparent border-r-transparent border-b-red-500 mr-2"></div>
                            <p class="text-red-600 text-sm font-medium">
                                Link Model Operator Estimate Inserted Here.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                 <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 w-full font-bold text-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-calculator mr-2"></i> Hitung & Simpan Parameter Atmospheric Losses
                    </button>
            <div class="flex justify-between mt-6">
                <a href="/annpolaloss/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 transition-colors duration-200">
                    <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
                </a>
                {{-- If you have a next page, uncomment and adjust the link below --}}
                {{-- <a href="/next-page/{{$dataId}}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200">
                    Halaman Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                </a> --}}
            </div>
        </div>
    </div>

    <script>
        /**
         * Calculates the atmospheric loss based on the given minimum elevation angle
         * using a lookup table and interpolation logic similar to the provided Excel formula.
         *
         * @param {number} minElevationAngle - The minimum elevation angle in degrees.
         * @returns {number} The calculated loss in dB, rounded to one decimal place.
         */
        function calculateAtmosphericLoss(minElevationAngle) {
            // Define the lookup table data from your image
            const elevationAngles = [0, 2.5, 5, 10, 30, 45, 90];
            const losses = [10.2, 4.6, 2.1, 1.1, 0.4, 0.3, 0.0];

            // Get the value of B8 from the table, which is elevationAngles[1] (2.5 degrees)
            const B8_elevationAngle = elevationAngles[1]; // 2.5

            // Excel formula: IF(D21 < B8, 4.6, ...)
            if (minElevationAngle < B8_elevationAngle) {
                // The value 4.6 is hardcoded in the Excel formula for this condition.
                return 4.6;
            } else {
                // Excel formula: INDEX(D6:D18, MATCH(D21, B6:B18, 1), 1)

                let matchIndex = -1;
                // The MATCH function with type 1 finds the largest value that is less than or equal to lookup_value.
                // We need to iterate through elevationAngles to find this.
                for (let i = 0; i < elevationAngles.length; i++) {
                    if (minElevationAngle >= elevationAngles[i]) {
                        matchIndex = i;
                    } else {
                        // Since the elevationAngles are sorted, we can break once we exceed minElevationAngle
                        break;
                    }
                }

                if (matchIndex !== -1) {
                    // Return the corresponding loss from the losses array
                    // Round to one decimal place as seen in your example data
                    return parseFloat(losses[matchIndex].toFixed(1));
                } else {
                    console.warn("Could not find a matching elevation angle for lookup.");
                    return 0.0; // Default or error handling
                }
            }
        }

        /**
         * Updates the "Loss Determined" input field for Atmospheric Loss
         * based on the "Min. Elev. Angle" input.
         */
        function updateAtmosphericLoss() {
            const minElevationAngleInput = document.getElementById('min_elevation_angle');
            const lossDeterminedInput = document.getElementById('loss_determined_atmospheric');

            const minElevationAngle = parseFloat(minElevationAngleInput.value);

            if (!isNaN(minElevationAngle)) {
                const calculatedLoss = calculateAtmosphericLoss(minElevationAngle);
                lossDeterminedInput.value = calculatedLoss;
            } else {
                lossDeterminedInput.value = ''; // Clear if input is not a valid number
            }
        }

        /**
         * Updates the "Uplink Loss Determined" display based on the Uplink Loss input.
         */
        function updateUplinkIonosphericLoss() {
            const uplinkLossInput = document.getElementById('uplink_loss_ionosphere');
            const uplinkLossDisplay = document.getElementById('uplink_loss_determined_display');

            const uplinkLoss = parseFloat(uplinkLossInput.value);

            if (!isNaN(uplinkLoss)) {
                uplinkLossDisplay.textContent = `${uplinkLoss.toFixed(1)} dB`;
            } else {
                uplinkLossDisplay.textContent = '0.0 dB'; // Default if input is not a valid number
            }
        }

        /**
         * Updates the "Downlink Loss Determined" display based on the Downlink Loss input.
         */
        function updateDownlinkIonosphericLoss() {
            const downlinkLossInput = document.getElementById('downlink_loss_ionosphere');
            const downlinkLossDisplay = document.getElementById('downlink_loss_determined_display');

            const downlinkLoss = parseFloat(downlinkLossInput.value);

            if (!isNaN(downlinkLoss)) {
                downlinkLossDisplay.textContent = `${downlinkLoss.toFixed(1)} dB`;
            } else {
                downlinkLossDisplay.textContent = '0.0 dB'; // Default if input is not a valid number
            }
        }

        // Call the functions once when the page loads to set the initial values
        document.addEventListener('DOMContentLoaded', () => {
            updateAtmosphericLoss();
            updateUplinkIonosphericLoss();
            updateDownlinkIonosphericLoss();
        });
    </script>
</x-layout>