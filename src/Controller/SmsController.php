<?php
namespace App\Controller;

use App\Service\HttpResponse;
use App\Service\NotificationService;

class SmsController
{
    public static function sendAction(NotificationService $notificationService)
    {
        try {
            $number = $_POST['number'];
            $message = $_POST['message'];
            $notificationService->addListSms($number, $message);
            HttpResponse::json('test');
        } catch (\Exception $exception) {
            HttpResponse::json('Internal server error.', 500);
        }
    }
}