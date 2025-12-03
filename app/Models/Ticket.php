<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Department;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
        'admin_note'
    ];

    public static function onDepartment(string $type)
    {
        $departments = Department::list();

        foreach ($departments as $key => $dept) {
            if ($dept['label'] === $type) {
                $connection = $dept['connection'];
                break;
            }
        }

        $instance = new static();
        $instance->setConnection($connection);

        return $instance;
    }

}
