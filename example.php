<?php

use AppParsers\Parsers\Estate\Page;
use AppParsers\Parsers\Estate\Pagination;
use AppParsers\Parsers\Handler\EstateHandler;
use AppParsers\Parsers\Result\SaveToJson;


$pagination = new Pagination('https://turk.estate/en/');
$estateParser = new EstateHandler();
$estateParser->process($pagination);

// or

$pagination = new Pagination('https://turk.estate/en/');
$parserEstate = new Page();
$parserEstate->regitsterCallback([new SaveToJson(), 'save']);

$paginationList = $pagination->parserPagination();
foreach ($paginationList as $item) {
    $parserEstate->getAndParsePage($item);
}