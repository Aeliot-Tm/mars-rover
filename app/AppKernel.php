<?php

declare(strict_types=1);

use MarsRover\Core\Container;

/**
 * Class AppKernel
 */
final class AppKernel
{
    /**
     * @var Container
     */
    private $container;

    /**
     * AppKernel constructor.
     */
    public function __construct()
    {
        $this->container = new Container($this->getServicesConfiguration());
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @return array
     */
    private function getServicesConfiguration(): array
    {
        return require __DIR__.'/config/services.php';
    }
}
