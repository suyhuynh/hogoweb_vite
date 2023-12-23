<?php

namespace Modules\User\Entities;

use Illuminate\Auth\Authenticatable;
use Modules\User\Entities\Position;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as FoundationAuthenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Modules\User\Admin\UserTable;

class User extends FoundationAuthenticatable{

    use HasApiTokens, HasFactory, Notifiable, Authenticatable;
    protected $module = 'user';
    protected $fillable = [
        'department_id',
        'parent_id',
        'role_id',
        'type',
        'auth_name',
        'fullname',
        'avatar',
        'phone',
        'address',
        'birthday',
        'email',
        'username',
        'password',
        'remember_token',
        'permissions',
        'last_login',
        'email_verified_at',
        'remember_token',
        'facebook',
        'google',
        'is_receive_mail_from_sys',
       
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'is_receive_mail_from_sys' => 'boolean',
        'email_verified_at' => 'datetime'
    ];
    protected $appends = ['short_name'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['last_login', 'birthday'];

    public function childs() {
        return $this->hasMany('Modules\User\Entities\User', 'parent_id', 'id')->with('childs');
    }

    public static function registered($email) {
        return static::where('email', $email)->exists();
    }

    public static function findByEmail($email) {
        return static::where('email', $email)->first();
    }

    public static function totalCustomer() {
        return Role::findOrNew(setting('customer_role'))->users()->count();
    }

    public function getRoleSetAttribute() {
        $role = Role::where('id', $this->role_id)->first();
        if(!empty($role)){
            return array_fill_keys(explode(',', $role->permissions), true);
        } 
        return [];
    }


    public function getFullNameEmailAttribute() {
        return "{$this->fullname} - {$this->email}";
    }

    public function getFullNamePhoneAttribute() {
        return "{$this->fullname} - {$this->phone}";
    }

    public function getShortNameAttribute()
	{
		$value = $this->fullname;
		if(!empty($value)){
			$value = ucwords(strtolower($value));
			$arr_name = explode(' ', $value);
			$arr = array_slice($arr_name,-2);
			return implode(' ', $arr);
		}
		return $value;
	}

    /**
     * Determine if the user has access to the given permissions.
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAccess($permission) {
        $roles = $this->role->permissions;
        return !empty($roles) ? in_array($permission, $roles) : false;
    }

    /**
     * Determine if the user has access to the any given permissions
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAnyAccess($permissions) {
        $permissions = is_array($permissions) ? $permissions : func_get_args();
        return getRolePermissions($this->role->permissions, $permissions);
        // return $this->getPermissionsInstance()->hasAnyAccess($permissions);
    }
    

    public function scopeSales($query) {
        $department_sale_id = collect(config('im.module.user.config.department'))->firstWhere('slug', 'sale')['id'];
        return $query->where('department_id', $department_sale_id);
    }

    protected static function boot() {
        parent::boot();
        static::created(function (self $user) {
 
        });

        static::saving(function (self $user) {
            if(!empty(request()->password)){
                $user->password = bcrypt(request()->password);
            }
        });
    }

    public function position() {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id')->withDefault(['permissions']);
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes()->select('fullname', 'phone', 'email', 'status', 'created_at', 'type', 'id');
        $query = $query->where('id', '<>', auth()->user()->id);
        if(!empty($keyword = $request->input('filters.keyword', ''))){
            $query = $query->where(function ($q) use($keyword){
                return $q->where('fullname', 'like', '%'.$keyword.'%')
                ->orwhere('phone', 'like', '%'.$keyword.'%')
                ->orwhere('email', 'like', '%'.$keyword.'%');
            });
        }

        if(!empty($request->input('filters.start_date', ''))){
            $query = $query->whereBetween('created_at', [$request->input('filters.start_date', date('Y-m-01')), $request->input('filters.end_date', date('Y-m-d'))]);
        }

        if(!empty($status = $request->input('filters.status', ''))){
            $query = $query->where('status', $status);
        }

        return $query;
    }

    public function table($request)
    {   
        $query = $this->search($request);
        return new UserTable($query);
    }
}
