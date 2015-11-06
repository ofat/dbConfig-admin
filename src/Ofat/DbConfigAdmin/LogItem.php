<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\DbConfigAdmin;

class LogItem extends \Eloquent
{
    protected $fillable = [
        'field',
        'old_value',
        'new_value',
        'old_comment',
        'new_comment',
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