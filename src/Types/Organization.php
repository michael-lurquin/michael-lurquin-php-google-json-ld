<?php

namespace MichaelLurquin\PhpGoogleJsonLd\Types;

/**
 * @see https://developers.google.com/search/docs/appearance/structured-data/logo#structured-data-type-definitions
 */
class Organization
{
    public string $url;
    public string $logo;

    public function url(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function logo(string $logo)
    {
        $this->logo = $logo;

        return $this;
    }
}