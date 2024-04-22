<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<label>Select your Interests<span class="text-danger">*</span></label>
<select id="choices-multiple-remove-button" multiple="multiple" name="interests[]">
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

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<!-- Choices JS -->
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

<script>
  $(document).ready(function () {
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
      removeItemButton: true,
      maxItemCount: 5,
      searchResultLimit: 5,
      renderChoiceLimit: 5
    });

    function applyCustomStyles() {
      $('.choices__list--multiple .choices__item').css({
        'background-color': '#FFC107',
        'color': '#000'
    });
  }

  applyCustomStyles();

  const observer = new MutationObserver(applyCustomStyles);
  observer.observe(document.getElementById('choices-multiple-remove-button'), {
    childList: true,
    subtree: true
  });

  setInterval(applyCustomStyles, 500);
});
</script>