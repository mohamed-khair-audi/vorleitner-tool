<?php
defined('ABSPATH') || exit;

class AbschleppPdfDataPreparer
{
    public function prepare(array $dfFormData): array
    {
        return array_merge($dfFormData, [
            'datum_formatiert'          => $this->formatDate($dfFormData['datum'] ?? ''),
            'abholtermin_formatiert'    => $this->formatDate($dfFormData['abholtermin'] ?? ''),
            'einsatz_beginn_formatiert' => $this->formatDatetime($dfFormData['einsatz_beginn'] ?? ''),
            'einsatz_ende_formatiert'   => $this->formatDatetime($dfFormData['einsatz_ende'] ?? ''),
            'einsatz_typ_text'          => $this->joinLabels($dfFormData['einsatz_typ'] ?? [], AbschleppFieldLabels::einsatzTyp()),
            'hingewiesen_per_text'      => $this->joinLabels($dfFormData['standgeld_hingewiesen_per'] ?? [], AbschleppFieldLabels::hinweisPerKanal()),
            'zusatzleistungen_text'     => $this->joinLabels($dfFormData['zusatzleistungen'] ?? [], AbschleppFieldLabels::zusatzleistungen()),
            'auftragsart_label'         => AbschleppFieldLabels::auftragsart()[$dfFormData['auftragsart'] ?? ''] ?? ($dfFormData['auftragsart'] ?? ''),
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

    private function joinLabels(array $dfValues, array $dfLabelMap): string
    {
        return implode(', ', array_filter(array_map(fn ($dfVal) => $dfLabelMap[$dfVal] ?? '', $dfValues)));
    }
}
