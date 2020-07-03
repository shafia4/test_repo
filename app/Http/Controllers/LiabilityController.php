<?php

namespace App\Http\Controllers;

use App\Liability;
use App\Partner;
use App\Contract;
use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Auth;

class LiabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = Currency::all();
        $liabilities = Liability::where('user_id', Auth::user()->id)->get();

        return view('liability.index', compact('liabilities', 'currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$liabilities=Liability::where('user_id',Auth::user()->id)->get();
        $currency = Currency::all();
        $liabilities = Liability::all();
        return view('liability.add', compact('liabilities', 'currency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        if ($file = $request->file('contract')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('contracts', $name);
            DB::table('contracts')->insert(
                ['liability_id' => $liability->id,'path' => $name,'name' => $liability->name]
            );
        }
         




        $liabilities = Liability::where('user_id', Auth::user()->id)->get();


        return redirect()->route('liability.index')->with('message', 'Die Verbindlichkeit wurde erfolgreich hinzugefügt');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Liability $liability
     * @return \Illuminate\Http\Response
     */
    public function show(Liability $liability)
    {
        if (Auth::user()->id == $liability->user->id or Session::get('inhererid') == $liability->user->id) {
            $contracts = Contract::where('liability_id', $liability->id)->get();
            return view('liability.show', compact('liability', 'contracts'));
        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Liability $liability
     * @return \Illuminate\Http\Response
     */
    public function edit(Liability $liability)
    {
       
        $currency = Currency::all();
        $contracts = Contract::where('liability_id', $liability->id)->get();
        $partners = Partner::where('user_id', Auth::user()->id)->get();
        return view('liability.edit', compact('liability', 'partners', 'contracts', 'currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Liability           $liability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        

        $liability = Liability::findOrFail($id);

        if ($request['name'] !== null) {
            $input['name'] = $request['name'];
        }
        if ($request['user_id'] !== null) {
            $input['user_id'] = $request['user_id'];
        }
        if ($request['agreementdate'] !== null) {
            $input['agreementdate'] = strTotime($request['agreementdate']);
        }
        if ($request['contractnr'] !== null) {
            $input['contractnr'] = $request['contractnr'];
        }
        if ($request['creditor'] !== null) {
            $input['creditor'] = $request['creditor'];
        }
        if ($request['currentvalue'] !== null) {
             $request['currentvalue'] = str_replace(',', '.', $request['currentvalue']);
            $input['currentvalue'] = $request['currentvalue'];
        }
        if ($request['initialvalue'] !== null) {
             $request['initialvalue'] = str_replace(',', '.', $request['initialvalue']);
            $input['initialvalue'] = $request['initialvalue'];
        }
        if ($request['interest'] !== null) {
            if (null !== (strpos($request['interest'], ','))) {
                $input['interest'] = str_replace(',', '.', $request['interest']);
            } else {
                $input['interest'] = $request['interest'];
            };
        }
        if ($request['enddate'] !== null) {
            $input['enddate'] = strTotime($request['enddate']);
        }
        if ($request['notes'] !== null) {
            $input['notes'] = $request['notes'];
        }
        if ($request['liabilitytype'] !== null) {
            $input['liabilitytype'] = $request['liabilitytype'];
        }
        if ($request['currency_id'] !== null) {
            $input['currency_id'] = $request['currency_id'];
        }

      

        $liability->update($input);

        if ($file = $request->file('contract')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('contracts', $name);
            DB::table('contracts')->insert(
                ['liability_id' => $liability->id,'path' => $name,'name' => $liability->name]
            );
        }

          $contracts = Contract::where('liability_id', $liability->id)->get();

        return redirect()->back()->with('message', 'Die Verbindlichkeit wurde erfolgreich geändert');
          
         
        // return view('liability.show',compact('liability','contracts','updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Liability $liability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liability $liability)
    {
     
        $liability->delete();
        
        Session::flash('message', 'Erfolgreich gelöscht');
        Session::flash('alert-class', 'alert-danger');
         
         $liabilities = Liability::where('user_id', Auth::user()->id)->get();

        return view('liability.index', compact('liabilities'));
    }

    public function deletecontract($id)
    {
        $contract = Contract::findOrFail($id);
        $contract->delete();
        
       

        return back();
    }
}
