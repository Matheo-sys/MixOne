<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class SearchReservationsAction
{
    public function execute(?string $query = null): Collection
    {
        $baseQuery = Reservation::from('reservations as R')
            ->leftJoin('studios as S', 'S.id', 'R.studio_id')
            ->where('S.user_id', Auth::id())
            ->with(['user', 'studio'])
            ->select('R.*')
            ->orderBy('R.id', 'desc');

        if ($query) {
            $baseQuery->where(function ($q) use ($query) {
                $q->where('R.id', 'LIKE', "%{$query}%")
                    ->orWhereHas('user', function ($userQuery) use ($query) {
                        $userQuery->where('email', 'LIKE', "%{$query}%")
                            ->orWhere('first_name', 'LIKE', "%{$query}%")
                            ->orWhere('last_name', 'LIKE', "%{$query}%");
                    })
                    ->orWhere('R.status', 'LIKE', "%{$query}%")
                    ->orWhere('R.price', 'LIKE', "%{$query}%");
            });
        }

        return $baseQuery->get();
    }
}
