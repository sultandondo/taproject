<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Data;

class ArduinoController extends Controller
{
    public function getData()
    {
        $data = Data::findOrFail(5);
    
        if ($data) {
            return response()->json([
                'id' => $data->id,
                'path_loss' => $data->path_loss,
                'path_loss_downlink' => $data->path_loss_downlink,
            ]);
        }
    
        return response()->json(['message' => 'No data'], 200);  // Gunakan 200 agar Arduino bisa baca JSON
    }


    public function postResult(Request $request, $idt)
    {
        //dd($request->all());
        $request->validate([
            'path_loss'=> 'nullable|numeric',
            'path_loss_downlink'=> 'nullable|numeric',
            // validasi kolom lainnya sesuai kebutuhan
        ]);
        $id = 5;
        // Data::create($request->all());
        $data = Data::findOrFail($id);
        $data->update([
            'path_loss' => $request->input('path_loss'),
            'path_loss_downlink' => $request->input('path_loss_downlink'),

            // Field lainnya
        ]);

        return redirect()->route('simulationhardware.show', ['id' => $idt])->with('success', 'Data berhasil ditambahkan');
    }
}
