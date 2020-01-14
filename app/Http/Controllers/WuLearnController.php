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

    public function load_data(Request $request, User $user) {
        $result = $user->wulearn()->load_data();
        flash('Die Lehrveranstaltungen und Noten wurden aktualisiert.')->success();
        return back();
    }

    public function load_meta(Request $request, User $user) {
        $result = $user->wulearn()->load_meta();
        flash('Daten wurden aktualisiert.')->success();
        return back();
    }

    public function load_exams(Request $request, User $user) {
        $result = $user->wulearn()->load_exams();
        flash('Die Daten der Prüfungseinsicht wurden aktualisiert.')->success();
        return back();
    }

    public function load_news(Request $request, User $user) {
        $result = $user->wulearn()->load_news();
        flash('Die Ankündigungen wurden aktualisiert.')->success();
        return back();
    }

    public function verify(Request $request, User $user) {
        $result = $user->wulearn()->verify();
        if ($result == true)
            flash('Die Verbindung zu Learn@WU wurde erfolgreich hergestellt. Die eingegebenen Logindaten sind gültig.')->success();
        else
            flash('Es konnte keine Verbindung zu Learn@WU hergestellt werden. Bitte überprüfen Sie Ihre Logindaten.')->error();
        return back();
    }

    public function open(Request $request, User $user, $url) {
        $payload = $user->wulearn()->get_loginpayload();
        
        $url = substr($url, strrpos($url, ".ac.at") + strlen(".ac.at"));
        $url = str_replace("%3D", "=", $url);
        $url = str_replace("%3F", "?", $url);
        $payload['url'] = $url;

        return view('openlearn')->with([
            'payload' => $payload,
            'user' => $user
        ]);
    }
}