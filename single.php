<?php

the_title();
the_content();
/* カスタムフィールドの取得 */
$team = get_post_meta($post->ID, 'team', true);
/* 投稿オブジェクトの取得 */
if ('red' === $team) {
    $post_red = $post; /* 赤（現在） */
    $post_blue = get_adjacent_post(true, '', false); /* 青（現在の次） */
    $post = $post_blue; /* 現在を青に置きかえる */
    $post_green = get_adjacent_post(true, '', false); /* 緑（現在の次：青の次） */
    $post = $post_red; /* 現在を赤に戻す */
} elseif ('blue' === $team) {
    $post_blue = $post; /* 青（現在） */
    $post_red = get_adjacent_post(true, '', true); /* 赤（現在の前） */
    $post_green = get_adjacent_post(true, '', false); /* 緑（現在の次） */
} elseif ('green' === $team) {
    $post_green = $post; /* 緑（現在） */
    $post_blue = get_adjacent_post(true, '', true); /* 青（現在の前） */
    $post = $post_blue; /* 現在を青に置きかえる */
    $post_red = get_adjacent_post(true, '', true); /* 赤（現在の前：青の前） */
    $post = $post_green; /* 現在を緑に戻す */
}
/* コメントオブジェクトの取得 */
$args = [
'author__not_in' => '1', /* 管理者を除く */
'status' => 'approve', /* 承認済み */
'type' => 'comment', /* コメント */
];
$args['post_id'] = $post_red->ID; /* 赤のID */
$comments_red = get_comments($args); /* 赤のコメント */
$args['post_id'] = $post_blue->ID; /* 青のID */
$comments_blue = get_comments($args); /* 青のコメント */
$args['post_id'] = $post_green->ID; /* 緑のID */
$comments_green = get_comments($args); /* 緑のコメント */
/* コメントの表示 */
echo "<p>{$post_red->post_title}（{$post_red->post_date})</p>";
if (empty($comments_red)) {
    echo '<p>コメントなし</p>';
} else {
    echo '<ol>';
    foreach ($comments_red as $comment) {
        if (empty($comment->comment_author)) {
            $comment_author = '匿名';
        } else {
            $comment_author = $comment->comment_author;
        }
        echo '<li>';
        echo "<article id=\"div-comment-{$comment->comment_ID}\">";
        echo "<p>{$comment->comment_content}</p>";
        echo "<p>{$comment_author}</p>";
        echo "<a class=\"comment-reply-link\" href=\"\" data-commentid=\"{$comment->comment_ID}\" data-postid=\"{$comment->comment_post_ID}\" data-belowelement=\"div-comment-{$comment->comment_ID}\" data-respondelement=\"respond\">返信</a>";
        echo '</article>';
        echo '</li>';
    }
    echo '</ol>';
}
echo "<p>{$post_blue->post_title}（{$post_blue->post_date})</p>";
if (empty($comments_blue)) {
    echo '<p>コメントなし</p>';
} else {
    echo '<ol>';
    foreach ($comments_blue as $comment) {
        if (empty($comment->comment_author)) {
            $comment_author = '匿名';
        } else {
            $comment_author = $comment->comment_author;
        }
        echo '<li>';
        echo "<article id=\"div-comment-{$comment->comment_ID}\">";
        echo "<p>{$comment->comment_content}</p>";
        echo "<p>{$comment_author}</p>";
        echo "<a class=\"comment-reply-link\" href=\"\" data-commentid=\"{$comment->comment_ID}\" data-postid=\"{$comment->comment_post_ID}\" data-belowelement=\"div-comment-{$comment->comment_ID}\" data-respondelement=\"respond\">返信</a>";
        echo '</article>';
        echo '</li>';
    }
    echo '</ol>';
}
echo "<p>{$post_green->post_title}（{$post_green->post_date})</p>";
if (empty($comments_green)) {
    echo '<p>コメントなし</p>';
} else {
    echo '<ol>';
    foreach ($comments_green as $comment) {
        if (empty($comment->comment_author)) {
            $comment_author = '匿名';
        } else {
            $comment_author = $comment->comment_author;
        }
        echo '<li>';
        echo "<article id=\"div-comment-{$comment->comment_ID}\">";
        echo "<p>{$comment->comment_content}</p>";
        echo "<p>{$comment_author}</p>";
        echo "<a class=\"comment-reply-link\" href=\"\" data-commentid=\"{$comment->comment_ID}\" data-postid=\"{$comment->comment_post_ID}\" data-belowelement=\"div-comment-{$comment->comment_ID}\" data-respondelement=\"respond\">返信</a>";
        echo '</article>';
        echo '</li>';
    }
    echo '</ol>';
}
comment_form();
?>
<script type='text/javascript' src='http://localhost/wordpress/wp-includes/js/comment-reply.min.js' id='comment-reply-js'></script>
