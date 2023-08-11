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
    public array $tagIdList = [];
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
            'created_at' => 'Сreated from the date',
            'updated_at' => 'Updated At',
            'tagIdList' => 'Tags',
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

    public function addComment(Comment $model)
    {
        $model->approved = 0;
        $model->post_id = $this->id;
        $model->author_id = Yii::$app->user->id;

        return $model->save();
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
        $tagPosts = $this->getTagPosts()->all();
        foreach ($tagPosts as $tagPost) {
            array_push($tags, $tagPost->getTag()->one());
        }
        return $tags;
    }

    public function getTagsWeight()
    {

    }

    public function setTags(): bool
    {
        $currentTags = $this->getTags();
        foreach ($currentTags as $currTag) {
            if (!in_array($currTag->id, $this->tagIdList)) {
                TagPost::findOne(['id' => $currTag->id])->delete();
            }
        }

        foreach ($this->tagIdList as $tagId) {
            if (!in_array($tagId, $currentTags)) {
                $tagPost = new TagPost();
                $tagPost->tag_id = $tagId;
                $tagPost->post_id = $this->id;
                if(!$tagPost->save()) {
                    return false;
                }
            }
        }
        return true;
    }

    public function getStatus()
    {
        return $this->hasOne(Lookup::class, ['id' => 'status']);
    }

    public function getEncodedText(): string
    {
        return yii\helpers\Html::encode($this->content);
    }
}
