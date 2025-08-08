<?php

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {


        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->string('title');
        });

        Schema::create('texts', function (Blueprint $table) {
            $table->id();
            $table->longText('sentence'); // The actual text content           
            $table->foreignIdFor(Chat::class)->constrained()->cascadeOnDelete();
            $table->string('senderType')->default('user'); // 'user' or 'llm'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('texts');
        Schema::dropIfExists('chats');
    }
};
