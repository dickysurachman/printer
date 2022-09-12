<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itempallet".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $var_1
 * @property string|null $var_2
 * @property string|null $biner
 * @property string|null $var_3
 * @property string|null $var_6
 * @property string|null $var_7
 * @property string|null $var_8
 * @property string|null $var_9
 * @property string|null $var_10
 * @property int|null $status
 * @property int $ulang
 * @property string|null $var_4
 * @property string|null $var_5
 * @property int|null $hitung
 * @property int|null $gagal
 */
class Itempallet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itempallet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
             [['ulang','var_1','var_2','var_3','var_4','var_5'], 'required'],
            [['status', 'ulang', 'hitung', 'gagal','var_8','var_6'], 'integer'],
             [['var_1','var_2'], 'string','min' => 14, 'max' => 14],
            //[['var_1', 'var_2'], 'string', 'max' => 200],
            [['biner'], 'string', 'max' => 500],
            [['var_3', 'var_7', 'var_9', 'var_10', 'var_4', 'var_5'], 'string', 'max' => 100],
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
             'tanggal' => Yii::t('yii', 'Date Time'),
            'var_1' => Yii::t('yii', 'Content'),
            'var_2' => Yii::t('yii', 'GTIN'),
            'var_4' => Yii::t('yii', 'EXP DATE'),
            'var_3' => Yii::t('yii', 'LOT NO'),
            'var_5' => Yii::t('yii', 'S / N'),
            'var_6' => Yii::t('yii', 'Company Name'),
            'var_7' => Yii::t('yii', 'SSCC'),
            'var_8' => Yii::t('yii', 'Count'),
            'var_9' => Yii::t('yii', 'Weight (kg)'),
            'var_10' => Yii::t('yii', 'Var 10'),
            'biner' => Yii::t('yii', 'Hexa'),
            'ulang' => Yii::t('yii', 'Loop'),
            'hitung' => Yii::t('yii', 'Success'),
            'gagal' => Yii::t('yii', 'Failure'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }

     public function getPerusahaan()
    {
        return $this->hasOne(Perusahaan::className(), ['id' => 'var_6']);
    }
}
