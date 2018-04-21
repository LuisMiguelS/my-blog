<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Traits\FindSlug;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FindSlugTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    /** @test */
    function it_can_find_post_model_by_slug()
    {

        $post1 = PostModel::create(['name' => 'laravel amazing post']);
        $post2 = PostModel::create(['name' => 'laravel cool post']);

        $this->assertTrue(
            $post1->slug === PostModel::findBySlug('laravel-amazing-post')->slug
        );

        $this->assertTrue(
            $post2->slug === PostModel::findBySlug('laravel-cool-post')->slug
        );

        try {
            postModel::findBySlug('laravel-not-exists-post');
        }catch (\Exception $e){
            $this->assertTrue($e instanceof ModelNotFoundException);
        }

    }

    protected function setUpDatabase(Application $app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('post_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
        });
    }
}

class PostModel extends Model
{
    use HasSlug, FindSlug;

    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
