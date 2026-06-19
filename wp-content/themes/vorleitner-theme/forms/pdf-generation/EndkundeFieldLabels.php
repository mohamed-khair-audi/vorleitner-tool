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
            'selbst_schuld'  => 'Ich bin selbst schuld',
            'gegner_schuld'  => 'Der Unfallgegner ist schuld',
            'schuld_unklar'  => 'Schuldfrage unklar',
        ];
    }

    public static function werkstattOption(): array
    {
        return [
            'nur_diagnose' => 'Ich wünsche vorerst nur eine Diagnose.',
            'nur_anruf'    => 'Ich möchte zunächst nur einen Anruf.',
            'beauftragung' => 'Hiermit beauftrage ich die Firma Vorleitner mit der Reparatur, Diagnose und Ersatzteile-Bestellung.',
        ];
    }

    public static function beauftragteLeistungen(): array
    {
        return [
            'abschleppen'      => 'Abschleppleistung',
            'pannenhilfe'      => 'Pannenhilfe',
            'werkstattauftrag' => 'Werkstattauftrag für Diagnose und Reparatur',
        ];
    }

    public static function leistungenLabel(array $dfValues): string
    {
        $dfMap    = self::beauftragteLeistungen();
        $dfLabels = array_map(fn($v) => $dfMap[$v] ?? $v, (array) $dfValues);
        return implode(', ', $dfLabels);
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
