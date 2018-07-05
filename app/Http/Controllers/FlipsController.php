<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flips;

class FlipsController extends Controller
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

    public function init(Request $request) {
        $user = $request->user();
        $force = false;
        if ($request->query('force') == '1')
            $force = true;       
        $user->flips->init($force);
        return redirect()->route('dashboard');
    }

    public function studienabschnitte(Request $request) {
        $user = $request->user();
        $user->flips->getStudienAbschnitte();
        return redirect()->route('dashboard');
    }

}