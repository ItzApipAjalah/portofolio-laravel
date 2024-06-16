
async function fetchLastCommitTitle() {
  try {
      const response = await fetch('/api/last-commit-title');
      const data = await response.json();
      return data[0].commit.message;
  } catch (error) {
      console.error('Error fetching last commit title:', error);
      return null;
  }
}

async function updateLastDeploymentInfo() { 
  const deployLink = document.getElementById('deploy-link');
  const deployInfo = document.getElementById('deploy-info');

  const lastCommitTitle = await fetchLastCommitTitle();
  if (lastCommitTitle) {
      deployInfo.textContent = `Last change: ${lastCommitTitle}`;
  } else {
      deployInfo.textContent = 'No recent changes found';
  }
}

updateLastDeploymentInfo();


(window.setScroll = () => document.body.style.setProperty('--scroll', scrollY / innerHeight))();
['scroll', 'resize'].forEach(e => addEventListener(e, setScroll));

['mouseenter', 'mouseleave'].forEach(e => document.addEventListener(e, () => {
    if (e === 'mouseleave') bg.removeAttribute('style');
    bg.style.transition = 'transform .1s linear';
    setTimeout(() => bg.style.transition = '', 100);
}));

document.querySelector('#arrow svg').addEventListener('click', () => {
    const start = performance.now();

    !function step() {
        const progress = (performance.now() - start) / 200;
        scrollTo({ top: (innerWidth > 880 ? .3 : .8) * innerHeight * easeOutCubic(progress) });
        if (progress < 1) requestAnimationFrame(step);
    }();

    function easeOutCubic(x) {
        return 1 - Math.pow(1 - x, 3);
    }
});

window.addEventListener('scroll', function() {
    var bg = document.getElementById('bg');
    var scrollPos = window.scrollY;

    var threshold = 180;

    if (scrollPos > threshold) {
        bg.classList.add('blur');
    } else {
        bg.classList.remove('blur');
    }
});

var audio = document.getElementById("myAudio");
var firstTrack = "src/sound/odoriko.mp3";
  var secondTrack = "src/sound/踊り子.mp3";
  audio.volume = 0.5; // Set volume to 50% (0.0 to 1.0)

  var isPlaying = true;

  function toggleMusic() {
    if (isPlaying) {
      audio.pause();
      isPlaying = false;
    } else {
      audio.play();
      isPlaying = true;
    }
  }

  document.addEventListener("keydown", function(event) {
    if (event.key === "1") {
      toggleMusic();
    }
  });

  function playAudio() {
    audio.play().catch(function(error) {
      // Autoplay was prevented, possibly due to browser restrictions
      // You can handle this situation here, e.g., by displaying a play button for the user
      console.error("Autoplay prevented: " + error);
    });
  }

  // Call the playAudio function when the page loads
  window.addEventListener("load", playAudio);

  var audio = document.getElementById("myAudio");

  // Function to show Toastr alert when music is loading
  audio.addEventListener('loadstart', function() {
    toastr.info('Music Sedang memuat');
  });

  // Function to show Toastr alert when music starts playing
  audio.addEventListener('play', function() {
    toastr.info('Press 1 to toggle music on/off', '', {
      timeOut: 10000 // Set timeout to 10 seconds (10000 milliseconds)
    });
  });

  document.addEventListener("DOMContentLoaded", function() {
    toastr.options.progressBar = true;
    toastr.info('Tekan 2 Mengganti gambar neko <3', '', {

        timeOut: 20000 // Set timeout to 20 seconds (20000 milliseconds)
    });
});
//Reset scroll top

history.scrollRestoration = "manual";

$(window).on('beforeunload', function(){
      $(window).scrollTop(0);
});
  // Function to play audio
  function handleAutoplayError(error) {
    console.error("Autoplay prevented: " + error);
    toastr.error('Music tidak dapat dimainkan otomatis. Klik di sini untuk menyalakan music.', '', {
      onclick: function() {
        audio.play().catch(function(error) {
          console.error("Manual play failed: " + error);
        });
      },
      timeOut: 20000, // Set timeout to 0 to prevent auto hide
      extendedTimeOut: 20000 // Set extended timeout to 0 to prevent auto hide
    });
  }

  // Function to play audio
  function playAudio() {
    audio.play().catch(handleAutoplayError);
  }

  // Function to switch to the next music track
  function switchTrack() {
    if (audio.src.includes(firstTrack)) {
      audio.src = secondTrack;
    } else {
      audio.src = firstTrack;
    }
    audio.play().catch(handleAutoplayError);
  }

  // Call switchTrack function when the current track ends
  audio.addEventListener('ended', function() {
    switchTrack();
  });

  // Call playAudio function when the page loads
  window.addEventListener("load", playAudio);

  document.getElementById('showImage').addEventListener('click', function () {
    // Tampilkan SweetAlert dengan gambar di dalamnya
    Swal.fire({
        imageUrl: 'https://w0.peakpx.com/wallpaper/778/9/HD-wallpaper-404-error-404-error-glitch-glitch.jpg', // Ganti dengan path ke gambar yang ingin ditampilkan
        imageAlt: 'Gambar',
        showCloseButton: true // Menampilkan tombol close
    });
});

document.getElementById('cv').addEventListener('click', function () {
  // Tampilkan SweetAlert dengan gambar di dalamnya
  Swal.fire({
      imageUrl: '../../src/image/CV/CV.jpg', // Ganti dengan path ke gambar yang ingin ditampilkan
      imageAlt: 'Gambar',
      showCloseButton: true, // Menampilkan tombol close
      footer: '<a href="../../src/image/CV/CV.pdf" download>Download CV</a>' // Tombol unduh CV
  });
});

// Menambahkan event listener ke seluruh dokumen
document.addEventListener('keydown', function(event) {
  // Memeriksa apakah tombol yang ditekan adalah "3"
  if (event.key === '3') {
    // Menampilkan SweetAlert dengan pilihan latar belakang
    Swal.fire({
      title: 'Pilih latar belakang(bug)',
      input: 'select',
      inputOptions: {
        'bg2.webp': 'Background 2',
        'bg.webp': 'Background 1'
      },
      inputPlaceholder: 'Pilih latar belakang',
      showCancelButton: true,
      confirmButtonText: 'Simpan',
      cancelButtonText: 'Batal',
      inputValidator: (value) => {
        if (!value) {
          return 'Anda harus memilih salah satu opsi'
        }
      }
    }).then((result) => {
      if (result.isConfirmed) {
        const selectedBackground = result.value;
        // Ubah latar belakang sesuai dengan pilihan pengguna
        document.getElementById('bg').style.backgroundImage = `url('../../src/image/${selectedBackground}')`;
        Swal.fire('Sukses!', 'Latar belakang telah diubah', 'success');
      }
    });
  }
});

document.body.style.overflow = 'hidden';

        // Re-enable scrolling after 1 second
        setTimeout(function() {
            document.body.style.overflow = 'auto';
        }, 1400); // 1000 milliseconds = 1 second
        async function fetchAnimeRecommendations() {
          try {
              const response = await fetch('/api/anime-recommendations');
              const data = await response.json();
              return data;
          } catch (error) {
              console.error('Error fetching anime recommendations:', error);
              return null;
          }
      }

      // Function to display anime recommendations in widgets
      // Function to display anime recommendations in widgets
async function displayAnimeRecommendations() {
  const animeListDiv = document.getElementById('animeList');
  const animeData = await fetchAnimeRecommendations();

  if (animeData && animeData.data && animeData.data.length > 0) {
      // Generate a random index within the range of available recommendations
      const randomIndex = Math.floor(Math.random() * animeData.data.length);

      // Get a random recommendation
      const recommendation = animeData.data[randomIndex];
      const entry = recommendation.entry[0];
      const title = entry.title;
      const imageUrl = entry.images.jpg.image_url;

      const widget = document.createElement('div');
      widget.classList.add('widget');

      widget.innerHTML = `
          <a href="${entry.url}" aria-label="${title}">
              <div class="content">
                  <div class="image" style="background-image: url('${imageUrl} ' )"></div>
                  <div class="meta" style="white-space: nowrap; text-align: center;">
                      <b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Recommendation Anime &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </b>
                      <p id="animeTitle">${title}</p>
                  </div>
              </div>
          </a>
      `;
      animeListDiv.appendChild(widget);
  } else {
      animeListDiv.innerHTML = '<p>No anime recommendations found.</p>';
  }
}

// Mendapatkan nilai waifuImages dari local storage saat halaman dimuat
let waifuImages = JSON.parse(localStorage.getItem('waifuImages')) || [];

const gachaWaifuWidget = document.getElementById('gachaWidget');

gachaWaifuWidget.addEventListener('click', async function() {
    const lastAccessTime = localStorage.getItem('waifuLastAccessTime');

    if (lastAccessTime) {
        const currentTime = new Date().getTime();
        const elapsedTime = currentTime - parseInt(lastAccessTime);

        if (elapsedTime < 20000) { // 20000 milidetik = 20 detik
            toastr.warning('Anda telah menggunakan gacha waifu dalam waktu 20 detik terakhir.');
            return;
        }
    }

    try {
        const response = await fetch('/api/waifu-image');
        const data = await response.json();

        const imageUrl = data.url;

        // Menyimpan URL gambar ke dalam array waifuImages
        waifuImages.push(imageUrl);

        Swal.fire({
            imageUrl: '',
            html: '<img id="waifuImage" src="' + imageUrl + '" alt="Waifu" style="filter: blur(20px); max-width: 100%; height: auto; transition: filter 0.3s;"><div id="clickText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 24px;">Click gambar Untuk Melihat</div>',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText: 'Close',
            confirmButtonText: 'Download',
            didOpen: () => {
                const waifuImage = document.getElementById('waifuImage');
                const clickText = document.getElementById('clickText');

                waifuImage.addEventListener('click', function() {
                    waifuImage.style.filter = 'none';
                    clickText.style.display = 'none';
                });

                // Membuat tombol "Waifu Kamu" di dalam SweetAlert
                const waifuButton = document.createElement('button');
                waifuButton.innerText = 'Waifu Kamu';
                waifuButton.classList.add('swal2-confirm', 'swal2-styled');
                waifuButton.addEventListener('click', function() {
                    // Menampilkan SweetAlert dengan semua URL gambar waifu
                    Swal.fire({
                        title: 'Waifu Kamu',
                        html: waifuImages.map(imageUrl => `<img src="${imageUrl}" style="max-width: 100%; height: auto;">`).join(''),
                        showCloseButton: true
                    });
                });

                // Menambahkan tombol "Waifu Kamu" ke dalam SweetAlert
                const buttonsContainer = Swal.getActions();
                buttonsContainer.appendChild(waifuButton);
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const downloadLink = document.createElement('a');
                downloadLink.href = imageUrl;
                downloadLink.download = 'waifu.jpg';
                downloadLink.style.display = 'none';
                document.body.appendChild(downloadLink);
                downloadLink.click();
                document.body.removeChild(downloadLink);
            }
        });

        const currentTime = new Date().getTime();
        localStorage.setItem('waifuLastAccessTime', currentTime.toString());
        localStorage.setItem('waifuImages', JSON.stringify(waifuImages)); // Simpan array waifuImages ke localStorage
    } catch (error) {
        console.error('Error fetching waifu image:', error);
        toastr.error('Terjadi kesalahan saat mengambil gambar waifu. Silakan coba lagi nanti.');
    }
});







      // Display anime recommendations when the page loads
      window.onload = displayAnimeRecommendations;

      window.TrackJS && TrackJS.install({
        token: "3ac9abaa54dd44a4b6123e54130f8c46",
        console: { display: false }
    });
