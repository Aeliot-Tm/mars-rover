<?php

declare(strict_types=1);

namespace MarsRover\Test\Listener;

use DG\BypassFinals;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Util\Test as TestUtil;
use function method_exists;
use function preg_match;

/**
 * Class BypassFinalsListener
 *
 * For support phpunit 6
 */
final class BypassFinalsListener implements TestListener
{
    use TestListenerDefaultImplementation;

    /**
     * @var string
     */
    private $testPattern;

    /**
     * @param string $testPattern
     */
    public function __construct(string $testPattern)
    {
        $this->testPattern = $testPattern;
    }

    /**
     * @param Test $test
     *
     * @return void
     */
    public function startTest(Test $test): void
    {
        $describeCallback = [
            TestUtil::class,
            method_exists(TestUtil::class, 'describeAsString') ? 'describeAsString' : 'describe',
        ];

        if (preg_match($this->testPattern, $describeCallback($test))) {
            BypassFinals::enable();
        }
    }
}
