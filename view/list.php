<?php 
    $page_name = "share-list";
    $page_title = "技术分享";
    include_once(TPL_PATH . 'common/header.php'); 
?>
<div id="header-wrap">
<div id="header-body">
    <?php
        echo '<h2>' . $sub_title . '</h2>';
    ?>
</div>
</div>
<div id="bdw">
<div id="bd" class="clearfix">
<?php
    echo '<div class="filter">';
    foreach ($filter as $key => $res) {
        if($key == 'dep') {
            echo '<div class="filter-item">';
            echo '<h4>按部门</h4>';
            echo '<ul>';
            foreach ($res as $dep) {
                if ($dep > 0) {
                $current = ($currType == 'dep' && $currValue == $dep) ? 'current' : '';
                echo '<li class="'.$current.'"><a href="/share/list?dep='.$dep.'">' . NewBambooHelper::getOrgNameByOrgId($dep) . '</a></li>';
                }
            }
            echo '</ul>';
            echo '</div>';
        }
        if ($key == 'org') {
            echo '<div class="filter-item">';
            echo '<h4>按团队</h4>';
            echo '<ul>';
            foreach ($res as $dep) {
                if ($dep> 0) {
                $current = ($currType == 'org' && $currValue == $dep) ? 'current' : '';
                echo '<li class="'.$current.'"><a href="/share/list?org='.$dep.'">' . NewBambooHelper::getOrgNameByOrgId($dep) . '</a></li>';
                }
            }
            echo '</ul>';
            echo '</div>';
        }
        if ($key == 'year') {
            echo '<div class="filter-item">';
            echo '<h4>按年份</h4>';
            echo '<ul>';
            foreach($res as $year) {
                $current = ($currType == 'year' && $currValue == $year) ? 'current' : '';
                echo '<li class="'.$current.'"><a class="" href="/share/list?year='.$year.'">'.$year.'</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }
    echo '<div class="filter-item">';
    echo '<h4>按标签</h4>';
    echo '<ul>';
    foreach ($tagList as $tag ) {
        echo '<li class="tag"><a class="" href="/share/tag/'.$tag['obj']->id.'">'.htmlspecialchars($tag['obj']->name).'<span>('.$tag['count'].')</span></a></li>';
    }
    echo '<li class="tag"><a class="" href="/share/tag">更多标签...</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';

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
            $mark = isset($share->slide) && !empty($share->slide) ? '<mark class="flag-pdf">PDF</mark>' : '';
            echo '<li class="'.$class.'">';
            echo '<span class="status">'.$str.'</span>';
            echo '<a href="/share/default/'.$share->id.'">'.htmlspecialchars(trim($share->title)).$mark.'</a>';
            echo '<span class="date"> - '.date('Y-m-d', $share->start) . '</span>';
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
