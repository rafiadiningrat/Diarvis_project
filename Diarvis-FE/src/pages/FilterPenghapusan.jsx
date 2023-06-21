import React, { useContext, useState, useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import axios from "axios";
import Layout from "../layout/layout";
import { FaRegCheckCircle, FaBookOpen, FaChartBar } from "react-icons/fa";
import { BsCashStack } from "react-icons/bs";
import { UserContext } from "../App";
import Footer from "../components/Layout/Footer";

function FilterPenghapusan(props) {
  const isLoggedIn = useContext(UserContext);
  const navigate = useNavigate();
  const location = useLocation();
  const [Bidang, setBidang] = useState([]);
  const [idBidang, setIdBidang] = useState();
  const [Unit, setUnit] = useState([]);
  const [idUnit, setIdUnit] = useState();
  const [SubUnit, setSubUnit] = useState([]);
  const [idSubUnit, setIdSubUnit] = useState();
  const [UPB, setUPB] = useState([]);
  const [idUPB, setIdUPB] = useState();
  const [takenUPB, setTakenUPB] = useState();
  const [KIB, setKIB] = useState();
  let filterURL;
  console.log(filterURL);
  const dataUser = JSON.parse(sessionStorage.getItem("user"));

  const navigateToDirectedPage = () => {
    if (dataUser.kode_group === 1) {
      filterURL = `${idBidang}/${idUnit}/${idSubUnit}/${takenUPB}`;
      if (KIB === "B") {
        navigate("/laporan-penghapusan/kib-b", { state: filterURL });
      } else if (KIB === "E") {
        navigate("/laporan-penghapusan/kib-e", { state: filterURL });
      }
    } else {
      filterURL = `${dataUser.kode_bidang}/${dataUser.kode_unit}/${dataUser.kode_sub_unit}/${dataUser.kode_upb}`;
      if (KIB === "B") {
        navigate("/laporan-penghapusan/kib-b", { state: filterURL });
      } else if (KIB === "E") {
        navigate("/laporan-penghapusan/kib-e", { state: filterURL });
      }
    }
  };

  useEffect(() => {
    axios.get("http://localhost:8000/api/bidang").then((res) => {
      setBidang(res.data);
    });
  }, []);

  const handleBidang = (e) => {
    setIdBidang(e.target.value);
    axios
      .get(`http://localhost:8000/api/unit/${e.target.value}`)
      .then((res) => {
        setUnit(res.data.data);
      });
  };

  const handleUnit = (e) => {
    setIdUnit(e.target.value);
    axios
      .get(`http://localhost:8000/api/sub-unit/${idBidang}/${e.target.value}`)
      // .get(`http://localhost:8000/api/sub-unit/${e.target.value}`)
      .then((res) => {
        setSubUnit(res.data.data);
      });
  };

  const handleSubUnit = (e) => {
    setIdSubUnit(e.target.value);
    axios
      .get(
        `http://localhost:8000/api/upb/${idBidang}/${idUnit}/${e.target.value}`
      )
      .then((res) => {
        setUPB(res.data.data);
      });
  };

  const handleUPB = (e) => {
    setTakenUPB(e.target.value);
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
              {dataUser.kode_group === 1 ? (
                <>
                  <div className="flex flex-row items-center justify-between">
                    <label
                      htmlFor="Sub Unit"
                      className="text-sm font-medium text-gray-900 dark:text-white"
                    >
                      Sub Unit
                    </label>
                    <select
                      id="SubUnit"
                      name="SubUnit"
                      className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                      placeholder="pilih Sub Unit"
                      required
                      // value={SubUnit}
                      onChange={(e) => handleSubUnit(e)}
                    >
                      <option defaultValue>Pilih Sub Unit</option>
                      {SubUnit.map((item) => (
                        <option value={item.kode_sub_unit}>
                          {item.nama_sub_unit}
                        </option>
                      ))}
                    </select>
                  </div>
                  <div className="flex flex-row items-center justify-between">
                    <label
                      htmlFor="Bidang"
                      className="text-sm font-medium text-gray-900 dark:text-white"
                    >
                      Bidang
                    </label>
                    <select
                      id="Bidang"
                      name="Bidang"
                      className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                      placeholder="pilih Bidang"
                      required
                      onChange={(e) => handleBidang(e)}
                    >
                      <option defaultValue>Pilih Bidang</option>
                      {Bidang.map((item) => (
                        <option value={item.kode_bidang}>
                          {item.nama_bidang}
                        </option>
                      ))}
                    </select>
                  </div>
                  <div className="flex flex-row items-center justify-between">
                    <label
                      htmlFor="UPB"
                      className="text-sm font-medium text-gray-900 dark:text-white"
                    >
                      UPB
                    </label>
                    <select
                      id="UPB"
                      name="UPB"
                      className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                      placeholder="pilih UPB"
                      required
                      onChange={(e) => handleUPB(e)}
                    >
                      <option defaultValue>Pilih UPB</option>
                      {UPB.map((item) => (
                        <option value={item.kode_upb}>{item.nama_upb}</option>
                      ))}
                    </select>
                  </div>
                  <div className="flex flex-row items-center justify-between">
                    <label
                      htmlFor="Unit"
                      className="text-sm font-medium text-gray-900 dark:text-white"
                    >
                      Unit
                    </label>
                    <select
                      id="Unit"
                      name="Unit"
                      className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                      placeholder="pilih Unit"
                      required
                      // value={Unit}
                      onChange={(e) => handleUnit(e)}
                    >
                      <option defaultValue>Pilih Unit</option>
                      {Unit.map((item) => (
                        <option value={item.kode_unit}>{item.nama_unit}</option>
                      ))}
                    </select>
                  </div>
                </>
              ) : (
                <></>
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
}

export default FilterPenghapusan;
