<?php
defined('ABSPATH') || exit;

class FormDataValidator
{
    public function validateAbschleppen(array $dfData): array
    {
        return $this->runRules($dfData, AbschleppValidationRules::get());
    }

    public function validateWerkstatt(array $dfData): array
    {
        return $this->runRules($dfData, WerkstattValidationRules::get());
    }

    public function isValid(array $dfErrors): bool
    {
        return empty($dfErrors);
    }

    private function runRules(array $dfData, array $dfRules): array
    {
        $dfErrors = [];

        foreach ($dfRules as $dfField => $dfRule) {
            $dfValue = $dfData[$dfField] ?? '';
            $dfLabel = $dfRule['label'] ?? $dfField;

            if (!empty($dfRule['required']) && ($dfValue === '' || $dfValue === null)) {
                $dfErrors[$dfField] = "{$dfLabel} ist ein Pflichtfeld";
                continue;
            }

            if ($dfValue === '' || $dfValue === null) continue;

            if (($dfRule['type'] ?? '') === 'email' && !is_email((string) $dfValue)) {
                $dfErrors[$dfField] = "{$dfLabel}: Ungültige E-Mail-Adresse";
            } elseif (($dfRule['type'] ?? '') === 'date' && !\DateTime::createFromFormat('Y-m-d', (string) $dfValue)) {
                $dfErrors[$dfField] = "{$dfLabel}: Ungültiges Datum (erwartet: YYYY-MM-DD)";
            } elseif (in_array($dfRule['type'] ?? '', ['decimal', 'integer'], true)) {
                if (!is_numeric($dfValue)) {
                    $dfErrors[$dfField] = "{$dfLabel}: Muss eine Zahl sein";
                } elseif (isset($dfRule['min']) && (float) $dfValue < (float) $dfRule['min']) {
                    $dfErrors[$dfField] = "{$dfLabel}: Mindestens {$dfRule['min']}";
                } elseif (isset($dfRule['max']) && (float) $dfValue > (float) $dfRule['max']) {
                    $dfErrors[$dfField] = "{$dfLabel}: Maximal {$dfRule['max']}";
                }
            } elseif (($dfRule['type'] ?? '') === 'array' && isset($dfRule['in']) && is_array($dfValue)) {
                $dfInvalid = array_diff($dfValue, $dfRule['in']);
                if (!empty($dfInvalid)) $dfErrors[$dfField] = "{$dfLabel}: Unzulässige Werte";
            }

            if (!isset($dfErrors[$dfField]) && isset($dfRule['pattern']) && !preg_match($dfRule['pattern'], (string) $dfValue)) {
                $dfErrors[$dfField] = "{$dfLabel}: Ungültiges Format";
            }
            if (!isset($dfErrors[$dfField]) && isset($dfRule['in']) && !is_array($dfValue) && !in_array($dfValue, $dfRule['in'], true)) {
                $dfErrors[$dfField] = "{$dfLabel}: Unzulässiger Wert";
            }
            if (!isset($dfErrors[$dfField]) && isset($dfRule['max_length']) && mb_strlen((string) $dfValue) > $dfRule['max_length']) {
                $dfErrors[$dfField] = "{$dfLabel}: Maximal {$dfRule['max_length']} Zeichen erlaubt";
            }
        }

        return $dfErrors;
    }
}
