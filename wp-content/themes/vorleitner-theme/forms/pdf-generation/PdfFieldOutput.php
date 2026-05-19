<?php
defined('ABSPATH') || exit;

class PdfFieldOutput
{
    public static function text(string $dfValue): string
    {
        return htmlspecialchars(self::normalize($dfValue), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public static function textMultiline(string $dfValue): string
    {
        return nl2br(self::text($dfValue));
    }

    private static function normalize(string $dfValue): string
    {
        $dfValue = html_entity_decode($dfValue, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        // Standard JSON: \u00df
        $dfValue = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', static function (array $dfM): string {
            return mb_chr((int) hexdec($dfM[1]), 'UTF-8');
        }, $dfValue) ?? $dfValue;
        // Backslash lost (e.g. double-encoded): "Stra\u00dfe" becomes "Strau00dfe" — uXXXX between letters
        $dfValue = preg_replace_callback(
            '/(?<=\p{L})u([0-9a-fA-F]{4})(?=\p{L})/u',
            static function (array $dfM): string {
                return mb_chr((int) hexdec($dfM[1]), 'UTF-8');
            },
            $dfValue
        ) ?? $dfValue;
        // uXXXX anywhere not preceded by backslash or word char — lookahead removed
        // because the next char (e.g. "b" in "übergeben") may itself be a hex digit
        $dfValue = preg_replace_callback('/(?<![\\\w])u([0-9a-fA-F]{4})/i', static function (array $dfM): string {
            return mb_chr((int) hexdec($dfM[1]), 'UTF-8');
        }, $dfValue) ?? $dfValue;

        return str_replace(
            ["\u{26A0}\u{FE0F}", "\u{26A0}", '⚠', "\u{2013}", "\u{2014}", '–', '—', '…', "\u{00B7}", '·'],
            ['[!]', '[!]', '[!]', '-', '-', '-', '-', '...', '|', '|'],
            $dfValue
        );
    }
}
