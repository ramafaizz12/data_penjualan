<?php

namespace App\Http\Controllers;


use App\Models\Penjualan;
use App\Models\JenisMakanan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Penjualan::with('category')->get();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function getPenjualanByCategory($categoryId)
    {
        $category = JenisMakanan::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Kategori tidak ditemukan'], 404);
        }

        $penjualans = $category->books;

        return response()->json($penjualans, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'description' => 'required',
            'harga' => 'required|integer',
            'category_id' => 'required|exists:jenis_makanans,id',
        ]);

        $book = Penjualan::create($request->all());
        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'description' => 'required',
            'harga' => 'required|integer',
            'category_id' => 'required|exists:jenis_makanans,id',
        ]);

        $book = Penjualan::findOrFail($id);
        $book->update($request->all());
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Penjualan::findOrFail($id);
        $book->delete();
        return response()->json(null, 204);
    }
}
