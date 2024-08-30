<?php

namespace Belokdwi\Bpjs\PCare;

class Kesadaran extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'kesadaran';

    /**
     * Get pcare kesadaran.
     *
     * @return array
     */
    public function getKesadaran()
    {
        $this->setResponse($this->index());

        return $this->response;
    }
}
