<?php
require ('dbconn.php');

?>

<?php
if ($_SESSION['userId'] == '1') {
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
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Library</title>
        <?php require ("links.php") ?>
    </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <?php require ("nav.php") ?>
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Book Details</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div class="card-body">
        <?php
        $x = $_GET['id'];
        $sql = "select * from bookbud.book where bookId='$x'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $series = $row['series'];
        $author = $row['author'];
        $description = $row['bookDescription'];
        $lang = $row['publicationLanguage'];
        $rating = $row['rating'];
        $genre = $row['mainGenre'];
        $genres = $row['genres'];
        $shelf = $row['shelf'];
        $bookEdition = $row['bookEdition'];
        $publisher = $row['publisher'];
        $pages = $row['pages'];
        $year = $row['yearOfPublication'];
        $available = $row["isAvailable"] == '1' ? 'Yes' : 'No';
        $img = $row['coverImage'];
        ?>
        <form action="editbookdetails.php?id=<?php echo $x ?>" method="post">
          <input type="hidden" name="bookId" value="<?php echo htmlspecialchars($row['bookId']); ?>">
          <div class="card-body">
            <div class="form-group">
              <label for="title">Title <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="title" id="title" placeholder="Enter book title"
                value="<?php echo htmlspecialchars($row['title']); ?>" required>
            </div>
            <div class="form-group">
              <label for="author">Author</label>
              <input type="text" class="form-control" name="author" id="author" placeholder="Enter book author"
                value="<?php echo htmlspecialchars($row['author']); ?>">
            </div>
            <div class="form-group">
              <label for="series">Series</label>
              <input type="text" class="form-control" name="series" id="series" placeholder="Enter book series"
                value="<?php echo htmlspecialchars($row['series']); ?>">
            </div>
            <div class="form-group">
              <label for="rating">Rating</label>
              <input type="text" class="form-control" name="rating" id="rating" placeholder="Enter book rating"
                value="<?php echo htmlspecialchars($row['rating']); ?>">
            </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" name="description" rows="4"
                    placeholder="Enter book description" value="<?php echo htmlspecialchars($row['bookDescription']); ?>"></textarea>
                </div>
                <div class="form-group">
                  <label for="language">Language</label>
                  <input type="text" class="form-control" name="language" id="language" placeholder="Enter book language"value="<?php echo htmlspecialchars($row['publicationLanguage']); ?>">
                </div>
                <div class="form-group mt-3">
                  <label for="bookform">Book Form</label>
                  <input type="text" class="form-control" name="bookform" id="bookform" placeholder="Enter book form"value="<?php echo htmlspecialchars($row['bookForm']); ?>">
                </div>
                <div class="form-group">
                  <label for="bookedition">Book Edition</label>
                  <input type="text" class="form-control" name="bookedition" id="bookedition"
                    placeholder="Enter book edition"value="<?php echo htmlspecialchars($row['bookEdition']); ?>">
                </div>
                <div class="form-group">
                  <label for="pages">No. of Pages</label>
                  <input type="text" class="form-control" name="pages" id="pages" placeholder="Enter book no. of pages" value="<?php echo htmlspecialchars($row['pages']); ?>">
                </div>
                <div class="form-group">
                  <label for="publisher">Publisher</label>
                  <input type="text" class="form-control" name="publisher" id="publisher"
                    placeholder="Enter book publisher" value="<?php echo htmlspecialchars($row['publisher']); ?>">
                </div>
                <div class="form-group">
                  <label for="yearpub">Year of Publication</label>
                  <input type="text" class="form-control" name="yearpub" id="yearpub"
                    placeholder="Enter book year of publication" value="<?php echo htmlspecialchars($row['yearOfPublication']); ?>">
                </div>
                <!--Check how to take awards as input-->
                <div class="form-group">
                  <label for="awards">Awards</label>
                  <input type="text" class="form-control" name="awards" id="awards" placeholder="Enter book awards" value="<?php echo htmlspecialchars($row['awards']); ?>">
                </div>
                <!--Check the other database inputs-->
                <div class="form-group">
                  <label for="coverimg">Cover Image <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="coverimg" id="coverimg"
                    placeholder="Enter book cover image" required value="<?php echo htmlspecialchars($row['coverImage']); ?>">
                </div>
          </div>
          <div class="d-flex justify-content-end align-items-center" style="height: 100px;">
            <div class="card-footer float-right">
              <button type="submit" name="submit" class="btn btn-success">Update Book</button>
            </div>
          </div>
        </form>
      </div>


      <?php
if(isset($_POST['submit']))
{
     $bookid = $_GET['id'];
   $Section = $_POST['Section'];
$Subject = $_POST['Subject'];
$book = $_POST['book'];
$Copyright = $_POST['Copyright'];
$Title = $_POST['Title'];
$availability = $_POST['availability'];
$Author = $_POST['Author'];
$ISBN = $_POST['ISBN'];
$status = $_POST['status'];


 // $sql1 = "INSERT INTO `book`( `Section`, `Subject`, `Textbook`, `Volume`, `Year`, `Availability`, `Author`, `ISBN`, `Status`) VALUES ('$Section','$Subject','$book','$Copyright','$Title','$availability','$Author','$ISBN','$status')";

echo $sql1="update LMS.book set `Section`='$Section',`Subject`='$subject',`Textbook`='$book',`Volume`='$Title',`Year`='$Copyright',`Availability`='$availability',`Author`='$Author',`ISBN`='$ISBN',`Status`='$status' WHERE BookId='$bookid'";

// $conn->query($sql1) or die($conn->error);

if($conn->query($sql1) == TRUE){
echo "<script type='text/javascript'>alert('Success')</script>";
header( "Refresh:0.01; url=book.php", true, 303);
}
else
{//echo $conn->error;
echo "<script type='text/javascript'>alert('Error')</script>";
}
}
?>
      
    </body>

</html>


<?php }
else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>