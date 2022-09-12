<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Books is the model behind the contact form.
 */
class Csv3 extends Model
{
    public $alamat;
    public $phone;
    public $gambar;
    public $tanggal;
    public $jumlah;
    public $lot;
    public $expired;
    public $nama;
    public $nie;
    public $gtin;
    public $namav;
    public $csv;
    public $company;
    public $varian;
    public $qty;
    public $berat;

    /**
     * @inheritdoc
     */
        
    public function rules()
    {
        return [
            // name, email, subject and body are required
            
            //[['csv'],'file'], 
            [['jumlah','qty','company'],'integer'],
			//[['csv'], 'file', 'extensions' => 'csv',],
            [['alamat'], 'string', 'max' => 2],
            [['expired'], 'string', 'max' => 12],
            [['lot'], 'string', 'max' => 12],
            //[['gambar'],'file', 'extensions' => 'csv', 'mimeTypes' => 'image/jpeg, image/png'], 
            //[['gambar'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['nie','namav','varian','berat','nama','gtin','alamat','phone','lot','expired','tanggal','nama'],'safe'],
            // verifyCode needs to be entered correctly
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
                    'tanggal'=>'Tanggal Scanning',
                    'gambar'=>'File Foto',
                    'nama'=>'Job Name',
                    'jumlah'=>'Generate S/N Count',
                    'csv'=>'File CSV',
                    'alamat'=> 'Delimiter',
                    'phone'=>'Phone',
                    'lot'=>'LOT NO',
                    'expired'=>'EXP DATE',
                    'nie'=>'Content',
                    'nama'=>'JOB NAME',
                    'namav'=>'PRODUCT NAME',
                    'gtin'=>'GTIN',
                    'company' => Yii::t('yii', 'Company Name'),
                    'varian' => Yii::t('yii', 'SSCC'),
                    'qty' => Yii::t('yii', 'Count'),
                    'berat' => Yii::t('yii', 'Weight (kg)'),

                    ];
     
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
}
