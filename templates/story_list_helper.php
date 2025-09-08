<?php

function getStoryList($basePath) {
    $storyList = [];
    $storyDir = $basePath . '/_cerita/';

    // Get all directories directly under _cerita/
    $directories = glob($storyDir . 'Arc_*_*', GLOB_ONLYDIR);

    foreach ($directories as $dir) {
        $folderName = basename($dir);
        // Extract human-readable title from folder name (e.g., Arc_01_Awal_Perjalanan -> Awal Perjalanan)
        $titleParts = explode('_', $folderName);
        $arcTitle = implode(' ', array_slice($titleParts, 2)); // Skip "Arc" and chapter number

        $indexJsonPath = $dir . '/index.json';
        $pageParam = str_replace($basePath . '/', '', $dir) . '/index';

        $displayTitle = $arcTitle;

        if (file_exists($indexJsonPath)) {
            $json_content = file_get_contents($indexJsonPath);
            $storyData = json_decode($json_content, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($storyData['Meta']['Title'])) {
                $displayTitle = $storyData['Meta']['Title'];
            }
        }

        $storyList[] = [
            'title' => $displayTitle,
            'page_param' => $pageParam
        ];
    }

    return $storyList;
}

?>