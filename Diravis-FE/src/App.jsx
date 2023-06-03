import React, { useState, createContext, useContext } from "react";
import "./App.css";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import PrivateRoutes from "./utils/PrivateRoutes";
import Register from "./auth/Register";
import Login from "./auth/Login";
import Dashboard from "./pages/Dashboard";
import DetailsTugas from "./pages/DetailsTugas";
import Help from "./pages/Help";
import InputMateri from "./pages/InputMateri";
import InputTugas from "./pages/InputTugas";
import Materi from "./pages/Materi";
import Profile from "./pages/Profile";
import Tugas from "./pages/Tugas";
import TugasMahasiswa from "./pages/TugasMahasiswa";
import TestPage from "./pages/TestPage";
import Filter from "./pages/DataMaster/Filter";
import DataMasterB from "./pages/DataMaster/DataMasterB";
import DataMasterE from "./pages/DataMaster/DataMasterE";
import DetailsDataMasterB from "./pages/DataMaster/DetailsDataMasterB";
import DetailsDataMasterE from "./pages/DataMaster/DetailsDataMasterE";
import PengusulanB from "./pages/Pengusulan/PengusulanB";
import PengusulanE from "./pages/Pengusulan/PengusulanE";

export const UserContext = createContext(null);
const App = () => {
  const [user, setUser] = useState(false);
  return (
    <UserContext.Provider value={{ user, setUser }}>
      <Routes>
        {/* <Route element={<PrivateRoutes />}> */}
        <Route exact path="/" element={<Dashboard />} />

        {/* Data Master Routes */}
        <Route path="/datamaster/kib-b/filter" element={<Filter />} />
        <Route path="/datamaster/kib-e/filter" element={<Filter />} />
        <Route path="/dataMaster/kib-b" element={<DataMasterB />} />
        <Route
          path="/dataMaster/kib-b/detail/:barangId"
          element={<DetailsDataMasterB />}
        />
        <Route
          path="/dataMaster/kib-e/detail/:barangId"
          element={<DetailsDataMasterE />}
        />
        <Route path="/dataMaster/kib-e" element={<DataMasterE />} />
        {/* Pengusulan Routes */}
        <Route path="/pengusulan/kib-b" element={<PengusulanB />} />
        <Route path="/pengusulan/kib-e" element={<PengusulanE />} />

        <Route path="/profile" element={<Profile />} />
        <Route path="/tugas" element={<Tugas />} />
        <Route path="/inputTugas" element={<InputTugas />} />
        <Route path="/materi" element={<Materi />} />
        <Route path="/inputMateri" element={<InputMateri />} />
        <Route path="/tugasMahasiswa" element={<TugasMahasiswa />} />
        <Route path="/details/:mhsId" element={<DetailsTugas />} />
        <Route path="/help" element={<Help />} />
        <Route path="/test" element={<TestPage />} />
        {/* </Route> */}

        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
      </Routes>
    </UserContext.Provider>
  );
};

export default App;
