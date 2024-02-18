<?php 
namespace controller\topic\edit;

use db\TopicQuery;
use lib\Auth;
use lib\Msg;
use model\TopicModel;
use model\UserModel;
use Throwable;

function get()
{
    Auth::requireLogin();
    
    $topic = TopicModel::getSessionAndFlush();

    if(!empty($topic)){
        \view\topic\edit\index($topic, true);
        return;
    }
    
    $topic = new TopicModel;
    $topic->id = getParam('topic_id', null, false);
    
    $user = UserModel::getSession();
    Auth::requirePermission($topic->id, $user);
    
    $fetchedTopic = TopicQuery::fetchById($topic);
    \view\topic\edit\index($fetchedTopic, true);
    
}

function post(){
    Auth::requireLogin();

    $topic = new TopicModel;
    $topic->id        = getParam('topic_id', null);
    $topic->title     = getParam('title', null);
    $topic->published = getParam('published', null);

    $user = UserModel::getSession();
    Auth::requirePermission($topic->id, $user);

    try {
        $is_success = TopicQuery::update($topic);
    } catch (Throwable $e) {
        Msg::push(Msg::DEBUG, $e->getMessage());
        $is_success = false;
    }

    if($is_success){
        Msg::push(Msg::INFO, 'トピックの更新に成功しました');
        redirect('topic/archive');
    } else{
        Msg::push(Msg::ERROR, 'トピックの更新に失敗しました');
        TopicModel::setSession($topic);
        redirect(GO_REFERER);
    }
}