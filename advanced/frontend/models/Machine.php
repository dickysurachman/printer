<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "machine".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $nama
 * @property string|null $ip
 * @property string|null $key
 * @property int|null $status
 */
class Machine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'machine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status'], 'integer'],
            [['nama', 'ip', 'key'], 'string', 'max' => 100],
        ];
    }


    public function getStatusnya()
    {
        if($this->status==0){
            return "Off";
        } else {
            return "On";
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'tanggal' => Yii::t('yii', 'Date Add'),
            'nama' => Yii::t('yii', 'Nama'),
            'ip' => Yii::t('yii', 'IP Public'),
            'key' => Yii::t('yii', 'Key'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
