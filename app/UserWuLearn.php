<?php

namespace App;

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

    public function load_data() {
        $api = new WuLearnApi( $this->user );
        if ($api->verify()) {
            $data = $api->call("data");
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
        }
        return true;
    }


    public function load_meta() {
        $api = new WuLearnApi( $this->user );
        if ($api->verify()) {
            $data = $api->call("meta");
            $this->user->update($data);
        }
        return true;
    }

    public function load_webview() {
        $api = new WuLearnApi( $this->user );
        if ($api->verify()) {
            $data = $api->call("webview");

            foreach ($data as $entry) {
                $filename = hash("md5", "Einsicht-" . $this->user->wulogin . '-' . $entry["exam_id"]) . '.pdf';
                $entry['file'] = $filename;
                Storage::put($filename, base64_decode($entry["pdf"]));
                $exam = $this->user->exams()->updateOrCreate(
                    ['exam_id' => $entry["exam_id"]], 
                    $entry
                );
            }
        }
        return true;
    }

    public function verify() {
        $api = new WuLearnApi( $this->user );
        $api->verify();
        return true;
    }
}