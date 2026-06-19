<?php
defined('ABSPATH') || exit;

/**
 * Vollständiger Infotext / Rechtstext für das öffentliche Endkunden-Formular.
 */
class EndkundeLegalText
{
    public static function paragraphs(): array
    {
        return [
            'Sehr geehrter Kunde, mit Ihrer Unterschrift erteilen Sie uns den Auftrag, im Rahmen unseres Abschlepp- und Kfz-Werkstattservices Ihr Fahrzeug zu bergen, abzuschleppen und/oder zu verwahren sowie – sofern gewünscht – eine Fehlersuche bzw. Schadensfeststellung (Diagnose) durchzuführen, einen Befund zu erstellen und nach Ihrer Freigabe erforderliche Ersatzteile zu bestellen, einzubauen und eine Reparatur durchzuführen.',
            'Die Abrechnung aller Leistungen erfolgt nach dem tatsächlich angefallenen Arbeitsaufwand gemäß unseren jeweils gültigen Verrechnungssätzen.',
            'Diagnosekosten: Die Fehlersuche und Schadensfeststellung ist kostenpflichtig. Die Kosten hierfür belaufen sich – je nach Aufwand – in der Regel auf 50,00 € bis 250,00 € brutto. Bei Erteilung eines vollständigen Reparaturauftrags werden diese Kosten angerechnet.',
            'Standgebühren: Für das Abstellen von Fahrzeugen auf unserem Betriebsgelände fallen grundsätzlich Standgebühren gemäß unserer jeweils gültigen Hauspreisliste an und können insbesondere von Fahrzeugart, Fahrzeuggröße sowie dem benötigten Stellplatz abhängig sein. Die Standgebühren werden pro Kalendertag berechnet.',
            'Während der Bearbeitung eines erteilten Werkstattauftrags plus 5 Werktage Abholzeit werden keine Standgebühren berechnet. Außerhalb dieser Zeit ist das Abstellen / Parken kostenpflichtig. Als abgeschlossen gilt der Werkstattauftrag mit Fertigstellung der Reparatur oder Mitteilung über die Fertigstellung der Diagnose bzw. Nichtdurchführung der Reparatur.',
            'Die Geltendmachung eines weitergehenden Schadens bleibt vorbehalten.',
            'Eine Abholung des Fahrzeugs ist ausschließlich zu unseren Geschäftszeiten möglich. Die Herausgabe erfolgt nur an den Eigentümer oder an eine schriftlich bevollmächtigte Person und erst nach vollständiger Begleichung sämtlicher angefallener Kosten.',
            'Fahrzeuge können durch uns nur dann entsorgt oder angekauft werden, wenn alle offenen Forderungen beglichen sind und uns die Zulassungsbescheinigung Teil II (Fahrzeugbrief) im Original vorliegt. Bis zur Vorlage des Fahrzeugbriefs fallen weiterhin Standgebühren an.',
            'Der Unterzeichnende beauftragt uns zudem mit der Durchführung von Abschlepp- und Bergungsarbeiten, gegebenenfalls erforderlichen Reinigungsarbeiten sowie dem Abstellen (Verwahren) des Fahrzeugs. Er bestätigt ausdrücklich, zur Erteilung dieses Auftrags berechtigt zu sein.',
            'Es gelten unsere Allgemeinen Geschäftsbedingungen (AGB) in der jeweils aktuellen Fassung. Mit Ihrer Unterschrift bestätigen Sie, dass Sie diese sowie unsere Datenschutzbestimmungen zur Kenntnis genommen haben und anerkennen.',
            'Detaillierte Informationen finden Sie unter: www.vorleitner.de/impressum und www.vorleitner.de/datenschutz',
        ];
    }

    public static function html(): string
    {
        $dfParagraphs = self::paragraphs();
        $dfHtml       = '';

        foreach ($dfParagraphs as $dfIndex => $dfParagraph) {
            if ($dfIndex === count($dfParagraphs) - 1) {
                $dfHtml .= '<p>Detaillierte Informationen finden Sie unter: '
                    . '<a href="https://www.vorleitner.de/impressum" target="_blank" rel="noopener noreferrer">www.vorleitner.de/impressum</a> '
                    . 'und '
                    . '<a href="https://www.vorleitner.de/datenschutz" target="_blank" rel="noopener noreferrer">www.vorleitner.de/datenschutz</a>'
                    . '</p>';
                continue;
            }
            $dfHtml .= '<p>' . esc_html($dfParagraph) . '</p>';
        }

        return $dfHtml;
    }

    public static function plainForPdf(): string
    {
        return implode("\n\n", self::paragraphs());
    }
}
