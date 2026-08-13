<?php

namespace App\Services;

class NotificationSettingsManager
{
    private $settings = [];

    public function __construct(){
        $this->settings = [
            'email_enabled' => true,
            'sms_enabled' => false,
            'default_channel' => 'email',
        ];
    }

    public function get(string $key){
        return $this->settings[$key] ?? null;
    }
    public function set(string $key, mixed $value){
        $this->settings[$key] = $value;
    }
    public function all(){
        return $this->settings;
    }
}