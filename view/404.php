<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>美团技术学院</title>
    <style>
        span { display:inline-block; width:8px; height:4px; background:#CCC; margin:0 1px;  }
        span.long { width:20px;}
        span:nth-child(5),
        span:nth-child(10) { margin-right:10px; }
        div { margin:200px 0; text-align:center;}
        a { padding:100px; display:inline-block; }
        a:hover { background:#F1F1F1; }
    </style>
</head>
<body>
    <div class="main">
        <a href="/">
            <?php
                for ($i = 0; $i < 15; $i++) {
                    $class = ($i > 3 && $i < 11) ? 'long' : '';
                    echo '<span class='.$class.'></span>';
                }
            ?>
        </a>
    </div>
</body>
</html>
