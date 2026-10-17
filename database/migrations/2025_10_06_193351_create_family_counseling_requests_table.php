<?php

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
        Schema::create('family_counseling_requests', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('pseudonym')->nullable(); // الاسم المستعار
            $table->text('question'); // السؤال/المشكلة
            $table->text('answer')->nullable(); // إجابة الإدارة
            $table->boolean('is_public')->default(false); // عرض السؤال والإجابة للعامة
            $table->string('ip_address')->nullable(); // عنوان IP
            $table->text('user_agent')->nullable(); // معلومات المتصفح
            $table->string('status')->default('pending'); // pending, answered, published
            $table->unsignedBigInteger('answered_by')->nullable(); // من أجاب على السؤال
            $table->timestamp('answered_at')->nullable(); // وقت الإجابة
            $table->timestamps();
            
            $table->foreign('answered_by')->references('id')->on('users')->onDelete('set null');
            $table->index(['status', 'is_public']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_counseling_requests');
    }
};
