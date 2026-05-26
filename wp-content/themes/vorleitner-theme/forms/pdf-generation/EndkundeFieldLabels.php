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
            'selbst_schuld'  => 'Sind Sie selbst schuld?',
            'gegner_schuld'  => 'Ist der Unfallgegner schuld?',
            'schuld_unklar'  => 'Schuldfrage unklar?',
        ];
    }

    public static function werkstattOption(): array
    {
        return [
            'nur_diagnose' => 'Wollen Sie vorerst die Diagnose (71,00 – 238,00 Euro, Kosten ist zu rechnen)',
            'nur_anruf'    => 'Wollen Sie erstmal nur einen Anruf?',
            'beauftragung' => 'Hiermit beauftrag ich die Firma Vorleitner mit der Reparatur, Diagnose und Ersatzteile Bestellung',
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
