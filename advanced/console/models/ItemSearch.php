<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Item;

/**
 * ItemSearch represents the model behind the search form about `app\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */
    public $tgl_a;
    public $tgl_b;
    public $numlimit;
    public function rules()
    {
        return [
            [['id','numlimit'], 'integer'],
            [['tgl_a','tgl_b','edit_date','tanggal', 'var_1','gagal','hitung','ulang','var_4','var_5','var_2', 'biner', 'var_3', 'status'], 'safe'],
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
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'defaultOrder' => [
                'tanggal' => SORT_DESC
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'edit_date' => $this->edit_date,
            'hitung' => $this->hitung,
            'gagal' => $this->gagal,
            'ulang' => $this->ulang,
        ]);

        $query->andFilterWhere(['like', 'var_1', $this->var_1])
            ->andFilterWhere(['>=', 'tanggal', $this->tgl_a])
            ->andFilterWhere(['<=', 'date(tanggal)', $this->tgl_b])
            ->andFilterWhere(['like', 'var_2', $this->var_2])
            ->andFilterWhere(['like', 'biner', $this->biner])
            ->andFilterWhere(['like', 'var_3', $this->var_3])
            ->andFilterWhere(['like', 'var_4', $this->var_4])
            ->andFilterWhere(['like', 'var_5', $this->var_5])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
