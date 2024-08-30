<?php

namespace Belokdwi\Bpjs\PCare;

class Diagnosa extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'diagnosa';

    /**
     * Get pcare diagnosa.
     *
     * @param string $keyword
     * @param int $offset
     * @param int $limit
     * @return array
     */
    public function getDiagnosa($keyword = null, $offset = null, $limit = null)
    {
        $this->setKeyword($keyword);
        $this->setOffset($offset);
        $this->setLimit($limit);

        $this->setResponse($this->keyword($this->keyword)->index($this->offset, $this->limit));

        return $this->response;
    }
}
