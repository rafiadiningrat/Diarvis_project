import React, { useState, createContext, useContext } from "react";
import "./App.css";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import PrivateRoutes from "./utils/PrivateRoutes";
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
import TestPage2 from "./pages/TestPage2";
import Filter from "./pages/DataMaster/Filter";
import FilterKIB from "./pages/FilterKIB";
import DataMasterB from "./pages/DataMaster/DataMasterB";
import DataMasterE from "./pages/DataMaster/DataMasterE";
import DetailsDataMasterB from "./pages/DataMaster/DetailsDataMasterB";
import DetailsDataMasterE from "./pages/DataMaster/DetailsDataMasterE";
import PengusulanB from "./pages/Pengusulan/PengusulanB";
import PengusulanE from "./pages/Pengusulan/PengusulanE";
import PenilaianB from "./pages/Penilaian/PenilaianB";
import PenilaianE from "./pages/Penilaian/PenilaianE";
import VerifikasiB from "./pages/Verifikasi/VerifikasiB";
import VerifikasiE from "./pages/Verifikasi/VerifikasiE";
import DetailPenilaianB from "./pages/Penilaian/DetailPenilaianB";
import DetailPenilaianE from "./pages/Penilaian/DetailPenilaianE";
import BeritaAcaraE from "./pages/Laporan/BeritaAcaraE";
import BeritaAcaraB from "./pages/Laporan/BeritaAcaraB";
import LaporanPenghapusanB from "./pages/Laporan/LaporanPenghapusanB";
import LaporanPenghapusanE from "./pages/Laporan/LaporanPenghapusanE";
import ShowDataUser from "./pages/DataUser/DataUser";
import ShowDetailsDataUser from "./pages/DataUser/DetailDataUser";
import ShowTambahDataUser from "./pages/DataUser/TambahDataUser";
import ShowEditDataUser from "./pages/DataUser/EditDataUser";

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
        <Route path="/pengusulan/filter" element={<FilterKIB />} />
        <Route path="/pengusulan/kib-b" element={<PengusulanB />} />
        <Route path="/pengusulan/kib-e" element={<PengusulanE />} />
        {/* Penilaian Routes */}
        <Route path="/penilaian/filter" element={<FilterKIB />} />
        <Route path="/penilaian/kib-b" element={<PenilaianB />} />
        <Route path="/penilaian/kib-e" element={<PenilaianE />} />
        <Route
          path="/penilaian/kib-b/detail/:barangId"
          element={<DetailPenilaianB />}
        />
        <Route
          path="/penilaian/kib-e/detail/:barangId"
          element={<DetailPenilaianE />}
        />
        {/* Data User */}
        <Route path="/data-user" element={<ShowDataUser />} />
        <Route path="/data-user/detail/:userId" element={<ShowDetailsDataUser />} />
        <Route path="/data-user/tambah-user" element={<ShowTambahDataUser />} />
        <Route path="/data-user/edit/:userId" element={<ShowEditDataUser />} />
        {/* Verifikasi Routes */}
        <Route path="/verifikasi/filter" element={<FilterKIB />} />
        <Route path="/verifikasi/kib-b" element={<VerifikasiB />} />
        <Route path="/verifikasi/kib-e" element={<PengusulanE />} />
        {/* Laporan Routes */}
        <Route path="/berita-acara/filter" element={<FilterKIB />} />
        <Route path="/berita-acara/kib-b" element={<BeritaAcaraB />} />
        <Route path="/berita-acara/kib-e" element={<BeritaAcaraE />} />
        <Route path="/laporan-penghapusan/filter" element={<FilterKIB />} />
        <Route path="/laporan-penghapusan/kib-b" element={<LaporanPenghapusanB />} />
        <Route path="/laporan-penghapusan/kib-e" element={<LaporanPenghapusanE />} />

        <Route path="/profile" element={<Profile />} />
        <Route path="/tugas" element={<Tugas />} />
        <Route path="/inputTugas" element={<InputTugas />} />
        <Route path="/materi" element={<Materi />} />
        <Route path="/inputMateri" element={<InputMateri />} />
        <Route path="/tugasMahasiswa" element={<TugasMahasiswa />} />
        <Route path="/details/:mhsId" element={<DetailsTugas />} />
        <Route path="/help" element={<Help />} />
        <Route path="/test" element={<TestPage />} />
        <Route path="/test2" element={<TestPage2 />} />
        {/* </Route> */}

        <Route path="/login" element={<Login />} />
      </Routes>
    </UserContext.Provider>
  );
};

export default App;
