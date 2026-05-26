<?php
defined('ABSPATH') || exit;

class PdfRegenerator
{
    public function generateForPost(int $dfPostId): string
    {
        $dfJson     = get_post_meta($dfPostId, 'auftrag_form_data_json', true);
        $dfFormData = json_decode($dfJson, true);

        if (empty($dfFormData) || !is_array($dfFormData)) {
            throw new \RuntimeException('Formulardaten für diesen Auftrag nicht gefunden.');
        }

        $dfType = $this->resolveFormType($dfPostId);

        $dfPdfData = match ($dfType) {
            'abschleppen' => (new AbschleppPdfDataPreparer())->prepare($dfFormData),
            'endkunde'    => (new EndkundePdfDataPreparer())->prepare($dfFormData),
            default       => (new WerkstattPdfDataPreparer())->prepare($dfFormData),
        };

        return (new PdfGenerator())->generateFromTemplate($dfPdfData, $dfType);
    }

    private function resolveFormType(int $dfPostId): string
    {
        $dfSlugs = wp_get_post_terms($dfPostId, AuftragConstants::TAXONOMY_SLUG, ['fields' => 'slugs']);

        if (in_array(AuftragConstants::TAXONOMY_TERM_ABSCHLEPPEN, (array) $dfSlugs, true)) {
            return 'abschleppen';
        }
        if (in_array(AuftragConstants::TAXONOMY_TERM_ENDKUNDE, (array) $dfSlugs, true)) {
            return 'endkunde';
        }

        return 'werkstatt';
    }
}
