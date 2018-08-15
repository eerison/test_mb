<?php

include 'vendor/autoload.php';

$messageBird = new \MessageBird\Client('J62dzFmRiFQDrJFAC9uSZLii0');
$notificationService = new \App\Service\NotificationService($messageBird);

if (isset($_SERVER['SERVER_PROTOCOL'])) {
    echo 1;
   \App\Controller\SmsController::sendAction($notificationService);
} else {
    \App\Command\SmsCommand::dispatch($notificationService);
}
