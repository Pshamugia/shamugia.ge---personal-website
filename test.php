<?php
// Check PHP Info
phpinfo();

// Check File Permissions
echo "<h2>File Permissions:</h2>";
echo "Public Directory: " . substr(sprintf('%o', fileperms(__DIR__)), -4) . "<br>";
echo "Vendor Directory: " . substr(sprintf('%o', fileperms(__DIR__.'/vendor')), -4) . "<br>";
echo "Bootstrap Directory: " . substr(sprintf('%o', fileperms(__DIR__.'/bootstrap')), -4) . "<br>";

// Test Laravel Autoload
if (file_exists(__DIR__.'/vendor/autoload.php')) {
    echo "<h2>Autoload File Exists</h2>";
} else {
    echo "<h2>Autoload File Missing</h2>";
}

// Test Laravel App
if (file_exists(__DIR__.'/bootstrap/app.php')) {
    echo "<h2>App File Exists</h2>";
} else {
    echo "<h2>App File Missing</h2>";
}

// Check if Laravel is Running
try {
    require __DIR__.'/vendor/autoload.php';
    $app = require __DIR__.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    echo "<h2>Laravel is Working</h2>";
} catch (Exception $e) {
    echo "<h2>Laravel Error:</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
