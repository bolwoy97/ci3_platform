<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Perfect_money {

        public function validate_payment($data)
        {
            $secret = strtoupper( md5($GLOBALS['env']['pm_secret']) );
            $hash = $data['PAYMENT_ID'].':'.
            $data['PAYEE_ACCOUNT'].':'.
            $data['PAYMENT_AMOUNT'].':'.
            $data['PAYMENT_UNITS'].':'.
            $data['PAYMENT_BATCH_NUM'].':'.
            $data['PAYER_ACCOUNT'].':'.
            $secret.':'.
            $data['TIMESTAMPGMT'];

            $hash = strtoupper( md5($hash) );

            if ( $hash != $data['V2_HASH'] ) {
                    return 'V2_HASH error';
            }
            
            return 'ok';
        }

    }