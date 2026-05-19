<?php
defined('ABSPATH') || exit;

class AuftragSettings
{
    private const PODS_SLUG = AuftragConstants::PODS_SETTINGS_SLUG;
    private const FIELD_AB  = 'recipient_email_abschleppen';
    private const FIELD_WS  = 'recipient_email_werkstatt';
    private const FIELD_TD  = 'vorleitner_testdaten_aktiv';

    public static function registerDefaults(): void
    {
        $dfAdminEmail = (string) get_option('admin_email');
        foreach ([self::FIELD_AB, self::FIELD_WS] as $dfField) {
            $dfOptionKey = self::PODS_SLUG . '_' . $dfField;
            if (empty(get_option($dfOptionKey))) {
                update_option($dfOptionKey, $dfAdminEmail);
            }
        }
    }

    public static function isTestdatenAktiv(): bool
    {
        return (bool) self::getSetting(self::FIELD_TD);
    }

    public static function getAbschleppRecipient(): string
    {
        return self::getSetting(self::FIELD_AB);
    }

    public static function getWerkstattRecipient(): string
    {
        return self::getSetting(self::FIELD_WS);
    }

    private static function getSetting(string $dfFieldName): string
    {
        try {
            $dfPod   = pods(self::PODS_SLUG);
            $dfValue = $dfPod ? (string) $dfPod->field($dfFieldName) : '';
        } catch (\Exception $dfEx) {
            $dfValue = '';
        }

        return !empty($dfValue) ? $dfValue : '';
    }
}
