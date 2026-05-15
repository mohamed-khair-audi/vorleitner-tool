<?php
defined('ABSPATH') || exit;

class AbschleppValidationRules
{
    public static function get(): array
    {
        return [
            'auftragsart'                  => ['required' => true, 'in' => array_keys(AbschleppFieldLabels::auftragsart()), 'label' => 'Auftragsgeber'],
            'kunde_vorname'                => ['required' => true, 'max_length' => 100, 'label' => 'Vorname'],
            'kunde_nachname'               => ['required' => true, 'max_length' => 100, 'label' => 'Nachname'],
            'kunde_strasse'                => ['max_length' => 200, 'label' => 'Straße'],
            'kunde_hausnummer'             => ['max_length' => 20,  'label' => 'Hausnummer'],
            'kunde_plz'                    => ['pattern' => '/^\d{5}$/', 'label' => 'PLZ'],
            'kunde_ort'                    => ['max_length' => 100, 'label' => 'Ort'],
            'kunde_telefon'                => ['max_length' => 50,  'label' => 'Telefon'],
            'kennzeichen'                  => ['required' => true, 'max_length' => 20, 'label' => 'Kennzeichen'],
            'fahrzeug_gewicht_zulaessig'   => ['type' => 'integer', 'min' => 0, 'max' => 50000, 'label' => 'Gesamtgewicht (kg)'],
            'datum'                        => ['required' => true, 'type' => 'date', 'label' => 'Datum'],
            'einsatz_typ'                  => ['type' => 'array', 'in' => array_keys(AbschleppFieldLabels::einsatzTyp()), 'label' => 'Auftragsart'],
            'standgeld_betrag_euro'        => ['type' => 'decimal', 'min' => 0, 'label' => 'Standgeld'],
            'bergung_stunden_anzahl'       => ['type' => 'decimal', 'min' => 0, 'label' => 'Bergung Stunden'],
            'fahrzeug_versichert_bei'      => ['max_length' => 200, 'label' => 'Versicherung'],
            'versicherung_schaden_nummer'  => ['max_length' => 100, 'label' => 'Schadennummer'],
        ];
    }
}
