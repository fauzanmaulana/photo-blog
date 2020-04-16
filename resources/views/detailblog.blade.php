@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('message'))
      <div class="alert alert-success" role="alert">{{session('message')}}</div>
    @endif
    <div class="d-flex flex-column">
        <h3 class="text-center my-0">{{$blog->judul}}</h3>
        <hr>
        <img src="{{asset('assets/featuredimage/'.$blog->gambar_depan)}}" alt="gambardetail" width="800" class="mx-auto">
        <br>
        <br>
        <h5 class="mx-5 text-center" style="line-height:2.5ch">{{$blog->deskripsi}}</h5>
        <hr>
        <div class="d-flex justify-content-between mx-5">
            <p class="card-text">{{$blog->tema->nama_tema}}</p>
            <p class="card-text">writed by {{$blog->user->name}}</p>
            @if($blog->user->id !== Auth::user()->id)
              <button class="btn btn-outline-success" onclick="openmodal()">Contact</button>
            @endif
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactLabel">Send Message to {{$blog->user->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/pesan/{{$blog->id}}/{{$blog->user->id}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <p class="card-text">Peminat : {{Auth::user()->email}}<span class="float-right">Rp.{{$blog->tema->harga}}</span></p>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" rows="5" name="pesanan"></textarea>
          </div>
          <div class="form-bayar form-group">
            <label for="buktipembayaran">Upload Bukti Pembayaran</label>
            <input type="file" class="form-control-file" id="buktipembayaran" name="buktipembayaran">
          </div>
          <div class="form-check">
            <input class="form-check-input" value="2" type="radio" name="cekformbayar" id="cekformbayar">Bayar Sekarang
            <br>
            <input class="form-check-input" value="1" type="radio" name="cekformbayar" id="cekformbayar">Bayar Nanti
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    const openmodal = () => $('#contact').modal('show');
    document.querySelector('.form-bayar').style.display = 'none'
    $('input[name="cekformbayar"]').on('change', function() {
      $('.form-bayar').toggle(+this.value === 2 && this.checked)
    })
</script>