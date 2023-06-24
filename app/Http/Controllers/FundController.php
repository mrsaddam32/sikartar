<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funds = Fund::orderBy('tanggal_pemasukkan', 'desc')->paginate(10);
        $totalPemasukkan = Fund::sum('jumlah_nominal');

        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.funds.index', [
                'title' => 'Keuangan',
                'active' => 'admin/keuangan',
            ], compact('funds', 'totalPemasukkan'));
        } else {
            return view('user.funds.index', [
                'title' => 'Keuangan',
                'active' => 'user/keuangan',
            ], compact('funds', 'totalPemasukkan'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('admin.funds.create', [
                'title' => 'Input Pemasukkan Baru',
                'active' => 'admin/keuangan',
            ]);
        } else {
            return view('user.funds.create', [
                'title' => 'Input Pemasukkan Baru',
                'active' => 'user/keuangan',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Fund::create([
            'sumber_dana' => $request->sumber_dana,
            'jumlah_nominal' => $request->jumlah_nominal,
            'tanggal_pemasukkan' => date('Y-m-d', strtotime($request->tanggal_pemasukkan)),
        ]);

        Fund::updateTotalPemasukkan();

        if (Auth::check() && Auth::user()->role_id == 1) {
            return redirect()->route('admin.keuangan.index')->with('success', 'New fund entry data has been added');
        } else {
            return redirect()->route('user.keuangan.index')->with('success', 'New fund entry data has been added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function show(Fund $fund)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function edit(Fund $fund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fund $fund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fund  $fund
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fund $fund)
    {
        //
    }
}
