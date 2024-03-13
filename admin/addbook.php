<?php
require('dbconn.php');

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
        <?php require("links.php") ?>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <?php require("nav.php") ?>
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
            <div class="card-body row justify-content-center">

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
                                    <textarea class="form-control" id="description" name="description" rows="4"  placeholder="Enter book description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="language">Language</label>
                                    <input type="text" class="form-control" name="language" id="language" placeholder="Enter book language">
                                </div>
                                <!--Genre should be dropdown-->
                                <div class="form-group">
                                    <label for="genre">Genre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="genre" id="genre" placeholder="Enter book genre">
                                </div>
                                <div class="form-group">
                                    <label for="bookform">Book Form</label>
                                    <input type="text" class="form-control" name="bookform" id="bookform" placeholder="Enter book form">
                                </div>
                                <div class="form-group">
                                    <label for="bookedition">Book Edition</label>
                                    <input type="text" class="form-control" name="bookedition" id="bookedition" placeholder="Enter book edition">
                                </div>
                                <div class="form-group">
                                    <label for="pages">No. of Pages</label>
                                    <input type="text" class="form-control" name="pages" id="pages" placeholder="Enter book no. of pages">
                                </div>
                                <div class="form-group">
                                    <label for="publisher">Publisher</label>
                                    <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Enter book publisher">
                                </div>
                                <div class="form-group">
                                    <label for="yearpub">Year of Publication</label>
                                    <input type="text" class="form-control" name="yearpub" id="yearpub" placeholder="Enter book year of publication">
                                </div>
                                <!--Check if first year of pub is needed-->
                                <!--Check how to take awards as input-->
                                <div class="form-group">
                                    <label for="awards">Awards</label>
                                    <input type="text" class="form-control" name="awards" id="awards" placeholder="Enter book awards">
                                </div>
                                <!--Check the other database inputs-->
                                <div class="form-group">
                                    <label for="coverimg">Cover Image</label>
                                    <input type="text" class="form-control" name="coverimg" id="coverimg" placeholder="Enter book cover image">
                                </div>
                                <!--Cover Image should be last input-->
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer float-right">
                                <button type="submit" class="btn btn-success">Add Book</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->

            </div>
        </div>
        <!--/.wrapper-->

        <?php require("scripts.php") ?>

        <?php
        if (isset($_POST['submit'])) {
           
            $Section = $_POST['Section'];
            $Subject = $_POST['Subject'];
            $book = $_POST['book'];
            $Title = $_POST['Title'];
            $Copyright = $_POST['Copyright'];

            $availability = $_POST['availability'];
            $Author = $_POST['Author'];
            $ISBN = $_POST['ISBN'];
            $status = $_POST['status'];


            $sql1 = "INSERT INTO `book`( `Section`, `Subject`, `Textbook`, `Volume`, `Year`, `Availability`, `Author`, `ISBN`, `Status`) VALUES ('$Section','$Subject','$book','$Title','$Copyright','$availability','$Author','$ISBN','$status')";

            if ($conn->query($sql1) === TRUE) {
                echo "<script type='text/javascript'>alert('Success')</script>";
            } else {//echo $conn->error;
                echo "<script type='text/javascript'>alert('Error')</script>";
            }

        }
        ?>
    </body>

    </html>


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>