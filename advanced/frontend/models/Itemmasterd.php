<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemmasterd".
 *
 * @property int $id
 * @property string|null $idmaster
 * @property string|null $iddetail
 * @property int|null $status
 */
class Itemmasterd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemmasterd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iddetail','idmaster','status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'idmaster' => Yii::t('yii', 'Job ID'),
            'iddetail' => Yii::t('yii', 'Item Detail'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }

    public function getStatusname(){
        if($this->statusc==0){
            return "PROGRESS";
        } elseif($this->statusc==1) {
            return "PASS";
        } else {
            return "FAIL";

        }
    }
    public function getItemd()
    {
        return $this->hasOne(Item::className(), ['id' => 'iddetail']);
    }
}
