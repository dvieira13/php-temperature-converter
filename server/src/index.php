<?php
// index.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/convert.php';

// Get URI path (e.g. /api/convert)
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Handle GET /api/convert
if ($method === 'GET' && preg_match('#/api/convert$#', $requestUri)) {
    $value = $_GET['value'] ?? null;
    $from  = $_GET['from'] ?? null;
    $to    = $_GET['to'] ?? null;

    if ($value === null || $from === null || $to === null || !is_numeric($value)) {
        http_response_code(400);
        echo json_encode(["error" => "Missing or invalid parameters"]);
        exit;
    }

    $value = floatval($value);
    $from = strtoupper($from);
    $to = strtoupper($to);
    $validUnits = ['C', 'F', 'K'];

    if (!in_array($from, $validUnits) || !in_array($to, $validUnits)) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid unit type"]);
        exit;
    }

    $result = convertTemperature($value, $from, $to);

    echo json_encode([
        "from" => $from,
        "to" => $to,
        "input" => $value,
        "output" => $result
    ]);
    exit;
}

// Fallback 404
http_response_code(404);
echo json_encode(["error" => "Not found"]);
