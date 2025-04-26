<x-layout>
    <x-slot:title>{{ $title }}</x-slot>

    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Transmitter</h1>

        <form method="GET" action="">
            @csrf

            {{-- Uplink Transmitter --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2 text-gray-800">Uplink Transmitter</h2>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Transmitter Power (dBm):</label>
                    <input type="number" name="uplink_transmitter_power" class="border border-gray-300 bg-gray-50 p-3 w-full text-base rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total Line Losses (dB):</label>
                    <input type="number" name="uplink_total_line_losses" class="border border-gray-300 bg-gray-50 p-3 w-full text-base rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total Power Deliver to Antenna (dBm):</label>
                    <input type="number" name="total_power_deliver_to_antenna" class="border border-gray-300 bg-gray-50 p-3 w-full text-base rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
            </div>

            {{-- Downlink Transmitter --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2 text-gray-800">Downlink Transmitter</h2>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Transmitter Power (dBm):</label>
                    <input type="number" name="downlink_transmitter_power" class="border border-gray-300 bg-gray-50 p-3 w-full text-base rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total Line Losses (dB):</label>
                    <input type="number" name="downlink_total_line_losses" class="border border-gray-300 bg-gray-50 p-3 w-full text-base rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1 text-gray-700">Total RF Power Deliver to Antenna (dBm):</label>
                    <input type="number" name="total_rf_power_deliver_to_antenna" class="border border-gray-300 bg-gray-50 p-3 w-full text-base rounded focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 w-full font-semibold text-lg">Simpan</button>
        </form>
    </div>
</x-layout>
