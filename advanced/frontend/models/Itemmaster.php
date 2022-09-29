<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemmaster".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $nama
 * @property int|null $status
 */
class Itemmaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemmaster';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama','linenm'], 'required'],
            [['tanggal'], 'safe'],
            [['status','shift','machine','job_id','id_line'], 'integer'],
            [['nama','linenm','var_1','var_2','var_3','var_4','var_5'], 'string', 'max' => 100],
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
            'nama' => Yii::t('yii', 'Name'),
            'status' => Yii::t('yii', 'Status'),
            'shift' => Yii::t('yii', 'Shift'),
            'machine' => Yii::t('yii', 'Machine'),
            'linenm' => Yii::t('yii', 'Line Name'),
            'var_1' => Yii::t('yii', 'NIE'),
            'var_2' => Yii::t('yii', 'GTIN'),
            'var_3' => Yii::t('yii', 'LOT NO'),
            'var_4' => Yii::t('yii', 'EXP DATE'),
            'var_5' => Yii::t('yii', 'Product Name'),
            'job_id' => Yii::t('yii', 'Product Name'),
            'id_line' => Yii::t('yii', 'Line Name'),
        ];
    }
    public function getStatusname(){
        if($this->status==1){

            return "Done";
        } else {
            return "On Progress";
        }

    }
    public function getProduk(){

        return $this->hasOne(Jobs::className(), ['id' => 'job_id']);
    }
    public function getLine(){

        return $this->hasOne(Line::className(), ['id' => 'id_line']);
    }
    public function getMesin(){

        return $this->hasOne(Machine::className(), ['id' => 'machine']);
    }

    public function getDetail()
    {
        return $this->hasMany(Itemmasterd::className(), ['idmaster' => 'id']);
    }
}
