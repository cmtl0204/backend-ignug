<?php

namespace App\Models\LicenseWork;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $table= 'license.employers';
    protected $filable=[
        'logo',
        'department',
        'coordination',
        'unit',
        'approval_name',
        'register_name',
        
    ];
    // Scopes
    public function scopeLogo($query, $logo)
    {
        if ($logo) {
            return $query->orWhere('logo', 'ILIKE', "%$logo%");
        }
    }

    public function scopeDepartment($query, $department)
    {
        if ($department) {
            return $query->orWhere('department', 'ILIKE', "%$department%");
        }
    }
    public function scopeCoordination($query, $coordination)
    {
        if ($coordination) {
            return $query->orWhere('coordination', 'ILIKE', "%$coordination%");
        }
    }

    public function scopeUnit($query, $unit)
    {
        if ($unit) {
            return $query->orWhere('unit', 'ILIKE', "%$unit%");
        }
    }
    public function scopeApprovalName($query, $approval_name)
    {
        if ($approval_name) {
            return $query->orWhere('approval_name', 'ILIKE', "%$approval_name%");
        }
    }

    public function scopeRegisterName($query, $register_name)
    {
        if ($register_name) {
            return $query->orWhere('register_name', 'ILIKE', "%$register_name%");
        }
    }
    public function scopeCustomOrderBy($query, $sorts)
    {
        if (!empty($sorts[0])) {
            foreach ($sorts as $sort) {
                $field = explode('-', $sort);
                if (empty($field[0]) && in_array($field[1], $this->fillable)) {
                    $query = $query->orderByDesc($field[1]);
                } else if (in_array($field[0], $this->fillable)) {
                    $query = $query->orderBy($field[0]);
                }
            }
            return $query;
        }
    }

    public function scopeCustomSelect($query, $fields)
    {
        if (!empty($fields)) {
            $fields = explode(',', $fields);
            foreach ($fields as $field) {
                $fieldExist = array_search(strtolower($field), $fields);
                if ($fieldExist == false) {
                    unset($fields[$fieldExist]);
                }
            }

            array_unshift($fields, 'id');
            return $query->select($fields);
        }
    }
}
