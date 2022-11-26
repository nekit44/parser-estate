<?php

namespace AppParsers\Parsers\Handler;

use AppParsers\Parsers\Estate\PaginationInterface;

interface BaseHandler
{
    public function process(PaginationInterface $pagination): void;
}