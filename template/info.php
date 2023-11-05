<?php
$sqlInfo = "SELECT * FROM website LIMIT 1";

$resultInfo = $server->query($sqlInfo);
$rowInfo = mysqli_fetch_assoc($resultInfo);
?>

<title>
    <?php echo $rowInfo['title']; ?>
  </title>
  <meta charset="utf-8" />
  <meta
  name="viewport"
  content="width=device-width, initial-scale=1, shrink-to-fit=no"
  />
  <meta
  name="keywords"
  content="<?php echo $rowInfo['keyword']; ?>"
  />
  <meta
  name="description"
  content="<?php echo $rowInfo['keyword']; ?>"
  />
  <meta name="author" content="SLOTGAME66" />
  <link rel="icon" type="image/ico" href=<?php echo "manager/".$rowInfo['icon'].""; ?> />
<!--   <link rel="stylesheet" type="text/css" href="template/loading.css" /> -->
  <!--Cache-->
  <meta
  http-equiv="Cache-Control"
  content="no-cache, no-store, must-revalidate"
  />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <!-- Facebook OG -->
  <meta property="og:url" content="<?php echo $rowInfo['domain']; ?>" />
  <meta property="og:type" content="game" />
  <meta property="og:title" content="<?php echo $rowInfo['title']; ?>" />
  <meta property="og:description" content="<?php echo $rowInfo['keyword']; ?>" />
  <meta property="og:image" content="" />
  <!-- <link rel="icon" href="assets/img/favicons/favicon.ico" /> -->
  <meta
  name="csrf-token"
  content="53UNUMKCNPwjqQDn1KLwcSWbptIzrpdwFoogqTKG"
  />
  