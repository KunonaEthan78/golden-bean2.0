<?php
// Simple test to check if we can access the chat route
// Access this via: http://localhost/golden-bean2.0/test_chat.php

echo "<h1>Chat Route Test</h1>";

// Check if the route exists
$routes = [
    '/chat' => 'Chat Route'
];

foreach ($routes as $route => $name) {
    echo "<p><strong>$name:</strong> ";
    echo "<a href='{$route}' target='_blank'>{$route}</a>";
    echo "</p>";
}

echo "<h2>Direct Chat Access</h2>";
echo "<p><a href='/chat' class='btn btn-primary'>Open Chat</a></p>";

echo "<style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    .btn { 
        background: #007bff; 
        color: white; 
        padding: 10px 20px; 
        text-decoration: none; 
        border-radius: 5px; 
        display: inline-block; 
    }
</style>";
?>
