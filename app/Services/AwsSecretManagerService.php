<?php

namespace App\Services;
use Aws\SecretsManager\SecretsManagerClient; 
use Aws\Exception\AwsException;
use Aws\Credentials\CredentialProvider;
use Aws\S3\S3Client;

class AwsSecretManagerService
{
	
	function __construct()
	{
		$this->configVariables = config('secret-manager.configVariables');
		$this->region = config('secret-manager.aws.region');
		$this->secretName = config('secret-manager.aws.secretName');

		$this->isSecretManagerLoaded = config("isSecretManagerLoaded",false);
		$this->checkSecretManagerApi = config('secret-manager.checkSecretManagerApi',false);
	}


	public function loadSecrets(){

		//Only run this if the evironment is enabled
		if(!$this->isSecretManagerLoaded || $this->checkSecretManagerApi){

			// Get env variables from aws secret manager
			$client = new SecretsManagerClient([
			    'version' => 'latest',
			    'region' => $this->region,
			]);

			try {
			    $result = $client->getSecretValue([
			        'SecretId' => $this->secretName,
			    ]);
			} catch (AwsException $e) {
			    $error = $e->getAwsErrorCode();
			    if ($error == 'DecryptionFailureException') {
			        throw $e;
			    }
			    if ($error == 'InternalServiceErrorException') {
			        throw $e;
			    }
			    if ($error == 'InvalidParameterException') {
			        throw $e;
			    }
			    if ($error == 'InvalidRequestException') {
			        throw $e;
			    }
			    if ($error == 'ResourceNotFoundException') {
			        throw $e;
			    }
			}

			if (isset($result['SecretString'])) {
			    $variable = json_decode($result['SecretString']);
			} else {
			    $variable = json_decode(base64_decode($result['SecretBinary']));
			}

			if(!empty($variable)){
				foreach ($variable as $key => $value) {
					putenv($key."=".$value);

				}

				//Process variables in config that need updating
				$this->updateConfigs();
			}
		}
	}


	protected function updateConfigs()
    {
    	// Update config variables from env
        foreach ($this->configVariables as $variable => $configPath) {
        	if(!empty(getenv($variable))){
            	config([$configPath => getenv($variable)]);
            }
        }

        config(["isSecretManagerLoaded" => true]);
    }
}