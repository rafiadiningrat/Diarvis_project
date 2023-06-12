import React, { useContext, useState, useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import axios from "axios";
import Layout from "../layout/layout";
import { FaRegCheckCircle, FaBookOpen, FaChartBar } from "react-icons/fa";
import { BsCashStack } from "react-icons/bs";
import { UserContext } from "../App";

const FilterUPB = (props) => {
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
  // const [filterURL, setFilterURL] = useState();
  let filterURL = `${idBidang}/${idUnit}/${idSubUnit}/${takenUPB}`;
  // console.log("filterURL: ", filterURL);
  console.log(location.pathname);
  // console.log(takenUPB);
  // console.log("Bidang Collection: ", Bidang);
  // console.log("id Bidang: ", idBidang);
  // console.log("Unit Collection: ", Unit);
  // console.log("id Unit: ", idUnit);
  // console.log("Sub Unit Collection: ", SubUnit);
  // console.log("id Sub Unit: ", idSubUnit);
  // console.log("UPB Collection: ", UPB);
  // console.log("id UPB: ", takenUPB);

  const navigateToDirectedPage = () => {
    if (location.pathname === "/datamaster/kib-b/filter") {
      navigate("/datamaster/kib-b", {state: filterURL});
    }
    if (location.pathname === "/datamaster/kib-e/filter") {
      navigate("/datamaster/kib-e", { state: filterURL});
    }
    if (location.pathname === "/pengusulan/kib-b/filter") {
      navigate("/admin/pengusulan/kib-b", { state: filterURL});
    }
    if (location.pathname === "/pengusulan/kib-e/filter") {
      navigate("/admin/pengusulan/kib-e", { state: filterURL});
    }
    if (location.pathname === "/penilaian/kib-b/filter") {
      navigate("/admin/penilaian/kib-b", { state: filterURL});
    }
    if (location.pathname === "/penilaian/kib-e/filter") {
      navigate("/admin/penilaian/kib-e", { state: filterURL});
    }
    if (location.pathname === "/verifikasi/kib-b/filter") {
      navigate("/admin/verifikasi/kib-b", { state: filterURL});
    }
    if (location.pathname === "/verifikasi/kib-e/filter") {
      navigate("/admin/verifikasi/kib-e", { state: filterURL});
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
  return (
    <>
      <Layout />
      <div className="lg:ml-64 mt-[118px] px-5 pt-5 w-auto min-h-[52.688rem]">
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
                  <option value={item.kode_bidang}>{item.nama_bidang}</option>
                ))}
              </select>
            </div>
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
          </div>
          <div className="flex flex-col items-center justify-center pt-10">
            {location.pathname === "/berita-acara/filter" ? (
              <a
                href={`http://localhost:8000/api/berita-acara/${filterURL}`}
                download
                className="w-auto text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              >
                Generate Berita Acara
              </a>
            ) : (
              <button
                type="submit"
                className="w-1/6 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                onClick={() => navigateToDirectedPage()}
              >
                Submit
              </button>
            )}
          </div>
        </div>
      </div>
    </>
  );
};

export default FilterUPB;
