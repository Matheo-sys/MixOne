@extends('layouts.backendDB')

@section('content')

    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">
            <h1 class="text-30 lh-14 fw-600">Mes studios</h1>
        </div>

        <div class="col-auto">
            <a href="{{ route('dashboard.studio.create') }}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                Ajouter Studio <div class="icon-arrow-top-right ml-15"></div>
            </a>
        </div>
    </div>

    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        @if ($studios->isEmpty())
            <p>Aucun studio trouvé</p>
        @else
            <div class="tabs -underline-2 js-tabs">
                <div class="tabs__content pt-30 js-tabs-content">
                    <div class="tabs__pane -tab-item-1 is-tab-el-active">
                        <div class="overflow-scroll scroll-bar-1">
                            <table class="table-4 -border-bottom col-12">
                                <thead class="bg-light-2">
                                <tr>
                                    <th>
                                        <div class="d-flex items-center">
                                            <div class="form-checkbox">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Reviews</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($studios as $studio)
                                    <tr>
                                        <td>
                                            <div class="d-flex items-center">
                                                <div class="form-checkbox">
                                                    <input type="checkbox" name="name">
                                                    <div class="form-checkbox__mark">
                                                        <div class="form-checkbox__icon icon-check"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-blue-1 fw-500">{{ $studio->name }}</td>
                                        <td>{{ $studio->city }}</td>
                                        <td>{{ $studio->user->name ?? 'Inconnu' }}</td> <!-- Utilisation de la relation user -->
                                        <td>
                                                <span class="rounded-100 py-4 px-10 text-center text-14 fw-500 bg-yellow-4 text-yellow-3">
                                                    Pending
                                                </span>
                                        </td>
                                        <td>
                                            <div class="rounded-4 size-35 bg-blue-1 text-white flex-center text-12 fw-600">4.8</div>
                                        </td>
                                        <td>{{ $studio->updated_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="row x-gap-10 y-gap-10 items-center">
                                                <div class="col-auto">
                                                    <button class="flex-center bg-light-2 rounded-4 size-35">
                                                        <i class="icon-eye text-16 text-light-1"></i>
                                                    </button>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="flex-center bg-light-2 rounded-4 size-35">
                                                        <i class="icon-edit text-16 text-light-1"></i>
                                                    </button>
                                                </div>
                                                <div class="col-auto">
                                                    <button class="flex-center bg-light-2 rounded-4 size-35">
                                                        <i class="icon-trash-2 text-16 text-light-1"></i>
                                                    </button>
                                                </div>
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
                        <button class="button -blue-1 size-40 rounded-full border-light">
                            <i class="icon-chevron-right text-12"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
