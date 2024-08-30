<?php

namespace Belokdwi\Bpjs\PCare;

use Illuminate\Http\Request;

class Kunjungan extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'kunjungan';

    public function rujukan($nomorKunjungan)
    {
        $this->feature .= "/rujukan/{$nomorKunjungan}";
        return $this;
    }

    public function riwayat($nomorKartu)
    {
        $this->feature .= "/peserta/{$nomorKartu}";
        return $this;
    }

    /**
     * Add pcare kunjungan.
     *
     * @param Request $request
     * @return array
     */
    public function addKunjungan(Request $request)
    {
        $this->setResponse($this->store($request->all()));

        return $this->response;
    }

    /**
     * Edit pcare kunjungan.
     *
     * @param Request $request
     * @return array
     */
    public function editKunjungan(Request $request)
    {
        $this->setResponse($this->update($request->all()));

        return $this->response;
    }

    /**
     * Delete pcare kunjungan.
     *
     * @param string $noKunjungan
     * @return array
     */
    public function deleteKunjungan(string $noKunjungan)
    {
        $this->setResponse($this->destroy($noKunjungan));

        return $this->response;
    }
}
