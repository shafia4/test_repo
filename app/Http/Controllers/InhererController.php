<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inherer;
use App\Inhereracess;
use App\User;
use App\Partner;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Auth;
use Lang;

class InhererController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inherers = Inherer::where('user_id', Auth::user()->id)->get();

        return view('inherer.index', compact('inherers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inherer.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [


            'photo' => 'max:10000|mimes:png,jpg,jpeg,pdf,doc,docx',

            ]
        );

        $request['user_id'] = Auth::user()->id;
        $request['passcode'] = substr(md5(mt_rand()), 0, 7);
        ;
        $inherer = Inherer::create($request->all());

        $inherers = Inherer::where('user_id', Auth::user()->id)->get();


        //return view('inherer.index', compact('inherers'))->with('message','Die Person wurde erfolgreich hinzugefügt');

        return redirect()->route('inherer.index')->with('message', 'Die Person wurde erfolgreich hinzugefügt');
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
        //
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
        $this->validate($request, []);



        $inherer = Inherer::findOrFail($id);



        if ($request['telnr'] !== null) {
            $input['telnr'] = $request['telnr'];
        }
        if ($request['email'] !== null) {
            $input['email'] = $request['email'];
        }
        if ($request['is_active'] !== null) {
            $input['is_active'] = $request['is_active'];
        }

        if ($request['graceperiod'] !== null) {
            $input['graceperiod'] = $request['graceperiod'];
        }
        if ($request['message'] !== null) {
            $input['message'] = $request['message'];
        }

        $inherer->update($input);
        return back()->with('message', Lang::get('add.msgsavedasset'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $inherer = Inherer::where('id', $id)->delete();
        $inhereracess = Inhereracess::where('inherer_id', $id)->delete();


        return back()->with('message', 'Erfolgreich gelöscht');
    }

    public function updatepasscode(Request $request)
    {


        $newpasscode = substr(md5(mt_rand()), 0, 7);
        $id = $request['inhererid'];

        $inherer = Inherer::findOrFail($id)->update(['passcode' => $newpasscode]);

        return back()->with('message', Lang::get('add.passcodeupdated'));
    }





    public function get()
    {

        return view('inherer.get', compact('inherers'));
    }

    public function getdata(Request $request)
    {

        $userid = User::where('email', $request['notedemail'])->first();

        $inhererid = Inherer::where([['user_id', $userid->id], ['passcode', $request['passcode']], ['email', $request['inhereremail']]])->first();



        if ($inhererid != []) {
            if (DB::table('inhereracesses')->where('user_id', $userid->id)->where('inherer_id', $inhererid->id)->doesntExist()) {
                DB::table('inhereracesses')->insert(['user_id' => $userid->id, 'inherer_id' => $inhererid->id, 'acessed' => strToTime(now())]);
                $acessedtime = strToTime(now());
            } else {
                $acessedtime = DB::table('inhereracesses')->where('user_id', $userid->id)->where('inherer_id', $inhererid->id)->value('acessed');
                $inherer = User::findOrFail($userid->id);
            }

            if ((strToTime(now()) > ($acessedtime) + $inhererid->graceperiod) and ($inhererid->is_active == 1)) {
                Session::put('inhererid', $userid->id);
                $partners = Partner::where('user_id', $userid->id)->get();
            }

            return view('inherer.approved', compact('inhererid', 'userid', 'acessedtime', 'is_active', 'inherer', 'partners'));
        } else {
            return view('inherer.disapproved');
        }
    }
}
