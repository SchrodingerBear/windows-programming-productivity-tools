<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage and Cookies</title>
</head>

<body>

    <?php
    // PHP code to display session data
    echo "<h3>Session Data:</h3>";
    foreach ($_SESSION as $key => $value) {
        if (is_array($value)) {
            echo "Session Key: $key, Value: " . json_encode($value) . "<br>";
        } else {
            echo "Session Key: $key, Value: $value <br>";
        }
    }

    // PHP code to display cookies
    echo "<h3>Cookies:</h3>";
    foreach ($_COOKIE as $key => $value) {
        echo "Cookie Key: $key, Value: $value <br>";
    }
    ?>

    <script>
        // JavaScript to display localStorage data
        function displayLocalStorage() {
            document.write("<h3>Local Storage:</h3>");
            for (let i = 0; i < localStorage.length; i++) {
                let key = localStorage.key(i);
                let value = localStorage.getItem(key);
                document.write("LocalStorage Key: " + key + ", Value: " + value + "<br>");
            }
        }

        // JavaScript to display sessionStorage data
        function displaySessionStorage() {
            document.write("<h3>Session Storage:</h3>");
            for (let i = 0; i < sessionStorage.length; i++) {
                let key = sessionStorage.key(i);
                let value = sessionStorage.getItem(key);
                document.write("SessionStorage Key: " + key + ", Value: " + value + "<br>");
            }
        }

        // Display localStorage and sessionStorage data
        displayLocalStorage();
        displaySessionStorage();
    </script>

</body>

</html>