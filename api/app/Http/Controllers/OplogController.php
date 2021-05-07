<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\OpLog;

class OplogController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->is_demo) {
            return redirect('/home');
        }

        $limit = request('limit', 20);
        $oplogs = my_comp()->oplog()->orderBy('id', 'desc')
            ->with('user')
            ->get();

        $oplogs = $this->paginate($oplogs, $limit);
        return view('oplogs.index', compact('oplogs'));
    }
}
