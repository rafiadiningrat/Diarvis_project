import React, { useEffect, useState } from "react";
import { useParams, useLocation } from "react-router-dom";
import Layout from "../../layout/layout";
import { UserContext } from "../../App";

function DetailPenilaianE(props) {
  const location = useLocation();
  const dataPenilaian = location.state;
  const dataBarang = dataPenilaian.kib_b;
  console.log(dataPenilaian);

  useEffect(() => {

  }, []);
  return (
    <>
      <Layout />
      <div className="flex flex-col  lg:ml-64 mt-[118px] px-5 pt-5 w-auto min-h-[52.688rem]">
        <div className="grid grid-cols-2 gap-4">
          <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow">
            <div className="px-4 sm:px-0">
              <h3 className="text-base font-semibold leading-7 text-gray-900">
                Informasi Detail KIB-E
              </h3>
            </div>
            <div className="mt-6 border-t border-gray-100">
              <dl className="divide-y divide-gray-100">
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Id Pemda
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    Margot Foster
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Nama Aset
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    Backend Developer
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Kode Aset
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.kd_aset8}.{dataBarang.kd_aset80}.
                    {dataBarang.kd_aset81}.{dataBarang.kd_aset82}.
                    {dataBarang.kd_aset83}.{dataBarang.kd_aset84}.
                    {dataBarang.kd_aset85}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Nomor Register
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    -
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Tanggal Perolehan
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.tgl_perolehan}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Tanggal Pembukuan
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    -
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Judul
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.judul}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Pencipta
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.pencipta}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Ukuran
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.ukuran}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Asal Usul
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.asal_usul}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Kondisi
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.kondisi}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Harga
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.harga}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Masa Manfaat
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.masa_manfaat}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Nilai Sisa
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {dataBarang.nilai_sisa}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">
                    Keterangan
                  </dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {/* {dataBarang.keterangan} */}
                    Keterangan
                  </dd>
                </div>
              </dl>
            </div>
          </div>
          <div className="block p-6 h-auto max-h-auto bg-white border border-gray-200 rounded-lg shadow">
            <div className="px-4 sm:px-0">
              <h3 className="text-base font-semibold leading-7 text-gray-900">
                Informasi Detail Penilaian KIB-E
              </h3>
              {/* <div className="h-[1px] min-w-full bg-gray-100" /> */}
              <div className="mt-6 border-t border-gray-100">
                <div className="divide-y divide-gray-100">
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      Foto Barang
                    </dt>
                  </div>
                </div>
              </div>
              <div className="grid grid-cols-2 gap-2 mt-5">
                <div>
                  <img
                    className="h-[11.875rem] w-[11.875rem] lg:h-[9.25rem] lg:w-[9.25rem] xl:h-[13.125rem] xl:w-[22.5rem] 2xl:h-[22.5rem] 2xl:w-[22.5rem] rounded-lg"
                    // className="h-auto max-w-full rounded-lg"
                    src={dataPenilaian.foto_barang1}
                    alt=""
                  />
                </div>
                <div>
                  <img
                    className="h-[11.875rem] w-[11.875rem] lg:h-[9.25rem] lg:w-[9.25rem] xl:h-[13.125rem] xl:w-[22.5rem] 2xl:h-[22.5rem] 2xl:w-[22.5rem] rounded-lg"
                    src={dataPenilaian.foto_barang2}
                    alt=""
                  />
                </div>
                <div>
                  <img
                    className="h-[11.875rem] w-[11.875rem] lg:h-[9.25rem] lg:w-[9.25rem] xl:h-[13.125rem] xl:w-[22.5rem] 2xl:h-[22.5rem] 2xl:w-[22.5rem] rounded-lg"
                    src={dataPenilaian.foto_barang3}
                    alt=""
                  />
                </div>
                <div>
                  <img
                    className="h-[11.875rem] w-[11.875rem] lg:h-[9.25rem] lg:w-[9.25rem] xl:h-[13.125rem] xl:w-[22.5rem] 2xl:h-[22.5rem] 2xl:w-[22.5rem] rounded-lg"
                    src={dataPenilaian.foto_barang4}
                    alt=""
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

export default DetailPenilaianE;
