<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'Trang chủ')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">

    <!-- Animation & effects -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">

    <!-- Date / Time picker -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.timepicker.css') }}">

    <!-- Main style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    @include('partials.header', ['active' => $__env->yieldContent('active')])
    @yield('content')

    @if (Route::currentRouteName() !== 'profile.index')
    @include('partials.footer') @endif
    <!-- jQuery (chỉ dùng 1 bản) -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>

    <!-- Popper & Bootstrap -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('assets/js/aos.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/js/scrollax.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/range.js') }}"></script>

    <!-- Google Map (nếu dùng) -->
    {{--
    <script src="{{ asset('assets/js/google-map.js') }}"></script> --}}

    <!-- Main -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- FLOATING CHAT WIDGET --}}
    {{-- FLOATING CHAT WIDGET --}}
    <div id="ai-chat-widget" style="position: fixed; bottom: 20px; right: 20px; z-index: 99999;">

        <button id="chat-toggle" class="btn btn-danger rounded-circle shadow"
            style="width:60px;height:60px;display:none;">
            💬
        </button>

        <div id="chat-box" class="card shadow" style="width:340px;height:500px;display:flex;flex-direction:column;">

            <div class="card-header bg-danger text-white d-flex justify-content-between">
                <strong><i class="fa fa-robot"></i> AI BookTour</strong>
                <button class="btn btn-sm text-white" onclick="closeChat()">×</button>
            </div>

            <!-- VÙNG CHAT -->
            <div id="chat-messages" class="card-body" style="flex-grow:1;overflow-y:auto;">
            </div>

            <!-- INPUT -->
            <div class="card-footer">
                <div class="d-flex">
                    <input id="chat-input" type="text" class="form-control" placeholder="Hỏi về tour, giá...">
                    <button class="btn btn-danger ml-2" onclick="sendMessage()">Gửi</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const chatToggle = document.getElementById('chat-toggle');
        const chatMessages = document.getElementById('chat-messages');
        const chatInput = document.getElementById('chat-input');

        // Load chat từ localStorage
        document.addEventListener("DOMContentLoaded", () => {
            const saved = localStorage.getItem("chat_history");
            chatMessages.innerHTML = saved ?? `<em class="text-muted">Xin chào! Tôi có thể giúp gì cho chuyến đi của bạn?</em>`;
            scrollBottom();
        });

        // Đóng chat
        function closeChat() {
            localStorage.setItem("chat_history", chatMessages.innerHTML);
            chatBox.style.display = "none";
            chatToggle.style.display = "block";
        }

        // Mở chat
        chatToggle.onclick = () => {
            chatBox.style.display = "flex";
            chatToggle.style.display = "none";
            scrollBottom();
        };

        // Gửi tin nhắn
        function sendMessage() {
            const message = chatInput.value.trim();
            if (!message) return;

            appendUser(message);
            chatInput.value = "";

            fetch("{{ route('client.ai.chat') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ message })
            })
                .then(res => res.json())
                .then(data => {
                    appendAI(data.reply);
                    saveChat();
                })
                .catch(() => {
                    appendAI("❌ Lỗi kết nối máy chủ");
                });
        }
        // Append user
        function appendUser(text) {
            chatMessages.innerHTML += `
        <div class="text-right mb-2">
            <div class="chat-message bg-primary text-white d-inline-block">
                ${text}
            </div>
        </div>`;
            scrollBottom();
        }

        function appendAI(text) {
            chatMessages.innerHTML += `
        <div class="text-left mb-2">
            <div class="chat-message bg-light text-dark d-inline-block">
                ${text}
            </div>
        </div>`;
            scrollBottom();
        }


        // Scroll xuống cuối
        function scrollBottom() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        // Lưu chat
        function saveChat() {
            localStorage.setItem("chat_history", chatMessages.innerHTML);
        }
    </script>
</body>

</html>