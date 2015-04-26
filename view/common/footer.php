<footer id="ftw">
    <div id="ft">&copy; 2014 美团技术学院 -
    <a href="http://task.sankuai.com/servicedesk/customer/newbamboo/create/improvement">建议/意见/吐槽</a> -
    <a href="/about">关于我们</a> -
    <a href="/lecturer/glory">贡献排行</a> -
    <a href="/help/faq">帮助文档</a>
    <?php
        if (AdminController::isAdmin(self::$loginUser->login)) {
            echo ' - <a href="/admin">管理入口</a>';
            echo ' - <a href="/training/add">创建培训</a>';
        }
    ?>
    </div>
</footer>
</body>
</html>
