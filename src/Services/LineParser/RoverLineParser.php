<?php

declare(strict_types=1);

namespace MarsRover\Services\LineParser;

use MarsRover\Exception\InvalidRowFormatException;
use function explode;
use function preg_match;
use function sprintf;

/**
 * Class RoverLineParser
 */
final class RoverLineParser implements LineParserInterface
{
    /**
     * @param string $line
     *
     * @return array
     */
    public function parse(string $line): array
    {
        if (!preg_match('/^\d+\s\d+\s[NESW]$/', $line)) {
            throw new InvalidRowFormatException(sprintf('Invalid Rover position row passed: "%s"', $line));
        }

        [$x, $y, $orientation] = explode(' ', $line);
        $x = (int) $x;
        $y = (int) $y;

        return [$x, $y, $orientation];
    }
}
