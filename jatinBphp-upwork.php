<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
   use HasFactory, Notifiable,SoftDeletes;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'role_id',
       'name',
       'real_name',
       'email',
       'password',
   ];

   /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
   protected $hidden = [
       'password',
       'remember_token',
   ];

   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [
       'email_verified_at' => 'datetime',
   ];

   /**
    * [leads description]
    * @return [type] [description]
    */
   public function leads()
   {
       return $this->belongsToMany('App\Models\Lead', 'lead_id', 'id')->whereNotNull("id");
   }
}
<?php

namespace App\Models;

use App\Traits\StudioTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
   use SoftDeletes;
   protected $table   = "leads";
   public $timestamps = true;

   /**
    * [notes description]
    *
    * @return  [type]  [description]
    */
   public function notes()
   {
       return $this->hasMany('App\Models\Notes', 'lead_id', 'id');
   }
}
===
<?php

namespace App\Models;

use App\Traits\StudioTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
   use SoftDeletes;
   protected $table   = "notes";
   public $timestamps = true;
}
-----
Code to fetch data.

$users = User::all();

foreach($users as $key => $user) {
	foreach($user->leads as $key1 => $lead) {
		foreach($lead->notes as $key2 => $note) {
			$note->value;
		}
	}
}
