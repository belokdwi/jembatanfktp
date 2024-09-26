<?php

namespace Belokdwi\Bpjs\PCare;

use Illuminate\Http\Request;

class Tindakan extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'tindakan';

    public function kodeTkp($kodeTkp)
    {
        $this->feature .= "/kdTkp/{$kodeTkp}";
        return $this;
    }

    public function kunjungan($nomorKunjungan)
    {
        $this->feature .= "/kunjungan/{$nomorKunjungan}";
        return $this;
    }

    public function deleteEndpoint($kdTindakanSK, $nomorKunjungan)
    {
        $this->feature .= "/{$kdTindakanSK}/kunjungan/{$nomorKunjungan}";
        return $this;
    }

    /**
     * Get Data Referensi Tindakan.
     *
     * @param string 
     * Parameter 1 : kdTkp => 10 : RJTP, 20 : RITP, 50 : Promotif
     * Parameter 2 : Row data awal yang akan ditampilkan
     * Parameter 3 : Limit jumlah data yang akan ditampilkan
     * @return void
     */
    public function getReferensi(string $keyword, $offset = null, $limit = null)
    {
        $this->setResponse($this->kodeTkp($keyword)->index($offset, $limit));

        return $this->response;
    }

    /**
     * Get Data Tindakan by Kunjungan.
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
     * Add Data Tindakan.
     *
     * @param Request $request
     * @return array
     */
    public function addTindakan(Request $request)
    {
        $this->setResponse($this->store($request->all()));

        return $this->response;
    }

    /**
     * Edit Data Tindakan.
     *
     * @param Request $request
     * @return array
     */
    public function editTindakan(Request $request)
    {
        $this->setResponse($this->update($request->all()));

        return $this->response;
    }

    /**
     * Delete Data Tindakan.
     *
     * @param Request $kdTindakanSK $nomorKunjungan
     * @return array
     */
    public function deleteTindakan(string $kdTindakanSK, string $nomorKunjungan)
    {
        $this->setResponse(
            $this
                ->deleteEndpoint($kdTindakanSK, $nomorKunjungan)
                ->destroy()
        );

        return $this->response;
    }
}
