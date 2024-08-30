<?php

namespace Belokdwi\Bpjs\PCare;

class Provider extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'provider';

    /**
     * Get pcare provider.
     *
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getProvider($offset = null, $limit = null)
    {
        $this->setOffset($offset);
        $this->setLimit($limit);

        $this->setResponse($this->index($this->offset, $this->limit));

        return $this->response;
    }
}
