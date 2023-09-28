<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #F0F3F4;
            padding: 20px;
        }

        h1 {
            color: #007bff;
            margin-top: 20px;
        }

        #player-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #FFFFFF;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        audio {
            width: 100%;
            margin-top: 20px;
        }

        #playlist {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        #playlist li {
            cursor: pointer;
            padding: 10px;
            background-color: #F5F5F5;
            margin: 5px 0;
            transition: background-color 0.2s ease-in-out;
            border-radius: 5px;
        }

        #playlist li:hover {
            background-color: #ECF2FF;
        }

        #playlist li.active {
            background-color: #007bff;
            color: #fff;
        }

        form {
            text-align: center;
            margin: 20px;
        }

        /* Style the search input */
        input[type="search"] {
            padding: 10px;
            width: 300px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Style the search button */
        button.btn-primary {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin: 7px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        /* Style the button on hover */
        button.btn-primary:hover {
            background-color: #0056b3;
        }

        /* Modal styles */
        .modal-body {
            background-color: #F5F5F5;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-title {
            color: #007bff;
        }

        .btn-close {
            color: #007bff;
        }

        /* Button styles */
        .btn {
            margin: 10px;
        }
    </style>
</head>

<body>
     <!-- //my addsong -->
    <div class="modal fade" id="addsongs" tabindex="-1" aria-labelledby="addsongs" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Song</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <br>

                    <form action="/addsong" method="post" enctype="multipart/form-data">
                        <input type="file" name="music">
                        <button type="submit">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" data-bs-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- //add to playlist modal -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggle">My Playlist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-content">

                    <div class="modal-body">

                        <?php foreach ($playlists as $item): ?>
                            <br>
                            <a href="/playlists/<?= $item['id'] ?>">
                                <?= $item['name'] ?>
                            </a>

                            <br>
                        <?php endforeach ?>


                    </div>
                    <div class="modal-footer">
                        <a href="#" data-bs-dismiss="modal">Close</a>
                        <a href="#" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Create New</a>