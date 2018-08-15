<?php

namespace App\Tests\Service;

use App\Service\NotificationService;
use MessageBird\Client;
use PHPUnit\Framework\TestCase;

class NotificationServiceTest extends TestCase
{
    public function testPrepareText()
    {
        $messagerBird = $this->createMock(Client::class);
        $notificationService = new NotificationService($messagerBird);
        $this->assertEquals('Hello phpunit.', $notificationService->prepareText('Hello phpunit.'));
        $this->assertEquals('aeiouaeiouaeiouaoc', $notificationService->prepareText('áéíóúàèìòùâêîôûãõç'));
        $this->assertEquals('AEIOUAEIOUAEIOUAOC', $notificationService->prepareText('ÁÉÍÓÚÀÈÌÒÙÂÊÎÔÛÃÕÇ'));

    }
}