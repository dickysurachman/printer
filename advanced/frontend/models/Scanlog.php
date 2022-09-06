<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scanlog".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $scan
 * @property int|null $status
 */
class Scanlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scanlog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status'], 'integer'],
            [['scan'], 'string', 'max' => 300],
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
            'scan' => Yii::t('yii', 'Scan'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
