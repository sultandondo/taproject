<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">Form Parameter Orbit</h1>

    <form method="GET" action="">
    @csrf
    {{-- Uplink Frekuensi --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2 text-gray-800">Uplink Frekuensi</h2>

            <div class="mb-4">
                <label for="Frekuensi" class="block font-medium mb-1 text-gray-700">Frekuensi:</label>
                <select name="frekuensi" id="frekuensi" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                    <option value="">-- Pilih Frekuensi --</option>
                    <option value="145.800">145.800</option>
                    <option value="437.500">437.500</option>
                    <option value="1269.900">1269.900</option>
                    <option value="450.000">450.000</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="Panjang Gelombang (λ)" class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ):</label>
                <select name="panjang gelombang" id="panjang gelombang" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                    <option value="">-- Panjang Gelombang --</option>
                    <option value="2.056 meter">2.056 meter</option>
                    <option value="0.685 meter">0.685 meter</option>
                    <option value="0.236 meter">0.236 meter</option>
                    <option value="0.666 meter">0.666 meter</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="Path Loss" class="block font-medium mb-1 text-gray-700">Path Loss:</label>
                <select name="path loss" id="path loss" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                    <option value="">-- Path Loss --</option>
                    <option value="144.6 dB">144.6 dB</option>
                    <option value="154.2 dB">154.2 dB</option>
                    <option value="163.4 dB">163.4 dB</option>
                    <option value="154.4 dB">154.4 dB</option>
                </select>
            </div>
        </div>    

    {{-- Downlink Frekuensi --}}
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2 text-gray-800">Downlink Frekuensi</h2>
                <div class="mb-4">
                <label for="Frekuensi" class="block font-medium mb-1 text-gray-700">Frekuensi:</label>
                <select name="frekuensi" id="frekuensi" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                    <option value="">-- Pilih Frekuensi --</option>
                    <option value="145.800">145.800</option>
                    <option value="437.500">437.500</option>
                    <option value="2405.000">2405.000</option>
                    <option value="136.000">136.000</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="Panjang Gelombang (λ)" class="block font-medium mb-1 text-gray-700">Panjang Gelombang (λ):</label>
                <select name="panjang gelombang" id="panjang gelombang" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                    <option value="">-- Panjang Gelombang --</option>
                    <option value="2.056 meter">2.056 meter</option>
                    <option value="0.685 meter">0.685 meter</option>
                    <option value="0.125 meter">0.125 meter</option>
                    <option value="2.204 meter">2.204 meter</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="Path Loss" class="block font-medium mb-1 text-gray-700">Path Loss:</label>
                <select name="path loss" id="path loss" required class="border border-gray-300 p-3 w-full rounded bg-gray-50">
                    <option value="">-- Path Loss --</option>
                    <option value="144.6 dB">144.6 dB</option>
                    <option value="154.2 dB">154.2 dB</option>
                    <option value="169.0 dB">169.0 dB</option>
                    <option value="144.0 dB">144.0 dB</option>
                </select>
            </div>
            </div>
        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 w-full">Simpan</button>
    </form>
</div>
</x-layout>