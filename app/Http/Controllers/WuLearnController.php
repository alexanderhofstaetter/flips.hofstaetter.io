<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;


class WuLearnController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function load_data(Request $request) {
        $user = $request->user();
        $result = $user->wulearn()->load_data();
        flash('Die Lehrveranstaltungen und Noten wurden aktualisiert.')->success();
        return redirect()->route('dashboard');
    }


    public function load_meta(Request $request) {
        $user = $request->user();
        $result = $user->wulearn()->load_meta();
        flash('Die Informationen wurden aktualisiert.')->success();
        return redirect()->route('dashboard');
    }

    public function load_exams(Request $request) {
        $user = $request->user();
        $result = $user->wulearn()->load_exams();
        flash('Die Daten der Prüfungseinsicht wurden aktualisiert.')->success();
        return redirect()->route('dashboard');
    }

    public function verify(Request $request) {
        $user = $request->user();
        $result = $user->wulearn()->verify();
        if ($result == true)
            flash('Die Verbindung zu Learn@WU wurde erfolgreich hergestellt. Die eingegebenen Logindaten sind gültig.')->success();
        else
            flash('Es konnte keine Verbindung zu Learn@WU hergestellt werden. Bitte überprüfen Sie Ihre Logindaten.')->warning();
        return redirect()->route('dashboard');
    }
}