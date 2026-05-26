<?php
defined('ABSPATH') || exit;

class EmailHtmlLayout
{
    public static function wrap(string $dfTitle, string $dfContent, string $dfBadge = ''): string
    {
        $dfBadgeHtml = $dfBadge !== ''
            ? '<p style="margin:0 0 12px;font-size:12px;font-weight:700;letter-spacing:0.04em;text-transform:uppercase;color:#93c5fd">' . esc_html($dfBadge) . '</p>'
            : '';

        return '<!DOCTYPE html><html lang="de"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>'
            . '<body style="margin:0;padding:0;background:#f1f5f9;font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Arial,sans-serif">'
            . '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:24px 12px">'
            . '<tr><td align="center">'
            . '<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#fff;border-radius:12px;overflow:hidden;border:1px solid #e2e8f0">'
            . '<tr><td style="background:linear-gradient(145deg,#1e293b 0%,#334155 100%);padding:24px 28px;color:#fff">'
            . '<p style="margin:0 0 4px;font-size:13px;font-weight:600;color:#93c5fd">Autohaus Vorleitner</p>'
            . $dfBadgeHtml
            . '<h1 style="margin:0;font-size:22px;font-weight:700;line-height:1.3;color:#fff">' . esc_html($dfTitle) . '</h1>'
            . '</td></tr>'
            . '<tr><td style="padding:28px;color:#334155;font-size:15px;line-height:1.55">' . $dfContent . '</td></tr>'
            . '<tr><td style="padding:16px 28px 24px;background:#f8fafc;border-top:1px solid #e2e8f0;font-size:12px;color:#64748b;line-height:1.5">'
            . 'Diese E-Mail wurde automatisch vom Kundenformular auf <a href="https://www.vorleitner.de" style="color:#2563eb">vorleitner.de</a> erzeugt.'
            . '</td></tr>'
            . '</table></td></tr></table></body></html>';
    }

    public static function intro(string $dfText): string
    {
        return '<p style="margin:0 0 20px;color:#475569;font-size:15px;line-height:1.55">' . $dfText . '</p>';
    }

    public static function section(string $dfHeading, string $dfRowsHtml): string
    {
        return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0 0 20px;border:1px solid #e2e8f0;border-radius:10px;overflow:hidden">'
            . '<tr><td colspan="2" style="padding:10px 14px;background:#f1f5f9;font-size:13px;font-weight:700;color:#1e293b;border-bottom:1px solid #e2e8f0">'
            . esc_html($dfHeading)
            . '</td></tr>'
            . $dfRowsHtml
            . '</table>';
    }

    public static function row(string $dfLabel, string $dfValue): string
    {
        if (trim($dfValue) === '') {
            return '';
        }

        return '<tr>'
            . '<td style="width:38%;padding:10px 14px;background:#fafafa;font-size:13px;font-weight:600;color:#64748b;vertical-align:top;border-top:1px solid #f1f5f9">'
            . esc_html($dfLabel)
            . '</td>'
            . '<td style="padding:10px 14px;font-size:14px;color:#1e293b;vertical-align:top;border-top:1px solid #f1f5f9">'
            . nl2br(esc_html($dfValue))
            . '</td></tr>';
    }

    public static function notice(string $dfText): string
    {
        return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin:0;background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px">'
            . '<tr><td style="padding:14px 16px;font-size:14px;color:#1e40af;line-height:1.5">'
            . $dfText
            . '</td></tr></table>';
    }
}
