<?php

namespace app\modules\interesting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\interesting\models\Interesting;

/**
 * PresscentreSearch represents the model behind the search form about `app\modules\presscentre\models\Presscentre`.
 */
class InterestingSearch extends Interesting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'created_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 150],

        ];
    }

    /**
     * @inheritdoc
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
        $query = Interesting::find();

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
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);
        return $dataProvider;
    }
}
