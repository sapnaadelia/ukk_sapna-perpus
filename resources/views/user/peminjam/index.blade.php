@extends('template/main')

@section('content')
    <form action="{{ route('peminjam.buku.cari') }}">
        <div class="row">
            <div class="input-group col-md-4">
                <input type="search" class="form-control rounded w-6px " placeholder="Cari Buku...." aria-label="Search"
                    name="cari" aria-describedby="search-addon" />
                <button type="submit" class="btn btn-outline-primary" data-mdb-ripple-init>Cari</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered mt-4">
            <thead>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>foto</th>
                <th width="300px">Aksi</th>
            </thead>
            @php
                $no = ($buku->currentPage() - 1) * $buku->perPage() + 1;
            @endphp
            <tbody>
                @foreach ($buku as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ $item->penulis }}</td>
                        <td>{{ $item->penerbit }}</td>
                        <td>
                            <img src="{{ asset('storage/foto/' . $item->foto) }}" alt="Foto Buku" style="width:100px">
                        </td>
                        

                        <td>
                            <a href="{{ route('peminjam.buku.show', $item->id) }}" class="btn btn-primary">Detail</a>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#pinjamModal-{{ $item->id }}">
                                Pinjam Buku
                            </button>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#koleksiModal-{{ $item->id }}">
                                simpan
                            </button>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="pinjamModal-{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="pinjamModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pinjamModalLabel">Pinjam Buku - {{ $item->judul }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Add your pinjam form here -->
                                            <form action="{{ route('peminjam.buku.store', $item->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}">
                                                <input type="hidden" value="{{ $item->id }}" name="buku_id">
                                                <input type="hidden" value=" {{ Auth::id() }}" name="user_id">
                                                <button type="submit" class="btn btn-primary">Pinjam</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="koleksiModal-{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="koleksiModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="koleksiModalLabel">Simpan ke Koleksi -
                                                {{ $item->judul }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Add your pinjam form here -->
                                            <form action="{{ route('peminjam.koleksi.store', $item->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="buku_id">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $buku->links() }}
    </div>
@endsection