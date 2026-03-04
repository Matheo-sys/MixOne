<style>
/* Messaging Widget Styles - Inlined to bypass build issues */
.messaging-widget {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
    font-family: 'Jost', sans-serif;
}

.messaging-button {
    width: 60px;
    height: 60px;
    background-color: #3554D1;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(53, 84, 209, 0.3);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 24px;
    position: relative;
}

.messaging-button:hover {
    transform: scale(1.05);
    background-color: #4361ee;
}

.btn-new-message:hover {
    background: rgba(255,255,255,0.4) !important;
    transform: translateY(-1px);
}

.messaging-button .notification-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    background: #D13535;
    color: white;
    font-size: 10px;
    font-weight: 700;
    min-width: 20px;
    min-height: 20px;
    line-height: 20px;
    text-align: center;
    padding: 0 5px;
    border-radius: 50px;
    border: 2px solid white;
    box-shadow: 0 2px 6px rgba(209,53,53,0.5);
}

.messaging-window {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 380px;
    height: 550px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    border: 1px solid #eee;
}

.messaging-window__header {
    background: #3554D1;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.messaging-window__body {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    height: calc(100% - 60px);
}

.conversation-list {
    flex: 1;
    overflow-y: auto;
}

.conversation-item {
    padding: 15px 20px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background 0.2s;
}

.conversation-item:hover {
    background: #f9f9f9;
}

.conversation-item.active {
    background: #f0f7ff;
}

.active-chat {
    flex: 1;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.active-chat__header {
    padding: 12px 20px;
    border-bottom: 1px solid #eee;
    background: #fcfcfc;
}

.message-history {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
    background: #fbfbfb;
}

.message-bubble {
    max-width: 80%;
    padding: 10px 14px;
    border-radius: 12px;
    font-size: 14px;
    position: relative;
}

.message-bubble.sent {
    align-self: flex-end;
    background: #3554D1;
    color: white;
    border-bottom-right-radius: 2px;
}

.message-bubble.received {
    align-self: flex-start;
    background: #eee;
    color: #051036;
    border-bottom-left-radius: 2px;
}

.message-bubble .message-time {
    font-size: 10px;
    opacity: 0.7;
    margin-top: 4px;
    text-align: right;
}

.message-input-area {
    padding: 15px;
    border-top: 1px solid #eee;
    display: flex;
    align-items: flex-end;
    gap: 10px;
    background: white;
}

.message-input-area textarea {
    flex: 1;
    border: 1px solid #ddd;
    border-radius: 20px;
    padding: 9px 15px;
    height: 40px;
    min-height: 40px;
    max-height: 120px;
    resize: none;
    font-size: 14px;
    overflow-y: hidden;
    line-height: 1.5;
}

.message-input-area textarea:focus {
    outline: none;
    border-color: #3554D1;
}

.message-input-area .send-btn {
    width: 40px;
    height: 40px;
    min-width: 40px;
    background: #3554D1;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    font-size: 16px;
    transition: transform 0.2s, background 0.2s;
}

.message-input-area .send-btn:hover {
    transform: scale(1.1);
    background: #2541b2;
}

.new-message-search {
    padding: 10px 20px;
    border-bottom: 1px solid #eee;
    background: #fcfcfc;
}

.new-message-search input {
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 8px 12px;
    font-size: 14px;
}

.search-results {
    max-height: 300px;
    overflow-y: auto;
}

.d-none {
    display: none !important;
}

@media (max-width: 576px) {
    .messaging-window {
        bottom: 0;
        right: 0;
        width: 100vw;
        height: 100vh;
        border-radius: 0;
    }

    .messaging-widget {
        bottom: 20px;
        right: 20px;
    }
}
</style>

<div id="messaging-widget" class="messaging-widget">
    <!-- Floating Button -->
    <button id="messaging-button" class="messaging-button">
        <i class="icon-email-2"></i>
        <span class="notification-badge d-none">0</span>
    </button>

    <!-- Chat Window -->
    <div id="messaging-window" class="messaging-window d-none">
        <div class="messaging-window__header">
            <div class="d-flex items-center" style="display: flex; align-items: center;">
                <h5 class="text-18 fw-500 text-white mb-0">Messages</h5>
                <button id="show-search" class="text-white ml-15 btn-new-message" style="background: rgba(255,255,255,0.2); border: none; border-radius: 20px; padding: 4px 12px; font-size: 12px; cursor:pointer; display: flex; align-items: center; transition: all 0.2s ease;">
                    <i class="icon-plus mr-5" style="font-size: 10px;"></i>
                    <span>Nouveau Message</span>
                </button>
            </div>
            <button id="close-messaging" class="text-white text-24" style="background:none; border:none; cursor:pointer;">&times;</button>
        </div>

        <div class="messaging-window__body">
            <!-- Search Interface -->
            <div id="search-interface" class="d-none">
                <div class="new-message-search">
                    <input type="text" id="user-search-input" placeholder="Rechercher un utilisateur...">
                </div>
                <div id="search-results" class="search-results">
                    <!-- Results will be loaded here -->
                </div>
                <div class="text-center py-10">
                    <button id="cancel-search" class="text-12 text-blue-1 fw-500">Annuler</button>
                </div>
            </div>

            <!-- Conversation List -->
            <div id="conversation-list" class="conversation-list">
                <div class="text-center py-20 text-light-1">Chargement...</div>
            </div>

            <!-- Active Chat Area -->
            <div id="active-chat" class="active-chat d-none">
                <div class="active-chat__header d-flex items-center" style="display: flex; align-items: center; padding: 10px;">
                    <button id="back-to-list" class="mr-10" style="background:none; border:none; cursor:pointer; padding: 0 10px;">
                        <i class="icon-arrow-left text-14"></i>
                    </button>
                    <div class="d-flex items-center" style="display: flex; align-items: center;">
                        <img id="chat-partner-avatar" src="{{ asset('media/img/misc/avatar-default.png') }}" alt=""  style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                        <span id="chat-partner-name" style="font-weight: 500; color: #051036;">Collaborateur</span>
                    </div>
                </div>
                <div id="message-history" class="message-history"></div>
                <form id="send-message-form" class="message-input-area">
                    <input type="hidden" id="receiver-id">
                    <textarea id="message-text" placeholder="Écrire un message..." required></textarea>
                    <button type="submit" class="send-btn" title="Envoyer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18" height="18" style="transform: rotate(0deg); display:block;">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const widget = document.getElementById('messaging-widget');
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

        let currentUserId = {{ auth()->id() ?? 'null' }};
        let messages = [];
        let hiddenContacts = [];
        let editingMessageId = null;
        let searchTimeout;
        const notificationBadge = document.querySelector('.notification-badge');

        if (!currentUserId) {
            widget.style.display = 'none';
            return;
        }

        button.addEventListener('click', () => {
            chatWindow.classList.toggle('d-none');
            if (!chatWindow.classList.contains('d-none')) {
                loadMessages();
                markAllAsRead();
            }
        });

        closeBtn.addEventListener('click', () => chatWindow.classList.add('d-none'));

        backBtn.addEventListener('click', () => {
            activeChat.classList.add('d-none');
            conversationList.classList.remove('d-none');
        });

        // Search Logic
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
                    const response = await fetch(`/api/users/search?q=${encodeURIComponent(query)}`);
                    const users = await response.json();
                    renderSearchResults(users);
                } catch (error) {
                    console.error('Error searching users:', error);
                }
            }, 300);
        });

        function renderSearchResults(users) {
            searchResults.innerHTML = users.length === 0 
                ? '<div class="text-center py-15 text-light-1">Aucun utilisateur trouvé</div>'
                : users.map(user => `
                    <div class="conversation-item" onclick="window.startNewMessagingChat(${user.id}, '${user.first_name} ${user.last_name}', '${user.avatar}')" style="padding: 10px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;">
                        <img src="${user.avatar ? '/storage/' + user.avatar : '/media/img/misc/avatar-default.png'}" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                        <span style="font-weight: 500; color: #051036; font-size: 14px;">${user.first_name} ${user.last_name}</span>
                    </div>
                `).join('');
        }

        window.startNewMessagingChat = function(userId, name, avatar) {
            searchInterface.classList.add('d-none');
            activeChat.classList.remove('d-none');
            conversationList.classList.add('d-none');
            chatWindow.classList.remove('d-none');
            
            receiverInput.value = userId;
            partnerName.textContent = name;
            partnerAvatar.src = avatar && avatar !== 'null' ? '/storage/' + avatar : '/media/img/misc/avatar-default.png';
            
            renderMessages(userId);
        };

        async function loadMessages() {
            try {
                const response = await fetch('/message');
                const data = await response.json();
                messages = data.messages || [];
                hiddenContacts = data.hidden_contacts || [];
                renderConversations();
            } catch (error) {
                console.error('Error loading messages:', error);
            }
        }

        async function fetchUnreadCount() {
            try {
                if (chatWindow.classList.contains('d-none')) {
                    const response = await fetch('/message/unread-count');
                    const data = await response.json();
                    if (data.count > 0) {
                        notificationBadge.textContent = data.count;
                        notificationBadge.classList.remove('d-none');
                    } else {
                        notificationBadge.classList.add('d-none');
                    }
                }
            } catch (error) {
                console.error('Error fetching unread count:', error);
            }
        }

        async function markAllAsRead() {
            try {
                await fetch('/message/read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                notificationBadge.classList.add('d-none');
            } catch (error) {
                console.error('Error marking as read:', error);
            }
        }

        window.hideConversation = async function(e, contactId) {
            e.stopPropagation();
            try {
                const res = await fetch(`/message/hide/${contactId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                if (res.ok) {
                    hiddenContacts.push(contactId);
                    renderConversations();
                }
            } catch (error) {
                console.error('Error hiding conversation', error);
            }
        };

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

        function renderConversations() {
            const conversations = {};
            messages.forEach(msg => {
                const otherUser = msg.sender_id === currentUserId ? msg.receiver : msg.sender;
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
                : visibleConvs.map(conv => `
                    <div class="conversation-item" onclick="window.startNewMessagingChat(${conv.user.id}, '${conv.user.first_name} ${conv.user.last_name}', '${conv.user.avatar}')" style="padding: 15px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;">
                        <img src="${conv.user.avatar ? '/storage/' + conv.user.avatar : '/media/img/misc/avatar-default.png'}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                        <div style="flex: 1; overflow: hidden;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                <span style="font-weight: 500; color: #051036; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${conv.user.first_name} ${conv.user.last_name}</span>
                                <div style="display: flex; align-items: center;">
                                    <span style="font-size: 10px; color: #777; margin-right: 8px;">${formatMessageDate(conv.lastMessage.created_at)}</span>
                                    <div onclick="window.hideConversation(event, ${conv.user.id})" style="color: #bbb; cursor: pointer; padding: 2px;" onmouseover="this.style.color='#dd2727'" onmouseout="this.style.color='#bbb'">
                                        <i class="icon-trash" style="font-size: 12px;"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="font-size: 12px; color: #777; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0;">${conv.lastMessage.message}</p>
                        </div>
                    </div>
                `).join('');
        }

        window.startEditMessage = function(id) {
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
                // trigger resize
                messageInput.dispatchEvent(new Event('input'));
            }
        };

        function renderMessages(otherUserId) {
            const filteredMessages = messages.filter(msg => 
                msg.sender_id === otherUserId || msg.receiver_id === otherUserId
            );

            messageHistory.innerHTML = filteredMessages.map(msg => `
                <div class="message-bubble ${msg.sender_id === currentUserId ? 'sent' : 'received'}">
                    <div class="message-content">${msg.message}
                        ${msg.sender_id === currentUserId && ((new Date() - new Date(msg.created_at)) / 1000 / 60 <= 10) ? `
                            <div onclick="window.startEditMessage(${msg.id})" style="position:absolute; right: -20px; top: 0; cursor: pointer; color: #bbb; display: ${msg.id ? 'block' : 'none'};" onmouseover="this.style.color='#3554D1'" onmouseout="this.style.color='#bbb'">
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
            
            messageHistory.scrollTop = messageHistory.scrollHeight;
        }

        // Auto-resize textarea
        messageInput.addEventListener('input', function() {
            this.style.height = '40px'; // Reset base height
            const newHeight = Math.min(this.scrollHeight, 120);
            this.style.height = newHeight + 'px';
            if (this.scrollHeight > 120) {
                this.style.overflowY = 'auto';
            } else {
                this.style.overflowY = 'hidden';
            }
        });

        // Submit on Enter (unless Shift+Enter is pressed)
        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                // We fake a submit event on the form
                sendForm.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
            }
        });

        sendForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const text = messageInput.value.trim();
            const receiverId = receiverInput.value;

            if (!text || !receiverId) return;

            // Optimistic UI
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
                    sender_id: currentUserId,
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
            messageInput.style.height = '40px'; // Reset height visually
            renderMessages(parseInt(receiverId));

            try {
                const endpoint = currentEditId ? `/message/${currentEditId}` : '/message';
                const method = currentEditId ? 'PUT' : 'POST';

                const response = await fetch(endpoint, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        receiver_id: receiverId,
                        message: text
                    })
                });

                if (!response.ok) {
                    // En cas d'erreur : on annule
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
                console.error('Error sending message:', error);
                await loadMessages();
                renderMessages(parseInt(receiverId));
            }
        });

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

        // Fetch unread count on load if closed
        fetchUnreadCount();
    });
})();
</script>
