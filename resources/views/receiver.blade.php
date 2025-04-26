<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Receiver</h1>

        <form method="GET" action="">
            @csrf

            {{-- Uplink Receiver --}}
            <h2 class="text-lg font-semibold mb-2 mt-4">Uplink Receiver (Spacecraft)</h2>
            <div class="mb-4">
                <label for="uplink_losses" class="block font-medium mb-1">Total In-Losses dari Antena ke LNA (dB):</label>
                <input type="number" name="uplink_losses" id="uplink_losses" class="border p-2 w-full rounded" min="0">
            </div>
            <div class="mb-4">
                <label for="uplink_noise" class="block font-medium mb-1">System Noise Temperature (K):</label>
                <input type="number" name="uplink_noise" id="uplink_noise" class="border p-2 w-full rounded" min="0">
            </div>
            <div class="mb-4">
                <label for="cn_uplink" class="block font-medium mb-1">C/N Uplink (dB):</label>
                <input type="number" name="cn_uplink" id="cn_uplink" class="border p-2 w-full rounded" min="0">
            </div>

            {{-- Downlink Receiver --}}
            <h2 class="text-lg font-semibold mb-2 mt-6">Downlink Receiver (Ground Station)</h2>
            <div class="mb-4">
                <label for="downlink_losses" class="block font-medium mb-1">Total In-Losses dari Antena ke LNA (dB):</label>
                <input type="number" name="downlink_losses" id="downlink_losses" class="border p-2 w-full rounded" min="0">
            </div>
            <div class="mb-4">
                <label for="downlink_noise" class="block font-medium mb-1">System Noise Temperature (K):</label>
                <input type="number" name="downlink_noise" id="downlink_noise" class="border p-2 w-full rounded" min="0">
            </div>
            <div class="mb-6">
                <label for="cn_downlink" class="block font-medium mb-1">C/N Downlink (dB):</label>
                <input type="number" name="cn_downlink" id="cn_downlink" class="border p-2 w-full rounded" min="0">
            </div>

            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 w-full">Simpan</button>
        </form>
    </div>
</x-layout>