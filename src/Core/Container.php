<?php

declare(strict_types=1);

namespace MarsRover\Core;

use function array_key_exists;
use function array_values;

/**
 * Class Container
 */
final class Container
{
    /**
     * @var array
     */
    private $configuration;

    /**
     * @var object[]
     */
    private $services = [];

    /**
     * Container constructor.
     *
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param string $id
     *
     * @return object
     */
    public function getService(string $id): object
    {
        if (!array_key_exists($id, $this->services)) {
            $this->services[$id] = $this->createService($id);
        }

        return $this->services[$id];
    }

    /**
     * @param string $id
     *
     * @return object
     */
    private function createService(string $id): object
    {
        $config = $this->configuration[$id] ?? [];
        foreach ($config as $key => $dependencyId) {
            $config[$key] = $this->getService($dependencyId);
        }
        $dependencies = array_values($config);

        return new $id(...$dependencies);
    }
}
