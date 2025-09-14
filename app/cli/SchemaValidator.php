<?php

namespace App\Cli;

use Base;
use Opis\JsonSchema\Validator;

class SchemaValidator
{
    protected $f3;

    public function __construct(Base $f3)
    {
        $this->f3 = $f3;
    }

    public function validateSeriesMeta(): void
    {
        echo "\n--- Validating series_meta.json ---\n";

        $series_meta_path = $this->f3->get('ROOT') . $this->f3->get('BASE') . '/cerita/series_meta.json';
        $schema_path = $this->f3->get('ROOT') . $this->f3->get('BASE') . '/novel_data/schemas/series_meta_schema.json';

        if (!file_exists($series_meta_path)) {
            echo "Error: series_meta.json not found at {$series_meta_path}\n";
            return;
        }

        if (!file_exists($schema_path)) {
            echo "Error: series_meta_schema.json not found at {$schema_path}\n";
            return;
        }

        $series_meta_content = file_get_contents($series_meta_path);
        $schema_content = file_get_contents($schema_path);

        $series_meta_data = json_decode($series_meta_content);
        $schema_data = json_decode($schema_content);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Error: Invalid JSON in series_meta.json: " . json_last_error_msg() . "\n";
            return;
        }

        $validator = new Validator();
        $result = $validator->validate($series_meta_data, $schema_data);

        if ($result->isValid()) {
            echo "Validation successful: series_meta.json is valid!\n";
        } else {
            echo "Validation failed for series_meta.json:\n";
            echo (string)$result . "\n"; // Use (string)$result to get error details
        }
        echo "\n-----------------------------------\n";
    }

    public function watchSeriesMeta(): void
    {
        echo "\n--- Watching series_meta.json for changes ---\n";
        echo "Press Ctrl+C to stop.\n";

        $series_meta_path = $this->f3->get('ROOT') . $this->f3->get('BASE') . '/cerita/series_meta.json';
        $schema_path = $this->f3->get('ROOT') . $this->f3->get('BASE') . '/novel_data/schemas/series_meta_schema.json';

        if (!file_exists($series_meta_path)) {
            echo "Error: series_meta.json not found at {$series_meta_path}\n";
            return;
        }

        if (!file_exists($schema_path)) {
            echo "Error: series_meta_schema.json not found at {$schema_path}\n";
            return;
        }

        $last_modified_time = filemtime($series_meta_path);
        echo "Initial validation:\n";
        $this->validateSeriesMeta();

        while (true) {
            clearstatcache(); // Clear file stat cache
            $current_modified_time = filemtime($series_meta_path);

            if ($current_modified_time !== $last_modified_time) {
                echo "\n--- Change detected! Re-validating... ---\n";
                $this->validateSeriesMeta();
                $last_modified_time = $current_modified_time;
            }
            sleep(2); // Check every 2 seconds
        }
    }
}
