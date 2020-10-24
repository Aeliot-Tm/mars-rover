<?php

declare(strict_types=1);

namespace MarsRover\Input;

/**
 * Interface LinesReaderInterface
 */
interface LinesReaderInterface
{
    /**
     * @return iterable
     */
    public function getLines(): iterable;
}
