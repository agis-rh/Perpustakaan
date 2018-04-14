<!DOCTYPE html>
 <html lang="en"> 
<head>
     <meta charset="UTF-8" />
    <title>Welcome Administrator</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/magic.css" />
    <link rel="shortcut icon" href="img/favicon.gif" />
</head>

<body >

<!----------------------------------------------------content------------------------------------> 
    <div class="container">
    <div class="text-center">
        <img src="img/logo.png" id="logoimg" alt=" Logo" />
    </div>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
            <form id="login" action="cek_login.php" method="post" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                    Masukan Username dan Password
                </p>
                <input type="text" required="required" placeholder="Username" name="username" id="username" class="form-control" />
                <input type="password" required="required" placeholder="Password" name="password" id="password" class="form-control" />
                <button class="btn text-muted  text-center btn-success" name="submit" type="submit">Sign in</button>
            </form>
<!--------------------------------------------------form lupa password---------------------------->
        </div>
        <div id="forgot" class="tab-pane">
            <form action="#" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Masukan E-mail</p>
                <input type="email"  required="required" placeholder="Your E-mail"  class="form-control" />
                <br />
                <button class="btn text-muted text-center btn-success" type="submit">Minta Password Baru</button>
            </form>
        </div>
<!--------------------------------------------form daftar----------------------------------------->
        <div id="signup" class="tab-pane">
            <form action="#" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">Silahkan isi semua data</p>
                 <input type="text" required="required" placeholder="Username" class="form-control" />
                 <input type="password" required="required" placeholder="Password" class="form-control" />
                <input type="text" required="required" placeholder="Nama Lengkap" class="form-control" />
                <input type="email" required="required" placeholder="E-mail" class="form-control" />
                <input type="text" required="required" placeholder="Nomor Telpon" class="form-control" /><br />
                <button class="btn text-muted text-center btn-success" type="submit">Daftar</button>
            </form>
        </div>
    </div>
<!------------------------------------------------link---------------------------------------------->
    <div class="text-center">
        <ul class="list-inline">
            <li><a href="#login" data-toggle="tab"><button type="button" class="btn btn-link">Login</button></a></li>
            <li><a href="#forgot" data-toggle="tab"><button type="button" class="btn btn-link">Lupa Password</button></a></li>
            <li><a href="#signup" data-toggle="tab"><button type="button" class="btn btn-link">Daftar</button></a></li>
        </ul>
    </div>
</div>
<!------------------------------------------------------end content-------------------------------->   
	      
<script src="js/jquery-2.0.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/login.js"></script>

</body>
</html>
