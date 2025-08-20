<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    public function sendReminder($contact)
    {
        // Ensure the number starts with 0
        // if (substr($contact, 0, 1) !== '0') {
        //     $contact = '63' . $contact; // Prepend 0 if missing
        // }

        $contact = preg_replace('/^0/', '+63', $contact);

        $response = Http::withHeaders([
            // 'Authorization' => 'App 82795472d3f26a83125f0ed4ef9c85f9-d7f76795-471f-4971-abd9-23d0b9dee53f',
            // 'Authorization' => 'App 82de6e44882b59fc74eb07e67966a6db-bb5d3ed5-12d2-486d-bd27-5ce585c1585f',
            'Authorization' => 'App 82de6e44882b59fc74eb07e67966a6db-bb5d3ed5-12d2-486d-bd27-5ce585c1585f',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])
        ->post('https://e52xg3.api.infobip.com/sms/2/text/advanced', [
            // ->post('https://kq8861.api.infobip.com/sms/2/text/advanced', [
            'messages' => [
                [
                    'destinations' => [
                        ['to' => $contact]  
                    ],
                    // 'from' => 'ServiceSMS',
                    'from' => '447491163443',
                    'text' => 'Good day! You have a vaccination schedule today. Don\'t forget to visit the Olongapo City ABTC!',
                ]
            ]
        ]);

        return $response->successful();

        // Movider requires 'application/x-www-form-urlencoded'
        // $response = Http::asForm()->withHeaders([
        //     'Content-Type' => 'application/x-www-form-urlencoded',
        //     'cache-control' => 'no-cache'
        // ])->post('https://api.movider.co/v1/sms', [
        //     'api_key' => '2vUkiKAdSV938sZaF3JoHXUc1xp',
        //     'api_secret' => '8xaetCeQo49yceRgVNCUhzoUyCM9sTFX3JIT34Q1',
        //     'text' => "Good day! You have a vaccination schedule today. Don't forget to visit the Olongapo City ABTC!",
        //     'to' => $contact,
        //     'from' => ''
        // ]);

        // if (!$response->successful()) {
        //     logger()->error('Movider SMS failed', [
        //         'status' => $response->status(),
        //         'reason' => $response->reason(),
        //         'body' => $response->body()
        //     ]);
        // } else {
        //     logger()->info('Movider SMS sent', [
        //         'body' => $response->body()
        //     ]);
        // }

        // return $response->successful();
    }
}