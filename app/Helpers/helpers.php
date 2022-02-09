<?php

if (!function_exists('NumberOnly')) {
    /**
     * Retorna apenas numeros
     *
     * @param string $value
     * @return int
     */
    function NumberOnly($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }
}
