import React, { useState, createContext, useContext } from "react";
import "./App.css";
import { Routes, Route, BrowserRouter } from "react-router-dom";
import PrivateRoutes from "./utils/PrivateRoutes";
import Login from "./auth/Login";
import Dashboard from "./pages/Dashboard/Dashboard";
import TestPage from "./pages/TestPage";
import TestPage2 from "./pages/TestPage2";
import FilterUPB from "./pages/FilterUPB";
import FilterKIB from "./pages/FilterKIB";
import FilterPenghapusan from "./pages/FilterPenghapusan";
import DataMasterB from "./pages/DataMaster/DataMasterB";
import DataMasterE from "./pages/DataMaster/DataMasterE";
import DetailsDataMasterB from "./pages/DataMaster/DetailsDataMasterB";
import DetailsDataMasterE from "./pages/DataMaster/DetailsDataMasterE";
import PengusulanB from "./pages/Pengusulan/PengusulanB";
import PengusulanE from "./pages/Pengusulan/PengusulanE";
import EditPengusulanB from "./pages/Pengusulan/EditPengusulanB";
import EditPengusulanE from "./pages/Pengusulan/EditPengusulanE";
import DiusulkanB from "./pages/Pengusulan/DiusulkanB";
import DiusulkanE from "./pages/Pengusulan/DiusulkanE";
import PenilaianB from "./pages/Penilaian/PenilaianB";
import PenilaianE from "./pages/Penilaian/PenilaianE";
import DinilaiB from "./pages/Penilaian/DinilaiB";
import DinilaiE from "./pages/Penilaian/DinilaiE";
import VerifikasiB from "./pages/Verifikasi/VerifikasiB";
import VerifikasiE from "./pages/Verifikasi/VerifikasiE";
import TerverifikasiB from "./pages/Verifikasi/TerverifikasiB";
import TerverifikasiE from "./pages/Verifikasi/TerverifikasiE";
import DetailVerifikasiB from "./pages/Verifikasi/DetailVerifikasiB";
import DetailVerifikasiE from "./pages/Verifikasi/DetailVerifikasiE";
import DetailPenilaianB from "./pages/Penilaian/DetailPenilaianB";
import DetailPenilaianE from "./pages/Penilaian/DetailPenilaianE";
import BeritaAcaraE from "./pages/Laporan/BeritaAcaraE";
import BeritaAcaraB from "./pages/Laporan/BeritaAcaraB";
import LaporanPenghapusanB from "./pages/Laporan/LaporanPenghapusanB";
import LaporanPenghapusanE from "./pages/Laporan/LaporanPenghapusanE";
import ShowDataUser from "./pages/Admin/DataUser/DataUser";
import ShowDetailsDataUser from "./pages/Admin/DataUser/DetailDataUser";
import ShowTambahDataUser from "./pages/Admin/DataUser/TambahDataUser";
import ShowEditDataUser from "./pages/Admin/DataUser/EditDataUser";
import ShowProfile from "./pages/Profile/Profile";
import AdminPengusulanB from "./pages/Admin/AdminPengusulan/AdminPengusulanB";
import AdminPengusulanE from "./pages/Admin/AdminPengusulan/AdminPengusulanE";
import AdminPengusulanDetailB from "./pages/Admin/AdminPengusulan/AdminPengusulanDetailB";
import AdminPengusulanDetailE from "./pages/Admin/AdminPengusulan/AdminPengusulanDetailE";
import AdminPenilaianB from "./pages/Admin/AdminPenilaian/AdminPenilaianB";
import AdminPenilaianE from "./pages/Admin/AdminPenilaian/AdminPenilaianE";
import AdminPenilaianDetailB from "./pages/Admin/AdminPenilaian/AdminPenilaianDetailB";
import AdminPenilaianDetailE from "./pages/Admin/AdminPenilaian/AdminPenilaianDetailE";
import AdminVerifikasiB from "./pages/Admin/AdminVerifikasi/AdminVerifikasiB";
import AdminVerifikasiE from "./pages/Admin/AdminVerifikasi/AdminVerifikasiE";
import AdminVerifikasiDetailB from "./pages/Admin/AdminVerifikasi/AdminVerifikasiDetailB";
import AdminVerifikasiDetailE from "./pages/Admin/AdminVerifikasi/AdminVerifikasiDetailE";

// import * from "./pages/Routes";

export const UserContext = createContext(null);
const App = () => {
  const [user, setUser] = useState(false);
  return (
    <UserContext.Provider value={{ user, setUser }}>
      <Routes>
        {/* protected Routes */}
        {/* <Route element={<PrivateRoutes />}> */}
        <Route exact path="/" element={<Dashboard />} />

        {/* Data Master Routes */}
        <Route path="/datamaster/kib-b/filter" element={<FilterUPB />} />
        <Route path="/datamaster/kib-e/filter" element={<FilterUPB />} />
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
        <Route path="/diusulkan/filter" element={<FilterKIB />} />
        <Route path="/diusulkan/kib-b" element={<DiusulkanB />} />
        <Route path="/diusulkan/kib-e" element={<DiusulkanE />} />
        <Route
          path="/diusulkan/kib-b/detail/:idUsulan"
          element={<DetailPenilaianB />}
        />
        <Route
          path="/diusulkan/kib-e/detail/:idUsulan"
          element={<DetailPenilaianE />}
        />
        <Route
          path="/diusulkan/kib-b/edit/:idUsulan"
          element={<EditPengusulanB />}
        />
        <Route
          path="/diusulkan/kib-e/edit/:idUsulan"
          element={<EditPengusulanE />}
        />
        {/* Penilaian Routes */}
        <Route path="/penilaian/filter" element={<FilterKIB />} />
        <Route path="/penilaian/kib-b" element={<PenilaianB />} />
        <Route path="/penilaian/kib-e" element={<PenilaianE />} />
        <Route
          path="/penilaian/kib-b/detail/:idUsulan"
          element={<DetailPenilaianB />}
        />
        <Route
          path="/penilaian/kib-e/detail/:idUsulan"
          element={<DetailPenilaianE />}
        />
        <Route path="/dinilai/filter" element={<FilterKIB />} />
        <Route path="/dinilai/kib-b" element={<DinilaiB />} />
        <Route path="/dinilai/kib-e" element={<DinilaiE />} />
        <Route path="/dinilai/kib-b/detail/:idUsulan" element={<DetailVerifikasiB />} />
        <Route path="/dinilai/kib-e/detail/:idUsulan" element={<DetailVerifikasiE />} />
        {/* Data User */}
        <Route path="/data-user" element={<ShowDataUser />} />
        <Route
          path="/data-user/detail/:userId"
          element={<ShowDetailsDataUser />}
        />
        <Route path="/data-user/tambah-user" element={<ShowTambahDataUser />} />
        <Route path="/data-user/edit/:userId" element={<ShowEditDataUser />} />
        <Route path="/profile/:userId" element={<ShowProfile />} />
        {/* Verifikasi Routes */}
        <Route path="/verifikasi/filter" element={<FilterKIB />} />
        <Route path="/verifikasi/kib-b" element={<VerifikasiB />} />
        <Route path="/verifikasi/kib-e" element={<VerifikasiE />} />
        <Route
          path="/verifikasi/kib-b/detail/:idUsulan"
          element={<DetailVerifikasiB />}
        />
        <Route
          path="/verifikasi/kib-e/detail/:idUsulan"
          element={<DetailVerifikasiE />}
        />
        <Route path="/terverifikasi/filter" element={<FilterKIB />} />
        <Route path="/terverifikasi/kib-b" element={<TerverifikasiB />} />
        <Route path="/terverifikasi/kib-e" element={<TerverifikasiE />} />
        <Route path="/terverifikasi/kib-b/detail/:idUsulan" element={<AdminVerifikasiDetailB />} />
        <Route path="/terverifikasi/kib-e/detail/:idUsulan" element={<AdminVerifikasiDetailE />} />
        {/* Laporan Routes */}
        <Route path="/berita-acara/filter" element={<FilterUPB />} />
        <Route path="/berita-acara/kib-b" element={<BeritaAcaraB />} />
        <Route path="/berita-acara/kib-e" element={<BeritaAcaraE />} />
        <Route
          path="/laporan-penghapusan/filter"
          element={<FilterPenghapusan />}
        />
        <Route
          path="/laporan-penghapusan/kib-b"
          element={<LaporanPenghapusanB />}
        />
        <Route
          path="/laporan-penghapusan/kib-e"
          element={<LaporanPenghapusanE />}
        />
        {/* Special Admin Routes */}
        <Route path="/pengusulan/kib-b/filter" element={<FilterUPB />} />
        <Route path="/pengusulan/kib-e/filter" element={<FilterUPB />} />
        <Route path="/penilaian/kib-b/filter" element={<FilterUPB />} />
        <Route path="/penilaian/kib-e/filter" element={<FilterUPB />} />
        <Route path="/verifikasi/kib-b/filter" element={<FilterUPB />} />
        <Route path="/verifikasi/kib-e/filter" element={<FilterUPB />} />
        <Route path="/admin/pengusulan/kib-b" element={<AdminPengusulanB />} />
        <Route path="/admin/pengusulan/kib-e" element={<AdminPengusulanE />} />
        <Route
          path="/admin/pengusulan/detail/kib-b/:idUsulan"
          element={<AdminPengusulanDetailB />}
        />
        <Route
          path="/admin/pengusulan/detail/kib-e/:idUsulan"
          element={<AdminPengusulanDetailE />}
        />
        <Route path="/admin/penilaian/kib-b" element={<AdminPenilaianB />} />
        <Route path="/admin/penilaian/kib-e" element={<AdminPenilaianE />} />
        <Route
          path="/admin/penilaian/detail/kib-b/:idUsulan"
          element={<AdminPenilaianDetailB />}
        />
        <Route
          path="/admin/penilaian/detail/kib-e/:idUsulan"
          element={<AdminPenilaianDetailE />}
        />
        <Route path="/admin/verifikasi/kib-b" element={<AdminVerifikasiB />} />
        <Route path="/admin/verifikasi/kib-e" element={<AdminVerifikasiE />} />
        <Route
          path="/admin/verifikasi/detail/kib-b/:idUsulan"
          element={<AdminVerifikasiDetailB />}
        />
        <Route
          path="/admin/verifikasi/detail/kib-e/:idUsulan"
          element={<AdminVerifikasiDetailE />}
        />

        {/* TEST ROUTES */}
        <Route path="/test" element={<TestPage />} />
        <Route path="/test2" element={<TestPage2 />} />
        {/* </Route> */}

        <Route path="/login" element={<Login />} />
      </Routes>
    </UserContext.Provider>
  );
};

export default App;
