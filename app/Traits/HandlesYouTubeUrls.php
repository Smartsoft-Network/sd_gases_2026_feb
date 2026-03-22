<?php

namespace App\Traits;

trait HandlesYouTubeUrls
{
    /**
     * Convert various YouTube URL formats to an embeddable URL.
     *
     * @param string|null $url
     * @return string|null
     */
    protected function convertToYoutubeEmbedUrl(?string $url): ?string
    {
        if (empty($url)) {
            return $url;
        }

        // If it's already an embed URL, just return it
        if (str_contains($url, 'youtube.com/embed/')) {
            return $url;
        }

        $youtubeId = $this->extractYoutubeId($url);

        if ($youtubeId) {
            return "https://www.youtube.com/embed/{$youtubeId}";
        }

        return $url;
    }

    /**
     * Extract YouTube video ID from various URL formats.
     *
     * @param string $url
     * @return string|null
     */
    protected function extractYoutubeId(string $url): ?string
    {
        $patterns = [
            '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
            '/([a-zA-Z0-9_-]{11})/' // Fallback if just the ID is provided
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        return null;
    }
}
