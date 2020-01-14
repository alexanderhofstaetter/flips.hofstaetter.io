<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;


class WuLpisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function load_data(Request $request, User $user) {
        $result = $user->wulpis()->load_data();
        flash('Die Studienplanpunkte (aus LPIS) wurden aktualisiert.')->success();
        return back();
    }
}