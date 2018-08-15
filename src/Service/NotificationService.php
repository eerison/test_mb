<?php
namespace App\Service;

use MessageBird\Client;

class NotificationService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $phoneNumber
     * @param string $text
     * @return bool
     * @throws \MessageBird\Exceptions\HttpException
     * @throws \MessageBird\Exceptions\RequestException
     * @throws \MessageBird\Exceptions\ServerException
     */
    public function SendSms(string $phoneNumber, string $text) : bool
    {
        $object = [
            'recipients' => $phoneNumber,
            'originator' => 'MessageBird',
            'body' => $text,

        ];
        $this->client->messages->create($object);
    }
}