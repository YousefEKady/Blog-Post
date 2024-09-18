<?php
namespace todoApp\classes;
class Session
{
    // Start
    public function __construct()
    {
        session_start();
    }
    // Set
    public static function set($data, $value)
    {
        $_SESSION[$data] = $value;
    }
    // Get
    public function get($data)
    {
        return isset($_SESSION[$data]) ? $_SESSION[$data] : null;
    }
    // Unset
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
    // Destroy
    public function destroy()
    {
        session_destroy();
    }
}