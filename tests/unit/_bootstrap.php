<?php
// Here you can initialize variables that will be available to your tests

// require_once __DIR__.'/stubs/Facades.php';

$package = \Codeception\Configuration::projectDir();

\Package::load('dependency', $package);
