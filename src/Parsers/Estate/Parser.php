<?php
declare(strict_types=1);

namespace AppParsers\Parsers\Estate;

use AppParsers\Entities\ObjectEntity;
use Curl\Curl;
use DiDom\Document;


abstract class Parser
{
    protected Curl $curl;
    protected $callbacks;

    public function __construct(Curl $curl = new Curl())
    {
        $this->curl = $curl;
        $this->curl->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36');
    }

    /**
     * @param string $item_url
     * @return string
     */
    public function slug(string $item_url): string
    {
        $parse_url = parse_url($item_url, PHP_URL_PATH);
        $explode = explode('/', $parse_url);
        $explode = array_filter($explode, function ($value) {
            return !empty($value);
        });
        $slug = end($explode);
        return $slug;
    }

    /**
     * @param Document $document
     * @return ObjectEntity
     */
    abstract function parser(Document $document): ObjectEntity;

    /**
     * @param string $url
     * @return void
     */
    abstract function getAndParsePage(string $url): void;

    /**
     * @param callable $callback
     * @return void
     * @throws \Exception
     */
    public function regitsterCallback(callable $callback)
    {
        if (!is_countable($callback)) {
            throw new \Exception('Send func is not callable');
        }
        $this->callbacks[] = $callback;
    }


}