<?php

namespace App\Services;

use telesign\sdk\messaging\MessagingClient;
use Illuminate\Support\Facades\Log;

class TelesignService
{
    private $customerId = '7F8C4E5A-9D15-4235-95CE-80BBD275A75E';  // Replace with your Telesign customer ID
    private $apiKey = 'ykXueJTcXEA2t11ycyJnSQqq3zwCB1ObeevJMsVH++wKpEyuOGMEhLhbf/2wmMtvHEpaNV7t6gls0FumQswmWA==';  // Replace with your Telesign API key

    public function sendSMS($phoneNumber, $message)
    {
        // Create the Telesign messaging client instance
        $messagingClient = new MessagingClient($this->customerId, $this->apiKey);

        // Set the message type (e.g., "ARN" for alerts)
        $messageType = "ARN";

        // Send the message via Telesign
        $response = $messagingClient->message($phoneNumber, $message, $messageType, []);

        // Log the response for debugging purposes
        Log::info('Telesign Response: ' . print_r($response->json(), true));

        // Check if the response is successful and return true/false accordingly
        return $response->status_code == 200;
    }
}
