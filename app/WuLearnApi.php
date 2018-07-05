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
    private $path = 'apis/wu-learn-api.py';

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function verify() {
        $mode = "verify";
        $result = $this->call($mode);
        if ($result != '1') {
            flash('Es konnte keine Verbindung zu Learn@WU hergestellt werden. Bitte überprüfen Sie Ihre Logindaten.')->warning();
            $this->log("error", $mode);
            return false;
        }
        return true;
    }

    public function call($mode) {
        $username = $this->user->wulogin;
        $password = $this->user->wupassword;
        
        // Demo Mode: Get from local JSON cache (FILE)
        // return json_decode(file_get_contents(base_path("apis/wu-learn-api-$mode.json")), true);
 
        $cred_file = tempnam(sys_get_temp_dir(), hash('md5', serialize([$username, $password, rand()])));
        touch ($cred_file); chmod($cred_file, 0600);
        file_put_contents($cred_file, "username=$username\npassword=$password");
        
        $script = base_path($this->path);
        $process = new Process("python $script --credfile=$cred_file --mode=$mode");

        // run process and then delete credentials file
        $process->run();
        file_put_contents($cred_file, ''); unlink($cred_file); 

        if (!$process->isSuccessful()) {
            $this->log("error", $mode);
            throw new ProcessFailedException($process);
        }
        $this->log("success", $mode);
        return json_decode($process->getOutput(), true);
    }

    private function log($status, $mode) {
        $this->user->activities()->create([
            'identifier' => $this->identifier,
            'status' => $status,
            'event' => $mode
        ]);
    }
}