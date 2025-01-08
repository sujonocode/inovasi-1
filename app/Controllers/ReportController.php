<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpWord\TemplateProcessor;

class ReportController extends Controller
{
    public function generateReport()
    {
        // Path to the Word template file
        $templatePath = WRITEPATH . 'templates/report_template.docx';

        // Load the Word template
        $templateProcessor = new TemplateProcessor($templatePath);

        // Data to be inserted into the template
        $data = [
            'name'  => 'John Doe',
            'nomor' => 'B-1768/18020/KP.320/2024',
        ];

        // Replace placeholders with actual data
        foreach ($data as $key => $value) {
            $templateProcessor->setValue("{{{$key}}}", $value);
        }

        // Save the processed file to a new location
        $outputPath = WRITEPATH . 'reports/generated_report.docx';
        $templateProcessor->saveAs($outputPath);

        // Force download the file
        return $this->response->download($outputPath, null)->setFileName('report.docx');
    }
}
