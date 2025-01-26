<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->input('paymentMethod');

        $user->newSubscription('default', 'price_1QlYbW03SANrjQmS59icFnyD')
            ->create($paymentMethod);

        return redirect()->route('home')->with('success', 'Subskrypcja aktywowana!');
    }

    public function cancel(Request $request)
    {
        $user = $request->user();
        $user->subscription('default')->cancel();

        return redirect()->route('home')->with('success', 'Subskrypcja została anulowana.');
    }
}
