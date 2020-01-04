<?php

namespace Population\Models\Entytys\Digital\Infra;

use Support\Models\Base;
use SiUtils\Helper\File;

// set_include_path(get_include_path() . get_include_path().'/phpseclib');
// include('phpseclib/Net/SSH2.php');
use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA as Crypt_RSA;

class SshKey extends Base
{

    public static $apresentationName = 'Chaves SSH';

    protected $organizationPerspective = false;

    protected $table = 'infra_ssh_keys';   
    
    public static $storageFolder = 'keys';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'public_key',
        'private_key'
    ];


    protected $mappingProperties = array(

        'customer_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'credit_card_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'user_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'docker_compose_file' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    public function getLocalKey()
    {
        return file_get_contents(storage_path().DS.self::$storageFolder.DS.$this->slug.'PEM');
    }

    public function getApresentationName()
    {
        $name = $this->name;
        if (empty($name)) {
            return 'Vazio';
        }
        return $name;
    }

    public static function defaultById($id)
    {
        $ssh = self::find($id);
        $folder = DIRECTORY_SEPARATOR.'var'.DIRECTORY_SEPARATOR.'www'.DIRECTORY_SEPARATOR.'.ssh';
        $location = $folder.DIRECTORY_SEPARATOR."id_rsa";
        File::createFile($location, $ssh->getPrivateKey());
        $location = $folder.DIRECTORY_SEPARATOR."id_rsa.pub";
        File::createFile($location, $ssh->getPublicKey());
    }


    /** 
     * Retorna a chave Publica
    */
    public function getPublicKey()
    {
        if (!empty($this->public_key)) {
            return $this->public_key;
        }
        $key = new Crypt_RSA();
        $key->loadKey($this->getLocalKey());
        return $key;
    }

    /** 
     * Retorna a chave Privada
    */
    public function getPrivateKey()
    {
        if (!empty($this->private_key)) {
            return $this->private_key;
        }
        $key = new Crypt_RSA();
        $key->loadKey($this->getLocalKey());
        return $key;
    }

    /**
     * Cria uma assinatura para determinado texto
     */
    public function createSignatureFromMessage($plaintext = '...')
    {
        $rsa = $this->getPrivateKey();

        //$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PSS);
        $signature = $rsa->sign($plaintext);
        return $signature;
    }

    /**
     * Verifica se uma Assinatura é Valida
     */
    public function verifySignature($plaintext, $signature)
    {
        $rsa = $this->getPublicKey();
        if ($rsa->verify($plaintext, $signature)){
            return true;
        }
        
        return false;
    }

    /**
     * Criptografa mensagem com a chave
     */
    public function encryptMessage($plaintext)
    {
        $rsa = $this->getPublicKey();

        //$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_OAEP);
        $ciphertext = $rsa->encrypt($plaintext);

        return $ciphertext;
    }

    /**
     * Descriptografas messagen com a chave
     */
    public function decryptaMessage($ciphertext)
    {
        $rsa = $this->getPrivateKey();
        return $rsa->decrypt($ciphertext);
    }

    /**
     * Cria uma chave
     */
    public function createKey($hasPassword = false)
    {
        $rsa = new Crypt_RSA();

        if ($hasPassword){
            $rsa->setPassword($hasPassword);
        }

        // DIferentes Formatos (Nao usado Nenhum)
        // $rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_XML);
        //$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);
 
        //$rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
        //$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);

        //define('CRYPT_RSA_EXPONENT', 65537);
        //define('CRYPT_RSA_SMALLEST_PRIME', 64); // makes it so multi-prime RSA is used
        extract($rsa->createKey()); // == $rsa->createKey(1024) where 1024 is the key size
        /**Values of $privatekey and $publickey:
            $privatekey:

            -----BEGIN RSA PRIVATE KEY-----
            MIICXAIBAAKBgQCqGKukO1De7zhZj6+H0qtjTkVxwTCpvKe4eCZ0FPqri0cb2JZfXJ/DgYSF6vUp
            wmJG8wVQZKjeGcjDOL5UlsuusFncCzWBQ7RKNUSesmQRMSGkVb1/3j+skZ6UtW+5u09lHNsj6tQ5
            1s1SPrCBkedbNf0Tp0GbMJDyR4e9T04ZZwIDAQABAoGAFijko56+qGyN8M0RVyaRAXz++xTqHBLh
            3tx4VgMtrQ+WEgCjhoTwo23KMBAuJGSYnRmoBZM3lMfTKevIkAidPExvYCdm5dYq3XToLkkLv5L2
            pIIVOFMDG+KESnAFV7l2c+cnzRMW0+b6f8mR1CJzZuxVLL6Q02fvLi55/mbSYxECQQDeAw6fiIQX
            GukBI4eMZZt4nscy2o12KyYner3VpoeE+Np2q+Z3pvAMd/aNzQ/W9WaI+NRfcxUJrmfPwIGm63il
            AkEAxCL5HQb2bQr4ByorcMWm/hEP2MZzROV73yF41hPsRC9m66KrheO9HPTJuo3/9s5p+sqGxOlF
            L0NDt4SkosjgGwJAFklyR1uZ/wPJjj611cdBcztlPdqoxssQGnh85BzCj/u3WqBpE2vjvyyvyI5k
            X6zk7S0ljKtt2jny2+00VsBerQJBAJGC1Mg5Oydo5NwD6BiROrPxGo2bpTbu/fhrT8ebHkTz2epl
            U9VQQSQzY1oZMVX8i1m5WUTLPz2yLJIBQVdXqhMCQBGoiuSoSjafUhV7i1cEGpb88h5NBYZzWXGZ
            37sJ5QsW+sJyoNde3xH8vdXhzU7eT82D6X/scw9RZz+/6rCJ4p0=
            -----END RSA PRIVATE KEY-----

            $publickey:

            -----BEGIN PUBLIC KEY-----
            MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCqGKukO1De7zhZj6+H0qtjTkVxwTCpvKe4eCZ0
            FPqri0cb2JZfXJ/DgYSF6vUpwmJG8wVQZKjeGcjDOL5UlsuusFncCzWBQ7RKNUSesmQRMSGkVb1/
            3j+skZ6UtW+5u09lHNsj6tQ51s1SPrCBkedbNf0Tp0GbMJDyR4e9T04ZZwIDAQAB
            -----END PUBLIC KEY-----

 */
    }
}