<?php 
    $page_name = "share-list";
    $page_title = "技术分享";
    $techshow = 475;
    include_once(TPL_PATH . 'common/header.php'); 
?>
<div id="header-wrap">
<div id="header-body">
    <?php
        if (isset($curTag)) {
            if ($curTag->id == $techshow) {
                $tag_title = 'Tech Show';
            } else {
                $tag_title = '标签：'.htmlspecialchars($curTag->name);
            }
        } else {
            $tag_title = '按标签查看';
        }
        echo '<h2>' . $tag_title . '</h2>';
        if ($curTag->id == $techshow) {
            echo '<p>共享 共建 共生 共赢</p>';
            echo '2015年1月30日周五 总部4F北区南京厅';
        }
    ?>
</div>
</div>
<div id="bdw">
<div id="bd" class="clearfix">
<?php
    if ($curTag->id != $techshow) {
    echo '<div class="filter">';
    echo '<div class="filter-item filter-item-tag">';
    echo '<ul>';
    foreach ($tagList as $res) {
        $tag = new TagsModel($res['tagid']);
        if($res['count'] <=2) {
            $class = ' small';
        } elseif ($res['count'] <=5) {
            $class = ' normal';
        } else {
            $class = ' large';
        }
        $cur = '';
        if (isset($curTag) && $tag->id == $curTag->id) {
            $cur = ' current';
        }
        if (!empty($tag->name) && $res['count'] > 1) {
            echo '<li class="tag '.$class. $cur .'"><a class="" href="/share/tag/'.$tag->id.'">'.htmlspecialchars($tag->name).'<span>('.$res['count'].')</span></a></li>';
        }
    }
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    }

    if (count($shareList)) {
        echo '<div class="course-list">';
        echo '<ul>';
        foreach ($shareList as $share) {
            if (TS < $share->start) {
                $str = '即将开始';
                $class = 'comming';
            } elseif ( TS > $share->end) {
                $str = '已结束';
                $class = 'end';
            } else {
                $str = '进行中';
                $class = 'hot';
            }
            $lecturer = new MitUserModel(empty($share->lecturer) ? 99999 : $share->lecturer);
            $avatar = '<img style="width:24px;" src="' . NewBambooHelper::getAvatarByLogin($lecturer->login) . '" />';
            $lecturerText = '<a href="/user/default/'.$lecturer->login.'">' . $lecturer->name . '</a>';
            $lecturerOrg = UserHelper::getUserOrg($lecturer);
            $title = htmlspecialchars($share->title);
            echo '<li class="'.$class.'">';
            echo '<span class="status" style="width:5em; padding:3px 2px;">'.$str.'</span>';
            echo '<a style="width:22em; display:inline-block;" href="/share/default/'.$share->id.'">'.$title.'</a>';
            echo '<span class="date" style="color:#AAA">'.date('Y-m-d H:i', $share->start) . '-'.date('H:i',$share->end) .'</span>';
            echo '<span class="lecturer">'. $avatar . $lecturerText . ' ' . $lecturerOrg . '</span>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

?>
</div>
</div>
<?php include_once(TPL_PATH . 'common/footer.php'); ?>
