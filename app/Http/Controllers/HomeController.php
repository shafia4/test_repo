<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Asset;
use App\User;
use App\Currency;
use App\Inhereracess;
use App\Liability;
use App\Inherer;
use Illuminate\Support\Facades\DB;
use App\Contract;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    }

    public function dashboard()
    {

        //Berechnung des totalen Vermögens

        $assetvalue = 0;
        foreach (Auth::user()->asset as $userasset) {
            if ($userasset->currency_id == Auth::user()->currency_id) {
                $assetvalue = $assetvalue + $userasset->value;
            } else {
                $assetvalue = $assetvalue + $userasset->value * $userasset->currency->tolead / Auth::user()->currency->tolead;
            }
        };

        $assetvalue = number_format($assetvalue, 0, 0, '');


        //Schulden
        $liabvalue = 0;
        foreach (Auth::user()->liability as $userliability) {
            if ($userliability->currency_id == Auth::user()->currency_id) {
                $liabvalue = $liabvalue + $userliability->currentvalue;
            } else {
                $liabvalue = $liabvalue + $userliability->currentvalue * $userliability->currency->tolead / Auth::user()->currency->tolead;
            }
        }
        $liabvalue = number_format($liabvalue, 0, 0, '');



        //Wertvollstes Asset

        $values = array();

        foreach (Auth::user()->asset as $userasset) {
            if ($userasset->currency_id == Auth::user()->currency_id) {
                $values[$userasset->id] = $userasset->value;
            } else {
                $values[$userasset->id] = $userasset->value * $userasset->currency['tolead'];
            }
        }



        if (count($values) != 0) {
            $keyassetid = array_keys($values, max($values));
            $keyasset = Asset::findOrFail($keyassetid);
        } else {
            $value = 0;
            $keyassetid = 0;
        }

        //Wertvollste Schulden

        $valuesl = array();

        foreach (Auth::user()->liability as $userliability) {
            if ($userliability->currency_id == Auth::user()->currency_id) {
                $valuesl[$userliability->id] = $userliability->currentvalue;
            } else {
                $valuesl[$userliability->id] = $userliability->currentvalue * $userliability->currency['tolead'];
            }
        }



        if (($valuesl) != []) {
            $keyliabid = array_keys($valuesl, max($valuesl));
            $keyliab = Liability::findOrFail($keyliabid);
        } else {
            $valuel = 0;
            $keyliabid = 0;
        }



        //zuletz hinzugefügtes Asset
        $lastasset = Asset::where('user_id', Auth::user()->id)->get();
        $lastasset = $lastasset->sortBy('updated_at')->last();

        $lastliab = Liability::where('user_id', Auth::user()->id)->get();
        $lastliab = $lastliab->sortBy('updated_at')->last();


        // hat wer von den Erben zugegriffen??

        $inhereracessed = Inhereracess::where('user_id', Auth::user()->id)->get();



        //erinnerung für assetclassen

        $cashid = DB::table('assettypes')->where('name', 'assettype.cash')->first();
		$cash = '';
        if (!empty($cashid)) {
            $cash = Auth::user()->asset->where('assettype_id', '=', $cashid->id);
        }

        // nächste Erinnerung

        $userassets = Auth::user()->asset;
        foreach ($userassets as $userasset) {
            foreach ($userasset->contract as $userassetcontract) {
                $reminder = $userassetcontract;
            }
        }

        //$reminder=asort($reminder);
        // $nextreminder=$userassetcontract;



        // $nextreminder=array_filter($reminder, function ($v) {

        //           return $v > 0;
        //         });
        // $nextreminder=array_filter($nextreminder);

        // if(($nextreminder)!=[]){
        // $nextreminder=min($nextreminder);
        // $keycontractid = array_search($nextreminder, $reminder);
        // $keycontract=Contract::findOrFail($keycontractid);};

        //mehrere Vertragserinnerungen einbauen


        //letztes Currency update:
        $currencyupdate = Currency::orderBy('updated_at', 'desc')->first();

        //passives Einkommen
        $userassets = Auth::user()->asset;
        $income = 0;
        foreach ($userassets as $userasset) {
            if ($userasset->currency->id == Auth::user()->currency_id) {
                if ($userasset->revenue) {
                    $income = $income + $userasset->revenue - $userasset->costs;
                } else {
                    $income = $income + $userasset->value * $userasset->interest / 100;
                }
            } else {
                if ($userasset->revenue) {
                    $income = ($income + $userasset->revenue - $userasset->costs) * $userasset->currency->tolead / Auth::user()->currency->tolead;
                } else {
                    $income = $income + ($userasset->value * $userasset->interest / 100) * $userasset->currency->tolead / Auth::user()->currency->tolead;
                }
            }
        }


        //durchschnittliche Zinsen
        $userliabs = Auth::user()->liability;
        $userinterest = 0;
        foreach ($userliabs as $userliab) {
            if ($userliab->currency->id == Auth::user()->currency_id) {
                $userinterest = $userinterest + (($userliab->interest * $userliab->currentvalue) / 100);
            } else {
                $userinterest = $userinterest + ((($userliab->interest * $userliab->currentvalue) * $userliab->currency->tolead / Auth::user()->currency->tolead) / 100);
            }
        }

        //summe pro Assetart für Graph
        $assetclasses = Auth::user()->asset->groupBy('assettype_id')->all();

        //color piechart
        $color = [
            'rgba(11,156,59, 0.2)',
            'rgba(240, 52, 52, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(236, 81, 81, 0.2)',
            'rgba(236, 137, 81, 0.2)',
            'rgba(236, 207, 81, 0.2)',
            'rgba(195, 216, 100, 0.2)',
            'rgba(79, 171, 43, 0.2)',
            'rgba(102, 229, 210, 0.2)',
            'rgba(102, 166, 229, 0.2)',
            'rgba(159, 102, 229, 0.2)',
            'rgba(229, 102, 214, 0.2)',
            'rgba(229, 102, 132, 0.2)',
            'rgba(254, 251, 252, 0.2)',
            'rgba(105, 56, 220, 0.2)',
        ];


        $bordercolor = [
            'rgba(11,156,59, 1)',
            'rgba(240, 52, 52, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(236, 81, 81, 1)',
            'rgba(236, 137, 81, 1)',
            'rgba(236, 207, 81, 1)',
            'rgba(195, 216, 100, 1)',
            'rgba(79, 171, 43, 1)',
            'rgba(102, 229, 210, 1)',
            'rgba(102, 166, 229, 1)',
            'rgba(159, 102, 229, 1)',
            'rgba(229, 102, 214, 1)',
            'rgba(229, 102, 132, 1)',
            'rgba(254, 251, 252, 1)',
            'rgba(105, 56, 220, 1)',


        ];



        $dayofmonth = date("d");
        $contracts = Contract::where('reminderreg', $dayofmonth)->whereNotNull('asset_id')->get();






        return view('home', compact('values', 'valuesl', 'keyasset', 'keyliab', 'keyliabid', 'lastasset', 'nextreminder', 'keycontract', 'income', 'assetvalue', 'liabvalue', 'contracts', 'cash', 'lastliab', 'keyassetid', 'inhereracessed', 'accessinguser', 'howmanyacessed', 'assetclasses', 'color', 'bordercolor', 'currencyupdate', 'userinterest'));
    }


    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate(
            [
                'current-password' => 'required',
                'new-password' => 'required|string|min:6|confirmed',
            ]
        );
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
