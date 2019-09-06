<?php

namespace App;

use App\Lv;
use App\News;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserWuLpis
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function load_data() {
        $api = new WuLpisApi( $this->user );
        $api->call("infos");
        $data = $api->data['pp'];
        foreach ($data as $key => $entry) {
            $planobject = $this->user->planobjects()->updateOrCreate(
                ['internal_id' => $key], 
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
}