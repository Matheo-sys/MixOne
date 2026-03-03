/**
 * Global AJAX Form Handler - MixOne
 * Intercepts all forms with .js-ajax-form class
 */

// Toast container (injected by backendDB layout)
function showToast(type, message) {
    const container = document.getElementById('toast-container');
    if (!container) {
        // Fallback for non-dashboard pages: create container on the fly
        const fallback = document.createElement('div');
        fallback.id = 'toast-container';
        fallback.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999;pointer-events:none;';
        document.body.appendChild(fallback);
    }

    const c = document.getElementById('toast-container');
    const isSuccess = type === 'success';
    const toast = document.createElement('div');
    toast.style.cssText = [
        'display:flex;align-items:center;gap:10px;',
        'padding:14px 20px;margin-bottom:10px;border-radius:8px;',
        'box-shadow:0 4px 20px rgba(0,0,0,.15);',
        'pointer-events:auto;cursor:pointer;',
        'transition:opacity .4s,transform .4s;opacity:0;transform:translateX(20px);',
        isSuccess
            ? 'background:#3554d1;color:#fff;'
            : 'background:#dd2727;color:#fff;'
    ].join('');

    toast.innerHTML = `
        <i class="icon-${isSuccess ? 'check' : 'close'}" style="font-size:16px;flex-shrink:0"></i>
        <span style="font-size:14px;font-weight:500">${message}</span>
    `;
    c.appendChild(toast);

    // Animate in
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(0)';
        });
    });

    // Dismiss after 4s or on click
    const dismiss = () => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(20px)';
        setTimeout(() => toast.remove(), 400);
    };
    toast.addEventListener('click', dismiss);
    setTimeout(dismiss, 4000);
}

function clearFormErrors(form) {
    form.querySelectorAll('.ajax-error').forEach(el => el.remove());
    form.querySelectorAll('.is-error').forEach(el => el.classList.remove('is-error'));
}

function showValidationErrors(form, errors) {
    Object.keys(errors).forEach(field => {
        const input = form.querySelector(`[name="${field}"]`);
        if (input) {
            const wrapper = input.closest('.form-input') || input.parentElement;
            if (wrapper) wrapper.classList.add('is-error');
            const msg = document.createElement('div');
            msg.className = 'text-12 text-red-1 mt-5 ajax-error';
            msg.textContent = errors[field][0];
            (wrapper || input.parentElement).after(msg);
        }
    });
}

async function handleAjaxForm(form) {
    const submitBtn = form.querySelector('[type="submit"]');
    const originalHtml = submitBtn ? submitBtn.innerHTML : '';

    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span style="display:inline-block;width:16px;height:16px;border:2px solid rgba(255,255,255,.5);border-top-color:#fff;border-radius:50%;animation:spin .7s linear infinite;vertical-align:middle"></span> Envoi…';
    }

    clearFormErrors(form);

    // Build FormData (handles files + fields)
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

        const data = await response.json();

        if (response.ok) {
            showToast('success', data.message || 'Opération réussie');

            // Reset form if requested
            if (form.hasAttribute('data-reset')) form.reset();

            // Update avatar across header if returned
            if (data.avatar_url) {
                document.querySelectorAll('.header-avatar,[data-avatar]').forEach(img => {
                    img.src = data.avatar_url + '?t=' + Date.now();
                });
            }

            // If server tells us to redirect (e.g. reservation success)
            if (data.redirect) {
                setTimeout(() => { window.location.href = data.redirect; }, 1200);
                return;
            }

            // If the form action involves reservation confirm/cancel, update the row
            if (data.new_status) {
                updateReservationRow(form, data.new_status);
            }

        } else if (response.status === 422) {
            if (data.errors) {
                showValidationErrors(form, data.errors);
            }
            showToast('error', data.message || 'Veuillez corriger les erreurs.');
        } else {
            showToast('error', data.message || 'Une erreur est survenue.');
        }

    } catch (err) {
        console.error('AJAX Error:', err);
        showToast('error', 'Erreur de connexion. Veuillez réessayer.');
    } finally {
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHtml;
        }
    }
}

/**
 * Dynamically update a reservation row status badge after confirm/cancel
 */
function updateReservationRow(form, newStatus) {
    const row = form.closest('tr');
    if (!row) return;

    // Update the status badge
    const badge = row.querySelector('.rounded-100');
    if (badge) {
        badge.textContent = newStatus;
        // Remove all possible status classes and apply the new one
        const colorMap = {
            'Confirmée': 'bg-blue-1-05',
            'En attente': 'bg-yellow-4',
            'Annulée': 'text-red-1',
        };
        Object.values(colorMap).forEach(c => badge.classList.remove(c));
        if (colorMap[newStatus]) badge.classList.add(colorMap[newStatus]);
    }

    // Remove only the submitted form from the dropdown (not the whole row)
    form.remove();
}

// Add spin keyframe once
if (!document.getElementById('ajax-spin-style')) {
    const s = document.createElement('style');
    s.id = 'ajax-spin-style';
    s.textContent = '@keyframes spin{to{transform:rotate(360deg)}}';
    document.head.appendChild(s);
}

// Main listener — intercept ALL .js-ajax-form submissions
document.addEventListener('submit', function (e) {
    if (e.target.classList.contains('js-ajax-form')) {
        e.preventDefault();
        e.stopPropagation();
        handleAjaxForm(e.target);
    }
}, true);
