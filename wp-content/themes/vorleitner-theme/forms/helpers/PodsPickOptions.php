<?php
defined('ABSPATH') || exit;

class PodsPickOptions
{
    private static array $dfCache = [];

    /**
     * Liest die pick_custom-Optionen eines Pods-Feldes aus der Datenbank.
     * Format in Pods: "value|Label\nvalue2|Label2"
     * Gibt ein assoziatives Array ['value' => 'Label'] zurück.
     * Fällt auf $dfFallback zurück wenn Pods nicht verfügbar ist.
     */
    public static function get(string $dfPodName, string $dfFieldName, array $dfFallback = []): array
    {
        $dfCacheKey = $dfPodName . '.' . $dfFieldName;

        if (isset(self::$dfCache[$dfCacheKey])) {
            return self::$dfCache[$dfCacheKey];
        }

        if (!function_exists('pods_api')) {
            return self::$dfCache[$dfCacheKey] = $dfFallback;
        }

        try {
            $dfField = pods_api()->load_field(['pod' => $dfPodName, 'name' => $dfFieldName]);
            $dfRaw   = $dfField['options']['pick_custom'] ?? $dfField['pick_custom'] ?? '';

            if (empty(trim((string) $dfRaw))) {
                return self::$dfCache[$dfCacheKey] = $dfFallback;
            }

            $dfOptions = [];
            foreach (explode("\n", (string) $dfRaw) as $dfLine) {
                $dfLine = trim($dfLine);
                if ($dfLine === '') continue;
                $dfParts = explode('|', $dfLine, 2);
                $dfOptions[trim($dfParts[0])] = trim($dfParts[1] ?? $dfParts[0]);
            }

            return self::$dfCache[$dfCacheKey] = ($dfOptions ?: $dfFallback);

        } catch (\Throwable $dfE) {
            return self::$dfCache[$dfCacheKey] = $dfFallback;
        }
    }
}
