@extends('layouts.backendDB')

@section('content')

    <div class="row y-gap-20 justify-between items-end pb-40 lg:pb-30 md:pb-24">
        <div class="col-auto ml-10">
            <h1 class="text-26 sm:text-22 lh-14 fw-600">TOUS MES STUDIOS</h1>
            <div class="text-15 text-light-1">Gérez facilement vos studios d'enregistrement.</div>
        </div>

        <div class="col-auto mr-10 sm:mr-0 sm:w-100">
            <a href="{{ route('dashboard.studio.create') }}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white sm:w-100">
                Ajouter Studio <div class="icon-arrow-top-right ml-15"></div>
            </a>
        </div>
    </div>

    <div class="py-30 px-30 sm:px-15 rounded-4 bg-white shadow-3">
        @if ($studios->isEmpty())
            <div class="text-center py-40">
                <i class="icon-hotel text-60 text-light-1 mb-20"></i>
                <p class="text-18 fw-500">Vous n'avez pas encore de studio.</p>
                <a href="{{ route('dashboard.studio.create') }}" class="button -md -blue-1 bg-blue-1-05 text-blue-1 mt-20">Ajouter votre premier studio</a>
            </div>
        @else
            <div class="tabs -underline-2 js-tabs">
                <div class="tabs__content pt-30 js-tabs-content">
                    <div class="tabs__pane -tab-item-1 is-tab-el-active">
                        <div class="overflow-scroll scroll-bar-1">
                            <table class="table-4 -border-bottom col-12 table-responsive-cards">
                                <thead class="bg-light-2">
                                <tr>

                                    <th>Nom</th>
                                    <th>Lieu</th>
                                    <th>Avis</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($studios as $studio)
                                    <tr>
                                        <td data-label="Nom" class="text-blue-1 fw-500">{{ $studio->name }}</td>
                                        <td data-label="Lieu">{{ $studio->city }}</td>
                                        <td data-label="Avis">
                                            <div class="rounded-4 size-35 bg-blue-1 text-white flex-center text-12 fw-600">4.8</div>
                                        </td>
                                        <td data-label="Date">{{ $studio->created_at->format('d/m/Y') }}</td>
                                        <td data-label="Action">
                                            <div class="d-flex align-items-center gap-2">
                                                <!-- Bouton Vue -->
                                                <a href="{{ route('studio.show', $studio->id) }}" class="d-flex justify-content-center align-items-center bg-light-2 rounded-4 p-2" title="Voir">
                                                    <i class="icon-eye text-16 text-light-1"></i>
                                                </a>

                                                <!-- Bouton Modifier -->
                                                <a href="{{ route('dashboard.studio.edit', $studio->id) }}" class="d-flex justify-content-center align-items-center bg-light-2 rounded-4 p-2 ml-10" title="Modifier">
                                                    <i class="icon-edit text-16 text-light-1"></i>
                                                </a>

                                                <!-- Bouton Supprimer -->
                                                <form class="ml-10" action="{{ route('studio.destroy', $studio->id) }}" method="POST"
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce studio ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="d-flex justify-content-center align-items-center bg-light-2 rounded-4 p-2" title="Supprimer">
                                                        <i class="icon-trash-2 text-16 text-light-1"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-30">
                <div class="row justify-between">
                    <div class="col-auto">
                        <button class="button -blue-1 size-40 rounded-full border-light">
                            <i class="icon-chevron-left text-12"></i>
                        </button>
                    </div>
                    <div class="col-auto">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <div class="size-40 flex-center rounded-full">1</div>
                            </div>
                            <div class="col-auto">
                                <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>
                            </div>
                            <div class="col-auto">
                                <div class="size-40 flex-center rounded-full">3</div>
                            </div>
                            <div class="col-auto">
                                <div class="size-40 flex-center rounded-full bg-light-2">4</div>
                            </div>
                            <div class="col-auto">
                                <div class="size-40 flex-center rounded-full">5</div>
                            </div>
                            <div class="col-auto">
                                <div class="size-40 flex-center rounded-full">...</div>
                            </div>
                            <div class="col-auto">
                                <div class="size-40 flex-center rounded-full">20</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="col-auto">
                            <button class="flex-center bg-light-2 rounded-4 size-35">
                                <i class="icon-trash-2 text-16 text-light-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
