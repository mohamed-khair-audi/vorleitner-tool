<?php
defined('ABSPATH') || exit;

class WerkstattValidationRules
{
    public static function get(): array
    {
        return [
            'kunde_vorname'                => ['required' => true, 'max_length' => 100, 'label' => 'Vorname'],
            'kunde_nachname'               => ['required' => true, 'max_length' => 100, 'label' => 'Nachname'],
            'kunde_strasse'                => ['max_length' => 200, 'label' => 'Straße'],
            'kunde_hausnummer'             => ['max_length' => 20,  'label' => 'Hausnummer'],
            'kunde_plz'                    => ['pattern' => '/^\d{5}$/', 'label' => 'PLZ'],
            'kunde_ort'                    => ['max_length' => 100, 'label' => 'Ort'],
            'kunde_telefon'                => ['max_length' => 50,  'label' => 'Telefon'],
            'kunde_email'                  => ['type' => 'email', 'label' => 'E-Mail'],
            'fahrzeug_typ_modell'          => ['required' => true, 'max_length' => 150, 'label' => 'Fahrzeugtyp'],
            'kennzeichen'                  => ['max_length' => 20, 'label' => 'Kennzeichen'],
            'km_stand'                     => ['type' => 'integer', 'min' => 0, 'label' => 'KM-Stand'],
            'fahrzeug_ident_nummer'        => ['max_length' => 17, 'pattern' => '/^[A-HJ-NPR-Z0-9]{17}$/i', 'label' => 'FIN (17 Zeichen)'],
            'annahmetermin'                => ['required' => true, 'type' => 'datetime', 'label' => 'Annahmetermin'],
            'ersatzfahrzeug_typ'           => ['in' => array_keys(WerkstattFieldLabels::ersatzfahrzeugTyp()), 'label' => 'Ersatzfahrzeug'],
            'kostenangebot_euro'           => ['type' => 'decimal', 'min' => 0, 'label' => 'Kostenangebot'],
            'arbeitszeit_stunden'          => ['type' => 'decimal', 'min' => 0, 'label' => 'Arbeitszeit'],
            'motoroel_korrigiert_liter'    => ['type' => 'decimal', 'min' => 0, 'label' => 'Motoröl (Liter)'],
            'kuehlmittel_korrigiert_liter' => ['type' => 'decimal', 'min' => 0, 'label' => 'Kühlmittel (Liter)'],
            'frostschutz_temperatur_grad'  => ['type' => 'integer', 'label' => 'Frostschutz (°C)'],
            'probefahrt_minuten'           => ['type' => 'integer', 'min' => 0, 'label' => 'Probefahrt (Min.)'],
        ];
    }
}
