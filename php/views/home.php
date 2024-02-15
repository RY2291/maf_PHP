<?php

namespace view\home;

function index($topics)
{
  $topics = escape($topics);
  $topic = array_shift($topics); 
  \partials\topic_header_item($topic, true);
?>
  <ul class="container">
    <?php
    foreach ($topics as $topic) {
      $url = getUrl('topic/detail?topic_id=' . $topic->id);
      \partials\topic_list_item($topic, $url, true);
    }
    ?>
  </ul>
<?php } ?>