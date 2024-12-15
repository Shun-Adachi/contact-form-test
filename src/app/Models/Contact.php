<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    //ContactとCategoryのリレーション
    public function Category(){
        return $this->belongsTo(Category::class);
    }

    //キーワード検索
    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('last_name', 'like', '%' . $keyword . '%')
                  ->orwhere('first_name', 'like', '%' . $keyword . '%')
                  ->orwhere('email', 'like', '%' . $keyword . '%');
        }
    }

    //カテゴリ検索
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

   //カテゴリ検索
    public function scopeGenderSearch($query, $gender_key)
    {
        if (!empty($gender_key)) {
            $query->where('gender', $gender_key);
        }
    }

    //日付検索
    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
    }

}
