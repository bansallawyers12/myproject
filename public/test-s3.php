<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Storage;

header('Content-Type: application/json');

try {
    $results = [];
    
    // Check BusinessEntities directory structure
    $businessEntitiesPath = 'BusinessEntities';
    try {
        $businessEntitiesDirs = Storage::disk('s3')->directories($businessEntitiesPath);
        $results['business_entities'] = [
            'exists' => Storage::disk('s3')->exists($businessEntitiesPath),
            'directories' => $businessEntitiesDirs
        ];
        
        // Check each business entity directory
        foreach ($businessEntitiesDirs as $dir) {
            try {
                $docsPath = $dir . '/docs';
                $results['business_entities']['subdirectories'][$dir] = [
                    'exists' => Storage::disk('s3')->exists($dir),
                    'docs_exists' => Storage::disk('s3')->exists($docsPath),
                    'files' => Storage::disk('s3')->files($dir),
                    'docs_files' => Storage::disk('s3')->files($docsPath)
                ];
            } catch (\Exception $e) {
                $results['business_entities']['subdirectories'][$dir] = [
                    'error' => $e->getMessage()
                ];
            }
        }
    } catch (\Exception $e) {
        $results['business_entities'] = [
            'error' => $e->getMessage()
        ];
    }
    
    // Check GeneralInfo directory structure
    $generalInfoPath = 'GeneralInfo';
    try {
        $generalInfoDirs = Storage::disk('s3')->directories($generalInfoPath);
        $results['general_info'] = [
            'exists' => Storage::disk('s3')->exists($generalInfoPath),
            'directories' => $generalInfoDirs
        ];
        
        // Check each general info directory
        foreach ($generalInfoDirs as $dir) {
            try {
                $docsPath = $dir . '/docs';
                $results['general_info']['subdirectories'][$dir] = [
                    'exists' => Storage::disk('s3')->exists($dir),
                    'docs_exists' => Storage::disk('s3')->exists($docsPath),
                    'files' => Storage::disk('s3')->files($dir),
                    'docs_files' => Storage::disk('s3')->files($docsPath)
                ];
            } catch (\Exception $e) {
                $results['general_info']['subdirectories'][$dir] = [
                    'error' => $e->getMessage()
                ];
            }
        }
    } catch (\Exception $e) {
        $results['general_info'] = [
            'error' => $e->getMessage()
        ];
    }
    
    // Check specific document paths
    $testPaths = [
        'BusinessEntities/1_Test Business/docs',
        'GeneralInfo/Test Business/docs',
        'BusinessEntities/2_Another Business/docs'
    ];
    
    foreach ($testPaths as $path) {
        try {
            $results['paths'][$path] = [
                'exists' => Storage::disk('s3')->exists($path),
                'files' => Storage::disk('s3')->files($path)
            ];
        } catch (\Exception $e) {
            $results['paths'][$path] = [
                'error' => $e->getMessage()
            ];
        }
    }
    
    echo json_encode([
        'success' => true,
        'results' => $results,
        'config' => [
            'bucket' => config('filesystems.disks.s3.bucket'),
            'region' => config('filesystems.disks.s3.region'),
            'endpoint' => config('filesystems.disks.s3.endpoint')
        ]
    ]);
} catch (\Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ]);
} 