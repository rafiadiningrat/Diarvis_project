import React, { useEffect, useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import Layout from "../../layout/layout";
import axios from "axios";
import Swal from "sweetalert2";

function EditPengusulanB(props) {
  const location = useLocation();
  const navigate = useNavigate();
  // const dataPenilaian = location.state;
  // const dataBarang = dataBarang.kib_b;
  const [dataBarang, setDataBarang] = useState({});
  const [alasanPenghapusan, setAlasanPenghapusan] = useState("");
  const [file1, setFile1] = useState(null);
  const [file2, setFile2] = useState(null);
  const [file3, setFile3] = useState(null);
  const [file4, setFile4] = useState(null);
  const [currentIndex, setCurrentIndex] = useState(0);
  const dataUser = JSON.parse(sessionStorage.getItem("user"));
  const formData = {
    id_user: dataUser.id_user,
    id_aset_b: dataBarang.id_aset_b,
    alasan_penghapusan: alasanPenghapusan,
    foto_barang1: file1,
    foto_barang2: file2,
    foto_barang3: file3,
    foto_barang4: file4,
  };
  console.log(formData);

  const updateHandler = async () => {
    try {
      const createUser = await axios
        .post(
          `http://localhost:8000/api/kibb/usulan/update/${dataBarang.id_usulan_b}`,
          formData,
          {
            params: {
              _method: "PUT",
            },
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        )
        .then((res) => {
          console.log(res);
          Swal.fire({
            icon: "success",
            title: "Edit data pengusulan Berhasil",
            text: "Data pengusulan berhasil diubah!",
          }).then(function () {
            navigate("/diusulkan/kib-b");
          });
          return res.data;
        });
    } catch (err) {
      console.log(err);
      Swal.fire({
        icon: "error",
        title: "Edit pengusulan Gagal",
        text: "Pastikan semua kolom terisi dengan benar!",
      });
    }
  };

  const handleAlasanPenghapusan = (e) => {
    setAlasanPenghapusan(e.target.value);
  };

  useEffect(() => {
    setDataBarang(location.state);
    setAlasanPenghapusan(location.state.alasan_penghapusan);
  }, []);
  return (
    <>
      <Layout />
      <div className="min-h-screen">
        <div className="flex flex-col lg:ml-64 pt-[8.7rem] px-5 w-auto">
          <div className="grid grid-cols-2 gap-4">
            <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow">
              <div className="px-4 sm:px-0">
                <h3 className="text-base font-semibold leading-7 text-gray-900">
                  Informasi Detail Barang KIB-B
                </h3>
              </div>
              <div className="mt-6 border-t border-gray-100">
                <dl className="divide-y divide-gray-100">
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      Nama Aset
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.nama_aset}
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
                      {dataBarang.no_reg8}
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
                      Merek
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.merk}
                    </dd>
                  </div>
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      Tipe
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.type}
                    </dd>
                  </div>
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      CC
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.cc}
                    </dd>
                  </div>
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      Bahan
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.bahan}
                    </dd>
                  </div>
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      No Pabrik
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.nomor_pabrik}
                    </dd>
                  </div>
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      No Rangka
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.nomor_rangka}
                    </dd>
                  </div>
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      No Mesin
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.nomor_mesin}
                    </dd>
                  </div>
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      No Polisi
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.nomor_polisi}
                    </dd>
                  </div>
                  <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt className="text-sm font-medium leading-6 text-gray-900">
                      No BPKB
                    </dt>
                    <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                      {dataBarang.nomor_bpkb}
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
                      {dataBarang.keterangan}
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
            <div className="block p-6 h-auto max-h-auto bg-white border border-gray-200 rounded-lg shadow">
              <div className="px-4 sm:px-0">
                <h3 className="text-base font-bold leading-7 text-gray-900">
                  Edit Pengusulan KIB-B
                </h3>
                {/* <div className="h-[1px] min-w-full bg-gray-100" /> */}
                <div className="mt-6 border-t border-gray-100">
                  <div className="divide-y divide-gray-100">
                    <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                      <dt className="flex text-sm font-medium leading-6 text-gray-900 items-center">
                        Alasan Penghapusan
                      </dt>
                      <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <input
                          type="textarea"
                          name="alasan_penghapusan"
                          id="alasan_penghapusan"
                          className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                          value={alasanPenghapusan}
                          onChange={(e) => {
                            handleAlasanPenghapusan(e);
                          }}
                        />
                      </dd>
                    </div>
                    <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                      <dt className="text-md font-semibold leading-6 text-gray-900">
                        Foto Barang
                      </dt>
                    </div>
                    <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                      <dt className="flex items-center text-sm font-medium leading-6 text-gray-900">
                        Tampak Depan
                      </dt>
                      <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <input
                          class="w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                          id="file_input"
                          type="file"
                          accept="image/*"
                          onChange={(e) => setFile1(e.target.files[0])}
                        />
                      </dd>
                    </div>
                    <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                      <dt className="flex items-center text-sm font-medium leading-6 text-gray-900">
                        Tampak Kanan
                      </dt>
                      <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <input
                          class="w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                          id="file_input"
                          type="file"
                          accept="image/*"
                          onChange={(e) => setFile2(e.target.files[0])}
                        />
                      </dd>
                    </div>
                    <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                      <dt className="flex items-center text-sm font-medium leading-6 text-gray-900">
                        Tampak Belakang
                      </dt>
                      <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <input
                          class="w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                          id="file_input"
                          type="file"
                          accept="image/*"
                          onChange={(e) => setFile3(e.target.files[0])}
                        />
                      </dd>
                    </div>
                    <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                      <dt className="flex items-center text-sm font-medium leading-6 text-gray-900">
                        Tampak Kiri
                      </dt>
                      <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <input
                          class="w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                          id="file_input"
                          type="file"
                          accept="image/*"
                          onChange={(e) => setFile4(e.target.files[0])}
                        />
                      </dd>
                    </div>
                    <div className="flex flex-col items-center justify-center pt-10">
                      <button
                        type="submit"
                        className="w-2/6 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        onClick={(e) => updateHandler(e)}
                      >
                        Submit
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

export default EditPengusulanB;
