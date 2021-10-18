<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id');    // shorthand for $table->unsignedBigInteger('id');
            $table->string('artist');
            $table->string('title');
            $table->string('title_mbid', 36)->nullable(); // 36 = the amount of character max
            $table->string('cover')->nullable();    //
            $table->float('price', 5, 2)->default(19.99);
            $table->unsignedInteger('stock')->default(1);
            $table->timestamps();

            // Foreign key relation, relation to genre_id
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade')->onUpdate('cascade');

        });

        // Insert some records (inside up-function, after create-method)
        DB::table('records')->insert(
            [
                [
                    'genre_id' => 1,
                    'created_at' => now(),
                    'stock' => 1,
                    'artist' => 'Queen',
                    'title' => 'Greatest Hits',
                    'title_mbid' => 'fcb78d0d-8067-4b93-ae58-1e4347e20216',
                    'cover' => null
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
