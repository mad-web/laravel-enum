<?php

namespace MadWeb\Enum\Test;

use MadWeb\Enum\Enum;

class EnumCastingTest extends TestCase
{
    /** @test */
    public function retrieve_casting()
    {
        $post = Post::create(['title' => 'Some title', 'status' => 'pending']);

        $post = Post::where('id', $post->id)->first();

        $this->assertInstanceOf(Enum::class, $post->status);
    }

    /** @test */
    public function retrieve_casting_integer()
    {
        $favoriteDay = FavoriteDay::create(['title' => 'Some title', 'day' => 1]);

        $favoriteDay = FavoriteDay::where('id', $favoriteDay->id)->first();

        $this->assertInstanceOf(Enum::class, $favoriteDay->day);
    }

    /** @test */
    public function retrieve_casting_integer_as_string()
    {
        $favoriteDay = FavoriteDay::create(['title' => 'Some title', 'day' => '1']);

        $favoriteDay = FavoriteDay::where('id', $favoriteDay->id)->first();

        $this->assertInstanceOf(Enum::class, $favoriteDay->day);
    }

    /** @test */
    public function set_casting()
    {
        $post = Post::make(['title' => 'Some title', 'status' => 'pending']);

        $this->assertInstanceOf(Enum::class, $post->status);
    }

    /** @test */
    public function set_casting_integer()
    {
        $favoriteDay = FavoriteDay::make(['title' => 'Some title', 'day' => 1]);

        $this->assertInstanceOf(Enum::class, $favoriteDay->day);
    }

    /** @test */
    public function set_casting_integer_as_string()
    {
        $favoriteDay = FavoriteDay::make(['title' => 'Some title', 'day' => '1']);

        $this->assertInstanceOf(Enum::class, $favoriteDay->day);
    }

    /** @test */
    public function set_attribute()
    {
        $post = Post::create(['title' => 'Some title', 'status' => 'pending']);

        $post->status = PostStatusEnum::PUBLISHED();

        $this->assertEquals($post->status->getValue(), PostStatusEnum::PUBLISHED()->getValue());
    }

    /** @test */
    public function set_attribute_integer()
    {
        $favoriteDay = FavoriteDay::create(['title' => 'Some title', 'day' => 1]);

        $favoriteDay->day = DaysOfWeekEnum::TUESDAY();

        $this->assertEquals($favoriteDay->day->getValue(), DaysOfWeekEnum::TUESDAY()->getValue());
    }

    /** @test */
    public function set_attribute_integer_as_string()
    {
        $favoriteDay = FavoriteDay::create(['title' => 'Some title', 'day' => '1']);

        $favoriteDay->day = DaysOfWeekEnum::TUESDAY();

        $this->assertEquals($favoriteDay->day->getValue(), DaysOfWeekEnum::TUESDAY()->getValue());
    }

    /** @test */
    public function change_attribute()
    {
        $post = Post::create(['title' => 'Some title', 'status' => 'pending']);

        $post->status = PostStatusEnum::PUBLISHED();

        $post->save();

        $post = Post::where('id', $post->id)->first();

        $this->assertEquals($post->status->getValue(), PostStatusEnum::PUBLISHED()->getValue());
    }

    /** @test */
    public function change_attribute_integer()
    {
        $favoriteDay = FavoriteDay::create(['title' => 'Some title', 'day' => 1]);

        $favoriteDay->day = DaysOfWeekEnum::TUESDAY();

        $favoriteDay->save();

        $favoriteDay = FavoriteDay::where('id', $favoriteDay->id)->first();

        $this->assertEquals($favoriteDay->day->getValue(), DaysOfWeekEnum::TUESDAY()->getValue());
    }

    /** @test */
    public function change_attribute_integer_as_string()
    {
        $favoriteDay = FavoriteDay::create(['title' => 'Some title', 'day' => '1']);

        $favoriteDay->day = DaysOfWeekEnum::TUESDAY();

        $favoriteDay->save();

        $favoriteDay = FavoriteDay::where('id', $favoriteDay->id)->first();

        $this->assertEquals($favoriteDay->day->getValue(), DaysOfWeekEnum::TUESDAY()->getValue());
    }
}
