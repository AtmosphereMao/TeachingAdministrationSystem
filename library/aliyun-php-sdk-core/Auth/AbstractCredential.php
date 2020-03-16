<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

abstract class AbstractCredential
{
    abstract public function getAccessKeyId();

    abstract public function getAccessSecret();

    abstract public function getSecurityToken();
}
