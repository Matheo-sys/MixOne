/**
 * Composant du Widget de Messagerie
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const widget = document.getElementById('messaging-widget');
        if (!widget) return;

        // Configuration récupérée via les attributs data
        const config = {
            currentUserId: widget.getAttribute('data-user-id') ? parseInt(widget.getAttribute('data-user-id')) : null,
            csrfToken: widget.getAttribute('data-csrf')
        };

        // Si l'utilisateur n'est pas connecté, on masque le widget
        if (!config.currentUserId) {
            widget.style.display = 'none';
            return;
        }

        // Éléments du DOM
        const button = document.getElementById('messaging-button');
        const chatWindow = document.getElementById('messaging-window');
        const closeBtn = document.getElementById('close-messaging');
        const conversationList = document.getElementById('conversation-list');
        const activeChat = document.getElementById('active-chat');
        const backBtn = document.getElementById('back-to-list');
        const messageHistory = document.getElementById('message-history');
        const sendForm = document.getElementById('send-message-form');
        const messageInput = document.getElementById('message-text');
        const receiverInput = document.getElementById('receiver-id');
        const partnerName = document.getElementById('chat-partner-name');
        const partnerAvatar = document.getElementById('chat-partner-avatar');

        const showSearchBtn = document.getElementById('show-search');
        const searchInterface = document.getElementById('search-interface');
        const searchInput = document.getElementById('user-search-input');
        const searchResults = document.getElementById('search-results');
        const cancelSearchBtn = document.getElementById('cancel-search');
        const notificationBadge = document.querySelector('.notification-badge');

        // Nouveaux éléments DOM pour Bloquer et Signaler
        const showBlockedUsersBtn = document.getElementById('show-blocked-users');
        const blockedUsersInterface = document.getElementById('blocked-users-interface');
        const blockedUsersList = document.getElementById('blocked-users-list');
        const closeBlockedUsersBtn = document.getElementById('close-blocked-users');

        const chatOptionsBtn = document.getElementById('chat-options-btn');
        const chatOptionsMenu = document.getElementById('chat-options-menu');
        const btnBlockUser = document.getElementById('btn-block-user');
        const btnReportUser = document.getElementById('btn-report-user');
        
        const reportInterface = document.getElementById('report-interface');
        const cancelReportBtn = document.getElementById('cancel-report');
        const reportUserForm = document.getElementById('report-user-form');
        const reportReason = document.getElementById('report-reason');
        const customReasonContainer = document.getElementById('custom-reason-container');
        const reportTargetId = document.getElementById('report-target-id');
        const reportCustomReason = document.getElementById('report-custom-reason');
        
        const blockedStatusArea = document.getElementById('blocked-status-area');

        let messages = [];
        let hiddenContacts = [];
        let blockedContacts = [];
        let editingMessageId = null;
        let searchTimeout;

        // Ouvrir/Fermer la fenêtre de chat
        button.addEventListener('click', () => {
            chatWindow.classList.toggle('d-none');
            if (!chatWindow.classList.contains('d-none')) {
                loadMessages();
                markAllAsRead();
            }
        });

        closeBtn.addEventListener('click', () => chatWindow.classList.add('d-none'));

        // Retour à la liste des conversations
        backBtn.addEventListener('click', () => {
            activeChat.classList.add('d-none');
            chatOptionsMenu.classList.add('d-none');
            conversationList.classList.remove('d-none');
        });

        // Toggle du menu des options dans un chat
        chatOptionsBtn.addEventListener('click', () => {
            chatOptionsMenu.classList.toggle('d-none');
        });

        // Fermer le menu si on clique ailleurs
        document.addEventListener('click', (e) => {
            if (!chatOptionsBtn.contains(e.target) && !chatOptionsMenu.contains(e.target)) {
                chatOptionsMenu.classList.add('d-none');
            }
        });

        // Logique de recherche d'utilisateurs
        showSearchBtn.addEventListener('click', () => {
            conversationList.classList.add('d-none');
            activeChat.classList.add('d-none');
            searchInterface.classList.remove('d-none');
            searchInput.focus();
        });

        cancelSearchBtn.addEventListener('click', () => {
            searchInterface.classList.add('d-none');
            conversationList.classList.remove('d-none');
            searchInput.value = '';
            searchResults.innerHTML = '';
        });

        searchInput.addEventListener('input', () => {
            clearTimeout(searchTimeout);
            const query = searchInput.value.trim();
            if (query.length < 2) {
                searchResults.innerHTML = '';
                return;
            }

            searchTimeout = setTimeout(async () => {
                try {
                    const response = await fetch(`/tableau-de-bord/api/utilisateurs/rechercher?q=${encodeURIComponent(query)}`);
                    const users = await response.json();
                    renderSearchResults(users);
                } catch (error) {
                    console.error('Erreur lors de la recherche :', error);
                }
            }, 300);
        });

        // --- Logique pour Utilisateurs Bloqués ---
        showBlockedUsersBtn.addEventListener('click', () => {
            conversationList.classList.add('d-none');
            activeChat.classList.add('d-none');
            searchInterface.classList.add('d-none');
            blockedUsersInterface.classList.remove('d-none');
            loadBlockedUsers();
        });

        closeBlockedUsersBtn.addEventListener('click', () => {
            blockedUsersInterface.classList.add('d-none');
            conversationList.classList.remove('d-none');
        });

        async function loadBlockedUsers() {
            blockedUsersList.innerHTML = '<div class="text-center py-20 text-light-1">Chargement...</div>';
            try {
                const res = await fetch('/tableau-de-bord/message/blocked-users');
                const users = await res.json();
                
                if (users.length === 0) {
                    blockedUsersList.innerHTML = '<div class="text-center py-15 text-light-1">Aucun utilisateur bloqué</div>';
                    return;
                }

                blockedUsersList.innerHTML = users.map(user => {
                    const display = formatUserDisplay(user);
                    return `
                    <div style="padding: 10px 20px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f0f0f0;">
                        <div style="display: flex; align-items: center;">
                            <img src="${user.avatar ? '/storage/' + user.avatar : '/media/img/misc/avatar-default.png'}" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                            <div>
                                <div style="font-weight: 500; color: #051036; font-size: 14px;">${display.name}</div>
                                ${display.username ? `<span style="font-size: 12px; color: #777;">${display.username}</span>` : ''}
                            </div>
                        </div>
                        <button class="js-unblock-user text-12 text-blue-1 fw-500" data-id="${user.id}" style="background: none; border: none; cursor: pointer;">Débloquer</button>
                    </div>
                `}).join('');

                blockedUsersList.querySelectorAll('.js-unblock-user').forEach(btn => {
                    btn.addEventListener('click', async (e) => {
                        const targetId = e.target.dataset.id;
                        await fetch('/tableau-de-bord/message/unblock', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': config.csrfToken
                            },
                            body: JSON.stringify({ user_id: targetId })
                        });
                        // Retirer de la liste locale et recharger
                        blockedContacts = blockedContacts.filter(id => id != targetId);
                        loadBlockedUsers();
                        loadMessages(); // Recharger pour réafficher la conversation
                    });
                });
            } catch (err) {
                console.error("Erreur chargement bloqués :", err);
                blockedUsersList.innerHTML = '<div class="text-center py-15 text-red-1">Erreur de chargement</div>';
            }
        }

        // --- Logique pour Bloquer un utilisateur ---
        btnBlockUser.addEventListener('click', () => {
            const targetId = receiverInput.value;
            chatOptionsMenu.classList.add('d-none');
            
            Swal.fire({
                title: 'Bloquer cet utilisateur ?',
                text: "Vous ne pourrez plus communiquer avec lui.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3554D1',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, bloquer',
                cancelButtonText: 'Annuler',
                customClass: {
                    container: 'mixone-swal-container'
                }
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const res = await fetch('/tableau-de-bord/message/block', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': config.csrfToken
                            },
                            body: JSON.stringify({ user_id: targetId })
                        });
                        
                        if (res.ok) {
                            Swal.fire({
                                title: 'Succès !',
                                text: 'Utilisateur bloqué.',
                                icon: 'success',
                                confirmButtonColor: '#3554D1'
                            });
                            blockedContacts.push(parseInt(targetId));
                            activeChat.classList.add('d-none');
                            conversationList.classList.remove('d-none');
                            loadMessages();
                        }
                    } catch (err) {
                        console.error("Erreur de blocage :", err);
                    }
                }
            });
        });

        // --- Logique pour Signaler un utilisateur ---
        btnReportUser.addEventListener('click', () => {
            chatOptionsMenu.classList.add('d-none');
            reportTargetId.value = receiverInput.value;
            reportReason.value = '';
            reportCustomReason.value = '';
            customReasonContainer.classList.add('d-none');
            reportCustomReason.removeAttribute('required');
            activeChat.classList.add('d-none'); // On cache le chat actif
            reportInterface.classList.remove('d-none'); // On affiche le signalement
        });

        cancelReportBtn.addEventListener('click', (e) => {
            e.preventDefault();
            reportInterface.classList.add('d-none');
            activeChat.classList.remove('d-none'); // On réaffiche le chat
        });

        reportReason.addEventListener('change', (e) => {
            if (e.target.value === 'Autre') {
                customReasonContainer.classList.remove('d-none');
                reportCustomReason.setAttribute('required', 'required');
            } else {
                customReasonContainer.classList.add('d-none');
                reportCustomReason.removeAttribute('required');
            }
        });

        reportUserForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const payload = {
                reported_id: reportTargetId.value,
                reason: reportReason.value,
                custom_reason: reportCustomReason.value
            };

            try {
                const res = await fetch('/tableau-de-bord/message/report', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': config.csrfToken
                    },
                    body: JSON.stringify(payload)
                });
                
                if (res.ok) {
                    Swal.fire({
                        title: 'Envoyé',
                        text: "Signalement envoyé avec succès. Notre équipe va l'examiner rapidement.",
                        icon: 'success',
                        confirmButtonColor: '#3554D1'
                    });
                    reportInterface.classList.add('d-none');
                    activeChat.classList.remove('d-none');
                } else {
                    Swal.fire({
                        title: 'Erreur',
                        text: "Une erreur est survenue lors du signalement.",
                        icon: 'error',
                        confirmButtonColor: '#3554D1'
                    });
                }
            } catch (err) {
                console.error("Erreur de signalement :", err);
            }
        });

        /**
         * Helper : affiche le nom avec @username et badge profil
         */
        function formatUserDisplay(user) {
            const name = `${user.first_name} ${user.last_name}`;
            const username = user.username ? `@${user.username}` : '';
            
            let badgeColor = user.profile === 'studio' ? '#3554D1' : '#10b981';
            let badgeText = user.profile === 'studio' ? 'Studio' : 'Artiste';

            // Priorité au badge Admin
            if (user.is_admin) {
                badgeColor = '#D13535';
                badgeText = 'Admin';
            }

            const badge = `<span style="background: ${badgeColor}; color: white; font-size: 10px; padding: 2px 6px; border-radius: 10px; margin-left: 6px;">${badgeText}</span>`;
            return { name, username, badge };
        }

        /**
         * Affiche les résultats de recherche d'utilisateurs
         */
        function renderSearchResults(users) {
            searchResults.innerHTML = users.length === 0 
                ? '<div class="text-center py-15 text-light-1">Aucun utilisateur trouvé</div>'
                : users.map(user => {
                    const display = formatUserDisplay(user);
                    return `
                    <div class="conversation-item js-start-chat" data-id="${user.id}" data-name="${display.name}" data-avatar="${user.avatar}" data-is-admin="${user.is_admin ? 1 : 0}" style="padding: 10px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;">
                        <img src="${user.avatar ? '/storage/' + user.avatar : '/media/img/misc/avatar-default.png'}" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                        <div style="flex: 1;">
                            <div style="display: flex; align-items: center;">
                                <span style="font-weight: 500; color: #051036; font-size: 14px;">${display.name}</span>
                                ${display.badge}
                            </div>
                            ${display.username ? `<span style="font-size: 12px; color: #3554D1; font-weight: 500;">${display.username}</span>` : ''}
                        </div>
                    </div>
                `}).join('');

            searchResults.querySelectorAll('.js-start-chat').forEach(el => {
                el.addEventListener('click', () => {
                    startNewMessagingChat(el.dataset.id, el.dataset.name, el.dataset.avatar, el.dataset.isAdmin == "1");
                });
            });
        }

        /**
         * Lance une nouvelle conversation avec un utilisateur
         */
        const startNewMessagingChat = (userId, name, avatar, isAdmin = false) => {
            searchInterface.classList.add('d-none');
            activeChat.classList.remove('d-none');
            conversationList.classList.add('d-none');
            chatWindow.classList.remove('d-none');
            
            receiverInput.value = userId;
            partnerName.textContent = name;
            partnerAvatar.src = avatar && avatar !== 'null' ? '/storage/' + avatar : '/media/img/misc/avatar-default.png';
            
            // Masquer le bouton d'options (Signaler/Bloquer) si c'est un admin
            if (isAdmin) {
                chatOptionsBtn.classList.add('d-none');
            } else {
                chatOptionsBtn.classList.remove('d-none');
            }

            // Vérification si l'utilisateur est bloqué
            if (blockedContacts.includes(parseInt(userId))) {
                sendForm.classList.add('d-none');
                blockedStatusArea.classList.remove('d-none');
            } else {
                sendForm.classList.remove('d-none');
                blockedStatusArea.classList.add('d-none');
            }

            renderMessages(parseInt(userId));
        };

        window.startNewMessagingChat = startNewMessagingChat;

        /**
         * Charge tous les messages de l'utilisateur
         */
        async function loadMessages() {
            try {
                const response = await fetch('/tableau-de-bord/message');
                const data = await response.json();
                messages = data.messages || [];
                hiddenContacts = data.hidden_contacts || [];
                blockedContacts = data.blocked_contacts || [];
                renderConversations();
            } catch (error) {
                console.error('Erreur chargement messages :', error);
            }
        }

        /**
         * Récupère le nombre de messages non lus
         */
        async function fetchUnreadCount() {
            try {
                if (chatWindow.classList.contains('d-none')) {
                    const response = await fetch('/tableau-de-bord/message/nombre-non-lus');
                    const data = await response.json();
                    if (data.count > 0) {
                        notificationBadge.textContent = data.count;
                        notificationBadge.classList.remove('d-none');
                    } else {
                        notificationBadge.classList.add('d-none');
                    }
                }
            } catch (error) {
                console.error('Erreur nombre non lus :', error);
            }
        }

        /**
         * Marque tous les messages comme lus
         */
        async function markAllAsRead() {
            try {
                await fetch('/tableau-de-bord/message/lire', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': config.csrfToken
                    }
                });
                notificationBadge.classList.add('d-none');
            } catch (error) {
                console.error('Erreur lecture messages :', error);
            }
        }

        /**
         * Masque (supprime visuellement) une conversation
         */
        async function hideConversation(contactId) {
            const idToHide = isNaN(contactId) ? contactId : parseInt(contactId);
            
            // Optimistic UI : on cache tout de suite
            hiddenContacts.push(idToHide);
            renderConversations();

            try {
                const res = await fetch(`/tableau-de-bord/message/masquer/${contactId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': config.csrfToken
                    }
                });
                
                if (!res.ok) {
                    // Rollback si erreur serveur
                    hiddenContacts = hiddenContacts.filter(id => id !== idToHide);
                    renderConversations();
                }
            } catch (error) {
                console.error('Erreur masquage conversation :', error);
                // Rollback si erreur réseau
                hiddenContacts = hiddenContacts.filter(id => id !== idToHide);
                renderConversations();
            }
        };

        /**
         * Formate la date d'un message en texte lisible
         */
        function formatMessageDate(dateString) {
            const date = new Date(dateString);
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);

            const isToday = date.getDate() === today.getDate() && date.getMonth() === today.getMonth() && date.getFullYear() === today.getFullYear();
            const isYesterday = date.getDate() === yesterday.getDate() && date.getMonth() === yesterday.getMonth() && date.getFullYear() === yesterday.getFullYear();

            const time = date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            if (isToday) {
                return `Aujourd'hui à ${time}`;
            } else if (isYesterday) {
                return `Hier à ${time}`;
            } else {
                const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
                return `Le ${date.toLocaleDateString('fr-FR', options)} à ${time}`;
            }
        }

        /**
         * Affiche la liste des conversations (utilisateurs avec qui on a discuté)
         */
        function renderConversations() {
            const conversations = {};
            messages.forEach(msg => {
                const otherUser = msg.sender_id === config.currentUserId ? msg.receiver : msg.sender;
                if (!otherUser) return;
                
                if (!conversations[otherUser.id] || new Date(msg.created_at) > new Date(conversations[otherUser.id].lastMessage.created_at)) {
                    conversations[otherUser.id] = {
                        user: otherUser,
                        lastMessage: msg
                    };
                }
            });

            const visibleConvs = Object.values(conversations).filter(conv => !hiddenContacts.includes(conv.user.id));

            conversationList.innerHTML = visibleConvs.length === 0 
                ? '<div style="text-align: center; padding: 20px; color: #777;">Aucune conversation</div>'
                : visibleConvs.map(conv => {
                    const display = formatUserDisplay(conv.user);
                    return `
                    <div class="conversation-item js-conv-item" data-id="${conv.user.id}" data-name="${display.name}" data-avatar="${conv.user.avatar}" data-is-admin="${conv.user.is_admin ? 1 : 0}" style="padding: 15px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;">
                        <img src="${conv.user.avatar ? '/storage/' + conv.user.avatar : '/media/img/misc/avatar-default.png'}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                        <div style="flex: 1; overflow: hidden;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3px;">
                                <div style="display: flex; align-items: center; overflow: hidden;">
                                    <span style="font-weight: 500; color: #051036; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${display.name}</span>
                                    ${display.badge}
                                </div>
                                <div style="display: flex; align-items: center; flex-shrink: 0;">
                                    <span style="font-size: 10px; color: #777; margin-right: 8px;">${formatMessageDate(conv.lastMessage.created_at)}</span>
                                    <div class="js-hide-conv" data-id="${conv.user.id}" style="color: #bbb; cursor: pointer; padding: 2px;">
                                        <i class="icon-trash" style="font-size: 12px;"></i>
                                    </div>
                                </div>
                            </div>
                            ${display.username ? `<div style="font-size: 11px; color: #3554D1; font-weight: 500; margin-bottom: 3px;">${display.username}</div>` : ''}
                            <p style="font-size: 12px; color: #777; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0;">${conv.lastMessage.message}</p>
                        </div>
                    </div>
                `}).join('');

            conversationList.querySelectorAll('.js-conv-item').forEach(el => {
                el.addEventListener('click', (e) => {
                    if (e.target.closest('.js-hide-conv')) return;
                    startNewMessagingChat(el.dataset.id, el.dataset.name, el.dataset.avatar, el.dataset.isAdmin == "1");
                });
            });

            conversationList.querySelectorAll('.js-hide-conv').forEach(el => {
                el.addEventListener('click', (e) => {
                    e.stopPropagation();
                    hideConversation(el.dataset.id);
                });
            });
        }

        /**
         * Affiche l'historique des messages d'une conversation spécifique
         */
        function renderMessages(otherUserId) {
            const filteredMessages = messages.filter(msg => 
                msg.sender_id === otherUserId || msg.receiver_id === otherUserId
            );

            messageHistory.innerHTML = filteredMessages.map(msg => `
                <div class="message-bubble ${msg.sender_id === config.currentUserId ? 'sent' : 'received'}">
                    <div class="message-content">${msg.message}
                        ${msg.sender_id === config.currentUserId && ((new Date() - new Date(msg.created_at)) / 1000 / 60 <= 10) ? `
                            <div class="js-edit-msg" data-id="${msg.id}" style="position:absolute; right: -20px; top: 0; cursor: pointer; color: #bbb; display: ${msg.id ? 'block' : 'none'};">
                                <i class="icon-edit" style="font-size: 10px;"></i>
                            </div>
                        ` : ''}
                    </div>
                    <div class="message-time">
                        ${msg.is_edited ? '<span style="font-style: italic; opacity: 0.7; margin-right: 4px;">(modifié)</span>' : ''}
                        ${formatMessageDate(msg.created_at)}
                    </div>
                </div>
            `).join('');
            
            messageHistory.querySelectorAll('.js-edit-msg').forEach(el => {
                el.addEventListener('click', () => {
                    startEditMessage(parseInt(el.dataset.id));
                });
            });

            messageHistory.scrollTop = messageHistory.scrollHeight;
        }

        /**
         * Initialise l'édition d'un message existant
         */
        function startEditMessage(id) {
            const msg = messages.find(m => m.id === id);
            if (msg) {
                const msgDate = new Date(msg.created_at);
                if ((new Date() - msgDate) / 1000 / 60 > 10) {
                    Swal.fire({
                        title: 'Délai dépassé',
                        text: "Ce message a été envoyé il y a plus de 10 minutes et ne peut plus être modifié.",
                        icon: 'info',
                        confirmButtonColor: '#3554D1'
                    });
                    return;
                }
                editingMessageId = id;
                messageInput.value = msg.message;
                messageInput.focus();
                messageInput.dispatchEvent(new Event('input'));
            }
        };

        // Redimensionnement automatique de la zone de texte
        messageInput.addEventListener('input', function() {
            this.style.height = '40px'; 
            const newHeight = Math.min(this.scrollHeight, 120);
            this.style.height = newHeight + 'px';
            this.style.overflowY = this.scrollHeight > 120 ? 'auto' : 'hidden';
        });

        // Envoi sur la touche Entrée (sauf si Shift est maintenu)
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendForm.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
            }
        });

        // Envoi du message (Création ou Mise à jour)
        sendForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const text = messageInput.value.trim();
            const receiverId = receiverInput.value;

            if (!text || !receiverId) return;

            const nowIso = new Date().toISOString();
            const originalMessageText = editingMessageId ? messages.find(m => m.id === editingMessageId)?.message : null;

            if (editingMessageId) {
                const msgIndex = messages.findIndex(m => m.id === editingMessageId);
                if (msgIndex !== -1) {
                    messages[msgIndex].message = text;
                    messages[msgIndex].is_edited = true;
                }
            } else {
                messages.push({
                    sender_id: config.currentUserId,
                    receiver_id: parseInt(receiverId),
                    message: text,
                    created_at: nowIso,
                    is_read: false,
                    is_edited: false,
                    sender: null,
                    receiver: null
                });
            }

            const currentEditId = editingMessageId;
            editingMessageId = null;

            messageInput.value = '';
            messageInput.style.height = '40px'; 
            renderMessages(parseInt(receiverId));

            try {
                const endpoint = currentEditId ? `/tableau-de-bord/message/${currentEditId}` : '/tableau-de-bord/message';
                const method = currentEditId ? 'PUT' : 'POST';

                const response = await fetch(endpoint, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': config.csrfToken
                    },
                    body: JSON.stringify({
                        receiver_id: receiverId,
                        message: text
                    })
                });

                if (!response.ok) {
                    if (currentEditId) {
                        const msgIndex = messages.findIndex(m => m.id === currentEditId);
                        if (msgIndex !== -1) {
                            messages[msgIndex].message = originalMessageText;
                            messages[msgIndex].is_edited = false; 
                        }
                    }
                    await loadMessages();
                    renderMessages(parseInt(receiverId));
                }
            } catch (error) {
                console.error('Erreur lors de l\'envoi :', error);
                await loadMessages();
                renderMessages(parseInt(receiverId));
            }
        });

        // Rafraîchissement périodique
        setInterval(() => {
            if (!chatWindow.classList.contains('d-none')) {
                loadMessages().then(() => {
                    if (!activeChat.classList.contains('d-none')) {
                        renderMessages(parseInt(receiverInput.value));
                    }
                });
            } else {
                fetchUnreadCount();
            }
        }, 10000);

        fetchUnreadCount();
    });
})();
