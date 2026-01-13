<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\OpenAIService;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    private $openaiService;
    public function __construct()
    {
        $this->openaiService = new OpenAIService();
    }

    public function chatbot(Request $request)
    {
        return view('clients.chatbot.test');
    }
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        if (!$message) {
            return response()->json([
                'status' => false,
                'reply' => 'Vui lòng nhập tin nhắn.'
            ], 422);
        }
        $response = $this->openaiService->getResponseFromOpenAI($message);

        if ($response['status']) {
            return response()->json([
                'status' => true,
                'reply' => $response['message']
            ]);
        }
        return response()->json([
            'status' => false,
            'reply' => 'Xin lỗi, hệ thống đang bận. Vui lòng thử lại sau.'
        ], 500);
    }
}
