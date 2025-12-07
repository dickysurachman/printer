<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "jobs".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $nama
 * @property string|null $nie
 * @property string|null $gtin
 * @property int|null $status
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
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
            [['nie', 'gtin'], 'string', 'min'=>14, 'max' => 14],
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
            'nie' => Yii::t('yii', 'NIE'),
            'gtin' => Yii::t('yii', 'GTIN'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
