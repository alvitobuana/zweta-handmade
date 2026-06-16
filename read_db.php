<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$products = Product::all();
foreach ($products as $p) {
    echo "ID: {$p->id} | Name: {$p->name} | Price: {$p->price} | Image: {$p->image} | Category: {$p->category} | Stock: {$p->stock}\n";
}
