<?php

class FacebookConversions
{
  private $accessToken;
  private $pixelId;
  private $apiUrl;

  private function hashData($data)
  {
    return hash('sha256', $data);
  }

  public function __construct($config)
  {
    $this->accessToken = $config['access_token'];
    $this->pixelId = $config['pixel_id'];
    $this->apiUrl = $config['api_url'];
  }

  public function sendEvent($eventName, $eventData)
  {
    // Hashear campos do user_data automaticamente
    $hashedUserData = [];
    if (isset($eventData['user_data'])) {
      foreach ($eventData['user_data'] as $key => $value) {
        $hashedUserData[$key] = $this->hashData($value);
      }
    }

    $data = [
      'data' => [
        [
          'event_name' => $eventName,
          'event_time' => time(),
          'user_data'  => $hashedUserData,
          'custom_data' => $eventData['custom_data'] ?? [],
        ]
      ],
      'access_token' => $this->accessToken,
    ];

    $url = "{$this->apiUrl}/{$this->pixelId}/events";
    return $this->makeRequest($url, $data);
  }


  private function makeRequest($url, $data)
  {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
  }
}
