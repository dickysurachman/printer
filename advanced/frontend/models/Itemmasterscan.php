<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "itemmasterscan".
 *
 * @property int $id
 * @property string|null $tanggal
 * @property string|null $nama
 * @property int|null $status
 * @property string|null $linenm
 * @property int|null $shift
 * @property int|null $machine
 * @property string|null $var_1
 * @property string|null $var_2
 * @property string|null $var_3
 * @property string|null $var_4
 * @property string|null $var_5
 * @property int|null $job_id
 * @property int|null $id_line
 */
class Itemmasterscan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'itemmasterscan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['status', 'shift', 'machine', 'job_id', 'id_line'], 'integer'],
            [['nama', 'linenm', 'var_1', 'var_2', 'var_3', 'var_4', 'var_5'], 'string', 'max' => 100],
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
            'linenm' => Yii::t('yii', 'Linenm'),
            'shift' => Yii::t('yii', 'Shift'),
            'machine' => Yii::t('yii', 'Machine'),
            'var_1' => Yii::t('yii', 'Var 1'),
            'var_2' => Yii::t('yii', 'Var 2'),
            'var_3' => Yii::t('yii', 'Var 3'),
            'var_4' => Yii::t('yii', 'Var 4'),
            'var_5' => Yii::t('yii', 'Var 5'),
            'job_id' => Yii::t('yii', 'Job ID'),
            'id_line' => Yii::t('yii', 'Id Line'),
        ];
    }
}
