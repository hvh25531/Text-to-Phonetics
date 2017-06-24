<?php

// Handle json input
$data = json_decode(file_get_contents('php://input'), true);

include( __DIR__ . '/vendor/autoload.php' );
$transcriber = new GGG\Language\PhoneticTranscriber;
$transcriber->set('output_style', 'text');
$transcriber->set('output_dialect', $data['output_dialect']);

$transcription = $transcriber->transcribe($data['input_text']);

echo $transcription;
return;