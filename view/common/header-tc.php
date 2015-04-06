<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
    <meta charset="utf-8" />
    <?php
        $title = isset($page_title) ? $page_title . ' - 美团技术委员会' : '美团技术委员会';
        echo '<title>' . $title . '</title>';
    ?>
    <link rel="stylesheet" href="/static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/static/css/prt_base.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <script type="text/javascript"  src="/static/js/zepto.min.js"></script>
    <script type="text/javascript"  src="/static/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript"  src="/static/js/prt_base.js"></script>
    <script type="text/javascript"  src="/static/js/chart.min.js"></script>
    <script type="text/javascript" src="/static/js/jquery.dragsort.js"></script>
</head>
<body id="<?php echo isset($page_name) ? $page_name : ''; ?>">
<header class="common-header">美团技术委员会
    <?php 
        $count = ReviewHelper::getCountOfTodo(self::$loginUser);
        $DATES = ReviewHelper::getLimitDates();
        echo '<a class="mine" href="/review/mine">我的申请</a>';
        if ($count > 0) {
            echo '<a href="/review/manage">待处理<span>' . $count . '</span>项</a>';
        } else {
            echo '<a href="/review/manage">待处理事项</a>';
        }
    ?>
</header>
