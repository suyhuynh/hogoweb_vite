<?php

namespace Modules\User\Entities;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Position;
use Modules\User\Entities\Department;
use Modules\App\Entities\AppModel;
use Modules\Core\Entities\Setting;
use Modules\User\Admin\UserTable;

class User extends AppModel{
    use Authenticatable;
    protected $module = 'user';
    protected $fillable = [
        'parent_id',
        'position_id',
        'department_id',
        'employee_id',
        'block_id',
        'role_id',
        'avatar',
        'note',
        'fullname',
        'username',
        'password',
        'email',
        'phone',
        'remember_token',
        'passport',
        'country_id',
        'province_id',
        'district_id',
        'ward_id',
        'address',
        'gender',
        'birthday',
        'cmnd_back',
        'cmnd_front',
        'facebook',
        'google',
        'status',
        'permissions',
        'is_receive_mail_from_sys',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'is_receive_mail_from_sys' => 'boolean',
    ];
    protected $appends = ['short_name'];
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['last_login'];

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

    /**
     * Login the user.
     *
     * @return $this|bool
     */
    public function login() {
        return auth()->login($this);
    }

    /**
     * Determine if the user is a customer.
     *
     * @return bool
     */
    public function isCustomer() {
        if ($this->hasRoleName('admin')) {
            return false;
        }

        return $this->hasRoleId(setting('customer_role'));
    }

    /**
     * Determine if the user is a customer.
     *
     * @return bool
     */
    public function isSale() {

        return config('im.module.user.config.department.' . $this->department_id . '.slug') == 'sale';
    }

    /**
     * Determine if the user is a customer.
     *
     * @return bool
     */
    public function isLead() {
        return $this->childs->count() > 0;
    }

    public function isSaleLead() {
        return $this->isSale() && $this->isLead();
    }

    public function getSaleStaffIds() {
        $ids = collect();
        if ($this->isSale()) {
            $ids->push($this->id);
        }
        if ($this->isSaleLead()) {
            $ids = $ids->merge($this->childs->pluck('fullname', 'id')->keys());
            foreach ($this->childs as $user) {
                $ids = $ids->merge($user->childs->pluck('fullname', 'id')->keys());
            }

        }
        return $ids->all();
    }

    /**
     * Checks if a user belongs to the given Role ID.
     *
     * @param int $roleId
     * @return bool
     */
    public function hasRoleId($roleId) {
        return $this->roles()->whereId($roleId)->count() !== 0;
    }

    /**
     * Checks if a user belongs to the given Role Slug.
     *
     * @param string $slug
     * @return bool
     */
    public function hasRoleSlug($slug) {
        return $this->roles()->whereSlug($slug)->count() !== 0;
    }

    /**
     * Checks if a user belongs to the given Role Name.
     *
     * @param string $name
     * @return bool
     */
    public function hasRoleName($name) {
        return $this->roles()->whereTranslation('name', $name)->count() !== 0;
    }

    /**
     * Check if the current user is activated.
     *
     * @return bool
     */
    public function isActivated() {
        return true;
        return Activation::completed($this);
    }

    /**
     * Get the recent orders of the user.
     *
     * @param int $take
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function recentOrders($take) {
        return $this->orders()->latest()->take($take)->get();
    }

    public function scopeActive($query) {
        return $query->where('active', 1);
    }

    /**
     * Get the roles of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() {
        return $this->belongsToMany(Role::class, 'user_roles')->withTimestamps();
    }

    public function getRoleSetAttribute() {
        $role = Role::where('id', $this->role_id)->first();
        if(!empty($role)){
            return array_fill_keys(explode(',', $role->permissions), true);
        } 
        return [];
    }
    /**
     * Get the orders of the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders() {
        return $this->hasMany(Order::class, 'customer_id');
    }

    public function theme_admin() {
        return $this->belongsTo(Setting::class, 'id', 'created_by')->where('type', 'admin');
    }

    // /**
    //  * Get the full name of the user.
    //  *
    //  * @return string
    //  */
    // public function getFullNameAttribute()
    // {
    //     return "{$this->first_name} {$this->last_name}";
    // }

    public function getFullNameEmailAttribute() {
        return "{$this->fullname} - {$this->email}";
    }

    public function getFullNamePhoneAttribute() {
        return "{$this->fullname} - {$this->phone}";
    }

    /**
     * Get the department of the user.
     *
     * @return string
     */
    public function getDepartmentAttribute() {
        return config('im.module.user.config.department.' . $this->department_id)['title'] ?? '';
    }

    /**
     * Set user's permissions.
     *
     * @param array $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions) {
        $this->attributes['permissions'] = Permission::prepare($permissions);
    }

    /**
     * Determine if the user has access to the given permissions.
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAccess($permissions) {
        $permissions = is_array($permissions) ? $permissions : func_get_args();
        return $this->getPermissionsInstance()->hasAccess($permissions);
    }

    /**
     * Determine if the user has access to the any given permissions
     *
     * @param array|string $permissions
     * @return bool
     */
    public function hasAnyAccess($permissions) {
        $permissions = is_array($permissions) ? $permissions : func_get_args();

        return $this->getPermissionsInstance()->hasAnyAccess($permissions);
    }

    public function scopeSales($query) {
        $department_sale_id = collect(config('im.module.user.config.department'))->firstWhere('slug', 'sale')['id'];
        return $query->where('department_id', $department_sale_id);
    }

    protected static function boot() {
        parent::boot();
        static::created(function (self $user) {
            if(check_addon('notify')){
                $data_render = [
                    'username' => $user->username,
                    'email_login' => $user->email,
                    'link_login' => url('/').route('admin.login'),
                ];
                event(new \Modules\Notify\Events\SendMailNotify($data_render, $user, 'user_create'));
            }
        });

        static::saving(function (self $user) {
            if(!empty(request()->is_receive_mail_from_sys)){
                $user->is_receive_mail_from_sys = filter_var(request()->is_receive_mail_from_sys, FILTER_VALIDATE_BOOLEAN);
            }
            
            if(!empty(request()->password)){
                $user->password = bcrypt(request()->password);
            }
        });
    }

    public function position() {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }

    public function department() {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes()->with('department', 'position');
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where(function ($q) use($keyword){
                return $q->where('fullname', 'like', '%'.$keyword.'%')
                ->orwhere('phone', 'like', '%'.$keyword.'%')
                ->orwhere('email', 'like', '%'.$keyword.'%');
            });
        }
        return $query;
    }

    public function table($request)
    {   
        $query = $this->search($request);
        return new UserTable($query);
    }
    
    public function getMapData($item)
    {
        return [
            'position' => @$item->position->title,
            'department' => @$item->department->title,
        ];
    }

    public function getShortNameAttribute()
	{
		$value=$this->fullname;
		if(!empty($value)){
			$value=ucwords(strtolower($value));
			$arr_name = explode(' ', $value);
			$arr = array_slice($arr_name,-2);
			return implode(' ', $arr);
		}
		
	}


}
