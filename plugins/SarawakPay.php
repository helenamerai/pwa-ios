<?php
/**
 * Sarawak Pay module
 */

class SarawakPay
{
    const SP_PUBLIC_KEY          = "keys/sarawakpay_public_key.pub";
    const MERCHANT_PUBLIC_KEY    = "keys/merchant_public_key.pub";
    const MERCHANT_PRIVATE_KEY   = "keys/merchant_private_key.pem";

    /**
     * @param  string  $url   Sarawak pay api
     * @param  string  $data  JSON data
     * @return string         JSON string
     */
    
    public static function post($url, $data)
    {
        echo "come here";
    
        $signedData = json_decode($data, true, 512, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $signedData['sign'] = Encryption::generateSignature($data, self::MERCHANT_PRIVATE_KEY);

        $encryptedData = Encryption::encrypt(json_encode($signedData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), self::SP_PUBLIC_KEY);

        $payload = "FAPView=JSON&formData=" . str_replace('+', '%2B', $encryptedData);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close ($ch);

        $decrypted_response = Encryption::decrypt($response, self::MERCHANT_PRIVATE_KEY);

        // Verify Server Response
        if (Encryption::verifySignature($decrypted_response, self::SP_PUBLIC_KEY)) {
            return $decrypted_response;
        }

        return false;
    }

    /**
     * @param  string  $data  JSON data
     * @return string         JSON string
     */
    public static function encrypt(string $data)
    {
        return Encryption::encrypt($data, self::SP_PUBLIC_KEY);
    }

    /**
     * @param  string  $data  Encrypted formData
     * @return string         Decrypted JSON string
     */
    public static function decrypt(string $data)
    {
        return Encryption::decrypt($data, self::MERCHANT_PRIVATE_KEY);
    }

    /**
     * @param  string  $data  JSON data
     * @return boolean
     */
    public static function checkSign(string $data)
    {
        return Encryption::verifySignature($data, self::SP_PUBLIC_KEY);
    }

}
