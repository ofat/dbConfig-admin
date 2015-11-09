<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\DbConfigAdmin;

class LogItem extends \Eloquent
{
    protected $fillable = [
        'field',
        'diff',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = \Config::get('dbConfigAdmin.logs_table', 'settings_logs');
    }
}