<?php

namespace Belokdwi\Bpjs\PCare;

class HeaderConfig extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = '';


    /**
     * Get Data HeaderConfig
     * @return array
     */
    public function getConfig()
    {
        return $this->getHeaders();
    }
}
