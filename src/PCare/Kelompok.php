<?php

namespace Belokdwi\Bpjs\PCare;

use Illuminate\Http\Request;

class Kelompok extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'kelompok';

    private function club($kodeJenisKelompok)
    {
        $this->feature .= "/club/{$kodeJenisKelompok}";
        return $this;
    }

    private function kegiatan($parameter)
    {
        // {bulan} for get or {edu id} for delete
        $this->feature .= "/kegiatan/{$parameter}";
        return $this;
    }

    private function peserta($eduId, $nomorKartu = null)
    {
        $this->feature .= "/peserta/{$eduId}";
        /* if ($nomorKartu !== null) {
            $this->feature .= "/{$nomorKartu}";
        } */
        return $this;
    }

    private function addKegiatanEndpoint()
    {
        $this->feature .= "/kegiatan";
        return $this;
    }

    private function addPesertaEndpoint()
    {
        $this->feature .= "/peserta";
        return $this;
    }

    private function deleteKegiatanEndpoint($eduId)
    {
        $this->feature .= "/kegiatan/{$eduId}";
        return $this;
    }

    private function deletePesertaEndpoint($eduId, $nomorKartu)
    {
        $this->feature .= "/peserta/{$eduId}/{$nomorKartu}";
        return $this;
    }

    /**
     * Get Data Club Prolanis.
     *
     * @param string $keyword
     * Parameter $keyword : Kode Jenis Kelompok => 01 : Diabetes Melitus, 02 : Hipertensi
     * @return void
     */
    public function getClub(string $keyword)
    {
        $this->setResponse($this->club($keyword)->index());
        return $this->response;
    }

    /**
     * Get Data Kegiatan Prolanis.
     *
     * @param string $keyword
     * Parameter $keyword : Bulan, format => dd-mm-yyyy
     * @return void
     */
    public function getKegiatan(string $keyword)
    {
        $this->setResponse($this->kegiatan($keyword)->index());
        return $this->response;
    }

    /**
     * Get Data Peserta Kegiatan Kelompok.
     *
     * @param string $keyword
     * Parameter $keyword : eduId
     * @return void
     */
    public function getPeserta(string $keyword)
    {
        $this->setResponse($this->peserta($keyword)->index());
        return $this->response;
    }

    /**
     * Add Data Kegiatan Kelompok
     *
     * @param Request $request
     * @return array
     */
    public function addKegiatanKelompok(Request $request)
    {
        $this->setResponse($this->addKegiatanEndpoint()->store($request->all()));
        return $this->response;
    }

    /**
     * Add Data Peserta Kegiatan Kelompok.
     *
     * @param Request $request
     * @return array
     */
    public function addPesertaKegiatan(Request $request)
    {
        $this->setResponse($this->addPesertaEndpoint()->store($request->all()));
        return $this->response;
    }

    /**
     * Delete Data Kegiatan Kelompok
     *
     * @param Request $eduId
     * @return array
     */
    public function deleteKegiatanKelompok(string $eduId)
    {
        $this->setResponse(
            $this
                ->deleteKegiatanEndpoint($eduId)
                ->destroy()
        );
        return $this->response;
    }

    /**
     * Delete Data Peserta Kegiatan Kelompok
     *
     * @param Request $eduId $nomorKartu
     * @return array
     */
    public function deletePesertaKegiatan(string $eduId, string $nomorKartu)
    {
        $this->setResponse(
            $this
                ->deletePesertaEndpoint($eduId, $nomorKartu)
                ->destroy()
        );
        return $this->response;
    }
}
