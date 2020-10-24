<?php

declare(strict_types=1);

use MarsRover\Core\Application;

require_once __DIR__.'/app/bootstrap.php';

$appKernel = new AppKernel();
$application = new Application($appKernel);
$application->run();
