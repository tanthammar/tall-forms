<?php

namespace Tanthammar\TallForms;

class Helpers
{
    public static function unique_words(string $scentence): string
    {
        return implode(' ', array_unique(explode(' ', $scentence)));
    }

    public static function mergeFilledToObject(array $defaults, array $custom): object
    {
        return (object)array_merge($defaults, array_filter($custom, fn ($var) => filled($var)));
    }

    public static function mergeFilledToArray(array $defaults, array $custom): array
    {
        return array_merge($defaults, array_filter($custom, fn ($var) => filled($var)));
    }
}
