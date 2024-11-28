<?php
require_once '../vendor/autoload.php';
require_once '../src/FacebookConversions.php';

$config = require '../config/config.php';
$facebookConversions = new FacebookConversions($config);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tenta pegar o corpo da requisição
    $input = file_get_contents('php://input');
    
    // Verifica se o conteúdo foi lido corretamente
    if ($input === false) {
        echo json_encode(['error' => 'Failed to read input']);
        exit;
    }

    // Decodifica o JSON
    $data = json_decode($input, true);

    // Verifica se houve erro na decodificação do JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'Invalid JSON']);
        exit;
    }

    // Verifica se as chaves necessárias estão presentes
    if (!isset($data['event_name']) || !isset($data['event_data'])) {
        echo json_encode(['error' => 'event_name and event_data are required']);
        exit;
    }

    // Chama a função para enviar o evento
    $response = $facebookConversions->sendEvent($data['event_name'], $data['event_data']);

    // Retorna a resposta
    echo json_encode($response);
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
