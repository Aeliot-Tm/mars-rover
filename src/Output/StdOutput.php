<?php

declare(strict_types=1);

namespace MarsRover\Output;

use const PHP_EOL;

/**
 * Class StdOutput
 */
final class StdOutput implements OutputInterface
{
    /**
     * @param string $line
     *
     * @return void
     */
    public function writeLine(string $line): void
    {
        echo $line.PHP_EOL;
    }
}
