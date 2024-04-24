<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, 
                                       initial-scale=1.0" />
    <title>404 Error</title>
    <link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
          rel="stylesheet" />
          <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <style>
        body,
        html {
            height: 100%;
        }
    </style>
</head>
 
<body class="d-flex justify-content-center 
                 align-items-center bg-warning">
    <div class="col-md-12 text-center">
        <h1 class="text-danger">ERROR</h1>
        <h2>Unauthorized Access</h2>
        <p>
            Sorry, you cannot access the page you are looking for.
        </p>
    </div>
</body>
 
</html>
<?php
while (ob_get_level()) {
  ob_end_flush();
}
flush();  // Make sure all buffers are flushed
sleep(3);
echo "<script>window.location = 'index.php';</script>";
?>
