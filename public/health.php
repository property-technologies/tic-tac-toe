<?php

/**
 * Health Check Endpoint
 * 
 * Returns a simple status check response
 */

header('Content-Type: application/json');
http_response_code(200);

echo json_encode(['status' => 'ok']);
