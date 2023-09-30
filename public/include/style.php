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
         background-color: #ADC4CE;
         padding: 20px;
     }

     h1 {
         color: #333;
     }

     #player-container {
         max-width: 400px;
         margin: 0 auto;
         padding: 20px;
         background-color: #fff;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
     }

     audio {
         width: 100%;
     }

     #playlist {
         list-style: none;
         padding: 0;
     }

     #playlist li {
         cursor: pointer;
         padding: 10px;
         background-color: #eee;
         margin: 5px 0;
         transition: background-color 0.2s ease-in-out;
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

  input[type="search"] {
    padding: 10px;
    width: 300px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
  }

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

  button.btn-primary:hover {
    background-color: #0056b3; 
  }

  
    </style>
</head>