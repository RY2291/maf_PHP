<?php 
namespace controller\topic\detail;

use db\CommentQuery;
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
    
    $fetchedTopic = TopicQuery::fetchById($topic);    
    $comments = CommentQuery::fetchByTopicId($topic);

    if(!$fetchedTopic){
        Msg::push(Msg::ERROR, 'トピックが見つかりません');
        redirect('404');
    }

    \view\topic\detail\index($fetchedTopic, $comments);
}