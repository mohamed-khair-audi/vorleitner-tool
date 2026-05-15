<?php
defined('ABSPATH') || exit;

class PdfGenerator
{
    private string $dfOutputDirectory;

    public function __construct()
    {
        $dfUploadInfo            = wp_upload_dir();
        $this->dfOutputDirectory = $dfUploadInfo['basedir'] . '/' . AuftragConstants::UPLOAD_SUBFOLDER . '/';
        wp_mkdir_p($this->dfOutputDirectory);
    }

    public function generateFromTemplate(array $dfPdfData, string $dfTemplateSlug): string
    {
        require_once get_template_directory() . '/vendor/autoload.php';

        $dfMpdf = new \Mpdf\Mpdf([
            'format'           => 'A4',
            'margin_top'       => 16,
            'margin_bottom'    => 20,
            'margin_left'      => 16,
            'margin_right'     => 16,
            'margin_footer'    => 7,
            'default_font'     => 'dejavusans',
            'default_font_size'=> 9.5,
            'charset_in'       => 'UTF-8',
        ]);

        $dfMpdf->SetDisplayMode('fullpage');
        $dfMpdf->WriteHTML($this->renderHtmlTemplate($dfPdfData, $dfTemplateSlug));

        $dfOutputFilePath = $this->dfOutputDirectory
            . $dfTemplateSlug . '-' . date('Ymd-His') . '-' . uniqid() . '.pdf';
        $dfMpdf->Output($dfOutputFilePath, \Mpdf\Output\Destination::FILE);

        return $dfOutputFilePath;
    }

    private function renderHtmlTemplate(array $dfPdfData, string $dfTemplateSlug): string
    {
        $dfTemplatePath = get_template_directory() . '/templates/pdf/' . $dfTemplateSlug . '-pdf.php';
        ob_start();
        extract(['dfData' => $dfPdfData]);
        include $dfTemplatePath;
        return ob_get_clean();
    }
}
