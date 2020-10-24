<?php

declare(strict_types=1);

namespace MarsRover\Input;

use function fgets;
use function trim;

/**
 * Class StdInputReader
 */
final class StdInputReader implements LinesReaderInterface
{
    /**
     * @return iterable
     */
    public function getLines(): iterable
    {
        while ($buffer = fgets(STDIN)) {
            yield trim($buffer);
        }
    }
}
