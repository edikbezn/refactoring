<?php

use Symfony\Component\Console\Input\ArgvInput;

require_once __DIR__ . "/vendor/autoload.php";

$input = new ArgvInput();
$fileName = $input->getFirstArgument();

(new App($fileName, __DIR__))->run();