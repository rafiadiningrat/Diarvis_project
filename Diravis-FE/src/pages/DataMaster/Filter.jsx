import React, { useContext } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import Layout from "../../layout/layout";
import { FaRegCheckCircle, FaBookOpen, FaChartBar } from "react-icons/fa";
import { BsCashStack } from "react-icons/bs";
import { UserContext } from "../../App";

const Filter = (props) => {
  const isLoggedIn = useContext(UserContext);
  const navigate = useNavigate();
  const location = useLocation();
  console.log(location.pathname);
  
  const navigateToDataMaster = () => {
    if (location.pathname === "/datamaster/kib-b/filter") {
      navigate("/datamaster/kib-b");
    }
    if (location.pathname === "/datamaster/kib-e/filter") {
      navigate("/datamaster/kib-e");
    }
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
                htmlFor="KIB"
                className="text-sm font-medium text-gray-900 dark:text-white"
              >
                KIB
              </label>
              <select
                id="KIB"
                name="KIB"
                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                placeholder="pilih KIB"
                required
                // value={KIB}
                // onChange={(e) => setKIB(e.target.value)}
              >
                <option defaultValue>Pilih KIB</option>
                <option value="US">
                  B <span>&#40;</span>Peralatan dan Mesin<span>&#41;</span>
                </option>
                <option value="CA">
                  E <span>&#40;</span>Aset tetap lainnya<span>&#41;</span>
                </option>
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
                // onChange={(e) => setSubUnit(e.target.value)}
              >
                <option defaultValue>Pilih Sub Unit</option>
                <option value="US">
                  B <span>&#40;</span>Peralatan dan Mesin<span>&#41;</span>
                </option>
                <option value="CA">
                  E <span>&#40;</span>Aset tetap lainnya<span>&#41;</span>
                </option>
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
                // value={Bidang}
                // onChange={(e) => setBidang(e.target.value)}
              >
                <option defaultValue>Pilih Bidang</option>
                <option value="US">
                  B <span>&#40;</span>Peralatan dan Mesin<span>&#41;</span>
                </option>
                <option value="CA">
                  E <span>&#40;</span>Aset tetap lainnya<span>&#41;</span>
                </option>
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
                // value={UPB}
                // onChange={(e) => setUPB(e.target.value)}
              >
                <option defaultValue>Pilih UPB</option>
                <option value="US">
                  B <span>&#40;</span>Peralatan dan Mesin<span>&#41;</span>
                </option>
                <option value="CA">
                  E <span>&#40;</span>Aset tetap lainnya<span>&#41;</span>
                </option>
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
                // onChange={(e) => setUnit(e.target.value)}
              >
                <option defaultValue>Pilih Unit</option>
                <option value="US">
                  B <span>&#40;</span>Peralatan dan Mesin<span>&#41;</span>
                </option>
                <option value="CA">
                  E <span>&#40;</span>Aset tetap lainnya<span>&#41;</span>
                </option>
              </select>
            </div>
          </div>
          <div className="flex flex-col items-center justify-center pt-10">
            <button
              type="submit"
              className="w-1/6 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              onClick={() => navigateToDataMaster(  )}
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </>
  );
};

export default Filter;
