<?php header('Content-Type: application/xml');

$xml = new SimpleXMLElement('<books/>');

$book = $xml->addChild('book');
$book->addChild('id', 1);
$book->addChild('buku', 'Bulan');
$book->addChild('penulis', 'Tere Liye');
$book->addChild('genre', 'Fantasi');
$book->addChild('tahun', 2015);

echo $xml->asXML();