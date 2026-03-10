<section class="relative layout-pt-xl layout-pb-xl flex-center" style="min-height: 800px; background-image: url('{{ asset('media/img/backgrounds/11.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
    <!-- Dark gradient overlay for readability -->
    <div style="position: absolute; inset: 0; background: linear-gradient(90deg, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.6) 50%, rgba(15, 23, 42, 0.4) 100%);"></div>
    
    <div class="container relative z-2">
        <div class="row y-gap-50 justify-between items-center">
            
            <!-- Left Side: Text -->
            <div class="col-lg-5 text-white">
                <div class="d-inline-block px-20 py-10 rounded-100 bg-white-10 text-white text-14 fw-500 mb-20" style="backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                    Support 24/7
                </div>
                <h1 class="text-50 md:text-40 fw-700 text-white mb-20 lh-12">
                    Créons quelque<br><span class="text-blue-1">chose d'unique.</span>
                </h1>
                <p class="text-white text-18 md:text-16 opacity-80 mb-0">
                    Vous avez un projet d'enregistrement, de mixage ou de mastering ? Notre équipe de professionnels est là pour vous accompagner si vous avez une question.
                </p>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="col-lg-6 col-xl-5">
                <div class="bg-white rounded-16 shadow-4 px-40 py-50 md:px-24 md:py-30" style="backdrop-filter: blur(20px);">
                    <div class="text-30 fw-700 mb-10 text-dark-1">
                        Envoyez-nous un message
                    </div>
                    <p class="text-16 text-light-1 mb-30">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>

                    @if(session('success'))
                        <div id="success-message" class="alert alert-success d-flex items-center mb-30 rounded-8">
                            <i class="icon-check text-18 mr-10"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mb-30 rounded-8">
                            <ul class="list-disc pl-20">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('send.email') }}" method="POST" class="js-ajax-form" data-reset>
                        @csrf
                        <div class="row y-gap-20">
                            <div class="col-sm-6">
                                <div class="form-input custom-input">
                                    <input type="text" name="name" required class="border-light rounded-8">
                                    <label class="lh-1 text-16 text-light-1">Nom complet</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-input custom-input">
                                    <input type="email" name="email" required class="border-light rounded-8">
                                    <label class="lh-1 text-16 text-light-1">Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input custom-input">
                                    <input type="text" name="subject" required class="border-light rounded-8">
                                    <label class="lh-1 text-16 text-light-1">Sujet</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input custom-input">
                                    <textarea name="message" required rows="4" class="border-light rounded-8 p-20"></textarea>
                                    <label class="lh-1 text-16 text-light-1" style="top: 20px;">Votre message</label>
                                </div>
                            </div>
                            <div class="col-12 mt-10">
                                <button type="submit" class="button w-100 px-30 h-60 bg-blue-1 text-white fw-600 rounded-8 transition flex-center hover:opacity-80">
                                    Envoyer le message <i class="icon-arrow-top-right text-16 ml-10"></i>
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
            successMessage.style.opacity = '0';
            successMessage.style.transform = 'translateY(20px)';
            successMessage.style.transition = 'all 0.5s ease';

            setTimeout(() => {
                successMessage.style.opacity = '1';
                successMessage.style.transform = 'translateY(0)';
            }, 100);

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


