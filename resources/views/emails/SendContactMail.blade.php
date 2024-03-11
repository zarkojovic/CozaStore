<!DOCTYPE html>
<html>
<head>
    <title>Contact Message</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="text-center">Contact Message</h1>
            <hr>
            <h2>Hello, {{ $data->name }}</h2>
            <p>Email: {{ $data->email }}</p>
            <p>Subject: {{ $data->subject }}</p>
            <p>Message: {{ $data->message }}</p>
        </div>
    </div>
</div>
</body>
</html>
