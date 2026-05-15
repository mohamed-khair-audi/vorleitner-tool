<?php
defined('ABSPATH') || exit;

class FormDataSanitizer
{
    private array $dfTextareaFields = [
        'einsatzort', 'schaden_beschreibung', 'sonstiges_bemerkung', 'fahrzeuginhalt_gegenstaende',
        'interne_notizen', 'werkstatt_notizen', 'kundenbeanstandung', 'arbeitsgang_und_ersatzteile',
        'unterschrift_base64',
    ];

    private array $dfEmailFields   = ['kunde_email'];
    private array $dfArrayFields   = ['standgeld_hingewiesen_per', 'zusatzleistungen', 'einsatz_typ'];
    private array $dfDecimalFields = [
        'standgeld_betrag_euro', 'bergung_stunden_anzahl', 'kostenangebot_euro',
        'arbeitszeit_stunden', 'motoroel_korrigiert_liter', 'kuehlmittel_korrigiert_liter',
    ];
    private array $dfIntegerFields = ['probefahrt_minuten', 'frostschutz_temperatur_grad', 'fahrzeug_gewicht_zulaessig', 'km_stand'];

    public function sanitizeAbschleppen(array $dfRaw): array { return $this->sanitizeAll($dfRaw); }
    public function sanitizeWerkstatt(array $dfRaw): array   { return $this->sanitizeAll($dfRaw); }

    private function sanitizeAll(array $dfRaw): array
    {
        $dfResult = [];
        foreach ($dfRaw as $dfField => $dfValue) {
            // JSON clients sometimes send "field[]" as literal key – normalize to "field"
            $dfField = rtrim($dfField, '[]');
            $dfResult[$dfField] = $this->sanitizeOne($dfField, $dfValue);
        }
        return $dfResult;
    }

    private function sanitizeOne(string $dfField, mixed $dfValue): mixed
    {
        if (in_array($dfField, $this->dfArrayFields, true)) {
            return is_array($dfValue) ? array_map('sanitize_text_field', $dfValue) : [];
        }
        if (in_array($dfField, $this->dfDecimalFields, true)) {
            $dfNum = str_replace(',', '.', (string) $dfValue);
            return is_numeric($dfNum) && (float) $dfNum >= 0 ? round((float) $dfNum, 4) : null;
        }
        if (in_array($dfField, $this->dfIntegerFields, true)) {
            return is_numeric($dfValue) ? (int) $dfValue : null;
        }
        if (in_array($dfField, $this->dfEmailFields, true)) {
            return sanitize_email((string) $dfValue);
        }
        if (in_array($dfField, $this->dfTextareaFields, true)) {
            return sanitize_textarea_field((string) $dfValue);
        }
        return sanitize_text_field((string) $dfValue);
    }
}
