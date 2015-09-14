<?php

namespace Appkr\Fractal\Example\Test;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResourceApiTestForLumen extends \TestCase
{
    use DatabaseTransactions;

    /**
     * Stubbed Author model
     *
     * @var \Appkr\Fractal\Example\Author
     */
    protected $author;

    /**
     * Stubbed resource
     *
     * @var array
     */
    protected $resource = [];

    /**
     * JWT token
     *
     * @var string
     */
    protected $jwtToken = 'header.payload.signature';

    /** @before */
    public function stub()
    {
        $faker = \Faker\Factory::create();

        $this->author = \Appkr\Fractal\Example\Author::create([
            'name'  => 'foo',
            'email' => $faker->safeEmail
        ]);

        $this->resource = \Appkr\Fractal\Example\Resource::create([
            'title'       => $faker->sentence(),
            'author_id'  => $this->author->id,
            'description' => $faker->randomElement([$faker->paragraph(), null]),
            'deprecated'  => $faker->randomElement([0, 1])
        ])->toArray();
    }

    /** @test */
    public function it_fetches_a_collection_of_resources()
    {
        $this->get('api/v1/resource', $this->getHeaders())
            ->seeStatusCode(200)
            ->seeJson();
    }

    /** @test */
    public function it_fetches_a_single_resource()
    {
        $this->get('api/v1/resource/' . $this->resource['id'], $this->getHeaders())
            ->seeStatusCode(200)
            ->seeJson();
    }

    /** @test */
    public function it_responds_404_if_a_resource_is_not_found()
    {
        $this->get('api/v1/resource/100000', $this->getHeaders())
            ->seeStatusCode(404)
            ->seeJson();
    }

    /** @test */
    public function it_responds_422_if_a_new_resource_request_fails_validation()
    {
        $payload = [
            'title'       => null,
            'author_id'  => null,
            'description' => 'n'
        ];

        $this->post('api/v1/resource', $payload, $this->getHeaders())
            ->seeStatusCode(422)
            ->seeJson();
    }

    /** @test */
    public function it_responds_201_with_created_resource_after_creation()
    {
        $payload = [
            'title'       => 'new title',
            'author_id'  => $this->author->id,
            'description' => 'new description'
        ];

        $this->actingAs($this->author)
            ->post('api/v1/resource', $payload, $this->getHeaders())
            ->seeInDatabase('resources', ['title' => 'new title'])
            ->seeStatusCode(201)
            ->seeJsonContains(['title' => 'new title']);
    }

    /** @test */
    public function it_responds_200_if_a_update_request_is_succeeded()
    {
        $this->actingAs($this->author)
            ->put(
                'api/v1/resource/' . $this->resource['id'],
                ['title' => 'MODIFIED title', '_method' => 'PUT'],
                $this->getHeaders()
            )
            ->seeInDatabase('resources', ['title' => 'MODIFIED title'])
            ->seeStatusCode(200)
            ->seeJson();
    }

    /** @test */
    public function it_responds_200_if_a_delete_request_id_succeeded()
    {
        $this->actingAs($this->author)
            ->delete(
                'api/v1/resource/' . $this->resource['id'],
                ['_method' => 'DELETE'],
                $this->getHeaders()
            )
            ->notSeeInDatabase('resources', ['id' => $this->resource['id']])
            ->seeStatusCode(200)
            ->seeJson();
    }

    /**
     * Set/Get http request header
     *
     * @param array $append
     *
     * @return array
     */
    protected function getHeaders($append = [])
    {
        return [
            'HTTP_Authorization' => "Bearer {$this->jwtToken}",
            'HTTP_Accept'        => 'application/json'
        ] + $append;
    }
}