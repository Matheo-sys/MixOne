@extends('layouts.admin')

@section('content')
<div class="row y-gap-20 justify-between items-center pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-700">Signalement #{{ $report->id }}</h1>
        <div class="text-15 text-light-1 mt-5 d-flex items-center" style="gap: 12px;">
            <span><i class="icon-calendar-2 mr-5"></i>{{ $report->created_at->format('d/m/Y à H:i') }}</span>
            <span class="text-blue-1">• {{ $report->created_at->locale('fr')->diffForHumans() }}</span>
        </div>
    </div>
    <div class="col-auto d-flex items-center" style="gap: 10px;">
        @if($report->status == 'pending')
            <span class="report-badge report-badge--pending"><span class="report-badge__dot report-badge__dot--pulse"></span> En attente</span>
        @else
            <span class="report-badge report-badge--resolved"><i class="icon-check text-10 mr-5"></i> Résolu</span>
        @endif
        <a href="{{ route('admin.reports.index') }}" class="button -md -outline-blue-1 text-blue-1 bg-white shadow-1 rounded-8">
            <i class="icon-arrow-left text-14 mr-10"></i>Retour
        </a>
    </div>
</div>

<div class="row y-gap-30">
    {{-- PANNEAU GAUCHE --}}
    <div class="col-xl-4 col-lg-5">
        {{-- Carte Infos --}}
        <div class="rshow-card mb-20">
            <h5 class="rshow-card__title"><i class="icon-profile mr-10 text-blue-1"></i>Informations</h5>

            <div class="rshow-user-block mb-15">
                <div class="text-11 text-light-1 fw-600 uppercase mb-8">Signaleur (Plaignant)</div>
                <div class="rshow-user-row">
                    <img src="{{ $report->reporter->avatar ? asset('storage/' . $report->reporter->avatar) : asset('media/img/misc/avatar-default.png') }}" class="rshow-user-row__avatar">
                    <div class="flex-1">
                        <div class="fw-600 text-dark-1 text-15">{{ $report->reporter->first_name }} {{ $report->reporter->last_name }}</div>
                        @if($report->reporter->username)<div class="text-12 text-light-1">{{ '@' . $report->reporter->username }}</div>@endif
                        @if($report->reporter->is_admin)
                            <span class="rshow-profile-badge rshow-profile-badge--admin">Admin</span>
                        @else
                            <span class="rshow-profile-badge rshow-profile-badge--{{ $report->reporter->profile }}">{{ ucfirst($report->reporter->profile) }}</span>
                        @endif
                    </div>
                    <a href="{{ route('admin.users.show', $report->reporter) }}" class="rshow-profile-link" target="_blank" title="Voir profil">
                        <i class="icon-arrow-top-right"></i>
                    </a>
                </div>
            </div>

            <div class="rshow-user-block mb-15">
                <div class="text-11 text-light-1 fw-600 uppercase mb-8">Signalé (Cible)</div>
                <div class="rshow-user-row rshow-user-row--danger">
                    <img src="{{ $report->reported->avatar ? asset('storage/' . $report->reported->avatar) : asset('media/img/misc/avatar-default.png') }}" class="rshow-user-row__avatar rshow-user-row__avatar--danger">
                    <div class="flex-1">
                        <div class="fw-600 text-red-1 text-15">{{ $report->reported->first_name }} {{ $report->reported->last_name }}</div>
                        @if($report->reported->username)<div class="text-12 text-light-1">{{ '@' . $report->reported->username }}</div>@endif
                        @if($report->reported->is_admin)
                            <span class="rshow-profile-badge rshow-profile-badge--admin">Admin</span>
                        @else
                            <span class="rshow-profile-badge rshow-profile-badge--{{ $report->reported->profile }}">{{ ucfirst($report->reported->profile) }}</span>
                        @endif
                    </div>
                    <a href="{{ route('admin.users.show', $report->reported) }}" class="rshow-profile-link" target="_blank" title="Voir profil">
                        <i class="icon-arrow-top-right"></i>
                    </a>
                </div>
            </div>

            <div class="rshow-info-block">
                <div class="text-11 text-light-1 fw-600 uppercase mb-8">Motif</div>
                <div class="rshow-motif-box">
                    <div class="fw-600 text-dark-1">{{ $report->reason }}</div>
                    @if($report->custom_reason)
                        <div class="text-14 text-light-1 mt-8" style="font-style: italic;">"{{ $report->custom_reason }}"</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Carte Décision --}}
        @if($report->status == 'pending')
        <div class="rshow-card rshow-card--decision">
            <h5 class="rshow-card__title text-red-1"><i class="icon-check mr-10"></i>Prendre une décision</h5>

            <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST" id="report-decision-form">
                @csrf
                <div class="rshow-decision-options">
                    <label class="rshow-decision-opt">
                        <input type="radio" name="action" value="ban_reported" required>
                        <div class="rshow-decision-opt__content">
                            <div class="rshow-decision-opt__radio"></div>
                            <div class="rshow-decision-opt__icon rshow-decision-opt__icon--red"><i class="icon-close"></i></div>
                            <div>
                                <div class="fw-700 text-red-1">Bannir le signalé</div>
                                <div class="text-12 text-light-1">L'utilisateur sera banni de la plateforme.</div>
                            </div>
                        </div>
                    </label>

                    <label class="rshow-decision-opt">
                        <input type="radio" name="action" value="ignore">
                        <div class="rshow-decision-opt__content">
                            <div class="rshow-decision-opt__radio"></div>
                            <div class="rshow-decision-opt__icon rshow-decision-opt__icon--gray"><i class="icon-minus"></i></div>
                            <div>
                                <div class="fw-700 text-dark-1">Classer sans suite</div>
                                <div class="text-12 text-light-1">Aucune action ne sera entreprise.</div>
                            </div>
                        </div>
                    </label>

                    <label class="rshow-decision-opt">
                        <input type="radio" name="action" value="ban_reporter">
                        <div class="rshow-decision-opt__content">
                            <div class="rshow-decision-opt__radio"></div>
                            <div class="rshow-decision-opt__icon rshow-decision-opt__icon--purple"><i class="icon-shield"></i></div>
                            <div>
                                <div class="fw-700 text-purple-1">Bannir le signaleur</div>
                                <div class="text-12 text-light-1">Sanction pour abus de signalement.</div>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="mt-20">
                    <label class="text-13 fw-500 text-dark-1 d-block mb-8">Notes de modération</label>
                    <textarea name="admin_notes" rows="4" class="rshow-textarea" placeholder="Justifiez votre décision ici... (obligatoire)" required></textarea>
                </div>

                <button type="submit" class="button -md -dark-1 bg-blue-1 text-white w-100 shadow-2 rounded-8 mt-20 h-55" onclick="confirmAction(event, this.form, 'Voulez-vous vraiment appliquer cette décision ?')">
                    Valider la décision <i class="icon-arrow-top-right ml-10"></i>
                </button>
            </form>
        </div>
        @else
        <div class="rshow-card">
            <h5 class="rshow-card__title" style="color: #28a745;"><i class="icon-check mr-10"></i>Décision prise</h5>
            <div class="rshow-motif-box" style="border-color: #d4edda; background: #f6fff8;">
                <div class="fw-600 text-dark-1">Action : {{ $report->action_taken ?? 'N/A' }}</div>
                @if($report->admin_notes)
                    <div class="text-14 text-light-1 mt-8">{{ $report->admin_notes }}</div>
                @endif
            </div>
        </div>
        @endif
    </div>

    {{-- PANNEAU DROIT : CHAT --}}
    <div class="col-xl-8 col-lg-7">
        <div class="rshow-chat">
            <div class="rshow-chat__header">
                <h5 class="text-16 fw-600 d-flex items-center">
                    <i class="icon-newsletter text-20 mr-12 text-blue-1"></i>
                    Historique de la conversation
                </h5>
                <div class="text-13 text-light-1">{{ count($messages) }} message(s)</div>
            </div>

            <div class="rshow-chat__body">
                @if($messages->isEmpty())
                    <div class="text-center py-60">
                        <div class="size-70 bg-white rounded-full flex-center mx-auto mb-15 shadow-1">
                            <i class="icon-search text-28 text-light-1"></i>
                        </div>
                        <div class="text-16 fw-500 text-dark-1">Aucun historique disponible</div>
                        <div class="text-14 text-light-1 mt-5">Aucun message échangé entre ces utilisateurs.</div>
                    </div>
                @else
                    <div class="rshow-chat__messages">
                        @foreach($messages as $msg)
                            @php
                                $isReporter = $msg->sender_id == $report->reporter_id;
                                $sender = $isReporter ? $report->reporter : $report->reported;
                            @endphp
                            <div class="rshow-msg {{ $isReporter ? 'rshow-msg--right' : 'rshow-msg--left' }}">
                                <img src="{{ $sender->avatar ? asset('storage/' . $sender->avatar) : asset('media/img/misc/avatar-default.png') }}" class="rshow-msg__avatar {{ $isReporter ? '' : 'rshow-msg__avatar--danger' }}">
                                <div class="rshow-msg__wrap">
                                    <div class="rshow-msg__meta">
                                        <span class="fw-600 text-13 {{ $isReporter ? 'text-blue-1' : 'text-red-1' }}">{{ $sender->first_name }} <span class="fw-400 text-11">({{ $isReporter ? 'Signaleur' : 'Signalé' }})</span></span>
                                        <span class="text-11 text-light-1">{{ $msg->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <div class="rshow-msg__bubble {{ $isReporter ? 'rshow-msg__bubble--blue' : 'rshow-msg__bubble--white' }}">
                                        {{ $msg->message }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="rshow-chat__footer">
                <i class="icon-info text-16 mr-10 text-blue-1"></i>
                Historique généré à partir des messages échangés avant le signalement.
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.querySelector('.rshow-chat__body')?.scrollTo(0, document.querySelector('.rshow-chat__body')?.scrollHeight);
</script>
@endpush

<style>
/* ========== BADGES (réutilisés de index) ========== */
.report-badge { display: inline-flex; align-items: center; gap: 6px; padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
.report-badge--pending { background: #FFF3CD; color: #856404; }
.report-badge--resolved { background: #D4EDDA; color: #155724; }
.report-badge__dot { width: 7px; height: 7px; border-radius: 50%; background: #E6A817; }
.report-badge__dot--pulse { animation: badgePulse 1.5s ease-in-out infinite; }
@keyframes badgePulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.3; } }

/* ========== CARD ========== */
.rshow-card {
    background: white;
    border-radius: 14px;
    box-shadow: 0 4px 25px rgba(0,0,0,0.04);
    padding: 28px;
    border: 1px solid #eef0f6;
}
.rshow-card--decision { border-top: 3px solid #3554D1; }
.rshow-card__title { font-size: 17px; font-weight: 600; margin-bottom: 22px; padding-bottom: 14px; border-bottom: 1px solid #eef0f6; display: flex; align-items: center; }

/* ========== USER ROWS ========== */
.rshow-user-row {
    display: flex; align-items: center; gap: 12px; padding: 14px; border-radius: 10px; background: #f8f9fc; transition: background 0.2s;
}
.rshow-user-row:hover { background: #eef0f6; }
.rshow-user-row--danger { background: #fef5f5; }
.rshow-user-row--danger:hover { background: #fde8e8; }
.rshow-user-row__avatar { width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid #e8edfb; flex-shrink: 0; }
.rshow-user-row__avatar--danger { border-color: #fde2e2; }
.rshow-profile-link {
    width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;
    background: white; color: #3554D1; font-size: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: all 0.2s;
}
.rshow-profile-link:hover { background: #3554D1; color: white; }
.rshow-profile-badge {
    display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: 600; margin-top: 4px; color: white;
}
.rshow-profile-badge--artist { background: #10b981; }
.rshow-profile-badge--studio { background: #3554D1; }
.rshow-profile-badge--admin { background: #D13535; }

/* ========== MOTIF ========== */
.rshow-motif-box { padding: 14px; border-radius: 10px; border: 1px solid #eef0f6; background: #f8f9fc; }

/* ========== DECISION OPTIONS ========== */
.rshow-decision-options { display: flex; flex-direction: column; gap: 10px; }
.rshow-decision-opt { display: block; cursor: pointer; }
.rshow-decision-opt input { display: none; }
.rshow-decision-opt__content {
    display: flex; align-items: center; gap: 12px; padding: 14px; border-radius: 10px;
    border: 1px solid #eef0f6; background: white; transition: all 0.2s;
}
.rshow-decision-opt__content:hover { border-color: #c4cff5; }
.rshow-decision-opt input:checked + .rshow-decision-opt__content { border-color: #3554D1; background: #f2f5ff; }
.rshow-decision-opt__radio {
    width: 18px; height: 18px; border-radius: 50%; border: 2px solid #d0d0d0; flex-shrink: 0; position: relative;
}
.rshow-decision-opt input:checked + .rshow-decision-opt__content .rshow-decision-opt__radio {
    border-color: #3554D1; background: #3554D1;
}
.rshow-decision-opt input:checked + .rshow-decision-opt__content .rshow-decision-opt__radio::after {
    content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    width: 7px; height: 7px; background: white; border-radius: 50%;
}
.rshow-decision-opt__icon {
    width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center;
    font-size: 14px; flex-shrink: 0;
}
.rshow-decision-opt__icon--red { background: #fde2e2; color: #d33; }
.rshow-decision-opt__icon--gray { background: #f0f0f0; color: #777; }
.rshow-decision-opt__icon--purple { background: #ede5fb; color: #7c3aed; }
.rshow-textarea {
    width: 100%; padding: 14px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 14px;
    outline: none; resize: vertical; background: #fdfdfd; transition: border-color 0.2s;
}
.rshow-textarea:focus { border-color: #3554D1; }

/* ========== CHAT ========== */
.rshow-chat {
    background: white; border-radius: 14px; box-shadow: 0 4px 25px rgba(0,0,0,0.04);
    border: 1px solid #eef0f6; display: flex; flex-direction: column; height: 100%; min-height: 600px;
}
.rshow-chat__header {
    padding: 22px 28px; border-bottom: 1px solid #eef0f6;
    display: flex; align-items: center; justify-content: space-between;
}
.rshow-chat__body {
    flex: 1; padding: 24px; background: #f4f5f8; overflow-y: auto; max-height: 650px;
}
.rshow-chat__body::-webkit-scrollbar { width: 5px; }
.rshow-chat__body::-webkit-scrollbar-thumb { background: #d0d0d0; border-radius: 10px; }
.rshow-chat__footer {
    padding: 16px 28px; border-top: 1px solid #eef0f6; font-size: 13px; color: #777;
    display: flex; align-items: center;
}
.rshow-chat__messages { display: flex; flex-direction: column; gap: 16px; }

/* ========== MESSAGE BUBBLES ========== */
.rshow-msg { display: flex; gap: 10px; max-width: 85%; }
.rshow-msg--right { align-self: flex-end; flex-direction: row-reverse; }
.rshow-msg--left { align-self: flex-start; }
.rshow-msg__avatar { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; flex-shrink: 0; border: 2px solid #e8edfb; }
.rshow-msg__avatar--danger { border-color: #fde2e2; }
.rshow-msg__wrap { display: flex; flex-direction: column; gap: 4px; }
.rshow-msg--right .rshow-msg__meta { text-align: right; }
.rshow-msg__meta { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.rshow-msg--right .rshow-msg__meta { justify-content: flex-end; }
.rshow-msg__bubble {
    padding: 12px 16px; border-radius: 14px; font-size: 14px; line-height: 1.5;
    box-shadow: 0 1px 4px rgba(0,0,0,0.04);
}
.rshow-msg__bubble--blue { background: #3554D1; color: white; border-bottom-right-radius: 4px; }
.rshow-msg__bubble--white { background: white; color: #333; border-bottom-left-radius: 4px; }
</style>
@endsection
