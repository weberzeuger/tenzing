<?php
// Single entry point to the application

call_user_func(static function () {
    $basedir = dirname(__DIR__);

    // Auto-load classes and libraries (see "composer.json" file)
    require $basedir . '/vendor/autoload.php';

    // Launch the application
    $application = new \ManhattanReview\Tenzing\Core\Bootstrap($basedir);
    $application->run();
});
