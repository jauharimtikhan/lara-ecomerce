<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';

    public function convertUuidToWireModel(string $id)
    {
        if($this->find($id)){
            $count = $this->count();
            $i = time();
         return "permission.{$this->name}.{$i}";
        }

    }
}
