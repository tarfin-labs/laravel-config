<?php

namespace TarfinLabs\LaravelConfig\Tests;

use Illuminate\Support\Str;
use TarfinLabs\LaravelConfig\Config\Config;
use TarfinLabs\LaravelConfig\Config\ConfigFactory;
use TarfinLabs\LaravelConfig\LaravelConfig;

class LaravelConfigTest extends TestCase
{
    /** @var LaravelConfig */
    protected $laravelConfig;

    public function setUp(): void
    {
        parent::setUp();

        $this->laravelConfig = new LaravelConfig();
    }

    /** @test */
    public function it_create_a_new_config_parameter(): void
    {
        $factory = new ConfigFactory();
        $configItem = $factory->setName(Str::random(5))
                              ->setType('boolean')
                              ->setValue('1')
                              ->setDescription(Str::random(50))
                              ->get();

        $this->laravelConfig->create($configItem);

        $this->assertDatabaseHas('config', [
            'name'        => $configItem->name,
            'val'         => $configItem->val,
            'type'        => $configItem->type,
            'description' => $configItem->description,
        ]);
    }

    /** @test */
    public function it_create_a_new_config_parameter_with_tag(): void
    {
        $factory = new ConfigFactory();
        $configItem = $factory->setName(Str::random(5))
            ->setType('boolean')
            ->setValue('1')
            ->setTags(['system'])
            ->setDescription(Str::random(50))
            ->get();

        $this->laravelConfig->create($configItem);

        $this->assertDatabaseHas('config', [
            'name'        => $configItem->name,
            'val'         => $configItem->val,
            'type'        => $configItem->type,
            'description' => $configItem->description,
        ]);

        $this->assertTrue($this->laravelConfig->getByTag(['system'])->count() > 0);
    }

    /** @test */
    public function it_does_not_create_a_config_parameter_with_the_same_name(): void
    {
        $config = factory(Config::class)->create();
        $this->assertDatabaseHas('config', ['name' => $config->name]);

        $factory = new ConfigFactory();
        $configItem = $factory->setName($config->name)
                              ->setType('boolean')
                              ->setValue('1')
                              ->setDescription(Str::random(50))
                              ->get();

        $response = $this->laravelConfig->create($configItem);

        $this->assertFalse($response);
    }

    /** @test */
    public function it_updates_existing_config_parameter(): void
    {
        $config = factory(Config::class)->create(['val' => '0']);
        $this->assertDatabaseHas('config', ['name' => $config->name, 'val' => $config->val]);

        $factory = new ConfigFactory($config);
        $configItem = $factory->setType('boolean')
                              ->setValue('0')
                              ->setDescription('updated-description')
                              ->get();

        $this->laravelConfig->update($config, $configItem);

        $this->assertDatabaseHas('config', [
            'name'        => $config->name,
            'val'         => $configItem->val,
            'type'        => $configItem->type,
            'description' => $configItem->description,
        ]);
    }

    /** @test */
    public function it_deletes_an_existing_config_parameter(): void
    {
        $name = 'dummy-name';
        $config = factory(Config::class)->create(['name' => $name]);
        $this->assertDatabaseHas('config', ['name' => $config->name]);

        $this->laravelConfig->delete($config);

        $this->assertDatabaseMissing('config', ['name' => $name]);
    }

    /** @test */
    public function it_sets_a_value_to_existing_config_parameter(): void
    {
        $config = factory(Config::class)->create(['val' => '1']);

        $response = $this->laravelConfig->set($config->name, '0');

        $this->assertEquals('0', $response);
    }

    /** @test */
    public function it_does_not_set_a_value_to_not_existing_config_parameter(): void
    {
        $response = $this->laravelConfig->set('dummy', '1');

        $this->assertNull($response);
    }

    /** @test */
    public function it_returns_a_config_parameter_value_by_given_name(): void
    {
        $config = factory(Config::class)->create();

        $response = $this->laravelConfig->get($config->name);

        $this->assertEquals($config->val, $response);
    }

    /** @test */
    public function it_returns_config_collection_by_tag_name(): void
    {
        factory(Config::class, 3)
            ->create();

        $config = factory(Config::class, 5)->create([
            'tags' => ['system'],
        ]);

        $response = $this->laravelConfig->getByTag(['system']);

        $this->assertEquals($config->count(), $response->count());
    }

    /** @test */
    public function it_does_not_return_a_not_existing_config_parameter(): void
    {
        $response = $this->laravelConfig->get('dummy');

        $this->assertNull($response);
    }

    /** @test */
    public function it_returns_if_a_config_parameter_is_exist(): void
    {
        $name = 'dummy';
        $response = $this->laravelConfig->has($name);
        $this->assertFalse($response);

        factory(Config::class)->create(['name' => $name]);
        $response = $this->laravelConfig->has($name);
        $this->assertTrue($response);
    }

    /** @test */
    public function it_returns_all_config_parameters(): void
    {
        factory(Config::class)->times(2)->create();

        $response = $this->laravelConfig->all();

        $this->assertEquals(2, $response->count());
    }

    /** @test */
    public function it_returns_nested_config_parameters(): void
    {
        factory(Config::class)->create([
            'name'  => 'foo.bar',
            'val'   => true,
        ]);

        factory(Config::class)->create([
            'name'  => 'foo.baz',
            'val'   => false,
        ]);

        $response = $this->laravelConfig->getNested('foo');

        $this->assertEquals(2, $response->count());
        $this->assertEquals('bar', $response->first()->name);
        $this->assertEquals('baz', $response->last()->name);
    }
}
