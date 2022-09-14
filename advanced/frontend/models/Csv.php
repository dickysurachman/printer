<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Books is the model behind the contact form.
 */
class Csv extends Model
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
    public $linenm;
    public $machine;
    public $shift;


    /**
     * @inheritdoc
     */
        
    public function rules()
    {
        return [
            // name, email, subject and body are required
            
            //[['csv'],'file'], 
            [['machine','lot','expired','nie','linenm','nama','jumlah','namav'],'required'],
            [['jumlah','shift'],'integer'],
			//[['csv'], 'file', 'extensions' => 'csv',],
            [['alamat'], 'string', 'max' => 2],
            [['expired'], 'string', 'max' => 12],
            [['lot'], 'string', 'max' => 12],
            //[['gambar'],'file', 'extensions' => 'csv', 'mimeTypes' => 'image/jpeg, image/png'], 
            //[['gambar'], 'file', 'extensions' => 'jpg,jpeg,png'],
            [['nie','namav','linenm','machine','nama','gtin','linenm','alamat','phone','lot','expired','tanggal','nama'],'safe'],
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
                    'jumlah'=>'Production Target',
                    'csv'=>'File CSV',
                    'alamat'=> 'Delimiter',
                    'phone'=>'Phone',
                    'lot'=>'LOT',
                    'expired'=>'EXP DATE',
                    'nie'=>'NIE',
                    'nama'=>'JOB NAME',
                    'namav'=>'PRODUCT NAME',
                    'gtin'=>'GTIN',
                    'machine'=>'Machine Name',
                    'linenm'=>'Line Name',
                    'shift'=>'Shift',
                    ];
     
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
}
