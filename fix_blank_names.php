<?php
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
$loader = require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/app/Config/Paths.php';
$config = new \Config\Paths();
require __DIR__ . '/vendor/codeigniter4/framework/system/bootstrap.php';

$db = \Config\Database::connect();

echo "--- FIXING BLANK NAMES ---\n";

$builder = $db->table('users');
$builder->where('name', '')->orWhere('name', null);
$users = $builder->get()->getResult();

if (empty($users)) {
    echo "No users found with blank names.\n";
} else {
    foreach ($users as $user) {
        echo "Fixing user: {$user->username}... ";
        
        $updateData = [
            'name' => $user->username,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $db->table('users')
           ->where('id', $user->id)
           ->update($updateData);
           
        echo "Done (set name to username).\n";
    }
}

echo "\n--- VERIFICATION ---\n";
$allUsers = $db->table('users')->get()->getResult();
foreach ($allUsers as $u) {
    echo "ID: {$u->id} | Username: {$u->username} | Name: " . ($u->name ?: 'BLANK') . "\n";
}
