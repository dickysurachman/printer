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
            [['status'], 'integer'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'tanggal' => Yii::t('yii', 'Tanggal'),
            'nama' => Yii::t('yii', 'Nama'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }

    public function getDetail()
    {
        return $this->hasMany(Itemmasterpd::className(), ['idmaster' => 'id']);
    }
}
