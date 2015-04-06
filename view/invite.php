<?php
    $page_name = "upload";
    $page_title= '邀请小伙伴';
    include_once(TPL_PATH . 'common/header.php');
    $lecturer = new MitUserModel($share->lecturer);
    $lecturerOrg = UserHelper::getUserOrg($lecturer);
    $orgText = UserHelper::getUserOrg(self::$loginUser);
?>
<div id="header-wrap">
<div id="header-body">
    <h2><a href="/share/default/<?php echo $share->id?>"><?php echo $share->title ?></a></h2>
    <p><?php echo $lecturer->name . '@'. $lecturerOrg ?></p>
</div>
</div>
<div id="bdw">
<div id="bd" class="clearfix">
<div class="new-form-box">
    <header>
        <h2>邀请小伙伴</h2>
        <a class="new-form-skip" href="/share/default/<?php echo $share->id ?>">跳过这一步&raquo;</a>
    </header>
    <?php
        echo '
            <form class="add-user" method="post">
                <input type="hidden" name="courseid" value="' . $share->id . '"/>
                <ul class="new-form-tips">
                    <li>填写mis用户名或邮件地址，如有多个使用逗号分隔</li>
                    <li>点击邀请我的小伙伴，可以批量邀请'.$orgText.'所有同学</li>
                </ul>
                <textarea class="text" tabindex="1" name="invite" id="invite-login" placeholder="填写mis用户名或邮件地址，如有多个请使用逗号分隔"></textarea>
                <div class="new-form-submit">
                    <input tabindex="2" type="submit" class="btn btn-large btn-danger" value="邀请" />
                    <a href="###" title="aaa" id="invite-team" class="btn btn-large">邀请我的小伙伴</a>
                </div>
            </form>
        ';
    ?>
</div>

<div class="new-form-box invite-box" style="margin:20px 0;">
    <?php
    echo '<h3>已邀请('.count($inviteList).')</h3>';
    echo '<ul>';
        foreach ($inviteList as $key => $rel) {
            $user = new MitUserModel($rel->userid);
            $oper = new MitUserModel($rel->operid);

            $org = UserHelper::getUserOrg($user);
            echo '
                <li>
                    <span class="user"><a href="/user/default/' . $user->login . '"><img src="' . NewBambooHelper::getAvatarByLogin($user->login) . '">' . $user->name. '</a></span>
                    <span class="org">' .$org . '</span>
                    <span class="oper">' . $oper->name . '邀请于'.date('Y-m-d H:i', $rel->modtime). '</span>
                </li>
            ';
        }
        echo '</ul>';
        echo '<h3>已报名('.count($applyList).')</h3>';
        echo '<ul>';
        foreach ($applyList as $res) {
            $user = new MitUserModel($res->userid);
            $org = UserHelper::getUserOrg($user);
            echo '
                <li>
                    <span class="user"><a href="/user/default/' . $user->id. '"><img src="' . NewBambooHelper::getAvatarByLogin($user->login) . '">' . $user->name . '</a></span>
                    <span class="org">'.$org.'</span>
                    <span class="oper">'. date('Y-m-d H:i', $res->modtime) . '报名</span>
                </li>
            ';
        }
        echo '</ul>';
    ?>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
    MIT.share.invite(<?php echo self::$loginUser->id ?>);
});
</script>
<?php include_once(TPL_PATH . 'common/footer.php'); ?>
