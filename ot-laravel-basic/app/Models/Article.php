<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    //    protected $guarded = ['id'];
    protected $fillable = ['body', 'user_id'];

    public function user(): BelongsTo
    {
        //User라는 클래스에 article이 속한다는 뜻
        //Articles 모델에서 User 모델에 접근하면, 이 글을 어떤 유저가 작성했는지 조회할 수 있다.
        return $this->belongsTo(User::class);
    }
}
