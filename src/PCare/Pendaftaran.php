<?php

namespace Belokdwi\Bpjs\PCare;

use Illuminate\Http\Request;

class Pendaftaran extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'pendaftaran';

    public function peserta($nomorKartu)
    {
        $this->feature .= "/peserta/{$nomorKartu}";
        return $this;
    }

    public function tanggalDaftar($tanggalDaftar)
    {
        $this->feature .= "/tglDaftar/{$tanggalDaftar}";
        return $this;
    }

    public function nomorUrut($nomorUrut)
    {
        $this->feature .= "/noUrut/{$nomorUrut}";
        return $this;
    }

    public function kodePoli($kodePoli)
    {
        $this->feature .= "/kdPoli/{$kodePoli}";
        return $this;
    }

    /**
     * Add pcare pendaftaran.
     *
     * @param Request $request
     * @return array
     */
    public function addPendaftaran(Request $request)
    {
        $this->setResponse($this->store($request->all()));

        return $this->response;
    }

    public function deletePendaftaran(string $nomorKartu, string $tanggalDaftar, string $nomorUrut, string $kodePoli)
    {
        $this->setResponse(
            $this
                ->peserta($nomorKartu)
                ->tanggalDaftar($tanggalDaftar)
                ->nomorUrut($nomorUrut)
                ->kodePoli($kodePoli)
                ->destroy()
        );

        return $this->response;
    }

    /**
     * Get pcare pendaftaran provider.
     *
     * @param string $date
     * @return void
     */
    public function getPendaftaranProvider(string $date, int $offset, int $limit)
    {
        $this->setResponse($this->tanggalDaftar($date)->index($offset, $limit));

        return $this->response;
    }

    /**
     * Get Data Pendaftaran by Nomor Urut.
     *
     * @param string $nomorUrut $date
     * @return void
     */
    public function getPendaftaranNomorUrut(string $nomorUrut, string $date)
    {
        $this->setResponse($this->nomorUrut($nomorUrut)->tanggalDaftar($date)->index());

        return $this->response;
    }
}
