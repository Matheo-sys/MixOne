<?php

use App\Models\Studio;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Str;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Generating slugs for studios...\n";
Studio::whereNull('slug')->each(function ($studio) {
    $studio->slug = Str::slug($studio->name) . '-' . Str::random(5);
    $studio->save();
});

echo "Generating UUIDs for users...\n";
User::whereNull('uuid')->each(function ($user) {
    $user->uuid = (string) Str::uuid();
    $user->save();
});

echo "Generating UUIDs for reservations...\n";
Reservation::whereNull('uuid')->each(function ($reservation) {
    $reservation->uuid = (string) Str::uuid();
    $reservation->save();
});

echo "Done!\n";
