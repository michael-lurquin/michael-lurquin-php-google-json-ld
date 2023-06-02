<?php

use PHPUnit\Framework\TestCase;
use MichaelLurquin\PhpGoogleJsonLd\Context;

final class ContextTest extends TestCase
{
    private $context;

    /**
     * @see https://docs.phpunit.de/en/9.5/assertions.html#
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->context = new Context();
    }

    public function testInitializationClass(): void
    {
        $this->assertInstanceOf(Context::class, $this->context);

        $this->assertIsArray($this->context->getProperties());

        $this->assertArrayHasKey('@context', $this->context->getProperties());
        $this->assertArrayHasKey('@type', $this->context->getProperties());

        $this->assertEquals('https://schema.org', $this->context->getProperty('@context'));
        $this->assertEmpty($this->context->getProperty('@type'));
    }

    public function testOrganizationClass(): void
    {
        $this->context->createOrganization();

        $this->assertIsArray($this->context->getProperties());

        $this->assertArrayHasKey('url', $this->context->getProperties());
        $this->assertArrayHasKey('logo', $this->context->getProperties());

        $this->assertEquals('https://www.example.com', $this->context->getProperty('url'));
        $this->assertEquals('https://www.example.com/images/logo.png', $this->context->getProperty('logo'));
    }
}