<?php
    $data = $_POST['data'];
    $file_name = $_POST['file_name'];

    file_put_contents ( 'result', $data );

    require 's3-sdk.php';
    if (!defined('awsAccessKey')) define('awsAccessKey', getenv ('AWS_ACCESS_KEY_ID') );
    if (!defined('awsSecretKey')) define('awsSecretKey', getenv ('AWS_SECRET_ACCESS_KEY') );

    $s3 = new S3(awsAccessKey, awsSecretKey);

    $bucket_queries = 'user-study-queries';
    $bucket_result = 'user-study-results';

    $file = 'result';
    $s3->putObject($s3->inputFile($file, false), $bucket_result, $file_name, S3::ACL_PUBLIC_READ);
    // $s3->putObject(( string ) $data, $bucket_result, $file_name, S3::ACL_PUBLIC_READ, array(), array('Content-Type' => 'text/plain'));
?>
