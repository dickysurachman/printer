<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\Item;
use app\models\Logitem;
use frontend\models\Setting;
use app\models\Scanlog;
use Da\QrCode\QrCode;
use ZipArchive;
use app\models\User;
use app\models\Machine;
use app\models\Itemmasterd;
use app\models\Scanlogcarton;
use app\models\Scanlogpallet;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup','settingsave','scan','settingcamera','scanm','scanm2','password'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','settingsave','scan','settingcamera','scanm','scanm2','password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionInfo($key){
        $h=Machine::find()->where(['key'=>$key])->one();
        if(isset($h)) {
        $ipx=$h->ip;
        $ipy=$_SERVER['REMOTE_ADDR'];
        if(($ipx==$ipy) or ($ipy=="::1")) {
            //$job=Itemmaster::findOne()        
            $res=Item::find()->where(['status'=>1,'machine'=>$h->id])->limit(10)->all();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
            'message' => $res,
            'code' => 100,
            ];
            foreach($res as $value){
                $value->status=2;
                $value->save();
            }
            $h->status=1;
            $h->save();
        }
        }
    }
    public function actionInfox(){
        $res=Item::find()->where(['status'=>1])->limit(50)->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return [
        'message' => $res,
        'code' => 100,
    ];
    }
    public function actionPassword(){
        $request = Yii::$app->request;
        $model = User::findOne(Yii::$app->user->identity->id);

        if($model->load($request->post())){
                $model->updated_at=time();
                $model->setPassword($model->password_hash);
                $model->generateAuthKey();
                $model->save();
        
        }
        return $this->render('updatep', [
                    'model' => $model,
                ]);
        
        
    }
    public function actionTanggal(){
        return "Date Time : ".date('d-m-Y H:i:s',time());
    }

    public function actionCamera($status,$key){        
        $h=Machine::find()->where(['key'=>$key])->one();
        if(isset($h)) {
            if(trim($status)<>""){
                $mm=new Scanlog;
                $mm->scan =$status;
                $mm->machine =$h->id;
                $mm->save();
                return "save";
            }
        }
    }       
    public function actionCamerakardus($status,$key){        
        $h=Machine::find()->where(['key'=>$key])->one();
        if(isset($h)) {
            if(trim($status)<>""){
                $mm=new Scanlogcarton;
                $mm->scan =$status;
                $mm->machine =$h->id;
                $mm->save();
                return "save";
            }
        }
    }       
    public function actionCamerapallet($status,$key){        
        $h=Machine::find()->where(['key'=>$key])->one();
        if(isset($h)) {
            if(trim($status)<>""){
                $mm=new Scanlogpallet;
                $mm->scan =$status;
                $mm->machine =$h->id;
                $mm->save();
                return "save";
            }
        }
    }    
    public function actionCamerac($status){        
        if(trim($status)<>""){
            $mm=new Scanlog;
            $mm->scan =$status;
            $mm->save();
        }

    }    
    public function actionCameralive(){        
       return $this->render('livecamera');
    }

    public function actionScanm(){
        $model= new Scanlog();
        if (Yii::$app->request->isAjax) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->post()) {
            $resp="";
            $hasil = explode(PHP_EOL,$_POST['Inputan']['barcode']);
            foreach($hasil as $value){
            if($value<>" " or $value<>""){
                $value = preg_replace("/\r|\n/", "", $value);
                $value =trim($value);
                if($value<>""){
                $jj=new Scanlog();
                $jj->scan=$value;
                if($jj->save()) {
                    $resp.=$value." berhasil diinput <br/>";
                } else {
                    $resp.=$value." gagal diinput <br/>";
                }
                }
                
            }
            }
            return $resp;
            
        } else {
            return "data tidak berhasil diinput";
        }
        }
        return $this->render('createscanm', [
        'model' => $model,
        ]);
    } 

    public function actionScanm2(){
        $model= new Scanlog();
        if (Yii::$app->request->isAjax) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->post()) {
            $resp="";
            //$hasil = explode(PHP_EOL,$_POST['Inputan']['barcode']);
            $hasil = explode("\n",$_POST['Inputan']['barcode']);
            foreach($hasil as $value){
            if($value<>" " or $value<>""){
                $value = preg_replace("/\r|\n/", "", $value);
                $value =trim($value);
                if($value<>""){
                $jj=new Scanlog();
                $jj->scan=$value;
                if($jj->save()) {
                    $resp.=$value." berhasil diinput <br/>";
                    $item=$value;
                    $data=explode("(", $item);
                    if(count($data)==6){
                        $dat1=explode(")",$data[1]);
                        $var1=$dat1[1];
                        $dat1=explode(")",$data[2]);
                        $var2=$dat1[1];
                        $dat1=explode(")",$data[3]);
                        $var3=$dat1[1];
                        $dat1=explode(")",$data[4]);
                        $var4=$dat1[1];
                        $dat1=explode(")",$data[5]);
                        $var5=$dat1[1];
                        $gabung ="(90)".$var1."(01)".$var2."(10)".$var3."(17)".$var4."(21)".$var5;
                        $qrCode = (new QrCode($gabung))
                            ->setSize(170)
                            ->setMargin(5)
                            ->useForegroundColor(13, 13, 13);
                        $qrCode->writeFile('code.png'); // writer defaults to PNG when none is specified
                        header('Content-Type: '.$qrCode->getContentType());
                        $resp.='<div class="row">
                        <div class="col-3">
                        <img src="' . $qrCode->writeDataUri() . '">
                        </div>
                        <div class="col-4">
                        <table id="w0" class="table table-striped table-bordered detail-view"><tbody><tr><th>NIE</th><td>'.$var1.'</td></tr>
<tr><th>GTIN</th><td>'.$var2.'</td></tr>
<tr><th>LOT NO</th><td>'.$var3.'</td></tr>
<tr><th>EXP DATE</th><td>'.$var4.'</td></tr>
<tr><th>S / N</th><td>'.$var5.'</td></tr></tbody></table>
                        </div></div>';
                    }
                } else {
                    $resp.=$value." gagal diinput <br/>";
                }
                }
                
            }
            }
            return $resp;
            
        } else {
            return "data tidak berhasil diinput";
        }
        }
        return $this->render('createscanm2', [
        'model' => $model,
        ]);
    } 

    public function actionHitung($id,$status,string $logbaca="", string $key) {
        $h=Machine::find()->where(['key'=>$key])->one();
        if(isset($h)) {
        $ipx=$h->ip;
        $ipy=$_SERVER['REMOTE_ADDR'];
        if(($ipx==$ipy) or ($ipy=="::1")) {   
            if($status=="failure") {
            $new1=new Logitem();
            $new1->logbaca=$logbaca;
            $new1->machine=$h->id;
            $new1->ip=$ipy;
            $new1->save();
            } else {
            $ja=Item::findOne($id);
            if(isset($ja)){
            $total=$ja->hitung+$ja->gagal;
            if($status=="sukses") {

            //$ja->hitung = $ja->hitung+1;
            //$total+=1;
            //if($total>=$ja->ulang) 
            //{
                $ja->status=2;
                $det=Itemmasterd::findOne(['iddetail'=>$ja->id]);
                //if(isset($det)) {                    
                $det->status=1;
                $det->save();
            //    }
            //}
            } else {
            //$ja->gagal= $ja->gagal+1;
            //$total+=1;
            //if($total>=$ja->ulang) {
                $ja->status=2;
                $det=Itemmasterd::findOne($ja->id);
                $det->status=2;
                $det->save();                
            //}
            }
            $ja->save();
            }
        }
    } } 
    } 
    public function actionHitungx($id,$status,string $logbaca=""){
        if($status=="failure") {
            $new1=new Logitem();
            $new1->logbaca=$logbaca;
            $new1->save();
        } else {
        $ja=Item::findOne($id);
        if(isset($ja)){
        $total=$ja->hitung+$ja->gagal;
        if($status=="sukses") {
        $ja->hitung = $ja->hitung+1;
        $total+=1;
        if($total>=$ja->ulang) $ja->status=2;
        } else {
        $ja->gagal= $ja->gagal+1;
        $total+=1;
        if($total>=$ja->ulang) $ja->status=2;
        }
        $ja->save();
        }
        }
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        } else {
            return $this->render('index');
        }
    }
    public function actionScan(){
        return $this->render('scanningc');

    }

public function actionEksekusi()
    {
        if(Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        } else {
            return $this->render('py');
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout="main-login";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout($pesan)
    {
        return $this->render('about',['pesan'=>$pesan]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout="main-login";
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionGetprint(){
        $filename=Yii::$app->security->generateRandomString() . '0-' . time().".zip";
        $zip = new \ZipArchive(); 
        $zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFile('runprinter.bat'); 
        $zip->addFile('programprint.py'); 
        $zip->addFile('setting.txt'); 
        $zip->close();
        //$zip->createZip($zip,$filename);
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($filename));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile("$filename");

    }
    public function actionGetcamera(){
        $filename=Yii::$app->security->generateRandomString() . '0-' . time().".zip";
        $zip = new \ZipArchive(); 
        $zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $zip->addFile('runcamera.bat'); 
        $zip->addFile('camerasrv.py'); 
        $zip->addFile('setting2.txt'); 
        $zip->close();
        //$zip->createZip($zip,$filename);
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($filename));
        header("Pragma: no-cache"); 
        header("Expires: 0"); 
        readfile("$filename");

    }
     public function actionSettingsave()
    {
        $model = new Setting();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Save File Setting');
            $myfile = fopen("setting.txt", "w") or die("Unable to open file!");
            //$txt = "Mickey Mouse\n";
            fwrite($myfile, $model->url1."\n");
            fwrite($myfile, $model->url2."\n");
            fwrite($myfile, $model->timer."\n");
            fwrite($myfile, $model->ip_alat."\n");
            fwrite($myfile, $model->port_alat."\n");
            fwrite($myfile, $model->buffer."\n");
            fwrite($myfile, $model->key."\n");
            fclose($myfile);
            //return $this->goHome();
            return $this->redirect(['site/settingsave']);
        }

        return $this->render('settingsave', [
            'model' => $model,
        ]);
    }

     public function actionSettingcamera()
    {
        $model = new Setting();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Save File Setting');
            $myfile = fopen("setting2.txt", "w") or die("Unable to open file!");
            //$txt = "Mickey Mouse\n";
            fwrite($myfile, $model->url2."\n");
            fwrite($myfile, $model->port_alat."\n");
            fwrite($myfile, $model->key."\n");
            fwrite($myfile, $model->ip_alat."\n");
            fclose($myfile);
            //return $this->goHome();
            return $this->redirect(['site/settingcamera']);
        }

        return $this->render('settingcamera', [
            'model' => $model,
        ]);
    }
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
