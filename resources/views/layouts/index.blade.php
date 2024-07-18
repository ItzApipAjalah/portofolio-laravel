<!DOCTYPE html>
<html lang="en" translate="no">
    <head>
        <title>Portofolio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../src/css/index.css">
        <link rel="icon" type="image/x-icon" href="../src/image/favicon.ico">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <!-- PDF.js CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf_viewer.css">


    </head>
    <body style="--scroll: 0;">
        <div id="bg"></div>
        <audio id="myAudio">
            <source src="../src/sound/odoriko.mp3" type="audio/mpeg">
            Your browser does not support the audio element.
          </audio>

          <header>
            <img src="../src/image/profile.jpg" height="200" width="200" alt="avatar">
            <section>
                <h1>
                    <span style="--delay: 0.1s;">A</span>
                    <span style="--delay: 0.2s;">f</span>
                    <span style="--delay: 0.3s;">i</span>
                    <span style="--delay: 0.4s;">f</span>
                    <span style="--delay: 0.5s;"> </span>
                    <span style="--delay: 0.6s;">M</span>
                    <span style="--delay: 0.7s;">e</span>
                    <span style="--delay: 0.8s;">d</span>
                    <span style="--delay: 0.9s;">y</span>
                    <span style="--delay: 1.0s;">a</span>

                </h1>
                <p>Halo, nama saya Afif Medya Wishnu, Saya seorang pelajar berumur 17 tahun yang tengah menempuh pendidikan di SMK Taruna Bhakti, khususnya di jurusan pemrograman perangkat lunak dan gim.</p>
                {{-- <button id="cv">CV Saya</button> --}}
            </section>
        </header>

        <div id="arrow">
            <svg stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" fill="none" viewBox="0 0 512 512">
                <path d="M112 184l144 144 144-144"></path>
            </svg>
        </div>

        @yield('content')
        <!-- <footer>
            <div>
                <p><span>Search Anime</span> • <a href="https://myanimelist.net/anime.php">MyAnimeList</a></p>
            </div>
            <form action="/search" method="get">
                <input type="text" name="query" placeholder="Search...">
                <button type="submit">Search</button>
            </form>

        </footer>
         -->

        <script defer="" src="../src/js/index.js">


        </script>
        <script defer="" src="../src/js/min.js"></script>
        <script defer="" src="../src/js/oneko.js"></script>
        <script defer="" src="../src/js/github/github.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
        @stack('scripts')
    </body>
</html>
