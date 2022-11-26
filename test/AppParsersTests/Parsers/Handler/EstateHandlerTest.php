<?php
declare(strict_types=1);

namespace tests\Parsers\Handler;

use AppParsers\Parsers\Handler\EstateHandler;
use AppParsersTests\Parsers\Estate\Pagination;
use PHPUnit\Framework\TestCase;

class EstateHandlerTest extends TestCase
{
    private EstateHandler $parser;

    protected function setUp(): void
    {
        $this->parser = new EstateHandler();
        $this->paginationList = new Pagination();
    }

    public function testBaseHandler()
    {
        $this->parser->process($this->paginationList);
        $this->assertTrue(true);
    }
}