<?php

namespace App\Models;

use App\Enums\UserStatus;
use App\Models\Evaluate\Evaluation;
use App\Models\Notification\UserContactTool;
use App\Models\Notification\UserNotificationType;
use App\Models\Traits\Scopes\ScopesTrait;
use App\Models\User\UserCanadianJobOffer;
use App\Models\User\UserComment;
use App\Models\User\UserCompilation;
use App\Models\User\UserFuturePlans;
use App\Models\User\UserImage;
use App\Models\User\UserLanguage;
use App\Models\User\UserManitoba;
use App\Models\User\UserNetWorth;
use App\Models\User\UserNotification;
use App\Models\User\UserProfile;
use App\Models\User\UsersCanadianRelative;
use App\Models\User\UsersEducation;
use App\Models\User\UserSpouse;
use App\Models\User\UsersWork;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property integer $status
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property bool $is_profile_imported
 * @property UserProfile $profile
 * @property UserNetWorth $netWorth
 * @property UserSpouse $spouse
 * @property UserComment $comment
 * @property UserManitoba $manitoba
 * @property UsersCanadianRelative $relative
 * @property UserLanguage[] $languages
 * @property UserImage $image
 * @property UsersEducation $education
 * @property UsersWork $work
 * @property UserCanadianJobOffer $jobOffer
 * @property Evaluation[] $evaluations
 * @property UserFuturePlans $futurePlan
 * @property VirtualProfile[] $virtualProfiles
 * @property VirtualProfile[] $virtualProfilesSaved
 * @mixin CanResetPassword
 */
class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable;
    use ScopesTrait;
    use Billable;
    use HasEvents;
    use HasAccess;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'password', 'terms_accepted', 'isFirstLogin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForMail()
    {
        return [$this->email => $this->name];
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function markStatusAsActive()
    {
        return $this->forceFill([
            'status' => UserStatus::Active,
        ])->save();
    }

    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function userContactTool()
    {
        return $this->hasOne(UserContactTool::class);
    }

    public function netWorth()
    {
        return $this->hasOne(UserNetWorth::class);
    }

    public function spouse()
    {
        return $this->hasOne(UserSpouse::class);
    }

    public function comment()
    {
        return $this->hasOne(UserComment::class);
    }

    public function manitoba()
    {
        return $this->hasOne(UserManitoba::class);
    }

    public function relative()
    {
        return $this->hasOne(UsersCanadianRelative::class);
    }

    public function languages()
    {
        return $this->hasMany(UserLanguage::class);
    }

    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    public function image()
    {
        return $this->hasOne(UserImage::class);
    }

    public function education()
    {
        return $this->hasOne(UsersEducation::class);
    }

    public function work()
    {
        return $this->hasOne(UsersWork::class);
    }

    public function jobOffer()
    {
        return $this->hasOne(UserCanadianJobOffer::class);
    }

    public function evaluations($id = null)
    {
        return $this->hasMany(Evaluation::class)->where('virtual_profile_id', $id);
    }

    public function evaluationsByUser()
    {
        return $this->hasMany(Evaluation::class)->where('user_id', $this->id);
    }

    public function futurePlan()
    {
        return $this->hasOne(UserFuturePlans::class);
    }

    public function virtualProfiles()
    {
        return $this->hasMany(VirtualProfile::class);
    }

    public function virtualProfilesSaved()
    {
        return $this->hasMany(VirtualProfile::class)->where('saved', VirtualProfile::SAVED)->orderBy('id', 'desc');
    }


    public function notificationType()
    {
        return $this->hasOne(UserNotificationType::class);
    }

    public function compilation()
    {
        return $this->hasOne(UserCompilation::class, 'user_id', 'id');
    }

    public static function getAvailableFields()
    {
        return [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'email' => 'Email'
        ];
    }
}
