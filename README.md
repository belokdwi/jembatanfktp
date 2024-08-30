# BPJS Kesehatan Indonesia

PHP package to access BPJS Kesehatan API.

This package is a wrapper of BPJS Web Service

Katalog: https://dvlp.bpjs-kesehatan.go.id:8888/trust-mark/portal.html \
Base URL: https://apijkn-dev.bpjs-kesehatan.go.id

## Installation

- Require this package with composer.
  `composer require Belokdwi/laravel-bpjs`

- Add the ServiceProvider to the providers array in config/app.php.
  `Belokdwi\Bpjs\BpjsServiceProvider::class,`

- Copy the package config to your local config with the publish command:
  `php artisan vendor:publish --provider="Belokdwi\Bpjs\BpjsServiceProvider"`

- Update your `.env` file

```
BPJS_CONS_ID=CONSID        # consumer id
BPJS_SECRET_KEY=SECRETKEY  # secret key
BPJS_USERNAME=USERNAME     # pcare login user name
BPJS_PASSWORD=PASSWORD     # pcare login password
BPJS_USER_KEY=USERKEY      # user key
BPJS_APP_CODE=095
BPJS_BASE_URL=https://apijkn-dev.bpjs-kesehatan.go.id
BPJS_SERVICE_PCARE=pcare-rest-dev
```

## Usage

### Diagnosa

```
$pcare = new Belokdwi\Bpjs\Pcare\Diagnosa();
$pcare->setKeyword('A00');
$pcare->setOffset(0);
$pcare->setLimit(10);
$response = $pcare->getDiagnosa();

// or
$pcare = new Belokdwi\Bpjs\Pcare\Diagnosa();
$response = $pcare->getDiagnosa('A00', 0, 10);
```

### Dokter

```
$pcare = new Belokdwi\Bpjs\PCare\Dokter();
$pcare->setOffset(0);
$pcare->setLimit(10);
$response = $pcare->getDokter();

// or
$pcare = new Belokdwi\Bpjs\PCare\Dokter();
$response = $pcare->getDokter(0, 10);
```

### Kesadaran

```
$pcare = new Belokdwi\Bpjs\PCare\Kesadaran();
$response = $pcare->getKesadaran();
```

### Peserta

#### Peserta By Nomor Kartu

```
$pcare = new Belokdwi\Bpjs\PCare\Peserta();
$pcare->setKeyword('0001261832477');
$response = $pcare->getPesertaByNoka();

// or
$pcare = new Belokdwi\Bpjs\PCare\Peserta();
$response = $pcare->getPesertaByNoka('0001261832477');
```

#### Peserta By NIK

```
$pcare = new Belokdwi\Bpjs\PCare\Peserta();
$pcare->setKeyword('3174016909650001');
$response = $pcare->getPesertaByNik();

// or
$pcare = new Belokdwi\Bpjs\PCare\Peserta();
$response = $pcare->getPesertaByNik('3174016909650001');
```

### Poli

```
$pcare = new Belokdwi\Bpjs\PCare\Poli();
$pcare->setOffset(0);
$pcare->setLimit(10);
$response = $pcare->getPoli();

// or
$pcare = new Belokdwi\Bpjs\PCare\Poli();
$response = $pcare->getPoli(0, 10);
```

### Provider

```
$pcare = new Belokdwi\Bpjs\PCare\Provider();
$pcare->setOffset(0);
$pcare->setLimit(10);
$response = $pcare->getProvider();

// or
$pcare = new Belokdwi\Bpjs\PCare\Provider();
$response = $pcare->getProvider(0, 10);
```

### Spesialis

#### Spesialis

```
// spesialis
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$response = $pcare->getSpesialis();
```

#### Subspesialis

```
// sub spesialis
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$pcare->setKeyword('ANA');
$response = $pcare->getSubSpesialis();

// or
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$response = $pcare->getSubSpesialis('ANA');
```

#### Sarana

```
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$response = $pcare->getSarana();
```

#### Khusus

```
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$response = $pcare->getKhusus();
```

#### Faskes Rujukan Subspesialis

```
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$pcare->setKodeSubspesialis('3');
$pcare->setKodeSarana('1');
$pcare->setTanggalRujuk('27-12-2022');
$response = $pcare->getFaskesRujukanSubspesialis();

// or
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$response = $pcare->getFaskesRujukanSubspesialis(3, 1, '27-12-2022');
```

#### Faskes Rujukan Khusus

```
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$pcare->setKodeKhusus('IGD');
$pcare->setNomorKartu('0001261832477');
$pcare->setTanggalRujuk('27-12-2022');
$response = $pcare->getFaskesRujukanKhusus();

// or
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$response = $pcare->getFaskesRujukanKhusus('IGD', '0001261832477', '27-12-2022');
```

#### Faskes Rujukan Khusus Subspesialis

```
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$pcare->setKodeKhusus('THA');
$pcare->setKodeSubspesialis('3');
$pcare->setNomorKartu('0001261832477');
$pcare->setTanggalRujuk('27-12-2022');
$response = $pcare->getFaskesRujukanKhususSubspesialis();

// or
$pcare = new Belokdwi\Bpjs\PCare\Spesialis();
$response = $pcare->getFaskesRujukanKhususSubspesialis('THA', '3', '0001261832477', '27-12-2022');
```

### Status Pulang

```
// rawat inap
$pcare = new Belokdwi\Bpjs\PCare\StatusPulang();
$response = $pcare->getStatusPulangRawatInap();

// rawat jalan
$pcare = new Belokdwi\Bpjs\PCare\StatusPulang();
$response = $pcare->getStatusPulangRawatJalan();
```

### Pendaftaran

```
// add pendaftaran
$pcare = new Belokdwi\Bpjs\PCare\Pendaftaran();
$response = $pcare->addPendaftaran($request);

// delete pendaftaran
$pcare = new Belokdwi\Bpjs\PCare\Pendaftaran();
$response = $pcare->deletePendaftaran($nomorKartu, $tanggalDaftar, $nomorUrut, $kodePoli);
```

## Contributions

Your contribution is always welcome!
