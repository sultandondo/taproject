<x-layout>
    <x-slot:title>Atmospheric and Ionospheric Losses</x-slot:title>
    
    <div class="container mx-auto max-w-lg bg-gray-300 rounded-lg shadow-xl p-4">
        
        <div class="bg-white rounded-t-lg p-0 mb-4 overflow-hidden">
            <h2 class="text-xl font-bold text-center bg-yellow-400 text-black py-2 px-4">
                Loss due to Atmospheric Gases:
            </h2>
            <p class="text-center bg-pink-300 text-black font-medium py-1 text-base">Uplink and Downlink:</p>
        </div>
        
        <div class="bg-gray-300 p-4">
            <div class="flex justify-around items-center font-bold bg-blue-400 text-white py-2 text-base rounded-t-lg">
                <div class="w-1/3 text-center">Elevation Angle:</div>
                <div class="w-1/3 text-center">Loss:</div>
                <div class="w-1/3 text-center">Unit:</div>
            </div>
            
            <div class="text-base">
                <div class="flex justify-around items-center py-1">
                    <div class="w-1/3 text-center">0°</div>
                    <div class="w-1/3 text-center">10.2</div>
                    <div class="w-1/3 text-center">dB</div>
                </div>
                <div class="flex justify-around items-center py-1">
                    <div class="w-1/3 text-center">2.5°</div>
                    <div class="w-1/3 text-center">4.6</div>
                    <div class="w-1/3 text-center">dB</div>
                </div>
                <div class="flex justify-around items-center py-1">
                    <div class="w-1/3 text-center">5°</div>
                    <div class="w-1/3 text-center">2.1</div>
                    <div class="w-1/3 text-center">dB</div>
                </div>
                <div class="flex justify-around items-center py-1">
                    <div class="w-1/3 text-center">10°</div>
                    <div class="w-1/3 text-center">1.1</div>
                    <div class="w-1/3 text-center">dB</div>
                </div>
                <div class="flex justify-around items-center py-1">
                    <div class="w-1/3 text-center">30°</div>
                    <div class="w-1/3 text-center">0.4</div>
                    <div class="w-1/3 text-center">dB</div>
                </div>
                <div class="flex justify-around items-center py-1">
                    <div class="w-1/3 text-center">45°</div>
                    <div class="w-1/3 text-center">0.3</div>
                    <div class="w-1/3 text-center">dB</div>
                </div>
                <div class="flex justify-around items-center py-1">
                    <div class="w-1/3 text-center">90°</div>
                    <div class="w-1/3 text-center">0.0</div>
                    <div class="w-1/3 text-center">dB</div>
                </div>
            </div>

            <form method="POST" action="{{ route('atmospheric.calculate') }}" class="pt-4">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                
                <div class="grid grid-cols-2 gap-x-8 items-start"> 
                    <div class="flex flex-col items-start"> {{-- Stack label and input vertically, align to start --}}
                        <label for="min_elevation_angle" class="font-medium text-gray-700 whitespace-nowrap mb-1">Min. Elev. Angle:</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="number" 
                                name="min_elevation_angle" 
                                id="min_elevation_angle"
                                step="0.1" 
                                min="0" 
                                max="90"
                                class="w-20 px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-center bg-blue-200 font-bold"
                                value="5"
                                oninput="calculateLoss()"
                                required
                            >
                            <span class="text-gray-600">deg.</span>
                            <span class="text-2xl text-blue-600"></span>
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-start"> {{-- Stack label and input vertically, align to start --}}
                        <label for="loss_determined" class="font-medium text-gray-700 whitespace-nowrap mb-1">Loss Determined:</label>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="text" 
                                name="loss_determined" 
                                id="loss_determined"
                                class="w-20 px-3 py-2 border border-gray-300 rounded-md bg-yellow-200 text-center font-bold"
                                value="2.1"
                                readonly
                            >
                            <span class="text-gray-600">dB</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Lookup table for atmospheric losses
        const lossTable = [
            { angle: 0, loss: 10.2 },
            { angle: 2.5, loss: 4.6 },
            { angle: 5, loss: 2.1 },
            { angle: 10, loss: 1.1 },
            { angle: 30, loss: 0.4 },
            { angle: 45, loss: 0.3 },
            { angle: 90, loss: 0.0 }
        ];

        function calculateLoss() {
            const angle = parseFloat(document.getElementById('min_elevation_angle').value);
            const lossOutput = document.getElementById('loss_determined');
            
            if (isNaN(angle) || angle < 0 || angle > 90) {
                lossOutput.value = '';
                return;
            }

            let loss = 0;

            // Find the appropriate loss value using interpolation
            if (angle >= 90) {
                loss = 0.0;
            } else {
                // Find the two points to interpolate between
                let lowerPoint = lossTable [0];
                let upperPoint = lossTable [lossTable.length - 1];
                
                for (let i = 0; i < lossTable.length - 1; i++) {
                    if (angle >= lossTable [i].angle && angle <= lossTable [i + 1].angle) {
                        lowerPoint = lossTable [i];
                        upperPoint = lossTable [i + 1];
                        break;
                    }
                }
                
                // Linear interpolation
                if (lowerPoint.angle === upperPoint.angle) {
                    loss = lowerPoint.loss;
                } else {
                    const ratio = (angle - lowerPoint.angle) / (upperPoint.angle - lowerPoint.angle);
                    loss = lowerPoint.loss + ratio * (upperPoint.loss - lowerPoint.loss);
                }
            }

            lossOutput.value = loss.toFixed(1);
        }

        // Initialize calculation on page load
        document.addEventListener('DOMContentLoaded', function() {
            calculateLoss();
        });
    </script>
</x-layout>
