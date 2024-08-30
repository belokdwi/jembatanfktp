<?php

namespace Belokdwi\Bpjs\PCare;

class Dokter extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'dokter';

    /**
     * Get pcare dokter.
     *
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getDokter($offset = null, $limit = null)
    {
        $this->setOffset($offset);
        $this->setKeyword($limit);

        $this->setResponse($this->index($this->offset, $this->limit));

        return $this->response;
    }
}
