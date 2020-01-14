<?php

namespace App;

use App\Lv;
use App\News;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserWuLearn
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get_loginpayload() {
        $api = new WuLearnApi( $this->user );
        $api->call("loginpayload");
        return $api->data;
    }

    public function load_data() {
        $api = new WuLearnApi( $this->user );
        $api->call("grades");
        $data = $api->data;
        foreach ($data as $key => $entry) {
            $lv = $this->user->lvs()->updateOrCreate(
                ['key' => $key], 
                $entry
            );
            if (array_key_exists("grades", $entry) ) {
                foreach ($entry["grades"] as $g) {
                    $g["user_id"] = $this->user->id;
                    $grade = $lv->grades()->updateOrCreate(
                        ['title' => $g["title"], 'lv_id' => $lv->id], 
                        $g
                    );
                }
            }
        }
        return true;
    }

    public function load_news() {
        $api = new WuLearnApi( $this->user );
        $api->call("news");
        $data = $api->data;
        foreach ($data as $entry) {
            $lv = Lv::where('key', $entry['lv'])->first();
            if( !$lv ) {
                $this->load_data();
                $lv = Lv::where('key', $entry['lv'])->first();
            }
            $news = $lv->news()->updateOrCreate(
                ['number' => $entry["number"]], 
                $entry
            );
        }
        return true;
    }

    public function load_meta() {
        $api = new WuLearnApi( $this->user );
        $api->call("meta");
        $data = $api->data;
        $this->user->update($data);
        return true;
    }

    public function load_exams() {
        $api = new WuLearnApi( $this->user );
        $api->call("exams");
        $data = $api->data;
        foreach ($data as $entry) {
            $filename = hash("md5", "Einsicht-" . $this->user->wulogin . '-' . $entry["number"]) . '.pdf';
            $entry['file'] = $filename;
            Storage::put($filename, base64_decode($entry["pdf"]));
            $exam = $this->user->exams()->updateOrCreate(
                ['number' => $entry["number"]], 
                $entry
            );
        }
        return true;
    }

    public function verify() {
        $api = new WuLearnApi($this->user);
        $api->call("verify");
        return $api->status['logged_in'];
    }
}