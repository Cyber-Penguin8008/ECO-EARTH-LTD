<?php
/**
 * EcoEarth Ltd - enquiry form handler
 *
 * The contact form posts here. Change the two settings below and nothing else.
 */

// ---------------------------------------------------------------- settings
$TO      = 'ecoearth36@gmail.com';   // where enquiries are delivered
$FROM    = 'website@ecoearth.co.uk'; // must be an address on your own domain
$SUCCESS = 'thank-you.html';
$FAILURE = 'contact.html?sent=error';

// ------------------------------------------------------------------ guards
// Only accept a real form submission.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

// Honeypot: a field hidden from people. If it has anything in it, a bot filled it.
if (!empty($_POST['website'])) {
    header('Location: ' . $SUCCESS);  // pretend it worked, tell the bot nothing
    exit;
}

// Speed check: the form cannot be read and filled in under three seconds.
if (!empty($_POST['ts']) && ctype_digit($_POST['ts'])) {
    if ((time() * 1000 - (int) $_POST['ts']) < 3000) {
        header('Location: ' . $SUCCESS);
        exit;
    }
}

// ------------------------------------------------------------------ inputs
function field($key, $max = 500) {
    $v = isset($_POST[$key]) ? trim($_POST[$key]) : '';
    return mb_substr($v, 0, $max);
}

$name    = field('name', 120);
$email   = field('email', 180);
$phone   = field('phone', 60);
$country = field('country', 120);
$type    = field('type', 120);
$sector  = field('sector', 120);
$message = field('msg', 4000);

// Required fields.
if ($name === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ' . $FAILURE);
    exit;
}

// Header injection: a newline in a header field lets a spammer add their own
// recipients. Strip anything that could start a new header line.
function single_line($v) {
    return trim(str_replace(["\r", "\n", "%0a", "%0d"], ' ', $v));
}
$email = single_line($email);
$name  = single_line($name);

// ------------------------------------------------------------------ message
$lines = [
    'New enquiry from the EcoEarth website',
    str_repeat('-', 42),
    'Name:     ' . $name,
    'Email:    ' . $email,
    'Phone:    ' . ($phone   !== '' ? $phone   : '(not given)'),
    'Country:  ' . ($country !== '' ? $country : '(not given)'),
    'They are: ' . $type,
    'Sector:   ' . $sector,
    '',
    'Message:',
    ($message !== '' ? $message : '(no message)'),
    '',
    str_repeat('-', 42),
    'Sent: ' . date('d M Y, H:i') . ' UK time',
    'IP:   ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'),
];
$body = implode("\n", $lines);

$subject = 'Website enquiry - ' . $name;

$headers   = [];
$headers[] = 'From: EcoEarth Website <' . $FROM . '>';
$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';  // hit reply, it goes to them
$headers[] = 'Content-Type: text/plain; charset=UTF-8';
$headers[] = 'X-Mailer: PHP/' . phpversion();

$sent = @mail($TO, $subject, $body, implode("\r\n", $headers));

header('Location: ' . ($sent ? $SUCCESS : $FAILURE));
exit;
