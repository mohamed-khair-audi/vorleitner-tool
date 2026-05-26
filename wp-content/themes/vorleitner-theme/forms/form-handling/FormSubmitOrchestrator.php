<?php
defined('ABSPATH') || exit;

class FormSubmitOrchestrator
{
    public function handleAbschleppSubmit(array $dfSanitizedData): array
    {
        $dfPostId      = (new AuftragPostFactory())->createAbschleppPost($dfSanitizedData);
        $dfPdfData     = (new AbschleppPdfDataPreparer())->prepare($dfSanitizedData);
        $dfPdfFilePath = (new PdfGenerator())->generateFromTemplate($dfPdfData, 'abschleppen');

        update_post_meta($dfPostId, 'auftrag_form_data_json', wp_json_encode($dfSanitizedData));

        $dfToken     = PdfTokenStore::generateAndSave($dfPostId);
        $dfEmailData = (new AbschleppEmailContent())->build($dfSanitizedData, $dfPdfFilePath);
        (new EmailSender())->send($dfEmailData);

        @unlink($dfPdfFilePath);

        return ['success' => true, 'post_id' => $dfPostId, 'pdf_token' => $dfToken];
    }

    public function handleWerkstattSubmit(array $dfSanitizedData): array
    {
        $dfPostId      = (new AuftragPostFactory())->createWerkstattPost($dfSanitizedData);
        $dfPdfData     = (new WerkstattPdfDataPreparer())->prepare($dfSanitizedData);
        $dfPdfFilePath = (new PdfGenerator())->generateFromTemplate($dfPdfData, 'werkstatt');

        update_post_meta($dfPostId, 'auftrag_form_data_json', wp_json_encode($dfSanitizedData));

        $dfToken     = PdfTokenStore::generateAndSave($dfPostId);
        $dfEmailData = (new WerkstattEmailContent())->build($dfSanitizedData, $dfPdfFilePath);
        (new EmailSender())->send($dfEmailData);

        @unlink($dfPdfFilePath);

        return ['success' => true, 'post_id' => $dfPostId, 'pdf_token' => $dfToken];
    }

    public function handleEndkundeSubmit(array $dfSanitizedData): array
    {
        $dfPostId      = (new AuftragPostFactory())->createEndkundePost($dfSanitizedData);
        $dfPdfData     = (new EndkundePdfDataPreparer())->prepare($dfSanitizedData);
        $dfPdfFilePath = (new PdfGenerator())->generateFromTemplate($dfPdfData, 'endkunde');

        update_post_meta($dfPostId, 'auftrag_form_data_json', wp_json_encode($dfSanitizedData));

        (new EndkundeEmailContent())->sendAll($dfSanitizedData, $dfPdfFilePath);

        @unlink($dfPdfFilePath);

        return ['success' => true, 'post_id' => $dfPostId];
    }
}
