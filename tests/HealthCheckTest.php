<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * Health Check Endpoint Test
 */
class HealthCheckTest extends TestCase
{
    /**
     * Helper method to get health endpoint response
     *
     * @return string
     */
    private function getHealthEndpointOutput(): string
    {
        $phpBinary = escapeshellarg(PHP_BINARY);
        $scriptPath = escapeshellarg(__DIR__ . '/../public/health.php');
        $command = $phpBinary . ' ' . $scriptPath;

        $output = shell_exec($command);

        return $output !== null ? $output : '';
    }

    /**
     * Test health endpoint returns correct response
     *
     * @runInSeparateProcess
     */
    public function testHealthEndpointReturnsOk(): void
    {
        $output = $this->getHealthEndpointOutput();
        $response = json_decode($output, true);
        
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
        $output = $this->getHealthEndpointOutput();
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
        $output = $this->getHealthEndpointOutput();
        $response = json_decode($output, true);
        
        $this->assertEquals(['status' => 'ok'], $response);
    }
}
