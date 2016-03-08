<?php
namespace api\storage;

class PublicKeyStorage implements \OAuth2\Storage\PublicKeyInterface{


	private $pbk =  null;
	private $pvk =  null;

	public function __construct()
	{
		//files should be in same directory as this file
		//keys can be generated using OpenSSL tool with command:
		/*
		 private key:
		 openssl genrsa -out privkey.pem 2048

		 public key:
		 openssl rsa -in privkey.pem -pubout -out pubkey.pem
		 */
		$this->pbk =  file_get_contents('privkey.pem', true);
		$this->pvk =  file_get_contents('pubkey.pem', true);
	}

	public function getPublicKey($client_id = null){
		return  $this->pbk;
	}

	public function getPrivateKey($client_id = null){
		return  $this->pvk;
	}

	public function getEncryptionAlgorithm($client_id = null){
		return 'HS256';
	}

}