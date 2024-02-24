<?php

// Define the base directory of your app relative to the location of this _config.php file.
// Since _config.php is inside 'public', the base directory for 'app' would be '../models' relative to 'public'.
$baseDir = __DIR__ . '/../models';

// Register the autoloader
spl_autoload_register(function ($className) use ($baseDir) {
    // Replace namespace separator with directory separator
    // Assuming your classes might use namespaces, e.g., App\Models\Dice
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    
    // Construct the full path to the class file
    $file = $baseDir . DIRECTORY_SEPARATOR . $classPath;
    
    // Check if the file exists and include it
    if (file_exists($file)) {
        require_once $file;
    }
});

// You might also want to define other configurations or initialize resources here
