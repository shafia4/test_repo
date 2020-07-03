<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Immo;
use App\Assetusage;
use App\Assettype;
use App\Partner;
use App\Document;
use App\Contract;
use App\Currency;
use App\Liability;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Auth;
use Lang;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = Currency::all();

        $allassets = Asset::where('user_id', Auth::user()->id)->get();
		
        $totalvalue = 0;

        foreach (Auth::user()->asset as $userasset) {
            if ($userasset->currency_id == Auth::user()->currency_id) {
                $totalvalue = $totalvalue + $userasset->value;
            } else {
                $totalvalue = $totalvalue + $userasset->value * $userasset->currency['tolead'];
            }
        }





        return view('asset.index', compact('allassets', 'currency', 'totalvalue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assetusage = Assetusage::all();
        $assettypes = Assettype::all();
        $liablities = Liability::where('user_id',Auth::user()->id)->pluck('name','id');
        
        return view('asset.add', compact('assetusage', 'assettypes','liablities'));
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

            'name' => 'required',
            'value' => 'required',

            ]
        );


        $currency = Currency::all();
        $request['currency_id'] = Auth::user()->currency->id;
        $request['value'] = str_replace(',', '.', $request['value']);
        //~ print_r($request->all());die;
        $asset = Asset::create($request->all());
        
        $assetid = $asset->id;
        $assettypes = Assettype::all();
        $assetusage = Assetusage::all();
        $partners = Partner::where('user_id', Auth::user()->id)->get();
        return view('asset.edit', compact('assetusage', 'assettypes', 'assetid', 'asset', 'partners', 'currency'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asset $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
		
        if (Auth::user()->id == $asset->user->id or Session::get('inhererid') == $asset->user->id) {
			$liablity = '';
			if(!empty($asset['liability_id'])){
				$liablity = Liability::where('id',$asset['liability_id'])->first();
			}
            return view('asset.show', compact('asset','liablity'));
        } else {
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asset $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        //$asset=Asset::findOrFail($asset);
        if (Auth::user()->id == $asset->user->id) {
            $currency = Currency::all();
            $partners = Partner::where('user_id', Auth::user()->id)->get();
            $assetusage = Assetusage::all();
            $assettypes = Assettype::all();
            $liablities = Liability::where('user_id',Auth::user()->id)->pluck('name','id');
            return view('asset.edit', compact('asset', 'assettypes', 'assetusage', 'partners', 'currency','liablities'));
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Asset               $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate(
            $request,
            [


            'currency_id' => 'required',
            'document' => '|max:10000|mimes:png,jpg,jpeg,pdf,doc,docx',
            'photo' => '|max:10000|mimes:png,jpg,jpeg,pdf',
            'assettype_id' => 'required',

            ]
        );


        $asset = Asset::findOrFail($id);

        if ($request['value'] !== null) {
            $request['value'] = str_replace(',', '.', $request['value']);
            $input['value'] = $request['value'];
        }
        if ($request['currency_id'] !== null) {
            $input['currency_id'] = $request['currency_id'];
        }
        if ($request['assettype_id'] !== null) {
            $input['assettype_id'] = $request['assettype_id'];
        }
        if ($request['assetusage_id'] !== null) {
            $input['assetusage_id'] = $request['assetusage_id'];
        }
        if ($request['city'] !== null) {
            $input['city'] = $request['city'];
        }
        if ($request['street'] !== null) {
            $input['street'] = $request['street'];
        }
        if ($request['valuebase'] !== null) {
            $input['valuebase'] = $request['valuebase'];
        }
        if ($request['milage'] !== null) {
            $input['milage'] = $request['milage'];
        }
        if ($request['licenseplate'] !== null) {
            $input['licenseplate'] = $request['licenseplate'];
        }
        if ($request['artist'] !== null) {
            $input['artist'] = $request['artist'];
        }

        if ($request['cost'] !== null) {
            $input['costs'] = $request['cost'];
        }
        if ($request['revenue'] !== null) {
            $input['revenue'] = $request['revenue'];
        }
        if ($request['enddate'] !== null) {
            $input['enddate'] = $request['enddate'];
        }
        if ($request['interest'] !== null) {
            if (null !== (strpos($request['interest'], ','))) {
                $input['interest'] = str_replace(',', '.', $request['interest']);
            } else {
                $input['interest'] = $request['interest'];
            };
        }
        if ($request['term'] !== null) {
            $input['term'] = $request['term'];
        }
        if ($request['brand'] !== null) {
            $input['brand'] = $request['brand'];
        }
        if ($request['serialnr'] !== null) {
            $input['serialnr'] = $request['serialnr'];
        }
        if ($request['initialinvestment'] !== null) {
            $input['initialinvestment'] = $request['initialinvestment'];
        }
        if ($request['purchasedate'] !== null) {
            $input['purchasedate'] = $request['purchasedate'];
        }
        if ($request['notes'] !== null) {
            $input['notes'] = $request['notes'];
        }


        if ($file = $request->file('document')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('documents', $name);
            DB::table('documents')->insert(
                ['asset_id' => $asset->id, 'path' => $name, 'name' => $request['documentname']]
            );
        }


        if ($file = $request->file('photo')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('photos', $name);

            DB::table('photos')->insert(
                ['asset_id' => $asset->id, 'path' => $name]
            );
        }



        $currency = Currency::all();
        $asset->update($input);
        $assetusage = Assetusage::all();
        $assettypes = Assettype::all();
        $partners = Partner::where('user_id', Auth::user()->id)->get();




        //return view('asset.edit',compact('asset','status','assettypes','assetusage','partners','currency'));

        return redirect()->back()->with('message', Lang::get('add.msgsavedasset'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asset $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);

        $contracts = Contract::where('asset_id', $asset->id)->get();
        foreach ($contracts as $contract) {
            $path = '/contracts/' . $contract->path;
            if (isset($contract->path)) {
                unlink(public_path() . $path);
            }
            $contract->delete();
        }

        $documents = Document::where('asset_id', $asset->id)->get();
        foreach ($documents as $document) {
            $path = '/documents/' . $document->path;
            if (isset($document->path)) {
                unlink(public_path() . $path);
            }
            $document->delete();
        }

        $photos = Document::where('asset_id', $asset->id)->get();
        foreach ($photos as $photo) {
            $path = '/photos/' . $photo->path;
            if (isset($photo->path)) {
                unlink(public_path() . $path);
            }
            $photo->delete();
        }



        $asset->delete();

        Session::flash('message', Lang::get('add.msgdeleted'));
        Session::flash('alert-class', 'alert-danger');

        $allassets = Asset::where('user_id', Auth::user()->id)->get();

        //return view('asset.index', compact('allassets'));
        return redirect()->back();
    }



    public function addcontract(Request $request, $id)
    {

        $this->validate(
            $request,
            [

            'name' => 'required',
            'document' => '|max:10000|mimes:png,jpg,jpeg,pdf,doc,docx',

            ]
        );



        if ($file = $request->file('document')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('contracts', $name);
            $request['path'] = $name;
        }

        $request['asset_id'] = $id;
        $request['agreedon'] = strToTime($request['agreedon']);
        $request['termination'] = strToTime($request['termination']);

        $contract = Contract::create($request->all());

        $partner_id = $request['partner_id'];

        $assetpartner = DB::table('contract_partner')->insert(['contract_id' => $contract->id, 'partner_id' => $partner_id]);

        $currency = Currency::all();
        $asset = Asset::findOrFail($id);
        $assetusage = Assetusage::all();
        $assettypes = Assettype::all();
        $partners = Partner::where('user_id', Auth::user()->id)->get();

        //return view('asset.edit',compact('asset','assettypes','assetusage','partners','currency'));

        return redirect()->back()->with('message', Lang::get('add.msgsavedasset'));
    }



    public function changecontract(Request $request, $id)
    {
        if ($file = $request->file('document')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('contracts', $name);
        }


        if (isset($name)) {
            $request['path'] = $name;
        }




        if ($request['name'] !== null) {
            $input['name'] = $request['name'];
        }

        if ($request['value'] !== null) {
            $input['value'] = $request['value'];
        }

        if ($request['agreedon'] !== null) {
            $input['agreedon'] = strToTime($request['agreedon']);
        }

        if ($request['storedlocation'] !== null) {
            $input['storedlocation'] = $request['storedlocation'];
        }
        if ($request['termination'] !== null) {
            $input['termination'] = strToTime($request['termination']);
        }

        if ($request['reminderreg'] !== null) {
            $input['reminderreg'] = $request['reminderreg'];
        }
        if ($request['reminderterm'] !== null) {
            $input['reminderterm'] = $request['reminderterm'];
        }
        if ($request['partner'] !== null) {
            $input['partner_id'] = $request['partner'];
        }
        if ($request['partner'] == '0') {
            DB::table('contract_partner')->where('contract_id', $id)->delete();
        }
        if ($request['partner'] !== '0') {
            DB::table('contract_partner')->where('contract_id', $id)->delete();

            DB::table('contract_partner')->insert(['contract_id' => $id, 'partner_id' => $request['partner']]);
        }

        $asset_id = $request['asset_id'];


        $contract = Contract::findOrFail($id)->update($input);


        $currency = Currency::all();
        $partners = Partner::all();
        $asset = Asset::findOrFail($asset_id);
        $assetusage = Assetusage::all();
        $assettypes = Assettype::all();

        return view('asset.edit', compact('asset', 'assettypes', 'assetusage', 'partners', 'currency'))->with('message', Lang::get('add.msgsavedasset'));
        ;
    }

    public function deletecontract($id)
    {
        $contract = Contract::findOrFail($id);
        $contractpath = "/contracts/" . $contract->path;
        unlink(public_path() . $contractpath);
        //Storage::delete(public_path('/contracts/'.$contract->path));
        $contract->delete();


        return back()->with('message', Lang::get('add.msgsavedasset'));
        ;
    }

    public function deletephoto($id)
    {
        $photo = Photo::findOrFail($id);
        $photopath = "/photos/" . $photo->path;
        //dd($try);
        unlink(public_path() . $photopath);
        //Storage::delete(public_path('/photos/'.$photo->path));
        $photo->delete();



        return back()->with('message', Lang::get('add.msgsavedasset'));
    }

    public function deletedocument($id)
    {
        $document = Document::findOrFail($id);
        $documentpath = "/documents/" . $document->path;
        unlink(public_path() . $documentpath);
        //Storage::delete(public_path('/documents/'.$document->path));
        $document->delete();

        return back()->with('message', Lang::get('add.msgdeletet'));
    }
}
