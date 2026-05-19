<?php
defined('ABSPATH') || exit;

class AbschleppPdfDataPreparer
{
    public function prepare(array $dfFormData): array
    {
        return array_merge($dfFormData, [
            'datum_formatiert'                    => $this->formatDate($dfFormData['datum'] ?? ''),
            'abholtermin_formatiert'              => $this->formatDate($dfFormData['abholtermin'] ?? ''),
            'standgeld_hingewiesen_am_formatiert' => $this->formatDate($dfFormData['standgeld_hingewiesen_am'] ?? ''),
            'fahrzeug_abgeholt_am_formatiert'     => $this->formatDate($dfFormData['fahrzeug_abgeholt_am'] ?? ''),
            'kennzeichen_abgeholt_am_formatiert'  => $this->formatDate($dfFormData['kennzeichen_abgeholt_am'] ?? ''),
            'fahrzeuginhalt_entnommen_am_formatiert' => $this->formatDate($dfFormData['fahrzeuginhalt_entnommen_am'] ?? ''),
            'sichergestellt_am_formatiert'        => $this->formatDate($dfFormData['sichergestellt_am'] ?? ''),
            'freigabe_am_formatiert'              => $this->formatDate($dfFormData['freigabe_am'] ?? ''),
            'besichtigt_am_formatiert'            => $this->formatDate($dfFormData['besichtigt_am'] ?? ''),
            'einsatz_beginn_formatiert'           => $this->formatDatetime($dfFormData['einsatz_beginn'] ?? ''),
            'einsatz_ende_formatiert'             => $this->formatDatetime($dfFormData['einsatz_ende'] ?? ''),
            'auftragsart_label'                   => AbschleppFieldLabels::auftragsart()[$dfFormData['auftragsart'] ?? ''] ?? ($dfFormData['auftragsart'] ?? ''),
        ]);
    }

    private function formatDate(string $dfRaw): string
    {
        $dfDate = \DateTime::createFromFormat('Y-m-d', $dfRaw);
        return $dfDate ? $dfDate->format('d.m.Y') : $dfRaw;
    }

    private function formatDatetime(string $dfRaw): string
    {
        $dfDatetime = \DateTime::createFromFormat('Y-m-d\TH:i', $dfRaw);
        return $dfDatetime ? $dfDatetime->format('d.m.Y H:i') . ' Uhr' : $dfRaw;
    }
}
