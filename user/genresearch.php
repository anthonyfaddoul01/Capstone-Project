<?php
require ('dbconn.php');

?>

<?php
if ($_SESSION['type'] == 'User') {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Genre Search</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php require ("links.php") ?>


    <style>
      .sidebar {
        width: inherit;
        /* Adjust the width as needed */
        height: 100vh;
        /* Set the height to the full view height */
        background-color: #000;
        /* Adjust the background color to match your sidebar */
        padding: 1rem;
        position: fixed;
        /* Fixed sidebar */
        overflow-y: auto;
      }

      .sidebar .nav-link {
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 0.5rem;
      }

      .sidebar .nav-link:hover,
      .sidebar .nav-link:focus {
        color: #ffc451 !important;
        background-color: white;
      }

      .sidebar .nav-link.active {
        color: #000;
        background-color: #fff;
        /* Adjust active link background color */
        border-radius: 0.25rem;
        font-weight: bolder;
      }

      .sidebar .nav-link.active:hover {
        color: #ffc451 !important;
        background-color: black;
      }

      .sidebar .brand {
        color: #fff;
        font-size: 1.5rem;
        font-weight: bold;
        text-decoration: none;
        margin-bottom: 1rem;
        display: block;
      }

      .sidebar img {
        max-width: 100%;
        height: auto;
      }

      .sidebar hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
      }

      .imgcontainer {
        height: 40vh;
        width: 100%;
        object-fit: fill;
        object-position: center;

      }

      /* Further customization can be done here */
    </style>
  </head>

  <body class="bg-white">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <div class="sidebar">
        <!-- Sidebar content -->
        <a href="#" class="brand d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <img src="images/logo.png" alt="Logo" width="40" height="32" />
          BookBud
          <button class="nav-link d-block d-lg-none mb-0 ml-5" data-widget="pushmenu" href="#" role="button"><i
              class="fas fa-bars" style="color:white; font-size:20px;"></i></button>
        </a>
        <hr />
        <ul class="nav nav-pills flex-column mb-auto hov">
          <li class="nav-item">
            <a href="#" class="nav-link active" onclick="displayPopularBooks(1)"> For You </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link active" onclick="searchBooks(1)"> Favorites </a>
          </li>

          <!-- More categories -->
        </ul>
        <hr />
        <span
          class="brand d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">Genres</span>
        <ul class="nav nav-pills flex-column mb-auto">
          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Fiction', 1); return false;">
              <i class="fas fa-light fa-user-astronaut"></i>
              Fiction
            </a>
          </li>
          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Fantasy', 1); return false;">
              <i class="fas fa-magic"></i>
              Fantasy
            </a>
          </li>
          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Young Adult', 1); return false;">
              <i class="fas fa-light fa-user-tie"></i>
              Young Adult
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Romance', 1); return false;">
              <i class="fas fa-light fa-heart"></i>
              Romance
            </a>
          </li>
          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Nonfiction', 1); return false;">
              <i class="fas fa-sharp fa-light fa-biohazard"></i>
              Non-Fiction
            </a>
          </li>
          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Historical Fiction', 1); return false;">
              <i class="fa-solid fa-archway"></i>
              Historical Fiction
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Mystery', 1); return false;">
              <i class="fa-solid fa-question"></i>
              Mystery
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Science Fiction', 1); return false;">
              <i class="fa-solid fa-atom"></i>
              Science Fiction
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Classics', 1); return false;">
              <i class="fa-brands fa-black-tie"></i>
              Classics
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('History', 1); return false;">
              <i class="fa-solid fa-landmark"></i>
              History
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Horror', 1); return false;">
              <i class="fa-solid fa-skull-crossbones"></i>
              Horror
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Childrens', 1); return false;">
              <i class="fa-solid fa-child-reaching"></i>
              Children
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Poetry', 1); return false;">
              <i class="fa-solid fa-pen-nib"></i>
              Poetry
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Philosophy', 1); return false;">
              <i class="fa-solid fa-brain"></i>
              Philosophy
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Manga', 1); return false;">
              <i class="fas fa-light fa-dragon"></i>
              Manga
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Paranormal', 1); return false;">
              <i class="fas fa-light fa-ghost"></i>
              Paranormal
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Comics', 1); return false;">
              <i class="fa-regular fa-face-laugh-beam"></i>
              Comics
            </a>
          </li>

          <li>
            <a href="#" class="nav-link" onclick="fetchBooksByGenre('Thriller', 1); return false;">
              <i class="fa-solid fa-mask"></i>
              Thriller
            </a>
          </li>



          <!-- More genres -->
        </ul>
        <hr />
        <!-- Rest of the sidebar content -->
      </div>
    </aside>
    <!-- ======= Header ======= -->
    <header id="header" class=" header-inner-pages" style="background:rgba(0, 0, 0, 1);">
      <div class="container-lg d-flex align-items-center justify-content-between justify-content-lg-center pr-3">
        <a class="nav-link d-block d-lg-none" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"
            style="color:white; font-size:20px;"></i></a>

        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        <?php
        $userId = $_SESSION['userId'];
        $sql = "select * from bookbud.user where userId='$userId'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $username = $row['username'];
        $type = $row['type'];
        ?>
        <nav id="navbar" class="navbar order-last order-lg-0">
          <ul>
            <li><a class="nav-link" href="index.php">Home</a></li>
            <li class="dropdown"><a href="#"><span>Browse Books</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="genresearch.php">By Genre</a></li>
                <li><a href="search.php">By Search</a></li>
              </ul>
            </li>
            <li class="dropdown"><a href="#"><span>My Books</span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="current.php">Currently Issued Books</a></li>
                <li><a href="#">Favorites</a></li>
                <li><a href="pre.php">Prev Borrowed Books</a></li>
              </ul>
            </li>
            <li><a class="nav-link scrollto" href="profile.php">Profile</a></li>
            <li class="pl-5">
              <div><a href="logout.php" class="get-started-btn scrollto px-3">Logout</a></div>
            </li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->
        <div></div>


      </div>
    </header><!-- End Header -->
    <div class="content-wrapper mt-5 bg-white">
      <div id="display" class="display row col-12"></div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function fetchBooksByGenre(genre, page) {
        $.ajax({
          url: "searchbygenre.php",
          type: "GET",
          data: { genre: genre, page: page },
          success: function (data) {
            $('#display').html(data);
          }
        });
      }

      function searchBooks(page) {
        $.ajax({
          url: "getfavorites.php",
          type: "GET",
          data: { page: page },
          success: function (data) {
            $('#display').html(data);
          }
        });
      }

      function displayPopularBooks(page) {
        $.ajax({
          url: "getfavorites.php", //get popular books based on what????? machine leaning??? getpopular.php
          type: "GET",
          data: { page: page },
          success: function (data) {
            $('#display').html(data);
          }
        });
      }

      document.addEventListener("DOMContentLoaded", function(event){
        displayPopularBooks(1);
      });
    </script>
    <?php require ("scripts.php") ?>
  </body>

  </html>


<?php } else {
  echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>