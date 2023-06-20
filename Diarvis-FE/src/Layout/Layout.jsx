import React from "react";
import Header from "../components/Layout/Header";
import Sidebar from "../components/Layout/Sidebar";

const Layout = ({ children }) => {
    return (
        <>
        <Header name="Dashboard" />
        <Sidebar />
    </>
    );
};

export default Layout;