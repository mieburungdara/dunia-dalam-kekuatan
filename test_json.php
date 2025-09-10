<?php
$filePath = '/home/rezaiturere/pecahan-dunia/novel_data/locations.json';
$content = file_get_contents($filePath);
$decodedContent = json_decode($content, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Decode Error: " . json_last_error_msg() . "\n";
} else {
    echo "Decoded Content:\n";
    print_r($decodedContent);
}
?>
