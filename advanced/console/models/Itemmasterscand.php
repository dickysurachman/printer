<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemmasterscand".
 *
 * @property int $id
 * @property int|null $idmaster
 * @property int|null $iddetail
 * @property int|null $status
 */
class Itemmasterscand extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemmasterscand';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmaster', 'iddetail', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idmaster' => Yii::t('yii', 'Idmaster'),
            'iddetail' => Yii::t('yii', 'Iddetail'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
     public function getItemd()
    {
        return $this->hasOne(Itemscan::className(), ['id' => 'iddetail']);
    }
}
