import React from "react";
import { useState, useEffect } from "react";
import Home from "../components/Layout/Sidebar";
import Header from "../components/Layout/Header";
import axios from "axios";
import Swal from "sweetalert2";

const TugasMahasiswa = () => {
  const [task, setTask] = useState([]);
  const [mahasiswa, setMahasiswa] = useState([]);
  const [nilai, setNilai] = useState();

  useEffect(() => {
    loadTask();
    loadMahasiswa();
  }, []);

  const loadTask = () => {
    axios
      .get("http://localhost:8000/api/pengumpulanTugas")
      .then((res) => {
        setTask(res.data.data);
      })
      .catch((err) => {
        console.log(err.message);
      });
  };

  const loadMahasiswa = () => {
    axios
      .get("http://localhost:8000/api/mahasiswa")
      .then((res) => {
        setMahasiswa(res.data.data);
      })
      .catch((err) => {
        console.log(err.message);
      });
  };

  const inputNilai = (id) => {
    axios
      .post(`http://localhost:8000/api/pengumpulanTugas/${id}`, {nilai:nilai})
      .then((res) => {
        console.log(res);
        Swal.fire({
          icon: "success",
          title: "Nilai Berhasil Diinputkan",
          showConfirmButton: false,
          timer: 1500,
        });
        loadTask();
      })
      .catch((err) => {
        console.log(err.message);
      });
  };

  return (
    <>
      <form id="upload_nilai"></form>
      <div className="flex w-screen">
        <Home />
        <div className="flex flex-col w-screen">
          <Header name="Tugas" />

          <div class=" mx-10 mt-10 shadow-md">
            <table class="w-full text-sm text-left text-gray-500">
              <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 justify-items-center">
                <tr className="">
                  <th scope="col" class="px-6 py-3 ">
                    No
                  </th>
                  <th scope="col" class="px-6 py-3 ">
                    Nama
                  </th>
                  <th scope="col" class="px-6 py-3 ">
                    NIM
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Nama File
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Nilai
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                {task &&
                  task?.map((tugas, index) => (
                    <>
                      {mahasiswa &&
                        mahasiswa?.map((mhs) => (
                          <>
                            {mhs.id === tugas.mahasiswa_id && (
                              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4">{index + 1}</td>
                                <th
                                  scope="row"
                                  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                  {mhs.nama}
                                </th>
                                <td class="px-6 py-4">{mhs.NIM}</td>
                                <td class="px-6 py-4">
                                  {tugas.kumpulan_tugas}
                                </td>
                                {tugas.nilai === 0 ? (
                                  <>
                                    <td class="px-6 py-4 mx-auto">
                                      <input
                                        type="number"
                                        name="nilai"
                                        id="nilai"
                                        max="100"
                                        placeholder={tugas.nilai}
                                        class="text-center bg-green-50 border border-green-500 text-green-900 dark:text-green-400 placeholder-green-700  text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-2/12 center"
                                        onChange={(e) => {
                                          setNilai(e.target.value);
                                        }}
                                      />
                                    </td>
                                    <td class="px-6 py-4">
                                      <button
                                        type="submit"
                                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                        onClick={() => inputNilai(tugas.id)}
                                      >
                                        submit
                                      </button>
                                    </td>
                                  </>
                                ) : (
                                  <>
                                    <td class="px-6 py-4">
                                      <input
                                        type="number"
                                        name="nilai"
                                        id="nilai"
                                        max="100"
                                        placeholder={tugas.nilai}
                                        class="text-center bg-green-200 border border-green-500 text-green-900 dark:text-green-400 placeholder-green-700  text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-2/12"
                                        onChange={(e) => {
                                          setNilai(e.target.value);
                                        }}
                                        disabled
                                      />
                                    </td>
                                    <td class="px-6 py-4">
                                      <button
                                        type="submit"
                                        class="text-white bg-green-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                                        onClick={() => inputNilai(tugas.id)}
                                        disabled
                                      >
                                        submit
                                      </button>
                                    </td>
                                  </>
                                )}
                              </tr>
                            )}
                          </>
                        ))}
                    </>
                  ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </>
  );
};

export default TugasMahasiswa;
