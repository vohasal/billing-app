<?php

namespace App\DTO;

use Zerotoprod\DataModel\DataModel;

class UserDTO
{
    use DataModel;

    public readonly int $id;
    public readonly string $name;
    public readonly string $email;

}
