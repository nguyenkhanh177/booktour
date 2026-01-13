@extends('layouts.client')

@section('title', 'Test AI Chatbot')

@section('content')
    <div class="hero-wrap" style="background-image: url('{{ asset('assets/images/bg_1.jpg') }}'); height: 300px;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center" style="height: 300px;">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-3 bread">Test AI Chatbot</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0 text-white">Chat với AI</h4>
                        </div>
                        <div class="card-body">
                            <!-- Khu vực hiển thị kết quả -->
                            @if (!session('reply') && !session('error'))
                                <em>Hãy đặt câu hỏi để bắt đầu...</em>
                            @endif

                            @if (session('reply'))
                                <div class="text-left mb-2">
                                    <div class="d-inline-block bg-white border p-2 rounded shadow-sm text-dark">
                                        <strong>Bot:</strong> {!! session('reply') !!}
                                    </div>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="text-center mb-2">
                                    <small class="text-danger">Lỗi: {{ session('error') }}</small>
                                </div>
                            @endif

                            <!-- Form nhập liệu -->
                            <form id="chat-form" action="{{ route('client.ai.chat') }}" method="post" novalidate>
                                @csrf
                                <div class="input-group">
                                    <input type="text" id="message-input" name="message" class="form-control"
                                        placeholder="Nhập câu hỏi của bạn..." required>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit" id="btn-submit">
                                            <i class="fa fa-paper-plane"></i> Gửi
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection