<?php

namespace Omnipay\Alipay;

use Omnipay\Alipay\Requests\DataServiceBillDownloadUrlQueryRequest;
use Omnipay\Alipay\Requests\TradeCancelRequest;
use Omnipay\Alipay\Requests\TradeOrderSettleRequest;
use Omnipay\Alipay\Requests\TradeQueryRequest;
use Omnipay\Alipay\Requests\TradeRefundQueryRequest;
use Omnipay\Alipay\Requests\TradeRefundRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Exception\InvalidRequestException;

abstract class AbstractAopGateway extends AbstractGateway
{
    protected $endpoints = [
        'production' => 'https://openapi.alipay.com/gateway.do',
        'sandbox'    => 'https://openapi.alipaydev.com/gateway.do',
    ];


    public function getDefaultParameters()
    {
        return [
            'format'     => 'JSON',
            'charset'    => 'UTF-8',
            'signType'   => 'RSA',
            'version'    => '1.0',
            'timestamp'  => date('Y-m-d H:i:s'),
            'alipaySdk' => 'lokielse/omnipay-alipay',
        ];
    }


    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->getParameter('app_id');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setAppId($value)
    {
        return $this->setParameter('app_id', $value);
    }


    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->getParameter('format');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setFormat($value)
    {
        return $this->setParameter('format', $value);
    }


    /**
     * @return mixed
     */
    public function getCharset()
    {
        return $this->getParameter('charset');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setCharset($value)
    {
        return $this->setParameter('charset', $value);
    }


    /**
     * @return mixed
     */
    public function getSignType()
    {
        return $this->getParameter('sign_type');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setSignType($value)
    {
        return $this->setParameter('sign_type', $value);
    }


    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->getParameter('version');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setVersion($value)
    {
        return $this->setParameter('version', $value);
    }


    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->getParameter('private_key');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setPrivateKey($value)
    {
        return $this->setParameter('private_key', $value);
    }


    /**
     * @return mixed
     */
    public function getEncryptKey()
    {
        return $this->getParameter('encrypt_key');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setEncryptKey($value)
    {
        return $this->setParameter('encrypt_key', $value);
    }


    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setNotifyUrl($value)
    {
        return $this->setParameter('notify_url', $value);
    }


    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->getParameter('timestamp');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setTimestamp($value)
    {
        return $this->setParameter('timestamp', $value);
    }


    /**
     * @return mixed
     */
    public function getAppAuthToken()
    {
        return $this->getParameter('app_auth_token');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setAppAuthToken($value)
    {
        return $this->setParameter('app_auth_token', $value);
    }


    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }


    /**
     * @return mixed
     */
    public function getAlipaySdk()
    {
        return $this->getParameter('alipay_sdk');
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setAlipaySdk($value)
    {
        return $this->setParameter('alipay_sdk', $value);
    }


    public function production()
    {
        return $this->setEnvironment('production');
    }


    /**
     * @param $value
     *
     * @return $this
     * @throws InvalidRequestException
     */
    public function setEnvironment($value)
    {
        $env = strtolower($value);

        if (! isset($this->endpoints[$env])) {
            throw new InvalidRequestException('The environment is invalid');
        }

        $this->setEndpoint($this->endpoints[$env]);

        return $this;
    }


    /**
     * @param $value
     *
     * @return $this
     */
    public function setEndpoint($value)
    {
        return $this->setParameter('endpoint', $value);
    }


    public function sandbox()
    {
        return $this->setEnvironment('sandbox');
    }


    /**
     * Query Order Status
     *
     * @param array $parameters
     *
     * @return TradeQueryRequest
     */
    public function query(array $parameters = [])
    {
        return $this->createRequest(TradeQueryRequest::class, $parameters);
    }


    /**
     * Refund
     *
     * @param array $parameters
     *
     * @return TradeRefundRequest
     */
    public function refund(array $parameters = [])
    {
        return $this->createRequest(TradeRefundRequest::class, $parameters);
    }


    /**
     * Query Refund Status
     *
     * @param array $parameters
     *
     * @return TradeRefundQueryRequest
     */
    public function refundQuery(array $parameters = [])
    {
        return $this->createRequest(TradeRefundQueryRequest::class, $parameters);
    }


    /**
     * Cancel Order
     *
     * @param array $parameters
     *
     * @return TradeCancelRequest
     */
    public function cancel(array $parameters = [])
    {
        return $this->createRequest(TradeCancelRequest::class, $parameters);
    }


    /**
     * Settle
     *
     * @param array $parameters
     *
     * @return TradeCancelRequest
     */
    public function settle(array $parameters = [])
    {
        return $this->createRequest(TradeOrderSettleRequest::class, $parameters);
    }


    /**
     * @param array $parameters
     *
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function queryBillDownloadUrl(array $parameters = [])
    {
        return $this->createRequest(DataServiceBillDownloadUrlQueryRequest::class, $parameters);
    }
}