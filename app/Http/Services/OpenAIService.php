<?php

namespace App\Http\Services;

use App\Models\Tour;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OpenAIService
{


    public function getResponseFromOpenAI($prompt)
    {
        if (Storage::disk('local')->exists('data/rules.txt')) {
            $rules = Storage::disk('local')->get('data/rules.txt');
        } else {
            $rules = "Bạn là nhân viên tư vấn du lịch. Hãy trả lời ngắn gọn và thân thiện.";
        }
        try {
            $tours = Tour::orderBy('created_at', 'desc')->limit(2)->get();

            foreach ($tours as $tour) {
                $rules .=  "Sau đây là một vài tour mới nhất: \n\nTour: " . $tour->name . "\n mã:" . $tour->id . "\nGiá: " . $tour->price . "\nMô tả: " . $tour->description . "\nID: " . $tour->id . "\n";
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => $rules],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            if ($response->failed()) {
                $error = $response->json()['error']['message'] ?? 'Unknown Error';
                Log::error('OpenAI API Failure: ' . $error);
                return [
                    'status' => false,
                    'message' => 'Xin lỗi, robot đang gặp sự cố kết nối: ' . $error
                ];
            }

            $result = $response->json();
            $content = $result['choices'][0]['message']['content'] ?? 'Không có phản hồi';

            return [
                'status' => true,
                'message' => $content
            ];
        } catch (\Throwable $th) {
            Log::error('Lỗi OpenAI: ' . $th->getMessage());
            return [
                'status' => false,
                'message' => 'Xin lỗi, hệ thống đang bận. Vui lòng thử lại sau.'
            ];
        }
    }
}
