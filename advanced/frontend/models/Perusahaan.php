<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perusahaan".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $nama
 * @property string|null $telp
 * @property string|null $alamat
 * @property int|null $status
 */
class Perusahaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perusahaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status'], 'integer'],
            [['nama', 'telp', 'alamat'], 'string', 'max' => 100],
        ];
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
            'telp' => Yii::t('yii', 'Contact Number'),
            'alamat' => Yii::t('yii', 'Address'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
