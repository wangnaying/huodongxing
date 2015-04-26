<?php
    $page_name = 'course';
    $page_title = htmlspecialchars($share->title);
    $lecturer = new MitUserModel($share->lecturer);
    $lecturerOrg = UserHelper::getUserOrg($lecturer);
        if (strlen($share->wiki) > 7) {
            $url = '<a href="'. htmlspecialchars($share->wiki).'" target="_blank">点击查看</a>'; 
        } else {
            $url = '';
        }
    include_once(TPL_PATH . 'common/header.php');
?>
<?php
    if (!empty($sysMsg)) {
        NewBambooHelper::blkSysMsg($sysMsg);
    }
?>
<div class="path-nav">
    <ul>
        <li><a href="/">首页</a>&raquo;</li>
        <li><a href="/share">技术分享</a>&raquo;</li>
        <li><?php echo htmlspecialchars($share->title)?></li>
    </ul>
</div>
<div id="header-wrap">
<div id="header-body">
    <div class="cover">
        <div class="cover-inner">
            <?php
                echo '<p>' .htmlspecialchars($share->title). '</p>';
                echo '<p class="guest">' . $lecturer->name . ' ( ' . $lecturerOrg . ' )</p>';
            ?>
        </div>
    </div>
    <?php
        $time = date('Y-m-d', $share->start);
        $time .= ' ' . NewBambooHelper::getWeekDay(date('w', $share->start));
        $time .= ' ' . date('H:i', $share->start);
        $oper = new MitUserModel($relation->operid);
        $isApplied = $relation->status == ControllerBusiness::RELATION_APPLY_APPROVE;
        $isInvited = $relation->status == ControllerBusiness::RELATION_INVITED;
        $isExpired = TS > $share->end;
        $isStarted = TS > $share->start;
        $canApply = $share->apply;
        $cond_survey = array('objtype' => ControllerBusiness::MODEL_TYPE_SHARE, 'objid' => $share->id, 'userid' => self::$loginUser->id,);
        $hasSurvey = DBObj::getBlank('SurveyModel')->searchExists($cond_survey);
        $link = '/survey/default?objtype=' . ControllerBusiness::MODEL_TYPE_SHARE. '&objid='.$share->id;
        $action = '';
        $meetingroom = strlen($share->meetingroom) > 0 ? htmlspecialchars($share->meetingroom) : '待定';
        $avatar = '<img style="width:24px;border-radius:2px; margin:0 2px 0 0;" src="'.NewBambooHelper::getAvatarByLogin($lecturer->login).'" />';
        $profileUrl = NewBambooHelper::getProfileUrl($lecturer);

        if ($isExpired) {
            if ($isApplied || $isInvited) {
                if ($hasSurvey) {
                    $action = '<p>你参加过这次分享，谢谢你的反馈。</p>';
                } else {
                    $action = '<p>你参加过这次分享，请<a href="'.$link.'">提供反馈意见</a>给我们。</p>';
                }
            } else {
                $action = '<p>这次技术分享已结束。</p>';
            }
        } else {
            if ($isInvited) {
                $action = '<p>' . $oper->name . '邀请你参加这次分享，请不要迟到。
               <a href="/share/refuseinvite/' . $share->id . '">我不参加</a></p>';
            } elseif ($isApplied) {
                $action = '<p>你已报名，请不要迟到。
               <a href="/share/cancelapply/' . $share->id . '">取消报名</a></p>';
            } else {
                if ($canApply) {
                    if(count($userList) >= $share->limit) {
                        $action = '<p>报名人数已满，请联系讲师确认是否可以旁听</p>';
                    } else {
                        $action = '<a class="apply" href="/share/apply/'.$share->id. '">报名参加</a>';
                    }
                } else {
                    $action = '<p>这次分享不支持报名，如感兴趣请联系' . $lecturer->name .'</p>';
                }
            }
        }
        echo '<div class="infomation">';
        echo '<h2>'. htmlspecialchars($share->title) .'</h2>';
        echo '<p class="guest">讲师：<a href="'.$profileUrl.'">' . $lecturer->name . '</a><span> ( ' . $lecturerOrg .' )</span></p>';
        echo '<p class="date">时间：' . $time . '</p>';
        echo '<p class="meetingroom">地点：' . $meetingroom . RoomAreaController::getArea($meetingroom) . '</p>';
        if ($share->apply) {
            echo '<p class="date">名额：' . $share->limit. '</p>';
        }
        echo '<p>';
        if (!empty($share->slide)) {
            echo '<a target="_blank" href="' . $slideUrl .'" class="btn btn-danger">SLIDE SHOW</a>';
        }
        if (strlen($share->wiki) > 7) {
            echo '<a class="btn " href="'. htmlspecialchars($share->wiki).'" target="_blank">WIKI/PAGE</a>'; 
        }

        echo '</p>';

        echo '<div class="action">'.$action.'</div>';
        echo '</div>';
    ?>
    <?php 
        echo '
            <div class="slide-box">
                <canvas id="slide"></canvas>
                <div class="">
                    <button id="prev" class="btn">上一页</button>
                    <button id="next" class="btn">下一页</button>
                    <span class="pages btn disabled"><span id="page_num"></span>/<span id="page_count"></span></span>
                    <a target="_blank" href="' . $slideUrl .'" class="btn">全屏/下载</a>
                    <button id="hideSlide" class="btn">关闭</button>
                </div>
            </div>
        ';
    ?>
</div>
</div>
<div id="bdw">
<div id="bd" class="clearfix">
<?php
    echo '<div class="main">';
        if (strlen($share->description) > 0) {
            echo '<div class="content-box">';
            echo '<h2>内容介绍</h2>';
            echo '<div class="share-content"> ';
            echo NewbambooHelper::getHrefFromText(nl2br(htmlspecialchars($share->description)) );
            echo ' </div>';
            echo '</div>';
        }

        if (count($tags) > 0) {
            echo '<div class="tags">';
            echo '<h4>标签:</h4>';
            echo '<ul>';
            foreach ($tags as $tag) {
                echo '<li><a href="/share/tag/'. $tag->id.'">' . htmlspecialchars($tag->name) . '</a></li>';
            }
            echo '</ul></div>';
        }
    echo '</div>';
    echo '<aside class="side">';
    NewBambooHelper::blkTraineeList('参加名单', $userList, self::$loginUser);
    echo '</aside>';
    ?>
</div>
</div>
<?php
    $hasAdminPermisson = UserController::hasAdminPermisson(self::$loginUser, $share);
    if ($hasAdminPermisson) {
        $isAdmin  = AdminController::isAdmin(self::$loginUser->login);
        $param = 'objtype='.ControllerBusiness::MODEL_TYPE_SHARE.'&objid='.$share->id;
        echo '<div class="action-bar">';
        echo '<p>';
        echo '<a class="btn" href="/share/upload?'.$param.'">上传PDF</a>';
        echo '<a class="btn" href="/mail/default/?'.$param.'">发邮件</a>';
        //echo '<a class="btn" href="/notice/create/?'.$param.'">发行事历通知</a>';
        if (TS < $share->start) {
            echo '<a class="btn" href="/share/invite/' . $share->id . '">邀请</a>';
        } else {
            echo '<a class="btn" href="/share/invite/' . $share->id . '">补充参加名单</a>';
        }


        if (TS > $share->start) {
            echo '<a class="btn" href="/survey/result?'.$param.'">查看调查结果</a>';
        } else {
            echo '<a class="btn disabled" href="###">查看调查结果</a>';
        }

        echo '<a class="btn" href="/share/edit/' . $share->id . '">编辑</a>';

        if($isAdmin) {
            echo '<a class="btn" href="/share/delete/' . $share->id . '">删除</a>';
        }
        echo '</p>';
        echo '</div>';
    }
?>
<script>
$(document).ready(function(){
    MIT.share.showSlide();
});
</script>
<script>
    //var url = '<?php echo $slideUrl?>';
    var url = '';
    var pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null,
        scale = 0.8,
        canvas = document.getElementById('slide'),
        ctx = canvas.getContext('2d');

    function renderPage(num) {
        pageRendering = true;

        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport(scale);

            canvas.height = viewport.height;
            canvas.width = viewport.width;

            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };

            var renderTask = page.render(renderContext);

            renderTask.promise.then(function () {
                pageRendering = false;
                if (pageNumPending !== null) {
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
            });
        });
        document.getElementById('page_num').textContent = pageNum;
    }

    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    function onPrevPage() {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    }

    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    }

    document.getElementById('prev').addEventListener('click', onPrevPage);
    document.getElementById('next').addEventListener('click', onNextPage);

    PDFJS.getDocument(url).then(function (pdfDoc_) {
        pdfDoc = pdfDoc_;
        document.getElementById('page_count').textContent = pdfDoc.numPages;
        renderPage(pageNum);
    });


</script>
<?php include_once(TPL_PATH . 'common/footer.php'); ?>
