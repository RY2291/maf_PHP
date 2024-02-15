<?php

namespace db;

use db\DataSource;
use model\TopicModel;
use model\UserModel;

class TopicQuery
{
    public static function fetchByUserId($user)
    {

        if (!$user->isValidateId()) {
            return false;
        }

        $db = new DataSource;
        $sql = 'select * from pollapp.topics where user_id = :id and del_flg = 0 order by id desc';
        $result = $db->select($sql, [
            ':id' => $user->id
        ], DataSource::CLS, TopicModel::class);

        return $result;
    }

    public static function fetchByPublishedTopic()
    {
        $db = new DataSource;
        $sql = 'SELECT 
                t.*
            ,   u.nickname
            FROM topics t
            INNER JOIN users u ON
                t.user_id = u.id
            WHERE t.del_flg = 0
                AND u.del_flg = 0
                AND t.published = 1
            ORDER BY t.id desc
            ';
        $result = $db->select($sql, [], DataSource::CLS, TopicModel::class);
        return $result;
    }

    public static function fetchById($topic)
    {
        $db = new DataSource;
        $sql = 'SELECT 
                t.*
            ,   u.nickname
            FROM pollapp.topics t
            INNER JOIN pollapp.users u ON
                t.user_id = u.id
            WHERE
                t.id = :id
            AND t.del_flg = 0
            AND u.del_flg = 0
            ORDER BY t.id desc
            ';
        $result = $db->selectOne($sql, [
            ':id' => $topic->id
        ], DataSource::CLS, TopicModel::class);
        return $result;
    }

    public static function incrementViewCount($topic)
    {

        $db = new DataSource;
        $sql = '
          UPDATE topics
          SET views = views + 1
          WHERE id = :id;
    ';
        return $db->execute($sql, [
            ':id' => $topic->id
        ]);
    }

    public static function isUserOwnTopic($topic_id, $user)
    {
        if (!(TopicModel::validateId($topic_id) && $user->isValidateId())) {
            return false;
        }

        $db = new DataSource;
        $sql = 'SELECT 
                count(1)
            FROM pollapp.topics t
            WHERE
                t.id = :topic_id
            AND t.user_id = :user_id
            AND t.del_flg = 0
            ';
        $result = $db->selectOne($sql, [
            ':topic_id' => $topic_id, ':user_id' => $user->id
        ]);

        return !empty($result) && $result['count(1)'] == 1;
    }

    public static function update($topic)
    {
        if (!($topic->isValidateId()
            * $topic->isValidateTitle()
            * $topic->isValidatePublished()
        )) {
            return false;
        }
        $db = new DataSource();
        $sql = 'UPDATE topics
                SET
                    published = :published
                ,   title = :title
                WHERE id = :id
                ';

        return $db->execute($sql, [
            ':published' => $topic->published,
            ':title' => $topic->title,
            ':id' => $topic->id
        ]);
    }

    public static function insert($topic, $user)
    {
        if (!($user->validateId()
            * $topic->isValidateTitle()
            * $topic->isValidatePublished()
        )) {
            return false;
        }

        $db = new DataSource();
        $sql = 'INSERT INTO topics(
                    title
                ,   published
                ,   user_id
                ) VALUES(
                    :title
                ,   :published
                ,   :user_id
                )
                ';

        return $db->execute($sql, [
            ':title' => $topic->title,
            ':published' => $topic->published,
            ':user_id' => $user->id
        ]);
    }

    public static function incrementLikesOrDislikes($comment)
    {
        if (!($comment->isValidTopicId()
            * $comment->isValidAgree()
        )) {
            return false;
        }
        $db = new DataSource();

        if ($comment->agree) {
            $sql = 'UPDATE topics SET likes = likes + 1 WHERE id = :id';
        } else {
            $sql = 'UPDATE topics SET dislikes = dislikes + 1 WHERE id = :id';
        }

        return $db->execute($sql, [
            ':id' => $comment->topic_id
        ]);
    }
}
