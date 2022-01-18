<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TutorProfile;
use App\Models\TutorPayout;
use App\Models\StripeTransfer;

class StripeConnectController extends Controller
{
    public function connectAccount($id = null)
    {
        $tutor = TutorProfile::where('user_id', $id)->first();

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try
        {
            $account = \Stripe\Account::create(array(
                'country' => 'US',
                'type' => 'express',
                'capabilities' => [
                    'card_payments' => [
                      'requested' => true,
                    ],
                    'transfers' => [
                      'requested' => true,
                    ],
                ]
            ));

            $tutor->stripe_account = $account->id;
            $tutor->save();
        }
        catch(\Stripe\Error\InvalidRequest $e)
        {
            dd($e->getMessage());
        }

        return redirect()->back()->with('success', 'Stripe Account is ready for Payments');
    }

    public function boarded($enc)
    {
        $user = auth()->user();
        if(md5(base64_encode($user->email.$user->id)) == $enc)
        {
            $tutor = $user->tutor_profile;
            $tutor->is_boarded = 1;
            $tutor->save();

            return redirect()->route('stripe.account');
        }

        return redirect()->route('tutor.payout')->with('error', 'Invalid Access');
    }

    public function goToStripe()
    {
        $user = auth()->user();
        $tutor = $user->tutor_profile;

        if($tutor->stripe_account)
        {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            if(!$tutor->is_boarded)
            {
                $account_link = \Stripe\AccountLink::create([
                  'account' => $tutor->stripe_account,
                  'refresh_url' => route('tutor.payout'),
                  #FOR EXPRESS
                  'return_url' => route('boarded', md5(base64_encode($user->email.$user->id))),
                  'type' => 'account_onboarding',
                ]);

                return redirect($account_link->url);
            }
            else
            {
                #FOR EXPRESS
                $account_link = \Stripe\Account::createLoginLink($tutor->stripe_account);
                return redirect($account_link->url);
            }
        }

        return redirect()->back()->with('error', 'Something Went Wrong!');
    }

    public function transfer($id = null)
    {
        $payout = TutorPayout::find($id);
        $tutor = TutorProfile::where('user_id',$payout->tutor_id)->first();
        $amount = $payout->amount * 100;

        $s = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try
        {
            $transfer = \Stripe\Transfer::create(array(
                "currency" => 'usd',
                "amount" => $amount,
                "destination" => $tutor->stripe_account,
                "transfer_group" => $tutor->id,
            ));

            if($transfer){
                StripeTransfer::create([
                    'stripe_transfer_id' => $transfer->id,
                    'amount' => $payout->amount,
                    'tutor_id' => $tutor->id,
                ]);

                $payout->status = "cleared";
                $payout->save();
            }
        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
        }

        return redirect()->back()->with('success', 'Amount Transfered Successfully');
    }
}
