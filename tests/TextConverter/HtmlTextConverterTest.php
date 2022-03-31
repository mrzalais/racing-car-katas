<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\HtmlTextConverter;

class HtmlTextConverterTest extends TestCase
{
    private string $pathToTextFile;

    public function setUp(): void
    {
        $this->pathToTextFile = __DIR__ . '/text.txt';
        parent::setUp();
    }

    public function testItReturnsCorrectPathToFile(): void
    {
        $converter = new HtmlTextConverter($this->pathToTextFile);
        $this->assertSame($this->pathToTextFile, $converter->getFileNameWithPath());
    }

    public function testItConvertsTextToHtml(): void
    {
        $converter = new HtmlTextConverter($this->pathToTextFile);

        $this->assertEquals(
            'Lorem ipsum dolor sit amet,<br />consectetur adipiscing elit,<br />sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br />',
            $converter->convertToHtml()
        );
    }
}
