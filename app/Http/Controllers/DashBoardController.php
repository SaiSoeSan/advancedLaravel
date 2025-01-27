<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    /**
     * Provision a new web server.
     */
    public function __invoke()
    {
        switch (auth()->user()->role) {
            case 'instructor':
                return redirect()->route('instructor.dashboard');
                break;

            case 'member':
                return redirect()->route('member.dashboard');
                break;

            case 'admin':
                return redirect()->route('admin.dashboard');
                break;

            default:
                return redirect()->route('login');
                break;
        }
    }
}
