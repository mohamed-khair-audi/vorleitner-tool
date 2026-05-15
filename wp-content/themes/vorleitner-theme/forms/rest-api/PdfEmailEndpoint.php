<?php
defined('ABSPATH') || exit;

class PdfEmailEndpoint
{
    public function register(): void
    {
        register_rest_route(AuftragConstants::REST_NAMESPACE, '/pdf/email', [
            'methods'             => 'POST',
            'callback'            => [$this, 'handle'],
            'permission_callback' => [FormRestPermission::class, 'verify'],
        ]);
    }

    public function handle(WP_REST_Request $dfRequest): WP_REST_Response
    {
        $dfPostId = (int) $dfRequest->get_param('post_id');
        $dfToken  = sanitize_text_field((string) $dfRequest->get_param('token'));
        $dfEmail  = sanitize_email((string) $dfRequest->get_param('email'));

        if (!is_email($dfEmail)) {
            return new WP_REST_Response(['error' => 'invalid_email', 'message' => 'Ungültige E-Mail-Adresse.'], 422);
        }
        if (!PdfTokenStore::validate($dfPostId, $dfToken)) {
            return new WP_REST_Response(['error' => 'forbidden', 'message' => 'Ungültiger oder abgelaufener Link.'], 403);
        }

        try {
            $dfPath = (new PdfRegenerator())->generateForPost($dfPostId);
        } catch (\Exception $dfEx) {
            return new WP_REST_Response(['error' => 'generation_failed', 'message' => $dfEx->getMessage()], 500);
        }

        $dfBody = "Sehr geehrter Kunde,\n\nanbei erhalten Sie Ihre Auftragskarte als PDF-Anhang.\n\nMit freundlichen Grüßen\nIhr Vorleitner Team\nwww.vorleitner.de";
        $dfSent = wp_mail($dfEmail, 'Ihre Auftragskarte von Vorleitner', $dfBody, ['Content-Type: text/plain; charset=UTF-8'], [$dfPath]);
        @unlink($dfPath);

        if (!$dfSent) {
            return new WP_REST_Response(['error' => 'mail_failed', 'message' => 'E-Mail konnte nicht gesendet werden.'], 500);
        }

        return new WP_REST_Response(['success' => true, 'message' => 'PDF wurde an ' . $dfEmail . ' gesendet.']);
    }
}
