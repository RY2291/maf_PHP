<?php

namespace view\topic\detail;

function index($topic, $comments)
{
    \partials\topic_header_item($topic, true);
?>
    <ul class="list-unstyled">
        <?php foreach($comments as $comment) : ?>
            <?php $agree_label = $comment->agree ? '賛成' : '反対' ?>
            <?php $agree_class = $comment->agree ? 'badge-success' : 'badge-danger' ?>
            <li class="bg-white shadow-sm mb-3 rounded p-3">
                <h2 class="h4 mb-2">
                    <span class="badge <?php echo $agree_class ?> mr-1 align-bottom"><?php echo $agree_label ?></span>
                    <a class="text-body" href=""><?php echo $comment->body ?></a>
                </h2>
                <span>Commented by <?php echo $comment->nickname ?></span>
            </li>
        <?php endforeach ; ?>
    </ul>
<?php } ?>