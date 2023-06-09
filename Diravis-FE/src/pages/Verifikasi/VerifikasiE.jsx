import React, { useContext } from "react";
import Layout from "../../layout/layout";
import { UserContext } from "../../App";

const VerifikasiE = () => {
  const isLoggedIn = useContext(UserContext);
  return (
    <>
      <Layout />
      <div className="flex flex-col  lg:ml-64 mt-[118px] px-5 pt-5 w-auto min-h-[52.688rem]">
        <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow"></div>
      </div>
    </>
  );
};

export default VerifikasiE;
