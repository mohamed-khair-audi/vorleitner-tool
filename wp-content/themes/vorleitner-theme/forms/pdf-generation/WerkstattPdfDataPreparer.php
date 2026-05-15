<?php
defined('ABSPATH') || exit;

class WerkstattPdfDataPreparer
{
    public function prepare(array $dfFormData): array
    {
        return array_merge($dfFormData, [
            'annahmetermin_formatiert'       => $this->formatDatetime($dfFormData['annahmetermin'] ?? ''),
            'abholtermin_werkstatt_formatiert' => $this->formatDatetime($dfFormData['abholtermin_werkstatt'] ?? ''),
            'naechste_hu_formatiert'         => $this->formatDate($dfFormData['naechste_hauptuntersuchung'] ?? ''),
            'ersatzfahrzeug_label'           => $this->mapErsatzfahrzeugTyp($dfFormData['ersatzfahrzeug_typ'] ?? ''),
            'endkontrolle_label'             => $this->mapEndkontrolle($dfFormData['endkontrolle_fahrzeug_abholbereit'] ?? ''),
        ]);
    }

    private function formatDate(string $dfRawDate): string
    {
        $dfDate = \DateTime::createFromFormat('Y-m-d', $dfRawDate);
        return $dfDate ? $dfDate->format('d.m.Y') : $dfRawDate;
    }

    private function formatDatetime(string $dfRawDatetime): string
    {
        $dfDatetime = \DateTime::createFromFormat('Y-m-d\TH:i', $dfRawDatetime);
        return $dfDatetime ? $dfDatetime->format('d.m.Y H:i') . ' Uhr' : $dfRawDatetime;
    }

    private function mapErsatzfahrzeugTyp(string $dfValue): string
    {
        return WerkstattFieldLabels::ersatzfahrzeugTyp()[$dfValue] ?? $dfValue;
    }

    private function mapEndkontrolle(string $dfValue): string
    {
        return $dfValue === '1' ? '✓ Fahrzeug abholbereit' : '✗ Nicht abholbereit – darf nicht bewegt werden';
    }
}
