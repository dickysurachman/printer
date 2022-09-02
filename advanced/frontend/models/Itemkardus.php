<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemkardus".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $var_1
 * @property string|null $var_2
 * @property string|null $biner
 * @property string|null $var_3
 * @property int|null $status
 * @property int $ulang
 * @property string|null $var_4
 * @property string|null $var_5
 * @property string|null $var_6
 * @property string|null $var_7
 * @property string|null $var_8
 * @property string|null $var_9
 * @property string|null $var_10
 * @property int|null $hitung
 * @property int|null $gagal
 */
class Itemkardus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemkardus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['ulang'],'required'],
            [['status', 'hitung', 'gagal'], 'integer'],
            [['var_1', 'var_2'], 'string', 'max' => 200],
            [['biner'], 'string', 'max' => 500],
            [['var_3', 'var_4', 'var_5', 'var_6', 'var_7', 'var_8', 'var_9', 'var_10'], 'string', 'max' => 100],
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
            'var_1' => Yii::t('yii', 'Var 1'),
            'var_2' => Yii::t('yii', 'Var 2'),
            'biner' => Yii::t('yii', 'Biner'),
            'var_3' => Yii::t('yii', 'Var 3'),
            'status' => Yii::t('yii', 'Status'),
            'ulang' => Yii::t('yii', 'Ulang'),
            'var_4' => Yii::t('yii', 'Var 4'),
            'var_5' => Yii::t('yii', 'Var 5'),
            'var_6' => Yii::t('yii', 'Var 6'),
            'var_7' => Yii::t('yii', 'Var 7'),
            'var_8' => Yii::t('yii', 'Var 8'),
            'var_9' => Yii::t('yii', 'Var 9'),
            'var_10' => Yii::t('yii', 'Var 10'),
            'hitung' => Yii::t('yii', 'Hitung'),
            'gagal' => Yii::t('yii', 'Gagal'),
        ];
    }
}
