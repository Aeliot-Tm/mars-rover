<?php

declare(strict_types=1);

/**
 * Class Autoloader
 *
 * @deprecated
 */
final class Autoloader
{
    /**
     * @var string[]
     */
    private $directories;

    /**
     * Autoloader constructor.
     *
     * @param string[] $directories
     */
    public function __construct(array $directories)
    {
        $this->directories = $directories;
    }

    /**
     * @param string $className
     *
     * @return void
     */
    public function load(string $className): void
    {
        $file = str_replace('\\', DIRECTORY_SEPARATOR, substr($className, 10));
        foreach ($this->directories as $directory) {
            $path = "$directory/$file.php";
            if (file_exists($path)) {
                require_once $path;
            }
        }
    }
}
