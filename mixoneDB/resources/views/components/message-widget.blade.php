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
    .messaging-widget {
        bottom: 20px;
        right: 20px;
    }

    /* Masquer le bouton flottant quand la fenêtre est ouverte */
    .messaging-widget:has(.messaging-window:not(.d-none)) .messaging-button {
        display: none;
    }

    .messaging-window {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100% !important;
        height: 100% !important;
        height: 100dvh !important;
        border-radius: 0;
        margin: 0;
        z-index: 10001;
        display: flex;
        flex-direction: column;
    }

    .messaging-window__header {
        height: 70px;
        padding: 0 20px;
        flex-shrink: 0;
    }

    .messaging-window__body {
        height: calc(100% - 70px);
        display: flex;
        flex-direction: column;
    }

    .message-history {
        padding: 20px 15px;
    }

    .message-bubble {
        max-width: 85%;
        font-size: 15px;
        padding: 12px 16px;
    }

    .message-input-area {
        padding: 15px;
        padding-bottom: calc(15px + env(safe-area-inset-bottom, 0px));
        background: #fff;
        border-top: 1px solid #eee;
    }

    .message-input-area textarea {
        font-size: 16px; /* Empêche le zoom auto sur iPhone */
        height: 45px;
        padding: 10px 15px;
    }

    .active-chat__header {
        height: 60px;
        padding: 0 15px;
    }

    #back-to-list {
        padding-left: 0 !important;
    }

    #back-to-list i {
        font-size: 18px !important;
    }
}
</style>

<div id="messaging-widget" class="messaging-widget" data-user-id="{{ auth()->id() }}" data-csrf="{{ csrf_token() }}">
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

@push('scripts')
    <script src="{{ asset('js/components/message-widget.js') }}"></script>
@endpush
