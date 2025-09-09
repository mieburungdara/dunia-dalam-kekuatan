<?php

class CharacterHelper
{
    /**
     * @var array|null Cache for character data for a single request.
     */
    private static $characters_data = null;

    /**
     * Get a character's name by their ID.
     *
     * @param string $id The ID of the character.
     * @return string The name of the character or "Karakter Tidak Dikenal".
     */
    public static function getCharacterNameById(string $id): string
    {
        // Load characters if not already loaded for this request
        if (self::$characters_data === null) {
            $f3 = Base::instance();
            $json_path = $f3->get('ROOT') . '/novel_data/CHARACTERS.json';
            
            if (file_exists($json_path)) {
                $json_content = file_get_contents($json_path);
                $data = json_decode($json_content, true);
                // Assuming the IDs are unique, let's key the array by ID for faster lookups
                self::$characters_data = array_column($data['characters'] ?? [], null, 'id');
            } else {
                // Handle case where file doesn't exist
                self::$characters_data = [];
            }
        }

        // Search for the character by id in our indexed array
        if (isset(self::$characters_data[$id])) {
            return self::$characters_data[$id]['nama'] ?? 'Nama Tidak Tersedia';
        }

        return 'Karakter Tidak Dikenal';
    }
}
