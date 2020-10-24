<?php

declare(strict_types=1);

namespace MarsRover\Services\LineParser;

use MarsRover\Exception\InvalidRowFormatException;
use function preg_match;
use function sprintf;
use function str_split;

/**
 * Class ActionsLineParser
 */
final class ActionsLineParser implements LineParserInterface
{
    /**
     * @param string $line
     *
     * @return array
     */
    public function parse(string $line): array
    {
        if (!preg_match('/^[LRM]+$/', $line)) {
            throw new InvalidRowFormatException(sprintf('Invalid actions row passed: "%s"', $line));
        }

        return str_split($line, 1);
    }
}
