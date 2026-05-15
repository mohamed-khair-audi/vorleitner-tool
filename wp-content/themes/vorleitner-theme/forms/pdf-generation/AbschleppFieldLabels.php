<?php
defined('ABSPATH') || exit;

class AbschleppFieldLabels
{
    public static function einsatzTyp(): array
    {
        return PodsPickOptions::get('vorleitner_auftrag', 'einsatz_typ', [
            'panne'          => 'Panne',
            'unfall'         => 'Unfall',
            'bergung'        => 'Bergung',
            'sicherstellung' => 'Sicherstellung',
        ]);
    }

    public static function hinweisPerKanal(): array
    {
        return PodsPickOptions::get('vorleitner_auftrag', 'standgeld_hingewiesen_per', [
            'telefon'     => 'Telefon',
            'sms'         => 'SMS',
            'whatsapp'    => 'WhatsApp',
            'post'        => 'Post',
            'email'       => 'E-Mail',
            'muendlich'   => 'Mündlich',
            'persoenlich' => 'Persönlich',
        ]);
    }

    public static function zusatzleistungen(): array
    {
        return PodsPickOptions::get('vorleitner_auftrag', 'zusatzleistungen', [
            'strassenreinigung'         => 'Straßenreinigung',
            'reinigung_einsatzfahrzeug' => 'Reinigung Einsatzfahrzeug',
            'reinigung_standflaeche'    => 'Reinigung Standfläche',
            'gabelstapler'              => 'Gabelstaplereinsatz',
            'gdv_pauschale'             => 'GDV-Notdienstpauschale',
            'bergung_stunden'           => 'Bergung Std.',
            'bergungshelfer'            => 'Bergungshelfer',
            'gutachter'                 => 'Gutachter beauftragen',
            'schluessel_vorhanden'      => 'Schlüssel vorhanden',
            'gewichtszuschlag'          => 'Gewichtszuschlag',
        ]);
    }

    public static function auftragsart(): array
    {
        return PodsPickOptions::get('vorleitner_auftrag', 'auftragsart', [
            'adac'        => 'ADAC',
            'gdv'         => 'GDV',
            'polizei'     => 'Polizei',
            'versicherung' => 'Versicherung',
            'sonstige'    => 'Sonstige',
            'privat'      => 'Privat',
            'assistance'  => 'Assistance Partner',
        ]);
    }
}
