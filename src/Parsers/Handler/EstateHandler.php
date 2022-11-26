<?php
declare(strict_types=1);

namespace AppParsers\Parsers\Handler;

use AppParsers\Parsers\Estate\Page;
use AppParsers\Parsers\Estate\PaginationInterface;
use AppParsers\Parsers\Result\SaveToJson;


class EstateHandler implements BaseHandler
{

    public function process(PaginationInterface $pagination): void
    {
        $paginationList = $pagination->parserPagination();
        $parserEstate = new Page();
        $parserEstate->regitsterCallback([new SaveToJson(), 'save']);
        foreach ($paginationList as $item) {
            $parserEstate->getAndParsePage($item);
        }
    }

}