<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kardusitem;

/**
 * KardusitemSearch represents the model behind the search form about `app\models\Kardusitem`.
 */
class KardusitemSearch extends Kardusitem
{
    /**
     * @inheritdoc
     */
         public $tgl_a;
    public $tgl_b;
    public function rules()
    {
        return [
            [['id', 'idkardus', 'iddetail', 'status'], 'integer'],
            [['tanggal','tgl_a','tgl_b'], 'safe'],
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
        $query = Kardusitem::find();

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
            'idkardus' => $this->idkardus,
            'iddetail' => $this->iddetail,
            'status' => $this->status,
            'tanggal' => $this->tanggal,

        ]);

        $query->andFilterWhere(['>=', 'tanggal', $this->tgl_a])
            ->andFilterWhere(['<=', 'date(tanggal)', $this->tgl_b]);
        return $dataProvider;
    }
}
