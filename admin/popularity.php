<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Genre Recommendations</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: 'http://127.0.0.1:5000/test',  // Make sure the URL is correct
                type: 'GET',
                success: function (response) {
                    console.log(response);
                    displayGenres(response);
                },
                error: function (xhr, status, error) {
                    console.log('Error:', xhr.responseText);
                }
            });

            function displayGenres(data) {
                for (const genre in data) {
                    let books = data[genre];
                    let content = `<h3>${genre}</h3><ul>`;
                    books.forEach(book => {
                        content += `<li>${book.title} by ${book.author}</li>`;
                    });
                    content += '</ul>';
                    $('#genres').append(content);
                }
            }
        });
    </script>
</head>

<body>
    <div id="genres"></div>
</body>

</html>