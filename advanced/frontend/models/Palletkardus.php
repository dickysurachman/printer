<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "palletkardus".
 *
 * @property int $id
 * @property int|null $idpallet
 * @property int|null $idkardus
 * @property int|null $status
 */
class Palletkardus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'palletkardus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpallet', 'idkardus', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idpallet' => Yii::t('yii', 'Idpallet'),
            'idkardus' => Yii::t('yii', 'Idkardus'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
