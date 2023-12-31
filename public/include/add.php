<div class="modal fade" id="manageSongsModal" tabindex="-1" aria-labelledby="manageSongsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="manageSongsModalLabel">Manage Songs</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/magupload" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="music_id" value="">
                    <div class="mb-3">
                        <label for="file" class="form-label">Song File (MP3 or WAV)</label>
                        <input type="file" class="form-control" name="song" required>
                    </div>
                   <button type="submit" class="btn btn-dark">Add Song</button>
                </form>
            </div>
            <div class="modal-footer bg-dark">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>