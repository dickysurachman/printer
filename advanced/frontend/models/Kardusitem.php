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
            [['tanggal'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idkardus' => Yii::t('yii', 'Carton'),
            'iddetail' => Yii::t('yii', 'Item'),
            'status' => Yii::t('yii', 'Status'),
            'tanggal' => Yii::t('yii', 'Add Date '),
        ];
    }

    public function getItemd()
    {
        return $this->hasOne(Item::className(), ['id' => 'iddetail']);
    }    
    public function getCarton()
    {
        return $this->hasOne(Itemkardus::className(), ['id' => 'idkardus']);
    }
}
