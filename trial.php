<!-- <!DOCTYPE html>
<html lang="en">
<head> -->
<!-- <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combined Page</title> -->
<!-- Bootstrap CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
<!-- Choices CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<!-- Page Specific Styles -->
<!-- <style>
        .mt-100{margin-top: 100px}
        body{
            background: #00B4DB;
            background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);
            background: linear-gradient(to right, #0083B0, #00B4DB);
            color: #514B64;
            min-height: 100vh;
        }
    </style> -->
<!-- </head>
<body> -->
<!-- <div class="row d-flex justify-content-center mt-100">
    <div class="col-md-6">  -->
<label>Select your Interests<span class="text-danger">*</span></label>
<select id="choices-multiple-remove-button" multiple="multiple"  name="interests[]">
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
<!-- </div>
</div> -->

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<!-- Choices JS -->
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<!-- Page Specific Scripts -->
<script>
$(document).ready(function () {
  var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
    removeItemButton: true,
    maxItemCount: 5,
    searchResultLimit: 5,
    renderChoiceLimit: 5
  });

  // Function to apply custom styles
  function applyCustomStyles() {
    // Specifically target the selected items that are displayed as tags
    $('.choices__list--multiple .choices__item').css({
      'background-color': '#FFC107',
      'color': '#000' // Change text color if needed
    });
  }

  // Apply styles initially
  applyCustomStyles();

  // Set a mutation observer to apply custom styles upon changes
  const observer = new MutationObserver(applyCustomStyles);
  observer.observe(document.getElementById('choices-multiple-remove-button'), {
    childList: true,
    subtree: true
  });

  // Reapply styles periodically in case of external changes
  setInterval(applyCustomStyles, 500);
});
</script>
<!-- </body>
</html> -->


