<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $statusCode }} Error</title>
    <link rel="icon" type="image/x-icon" href="https://i.ibb.co/NCdmBnM/svgviewer-png-output-removebg-preview.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
    @import url("https://fonts.googleapis.com/css?family=Bevan");
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
    }

    body {
      background: #1c1c1c;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      color: #ffffff;
    }

    p {
      font-family: "Bevan", cursive;
      font-size: 130px;
      text-align: center;
      letter-spacing: 5px;
      background-color: #000000;
      color: transparent;
      text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.1);
      -webkit-background-clip: text;
      -moz-background-clip: text;
      background-clip: text;
      margin-bottom: 20px;
    }
    p span {
      font-size: 1.2em;
    }

    code {
      color: #bdbdbd;
      text-align: center;
      display: block;
      font-size: 16px;
      margin: 0 30px 25px;
    }
    code span {
      color: #f0c674;
    }
    code i {
      color: #b5bd68;
    }
    code em {
      color: #b294bb;
      font-style: unset;
    }
    code b {
      color: #81a2be;
      font-weight: 500;
    }

    .home-link {
      display: inline-block;
      padding: 15px 30px;
      margin-top: 20px;
      font-size: 1.5em;
      font-weight: bold;
      color: #ffffff;
      text-decoration: none;
      background: linear-gradient(45deg, #4a4a4a, #282828);
      border: none;
      border-radius: 30px;
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
      animation: pulse 2s infinite;
    }

    .home-link:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 20px rgba(0, 0, 0, 0.5);
      background: linear-gradient(45deg, #ff6b6b, #f06595);
    }

    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
    }

    @media screen and (max-width: 880px) {
      p {
        font-size: 14vw;
      }
    }
    </style>
</head>
<body>
    <p>HTTP: <span>{{ $statusCode }}</span></p>
    <code><span>if</span> (<b>{{ $message }}</b>) {<span>try_again()</span>;}</code>
    <code><span>else if (<b>we_screwed_up</b>)</span> {<em>alert</em>(<i>"We're really sorry about that."</i>); <span>window</span>.<em>location</em> = "{{ $path }}";}</code>
    <a href="{{ url('/') }}" class="home-link">HOME</a>

    <script>
        function type(n, t) {
            var str = document.getElementsByTagName("code")[n].innerHTML.toString();
            var i = 0;
            document.getElementsByTagName("code")[n].innerHTML = "";

            setTimeout(function() {
                var se = setInterval(function() {
                    i++;
                    document.getElementsByTagName("code")[n].innerHTML =
                        str.slice(0, i) + "|";
                    if (i == str.length) {
                        clearInterval(se);
                        document.getElementsByTagName("code")[n].innerHTML = str;
                    }
                }, 10);
            }, t);
        }

        type(0, 0);
        type(1, 600);
        type(2, 1300);
    </script>
</body>
</html>
