<?php

// Load Composer dependencies
require 'vendor/autoload.php';

// Use the Hash facade
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

// Hash a password
$password = 'your-password'; // Replace this with the actual password
$hashedPassword = Hash::make($password);

// Output the hashed password
echo $hashedPassword;
 