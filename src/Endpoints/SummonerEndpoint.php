<?php

namespace src\Endpoints;
use src\Interfaces\ApiHandlerInterface;
class SummonerEndpoint
{
    private ApiHandlerInterface $apiHandler;
    public function __construct(ApiHandlerInterface $apiHandler)
    {
        $this->apiHandler = $apiHandler;
    }
    public function getData(string $puuid): array
    {
        return $this->apiHandler->request(endpoint: "/lol/summoner/v4/summoners/by-puuid/{$puuid}");
    }
}