<?php

namespace Belokdwi\Bpjs\PCare;

class Peserta extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'peserta';

    public function jenisKartu($jenisKartu)
    {
        $this->feature .= "/{$jenisKartu}";
        return $this;
    }

    /**
     * Get pcare peserte by nomor kartu.
     *
     * @param string $keyword
     * @return array
     */
    public function getPesertaByNoka($keyword = null)
    {
        $this->setKeyword($keyword);

        return $this->getPeserta('noka');
    }

    /**
     * Get pcare peserta by nik.
     *
     * @param string $keyword
     * @return array
     */
    public function getPesertaByNik($keyword = null)
    {
        $this->setKeyword($keyword);

        return $this->getPeserta('nik');
    }

    /**
     * Get pcare peserta.
     *
     * @param string $jenisKartu
     * @return array
     */
    private function getPeserta(string $jenisKartu)
    {
        $this->setResponse($this->jenisKartu($jenisKartu)->show($this->keyword));

        return $this->response;
    }
}
