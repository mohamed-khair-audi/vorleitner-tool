<?php
defined('ABSPATH') || exit;

class EndkundeEmailContent
{
    public function sendAll(array $dfFormData, string $dfPdfFilePath): void
    {
        $dfSender   = new EmailSender();
        $dfPrepared = (new EndkundePdfDataPreparer())->prepare($dfFormData);
        $dfAttach   = [$dfPdfFilePath];

        $dfAdmin = AuftragSettings::getEndkundeRecipient();
        if ($dfAdmin === '') {
            return;
        }

        $dfSender->send([
            'recipients'  => [$dfAdmin],
            'subject'     => $this->buildAdminSubject($dfPrepared),
            'body'        => $this->buildAdminBody($dfPrepared),
            'attachments' => $dfAttach,
        ]);
    }

    private function buildAdminSubject(array $dfData): string
    {
        $dfKz    = $dfData['kennzeichen'] ?? 'ohne Kennzeichen';
        $dfName  = trim(($dfData['kunde_nachname'] ?? '') . ' ' . ($dfData['kunde_vorname'] ?? ''));

        return sprintf('Kundenauftrag: %s – %s – %s', $dfKz, $dfName, date('d.m.Y H:i'));
    }

    private function buildAdminBody(array $dfData): string
    {
        $dfContent = EmailHtmlLayout::intro(
            'Ein neuer Kundenauftrag ist über das <strong>öffentliche Kundenformular</strong> eingegangen. '
            . 'Alle Details finden Sie unten – die vollständige Auftragskarte mit Unterschrift ist als <strong>PDF im Anhang</strong>.'
        );

        $dfContent .= EmailHtmlLayout::section('Beauftragte Leistungen', EmailHtmlLayout::row('Leistungen', $dfData['beauftragte_leistungen_label'] ?? ''));
        $dfContent .= EmailHtmlLayout::section('Kontakt / Auftraggeber', $this->rowsKontakt($dfData));

        if (($dfData['ist_fahrzeugeigentuemer'] ?? '') === 'nein') {
            $dfContent .= EmailHtmlLayout::section('Fahrzeugeigentümer', $this->rowsEigentuemer($dfData));
        }

        $dfContent .= EmailHtmlLayout::section('Fahrzeug', $this->rowsFahrzeug($dfData));
        $dfContent .= EmailHtmlLayout::section('Unfall / Panne & Schaden', $this->rowsSchaden($dfData));
        if (!empty($dfData['werkstattleistung_option_label'])) {
            $dfContent .= EmailHtmlLayout::section('Werkstattauftrag – Umfang', $this->rowsWerkstatt($dfData));
        }
        $dfContent .= EmailHtmlLayout::section('Zusatzoptionen', $this->rowsOptionen($dfData));

        if (!empty(trim($dfData['sonstige_anmerkungen'] ?? ''))) {
            $dfContent .= EmailHtmlLayout::section('Anmerkungen', EmailHtmlLayout::row('Hinweise', $dfData['sonstige_anmerkungen']));
        }

        $dfContent .= EmailHtmlLayout::section('Abschluss', $this->rowsAbschluss($dfData));

        $dfContent .= '<div style="margin-top:20px">'
            . EmailHtmlLayout::notice('📎 <strong>PDF-Anhang:</strong> Vollständiger Kundenauftrag inkl. digitaler Unterschrift und Infotext.')
            . '</div>';

        return EmailHtmlLayout::wrap(
            'Neuer Kundenauftrag',
            $dfContent,
            'Online-Formular'
        );
    }

    private function rowsKontakt(array $dfData): string
    {
        return EmailHtmlLayout::row('Name', trim(($dfData['kunde_vorname'] ?? '') . ' ' . ($dfData['kunde_nachname'] ?? '')))
            . EmailHtmlLayout::row('Adresse', trim(($dfData['kunde_strasse'] ?? '') . ' ' . ($dfData['kunde_hausnummer'] ?? '')) . ', ' . ($dfData['kunde_plz'] ?? '') . ' ' . ($dfData['kunde_ort'] ?? ''))
            . EmailHtmlLayout::row('Telefonnummer (Handy)', $dfData['kunde_telefon'] ?? '')
            . EmailHtmlLayout::row('E-Mail', $dfData['kunde_email'] ?? '')
            . EmailHtmlLayout::row('Ich bin der Fahrzeugeigentümer', $dfData['ist_fahrzeugeigentuemer_label'] ?? '');
    }

    private function rowsEigentuemer(array $dfData): string
    {
        return EmailHtmlLayout::row('Name', $dfData['eigentuemer_name'] ?? '')
            . EmailHtmlLayout::row('Adresse', trim(($dfData['eigentuemer_strasse'] ?? '') . ' ' . ($dfData['eigentuemer_hausnummer'] ?? '')) . ', ' . ($dfData['eigentuemer_plz'] ?? '') . ' ' . ($dfData['eigentuemer_ort'] ?? ''))
            . EmailHtmlLayout::row('Telefonnummer', $dfData['eigentuemer_telefon'] ?? '')
            . EmailHtmlLayout::row('E-Mail', $dfData['eigentuemer_email'] ?? '');
    }

    private function rowsFahrzeug(array $dfData): string
    {
        return EmailHtmlLayout::row('Hersteller / Typ', trim(($dfData['fahrzeug_hersteller'] ?? '') . ' ' . ($dfData['fahrzeug_typ'] ?? '')))
            . EmailHtmlLayout::row('Kennzeichen', $dfData['kennzeichen'] ?? '')
            . EmailHtmlLayout::row('KM-Stand (ca.)', (string) ($dfData['km_stand'] ?? ''));
    }

    private function rowsSchaden(array $dfData): string
    {
        $dfRows = EmailHtmlLayout::row('Art', $dfData['unfall_oder_panne_label'] ?? '');

        if (($dfData['unfall_oder_panne'] ?? '') === 'unfall') {
            $dfRows .= EmailHtmlLayout::row('Schuldfrage', $dfData['unfall_schuldfrage_label'] ?? '');
        }

        return $dfRows . EmailHtmlLayout::row('Schadenbeschreibung', $dfData['schaden_beschreibung'] ?? '');
    }

    private function rowsWerkstatt(array $dfData): string
    {
        return EmailHtmlLayout::row('Umfang', $dfData['werkstattleistung_option_label'] ?? '');
    }

    private function rowsOptionen(array $dfData): string
    {
        $dfRows = EmailHtmlLayout::row('Ersatzfahrzeug / Mietfahrzeug', $dfData['ersatzfahrzeug_gewuenscht_label'] ?? '')
            . EmailHtmlLayout::row('Ich hole das Fahrzeug selbst ab', $dfData['auto_selbst_abholung_label'] ?? '');

        if (($dfData['auto_selbst_abholung'] ?? '') === 'nein') {
            $dfRows .= EmailHtmlLayout::row('Abholer Name', $dfData['abholer_name'] ?? '')
                . EmailHtmlLayout::row('Abholer Adresse', trim(($dfData['abholer_strasse'] ?? '') . ' ' . ($dfData['abholer_hausnummer'] ?? '')) . ', ' . ($dfData['abholer_plz'] ?? '') . ' ' . ($dfData['abholer_ort'] ?? ''))
                . EmailHtmlLayout::row('Abholer Telefon', $dfData['abholer_telefon'] ?? '')
                . EmailHtmlLayout::row('Abholervollmacht', $dfData['abholer_vollmacht_label'] ?? '');
        }

        $dfRows .= EmailHtmlLayout::row('Sammeltransport ADAC / andere Versicherung', $dfData['sammeltransport_geplant_label'] ?? '')
            . EmailHtmlLayout::row('Wertgegenstände im Fahrzeug', $dfData['wertgegenstaende_im_fzg_label'] ?? '');

        if (($dfData['wertgegenstaende_im_fzg'] ?? '') === 'ja') {
            $dfRows .= EmailHtmlLayout::row('Wenn ja, welche', $dfData['wertgegenstaende_beschreibung'] ?? '');
        }

        return $dfRows;
    }

    private function rowsAbschluss(array $dfData): string
    {
        return EmailHtmlLayout::row('AGB / Datenschutz', $dfData['agb_akzeptiert_label'] ?? '')
            . EmailHtmlLayout::row('Eingereicht am', $dfData['eingereicht_am_formatiert'] ?? '')
            . EmailHtmlLayout::row('Unterschrift', !empty($dfData['unterschrift_base64']) ? 'Ja (im PDF)' : 'Nein');
    }
}
