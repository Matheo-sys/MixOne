<div class="dashboard__sidebar bg-white scroll-bar-1">


    <div class="sidebar -dashboard">

        <div class="sidebar__item">
            <div class="sidebar__button -is-active">
                <a href={{route('dashboard')}} class="d-flex items-center text-15 lh-1 fw-500 ">
                    <img src={{asset("media/img/dashboard/sidebar/booking.svg")}} alt="image" class="mr-15">
                    Historique des réservations
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button ">
                <a href={{route('dashboardWishlist')}} class="d-flex items-center text-15 lh-1 fw-500">
                    <img src={{asset("media/img/dashboard/sidebar/bookmark.svg")}} alt="image" class="mr-15">
                    Liste d'envie
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button ">
                <a href={{route('dashboardSettings')}} class="d-flex items-center text-15 lh-1 fw-500">
                    <img src={{asset("media/img/dashboard/sidebar/gear.svg")}} alt="image" class="mr-15">
                    Paramètres
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button ">
                <a href="/" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"
                   class="d-flex items-center text-15 lh-1 fw-500">
                    <img src={{asset("media/img/dashboard/sidebar/log-out.svg")}} alt="image" class="mr-15">
                    Se déconnecter
                </a>
            </div>
        </div>

    </div>


</div>
