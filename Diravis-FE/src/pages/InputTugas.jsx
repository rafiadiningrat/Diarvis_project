import React, { useEffect, useState } from "react";
import Home from "../components/Layout/Sidebar";
import Header from "../components/Layout/Header";
import Swal from "sweetalert2";
import axios from "axios";
import Layout from "../layout/layout";
import { useNavigate } from "react-router-dom";

const InputTugas = () => {
  const [judul, setJudul] = useState();
  const [deskripsi, setDeskripsi] = useState();
  const [file, setFile] = useState(null);
  const navigate = useNavigate();

  const formData = {
    judul: judul,
    deskripsi: deskripsi,
    file_tugas: file,
  };

  useEffect(() => {
    console.log("File has been set.");
  }, [file]);

  const uploadTugasHandler = async (e) => {
    e.preventDefault();
    try {
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };
      const dataTugas = await axios
        .post("http://localhost:8000/api/tugas", formData, config)
        .then((res) => {
          console.log(res);
          Swal.fire(
            "Input Tugas Berhasil",
            "Tugas berhasil ditambahkan",
            "success"
          );
          navigate("/");
        });
    } catch (error) {
      console.log(error);
      Swal.fire({
        icon: "error",
        title: "Input Tugas Gagal",
        text: "Ada keluhan pada server atau form input",
      });
    }
  };

  return (
    <>
      <Layout />
      <div className="flex flex-col  lg:ml-64 mt-[118px] px-5 pt-5 w-auto min-h-[52.688rem]">
        <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow">
          <div className="gap-4 pl-10 pr-10 pt-10">
            <div class="block w-full rounded-lg border border-gray-200 bg-white p-6 shadow-md">
              <form onSubmit={uploadTugasHandler}>
                <div class="mb-6">
                  <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Form Usulan
                  </h5>
                </div>
                <div class="mb-6">
                  <label
                    for="alasan"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    Alasan
                  </label>
                  <textarea
                    type="deskripsi"
                    id="deskripsi"
                    value={deskripsi}
                    onChange={(e) => setDeskripsi(e.target.value)}
                    rows="3"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/2 p-2.5 "
                    placeholder="Masukkan Deskripsi atau keterangan"
                    required
                  />
                </div>
                <div class="mb-6">
                  <h5 className="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                    Upload Foto
                  </h5>
                </div>
                <div className="mt-5 grid grid-cols-2 gap-10">
                  <div className="flex flex-row items-center justify-evenly">
                    <label
                      class="mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      for="file_input"
                    >
                      Tampak Depan
                    </label>
                    <input
                      class="w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                      id="file_input"
                      type="file"
                      onChange={(e) => setFile(e.target.files[0])}
                    />
                  </div>
                  <div className="flex flex-row items-center justify-evenly">
                    <label
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      for="file_input"
                    >
                      Tampak Atas
                    </label>
                    <input
                      class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                      id="file_input"
                      type="file"
                      onChange={(e) => setFile(e.target.files[0])}
                    />
                  </div>
                  <div className="flex flex-row items-center justify-evenly">
                    <label
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      for="file_input"
                    >
                      Tampak Belakang
                    </label>
                    <input
                      class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                      id="file_input"
                      type="file"
                      onChange={(e) => setFile(e.target.files[0])}
                    />
                  </div>
                  <div className="flex flex-row items-center justify-evenly">
                    <label
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      for="file_input"
                    >
                      Tampak Bawah
                    </label>
                    <input
                      class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                      id="file_input"
                      type="file"
                      onChange={(e) => setFile(e.target.files[0])}
                    />
                  </div>
                </div>

                {/* <div className="flex justify-center">
                  <button
                    type="submit"
                    className="btn bg-emerald-600 hover:bg-emerald-700 border-transparent hover:border-transparent  btn-xl mt-3 w-40 text-white"
                  >
                    Submit
                  </button>
                </div> */}
              </form>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default InputTugas;
