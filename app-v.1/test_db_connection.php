<?php
/**
 * Archivo de prueba para verificar la conexión a la base de datos
 * Ejecutar desde el navegador: http://localhost/smartcomunity/app-v.1/test_db_connection.php
 */

// Configuración de la base de datos
$host = '127.0.0.1';
$dbname = 'smartcom';
$username = 'root';
$password = '';

try {
    // Crear conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>✅ Conexión a la base de datos exitosa!</h2>";
    echo "<p><strong>Servidor:</strong> $host</p>";
    echo "<p><strong>Base de datos:</strong> $dbname</p>";
    echo "<p><strong>Usuario:</strong> $username</p>";
    
    // Verificar si existe la tabla users
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() > 0) {
        echo "<p>✅ <strong>Tabla 'users' encontrada</strong></p>";
        
        // Mostrar estructura de la tabla users
        $stmt = $pdo->query("DESCRIBE users");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<h3>Estructura de la tabla 'users':</h3>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>Campo</th><th>Tipo</th><th>Nulo</th><th>Clave</th><th>Por defecto</th><th>Extra</th></tr>";
        
        foreach ($columns as $column) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($column['Field']) . "</td>";
            echo "<td>" . htmlspecialchars($column['Type']) . "</td>";
            echo "<td>" . htmlspecialchars($column['Null']) . "</td>";
            echo "<td>" . htmlspecialchars($column['Key']) . "</td>";
            echo "<td>" . htmlspecialchars($column['Default']) . "</td>";
            echo "<td>" . htmlspecialchars($column['Extra']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Contar registros en la tabla users
        $stmt = $pdo->query("SELECT COUNT(*) as total FROM users");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "<p><strong>Total de usuarios:</strong> " . $result['total'] . "</p>";
        
    } else {
        echo "<p>⚠️ <strong>Tabla 'users' no encontrada</strong></p>";
        echo "<p>Necesitas ejecutar las migraciones de Laravel para crear las tablas.</p>";
    }
    
    // Mostrar todas las tablas en la base de datos
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "<h3>Tablas en la base de datos '$dbname':</h3>";
    if (count($tables) > 0) {
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>" . htmlspecialchars($table) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No hay tablas en la base de datos.</p>";
    }
    
} catch (PDOException $e) {
    echo "<h2>❌ Error de conexión a la base de datos</h2>";
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>Código de error:</strong> " . $e->getCode() . "</p>";
    
    echo "<h3>Posibles soluciones:</h3>";
    echo "<ul>";
    echo "<li>Verificar que XAMPP esté ejecutándose</li>";
    echo "<li>Verificar que MySQL esté iniciado en XAMPP</li>";
    echo "<li>Verificar que la base de datos 'smartcom' exista</li>";
    echo "<li>Verificar las credenciales de acceso</li>";
    echo "</ul>";
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f5f5f5;
    }
    
    h2, h3 {
        color: #333;
    }
    
    table {
        background-color: white;
        border-collapse: collapse;
        margin: 10px 0;
    }
    
    th {
        background-color: #007bff;
        color: white;
        padding: 8px;
    }
    
    td {
        padding: 8px;
    }
    
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
    ul {
        background-color: white;
        padding: 15px;
        border-radius: 5px;
    }
    
    p {
        background-color: white;
        padding: 10px;
        border-radius: 5px;
        margin: 10px 0;
    }
</style>