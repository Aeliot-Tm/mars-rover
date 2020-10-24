<?php

declare(strict_types=1);

namespace MarsRover\Core;

use AppKernel;
use MarsRover\Output\OutputInterface;
use MarsRover\Output\StdOutput;
use MarsRover\Services\RoverWalker;

/**
 * Class Application
 */
final class Application
{
    /**
     * @var AppKernel
     */
    private $appKernel;

    /**
     * Application constructor.
     *
     * @param AppKernel $appKernel
     */
    public function __construct(AppKernel $appKernel)
    {
        $this->appKernel = $appKernel;
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $container = $this->appKernel->getContainer();
        /** @var RoverWalker $roverWalker */
        $roverWalker = $container->getService(RoverWalker::class);
        /** @var OutputInterface $output */
        $output = $container->getService(StdOutput::class);
        $roverWalker->run($output);
    }
}
