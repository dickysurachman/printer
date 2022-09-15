<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kardusitem".
 *
 * @property int $id
 * @property int|null $idkardus
 * @property int|null $iddetail
 * @property int|null $status
 */
class Kardusitem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kardusitem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkardus', 'iddetail', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idkardus' => Yii::t('yii', 'Idkardus'),
            'iddetail' => Yii::t('yii', 'Iddetail'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
