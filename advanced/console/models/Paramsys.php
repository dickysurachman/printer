<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "param_sys".
 *
 * @property int $id
 * @property string|null $nama
 * @property string|null $pemisah
 * @property int|null $SN
 * @property int|null $status
 */
class Paramsys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'param_sys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SN', 'status','jumlah'], 'integer'],
            [['nama', 'pemisah','pemisah2'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'nama' => Yii::t('yii', 'Name'),
            'pemisah' => Yii::t('yii', 'First Delimiter Character'),
            'pemisah2' => Yii::t('yii', 'Second Delimiter Character'),
            'jumlah' => Yii::t('yii', 'Total Sequence'),
            'SN' => Yii::t('yii', 'SN Sequence'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
