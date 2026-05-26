<?php
defined('ABSPATH') || exit;

class EndkundeRestEndpoint
{
    public function register(): void
    {
        register_rest_route(AuftragConstants::REST_NAMESPACE, '/endkunde', [
            'methods'             => 'POST',
            'callback'            => [$this, 'handleRequest'],
            'permission_callback' => [PublicFormRestPermission::class, 'verify'],
        ]);
    }

    public function handleRequest(WP_REST_Request $dfRequest): WP_REST_Response
    {
        try {
            $dfRawData       = $dfRequest->get_json_params() ?? [];
            $dfValidator     = new FormDataValidator();
            $dfMissingFields = $dfValidator->validateEndkunde($dfRawData);

            if (!$dfValidator->isValid($dfMissingFields)) {
                return new WP_REST_Response([
                    'error'   => 'validation_failed',
                    'message' => 'Bitte korrigieren Sie die markierten Felder.',
                    'errors'  => $dfMissingFields,
                ], 422);
            }

            $dfSanitizedData = (new FormDataSanitizer())->sanitizeEndkunde($dfRawData);
            $dfResult        = (new FormSubmitOrchestrator())->handleEndkundeSubmit($dfSanitizedData);

            return new WP_REST_Response($dfResult, 200);
        } catch (\Exception $dfException) {
            return new WP_REST_Response(['error' => $dfException->getMessage()], 500);
        }
    }
}
