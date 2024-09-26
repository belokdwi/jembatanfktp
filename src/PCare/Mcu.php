<?php

namespace Belokdwi\Bpjs\PCare;

use Illuminate\Http\Request;

class Mcu extends BasePcare
{
    /**
     * @var string
     */
    protected $feature = 'MCU';

    public function kunjungan($nomorKunjungan)
    {
        $this->feature .= "/kunjungan/{$nomorKunjungan}";
        return $this;
    }

    public function deleteEndpoint($kdMcu, $nomorKunjungan)
    {
        $this->feature .= "{$kdMcu}/kunjungan/{$nomorKunjungan}";
        return $this;
    }

    /**
     * Get Data MCU
     *
     * @param string $nomorKunjungan
     * @return void
     */
    public function getMcu(string $nomorKunjungan)
    {
        $this->setResponse($this->kunjungan($nomorKunjungan)->index());

        return $this->response;
    }

    /**
     * Add Data Mcu.
     *
     * @param Request $request
     * @return array
     */
    public function addMcu(Request $request)
    {
        $this->setResponse($this->store($request->all()));
        return $this->response;
    }

    /**
     * Edit Data Mcu.
     *
     * @param Request $request
     * @return array
     */
    public function editMcu(Request $request)
    {
        $this->setResponse($this->update($request->all()));
        return $this->response;
    }

    /**
     * Delete Data Mcu.
     *
     * @param Request $kdMcu $nomorKunjungan
     * @return array
     */
    public function deleteMcu(string $kdMcu, string $nomorKunjungan)
    {
        $this->setResponse(
            $this
                ->deleteEndpoint($kdMcu, $nomorKunjungan)
                ->destroy()
        );

        return $this->response;
    }
}
