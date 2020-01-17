<?php

namespace TarfinLabs\LaravelConfig\Config;

class ConfigFactory
{
    /**
     * @var ConfigItem
     */
    protected $configItem;

    /**
     * ConfigFactory constructor.
     *
     * @param  Config|null  $config
     */
    public function __construct(Config $config = null)
    {
        $this->configItem = new ConfigItem();

        if (!is_null($config)) {
            $this->setName($config->name)
                 ->setValue($config->val)
                 ->setType($config->type)
                 ->setDescription($config->description);
        }
    }

    /**
     * Set the name of config paremeter.
     *
     * @param  string  $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->configItem->name = $name;

        return $this;
    }

    /**
     * Set the value of config parameter.
     *
     * @param $value
     *
     * @return $this
     */
    public function setValue($value): self
    {
        $this->configItem->val = $value;

        return $this;
    }

    /**
     * Set the type of config parameter.
     *
     * @param $type
     *
     * @return $this
     */
    public function setType($type): self
    {
        $this->configItem->type = $type;

        return $this;
    }

    /**
     * Set the description of config parameter.
     *
     * @param $description
     *
     * @return $this
     */
    public function setDescription($description): self
    {
        $this->configItem->description = $description;

        return $this;
    }

    /**
     * return ConfigItem.
     *
     * @return ConfigItem
     */
    public function get(): ConfigItem
    {
        return $this->configItem;
    }
}
