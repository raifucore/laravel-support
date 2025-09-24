<?php

if (!function_exists('pathWithModifyTime')) {
    function pathWithModifyTime(string $publicPath): string
    {
        $fullPath = app()->publicPath($publicPath);
        return $publicPath . (file_exists($fullPath) ? '?mod=' . filemtime($fullPath) : '');
    }
}

if (!function_exists('rroute')) {
    function rroute(string $name, array $parameters = []): string
    {
        return route($name, $parameters, false);
    }
}
