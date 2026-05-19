<?php
defined('ABSPATH') || exit;

class PdfDownloadEndpoint
{
    public function register(): void
    {
        // Frontend-Download via Token (zeitlich begrenzt)
        register_rest_route(AuftragConstants::REST_NAMESPACE, '/pdf/download', [
            'methods'             => 'GET',
            'callback'            => [$this, 'handle'],
            'permission_callback' => '__return_true',
        ]);

        // Admin-Download via Capability + WP-Nonce (kein Token nötig)
        register_rest_route(AuftragConstants::REST_NAMESPACE, '/pdf/admin', [
            'methods'             => 'GET',
            'callback'            => [$this, 'handleAdmin'],
            'permission_callback' => fn() => current_user_can('manage_options'),
        ]);
    }

    public function handle(WP_REST_Request $dfRequest): void
    {
        $dfPostId = (int) $dfRequest->get_param('post_id');
        $dfToken  = sanitize_text_field((string) $dfRequest->get_param('token'));
        $dfMode   = $dfRequest->get_param('mode') === 'view' ? 'inline' : 'attachment';

        if (!PdfTokenStore::validate($dfPostId, $dfToken)) {
            status_header(403);
            wp_die('Ungültiger oder abgelaufener Link.', '', ['response' => 403]);
        }

        $this->streamPdf($dfPostId, $dfMode);
    }

    public function handleAdmin(WP_REST_Request $dfRequest): void
    {
        $dfPostId = (int) $dfRequest->get_param('post_id');
        $dfMode   = $dfRequest->get_param('mode') === 'download' ? 'attachment' : 'inline';

        $this->streamPdf($dfPostId, $dfMode);
    }

    private function streamPdf(int $dfPostId, string $dfMode): void
    {
        try {
            $dfPath = (new PdfRegenerator())->generateForPost($dfPostId);
        } catch (\Exception $dfEx) {
            status_header(404);
            wp_die('PDF konnte nicht generiert werden.', '', ['response' => 404]);
        }

        nocache_headers();
        header('Content-Type: application/pdf');
        header('Content-Disposition: ' . $dfMode . '; filename="auftragskarte-' . $dfPostId . '.pdf"');
        header('Content-Length: ' . filesize($dfPath));
        readfile($dfPath);
        @unlink($dfPath);
        exit;
    }
}
