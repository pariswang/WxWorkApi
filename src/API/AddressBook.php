<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2018/12/26
 * Time: 11:43 PM
 */

namespace Pariswang\WxWorkApi\API;

use Pariswang\WxWorkApi\API\Traits\Batch;
use Pariswang\WxWorkApi\API\Traits\Department;
use Pariswang\WxWorkApi\API\Traits\Tag;
use Pariswang\WxWorkApi\API\Traits\User;

class AddressBook extends BaseAPI
{
    use Batch, Department, User, Tag;
}