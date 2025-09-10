<?php

// Load F3 if not already loaded (for CLI context)
if (!class_exists('Base')) {
    require_once __DIR__ . '/../../vendor/bcosca/fatfree-core/base.php';
    $f3 = Base::instance();
    $f3->set('ROOT', __DIR__ . '/../..');
    $f3->set('AUTOLOAD', $f3->get('ROOT') . '/app/controllers/;' . $f3->get('ROOT') . '/app/helpers/;' . $f3->get('ROOT') . '/app/cli/');
    $f3->set('DEBUG', 3);
}

class ConsistencyChecker {

    protected $f3;
    protected $novelDataPath;
    protected $allCharactersData; // Cache for all character data
    protected $allItemNames; // Cache for all item names
    protected $allLocationNames; // Cache for all location names

    public function __construct() {
        $this->f3 = Base::instance();
        $this->novelDataPath = $this->f3->get('ROOT') . '/novel_data/';
    }

    public function runChecks() {
        echo "Memulai pemeriksaan konsistensi data novel...\n";
        $this->allCharactersData = $this->loadAllCharacters(); // Load all characters once
        $this->allLocationNames = $this->loadAllLocations(); // Load all locations once

        $this->checkCharacterSkills();
        $this->checkCharacterRelationships();
        $this->checkCharacterInventory();
        $this->checkLocationReferences();

        echo "\nPemeriksaan konsistensi data novel selesai.\n";
    }

    protected function loadAllCharacters() {
        $charactersIndex = $this->loadIndex('CHARACTERS.json');
        $allCharacters = [];
        foreach ($charactersIndex as $charId) {
            $characterData = $this->loadFile('characters/' . $charId . '.json');
            if ($characterData) {
                $allCharacters[$characterData['ID']] = $characterData; // Index by ID for quick lookup
            }
        }
        return $allCharacters;
    }

    protected function loadAllLocations() {
        $allLocations = [];

        // Load Cities
        $citiesIndex = $this->loadIndex('cities.json');
        foreach ($citiesIndex as $cityFile) {
            $cityData = $this->loadFile('cities/' . $cityFile . '.json');
            if ($cityData && isset($cityData['name'])) {
                $allLocations[strtolower($cityData['name'])] = true;
            }
        }

        // Load Villages
        $villagesIndex = $this->loadIndex('villages.json');
        foreach ($villagesIndex as $villageFile) {
            $villageData = $this->loadFile('villages/' . $villageFile . '.json');
            if ($villageData && isset($villageData['name'])) {
                $allLocations[strtolower($villageData['name'])] = true;
            }
        }

        // Load Kingdoms
        $kingdomsIndex = $this->loadIndex('kingdoms.json');
        foreach ($kingdomsIndex as $kingdomFile) {
            $kingdomData = $this->loadFile('kingdoms/' . $kingdomFile . '.json');
            if ($kingdomData && isset($kingdomData['name'])) {
                $allLocations[strtolower($kingdomData['name'])] = true;
            }
        }

        // Load General Locations
        $locationsIndex = $this->loadIndex('locations.json');
        foreach ($locationsIndex as $locationFile) {
            $locationData = $this->loadFile('locations/' . $locationFile . '.json');
            if ($locationData && isset($locationData['name'])) {
                $allLocations[strtolower($locationData['name'])] = true;
            }
        }

        return $allLocations;
    }

    public function checkCharacterSkills() {
        echo "\n--- Memeriksa konsistensi skill karakter ---\n";

        $skillsIndex = $this->loadIndex('skills.json');

        if (empty($this->allCharactersData)) {
            echo "Tidak ada data karakter ditemukan. Lewati pemeriksaan skill karakter.
";
            return;
        }
        if (empty($skillsIndex)) {
            echo "Tidak ada data skill ditemukan. Lewati pemeriksaan skill karakter.
";
            return;
        }

        $allSkills = [];
        foreach ($skillsIndex as $skillFile) {
            $skillData = $this->loadFile('skills/' . $skillFile);
            if ($skillData && isset($skillData['Name'])) {
                $allSkills[$skillData['Name']] = true; // Use skill name as key for quick lookup
            }
        }


        $inconsistenciesFound = false;

        foreach ($this->allCharactersData as $characterData) {
            if (isset($characterData['Skills']) && is_array($characterData['Skills'])) {
                foreach ($characterData['Skills'] as $skillEntry) {
                    if (isset($skillEntry['Name'])) {
                        $skillName = $skillEntry['Name'];
                        if (!isset($allSkills[$skillName])) {
                            echo "  [INKONSISTENSI] Karakter '{$characterData['Name']}' memiliki skill '{$skillName}' yang tidak terdaftar dalam data skill.\n";
                            $inconsistenciesFound = true;
                        }
                    } else {
                        echo "  [PERINGATAN] Entri skill tanpa 'Name' ditemukan di karakter '{$characterData['Name']}'.\n";
                        $inconsconsistenciesFound = true;
                    }
                }
            }
        }

        if (!$inconsistenciesFound) {
            echo "Pemeriksaan skill karakter selesai. Tidak ada inkonsistensi ditemukan.\n";
        } else {
            echo "Pemeriksaan skill karakter selesai. Beberapa inkonsistensi ditemukan.\n";
        }
    }

    public function checkCharacterRelationships() {
        echo "\n--- Memeriksa konsistensi hubungan karakter ---\n";

        if (empty($this->allCharactersData)) {
            echo "Tidak ada data karakter ditemukan. Lewati pemeriksaan hubungan karakter.\n";
            return;
        }

        $inconsistenciesFound = false;
        $characterIds = array_keys($this->allCharactersData);

        foreach ($this->allCharactersData as $characterData) {
            if (isset($characterData['Relationships']) && is_array($characterData['Relationships'])) {
                foreach ($characterData['Relationships'] as $relationship) {
                    if (isset($relationship['TargetID'])) {
                        $targetId = $relationship['TargetID'];
                        if (!in_array($targetId, $characterIds)) {
                            echo "  [INKONSISTENSI] Karakter '{$characterData['Name']}' memiliki hubungan dengan TargetID '{$targetId}' yang tidak ditemukan.\n";
                            $inconsistenciesFound = true;
                        }
                    } else {
                        echo "  [PERINGATAN] Entri hubungan tanpa 'TargetID' ditemukan di karakter '{$characterData['Name']}'.\n";
                        $inconsistenciesFound = true;
                    }
                }
            }
        }

        if (!$inconsistenciesFound) {
            echo "Pemeriksaan hubungan karakter selesai. Tidak ada inkonsistensi ditemukan.\n";
        } else {
            echo "Pemeriksaan hubungan karakter selesai. Beberapa inkonsistensi ditemukan.\n";
        }
    }

    public function checkCharacterInventory() {
        echo "\n--- Memeriksa konsistensi inventaris karakter ---\n";

        if (empty($this->allCharactersData)) {
            echo "Tidak ada data karakter ditemukan. Lewati pemeriksaan inventaris karakter.\n";
            return;
        }

        $this->allItemNames = $this->loadAllItemNames(); // Load all item names once

        if (empty($this->allItemNames)) {
            echo "Tidak ada data item ditemukan. Lewati pemeriksaan inventaris karakter.\n";
            return;
        }

        $inconsistenciesFound = false;

        foreach ($this->allCharactersData as $characterData) {
            if (isset($characterData['Inventory']) && is_array($characterData['Inventory'])) {
                foreach ($characterData['Inventory'] as $itemEntry) {
                    if (isset($itemEntry['Name'])) {
                        $itemName = $itemEntry['Name'];
                        $itemNameLower = strtolower($itemName);
                        if (!isset($this->allItemNames[$itemNameLower])) {
                            echo "  [INKONSISTENSI] Karakter '{$characterData['Name']}' memiliki item '{$itemName}' di inventaris yang tidak terdaftar dalam data item.\n";
                            $inconsistenciesFound = true;
                        }
                    } else {
                        echo "  [PERINGATAN] Entri item tanpa 'Name' ditemukan di inventaris karakter '{$characterData['Name']}'.\n";
                        $inconsistenciesFound = true;
                    }
                }
            }
        }

        if (!$inconsistenciesFound) {
            echo "Pemeriksaan inventaris karakter selesai. Tidak ada inkonsistensi ditemukan.\n";
        } else {
            echo "Pemeriksaan inventaris karakter selesai. Beberapa inkonsistensi ditemukan.\n";
        }
    }

    public function checkLocationReferences() {
        echo "\n--- Memeriksa referensi lokasi ---\n";

        if (empty($this->allCharactersData)) {
            echo "Tidak ada data karakter ditemukan. Lewati pemeriksaan referensi lokasi.\n";
            return;
        }
        if (empty($this->allLocationNames)) {
            echo "Tidak ada data lokasi ditemukan. Lewati pemeriksaan referensi lokasi.\n";
            return;
        }

        $inconsistenciesFound = false;

        // Check Character Origins and Backgrounds
        foreach ($this->allCharactersData as $characterData) {
            $charName = $characterData['Name'];

            // Check 'Origin'
            if (isset($characterData['Origin']) && !empty($characterData['Origin'])) {
                $originLower = strtolower($characterData['Origin']);
                if (!isset($this->allLocationNames[$originLower])) {
                    echo "  [INKONSISTENSI] Karakter '{$charName}' memiliki 'Origin' ('{$characterData['Origin']}') yang tidak terdaftar sebagai lokasi.\n";
                    $inconsistenciesFound = true;
                }
            }

            // Check 'Background' for location names (simple keyword search for now)
            if (isset($characterData['Background']) && !empty($characterData['Background'])) {
                $background = $characterData['Background'];
                foreach ($this->allLocationNames as $locNameLower => $value) {
                    // Simple check: if location name is present in background string
                    if (stripos($background, $locNameLower) !== false) {
                        // Found a potential match, but need to be careful with partial matches
                        // For now, just check if the exact name is present.
                        // More advanced parsing would be needed for complex sentences.
                    }
                }
            }

            // Check 'KeyEvents' for location names
            if (isset($characterData['KeyEvents']) && is_array($characterData['KeyEvents'])) {
                foreach ($characterData['KeyEvents'] as $event) {
                    if (isset($event['Impact']) && !empty($event['Impact'])) {
                        $impact = $event['Impact'];
                        foreach ($this->allLocationNames as $locNameLower => $value) {
                            if (stripos($impact, $locNameLower) !== false) {
                                // Found a potential match
                            }
                        }
                    }
                }
            }
        }

        // Check Historical Events
        $historicalEventsData = $this->loadIndex('historical_events.json'); // Renamed for clarity
        if (!empty($historicalEventsData)) {
            foreach ($historicalEventsData as $eventData) { // Directly use $eventData
                if ($eventData && isset($eventData['related_locations']) && is_array($eventData['related_locations'])) {
                    foreach ($eventData['related_locations'] as $location) {
                        $locationLower = strtolower($location);
                        if (!isset($this->allLocationNames[$locationLower])) {
                            echo "  [INKONSISTENSI] Peristiwa Sejarah '{$eventData['name']}' memiliki lokasi '{$location}' yang tidak terdaftar.\n";
                            $inconsistenciesFound = true;
                        }
                    }
                }
            }
        }


        if (!$inconsistenciesFound) {
            echo "Pemeriksaan referensi lokasi selesai. Tidak ada inkonsistensi ditemukan.\n";
        } else {
            echo "Pemeriksaan referensi lokasi selesai. Beberapa inkonsistensi ditemukan.\n";
        }
    }


    protected function loadAllItemNames() {
        $itemsIndex = $this->loadIndex('items.json');
        $allItemNames = [];
        if (!empty($itemsIndex)) {
            foreach ($itemsIndex as $itemFile) {
                $itemData = $this->loadFile('items/' . $itemFile . '.json');
                if ($itemData && isset($itemData['name'])) { // Assuming item name is 'name'
                    $allItemNames[strtolower($itemData['name'])] = true; // Store lowercase name
                }
            }
        }
        return $allItemNames;
    }

    protected function loadIndex($filename) {
        $filePath = $this->novelDataPath . $filename;
        if (!file_exists($filePath)) {
            return [];
        }
        $content = file_get_contents($filePath);
        return json_decode($content, true);
    }

    protected function loadFile($relativePath) {
        $filePath = $this->novelDataPath . $relativePath;
        if (!file_exists($filePath)) {
            return null;
        }
        $content = file_get_contents($filePath);
        return json_decode($content, true);
    }
}

// Run the checker
$checker = new ConsistencyChecker();
$checker->runChecks();

?>