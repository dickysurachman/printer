<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Itemkardus;

/**
 * ItemkardusSearch represents the model behind the search form about `app\models\Itemkardus`.
 */
class ItemkardusSearch extends Itemkardus
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
            [['id', 'ulang', 'hitung', 'gagal','numlimit'], 'integer'],
            [['tgl_a','tgl_b','tanggal', 'var_1', 'var_2', 'biner', 'var_3', 'status', 'var_4', 'var_5', 'var_6', 'var_7', 'var_8', 'var_9', 'var_10'], 'safe'],
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
        $query = Itemkardus::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'ulang' => $this->ulang,
            'hitung' => $this->hitung,
            'gagal' => $this->gagal,
        ]);

        $query->andFilterWhere(['like', 'var_1', $this->var_1])
            ->andFilterWhere(['like', 'var_2', $this->var_2])
             ->andFilterWhere(['>=', 'tanggal', $this->tgl_a])
            ->andFilterWhere(['<=', 'date(tanggal)', $this->tgl_b])
            ->andFilterWhere(['like', 'biner', $this->biner])
            ->andFilterWhere(['like', 'var_3', $this->var_3])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'var_4', $this->var_4])
            ->andFilterWhere(['like', 'var_5', $this->var_5])
            ->andFilterWhere(['like', 'var_6', $this->var_6])
            ->andFilterWhere(['like', 'var_7', $this->var_7])
            ->andFilterWhere(['like', 'var_8', $this->var_8])
            ->andFilterWhere(['like', 'var_9', $this->var_9])
            ->andFilterWhere(['like', 'var_10', $this->var_10]);

        return $dataProvider;
    }
}
