<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Inherer;
use App\Currency;
use App\User;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function currency()
    {
        $currency = Currency::all();

        return view('admin.currency', compact('currency'));
    }


    public function dashboard()
    {
        $currency = Currency::all();
        $user = User::all();
        $lastuserjoin = $user->sortByDesc('created_at')->first();
        $lastuserupdate = $user->sortByDesc('updated_at')->first();


        return view('admin.dashboard', compact('currency', 'user', 'lastuserjoin', 'lastuserupdate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function currencyupdate(Request $request)
    {
        $request['updated_at'] = now()->toDateTimeString();

        if ($request['USD'] !== null) {
            DB::table('currencies')->where('name', 'USD')->update(['tolead' => $request['USD'], 'updated_at' => $request['updated_at']]);
        }
        if ($request['GBP'] !== null) {
            DB::table('currencies')->where('name', 'GBP')->update(['tolead' => $request['GBP'], 'updated_at' => $request['updated_at']]);
        }
        if ($request['HRK'] !== null) {
            DB::table('currencies')->where('name', 'HRK')->update(['tolead' => $request['HRK'], 'updated_at' => $request['updated_at']]);
        }
        if ($request['BAM'] !== null) {
            DB::table('currencies')->where('name', 'BAM')->update(['tolead' => $request['BAM'], 'updated_at' => $request['updated_at']]);
        }
        if ($request['CHF'] !== null) {
            DB::table('currencies')->where('name', 'CHF')->update(['tolead' => $request['CHF'], 'updated_at' => $request['updated_at']]);
        }
        if ($request['BTC'] !== null) {
            DB::table('currencies')->where('name', 'BTC')->update(['tolead' => $request['BTC'], 'updated_at' => $request['updated_at']]);
        }
        if ($request['LTC'] !== null) {
            DB::table('currencies')->where('name', 'LTC')->update(['tolead' => $request['LTC'], 'updated_at' => $request['updated_at']]);
        }

         //dd($request);

         return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
