<?php
namespace Tests\Functional;

class BasiqueTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetArticleHomePage()
    {
        $response = $this->runApp('GET', '/article');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Liste des articles', (string)$response->getBody());
        $this->assertNotContains('Hello', (string)$response->getBody());
    }
}