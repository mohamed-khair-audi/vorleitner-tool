<?php
defined('ABSPATH') || exit;

class RestApiRouter
{
    public function registerAllRoutes(): void
    {
        (new AbschleppRestEndpoint())->register();
        (new WerkstattRestEndpoint())->register();
        (new PdfDownloadEndpoint())->register();
        (new PdfEmailEndpoint())->register();
    }
}
