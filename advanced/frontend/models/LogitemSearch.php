<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Logitem;

/**
 * LogitemSearch represents the model behind the search form about `app\models\Logitem`.
 */
class LogitemSearch extends Logitem
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
            [['id', 'status','machine','numlimit'], 'integer'],
            [['tanggal', 'logbaca','ip','tgl_a','tgl_b'], 'safe'],
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
        $query = Logitem::find();

            
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
            'machine' => $this->machine,
        ]);

        $query->andFilterWhere(['like', 'logbaca', $this->logbaca])
        ->andFilterWhere(['like', 'ip', $this->ip])
        ->andFilterWhere(['>=', 'tanggal', $this->tgl_a])
            ->andFilterWhere(['<=', 'date(tanggal)', $this->tgl_b])
        ;

        return $dataProvider;
    }
}
