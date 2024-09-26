<?php

namespace Belokdwi\Bpjs\PCare;

use Illuminate\Http\Request;

class Obat extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'obat';

    public function dpho($keyword)
    {
        $this->feature .= "/dpho/{$keyword}";
        return $this;
    }

    public function kunjungan($nomorKunjungan)
    {
        $this->feature .= "/kunjungan/{$nomorKunjungan}";
        return $this;
    }

    public function addEndpoint()
    {
        $this->feature .= "/kunjungan";
        return $this;
    }

    public function deleteEndpoint($kodeObatSK, $nomorKunjungan)
    {
        $this->feature .= "/{$kodeObatSK}/kunjungan/{$nomorKunjungan}";
        return $this;
    }

    /**
     * Get Data DPHO.
     *
     * @param string $keyword Kode atau nama DPHO
     * @return void
     */
    public function getDPHO(string $keyword, $offset = null, $limit = null)
    {
        $this->setResponse($this->dpho($keyword)->index($offset, $limit));

        return $this->response;
    }

    /**
     * Get Data Obat by Kunjungan.
     *
     * @param string $nomorKunjungan
     * @return void
     */
    public function getKunjungan(string $nomorKunjungan)
    {
        $this->setResponse($this->kunjungan($nomorKunjungan)->index());

        return $this->response;
    }

    /**
     * Add Data Obat.
     *
     * @param Request $request
     * @return array
     */
    public function addObat(Request $request)
    {
        $this->setResponse($this->addEndpoint()->store($request->all()));

        return $this->response;
    }

    /**
     * Delete Data Obat.
     *
     * @param Request $kodeObatSK $nomorKunjungan
     * @return array
     */
    public function deleteObat(string $kodeObatSK, string $nomorKunjungan)
    {
        $this->setResponse(
            $this
                ->deleteEndpoint($kodeObatSK, $nomorKunjungan)
                ->destroy()
        );

        return $this->response;
    }
}
