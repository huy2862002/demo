<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $timestamps = FALSE;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function get_count() // Tổng số tài khoản đang đã đăng ký
    {
        $get_count = User::count();
        return $get_count;
    }

    public function add_new($request){
        $new_user = new User();
        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);
        $new_user->phone_number = $request->phone_number;
        $new_user->role = 1;
        $new_user->status = 1;
        $new_user->created_at = strtotime(date('Y-m-d H:i:s'));
        $new_user->updated_at = strtotime(date('Y-m-d H:i:s'));
        $new_user->save();
    }

    public function check_email_exist($request){
        $exist = User::select('users.*')
            ->where('email', '=', $request->email)
            ->exists();
        return $exist;
    }
}
