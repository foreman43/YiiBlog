<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostSearch represents the model behind the search form of `app\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['content'], 'string', 'min' => 25],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Lookup::class, 'targetAttribute' => ['status' => 'id']],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // todo: Test filter
        //filter by default don't show post without any tags
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        $tagWhere[] = 'or';
        foreach ($this->tagIdList as $tagId)
        {
            $tagWhere[] = ['tbl_tag_post.tag_id' => $tagId];
        }
        $query->innerJoin('tbl_tag_post', 'tbl_tag_post.post_id = tbl_post.id')
            ->andFilterWhere($tagWhere);

        return $dataProvider;
    }
}
