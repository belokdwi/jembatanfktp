<?php

namespace Belokdwi\Bpjs\PCare;

class Prognosa extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'prognosa';

    /**
     * Get pcare kesadaran.
     *
     * @return array
     */
    public function getPrognosa()
    {
        $this->setResponse($this->index());

        return $this->response;
    }
}
