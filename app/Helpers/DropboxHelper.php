<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\Dropbox\Exceptions\BadRequest;

class DropboxHelper
{
    public static function getDirectLink(string $dropboxPath) : ?string
    {
        if (empty($dropboxPath)) {
            return null;
        }

        try {
            // Ensure path starts with '/' for consistency with Dropbox API
            $path = '/' . ltrim($dropboxPath, '/');

            // Consider injecting the client via constructor if used frequently
            $client = new DropboxClient(config('filesystems.disks.dropbox.authorization_token'));

            // Try to get existing shared links first
            $sharedLinks = $client->listSharedLinks($path, false); // Set direct_only to false if needed

            if (!empty($sharedLinks['links'])) {
                $url = $sharedLinks['links'][0]['url'];
            } else {
                // Create new public shared link if none exist
                $response = $client->createSharedLinkWithSettings($path, ['requested_visibility' => 'public']);
                $url = $response['url'];
            }

            // Convert to direct download link
            $directUrl = str_replace('www.dropbox.com', 'dl.dropboxusercontent.com', $url);
            $directUrl = str_replace('?dl=0', '?raw=1', $directUrl); // or ?dl=1

            return $directUrl;

        } catch (BadRequest $e) {
            // Handle specific errors like shared_link_already_exists if needed (like in AssetDocumentController)
            Log::error("Dropbox BadRequest generating link for {$path}: " . $e->getMessage());
             if (strpos($e->getMessage(), 'shared_link_already_exists') !== false) {
                // Attempt recovery if possible (retry listSharedLinks)
             }
            return null; // Return null on error
        } catch (\Exception $e) {
            // Catch path/not_found or other general errors
             if (strpos($e->getMessage(), 'path/not_found') !== false) {
                Log::warning("Dropbox file not found for link generation: {$path}");
             } else {
                Log::error("Error generating Dropbox link for {$path}: " . $e->getMessage());
             }
            return null; // Return null on error
        }
    }
}