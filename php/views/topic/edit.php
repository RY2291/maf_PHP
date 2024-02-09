<?php 
namespace view\topic\edit;

function index($topic)
{?>
    <h1 class="h2 mb-3">トピック作成</h1>
        <div class="bg-white p-4 shadow-sm mx-auto rounded">
            <form action="<?php echo CURRENT_URI ?>" method="post">
                <input type="hidden" name="topic_id" value="<?php echo $topic->id ?>">
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" value="<?php echo $topic->title ?>" class="form-control" name="title" id="title">
                </div>
                <div class="form-group">
                    <label for="published">ステータス</label>
                    <select name="published" id="published" class="form-control">
                        <option value="1" <?php echo $topic->published ? 'selected' : '' ?>>公開</option>
                        <option value="0" <?php echo $topic->published ? '' : 'selected' ?>>非公開</option>
                    </select>
                </div>
                <div class="d-flex align-items-center">
                    <div>
                        <input type="submit" value="送信" class="btn btn-primary shadow-sm mr-3">
                    </div>
                    <div>
                        <a href="<?php theUrl('topic/archive') ?>">戻る</a>
                    </div>
                    
                </div>
            </form>
        </div>


<?php } ?>

