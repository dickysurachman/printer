<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scanlog".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $scan
 * @property int|null $status
 */
class Scanlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scanlog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status','machine','process','id_job','id_item'], 'integer'],
            [['scan'], 'string', 'max' => 300],
            [['dbs','stat'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'tanggal' => Yii::t('yii', 'Date'),
            'scan' => Yii::t('yii', 'Data'),
            'status' => Yii::t('yii', 'Status'),
            'machine' => Yii::t('yii', 'Machine'),
            'process' => Yii::t('yii', 'Process'),
            'id_job' => Yii::t('yii', 'Job Master'),
            'id_item' => Yii::t('yii', 'Item'),
            'dbs' => Yii::t('yii', 'Verified'),
            'stat' => Yii::t('yii', 'Status'),
        ];
    }

    public function getJob(){
        return $this->hasOne(Itemmaster::className(), ['id' => 'id_job']);
    }
    public function getItem(){
        return $this->hasOne(Item::className(), ['id' => 'id_item']);
    }
      public function getMesin(){

        return $this->hasOne(Machine::className(), ['id' => 'machine']);
    }


}
