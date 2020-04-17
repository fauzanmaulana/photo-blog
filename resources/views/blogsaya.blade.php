@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('message'))
      <div class="alert alert-success" role="alert">{{session('message')}}</div>
    @endif
    @foreach($portfolio as $pf)
        @if($pf->user_id == Auth::user()->id)
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{Route('detail',[$pf->id])}}" style="text-decoration:none; color:#212529">
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4" style="background-image:url('{{asset('assets/featuredimage/'.$pf->gambar_depan)}}'); background-size:cover"></div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$pf->judul}}</h5>
                                <p class="card-text">{{str_limit($pf->deskripsi,100)}}</p>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text"><small class="text-muted">{{$pf->tema->nama_tema}}</small></p>
                                    <p class="card-text"><small class="text-muted">writed by {{$pf->user->name}}</small></p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="btn-edit">
                    <a href="{{Route('blogupdate',[$pf->id])}}" class="btn btn-success">edit</a>
                </div>
                <div class="btn-delete">
                    <a href="{{Route('bloghapus',[$pf->id])}}" class="btn btn-danger">hapus</a>
                </div>
            </div>
        @endif
    @endforeach
</div>
@endsection