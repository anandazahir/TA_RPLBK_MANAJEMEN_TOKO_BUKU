<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all(); 
        if ($buku -> count() > 0) {
            return response()->json([
                'Status' => 200,
                'Buku' => $buku
            ], 200);
        }else {
            return response()->json([
                'Status' => 404,
                'Buku' => 'Data tidak ada'
            ], 404);
        }  
    }
    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Judul' => 'required|string|max:191',
            'Pengarang' => 'required|string|max:191',
            'Penerbit' => 'required|string|max:191',
            'Stock' => 'required|string|max:191',
            'Quantity' => 'required|numeric|digits_between:1,3',
            'Tahun' => 'required|digits:4',
            'Harga' => 'required|numeric|digits_between:1,8',
        ]);
        if ($validator -> fails()) {
            return response()->json([
                'Status' => 422,
                'Errors' => $validator->messages()
            ], 422);
        }else 
        {
            $buku = Buku::create([
                'Judul' => $request->Judul,
                'Pengarang' => $request->Pengarang,
                'Genre' => $request->Genre,
                'Penerbit' =>$request->Penerbit,
                'Stock' => $request->Stock,
                'Quantity' => $request->Quantity,
                'Tahun' => $request->Tahun,
                'Harga' => $request->Harga,
            ]);
            $buku->where('Stock', 'Kosong')->update(['Quantity' => "0"]);
            if ($buku) {
                return response()->json([
                    'Status' => 200,
                    'Message' => "Data berhasil ditambahkan"
                ], 200);
            }else {
                return response()->json([
                    'Status' => 500,
                    'Errors' => "Error"
                ], 500);
            }

        }
    }
    public function show($id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            return response()->json([
                'Status' => 200,
                'Buku' => $buku
            ], 404);
        }else 
        {
            return response()->json([
                'Status' => 404,
                'Pesan' => 'Data tidak ditemukan'
            ], 404);
        }
    }
    public function edit($id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            return response()->json([
                'Status' => 404,
                'Buku' => $buku
            ], 404);
        }else 
        {
            return response()->json([
                'Status' => 404,
                'Pesan' => 'Data tidak ditemukan'
            ], 404);
        }
    }
    public function update(Request $request, int $id)
    {
        
        $validator = Validator::make($request->all(), [
            'Judul' => 'required|string|max:191',
            'Pengarang' => 'required|string|max:191',
            'Penerbit' => 'required|string|max:191',
            'Stock' => 'required|string|max:191',
            'Quantity' => 'required|numeric|digits_between:1,6',
            'Tahun' => 'required|digits:4',
            'Harga' => 'required|numeric|digits_between:1,8',
        ]);
        if ($validator -> fails()) {
            return response()->json([
                'Status' => 422,
                'Errors' => $validator->messages()
            ], 422);
        }else 
        {
            $buku = Buku::find($id);
            if ($buku) {
                $buku -> update([
                    'Judul' => $request->Judul,
                    'Pengarang' => $request->Pengarang,
                    'Genre' => $request->Genre,
                    'Penerbit' =>$request->Penerbit,
                    'Stock' => $request->Stock,
                    'Quantity' => $request->Quantity,
                    'Tahun' => $request->Tahun,
                    'Harga' => $request->Harga,
                ]);
                $buku->where('Stock', 'Kosong')->update(['Quantity' => "0"]);
                return response()->json([
                    'Status' => 200,
                    'Message' => "Data berhasil diupdate"
                ], 200);
            }else {
                return response()->json([
                    'Status' => 404,
                    'Message' => "Data tidak ditemukan"
                ], 404);
            }
        }
    }
    public function destroy ($id)
    {
        $buku = Buku::find($id);
        if ($buku) {
            $buku->delete();
            return response()->json([
                'Status' => 200,
                'Message' => "Data berhasil dihapus"
            ], 200);
        }else {
            return response()->json([
                'Status' => 404,
                'Message' => "Data tidak ditemukan"
            ], 404);
        }
    }
    public function stock(Request $request)
    {
        $Stock = $request->Stock;
        $Return=ucfirst(strval($Stock));
        $buku = Buku::all()->where('Stock', $Return);
        if ($buku -> count() > 0) {
            return response()->json([
                'Status' => 200,
                'Buku' => $buku
            ], 200);
        }else {
            return response()->json([
                'Status' => 404,
                'Buku' => 'Data tidak ada'
            ], 404);
        }  
    }
} 