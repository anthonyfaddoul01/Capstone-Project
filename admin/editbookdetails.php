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
                        <form class="form-horizontal row-fluid" action="edit_book_details.php?id=<?php echo $bookid ?>" method="post">
                                           
                                           <div class="control-group">
     
                                                 <label class="control-label" for="Section"><b>Book Section:</b></label>
                                                 <div class="controls">
                                                     <select name = "Section" tabindex="1" value="SC" data-placeholder="" class="span8" required>
                                                       <!--   <option value="<?php echo $status?>"><?php echo $status ?> </option> -->
                                                       <option value=""></option>
                                                         <option value="General Reference"<?php echo($row['Section']=="General Reference")? 'selected':''; ?>>General Reference</option>
     
                                                         <option value="Reference"<?php echo($row['Section']=="Reference")? 'selected':''; ?>>Reference</option>
     
                                                         <option value="Filipiniana" <?php echo($row['Section']=="Filipiniana")? 'selected':''; ?>>Filipiniana</option>
     
                                                         <option class="Periodical" <?php echo($row['Section']=="Periodical")? 'selected':''; ?>>Periodical</option>
     
                                                         <option value="Reserved Books"<?php echo($row['Section']=="Reserved Books")? 'selected':''; ?>> Reserved Books</option>
     
                                                         <option value="Graduate Studies" <?php echo($row['Section']=="Graduate Studies")? 'selected':''; ?>>Graduate Studies</option>
     
                                                         <option value="Special Collections" <?php echo($row['Section']=="Special Collections")? 'selected':''; ?>>Special Collection</option>
     
                                                         <option value="Rare Book"  <?php echo($row['Section']=="Rare Book")? 'selected':''; ?>> Rare Book</option>
     
                                                         <option value="Computer Internet Area"  <?php echo($row['Section']=="Computer Internet Area")? 'selected':''; ?>>Computer Internet Area</option>
                                                         
                                                     </select>
                                                 </div>
                                                 
                                         </div>
                                             <div class="control-group">
                                                 <label class="control-label" for="Subject"><b>Subject</b></label>
                                                 <div class="controls">
                                                     <input type="text" id="Subject" name="Subject" placeholder="Subject" class="span8" required value="<?php echo $subject?>">
                                                 </div>
                                             </div>
                                              <div class="control-group">
                                                 <label class="control-label" for="book"><b>Textbook</b></label>
                                                 <div class="controls">
                                                     <input type="text" id="book" name="book" placeholder="Textbook" class="span8" required value="<?php echo $name?>">
                                                 </div>
                                             </div>
                                             
                                             <div class="control-group">
                                                 <label class="control-label" for="Copyright"><b>Copyright Year</b></label>
                                                 <div class="controls">
                                                     <input type="text" id="Copyright" name="Copyright" placeholder="Copyright" class="span8" required value="<?php echo $year?>">
                                                 </div>
                                             </div>
                                             <div class="control-group">
                                                 <label class="control-label" for="Title"><b>Volume</b></label>
                                                 <div class="controls">
                                                     <input type="text" id="Title" name="Title" placeholder="Volumes" class="span8" required value="<?php echo $vol?>">
                                                 </div>
                                             </div>
                                             <div class="control-group">
                                                 <label class="control-label" for="Availability"><b>Number of Copies</b></label>
                                                 <div class="controls">
                                                     <input type="text" id="availability" name="availability" placeholder="Number of Copies" class="span8" required value="<?php echo $avail?>">
                                                 </div >
                                             </div>
                                             <div class="control-group">
                                                 <label class="control-label" for="Author"><b>Author</b></label>
                                                 <div class="controls">
                                                     <input type="text" id="Author" name="Author" placeholder="Author" class="span8" required value="<?php echo $author?>">
                                                 </div>
                                             </div>
                                             <div class="control-group">
                                                 <label class="control-label" for="ISBN"><b>ISBN</b></label>
                                                 <div class="controls">
                                                     <input type="text" id="ISBN" name="ISBN" placeholder="ISBN" class="span8" required value="<?php echo $isbn?>">
                                                 </div >
                                             </div>
                                              <div class="control-group">
                                                 <label class="control-label" for="status"><b>Book Status:</b></label>
                                                 <div class="controls">
                                                    
                                                   <select name = "status" tabindex="1" value="SC" data-placeholder="Select Status" class="span6">
                                                       <!--   <option value="<?php echo $status?>"><?php echo $status ?> </option> -->
                                                       <option value=""></option>
     
                                                         <option value="GOOD" <?php echo($row['Status']=="GOOD")? 'selected':''; ?>>GOOD</option>
     
                                                         <option value="DAMAGE" <?php echo($row['Status']=="DAMAGE")? 'selected':''; ?>>DAMAGE</option>
     
                                                         <option value="DILAPIDATED" <?php echo($row['Status']=="DILAPIDATED")? 'selected':''; ?>>DILAPIDATED</option>
                                                         
                                                     </select>
                                                 </div>
                                         </div>
     
     
                                             <div class="control-group">
                                                 <div class="controls">
                                                     <button type="submit" name="submit"class="btn">Update Details</button>
                                                 </div>
                                             </div>
     
                                            
                                         </form> 
                            </div>


                        </div>
                    </div>
                    <!-- /.card -->

                </div>



            </div>
        </div>
        <!--/.wrapper-->

        <?php require("scripts.php") ?>

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


<?php } else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>