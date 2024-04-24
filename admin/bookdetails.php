<?php
require('dbconn.php');

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
                <div class="col">
                    <!-- Box Comment -->
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
                        <!-- /.card-header -->
                        <div class="card-body row">
                            <div class="row align-items-center m-5">
                                <?php echo '<img class="img-fluid pad" src="' . $img . '">' ?>
                            </div>
                            <div class="col-8 row align-items-center m-5">
                                <p><b class="text-info">Book ID:</b>
                                    <?php echo $bookid; ?> &emsp;
                                    <b class="text-info">Book Title:</b>
                                    <?php echo $title; ?> &emsp;
                                    <b class="text-info">Book Author:</b>
                                    <?php echo $author; ?> &emsp;
                                    <b class="text-info">Book Series:</b>
                                    <?php echo $series; ?>
                                </p>
                                <p><b class="text-info">Book Language:</b>
                                    <?php echo $lang; ?> &emsp;
                                    <b class="text-info">Book Rating:</b>
                                    <?php echo $rating; ?> &emsp;
                                    <b class="text-info">Book Genre:</b>
                                    <?php echo $genre; ?> &emsp;
                                    <b class="text-info">Book Shelf:</b>
                                    <?php echo $shelf; ?> &emsp;
                                    <b class="text-info">Book No. of pages:</b>
                                    <?php echo $pages; ?> 
                                </p>
                                <p><b class="text-info">Book Edition:</b>
                                    <?php echo $bookEdition; ?> &emsp;
                                    <b class="text-info">Book Publisher:</b>
                                    <?php echo $publisher; ?> &emsp;
                                    <b class="text-info">Book Year of publication:</b>
                                    <?php echo $year; ?> &emsp;
                                    <b class="text-info">Book Availability:</b>
                                    <?php echo $available; ?>
                                </p>
                                <p><b class="text-info">Book Description:</b>
                                    <?php echo $description; ?>
                                </p>
                            </div>


                        </div>
                        <div class="row justify-content-between pl-5 pb-3 pr-5">
                            <a href="book.php" class="btn btn-primary">Go Back</a>
                            <form action="deletebook.php" method="post">
                                <button onclick="return myFunction2()" name="delete" type="submit"
                                    class="btn btn-danger">Delete</button>
                                <script>
                                    function myFunction2() {
                                        return confirm('Are you sure you want to delete this book?');
                                    } 
                                </script>
                                <input type="hidden" name="deletor" value="admin">
                                <input type="hidden" name="item" value="<?php echo $name ?>">
                                <input type="hidden" name="bookId" value="<?php echo $bookid ?>">
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>



            </div>
        </div>
        <!--/.wrapper-->

        <?php require("scripts.php") ?>


    </body>

    </html>


<?php } else {
    echo "<script>window.location = '../error.php';</script>";
} ?>