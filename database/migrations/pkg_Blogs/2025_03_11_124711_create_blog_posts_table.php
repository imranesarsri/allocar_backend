<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id('blog_post_id');
            $table->string('title', 255)->unique();
            $table->string('slug', 255);
            $table->longText('content');
            $table->text('excerpt')->nullable();
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->unsignedBigInteger('blog_author_id');
            $table->unsignedBigInteger('blog_category_id')->nullable();
            $table->string('featured_image', 255)->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->integer('views_count')->default(0);
            $table->timestamps();

            $table->foreign('blog_author_id')->references('blog_author_id')->on('blog_authors');
            $table->foreign('blog_category_id')->references('blog_category_id')->on('blog_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
