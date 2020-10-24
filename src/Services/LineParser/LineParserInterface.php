<?php

declare(strict_types=1);

namespace MarsRover\Services\LineParser;

/**
 * Interface LineParserInterface
 */
interface LineParserInterface
{
    /**
     * @param string $line
     *
     * @return array
     */
    public function parse(string $line): array;
}
