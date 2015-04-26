<?php
    $page_name = "course-edit";
    $page_title = '我要分享';
    include_once(TPL_PATH . 'common/header.php');
?>
<div id="bdw">
<div id="bd">
<?php

    echo '<h2 class="page-title">我要分享</h2>';
    if(isset($sysMsg)) {
        echo '<div class="alert alert-danger">';
        foreach($sysMsg as $msg) {
            echo '<li>' . $msg . '</li>';
        }
        echo '</div>';
    }
?>
<form class="form-horizontal" role="form" method="post">
    <div class="form-group">
        <label class="">分享主题</label>
        <div class="">
            <input type="text" class="input-title-user" value="<?php echo $courseTitle ?>" name="title" placeholder=""/>
            <p>分享/课程标题不得大于30个字符</p>
        </div>
    </div>
    <div class="form-group">
        <label class="">分享人</label>
        <div class="">
            <input type="text" name="lecturer" value="<?php echo self::$loginUser->login ?>" />
            <p>分享人的mis用户名，<strong>不包含</strong>"@meituan.com"。如果把分享人设置为其他人，你将不能进行编辑操作。</p>
        </div>
    </div>
    <div class="form-group">
        <label class="">时间</label>
        <div class="">
            <input class="" type="date" name="date" value="<?php echo $date ?>" />
            <input class="input-small" type="text" placeholder="格式 17:00" name="start" value="<?php echo $start ?>" />
            <input class="input-small" type="text" placeholder="格式 17:00" name="end" value="<?php echo $end ?>" />
            <p>抱歉，日期选择还来不及做，您受累：）</p>
        </div>
    </div>
    <div class="form-group">
        <label class="">地点</label>
        <div class="">
            <input class="" type="text" name="meetingroom" value="<?php echo $meetingroom ?>" placeholder=""/>
            <p>请填写会议室的中文全名。如：广州厅</p>
        </div>
    </div>
    <?php
        $checked = $apply == 1 ? 'checked' : '';
        echo '
            <div class="form-group">
                <label class="">人数上限</label>
                <div class="input-check">
                    <input type="number" name="limit" value="'.$limit.'" />
                    <input id="input-apply" type="checkbox" '. $checked .'  name="apply" />
                    <label for="input-apply">接受报名</label>
                    <p>勾选接受报名后，所有用户均可报名参加</p>
                </div>
            </div>
        ';
    ?>
    <div class="form-group">
        <label class="">内容简介</label>
        <div class="">
            <textarea name="description"><?php echo $description ?></textarea>
            <p>请介绍课程的背景，面向的用户以及课程内容</p>
        </div>
    </div>
    <div class="form-group">
        <label class="">WIKI/BLOG</label>
        <div class="">
            <input type="text" class="input-title-user" name="wiki" value="<?php echo $wiki?>" placeholder=""/>
            <p>目前系统不支持内容管理，建议在WIKI中新建这节课程的页面并上传PPT</p>
        </div>
    </div>
    <div class="form-group">
        <label class="">标签</label>
        <div class="">
            <input class="" name="tag" type="text" value="<?php echo $tag?>" />
            <p>请使用逗号分隔，最多填写3个标签</p>
        </div>
    </div>
    <div class="form-group">
        <label class=""></label>
        <div class="">
            <input type="submit" class="btn btn-large" value="提交">
        </div>
    </div>
</form>
</div>
</div>
<?php include_once(TPL_PATH . 'common/footer.php'); ?>
