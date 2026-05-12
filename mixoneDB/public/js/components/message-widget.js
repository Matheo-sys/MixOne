/******/ (() => { // webpackBootstrap
/*!***************************************************!*\
  !*** ./resources/js/components/message-widget.js ***!
  \***************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
/**
 * Composant du Widget de Messagerie
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var widget = document.getElementById('messaging-widget');
    if (!widget) return;

    // Configuration récupérée via les attributs data
    var config = {
      currentUserId: widget.getAttribute('data-user-id') ? parseInt(widget.getAttribute('data-user-id')) : null,
      csrfToken: widget.getAttribute('data-csrf')
    };

    // Si l'utilisateur n'est pas connecté, on masque le widget
    if (!config.currentUserId) {
      widget.style.display = 'none';
      return;
    }

    // Éléments du DOM
    var button = document.getElementById('messaging-button');
    var chatWindow = document.getElementById('messaging-window');
    var closeBtn = document.getElementById('close-messaging');
    var conversationList = document.getElementById('conversation-list');
    var activeChat = document.getElementById('active-chat');
    var backBtn = document.getElementById('back-to-list');
    var messageHistory = document.getElementById('message-history');
    var sendForm = document.getElementById('send-message-form');
    var messageInput = document.getElementById('message-text');
    var receiverInput = document.getElementById('receiver-id');
    var partnerName = document.getElementById('chat-partner-name');
    var partnerAvatar = document.getElementById('chat-partner-avatar');
    var showSearchBtn = document.getElementById('show-search');
    var searchInterface = document.getElementById('search-interface');
    var searchInput = document.getElementById('user-search-input');
    var searchResults = document.getElementById('search-results');
    var cancelSearchBtn = document.getElementById('cancel-search');
    var notificationBadge = document.querySelector('.notification-badge');
    var messages = [];
    var hiddenContacts = [];
    var editingMessageId = null;
    var searchTimeout;

    // Ouvrir/Fermer la fenêtre de chat
    button.addEventListener('click', function () {
      chatWindow.classList.toggle('d-none');
      if (!chatWindow.classList.contains('d-none')) {
        loadMessages();
        markAllAsRead();
      }
    });
    closeBtn.addEventListener('click', function () {
      return chatWindow.classList.add('d-none');
    });

    // Retour à la liste des conversations
    backBtn.addEventListener('click', function () {
      activeChat.classList.add('d-none');
      conversationList.classList.remove('d-none');
    });

    // Logique de recherche d'utilisateurs
    showSearchBtn.addEventListener('click', function () {
      conversationList.classList.add('d-none');
      activeChat.classList.add('d-none');
      searchInterface.classList.remove('d-none');
      searchInput.focus();
    });
    cancelSearchBtn.addEventListener('click', function () {
      searchInterface.classList.add('d-none');
      conversationList.classList.remove('d-none');
      searchInput.value = '';
      searchResults.innerHTML = '';
    });
    searchInput.addEventListener('input', function () {
      clearTimeout(searchTimeout);
      var query = searchInput.value.trim();
      if (query.length < 2) {
        searchResults.innerHTML = '';
        return;
      }
      searchTimeout = setTimeout(/*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee() {
        var response, users;
        return _regeneratorRuntime().wrap(function _callee$(_context) {
          while (1) switch (_context.prev = _context.next) {
            case 0:
              _context.prev = 0;
              _context.next = 3;
              return fetch("/tableau-de-bord/api/utilisateurs/rechercher?q=".concat(encodeURIComponent(query)));
            case 3:
              response = _context.sent;
              _context.next = 6;
              return response.json();
            case 6:
              users = _context.sent;
              renderSearchResults(users);
              _context.next = 13;
              break;
            case 10:
              _context.prev = 10;
              _context.t0 = _context["catch"](0);
              console.error('Erreur lors de la recherche :', _context.t0);
            case 13:
            case "end":
              return _context.stop();
          }
        }, _callee, null, [[0, 10]]);
      })), 300);
    });

    /**
     * Helper : affiche le nom avec @username et badge profil
     */
    function formatUserDisplay(user) {
      var name = "".concat(user.first_name, " ").concat(user.last_name);
      var username = user.username ? "@".concat(user.username) : '';
      var badgeColor = user.profile === 'studio' ? '#3554D1' : '#10b981';
      var badgeText = user.profile === 'studio' ? 'Studio' : 'Artiste';
      var badge = user.profile ? "<span style=\"background: ".concat(badgeColor, "; color: white; font-size: 10px; padding: 2px 6px; border-radius: 10px; margin-left: 6px;\">").concat(badgeText, "</span>") : '';
      return {
        name: name,
        username: username,
        badge: badge
      };
    }

    /**
     * Affiche les résultats de recherche d'utilisateurs
     */
    function renderSearchResults(users) {
      searchResults.innerHTML = users.length === 0 ? '<div class="text-center py-15 text-light-1">Aucun utilisateur trouvé</div>' : users.map(function (user) {
        var display = formatUserDisplay(user);
        return "\n                    <div class=\"conversation-item js-start-chat\" data-id=\"".concat(user.id, "\" data-name=\"").concat(display.name, "\" data-avatar=\"").concat(user.avatar, "\" style=\"padding: 10px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;\">\n                        <img src=\"").concat(user.avatar ? '/storage/' + user.avatar : '/media/img/misc/avatar-default.png', "\" style=\"width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;\">\n                        <div style=\"flex: 1;\">\n                            <div style=\"display: flex; align-items: center;\">\n                                <span style=\"font-weight: 500; color: #051036; font-size: 14px;\">").concat(display.name, "</span>\n                                ").concat(display.badge, "\n                            </div>\n                            ").concat(display.username ? "<span style=\"font-size: 12px; color: #3554D1; font-weight: 500;\">".concat(display.username, "</span>") : '', "\n                        </div>\n                    </div>\n                ");
      }).join('');
      searchResults.querySelectorAll('.js-start-chat').forEach(function (el) {
        el.addEventListener('click', function () {
          startNewMessagingChat(el.dataset.id, el.dataset.name, el.dataset.avatar);
        });
      });
    }

    /**
     * Lance une nouvelle conversation avec un utilisateur
     */
    var startNewMessagingChat = function startNewMessagingChat(userId, name, avatar) {
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
    function loadMessages() {
      return _loadMessages.apply(this, arguments);
    }
    /**
     * Récupère le nombre de messages non lus
     */
    function _loadMessages() {
      _loadMessages = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee3() {
        var response, data;
        return _regeneratorRuntime().wrap(function _callee3$(_context3) {
          while (1) switch (_context3.prev = _context3.next) {
            case 0:
              _context3.prev = 0;
              _context3.next = 3;
              return fetch('/tableau-de-bord/message');
            case 3:
              response = _context3.sent;
              _context3.next = 6;
              return response.json();
            case 6:
              data = _context3.sent;
              messages = data.messages || [];
              hiddenContacts = data.hidden_contacts || [];
              renderConversations();
              _context3.next = 15;
              break;
            case 12:
              _context3.prev = 12;
              _context3.t0 = _context3["catch"](0);
              console.error('Erreur chargement messages :', _context3.t0);
            case 15:
            case "end":
              return _context3.stop();
          }
        }, _callee3, null, [[0, 12]]);
      }));
      return _loadMessages.apply(this, arguments);
    }
    function fetchUnreadCount() {
      return _fetchUnreadCount.apply(this, arguments);
    }
    /**
     * Marque tous les messages comme lus
     */
    function _fetchUnreadCount() {
      _fetchUnreadCount = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee4() {
        var response, data;
        return _regeneratorRuntime().wrap(function _callee4$(_context4) {
          while (1) switch (_context4.prev = _context4.next) {
            case 0:
              _context4.prev = 0;
              if (!chatWindow.classList.contains('d-none')) {
                _context4.next = 9;
                break;
              }
              _context4.next = 4;
              return fetch('/tableau-de-bord/message/nombre-non-lus');
            case 4:
              response = _context4.sent;
              _context4.next = 7;
              return response.json();
            case 7:
              data = _context4.sent;
              if (data.count > 0) {
                notificationBadge.textContent = data.count;
                notificationBadge.classList.remove('d-none');
              } else {
                notificationBadge.classList.add('d-none');
              }
            case 9:
              _context4.next = 14;
              break;
            case 11:
              _context4.prev = 11;
              _context4.t0 = _context4["catch"](0);
              console.error('Erreur nombre non lus :', _context4.t0);
            case 14:
            case "end":
              return _context4.stop();
          }
        }, _callee4, null, [[0, 11]]);
      }));
      return _fetchUnreadCount.apply(this, arguments);
    }
    function markAllAsRead() {
      return _markAllAsRead.apply(this, arguments);
    }
    /**
     * Masque (supprime visuellement) une conversation
     */
    function _markAllAsRead() {
      _markAllAsRead = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee5() {
        return _regeneratorRuntime().wrap(function _callee5$(_context5) {
          while (1) switch (_context5.prev = _context5.next) {
            case 0:
              _context5.prev = 0;
              _context5.next = 3;
              return fetch('/tableau-de-bord/message/lire', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': config.csrfToken
                }
              });
            case 3:
              notificationBadge.classList.add('d-none');
              _context5.next = 9;
              break;
            case 6:
              _context5.prev = 6;
              _context5.t0 = _context5["catch"](0);
              console.error('Erreur lecture messages :', _context5.t0);
            case 9:
            case "end":
              return _context5.stop();
          }
        }, _callee5, null, [[0, 6]]);
      }));
      return _markAllAsRead.apply(this, arguments);
    }
    function hideConversation(_x) {
      return _hideConversation.apply(this, arguments);
    }
    function _hideConversation() {
      _hideConversation = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee6(contactId) {
        var idToHide, res;
        return _regeneratorRuntime().wrap(function _callee6$(_context6) {
          while (1) switch (_context6.prev = _context6.next) {
            case 0:
              idToHide = isNaN(contactId) ? contactId : parseInt(contactId); // Optimistic UI : on cache tout de suite
              hiddenContacts.push(idToHide);
              renderConversations();
              _context6.prev = 3;
              _context6.next = 6;
              return fetch("/tableau-de-bord/message/masquer/".concat(contactId), {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': config.csrfToken
                }
              });
            case 6:
              res = _context6.sent;
              if (!res.ok) {
                // Rollback si erreur serveur
                hiddenContacts = hiddenContacts.filter(function (id) {
                  return id !== idToHide;
                });
                renderConversations();
              }
              _context6.next = 15;
              break;
            case 10:
              _context6.prev = 10;
              _context6.t0 = _context6["catch"](3);
              console.error('Erreur masquage conversation :', _context6.t0);
              // Rollback si erreur réseau
              hiddenContacts = hiddenContacts.filter(function (id) {
                return id !== idToHide;
              });
              renderConversations();
            case 15:
            case "end":
              return _context6.stop();
          }
        }, _callee6, null, [[3, 10]]);
      }));
      return _hideConversation.apply(this, arguments);
    }
    ;

    /**
     * Formate la date d'un message en texte lisible
     */
    function formatMessageDate(dateString) {
      var date = new Date(dateString);
      var today = new Date();
      var yesterday = new Date(today);
      yesterday.setDate(yesterday.getDate() - 1);
      var isToday = date.getDate() === today.getDate() && date.getMonth() === today.getMonth() && date.getFullYear() === today.getFullYear();
      var isYesterday = date.getDate() === yesterday.getDate() && date.getMonth() === yesterday.getMonth() && date.getFullYear() === yesterday.getFullYear();
      var time = date.toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
      });
      if (isToday) {
        return "Aujourd'hui \xE0 ".concat(time);
      } else if (isYesterday) {
        return "Hier \xE0 ".concat(time);
      } else {
        var options = {
          day: '2-digit',
          month: '2-digit',
          year: 'numeric'
        };
        return "Le ".concat(date.toLocaleDateString('fr-FR', options), " \xE0 ").concat(time);
      }
    }

    /**
     * Affiche la liste des conversations (utilisateurs avec qui on a discuté)
     */
    function renderConversations() {
      var conversations = {};
      messages.forEach(function (msg) {
        var otherUser = msg.sender_id === config.currentUserId ? msg.receiver : msg.sender;
        if (!otherUser) return;
        if (!conversations[otherUser.id] || new Date(msg.created_at) > new Date(conversations[otherUser.id].lastMessage.created_at)) {
          conversations[otherUser.id] = {
            user: otherUser,
            lastMessage: msg
          };
        }
      });
      var visibleConvs = Object.values(conversations).filter(function (conv) {
        return !hiddenContacts.includes(conv.user.id);
      });
      conversationList.innerHTML = visibleConvs.length === 0 ? '<div style="text-align: center; padding: 20px; color: #777;">Aucune conversation</div>' : visibleConvs.map(function (conv) {
        var display = formatUserDisplay(conv.user);
        return "\n                    <div class=\"conversation-item js-conv-item\" data-id=\"".concat(conv.user.id, "\" data-name=\"").concat(display.name, "\" data-avatar=\"").concat(conv.user.avatar, "\" style=\"padding: 15px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;\">\n                        <img src=\"").concat(conv.user.avatar ? '/storage/' + conv.user.avatar : '/media/img/misc/avatar-default.png', "\" style=\"width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 12px;\">\n                        <div style=\"flex: 1; overflow: hidden;\">\n                            <div style=\"display: flex; justify-content: space-between; align-items: center; margin-bottom: 3px;\">\n                                <div style=\"display: flex; align-items: center; overflow: hidden;\">\n                                    <span style=\"font-weight: 500; color: #051036; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;\">").concat(display.name, "</span>\n                                    ").concat(display.badge, "\n                                </div>\n                                <div style=\"display: flex; align-items: center; flex-shrink: 0;\">\n                                    <span style=\"font-size: 10px; color: #777; margin-right: 8px;\">").concat(formatMessageDate(conv.lastMessage.created_at), "</span>\n                                    <div class=\"js-hide-conv\" data-id=\"").concat(conv.user.id, "\" style=\"color: #bbb; cursor: pointer; padding: 2px;\">\n                                        <i class=\"icon-trash\" style=\"font-size: 12px;\"></i>\n                                    </div>\n                                </div>\n                            </div>\n                            ").concat(display.username ? "<div style=\"font-size: 11px; color: #3554D1; font-weight: 500; margin-bottom: 3px;\">".concat(display.username, "</div>") : '', "\n                            <p style=\"font-size: 12px; color: #777; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0;\">").concat(conv.lastMessage.message, "</p>\n                        </div>\n                    </div>\n                ");
      }).join('');
      conversationList.querySelectorAll('.js-conv-item').forEach(function (el) {
        el.addEventListener('click', function (e) {
          if (e.target.closest('.js-hide-conv')) return;
          startNewMessagingChat(el.dataset.id, el.dataset.name, el.dataset.avatar);
        });
      });
      conversationList.querySelectorAll('.js-hide-conv').forEach(function (el) {
        el.addEventListener('click', function (e) {
          e.stopPropagation();
          hideConversation(el.dataset.id);
        });
      });
    }

    /**
     * Affiche l'historique des messages d'une conversation spécifique
     */
    function renderMessages(otherUserId) {
      var filteredMessages = messages.filter(function (msg) {
        return msg.sender_id === otherUserId || msg.receiver_id === otherUserId;
      });
      messageHistory.innerHTML = filteredMessages.map(function (msg) {
        return "\n                <div class=\"message-bubble ".concat(msg.sender_id === config.currentUserId ? 'sent' : 'received', "\">\n                    <div class=\"message-content\">").concat(msg.message, "\n                        ").concat(msg.sender_id === config.currentUserId && (new Date() - new Date(msg.created_at)) / 1000 / 60 <= 10 ? "\n                            <div class=\"js-edit-msg\" data-id=\"".concat(msg.id, "\" style=\"position:absolute; right: -20px; top: 0; cursor: pointer; color: #bbb; display: ").concat(msg.id ? 'block' : 'none', ";\">\n                                <i class=\"icon-edit\" style=\"font-size: 10px;\"></i>\n                            </div>\n                        ") : '', "\n                    </div>\n                    <div class=\"message-time\">\n                        ").concat(msg.is_edited ? '<span style="font-style: italic; opacity: 0.7; margin-right: 4px;">(modifié)</span>' : '', "\n                        ").concat(formatMessageDate(msg.created_at), "\n                    </div>\n                </div>\n            ");
      }).join('');
      messageHistory.querySelectorAll('.js-edit-msg').forEach(function (el) {
        el.addEventListener('click', function () {
          startEditMessage(parseInt(el.dataset.id));
        });
      });
      messageHistory.scrollTop = messageHistory.scrollHeight;
    }

    /**
     * Initialise l'édition d'un message existant
     */
    function startEditMessage(id) {
      var msg = messages.find(function (m) {
        return m.id === id;
      });
      if (msg) {
        var msgDate = new Date(msg.created_at);
        if ((new Date() - msgDate) / 1000 / 60 > 10) {
          alert("Ce message a été envoyé il y a plus de 10 minutes et ne peut plus être modifié.");
          return;
        }
        editingMessageId = id;
        messageInput.value = msg.message;
        messageInput.focus();
        messageInput.dispatchEvent(new Event('input'));
      }
    }
    ;

    // Redimensionnement automatique de la zone de texte
    messageInput.addEventListener('input', function () {
      this.style.height = '40px';
      var newHeight = Math.min(this.scrollHeight, 120);
      this.style.height = newHeight + 'px';
      this.style.overflowY = this.scrollHeight > 120 ? 'auto' : 'hidden';
    });

    // Envoi sur la touche Entrée (sauf si Shift est maintenu)
    messageInput.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendForm.dispatchEvent(new Event('submit', {
          cancelable: true,
          bubbles: true
        }));
      }
    });

    // Envoi du message (Création ou Mise à jour)
    sendForm.addEventListener('submit', /*#__PURE__*/function () {
      var _ref2 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee2(e) {
        var _messages$find;
        var text, receiverId, nowIso, originalMessageText, msgIndex, currentEditId, endpoint, method, response, _msgIndex;
        return _regeneratorRuntime().wrap(function _callee2$(_context2) {
          while (1) switch (_context2.prev = _context2.next) {
            case 0:
              e.preventDefault();
              text = messageInput.value.trim();
              receiverId = receiverInput.value;
              if (!(!text || !receiverId)) {
                _context2.next = 5;
                break;
              }
              return _context2.abrupt("return");
            case 5:
              nowIso = new Date().toISOString();
              originalMessageText = editingMessageId ? (_messages$find = messages.find(function (m) {
                return m.id === editingMessageId;
              })) === null || _messages$find === void 0 ? void 0 : _messages$find.message : null;
              if (editingMessageId) {
                msgIndex = messages.findIndex(function (m) {
                  return m.id === editingMessageId;
                });
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
              currentEditId = editingMessageId;
              editingMessageId = null;
              messageInput.value = '';
              messageInput.style.height = '40px';
              renderMessages(parseInt(receiverId));
              _context2.prev = 13;
              endpoint = currentEditId ? "/tableau-de-bord/message/".concat(currentEditId) : '/tableau-de-bord/message';
              method = currentEditId ? 'PUT' : 'POST';
              _context2.next = 18;
              return fetch(endpoint, {
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
            case 18:
              response = _context2.sent;
              if (response.ok) {
                _context2.next = 24;
                break;
              }
              if (currentEditId) {
                _msgIndex = messages.findIndex(function (m) {
                  return m.id === currentEditId;
                });
                if (_msgIndex !== -1) {
                  messages[_msgIndex].message = originalMessageText;
                  messages[_msgIndex].is_edited = false;
                }
              }
              _context2.next = 23;
              return loadMessages();
            case 23:
              renderMessages(parseInt(receiverId));
            case 24:
              _context2.next = 32;
              break;
            case 26:
              _context2.prev = 26;
              _context2.t0 = _context2["catch"](13);
              console.error('Erreur lors de l\'envoi :', _context2.t0);
              _context2.next = 31;
              return loadMessages();
            case 31:
              renderMessages(parseInt(receiverId));
            case 32:
            case "end":
              return _context2.stop();
          }
        }, _callee2, null, [[13, 26]]);
      }));
      return function (_x2) {
        return _ref2.apply(this, arguments);
      };
    }());

    // Rafraîchissement périodique
    setInterval(function () {
      if (!chatWindow.classList.contains('d-none')) {
        loadMessages().then(function () {
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
/******/ })()
;