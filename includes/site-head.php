<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/db.php';
?><!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <base href="<?= BASE_PATH ?>/">
  <meta name="title" content="<?= sanitize($pageMeta['title'] ?? 'H&K Services - Construction Bâtiment en France') ?>">
  <meta name="description" content="<?= sanitize($pageMeta['desc'] ?? "Besoin d'une entreprise générale du bâtiment en France ? H&K Services transforme vos idées en projets modernes et durables.") ?>">
  <title><?= sanitize($pageTitle ?? 'H&K Services') ?></title>
  <link rel="preconnect" href="https://fonts.gstatic.com/" />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;family=Teko:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&amp;family=Montserrat:wght@600;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet" />
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/fontawesome-all.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/ebfaecfa0a.js" crossorigin="anonymous"></script>
  <link href="css/owl.css" rel="stylesheet" />
  <link href="css/flaticon.css" rel="stylesheet" />
  <link href="css/linoor-icons-2.css" rel="stylesheet" />
  <link href="css/animate.css" rel="stylesheet" />
  <link href="css/jquery-ui.css" rel="stylesheet" />
  <link href="css/jquery.fancybox.min.css" rel="stylesheet" />
  <link href="css/hover.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/jarallax.css" />
  <link href="css/custom-animate.css" rel="stylesheet" />
  <link href="style.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/rtl.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" id="jssDefault" href="css/colors/color-default.css" />
  <link rel="shortcut icon" href="img/logo png/Logo.png" id="fav-shortcut" type="image/x-icon" />
  <link rel="icon" href="img/logo png/Logo.png" id="fav-icon" type="image/x-icon" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
