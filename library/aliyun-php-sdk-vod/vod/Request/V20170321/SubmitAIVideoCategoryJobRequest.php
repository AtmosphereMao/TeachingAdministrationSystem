<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace vod\Request\V20170321;

class SubmitAIVideoCategoryJobRequest extends \RpcAcsRequest
{
    public function __construct()
    {
        parent::__construct('vod', '2017-03-21', 'SubmitAIVideoCategoryJob', 'vod', 'openAPI');
        $this->setMethod('POST');
    }

    private $aIVideoCategoryConfig;

    private $userData;

    private $resourceOwnerId;

    private $resourceOwnerAccount;

    private $ownerAccount;

    private $ownerId;

    private $mediaId;

    public function getAIVideoCategoryConfig()
    {
        return $this->aIVideoCategoryConfig;
    }

    public function setAIVideoCategoryConfig($aIVideoCategoryConfig)
    {
        $this->aIVideoCategoryConfig = $aIVideoCategoryConfig;
        $this->queryParameters['AIVideoCategoryConfig'] = $aIVideoCategoryConfig;
    }

    public function getUserData()
    {
        return $this->userData;
    }

    public function setUserData($userData)
    {
        $this->userData = $userData;
        $this->queryParameters['UserData'] = $userData;
    }

    public function getResourceOwnerId()
    {
        return $this->resourceOwnerId;
    }

    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->resourceOwnerId = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;
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

    public function getMediaId()
    {
        return $this->mediaId;
    }

    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->queryParameters['MediaId'] = $mediaId;
    }
}
