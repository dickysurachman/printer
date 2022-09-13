<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "linenm".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $nama
 * @property int|null $status
 */
class Line extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'linenm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status'], 'integer'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
     public function getStatusnya()
    {
        if($this->status==0){
            return "Off";
        } else {
            return "On";
        }
    }
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'tanggal' => Yii::t('yii', 'Add Date'),
            'nama' => Yii::t('yii', 'Name'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
