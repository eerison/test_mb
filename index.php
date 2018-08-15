<?php

include 'vendor/autoload.php';

$messageBird = new \MessageBird\Client(App\Config\MB_ACESS_KEY);
$notificationService = new \App\Service\NotificationService($messageBird);

\App\Controller\SmsController::sendAction($notificationService);