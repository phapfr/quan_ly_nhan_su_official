<?php

namespace App\Http\Controllers;

use App\Models\Luong;
use Illuminate\Http\Request;

class LuongController extends Controller
{
    public function index()
    {
        return view('Page.Luong.index');
    }

    public function store(Request $request)
    {
        $data   = $request->all();
        Luong::create($data);
        return response()->json([
            'trang_thai_them_moi' => true,
        ]);
    }

    public function getData()
    {
        $data = Luong::get();
        return response()->json([
            'luong'  => $data,
        ]);
    }
}
