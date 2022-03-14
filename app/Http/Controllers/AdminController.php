<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    function index(){
        $pertanyaan = DB::select('select *,  pertanyaan.id as idtanya from pertanyaan join kategori on pertanyaan.id_kategori=kategori.id 
                                                            join users on users.id=pertanyaan.id_author order by pertanyaan');
        $kategori = DB::select('select * from kategori order by kategori');

        // side nav kategori
        $kategori_1 = DB::select('select * from kategori where id_role=3 order by kategori');
        $kategori_2 = DB::select('select * from kategori where id_role=2 order by kategori');

        $role = DB::select('select * from user_role where id<>1');
        return view('admin.index', ['pertanyaan'=>$pertanyaan, 'kategori_2'=>$kategori_2, 'kategori_1'=>$kategori_1], ['kategori'=>$kategori, 'role'=>$role]);
    }

    // hasil pencarian pertanyaan
    public function ambil_p(Request $request)
    {
        $nama = $request->nama;
        $pertanyaan = DB::table('pertanyaan')
        ->select('*', 'pertanyaan.id as idtanya') 
        ->join('kategori', 'pertanyaan.id_kategori', '=', 'kategori.id')
        ->join('users', 'users.id', '=', 'pertanyaan.id_author')
        ->orderBy('pertanyaan.pertanyaan', 'ASC')
        ->where('pertanyaan','like',"%".$nama."%")->get(); 
        
        if (count($pertanyaan)<=0){
            return '<center><p class="text-muted">Tidak ada data yang ditemukan!</p></center>';
        }
        
        return view('admin.get_pertanyaan1', ['pertanyaan' => $pertanyaan]);
    }

    // halaman contact us
    function contact(){

        // side nav kategori
        $kategori_1 = DB::select('select * from kategori where id_role=3 order by kategori');
        $kategori_2 = DB::select('select * from kategori where id_role=2 order by kategori');

        return view('admin.contactus', ['kategori_2'=>$kategori_2, 'kategori_1'=>$kategori_1]);
    }

    // ---------------------------------------------PERTANYAAN INDEX-----------------------------------------------------
    // hapus pertanyaan halaman index
    function hapus_p($id){
        DB::table('pertanyaan')->where('id', $id)->delete();
        return redirect('admin/index')->with('status', 'Pertanyaan berhasil dihapus!');
    }

    // menuju ke halaman edit_p index
    function edit_p($id){

        // side nav kategori
        $kategori_1 = DB::select('select * from kategori where id_role=3 order by kategori');
        $kategori_2 = DB::select('select * from kategori where id_role=2 order by kategori');

        // dropdown kategori
        $kategori = DB::select('select * from kategori order by kategori');

        // mengambil data pertanyaan berdasarkan id yang dipilih
        $pertanyaan = DB::table('pertanyaan')->where('id',$id)->get();

        // passing data pegawai yang didapat ke view editpertanyaan.blade.php
        return view('admin.edit_p', ['kategori_2'=>$kategori_2, 'kategori_1'=>$kategori_1], ['pertanyaan'=>$pertanyaan, 'kategori'=>$kategori]);
    }

    // proses edit pertanyaan index
    function edit_tanyaindex(Request $request, $id){

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

        // $id_author = Auth::user()->id;

        DB::table('pertanyaan')->where('id', $id)->update([
            'id_kategori' => $request->kategori,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            
        ]);
        return redirect()->route('admin.dashboard')->with('status', 'Pertanyaan berhasil diubah!');
    }

    // menuju ke halaman add_p index
    function add_p(){

        // side nav kategori
        $kategori_1 = DB::select('select * from kategori where id_role=3 order by kategori');
        $kategori_2 = DB::select('select * from kategori where id_role=2 order by kategori');
        
        $kategori = DB::select('select * from kategori');
        return view('admin.add_p', ['kategori'=>$kategori, 'kategori_2'=>$kategori_2, 'kategori_1'=>$kategori_1]);
    }

    // proses add pertanyaan index
    public function add_tanyaindex(Request $request)
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

        return redirect('admin/index')->with('status', 'Pertanyaan berhasil ditambahkan!');
    }

    // ---------------------------------------------KATEGORI INDEX-----------------------------------------------------
    // hapus kategori halaman index
    function hapus_k($id){
        DB::table('kategori')->where('id', $id)->delete();
        return redirect('admin/index')->with('status_k', 'Kategori berhasil dihapus!');
    }

    // edit kategori halaman index
    function edit_k(Request $request, $id){
        $request->validate([
            'kategori' => 'required',
            'role' => 'required',
        ], [
            'kategori.required' => 'Kategori tidak boleh kosong',
            'role.required' => 'Pertanyaan tidak boleh kosong',
        ]);

        $kategori = DB::table('kategori')
        ->select('image')
        ->where('id', $id)
        ->get();
        // return dd($kategori[0]->image);

        if($request->image){
            $image = $request->file('image')->getClientOriginalName();
            if($kategori[0]->image){
                storage::disk('public')->delete($kategori[0]->image);
                $request->image = $request->file('image')->storeAs('icon_kategori', $image, 'public');
            } else{
                $request->image = $request->file('image')->storeAs('icon_kategori', $image, 'public');
            }
        } else{
            $request->image = $kategori[0]->image;
        }

        DB::table('kategori')->where('id', $id)->update([
            'kategori' => $request->kategori,
            'id_role' => $request->role,
            'image' => $request->image,
        ]);
        return redirect()->route('admin.dashboard')->with('status_k', 'Kategori berhasil diubah!');
    }

    // add kategori halaman index
    public function add_k(Request $request)
    {
        // return $request->file('image')->store('post-images');

        $request->validate([
            'kategori' => 'required',
            'role' => 'required',
        ], [
            'kategori.required' => 'Kategori tidak boleh kosong',
            'role.required' => 'Pertanyaan tidak boleh kosong',
        ]);

        if($request->image){
            $image = $request->file('image')->getClientOriginalName();
            $request->image = $request->file('image')->storeAs('icon_kategori', $image, 'public');
        }
        
        DB::table('kategori')->insert([
            'kategori' => $request->kategori,
            'id_role' => $request->role,
            'image' => $request->image,
        ]);
        return redirect()->route('admin.dashboard')->with('status_k', 'Kategori berhasil ditambahkan!');
    }

    // menampilkan kategori di side nav, data pertanyaan, judul kategori
    public function detailkat($id)
    {
        // side nav kategori
        $kategori_1 = DB::select('select * from kategori where id_role=3 order by kategori');
        $kategori_2 = DB::select('select * from kategori where id_role=2 order by kategori');

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
        return view('admin.kategori', ['kategori_1'=>$kategori_1, 'kategori_2'=>$kategori_2], ['topikpertanyaan' => $topikpertanyaan, 'topikkategori'=>$topikkategori]);
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
        
        return view('admin.get_pertanyaan', ['jawaban' => $jawaban]);
    }

    // add halaman add kategori 
    function add_p2($id){

        // side nav kategori
        $kategori_1 = DB::select('select * from kategori where id_role=3 order by kategori');
        $kategori_2 = DB::select('select * from kategori where id_role=2 order by kategori');

        // mengambil input kategori berdasarkan id kategori yang dipilih
        $kategori = DB::table('kategori')
        ->where('id',$id)->get(); 

        // $kategori = DB::select('select * from kategori where id_role=2');
        return view('admin.add_p2', ['kategori'=>$kategori, 'kategori_1'=>$kategori_1, 'kategori_2'=>$kategori_2]);
    }

    // tambah pertanyaan halaman kategori
    public function add_tanyakategori(Request $request)
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

        return redirect()->route('admin.kategori', $request->kategori)->with('status', 'Pertanyaan berhasil ditambahkan!');
    }

    // hapus pertanyaan pada halaman kategori
    function hapus_p2($id){
        DB::table('pertanyaan')->where('id', $id)->delete();
        return redirect()->back()->with('status', 'Pertanyaan berhasil dihapus!');
    }

    // edit halaman kategori
    function edit_p2($id){

        // side nav kategori
        $kategori_1 = DB::select('select * from kategori where id_role=3 order by kategori');
        $kategori_2 = DB::select('select * from kategori where id_role=2 order by kategori');

        // dropdown kategori
        $kategori = DB::select('select * from kategori order by kategori');

        // mengambil data pertanyaan berdasarkan id yang dipilih
        $pertanyaan = DB::table('pertanyaan')->where('id',$id)->get();

        // passing data pegawai yang didapat ke view editpertanyaan.blade.php
        return view('admin.edit_p2', ['kategori'=>$kategori, 'kategori_1'=>$kategori_1, 'kategori_2'=>$kategori_2], ['pertanyaan'=>$pertanyaan]);
    }

    // update pertanyaan
    function edit_tanyakategori(Request $request, $id){
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

        // $id_author = Auth::user()->id;

        DB::table('pertanyaan')->where('id', $id)->update([
            'id_kategori' => $request->kategori,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
            
        ]);
        return redirect()->route('admin.kategori', $request->kategori)->with('status', 'Pertanyaan berhasil diubah!');
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
