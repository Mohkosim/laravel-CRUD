<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemrograman Web Lanjut</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Data Buku</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href=" {{ route('bukus.create') }} " class="btn btn-md btn-success mb-3">TAMBAH</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">judul</th>
                                    <th scope="col">pengarang</th>
                                    <th scope="col">penerbit</th>
                                    <th scope="col">gambar</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bukus as $buku)
                                <tr>
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->pengarang }}</td>
                                    <td>{!! $buku->penerbit !!}</td>

                                    <td>
                                    @if($buku->image)
                                    <img src="{{ asset('storage/image/' . $buku->image) }}" alt="Gambar" style="max-width: 200px; max-height: 200px;">

                                    @else
                                    <p>Tidak ada gambar yang tersedia</p>
                                    @endif
                                        </td>
                                        <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('bukus.destroy', $buku->id) }}" method="POST">
                                            <a href="{{ route('bukus.edit', $buku->id) }}" {{ $buku->id }} class="btn btn-sm btn-primary">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="alert alert-danger">
                                            Data Buku belum Tersedia.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
        @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
        @endif
    </script>
</body>
</html>
