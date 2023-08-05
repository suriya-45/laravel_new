<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class users extends Model implements Authenticatable
{
    use HasFactory;
    protected $table = "users";

    protected $fillable =[
        "name",
        "email",
        "password",
        "github_id"
    ];
// Implement the required methods from the Authenticatable interface
public function getAuthIdentifierName()
{
    return 'id'; // Change this to the name of your primary key column if it's not 'id'
}

public function getAuthIdentifier()
{
    return $this->{$this->getAuthIdentifierName()};
}

public function getAuthPassword()
{
    return $this->password;
}
public function getRememberToken()
{
    return $this->remember_token;
}

public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

public function getRememberTokenName()
{
   
}


}
