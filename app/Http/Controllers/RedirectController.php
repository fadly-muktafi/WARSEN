<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function __invoke()
    {
        $role = Auth::user()->role;

        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'waiter':
                return redirect()->route('waiter.dashboard');
            case 'kasir':
                return redirect()->route('kasir.dashboard');
            case 'owner':
                return redirect()->route('owner.dashboard');
            default:
                return redirect('/');
        }
    }
}