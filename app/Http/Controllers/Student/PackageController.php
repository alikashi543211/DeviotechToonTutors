<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\SubscribePlan;

class PackageController extends Controller
{
    public function packages()
    {
        $packages = Package::all();
        return view('student.packages', get_defined_vars());
    }

    public function packagePayment($id = null)
    {
        session()->forget('package_id');

        $package = Package::find($id);
        return view('student.package_payment', get_defined_vars());
    }

    public function purchase(Request $req)
    {
        $amount = Package::find($req->id)->total_amount;
        $hours = Package::find($req->id)->hours;
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        try
        {
            $charge = \Stripe\Charge::create(array(
                "amount" => $amount * 100,
                "currency" => "usd",
                "description" => "Package Purcahse",
                "source" => $req->stripeToken,
            ));

            if ($charge) {
                SubscribePlan::where('user_id', auth()->user()->id)->update([
                    'status' => 'disabled',
                ]);
                $subscribe_plan = SubscribePlan::create([
                    'user_id' => auth()->user()->id,
                    'card_holder_name' => $req->name,
                    'total_hour' => $hours,
                    'remaining_hour' => $hours,
                    'amount' => $amount,
                    'package_id' => $req->id,
                ]);
            }

            return redirect()->route('student.dashboard')->with('success', 'You have successfully purchase package');
        }
        catch(\Stripe\Error\Card $e)
        {
            $error = $e->getMessage();
            return redirect()->route('student.packages')->with('error', $error);
        }
        catch(\Stripe\Error\InvalidRequest $e)
        {
            $error = $e->getMessage();
            return redirect()->route('student.packages')->with('error', $error);
        }
    }
}
