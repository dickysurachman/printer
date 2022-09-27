<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string $var_1
 * @property string $var_2
 * @property string $biner
 * @property string $var_3
 * @property int|null $status
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal','edit_date'], 'safe'],
            [['ulang','var_1','var_2','var_3','var_4','var_5'], 'required'],
            [['status','ulang','hitung','gagal','machine'], 'integer'],
            //[['var_2'], 'string', 'max' => 200],
            //[['var_1'], 'string', 'max' => 200],
            [['var_1','var_2'], 'string','min' => 14, 'max' => 14],
            //[['var_4'], 'string','min' => 12, 'max' => 12],
            [['var_3'], 'string', 'max' => 12],
            [['var_4'], 'string', 'max' => 12],
            [['biner'], 'string', 'max' => 500],
            //[['var_4'], 'string', 'min'=>6,'max' => 6],
            [['var_5'], 'string', 'max' => 14],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusname(){
        if($this->status==0)
        {
            return 'Active';
        }elseif($this->status==1){
            return 'Progress Execution';
        } else {
            return 'Done';
        }

    }

    public function getScan(){
        $gabung ="(90)".$this->var_1."(01)".$this->var_2."(10)".$this->var_3."(17)".$this->var_4."(21)".$this->var_5;
        return $gabung;
    }
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'tanggal' => Yii::t('yii', 'Add Date Time'),
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
            'edit_date' => Yii::t('yii', 'Last Update'),
            'machine' => Yii::t('yii', 'Machine'),
        ];
    }

     public function getMesin(){

        return $this->hasOne(Machine::className(), ['id' => 'machine']);
    }
     public function getJob(){

        return $this->hasOne(itemmasterd::className(), ['iddetail' => 'id']);
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if($this->isNewRecord)
                    {
                        $this->edit_date = date('Y-m-d H:i:s',time());
                    }
                    else
                    {
                        $this->edit_date = date('Y-m-d H:i:s',time());
                    }
            return true;
        } else {
            return false;
        }
    }
    public function getKarton(){
        return $this->hasOne(Kardusitem::className(), ['iddetail' => 'id']);
    }
    public function getScandata(){
        return $this->hasOne(Scanlog::className(), ['id_item' => 'id']);
    }
}
