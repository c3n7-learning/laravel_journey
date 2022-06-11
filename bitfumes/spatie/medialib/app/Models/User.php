<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
  use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
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

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('avatar')
      ->acceptsFile(function (File $file) {
        return $file->mimeType === 'image/jpeg';
      })
      ->registerMediaConversions(function (Media $media) {
        $this
          ->addMediaConversion('card')
          ->width(500)
          ->height(500);
        $this
          ->addMediaConversion('thumb')
          ->width(100)
          ->height(100);
      });
  }
}
