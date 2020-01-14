<?php

namespace App;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use App\User;

class WuLearnApi
{
    private $user;
    private $identifier = 'wu-learn-api';
    private $path = "apis/wu-learn-api/api.py";
    private $sessiondir = "app/sessions/wulearnapi/";

    public $status, $data;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function call($action) {
        $username = $this->user->wulogin;
        $password = $this->user->wupassword;
        
        // Demo action: Get from local JSON cache (FILE)
        // return json_decode(file_get_contents(base_path("apis/wu-learn-api-$action.json")), true);
 
        $cred_file = tempnam(sys_get_temp_dir(), hash('md5', serialize([$username, $password, rand()])));
        touch ($cred_file); chmod($cred_file, 0600);
        file_put_contents($cred_file, "username=$username\npassword=$password");
        
        $script = base_path($this->path);
        $sessiondir = storage_path($this->sessiondir);
        $process = new Process("python $script --action=$action --credfile=$cred_file --sessiondir=$sessiondir");

        // run process and then delete credentials file
        $process->run();
        file_put_contents($cred_file, ''); unlink($cred_file); 

        if (!$process->isSuccessful()) {
            $this->log("error", $action);
            throw new ProcessFailedException($process);
        }
        $this->log("success", $action);
        $this->data = json_decode($process->getOutput(), true)["data"];
        $this->status = json_decode($process->getOutput(), true)["status"];
    }

    private function log($status, $action) {
        $this->user->activities()->create([
            'identifier' => $this->identifier,
            'status' => $status,
            'event' => $action
        ]);
    }
}