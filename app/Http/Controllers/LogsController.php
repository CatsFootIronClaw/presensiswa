<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\tbl_user;
use Illuminate\Support\Facades\Auth;   

use Illuminate\Http\Request;

class LogsController extends Controller
{
    //
    public function index(Logs $logs, tbl_user $tbl_user)
    {
        $auth = Auth::user();
        $fotoprofil = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->where('guru.id_user', $auth->id_user)->get();
        $data = [
            'logsy' => $logs::orderBy('id_log', 'desc')->get(),
            'foto_profil' => $fotoprofil[0]
        ];

        return view('logs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Logs $logs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logs $logs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logs $logs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id_log = $request->input('id_log');
        // dd($id_logs);
        
        if ($id_log != null) {
            foreach ($id_log as $id) {
                Logs::where('id_log', $id)->delete();
            }
        }
        return redirect()->to('/logst')->with('success', 'Data berhasil dihapus');
    }

}
