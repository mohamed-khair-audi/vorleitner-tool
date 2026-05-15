<?php
defined('ABSPATH') || exit;

class AbschleppEmailContent
{
    public function build(array $dfFormData, string $dfPdfFilePath): array
    {
        $dfRecipients = [AuftragSettings::getAbschleppRecipient()];

        return [
            'recipients'  => $dfRecipients,
            'subject'     => 'Neuer Abschlepp-Auftrag – ' . ($dfFormData['kennzeichen'] ?? '') . ' – ' . date('d.m.Y'),
            'body'        => $this->buildEmailBody($dfFormData),
            'attachments' => [$dfPdfFilePath],
        ];
    }

    private function buildEmailBody(array $dfFormData): string
    {
        $dfKundenname = esc_html(trim(($dfFormData['kunde_vorname'] ?? '') . ' ' . ($dfFormData['kunde_nachname'] ?? '')));
        $dfKennzeichen = esc_html($dfFormData['kennzeichen'] ?? '');
        $dfDatum = esc_html($dfFormData['datum'] ?? date('d.m.Y'));

        return '<p>Ein neuer <strong>Abschlepp-Auftrag</strong> ist eingegangen.</p>'
            . '<table style="border-collapse:collapse;width:100%">'
            . '<tr><td style="padding:4px 8px;background:#f5f5f5;font-weight:bold">Kennzeichen</td><td style="padding:4px 8px">' . $dfKennzeichen . '</td></tr>'
            . '<tr><td style="padding:4px 8px;background:#f5f5f5;font-weight:bold">Kunde</td><td style="padding:4px 8px">' . $dfKundenname . '</td></tr>'
            . '<tr><td style="padding:4px 8px;background:#f5f5f5;font-weight:bold">Datum</td><td style="padding:4px 8px">' . $dfDatum . '</td></tr>'
            . '</table>'
            . '<p style="margin-top:16px">Die vollständigen Details befinden sich im beigefügten PDF.</p>';
    }
}
