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
            [['tanggal'], 'safe'],
            [['ulang','var_1','var_2','var_3','var_4','var_5'], 'required'],
            [['status','ulang','hitung','gagal'], 'integer'],
            //[['var_2'], 'string', 'max' => 200],
            //[['var_1'], 'string', 'max' => 200],
            [['var_1','var_2'], 'string','min' => 14, 'max' => 14],
            [['var_4'], 'string','min' => 6, 'max' => 6],
            [['biner'], 'string', 'max' => 500],
            [['var_3'], 'string', 'max' => 4],
            //[['var_4'], 'string', 'min'=>6,'max' => 6],
            [['var_5'], 'string', 'max' => 10],
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
            'var_1' => Yii::t('yii', 'NIE'),
            'var_2' => Yii::t('yii', 'GTIN'),
            'var_4' => Yii::t('yii', 'EXP DATE'),
            'var_5' => Yii::t('yii', 'S / N'),
            'biner' => Yii::t('yii', 'Hexa'),
            'ulang' => Yii::t('yii', 'Loop'),
            'var_3' => Yii::t('yii', 'LOT NO'),
            'hitung' => Yii::t('yii', 'Success'),
            'gagal' => Yii::t('yii', 'Failure'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
