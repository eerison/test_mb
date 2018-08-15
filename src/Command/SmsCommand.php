<?php
/**
 * Created by PhpStorm.
 * User: erison
 * Date: 8/15/18
 * Time: 5:23 PM
 */

namespace App\Command;


use App\Service\NotificationService;

class SmsCommand
{
    public static function dispatch(NotificationService $notificationService)
    {
        $notificationService->dispatchSms();
    }
}