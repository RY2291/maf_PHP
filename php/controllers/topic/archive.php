<?php 
namespace controller\topic\archive;

use db\TopicQuery;
use lib\Auth;
use lib\Msg;
use model\UserModel;

function get()
{
    Auth::requireLogin();
    $user = UserModel::getSession();
    $topics = TopicQuery::fetchByUserId($user);

    if($topics === false){
        Msg::push(Msg::ERROR, '再度ログインしてください');
        redirect('login');
    }

    if(count($topics) > 0){
        \view\topic\archive\index($topics);
    } else{
        echo '<div class="alert alert-primary">トピックを投稿してください</div>';
    }
}