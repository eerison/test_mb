<?php
namespace App\Controller;

use App\Service\HttpResponse;
use App\Service\NotificationService;
use MessageBird\Exceptions\HttpException;

class SmsController
{
    public static function sendAction(NotificationService $notificationService)
    {
        try {
//            $notificationService->SendSms('+5585986894892', 'test message 2.');
            HttpResponse::json('test');
        } catch (HttpException $exception) {
            HttpResponse::json($exception->getMessage(), $exception->getCode());
        } catch (\Exception $exception) {
            HttpResponse::json('Internal server error.', 500);
        }
    }
}