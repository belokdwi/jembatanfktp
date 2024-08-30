<?php

namespace Belokdwi\Bpjs\PCare;

class Poli extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'poli';

    public function fktp()
    {
        $this->feature .= "/fktp";
        return $this;
    }

    /**
     * Get pcare poli fktp.
     *
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getPoli($offset = null, $limit = null)
    {
        $this->setOffset($offset);
        $this->setLimit($limit);

        $this->setResponse($this->fktp()->index($this->offset, $this->limit));

        return $this->response;
    }
}
