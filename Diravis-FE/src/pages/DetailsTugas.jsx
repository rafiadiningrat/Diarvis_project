import React, { useState, useEffect } from "react";
import Home from "../components/Layout/Sidebar";
import Header from "../components/Layout/Header";
import { useNavigate, useParams } from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";

const DetailsTugas = () => {
  const { mhsId } = useParams();
  const [data, setData] = useState({});
  const [file, setFile] = useState(null);
  const dataUser = JSON.parse(sessionStorage.getItem("user"));
  const formData = {
    tugas_id: mhsId,
    mahasiswa_id: dataUser.id,
    file_tugas: file,
  };
  const navigate = useNavigate();

  useEffect(() => {
    fetch("http://localhost:8000/api/tugas/" + mhsId)
      .then((res) => {
        return res.json();
      })
      .then((resp) => {
        setData(resp.data);
      })
      .catch((err) => {
        console.log(err.message);
      });
  }, []);

  const pengumpulanTugasHandler = async (e) => {
    e.preventDefault();
    try {
      const config = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      };
      const dataTugas = await axios
        .post("http://localhost:8000/api/pengumpulanTugas", formData, config)
        .then((res) => {
          Swal.fire(
            "Pengumpulan Tugas Berhasil",
            "Tugas berhasil dikumpulkan",
            "success"
          );
          navigate("/tugas");
        });
    } catch (error) {
      console.log(error);
      Swal.fire({
        icon: "error",
        title: "Pengmupulan Tugas Gagal",
        text: "Ada keluhan pada server atau form input",
      });
    }
  };

  return (
    <>
      <div className="flex w-screen">
        <Home />
        <div className="flex flex-col w-screen">
          <Header name="Details" />
          <div className="gap-4 pl-10 pr-10 pt-10">
            {data && (
              <div class="w-auto p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-[#131313]">
                    {data.judul}
                  </h5>
                </a>
                <p class="mt-3 mb-3 font-normal text-gray-900 dark:text-gray-900">
                  {data.deskripsi}
                </p>

                <form onSubmit={pengumpulanTugasHandler}>
                  <div className="mt-5 flex flex-col justify-start gap-3">
                    <label
                      class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                      for="file_input"
                    >
                      Upload file Tugas
                    </label>
                    <input
                      class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                      id="file_input"
                      type="file"
                      onChange={(e) => setFile(e.target.files[0])}
                    />
                  </div>

                  <div className="flex justify-center">
                    <button
                      type="submit"
                      class="text-white w-1/6 mt-7 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm  py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                      SUBMIT
                    </button>
                  </div>
                </form>
              </div>
            )}
          </div>
        </div>
      </div>
    </>
  );
};

export default DetailsTugas;
