import React, { useContext, useState, useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import axios from "axios";
import Layout from "../layout/layout";
import { FaRegCheckCircle, FaBookOpen, FaChartBar } from "react-icons/fa";
import { BsCashStack } from "react-icons/bs";
import { UserContext } from "../App";
import Footer from "../components/Layout/Footer";

const FilterKIB = (props) => {
  const isLoggedIn = useContext(UserContext);
  const navigate = useNavigate();
  const location = useLocation();
  const [KIB, setKIB] = useState();
  const kondisi = "Rusak Berat";
  // console.log(location.pathname);

  const navigateToDirectedPage = () => {
    if (location.pathname === "/pengusulan/filter") {
      if (KIB === "B") {
        navigate("/pengusulan/kib-b");
      } else if (KIB === "E") {
        navigate("/pengusulan/kib-e");
      }
    } else if (location.pathname === "/diusulkan/filter") {
      if (KIB === "B") {
        navigate("/diusulkan/kib-b");
      } else if (KIB === "E") {
        navigate("/diusulkan/kib-e");
      }
    } else if (location.pathname === "/penilaian/filter") {
      if (KIB === "B") {
        navigate("/penilaian/kib-b");
      } else if (KIB === "E") {
        navigate("/penilaian/kib-e");
      }
    } else if (location.pathname === "/dinilai/filter") {
      if (KIB === "B") {
        navigate("/dinilai/kib-b");
      } else if (KIB === "E") {
        navigate("/dinilai/kib-e");
      }
    } else if (location.pathname === "/verifikasi/filter") {
      if (KIB === "B") {
        navigate("/verifikasi/kib-b");
      } else if (KIB === "E") {
        navigate("/verifikasi/kib-e");
      }
    } else if (location.pathname === "/terverifikasi/filter") {
      if (KIB === "B") {
        navigate("/terverifikasi/kib-b");
      } else if (KIB === "E") {
        navigate("/terverifikasi/kib-e");
      }
    } else if (location.pathname === "/berita-acara/filter") {
      if (KIB === "B") {
        navigate("/berita-acara/kib-b");
      } else if (KIB === "E") {
        navigate("/berita-acara/kib-e");
      }
    } else if (location.pathname === "/laporan-penghapusan/filter") {
      if (KIB === "B") {
        navigate("/laporan-penghapusan/kib-b");
      } else if (KIB === "E") {
        navigate("/laporan-penghapusan/kib-e");
      }
    }
  };

  const handleKIB = (e) => {
    setKIB(e.target.value);
    console.log(KIB);
  };
  return (
    <>
      <Layout />
      <div className="min-h-screen">
        <div className="lg:ml-64 pt-[8.7rem] px-5 w-auto">
          <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow">
            <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
              Filter
            </h5>
            <div className="grid grid-cols-2 gap-10">
              {location.pathname === "/pengusulan/filter" ? (
                <>
                  <div className="flex flex-row items-center justify-between">
                    <label
                      htmlFor="Bidang"
                      className="text-sm font-medium text-gray-900 dark:text-white"
                    >
                      KIB
                    </label>
                    <select
                      id="Bidang"
                      name="Bidang"
                      className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                      placeholder="pilih Bidang"
                      required
                      onChange={(e) => handleKIB(e)}
                    >
                      <option defaultValue>Pilih KIB</option>
                      <option value="B">KIB B</option>
                      <option value="E">KIB E</option>
                    </select>
                  </div>
                  <div className="flex flex-row items-center justify-between">
                    <label
                      htmlFor="Jenis Aset"
                      className="text-sm font-medium text-gray-900 dark:text-white"
                    >
                      Jenis Aset
                    </label>
                    <select
                      id="Jenis Aset"
                      name="Jenis Aset"
                      className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                      placeholder="pilih Bidang"
                      required
                      value={kondisi}
                    >
                      <option defaultValue>{kondisi}</option>
                      <option value="">
                        Tidak dapat dipindahtangankan/dimanfaatkan
                      </option>
                      <option value="">
                        Mengganggu kualitas laporan Keuangan
                      </option>
                      <option value="">
                        Membahayakan kepentingan sosial
                      </option>
                    </select>
                  </div>
                </>
              ) : (
                <div className="flex flex-row items-center justify-between">
                  <label
                    htmlFor="Bidang"
                    className="text-sm font-medium text-gray-900 dark:text-white"
                  >
                    KIB
                  </label>
                  <select
                    id="Bidang"
                    name="Bidang"
                    className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                    placeholder="pilih Bidang"
                    required
                    onChange={(e) => handleKIB(e)}
                  >
                    <option defaultValue>Pilih KIB</option>
                    <option value="B">KIB B</option>
                    <option value="E">KIB E</option>
                  </select>
                </div>
              )}
            </div>
            <div className="flex flex-col items-center justify-center pt-10">
              <button
                type="submit"
                className="w-1/6 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                onClick={() => navigateToDirectedPage()}
              >
                Submit
              </button>
            </div>
          </div>
        </div>
      </div>
      <Footer />
    </>
  );
};

export default FilterKIB;
