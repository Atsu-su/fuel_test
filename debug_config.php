<?php
// docker_debug.php - Docker環境での詳細デバッグ

echo "=== Docker MySQL 接続デバッグ ===\n\n";

// 1. 直接PDO接続テスト（現在成功しているもの）
echo "1. 直接PDO接続テスト:\n";
try {
    $dsn = "mysql:host=mysql;dbname=fuel_db;charset=utf8";
    $pdo = new PDO($dsn, 'fuel_user', 'fuel_pass');
    echo "✅ 直接PDO接続: 成功\n";
} catch (Exception $e) {
    echo "❌ 直接PDO接続: " . $e->getMessage() . "\n";
}

// 2. ポート指定付きでのテスト
echo "\n2. ポート指定付きPDO接続テスト:\n";
try {
    $dsn = "mysql:host=mysql;dbname=fuel_db;port=3306;charset=utf8";
    $pdo = new PDO($dsn, 'fuel_user', 'fuel_pass');
    echo "✅ ポート指定PDO接続: 成功\n";
} catch (Exception $e) {
    echo "❌ ポート指定PDO接続: " . $e->getMessage() . "\n";
}

// 3. FuelPHPの設定読み込みテスト
echo "\n3. FuelPHP設定読み込みテスト:\n";
if (file_exists('fuel/app/bootstrap.php')) {
    try {
        require_once 'fuel/app/bootstrap.php';
        
        echo "Environment: " . Fuel::$env . "\n";
        
        $config = Config::get('db.default');
        echo "設定内容:\n";
        echo "- DSN: " . $config['connection']['dsn'] . "\n";
        echo "- Username: " . $config['connection']['username'] . "\n";
        echo "- Type: " . $config['type'] . "\n";
        
        // FuelPHP経由での接続
        $db = Database_Connection::instance();
        $result = DB::query('SELECT 1 as test')->execute();
        echo "✅ FuelPHP DB接続: 成功\n";
        
    } catch (Exception $e) {
        echo "❌ FuelPHP DB接続エラー: " . $e->getMessage() . "\n";
        echo "エラータイプ: " . get_class($e) . "\n";
        
        // より詳細なエラー情報
        if ($e instanceof PDOException) {
            echo "PDOエラーコード: " . $e->getCode() . "\n";
            echo "PDOエラー詳細: " . $e->errorInfo[2] ?? 'N/A' . "\n";
        }
    }
} else {
    echo "❌ FuelPHPのbootstrap.phpが見つかりません\n";
}

// 4. ネットワーク接続確認
echo "\n4. ネットワーク接続確認:\n";
$connection = @fsockopen('mysql', 3306, $errno, $errstr, 10);
if ($connection) {
    echo "✅ MySQL ポート 3306 への接続: 成功\n";
    fclose($connection);
} else {
    echo "❌ MySQL ポート 3306 への接続: 失敗 ($errno: $errstr)\n";
}

// 5. DNS解決確認
echo "\n5. DNS解決確認:\n";
$ip = gethostbyname('mysql');
if ($ip !== 'mysql') {
    echo "✅ 'mysql' ホスト名解決: $ip\n";
} else {
    echo "❌ 'mysql' ホスト名解決: 失敗\n";
}

echo "\n=== デバッグ完了 ===\n";