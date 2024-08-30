<?php

namespace Belokdwi\Bpjs\PCare;

class StatusPulang extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'statuspulang';
    private $status = 'true';

    public function rawatInap(bool $status = true)
    {
        if ($status === true) {
            $this->status = 'true';
        } else {
            $this->status = 'false';
        }

        $this->feature .= "/rawatInap/{$this->status}";

        return $this;
    }

    /**
     * Get pcare status pulang.
     *
     * @param bool $status
     * @return array
     */
    public function getStatusPulang(bool $status)
    {
        $this->setResponse($this->rawatInap($status)->index());

        return $this->response;
    }

    /**
     * Get pcare status pulang rawat inap.
     *
     * @return array
     */
    public function getStatusPulangRawatInap()
    {
        return $this->getStatusPulang(true);
    }

    /**
     * Get pcare status pulang rawat jalan.
     *
     * @return array
     */
    public function getStatusPulangRawatJalan()
    {
        return $this->getStatusPulang(false);
    }
}
