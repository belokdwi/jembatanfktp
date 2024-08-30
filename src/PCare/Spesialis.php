<?php

namespace Belokdwi\Bpjs\PCare;

class Spesialis extends BasePcare
{
    protected $feature = 'spesialis';
    protected $subFeature;
    protected $param;
    protected $isRujuk = false;
    private $kodeSarana;
    private $tanggalRujuk;
    private $kodeKhusus;
    private $nomorKartu;

    public function rujuk()
    {
        $this->feature .= "/rujuk";
        return $this;
    }

    public function subSpesialis($kodeSpesialis = null)
    {
        $this->subFeature = "subspesialis";
        $this->param = $kodeSpesialis;
        $this->setFeature();
        return $this;
    }

    public function sarana($kodeSarana = null)
    {
        $this->subFeature = "sarana";
        $this->param = $kodeSarana;
        $this->setFeature();
        return $this;
    }

    public function tanggalRujuk($tanggalRujuk)
    {
        $this->feature .= "/tglEstRujuk/{$tanggalRujuk}";
        return $this;
    }

    public function khusus($kodeKhusus = null)
    {
        $this->subFeature = "khusus";
        $this->param = $kodeKhusus;
        $this->setFeature();
        return $this;
    }

    public function nomorKartu($nomorKartu = null)
    {
        $this->feature .= "/noKartu/{$nomorKartu}";
        return $this;
    }

    private function setFeature()
    {
        if ($this->isRujuk) {
            $this->feature .= "/{$this->subFeature}/{$this->param}";
        } else {
            $this->feature .= "/{$this->param}/{$this->subFeature}";
        }
    }

    public function setRujuk(bool $isRujuk)
    {
        $this->isRujuk = $isRujuk;
    }

    public function setKodeSubspesialis($kodeSubspesialis)
    {
        $this->setKeyword($kodeSubspesialis);
    }

    public function setKodeSarana($kodeSarana = null)
    {
        if (!is_null($kodeSarana)) {
            $this->kodeSarana = $kodeSarana;
        }
    }

    public function setTanggalRujuk($tanggalRujuk = null)
    {
        if (!is_null($tanggalRujuk)) {
            $this->tanggalRujuk = $tanggalRujuk;
        }
    }

    /**
     * Set kode khusus.
     * 
     * IGD = ALIH RAWAT
     * HDL = HEMODIALISA
     * JIW = JIWA
     * KLT = KUSTA
     * PAR = TB-MDR
     * KEM = SARANA KEMOTERAPI
     * RAT = SARANA RADIOTERAPI
     * HIV = HIV-ODHA
     * THA = THALASEMIA
     * HEM = HEMOFILI
     *
     * @param string $kodeKhusus
     * @return void
     */
    public function setKodeKhusus($kodeKhusus = null)
    {
        if (!is_null($kodeKhusus)) {
            $this->kodeKhusus = $kodeKhusus;
        }
    }

    public function setNomorKartu($nomorKartu = null)
    {
        if (!is_null($nomorKartu)) {
            $this->nomorKartu = $nomorKartu;
        }
    }

    /**
     * Get pcare spesialis.
     *
     * @return array
     */
    public function getSpesialis()
    {
        $this->setResponse($this->index());

        return $this->response;
    }

    /**
     * Get pcare sub spesialis.
     *
     * @param string $kodeSubspesialis
     * @return array
     */
    public function getSubSpesialis($kodeSubspesialis = null)
    {
        $this->setKodeSubspesialis($kodeSubspesialis);

        $this->setResponse($this->subSpesialis($this->keyword)->index());

        return $this->response;
    }

    /**
     * Get pcare sarana.
     *
     * @param string $kodeSarana
     * @return array
     */
    public function getSarana($kodeSarana = null)
    {
        $this->setKodeSarana($kodeSarana);

        $this->setResponse($this->sarana()->index());

        return $this->response;
    }

    /**
     * Get pcare khusus.
     *
     * @return array
     */
    public function getKhusus()
    {
        $this->setResponse($this->khusus()->index());

        return $this->response;
    }

    /**
     * Get pcare faskes rujukan subspesialis.
     *
     * @param string $kodeSubspesialis
     * @param string $kodeSarana
     * @param string $tanggalRujuk
     * @return array
     */
    public function getFaskesRujukanSubspesialis($kodeSubspesialis = null, $kodeSarana = null, $tanggalRujuk = null)
    {
        $this->setRujuk(true);
        $this->setKodeSubspesialis($kodeSubspesialis);
        $this->setKodeSarana($kodeSarana);
        $this->setTanggalRujuk($tanggalRujuk);

        $this->setResponse(
            $this
                ->rujuk()
                ->subSpesialis($this->keyword)
                ->sarana($this->kodeSarana)
                ->tanggalRujuk($this->tanggalRujuk)
                ->index()
        );

        return $this->response;
    }

    /**
     * Get pcare faskes rujukan khusus.
     *
     * @param string $kodeKhusus
     * @param string $nomorKartu
     * @param string $tanggalRujuk
     * @return array
     */
    public function getFaskesRujukanKhusus($kodeKhusus = null, $nomorKartu = null, $tanggalRujuk = null)
    {
        $this->setRujuk(true);
        $this->setKodeKhusus($kodeKhusus);
        $this->setNomorKartu($nomorKartu);
        $this->setTanggalRujuk($tanggalRujuk);

        $this->setResponse(
            $this
                ->rujuk()
                ->khusus($this->kodeKhusus)
                ->nomorKartu($this->nomorKartu)
                ->tanggalRujuk($this->tanggalRujuk)
                ->index()
        );

        return $this->response;
    }

    /**
     * Get pcare faskes rujukan khusus.
     *
     * @param string $kodeKhusus
     * @param string $kodeSubspesialis
     * @param string $nomorKartu
     * @param string $tanggalRujuk
     * @return array
     */
    public function getFaskesRujukanKhususSubspesialis($kodeKhusus = null, $kodeSubspesialis = null, $nomorKartu = null, $tanggalRujuk = null)
    {
        $this->setRujuk(true);
        $this->setKodeKhusus($kodeKhusus);
        $this->setKodeSubspesialis($kodeSubspesialis);
        $this->setNomorKartu($nomorKartu);
        $this->setTanggalRujuk($tanggalRujuk);

        $this->setResponse(
            $this
                ->rujuk()
                ->khusus($this->kodeKhusus)
                ->subSpesialis($this->keyword)
                ->nomorKartu($this->nomorKartu)
                ->tanggalRujuk($this->tanggalRujuk)
                ->index()
        );

        return $this->response;
    }
}
