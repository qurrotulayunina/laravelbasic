<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

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
            'judul'         => 'required|min:1',
            'harga'         => 'required|min:2',
            'penulis'       => 'required|min:5',
            'penerbit'      => 'required|min:5',
            'thn_terbit'    => 'required|min:2'
        ]);

        //create book
        Book::create([
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
            'judul'         => 'required|min:1',
            'harga'         => 'required|min:2',
            'penulis'       => 'required|min:5',
            'penerbit'      => 'required|min:5',
            'thn_terbit'    => 'required|min:2'
        ]);

        $book->update([
            'judul'         => $request->judul,
            'harga'         => $request->harga,
            'penulis'       => $request->penulis,
            'penerbit'      => $request->penerbit,
            'thn_terbit'    => $request->thn_terbit,
        ]);

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
