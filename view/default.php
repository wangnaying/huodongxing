<?php 
    $page_name = 'courses';
    $page_title = "技术分享";
    include_once(TPL_PATH . '../common/header.php'); 
?>
<div id="header-wrap">
<div id="header-body">
    <h2>技术分享</h2>
    <p>不限技术主题，人人都是讲师</p>
</div>
</div>
<div id="bdw">
<div id="bd" class="item-home">
<?php
    if (!empty($sysMsg)) {
        NewBambooHelper::blkSysMsg($sysMsg);
    }
    foreach ($shareList as $share) {
        $date = date('Y年m月d日', $share->start);
        $lecturer = new MitUserModel($share->lecturer);
        $avatar = '<img src="'. NewBambooHelper::getAvatarByLogin($lecturer->login) . '" />';
        $lecturerText = '<a href="/user/default/'.$lecturer->login.'">' . $lecturer->name . '</a>主讲';
        $link = '/share/default/' . $share->id;
        $plan = '<p class="exchange-date">' . date('Y-m-d H:i', $share->start). ' ' . htmlspecialchars($share->meetingroom) . '</p>';
        if (TS < $share->start) {
            $view = '<a class="btn-view" href="'.$link.'">我有兴趣</a>';
        } elseif (TS < $share->end) {
            $view = '<a class="btn-view" href="'.$link.'">进行中...</a>';
        } else {
            $plan = '';
            $view = '<a class="btn-expired" href="'.$link.'">已经结束</a>';
        }
        if (isset($share->slide) && !empty($share->slide)) {
            $slide = '<a class="tag-slide" href="'.$link.'">PDF</a>';
        } else {
            $slide = '';
        }
        if (empty($share->description)) {
            $desc = '讲师太懒还没有写内容简介...';
        } else {
            $desc = Core::safeSubstr(htmlspecialchars($share->description) , 0, 80) . '...';
        }
        $lecturerOrg = UserHelper::getUserOrg($lecturer);
        $avatar = '<img style="width:24px;border-radius:12px; vertical-align:-6px; margin:0 8px 0 0;" src="'.NewBambooHelper::getAvatarByLogin($lecturer->login).'" />';
        $tags = TagsController::getTagsForShare($share->id);
        $tagHtml = '';
        if (count($tags) > 0) {
            $tagHtml = '<ul>';
            foreach ($tags as $tag) {
                $tagHtml .= '<li><a href="/share/tag/'. $tag->id.'">' . htmlspecialchars($tag->name) . '</a></li>';
            }
            $tagHtml .= '</ul>';
        }
        echo '
            <article class="item-card">
                <header>
                    <p class="exchange-guest"><strong>' .$lecturer->name. '</strong> @'.$lecturerOrg.'</p>
                    <h3><a href="/share/default/'.$share->id .'">'. htmlspecialchars($share->title) . '</a></h3>
                    '.$plan.$slide.'
                </header>
                <section>
                    <p class="exchange-intro">'.$avatar.$desc.'</p>
                </section>
                <footer>
                    <p class="lecturer">'.$view .'</p>
                    '.$tagHtml.'
                </footer>
            </article>
        ';
    }
       
        echo '<a style="display:block; margin:0px auto; width:50%" class="btn btn-large" href="/share/list">所有技术分享</a>';
?>
</div>
</div>
<?php include_once(TPL_PATH . 'common/footer.php'); ?>
