<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tema;
use App\portfolio;
use App\pesanan;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $portfolio = portfolio::all();
        $tema = tema::all();
        return view('home', ['portfolio'=>$portfolio, 'tema'=>$tema]);
    }

    public function blog(){
        $tema = tema::all();
        return view('blog', ['tema'=>$tema]);
    }

    public function blogsaya()
    {
        $portfolio = portfolio::all();
        return view('blogsaya', ['portfolio'=>$portfolio]);
    }

    public function createblog(Request $req)
    {
        $image = $req->file('gambardepan');
        $name_file = $image->getClientOriginalName();
        $image->move(base_path('/public/assets/featuredimage'), $name_file);
        $blog = portfolio::create([
            'judul' => $req->judul,
            'user_id' => Auth::user()->id,
            'tema_id' => $req->tema,
            'gambar_depan' => $name_file,
            'deskripsi' => $req->deskripsi
        ]);
        return redirect()->route('home');
    }

    public function detailblog($id)
    {
        $blog = portfolio::find($id);
        // dd($blog);
        return view('detailblog', ['blog'=>$blog]);
    }

    public function pilihtema()
    {
        $tema = $_POST['temas'];
        return redirect('home')->with('tema', $tema);
    }

    public function prosespesan(Request $req, $portfolioid, $authorid)
    {
        $image = $req->file('buktipembayaran');
        if(!$image){
            $pesan = pesanan::create([
                'user_id'=>Auth::user()->id,
                'portfolio_id'=>$portfolioid,
                'author_id'=>$authorid,
                'pesan'=>$req->pesanan,
            ]);
            return redirect()->back()->with('message', "Berhasil Memesan, Silahkan cek Keranjang anda.");
        }
        $name_file = $image->getClientOriginalName();
        $image->move(base_path('/public/assets/fotopesanan'), $name_file);
        $pesan = pesanan::create([
            'user_id'=>Auth::user()->id,
            'portfolio_id'=>$portfolioid,
            'author_id'=>$authorid,
            'pesan'=>$req->pesanan,
            'bukti'=>$name_file
        ]);
        return redirect()->back()->with('message', "Berhasil Memesan, Silahkan cek Keranjang anda.");
    }

    //untuk yang memesan
    public function keranjang()
    {
        $pesanan = pesanan::where('user_id', Auth::user()->id)->get();
        return view('keranjang', compact('pesanan'));
    }

    //untuk yang dipesan
    public function pesanan()
    {
        $pesanan = pesanan::where('author_id', Auth::user()->id)->get();
        return view('pesanan', ['pesanan'=>$pesanan]);
    }

    public function konfirmasipembayaran($id)
    {
        $pesanan = pesanan::find($id);
        if($pesanan->status == 0){
            $pesanan->status = 1;
            $pesanan->save();
            return redirect()->back()->with('message', "Pembayaran berhasil Dikonfirmasi");
        }else{
            $pesanan->status = 0;
            $pesanan->save();
            return redirect()->back()->with('message', "Pembayaran berhasil Dibatalkan");
        }
    }

    public function bayarnanti(Request $req, $id)
    {
        $image = $req->file('bayar');
        $name_file = $image->getClientOriginalName();
        $image->move(base_path('/public/assets/fotopesanan'), $name_file);
        $pesanan = pesanan::find($id);
        $pesanan->bukti = $name_file;
        $pesanan->save();
        return redirect()->back()->with('message', "Pembayaran berhasil, Mohon tunggu konfirmasi dari author");
    }

    public function updateblog($id)
    {
        $tema = tema::all();
        $blog = portfolio::find($id);
        return view('blogupd', ['blog'=>$blog, 'tema'=>$tema]);
    }

    public function postupdateblog(Request $req, $id)
    {
        $blog = portfolio::find($id);
        $image = $req->file('gambardepan');
        if(!$image){
            $blog->judul = $req->judul;
            $blog->tema_id = $req->tema;
            $blog->deskripsi = $req->deskripsi;
            $blog->save();
            return redirect('blog/my')->with('message', 'berhasil update blog');
        }
        $name_file = $image->getClientOriginalName();
        $image->move(base_path('/public/assets/fotopesanan'), $name_file);
        $blog->judul = $req->judul;
        $blog->gambar_depan = $name_file;
        $blog->tema_id = $req->tema;
        $blog->deskripsi = $req->deskripsi;
        $blog->save();
        return redirect('blog/my')->with('message', 'berhasil update blog');
    }

    public function hapusblog($id)
    {
        $blog = portfolio::find($id);
        $blog->delete();
        return redirect('blog/my')->with('message', 'berhasil delete blog');
    }
}
