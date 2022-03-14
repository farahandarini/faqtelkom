<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserEksternalController extends Controller
{
    //menampilkan pertanyaan
    public function index()
    {
        $pertanyaan = DB::select('select * from pertanyaan join kategori on pertanyaan.id_kategori=kategori.id where id_role=3 order by pertanyaan');
        $kategori = DB::select('select * from kategori where id_role=3 order by kategori');
        return view('usereksternal.index', ['pertanyaan'=>$pertanyaan], ['kategori'=>$kategori]);
    }

    // halaman contact us
    function contact(){
        $kategori = DB::select('select * from kategori where id_role=3 order by kategori');
        return view('usereksternal.contactus', ['kategori'=>$kategori]);
    }

    // hasil pencarian pertanyaan
    public function ajax(Request $request)
    {

        $kategori = DB::select('select * from kategori where id_role=3 order by kategori');

        $name = $request->name;
        $pertanyaan = DB::table('pertanyaan')
        ->join('kategori', 'pertanyaan.id_kategori', '=', 'kategori.id')
        ->orderBy('pertanyaan', 'ASC')
        ->where('id_role', '=', 3)
        ->where('pertanyaan','like',"%".$name."%")->get();

        if (count($pertanyaan)<=0){
            return '<center><p class="text-muted">Tidak ada data yang ditemukan!</p></center>';
        }
        
        return view('usereksternal.ajaxpage', ['pertanyaan' => $pertanyaan], ['kategori'=>$kategori]);
    }

    // menampilkan kategori di side nav, data pertanyaan, judul kategori
    public function detailkat($id)
    {
        // side nav kategori
        $kategori = DB::select('select * from kategori where id_role=3 order by kategori');

        // mengambil data pertanyaan berdasarkan id kategori yang dipilih
        $topikpertanyaan = DB::table('pertanyaan')
        ->orderBy('pertanyaan', 'ASC')
        ->where('id_kategori',$id)->get();

        // mengambil judul kategori berdasarkan id kategori yang dipilih
        $topikkategori = DB::table('kategori')
        ->orderBy('kategori', 'ASC')
        ->where('id',$id)->get(); 
        // ['topikkategori'=>$topikkategori], 

        // passing data pertanyaan yang didapat ke view kategori.blade.php
        return view('usereksternal.kategori', ['kategori'=>$kategori], ['topikpertanyaan' => $topikpertanyaan, 'topikkategori'=>$topikkategori]);
    }

    // search di halaman kategori.blade.php
    public function get_pertanyaan(Request $request)
    {
        $name = $request->name;
        $id_kategori = $request->id_kategori;
        $jawaban = DB::table('pertanyaan')
        ->join('kategori', 'pertanyaan.id_kategori', '=', 'kategori.id')
        ->orderBy('pertanyaan', 'ASC')
        ->where('id_kategori', $id_kategori)
        ->where('pertanyaan','like',"%".$name."%")->get();

        if (count($jawaban)<=0){
            return '<center><p class="text-muted">Tidak ada data yang ditemukan!</p></center>';
        }
        
        return view('usereksternal.get_pertanyaan', ['jawaban' => $jawaban]);
    }
}
