<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cache;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateTelegramMessage extends Command
{
    protected $signature = 'telegram:translate';
    protected $description = 'Read messages from Telegram channel A, translate them using ChatGPT, and post to channel B';

    protected $telegram;
    protected $chatGPT;
    protected $trans;

    public function __construct()
    {
        parent::__construct();

        $this->telegram = new Api(env("TELEGRAM_BOT_TOKEN"));
        $this->chatGPT = new Client();
        $this->trans = new GoogleTranslate(); 
        $this->trans->setSource('en'); 
        $this->trans->setTarget('fa');
    }

    public function handle()
    {

        $channelAId = env("CHANNEL_A_CHAT_ID");
        $channelBId = env("CHANNEL_B_CHAT_ID");
        //Cache::flush();
        $latest = Cache::get('update_id') ?? 0;
        $updates = $this->telegram->getUpdates([
            'offset' => $latest > 0 ? $latest + 1 : 0,
            'limit' => 1,
            'timeout' => 0,
            'allowed_updates' => [],
        ]);
        foreach ($updates as $update) {
            if($update['update_id'] != Cache::get('update_id')){
                if (isset($update['channel_post']) && (string)$update['channel_post']['chat']['id'] === $channelAId) {
                    
                    if(isset($update['channel_post']['text'])){
                        $message = $update['channel_post']['text'];
    
                        // $response = $this->chatGPT->post('https://api.openai.com/v1/chat/completions', [
                        //     'headers' => [
                        //         'Authorization' => 'Bearer ' . env("CHATGPT_API_KEY"),
                        //         'Content-Type' => 'application/json',
                        //     ],
                        //     'json' => [
                        //         'model' => 'gpt-4',
                        //         'messages' => [
                        //             ['role' => 'system', 'content' => 'Please translate the following text to Persian as if it was written by a human.'],
                        //             ['role' => 'user', 'content' => $message],
                        //         ],
                        //     ],
                        // ]);
        
                        // $result = json_decode($response->getBody()->getContents(), true);
                        // dd($result);
                        // $translatedText = $result['choices'][0]['message']['content'];
                        $translatedMessage = $this->trans->translate($message);

                        $this->telegram->sendMessage([
                            'chat_id' => $channelBId,
                            'text' => $translatedMessage,
                        ]);
                    }else {
                        $this->telegram->forwardMessage([
                            'chat_id' => $channelBId,
                            'from_chat_id' => $channelAId,
                            'message_id' => $update['channel_post']['message_id'] ?? null,
                        ]);
                    }
                }
                Cache::put('update_id', $update['update_id']);
            }
        }
    }
}
