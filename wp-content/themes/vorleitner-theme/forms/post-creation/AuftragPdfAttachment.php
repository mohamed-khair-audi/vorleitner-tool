<?php
defined('ABSPATH') || exit;

class AuftragPdfAttachment
{
    public function attachToPost(int $dfPostId, string $dfPdfFilePath): int
    {
        $this->deleteExisting($dfPostId);

        $dfUploadInfo   = wp_upload_dir();
        $dfPdfUrl       = str_replace($dfUploadInfo['basedir'], $dfUploadInfo['baseurl'], $dfPdfFilePath);

        $dfAttachmentId = wp_insert_attachment(
            [
                'post_mime_type' => 'application/pdf',
                'post_title'     => basename($dfPdfFilePath),
                'post_status'    => 'inherit',
                'guid'           => $dfPdfUrl,
            ],
            $dfPdfFilePath,
            $dfPostId
        );

        update_post_meta($dfPostId, 'auftrag_pdf_attachment_id', $dfAttachmentId);
        update_post_meta($dfPostId, 'pdf_dateipfad', $dfPdfFilePath);

        return $dfAttachmentId;
    }

    private function deleteExisting(int $dfPostId): void
    {
        $dfOldId = (int) get_post_meta($dfPostId, 'auftrag_pdf_attachment_id', true);
        if ($dfOldId) {
            wp_delete_attachment($dfOldId, true);
        }
    }
}
