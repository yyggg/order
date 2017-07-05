<?php

namespace app\modules\orders\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\orders\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `app\modules\orders\models\Orders`.
 */
class OrdersAtvSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'stime', 'etime', 'created_at'], 'integer'],
            [['patriarch_name','phone', 'product_name', 'payment_type', 'principal'], 'safe'],
            [['money'], 'number'],
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
        $query = Orders::find();

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
            'product_id' => $this->product_id,
            'stime' => $this->stime,
            'etime' => $this->etime,
            'money' => $this->money,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'patriarch_name', $this->patriarch_name])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'principal', $this->principal]);

        return $dataProvider;
    }
}
