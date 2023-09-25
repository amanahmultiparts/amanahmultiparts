<?php
include '../config.php';

$page_pimpinan = 'dashboard';

if (isset($_COOKIE['login_pimpinan'])) {
    if ($akun_pimpinan == 'false') {
        header("location: " . $url . "system/pimpinan/logout");
    }
} else {
    header("location: " . $url . "pimpinan/login/");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan</title>
    <link rel="icon" href="../assets/icons/<?php echo $logo; ?>" type="image/svg">
    <link rel="stylesheet" href="../assets/css/pimpinan/index.css">
</head>
<body>
    <div class="pimpinan">

        <?php include './partials/menu.php'; ?>
        <div class="content_pimpinan">




        
        </div>

    </div>

</body>

</html>
