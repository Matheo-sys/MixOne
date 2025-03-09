<section>
    <div class="relative container">
        <div class="row justify-end">
            <div class="col-xl-5 col-lg-7">
                <div class="map-form px-40 pt-40 pb-50 lg:px-30 lg:py-30 md:px-24 md:py-24 bg-white rounded-4 shadow-4">
                    <div class="text-22 fw-500">
                        Envoyez-nous un message
                    </div>

                    <form action="{{ route('send.email') }}" method="POST">
                        @csrf
                        <div class="row y-gap-20 pt-20">
                            <div class="col-12">
                                <div class="form-input">
                                    <input type="text" name="name" required>
                                    <label class="lh-1 text-16 text-light-1">Nom prénom</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input">
                                    <input type="email" name="email" required>
                                    <label class="lh-1 text-16 text-light-1">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input">
                                    <input type="text" name="subject" required>
                                    <label class="lh-1 text-16 text-light-1">Sujet</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input">
                                    <textarea name="message" required rows="4"></textarea>
                                    <label class="lh-1 text-16 text-light-1">Votre message</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="button px-24 h-50 -dark-1 bg-blue-1 text-white">
                                    Envoyer <div class="icon-arrow-top-right ml-15"></div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
