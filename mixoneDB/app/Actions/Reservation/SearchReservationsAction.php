<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class SearchReservationsAction
{
    public function execute(?string $query = null): Collection
    {
        $baseQuery = Reservation::forStudioOwner(Auth::id())
            ->with(['user', 'studio']);

        if ($query) {
            $baseQuery->where(function ($q) use ($query) {
                $q->where('reservations.id', 'LIKE', "%{$query}%")
                    ->orWhereHas('user', function ($userQuery) use ($query) {
                        $userQuery->where('email', 'LIKE', "%{$query}%")
                            ->orWhere('first_name', 'LIKE', "%{$query}%")
                            ->orWhere('last_name', 'LIKE', "%{$query}%");
                    })
                    ->orWhere('reservations.status', 'LIKE', "%{$query}%")
                    ->orWhere('reservations.price', 'LIKE', "%{$query}%");
            });
        }

        return $baseQuery->get();
    }
}
