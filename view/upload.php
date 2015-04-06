<?php
    $page_name = 'upload';
    $page_title = '上传附件';
    include_once(TPL_PATH . 'common/header.php');
    $lecturer = new MitUserModel($share->lecturer);
    $lecturerOrg = UserHelper::getUserOrg($lecturer);
?>
<div id="header-wrap">
<div id="header-body">
    <h2><?php echo htmlspecialchars($share->title) ?></h2>
    <p><?php echo $lecturer->name . '@'. $lecturerOrg ?></p>
</div>
</div>
<div id="bdw">
<div id="bd">
<?php
    if (!empty($sysMsg)) {
        NewBambooHelper::blkSysMsg($sysMsg);
    }
?>
    <div class="new-form-box">
        <header>
            <h2>上传课件</h2>
            <a class="new-form-skip" href="/share/invite/<?php echo $share->id ?>">跳过这一步&raquo;</a>
        </header>
        <form class="form-horizontal form-upload" role="form" method="post" enctype="multipart/form-data">
            <ul class="new-form-tips">
                <li><strong>仅限上传 20M 以内的 PDF 文件</strong>，请点击按钮选择文件或拖动文件至灰色背景框内</li>
                <li>上传成功后原有文档会被删除</li>
                <li>文件将被重命名为：讲师-分享标题-时间戳.随机字符.pdf</li>
            </ul>
            <input type="file" class="btn-file" name="myfile" />
            <div class="new-form-submit">
                <input type="submit" class="btn btn-large btn-danger" value="上传" />
            </div>
        </form>
    </div>
</div>
</div>
<script>
$(document).ready(function(){
    $('.btn-file').live('change', function(){
    //    $(this).addClass('ready');
    });
});
</script>
<?php include_once(TPL_PATH . 'common/footer.php'); ?>
