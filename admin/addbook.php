<?php
require ('dbconn.php');
require_once 'classBook.php';

?>

<?php
if ($_SESSION['type'] == 'admin') {
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <?php require ("links.php") ?>
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <?php require ("nav.php") ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Add Book</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card-body row justify-content-center m-0">

        <!-- left column -->
        <div class="col-6">
          <!-- general form elements -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">New Book Info</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="addbook.php" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Title <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Enter book title" required>
                </div>
                <div class="form-group">
                  <label for="author">Author</label>
                  <input type="text" class="form-control" name="author" id="author" placeholder="Enter book author">
                </div>
                <div class="form-group">
                  <label for="series">Series</label>
                  <input type="text" class="form-control" name="series" id="series" placeholder="Enter book series">
                </div>
                <div class="form-group">
                  <label for="rating">Rating</label>
                  <input type="text" class="form-control" name="rating" id="rating" placeholder="Enter book rating">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="4"
                    placeholder="Enter book description"></textarea>
                </div>
                <div class="form-group">
                  <label for="language">Language</label>
                  <input type="text" class="form-control" name="language" id="language" placeholder="Enter book language">
                </div>
                <div class="form-group">
                  <label>Main Genre <span class="text-danger">*</span></label>
                  <select class="form-control select2bs4" style="width: 100%;" name="mainGenre">
                    <?php
                    $query = "SELECT * FROM genreid";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                      $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    }

                    foreach ($options as $option) {
                      ?>
                      <option>
                        <?php echo $option['genre']; ?>
                      </option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Genres <span class="text-danger">*</span></label>
                  <select class="select2" id="mySelect" multiple="multiple" data-placeholder="Select book genres"
                    style="width: 100%;" name="genre[]">
                    <?php
                    $query = "SELECT * FROM genreid";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                      $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    }

                    foreach ($options as $option) {
                      ?>
                      <option>
                        <?php echo $option['genre']; ?>
                      </option>
                      <?php
                    }
                    ?>

                  </select>
                </div>
                <div class="form-group mt-3">
                  <label for="bookform">Book Form</label>
                  <input type="text" class="form-control" name="bookform" id="bookform" placeholder="Enter book form">
                </div>
                <div class="form-group">
                  <label for="bookedition">Book Edition</label>
                  <input type="text" class="form-control" name="bookedition" id="bookedition"
                    placeholder="Enter book edition">
                </div>
                <div class="form-group">
                  <label for="pages">No. of Pages</label>
                  <input type="text" class="form-control" name="pages" id="pages" placeholder="Enter book no. of pages">
                </div>
                <div class="form-group">
                  <label for="publisher">Publisher</label>
                  <input type="text" class="form-control" name="publisher" id="publisher"
                    placeholder="Enter book publisher">
                </div>
                <div class="form-group">
                  <label for="yearpub">Year of Publication</label>
                  <input type="text" class="form-control" name="yearpub" id="yearpub"
                    placeholder="Enter book year of publication">
                </div>
                <div class="form-group">
                  <label for="yearpub">First Year of Publication</label>
                  <input type="text" class="form-control" name="fyearpub" id="yearpub"
                    placeholder="Enter book year of publication">
                </div>
                <!--Check how to take awards as input-->
                <div class="form-group">
                  <label for="awards">Awards</label>
                  <input type="text" class="form-control" name="awards" id="awards" placeholder="Enter book awards">
                </div>
                <!--Check the other database inputs-->
                <div class="form-group">
                  <label for="coverimg">Cover Image <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="coverimg" id="coverimg"
                    placeholder="Enter book cover image" required>
                </div>
                <!--Cover Image should be last input-->
              </div>
              <!-- /.card-body -->
              <div class="d-flex justify-content-end align-items-center" style="height: 100px;">
                <div class="card-footer float-right">
                  <button type="submit" name="submit" class="btn btn-success">Add Book</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.row -->

      </div>
    </div>
    <!--/.wrapper-->

    <?php require ("scripts.php") ?>

    <?php
    if (isset($_POST['submit'])) {
      // Assuming $conn is your mysqli connection from dbconn.php
      global $conn;

      // Sanitize input data
      $title = mysqli_real_escape_string($conn, $_POST['title']);
      $author = mysqli_real_escape_string($conn, $_POST['author']);
      $series = mysqli_real_escape_string($conn, $_POST['series']);
      $rating = mysqli_real_escape_string($conn, $_POST['rating']);
      $description = mysqli_real_escape_string($conn, $_POST['description']);
      $language = mysqli_real_escape_string($conn, $_POST['language']);
      $mainGenre = mysqli_real_escape_string($conn, $_POST['mainGenre']);
      if (isset($_POST['genre']) && is_array($_POST['genre'])) {
        $genre = array_map(function ($item) use ($conn) {
          return mysqli_real_escape_string($conn, $item);
        }, $_POST['genre']);
      } else {
        $genre = []; // Or handle the error as appropriate
      }
      $genres = implode($genre);
      $bookform = mysqli_real_escape_string($conn, $_POST['bookform']);
      $bookedition = mysqli_real_escape_string($conn, $_POST['bookedition']);
      $pages = mysqli_real_escape_string($conn, $_POST['pages']);
      $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
      $yearpub = mysqli_real_escape_string($conn, $_POST['yearpub']);
      $fyearpub = mysqli_real_escape_string($conn, $_POST['fyearpub']);
      $awards = mysqli_real_escape_string($conn, $_POST['awards']);
      $coverimg = mysqli_real_escape_string($conn, $_POST['coverimg']);

      // Assuming isAvailable is always true (1) and reservedNb is always 0
      $isAvailable = 1;
      $reservedNb = 0;
      $ID = CreateID();
      $GenreID = getGenreID($mainGenre);
      $numericCount = updateAndReturnNewCount(getGenreID($mainGenre));
      $alphabeticCount = getLetterPart(getCount(getGenreID($mainGenre)));
      $shelf = generateShelvingCode(getGenreID($mainGenre), getCount(getGenreID($mainGenre)));
      $sql = "INSERT INTO `book`(`bookId`, `title`, `series`, `author`, `rating`, `bookDescription`, `publicationLanguage`, `genres`, `mainGenre`, `genreID`, `numericCount`,
       `alphabeticalCount`, `shelf`, `bookForm`, `bookEdition`, `pages`, `publisher`, `yearOfPublication`, `awards`, `numRating`, `ratingbyStars`,
        `coverImage`, `isAvailable`, `reservedNb`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $stmt = $conn->prepare($sql);

      // Check if the statement was prepared successfully
      if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
        return;
      }

      // Assuming numRating, ratingbyStars, likedPercent are not provided and should be NULL or default
      $numRating = NULL; // Adjust according to your needs
      $ratingbyStars = NULL; // Adjust according to your needs
      $likedPercent = NULL; // Adjust according to your needs
  
      // Bind the parameters to the statement
      $stmt->bind_param("issssssssiissssissssisii", $ID, $title, $series, $author, $rating, $description, $language, $genres, $mainGenre, $GenreID, $numericCount, $alphabeticCount, $shelf, $bookform, $bookedition, $pages, $publisher, $yearpub, $awards, $numRating, $ratingbyStars, $coverimg, $isAvailable, $reservedNb);

      // Execute the statement
      if (!$stmt->execute()) {

        echo "<script>alert('Error inserting the book: " . addslashes($stmt->error) . "');</script>";

      } else {
        echo "<script>alert('Book inserted successfully.');</script>";
      }
      // Close the statement
      $stmt->close();
    }
    ?>

    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="plugins/dropzone/min/dropzone.min.js"></script>
    <script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
          format: 'L'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
          timePicker: true,
          timePickerIncrement: 30,
          locale: {
            format: 'MM/DD/YYYY hh:mm A'
          }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
          {
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
          },
          function (start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
          }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
          format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function (event) {
          $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function () {
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

      })
      // BS-Stepper Init
      document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
      })

      // DropzoneJS Demo Code Start
      Dropzone.autoDiscover = false

      // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
      var previewNode = document.querySelector("#template")
      previewNode.id = ""
      var previewTemplate = previewNode.parentNode.innerHTML
      previewNode.parentNode.removeChild(previewNode)

      var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
      })

      myDropzone.on("addedfile", function (file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function () { myDropzone.enqueueFile(file) }
      })

      // Update the total progress bar
      myDropzone.on("totaluploadprogress", function (progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
      })

      myDropzone.on("sending", function (file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
      })

      // Hide the total progress bar when nothing's uploading anymore
      myDropzone.on("queuecomplete", function (progress) {
        document.querySelector("#total-progress").style.opacity = "0"
      })

      // Setup the buttons for all transfers
      // The "add files" button doesn't need to be setup because the config
      // `clickable` has already been specified.
      document.querySelector("#actions .start").onclick = function () {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
      }
      document.querySelector("#actions .cancel").onclick = function () {
        myDropzone.removeAllFiles(true)
      }

    </script>

  </body>

  </html>
<?php } else {
  echo "<script>window.location = '../error.php';</script>";
} ?>