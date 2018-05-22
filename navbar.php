<?php session_start(); ?>
<nav class="navbar navbar-inverse" style="border-radius:0px;">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="/">XShare</a>
      </div>
      <ul class="nav navbar-nav">
        <?php if (isset($_SESSION['username'])): ?>
          <li><a href="/">Home</a></li>
          <li><a href="/gallery.php">Your gallery</a></li>
          <li><a href="/add-image.php">Add image</a></li>
          <?php else: ?> 
          <li><a href="/">Home</a></li>
          <?php endif; ?>
      </ul>
      <form class="navbar-form navbar-left" action="/search.php" method="post">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search" name="search">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php if (isset($_SESSION['username'])): ?>
          <?php echo '<li><p style="font-size:28px;"><span class="label label-default">Hello ' . $_SESSION['username'] . '!</span></p></li>' ?>
          
          <li><a href="/logout.php"><span class="glyphicon glyphicon glyphicon-log-out"></span> Log out</a></li>
        <?php else: ?> 
          <li><a href="/sign-up.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
          <li><a href="/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>