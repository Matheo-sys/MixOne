/******/ (() => { // webpackBootstrap
/*!***************************************************!*\
  !*** ./resources/js/components/message-widget.js ***!
  \***************************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
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

    // Nouveaux éléments DOM pour Bloquer et Signaler
    var showBlockedUsersBtn = document.getElementById('show-blocked-users');
    var blockedUsersInterface = document.getElementById('blocked-users-interface');
    var blockedUsersList = document.getElementById('blocked-users-list');
    var closeBlockedUsersBtn = document.getElementById('close-blocked-users');
    var chatOptionsBtn = document.getElementById('chat-options-btn');
    var chatOptionsMenu = document.getElementById('chat-options-menu');
    var btnBlockUser = document.getElementById('btn-block-user');
    var btnReportUser = document.getElementById('btn-report-user');
    var reportInterface = document.getElementById('report-interface');
    var cancelReportBtn = document.getElementById('cancel-report');
    var reportUserForm = document.getElementById('report-user-form');
    var reportReason = document.getElementById('report-reason');
    var customReasonContainer = document.getElementById('custom-reason-container');
    var reportTargetId = document.getElementById('report-target-id');
    var reportCustomReason = document.getElementById('report-custom-reason');
    var blockedStatusArea = document.getElementById('blocked-status-area');
    var messages = [];
    var hiddenContacts = [];
    var blockedContacts = [];
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
      chatOptionsMenu.classList.add('d-none');
      conversationList.classList.remove('d-none');
    });

    // Toggle du menu des options dans un chat
    chatOptionsBtn.addEventListener('click', function () {
      chatOptionsMenu.classList.toggle('d-none');
    });

    // Fermer le menu si on clique ailleurs
    document.addEventListener('click', function (e) {
      if (!chatOptionsBtn.contains(e.target) && !chatOptionsMenu.contains(e.target)) {
        chatOptionsMenu.classList.add('d-none');
      }
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
        var response, users, _console;
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
              /* eslint-disable */(_console = console).error.apply(_console, _toConsumableArray(oo_tx("902566824_131_20_131_73_11", 'Erreur lors de la recherche :', _context.t0)));
            case 13:
            case "end":
              return _context.stop();
          }
        }, _callee, null, [[0, 10]]);
      })), 300);
    });

    // --- Logique pour Utilisateurs Bloqués ---
    showBlockedUsersBtn.addEventListener('click', function () {
      conversationList.classList.add('d-none');
      activeChat.classList.add('d-none');
      searchInterface.classList.add('d-none');
      blockedUsersInterface.classList.remove('d-none');
      loadBlockedUsers();
    });
    closeBlockedUsersBtn.addEventListener('click', function () {
      blockedUsersInterface.classList.add('d-none');
      conversationList.classList.remove('d-none');
    });
    function loadBlockedUsers() {
      return _loadBlockedUsers.apply(this, arguments);
    } // --- Logique pour Bloquer un utilisateur ---
    function _loadBlockedUsers() {
      _loadBlockedUsers = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee6() {
        var res, users, _console5;
        return _regeneratorRuntime().wrap(function _callee6$(_context6) {
          while (1) switch (_context6.prev = _context6.next) {
            case 0:
              blockedUsersList.innerHTML = '<div class="text-center py-20 text-light-1">Chargement...</div>';
              _context6.prev = 1;
              _context6.next = 4;
              return fetch('/tableau-de-bord/message/blocked-users');
            case 4:
              res = _context6.sent;
              _context6.next = 7;
              return res.json();
            case 7:
              users = _context6.sent;
              if (!(users.length === 0)) {
                _context6.next = 11;
                break;
              }
              blockedUsersList.innerHTML = '<div class="text-center py-15 text-light-1">Aucun utilisateur bloqué</div>';
              return _context6.abrupt("return");
            case 11:
              blockedUsersList.innerHTML = users.map(function (user) {
                var display = formatUserDisplay(user);
                return "\n                    <div style=\"padding: 10px 20px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f0f0f0;\">\n                        <div style=\"display: flex; align-items: center;\">\n                            <img src=\"".concat(user.avatar ? '/storage/' + user.avatar : '/media/img/misc/avatar-default.png', "\" style=\"width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;\">\n                            <div>\n                                <div style=\"font-weight: 500; color: #051036; font-size: 14px;\">").concat(display.name, "</div>\n                                ").concat(display.username ? "<span style=\"font-size: 12px; color: #777;\">".concat(display.username, "</span>") : '', "\n                            </div>\n                        </div>\n                        <button class=\"js-unblock-user text-12 text-blue-1 fw-500\" data-id=\"").concat(user.id, "\" style=\"background: none; border: none; cursor: pointer;\">D\xE9bloquer</button>\n                    </div>\n                ");
              }).join('');
              blockedUsersList.querySelectorAll('.js-unblock-user').forEach(function (btn) {
                btn.addEventListener('click', /*#__PURE__*/function () {
                  var _ref5 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee5(e) {
                    var targetId;
                    return _regeneratorRuntime().wrap(function _callee5$(_context5) {
                      while (1) switch (_context5.prev = _context5.next) {
                        case 0:
                          targetId = e.target.dataset.id;
                          _context5.next = 3;
                          return fetch('/tableau-de-bord/message/unblock', {
                            method: 'POST',
                            headers: {
                              'Content-Type': 'application/json',
                              'X-CSRF-TOKEN': config.csrfToken
                            },
                            body: JSON.stringify({
                              user_id: targetId
                            })
                          });
                        case 3:
                          // Retirer de la liste locale et recharger
                          blockedContacts = blockedContacts.filter(function (id) {
                            return id != targetId;
                          });
                          loadBlockedUsers();
                          loadMessages(); // Recharger pour réafficher la conversation
                        case 6:
                        case "end":
                          return _context5.stop();
                      }
                    }, _callee5);
                  }));
                  return function (_x5) {
                    return _ref5.apply(this, arguments);
                  };
                }());
              });
              _context6.next = 19;
              break;
            case 15:
              _context6.prev = 15;
              _context6.t0 = _context6["catch"](1);
              /* eslint-disable */(_console5 = console).error.apply(_console5, _toConsumableArray(oo_tx("902566824_194_16_194_65_11", "Erreur chargement bloqués :", _context6.t0)));
              blockedUsersList.innerHTML = '<div class="text-center py-15 text-red-1">Erreur de chargement</div>';
            case 19:
            case "end":
              return _context6.stop();
          }
        }, _callee6, null, [[1, 15]]);
      }));
      return _loadBlockedUsers.apply(this, arguments);
    }
    btnBlockUser.addEventListener('click', function () {
      var targetId = receiverInput.value;
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
      }).then(/*#__PURE__*/function () {
        var _ref2 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee2(result) {
          var res, _console2;
          return _regeneratorRuntime().wrap(function _callee2$(_context2) {
            while (1) switch (_context2.prev = _context2.next) {
              case 0:
                if (!result.isConfirmed) {
                  _context2.next = 11;
                  break;
                }
                _context2.prev = 1;
                _context2.next = 4;
                return fetch('/tableau-de-bord/message/block', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': config.csrfToken
                  },
                  body: JSON.stringify({
                    user_id: targetId
                  })
                });
              case 4:
                res = _context2.sent;
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
                _context2.next = 11;
                break;
              case 8:
                _context2.prev = 8;
                _context2.t0 = _context2["catch"](1);
                /* eslint-disable */(_console2 = console).error.apply(_console2, _toConsumableArray(oo_tx("902566824_241_24_241_65_11", "Erreur de blocage :", _context2.t0)));
              case 11:
              case "end":
                return _context2.stop();
            }
          }, _callee2, null, [[1, 8]]);
        }));
        return function (_x) {
          return _ref2.apply(this, arguments);
        };
      }());
    });

    // --- Logique pour Signaler un utilisateur ---
    btnReportUser.addEventListener('click', function () {
      chatOptionsMenu.classList.add('d-none');
      reportTargetId.value = receiverInput.value;
      reportReason.value = '';
      reportCustomReason.value = '';
      customReasonContainer.classList.add('d-none');
      reportCustomReason.removeAttribute('required');
      activeChat.classList.add('d-none'); // On cache le chat actif
      reportInterface.classList.remove('d-none'); // On affiche le signalement
    });
    cancelReportBtn.addEventListener('click', function (e) {
      e.preventDefault();
      reportInterface.classList.add('d-none');
      activeChat.classList.remove('d-none'); // On réaffiche le chat
    });
    reportReason.addEventListener('change', function (e) {
      if (e.target.value === 'Autre') {
        customReasonContainer.classList.remove('d-none');
        reportCustomReason.setAttribute('required', 'required');
      } else {
        customReasonContainer.classList.add('d-none');
        reportCustomReason.removeAttribute('required');
      }
    });
    reportUserForm.addEventListener('submit', /*#__PURE__*/function () {
      var _ref3 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee3(e) {
        var payload, res, _console3;
        return _regeneratorRuntime().wrap(function _callee3$(_context3) {
          while (1) switch (_context3.prev = _context3.next) {
            case 0:
              e.preventDefault();
              payload = {
                reported_id: reportTargetId.value,
                reason: reportReason.value,
                custom_reason: reportCustomReason.value
              };
              _context3.prev = 2;
              _context3.next = 5;
              return fetch('/tableau-de-bord/message/report', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': config.csrfToken
                },
                body: JSON.stringify(payload)
              });
            case 5:
              res = _context3.sent;
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
              _context3.next = 12;
              break;
            case 9:
              _context3.prev = 9;
              _context3.t0 = _context3["catch"](2);
              /* eslint-disable */(_console3 = console).error.apply(_console3, _toConsumableArray(oo_tx("902566824_311_16_311_61_11", "Erreur de signalement :", _context3.t0)));
            case 12:
            case "end":
              return _context3.stop();
          }
        }, _callee3, null, [[2, 9]]);
      }));
      return function (_x2) {
        return _ref3.apply(this, arguments);
      };
    }());

    /**
     * Helper : affiche le nom avec @username et badge profil
     */
    function formatUserDisplay(user) {
      var name = "".concat(user.first_name, " ").concat(user.last_name);
      var username = user.username ? "@".concat(user.username) : '';
      var badgeColor = user.profile === 'studio' ? '#3554D1' : '#10b981';
      var badgeText = user.profile === 'studio' ? 'Studio' : 'Artiste';

      // Priorité au badge Admin
      if (user.is_admin) {
        badgeColor = '#D13535';
        badgeText = 'Admin';
      }
      var badge = "<span style=\"background: ".concat(badgeColor, "; color: white; font-size: 10px; padding: 2px 6px; border-radius: 10px; margin-left: 6px;\">").concat(badgeText, "</span>");
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
        return "\n                    <div class=\"conversation-item js-start-chat\" data-id=\"".concat(user.id, "\" data-name=\"").concat(display.name, "\" data-avatar=\"").concat(user.avatar, "\" data-is-admin=\"").concat(user.is_admin ? 1 : 0, "\" style=\"padding: 10px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;\">\n                        <img src=\"").concat(user.avatar ? '/storage/' + user.avatar : '/media/img/misc/avatar-default.png', "\" style=\"width: 35px; height: 35px; border-radius: 50%; object-fit: cover; margin-right: 12px;\">\n                        <div style=\"flex: 1;\">\n                            <div style=\"display: flex; align-items: center;\">\n                                <span style=\"font-weight: 500; color: #051036; font-size: 14px;\">").concat(display.name, "</span>\n                                ").concat(display.badge, "\n                            </div>\n                            ").concat(display.username ? "<span style=\"font-size: 12px; color: #3554D1; font-weight: 500;\">".concat(display.username, "</span>") : '', "\n                        </div>\n                    </div>\n                ");
      }).join('');
      searchResults.querySelectorAll('.js-start-chat').forEach(function (el) {
        el.addEventListener('click', function () {
          startNewMessagingChat(el.dataset.id, el.dataset.name, el.dataset.avatar, el.dataset.isAdmin == "1");
        });
      });
    }

    /**
     * Lance une nouvelle conversation avec un utilisateur
     */
    var startNewMessagingChat = function startNewMessagingChat(userId, name, avatar) {
      var isAdmin = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
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
    function loadMessages() {
      return _loadMessages.apply(this, arguments);
    }
    /**
     * Récupère le nombre de messages non lus
     */
    function _loadMessages() {
      _loadMessages = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee7() {
        var response, data, _console6;
        return _regeneratorRuntime().wrap(function _callee7$(_context7) {
          while (1) switch (_context7.prev = _context7.next) {
            case 0:
              _context7.prev = 0;
              _context7.next = 3;
              return fetch('/tableau-de-bord/message');
            case 3:
              response = _context7.sent;
              _context7.next = 6;
              return response.json();
            case 6:
              data = _context7.sent;
              messages = data.messages || [];
              hiddenContacts = data.hidden_contacts || [];
              blockedContacts = data.blocked_contacts || [];
              renderConversations();
              _context7.next = 16;
              break;
            case 13:
              _context7.prev = 13;
              _context7.t0 = _context7["catch"](0);
              /* eslint-disable */(_console6 = console).error.apply(_console6, _toConsumableArray(oo_tx("902566824_409_16_409_68_11", 'Erreur chargement messages :', _context7.t0)));
            case 16:
            case "end":
              return _context7.stop();
          }
        }, _callee7, null, [[0, 13]]);
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
      _fetchUnreadCount = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee8() {
        var response, data, _console7;
        return _regeneratorRuntime().wrap(function _callee8$(_context8) {
          while (1) switch (_context8.prev = _context8.next) {
            case 0:
              _context8.prev = 0;
              if (!chatWindow.classList.contains('d-none')) {
                _context8.next = 9;
                break;
              }
              _context8.next = 4;
              return fetch('/tableau-de-bord/message/nombre-non-lus');
            case 4:
              response = _context8.sent;
              _context8.next = 7;
              return response.json();
            case 7:
              data = _context8.sent;
              if (data.count > 0) {
                notificationBadge.textContent = data.count;
                notificationBadge.classList.remove('d-none');
              } else {
                notificationBadge.classList.add('d-none');
              }
            case 9:
              _context8.next = 14;
              break;
            case 11:
              _context8.prev = 11;
              _context8.t0 = _context8["catch"](0);
              /* eslint-disable */(_console7 = console).error.apply(_console7, _toConsumableArray(oo_tx("902566824_429_16_429_63_11", 'Erreur nombre non lus :', _context8.t0)));
            case 14:
            case "end":
              return _context8.stop();
          }
        }, _callee8, null, [[0, 11]]);
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
      _markAllAsRead = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee9() {
        var _console8;
        return _regeneratorRuntime().wrap(function _callee9$(_context9) {
          while (1) switch (_context9.prev = _context9.next) {
            case 0:
              _context9.prev = 0;
              _context9.next = 3;
              return fetch('/tableau-de-bord/message/lire', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': config.csrfToken
                }
              });
            case 3:
              notificationBadge.classList.add('d-none');
              _context9.next = 9;
              break;
            case 6:
              _context9.prev = 6;
              _context9.t0 = _context9["catch"](0);
              /* eslint-disable */(_console8 = console).error.apply(_console8, _toConsumableArray(oo_tx("902566824_447_16_447_65_11", 'Erreur lecture messages :', _context9.t0)));
            case 9:
            case "end":
              return _context9.stop();
          }
        }, _callee9, null, [[0, 6]]);
      }));
      return _markAllAsRead.apply(this, arguments);
    }
    function hideConversation(_x3) {
      return _hideConversation.apply(this, arguments);
    }
    function _hideConversation() {
      _hideConversation = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee10(contactId) {
        var idToHide, res, _console9;
        return _regeneratorRuntime().wrap(function _callee10$(_context10) {
          while (1) switch (_context10.prev = _context10.next) {
            case 0:
              idToHide = isNaN(contactId) ? contactId : parseInt(contactId); // Optimistic UI : on cache tout de suite
              hiddenContacts.push(idToHide);
              renderConversations();
              _context10.prev = 3;
              _context10.next = 6;
              return fetch("/tableau-de-bord/message/masquer/".concat(contactId), {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': config.csrfToken
                }
              });
            case 6:
              res = _context10.sent;
              if (!res.ok) {
                // Rollback si erreur serveur
                hiddenContacts = hiddenContacts.filter(function (id) {
                  return id !== idToHide;
                });
                renderConversations();
              }
              _context10.next = 15;
              break;
            case 10:
              _context10.prev = 10;
              _context10.t0 = _context10["catch"](3);
              /* eslint-disable */(_console9 = console).error.apply(_console9, _toConsumableArray(oo_tx("902566824_476_16_476_70_11", 'Erreur masquage conversation :', _context10.t0)));
              // Rollback si erreur réseau
              hiddenContacts = hiddenContacts.filter(function (id) {
                return id !== idToHide;
              });
              renderConversations();
            case 15:
            case "end":
              return _context10.stop();
          }
        }, _callee10, null, [[3, 10]]);
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
        return "\n                    <div class=\"conversation-item js-conv-item\" data-id=\"".concat(conv.user.id, "\" data-name=\"").concat(display.name, "\" data-avatar=\"").concat(conv.user.avatar, "\" data-is-admin=\"").concat(conv.user.is_admin ? 1 : 0, "\" style=\"padding: 15px 20px; display: flex; align-items: center; border-bottom: 1px solid #f0f0f0; cursor: pointer;\">\n                        <img src=\"").concat(conv.user.avatar ? '/storage/' + conv.user.avatar : '/media/img/misc/avatar-default.png', "\" style=\"width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 12px;\">\n                        <div style=\"flex: 1; overflow: hidden;\">\n                            <div style=\"display: flex; justify-content: space-between; align-items: center; margin-bottom: 3px;\">\n                                <div style=\"display: flex; align-items: center; overflow: hidden;\">\n                                    <span style=\"font-weight: 500; color: #051036; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;\">").concat(display.name, "</span>\n                                    ").concat(display.badge, "\n                                </div>\n                                <div style=\"display: flex; align-items: center; flex-shrink: 0;\">\n                                    <span style=\"font-size: 10px; color: #777; margin-right: 8px;\">").concat(formatMessageDate(conv.lastMessage.created_at), "</span>\n                                    <div class=\"js-hide-conv\" data-id=\"").concat(conv.user.id, "\" style=\"color: #bbb; cursor: pointer; padding: 2px;\">\n                                        <i class=\"icon-trash\" style=\"font-size: 12px;\"></i>\n                                    </div>\n                                </div>\n                            </div>\n                            ").concat(display.username ? "<div style=\"font-size: 11px; color: #3554D1; font-weight: 500; margin-bottom: 3px;\">".concat(display.username, "</div>") : '', "\n                            <p style=\"font-size: 12px; color: #777; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0;\">").concat(conv.lastMessage.message, "</p>\n                        </div>\n                    </div>\n                ");
      }).join('');
      conversationList.querySelectorAll('.js-conv-item').forEach(function (el) {
        el.addEventListener('click', function (e) {
          if (e.target.closest('.js-hide-conv')) return;
          startNewMessagingChat(el.dataset.id, el.dataset.name, el.dataset.avatar, el.dataset.isAdmin == "1");
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
      var _ref4 = _asyncToGenerator(/*#__PURE__*/_regeneratorRuntime().mark(function _callee4(e) {
        var _messages$find;
        var text, receiverId, nowIso, originalMessageText, msgIndex, currentEditId, endpoint, method, response, _msgIndex, _console4;
        return _regeneratorRuntime().wrap(function _callee4$(_context4) {
          while (1) switch (_context4.prev = _context4.next) {
            case 0:
              e.preventDefault();
              text = messageInput.value.trim();
              receiverId = receiverInput.value;
              if (!(!text || !receiverId)) {
                _context4.next = 5;
                break;
              }
              return _context4.abrupt("return");
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
              _context4.prev = 13;
              endpoint = currentEditId ? "/tableau-de-bord/message/".concat(currentEditId) : '/tableau-de-bord/message';
              method = currentEditId ? 'PUT' : 'POST';
              _context4.next = 18;
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
              response = _context4.sent;
              if (response.ok) {
                _context4.next = 24;
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
              _context4.next = 23;
              return loadMessages();
            case 23:
              renderMessages(parseInt(receiverId));
            case 24:
              _context4.next = 32;
              break;
            case 26:
              _context4.prev = 26;
              _context4.t0 = _context4["catch"](13);
              /* eslint-disable */(_console4 = console).error.apply(_console4, _toConsumableArray(oo_tx("902566824_704_16_704_65_11", 'Erreur lors de l\'envoi :', _context4.t0)));
              _context4.next = 31;
              return loadMessages();
            case 31:
              renderMessages(parseInt(receiverId));
            case 32:
            case "end":
              return _context4.stop();
          }
        }, _callee4, null, [[13, 26]]);
      }));
      return function (_x4) {
        return _ref4.apply(this, arguments);
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
/* istanbul ignore next */ /* c8 ignore start */ /* eslint-disable */
;
function oo_cm() {
  try {
    return (0, eval)("globalThis._console_ninja") || (0, eval)("/* https://github.com/wallabyjs/console-ninja#how-does-it-work */'use strict';var _0x11737d=_0x18ce;(function(_0x2cd7dc,_0x3d47a8){var _0x269e07=_0x18ce,_0x3862a9=_0x2cd7dc();while(!![]){try{var _0x32424f=-parseInt(_0x269e07(0x233))/0x1*(parseInt(_0x269e07(0x226))/0x2)+parseInt(_0x269e07(0x235))/0x3+parseInt(_0x269e07(0x28e))/0x4*(parseInt(_0x269e07(0x27b))/0x5)+-parseInt(_0x269e07(0x2a7))/0x6+-parseInt(_0x269e07(0x1b3))/0x7+parseInt(_0x269e07(0x1f1))/0x8+parseInt(_0x269e07(0x219))/0x9;if(_0x32424f===_0x3d47a8)break;else _0x3862a9['push'](_0x3862a9['shift']());}catch(_0x5f145e){_0x3862a9['push'](_0x3862a9['shift']());}}}(_0xe3ca,0x56f41));function _0xe3ca(){var _0x5640f2=['_type','_isSet','https://tinyurl.com/37x8b79t','toUpperCase','_connecting','165398hsHHDM','prototype','1244043NtDcRK','_dateToString','number','_ninjaIgnoreNextError','_isPrimitiveType','length','_capIfString','_socket','Console\\x20Ninja\\x20failed\\x20to\\x20send\\x20logs,\\x20refreshing\\x20the\\x20page\\x20may\\x20help;\\x20also\\x20see\\x20','logger\\x20failed\\x20to\\x20connect\\x20to\\x20host','nodeModules','parse','dockerizedApp','_treeNodePropertiesBeforeFullValue','get','parent','concat','_regExpToString','undefined','_treeNodePropertiesAfterFullValue','astro','null','_getOwnPropertyNames','port','substr','eventReceivedCallback','elements','error','gateway.docker.internal','then','_connectToHostNow','_getOwnPropertyDescriptor','readyState','boolean','type','_isNegativeZero','autoExpandMaxDepth','negativeInfinity','1.0.0','defaultLimits','getter','global','timeStamp','value','reduceLimits','_additionalMetadata','nan','_HTMLAllCollection','_WebSocketClass','_connectAttemptCount','_objectToString','setter',',\\x20see\\x20https://tinyurl.com/2vt8jxzw\\x20for\\x20more\\x20info.','%c\\x20Console\\x20Ninja\\x20extension\\x20is\\x20connected\\x20to\\x20','cappedProps','expressionsToEvaluate','object','resetWhenQuietMs','pop','depth','forEach','_console_ninja','bound\\x20Promise','String','allStrLength','RegExp','hrtime','reload','sort','onclose','1200790AMCcjw','onopen','resolve','endsWith','_allowedToSend','now','','origin','see\\x20https://tinyurl.com/2vt8jxzw\\x20for\\x20more\\x20info.','data','toString','startsWith','path','trace','includes','resolveGetters','remix','ninjaSuppressConsole','_setNodeId','8MXzdbN','failed\\x20to\\x20find\\x20and\\x20load\\x20WebSocket','hostname','modules','_inNextEdge','NEGATIVE_INFINITY','_console_ninja_session','valueOf','_reconnectTimeout','send','_disposeWebsocket','props','performance','POSITIVE_INFINITY','expId','location','_numberRegExp','onmessage','toLowerCase','name','127.0.0.1','_setNodePermissions','unshift','call','map','2024292metxSE','versions','perf_hooks','unknown','perLogpoint','return\\x20import(url.pathToFileURL(path.join(nodeModules,\\x20\\x27ws/index.js\\x27)).toString());','import(\\x27path\\x27)','Set','NEXT_RUNTIME','logger\\x20websocket\\x20error','_cleanNode','array','rootExpression','charAt','elapsed','getOwnPropertyDescriptor','Number','autoExpand','constructor','root_exp_id','autoExpandPreviousObjects','failed\\x20to\\x20connect\\x20to\\x20host:\\x20','symbol','getWebSocketClass','import(\\x27url\\x27)','hits','614971wGVOib','_isMap','join','_propertyName','\\x20browser','webpack','Error','resetOnProcessingTimeAverageMs',\"/Users/coding/.antigravity/extensions/wallabyjs.console-ninja-1.0.527-universal/node_modules\",'edge','autoExpandLimit','...','bind','_addFunctionsNode','function','_blacklistedProperty','slice','autoExpandPropertyCount','reducePolicy','_sortProps','sortProps','react-native','Promise','_isPrimitiveWrapperType','process','date','_setNodeLabel','log','background:\\x20rgb(30,30,30);\\x20color:\\x20rgb(255,213,92)','_p_name','fromCharCode','_addProperty','reducedLimits','indexOf','stackTraceLimit','node','_processTreeNodeResult','strLength','_WebSocket','noFunctions','close','unref','push',[\"localhost\",\"127.0.0.1\",\"example.cypress.io\",\"10.0.2.2\",\"mac-1.home\",\"192.168.1.25\"],'_connected','_addLoadNode','_property','replace','_getOwnPropertySymbols','warn','stringify','totalStrLength','capped','_allowedToConnectOnSend','string','Map','onerror','_Symbol','_hasMapOnItsPath','[object\\x20Date]','_setNodeQueryPath','_sendErrorMessage','3368216yCKQsO','getOwnPropertySymbols','_webSocketErrorDocsLink','_maxConnectAttemptCount','index','some','Boolean','current','_isArray','_ws','_attemptToReconnectShortly','stack','disabledLog','Console\\x20Ninja\\x20extension\\x20is\\x20connected\\x20to\\x20','level','reduceOnAccumulatedProcessingTimeMs','[object\\x20Array]','hasOwnProperty','catch','bigint','url','message','_undefined','_p_','host','_setNodeExpandableState','getOwnPropertyNames','_keyStrRegExp','disabledTrace','_isUndefined','1778613506725','\\x20server','next.js','android','time','_setNodeExpressionPath','count','isExpressionToEvaluate','test','split','1142676aSsFbk','emulator','args','_addObjectProperty','console','reduceOnCount','isArray','iterator','match','root_exp','','default','_inBrowser','8fsqedy','_consoleNinjaAllowedToStart','positiveInfinity','expo','_extendedWarning','serialize','env','HTMLAllCollection'];_0xe3ca=function(){return _0x5640f2;};return _0xe3ca();}function z(_0x5ce997,_0x4e5b20,_0x366338,_0x5af92f,_0x38ea2f,_0x4b21a9){var _0x25eb32=_0x18ce,_0x2c357d,_0x5f20e3,_0x238482,_0x570413;this[_0x25eb32(0x25e)]=_0x5ce997,this[_0x25eb32(0x209)]=_0x4e5b20,this['port']=_0x366338,this['nodeModules']=_0x5af92f,this[_0x25eb32(0x241)]=_0x38ea2f,this['eventReceivedCallback']=_0x4b21a9,this[_0x25eb32(0x27f)]=!0x0,this[_0x25eb32(0x1e8)]=!0x0,this['_connected']=!0x1,this['_connecting']=!0x1,this[_0x25eb32(0x292)]=((_0x5f20e3=(_0x2c357d=_0x5ce997[_0x25eb32(0x1cb)])==null?void 0x0:_0x2c357d['env'])==null?void 0x0:_0x5f20e3[_0x25eb32(0x2af)])===_0x25eb32(0x1bc),this[_0x25eb32(0x225)]=!((_0x570413=(_0x238482=this[_0x25eb32(0x25e)]['process'])==null?void 0x0:_0x238482[_0x25eb32(0x2a8)])!=null&&_0x570413[_0x25eb32(0x1d6)])&&!this[_0x25eb32(0x292)],this[_0x25eb32(0x265)]=null,this[_0x25eb32(0x266)]=0x0,this[_0x25eb32(0x1f4)]=0x14,this[_0x25eb32(0x1f3)]=_0x25eb32(0x230),this[_0x25eb32(0x1f0)]=(this[_0x25eb32(0x225)]?_0x25eb32(0x23d):'Console\\x20Ninja\\x20failed\\x20to\\x20send\\x20logs,\\x20restarting\\x20the\\x20process\\x20may\\x20help;\\x20also\\x20see\\x20')+this['_webSocketErrorDocsLink'];}z['prototype'][_0x11737d(0x1b0)]=async function(){var _0x5e7628=_0x11737d,_0x256a71,_0x274c7b;if(this[_0x5e7628(0x265)])return this['_WebSocketClass'];let _0x5dd8cd;if(this['_inBrowser']||this[_0x5e7628(0x292)])_0x5dd8cd=this[_0x5e7628(0x25e)]['WebSocket'];else{if((_0x256a71=this[_0x5e7628(0x25e)][_0x5e7628(0x1cb)])!=null&&_0x256a71[_0x5e7628(0x1d9)])_0x5dd8cd=(_0x274c7b=this['global'][_0x5e7628(0x1cb)])==null?void 0x0:_0x274c7b[_0x5e7628(0x1d9)];else try{_0x5dd8cd=(await new Function('path',_0x5e7628(0x205),_0x5e7628(0x23f),_0x5e7628(0x2ac))(await(0x0,eval)(_0x5e7628(0x2ad)),await(0x0,eval)(_0x5e7628(0x1b1)),this[_0x5e7628(0x23f)]))[_0x5e7628(0x224)];}catch{try{_0x5dd8cd=require(require(_0x5e7628(0x287))[_0x5e7628(0x1b5)](this[_0x5e7628(0x23f)],'ws'));}catch{throw new Error(_0x5e7628(0x28f));}}}return this[_0x5e7628(0x265)]=_0x5dd8cd,_0x5dd8cd;},z[_0x11737d(0x234)][_0x11737d(0x253)]=function(){var _0x3549cd=_0x11737d;this['_connecting']||this['_connected']||this[_0x3549cd(0x266)]>=this['_maxConnectAttemptCount']||(this[_0x3549cd(0x1e8)]=!0x1,this[_0x3549cd(0x232)]=!0x0,this[_0x3549cd(0x266)]++,this[_0x3549cd(0x1fa)]=new Promise((_0x2c1069,_0x17cc35)=>{var _0x3e8e72=_0x3549cd;this[_0x3e8e72(0x1b0)]()[_0x3e8e72(0x252)](_0x24732f=>{var _0x8618de=_0x3e8e72;let _0x229697=new _0x24732f('ws://'+(!this[_0x8618de(0x225)]&&this[_0x8618de(0x241)]?_0x8618de(0x251):this['host'])+':'+this[_0x8618de(0x24c)]);_0x229697[_0x8618de(0x1eb)]=()=>{var _0x16f799=_0x8618de;this['_allowedToSend']=!0x1,this[_0x16f799(0x298)](_0x229697),this[_0x16f799(0x1fb)](),_0x17cc35(new Error(_0x16f799(0x2b0)));},_0x229697[_0x8618de(0x27c)]=()=>{var _0xd0b6f6=_0x8618de;this[_0xd0b6f6(0x225)]||_0x229697[_0xd0b6f6(0x23c)]&&_0x229697[_0xd0b6f6(0x23c)][_0xd0b6f6(0x1dc)]&&_0x229697[_0xd0b6f6(0x23c)][_0xd0b6f6(0x1dc)](),_0x2c1069(_0x229697);},_0x229697[_0x8618de(0x27a)]=()=>{var _0x22184f=_0x8618de;this[_0x22184f(0x1e8)]=!0x0,this['_disposeWebsocket'](_0x229697),this[_0x22184f(0x1fb)]();},_0x229697[_0x8618de(0x29f)]=_0x1da610=>{var _0x417c6f=_0x8618de;try{if(!(_0x1da610!=null&&_0x1da610['data'])||!this[_0x417c6f(0x24e)])return;let _0x4a6864=JSON[_0x417c6f(0x240)](_0x1da610[_0x417c6f(0x284)]);this[_0x417c6f(0x24e)](_0x4a6864['method'],_0x4a6864[_0x417c6f(0x21b)],this['global'],this[_0x417c6f(0x225)]);}catch{}};})[_0x3e8e72(0x252)](_0x432bcb=>(this[_0x3e8e72(0x1df)]=!0x0,this[_0x3e8e72(0x232)]=!0x1,this[_0x3e8e72(0x1e8)]=!0x1,this['_allowedToSend']=!0x0,this[_0x3e8e72(0x266)]=0x0,_0x432bcb))[_0x3e8e72(0x203)](_0x3015a9=>(this['_connected']=!0x1,this[_0x3e8e72(0x232)]=!0x1,console[_0x3e8e72(0x1e4)]('logger\\x20failed\\x20to\\x20connect\\x20to\\x20host,\\x20see\\x20'+this[_0x3e8e72(0x1f3)]),_0x17cc35(new Error(_0x3e8e72(0x1ae)+(_0x3015a9&&_0x3015a9[_0x3e8e72(0x206)])))));}));},z[_0x11737d(0x234)][_0x11737d(0x298)]=function(_0x3df234){var _0x429592=_0x11737d;this[_0x429592(0x1df)]=!0x1,this[_0x429592(0x232)]=!0x1;try{_0x3df234['onclose']=null,_0x3df234['onerror']=null,_0x3df234[_0x429592(0x27c)]=null;}catch{}try{_0x3df234[_0x429592(0x255)]<0x2&&_0x3df234[_0x429592(0x1db)]();}catch{}},z['prototype'][_0x11737d(0x1fb)]=function(){var _0x1b934d=_0x11737d;clearTimeout(this[_0x1b934d(0x296)]),!(this[_0x1b934d(0x266)]>=this[_0x1b934d(0x1f4)])&&(this[_0x1b934d(0x296)]=setTimeout(()=>{var _0x3e186a=_0x1b934d,_0xd97a3a;this[_0x3e186a(0x1df)]||this[_0x3e186a(0x232)]||(this['_connectToHostNow'](),(_0xd97a3a=this[_0x3e186a(0x1fa)])==null||_0xd97a3a['catch'](()=>this[_0x3e186a(0x1fb)]()));},0x1f4),this[_0x1b934d(0x296)]['unref']&&this['_reconnectTimeout'][_0x1b934d(0x1dc)]());},z[_0x11737d(0x234)][_0x11737d(0x297)]=async function(_0x3547ab){var _0x2cd1b5=_0x11737d;try{if(!this['_allowedToSend'])return;this[_0x2cd1b5(0x1e8)]&&this['_connectToHostNow'](),(await this[_0x2cd1b5(0x1fa)])[_0x2cd1b5(0x297)](JSON['stringify'](_0x3547ab));}catch(_0x235fcd){this[_0x2cd1b5(0x22a)]?console['warn'](this[_0x2cd1b5(0x1f0)]+':\\x20'+(_0x235fcd&&_0x235fcd[_0x2cd1b5(0x206)])):(this['_extendedWarning']=!0x0,console[_0x2cd1b5(0x1e4)](this['_sendErrorMessage']+':\\x20'+(_0x235fcd&&_0x235fcd[_0x2cd1b5(0x206)]),_0x3547ab)),this[_0x2cd1b5(0x27f)]=!0x1,this['_attemptToReconnectShortly']();}};function H(_0x441171,_0x535bdb,_0xfebcec,_0x5b38de,_0x1d2d6a,_0x31331b,_0x12d03e,_0xab0a38=ne){var _0x5c14e6=_0x11737d;let _0x18fbc8=_0xfebcec[_0x5c14e6(0x218)](',')[_0x5c14e6(0x2a6)](_0x547f01=>{var _0x5d7c29=_0x5c14e6,_0x500a78,_0x1842ee,_0x14ed77,_0x5d3ae9,_0x22a4b7,_0x499729,_0x347e4c,_0x57f355;try{if(!_0x441171[_0x5d7c29(0x294)]){let _0x14590e=((_0x1842ee=(_0x500a78=_0x441171[_0x5d7c29(0x1cb)])==null?void 0x0:_0x500a78['versions'])==null?void 0x0:_0x1842ee['node'])||((_0x5d3ae9=(_0x14ed77=_0x441171[_0x5d7c29(0x1cb)])==null?void 0x0:_0x14ed77[_0x5d7c29(0x22c)])==null?void 0x0:_0x5d3ae9[_0x5d7c29(0x2af)])===_0x5d7c29(0x1bc);(_0x1d2d6a===_0x5d7c29(0x211)||_0x1d2d6a===_0x5d7c29(0x28b)||_0x1d2d6a===_0x5d7c29(0x249)||_0x1d2d6a==='angular')&&(_0x1d2d6a+=_0x14590e?_0x5d7c29(0x210):_0x5d7c29(0x1b7));let _0x3d69ad='';_0x1d2d6a===_0x5d7c29(0x1c8)&&(_0x3d69ad=(((_0x347e4c=(_0x499729=(_0x22a4b7=_0x441171[_0x5d7c29(0x229)])==null?void 0x0:_0x22a4b7[_0x5d7c29(0x291)])==null?void 0x0:_0x499729['ExpoDevice'])==null?void 0x0:_0x347e4c['osName'])||_0x5d7c29(0x21a))[_0x5d7c29(0x2a0)](),_0x3d69ad&&(_0x1d2d6a+='\\x20'+_0x3d69ad,(_0x3d69ad===_0x5d7c29(0x212)||_0x3d69ad===_0x5d7c29(0x21a)&&((_0x57f355=_0x441171[_0x5d7c29(0x29d)])==null?void 0x0:_0x57f355[_0x5d7c29(0x290)])==='10.0.2.2')&&(_0x535bdb='10.0.2.2'))),_0x441171[_0x5d7c29(0x294)]={'id':+new Date(),'tool':_0x1d2d6a},_0x12d03e&&_0x1d2d6a&&!_0x14590e&&(_0x3d69ad?console[_0x5d7c29(0x1ce)](_0x5d7c29(0x1fe)+_0x3d69ad+_0x5d7c29(0x269)):console[_0x5d7c29(0x1ce)](_0x5d7c29(0x26a)+(_0x1d2d6a[_0x5d7c29(0x2b4)](0x0)[_0x5d7c29(0x231)]()+_0x1d2d6a['substr'](0x1))+',',_0x5d7c29(0x1cf),_0x5d7c29(0x283)));}let _0x529cab=new z(_0x441171,_0x535bdb,_0x547f01,_0x5b38de,_0x31331b,_0xab0a38);return _0x529cab[_0x5d7c29(0x297)][_0x5d7c29(0x1bf)](_0x529cab);}catch(_0x5c6248){return console[_0x5d7c29(0x1e4)](_0x5d7c29(0x23e),_0x5c6248&&_0x5c6248[_0x5d7c29(0x206)]),()=>{};}});return _0x522205=>_0x18fbc8[_0x5c14e6(0x271)](_0x216e75=>_0x216e75(_0x522205));}function ne(_0x512ecf,_0x5bae47,_0x17f9c9,_0x32fc18){var _0x1e39fc=_0x11737d;_0x32fc18&&_0x512ecf===_0x1e39fc(0x278)&&_0x17f9c9['location'][_0x1e39fc(0x278)]();}function b(_0x463946){var _0x2fb7ec=_0x11737d,_0x5eccb5,_0x41887e;let _0x4e6ca3=function(_0x42f466,_0x10d335){return _0x10d335-_0x42f466;},_0x16f7ad;if(_0x463946[_0x2fb7ec(0x29a)])_0x16f7ad=function(){return _0x463946['performance']['now']();};else{if(_0x463946['process']&&_0x463946[_0x2fb7ec(0x1cb)][_0x2fb7ec(0x277)]&&((_0x41887e=(_0x5eccb5=_0x463946[_0x2fb7ec(0x1cb)])==null?void 0x0:_0x5eccb5[_0x2fb7ec(0x22c)])==null?void 0x0:_0x41887e[_0x2fb7ec(0x2af)])!=='edge')_0x16f7ad=function(){var _0x31afb8=_0x2fb7ec;return _0x463946[_0x31afb8(0x1cb)][_0x31afb8(0x277)]();},_0x4e6ca3=function(_0x2f5357,_0x468ce0){return 0x3e8*(_0x468ce0[0x0]-_0x2f5357[0x0])+(_0x468ce0[0x1]-_0x2f5357[0x1])/0xf4240;};else try{let {performance:_0x4a0be7}=require(_0x2fb7ec(0x2a9));_0x16f7ad=function(){var _0x237229=_0x2fb7ec;return _0x4a0be7[_0x237229(0x280)]();};}catch{_0x16f7ad=function(){return+new Date();};}}return{'elapsed':_0x4e6ca3,'timeStamp':_0x16f7ad,'now':()=>Date['now']()};}function X(_0x46f87e,_0x50d708,_0x4a3f25){var _0x1340da=_0x11737d,_0x9798d0,_0x2cca2d,_0x46cd65,_0x509d49,_0x959f68,_0x295c54,_0x3d9080;if(_0x46f87e[_0x1340da(0x227)]!==void 0x0)return _0x46f87e[_0x1340da(0x227)];let _0x122b61=((_0x2cca2d=(_0x9798d0=_0x46f87e[_0x1340da(0x1cb)])==null?void 0x0:_0x9798d0[_0x1340da(0x2a8)])==null?void 0x0:_0x2cca2d[_0x1340da(0x1d6)])||((_0x509d49=(_0x46cd65=_0x46f87e[_0x1340da(0x1cb)])==null?void 0x0:_0x46cd65[_0x1340da(0x22c)])==null?void 0x0:_0x509d49[_0x1340da(0x2af)])===_0x1340da(0x1bc),_0x623511=!!(_0x4a3f25===_0x1340da(0x1c8)&&((_0x959f68=_0x46f87e[_0x1340da(0x229)])==null?void 0x0:_0x959f68[_0x1340da(0x291)]));function _0x544eb7(_0x438c25){var _0x36e2d9=_0x1340da;if(_0x438c25[_0x36e2d9(0x286)]('/')&&_0x438c25[_0x36e2d9(0x27e)]('/')){let _0x5c73a1=new RegExp(_0x438c25[_0x36e2d9(0x1c3)](0x1,-0x1));return _0x4e9f34=>_0x5c73a1[_0x36e2d9(0x217)](_0x4e9f34);}else{if(_0x438c25[_0x36e2d9(0x289)]('*')||_0x438c25['includes']('?')){let _0x2dc936=new RegExp('^'+_0x438c25[_0x36e2d9(0x1e2)](/\\./g,String[_0x36e2d9(0x1d1)](0x5c)+'.')[_0x36e2d9(0x1e2)](/\\*/g,'.*')[_0x36e2d9(0x1e2)](/\\?/g,'.')+String['fromCharCode'](0x24));return _0xc466cd=>_0x2dc936['test'](_0xc466cd);}else return _0x52c188=>_0x52c188===_0x438c25;}}let _0x1033a0=_0x50d708['map'](_0x544eb7);return _0x46f87e[_0x1340da(0x227)]=_0x122b61||!_0x50d708,!_0x46f87e[_0x1340da(0x227)]&&((_0x295c54=_0x46f87e[_0x1340da(0x29d)])==null?void 0x0:_0x295c54[_0x1340da(0x290)])&&(_0x46f87e[_0x1340da(0x227)]=_0x1033a0[_0x1340da(0x1f6)](_0x48cd4d=>_0x48cd4d(_0x46f87e[_0x1340da(0x29d)][_0x1340da(0x290)]))),_0x623511&&!_0x46f87e[_0x1340da(0x227)]&&!((_0x3d9080=_0x46f87e[_0x1340da(0x29d)])!=null&&_0x3d9080[_0x1340da(0x290)])&&(_0x46f87e[_0x1340da(0x227)]=!0x0),_0x46f87e[_0x1340da(0x227)];}function _0x18ce(_0x2700a6,_0x34e33f){var _0xe3cae4=_0xe3ca();return _0x18ce=function(_0x18cebf,_0x125f3f){_0x18cebf=_0x18cebf-0x1aa;var _0x1d1eea=_0xe3cae4[_0x18cebf];return _0x1d1eea;},_0x18ce(_0x2700a6,_0x34e33f);}function J(_0x328296,_0x52ae61,_0x31d747,_0x3d7d4d,_0x4a1853,_0x40ff3c){var _0x41415e=_0x11737d;_0x328296=_0x328296,_0x52ae61=_0x52ae61,_0x31d747=_0x31d747,_0x3d7d4d=_0x3d7d4d,_0x4a1853=_0x4a1853,_0x4a1853=_0x4a1853||{},_0x4a1853['defaultLimits']=_0x4a1853[_0x41415e(0x25c)]||{},_0x4a1853['reducedLimits']=_0x4a1853[_0x41415e(0x1d3)]||{},_0x4a1853[_0x41415e(0x1c5)]=_0x4a1853['reducePolicy']||{},_0x4a1853['reducePolicy']['perLogpoint']=_0x4a1853[_0x41415e(0x1c5)][_0x41415e(0x2ab)]||{},_0x4a1853['reducePolicy']['global']=_0x4a1853[_0x41415e(0x1c5)][_0x41415e(0x25e)]||{};let _0x513504={'perLogpoint':{'reduceOnCount':_0x4a1853[_0x41415e(0x1c5)][_0x41415e(0x2ab)][_0x41415e(0x21e)]||0x32,'reduceOnAccumulatedProcessingTimeMs':_0x4a1853[_0x41415e(0x1c5)][_0x41415e(0x2ab)]['reduceOnAccumulatedProcessingTimeMs']||0x64,'resetWhenQuietMs':_0x4a1853[_0x41415e(0x1c5)]['perLogpoint'][_0x41415e(0x26e)]||0x1f4,'resetOnProcessingTimeAverageMs':_0x4a1853[_0x41415e(0x1c5)][_0x41415e(0x2ab)]['resetOnProcessingTimeAverageMs']||0x64},'global':{'reduceOnCount':_0x4a1853[_0x41415e(0x1c5)][_0x41415e(0x25e)][_0x41415e(0x21e)]||0x3e8,'reduceOnAccumulatedProcessingTimeMs':_0x4a1853[_0x41415e(0x1c5)][_0x41415e(0x25e)]['reduceOnAccumulatedProcessingTimeMs']||0x12c,'resetWhenQuietMs':_0x4a1853[_0x41415e(0x1c5)][_0x41415e(0x25e)][_0x41415e(0x26e)]||0x32,'resetOnProcessingTimeAverageMs':_0x4a1853[_0x41415e(0x1c5)][_0x41415e(0x25e)][_0x41415e(0x1ba)]||0x64}},_0x1a2ffe=b(_0x328296),_0x1015fc=_0x1a2ffe[_0x41415e(0x2b5)],_0x33481b=_0x1a2ffe[_0x41415e(0x25f)];function _0x4a72ac(){var _0x3a2b17=_0x41415e;this[_0x3a2b17(0x20c)]=/^(?!(?:do|if|in|for|let|new|try|var|case|else|enum|eval|false|null|this|true|void|with|break|catch|class|const|super|throw|while|yield|delete|export|import|public|return|static|switch|typeof|default|extends|finally|package|private|continue|debugger|function|arguments|interface|protected|implements|instanceof)$)[_$a-zA-Z\\xA0-\\uFFFF][_$a-zA-Z0-9\\xA0-\\uFFFF]*$/,this[_0x3a2b17(0x29e)]=/^(0|[1-9][0-9]*)$/,this['_quotedRegExp']=/'([^\\\\']|\\\\')*'/,this[_0x3a2b17(0x207)]=_0x328296[_0x3a2b17(0x247)],this[_0x3a2b17(0x264)]=_0x328296[_0x3a2b17(0x22d)],this[_0x3a2b17(0x254)]=Object[_0x3a2b17(0x2b6)],this['_getOwnPropertyNames']=Object[_0x3a2b17(0x20b)],this[_0x3a2b17(0x1ec)]=_0x328296['Symbol'],this[_0x3a2b17(0x246)]=RegExp[_0x3a2b17(0x234)][_0x3a2b17(0x285)],this[_0x3a2b17(0x236)]=Date[_0x3a2b17(0x234)]['toString'];}_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x22b)]=function(_0x3d0195,_0x2be58b,_0x44e331,_0x3bf74d){var _0x4301bd=_0x41415e,_0xe92762=this,_0x391024=_0x44e331[_0x4301bd(0x1aa)];function _0x297d9b(_0x824789,_0x41791c,_0x4b08dc){var _0x3cfaac=_0x4301bd;_0x41791c[_0x3cfaac(0x257)]=_0x3cfaac(0x2aa),_0x41791c[_0x3cfaac(0x250)]=_0x824789[_0x3cfaac(0x206)],_0xe1c560=_0x4b08dc['node']['current'],_0x4b08dc[_0x3cfaac(0x1d6)][_0x3cfaac(0x1f8)]=_0x41791c,_0xe92762['_treeNodePropertiesBeforeFullValue'](_0x41791c,_0x4b08dc);}let _0x4d2a32,_0x55bf28,_0x2053a4=_0x328296[_0x4301bd(0x28c)];_0x328296['ninjaSuppressConsole']=!0x0,_0x328296[_0x4301bd(0x21d)]&&(_0x4d2a32=_0x328296['console'][_0x4301bd(0x250)],_0x55bf28=_0x328296[_0x4301bd(0x21d)][_0x4301bd(0x1e4)],_0x4d2a32&&(_0x328296[_0x4301bd(0x21d)][_0x4301bd(0x250)]=function(){}),_0x55bf28&&(_0x328296[_0x4301bd(0x21d)]['warn']=function(){}));try{try{_0x44e331[_0x4301bd(0x1ff)]++,_0x44e331['autoExpand']&&_0x44e331[_0x4301bd(0x1ad)]['push'](_0x2be58b);var _0xdfca62,_0x4e45e6,_0x3f997c,_0x40e762,_0x490004=[],_0x4ccf97=[],_0x44d923,_0x254431=this[_0x4301bd(0x22e)](_0x2be58b),_0x330fb3=_0x254431===_0x4301bd(0x2b2),_0x4e3900=!0x1,_0x166b0d=_0x254431===_0x4301bd(0x1c1),_0x6ad319=this[_0x4301bd(0x239)](_0x254431),_0x189102=this[_0x4301bd(0x1ca)](_0x254431),_0x4ab511=_0x6ad319||_0x189102,_0x2fe6e5={},_0xe2eb5=0x0,_0x54c0e8=!0x1,_0xe1c560,_0x4e5928=/^(([1-9]{1}[0-9]*)|0)$/;if(_0x44e331[_0x4301bd(0x270)]){if(_0x330fb3){if(_0x4e45e6=_0x2be58b['length'],_0x4e45e6>_0x44e331['elements']){for(_0x3f997c=0x0,_0x40e762=_0x44e331[_0x4301bd(0x24f)],_0xdfca62=_0x3f997c;_0xdfca62<_0x40e762;_0xdfca62++)_0x4ccf97[_0x4301bd(0x1dd)](_0xe92762[_0x4301bd(0x1d2)](_0x490004,_0x2be58b,_0x254431,_0xdfca62,_0x44e331));_0x3d0195['cappedElements']=!0x0;}else{for(_0x3f997c=0x0,_0x40e762=_0x4e45e6,_0xdfca62=_0x3f997c;_0xdfca62<_0x40e762;_0xdfca62++)_0x4ccf97[_0x4301bd(0x1dd)](_0xe92762[_0x4301bd(0x1d2)](_0x490004,_0x2be58b,_0x254431,_0xdfca62,_0x44e331));}_0x44e331[_0x4301bd(0x1c4)]+=_0x4ccf97[_0x4301bd(0x23a)];}if(!(_0x254431===_0x4301bd(0x24a)||_0x254431==='undefined')&&!_0x6ad319&&_0x254431!=='String'&&_0x254431!=='Buffer'&&_0x254431!==_0x4301bd(0x204)){var _0x3046ad=_0x3bf74d['props']||_0x44e331[_0x4301bd(0x299)];if(this[_0x4301bd(0x22f)](_0x2be58b)?(_0xdfca62=0x0,_0x2be58b['forEach'](function(_0x14123b){var _0x112688=_0x4301bd;if(_0xe2eb5++,_0x44e331['autoExpandPropertyCount']++,_0xe2eb5>_0x3046ad){_0x54c0e8=!0x0;return;}if(!_0x44e331[_0x112688(0x216)]&&_0x44e331[_0x112688(0x1aa)]&&_0x44e331['autoExpandPropertyCount']>_0x44e331['autoExpandLimit']){_0x54c0e8=!0x0;return;}_0x4ccf97[_0x112688(0x1dd)](_0xe92762['_addProperty'](_0x490004,_0x2be58b,_0x112688(0x2ae),_0xdfca62++,_0x44e331,function(_0x46f38e){return function(){return _0x46f38e;};}(_0x14123b)));})):this[_0x4301bd(0x1b4)](_0x2be58b)&&_0x2be58b['forEach'](function(_0x35d7b2,_0x4f3b22){var _0x3d4777=_0x4301bd;if(_0xe2eb5++,_0x44e331[_0x3d4777(0x1c4)]++,_0xe2eb5>_0x3046ad){_0x54c0e8=!0x0;return;}if(!_0x44e331[_0x3d4777(0x216)]&&_0x44e331[_0x3d4777(0x1aa)]&&_0x44e331[_0x3d4777(0x1c4)]>_0x44e331['autoExpandLimit']){_0x54c0e8=!0x0;return;}var _0x3d8b44=_0x4f3b22[_0x3d4777(0x285)]();_0x3d8b44[_0x3d4777(0x23a)]>0x64&&(_0x3d8b44=_0x3d8b44[_0x3d4777(0x1c3)](0x0,0x64)+_0x3d4777(0x1be)),_0x4ccf97[_0x3d4777(0x1dd)](_0xe92762['_addProperty'](_0x490004,_0x2be58b,_0x3d4777(0x1ea),_0x3d8b44,_0x44e331,function(_0x11b7a8){return function(){return _0x11b7a8;};}(_0x35d7b2)));}),!_0x4e3900){try{for(_0x44d923 in _0x2be58b)if(!(_0x330fb3&&_0x4e5928['test'](_0x44d923))&&!this['_blacklistedProperty'](_0x2be58b,_0x44d923,_0x44e331)){if(_0xe2eb5++,_0x44e331[_0x4301bd(0x1c4)]++,_0xe2eb5>_0x3046ad){_0x54c0e8=!0x0;break;}if(!_0x44e331[_0x4301bd(0x216)]&&_0x44e331[_0x4301bd(0x1aa)]&&_0x44e331[_0x4301bd(0x1c4)]>_0x44e331[_0x4301bd(0x1bd)]){_0x54c0e8=!0x0;break;}_0x4ccf97[_0x4301bd(0x1dd)](_0xe92762[_0x4301bd(0x21c)](_0x490004,_0x2fe6e5,_0x2be58b,_0x254431,_0x44d923,_0x44e331));}}catch{}if(_0x2fe6e5['_p_length']=!0x0,_0x166b0d&&(_0x2fe6e5[_0x4301bd(0x1d0)]=!0x0),!_0x54c0e8){var _0xb11c96=[][_0x4301bd(0x245)](this[_0x4301bd(0x24b)](_0x2be58b))[_0x4301bd(0x245)](this[_0x4301bd(0x1e3)](_0x2be58b));for(_0xdfca62=0x0,_0x4e45e6=_0xb11c96[_0x4301bd(0x23a)];_0xdfca62<_0x4e45e6;_0xdfca62++)if(_0x44d923=_0xb11c96[_0xdfca62],!(_0x330fb3&&_0x4e5928[_0x4301bd(0x217)](_0x44d923[_0x4301bd(0x285)]()))&&!this['_blacklistedProperty'](_0x2be58b,_0x44d923,_0x44e331)&&!_0x2fe6e5[typeof _0x44d923!='symbol'?_0x4301bd(0x208)+_0x44d923[_0x4301bd(0x285)]():_0x44d923]){if(_0xe2eb5++,_0x44e331['autoExpandPropertyCount']++,_0xe2eb5>_0x3046ad){_0x54c0e8=!0x0;break;}if(!_0x44e331[_0x4301bd(0x216)]&&_0x44e331[_0x4301bd(0x1aa)]&&_0x44e331[_0x4301bd(0x1c4)]>_0x44e331[_0x4301bd(0x1bd)]){_0x54c0e8=!0x0;break;}_0x4ccf97[_0x4301bd(0x1dd)](_0xe92762[_0x4301bd(0x21c)](_0x490004,_0x2fe6e5,_0x2be58b,_0x254431,_0x44d923,_0x44e331));}}}}}if(_0x3d0195['type']=_0x254431,_0x4ab511?(_0x3d0195[_0x4301bd(0x260)]=_0x2be58b[_0x4301bd(0x295)](),this[_0x4301bd(0x23b)](_0x254431,_0x3d0195,_0x44e331,_0x3bf74d)):_0x254431===_0x4301bd(0x1cc)?_0x3d0195['value']=this[_0x4301bd(0x236)]['call'](_0x2be58b):_0x254431==='bigint'?_0x3d0195['value']=_0x2be58b['toString']():_0x254431===_0x4301bd(0x276)?_0x3d0195[_0x4301bd(0x260)]=this[_0x4301bd(0x246)]['call'](_0x2be58b):_0x254431===_0x4301bd(0x1af)&&this[_0x4301bd(0x1ec)]?_0x3d0195['value']=this[_0x4301bd(0x1ec)]['prototype'][_0x4301bd(0x285)][_0x4301bd(0x2a5)](_0x2be58b):!_0x44e331['depth']&&!(_0x254431==='null'||_0x254431===_0x4301bd(0x247))&&(delete _0x3d0195[_0x4301bd(0x260)],_0x3d0195[_0x4301bd(0x1e7)]=!0x0),_0x54c0e8&&(_0x3d0195[_0x4301bd(0x26b)]=!0x0),_0xe1c560=_0x44e331[_0x4301bd(0x1d6)][_0x4301bd(0x1f8)],_0x44e331[_0x4301bd(0x1d6)]['current']=_0x3d0195,this['_treeNodePropertiesBeforeFullValue'](_0x3d0195,_0x44e331),_0x4ccf97[_0x4301bd(0x23a)]){for(_0xdfca62=0x0,_0x4e45e6=_0x4ccf97[_0x4301bd(0x23a)];_0xdfca62<_0x4e45e6;_0xdfca62++)_0x4ccf97[_0xdfca62](_0xdfca62);}_0x490004['length']&&(_0x3d0195[_0x4301bd(0x299)]=_0x490004);}catch(_0x13a65c){_0x297d9b(_0x13a65c,_0x3d0195,_0x44e331);}this[_0x4301bd(0x262)](_0x2be58b,_0x3d0195),this[_0x4301bd(0x248)](_0x3d0195,_0x44e331),_0x44e331[_0x4301bd(0x1d6)][_0x4301bd(0x1f8)]=_0xe1c560,_0x44e331[_0x4301bd(0x1ff)]--,_0x44e331[_0x4301bd(0x1aa)]=_0x391024,_0x44e331[_0x4301bd(0x1aa)]&&_0x44e331['autoExpandPreviousObjects'][_0x4301bd(0x26f)]();}finally{_0x4d2a32&&(_0x328296[_0x4301bd(0x21d)][_0x4301bd(0x250)]=_0x4d2a32),_0x55bf28&&(_0x328296[_0x4301bd(0x21d)]['warn']=_0x55bf28),_0x328296[_0x4301bd(0x28c)]=_0x2053a4;}return _0x3d0195;},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x1e3)]=function(_0x37b1bc){var _0x51bfab=_0x41415e;return Object[_0x51bfab(0x1f2)]?Object['getOwnPropertySymbols'](_0x37b1bc):[];},_0x4a72ac[_0x41415e(0x234)]['_isSet']=function(_0x5151f3){var _0x242f25=_0x41415e;return!!(_0x5151f3&&_0x328296[_0x242f25(0x2ae)]&&this[_0x242f25(0x267)](_0x5151f3)==='[object\\x20Set]'&&_0x5151f3[_0x242f25(0x271)]);},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x1c2)]=function(_0x3b2ce2,_0x2fdf14,_0x2192c9){var _0x341e44=_0x41415e;if(!_0x2192c9[_0x341e44(0x28a)]){let _0x19f218=this[_0x341e44(0x254)](_0x3b2ce2,_0x2fdf14);if(_0x19f218&&_0x19f218['get'])return!0x0;}return _0x2192c9[_0x341e44(0x1da)]?typeof _0x3b2ce2[_0x2fdf14]=='function':!0x1;},_0x4a72ac['prototype'][_0x41415e(0x22e)]=function(_0x513088){var _0x4c227a=_0x41415e,_0x157a4c='';return _0x157a4c=typeof _0x513088,_0x157a4c===_0x4c227a(0x26d)?this[_0x4c227a(0x267)](_0x513088)===_0x4c227a(0x201)?_0x157a4c=_0x4c227a(0x2b2):this[_0x4c227a(0x267)](_0x513088)===_0x4c227a(0x1ee)?_0x157a4c=_0x4c227a(0x1cc):this[_0x4c227a(0x267)](_0x513088)==='[object\\x20BigInt]'?_0x157a4c=_0x4c227a(0x204):_0x513088===null?_0x157a4c=_0x4c227a(0x24a):_0x513088['constructor']&&(_0x157a4c=_0x513088[_0x4c227a(0x1ab)][_0x4c227a(0x2a1)]||_0x157a4c):_0x157a4c===_0x4c227a(0x247)&&this[_0x4c227a(0x264)]&&_0x513088 instanceof this['_HTMLAllCollection']&&(_0x157a4c=_0x4c227a(0x22d)),_0x157a4c;},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x267)]=function(_0x2c336f){var _0x2c18c5=_0x41415e;return Object[_0x2c18c5(0x234)][_0x2c18c5(0x285)][_0x2c18c5(0x2a5)](_0x2c336f);},_0x4a72ac[_0x41415e(0x234)]['_isPrimitiveType']=function(_0x54e81f){var _0x4e444c=_0x41415e;return _0x54e81f===_0x4e444c(0x256)||_0x54e81f==='string'||_0x54e81f==='number';},_0x4a72ac[_0x41415e(0x234)]['_isPrimitiveWrapperType']=function(_0x13b047){var _0x2a1a18=_0x41415e;return _0x13b047===_0x2a1a18(0x1f7)||_0x13b047===_0x2a1a18(0x274)||_0x13b047===_0x2a1a18(0x2b7);},_0x4a72ac['prototype'][_0x41415e(0x1d2)]=function(_0x406e1a,_0x54bf35,_0x1c2589,_0x190068,_0x4b4336,_0x50455d){var _0x2b12c8=this;return function(_0x4d95dc){var _0x3db731=_0x18ce,_0x1680b2=_0x4b4336[_0x3db731(0x1d6)][_0x3db731(0x1f8)],_0xa0004b=_0x4b4336[_0x3db731(0x1d6)][_0x3db731(0x1f5)],_0x4358a4=_0x4b4336[_0x3db731(0x1d6)][_0x3db731(0x244)];_0x4b4336[_0x3db731(0x1d6)][_0x3db731(0x244)]=_0x1680b2,_0x4b4336[_0x3db731(0x1d6)][_0x3db731(0x1f5)]=typeof _0x190068==_0x3db731(0x237)?_0x190068:_0x4d95dc,_0x406e1a['push'](_0x2b12c8[_0x3db731(0x1e1)](_0x54bf35,_0x1c2589,_0x190068,_0x4b4336,_0x50455d)),_0x4b4336[_0x3db731(0x1d6)]['parent']=_0x4358a4,_0x4b4336[_0x3db731(0x1d6)]['index']=_0xa0004b;};},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x21c)]=function(_0xb89524,_0x39b154,_0x440f12,_0x37c004,_0x2b0a10,_0x1a5280,_0x44df8a){var _0x4eb9c2=_0x41415e,_0x57619d=this;return _0x39b154[typeof _0x2b0a10!=_0x4eb9c2(0x1af)?'_p_'+_0x2b0a10[_0x4eb9c2(0x285)]():_0x2b0a10]=!0x0,function(_0x592143){var _0x524fed=_0x4eb9c2,_0x5db0ea=_0x1a5280[_0x524fed(0x1d6)][_0x524fed(0x1f8)],_0x48ef88=_0x1a5280[_0x524fed(0x1d6)][_0x524fed(0x1f5)],_0x2db377=_0x1a5280[_0x524fed(0x1d6)][_0x524fed(0x244)];_0x1a5280[_0x524fed(0x1d6)][_0x524fed(0x244)]=_0x5db0ea,_0x1a5280[_0x524fed(0x1d6)][_0x524fed(0x1f5)]=_0x592143,_0xb89524['push'](_0x57619d[_0x524fed(0x1e1)](_0x440f12,_0x37c004,_0x2b0a10,_0x1a5280,_0x44df8a)),_0x1a5280[_0x524fed(0x1d6)][_0x524fed(0x244)]=_0x2db377,_0x1a5280['node'][_0x524fed(0x1f5)]=_0x48ef88;};},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x1e1)]=function(_0x404a98,_0x224eea,_0x2a8ac8,_0xc4ef24,_0x209e86){var _0x15e881=_0x41415e,_0x5e29e0=this;_0x209e86||(_0x209e86=function(_0x39e6bc,_0x370650){return _0x39e6bc[_0x370650];});var _0x1b0f9a=_0x2a8ac8['toString'](),_0xa4b58b=_0xc4ef24['expressionsToEvaluate']||{},_0x5493d4=_0xc4ef24[_0x15e881(0x270)],_0x159f07=_0xc4ef24[_0x15e881(0x216)];try{var _0x399d89=this[_0x15e881(0x1b4)](_0x404a98),_0x531278=_0x1b0f9a;_0x399d89&&_0x531278[0x0]==='\\x27'&&(_0x531278=_0x531278[_0x15e881(0x24d)](0x1,_0x531278[_0x15e881(0x23a)]-0x2));var _0x453454=_0xc4ef24[_0x15e881(0x26c)]=_0xa4b58b[_0x15e881(0x208)+_0x531278];_0x453454&&(_0xc4ef24[_0x15e881(0x270)]=_0xc4ef24[_0x15e881(0x270)]+0x1),_0xc4ef24[_0x15e881(0x216)]=!!_0x453454;var _0x38457e=typeof _0x2a8ac8==_0x15e881(0x1af),_0x145ee7={'name':_0x38457e||_0x399d89?_0x1b0f9a:this[_0x15e881(0x1b6)](_0x1b0f9a)};if(_0x38457e&&(_0x145ee7['symbol']=!0x0),!(_0x224eea===_0x15e881(0x2b2)||_0x224eea===_0x15e881(0x1b9))){var _0x4fc38b=this[_0x15e881(0x254)](_0x404a98,_0x2a8ac8);if(_0x4fc38b&&(_0x4fc38b['set']&&(_0x145ee7[_0x15e881(0x268)]=!0x0),_0x4fc38b[_0x15e881(0x243)]&&!_0x453454&&!_0xc4ef24['resolveGetters']))return _0x145ee7[_0x15e881(0x25d)]=!0x0,this['_processTreeNodeResult'](_0x145ee7,_0xc4ef24),_0x145ee7;}var _0x5c7867;try{_0x5c7867=_0x209e86(_0x404a98,_0x2a8ac8);}catch(_0x390630){return _0x145ee7={'name':_0x1b0f9a,'type':_0x15e881(0x2aa),'error':_0x390630[_0x15e881(0x206)]},this[_0x15e881(0x1d7)](_0x145ee7,_0xc4ef24),_0x145ee7;}var _0x239e42=this[_0x15e881(0x22e)](_0x5c7867),_0x153dbf=this[_0x15e881(0x239)](_0x239e42);if(_0x145ee7['type']=_0x239e42,_0x153dbf)this[_0x15e881(0x1d7)](_0x145ee7,_0xc4ef24,_0x5c7867,function(){var _0x2a2d3f=_0x15e881;_0x145ee7[_0x2a2d3f(0x260)]=_0x5c7867[_0x2a2d3f(0x295)](),!_0x453454&&_0x5e29e0['_capIfString'](_0x239e42,_0x145ee7,_0xc4ef24,{});});else{var _0x170491=_0xc4ef24[_0x15e881(0x1aa)]&&_0xc4ef24['level']<_0xc4ef24[_0x15e881(0x259)]&&_0xc4ef24[_0x15e881(0x1ad)][_0x15e881(0x1d4)](_0x5c7867)<0x0&&_0x239e42!==_0x15e881(0x1c1)&&_0xc4ef24[_0x15e881(0x1c4)]<_0xc4ef24[_0x15e881(0x1bd)];_0x170491||_0xc4ef24[_0x15e881(0x1ff)]<_0x5493d4||_0x453454?this['serialize'](_0x145ee7,_0x5c7867,_0xc4ef24,_0x453454||{}):this[_0x15e881(0x1d7)](_0x145ee7,_0xc4ef24,_0x5c7867,function(){var _0x29be9c=_0x15e881;_0x239e42==='null'||_0x239e42==='undefined'||(delete _0x145ee7[_0x29be9c(0x260)],_0x145ee7['capped']=!0x0);});}return _0x145ee7;}finally{_0xc4ef24[_0x15e881(0x26c)]=_0xa4b58b,_0xc4ef24[_0x15e881(0x270)]=_0x5493d4,_0xc4ef24[_0x15e881(0x216)]=_0x159f07;}},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x23b)]=function(_0x149305,_0x4e4404,_0x187b3d,_0x59debf){var _0x4cdb3b=_0x41415e,_0x74bcfb=_0x59debf[_0x4cdb3b(0x1d8)]||_0x187b3d['strLength'];if((_0x149305==='string'||_0x149305===_0x4cdb3b(0x274))&&_0x4e4404[_0x4cdb3b(0x260)]){let _0x1e9dcd=_0x4e4404['value'][_0x4cdb3b(0x23a)];_0x187b3d[_0x4cdb3b(0x275)]+=_0x1e9dcd,_0x187b3d[_0x4cdb3b(0x275)]>_0x187b3d[_0x4cdb3b(0x1e6)]?(_0x4e4404[_0x4cdb3b(0x1e7)]='',delete _0x4e4404['value']):_0x1e9dcd>_0x74bcfb&&(_0x4e4404[_0x4cdb3b(0x1e7)]=_0x4e4404[_0x4cdb3b(0x260)][_0x4cdb3b(0x24d)](0x0,_0x74bcfb),delete _0x4e4404['value']);}},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x1b4)]=function(_0x4cafd8){var _0x1f56d7=_0x41415e;return!!(_0x4cafd8&&_0x328296[_0x1f56d7(0x1ea)]&&this[_0x1f56d7(0x267)](_0x4cafd8)==='[object\\x20Map]'&&_0x4cafd8[_0x1f56d7(0x271)]);},_0x4a72ac['prototype']['_propertyName']=function(_0x556f90){var _0x1a47d0=_0x41415e;if(_0x556f90[_0x1a47d0(0x221)](/^\\d+$/))return _0x556f90;var _0x409087;try{_0x409087=JSON[_0x1a47d0(0x1e5)](''+_0x556f90);}catch{_0x409087='\\x22'+this[_0x1a47d0(0x267)](_0x556f90)+'\\x22';}return _0x409087[_0x1a47d0(0x221)](/^\"([a-zA-Z_][a-zA-Z_0-9]*)\"$/)?_0x409087=_0x409087[_0x1a47d0(0x24d)](0x1,_0x409087[_0x1a47d0(0x23a)]-0x2):_0x409087=_0x409087['replace'](/'/g,'\\x5c\\x27')[_0x1a47d0(0x1e2)](/\\\\\"/g,'\\x22')[_0x1a47d0(0x1e2)](/(^\"|\"$)/g,'\\x27'),_0x409087;},_0x4a72ac[_0x41415e(0x234)]['_processTreeNodeResult']=function(_0x2ce4bf,_0x28f550,_0x44eea1,_0x4515b9){var _0x294ebc=_0x41415e;this[_0x294ebc(0x242)](_0x2ce4bf,_0x28f550),_0x4515b9&&_0x4515b9(),this[_0x294ebc(0x262)](_0x44eea1,_0x2ce4bf),this[_0x294ebc(0x248)](_0x2ce4bf,_0x28f550);},_0x4a72ac[_0x41415e(0x234)]['_treeNodePropertiesBeforeFullValue']=function(_0x172a9d,_0x25c126){var _0x3dad14=_0x41415e;this[_0x3dad14(0x28d)](_0x172a9d,_0x25c126),this['_setNodeQueryPath'](_0x172a9d,_0x25c126),this['_setNodeExpressionPath'](_0x172a9d,_0x25c126),this['_setNodePermissions'](_0x172a9d,_0x25c126);},_0x4a72ac[_0x41415e(0x234)]['_setNodeId']=function(_0x1537f2,_0x3ab443){},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x1ef)]=function(_0x2427d1,_0x358bf3){},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x1cd)]=function(_0x54e5a6,_0x43bba0){},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x20e)]=function(_0x54acf6){var _0x335ec4=_0x41415e;return _0x54acf6===this[_0x335ec4(0x207)];},_0x4a72ac[_0x41415e(0x234)]['_treeNodePropertiesAfterFullValue']=function(_0x3d7e71,_0x54743f){var _0x59cd8a=_0x41415e;this['_setNodeLabel'](_0x3d7e71,_0x54743f),this['_setNodeExpandableState'](_0x3d7e71),_0x54743f[_0x59cd8a(0x1c7)]&&this[_0x59cd8a(0x1c6)](_0x3d7e71),this['_addFunctionsNode'](_0x3d7e71,_0x54743f),this[_0x59cd8a(0x1e0)](_0x3d7e71,_0x54743f),this['_cleanNode'](_0x3d7e71);},_0x4a72ac['prototype'][_0x41415e(0x262)]=function(_0x58500d,_0x2f1ff0){var _0x53b67e=_0x41415e;try{_0x58500d&&typeof _0x58500d['length']==_0x53b67e(0x237)&&(_0x2f1ff0[_0x53b67e(0x23a)]=_0x58500d[_0x53b67e(0x23a)]);}catch{}if(_0x2f1ff0[_0x53b67e(0x257)]===_0x53b67e(0x237)||_0x2f1ff0['type']==='Number'){if(isNaN(_0x2f1ff0[_0x53b67e(0x260)]))_0x2f1ff0[_0x53b67e(0x263)]=!0x0,delete _0x2f1ff0[_0x53b67e(0x260)];else switch(_0x2f1ff0[_0x53b67e(0x260)]){case Number[_0x53b67e(0x29b)]:_0x2f1ff0[_0x53b67e(0x228)]=!0x0,delete _0x2f1ff0[_0x53b67e(0x260)];break;case Number['NEGATIVE_INFINITY']:_0x2f1ff0[_0x53b67e(0x25a)]=!0x0,delete _0x2f1ff0[_0x53b67e(0x260)];break;case 0x0:this[_0x53b67e(0x258)](_0x2f1ff0[_0x53b67e(0x260)])&&(_0x2f1ff0['negativeZero']=!0x0);break;}}else _0x2f1ff0[_0x53b67e(0x257)]==='function'&&typeof _0x58500d[_0x53b67e(0x2a1)]==_0x53b67e(0x1e9)&&_0x58500d[_0x53b67e(0x2a1)]&&_0x2f1ff0[_0x53b67e(0x2a1)]&&_0x58500d[_0x53b67e(0x2a1)]!==_0x2f1ff0['name']&&(_0x2f1ff0['funcName']=_0x58500d[_0x53b67e(0x2a1)]);},_0x4a72ac[_0x41415e(0x234)]['_isNegativeZero']=function(_0x5c40e7){var _0x716367=_0x41415e;return 0x1/_0x5c40e7===Number[_0x716367(0x293)];},_0x4a72ac['prototype'][_0x41415e(0x1c6)]=function(_0x20eb48){var _0x1c5169=_0x41415e;!_0x20eb48[_0x1c5169(0x299)]||!_0x20eb48['props'][_0x1c5169(0x23a)]||_0x20eb48[_0x1c5169(0x257)]===_0x1c5169(0x2b2)||_0x20eb48[_0x1c5169(0x257)]===_0x1c5169(0x1ea)||_0x20eb48['type']==='Set'||_0x20eb48[_0x1c5169(0x299)][_0x1c5169(0x279)](function(_0x415953,_0x627e36){var _0x3dc3b7=_0x1c5169,_0x10fc8e=_0x415953[_0x3dc3b7(0x2a1)][_0x3dc3b7(0x2a0)](),_0x279c34=_0x627e36[_0x3dc3b7(0x2a1)]['toLowerCase']();return _0x10fc8e<_0x279c34?-0x1:_0x10fc8e>_0x279c34?0x1:0x0;});},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x1c0)]=function(_0x16876f,_0x162fd2){var _0x3d2a76=_0x41415e;if(!(_0x162fd2[_0x3d2a76(0x1da)]||!_0x16876f[_0x3d2a76(0x299)]||!_0x16876f['props']['length'])){for(var _0x2f6f65=[],_0x358cf7=[],_0x167b6c=0x0,_0x2108d8=_0x16876f['props'][_0x3d2a76(0x23a)];_0x167b6c<_0x2108d8;_0x167b6c++){var _0x3c39e8=_0x16876f[_0x3d2a76(0x299)][_0x167b6c];_0x3c39e8[_0x3d2a76(0x257)]===_0x3d2a76(0x1c1)?_0x2f6f65[_0x3d2a76(0x1dd)](_0x3c39e8):_0x358cf7[_0x3d2a76(0x1dd)](_0x3c39e8);}if(!(!_0x358cf7[_0x3d2a76(0x23a)]||_0x2f6f65[_0x3d2a76(0x23a)]<=0x1)){_0x16876f[_0x3d2a76(0x299)]=_0x358cf7;var _0x20ca6a={'functionsNode':!0x0,'props':_0x2f6f65};this['_setNodeId'](_0x20ca6a,_0x162fd2),this['_setNodeLabel'](_0x20ca6a,_0x162fd2),this['_setNodeExpandableState'](_0x20ca6a),this[_0x3d2a76(0x2a3)](_0x20ca6a,_0x162fd2),_0x20ca6a['id']+='\\x20f',_0x16876f[_0x3d2a76(0x299)][_0x3d2a76(0x2a4)](_0x20ca6a);}}},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x1e0)]=function(_0x3123fd,_0x4647e8){},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x20a)]=function(_0x2ca82b){},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x1f9)]=function(_0x41db73){var _0x3b2dc0=_0x41415e;return Array[_0x3b2dc0(0x21f)](_0x41db73)||typeof _0x41db73==_0x3b2dc0(0x26d)&&this['_objectToString'](_0x41db73)==='[object\\x20Array]';},_0x4a72ac['prototype'][_0x41415e(0x2a3)]=function(_0x5900cd,_0x4da276){},_0x4a72ac[_0x41415e(0x234)][_0x41415e(0x2b1)]=function(_0x3153d5){var _0x60e45=_0x41415e;delete _0x3153d5['_hasSymbolPropertyOnItsPath'],delete _0x3153d5['_hasSetOnItsPath'],delete _0x3153d5[_0x60e45(0x1ed)];},_0x4a72ac['prototype'][_0x41415e(0x214)]=function(_0x1c5b52,_0xeb8701){};let _0x1b1f6a=new _0x4a72ac(),_0x5ab55c={'props':_0x4a1853[_0x41415e(0x25c)][_0x41415e(0x299)]||0x64,'elements':_0x4a1853[_0x41415e(0x25c)]['elements']||0x64,'strLength':_0x4a1853[_0x41415e(0x25c)][_0x41415e(0x1d8)]||0x400*0x32,'totalStrLength':_0x4a1853[_0x41415e(0x25c)]['totalStrLength']||0x400*0x32,'autoExpandLimit':_0x4a1853[_0x41415e(0x25c)][_0x41415e(0x1bd)]||0x1388,'autoExpandMaxDepth':_0x4a1853[_0x41415e(0x25c)][_0x41415e(0x259)]||0xa},_0x1bc32b={'props':_0x4a1853['reducedLimits'][_0x41415e(0x299)]||0x5,'elements':_0x4a1853[_0x41415e(0x1d3)][_0x41415e(0x24f)]||0x5,'strLength':_0x4a1853[_0x41415e(0x1d3)][_0x41415e(0x1d8)]||0x100,'totalStrLength':_0x4a1853['reducedLimits'][_0x41415e(0x1e6)]||0x100*0x3,'autoExpandLimit':_0x4a1853[_0x41415e(0x1d3)][_0x41415e(0x1bd)]||0x1e,'autoExpandMaxDepth':_0x4a1853[_0x41415e(0x1d3)][_0x41415e(0x259)]||0x2};if(_0x40ff3c){let _0x465da0=_0x1b1f6a[_0x41415e(0x22b)][_0x41415e(0x1bf)](_0x1b1f6a);_0x1b1f6a['serialize']=function(_0x5bb6ac,_0xc8b820,_0x217e83,_0x48221d){return _0x465da0(_0x5bb6ac,_0x40ff3c(_0xc8b820),_0x217e83,_0x48221d);};}function _0x5d0dae(_0x36176c,_0x50f2a2,_0x31d836,_0x2f1b40,_0x356462,_0x21c4d){var _0x31131d=_0x41415e;let _0xc471d5,_0x41a687;try{_0x41a687=_0x33481b(),_0xc471d5=_0x31d747[_0x50f2a2],!_0xc471d5||_0x41a687-_0xc471d5['ts']>_0x513504[_0x31131d(0x2ab)][_0x31131d(0x26e)]&&_0xc471d5[_0x31131d(0x215)]&&_0xc471d5['time']/_0xc471d5['count']<_0x513504[_0x31131d(0x2ab)][_0x31131d(0x1ba)]?(_0x31d747[_0x50f2a2]=_0xc471d5={'count':0x0,'time':0x0,'ts':_0x41a687},_0x31d747[_0x31131d(0x1b2)]={}):_0x41a687-_0x31d747[_0x31131d(0x1b2)]['ts']>_0x513504[_0x31131d(0x25e)][_0x31131d(0x26e)]&&_0x31d747[_0x31131d(0x1b2)][_0x31131d(0x215)]&&_0x31d747['hits']['time']/_0x31d747['hits']['count']<_0x513504['global'][_0x31131d(0x1ba)]&&(_0x31d747['hits']={});let _0x33ab9c=[],_0x32224c=_0xc471d5[_0x31131d(0x261)]||_0x31d747[_0x31131d(0x1b2)][_0x31131d(0x261)]?_0x1bc32b:_0x5ab55c,_0x4ed7e1=_0x541a03=>{var _0x1d9f10=_0x31131d;let _0xb83276={};return _0xb83276[_0x1d9f10(0x299)]=_0x541a03[_0x1d9f10(0x299)],_0xb83276['elements']=_0x541a03['elements'],_0xb83276[_0x1d9f10(0x1d8)]=_0x541a03[_0x1d9f10(0x1d8)],_0xb83276[_0x1d9f10(0x1e6)]=_0x541a03[_0x1d9f10(0x1e6)],_0xb83276[_0x1d9f10(0x1bd)]=_0x541a03[_0x1d9f10(0x1bd)],_0xb83276[_0x1d9f10(0x259)]=_0x541a03[_0x1d9f10(0x259)],_0xb83276[_0x1d9f10(0x1c7)]=!0x1,_0xb83276[_0x1d9f10(0x1da)]=!_0x52ae61,_0xb83276[_0x1d9f10(0x270)]=0x1,_0xb83276['level']=0x0,_0xb83276[_0x1d9f10(0x29c)]=_0x1d9f10(0x1ac),_0xb83276[_0x1d9f10(0x2b3)]=_0x1d9f10(0x222),_0xb83276['autoExpand']=!0x0,_0xb83276['autoExpandPreviousObjects']=[],_0xb83276[_0x1d9f10(0x1c4)]=0x0,_0xb83276[_0x1d9f10(0x28a)]=_0x4a1853['resolveGetters'],_0xb83276[_0x1d9f10(0x275)]=0x0,_0xb83276[_0x1d9f10(0x1d6)]={'current':void 0x0,'parent':void 0x0,'index':0x0},_0xb83276;};for(var _0x4872b1=0x0;_0x4872b1<_0x356462[_0x31131d(0x23a)];_0x4872b1++)_0x33ab9c['push'](_0x1b1f6a[_0x31131d(0x22b)]({'timeNode':_0x36176c===_0x31131d(0x213)||void 0x0},_0x356462[_0x4872b1],_0x4ed7e1(_0x32224c),{}));if(_0x36176c==='trace'||_0x36176c===_0x31131d(0x250)){let _0xbe35ed=Error[_0x31131d(0x1d5)];try{Error[_0x31131d(0x1d5)]=0x1/0x0,_0x33ab9c[_0x31131d(0x1dd)](_0x1b1f6a[_0x31131d(0x22b)]({'stackNode':!0x0},new Error()[_0x31131d(0x1fc)],_0x4ed7e1(_0x32224c),{'strLength':0x1/0x0}));}finally{Error[_0x31131d(0x1d5)]=_0xbe35ed;}}return{'method':_0x31131d(0x1ce),'version':_0x3d7d4d,'args':[{'ts':_0x31d836,'session':_0x2f1b40,'args':_0x33ab9c,'id':_0x50f2a2,'context':_0x21c4d}]};}catch(_0x5f1a84){return{'method':_0x31131d(0x1ce),'version':_0x3d7d4d,'args':[{'ts':_0x31d836,'session':_0x2f1b40,'args':[{'type':_0x31131d(0x2aa),'error':_0x5f1a84&&_0x5f1a84[_0x31131d(0x206)]}],'id':_0x50f2a2,'context':_0x21c4d}]};}finally{try{if(_0xc471d5&&_0x41a687){let _0x1e910a=_0x33481b();_0xc471d5[_0x31131d(0x215)]++,_0xc471d5[_0x31131d(0x213)]+=_0x1015fc(_0x41a687,_0x1e910a),_0xc471d5['ts']=_0x1e910a,_0x31d747[_0x31131d(0x1b2)][_0x31131d(0x215)]++,_0x31d747[_0x31131d(0x1b2)][_0x31131d(0x213)]+=_0x1015fc(_0x41a687,_0x1e910a),_0x31d747[_0x31131d(0x1b2)]['ts']=_0x1e910a,(_0xc471d5[_0x31131d(0x215)]>_0x513504[_0x31131d(0x2ab)][_0x31131d(0x21e)]||_0xc471d5[_0x31131d(0x213)]>_0x513504['perLogpoint'][_0x31131d(0x200)])&&(_0xc471d5['reduceLimits']=!0x0),(_0x31d747[_0x31131d(0x1b2)][_0x31131d(0x215)]>_0x513504[_0x31131d(0x25e)][_0x31131d(0x21e)]||_0x31d747[_0x31131d(0x1b2)][_0x31131d(0x213)]>_0x513504[_0x31131d(0x25e)][_0x31131d(0x200)])&&(_0x31d747[_0x31131d(0x1b2)][_0x31131d(0x261)]=!0x0);}}catch{}}}return _0x5d0dae;}function G(_0x57f7c8){var _0x8989a5=_0x11737d;if(_0x57f7c8&&typeof _0x57f7c8==_0x8989a5(0x26d)&&_0x57f7c8[_0x8989a5(0x1ab)])switch(_0x57f7c8[_0x8989a5(0x1ab)][_0x8989a5(0x2a1)]){case _0x8989a5(0x1c9):return _0x57f7c8[_0x8989a5(0x202)](Symbol[_0x8989a5(0x220)])?Promise[_0x8989a5(0x27d)]():_0x57f7c8;case _0x8989a5(0x273):return Promise[_0x8989a5(0x27d)]();}return _0x57f7c8;}((_0x49a927,_0x1a871b,_0x483899,_0xef7368,_0x4fe531,_0x8035f7,_0x1eee1e,_0x4e67e7,_0x1dcc2b,_0x36ad0d,_0x5eec70,_0x325478)=>{var _0x417c2e=_0x11737d;if(_0x49a927[_0x417c2e(0x272)])return _0x49a927['_console_ninja'];let _0x493a09={'consoleLog':()=>{},'consoleTrace':()=>{},'consoleTime':()=>{},'consoleTimeEnd':()=>{},'autoLog':()=>{},'autoLogMany':()=>{},'autoTraceMany':()=>{},'coverage':()=>{},'autoTrace':()=>{},'autoTime':()=>{},'autoTimeEnd':()=>{}};if(!X(_0x49a927,_0x4e67e7,_0x4fe531))return _0x49a927[_0x417c2e(0x272)]=_0x493a09,_0x49a927['_console_ninja'];let _0x1c6bc5=b(_0x49a927),_0x2b8f39=_0x1c6bc5[_0x417c2e(0x2b5)],_0x2d109f=_0x1c6bc5[_0x417c2e(0x25f)],_0x200f28=_0x1c6bc5[_0x417c2e(0x280)],_0x19208f={'hits':{},'ts':{}},_0xc7afd2=J(_0x49a927,_0x1dcc2b,_0x19208f,_0x8035f7,_0x325478,_0x4fe531==='next.js'?G:void 0x0),_0x118149=(_0x4b882a,_0x96562,_0x3f27ad,_0x13190a,_0x5817de,_0x3fb122)=>{var _0x3ee198=_0x417c2e;let _0x42dc9c=_0x49a927[_0x3ee198(0x272)];try{return _0x49a927[_0x3ee198(0x272)]=_0x493a09,_0xc7afd2(_0x4b882a,_0x96562,_0x3f27ad,_0x13190a,_0x5817de,_0x3fb122);}finally{_0x49a927[_0x3ee198(0x272)]=_0x42dc9c;}},_0x11bc8c=_0x374f3d=>{_0x19208f['ts'][_0x374f3d]=_0x2d109f();},_0x1c419e=(_0x19a11f,_0x5262fc)=>{var _0x3954f9=_0x417c2e;let _0x325002=_0x19208f['ts'][_0x5262fc];if(delete _0x19208f['ts'][_0x5262fc],_0x325002){let _0x493846=_0x2b8f39(_0x325002,_0x2d109f());_0x5bf617(_0x118149(_0x3954f9(0x213),_0x19a11f,_0x200f28(),_0x4202ca,[_0x493846],_0x5262fc));}},_0x2e039f=_0x5b0257=>{var _0x102273=_0x417c2e,_0x56d8f6;return _0x4fe531===_0x102273(0x211)&&_0x49a927['origin']&&((_0x56d8f6=_0x5b0257==null?void 0x0:_0x5b0257[_0x102273(0x21b)])==null?void 0x0:_0x56d8f6[_0x102273(0x23a)])&&(_0x5b0257[_0x102273(0x21b)][0x0][_0x102273(0x282)]=_0x49a927[_0x102273(0x282)]),_0x5b0257;};_0x49a927[_0x417c2e(0x272)]={'consoleLog':(_0xb0ef16,_0x4b56f2)=>{var _0x51186d=_0x417c2e;_0x49a927[_0x51186d(0x21d)][_0x51186d(0x1ce)]['name']!==_0x51186d(0x1fd)&&_0x5bf617(_0x118149(_0x51186d(0x1ce),_0xb0ef16,_0x200f28(),_0x4202ca,_0x4b56f2));},'consoleTrace':(_0xb88eb7,_0x523325)=>{var _0xc218c5=_0x417c2e,_0x514946,_0x272087;_0x49a927[_0xc218c5(0x21d)][_0xc218c5(0x1ce)][_0xc218c5(0x2a1)]!==_0xc218c5(0x20d)&&((_0x272087=(_0x514946=_0x49a927[_0xc218c5(0x1cb)])==null?void 0x0:_0x514946[_0xc218c5(0x2a8)])!=null&&_0x272087[_0xc218c5(0x1d6)]&&(_0x49a927[_0xc218c5(0x238)]=!0x0),_0x5bf617(_0x2e039f(_0x118149(_0xc218c5(0x288),_0xb88eb7,_0x200f28(),_0x4202ca,_0x523325))));},'consoleError':(_0x36ac47,_0x2b4a69)=>{var _0x24b679=_0x417c2e;_0x49a927[_0x24b679(0x238)]=!0x0,_0x5bf617(_0x2e039f(_0x118149('error',_0x36ac47,_0x200f28(),_0x4202ca,_0x2b4a69)));},'consoleTime':_0x2a2292=>{_0x11bc8c(_0x2a2292);},'consoleTimeEnd':(_0x186230,_0x3edf28)=>{_0x1c419e(_0x3edf28,_0x186230);},'autoLog':(_0x196e30,_0x4757f9)=>{var _0x14995c=_0x417c2e;_0x5bf617(_0x118149(_0x14995c(0x1ce),_0x4757f9,_0x200f28(),_0x4202ca,[_0x196e30]));},'autoLogMany':(_0x590664,_0x511674)=>{var _0x150948=_0x417c2e;_0x5bf617(_0x118149(_0x150948(0x1ce),_0x590664,_0x200f28(),_0x4202ca,_0x511674));},'autoTrace':(_0xf09034,_0x477842)=>{_0x5bf617(_0x2e039f(_0x118149('trace',_0x477842,_0x200f28(),_0x4202ca,[_0xf09034])));},'autoTraceMany':(_0x5dfffd,_0x37f583)=>{var _0x1a70f9=_0x417c2e;_0x5bf617(_0x2e039f(_0x118149(_0x1a70f9(0x288),_0x5dfffd,_0x200f28(),_0x4202ca,_0x37f583)));},'autoTime':(_0xa8fce3,_0x13dfa8,_0x217929)=>{_0x11bc8c(_0x217929);},'autoTimeEnd':(_0x48d600,_0x2b5f35,_0x5c28a8)=>{_0x1c419e(_0x2b5f35,_0x5c28a8);},'coverage':_0x2ec881=>{_0x5bf617({'method':'coverage','version':_0x8035f7,'args':[{'id':_0x2ec881}]});}};let _0x5bf617=H(_0x49a927,_0x1a871b,_0x483899,_0xef7368,_0x4fe531,_0x36ad0d,_0x5eec70),_0x4202ca=_0x49a927['_console_ninja_session'];return _0x49a927[_0x417c2e(0x272)];})(globalThis,_0x11737d(0x2a2),'63135',_0x11737d(0x1bb),_0x11737d(0x1b8),_0x11737d(0x25b),_0x11737d(0x20f),_0x11737d(0x1de),_0x11737d(0x281),_0x11737d(0x223),'1',{\"resolveGetters\":false,\"defaultLimits\":{\"props\":100,\"elements\":100,\"strLength\":51200,\"totalStrLength\":51200,\"autoExpandLimit\":5000,\"autoExpandMaxDepth\":10},\"reducedLimits\":{\"props\":5,\"elements\":5,\"strLength\":256,\"totalStrLength\":768,\"autoExpandLimit\":30,\"autoExpandMaxDepth\":2},\"reducePolicy\":{\"perLogpoint\":{\"reduceOnCount\":50,\"reduceOnAccumulatedProcessingTimeMs\":100,\"resetWhenQuietMs\":500,\"resetOnProcessingTimeAverageMs\":100},\"global\":{\"reduceOnCount\":1000,\"reduceOnAccumulatedProcessingTimeMs\":300,\"resetWhenQuietMs\":50,\"resetOnProcessingTimeAverageMs\":100}}});");
  } catch (e) {
    console.error(e);
  }
}
; /* istanbul ignore next */
function oo_oo(/**@type{any}**/i) {
  for (var _len = arguments.length, v = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
    v[_key - 1] = arguments[_key];
  }
  try {
    oo_cm().consoleLog(i, v);
  } catch (e) {}
  return v;
}
; /* istanbul ignore next */
function oo_tr(/**@type{any}**/i) {
  for (var _len2 = arguments.length, v = new Array(_len2 > 1 ? _len2 - 1 : 0), _key2 = 1; _key2 < _len2; _key2++) {
    v[_key2 - 1] = arguments[_key2];
  }
  try {
    oo_cm().consoleTrace(i, v);
  } catch (e) {}
  return v;
}
; /* istanbul ignore next */
function oo_tx(/**@type{any}**/i) {
  for (var _len3 = arguments.length, v = new Array(_len3 > 1 ? _len3 - 1 : 0), _key3 = 1; _key3 < _len3; _key3++) {
    v[_key3 - 1] = arguments[_key3];
  }
  try {
    oo_cm().consoleError(i, v);
  } catch (e) {}
  return v;
}
; /* istanbul ignore next */
function oo_ts(/**@type{any}**/v) {
  try {
    oo_cm().consoleTime(v);
  } catch (e) {}
  return v;
}
; /* istanbul ignore next */
function oo_te(/**@type{any}**/v, /**@type{any}**/i) {
  try {
    oo_cm().consoleTimeEnd(v, i);
  } catch (e) {}
  return v;
}
; /*eslint unicorn/no-abusive-eslint-disable:,eslint-comments/disable-enable-pair:,eslint-comments/no-unlimited-disable:,eslint-comments/no-aggregating-enable:,eslint-comments/no-duplicate-disable:,eslint-comments/no-unused-disable:,eslint-comments/no-unused-enable:,*/
/******/ })()
;