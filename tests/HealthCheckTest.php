<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Health Check Endpoint Test
 */
class HealthCheckTest extends TestCase
{
    /**
     * Test health endpoint returns correct response
     *
     * @runInSeparateProcess
     */
    public function testHealthEndpointReturnsOk(): void
    {
        // Start output buffering to capture the response
        ob_start();
        
        // Include the health check endpoint
        require __DIR__ . '/../public/health.php';
        
        // Get the output
        $output = ob_get_clean();
        
        // Decode JSON response
        $response = json_decode($output, true);
        
        // Assert the response
        $this->assertIsArray($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('ok', $response['status']);
    }
    
    /**
     * Test health endpoint returns valid JSON
     *
     * @runInSeparateProcess
     */
    public function testHealthEndpointReturnsValidJson(): void
    {
        // Start output buffering
        ob_start();
        
        // Include the health check endpoint
        require __DIR__ . '/../public/health.php';
        
        // Get the output
        $output = ob_get_clean();
        
        // Verify it's valid JSON
        $response = json_decode($output, true);
        $this->assertNotNull($response);
        $this->assertEquals(JSON_ERROR_NONE, json_last_error());
    }
    
    /**
     * Test health endpoint structure
     *
     * @runInSeparateProcess
     */
    public function testHealthEndpointStructure(): void
    {
        // Start output buffering
        ob_start();
        
        // Include the health check endpoint
        require __DIR__ . '/../public/health.php';
        
        // Get the output
        $output = ob_get_clean();
        
        // Decode and verify structure
        $response = json_decode($output, true);
        
        // Check exact structure
        $this->assertEquals(['status' => 'ok'], $response);
    }
}
