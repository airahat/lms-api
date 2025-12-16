<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');
        $apiKey = env('GEMINI_API_KEY');

        $client = new Client();

        try {
            $response = $client->post(
                'https://api.generativeai.google/v1beta2/models/gemini-2.5-flash:generateMessage',
                [
                    'headers' => [
                        'Authorization' => "Bearer $apiKey",
                        'Content-Type'  => 'application/json',
                    ],
                    'json' => [
                        'prompt' => [
                            [
                                'role' => 'user',
                                'content' => $message
                            ]
                        ],
                        'temperature' => 0.7,
                        'candidate_count' => 1,
                    ],
                ]
            );

            $data = json_decode($response->getBody(), true);

            $reply = $data['candidates'][0]['content'] ?? 'No response';

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            return response()->json(['reply' => 'Error: '.$e->getMessage()], 500);
        }
    }
}
