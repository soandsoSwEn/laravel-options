<?php


use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

if (!function_exists('setOption')) {
    /**
     * The function sets the parameter value by its key
     *
     * @param string $key Parameter key
     * @param string|array $value Parameter value
     * @return bool
     */
    function setOption(string $key, $value) : bool {
        return app('Option')->set($key, $value);
    }
}

if (!function_exists('getOption')) {
    /**
     * The function returns the value of the parameter by its key
     *
     * @param string $key
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function getOption(string $key) {
        return app('Option')->get($key);
    }
}