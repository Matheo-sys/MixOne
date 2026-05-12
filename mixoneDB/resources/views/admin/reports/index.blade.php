@extends('layouts.admin')

@section('title', 'Gestion des Signalements')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Signalements</h1>
        <div class="text-15 text-light-1">Gérez les litiges et signalements entre utilisateurs.</div>
    </div>
</div>

{{-- KPI Cards --}}
<div class="row y-gap-20 mb-30">
    <div class="col-lg-4 col-md-4">
        <div class="report-kpi-card report-kpi-card--pending">
            <div class="report-kpi-card__icon">
                <i class="icon-clock"></i>
            </div>
            <div>
                <div class="report-kpi-card__value">{{ $pendingCount }}</div>
                <div class="report-kpi-card__label">En attente</div>
            </div>
            @if($pendingCount > 0)
                <span class="report-kpi-pulse"></span>
            @endif
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="report-kpi-card report-kpi-card--resolved">
            <div class="report-kpi-card__icon report-kpi-card__icon--green">
                <i class="icon-check"></i>
            </div>
            <div>
                <div class="report-kpi-card__value">{{ $resolvedCount }}</div>
                <div class="report-kpi-card__label">Résolus</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="report-kpi-card report-kpi-card--total">
            <div class="report-kpi-card__icon report-kpi-card__icon--blue">
                <i class="icon-menu-2"></i>
            </div>
            <div>
                <div class="report-kpi-card__value">{{ $totalCount }}</div>
                <div class="report-kpi-card__label">Total</div>
            </div>
        </div>
    </div>
</div>

{{-- Filtres --}}
<div class="bg-white rounded-8 shadow-3 px-30 py-20 mb-30">
<div class="py-30 px-30 rounded-4 bg-white shadow-3">

    {{-- Barre de filtres --}}
    <div class="row y-gap-20 items-center justify-between pb-30">
        <div class="col-12">
            <form action="{{ route('admin.reports.index') }}" method="GET" class="row y-gap-20 items-end">
                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Recherche</div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, @username..." class="border-light rounded-4 px-15 py-10">
                </div>

                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Statut</div>
                    <select name="status" class="form-select border-light rounded-4 px-15 py-10">
                        <option value="">Tous les statuts</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Résolu</option>
                    </select>
                </div>

                <div class="col-auto">
                    <button type="submit" class="button -md bg-blue-1 text-white px-20">Filtrer</button>
                </div>

                @if(request()->anyFilled(['search', 'status']))
                <div class="col-auto">
                    <a href="{{ route('admin.reports.index') }}" class="button -md bg-light-2 text-dark-1 px-20">Réinitialiser</a>
                </div>
                @endif
            </form>
        </div>
    </div>

    <div class="overflow-scroll scroll-bar-1">
        <table class="report-table col-12">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Signaleur</th>
                    <th>Signalé</th>
                    <th>Motif</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                    <tr class="report-table__row {{ $report->status == 'pending' ? 'report-table__row--pending' : '' }}">
                        <td class="fw-600 text-dark-1">#{{ $report->id }}</td>
                        <td>
                            <div class="text-14 text-dark-1">{{ $report->created_at->format('d/m/Y') }}</div>
                            <div class="text-12 text-light-1">{{ $report->created_at->format('H:i') }}</div>
                        </td>
                        <td>
                            <div class="report-user-cell">
                                <img src="{{ $report->reporter->avatar ? asset('storage/' . $report->reporter->avatar) : asset('media/img/misc/avatar-default.png') }}" alt="" class="report-user-cell__avatar">
                                <div>
                                    <div class="text-14 fw-500 text-dark-1">{{ $report->reporter->first_name }} {{ $report->reporter->last_name }}</div>
                                    @if($report->reporter->username)
                                        <div class="text-12 text-light-1">{{ '@' . $report->reporter->username }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="report-user-cell">
                                <img src="{{ $report->reported->avatar ? asset('storage/' . $report->reported->avatar) : asset('media/img/misc/avatar-default.png') }}" alt="" class="report-user-cell__avatar report-user-cell__avatar--danger">
                                <div>
                                    <div class="text-14 fw-500 text-red-1">{{ $report->reported->first_name }} {{ $report->reported->last_name }}</div>
                                    @if($report->reported->username)
                                        <div class="text-12 text-light-1">{{ '@' . $report->reported->username }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-500 text-14">{{ $report->reason }}</div>
                            @if($report->reason === 'Autre' && $report->custom_reason)
                                <div class="text-12 text-light-1 report-table__truncate">{{ $report->custom_reason }}</div>
                            @endif
                        </td>
                        <td>
                            @if($report->status == 'pending')
                                <span class="report-badge report-badge--pending">
                                    <span class="report-badge__dot report-badge__dot--pulse"></span>
                                    En attente
                                </span>
                            @else
                                <span class="report-badge report-badge--resolved">
                                    <i class="icon-check text-10 mr-5"></i>
                                    Résolu
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.reports.show', $report->id) }}" class="report-details-btn">
                                <span>Détails</span>
                                <i class="icon-arrow-top-right text-12"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-40">
                            <div class="size-60 bg-light-2 rounded-full flex-center mx-auto mb-15">
                                <i class="icon-shield text-24 text-light-1"></i>
                            </div>
                            <div class="text-15 text-light-1">Aucun signalement trouvé.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($reports->hasPages())
        <div class="px-30 py-20 border-top-light">
            {{ $reports->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<style>
/* ========== KPI CARDS ========== */
.report-kpi-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 22px 25px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    border: 1px solid #f0f0f0;
    position: relative;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.report-kpi-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
}

.report-kpi-card__icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    background: #FFF3CD;
    color: #E6A817;
    flex-shrink: 0;
}

.report-kpi-card__icon--green {
    background: #D4EDDA;
    color: #28a745;
}

.report-kpi-card__icon--blue {
    background: #e8edfb;
    color: #3554D1;
}

.report-kpi-card__value {
    font-size: 28px;
    font-weight: 700;
    line-height: 1;
    color: #051036;
}

.report-kpi-card__label {
    font-size: 13px;
    color: #777;
    margin-top: 4px;
}

.report-kpi-pulse {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 10px;
    height: 10px;
    background: #E6A817;
    border-radius: 50%;
    animation: kpiPulse 2s ease-in-out infinite;
}

@keyframes kpiPulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.3); }
}


/* ========== TABLE ========== */
.report-table {
    width: 100%;
    border-collapse: collapse;
}

.report-table thead {
    background: #f8f9fc;
}

.report-table thead th {
    padding: 14px 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    color: #8b8fa7;
    letter-spacing: 0.5px;
    border-bottom: 2px solid #eef0f6;
    text-align: left;
    white-space: nowrap;
}

.report-table tbody td {
    padding: 16px 20px;
    border-bottom: 1px solid #f2f3f7;
    vertical-align: middle;
}

.report-table__row {
    transition: background 0.15s ease;
}

.report-table__row:hover {
    background: #fafbff;
}

.report-table__row--pending {
    border-left: 3px solid #E6A817;
}

.report-table__truncate {
    max-width: 180px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* ========== USER CELL ========== */
.report-user-cell {
    display: flex;
    align-items: center;
    gap: 10px;
}

.report-user-cell__avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e8edfb;
    flex-shrink: 0;
}

.report-user-cell__avatar--danger {
    border-color: #fde2e2;
}

/* ========== BADGES ========== */
.report-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

.report-badge--pending {
    background: #FFF3CD;
    color: #856404;
}

.report-badge--resolved {
    background: #D4EDDA;
    color: #155724;
}

.report-badge__dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #E6A817;
}

.report-badge__dot--pulse {
    animation: badgePulse 1.5s ease-in-out infinite;
}

@keyframes badgePulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
}

/* ========== DETAILS BUTTON ========== */
.report-details-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    color: #3554D1;
    background: #e8edfb;
    text-decoration: none;
    transition: all 0.2s ease;
}

.report-details-btn:hover {
    background: #3554D1;
    color: white;
    transform: translateX(2px);
}

.report-details-btn i {
    transition: transform 0.2s ease;
}

.report-details-btn:hover i {
    transform: translate(2px, -2px);
}
</style>
@endsection
