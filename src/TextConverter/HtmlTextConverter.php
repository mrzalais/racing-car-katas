<?php

declare(strict_types=1);

namespace RacingCar\TextConverter;

use RacingCar\TextConverter\Exceptions\FileNotFoundException;

class HtmlTextConverter
{
    private string $fullFileNameWithPath;

    public function __construct(string $fullFileNameWithPath)
    {
        $this->fullFileNameWithPath = $fullFileNameWithPath;
    }

    /**
     * @throws FileNotFoundException
     */
    public function convertToHtml(): string
    {
        if (!file_exists($this->fullFileNameWithPath)) {
            throw new FileNotFoundException();
        }

        $file = fopen($this->fullFileNameWithPath, 'r');

        if ($file === false) {
            throw new FileNotFoundException();
        }

        $html = '';
        while (($line = fgets($file)) !== false) {
            $line = rtrim($line);
            $html .= htmlspecialchars($line, ENT_QUOTES | ENT_HTML5);
            $html .= '<br />';
        }
        return $html;
    }

    public function getFileNameWithPath(): string
    {
        return $this->fullFileNameWithPath;
    }
}
