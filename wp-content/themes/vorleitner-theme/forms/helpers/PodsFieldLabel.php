<?php
defined('ABSPATH') || exit;

/**
 * Liest Feld-Labels aus der Pods-Datenbank.
 * Cacht pro Pod-Name, damit load_pod() nur einmal pro Request aufgerufen wird.
 */
class PodsFieldLabel
{
    /** @var array<string, array<string,string>> $dfCache[podName][fieldName] = label */
    private static array $dfCache = [];

    /**
     * Gibt das Label eines Pods-Feldes zurück.
     * Fällt auf $dfFallback zurück wenn Pods nicht geladen oder Feld nicht gefunden.
     */
    public static function get(string $dfPodName, string $dfFieldName, string $dfFallback = ''): string
    {
        if (!isset(self::$dfCache[$dfPodName])) {
            self::$dfCache[$dfPodName] = self::loadPodLabels($dfPodName);
        }

        return self::$dfCache[$dfPodName][$dfFieldName] ?? $dfFallback;
    }

    /**
     * Gibt Labels für mehrere Felder zurück: ['field_key' => 'Label', ...]
     * $dfFallbacks definiert gleichzeitig die gewünschte Reihenfolge und die
     * Fallback-Labels falls Pods nicht verfügbar ist.
     * Format: ['field_key' => 'Fallback-Label', ...]
     */
    public static function getMany(string $dfPodName, array $dfFallbacks): array
    {
        if (!isset(self::$dfCache[$dfPodName])) {
            self::$dfCache[$dfPodName] = self::loadPodLabels($dfPodName);
        }

        $dfResult = [];
        foreach ($dfFallbacks as $dfKey => $dfFallback) {
            $dfResult[$dfKey] = self::$dfCache[$dfPodName][$dfKey] ?? $dfFallback;
        }

        return $dfResult;
    }

    /** Lädt alle Feld-Labels eines Pods in einem einzigen API-Call. */
    private static function loadPodLabels(string $dfPodName): array
    {
        if (!function_exists('pods_api')) {
            return [];
        }

        try {
            $dfPod    = pods_api()->load_pod(['name' => $dfPodName]);
            $dfFields = $dfPod['fields'] ?? [];
            $dfLabels = [];

            foreach ($dfFields as $dfField) {
                $dfName = $dfField['name'] ?? '';
                if ($dfName !== '') {
                    $dfLabels[$dfName] = $dfField['label'] ?? $dfName;
                }
            }

            return $dfLabels;

        } catch (\Throwable $dfE) {
            return [];
        }
    }
}
