<?php
require_once __DIR__ . "/../vendor/autoload.php";

// Api Handler that will handle the data from requests
use RiotGamesPHP\Api\ApiHandler;
// This is config which will be responsible for your desired Region/Route
use RiotGamesPHP\Config\Config;
// HTTP Client by Guzzle that will process requests to endpoints
use GuzzleHttp\Client;
// Here's our first endpoint (https://developer.riotgames.com/apis#account-v1)
use RiotGamesPHP\Endpoints\Account\AccountEndpoint;

// Initializing HTTP Client, project is based on Dependency Injection.
$http = new Client();

/**
* Riot Games have global routes (americas, europe, asia, etc.) and local routes (euw1, na1, eune1, etc.)
* You can make one route for each, place them in one file and require.
* To look up when to use global route and when local read their API Documentation for each endpoint.
* How it looks: https://{$this->config->getRegion()}.api.riotgames.com/
*/
$route = new Config(region: "americas");

/**
* Now we're going to create Api that we'll go the job.
* You can also make api for each route, place it in one file and require.
*/
$americasApi = new ApiHandler(config: $route, httpClient: $http);

/**
* Creating our first endpoint access for ACCOUNT-V1 (https://developer.riotgames.com/apis#account-v1)
* As a parameter we'll need to pass our Api Handler with the access to required route.
*/
$accountEndpoint = new AccountEndpoint(apiHandler: $americasApi);

/**
* The easiest way to retrieve user's PUUID is to use username + tagline
* Endpoint: /riot/account/v1/accounts/by-riot-id/{gameName}/{tagLine}
* Let's make our first variable that will hold user's data.
* @return AccountDto
*/
$account = $accountEndpoint->getData(name: "Sushee", tag: "NA1");

/**
* Now we have the data.
*/
$puuid = $account->getPuuid();
$gameName = $account->getGameName();
$tagLine = $account->getTagLine();

var_dump($puuid, $gameName, $tagLine);
// Same with others endpoints, enjoy!