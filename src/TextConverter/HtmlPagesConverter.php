<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

use RacingCar\TextConverter\Exceptions\FileNotFoundException;
use RacingCar\TextConverter\Exceptions\LineNotFoundException;

class HtmlPagesConverter
{
    private string $filename;

    private array $breaks;

    /**
     * @throws FileNotFoundException
     */
    public function __construct(string $filename)
    {
        if (!file_exists($filename)) {
            throw new FileNotFoundException();
        }

        $file = fopen($filename, 'r');

        if ($file === false) {
            throw new FileNotFoundException();
        }
        $this->filename = $filename;

        $this->breaks = [0];
        while (($line = fgets($file)) !== false) {
            $line = rtrim($line);
            if (str_contains($line, 'PAGE_BREAK')) {
                $pageBreakPosition = ftell($file);
                $this->breaks[] = ftell($file);
            }
        }
        $this->breaks[] = ftell($file);
        fclose($file);
    }

    /**
     * @throws FileNotFoundException|LineNotFoundException
     */
    public function getHtmlPage(int $page = 0): string
    {
        if (!file_exists($this->filename)) {
            throw new FileNotFoundException;
        }

        $file = fopen($this->filename, 'r');

        if ($file === false) {
            throw new FileNotFoundException;
        }

        $pageStart = $this->breaks[$page];
        $pageEnd = $this->breaks[$page + 1];
        fseek($file, $pageStart);
        $html = '';
        while (ftell($file) !== $pageEnd) {
            $lineFromFile = fgets($file);

            if (!$lineFromFile) {
                throw new LineNotFoundException;
            }

            $line = rtrim($lineFromFile);
            if (str_contains($line, 'PAGE_BREAK')) {
                break;
            }
            $html .= htmlspecialchars($line, ENT_QUOTES | ENT_HTML5);
            $html .= '<br />';
        }
        fclose($file);
        return $html;
    }

    public function getFileName(): string
    {
        return $this->filename;
    }
}
