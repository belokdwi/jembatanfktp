<?php

namespace Belokdwi\Bpjs\PCare;

class Alergi extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'alergi';

    public function jenis($jenis)
    {
        $this->feature .= "/jenis/{$jenis}";
        return $this;
    }

    /**
     * Get Data Alergi Makanan.
     * @return array
     */
    public function getMakanan()
    {
        return $this->getAlergi('01');
    }

    /**
     * Get Data Alergi Udara.
     * @return array
     */
    public function getUdara()
    {
        return $this->getAlergi('02');
    }

    /**
     * Get Data Alergi Obat.
     * @return array
     */
    public function getObat()
    {
        return $this->getAlergi('03');
    }

    /**
     * Get Data Alergi
     * @return array
     */
    private function getAlergi(string $jenis)
    {
        $this->setResponse($this->jenis($jenis)->index());
        return $this->response;
    }
}
