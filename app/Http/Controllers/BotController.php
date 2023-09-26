<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

// namespace App\Models\Bot;

class BotController extends Controller
{

    public function getMessage()
    {
        $token = "6435606166:AAEfI6IGjH05A493laWttLqnuFwhzOX1_bk";
        $method = "getUpdates";
        $url = "https://api.telegram.org/bot{$token}/{$method}";
        $response = Http::get($url)->json();
        $lastMessage = [];
        if (!isset($response['ok']) || $response['ok'] !== true) {
            return [
                "status" => false,
                "data" => "خطا در دریافت پیام"
            ];
        }

        $lastUpdate = end($response['result']);

        if (!isset($lastUpdate['message']['text'])) {
            return [
                "status" => false,
                "data" => "هیچ پیامی ارسال نشده"
            ];
        }

        $lastMessage = $lastUpdate['message']['text'];
        return [
            "status" => true,
            "data" => $lastMessage
        ];
    }

    public function webhook(Request $request)
    {
        $token = "6435606166:AAEfI6IGjH05A493laWttLqnuFwhzOX1_bk";
        $method = "sendMessage";
        $chat_id = 5592050926;
        $text = json_encode($request->message);
        $url = "https://api.telegram.org/bot{$token}/{$method}?chat_id={$chat_id}&text={$text}";
        Http::post($url)->json();
    }
};



    // // dd($request->request);
        // if (!in_array($request->bot, json_decode($request->user()->accessBot))) {
        //     return [
        //         "status" => false,
        //     ];
        // }
        // $bot = (new Bot)->where('id', $request->bot)->first();
        // if (!$bot) {
        //     return [
        //         "status" => false,
        //     ];
        // }
        // $response = Http::get('https://api.telegram.org/bot' . $bot->token . '/setWebhook?url=' . $request->webhook)->body();
        // $data = json_decode($response);
        // return [
        //     "status" => true,
        //     "data" => $data->result
        // ];