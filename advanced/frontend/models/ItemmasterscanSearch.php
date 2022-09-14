<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Itemmasterscan;

/**
 * ItemmasterscanSearch represents the model behind the search form about `app\models\Itemmasterscan`.
 */
class ItemmasterscanSearch extends Itemmasterscan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'shift', 'machine', 'job_id', 'id_line'], 'integer'],
            [['tanggal', 'nama', 'linenm', 'var_1', 'var_2', 'var_3', 'var_4', 'var_5'], 'safe'],
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
        $query = Itemmasterscan::find();

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
            'shift' => $this->shift,
            'machine' => $this->machine,
            'job_id' => $this->job_id,
            'id_line' => $this->id_line,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'linenm', $this->linenm])
            ->andFilterWhere(['like', 'var_1', $this->var_1])
            ->andFilterWhere(['like', 'var_2', $this->var_2])
            ->andFilterWhere(['like', 'var_3', $this->var_3])
            ->andFilterWhere(['like', 'var_4', $this->var_4])
            ->andFilterWhere(['like', 'var_5', $this->var_5]);

        return $dataProvider;
    }
}
