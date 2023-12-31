<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property int $id
 * @property string $content
 * @property int|null $approved
 * @property string $created_at
 * @property int $post_id
 * @property int $author_id
 *
 * @property User $author
 * @property Post $post
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'tbl_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['content', 'post_id', 'author_id', 'approved'], 'required'],
            [['post_id', 'author_id', 'approved'], 'integer'],
            [['content'], 'string', 'max' => 256],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::class, 'targetAttribute' => ['post_id' => 'id']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'content' => 'Your comment:',
            'approved' => 'Approved',
            'created_at' => 'Created At',
            'post_id' => 'Post',
            'author_id' => 'Author ID',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    public function getAuthorEmail()
    {
        return $this->author->email;
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

    public function getPostTitle()
    {
        return $this->post->title;
    }

    public function getApprovedValue()
    {
        return $this->approved ? 'yes' : 'no';
    }
}
