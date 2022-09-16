<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemkardus".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $var_1
 * @property string|null $var_2
 * @property string|null $biner
 * @property string|null $var_3
 * @property int|null $status
 * @property int $ulang
 * @property string|null $var_4
 * @property string|null $var_5
 * @property string|null $var_6
 * @property string|null $var_7
 * @property string|null $var_8
 * @property string|null $var_9
 * @property string|null $var_10
 * @property int|null $hitung
 * @property int|null $gagal
 */
class Itemkardus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemkardus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            //[['ulang'],'required'],
            [['ulang','var_1','var_2','var_3','var_4','var_5'], 'required'],
            [['status', 'hitung', 'gagal','var_8','var_6'], 'integer'],
            //[['var_1', 'var_2'], 'string', 'max' => 200],
            [['var_1','var_2'], 'string','min' => 14, 'max' => 14],
            [['biner'], 'string', 'max' => 500],
            [['var_3', 'var_4', 'var_5', 'var_7', 'var_9', 'var_10'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
             'tanggal' => Yii::t('yii', 'Date Time'),
            'var_1' => Yii::t('yii', 'NIE'),
            'var_2' => Yii::t('yii', 'GTIN'),
            'var_3' => Yii::t('yii', 'LOT NO'),
            'var_4' => Yii::t('yii', 'EXP DATE'),
            'var_5' => Yii::t('yii', 'S / N'),
            'var_6' => Yii::t('yii', 'Company Name'),
            'var_7' => Yii::t('yii', 'Varian Name'),
            'var_8' => Yii::t('yii', 'Qty'),
            'var_9' => Yii::t('yii', 'Weight (kg)'),
            'var_10' => Yii::t('yii', 'Var 10'),
            'biner' => Yii::t('yii', 'Hexa'),
            'ulang' => Yii::t('yii', 'Loop'),
            'hitung' => Yii::t('yii', 'Success'),
            'gagal' => Yii::t('yii', 'Failure'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
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

    public function getPerusahaan()
    {
        return $this->hasOne(Perusahaan::className(), ['id' => 'var_6']);
    }
    public function getMaster()
    {
        return $this->hasOne(Itemkd::className(), ['iddetail' => 'id']);
    }

     public function getDetail()
    {
        return $this->hasMany(Kardusitem::className(), ['idkardus' => 'id']);
    }
}
