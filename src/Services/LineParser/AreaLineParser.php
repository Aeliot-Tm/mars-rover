<?php

declare(strict_types=1);

namespace MarsRover\Services\LineParser;

use MarsRover\Exception\InvalidRowFormatException;
use function explode;
use function preg_match;
use function sprintf;

/**
 * Class AreaLineParser
 */
final class AreaLineParser implements LineParserInterface
{
    /**
     * @param string $line
     *
     * @return int[]
     */
    public function parse(string $line): array
    {
        if (!preg_match('/^\d+\s\d+$/', $line)) {
            throw new InvalidRowFormatException(sprintf('Invalid Area row passed: "%s"', $line));
        }

        [$x, $y] = explode(' ', $line);
        $x = (int) $x;
        $y = (int) $y;

        return [$x, $y];
    }
}
