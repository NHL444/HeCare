<?php

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements AuthenticatableContract
{
    use HasFactory;
    use Authenticatable;
    protected $fillable = [ 'name', 'email', 'password', 'role' ];
    protected $table = 'admins';
    protected $primaryKey = 'id';

    public function getAuthPassword()
    {
        return $this->password;
    }
}
