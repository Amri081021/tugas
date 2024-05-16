<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemproduk = Produk::orderBy('created_at', 'desc')->paginate(20);
        $data = array('title' => 'Produk',
                    'itemproduk' => $itemproduk);
        return view('produk.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data = array('title' => 'Form Produk Baru',
                    'itemkategori' => $itemkategori);
        return view('produk.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_produk' => 'required|unique:produks',
            'nama_produk' => 'required',
            'slug_produk' => 'required',
            'deskripsi_produk' => 'required',
            'kategori_id' => 'required',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);

       $itemuser = $request->user();//ambil data user yang login
       $slug = \Str::slug($request->slug_produk);//buar slug dari input slug produk
       $inputan = $request->all();
       $inputan['slug_produk'] = $slug;
       $inputan['user_id'] = $itemuser->id;
       $inputan['status'] = 'publish';
       $itemproduk = Produk::create($inputan);
       return redirect()->route('produk.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemproduk = Produk::findOrFail($id);
        $data = array('title' => 'Data Produk',
                    'itemproduk' => $itemproduk);
        return view('produk.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemproduk = Produk::findOrFail($id);
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data = array('title' => 'Form Edit Produk',
                    'itemproduk' => $itemproduk,
                    'itemkategori' =>$itemkategori);
        return view('produk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode_produk' => 'required|unique:produks,id,'.$id,
            'nama_produk' => 'required',
            'slug_produk' => 'required',
            'deskripsi_produk' => 'required',
            'kategori_id' => 'required',
            'qty' => 'required|numeric',
            'satuan' => 'required|numeric',
            'harga' => 'required|numeric'
        ]);
        $itemproduk = Produk::findOrFail($id);
        //kalo ga ada error page not found 404
        $slug = \Str::slug($request->slug_produk); //slug kita gunakan nanti pas buka produk
        //kita validasi dulu, biar tidak ada slug yang sama
        $validasislug = Produk::where('id', '!=', $id) //yang idnya tidak sama dengan $id
                            ->where('slug_produk', $slug)
                            ->first();
        if($validasislug) {
            return back()->with('error', 'Slug sudah ada, coba yang lain');
        } else {
            $inputan = $request->all();
            $inputan['slug'] = $slug;
            $itemproduk->update($inputan);
            return redirect()->route('produk.index')->with('success', 'Data berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemproduk = Produk::findOrFail($id); //cari berdasarkan id=$id
        //kalau ga ada error page not found 404
        if ($itemproduk->delete()) {
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('error', 'Data gagal dihapus');
        }
    }

    public function uploadimage(Request $request){
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'required',
        ]);
        $itemuser = $request->user();
        $itemkategori = Kategori::where('user_id', $itemuser->id)
                                ->where('id', $request->kategori_id)
                                ->first();
        if ($itemkategori){
            $fileupload = $request->file('image');
            $folder = 'asset/images';
            $itemgambar = (new ImageController)->upload($fileupload, $itemuser, $folder);
            $inputan['foto'] = $itemgambar->url;//ambil url yang di upload
            $itemkategori->update($inputan);
            return back()->with('success', 'image berhasil di upload');
        }else{
            return back()->with('error', 'kategori tidak ditemukan');
        }
    }

    public function deleteimage(Request $request, $id) {
        $itemuser = $request->user();
        $itemkategori = Kategori::where('user_id', $itemuser->id)
                                ->where('id', $id)
                                ->first();
        if($itemkategori) {
            //cari database berdasarkan URL gambar
            $itemgambar = \App\Image::where('url', $itemkategori->foto)->first();
            //hapus imagenya
            if($itemgambar){
                \Storage::delete($itemgambar->url);
                $itemgambar->delete();
            }
            //baru upload ketegori
            $itemkategori->update(['foto' => null]);
            return back()->width('success', 'Data berhasil dihapus');
        }else{
            return back()->with('error', 'Data tidak ditemukan');
        }
    }

}
