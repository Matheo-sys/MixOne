<div class="dashboard" data-x="dashboard" data-x-toggle="-is-sidebar-open">
    <div class="dashboard__sidebar bg-white scroll-bar-1">


        <div class="sidebar -dashboard">

            <div class="sidebar__item">
                <div class="sidebar__button -is-active">
                    <a href="db-booking.html" class="d-flex items-center text-15 lh-1 fw-500">
                        <img src={{asset("media/img/dashboard/sidebar/booking.svg")}} alt="image" class="mr-15">
                        Historique des réservations
                    </a>
                </div>
            </div>

            <div class="sidebar__item">
                <div class="sidebar__button ">
                    <a href="db-wishlist.html" class="d-flex items-center text-15 lh-1 fw-500">
                        <img src={{asset("media/img/dashboard/sidebar/bookmark.svg")}} alt="image" class="mr-15">
                        Liste d'envie
                    </a>
                </div>
            </div>

            <div class="sidebar__item">
                <div class="sidebar__button ">
                    <a href="db-settings.html" class="d-flex items-center text-15 lh-1 fw-500">
                        <img src={{asset("media/img/dashboard/sidebar/gear.svg")}} alt="image" class="mr-15">
                        Paramètres
                    </a>
                </div>
            </div>

            <div class="sidebar__item">
                <div class="sidebar__button ">
                    <a href="#" class="d-flex items-center text-15 lh-1 fw-500">
                        <img src={{asset("media/img/dashboard/sidebar/log-out.svg")}} alt="image" class="mr-15">
                        Se déconnecter
                    </a>
                </div>
            </div>

        </div>


    </div>

    <div class="dashboard__main">
        <div class="dashboard__content bg-light-2">
            <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
                <div class="col-auto">

                    <h1 class="text-30 lh-14 fw-600">Historique des réservations</h1>
                    <div class="text-15 text-light-1">Retrouvez votre historique des réservations</div>

                </div>

                <div class="col-auto">

                </div>
            </div>


            <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                <div class="tabs -underline-2 js-tabs">
                    <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

                        <div class="col-auto">
                            <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Toutes les réservation</button>
                        </div>

                        <div class="col-auto">
                            <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button " data-tab-target=".-tab-item-2">Complètes</button>
                        </div>

                        <div class="col-auto">
                            <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button " data-tab-target=".-tab-item-3">Confirmés</button>
                        </div>

                        <div class="col-auto">
                            <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button " data-tab-target=".-tab-item-4">En cours de traitement</button>
                        </div>

                        <div class="col-auto">
                            <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button " data-tab-target=".-tab-item-5">Annulés</button>
                        </div>


                    </div>

                    <div class="tabs__content pt-30 js-tabs-content">

                        <div class="tabs__pane -tab-item-1 is-tab-el-active">
                            <div class="overflow-scroll scroll-bar-1">
                                <table class="table-3 -border-bottom col-12">
                                    <thead class="bg-light-2">
                                    <tr>
                                        <th>Titre</th>
                                        <th>Date de reservation</th>
                                        <th>Dates réservés</th>
                                        <th>Nombres heures réservés</th>
                                        <th>Total</th>
                                        <th>Payé</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>Bleu studio</td>
                                        <td>04/04/2025</td>
                                        <td class="lh-16">Début : 06/04/2025 à 20:00<br> Fin : 07/04/2025 à 02:00</td>
                                        <td class="fw-500">6h</td>
                                        <td class="fw-500">180€ </td>
                                        <td class="fw-500">180€ </td>
                                        <td><span class="rounded-100 py-4 px-10 text-center text-14 fw-500 bg-yellow-4 text-yellow-3">En attente</span></td>

                                        <td>
                                            <div class="dropdown js-dropdown js-actions-1-active">
                                                <div class="dropdown__button d-flex items-center rounded-4 text-blue-1 bg-blue-1-05 text-14 px-15 py-5" data-el-toggle=".js-actions-1-toggle" data-el-toggle-active=".js-actions-1-active">
                                                    <span class="js-dropdown-title">Actions</span>
                                                    <i class="icon icon-chevron-sm-down text-7 ml-10"></i>
                                                </div>

                                                <div class="toggle-element -dropdown-2 js-click-dropdown js-actions-1-toggle">
                                                    <div class="text-14 fw-500 js-dropdown-list">

                                                        <div><a href="#" class="d-block js-dropdown-link">Details</a></div>

                                                        <div><a href="#" class="d-block js-dropdown-link">Facture</a></div>

                                                        <div><a href="#" class="d-block js-dropdown-link">Confirmer</a></div>

                                                        <div><a href="#" class="d-block js-dropdown-link">Annuler</a></div>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

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

                                    <div class="size-40 flex-center rounded-full size-40 flex-center rounded-full bg-dark-1 text-white">1</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full bg-light-2">2</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">3</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">4</div>

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
            </div>
        </div>
    </div>
</div>
