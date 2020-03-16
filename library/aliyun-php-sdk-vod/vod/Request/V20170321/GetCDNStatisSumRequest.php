<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace vod\Request\V20170321;

class GetCDNStatisSumRequest extends \RpcAcsRequest
{
    public function __construct()
    {
        parent::__construct('vod', '2017-03-21', 'GetCDNStatisSum', 'vod', 'openAPI');
        $this->setMethod('POST');
    }

    private $resourceOwnerId;

    private $startStatisTime;

    private $resourceOwnerAccount;

    private $level;

    private $ownerAccount;

    private $ownerId;

    private $endStatisTime;

    public function getResourceOwnerId()
    {
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;
    }

    public function getStartStatisTime()
    {
        return $this->startStatisTime;
    }

    public function setStartStatisTime($startStatisTime)
    {
        $this->startStatisTime = $startStatisTime;
        $this->queryParameters['StartStatisTime'] = $startStatisTime;
    }

    public function getResourceOwnerAccount()
    {
        return $this->resourceOwnerAccount;
    }

    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->resourceOwnerAccount = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($level)
    {
        $this->level = $level;
        $this->queryParameters['Level'] = $level;
    }

    public function getOwnerAccount()
    {
        return $this->ownerAccount;
    }

    public function setOwnerAccount($ownerAccount)
    {
        $this->ownerAccount = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;
    }

    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;
    }

    public function getEndStatisTime()
    {
        return $this->endStatisTime;
    }

    public function setEndStatisTime($endStatisTime)
    {
        $this->endStatisTime = $endStatisTime;
        $this->queryParameters['EndStatisTime'] = $endStatisTime;
    }
}
