<?php
declare(strict_types=1);

namespace AppParsers\Parsers\Estate;

use AppParsers\Entities\FeaturesEntity;
use AppParsers\Entities\MapEntity;
use AppParsers\Entities\ObjectEntity;
use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;



class Page extends Parser
{
    /**
     * @param $document
     * @return ObjectEntity
     * @throws InvalidSelectorException
     */
    public function parser($html): ObjectEntity
    {
        $document = new Document($html);
        $objectEntity = new ObjectEntity();
        if ($name = $document->first('div.main-holder > div.container.object > h1'))
            $objectEntity->setName($name->text());
        if ($id = $document->first('div.price > span.id'))
            $id = str_replace('ID', '', $id->text());
        $objectEntity->setObjectNumber($id);
        $item_url = $document->first('link[rel="canonical"]')->attr('href');
        $objectEntity->setObjectSlug($this->slug($item_url));
        if ($compSlug = $document->first('div.params > div.complex > span.name > a'))
            $objectEntity->setComplexSlug($this->slug($compSlug->attr('href')));
        if ($city = $document->first('div.params > div.city > span.value'))
            $objectEntity->setCity($city->text());
        if ($type = $document->first('div.params > div.tip > span.value'))
            $objectEntity->setType($type->text());
        if ($rooms = $document->first('div.params > div.rooms > span.value'))
            $objectEntity->setRooms($rooms->text());
        if ($livingSpace = $document->first('div.params > div.square > span.value')) {
            $liv = $livingSpace->html();
            $liv = strip_tags(str_replace('<br>', '-', $liv));
            $objectEntity->setLivingSpace($liv);
        }
        if ($compDate = $document->first('div.params > div.finish > span.value'))
            $objectEntity->setCompletionDate($compDate->text());
        if ($price = $document->first('meta[itemprop="price"]'))
            $objectEntity->setPrice($price->attr('content'));
        $objectEntity->setCurrency('€');
        if ($img_html = $document->find(' div.scroll > ul > li > img')) {
            $img_arr = $this->getImage($img_html);
            $objectEntity->setImages($img_arr);
        }
        if ($features = $document->find('div.page_content > div.features')) {
            foreach ($features as $feature) {
                $name = $feature->first('h3')->text();
                $values = $feature->find('ul > li');
                $arr = [];
                foreach ($values as $value) {
                    $arr[] = $value->text();
                }
                $objectEntity->setFeatures(new FeaturesEntity($name, $arr));
            }
        }
        $nav = $document->first('div.navigation_wrapper > ul > li:nth-child(2)');
        if ($nav){
            $objectEntity->setMapCoords($this->getMapParams($nav->attr('onclick')));
        }

        return $objectEntity;
    }


    /**
     * @param string $url
     * @return void
     * @throws InvalidSelectorException
     */
    public function getAndParsePage(string $url): void
    {
        $this->curl->get($url);
        if (!$this->curl->error) {
            $page = $this->parser($this->curl->response);
            $page->setDescription($this->parseRu($url, false));
            foreach ($this->callbacks as $callback) {
                call_user_func($callback, $page);
            }
        }
    }

    /**
     * @param array $images_html
     * @return array
     */
    private function getImage(array $images_html): array
    {
        $img_arr = [];
        if (!empty($images_html))
            foreach ($images_html as $image)
                $img_arr[] = str_replace('_480x320', '', $image->attr('src'));
        return $img_arr;
    }

    private function parseRu(string $url, $return_html = true): string
    {
        $ruUrl = str_replace('en/', '', $url);
        $this->curl->get($ruUrl);
        if (!$this->curl->error) {
            $document = new Document($this->curl->response);
            if ($desk = $document->first('.article[itemprop="description"]'))
                return $return_html ? $desk->html() : $desk->text();
        }

        return '';
    }

    private function getMapParams($nav): MapEntity
    {
        $lat = null;
        $lng = null;
        $str = str_replace(['toggleObjectPanorama(true,',')'],'',$nav);
        $exp = explode(',', $str);
        if (isset($exp[1])){
          list($lat, $lng) = $exp;
        }
       return new MapEntity($lat, $lng);
    }
}