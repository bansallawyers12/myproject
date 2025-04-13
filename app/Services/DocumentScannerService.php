<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;
use Smalot\PdfParser\Parser as PdfParser;

class DocumentScannerService
{
    protected $pdfParser;

    public function __construct()
    {
        $this->pdfParser = new PdfParser();
    }

    public function extractInformation($filePath, $fileType)
    {
        if (str_starts_with($fileType, 'image/')) {
            return $this->extractFromImage($filePath);
        } elseif ($fileType === 'application/pdf') {
            return $this->extractFromPdf($filePath);
        }

        throw new \Exception('Unsupported file type: ' . $fileType);
    }

    protected function extractFromImage($imagePath)
    {
        $imageData = base64_encode(file_get_contents($imagePath));

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Analyze this receipt or invoice image and extract: company name, amount (before GST), whether GST is included (yes/no), GST amount (if any), ABN, address, and whether it is an invoice or receipt. Return the result in JSON format with keys: "document_type", "company", "amount", "gst_yes_no", "gst_amount", "abn", "address", "transaction_date".',
                        ],
                        [
                            'type' => 'image_url',
                            'image_url' => [
                                'url' => "data:image/jpeg;base64,{$imageData}",
                            ],
                        ],
                    ],
                ],
            ],
            'response_format' => ['type' => 'json_object'],
        ]);

        $extractedData = json_decode($response->choices[0]->message->content, true);

        return [
            'document_type' => $extractedData['document_type'] ?? 'receipt',
            'company' => $extractedData['company'] ?? 'Unknown',
            'amount' => floatval(str_replace(['$', ','], '', $extractedData['amount'] ?? 0)),
            'gst_yes_no' => filter_var($extractedData['gst_yes_no'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'gst_amount' => floatval(str_replace(['$', ','], '', $extractedData['gst_amount'] ?? 0)),
            'abn' => $extractedData['abn'] ?? null,
            'address' => $extractedData['address'] ?? null,
            'transaction_date' => $extractedData['transaction_date'] ?? now()->toDateString(),
            'raw_data' => $extractedData,
        ];
    }

    protected function extractFromPdf($pdfPath)
    {
        $pdf = $this->pdfParser->parseFile($pdfPath);
        $text = $pdf->getText();

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4o',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "Analyze the following receipt or invoice text and extract: company name, amount (before GST), whether GST is included (yes/no), GST amount (if any), ABN, address, and whether it is an invoice or receipt, and transaction date. Return the result in JSON format with keys: \"document_type\", \"company\", \"amount\", \"gst_yes_no\", \"gst_amount\", \"abn\", \"address\", \"transaction_date\".\n\nText:\n$text",
                ],
            ],
            'response_format' => ['type' => 'json_object'],
        ]);

        $extractedData = json_decode($response->choices[0]->message->content, true);

        return [
            'document_type' => $extractedData['document_type'] ?? 'receipt',
            'company' => $extractedData['company'] ?? 'Unknown',
            'amount' => floatval(str_replace(['$', ','], '', $extractedData['amount'] ?? 0)),
            'gst_yes_no' => filter_var($extractedData['gst_yes_no'] ?? false, FILTER_VALIDATE_BOOLEAN),
            'gst_amount' => floatval(str_replace(['$', ','], '', $extractedData['gst_amount'] ?? 0)),
            'abn' => $extractedData['abn'] ?? null,
            'address' => $extractedData['address'] ?? null,
            'transaction_date' => $extractedData['transaction_date'] ?? now()->toDateString(),
            'raw_data' => $extractedData,
        ];
    }
}