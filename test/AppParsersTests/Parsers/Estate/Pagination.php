<?php
declare(strict_types=1);

namespace AppParsersTests\Parsers\Estate;

use AppParsers\Parsers\Estate\PaginationInterface;
use AppParsersTests\Curl\CurlTest;


class Pagination implements PaginationInterface
{
    public function parserPagination(): array
    {
        return [
            CurlTest::EN
        ];
    }
}