<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string $var_1
 * @property string $var_2
 * @property string $biner
 * @property string $var_3
 * @property int|null $status
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['ulang'], 'required'],
            [['status','ulang'], 'integer'],
            [['var_1', 'var_2'], 'string', 'max' => 200],
            [['biner'], 'string', 'max' => 500],
            [['var_3','var_4','var_5'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'tanggal' => Yii::t('yii', 'Tanggal'),
            'var_1' => Yii::t('yii', 'Variable 1'),
            'var_2' => Yii::t('yii', 'Variable 2'),
            'var_4' => Yii::t('yii', 'Variable 4'),
            'var_5' => Yii::t('yii', 'Variable 5'),
            'biner' => Yii::t('yii', 'Hexa'),
            'ulang' => Yii::t('yii', 'Loop'),
            'var_3' => Yii::t('yii', 'Variabel 3'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
