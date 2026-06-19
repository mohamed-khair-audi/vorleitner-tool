<?php
defined('ABSPATH') || exit;

class EndkundeValidationRules
{
    public static function getBase(): array
    {
        return [
            'beauftragte_leistungen' => [
                'required' => true,
                'type'     => 'array',
                'in'       => array_keys(EndkundeFieldLabels::beauftragteLeistungen()),
                'label'    => 'Beauftragte Leistungen',
            ],
            'kunde_vorname'      => ['required' => true, 'max_length' => 100, 'label' => 'Vorname'],
            'kunde_nachname'     => ['required' => true, 'max_length' => 100, 'label' => 'Name'],
            'kunde_strasse'      => ['required' => true, 'max_length' => 200, 'label' => 'Straße'],
            'kunde_hausnummer'   => ['required' => true, 'max_length' => 20,  'label' => 'Hausnr.'],
            'kunde_plz'          => ['required' => true, 'pattern' => '/^\d{5}$/', 'label' => 'PLZ'],
            'kunde_ort'          => ['required' => true, 'max_length' => 100, 'label' => 'Wohnort'],
            'kunde_telefon'      => ['required' => true, 'max_length' => 50, 'pattern' => '/^[\+]?[0-9][\d\s\-]{5,50}$/', 'label' => 'Telefonnummer (Handy)'],
            'kunde_email'        => ['required' => true, 'type' => 'email', 'label' => 'E-Mail'],
            'ist_fahrzeugeigentuemer' => ['required' => true, 'in' => ['ja', 'nein'], 'label' => 'Ich bin der Fahrzeugeigentümer'],
            'fahrzeug_hersteller' => ['required' => true, 'max_length' => 100, 'label' => 'Hersteller'],
            'fahrzeug_typ'       => ['required' => true, 'max_length' => 150, 'label' => 'Typ'],
            'kennzeichen'        => ['required' => true, 'max_length' => 20, 'label' => 'Kennzeichen'],
            'km_stand'           => ['type' => 'integer', 'min' => 0, 'label' => 'Kilometerstand'],
            'unfall_oder_panne'  => ['required' => true, 'in' => ['unfall', 'panne'], 'label' => 'Unfall oder Panne'],
            'schaden_beschreibung' => ['required' => true, 'max_length' => 5000, 'label' => 'Was fehlt Ihrem Fahrzeug? (Schadenbeschreibung)'],
            'ersatzfahrzeug_gewuenscht' => ['required' => true, 'in' => ['ja', 'nein'], 'label' => 'Ersatzfahrzeug'],
            'auto_selbst_abholung' => ['required' => true, 'in' => ['ja', 'nein'], 'label' => 'Fahrzeugabholung'],
            'sammeltransport_geplant' => ['required' => true, 'in' => ['ja', 'nein'], 'label' => 'Sammeltransport'],
            'wertgegenstaende_im_fzg' => ['required' => true, 'in' => ['ja', 'nein'], 'label' => 'Wertgegenstände'],
            'sonstige_anmerkungen' => ['max_length' => 5000, 'label' => 'Sonstige Anmerkungen'],
            'agb_akzeptiert'     => ['required' => true, 'in' => ['1'], 'label' => 'Zustimmung zu AGB und Datenschutz'],
            'unterschrift_base64' => ['required' => true, 'label' => 'Digitale Unterschrift'],
        ];
    }

    public static function getConditional(array $dfData): array
    {
        $dfRules = [];

        if (($dfData['ist_fahrzeugeigentuemer'] ?? '') === 'nein') {
            $dfRules['eigentuemer_name']    = ['required' => true, 'max_length' => 200, 'label' => 'Name des Fahrzeugeigentümers'];
            $dfRules['eigentuemer_strasse'] = ['required' => true, 'max_length' => 200, 'label' => 'Straße (Eigentümer)'];
            $dfRules['eigentuemer_hausnummer'] = ['required' => true, 'max_length' => 20, 'label' => 'Hausnr. (Eigentümer)'];
            $dfRules['eigentuemer_plz']     = ['required' => true, 'pattern' => '/^\d{5}$/', 'label' => 'PLZ (Eigentümer)'];
            $dfRules['eigentuemer_ort']     = ['required' => true, 'max_length' => 100, 'label' => 'Ort (Eigentümer)'];
            $dfRules['eigentuemer_telefon'] = ['required' => true, 'max_length' => 50, 'pattern' => '/^[\+]?[0-9][\d\s\-]{5,50}$/', 'label' => 'Telefon (Eigentümer)'];
            $dfRules['eigentuemer_email']   = ['required' => true, 'type' => 'email', 'label' => 'E-Mail (Eigentümer)'];
        }

        if (($dfData['auto_selbst_abholung'] ?? '') === 'nein') {
            $dfRules['abholer_name']     = ['required' => true, 'max_length' => 200, 'label' => 'Name des Abholers'];
            $dfRules['abholer_strasse']  = ['required' => true, 'max_length' => 200, 'label' => 'Straße (Abholer)'];
            $dfRules['abholer_hausnummer'] = ['required' => true, 'max_length' => 20, 'label' => 'Hausnr. (Abholer)'];
            $dfRules['abholer_plz']      = ['required' => true, 'pattern' => '/^\d{5}$/', 'label' => 'PLZ (Abholer)'];
            $dfRules['abholer_ort']      = ['required' => true, 'max_length' => 100, 'label' => 'Ort (Abholer)'];
            $dfRules['abholer_telefon']  = ['required' => true, 'max_length' => 50, 'pattern' => '/^[\+]?[0-9][\d\s\-]{5,50}$/', 'label' => 'Telefonnummer (Abholer)'];
            $dfRules['abholer_vollmacht'] = ['required' => true, 'in' => ['1'], 'label' => 'Vollmacht für Abholer'];
        }

        if (($dfData['unfall_oder_panne'] ?? '') === 'unfall') {
            $dfRules['unfall_schuldfrage'] = [
                'required' => true,
                'in'       => array_keys(EndkundeFieldLabels::unfallSchuld()),
                'label'    => 'Schuldfrage',
            ];
        }

        $dfLeistungen = (array)($dfData['beauftragte_leistungen[]'] ?? $dfData['beauftragte_leistungen'] ?? []);
        if (in_array('werkstattauftrag', $dfLeistungen, true)) {
            $dfRules['werkstattleistung_option'] = [
                'required' => true,
                'in'       => array_keys(EndkundeFieldLabels::werkstattOption()),
                'label'    => 'Werkstattauftrag – Umfang',
            ];
        }

        if (($dfData['wertgegenstaende_im_fzg'] ?? '') === 'ja') {
            $dfRules['wertgegenstaende_beschreibung'] = [
                'required'   => true,
                'max_length' => 2000,
                'label'      => 'Beschreibung der Wertgegenstände',
            ];
        }

        return $dfRules;
    }

    public static function getAll(array $dfData): array
    {
        return array_merge(self::getBase(), self::getConditional($dfData));
    }
}
