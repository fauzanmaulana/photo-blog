@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="/blog/update/post/{{$blog->id}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{$blog->judul}}" id="judul" placeholder="judul">
        </div>
        <div class="form-group">
            <label for="gambardepan">Gambar Depan</label>
            <input type="file" name="gambardepan" class="form-control-file" id="gambardepan">
        </div>
        <div class="form-group">
            <label for="tema">Tema</label>
            <select class="form-control" id="tema" name="tema">
                <option selected="selected" value="{{$blog->tema->id}}">{{$blog->tema->nama_tema}}</option>
                @foreach($tema as $t)
                    <option value="{{$t->id}}">{{$t->nama_tema}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows=7>{{$blog->deskripsi}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection