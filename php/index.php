<!DOCTYPE html>
<html>
  <head>
    <title>Movie Database Search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://code.jquery.com/jquery-2.0.3.min.js" defer></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" defer></script>
  </head>
  <body>
    <nav class="navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Movie Database</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <p class="navbar-text navbar-right">Justin Dobson, Kris Dorer, Christian Murphy</li></p>
      </div><!-- /.navbar-collapse -->
    </nav>

    <main class="container">
      <h1>Movie Search</h1>

      <form role="form" action="results.php" method="post">
        <div class="form-group">
          <label for="return-type">Find a </label>
          <select name="return-type" class="form-control" id="return-type">
            <option>Actor</option>
            <option>Director</option>
            <option>Movie</option>
          </select>
        </div>

        <div class="form-group">
          <label for="param-type">where the</label>
          <select name="param-type" class="form-control" id="param-type">
            <option>Person</option>
            <option>Movie</option>
          </select>
          name
        </div>

        <div class="form-group">
          <label for="param-value">is</label>
          <input name="param-value" type="text" class="form-control" id="param-value" placeholder="name">
        </div>
        <input type="submit" class="btn btn-default">
      </form>
    </main>
   
  </body>
</html>
