@extends('layouts.admin')

@section('title', 'Détails du Litige #' . $reservation->id)

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Litige #{{ $reservation->id }}</h1>
        <div class="text-15 text-light-1">Analyse approfondie pour une résolution équitable.</div>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.disputes.index') }}" class="button -md -blue-1 bg-blue-1-05 text-blue-1">
            <i class="icon-arrow-left text-14 mr-10"></i> Retour à la liste
        </a>
    </div>
</div>

<div class="row y-gap-30">
    {{-- Colonne Gauche : Détails & Preuves --}}
    <div class="col-xl-8 col-lg-7">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <h4 class="text-18 fw-500 mb-20">Informations sur le signalement</h4>
            
            <div class="row y-gap-20">
                <div class="col-12">
                    <div class="text-14 text-light-1">Raison invoquée :</div>
                    <div class="text-16 fw-600 text-red-1 mt-5">{{ $reservation->dispute_reason }}</div>
                </div>
                
                <div class="col-12">
                    <div class="text-14 text-light-1">Description détaillée :</div>
                    <div class="text-15 mt-5 bg-light-2 p-20 rounded-4">
                        {{ $reservation->dispute_description ?? 'Aucune description détaillée fournie.' }}
                    </div>
                </div>

                @if($reservation->dispute_image)
                <div class="col-12">
                    <div class="text-14 text-light-1 mb-10">Preuve visuelle :</div>
                    <img src="{{ Storage::url($reservation->dispute_image) }}" alt="Preuve litige" class="rounded-4 w-1/1" style="max-height: 500px; object-fit: contain; background: #f5f5f5;">
                </div>
                @endif
            </div>

            <div class="border-top-light mt-30 pt-30">
                <h4 class="text-18 fw-500 mb-20">Historique de la conversation</h4>
                <div class="chat-history p-20 bg-light-2 rounded-4" style="max-height: 400px; overflow-y: auto;">
                    @forelse($messages as $message)
                        <div class="mb-15 {{ $message->sender_id === $reservation->user_id ? 'text-left' : 'text-right' }}">
                            <div class="d-inline-block px-15 py-10 rounded-4 {{ $message->sender_id === $reservation->user_id ? 'bg-white shadow-1' : 'bg-blue-1 text-white' }}">
                                <div class="text-12 fw-600 mb-5">{{ $message->sender->first_name }}</div>
                                <div class="text-14">{{ $message->content }}</div>
                                <div class="text-10 mt-5 opacity-70">{{ $message->created_at->format('H:i') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-light-1 py-20">Aucun message échangé entre ces utilisateurs.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Colonne Droite : Résolution --}}
    <div class="col-xl-4 col-lg-5">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3 sticky-top" style="top: 100px;">
            <h4 class="text-18 fw-500 mb-20">Trancher le litige</h4>
            
            <div class="bg-blue-1-05 p-20 rounded-4 mb-20">
                <div class="text-14 fw-600 text-blue-1">Récapitulatif financier</div>
                <div class="d-flex justify-between mt-10">
                    <span class="text-14">Montant séquestré :</span>
                    <span class="text-16 fw-700 text-blue-1">{{ number_format($reservation->price, 2) }} €</span>
                </div>
            </div>

            <form action="{{ route('admin.disputes.resolve', $reservation) }}" method="POST">
                @csrf
                <div class="form-input mb-20">
                    <textarea name="admin_notes" rows="6" placeholder="Notes internes sur votre décision..." required>{{ old('admin_notes', $reservation->admin_notes) }}</textarea>
                    <label class="lh-1 text-16 text-light-1">Notes de l'Admin</label>
                </div>

                <div class="row y-gap-10">
                    <div class="col-12">
                        <button type="submit" name="action" value="complete" class="button -md bg-blue-1 text-white w-1/1" onclick="return confirm('Payer le studio ?')">
                            Régler en faveur du STUDIO
                        </button>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="action" value="cancel" class="button -md bg-red-1 text-white w-1/1" onclick="return confirm('Rembourser l\'artiste ?')">
                            Régler en faveur de l'ARTISTE
                        </button>
                    </div>
                </div>
            </form>

            <div class="mt-30 pt-30 border-top-light">
                <h5 class="text-15 fw-500 mb-10">Détails Réservation</h5>
                <div class="text-14 lh-16">
                    <div><strong>Artiste :</strong> {{ $reservation->user->first_name }} {{ $reservation->user->last_name }}</div>
                    <div><strong>Studio :</strong> {{ $reservation->studio->name }}</div>
                    <div><strong>Propriétaire :</strong> {{ $reservation->studio->user->first_name }} {{ $reservation->studio->user->last_name }}</div>
                    <div><strong>Date :</strong> {{ $reservation->date->format('d/m/Y') }}</div>
                    <div><strong>Heures :</strong> {{ $reservation->number_of_hours }}h ({{ $reservation->time_slot }})</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .chat-history::-webkit-scrollbar { width: 5px; }
    .chat-history::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
</style>
