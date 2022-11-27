<?php
declare(strict_types=1);

namespace AppParsers\Parsers\Estate;

use Curl\Curl;
use DiDom\Document;


class Pagination implements PaginationInterface
{
    private Curl $curl;
    private string $baseDomain;

    const PATH_FOR_START = 'real-estate/';

    public function __construct(string $baseDomain, Curl $curl = new Curl())
    {
        $this->curl = $curl;
        $this->baseDomain = $baseDomain;
    }

    /**
     * @return array
     * @throws \DiDom\Exceptions\InvalidSelectorException
     */
    public function parserPagination(): array
    {
        $this->curl->get($this->baseDomain . self::PATH_FOR_START);
        $document = new Document($this->curl->response);
        $url_page_pagination = [];

        $max_pagination_html = $document->find('ul.pagination > li > a');
        $max = [];
        foreach ($max_pagination_html as $item)
            $max[] = (int)$item->text();
        $max = max($max);


        for ($i = 1; $i <= $max; $i++) {
            $this->curl->get("{$this->baseDomain}real-estate/page/{$i}/#objects");
            if (!$this->curl->error) {
                $document = new Document($this->curl->response);
                $ul_html = $document->find('#objects > div.objects-list.switchable.listview > ul > li');
                foreach ($ul_html as $item_li) {
                    $url_page_pagination[] = $item_li->first('.title > a')->attr('href');
                }
            }
        }
        return $url_page_pagination;
    }

}