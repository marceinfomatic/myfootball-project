<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class FootballController extends Controller
{
    public $config;
    public $baseUri;
    public $reqPrefs = array();
        
    public function __construct() {
        $this->config = parse_ini_file('../config.ini', true);

	// some lame hint for the impatient
	if($this->config['authToken'] == 'YOUR_AUTH_TOKEN' || !isset($this->config['authToken'])) {
		exit('Get your API-Key first and edit config.ini');
	}
        
        $this->baseUri = $this->config['baseUri']; 
        
        $this->reqPrefs['http']['method'] = 'GET';
        $this->reqPrefs['http']['header'] = 'X-Auth-Token: ' . $this->config['authToken'];
    }

    public function index () {

        $resource = 'matches';

        $response = file_get_contents($this->baseUri . $resource, false, 
                                      stream_context_create($this->reqPrefs));
        
        return json_decode($response);
    }
}
