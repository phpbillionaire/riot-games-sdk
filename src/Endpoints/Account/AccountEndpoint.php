<?php
namespace RiotGamesPHP\Endpoints\Account;
use RiotGamesPHP\Api\{ApiHandlerInterface};
use RiotGamesPHP\Endpoints\Account\DTO\AccountDto;

final class AccountEndpoint implements AccountEndpointInterface
{
    private ApiHandlerInterface $apiHandler;
    public function __construct(ApiHandlerInterface $apiHandler)
    {
        $this->apiHandler = $apiHandler;
    }
    public function getData(string $name, string $tag): AccountDto
    {
        $data = $this->apiHandler->request(endpoint: "/riot/account/v1/accounts/by-riot-id/{$name}/{$tag}");
        return new AccountDto($data["puuid"], $data["gameName"], $data["tagLine"]);
    }
}