<?php

namespace App\Models;


use Carbon\Carbon;
use DB;
class Oracle
{

function get_oracle_client($endpoint)
{
	$ORACLE_ACCESS_KEY=env('ORACLE_ACCESS_KEY');
	$ORACLE_SECRET_KEY=env('ORACLE_SECRET_KEY');
	$ORACLE_REGION=env('ORACLE_REGION');
	$ORACLE_NAMESPACE=env('ORACLE_NAMESPACE');

    $endpoint = "https://".$ORACLE_NAMESPACE.".compat.objectstorage.".$ORACLE_REGION.".oraclecloud.com/{$endpoint}";

    return new \Aws\S3\S3Client(array(
        'credentials' => [
            'key' => $ORACLE_ACCESS_KEY,
            'secret' => $ORACLE_SECRET_KEY,
        ],
        'version' => 'latest',
        'region' => $ORACLE_REGION,
        'bucket_endpoint' => true,
        'endpoint' => $endpoint
    ));
}

function upload_file_oracle($bucket_name, $folder_name = '', $file_name)
{
	$ORACLE_ACCESS_KEY=env('ORACLE_ACCESS_KEY');
	$ORACLE_SECRET_KEY=env('ORACLE_SECRET_KEY');
	$ORACLE_REGION=env('ORACLE_REGION');
	$ORACLE_NAMESPACE=env('ORACLE_NAMESPACE');

    if (empty(trim($bucket_name))) {
        return array('success' => false, 'message' => 'Please provide valid bucket name!');
    }

    if (empty(trim($file_name))) {
        return array('success' => false, 'message' => 'Please provide valid file name!');
    }

    if ($folder_name !== '') {
        $keyname = $folder_name . '/' . $file_name;
        $endpoint =  "{$bucket_name}/";
    } else {
        $keyname = $file_name;
        $endpoint =  "{$bucket_name}/{$keyname}";
    }

   
    $s3 = $this->get_oracle_client($endpoint);
    $s3->getEndpoint();
    
    $file_url = "https://objectstorage.ap-sydney-1.oraclecloud.com/p/2fANS0nPcqP9_Mqj-uKtDUia9MVwElYUxkDLKkoUzvRAbqxdW7D38v2sdas12tgg/n/sdbkcr4a47hl/b/bucket-20211031-1512/o/{$keyname}";
    try {
        $s3->putObject(array(
            'Bucket' => $bucket_name,
            'Key' => $keyname,
            'SourceFile' => new \GuzzleHttp\Psr7\CachingStream(
                    new \GuzzleHttp\Psr7\Stream(fopen(url('customer').'/'.$file_name, 'r'))),
            'StorageClass' => 'REDUCED_REDUNDANCY'
        ));

        return array('success' => true, 'message' => $file_url);
    } catch (S3Exception $e) {
        return array('success' => false, 'message' => $e->getMessage());
    } catch (Exception $e) {
        return array('success' => false, 'message' => $e->getMessage());
    }
}

	public function upFileOracle($file_name)
	{
		$bucket_name='bucket-20211031-1512';
		$folder_name='travelandong';
		$upload = $this->upload_file_oracle($bucket_name, $folder_name, $file_name);
		return $upload;
	}
}