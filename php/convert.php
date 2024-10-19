<?php
// Mengambil data dari API JSON eksternal
$apiUrl = 'http://localhost:4000/book';
$response = file_get_contents($apiUrl);

if ($response === FALSE) {
    die('Error occurred while fetching API.');
}

$dataArray = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON: ' . json_last_error_msg());
}

// Fungsi untuk mengonversi array ke format XML
function arrayToXml($data, &$xmlData) {
    foreach ($data as $key => $value) {
        $key = preg_replace('/[^a-zA-Z0-9_]/', '_', $key);
        if (is_numeric(substr($key, 0, 1))) {
            $key = 'item_' . $key;
        }

        if (is_array($value)) {
            $subnode = $xmlData->addChild($key);
            arrayToXml($value, $subnode);
        } else {
            $xmlData->addChild($key, htmlspecialchars($value));
        }
    }
}

$xml = new SimpleXMLElement('<root/>');

arrayToXml($dataArray, $xml);

header('Content-Type: application/xml');

echo $xml->asXML();
?>
