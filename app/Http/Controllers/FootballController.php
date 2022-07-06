<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Manager\MatchManagerInterface;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FootballController extends Controller
{
    private MatchManagerInterface $matchManager;
    public $config;
    public $baseUri;
    public $reqPrefs = array();

    public function __construct(MatchManagerInterface $matchManager) {
        $this->matchManager = $matchManager;

        $this->config = parse_ini_file('../config.ini', true);

        // some lame hint for the impatient
        if($this->config['authToken'] == 'YOUR_AUTH_TOKEN' || !isset($this->config['authToken'])) {
            exit('Get your API-Key first and edit config.ini');
        }

        $this->baseUri = $this->config['baseUri'];

        $this->reqPrefs['http']['method'] = 'GET';
        $this->reqPrefs['http']['header'] = 'X-Auth-Token: ' . $this->config['authToken'];
    }

    public function index (): array {

        $resource = 'matches';

        $response = file_get_contents($this->baseUri . $resource, false,
                                      stream_context_create($this->reqPrefs));

        //return json_decode($response);
        return json_decode($response, true) ?? [];
    }

    public function getMatches(): JsonResponse
    {
        $response = $this->index();

        /** @var array $matches */
        $matches = $response['matches'];

        if (!empty($matches)) {
            $data = [];

            foreach ($matches as $match) {
                $data[] = [
                    'id' => $match['id'],
                    'utcDate' => Carbon::parse($match['utcDate'])->setTimezone('utc')->toDateTime(),
                    'status' => $match['status'],
                    'area' => json_encode($match['area']),
                    'competition' => json_encode($match['competition']),
                    'season' => json_encode($match['season']),
                    'homeTeam' => json_encode($match['homeTeam']),
                    'awayTeam' => json_encode($match['awayTeam']),
                    'score' => json_encode($match['score']),
                ];
            }

            $this->matchManager->createMultiple($data);
        }

        $matches = $this->matchManager->getAll(15);
        return response()->json($matches, Response::HTTP_OK);
    }
}
