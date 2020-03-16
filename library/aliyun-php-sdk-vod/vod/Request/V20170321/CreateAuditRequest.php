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

class CreateAuditRequest extends \RpcAcsRequest
{
    public function __construct()
    {
        parent::__construct('vod', '2017-03-21', 'CreateAudit', 'vod', 'openAPI');
        $this->setMethod('POST');
    }

    private $auditContent;

    public function getAuditContent()
    {
        return $this->auditContent;
    }

    public function setAuditContent($auditContent)
    {
        $this->auditContent = $auditContent;
        $this->queryParameters['AuditContent'] = $auditContent;
    }
}
