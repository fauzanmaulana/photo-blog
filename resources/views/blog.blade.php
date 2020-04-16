@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="/blog/create" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control" id="judul" placeholder="judul">
        </div>
        <div class="form-group">
            <label for="gambardepan">Gambar Depan</label>
            <input type="file" name="gambardepan" class="form-control-file" id="gambardepan">
        </div>
        <div class="form-group">
            <label for="tema">Tema</label>
            <select class="form-control" id="tema" name="tema">
                @foreach($tema as $t)
                    <option value="{{$t->id}}">{{$t->nama_tema}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows=7></textarea>
        </div>
        <button type="submit">Buat Blog</button>
    </form>
</div>
@endsection