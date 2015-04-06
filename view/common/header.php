<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
    <meta charset="utf-8" />
    <?php
        $title = isset($page_title) ? $page_title . ' - 美团技术学院' : '美团技术学院';
        echo '<title>' . $title . '</title>';
    ?>
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/css/base.css?v=4">
    <script type="text/javascript" src="../static/js/zepto.min.js"></script>
    <script type="text/javascript" src="../static/js/mit_base.js"></script>
    <script type="text/javascript" src="../static/js/pdf.js"></script>
    <link rel="icon" href="/favicon.ico?v=2" type="image/x-icon">
</head>
<body id="<?php echo isset($page_name) ? $page_name : ''; ?>">
<header id="hdw">
    <div id="hd">
        <h1><a href="http://<?php echo HTTP_HOST ?>/">首经贸活动行</a></h1>
        <nav>
        </nav>
        <div class="user">
            <a href="/mine"><?php echo self::$loginUser->name; ?></a>
            <a href="/account/logout">退出</a>
            <a class="btn btn-danger" href="/share/add">我要分享</a>
        </div>
    </div>
</header>
