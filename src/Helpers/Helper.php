<?php

function pathWithModifyTime(string $publicPath): string
{
    $fullPath = app()->publicPath($publicPath);
    return $publicPath . (file_exists($fullPath) ? '?mod=' . filemtime($fullPath) : '');
}

function rroute(string $name, array $parameters = []): string
{
    return route($name, $parameters, false);
}
