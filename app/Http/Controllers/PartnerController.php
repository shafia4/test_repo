<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use Auth;
use App\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::where('user_id', Auth::user()->id)->get();

        return view('partner.index', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partner.add');
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
        $partner = Partner::create($request->all());

        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('photos', $name);

            DB::table('photos')->insert(
                ['partner_id' => $partner->id, 'path' => $name]
            );
        }




        $partner = Partner::all();


        return redirect()->route('partner.index')->with('message', 'Die Person wurde erfolgreich hinzugefügt');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $partner = Partner::findOrFail($id);

        // dd($partner);

        if (Auth::user()->id == $partner->user_id or Session::get('inhererid') == $partner->user_id) {
            //$partner=Partner::findOrFail($id);
            return view('partner.show', compact('partner'));
        } else {
            return back();
        }
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
        $this->validate(
            $request,
            [


                'photo' => 'max:10000|mimes:png,jpg,jpeg,pdf,doc,docx',

            ]
        );



        $partner = partner::findOrFail($id);



        if ($request['contactperson'] !== null) {
            $input['contactperson'] = $request['contactperson'];
        }
        if ($request['email'] !== null) {
            $input['email'] = $request['email'];
        }
        if ($request['tel'] !== null) {
            $input['tel'] = $request['tel'];
        }

        if ($request['street'] !== null) {
            $input['street'] = $request['street'];
        }
        if ($request['city'] !== null) {
            $input['city'] = $request['city'];
        }

        if ($request['idnumber'] !== null) {
            $input['idnumber'] = $request['idnumber'];
        }
        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('photos', $name);

            DB::table('photos')->insert(
                ['partner_id' => $partner->id, 'path' => $name]
            );
        }

        if (isset($input)) {
            $partner->update($input);
        };


        return back()->with('message', 'Der Partner wurde erfolgreich geändert');
        ;
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::where('id', $id)->delete();

        return back()->with('message', 'Erfolgreich gelöscht');
    }

    public function deletephoto($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();



        return back();
    }
}
