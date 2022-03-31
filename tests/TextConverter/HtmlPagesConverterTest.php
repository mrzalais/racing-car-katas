<?php

declare(strict_types=1);

namespace Tests\TextConverter;

use PHPUnit\Framework\TestCase;
use RacingCar\TextConverter\HtmlPagesConverter;
use RacingCar\TextConverter\Exceptions\FileNotFoundException;
use RacingCar\TextConverter\Exceptions\LineNotFoundException;

class HtmlPagesConverterTest extends TestCase
{
    private string $pathToTextFile;

    public function setUp(): void
    {
        $this->pathToTextFile = __DIR__ . '/html.txt';
        parent::setUp();
    }

    public function testItReturnsCorrectPathToFile(): void
    {
        $converter = new HtmlPagesConverter($this->pathToTextFile);
        $this->assertSame($this->pathToTextFile, $converter->getFileName());
    }

    /**
     * @throws FileNotFoundException| LineNotFoundException
     */
    public function testItConvertsTextToPages(): void
    {
        $converter = new HtmlPagesConverter($this->pathToTextFile);
        $this->assertSame(
            'Lorem ipsum dolor sit amet,<br />consectetur adipiscing elit,<br />sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<br />',
            $converter->getHtmlPage()
        );
    }

    /**
     * @throws FileNotFoundException
     */
    public function testItThrowsExceptionIfProvidedFilePathIsInvalid(): void
    {
        $this->expectException(FileNotFoundException::class);
        new HtmlPagesConverter('invalid');
    }
}
