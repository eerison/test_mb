<?php
namespace App\Service;

use MessageBird\Client;
use MessageBird\Objects\Message;

class NotificationService
{
    private $client;
    private const DIR_NAME_FILES_SMS = './DBSms/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function SendSms($object): Message
    {
        return $this->client->messages->create($object);
    }

    public function addListSms(string $phoneNumber, string $text) {
        $text = $this->prepareText($text);

        $split = str_split($text, 160);

        $object = '';

        foreach ($split as $smallText)
        {
            $object .= json_encode([
                'recipients' => $phoneNumber,
                'originator' => 'MessageBird',
                'body' => $smallText,
            ]).PHP_EOL;
        }

        $path = sprintf('%ssms_%d_%d.json', self::DIR_NAME_FILES_SMS ,time(), rand(1,999));
        $file = fopen($path, "a");
        fwrite($file, $object);
        fclose($file);
    }

    public function prepareText(string $text): string
    {
        $special = [
            'á', 'é', 'í', 'ó', 'ú', 'à', 'è', 'ì', 'ò', 'ù', 'â', 'ê', 'î', 'ô', 'û', 'ã','õ', 'ç',
            'Á', 'É', 'Í', 'Ó', 'Ú', 'À', 'È', 'Ì', 'Ò', 'Ù', 'Â', 'Ê', 'Î', 'Ô', 'Û', 'Ã','Õ', 'Ç',
        ];

        $normal = [
            'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a','o', 'c',
            'A', 'E', 'I', 'O', 'U', 'A', 'E', 'I', 'O', 'U','A', 'E', 'I', 'O', 'U', 'A','O', 'C',
        ];

        $text = str_replace($special, $normal, $text);
        return $text;
    }

    public function dispatchSms()
    {
        while (true) {

            [$filename] = scandir(self::DIR_NAME_FILES_SMS, 1);

            if (in_array($filename,['.', '..'])) {
                sleep(2);
                continue;
            }

            $path = self::DIR_NAME_FILES_SMS.$filename;
            $file = fopen($path, "r");

            while (($line = fgets($file)) !== false) {
                print_r(json_decode($line));
                $this->SendSms(json_decode($line));
                sleep(2);
            }

            fclose($file);
            unlink($path);
        }
    }
}