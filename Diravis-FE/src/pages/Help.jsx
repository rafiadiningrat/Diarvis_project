import React from "react";
import Home from "../components/Layout/Sidebar";
import Header from "../components/Layout/Header";

const Help = () => {
  return (
    <>
      <div className="flex">
        <Home />
        <div className="flex flex-col w-screen">
          <Header name="Help" />
          
        </div>
      </div>
    </>
  );
};

export default Help;
