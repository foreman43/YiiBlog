<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_post".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property Lookup $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Comment[] $tblComments
 * @property TagPost[] $tblTagPosts
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'tbl_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string', 'min' => 25],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Lookup::class, 'targetAttribute' => ['status' => 'id']],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[TblComments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    /**
     * Gets query for [[TblTagPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTagPosts()
    {
        return $this->hasMany(TagPost::class, ['post_id' => 'id']);
    }

    public function getTags()
    {
        $tags = [];
        $tagposts = $this->getTagPosts();
        foreach ($tagposts as $tagpost) {
            array_push($tags, $tagpost->getTag());
        }
    }

    public function getStatusLabel()
    {
        return $this->hasOne(Lookup::class, ['id' => 'status']);
    }
}
