<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseModel extends Model
{
    use HasFactory;

    public String $language = "C";
    public Int $appeared = 1972;
    public String $created = "Dennis Ritchie";
    public Bool $functional = true;
    public Bool $object_oriented = false;
    public array $relation = [
        "influenced-by" => ["B", "ALGOL 68", "Assembly", "FORTRAN"],
        "influences" => ["C++", "Objective-C", "C#", "Java", "JavaScript", "PHP", "Go"]
    ];
}
