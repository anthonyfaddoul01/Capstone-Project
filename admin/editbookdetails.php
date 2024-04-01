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
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <?php require ("nav.php") ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Book Details</h1>
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

                $bookid = $row['bookId'];
                $title = $row['title'];
                $series = $row['series'];
                $author = $row['author'];
                $description = $row['bookDescription'];
                $lang = $row['publicationLanguage'];
                $rating = $row['rating'];
                $genre = $row['mainGenre'];
                $shelf = $row['shelf'];
                $bookEdition = $row['bookEdition'];
                $publisher = $row['publisher'];
                $pages = $row['pages'];
                $year = $row['yearOfPublication'];
                $available = $row["isAvailable"] == '1' ? 'Yes' : 'No';
                $img = $row['coverImage'];
                ?>

                <div class="card-body row justify-content-center m-0">
                    <div class="col-6">
                        <div class="card card-info">
                            <div class="card card-widget">
                                <div class="card-header">
                                    <div class="user-block">
                                        <?php echo '<img src="' . $img . '">' ?>
                                        <span class="username"><a href="#">
                                                <?php echo $title; ?>
                                            </a></span>
                                        <span class="description">
                                            By
                                            <?php echo $author; ?>
                                        </span>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <form action="editbookdetails.php?id=<?php echo $bookid ?>" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" id="title"
                                                placeholder="Enter book title" required value="<?php echo $title ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="author">Author</label>
                                            <input type="text" class="form-control" name="author" id="author"
                                                placeholder="Enter book author" value="<?php echo $author ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="series">Series</label>
                                            <input type="text" class="form-control" name="series" id="series"
                                                placeholder="Enter book series" value="<?php echo $series ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="rating">Rating</label>
                                            <input type="text" class="form-control" name="rating" id="rating"
                                                placeholder="Enter book rating" value="<?php echo $rating ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="4"
                                                placeholder="Enter book description"
                                                value="<?php echo $description ?>"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="language">Language</label>
                                            <input type="text" class="form-control" name="language" id="language"
                                                placeholder="Enter book language" value="<?php echo $lang ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Main Genre <span class="text-danger">*</span></label>
                                            <select class="form-control select2bs4" style="width: 100%;"
                                                value="<?php echo $genre ?>">
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
                                            <select class="select2" id="mySelect" multiple="multiple"
                                                data-placeholder="Select book genres" style="width: 100%;" name="genre[]"
                                                value="<?php echo $title ?>">
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
                                            <input type="text" class="form-control" name="bookform" id="bookform"
                                                placeholder="Enter book form" value="<?php echo $title ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="bookedition">Book Edition</label>
                                            <input type="text" class="form-control" name="bookedition" id="bookedition"
                                                placeholder="Enter book edition" value="<?php echo $bookEdition ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="pages">No. of Pages</label>
                                            <input type="text" class="form-control" name="pages" id="pages"
                                                placeholder="Enter book no. of pages" value="<?php echo $pages ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="publisher">Publisher</label>
                                            <input type="text" class="form-control" name="publisher" id="publisher"
                                                placeholder="Enter book publisher" value="<?php echo $publisher ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="yearpub">Year of Publication</label>
                                            <input type="text" class="form-control" name="yearpub" id="yearpub"
                                                placeholder="Enter book year of publication" value="<?php echo $year ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="awards">Awards</label>
                                            <input type="text" class="form-control" name="awards" id="awards"
                                                placeholder="Enter book awards" value="<?php echo $title ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="coverimg">Cover Image <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="coverimg" id="coverimg"
                                                placeholder="Enter book cover image" required value="<?php echo $img ?>">
                                        </div>
                                        <!--Cover Image should be last input-->
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="d-flex justify-content-end align-items-center" style="height: 100px;">
                                        <div class="card-footer float-right">
                                            <button type="submit" name="submit" class="btn btn-success">Add
                                                Book</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->

        </div>



        </div>
        </div>
        <!--/.wrapper-->

        <?php require ("scripts.php") ?>

        <?php
        if (isset ($_POST['submit'])) {
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
    
            echo $sql1 = "update LMS.book set `Section`='$Section',`Subject`='$subject',`Textbook`='$book',`Volume`='$Title',`Year`='$Copyright',`Availability`='$availability',`Author`='$Author',`ISBN`='$ISBN',`Status`='$status' WHERE BookId='$bookid'";

            // $conn->query($sql1) or die($conn->error);
    
            if ($conn->query($sql1) == TRUE) {
                echo "<script type='text/javascript'>alert('Success')</script>";
                header("Refresh:0.01; url=book.php", true, 303);
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