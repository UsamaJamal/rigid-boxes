<?php
require 'C:/Users/DELL/Desktop/go-custom/vendor/autoload.php';
$app = require_once 'C:/Users/DELL/Desktop/go-custom/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$updates = [
    1 => 'uploads/industry-magnetic-closure-boxes.webp',
    2 => 'uploads/eco-circular-packaging.png',
    3 => 'uploads/corrugated-insert.webp',
];

foreach ($updates as $id => $img) {
    DB::table('admin_blogs')->where('id', $id)->update(['image' => $img]);
    echo "Restored Blog ID $id with image $img\n";
}

echo "Done restoring original blog images!\n";
