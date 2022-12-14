<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Scanlog;

/**
 * ScanlogSearch represents the model behind the search form about `app\models\Scanlog`.
 */
class ScanlogSearch extends Scanlog
{
    /**
     * @inheritdoc
     */
     public $numlimit;
    public $tgl_a;
    public $tgl_b;
    public function rules()
    {
        return [
            [['id', 'status','process','id_job','id_item','numlimit'], 'integer'],
            [['tanggal', 'scan','tgl_a','tgl_b'], 'safe'],
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
        $query = Scanlog::find();

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
            'status' => $this->status,
            'process' => $this->process,
            'id_job' => $this->id_job,
            'id_item' => $this->id_item,
        ]);

        $query->andFilterWhere(['like', 'scan', $this->scan])
            ->andFilterWhere(['>=', 'tanggal', $this->tgl_a])
            ->andFilterWhere(['<=', 'date(tanggal)', $this->tgl_b]);

        return $dataProvider;
    }
}
