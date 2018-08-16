<?php

include 'vendor/autoload.php';

$messageBird = new \MessageBird\Client('');
$notificationService = new \App\Service\NotificationService($messageBird);

if (isset($_SERVER['SERVER_PROTOCOL'])) {
   \App\Controller\SmsController::sendAction($notificationService);
} else {
    \App\Command\SmsCommand::dispatch($notificationService);
}
