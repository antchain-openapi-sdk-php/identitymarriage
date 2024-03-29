<?php

// This file is auto-generated, don't edit it. Thanks.

namespace AntChain\IDENTITYMARRIAGE;

use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Exception\TeaUnableRetryError;
use AlibabaCloud\Tea\Request;
use AlibabaCloud\Tea\RpcUtils\RpcUtils;
use AlibabaCloud\Tea\Tea;
use AlibabaCloud\Tea\Utils\Utils;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use AntChain\IDENTITYMARRIAGE\Models\CheckMarriageCoupleinfoRequest;
use AntChain\IDENTITYMARRIAGE\Models\CheckMarriageCoupleinfoResponse;
use AntChain\IDENTITYMARRIAGE\Models\CheckMarriageInfoRequest;
use AntChain\IDENTITYMARRIAGE\Models\CheckMarriageInfoResponse;
use AntChain\IDENTITYMARRIAGE\Models\CreateAntcloudGatewayxFileUploadRequest;
use AntChain\IDENTITYMARRIAGE\Models\CreateAntcloudGatewayxFileUploadResponse;
use AntChain\IDENTITYMARRIAGE\Models\NotifyMarriageInfoRequest;
use AntChain\IDENTITYMARRIAGE\Models\NotifyMarriageInfoResponse;
use AntChain\IDENTITYMARRIAGE\Models\QueryMarriageInfoRequest;
use AntChain\IDENTITYMARRIAGE\Models\QueryMarriageInfoResponse;
use AntChain\IDENTITYMARRIAGE\Models\SubmitMarriageCoupleinfoRequest;
use AntChain\IDENTITYMARRIAGE\Models\SubmitMarriageCoupleinfoResponse;
use AntChain\IDENTITYMARRIAGE\Models\SubmitMarriageInfoRequest;
use AntChain\IDENTITYMARRIAGE\Models\SubmitMarriageInfoResponse;
use AntChain\IDENTITYMARRIAGE\Models\UploadFileDataRequest;
use AntChain\IDENTITYMARRIAGE\Models\UploadFileDataResponse;
use AntChain\IDENTITYMARRIAGE\Models\UploadMarriageFileRequest;
use AntChain\IDENTITYMARRIAGE\Models\UploadMarriageFileResponse;
use AntChain\Util\UtilClient;
use Exception;

class Client
{
    protected $_endpoint;

    protected $_regionId;

    protected $_accessKeyId;

    protected $_accessKeySecret;

    protected $_protocol;

    protected $_userAgent;

    protected $_readTimeout;

    protected $_connectTimeout;

    protected $_httpProxy;

    protected $_httpsProxy;

    protected $_socks5Proxy;

    protected $_socks5NetWork;

    protected $_noProxy;

    protected $_maxIdleConns;

    protected $_securityToken;

    protected $_maxIdleTimeMillis;

    protected $_keepAliveDurationMillis;

    protected $_maxRequests;

    protected $_maxRequestsPerHost;

    /**
     * Init client with Config.
     *
     * @param config config contains the necessary information to create a client
     * @param mixed $config
     */
    public function __construct($config)
    {
        if (Utils::isUnset($config)) {
            throw new TeaError([
                'code'    => 'ParameterMissing',
                'message' => "'config' can not be unset",
            ]);
        }
        $this->_accessKeyId             = $config->accessKeyId;
        $this->_accessKeySecret         = $config->accessKeySecret;
        $this->_securityToken           = $config->securityToken;
        $this->_endpoint                = $config->endpoint;
        $this->_protocol                = $config->protocol;
        $this->_userAgent               = $config->userAgent;
        $this->_readTimeout             = Utils::defaultNumber($config->readTimeout, 20000);
        $this->_connectTimeout          = Utils::defaultNumber($config->connectTimeout, 20000);
        $this->_httpProxy               = $config->httpProxy;
        $this->_httpsProxy              = $config->httpsProxy;
        $this->_noProxy                 = $config->noProxy;
        $this->_socks5Proxy             = $config->socks5Proxy;
        $this->_socks5NetWork           = $config->socks5NetWork;
        $this->_maxIdleConns            = Utils::defaultNumber($config->maxIdleConns, 60000);
        $this->_maxIdleTimeMillis       = Utils::defaultNumber($config->maxIdleTimeMillis, 5);
        $this->_keepAliveDurationMillis = Utils::defaultNumber($config->keepAliveDurationMillis, 5000);
        $this->_maxRequests             = Utils::defaultNumber($config->maxRequests, 100);
        $this->_maxRequestsPerHost      = Utils::defaultNumber($config->maxRequestsPerHost, 100);
    }

    /**
     * Encapsulate the request and invoke the network.
     *
     * @param string         $version
     * @param string         $action   api name
     * @param string         $protocol http or https
     * @param string         $method   e.g. GET
     * @param string         $pathname pathname of every api
     * @param mixed[]        $request  which contains request params
     * @param string[]       $headers
     * @param RuntimeOptions $runtime  which controls some details of call api, such as retry times
     *
     * @throws TeaError
     * @throws Exception
     * @throws TeaUnableRetryError
     *
     * @return array the response
     */
    public function doRequest($version, $action, $protocol, $method, $pathname, $request, $headers, $runtime)
    {
        $runtime->validate();
        $_runtime = [
            'timeouted'          => 'retry',
            'readTimeout'        => Utils::defaultNumber($runtime->readTimeout, $this->_readTimeout),
            'connectTimeout'     => Utils::defaultNumber($runtime->connectTimeout, $this->_connectTimeout),
            'httpProxy'          => Utils::defaultString($runtime->httpProxy, $this->_httpProxy),
            'httpsProxy'         => Utils::defaultString($runtime->httpsProxy, $this->_httpsProxy),
            'noProxy'            => Utils::defaultString($runtime->noProxy, $this->_noProxy),
            'maxIdleConns'       => Utils::defaultNumber($runtime->maxIdleConns, $this->_maxIdleConns),
            'maxIdleTimeMillis'  => $this->_maxIdleTimeMillis,
            'keepAliveDuration'  => $this->_keepAliveDurationMillis,
            'maxRequests'        => $this->_maxRequests,
            'maxRequestsPerHost' => $this->_maxRequestsPerHost,
            'retry'              => [
                'retryable'   => $runtime->autoretry,
                'maxAttempts' => Utils::defaultNumber($runtime->maxAttempts, 3),
            ],
            'backoff' => [
                'policy' => Utils::defaultString($runtime->backoffPolicy, 'no'),
                'period' => Utils::defaultNumber($runtime->backoffPeriod, 1),
            ],
            'ignoreSSL' => $runtime->ignoreSSL,
            // 键值对
        ];
        $_lastRequest   = null;
        $_lastException = null;
        $_now           = time();
        $_retryTimes    = 0;
        while (Tea::allowRetry(@$_runtime['retry'], $_retryTimes, $_now)) {
            if ($_retryTimes > 0) {
                $_backoffTime = Tea::getBackoffTime(@$_runtime['backoff'], $_retryTimes);
                if ($_backoffTime > 0) {
                    Tea::sleep($_backoffTime);
                }
            }
            $_retryTimes = $_retryTimes + 1;

            try {
                $_request           = new Request();
                $_request->protocol = Utils::defaultString($this->_protocol, $protocol);
                $_request->method   = $method;
                $_request->pathname = $pathname;
                $_request->query    = [
                    'method'           => $action,
                    'version'          => $version,
                    'sign_type'        => 'HmacSHA1',
                    'req_time'         => UtilClient::getTimestamp(),
                    'req_msg_id'       => UtilClient::getNonce(),
                    'access_key'       => $this->_accessKeyId,
                    'base_sdk_version' => 'TeaSDK-2.0',
                    'sdk_version'      => '1.0.10',
                    '_prod_code'       => 'IDENTITYMARRIAGE',
                    '_prod_channel'    => 'undefined',
                ];
                if (!Utils::empty_($this->_securityToken)) {
                    $_request->query['security_token'] = $this->_securityToken;
                }
                $_request->headers = Tea::merge([
                    'host'       => Utils::defaultString($this->_endpoint, 'openapi.antchain.antgroup.com'),
                    'user-agent' => Utils::getUserAgent($this->_userAgent),
                ], $headers);
                $tmp                               = Utils::anyifyMapValue(RpcUtils::query($request));
                $_request->body                    = Utils::toFormString($tmp);
                $_request->headers['content-type'] = 'application/x-www-form-urlencoded';
                $signedParam                       = Tea::merge($_request->query, RpcUtils::query($request));
                $_request->query['sign']           = UtilClient::getSignature($signedParam, $this->_accessKeySecret);
                $_lastRequest                      = $_request;
                $_response                         = Tea::send($_request, $_runtime);
                $raw                               = Utils::readAsString($_response->body);
                $obj                               = Utils::parseJSON($raw);
                $res                               = Utils::assertAsMap($obj);
                $resp                              = Utils::assertAsMap(@$res['response']);
                if (UtilClient::hasError($raw, $this->_accessKeySecret)) {
                    throw new TeaError([
                        'message' => @$resp['result_msg'],
                        'data'    => $resp,
                        'code'    => @$resp['result_code'],
                    ]);
                }

                return $resp;
            } catch (Exception $e) {
                if (!($e instanceof TeaError)) {
                    $e = new TeaError([], $e->getMessage(), $e->getCode(), $e);
                }
                if (Tea::isRetryable($e)) {
                    $_lastException = $e;

                    continue;
                }

                throw $e;
            }
        }

        throw new TeaUnableRetryError($_lastRequest, $_lastException);
    }

    /**
     * Description: 婚姻状况核查
     * Summary: 婚姻状况核查.
     *
     * @param CheckMarriageInfoRequest $request
     *
     * @return CheckMarriageInfoResponse
     */
    public function checkMarriageInfo($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->checkMarriageInfoEx($request, $headers, $runtime);
    }

    /**
     * Description: 婚姻状况核查
     * Summary: 婚姻状况核查.
     *
     * @param CheckMarriageInfoRequest $request
     * @param string[]                 $headers
     * @param RuntimeOptions           $runtime
     *
     * @return CheckMarriageInfoResponse
     */
    public function checkMarriageInfoEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return CheckMarriageInfoResponse::fromMap($this->doRequest('1.0', 'identity.marriage.marriage.info.check', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 婚姻状况通知
     * Summary: 婚姻状况通知.
     *
     * @param NotifyMarriageInfoRequest $request
     *
     * @return NotifyMarriageInfoResponse
     */
    public function notifyMarriageInfo($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->notifyMarriageInfoEx($request, $headers, $runtime);
    }

    /**
     * Description: 婚姻状况通知
     * Summary: 婚姻状况通知.
     *
     * @param NotifyMarriageInfoRequest $request
     * @param string[]                  $headers
     * @param RuntimeOptions            $runtime
     *
     * @return NotifyMarriageInfoResponse
     */
    public function notifyMarriageInfoEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return NotifyMarriageInfoResponse::fromMap($this->doRequest('1.0', 'identity.marriage.marriage.info.notify', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 核婚授权文件上传
     * Summary: 核婚授权文件上传.
     *
     * @param UploadFileDataRequest $request
     *
     * @return UploadFileDataResponse
     */
    public function uploadFileData($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->uploadFileDataEx($request, $headers, $runtime);
    }

    /**
     * Description: 核婚授权文件上传
     * Summary: 核婚授权文件上传.
     *
     * @param UploadFileDataRequest $request
     * @param string[]              $headers
     * @param RuntimeOptions        $runtime
     *
     * @return UploadFileDataResponse
     */
    public function uploadFileDataEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return UploadFileDataResponse::fromMap($this->doRequest('1.0', 'identity.marriage.file.data.upload', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 双人婚姻状况核查
     * Summary: 双人婚姻状况核查.
     *
     * @param CheckMarriageCoupleinfoRequest $request
     *
     * @return CheckMarriageCoupleinfoResponse
     */
    public function checkMarriageCoupleinfo($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->checkMarriageCoupleinfoEx($request, $headers, $runtime);
    }

    /**
     * Description: 双人婚姻状况核查
     * Summary: 双人婚姻状况核查.
     *
     * @param CheckMarriageCoupleinfoRequest $request
     * @param string[]                       $headers
     * @param RuntimeOptions                 $runtime
     *
     * @return CheckMarriageCoupleinfoResponse
     */
    public function checkMarriageCoupleinfoEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return CheckMarriageCoupleinfoResponse::fromMap($this->doRequest('1.0', 'identity.marriage.marriage.coupleinfo.check', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 单人婚姻状况核查异步提交
     * Summary: 单人婚姻状况核查异步提交.
     *
     * @param SubmitMarriageInfoRequest $request
     *
     * @return SubmitMarriageInfoResponse
     */
    public function submitMarriageInfo($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->submitMarriageInfoEx($request, $headers, $runtime);
    }

    /**
     * Description: 单人婚姻状况核查异步提交
     * Summary: 单人婚姻状况核查异步提交.
     *
     * @param SubmitMarriageInfoRequest $request
     * @param string[]                  $headers
     * @param RuntimeOptions            $runtime
     *
     * @return SubmitMarriageInfoResponse
     */
    public function submitMarriageInfoEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return SubmitMarriageInfoResponse::fromMap($this->doRequest('1.0', 'identity.marriage.marriage.info.submit', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 双人婚姻状况核查异步提交
     * Summary: 双人婚姻状况核查异步提交.
     *
     * @param SubmitMarriageCoupleinfoRequest $request
     *
     * @return SubmitMarriageCoupleinfoResponse
     */
    public function submitMarriageCoupleinfo($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->submitMarriageCoupleinfoEx($request, $headers, $runtime);
    }

    /**
     * Description: 双人婚姻状况核查异步提交
     * Summary: 双人婚姻状况核查异步提交.
     *
     * @param SubmitMarriageCoupleinfoRequest $request
     * @param string[]                        $headers
     * @param RuntimeOptions                  $runtime
     *
     * @return SubmitMarriageCoupleinfoResponse
     */
    public function submitMarriageCoupleinfoEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return SubmitMarriageCoupleinfoResponse::fromMap($this->doRequest('1.0', 'identity.marriage.marriage.coupleinfo.submit', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 婚姻状况核查异步查询
     * Summary: 婚姻状况核查异步查询.
     *
     * @param QueryMarriageInfoRequest $request
     *
     * @return QueryMarriageInfoResponse
     */
    public function queryMarriageInfo($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->queryMarriageInfoEx($request, $headers, $runtime);
    }

    /**
     * Description: 婚姻状况核查异步查询
     * Summary: 婚姻状况核查异步查询.
     *
     * @param QueryMarriageInfoRequest $request
     * @param string[]                 $headers
     * @param RuntimeOptions           $runtime
     *
     * @return QueryMarriageInfoResponse
     */
    public function queryMarriageInfoEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return QueryMarriageInfoResponse::fromMap($this->doRequest('1.0', 'identity.marriage.marriage.info.query', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 授权文件上传接口
     * Summary: 上传文件接口.
     *
     * @param UploadMarriageFileRequest $request
     *
     * @return UploadMarriageFileResponse
     */
    public function uploadMarriageFile($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->uploadMarriageFileEx($request, $headers, $runtime);
    }

    /**
     * Description: 授权文件上传接口
     * Summary: 上传文件接口.
     *
     * @param UploadMarriageFileRequest $request
     * @param string[]                  $headers
     * @param RuntimeOptions            $runtime
     *
     * @return UploadMarriageFileResponse
     */
    public function uploadMarriageFileEx($request, $headers, $runtime)
    {
        if (!Utils::isUnset($request->fileObject)) {
            $uploadReq = new CreateAntcloudGatewayxFileUploadRequest([
                'authToken' => $request->authToken,
                'apiCode'   => 'identity.marriage.marriage.file.upload',
                'fileName'  => $request->fileObjectName,
            ]);
            $uploadResp = $this->createAntcloudGatewayxFileUploadEx($uploadReq, $headers, $runtime);
            if (!UtilClient::isSuccess($uploadResp->resultCode, 'ok')) {
                return new UploadMarriageFileResponse([
                    'reqMsgId'   => $uploadResp->reqMsgId,
                    'resultCode' => $uploadResp->resultCode,
                    'resultMsg'  => $uploadResp->resultMsg,
                ]);
            }
            $uploadHeaders = UtilClient::parseUploadHeaders($uploadResp->uploadHeaders);
            UtilClient::putObject($request->fileObject, $uploadHeaders, $uploadResp->uploadUrl);
            $request->fileId = $uploadResp->fileId;
        }
        Utils::validateModel($request);

        return UploadMarriageFileResponse::fromMap($this->doRequest('1.0', 'identity.marriage.marriage.file.upload', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }

    /**
     * Description: 创建HTTP PUT提交的文件上传
     * Summary: 文件上传创建.
     *
     * @param CreateAntcloudGatewayxFileUploadRequest $request
     *
     * @return CreateAntcloudGatewayxFileUploadResponse
     */
    public function createAntcloudGatewayxFileUpload($request)
    {
        $runtime = new RuntimeOptions([]);
        $headers = [];

        return $this->createAntcloudGatewayxFileUploadEx($request, $headers, $runtime);
    }

    /**
     * Description: 创建HTTP PUT提交的文件上传
     * Summary: 文件上传创建.
     *
     * @param CreateAntcloudGatewayxFileUploadRequest $request
     * @param string[]                                $headers
     * @param RuntimeOptions                          $runtime
     *
     * @return CreateAntcloudGatewayxFileUploadResponse
     */
    public function createAntcloudGatewayxFileUploadEx($request, $headers, $runtime)
    {
        Utils::validateModel($request);

        return CreateAntcloudGatewayxFileUploadResponse::fromMap($this->doRequest('1.0', 'antcloud.gatewayx.file.upload.create', 'HTTPS', 'POST', '/gateway.do', Tea::merge($request), $headers, $runtime));
    }
}
