<?php

namespace RaifuCore\Support\Services\Layout;

class Layout
{
    protected static Page|null $page = null;
    protected static Meta|null $meta = null;
    protected static Assets|null $assets = null;
    protected static Messages|null $messages = null;
    protected static Breadcrumbs|null $breadcrumbs = null;
    protected static Counter|null $counter = null;
    protected static array $menu = [];

    public static function page(): Page
    {
        if (is_null(self::$page)) {
            self::$page = new Page();
        }

        return self::$page;
    }

    public static function meta(): Meta
    {
        if (is_null(self::$meta)) {
            self::$meta = new Meta();
        }

        return self::$meta;
    }

    public static function assets(): Assets
    {
        if (is_null(self::$assets)) {
            self::$assets = new Assets();
        }

        return self::$assets;
    }

    public static function messages(): Messages
    {
        if (is_null(self::$messages)) {
            self::$messages = new Messages();
        }

        return self::$messages;
    }

    public static function breadcrumbs(): Breadcrumbs
    {
        if (is_null(self::$breadcrumbs)) {
            self::$breadcrumbs = new Breadcrumbs();
        }

        return self::$breadcrumbs;
    }

    public static function counter(): Counter
    {
        if (is_null(self::$counter)) {
            self::$counter = new Counter();
        }

        return self::$counter;
    }

    public static function menu(string $label = 'default'): Menu
    {
        if (!isset(self::$menu[$label])) {
            self::$menu[$label] = new Menu($label);
        }

        return self::$menu[$label];
    }
}
