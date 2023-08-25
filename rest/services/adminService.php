<?php

require_once(__DIR__ . '/../BaseService.class.php');
require_once __DIR__ . '/../dao/AdminDao.class.php';

class AdminService extends BaseService
{
    public function __construct()
    {
        parent::__construct(new AdminDao);
    }
}