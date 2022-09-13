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
            [['tanggal'], 'safe'],
            [['status','shift','machine'], 'integer'],
            [['nama','linenm'], 'string', 'max' => 100],
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

        ];
    }

    public function getDetail()
    {
        return $this->hasMany(Itemmasterd::className(), ['idmaster' => 'id']);
    }
}
