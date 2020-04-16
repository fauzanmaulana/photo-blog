@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Postingan</th>
                <th scope="col">Tema</th>
                <th scope="col">Bukti Pembayaran</th>
                <th scope="col">Pesan</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach($pesanan as $pesan)
            <tr>
                <th scope="row">{{$i++}}</th>
                <th>{{$pesan->portfolio->judul}}</th>
                <td>{{$pesan->portfolio->tema->nama_tema}}</td>
                @if($pesan->bukti)
                    <td><img src="{{asset('assets/fotopesanan/'.$pesan->bukti)}}" alt="bukti" width="180"></td>
                @else
                    <td><form action="" method="post" enctype="multipart/form-data"><input type="file" class="form-control-file" name="bayar"></form></td>
                @endif
                <td>{{$pesan->pesan}}</td>
                <td><?= ($pesan->status) ? "<p class='bg-success text-white'>Dikonfirmasi</p>" : "<p class='bg-warning'>Belum Dikonfirmasi</p>" ?></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection