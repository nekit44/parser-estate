<?php
declare(strict_types=1);

namespace AppParsersTests\Parsers\Estate;

use AppParsers\Parsers\Estate\Page;
use AppParsers\Parsers\Result\SaveToJson;
use AppParsersTests\Curl\CurlTest;
use AppParsersTests\Result\SaveToSpace;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    private Page $parser;

    protected function setUp(): void
    {
        $this->parser = new Page(new CurlTest());
        $this->parser->regitsterCallback([new SaveToSpace(), 'save']);
    }

    public function testParserPage()
    {
        $this->parser->getAndParsePage(CurlTest::EN);
        $this->assertTrue(true);
    }

}