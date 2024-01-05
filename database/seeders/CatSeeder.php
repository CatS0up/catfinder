<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\CatGender;
use App\Enums\CatStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatSeeder extends Seeder
{
    public static function dataTable(): array
    {
        return [
            [
                'image_url' => asset('images/initial-cats/behemoth.jpg'),
                'name' => 'Behemoth',
                'age' => 4,
                'breed' => 'black cat',
                'gender' => CatGender::Male->value,
                'status' => CatStatus::Available->value,
                'description' => '<b>Hi! I\'m Behemoth</b>',
            ],
            [
                'image_url' => asset('images/initial-cats/bread-cat.png'),
                'name' => 'Bread Cat',
                'age' => 2,
                'breed' => 'bread',
                'gender' => CatGender::Male->value,
                'status' => CatStatus::Available->value,
                'description' => '<b>Hi! I\'m Bread</b>',
            ],
            [
                'image_url' => asset('images/initial-cats/garfield.jpg'),
                'name' => 'Garfield',
                'age' => 3,
                'breed' => 'fat cat',
                'gender' => CatGender::Male->value,
                'status' => CatStatus::Available->value,
                'description' => '<b>All I do is eat and sleep. Eat and sleep. Eat and sleep. There must be more to a cat\'s life than that. But I hope not</b>',
            ],
            [
                'image_url' => asset('images/initial-cats/grumpy-cat.jpg'),
                'name' => 'Grumpy Cat',
                'age' => 12,
                'breed' => 'grumpy',
                'gender' => CatGender::Male->value,
                'status' => CatStatus::Available->value,
                'description' => '<img href="'.asset('images/initial-cats/grumpy-cat.jpg').'"></img>',
            ],
            [
                'image_url' => asset('images/initial-cats/khajiit.jpg'),
                'name' => 'Khajiit',
                'age' => 200,
                'breed' => 'khajiit',
                'gender' => CatGender::Male->value,
                'status' => CatStatus::Available->value,
                'description' => '<em>The warm sand of Elsweyr is far away from here</em>',
            ],
            [
                'image_url' => asset('images/initial-cats/shrek-cat.jpg'),
                'name' => 'Puss in Boots',
                'age' => 13,
                'breed' => 'ginger cat',
                'gender' => CatGender::Male->value,
                'status' => CatStatus::Available->value,
                'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis architecto earum ab debitis delectus, nam qui quos ipsam impedit excepturi maxime quasi soluta ducimus voluptatem velit saepe doloribus ut dolore.10',
            ],
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::query()
            ->whereRelation('roles', 'name', 'user')
            ->first()
            ->value('id');

        $cats = array_map(
            function (array $catData) use ($userId): array {
                return [
                    ...$catData,
                    'adding_user_id' => $userId,
                    'created_at' => now()->toDateTime(),
                    'updated_at' => now()->toDateTime(),
                ];
            },
            self::dataTable()
        );

        DB::table('cats')->insert($cats);
    }
}
