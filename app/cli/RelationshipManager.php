<?php

namespace App\Cli;

class RelationshipManager {

    protected $characterDataPath;
    protected $relationshipTypes;

    public function __construct() {
        $f3 = \Base::instance();
        $this->characterDataPath = $f3->get('ROOT') . 'novel_data/characters/';

        $relationshipTypesPath = $f3->get('ROOT') . 'novel_data/relationship_types.json';
        if (file_exists($relationshipTypesPath)) {
            $this->relationshipTypes = json_decode(file_get_contents($relationshipTypesPath), true);
        } else {
            $this->relationshipTypes = [];
            error_log("Warning: novel_data/relationship_types.json not found. Relationship type validation will be skipped.");
        }
    }

    private function characterExists($charId) {
        return file_exists($this->characterDataPath . $charId . '.json');
    }

    private function isValidRelationshipType($type) {
        return isset($this->relationshipTypes[$type]) && is_array($this->relationshipTypes[$type]) && isset($this->relationshipTypes[$type]['description']);
    }

    private function addSingleRelationship($sourceCharId, $targetCharId, $type, $description) {
        $filePath = $this->characterDataPath . $sourceCharId . '.json';
        $content = file_get_contents($filePath);
        $character = json_decode($content, true);

        if (!isset($character['Relationships'])) {
            $character['Relationships'] = [];
        }

        // Check if relationship already exists to prevent duplicates
        foreach ($character['Relationships'] as $rel) {
            if ($rel['TargetID'] === $targetCharId && $rel['Type'] === $type) {
                return false; // Relationship already exists
            }
        }

        $newRelationship = [
            'TargetID' => $targetCharId,
            'Type' => $type,
            'Description' => $description
        ];

        $character['Relationships'][] = $newRelationship;

        file_put_contents($filePath, json_encode($character, JSON_PRETTY_PRINT));
        return true;
    }

    private function removeSingleRelationship($sourceCharId, $targetCharId, $type) {
        $filePath = $this->characterDataPath . $sourceCharId . '.json';
        $content = file_get_contents($filePath);
        $character = json_decode($content, true);

        if (!isset($character['Relationships'])) {
            return false;
        }

        $initial_count = count($character['Relationships']);
        $character['Relationships'] = array_filter($character['Relationships'], function($rel) use ($targetCharId, $type) {
            return !($rel['TargetID'] === $targetCharId && $rel['Type'] === $type);
        });

        if (count($character['Relationships']) < $initial_count) {
            file_put_contents($filePath, json_encode($character, JSON_PRETTY_PRINT));
            return true;
        }
        return false;
    }

    public function help() {
        echo "Usage:\n";
        echo "  php index.php relationship list                       - List all characters and their IDs.\n";
        echo "  php index.php relationship add <charId> <targetId> <type> <description> - Add a relationship.\n";
        echo "  php index.php relationship remove <charId> <targetId> <type> - Remove a relationship.\n";
        echo "  php index.php relationship edit <charId> <targetId> <oldType> <newType> <newDescription> - Edit a relationship.\n";
        echo "  php index.php relationship show <charId>              - Show all relationships for a character.\n";
        echo "  php index.php relationship show <charId> <targetId>   - Show relationship between two characters.\n";
    }

    public function list() {
        echo "Listing all characters:\n";
        $files = scandir($this->characterDataPath);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $charId = pathinfo($file, PATHINFO_FILENAME);
                echo "- " . $charId . "\n";
            }
        }
    }

    public function add($f3, $params) {
        if (count($params) < 4) {
            echo "Error: Missing arguments for add command.\n";
            $this->help();
            return;
        }

        $charId = $params[0];
        $targetId = $params[1];
        $type = $params[2];
        $description = $params[3];

        if (!$this->characterExists($charId)) {
            echo "Error: Character '" . $charId . "' not found.\n";
            return;
        }
        if (!$this->characterExists($targetId)) {
            echo "Error: Target character '" . $targetId . "' not found.\n";
            return;
        }
        if (!empty($this->relationshipTypes) && !$this->isValidRelationshipType($type)) {
            echo "Error: Invalid relationship type '" . $type . "'. Please use one of the predefined types.\n";
            return;
        }

        // Add primary relationship (charId -> targetId)
        if ($this->addSingleRelationship($charId, $targetId, $type, $description)) {
            echo "Relationship added for '" . $charId . "' to '" . $targetId . "'.\n";
        } else {
            echo "Relationship already exists for '" . $charId . "' to '" . $targetId . "' with type '" . $type . "'.\n";
        }

        // Add inverse relationship (targetId -> charId)
        $inverseType = $this->relationshipTypes[$type]['inverse_type'] ?? $type;
        $inverseDescription = $this->relationshipTypes[$inverseType]['description'] ?? "Inverse relationship: " . $description;

        if ($this->addSingleRelationship($targetId, $charId, $inverseType, $inverseDescription)) {
            echo "Inverse relationship added for '" . $targetId . "' to '" . $charId . "'.\n";
        } else {
            echo "Inverse relationship already exists for '" . $targetId . "' to '" . $charId . "' with type '" . $inverseType . "'.\n";
        }
    }

    public function remove($f3, $params) {
        if (count($params) < 3) {
            echo "Error: Missing arguments for remove command.\n";
            $this->help();
            return;
        }

        $charId = $params[0];
        $targetId = $params[1];
        $type = $params[2];

        if (!$this->characterExists($charId)) {
            echo "Error: Character '" . $charId . "' not found.\n";
            return;
        }
        if (!$this->characterExists($targetId)) {
            echo "Error: Target character '" . $targetId . "' not found.\n";
            return;
        }

        // Remove primary relationship (charId -> targetId)
        if ($this->removeSingleRelationship($charId, $targetId, $type)) {
            echo "Relationship removed for '" . $charId . "' to '" . $targetId . "'.\n";
        } else {
            echo "Relationship not found for '" . $charId . "' to '" . $targetId . "' with type '" . $type . "'.\n";
        }

        // Remove inverse relationship (targetId -> charId)
        $inverseType = $this->relationshipTypes[$type]['inverse_type'] ?? $type;
        if ($this->removeSingleRelationship($targetId, $charId, $inverseType)) {
            echo "Inverse relationship removed for '" . $targetId . "' to '" . $charId . "'.\n";
        } else {
            echo "Inverse relationship not found for '" . $targetId . "' to '" . $charId . "' with type '" . $inverseType . "'.\n";
        }
    }

    public function edit($f3, $params) {
        if (count($params) < 5) {
            echo "Error: Missing arguments for edit command.\n";
            $this->help();
            return;
        }

        $charId = $params[0];
        $targetId = $params[1];
        $oldType = $params[2];
        $newType = $params[3];
        $newDescription = $params[4];

        if (!$this->characterExists($charId)) {
            echo "Error: Character '" . $charId . "' not found.\n";
            return;
        }
        if (!$this->characterExists($targetId)) {
            echo "Error: Target character '" . $targetId . "' not found.\n";
            return;
        }
        if (!empty($this->relationshipTypes) && !$this->isValidRelationshipType($newType)) {
            echo "Error: Invalid new relationship type '" . $newType . "'. Please use one of the predefined types.\n";
            return;
        }

        $filePath = $this->characterDataPath . $charId . '.json';
        $content = file_get_contents($filePath);
        $character = json_decode($content, true);

        if (!isset($character['Relationships'])) {
            echo "No relationships found for '" . $charId . "'.\n";
            return;
        }

        $found = false;
        foreach ($character['Relationships'] as &$rel) {
            if ($rel['TargetID'] === $targetId && $rel['Type'] === $oldType) {
                $rel['Type'] = $newType;
                $rel['Description'] = $newDescription;
                $found = true;
                break;
            }
        }

        if ($found) {
            file_put_contents($filePath, json_encode($character, JSON_PRETTY_PRINT));
            echo "Relationship updated for '" . $charId . "'.\n";
        }
        // Also update the inverse relationship if it exists
        $inverseOldType = $this->relationshipTypes[$oldType]['inverse_type'] ?? $oldType;
        $inverseNewType = $this->relationshipTypes[$newType]['inverse_type'] ?? $newType;
        $inverseNewDescription = $this->relationshipTypes[$inverseNewType]['description'] ?? "Inverse relationship: " . $newDescription;

        $targetFilePath = $this->characterDataPath . $targetId . '.json';
        $targetContent = file_get_contents($targetFilePath);
        $targetCharacter = json_decode($targetContent, true);

        if (isset($targetCharacter['Relationships'])) {
            foreach ($targetCharacter['Relationships'] as &$rel) {
                if ($rel['TargetID'] === $charId && $rel['Type'] === $inverseOldType) {
                    $rel['Type'] = $inverseNewType;
                    $rel['Description'] = $inverseNewDescription;
                    file_put_contents($targetFilePath, json_encode($targetCharacter, JSON_PRETTY_PRINT));
                    echo "Inverse relationship updated for '" . $targetId . "' to '" . $charId . "'.\n";
                    break;
                }
            }
        }

        if (!$found) {
            echo "Relationship not found for '" . $charId . "' with target '" . $targetId . "' and type '" . $oldType . "'.\n";
        }
    }

    public function show($f3, $params) {
        if (count($params) < 1) {
            echo "Error: Missing arguments for show command.\n";
            $this->help();
            return;
        }

        $charId = $params[0];

        if (!$this->characterExists($charId)) {
            echo "Error: Character '" . $charId . "' not found.\n";
            return;
        }

        $filePath = $this->characterDataPath . $charId . '.json';
        $content = file_get_contents($filePath);
        $character = json_decode($content, true);

        if (!isset($character['Relationships']) || empty($character['Relationships'])) {
            echo "No relationships found for '" . $charId . "'.\n";
            return;
        }

        echo "Relationships for '" . $character['Name'] . "' (ID: " . $charId . "):\n";

        if (count($params) === 1) {
            // Show all relationships for charId
            foreach ($character['Relationships'] as $rel) {
                $targetName = $this->getCharacterNameById($rel['TargetID']);
                echo "- Type: " . $rel['Type'] . ", Target: " . ($targetName ? $targetName . " (ID: " . $rel['TargetID'] . ")" : $rel['TargetID']) . ", Description: " . ($rel['Description'] ?? 'N/A') . "\n";
            }
        } elseif (count($params) === 2) {
            // Show specific relationship between charId and targetId
            $targetId = $params[1];
            if (!$this->characterExists($targetId)) {
                echo "Error: Target character '" . $targetId . "' not found.\n";
                return;
            }

            $found = false;
            foreach ($character['Relationships'] as $rel) {
                if ($rel['TargetID'] === $targetId) {
                    $targetName = $this->getCharacterNameById($rel['TargetID']);
                    echo "Relationship between '" . $character['Name'] . "' and '" . ($targetName ? $targetName . " (ID: " . $rel['TargetID'] . ")" : $rel['TargetID']) . "':\n";
                    echo "- Type: " . $rel['Type'] . ", Description: " . ($rel['Description'] ?? 'N/A') . "\n";
                    $found = true;
                }
            }
            if (!$found) {
                echo "No direct relationship found between '" . $charId . "' and '" . $targetId . "'.\n";
            }
        }
    }

    private function getCharacterNameById($charId) {
        $filePath = $this->characterDataPath . $charId . '.json';
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            $character = json_decode($content, true);
            return $character['Name'] ?? null;
        }
        return null;
    }
}
