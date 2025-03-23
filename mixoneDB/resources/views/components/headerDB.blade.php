<header data-add-bg="" class="header -dashboard bg-white js-header" data-x="header" data-x-toggle="is-menu-opened">
    <div data-anim="fade" class="header__container px-30 sm:px-20">
        <div class="-left-side">
            <a href="/" class="header-logo" data-x="header-logo" data-x-toggle="is-logo-dark">
                <img src={{asset("media/images/logo_droit.svg")}} alt="logo icon">
            </a>
        </div>

        <div class="row justify-between items-center pl-60 lg:pl-20">
            <div class="col-auto">
                <div class="d-flex items-center">
                    <button data-x-click="dashboard">
                        <i class="icon-menu-2 text-20"></i>
                    </button>

                    <div class="single-field relative d-flex items-center md:d-none ml-30">
                        <input class="pl-50 border-light text-dark-1 h-50 rounded-8" type="email" placeholder="Search">
                        <button class="absolute d-flex items-center h-full">
                            <i class="icon-search text-20 px-15 text-dark-1"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex items-center">

                    <div class="header-menu " data-x="mobile-menu" data-x-toggle="is-menu-active">
                        <div class="mobile-overlay"></div>

                        <div class="header-menu__content">
                            <div class="mobile-bg js-mobile-bg"></div>

                            <div class="menu js-navList">
                                <ul class="menu__nav text-dark-1 fw-500 -is-active">
                                    <li>
                                        <a href="/">
                                            <span class="mr-10">Accueil</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="/studio_list">
                                            <span class="mr-10">Nos studios</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="/about">
                                            <span class="mr-10">À propos</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/contact">Contact</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
                            </div>
                        </div>
                    </div>


                    <div class="row items-center x-gap-5 y-gap-20 pl-20 lg:d-none">
                        <div class="col-auto">
                            <button class="button -blue-1-05 size-50 rounded-22 flex-center" onclick="toggleMessageBox()">
                                <i class="icon-email-2 text-20"></i>
                            </button>
                        </div>
                        <div class="col-auto">
                            <button class="button -blue-1-05 size-50 rounded-22 flex-center">
                                <i class="icon-notification text-20"></i>
                            </button>
                        </div>

                        <div id="messageBox" class="message-box hidden">
                            <div class="message-box-header">
                                <h4>Messages</h4>
                                <button class="close-button" onclick="toggleMessageBox()">×</button>
                            </div>

                            <div class="message-box-content">
                                <div class="messages">
                                    <!-- Les messages seront affichés ici -->
                                </div>
                                <div class="message-input">
                                    <input type="text" id="receiverId" placeholder="ID du destinataire" />
                                    <input type="text" id="messageInput" placeholder="Tapez votre message..." />
                                    <button onclick="sendMessage()">Envoyer</button>
                                </div>
                            </div>



                            <script>
                                function toggleMessageBox() {
                                    const messageBox = document.getElementById('messageBox');
                                    messageBox.classList.toggle('hidden');
                                }

                                function sendMessage() {
                                    const messageInput = document.getElementById('messageInput');
                                    const receiverId = document.getElementById('receiverId').value;
                                    const messageText = messageInput.value.trim();
                                    if (messageText && receiverId) {
                                        fetch('/message', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            body: JSON.stringify({
                                                receiver_id: receiverId,
                                                message: messageText
                                            })
                                        })
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.success) {
                                                    loadMessages();
                                                    messageInput.value = '';
                                                } else {
                                                    console.error('Error sending message:', data);
                                                }
                                            })
                                            .catch(error => console.error('Error:', error));
                                    }
                                }

                                function loadMessages() {
                                    fetch('/message')
                                        .then(response => response.json())
                                        .then(messages => {
                                            const messagesContainer = document.querySelector('.messages');
                                            messagesContainer.innerHTML = '';
                                            messages.forEach(message => {
                                                const messageElement = document.createElement('div');
                                                messageElement.classList.add('message');

                                                const senderElement = document.createElement('div');
                                                senderElement.classList.add('sender');
                                                senderElement.textContent = message.sender ? message.sender.first_name : 'Unknown';

                                                const dateElement = document.createElement('div');
                                                dateElement.classList.add('date');
                                                dateElement.textContent = new Date(message.created_at).toLocaleString();

                                                const textElement = document.createElement('div');
                                                textElement.classList.add('text');
                                                textElement.textContent = message.message;

                                                messageElement.appendChild(senderElement);
                                                messageElement.appendChild(dateElement);
                                                messageElement.appendChild(textElement);

                                                messagesContainer.appendChild(messageElement);
                                            });
                                        })
                                        .catch(error => console.error('Error:', error));
                                }
                            </script>


                        </div>

                        <div class="pl-15">
                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('media/img/misc/avatar-1.png') }}" alt="image" class="size-50 rounded-22 object-cover">
                        </div>
                        <div class="d-none xl:d-flex x-gap-20 items-center pl-20" data-x="header-mobile-icons" data-x-toggle="text-white">
                            <div><button class="d-flex items-center icon-menu text-20" data-x-click="html, header, header-logo, header-mobile-icons, mobile-menu"></button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .messaging-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                display: none;
                justify-content: center;
                align-items: center;
            }

            .messaging-container {
                width: 900px;
                height: 600px;
                background-color: white;
                border-radius: 8px;
                overflow: hidden;
                display: flex;
            }

            .messaging-header {
                padding: 15px 20px;
                background-color: #3554D1;
                color: white;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .messaging-header h3 {
                margin: 0;
                color: white;
            }

            .close-modal {
                background: none;
                border: none;
                color: white;
                font-size: 24px;
                cursor: pointer;
            }

            .messaging-body {
                display: flex;
                flex: 1;
                overflow: hidden;
            }

            .messaging-sidebar {
                width: 280px;
                background-color: #f5f5f5;
                border-right: 1px solid #e0e0e0;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .new-message-btn {
                padding: 15px;
                border-bottom: 1px solid #e0e0e0;
            }

            .conversation-item {
                padding: 15px;
                border-bottom: 1px solid #e0e0e0;
                cursor: pointer;
                transition: background-color 0.2s;
            }

            .conversation-item:hover {
                background-color: #eaeaea;
            }

            .conversation-item.active {
                background-color: #e6f2ff;
            }

            .conversation-name {
                font-weight: 500;
                margin-bottom: 5px;
            }

            .conversation-time {
                font-size: 12px;
                color: #777;
            }

            .message-container {
                flex: 1;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .empty-state {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100%;
            }

            .active-conversation {
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .conversation-header {
                padding: 15px 20px;
                background-color: #f9f9f9;
                border-bottom: 1px solid #e0e0e0;
            }

            .conversation-header h4 {
                margin: 0;
            }

            .conversation-list {
                flex: 1;
                overflow-y: auto;
                max-height: calc(100% - 70px);
            }

            .messages-list {
                flex: 1;
                padding: 20px;
                overflow-y: auto;
                display: flex;
                flex-direction: column;
                max-height: calc(100% - 130px);
            }

            .message {
                max-width: 70%;
                padding: 10px 15px;
                border-radius: 18px;
                margin-bottom: 20px;
                position: relative;
            }

            .message-sent {
                align-self: flex-end;
                background-color: #3554D1;
                color: white;
                border-bottom-right-radius: 5px;
            }

            .message-received {
                align-self: flex-start;
                background-color: #f0f0f0;
                color: #333;
                border-bottom-left-radius: 5px;
            }

            .message-sender {
                font-size: 12px;
                margin-bottom: 3px;
                font-weight: 500;
            }

            .message-time {
                font-size: 10px;
                position: absolute;
                bottom: -16px;
                color: #777;
            }

            .message-sent .message-time {
                right: 5px;
            }

            .message-received .message-time {
                left: 5px;
            }

            .message-input {
                padding: 15px;
                border-top: 1px solid #e0e0e0;
                display: flex;
                align-items: center;
                background-color: white;
            }

            .message-input textarea {
                flex: 1;
                border: 1px solid #ddd;
                border-radius: 20px;
                padding: 10px 15px;
                resize: none;
                height: 40px;
                margin-right: 10px;
            }

            .new-message-modal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1100;
                display: none;
                justify-content: center;
                align-items: center;
            }

            .new-message-container {
                width: 400px;
                background-color: white;
                border-radius: 8px;
                overflow: hidden;
            }

            .new-message-header {
                padding: 15px 20px;
                background-color: #3554D1;
                color: white;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .new-message-content {
                padding: 20px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-weight: 500;
            }

            .form-select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }

            .new-message-actions {
                text-align: right;
            }
        </style>
</header>
