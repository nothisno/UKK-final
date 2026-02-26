<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Denda Keterlambatan Per Hari (Rp)
    |--------------------------------------------------------------------------
    |
    | Nominal denda keterlambatan per hari jika pengembalian melewati tanggal
    | yang seharusnya. Total denda keterlambatan = nilai ini × jumlah hari telat.
    |
    */
    'denda_keterlambatan_per_hari' => env('DENDA_KETERLAMBATAN_PER_HARI', 10000),
];
