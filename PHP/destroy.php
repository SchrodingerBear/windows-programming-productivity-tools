<?php
session_unset();
session_destroy();
echo "All session data deleted.<br>";

foreach ($_COOKIE as $key => $value) {
    setcookie($key, '', time() - 3600, '/');
    echo "Cookie '$key' deleted.<br>";
}
?>

<script>
    function deleteLocalStorage() {
        localStorage.clear();
        console.log("All localStorage data deleted.");
    }
    deleteLocalStorage();

    function deleteSessionStorage() {
        sessionStorage.clear();
        console.log("All sessionStorage data deleted.");
    }
    deleteSessionStorage();
</script>