@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('message'))
      <div class="alert alert-success" role="alert">{{session('message')}}</div>
    @endif
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Postingan</th>
            <th scope="col">Tema</th>
            <th scope="col">Customer</th>
            <th scope="col">Bukti Pembayaran</th>
            <th scope="col">Pesan</th>
            <th scope="col">Persetujuan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach($pesanan as $pesan)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{$pesan->portfolio->judul}}</td>
                    <td>{{$pesan->portfolio->tema->nama_tema}}</td>
                    <td>{{$pesan->user->email}}</td>
                    @if($pesan->bukti)
                        <td><img src="{{asset('assets/fotopesanan/'.$pesan->bukti)}}" alt="ini foto bukti" width="180"></td>
                    @else
                        <td>belum bayar</td>
                    @endif
                    <td>{{$pesan->pesan}}</td>
                    <td><a href="/konfirmasipembayaran/{{$pesan->id}}" class="{{$pesan->status ? 'btn btn-danger' : 'btn btn-success'}}">{{$pesan->status ? "batalkan" : "konfirmasi"}}</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection