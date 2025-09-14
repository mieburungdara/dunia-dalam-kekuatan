<?php

namespace App\Helpers;

use Base;

class SchemaLoader
{
    private static $schemas = [];

    public static function loadSchema(string $schemaName, Base $f3)
    {
        if (isset(self::$schemas[$schemaName])) {
            return self::$schemas[$schemaName];
        }

        $schema_path = $f3->get('ROOT') . $f3->get('BASE') . '/novel_data/schemas/' . $schemaName . '.json';

        if (!file_exists($schema_path)) {
            error_log("SchemaLoader: Schema file not found at " . $schema_path);
            return null;
        }

        $schema_content = file_get_contents($schema_path);
        $schema = json_decode($schema_content);

        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("SchemaLoader: JSON decode error for schema " . $schemaName . ": " . json_last_error_msg());
            return null;
        }

        self::$schemas[$schemaName] = $schema;
        return $schema;
    }
}
