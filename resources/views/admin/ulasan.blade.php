@extends('template/main')
@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <div class="table-responsive">
        <table class="table table-bordered mt-4">
            <thead>
                <th>No</th>
                <th>Ulasan</th>
                <th>User</th>
                <th>Buku</th>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->ulasan }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->buku->judul }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>

@endsection