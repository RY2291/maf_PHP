<?php  
namespace controller\home;

use db\TopicQuery;

function get(){
  $topics = TopicQuery::fetchByPublishedTopic();
  \view\home\index($topics);
};