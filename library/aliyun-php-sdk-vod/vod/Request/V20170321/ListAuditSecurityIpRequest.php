<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace vod\Request\V20170321;

class ListAuditSecurityIpRequest extends \RpcAcsRequest
{
    public function __construct()
    {
        parent::__construct('vod', '2017-03-21', 'ListAuditSecurityIp', 'vod', 'openAPI');
        $this->setMethod('POST');
    }

    private $securityGroupName;

    public function getSecurityGroupName()
    {
        return $this->securityGroupName;
    }

    public function setSecurityGroupName($securityGroupName)
    {
        $this->securityGroupName = $securityGroupName;
        $this->queryParameters['SecurityGroupName'] = $securityGroupName;
    }
}
