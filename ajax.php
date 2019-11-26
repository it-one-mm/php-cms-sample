<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>JavaScript Ajax GET Demo</title>

</head>

<body>
    <div id="result">
        <p>Content of the result DIV box will be replaced by the server response</p>
    </div>
    <div>
        <input type="text" id="firstName" placeholder="First Name...">
    </div>
    <div>
        <input type="text" id="lastName" placeholder="Last Name...">
    </div>
    <button type="button" onclick="displayFullName()">Display Full Name</button>

    <script src="js/jquery.js"></script>
    
    <script>
        
        function displayFullName() {
            // Creating the XMLHttpRequest object
            const fname = $('#firstName').val();
            const lname = $('#lastName').val();

            $.ajax({
                url: 'greet.php',
                type: 'POST',
                data: {
                    fname,
                    lname
                },
                success: function(result) {
                    $('#result > p').html(result);
                }
            });
        }

    </script>
</body>

</html>