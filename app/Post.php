<?php

namespace App;

use Laravelha\Support\Traits\Tableable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use Tableable;

    protected $guarded = ['id'];


    /**
     * ['data' => 'columnName', 'searchable' => true, 'orderable' => true, 'linkable' => false]
     *
     * searchable and orderable is true by default
     * linkable is false by default
     *
     * @return array[]
     */
    public static function getColumns(): array
    {
        return [
            ['data' => 'id', 'linkable' => true],
            ['data' => 'title'],
            ['data' => 'content'],
            ['data' => 'category_id'],
            ['data' => 'user_id'],
        ];
    }


    /**
     * Get the category of Post.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * Get the user of Post.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isEditor(User $user)
    {
        return ($this->user->is($user) OR $user->isAdmin());
    }

}
