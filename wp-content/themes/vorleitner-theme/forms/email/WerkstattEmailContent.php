<?php
defined('ABSPATH') || exit;

class WerkstattEmailContent
{
    public function build(array $dfFormData, string $dfPdfFilePath): array
    {
        $dfRecipients = [AuftragSettings::getWerkstattRecipient()];

        if (!empty($dfFormData['kunde_email'])) {
            $dfRecipients[] = $dfFormData['kunde_email'];
        }

        return [
            'recipients'  => $dfRecipients,
            'subject'     => 'Neuer Werkstatt-Auftrag – ' . ($dfFormData['kunde_nachname'] ?? '') . ' – ' . date('d.m.Y'),
            'body'        => $this->buildEmailBody($dfFormData),
            'attachments' => [$dfPdfFilePath],
        ];
    }

    private function buildEmailBody(array $dfFormData): string
    {
        $dfKundenname = esc_html(trim(($dfFormData['kunde_vorname'] ?? '') . ' ' . ($dfFormData['kunde_nachname'] ?? '')));
        $dfFahrzeug   = esc_html($dfFormData['fahrzeug_typ_modell'] ?? '');
        $dfAnnahme    = esc_html($dfFormData['annahmetermin'] ?? date('d.m.Y'));

        return '<p>Ein neuer <strong>Werkstatt-Auftrag</strong> ist eingegangen.</p>'
            . '<table style="border-collapse:collapse;width:100%">'
            . '<tr><td style="padding:4px 8px;background:#f5f5f5;font-weight:bold">Kunde</td><td style="padding:4px 8px">' . $dfKundenname . '</td></tr>'
            . '<tr><td style="padding:4px 8px;background:#f5f5f5;font-weight:bold">Fahrzeug</td><td style="padding:4px 8px">' . $dfFahrzeug . '</td></tr>'
            . '<tr><td style="padding:4px 8px;background:#f5f5f5;font-weight:bold">Annahme</td><td style="padding:4px 8px">' . $dfAnnahme . '</td></tr>'
            . '</table>'
            . '<p style="margin-top:16px">Die vollständigen Details befinden sich im beigefügten PDF.</p>';
    }
}
