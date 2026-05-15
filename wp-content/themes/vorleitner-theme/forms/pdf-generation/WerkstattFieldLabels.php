<?php
defined('ABSPATH') || exit;

class WerkstattFieldLabels
{
    public static function ersatzfahrzeugTyp(): array
    {
        return PodsPickOptions::get('vorleitner_auftrag', 'ersatzfahrzeug_typ', [
            'keines'                  => 'Keines',
            'mietfahrzeug'            => 'Mietfahrzeug',
            'werkstattersatzfahrzeug' => 'Werkstattersatzfahrzeug',
            'clubmobil'               => 'Clubmobil',
        ]);
    }

    /**
     * Checkliste: Feld-Key → Anzeigetext (Ja/Nein-Punkte).
     * Kein Pods-Pick-Feld – zentral hier gepflegt.
     */
    public static function checklistItems(): array
    {
        return [
            'probefahrt_durchgefuehrt'          => 'Probefahrt durchgeführt',
            'motorraum_verschluesse_zu'          => 'Alle Verschlüsse und Deckel im Motorraum zu',
            'fahrzeug_abholfertig_hergerichtet'  => 'Fahrzeug abholfertig hergerichtet',
            'abschlepphaken_entfernt'            => 'Abschlepphaken entfernt',
            'lack_spuren_entfernt'               => 'Alle Spuren / Fingerabdrücke auf Lack entfernt',
            'beleuchtung_ok'                     => 'Beleuchtung ok',
            'serviceheft_eintrag_gemacht'        => 'Servicehefteintrag gemacht',
            'service_intervall_zurueckgestellt'  => 'Service-Intervall zurückgestellt',
            'fahrzeug_gereinigt_innen_aussen'    => 'Fahrzeug gereinigt innen + außen',
            'motoroel_stand_ok'                  => 'Motorölstand ok',
            'kuehlmittel_ok'                     => 'Kühlmittel ok',
            'frostschutz_ok'                     => 'Frostschutz ok',
        ];
    }
}
