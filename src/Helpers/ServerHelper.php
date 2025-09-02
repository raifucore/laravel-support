<?php

namespace RaifuCore\Support\Helpers;

class ServerHelper
{
    public static function realIP(): string
    {
        $ip = null;

        if ($servItem = filter_input(INPUT_SERVER, 'HTTP_X_REAL_IP')) {
            $ips = explode(',', $servItem);
            $ip = self::isValidIp($ips[0]) ? $ips[0] : null;
        }

        if (! $ip && $servItem = filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR')) {
            $ips = explode(',', $servItem);
            $ip = self::isValidIp($ips[0]) ? $ips[0] : null;
        }

        if (! $ip && $servItem = filter_input(INPUT_SERVER, 'REMOTE_ADDR')) {
            $ip = self::isValidIp($servItem) ? $servItem : null;
        }

        if (! $ip && $requestIp = request()->ip()) {
            $ip = self::isValidIp($requestIp) ? $requestIp : null;
        }

        return $ip ?? '';
    }

    public static function isValidIp(string $ip, string $type = 'ipv4'): bool
    {
        $type = strtolower($type);
        $flag = '';
        switch ($type) {
            case 'ipv4': $flag = FILTER_FLAG_IPV4;
                break;
            case 'ipv6': $flag = FILTER_FLAG_IPV6;
                break;
        }

        return (bool) filter_var($ip, FILTER_VALIDATE_IP, $flag);
    }
}
