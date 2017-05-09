<?php

/**
 * @param string $key
 * @param integer|float|string|boolean|array $value
 */
function saveToStorage($key, $value)
{
    global $_SESSION;

    $_SESSION[$key] = $value;
}


/**
 * @param string $key
 * @return integer|float|string|boolean|array
 */
function getFromStorage($key)
{
    global $_SESSION;

    return $_SESSION[$key];
}