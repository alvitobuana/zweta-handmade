<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Zweta Handmade - Tas handmade custom berkualitas tinggi">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' | Zweta Handmade' : 'Zweta Handmade - Tas Handmade Custom' }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="/css/app.css">
    @endif
</head>
<body class="bg-cream text-dark-brown min-h-screen font-sans flex flex-col">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main class="flex-1">
        <div class="container mx-auto px-4 sm:px-6 py-12 lg:py-16">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    @include('partials.footer')

    @stack('scripts')

    <!-- ✨ Zweta AI Chatbot Widget -->
    <div id="zweta-chat" style="position:fixed;bottom:24px;right:24px;z-index:9999;font-family:inherit;">

        <!-- Floating Toggle Button -->
        <button id="chat-toggle"
            onclick="toggleChat()"
            style="width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#A56A43,#C8905A);border:none;cursor:pointer;box-shadow:0 4px 20px rgba(165,106,67,0.4);display:flex;align-items:center;justify-content:center;transition:transform 0.2s,box-shadow 0.2s;"
            onmouseover="this.style.transform='scale(1.08)';this.style.boxShadow='0 6px 28px rgba(165,106,67,0.5)'"
            onmouseout="this.style.transform='scale(1)';this.style.boxShadow='0 4px 20px rgba(165,106,67,0.4)'"
            title="Tanya Zweta AI">
            <span id="chat-icon" style="font-size:24px;transition:all 0.2s;">💬</span>
        </button>

        <!-- Chat Panel -->
        <div id="chat-panel"
            style="display:none;position:absolute;bottom:68px;right:0;width:340px;max-height:520px;background:#fff;border-radius:20px;box-shadow:0 20px 60px rgba(28,20,16,0.18);overflow:hidden;flex-direction:column;border:1px solid rgba(165,106,67,0.15);">

            <!-- Header -->
            <div style="background:linear-gradient(135deg,#A56A43,#C8905A);padding:16px 18px;display:flex;align-items:center;gap:10px;">
                <div style="width:36px;height:36px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:18px;">🤖</div>
                <div>
                    <p style="margin:0;color:#fff;font-weight:700;font-size:14px;">Zweta AI Assistant</p>
                    <p style="margin:0;color:rgba(255,255,255,0.8);font-size:11px;">Tanya seputar produk & rekomendasi</p>
                </div>
                <button onclick="toggleChat()" style="margin-left:auto;background:none;border:none;cursor:pointer;color:rgba(255,255,255,0.8);font-size:18px;line-height:1;padding:0;">✕</button>
            </div>

            <!-- Messages Area -->
            <div id="chat-messages"
                style="flex:1;overflow-y:auto;padding:16px;display:flex;flex-direction:column;gap:10px;max-height:360px;background:#FAFAF8;">
                <!-- Initial bot greeting injected by JS -->
            </div>

            <!-- Input Area -->
            <div style="padding:12px 14px;border-top:1px solid #f0ebe6;background:#fff;display:flex;gap:8px;align-items:flex-end;">
                <textarea id="chat-input"
                    placeholder="Tanya tentang produk Zweta..."
                    rows="1"
                    onkeydown="handleChatKey(event)"
                    oninput="autoResize(this)"
                    style="flex:1;border:1px solid #e8ddd5;border-radius:12px;padding:10px 14px;font-size:13px;resize:none;outline:none;font-family:inherit;line-height:1.4;max-height:80px;color:#1C1410;background:#FAFAF8;transition:border-color 0.2s;"
                    onfocus="this.style.borderColor='#A56A43'"
                    onblur="this.style.borderColor='#e8ddd5'"></textarea>
                <button onclick="sendChat()"
                    id="chat-send-btn"
                    style="width:38px;height:38px;flex-shrink:0;border-radius:50%;background:linear-gradient(135deg,#A56A43,#C8905A);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px;transition:transform 0.15s;"
                    onmouseover="this.style.transform='scale(1.08)'"
                    onmouseout="this.style.transform='scale(1)'">
                    ➤
                </button>
            </div>
        </div>
    </div>

    <style>
        #chat-messages::-webkit-scrollbar { width: 4px; }
        #chat-messages::-webkit-scrollbar-track { background: transparent; }
        #chat-messages::-webkit-scrollbar-thumb { background: #e0d5cd; border-radius: 4px; }
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .chat-bubble { animation: fadeSlideUp 0.25s ease; }
        @keyframes blink { 0%,80%,100% { opacity:0 } 40% { opacity:1 } }
        .typing-dot { display:inline-block;width:7px;height:7px;border-radius:50%;background:#A56A43;animation:blink 1.2s infinite; }
        .typing-dot:nth-child(2) { animation-delay:0.2s; }
        .typing-dot:nth-child(3) { animation-delay:0.4s; }
    </style>

    <script>
        let chatOpen = false;
        let chatGreeted = false;

        function toggleChat() {
            chatOpen = !chatOpen;
            const panel = document.getElementById('chat-panel');
            const icon  = document.getElementById('chat-icon');
            if (chatOpen) {
                panel.style.display = 'flex';
                panel.style.flexDirection = 'column';
                icon.textContent = '✕';
                if (!chatGreeted) {
                    chatGreeted = true;
                    setTimeout(() => appendBot('Halo! Saya Zweta AI 🤖\nSaya siap bantu kamu temukan tas yang tepat sesuai kebutuhan. Mau cari tas untuk apa? 😊'), 300);
                }
                setTimeout(() => document.getElementById('chat-input').focus(), 350);
            } else {
                panel.style.display = 'none';
                icon.textContent = '💬';
            }
        }

        function handleChatKey(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendChat();
            }
        }

        function autoResize(el) {
            el.style.height = 'auto';
            el.style.height = Math.min(el.scrollHeight, 80) + 'px';
        }

        function appendUser(text) {
            const msgs = document.getElementById('chat-messages');
            const div = document.createElement('div');
            div.className = 'chat-bubble';
            div.style.cssText = 'align-self:flex-end;max-width:80%;background:linear-gradient(135deg,#A56A43,#C8905A);color:#fff;padding:10px 14px;border-radius:18px 18px 4px 18px;font-size:13px;line-height:1.5;word-break:break-word;';
            div.textContent = text;
            msgs.appendChild(div);
            msgs.scrollTop = msgs.scrollHeight;
        }

        function appendBot(text) {
            const msgs = document.getElementById('chat-messages');
            const div = document.createElement('div');
            div.className = 'chat-bubble';
            div.style.cssText = 'align-self:flex-start;max-width:85%;background:#fff;color:#1C1410;padding:10px 14px;border-radius:18px 18px 18px 4px;font-size:13px;line-height:1.6;word-break:break-word;border:1px solid #f0e8e0;white-space:pre-wrap;box-shadow:0 2px 8px rgba(28,20,16,0.06);';
            div.textContent = text;
            msgs.appendChild(div);
            msgs.scrollTop = msgs.scrollHeight;
        }

        function showTyping() {
            const msgs = document.getElementById('chat-messages');
            const div = document.createElement('div');
            div.id = 'typing-indicator';
            div.className = 'chat-bubble';
            div.style.cssText = 'align-self:flex-start;background:#fff;padding:12px 16px;border-radius:18px 18px 18px 4px;border:1px solid #f0e8e0;display:flex;gap:4px;align-items:center;box-shadow:0 2px 8px rgba(28,20,16,0.06);';
            div.innerHTML = '<span class="typing-dot"></span><span class="typing-dot"></span><span class="typing-dot"></span>';
            msgs.appendChild(div);
            msgs.scrollTop = msgs.scrollHeight;
        }

        function removeTyping() {
            const t = document.getElementById('typing-indicator');
            if (t) t.remove();
        }

        async function sendChat() {
            const input = document.getElementById('chat-input');
            const btn   = document.getElementById('chat-send-btn');
            const text  = input.value.trim();
            if (!text) return;

            appendUser(text);
            input.value = '';
            input.style.height = 'auto';
            btn.disabled = true;
            btn.style.opacity = '0.5';
            showTyping();

            try {
                const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
                const res  = await fetch('/chat', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                    body: JSON.stringify({ message: text })
                });
                const data = await res.json();
                removeTyping();
                appendBot(data.reply || 'Maaf, ada masalah. Coba lagi ya!');
            } catch (e) {
                removeTyping();
                appendBot('Koneksi bermasalah. Silakan coba lagi 😊');
            } finally {
                btn.disabled = false;
                btn.style.opacity = '1';
                input.focus();
            }
        }
    </script>
</body>
</html>
