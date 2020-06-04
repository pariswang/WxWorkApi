<?php
/**
 * Created by PhpStorm.
 * User: pariswang
 * Date: 2018/12/26
 * Time: 11:43 PM
 */

namespace Paris\WxWorkApi\API;

use Paris\WxWorkApi\API\Traits\Batch;
use Paris\WxWorkApi\API\Traits\Department;
use Paris\WxWorkApi\API\Traits\Tag;
use Paris\WxWorkApi\API\Traits\User;

class AddressBook extends BaseAPI
{
    use Batch, Department, User, Tag;
}