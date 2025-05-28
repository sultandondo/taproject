<x-layout>
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">History</h1>
        
        <div class="overflow-x-auto">
            <table class="zebra-striped min-w-full table-auto border-collapse shadow-md rounded-lg bg-gray-100">
                <thead class="bg-gray-200 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Jenis Orbit</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Inklinasi</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">User Latitude Uplink</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">User Longitude Uplink</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">User Latitude Downlink</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Slant Range to User (km) Uplink</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">User Elevation Angle (°) Uplink</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">User Azimuth Angle Uplink GEO (°)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Earth Central Angle Uplink (°)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">User Longitude Downlink</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Slant Range to User (km) Downlink</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">User Elevation Angle (°) Downlink</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">User Azimuth Angle Downlink GEO (°)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Earth Central Angle Downlink (°)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Ketinggian (km)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Apogee (km)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Perigee (km)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Eccentricity (e)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Argument of Perigee (ω)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">R.A.A.N (Ω)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Sudut Elevasi</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Mean Orbit Altitude</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Mean Orbit Radius</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Slant Range (km)</th>
                        <th class="px-4 py-3 border text-left text-sm font-semibold">Azimuth Result Downlink</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-700">
                    @foreach($data as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 border text-sm">{{ $item->jenis_orbit }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->inklinasi }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->userlat_up }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->userlong_up }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->userlat_down }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->slantrangetouser_up_input }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->userelevationangel_up_input }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->userazimuthangle_up_input }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->earthcentralangle_up_input }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->userlong_down }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->spaceslot_down }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->slantrangetouser_down_input }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->userelevationangel_down_input }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->userazimuthangle_down_input }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->earthcentralangle_down_input }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->ketinggian }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->apogee }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->perigee }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->eccentricity }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->argumenop }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->raan }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->elevasi }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->altitude }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->radius }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->slant_range }}</td>
                            <td class="px-4 py-3 border text-sm">{{ $item->azimuthresult_down }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
