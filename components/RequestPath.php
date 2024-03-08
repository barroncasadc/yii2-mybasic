<?php

namespace app\components;

use Yii;
use Yii\base\Component;

class RequestPath extends Component {

  // upload form action --------------
  public function realPathRoot2()
  {
    // return realpath(dirname(__FILE__).'/../../web/custom/');
    return realpath(dirname(__FILE__).'/../web/custom');
  }

  public function realPath2()
  {
    return realpath(dirname(__FILE__).'/../web/');
  }

  // DELETE IMAGE
  public function removeFromServer($folderName, $file) {

    $whitelist   = ['127.0.0.1', '::1'];

    if (
        $file !== NULL &&
        $file !== 'default.png' &&
        $file !== ''
    ) {

        if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ // LOCALHOST
            // removendo arquivo anterior
            if (file_exists(Yii::$app->RequestPath->realPath2(). '/'.$folderName.'/' .$file)) {
                unlink(Yii::$app->RequestPath->realPath2(). '/'.$folderName.'/' .$file);
            }
        } else {
            if (file_exists('../web/custom/img' . '/'.$folderName.'/' .$file)) {
                unlink('../web/custom/img' . '/'.$folderName.'/' .$file);
            }
        }

     }
  }

  public function googleRCaptchaPublic() {

    $whitelist   = ['127.0.0.1', '::1'];

    if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ // LOCALHOST

       return '6LfdnsYaAAAAAH_NOxwEjzhkzZklC5J8I2bzpKxu';

    } else {

      return '6LdvScUbAAAAAEza2sR81kH_IwPrquY33M9qllSM';
    }

  }

  public function googleRCaptchaPrivate() {

    $whitelist   = ['127.0.0.1', '::1'];

    if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ // LOCALHOST

       return '6LfdnsYaAAAAANIZOEiZg1SDDPTPUU1YwbX_Bm3L';

    } else {

      return '6LdvScUbAAAAAKh60Ub173AzNYCQdn6Jw-08iN6E';
    }

  }

}