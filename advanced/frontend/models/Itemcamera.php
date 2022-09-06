<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemcamera".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $var_1
 * @property string|null $var_2
 * @property string|null $var_3
 * @property string|null $var_4
 * @property string|null $var_5
 * @property int|null $status
 * @property int|null $hitung
 * @property int|null $gagal
 */
class Itemcamera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemcamera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status', 'hitung', 'gagal'], 'integer'],
            [['var_1', 'var_2'], 'string', 'max' => 200],
            [['var_3', 'var_4', 'var_5'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tanggal' => Yii::t('yii', 'Date Time'),
            'var_1' => Yii::t('yii', 'NIE'),
            'var_2' => Yii::t('yii', 'GTIN'),
            'var_3' => Yii::t('yii', 'LOT NO'),
            'var_4' => Yii::t('yii', 'EXP DATE'),
            'var_5' => Yii::t('yii', 'S / N'),
            'biner' => Yii::t('yii', 'Hexa'),
            'ulang' => Yii::t('yii', 'Loop'),
            'hitung' => Yii::t('yii', 'Success'),
            'gagal' => Yii::t('yii', 'Failure'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
