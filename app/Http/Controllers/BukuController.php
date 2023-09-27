<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $bukus = Buku::get();

        return view('bukus.index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('bukus/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        //headle image upload and storage
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('image', $imageName, 'public');
        } else {
            $imageName = null; //no image uploud
        }

        Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'image' => $imageName, //store image file name in the databases
        ]);

        return redirect()->route('buku')->with(['Success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        //get buku by ID
        $bukus = Buku::findOrFail($id);

        //render view with buku
        return view('bukus/edit', compact('bukus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : RedirectResponse
    {
        $this->validate($request, [
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $bukus = Buku::findOrFail($id);

        //handle image upload and storage if a new image is select
        if ($request->hasFile('image'))
        {
            if ($bukus->image) {
                Storage::delete('public/image/'. $bukus->image);
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('image', $imageName, 'public');

            $bukus->image = $imageName;
        }

        $bukus->update([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit
        ]);

        return redirect()->route('buku')->with(['Success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : RedirectResponse
    {
        $bukus = Buku::findOrFail($id);
        $bukus->delete();

        return redirect()->route('buku')->with(['Success' => 'Data Berhasil Dihapus!']);
    }
}
