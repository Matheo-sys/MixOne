<div class="dashboard__sidebar bg-white scroll-bar-1">

    <div class="sidebar -dashboard">

        <div class="sidebar__item ">


            <a href="/" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
                <img src={{asset("media/img/dashboard/sidebar/compass.svg")}} alt="image" class="mr-15">
                Dashboard
            </a>


        </div>

        <div class="sidebar__item ">


            <a href='/dashboard/studio/booking' class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
                <img src={{asset("media/img/dashboard/sidebar/booking.svg")}} alt="image" class="mr-15">
                Réservations
            </a>


        </div>

        <div class="sidebar__item ">


            <div class="accordion -db-sidebar js-accordion">
                <div class="accordion__item">
                    <div class="accordion__button">
                        <div class="sidebar__button col-12 d-flex items-center justify-between">
                            <div class="d-flex items-center text-15 lh-1 fw-500">
                                <img src={{asset("media/img/dashboard/sidebar/hotel.svg")}} alt="image" class="mr-10">
                                Gestion Studio
                            </div>
                            <div class="icon-chevron-sm-down text-7"></div>
                        </div>
                    </div>

                    <div class="accordion__content">
                        <ul class="list-disc pt-15 pb-5 pl-40">

                            <li>
                                <a href="/dashboard/studio/list" class="text-15">Tous mes studios</a>
                            </li>

                            <li>
                                <a href="/dashboard/studio/create" class="text-15">Ajouter un studio</a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>


        </div>

        <div class="sidebar__item">
            <div class="sidebar__button ">
                <a href="/dashboard/settings" class="d-flex items-center text-15 lh-1 fw-500">
                    <img src={{asset("media/img/dashboard/sidebar/gear.svg")}} alt="image" class="mr-15">
                    Paramètres
                </a>
            </div>
        </div>

        <div class="sidebar__item ">


            <a href="/" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
                <img src={{asset("media/img/dashboard/sidebar/log-out.svg")}} alt="image" class="mr-15">
                Logout
            </a>


        </div>

    </div>

</div>
