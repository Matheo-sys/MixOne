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

        let messages = [];
        let hiddenContacts = [];
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
            conversationList.classList.remove('d-none');
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

        /**
         * Helper : affiche le nom avec @username et badge profil
         */
        function formatUserDisplay(user) {
            const name = `${user.first_name} ${user.last_name}`;
            const username = user.username ? `@${user.username}` : '';
            const badgeColor = user.profile === 'studio' ? '#3554D1' : '#10b981';
            const badgeText = user.profile === 'studio' ? 'Studio' : 'Artiste';
            const badge = user.profile ? `<span style="background: ${badgeColor}; color: white; font-size: 10px; padding: 2px 6px; border-radius: 10px; margin-left: 6px;">${badgeText}</span>` : '';
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
                    <div class="conversation-item js-start-chat" data-id="${user.id}" data-name="${display.name}" data-avatar="${user.avatar}" style="padding: 10px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;">
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
                    startNewMessagingChat(el.dataset.id, el.dataset.name, el.dataset.avatar);
                });
            });
        }

        /**
         * Lance une nouvelle conversation avec un utilisateur
         */
        const startNewMessagingChat = (userId, name, avatar) => {
            searchInterface.classList.add('d-none');
            activeChat.classList.remove('d-none');
            conversationList.classList.add('d-none');
            chatWindow.classList.remove('d-none');
            
            receiverInput.value = userId;
            partnerName.textContent = name;
            partnerAvatar.src = avatar && avatar !== 'null' ? '/storage/' + avatar : '/media/img/misc/avatar-default.png';
            
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
            try {
                const res = await fetch(`/tableau-de-bord/message/masquer/${contactId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': config.csrfToken
                    }
                });
                if (res.ok) {
                    hiddenContacts.push(contactId);
                    renderConversations();
                }
            } catch (error) {
                console.error('Erreur masquage conversation :', error);
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
                    <div class="conversation-item js-conv-item" data-id="${conv.user.id}" data-name="${display.name}" data-avatar="${conv.user.avatar}" style="padding: 15px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;">
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
                    startNewMessagingChat(el.dataset.id, el.dataset.name, el.dataset.avatar);
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
                    alert("Ce message a été envoyé il y a plus de 10 minutes et ne peut plus être modifié.");
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
