import React, { useContext, useState, useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import axios from "axios";
import Layout from "../../layout/layout";
import { FaRegCheckCircle, FaBookOpen, FaChartBar } from "react-icons/fa";
import { BsCashStack } from "react-icons/bs";
import { UserContext } from "../../App";

const FilterKIB = (props) => {
  const isLoggedIn = useContext(UserContext);
  const navigate = useNavigate();
  const location = useLocation();
  const [KIB, setKIB] = useState();

  const navigateToDataMaster = () => {
    if (KIB === "B") {
      navigate("/pengusulan/kib-b");
    }
    if (KIB === "E") {
      navigate("/pengusulan/kib-e");
    }
  };
  
  const handleKIB = (e) => {
    setKIB(e.target.value);
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
          </div>
          <div className="flex flex-col items-center justify-center pt-10">
            <button
              type="submit"
              className="w-1/6 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              onClick={() => navigateToDataMaster()}
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </>
  );
};

export default FilterKIB;
