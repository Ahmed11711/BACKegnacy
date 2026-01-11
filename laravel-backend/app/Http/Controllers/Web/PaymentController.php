<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->isAdmin()) {
            $payments = Payment::with('order')->latest()->paginate(15);
        } else {
            $payments = Payment::whereHas('order', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('order')->latest()->paginate(15);
        }
        
        return view('payments.index', compact('payments'));
    }

    /**
     * Display the specified payment.
     */
    public function show(Payment $payment)
    {
        $payment->load('order.user');
        
        return view('payments.show', compact('payment'));
    }
}
