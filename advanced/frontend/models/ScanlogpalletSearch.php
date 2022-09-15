<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Scanlogpallet;

/**
 * ScanlogpalletSearch represents the model behind the search form about `app\models\Scanlogpallet`.
 */
class ScanlogpalletSearch extends Scanlogpallet
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'machine', 'process', 'id_job', 'id_item'], 'integer'],
            [['tanggal', 'scan', 'dbs', 'stat'], 'safe'],
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
        $query = Scanlogpallet::find();

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
            'status' => $this->status,
            'machine' => $this->machine,
            'process' => $this->process,
            'id_job' => $this->id_job,
            'id_item' => $this->id_item,
        ]);

        $query->andFilterWhere(['like', 'scan', $this->scan])
            ->andFilterWhere(['like', 'dbs', $this->dbs])
            ->andFilterWhere(['like', 'stat', $this->stat]);

        return $dataProvider;
    }
}
