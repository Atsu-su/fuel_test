<?php
// db_test.php - FuelPHPプロジェクトルートに配置

try {
    // 設定に合わせてパラメータを調整
    $host = 'mysql';  // またはDocker環境なら 'mysql'
    $dbname = 'fuel_db';
    $username = 'fuel_user';
    $password = 'fuel_pass';  // 環境に応じて調整
    
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    
    $pdo = new PDO($dsn, $username, $password, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ));
    
    echo "✅ データベース接続成功！\n";
    echo "MySQL Version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "\n";
    
    // テーブル一覧の取得
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll();
    
    echo "利用可能なテーブル:\n";
    foreach ($tables as $table) {
        echo "- " . array_values($table)[0] . "\n";
    }
    
} catch (PDOException $e) {
    echo "❌ データベース接続エラー: " . $e->getMessage() . "\n";
    echo "接続情報を確認してください:\n";
    echo "Host: $host\n";
    echo "Database: $dbname\n";
    echo "Username: $username\n";
}