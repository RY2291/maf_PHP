<?php 
namespace controller\topic\detail;

use Throwable;
use db\CommentQuery;
use db\DataSource;
use db\TopicQuery;
use lib\Auth;
use lib\Msg;
use model\CommentModel;
use model\TopicModel;
use model\UserModel;


function get()
{
    $topic = new TopicModel;
    $topic->id = getParam('topic_id', null, false);
    
    TopicQuery::incrementViewCount($topic);

    $fetchedTopic = TopicQuery::fetchById($topic);    
    $comments = CommentQuery::fetchByTopicId($topic);

    if(empty($fetchedTopic) || !$fetchedTopic->published){
        Msg::push(Msg::ERROR, 'トピックが見つかりません');
        redirect('404');
    }

    \view\topic\detail\index($fetchedTopic, $comments);
}
function post(){
    Auth::requireLogin();

    $comment = new CommentModel;
    $comment->topic_id = getParam('topic_id', null);
    $comment->agree = getParam('agree', null);
    $comment->body = getParam('body', null);

    $user = UserModel::getSession();

    $comment->user_id = $user->id;

    try {
        $db = new DataSource();
        $db->begin();

        $is_success = TopicQuery::incrementLikesOrDislikes($comment);

        if($is_success && !($comment->body == '')){
            $is_success = CommentQuery::insert($comment);
        }

    } catch (Throwable $e) {
        Msg::push(Msg::DEBUG, $e->getMessage());
        $is_success = false;
    } finally{

        if($is_success){
            $db->commit();
            Msg::push(Msg::INFO, '登録が成功しました');
        } else{
            $db->rollback();
            Msg::push(Msg::ERROR, '登録が失敗しました');
        }
    }

    redirect('topic/detail?topic_id=' . $comment->topic_id);
}