<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible">
    <title>Front Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</head>

<body>
    <?php
        include "navbar.php";
    ?>
    <div class="container">
        <div class="page-header">
            <h1>XShare - Registration</h1>
        </div>

        <div class="jumbotron">
            <form id="sign-up-form">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div style="margin-top:20px;" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="mail" type="text" class="form-control" name="mail" placeholder="Email">
                </div>
                <div style="margin-top:20px;" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div style="margin-top:20px;" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password-second" type="password" class="form-control" name="password-second" placeholder="Re-enter your password">
                </div>
            </form>
            <button style="margin-top:20px;" class="btn btn-success" id="button-sign-up">Sign up</button>
        </div>
    </div>
  </div>
  <div class="modal fade" id="info-modal" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <p style="font-size:20px; font-weight:bold;"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</body>
</html>