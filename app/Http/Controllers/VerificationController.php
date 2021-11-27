<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    protected $APIKey = '9c01cf12f2ff27f5856fcf12';
    protected $SecretKey = 'iamsijal@1';
    protected $APIURL = 'https://ws.sms.ir/';


    /**
     * Gets API Verification Code Url.
     *
     * @return string Indicates the Url
     */
    protected function getAPIVerificationCodeUrl()
    {
        return "api/VerificationCode";
    }

    /**
     * Gets Api Token Url.
     *
     * @return string Indicates the Url
     */
    protected function getApiTokenUrl()
    {
        return "api/Token";
    }

    /**
     * Gets config parameters for sending request.
     *
     * @param string $APIKey API Key
     * @param string $SecretKey Secret Key
     * @param string $APIURL API URL
     *
     * @return void
     */

    /**
     * Verification Code.
     *
     * @param string $Code Code
     * @param string $MobileNumber Mobile Number
     *
     * @return string Indicates the sent sms result
     */
    public function verificationCode($Code, $MobileNumber)
    {
        $token = $this->_getToken($this->APIKey, $this->SecretKey);
        if ($token != false) {
            $postData = array(
                'Code' => $Code,
                'MobileNumber' => $MobileNumber,
            );

            $url = $this->APIURL . $this->getAPIVerificationCodeUrl();
            $VerificationCode = $this->_execute($postData, $url, $token);
            $object = json_decode($VerificationCode);

            $result = false;
            if (is_object($object)) {
                $result = $object->Message;
            } else {
                $result = false;
            }

        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * Gets token key for all web service requests.
     *
     * @return string Indicates the token key
     */
    private function _getToken()

    {
        $postData = array(
            'UserApiKey' => $this->APIKey,
            'SecretKey' => $this->SecretKey,
            'System' => 'php_rest_v_2_0'
        );
        $postString = json_encode($postData);

        $ch = curl_init($this->APIURL . $this->getApiTokenUrl());
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result);

        $resp = false;
        $IsSuccessful = '';
        $TokenKey = '';
        if (is_object($response)) {
            $IsSuccessful = $response->IsSuccessful;
            if ($IsSuccessful == true) {
                $TokenKey = $response->TokenKey;
                $resp = $TokenKey;
            } else {
                $resp = false;
            }
        }
        return $resp;
    }

    /**
     * Executes the main method.
     *
     * @param postData[] $postData array of json data
     * @param string $url url
     * @param string $token token string
     *
     * @return string Indicates the curl execute result
     */
    private function _execute($postData, $url, $token)
    {
        $postString = json_encode($postData);

        $ch = curl_init($url);

        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'x-sms-ir-secure-token: ' . $token
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function sendVerificationCode(Request $request)
    {
        $valid = $request->validate([
            'mobile_number' => ['required', 'numeric', 'min:11', 'regex:/(09)[0-9]{9}/'],
        ]); // validate mobile number
        $mobileNumber = $valid['mobile_number'];
        $verifyCheck = Verification::where('mobile_number', $mobileNumber)->get(); // check exist verify code
        if (count($verifyCheck) <= 2) {
            $code = AssistantController::sendVerificationCode(); // generate verify code
            Verification::create([
                'mobile_number' => $mobileNumber,
                'code' => $code
            ]); // create verify code
            $this->verificationCode($code, $mobileNumber);
            return response()->json([
                'message' => 'کد با موفقیت برای شما ارسال شد',
            ]);
        }
        return response()->json([
            'message' => 'کد قبلا برای شما ارسال شده است',
        ]);
    }
}
