<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SiNanTI - Sistem Layanan TI'; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .jumbotron {
            background: url('https://bpsjambi.id/publikasiBPS/public/adminLTE/dist/img/bglogin2.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            padding-top: 150px;
            padding-bottom: 150px;
        }

        .jumbotron h1,
        .jumbotron p {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .features-icon {
            font-size: 4em;
            color: #007bff;
        }

        .feature {
            margin-top: 30px;
        }

        .feature h3 {
            margin-top: 15px;
        }

        .contact-section {
            background: #f8f9fa;
            padding: 50px 0;
        }

        .contact-section h3 {
            margin-bottom: 30px;
        }

        .footer {
            background: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <?= $this->renderSection('content'); ?>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>