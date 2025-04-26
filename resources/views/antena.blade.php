<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-4 text-center">Form Antena</h1>

    <form method="GET" action="">
    @csrf
        <div class="mb-4">
            <label for="gain antena ground station_field" class="block font-medium">Gain Antena Ground Station:</label>
            <input type="number" name="gain antena ground station" id="gain antena ground station" class="border p-2 w-full rounded">
        </div>

        <div class="mb-4">
            <label for="gain antena satelit_field" class="block font-medium">Gain Antena Satelit:</label>
            <input type="number" name="gain antena ground satelit" id="gain antena satelit" class="border p-2 w-full rounded">
        </div>

        <div id="eirp ground station_field" class="mb-4">
            <label class="block font-medium">EIRP Ground Station:</label>
            <input type="number" name="eirp ground station" id="eirp ground station" class="border p-2 w-full rounded" min="0">
        </div>

        <div id="eirp satelit_field" class="mb-4">
            <label class="block font-medium">EIRP Satelit:</label>
            <input type="number" name="eirp satelit" id="eirp satelit" class="border p-2 w-full rounded" min="0">
        </div>

        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600 w-full">Simpan</button>
    </form>
</div>
</x-layout>