<?php
$db = new PDO('sqlite:/app/data/whats-growing-on.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$result = $db->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");
$tables = $result ? $result->fetchAll(PDO::FETCH_COLUMN) : [];

header('Content-Type: text/plain');
echo "SQLite OK\n";
echo "Tables:\n";
foreach ($tables as $t) {
    echo "- $t\n";
}
?>