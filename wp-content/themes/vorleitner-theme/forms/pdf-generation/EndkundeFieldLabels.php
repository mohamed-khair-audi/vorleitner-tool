<?php
defined('ABSPATH') || exit;

class EndkundeFieldLabels
{
    public static function jaNein(): array
    {
        return ['ja' => 'Ja', 'nein' => 'Nein'];
    }

    public static function unfallPanne(): array
    {
        return ['unfall' => 'Unfall', 'panne' => 'Panne'];
    }

    public static function unfallSchuld(): array
    {
        return [
            'selbst_schuld'  => 'Sie sind selbst schuld',
            'gegner_schuld'  => 'Der Unfallgegner ist schuld',
            'schuld_unklar'  => 'Schuldfrage ist unklar',
        ];
    }

    public static function werkstattOption(): array
    {
        return [
            'nur_diagnose' => 'Sie wünschen vorerst nur die Diagnose (71,00 – 238,00 Euro, Kosten sind zu rechnen)',
            'nur_anruf'    => 'Sie wünschen zunächst nur einen Anruf',
            'beauftragung' => 'Sie beauftragen die Firma Vorleitner mit Reparatur, Diagnose und Ersatzteile-Bestellung',
        ];
    }

    public static function label(string $dfKey, string $dfValue): string
    {
        $dfMaps = [
            'ist_fahrzeugeigentuemer'   => self::jaNein(),
            'unfall_oder_panne'         => self::unfallPanne(),
            'unfall_schuldfrage'        => self::unfallSchuld(),
            'werkstattleistung_gewuenscht' => self::jaNein(),
            'werkstattleistung_option'  => self::werkstattOption(),
            'ersatzfahrzeug_gewuenscht' => self::jaNein(),
            'auto_selbst_abholung'      => self::jaNein(),
            'sammeltransport_geplant'   => self::jaNein(),
            'wertgegenstaende_im_fzg'   => self::jaNein(),
        ];

        return $dfMaps[$dfKey][$dfValue] ?? $dfValue;
    }
}
