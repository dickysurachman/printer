<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemmasterp".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $nama
 * @property int|null $status
 */
class Itemmasterp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemmasterp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status','shift','machine','job_id','id_line'], 'integer'],
            [['nama','linenm','var_1','var_2','var_3','var_4','var_5'], 'string', 'max' => 100],        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'tanggal' => Yii::t('yii', 'Add Date'),
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
            'status' => Yii::t('yii', 'Status'),
            'statusdetail' => Yii::t('yii', 'Status'),
        ];
    }

    public function getDetail()
    {
        return $this->hasMany(Itemmasterpd::className(), ['idmaster' => 'id']);
    }

    public function getStatusdetail(){
        $ja=Itemmasterd::find()->where(['idmaster'=>$this->id])->all();
        $status="On Progress";
        foreach($ja as $vall){
            $haha=$vall->itemd->statusjob;
            if($haha=="Done"){
                $status="Done";
            } else {
                $status="On Progress";
                break;
            }
        }
        return $status;
    }
}
