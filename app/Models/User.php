<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed email
 * @property mixed mobile
 * @property mixed image
 * @property mixed password
 * @property mixed email_verified_at
 * @property mixed mobile_verified_at
 * @property mixed device_type
 * @property mixed device_token
 * @property boolean email_verified
 * @property boolean mobile_verified
 * @property boolean active
 */
class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    protected $fillable = ['name','email','mobile','image','password','email_verified_at','mobile_verified_at','device_type','device_token','active','email_verified','mobile_verified'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime','mobile_verified_at' => 'datetime'];

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
        static::deleting(function($Object) {
            foreach ($Object->notifications as $notification) {
                $notification->delete();
            };
        });
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function getImageAttribute($value): ?string
    {
        return ($value)?asset($value):null;
    }
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = Functions::StoreImageModel($value,'users/image');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile): void
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmailVerifiedAt()
    {
        return $this->email_verified_at;
    }

    /**
     * @param mixed $email_verified_at
     */
    public function setEmailVerifiedAt($email_verified_at): void
    {
        $this->email_verified_at = $email_verified_at;
    }

    /**
     * @return mixed
     */
    public function getMobileVerifiedAt()
    {
        return $this->mobile_verified_at;
    }

    /**
     * @param mixed $mobile_verified_at
     */
    public function setMobileVerifiedAt($mobile_verified_at): void
    {
        $this->mobile_verified_at = $mobile_verified_at;
    }

    /**
     * @return mixed
     */
    public function getDeviceType()
    {
        return $this->device_type;
    }

    /**
     * @param mixed $device_type
     */
    public function setDeviceType($device_type): void
    {
        $this->device_type = $device_type;
    }

    /**
     * @return mixed
     */
    public function getDeviceToken()
    {
        return $this->device_token;
    }

    /**
     * @param mixed $device_token
     */
    public function setDeviceToken($device_token): void
    {
        $this->device_token = $device_token;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return bool
     */
    public function isEmailVerified(): bool
    {
        return $this->email_verified;
    }

    /**
     * @param bool $email_verified
     */
    public function setEmailVerified(bool $email_verified): void
    {
        $this->email_verified = $email_verified;
    }

    /**
     * @return bool
     */
    public function isMobileVerified(): bool
    {
        return $this->mobile_verified;
    }

    /**
     * @param bool $mobile_verified
     */
    public function setMobileVerified(bool $mobile_verified): void
    {
        $this->mobile_verified = $mobile_verified;
    }

}
