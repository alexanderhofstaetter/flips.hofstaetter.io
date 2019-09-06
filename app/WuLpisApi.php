<?php

namespace App;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Http\Request;
use App\User;

class WuLpisApi
{
    private $user;
    private $identifier = 'wu-lpis-api';
    private $path = "apis/wu-lpis-api/api.py";
    private $sessiondir = "app/sessions/wulpisapi/";
    private $demoMode = true;

    public $status, $data;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function verify() {
        return true;
    }

    public function call($action, $additional_args = Null) {
        $username = $this->user->wulogin;
        $password = $this->user->wupassword;
        
        // Demo action: Get from local JSON cache (FILE)
        if ($this->demoMode) {
            $this->raw = file_get_contents(base_path("apis/wu-lpis-api/wu-lpis-api-$action.json"));
        }
        else {
            $cred_file = tempnam(sys_get_temp_dir(), hash('md5', serialize([$username, $password, rand()])));
            touch ($cred_file); chmod($cred_file, 0600);
            file_put_contents($cred_file, "username=$username\npassword=$password");
            
            $script = base_path($this->path);
            $sessiondir = storage_path($this->sessiondir);
            $process = new Process("python $script --action=$action --credfile=$cred_file --sessiondir=$sessiondir $additional_args");

            // run process and then delete credentials file
            $process->run();
            file_put_contents($cred_file, ''); unlink($cred_file); 

            if (!$process->isSuccessful()) {
                $this->log("error", $action);
                throw new ProcessFailedException($process);
            }
            $this->raw = $process->getOutput();
        }
        $this->log("success", $action);
        $this->data = json_decode($this->raw, true)["data"];
        $this->status = json_decode($this->raw, true)["status"];
    }

    private function log($status, $action) {
        $this->user->activities()->create([
            'identifier' => $this->identifier,
            'status' => $status,
            'event' => $action
        ]);
    }
}