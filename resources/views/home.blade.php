@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6">
                <form action="/tema" method="POST">
                @csrf
                    <div class="form-group">
                        <select class="form-control" id="temaop" name="temas" style="width:480px; float:left">
                            <option value="semuatema">semua tema</option>
                            @foreach($tema as $tm)
                            <option value="{{$tm->id}}">{{$tm->nama_tema}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" onclick="kosongkan()">cari</button>
                </form>
            </div>
            <!-- <div class="col-md-1">
                <button type="submit" class="btn btn-primary float-right">cari</button>
            </div> -->
        </div>
        <div class="row mb-5" id="card-con">
            @foreach($portfolio as $pf)
                @if (!session('tema') || session('tema') == "semuatema")
                    <div class="col-md-6">
                        <a href="/blog/{{$pf->id}}" style="text-decoration:none; color:#212529">
                            <div class="card mb-3" style="max-width: 540px;">
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
                    </div>
                @elseif(session('tema') == $pf->tema_id)
                    <div class="col-md-6">
                        <a href="/blog/{{$pf->id}}" style="text-decoration:none; color:#212529">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                    <img src="{{asset('assets/featuredimage/'.$pf->gambar_depan)}}" class="card-img" width="300" height="150">
                                    </div>
                                    <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$pf->judul}}</h5>
                                        <p class="card-text">{{str_limit($pf->deskripsi,100)}}</p>
                                        <p class="card-text"><small class="text-muted">{{$pf->tema->nama_tema}}</small></p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
</div>

<script>
    let kosongkan = () => {
        // document.getElementById('card-con').innerHTML = ""
        console.log("halo")
    }
</script>

@endsection