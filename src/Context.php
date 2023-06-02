<?php

namespace MichaelLurquin\PhpGoogleJsonLd;

use MichaelLurquin\PhpGoogleJsonLd\Types\Organization;

/**
 * @see https://dev.to/joemoses33/create-a-composer-package-how-to-29kn
 * 
 * @see https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data?hl=fr#search-appearance
 * @see https://developers.google.com/search/docs/appearance/structured-data/search-gallery
 */
final class Context
{
    public string $context = 'https://schema.org';
    public string $type;
    private array $properties = [];

    public function createOrganization(): self
    {
        $this->type = 'Organization';

        $organization = (new Organization())
            ->url('https://www.example.com')
            ->logo('https://www.example.com/images/logo.png')
        ;
        
        $this->properties = get_object_vars($organization);

        return $this;
    }

    public function getProperties(): array
    {
        return array_merge([
            '@context' => $this->context,
            '@type' => $this->type ?? null,
        ], $this->properties);
    }

    public function getProperty(string $name): string|null
    {
        return $this->getProperties()[$name] ?? null;
    }

    public function generate(): string
    {
        $properties = $this->getProperties();

        return "<script type=\"application/ld+json\">" . json_encode($properties, JSON_HEX_APOS | JSON_UNESCAPED_UNICODE) . "</script>";
    }
}