<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Browser\Casper;
use Carbon\Carbon;

class Flips extends Model
{
    private $url = 'https://lpis.wu.ac.at/lpis/';
    private $timeout = 20000;
    private $useragent = 'Mozilla';

    private $casper = null;

    protected $fillable = [
        'url_scraped', 'cookies',
    ];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        
        $this->casper = new Casper();
        $this->casper->setOptions([  
            'verbose'                   =>  'false', 
            'logLevel'                  =>  'warning',
            'waitTimeout'               =>  $this->timeout,
            'pageSettings.loadImages'   =>  'false',
            'pageSettings.loadPlugins'  =>  'false',
            'pageSettings.userAgent'    =>  $this->useragent
        ]);
    }

    public function init($force = false)
    {
        if (!($this->url_scraped != '' && 
            $this->cookies != '' && 
            $this->matrikelnummer == $this->user()->matrikelnummer && 
            $this->updated_at >= Carbon::now()->subMinutes(9) &&
            $this->casper != null &&
            $force == false)
        ) {
            if( ! $this->login() )
                return false;
        }
        $this->casper->setCookies($this->cookies);
        return true;
    }

    private function login() {

        $this->casper->start($this->url);
        $this->casper->waitForSelector('form#login');
        $this->casper->fillFormSelectors(
            'form#login',
            array(
                'input[accesskey="u"]'  =>  $this->user()->matrikelnummer,
                'input[accesskey="p"]'  =>  $this->user()->wupassword
            ),true
        );
        $this->casper->waitForSelector('form#ea_stupl');
        $this->casper->capturePage(storage_path('flips/init.png'));
        $this->casper->run();

        $url = $this->casper->getCurrentUrl();
        $url = substr($url, 0, strrpos( $url, '/')+1);
        $this->url_scraped = $url;
        $this->matrikelnummer = $this->user()->matrikelnummer;
        $this->cookies = json_encode($this->casper->getCookies());
        $this->casper->capturePage(storage_path('flips/init.png'));
        $this->update();
        return true;
    }

    public function getStudienAbschnitte() {
        $this->casper->setCookies($this->cookies);
        $this->init();

        $url = $this->url_scraped . 'EA';
        $this->casper->start($url);
        $this->casper->waitForSelector('form#ea_stupl');
        $this->casper->capturePage(storage_path('flips/studienabschnitte.png'));
        $this->casper->run();

        $result = $this->casper->getHTML();

        $this->update();
        return true;
    }


    public function getFaecher() {
        $this->casper->setCookies($this->cookies);
        $this->init();

        $url = $this->url_scraped . 'EA';
        $this->casper->start($url);
        $this->casper->waitForSelector('form#ea_stupl');

        $this->casper->click('form#ea_stupl input:last-child');
        $this->casper->waitForSelector('.b3k-data');
        $this->casper->capturePage(storage_path('flips/faecher.png'));
        $this->casper->run();

        $result = $this->casper->getHTML();

        $this->update();
        return true;
    }



    public function getVeranstaltungen($aspp, $spp) {
        $this->init();

        $sh = substr($aspp, strpos( $aspp, '_')+1);
        $a = '';
        $url = $this->url_scraped . 'DLVO' . '?'.'ASPP='.$aspp.';'.'SPP='.$spp.';'.'A='.$a.';'.'SH='.$sh.';';

        $this->casper->start($url);
        $this->casper->waitForSelector('.b3k-data');
        $this->casper->capturePage(storage_path('flips/veranstaltungen.png'));
        $this->casper->run();

        $result = $this->casper->getHTML();

        dd($this->casper->getOutput());

        $this->update();
        return true;
    }



    public function user()
    {
        return $this->belongsTo('App\User')->first();
    }
    
}