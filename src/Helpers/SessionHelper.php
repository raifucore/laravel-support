<?php

namespace RaifuCore\Support\Helpers;

use Throwable;

class SessionHelper
{
    private static string $flashKey = '_rc_session_flash_';

    public static function get(string|null $item = null): mixed
    {
        $data = session()->all();

        return is_null($item) ? $data : ($data[$item] ?? null);
    }

    public static function set(string|array $key, mixed $value = null): void
    {
        session()->put($key, $value);
    }

    public static function unset(string|array $key): void
    {
        session()->forget($key);
    }

    public static function setFlash(string|array $key, mixed $value = null): void
    {
        try {
            $flashData = session()->get(self::$flashKey) ?? [];
        } catch (Throwable) {
            $flashData = [];
        }

        if (is_string($key)) {
            $key = [$key => $value];
        }

        if (count($key) > 0) {
            foreach ($key as $k => $v) {
                $flashData[$k] = $v;
            }
        }
        session()->put(self::$flashKey, $flashData);
    }

    public static function getFlash(string $key, bool $keep = false): mixed
    {
        try {
            $flashData = session()->get(self::$flashKey) ?? [];
        } catch (Throwable) {
            $flashData = [];
        }

        if (! $flashData) {
            return null;
        }

        $flash = $flashData[$key] ?? null;

        if (! $keep && isset($flashData[$key])) {
            unset($flashData[$key]);
            if ($flashData) {
                session()->put(self::$flashKey, $flashData);
            } else {
                session()->forget(self::$flashKey);
            }
        }

        return $flash;
    }
}
