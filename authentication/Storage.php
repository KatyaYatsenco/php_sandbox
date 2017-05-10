<?php

class Storage
{

    public function set($key, $value)
    {
        $this->saveToStorage($key, $value);
    }

    public function get($key)
    {
        return $this->getFromStorage($key);
    }

    /**
     * @param string $key
     * @param integer|float|string|boolean|array $value
     */
    private function saveToStorage($key, $value)
    {
        global $_SESSION;

        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return integer|float|string|boolean|array
     */
    private function getFromStorage($key)
    {
        global $_SESSION;

        return $_SESSION[$key];
    }
}




