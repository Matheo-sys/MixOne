<section>
    <div class="relative container">
        <div class="row justify-end">
            <div class="col-xl-5 col-lg-7">
                <div class="map-form px-40 pt-40 pb-50 lg:px-30 lg:py-30 md:px-24 md:py-24 bg-white rounded-4 shadow-4">
                    @if(session('success'))
                        <div id="success-message" style="background: #d4edda;color: #155724;padding: 15px;border: 1px solid #c3e6cb;border-radius: 8px; margin-bottom: 20px;display: flex;align-items: center;">
                            <svg style="width: 20px; height: 20px; margin-right: 10px;" viewBox="0 0 24 24" fill="#155724">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Messages d'erreur -->
                        @if ($errors->any())
                            <div style="background: #f8d7da;color: #721c24;padding: 15px;border: 1px solid #f5c6cb;border-radius: 8px;margin-bottom: 20px;">
                                <ul style="margin: 0; padding-left: 20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation pour le message de succès
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            // Initial state
            successMessage.style.opacity = '0';
            successMessage.style.transform = 'translateY(20px)';
            successMessage.style.transition = 'all 0.5s ease';

            // Animate in
            setTimeout(() => {
                successMessage.style.opacity = '1';
                successMessage.style.transform = 'translateY(0)';
            }, 100);

            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                successMessage.style.opacity = '0';
                successMessage.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 500);
            }, 5000);
        }
    });
</script>


