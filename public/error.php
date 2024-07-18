<?php
$code = $_SERVER['REDIRECT_STATUS'];
$codes = array(
    400 => 'Bad Request',
    401 => 'Authorization Required',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request URI Too Large',
    415 => 'Unsupported Media Type',
    416 => 'Request Range Not Satisfiable',
    417 => 'Expectation Failed',
    422 => 'Unprocessable Entity',
    423 => 'Locked',
    424 => 'Failed Dependency',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported',
    506 => 'Variant Also Negotiates',
    507 => 'Insufficient Storage',
    510 => 'Not Extended',
    666 => '( ͡❛ ͜ʖ ͡❛)'
);
$descriptions = array(
    400 => 'The server could not understand the request due to invalid syntax.',
    401 => 'The client must authenticate itself to get the requested response.',
    402 => 'This request requires payment to proceed.',
    403 => 'You do not have permission to access this resource.',
    404 => 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.',
    405 => 'The request method is not supported for the requested resource.',
    406 => 'The requested resource is not capable of generating content acceptable according to the Accept headers sent in the request.',
    407 => 'You must authenticate with a proxy server before this request can be fulfilled.',
    408 => 'The server timed out waiting for the request.',
    409 => 'The request could not be completed due to a conflict with the current state of the target resource.',
    410 => 'The requested resource is no longer available at the server and no forwarding address is known.',
    411 => 'The server refuses to accept the request without a defined Content-Length.',
    412 => 'The server does not meet one of the preconditions that the requester put on the request.',
    413 => 'The request entity is larger than the server is willing or able to process.',
    414 => 'The URI requested by the client is longer than the server is willing to interpret.',
    415 => 'The media format of the requested data is not supported by the server.',
    416 => 'The range specified by the Range header field in the request cannot be fulfilled.',
    417 => 'The server cannot meet the requirements of the Expect request-header field.',
    422 => 'The request was well-formed but was unable to be followed due to semantic errors.',
    423 => 'The resource that is being accessed is locked.',
    424 => 'The request failed due to failure of a previous request.',
    500 => 'The server has encountered a situation it does not know how to handle.',
    501 => 'The request method is not supported by the server and cannot be handled.',
    502 => 'The server, while acting as a gateway or proxy, received an invalid response from the upstream server.',
    503 => 'The server is not ready to handle the request.',
    504 => 'The server, while acting as a gateway or proxy, did not get a response in time from the upstream server.',
    505 => 'The HTTP version used in the request is not supported by the server.',
    506 => 'The server has an internal configuration error.',
    507 => 'The server is unable to store the representation needed to complete the request.',
    510 => 'Further extensions to the request are required for the server to fulfill it.',
    666 => 'What are you doing here?'
);

$source_url = 'http'.((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if (basename($_SERVER['REQUEST_URI']) === 'error.php') {
    $code = 666;
}
if (array_key_exists($code, $codes) && is_numeric($code)) {
    $message = "Error $code: {$codes[$code]}";
    $description = $descriptions[$code];
} else {
    $message = 'Unknown error';
    $description = 'An unknown error has occurred.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?php echo $code; ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');
        body {
            background-color: #f0f2f5;
            color: #333;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-container {
            text-align: center;
            max-width: 500px;
            padding: 30px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin: 15px;
        }
        .error-code {
            font-size: 80px;
            font-weight: 700;
            color: #ff6b6b;
        }
        .error-message {
            font-size: 28px;
            margin-bottom: 20px;
        }
        .error-description {
            font-size: 18px;
            color: #6c757d;
            margin-bottom: 20px;
        }
        .home-link {
            display: inline-block;
            padding: 12px 25px;
            font-size: 18px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .home-link:hover {
            background-color: #0056b3;
        }
        @media (max-width: 600px) {
            .error-code {
                font-size: 60px;
            }
            .error-message {
                font-size: 24px;
            }
            .error-description {
                font-size: 16px;
            }
            .home-link {
                font-size: 16px;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code"><?php echo $code; ?></div>
        <div class="error-message"><?php echo $message; ?></div>
        <div class="error-description"><?php echo $description; ?></div>
        <a href="/" class="home-link">Go to Homepage</a>
    </div>
</body>
</html>
