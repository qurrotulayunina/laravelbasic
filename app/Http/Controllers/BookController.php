<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    //
    public function index()
    {
        //get books
        $books = Book::latest()->paginate(5);

        //render view with books
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'gambar'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul'         => 'required|min:1',
            'harga'         => 'required|min:2',
            'penulis'       => 'required|min:5',
            'penerbit'      => 'required|min:5',
            'thn_terbit'    => 'required|min:2'
        ]);

        //create book
        Book::create([
            'gambar'        => $request->gambar,
            'judul'         => $request->judul,
            'harga'         => $request->harga,
            'penulis'       => $request->penulis,
            'penerbit'      => $request->penerbit,
            'thn_terbit'    => $request->thn_terbit
        ]);

        //redirect to index
        return redirect()->route('books.index')->with(['success' => 'Data BUku Berhasil Disimpan!']);
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'gambar'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul'         => 'required|min:1',
            'harga'         => 'required|min:2',
            'penulis'       => 'required|min:5',
            'penerbit'      => 'required|min:5',
            'thn_terbit'    => 'required|min:2'
        ]);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/books', $gambar->hashName());

            //delete old image
            Storage::delete('public/books/'.$book->gambar);

            //update post with new image
            $book->update([
                'gambar'        => $gambar->hashName(),
                'judul'         => $request->judul,
                'harga'         => $request->harga,
                'penulis'       => $request->penulis,
                'penerbit'      => $request->penerbit,
                'thn_terbit'    => $request->thn_terbit,
            ]);

        } else {

            //update post without image
            $book->update([
            'judul'         => $request->judul,
            'harga'         => $request->harga,
            'penulis'       => $request->penulis,
            'penerbit'      => $request->penerbit,
            'thn_terbit'    => $request->thn_terbit,
            ]);
        }

        return redirect()->route('books.index')->with(['success' => 'Data Buku Berhasil Diubah!']);
    }

    public function destroy(Book $book)
    {
        //delete book
        $book->delete();

        //redirect to index
        return redirect()->route('books.index')->with(['success' => 'Data Buku Berhasil Dihapus!']);
    }
}
