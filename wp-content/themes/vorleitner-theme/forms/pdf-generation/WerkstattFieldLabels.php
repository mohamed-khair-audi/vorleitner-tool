<?php
defined('ABSPATH') || exit;

class WerkstattFieldLabels
{
    private const DF_POD = 'vorleitner_auftrag';

    public static function ersatzfahrzeugTyp(): array
    {
        return PodsPickOptions::get(self::DF_POD, 'ersatzfahrzeug_typ', [
            'keines'                  => 'Keines',
            'mietfahrzeug'            => 'Mietfahrzeug',
            'werkstattersatzfahrzeug' => 'Werkstattersatzfahrzeug',
            'clubmobil'               => 'Clubmobil',
        ]);
    }

    /**
     * Checkliste: Feld-Key → Label, direkt aus den Pods-Felddefinitionen.
     * Reihenfolge ist fix (bestimmt linke/rechte PDF-Spalte).
     * Fallbacks greifen wenn Pods nicht verfügbar ist.
     */
    public static function checklistItems(): array
    {
        return PodsFieldLabel::getMany(self::DF_POD, [
            'probefahrt_durchgefuehrt'          => 'Probefahrt durchgeführt',
            'motorraum_verschluesse_zu'          => 'Alle Verschlüsse / Deckel im Motorraum zu',
            'fahrzeug_abholfertig_hergerichtet'  => 'Fahrzeug abholfertig hergerichtet',
            'abschlepphaken_entfernt'            => 'Abschlepphaken entfernt',
            'lack_spuren_entfernt'               => 'Alle Spuren / Fingerabdrücke auf Lack entfernt',
            'beleuchtung_ok'                     => 'Beleuchtung ok',
            'serviceheft_eintrag_gemacht'        => 'Servicehefteintrag gemacht',
            'service_intervall_zurueckgestellt'  => 'Service zurückgestellt',
            'fahrzeug_gereinigt_innen_aussen'    => 'Fahrzeug gereinigt innen + außen',
            'motoroel_stand_ok'                  => 'Motorölstand ok',
            'kuehlmittel_ok'                     => 'Kühlmittel ok',
            'frostschutz_ok'                     => 'Frostschutz ok',
            'endkontrolle_durchgefuehrt'         => 'Endkontrolle durchgeführt',
        ]);
    }
}
