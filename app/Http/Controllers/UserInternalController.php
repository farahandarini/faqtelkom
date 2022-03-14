<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserInternalController extends Controller
{
    // menampilkan pertanyaan dan kategori
    function index(){
        $pertanyaan = DB::select('select *,  pertanyaan.id as idtanya from pertanyaan join kategori on pertanyaan.id_kategori=kategori.id 
                                                            join users on users.id=pertanyaan.id_author where kategori.id_role=2 order by pertanyaan');
        $kategori = DB::select('select * from kategori where id_role=2');
        return view('userinternal.index', ['pertanyaan'=>$pertanyaan], ['kategori'=>$kategori]);
    }

    // hasil pencarian pertanyaan
    public function ajax(Request $request)
    {
        $nama = $request->nama;
        $pertanyaan = DB::table('pertanyaan')
        ->select('*', 'pertanyaan.id as idtanya') 
        ->join('kategori', 'pertanyaan.id_kategori', '=', 'kategori.id')
        ->join('users', 'users.id', '=', 'pertanyaan.id_author')
        ->orderBy('pertanyaan', 'ASC')
        ->where('kategori.id_role', '=', 2)
        ->where('pertanyaan','like',"%".$nama."%")->get();        
        
        if (count($pertanyaan)<=0){
            return '<center><p class="text-muted">Tidak ada data yang ditemukan!</p></center>';
        }

        return view('userinternal.get_pertanyaan1', ['pertanyaan' => $pertanyaan]);
    }

    // halaman contact us
    function contact(){
        $kategori = DB::select('select * from kategori where id_role=2');
        return view('userinternal.contactus', ['kategori'=>$kategori]);
    }

    // halaman addpertanyaan 
    function addpertanyaan(){
        $kategori = DB::select('select * from kategori where id_role=2 order by kategori');
        return view('userinternal.addpertanyaan', ['kategori'=>$kategori]);
    }

    // tambah pertanyaan
    public function addpertanyaanprocess(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
            'pertanyaan' => 'required|max:50',
            'jawaban' => 'required',
        ], [
            'kategori.required' => 'Kategori tidak boleh kosong',
            'pertanyaan.required' => 'Pertanyaan tidak boleh kosong',
            'jawaban.required' => 'Jawaban tidak boleh kosong',
            'pertanyaan.max' => 'Pertanyaan tidak boleh lebih dari 50 karakter'
        ]);

        $id_author = Auth::user()->id;
        
        DB::table('pertanyaan')->insert([
            'id_kategori' => $request->kategori,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'id_author' => $id_author,
        ]);

        return redirect('userinternal/index')->with('status', 'Pertanyaan berhasil ditambahkan!');
    }

    // halaman editpertanyaan 
    function editpertanyaan($id){

        // dropdown kategori
        $kategori = DB::select('select * from kategori where id_role=2 order by kategori');

        // mengambil data pertanyaan berdasarkan id yang dipilih
        $pertanyaan = DB::table('pertanyaan')->where('id',$id)->get();

        // passing data pegawai yang didapat ke view editpertanyaan.blade.php
        return view('userinternal.editpertanyaan', ['kategori'=>$kategori], ['pertanyaan'=>$pertanyaan]);
    }

    // update pertanyaan
    function editpertanyaanprocess(Request $request, $id){
        $request->validate([
            'kategori' => 'required',
            'pertanyaan' => 'required|max:50',
            'jawaban' => 'required',
        ], [
            'kategori.required' => 'Kategori tidak boleh kosong',
            'pertanyaan.required' => 'Pertanyaan tidak boleh kosong',
            'jawaban.required' => 'Jawaban tidak boleh kosong',
            'pertanyaan.max' => 'Pertanyaan tidak boleh lebih dari 50 karakter'
        ]);

        $id_author = Auth::user()->id;

        DB::table('pertanyaan')->where('id', $id)->update([
            'id_kategori' => $request->kategori,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'id_author' => $id_author,
        ]);
        return redirect()->route('userinternal.dashboard')->with('status', 'Pertanyaan berhasil diubah!');
    }

    // hapus pertanyaan
    function hapuspertanyaan($id){
        DB::table('pertanyaan')->where('id', $id)->delete();
        return redirect('userinternal/index')->with('status', 'Pertanyaan berhasil dihapus!');
    }

    // menampilkan kategori di side nav, data pertanyaan, judul kategori
    public function detailkat($id)
    {
        // side nav kategori
        $kategori = DB::select('select * from kategori where id_role=2 order by kategori');

        // mengambil data pertanyaan berdasarkan id kategori yang dipilih
        $topikpertanyaan = DB::table('pertanyaan')
        ->select('*', 'pertanyaan.id as idtanya') 
        ->join('users', 'users.id', '=', 'pertanyaan.id_author')
        ->orderBy('pertanyaan', 'ASC')
        ->where('id_kategori',$id)->get();

        // mengambil judul kategori berdasarkan id kategori yang dipilih
        $topikkategori = DB::table('kategori')
        ->where('id',$id)->get(); 

        // passing data pertanyaan yang didapat ke view kategori.blade.php
        return view('userinternal.kategori', ['kategori'=>$kategori], ['topikpertanyaan' => $topikpertanyaan, 'topikkategori'=>$topikkategori]);
    }

    // search di halaman kategori.blade.php
    public function get_pertanyaan(Request $request)
    {
        $name = $request->name;
        $id_kategori = $request->id_kategori;
        $jawaban = DB::table('pertanyaan')
        ->select('*', 'pertanyaan.id as idtanya') 
        ->join('kategori', 'pertanyaan.id_kategori', '=', 'kategori.id')
        ->join('users', 'users.id', '=', 'pertanyaan.id_author')
        ->where('id_kategori', $id_kategori)
        ->orderBy('pertanyaan', 'ASC')
        ->where('pertanyaan','like',"%".$name."%")->get();

        if (count($jawaban)<=0){
            return '<center><p class="text-muted">Tidak ada data yang ditemukan!</p></center>';
        }
        
        return view('userinternal.get_pertanyaan', ['jawaban' => $jawaban]);
    }

    // edit halaman kategori
    function edit_pertanyaan($id){

        // dropdown kategori
        $kategori = DB::select('select * from kategori where id_role=2 order by kategori');

        // mengambil data pertanyaan berdasarkan id yang dipilih
        $pertanyaan = DB::table('pertanyaan')->where('id',$id)->get();

        // passing data pegawai yang didapat ke view editpertanyaan.blade.php
        return view('userinternal.edit_pertanyaan', ['kategori'=>$kategori], ['pertanyaan'=>$pertanyaan]);
    }

    // update pertanyaan
    function edit_proses(Request $request, $id){
        $request->validate([
            'kategori' => 'required',
            'pertanyaan' => 'required|max:50',
            'jawaban' => 'required',
        ], [
            'kategori.required' => 'Kategori tidak boleh kosong',
            'pertanyaan.required' => 'Pertanyaan tidak boleh kosong',
            'jawaban.required' => 'Jawaban tidak boleh kosong',
            'pertanyaan.max' => 'Pertanyaan tidak boleh lebih dari 50 karakter'
        ]);

        $id_author = Auth::user()->id;

        DB::table('pertanyaan')->where('id', $id)->update([
            'id_kategori' => $request->kategori,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'id_author' => $id_author,
        ]);
        return redirect()->route('userinternal.kategori', $request->kategori)->with('status', 'Pertanyaan berhasil diubah!');
        // return redirect()->back()->with('status', 'Pertanyaan berhasil dihapus!');
    }

    // hapus halaman kategori
    function hapus_pertanyaan($id){
        DB::table('pertanyaan')->where('id', $id)->delete();
        // return view('userinternal.kategori', ['kategori'=>$kategori], ['topikpertanyaan' => $topikpertanyaan, 'topikkategori'=>$topikkategori]);
        return redirect()->back()->with('status', 'Pertanyaan berhasil dihapus!');
    }

    // halaman kategori 
    function add_pertanyaan($id){
        // mengambil input kategori berdasarkan id kategori yang dipilih
        $kategori = DB::table('kategori')
        ->where('id',$id)->get(); 

        // $kategori = DB::select('select * from kategori where id_role=2');
        return view('userinternal.add_pertanyaan', ['kategori'=>$kategori]);
    }

    // tambah pertanyaan halaman kategori
    public function add_pertanyaanprocess(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|max:50',
            'jawaban' => 'required',
        ], [
            'pertanyaan.required' => 'Pertanyaan tidak boleh kosong',
            'jawaban.required' => 'Jawaban tidak boleh kosong',
            'pertanyaan.max' => 'Pertanyaan tidak boleh lebih dari 50 karakter'
        ]);

        $id_author = Auth::user()->id;
        
        DB::table('pertanyaan')->insert([
            'id_kategori' => $request->kategori,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            'id_author' => $id_author,
        ]);

        return redirect()->route('userinternal.kategori', $request->kategori)->with('status', 'Pertanyaan berhasil ditambahkan!');
    }

    public function upload(Request $request){
        // $fileName=$request->file('file')->getClientOriginalName();
        // $path=$request->file('file')->storeAs('uploads', $fileName, 'public');
        // return response()->json(['location'=>"/storage/$path"]); 

        $imgpath = request()->file('name')->store('uploads', 'public');
        return response()->json_encode(['location' => $imgpath]);
        
        /*$imgpath = request()->file('file')->store('uploads', 'public'); 
        return response()->json(['location' => "/storage/$imgpath"]);*/
    }
}
