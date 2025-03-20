<?php

$columnName = create_function('$value', 'return $value->name;');

$dbName = "radovi";
$dir = "backup/$dbName";

if (!is_dir($dir) && !mkdir($dir, 0777, true)) {
    echo "<p>Cannot create directory uploads.</p>";
    exit;
}

$time = time();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=$dbName", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $files = array();
    $tablesStmt = $pdo->query("SHOW TABLES");
    $tables = array();
    while ($row = $tablesStmt->fetch(PDO::FETCH_NUM)) {
        $tables[] = $row[0];
    }

    if (count($tables) > 0) {
        echo "<p>Backup for database '$dbName'.</p>";

        foreach ($tables as $table) {
            $stmt = $pdo->query("SELECT * FROM $table");
            $columnsStmt = $pdo->query("SHOW COLUMNS FROM $table");
            $columns = array();
            while ($col = $columnsStmt->fetch(PDO::FETCH_ASSOC)) {
                $columns[] = $col['Field'];
            }

            if ($stmt->rowCount() > 0) {
                $fileName = "$table" . "_" . "$time";
                $filePath = "$dir/$fileName.txt";

                if ($fp = fopen($filePath, "w+")) {
                    $files[] = $fileName;

                    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                        $rowText = "INSERT INTO $table (" . implode(", ", $columns) . ") VALUES ('" . implode("', '", $row) . "');\n";
                        fwrite($fp, $rowText);
                    }
                    fclose($fp);

                    echo "<p>Table '$table' has been stored.</p>";

                    if ($fp = gzopen("$dir/" . $fileName . "sql.gz", 'w9')) {
                        $content = file_get_contents($filePath);
                        gzwrite($fp, $content);
                        unlink($filePath);
                        gzclose($fp);

                        echo "<p>Table '$table' has been compressed.</p>";
                    } else {
                        echo "<p>Error compressing table '$table'.</p>";
                    }
                } else {
                    echo "<p>Cannot open file $filePath.</p>";
                    break;
                }
            }
        }
    } else {
        echo "<p>Database $dbName contains no tables.</p>";
    }
} catch (PDOException $e) {
    echo "<p>Cannot connect to database $dbName: " . $e->getMessage() . "</p>";
    exit;
}

?>