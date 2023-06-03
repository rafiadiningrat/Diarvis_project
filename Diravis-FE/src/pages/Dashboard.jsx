import React, { useContext, useEffect, useState } from "react";
import axios from "axios";
import Layout from "../layout/layout";
import { FaRegCheckCircle, FaBookOpen, FaChartBar } from "react-icons/fa";
import { BsCashStack } from "react-icons/bs";
import { UserContext } from "../App";

const Dashboard = () => {
  const isLoggedIn = useContext(UserContext);
  const [dataPengusulan, setDataPengusulan] = useState();
  const [dataPenilaian, setDataPenilaian] = useState();
  const [dataVerifikasi, setDataVerifikasi] = useState();
  const [dataPenghapusan, setDataPenghapusan] = useState();

  useEffect(() => {
    const getDataDashboard = async () => {
      try {
        const resPengusulan = await axios.get(
          "http://localhost:8000/api/total-pengusulan"
        );
        setDataPengusulan(resPengusulan.data);
        const resPenilaian = await axios.get(
          "http://localhost:8000/api/total-penilaian"
        );
        setDataPenilaian(resPenilaian.data);
        const resVerifikasi = await axios.get(
          "http://localhost:8000/api/total-verifikasi"
        );
        setDataVerifikasi(resVerifikasi.data);
        const resPenghapusan = await axios.get(
          "http://localhost:8000/api/total-penghapusan"
        );
        setDataPenghapusan(resPenghapusan.data);
        console
      } catch (error) {
        console.log(error);
      }
    }

    // const getDataDashboard = () => {
    //   axios
    //     .get("http://localhost:8000/api/total-pengusulan")
    //     .then((resPengusulan) => {
    //       setDataPengusulan(resPengusulan.data);
    //     });
    //     axios
    //       .get("http://localhost:8000/api/total-penilaian")
    //       .then((resPenilaian) => {
    //         setDataPenilaian(resPenilaian.data);
    //       });
    //       axios
    //         .get("http://localhost:8000/api/total-verifikasi")
    //         .then((resVerifikasi) => {
    //           setDataVerifikasi(resVerifikasi.data);
    //         });
    //         axios
    //           .get("http://localhost:8000/api/total-penghapusan")
    //           .then((resPenghapusan) => {
    //             setDataPenghapusan(resPenghapusan.data);
    //           });
    // };
    getDataDashboard();
  }, []);
  return (
    <>
      <Layout />
      <div className="flex flex-col  lg:ml-64 mt-[118px] px-5 pt-5 w-auto min-h-[52.688rem]">
        <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow">
          <div className="grid grid-cols-4 gap-4 mb-7">
            <div className="card w-auto bg-[#E93B81] text-primary-content">
              <div className="card-body">
                <div className="flex align-middle">
                  <FaRegCheckCircle size={25} />
                  <h2 className="card-title ml-5">Proses Pengusulan</h2>
                </div>
                <p>{dataPengusulan}</p>
              </div>
            </div>
            <div className="card w-auto bg-[#FFC764] text-primary-content">
              <div className="card-body">
                <div className="flex">
                  <FaBookOpen size={25} />
                  <h2 className="card-title ml-5">Proses Penilaian</h2>
                </div>
                <p>{dataPenilaian}</p>
              </div>
            </div>
            <div className="card w-auto bg-[#7868E6] text-primary-content">
              <div className="card-body">
                <div className="flex">
                  <BsCashStack size={25} />
                  <h2 className="card-title ml-5">Proses Verifikasi</h2>
                </div>
                <p>{dataVerifikasi}</p>
              </div>
            </div>
            <div className="card w-auto bg-[#BC658D] text-primary-content">
              <div className="card-body">
                <div className="flex">
                  <FaChartBar size={25} />
                  <h2 className="card-title ml-5">Total Penghapusan</h2>
                </div>
                <p>{dataPenghapusan}</p>
              </div>
            </div>
          </div>

          <div
            class="mb-4 flex rounded-lg bg-blue-300 p-4 text-sm text-blue-700 dark:bg-blue-200 dark:text-blue-800"
            role="alert"
          >
            <svg
              aria-hidden="true"
              class="mr-3 inline h-5 w-5 flex-shrink-0"
              fill="random"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"
              ></path>
            </svg>
            <span class="sr-only">Info</span>
            <div>
              <span class="font-medium">Pengumuman!</span> Ini adalah dashboard
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Dashboard;
