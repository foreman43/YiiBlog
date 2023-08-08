<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This is the model class for table "tbl_tag_post".
 *
 * @property int $id
 * @property int $post_id
 * @property int $tag_id
 *
 * @property Post $post
 * @property Tag $tag
 */
class TagPost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_tag_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['post_id', 'tag_id'], 'required'],
            [['post_id', 'tag_id'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::class, 'targetAttribute' => ['post_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::class, 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'post_id' => 'Post ID',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::class, ['id' => 'tag_id']);
    }

    public static function getTagsWeight(): array
    {
        $rows = (new \yii\db\Query())
            ->select(['tbl_tag.id', 'tbl_tag.name', 'COUNT(tbl_tag_post.id) AS count'])
            ->from('tbl_tag_post')
            ->innerJoin('tbl_tag', 'tbl_tag.id = tbl_tag_post.tag_id')
            ->groupBy('tbl_tag.name')
            ->all();

        $searchModel = new PostSearch();
        foreach ($rows as $item) {
            $params =  ["PostSearch" => ["tagIdList" => [$item['id']] ]];
            array_unshift($params, 'post/index');
            $weight[$item['name']] = ['weight' => $item['count'], 'url' => Url::to($params)];
        }

        return $weight ?? [];
    }
}
