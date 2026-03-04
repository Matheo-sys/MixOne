/**
 * Global AJAX Form Handler - MixOne
 * Gestion complète des formulaires avec retours d'erreurs visuels en français
 */

// ─── Toast Notification ──────────────────────────────────────────────────────
function showToast(type, message) {
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        container.style.cssText = 'position:fixed;top:20px;right:20px;z-index:99999;pointer-events:none;display:flex;flex-direction:column;gap:8px;';
        document.body.appendChild(container);
    }

    const isSuccess = type === 'success';
    const isWarning = type === 'warning';

    let bg = '#dd2727'; // rouge - erreur
    if (isSuccess) bg = '#3554d1'; // bleu - succès
    if (isWarning) bg = '#f59e0b'; // orange - warning

    const iconMap = { success: 'check', error: 'close', warning: 'notification' };
    const icon = iconMap[type] || 'close';

    const toast = document.createElement('div');
    toast.style.cssText = [
        'display:flex;align-items:flex-start;gap:12px;',
        `padding:14px 18px;border-radius:10px;max-width:380px;`,
        'box-shadow:0 8px 30px rgba(0,0,0,.18);',
        'pointer-events:auto;cursor:pointer;',
        'transition:opacity .4s,transform .4s;opacity:0;transform:translateX(30px);',
        `background:${bg};color:#fff;`,
    ].join('');

    toast.innerHTML = `
        <i class="icon-${icon}" style="font-size:16px;flex-shrink:0;margin-top:2px;"></i>
        <span style="font-size:14px;font-weight:500;line-height:1.4;">${message}</span>
    `;
    container.appendChild(toast);

    requestAnimationFrame(() => requestAnimationFrame(() => {
        toast.style.opacity = '1';
        toast.style.transform = 'translateX(0)';
    }));

    const dismiss = () => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(30px)';
        setTimeout(() => toast.remove(), 400);
    };
    toast.addEventListener('click', dismiss);
    setTimeout(dismiss, type === 'error' ? 6000 : 4000);
}

// ─── Nettoyage des erreurs ────────────────────────────────────────────────────
function clearFormErrors(form) {
    form.querySelectorAll('.ajax-error').forEach(el => el.remove());
    form.querySelectorAll('.ajax-error-summary').forEach(el => el.remove());
    form.querySelectorAll('.is-error input, .is-error textarea, .is-error select').forEach(el => {
        el.style.borderColor = '';
    });
    form.querySelectorAll('.is-error').forEach(el => el.classList.remove('is-error'));
}

// ─── Affichage des erreurs sous les champs ───────────────────────────────────
function showValidationErrors(form, errors) {
    const errorKeys = Object.keys(errors);

    errorKeys.forEach(field => {
        // Essaie de trouver le champ par name (y compris name="field[]" ou name="field[key]")
        let input = form.querySelector(`[name="${field}"]`)
            || form.querySelector(`[name="${field}[]"]`);

        const msg = Array.isArray(errors[field]) ? errors[field][0] : errors[field];

        if (input) {
            const wrapper = input.closest('.form-input')
                || input.closest('.form-group')
                || input.closest('.searchMenu-guests')
                || input.parentElement;

            if (wrapper) {
                wrapper.classList.add('is-error');
                // Bordure rouge sur l'input
                input.style.borderColor = '#dd2727';
            }

            // Injecte le message d'erreur après le wrapper (ou parent)
            const errorDiv = document.createElement('div');
            errorDiv.className = 'ajax-error';
            errorDiv.style.cssText = 'color:#dd2727;font-size:12px;font-weight:500;margin-top:5px;display:flex;align-items:center;gap:5px;';
            errorDiv.innerHTML = `<i class="icon-close" style="font-size:10px;background:#dd2727;color:#fff;border-radius:50%;padding:2px;flex-shrink:0;"></i> ${msg}`;

            const insertAfter = wrapper || input.parentElement;
            insertAfter.insertAdjacentElement('afterend', errorDiv);
        }
    });

    // Si plusieurs erreurs, afficher un résumé en haut du formulaire
    if (errorKeys.length > 1) {
        const summary = document.createElement('div');
        summary.className = 'ajax-error-summary';
        summary.style.cssText = [
            'background:#fff5f5;border:1px solid #ffcdd2;border-radius:8px;',
            'padding:12px 16px;margin-bottom:20px;',
        ].join('');
        summary.innerHTML = `
            <div style="display:flex;align-items:center;gap:8px;color:#dd2727;font-weight:600;margin-bottom:8px;font-size:14px;">
                <i class="icon-close" style="font-size:12px;background:#dd2727;color:#fff;border-radius:50%;padding:3px;"></i>
                ${errorKeys.length} erreur${errorKeys.length > 1 ? 's' : ''} à corriger
            </div>
            <ul style="margin:0;padding-left:20px;color:#c62828;font-size:13px;">
                ${errorKeys.map(k => {
            const m = Array.isArray(errors[k]) ? errors[k][0] : errors[k];
            return `<li>${m}</li>`;
        }).join('')}
            </ul>
        `;
        // Insérer au début du formulaire
        const firstChild = form.firstElementChild;
        form.insertBefore(summary, firstChild);
        // Scroller vers le résumé
        summary.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } else if (errorKeys.length === 1) {
        // Une seule erreur : scroller vers le champ concerné
        const firstInput = form.querySelector(`[name="${errorKeys[0]}"]`);
        if (firstInput) {
            firstInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstInput.focus();
        }
    }
}

// ─── Gestionnaire AJAX principal ──────────────────────────────────────────────
async function handleAjaxForm(form) {
    const submitBtn = form.querySelector('[type="submit"]');
    const originalHtml = submitBtn ? submitBtn.innerHTML : '';

    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span style="display:inline-flex;align-items:center;gap:8px;">
                <span style="width:16px;height:16px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;animation:ajaxSpin .7s linear infinite;display:inline-block;"></span>
                Envoi en cours…
            </span>`;
    }

    clearFormErrors(form);

    const formData = new FormData(form);
    const url = form.getAttribute('action') || window.location.pathname;
    const method = (form.getAttribute('method') || 'POST').toUpperCase();

    try {
        const response = await fetch(url, {
            method: method === 'GET' ? 'GET' : 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    || document.querySelector('[name="_token"]')?.value
                    || '',
            },
            body: method === 'GET' ? null : formData,
        });

        const data = await response.json().catch(() => ({}));

        if (response.ok) {
            showToast('success', data.message || 'Opération réussie !');

            if (form.hasAttribute('data-reset')) form.reset();

            if (data.avatar_url) {
                document.querySelectorAll('.header-avatar,[data-avatar]').forEach(img => {
                    img.src = data.avatar_url + '?t=' + Date.now();
                });
            }

            if (data.redirect) {
                setTimeout(() => { window.location.href = data.redirect; }, 1200);
                return;
            }

            if (data.new_status) {
                updateReservationRow(form, data.new_status);
            }

        } else if (response.status === 422) {
            // Erreurs de validation Laravel
            if (data.errors) {
                showValidationErrors(form, data.errors);
                const errorCount = Object.keys(data.errors).length;
                showToast('error', data.message || `Veuillez corriger les ${errorCount} erreur${errorCount > 1 ? 's' : ''} dans le formulaire.`);
            } else {
                showToast('error', data.message || 'Veuillez vérifier les informations saisies.');
            }

        } else if (response.status === 403) {
            showToast('error', data.message || 'Vous n\'êtes pas autorisé à effectuer cette action.');

        } else if (response.status === 401) {
            showToast('error', 'Vous devez être connecté pour effectuer cette action.');
            setTimeout(() => { window.location.href = '/login'; }, 2000);

        } else if (response.status === 404) {
            showToast('error', 'La ressource demandée est introuvable.');

        } else if (response.status >= 500) {
            showToast('error', 'Une erreur serveur est survenue. Veuillez réessayer dans quelques instants.');

        } else {
            showToast('error', data.message || 'Une erreur inattendue est survenue.');
        }

    } catch (err) {
        console.error('AJAX Error:', err);
        if (!navigator.onLine) {
            showToast('error', 'Pas de connexion Internet. Veuillez vérifier votre réseau.');
        } else {
            showToast('error', 'Impossible de contacter le serveur. Veuillez réessayer.');
        }
    } finally {
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHtml;
        }
    }
}

// ─── Mise à jour d'une ligne de réservation ───────────────────────────────────
function updateReservationRow(form, newStatus) {
    const row = form.closest('tr');
    if (!row) return;

    const badge = row.querySelector('.rounded-100');
    if (badge) {
        badge.textContent = newStatus;
        const colorMap = {
            'Confirmée': 'bg-blue-1-05',
            'En attente': 'bg-yellow-4',
            'Annulée': 'text-red-1',
        };
        Object.values(colorMap).forEach(c => badge.classList.remove(c));
        if (colorMap[newStatus]) badge.classList.add(colorMap[newStatus]);
    }
    form.remove();
}

// ─── Style CSS de l'animation spinner ────────────────────────────────────────
if (!document.getElementById('ajax-spin-style')) {
    const s = document.createElement('style');
    s.id = 'ajax-spin-style';
    s.textContent = `
        @keyframes ajaxSpin { to { transform: rotate(360deg); } }
        .is-error .form-input label,
        .is-error label { color: #dd2727 !important; }
        .ajax-error { animation: fadeInError .2s ease; }
        .ajax-error-summary { animation: fadeInError .3s ease; }
        @keyframes fadeInError {
            from { opacity: 0; transform: translateY(-5px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(s);
}

// ─── Écouteur global : intercepte .js-ajax-form (bubble, après les validations capture) ──
document.addEventListener('submit', function (e) {
    if (e.target.classList.contains('js-ajax-form')) {
        e.preventDefault();
        handleAjaxForm(e.target);
    }
}, false); // false = bubble phase → les validators en capture sur le form s'exécutent avant
