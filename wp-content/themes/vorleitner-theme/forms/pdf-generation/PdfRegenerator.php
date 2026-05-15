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

        $dfPdfData = $dfType === 'abschleppen'
            ? (new AbschleppPdfDataPreparer())->prepare($dfFormData)
            : (new WerkstattPdfDataPreparer())->prepare($dfFormData);

        return (new PdfGenerator())->generateFromTemplate($dfPdfData, $dfType);
    }

    private function resolveFormType(int $dfPostId): string
    {
        $dfSlugs = wp_get_post_terms($dfPostId, AuftragConstants::TAXONOMY_SLUG, ['fields' => 'slugs']);
        return in_array(AuftragConstants::TAXONOMY_TERM_ABSCHLEPPEN, (array) $dfSlugs, true)
            ? 'abschleppen'
            : 'werkstatt';
    }
}
