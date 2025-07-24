<?php
// Simple database migration script for messages table
// Run this file in browser: http://localhost/golden-bean2.0/create_messages_table.php

// Database configuration (update these as needed)
$host = 'localhost';
$dbname = 'golden_bean';  // Update with your actual database name
$username = 'root';       // Update with your database username
$password = '';           // Update with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h1>Messages Table Creation</h1>";
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'messages'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color: green;'>✅ Messages table already exists!</p>";
    } else {
        // Create messages table
        $sql = "CREATE TABLE messages (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            sender_id BIGINT UNSIGNED NOT NULL,
            receiver_id BIGINT UNSIGNED NOT NULL,
            message TEXT NULL,
            file_path VARCHAR(255) NULL,
            is_read BOOLEAN DEFAULT FALSE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_sender (sender_id),
            INDEX idx_receiver (receiver_id),
            FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
        
        $pdo->exec($sql);
        echo "<p style='color: green;'>✅ Messages table created successfully!</p>";
    }
    
    // Test the table structure
    $stmt = $pdo->query("DESCRIBE messages");
    echo "<h2>Messages Table Structure:</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>{$row['Field']}</td>";
        echo "<td>{$row['Type']}</td>";
        echo "<td>{$row['Null']}</td>";
        echo "<td>{$row['Key']}</td>";
        echo "<td>{$row['Default']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2>Next Steps:</h2>";
    echo "<p>1. Your messages table is ready</p>";
    echo "<p>2. You can now access the chat at: <a href='/chat' target='_blank'>http://localhost/golden-bean2.0/chat</a></p>";
    echo "<p>3. Make sure you're logged in first</p>";
    
} catch (PDOException $e) {
    echo "<h1 style='color: red;'>Database Error</h1>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration in this file.</p>";
}
?>
