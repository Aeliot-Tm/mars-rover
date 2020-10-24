<?php

declare(strict_types=1);

namespace MarsRover\Output;

/**
 * Interface OutputInterface
 */
interface OutputInterface
{
    /**
     * @param string $line
     *
     * @return void
     */
    public function writeLine(string $line): void;
}
