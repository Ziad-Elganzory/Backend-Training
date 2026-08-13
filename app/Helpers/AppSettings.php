<?php 

namespace App\Helpers;

class AppSettings
{
    private static ?AppSettings $instance = null;

    private array $settings = [];

    private function __construct(){}

    public static function getInstance(): AppSettings
    {
        if(self::$instance === null){
            self::$instance = new AppSettings();
        }
        return self::$instance;
    }

    public function get(string $key)
    {
        return $this->settings[$key] ?? null;
    }

    public function set(string $key, mixed $value)
    {
        $this->settings[$key] = $value;
    }

    public function __clone(){}

    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a singleton');
    }
}