var audio = document.getElementById("myAudio");
var firstTrack = "src/sound/odoriko.mp3";
  var secondTrack = "src/sound/踊り子.mp3";
  audio.volume = 0.5;

  var isPlaying = false;

  function toggleMusic() {
    if (isPlaying) {
      audio.pause();
      isPlaying = false;
      toastr.info('Music Dimatikan');

    } else {
      audio.play();
      isPlaying = true;
      toastr.info('Music Sedang memuat');

    }
  }

  document.addEventListener("keydown", function(event) {
    if (event.key === "1") {
      toggleMusic();

    }
  });
  var audio = document.getElementById("myAudio");


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



document.addEventListener("DOMContentLoaded", function() {
  toastr.options.progressBar = true;



  toastr.info('Tekan 1 Untuk Menyalakan/Mematikan Music', '', {
      timeOut: 5000
  });

  // Fungsi untuk mendapatkan waktu lokal Indonesia (WIB)
  function getLocalWIBTime() {
      const now = new Date();
      const utcOffset = 7 * 60; // Offset UTC+7 untuk WIB dalam menit
      const localTime = new Date(now.getTime() + (utcOffset * 60 * 1000));
      return localTime;
  }

  // Fungsi untuk memperbarui toastr dengan waktu WIB
  function updateToastrWithWIBTime() {
      const localTime = getLocalWIBTime();
      const hours = localTime.getUTCHours().toString().padStart(2, '0');
      const minutes = localTime.getUTCMinutes().toString().padStart(2, '0');
      const seconds = localTime.getUTCSeconds().toString().padStart(2, '0');
      const timeString = `${hours}:${minutes}:${seconds} WIB`;

      toastr.info(`Jam: ${timeString}`, '', {
          timeOut: 5000
      });
  }

  // Panggil fungsi untuk memperbarui toastr dengan waktu WIB saat halaman dimuat
  updateToastrWithWIBTime();


  // Perbarui toastr dengan waktu WIB setiap menit
  setInterval(updateToastrWithWIBTime, 60000);
});


  //Reset scroll top

  history.scrollRestoration = "manual";

  $(window).on('beforeunload', function(){
        $(window).scrollTop(0);
  });


  document.getElementById('showImage').addEventListener('click', function () {
      Swal.fire({
          imageUrl: 'https://w0.peakpx.com/wallpaper/778/9/HD-wallpaper-404-error-404-error-glitch-glitch.jpg',
          imageAlt: 'Gambar',
          showCloseButton: true
      });
  });

// document.getElementById('cv').addEventListener('click', function () {
//   Swal.fire({
//       imageUrl: '../../src/image/CV/CV.jpg',
//       imageAlt: 'Gambar',
//       showCloseButton: true,
//       footer: '<a href="../../src/image/CV/CV.pdf" download>Download CV</a>'
//   });
// });



document.addEventListener('DOMContentLoaded', function() {
  // Fungsi untuk mendapatkan waktu lokal Indonesia (WIB)
  function getLocalWIBHour() {
    // Menggunakan offset UTC+7 untuk WIB
    const now = new Date();
    const utcHour = now.getUTCHours();
    const wibHour = (utcHour + 7) % 24;
    return wibHour;
  }

  // Fungsi untuk mengatur latar belakang berdasarkan waktu
  function setBackgroundBasedOnTime() {
    const wibHour = getLocalWIBHour();
    const bgElement = document.getElementById('bg');

    if (wibHour >= 6 && wibHour < 18) {
      // Pagi hingga sore (06:00 - 17:59) menggunakan bg.webp
      bgElement.style.backgroundImage = "url('../../src/image/bg.webp')";
    } else {
      // Malam (18:00 - 05:59) menggunakan bg2.webp
      bgElement.style.backgroundImage = "url('../../src/image/bg2.webp')";
    }
  }

  setBackgroundBasedOnTime();

  document.addEventListener('visibilitychange', function() {
    if (document.visibilityState === 'visible') {
      setBackgroundBasedOnTime();
    }
  });

  window.addEventListener('focus', function() {
    setBackgroundBasedOnTime();
  });

  setInterval(setBackgroundBasedOnTime, 100);
});


document.body.style.overflow = 'hidden';
// Re-enable scrolling after 1 second
setTimeout(function() {
  document.body.style.overflow = 'auto';
}, 1400);
