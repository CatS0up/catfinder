<?php

declare(strict_types=1);

use App\Enums\CatStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cats', function (Blueprint $table): void {
            $table->id();

            $table->string('image_url');
            $table->string('name');
            $table->string('gender');
            $table->string('breed');
            $table->string('status')
                ->default(CatStatus::ForApproval)
                ->index();

            $table->text('description');

            $table->unsignedTinyInteger('age');

            $table->foreignIdFor(User::class, 'adding_user_id')
                ->constrained('users');
            $table->foreignIdFor(User::class, 'adopter_id')
                ->nullable()
                ->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cats');
    }
};
