<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Mengurutkan berdasarkan judul A-Z dan menggunakan pagination
        $books = Book::
        orderBy('title')->paginate(10);

        return view('books.index', compact('books'));
    }


    public function create(): View
    {
        return view('books.create');
    }



    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }



    public function preview(Book $book): View
    {
        return view('books.preview', compact('book'));
    }

   

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'title'          => 'required|string|max:255',
            'isbn'           => 'nullable|string|max:20|unique:books,isbn',
            'author'         => 'required|string|max:150',
            'publisher'      => 'nullable|string|max:150',
            'published_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'price'          => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'description'    => 'nullable|string',
        ];


        $messages = [
            'required' => ':attribute wajib diisi.',
            'unique'   => ':attribute sudah terdaftar, gunakan nilai lain.',
            'min'      => [
                'numeric' => ':attribute minimal bernilai :min.',
                'string'  => ':attribute minimal harus :min karakter.',
            ],
            'max'      => [
                'numeric' => ':attribute maksimal bernilai :max.',
                'string'  => ':attribute tidak boleh lebih dari :max karakter.',
            ],
        ];

        // Atribut kustom agar nama field lebih rapi
        $attributes = [
            'title'          => 'Judul Buku',
            'isbn'           => 'ISBN',
            'author'         => 'Penulis',
            'publisher'      => 'Penerbit',
            'published_year' => 'Tahun Terbit',
            'price'          => 'Harga',
            'stock'          => 'Stok',
            'description'    => 'Deskripsi',
        ];

        $validatedData = $request->validate($rules, $messages, $attributes);

        // Menyimpan data ke database
        Book::create($validatedData);

        // Redirect kembali ke halaman index dengan flash message
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }



    public function edit(Book $book)
{
    return view('books.edit', compact('book'));
}





public function update(Request $request, Book $book): RedirectResponse
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'isbn' => [
            'nullable',
            'string',
            'max:20',
            Rule::unique('books', 'isbn')->ignore($book),
        ],
        'author' => ['required', 'string', 'max:150'],
        'publisher' => ['nullable', 'string', 'max:150'],
        'published_year' => [
            'nullable',
            'integer',
            'min:1900',
            'max:'.date('Y'),
        ],
        'price' => ['required', 'numeric', 'min:0'],
        'stock' => ['required', 'integer', 'min:0'],
        'description' => ['nullable', 'string'],
    ]);

    $book->update($validated);

    return redirect()
        ->route('books.index')
        ->with('success', 'Data buku berhasil diperbarui.');
}



public function destroy(Book $book): RedirectResponse
{
    $book->delete();

    return redirect()
        ->route('books.index')
        ->with('success', 'Data buku berhasil dihapus.');
}

}