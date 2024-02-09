<?php 
namespace controller\topic\create;

use db\TopicQuery;
use lib\Auth;
use lib\Msg;
use model\TopicModel;
use model\UserModel;
use Throwable;

function get()
{
    Auth::requireLogin();
    
    $topic = new TopicModel;
    $topic->id = -1;
    $topic->title = '';
    $topic->published = 1;

    
    \view\topic\edit\index($topic, false);
}

function post(){
    Auth::requireLogin();

    $topic = new TopicModel;
    $topic->id        = getParam('topic_id', null);
    $topic->title     = getParam('title', null);
    $topic->published = getParam('published', null);

    $user = UserModel::getSession();

    try {
        $is_success = TopicQuery::insert($topic, $user);
    } catch (Throwable $e) {
        Msg::push(Msg::DEBUG, $e->getMessage());
        $is_success = false;
    }

    if($is_success){
        Msg::push(Msg::INFO, 'トピックの登録に成功しました');
        redirect('topic/archive');
    } else{
        Msg::push(Msg::ERROR, 'トピックの登録に失敗しました');
        redirect(GO_REFERER);
    }
}