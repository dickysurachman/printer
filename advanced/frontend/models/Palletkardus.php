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
            'idpallet' => Yii::t('yii', 'Pallet'),
            'idkardus' => Yii::t('yii', 'Carton'),
            'status' => Yii::t('yii', 'Status'),
            'tanggal' => Yii::t('yii', 'Add Date '),
        ];
    }

    public function getCarton()
    {
        return $this->hasOne(Itemkardus::className(), ['id' => 'idkardus']);
    }
    public function getPallet()
    {
        return $this->hasOne(Itempallet::className(), ['id' => 'idpallet']);
    }

}
