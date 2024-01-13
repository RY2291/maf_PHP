<?php 
namespace view\topic\archive;

function index($topics)
{?>
    <h1 class="h2 mb-3">過去の投稿</h1>
        <ul class="container">
            <?php 
            foreach ($topics as $topic) {
                $url = getUrl('topic/edit?topic_id=' . $topic->id);
                \partials\topic_list_item($topic, $url, true);
            }
            ?>
        </ul>
    </h1>


    <?php 
}
?>