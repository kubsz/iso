<?php
$a = "hello";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <div class="nav black">
        <div class="inner-nav margined">
            <div class="logo"><span class="primary-font bold">HS</span>Admin</div>
            <div class="img">
                <div class="name">Dave Cox</div>
                <div class="circle">D</div>
            </div>
        </div>
    </div>
    <div class="login-container">
        <h2>ADMIN</h2>
        <div class="line"></div>
        <div class="login-form">
            <input type="text" id="username" placeholder="Username"><br>
            <input id="password" type="password" placeholder="Password">
            <div class="login-button">Submit</div>
        </div>
    </div>
    <div class="sidenav black">
        <div class="list">
            <div class="option active-option"><i class="fas fa-home"></i>Dashboard</div>
            <div class="option"><i class="fas fa-user-graduate"></i>Students</div>
            <div class="option"><i class="fas fa-users"></i>Carers</div>
            <div class="option"><i class="fas fa-handshake"></i>Meetings</div>
            <div class="option"><i class="fas fa-laptop"></i>Resources</div>
            <div class="option"><i class="fas fa-door-closed"></i>Rooms</div>
        </div>
    </div>
    <div class="main">
        <h1>Dashboard</h1>
    </div>
</body>
<script src="script.js"></script>
</html>