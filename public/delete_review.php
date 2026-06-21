<?php
use Illuminate\Contracts\Console\Kernel;
use App\Models\ProductReview;

define('LARAVEL_START', microtime(true));

// Register the auto-loader
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

// Truncate the reviews table
ProductReview::truncate();
echo "Truncated product_reviews successfully";
