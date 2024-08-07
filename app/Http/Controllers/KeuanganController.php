<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeuanganController extends Controller
{
    public function cekDataPemasukan()
    {
        $count = Keuangan::where('tipe', 'pemasukan')->count();
        return response()->json(['count' => $count]);
    }

    public function cekDataPengeluaran()
    {
        $count = Keuangan::where('tipe', 'pengeluaran')->count();
        return response()->json(['count' => $count]);
    }

    public function getJmlPemasukan()
    {
        $total = Keuangan::where('tipe', 'pemasukan')->sum('jumlah_uang');
        return response()->json(['total' => $total]);
    }

    public function getJmlPengeluaran()
    {
        $total = Keuangan::where('tipe', 'pengeluaran')->sum('jumlah_uang');
        return response()->json(['total' => $total]);
    }

    public function getDataPemasukan()
    {
        $data = Keuangan::where('tipe', 'pemasukan')->get();
        return response()->json($data);
    }

    public function getDataPengeluaran()
    {
        $data = Keuangan::where('tipe', 'pengeluaran')->get();
        return response()->json($data);
    }

    public function deletePemasukan($id)
    {
        $finance = Keuangan::where('id', $id)->where('tipe', 'pemasukan')->first();
        if ($finance) {
            $finance->delete();
            return response()->json(['message' => 'Data deleted successfully']);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    public function saveData(Request $request)
    {
        $validatedData = $request->validate([
            'tipe' => 'required|string',
            'keterangan' => 'required|string',
            'jumlah_uang' => 'required|numeric',
            'tanggal' => 'required',
        ]);

        $finance = Keuangan::create($validatedData);

        return response()->json(['message' => 'Data saved successfully', 'data' => $finance], 201);
    }

    public function updateData(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tipe' => 'required|string',
            'keterangan' => 'required|string',
            'jumlah_uang' => 'required|numeric',
            'tanggal' => 'required',
        ]);

        $finance = Keuangan::find($id);
        if ($finance) {
            $finance->update($validatedData);
            return response()->json(['message' => 'Data updated successfully', 'data' => $finance]);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
}
