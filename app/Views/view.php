<!DOCTYPE html>
<html lang="en">

<body>

  <?php include 'include/add.php';
  include 'include/style.php';
  include 'include/modals.php';
  include 'include/addPlaylist.php';
  ?>

              <div class="container">
                <a href="/view" class="btn btn-primary ">
                  <i class="fas fa-home"></i> Back
                </a>
                <br>
              <div class="col">
                <form action="/search" method="get">
                  <div class="input-group">
                    <input type="search" name="search" class="form-control" placeholder="Search song">
                    <input type="hidden" name="context" value="<?= $context ?>">
                    <?php if ($context === 'playlist'): ?>
                      <input type="hidden" id="playlistIDInput" name="playlistID" value="">
                    <?php endif ?>
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <!-- Music Player Header -->
        <h1 class="mt-4">Music Player</h1>
        <div class="mb-3">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">My
            Playlist
          </button> 
           <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manageSongsModal">Manage
            Songs
          </button> 
        </div>
    </div>
    <!-- Audio Player -->
    <div class="audio-controls mb-3">
      <audio id="audio" controls autoplay></audio>
    </div>
         

    <!-- Music Playlist -->
      <ul class="list-group" id="playlist">
        <?php foreach ($music as $musicItem): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center"
            data-src="<?= base_url('/uploads/songs/' . $musicItem['file_path']) ?>">
            <?= $musicItem['title'] ?>
            <?php if ($context === 'playlist'): ?>
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
                  onclick="setMusicID('<?= $musicItem['music_id'] ?>')">
                  <i class="fas fa-plus"></i>+
                </button>
                <a href="<?= site_url('/removeFromPlaylist/' . $musicItem['id']) ?>" class="btn btn-secondary btn-sm">
                  <i class="fas fa-minus"></i>-
                </a>
              </div>
            <?php else: ?>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
                onclick="setMusicID('<?= $musicItem['music_id'] ?>')">
                <i class="fas fa-plus"></i>+
              </button>
            <?php endif ?>
          </li>
        <?php endforeach ?>
      </ul>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const urlParams = new URLSearchParams(window.location.search);
      const playlistID = urlParams.get('playlistID');
      const playlistIDInput = document.getElementById('playlistIDInput');
      if (playlistID) {
        playlistIDInput.value = playlistID;
      }
    });
  </script>

  <script>
    $(document).ready(function () {
      const modal = $("#myModal");
      const modalData = $("#modalData");
      const musicID = $("#musicID");
      function openModalWithData(dataId) {
        modalData.text("Data ID: " + dataId);
        musicID.val(dataId);
        modal.css("display", "block");
      }
      modal.click(function (event) {
        if (event.target === modal[0] || $(event.target).hasClass("close")) {
          modal.css("display", "none");
        }
      });
    });
  </script>
  <script>
    const audio = document.getElementById('audio');
    const playlist = document.getElementById('playlist');
    const playlistItems = playlist.querySelectorAll('li');

    let currentTrack = 0;

    function playTrack(trackIndex) {
      if (trackIndex >= 0 && trackIndex < playlistItems.length) {
        const track = playlistItems[trackIndex];
        const trackSrc = track.getAttribute('data-src');
        audio.src = trackSrc;
        audio.play();
        currentTrack = trackIndex;
      }
    }

    function nextTrack() {
      currentTrack = (currentTrack + 1) % playlistItems.length;
      playTrack(currentTrack);
    }

    function previousTrack() {
      currentTrack = (currentTrack - 1 + playlistItems.length) % playlistItems.length;
      playTrack(currentTrack);
    }

    playlistItems.forEach((item, index) => {
      item.addEventListener('click', () => {
        playTrack(index);
      });
    });

    audio.addEventListener('ended', () => {
      nextTrack();
    });

    playTrack(currentTrack);
  </script>
  <script>
    function setMusicID(musicID) {
      document.getElementById('musicID').value = musicID;
    }
  </script>

</body>

</html>
