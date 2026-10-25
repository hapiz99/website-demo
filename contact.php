<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

function respond(int $status, array $payload): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_SLASHES);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    respond(405, ['success' => false, 'message' => 'Use the contact form to send a message.']);
}

function postString(string $key): string
{
    $value = $_POST[$key] ?? '';
    return is_string($value) ? trim($value) : '';
}

$name = postString('name');
$email = postString('email');
$message = postString('message');

if ($name === '' || strlen($name) > 100) {
    respond(422, ['success' => false, 'message' => 'Enter your name (up to 100 characters).']);
}

if (strlen($email) > 254 || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    respond(422, ['success' => false, 'message' => 'Enter a valid email address.']);
}

if ($message === '' || strlen($message) > 5000) {
    respond(422, ['success' => false, 'message' => 'Enter a message (up to 5,000 characters).']);
}

$body = "Name: {$name}\nEmail: {$email}\n\n{$message}";
$headers = [
    'From: Iron Pulse Website <hello@ironpulse.fit>',
    'Reply-To: ' . $email,
    'Content-Type: text/plain; charset=UTF-8',
];

if (!mail('hello@ironpulse.fit', 'Website enquiry - Iron Pulse', $body, implode("\r\n", $headers))) {
    error_log('Iron Pulse contact form: PHP mail() failed to send a message.');
    respond(500, ['success' => false, 'message' => 'We could not send your message right now. Please try again later.']);
}

respond(200, ['success' => true, 'message' => 'Thanks! Your message has been sent.']);
