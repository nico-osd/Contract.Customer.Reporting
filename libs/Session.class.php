<?php
/**
 * Created by PhpStorm.
 * User: fabiangrutsch
 * Date: 01.05.14
 * Time: 19:01
 *
 * package libs/
 *
 */

class Session {

    /**
     * Initialize new Session
     */
    public static function init() {
        @session_start();
    }

    /**
     * Set Session data as key => value pair
     *
     * @param string $key The key
     * @param mixed $value The value for the key
     */
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function setMultiple($data = array()) {
        foreach($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    /**
     * Get Session data from key
     *
     * @param string $key The key
     * @return mixed
     */
    public static function get($key) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * Destroy Session
     */
    public static function destroy() {
        //unset($_SESSION);
        session_destroy();
    }
}