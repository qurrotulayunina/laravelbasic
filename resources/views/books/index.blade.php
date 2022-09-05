<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Books</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href='/'><i class="fa fa-home fa-2x"></i></a>
                        <h4 style='text-align: center'>TUGAS 2</h4>
                        <a href="{{ route('books.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                
                                <th scope="col">SAMPUL</th>
                                <th scope="col">JUDUL</th>
                                <th scope="col">HARGA</th>
                                <th scope="col">PENULIS</th>
                                <th scope="col">PENERBIT</th>
                                <th scope="col">TAHUN TERBIT</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($books as $book)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/books/').$book->gambar }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $book->judul }}</td>
                                    <td>Rp. {{ number_format($book->harga,0,',','.')}}</td>
                                    <td>{{ $book->penulis }}</td>
                                    <td>{{ $book->penerbit }}</td>
                                    <td>{{ $book->thn_terbit }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('books.destroy', $book->id) }}" method="POST">
                                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Buku belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $books->links() }}
                          <a href='/posts' style='float: left'>
                            <i class="fa fa-arrow-circle-left fa-2x" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>

</body>
</html>