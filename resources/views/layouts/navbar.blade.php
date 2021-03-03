<!doctype html>
<html>
<head>


  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">

</head>
<body>

  <!-- navigation bar -->

    <div class="row">
      <div class="col-xs-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3">
        
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="login">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="portfolio">My Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="groups">Groups</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="job">Jobs</a>
          </li>
          @if(\Session::get('ROLE')== "Admin")
          <li class="nav-item">
            <a class="nav-link" href="manageUsers">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="doJob">Job</a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="logout">Logout</a>
          </li>
        </ul>
        
      </div>
    </div>

  <!-- navigation bar ends here -->




  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</body>
</html>