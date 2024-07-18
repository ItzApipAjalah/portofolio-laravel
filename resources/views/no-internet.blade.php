<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Internet Connection</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            text-align: center;
        }
        .container h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .container p {
            font-size: 1.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>No Internet Connection</h1>
        <p>Please check your internet connection and try again.</p>
    </div>
    <script>
        function checkInternetConnection() {
            if (!navigator.onLine) {
                document.body.innerHTML = `
                    <div class="container">
                        <h1>No Internet Connection</h1>
                        <p>Please check your internet connection and try again.</p>
                    </div>
                `;
            }
        }

        window.addEventListener('load', checkInternetConnection);
        window.addEventListener('offline', checkInternetConnection);
    </script>
</body>
</html>
