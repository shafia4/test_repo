<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use App\User;
use App\Inherer;
use App\Liability;
use App\Asset;
use App\Assetusage;
use App\Assettype;
use Auth;

class UserController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $currency = Currency::all();
        $user = Auth::user();
        $inherers = Inherer::where('user_id', Auth::user()->id)->get();

        return view('user.edit', compact('id', 'inherers', 'user', 'currency'));
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
        $user = User::findOrFail($id);

        if ($request['name'] !== null) {
            $input['name'] = $request['name'];
        }
        if ($request['email'] !== null) {
            $input['email'] = $request['email'];
        }
        if ($request['adress'] !== null) {
            $input['adress'] = $request['adress'];
        }
        if ($request['city'] !== null) {
            $input['city'] = $request['city'];
        }
        if ($request['country'] !== null) {
            $input['country'] = $request['country'];
        }
        if ($request['currency_id'] !== null) {
            $input['currency_id'] = $request['currency_id'];
        }

        $user->update($input);
        $status = "Deine Einstellungen wurde erfolgreich aktualisiert";
        return back()->with('message', 'Die Anlage wurde erfolgreich geändert');
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

    public function newuser()
    {

        $currency = Currency::all();
        $assetusage = Assetusage::all();
        $assettypes = Assettype::all();


        return view('newuser', compact('assetusage', 'assettypes', 'currency'));
    }

    public function newuser1()
    {
        return route('user.new1');
    }

    public function newuser2()
    {

        return route('user.new2', compact('assetusage', 'assettypes', 'currency'));
    }

    public function newuser3()
    {

        return view('newuser3');
    }

    public function updatenewuser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request['currency_id'] !== null) {
            $input['currency_id'] = $request['currency_id'];
            $user->update($input);
        };


        $currency = Currency::all();
        $assetusage = Assetusage::all();
        $assettypes = Assettype::all();


        $status = "Die Währung wurde erfolgreich ausgewählt";

        return view('newuser1', compact('assetusage', 'assettypes', 'currency'));
    }

    public function updatenewuser1(Request $request)
    {



        $this->validate(
            $request,
            [

                'name' => 'required',
                'value' => 'required',

            ]
        );


        $currency = Currency::all();
        $request['currency_id'] = Auth::user()->currency->id;
        $request['value'] = str_replace(',', '.', $request['value']);
        $asset = Asset::create($request->all());
        $currency = Currency::all();



        return view('newuser2', compact('asset', 'currency'));
    }

    public function updatenewuser2(Request $request)
    {


        if (null !== (strpos($request['interest'], ','))) {
            $request['interest'] = str_replace(',', '.', $request['interest']);
        }

        $request['agreementdate'] = strTotime($request['agreementdate']);
        $request['enddate'] = strTotime($request['enddate']);
        $request['currentvalue'] = str_replace(',', '.', $request['currentvalue']);
        if ($request['initialvalue'] == '') {
            $request['initialvalue'] = $request['currentvalue'];
        } else {
            $request['initialvalue'] = str_replace(',', '.', $request['initialvalue']);
        }

        if ($request['interest'] == '') {
            $request['interest'] = 0;
        }



        $liability = Liability::create($request->all());



        return view('newuser3');
    }
}
