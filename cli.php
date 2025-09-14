<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/cli/SchemaValidator.php';
require_once __DIR__ . '/app/cli/NovelManager.php';

$f3 = \Base::instance();

// Set up F3 for CLI environment
$f3->set('DEBUG', 3);
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define CLI commands
if ($f3->get('CLI')) {
    // Example: php cli.php validate:series-meta
    $f3->route('GET @cli_validate_series_meta: /validate:series-meta', function($f3) {
        $validator = new \App\Cli\SchemaValidator($f3);
        $validator->validateSeriesMeta();
    });

    // Command to create a new novel
    $f3->route('GET @cli_create_novel: /create:novel', function($f3) {
        $novelManager = new \App\Cli\NovelManager($f3);
        $novelManager->createNovel();
    });

    // Command to watch series_meta.json for changes and validate
    $f3->route('GET @cli_watch_series_meta: /watch:series-meta', function($f3) {
        $validator = new \App\Cli\SchemaValidator($f3);
        $validator->watchSeriesMeta();
    });

    // Add other CLI commands here
    // $f3->route('GET @cli_some_other_command: /some:command', 'App\Cli\SomeOtherCliClass->someMethod');

    // Dispatch the CLI command
    $f3->run();
} else {
    echo "This script can only be run from the command line.\n";
}

