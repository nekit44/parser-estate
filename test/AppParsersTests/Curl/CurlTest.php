<?php
declare(strict_types=1);

namespace AppParsersTests\Curl;

use Curl\Curl as BaseCurl;

class CurlTest extends BaseCurl
{
    const RU = 'https://turk.estate/real-estate/o60907/';
    const EN = 'https://turk.estate/en/real-estate/o60907/';

    public $error = true;
    public $response = null;


    public function get($url, $data = [])
    {
        if ($url == self::RU) {
            $this->error = false;
            $this->response = file_get_contents(__DIR__ . '/example.html');
        } elseif ($url == self::EN) {
            $this->error = false;
            $this->response = file_get_contents(__DIR__ . '/example-en.html');
        }
    }

}