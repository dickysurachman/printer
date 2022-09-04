<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logitem".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property int|null $status
 * @property string|null $logbaca
 */
class Logitem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logitem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status'], 'integer'],
            [['logbaca'], 'string'],
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
            'status' => Yii::t('yii', 'Status'),
            'logbaca' => Yii::t('yii', 'Logbaca'),
        ];
    }
}