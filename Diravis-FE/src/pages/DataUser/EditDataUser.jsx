import React, { useContext, useState, useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import axios from "axios";
import Layout from "../../layout/layout";
import { FaRegCheckCircle, FaBookOpen, FaChartBar } from "react-icons/fa";
import { BsCashStack } from "react-icons/bs";
import { UserContext } from "../../App";
import Swal from "sweetalert2";

const ShowEditDataUser = (props) => {
  const isLoggedIn = useContext(UserContext);
  const navigate = useNavigate();
  const location = useLocation();
  const user = location.state;
  const [Nama, setNama] = useState(user.nama_lengkap);
  const [NIP, setNIP] = useState(user.no_pegawai);
  const [Email, setEmail] = useState(user.email);
  const [Password, setPassword] = useState("");
  const [NoTelepon, setNoTelepon] = useState(user.no_hp);
  const [Grup, setGrup] = useState(user.kode_grup);
  const [Bidang, setBidang] = useState([]);
  const [idBidang, setIdBidang] = useState(user.kode_bidang);
  const [Unit, setUnit] = useState([]);
  const [idUnit, setIdUnit] = useState(user.kode_unit);
  const [SubUnit, setSubUnit] = useState([]);
  const [idSubUnit, setIdSubUnit] = useState(user.kode_sub_unit);
  const [UPB, setUPB] = useState([]);
  const [takenUPB, setTakenUPB] = useState(user.kode_upb);

  const formData = {
    nama_lengkap: Nama,
    no_pegawai: NIP,
    email: Email,
    password: Password,
    no_hp: NoTelepon,
    kode_grup: Grup,
    kode_bidang: idBidang,
    kode_unit: idUnit,
    kode_sub_unit: idSubUnit,
    kode_upb: takenUPB,
  };

  console.log(Grup);

  useEffect(() => {
    axios.get("http://localhost:8000/api/bidang").then((res) => {
      setBidang(res.data);
    });
  }, []);

  const updateHandler = async () => {
    const createUser = await axios
      .put(`http://localhost:8000/api/update/user/${user.id_user}`, formData)
      .then((res) => {
        console.log(res);
        Swal.fire({
          icon: "success",
          title: "Edit User Berhasil",
          text: "Data User berhasil diubah!",
        }).then(function () {
          navigate("/data-user");
        });
        return res.data;
      })
      .catch((err) => {
        console.log(err);
        Swal.fire({
          icon: "error",
          title: "Edit User Gagal",
          text: "Pastikan semua kolom terisi dengan benar!",
        });
      });
  };

  const handleNama = (e) => {
    setNama(e.target.value);
  };

  const handleNIP = (e) => {
    setNIP(e.target.value);
  };

  const handleNoTelepon = (e) => {
    setNoTelepon(e.target.value);
  };

  const handleEmail = (e) => {
    setEmail(e.target.value);
  };

  const handlePassword = (e) => {
    setPassword(e.target.value);
  };

  const handleGrup = (e) => {
    setGrup(e.target.value);
  };

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
      .get(`http://localhost:8000/api/sub-unit/${e.target.value}`)
      .then((res) => {
        setSubUnit(res.data.data);
      });
  };

  const handleSubUnit = (e) => {
    setIdSubUnit(e.target.value);
    axios.get(`http://localhost:8000/api/upb/${e.target.value}`).then((res) => {
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
            Tambah Data User
          </h5>
          <div className="grid grid-cols-2 gap-10">
            <div className="grid grid-rows-5 gap-5">
              <div className="flex flex-row items-center justify-between">
                <label
                  htmlFor="Nama"
                  className="text-sm font-medium text-gray-900 dark:text-white"
                >
                  Nama
                </label>
                <input
                  type="text"
                  id="Nama"
                  name="Nama"
                  className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                  placeholder="Masukkan Nama"
                  required
                  value={Nama}
                  onChange={(e) => handleNama(e)}
                />
              </div>
              <div className="flex flex-row items-center justify-between">
                <label
                  htmlFor="NIP"
                  className="text-sm font-medium text-gray-900 dark:text-white"
                >
                  NIP
                </label>
                <input
                  type="number"
                  id="NIP"
                  name="NIP"
                  className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                  placeholder="Masukkan NIP"
                  required
                  value={NIP}
                  onChange={(e) => handleNIP(e)}
                />
              </div>
              <div className="flex flex-row items-center justify-between">
                <label
                  htmlFor="NoTelepon"
                  className="text-sm font-medium text-gray-900 dark:text-white"
                >
                  Nomor Telepon
                </label>
                <input
                  type="number"
                  id="NoTelepon"
                  name="NoTelepon"
                  className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                  placeholder="Masukkan No.Telp"
                  required
                  value={NoTelepon}
                  onChange={(e) => handleNoTelepon(e)}
                />
              </div>
              <div className="flex flex-row items-center justify-between">
                <label
                  htmlFor="Email"
                  className="text-sm font-medium text-gray-900 dark:text-white"
                >
                  Email
                </label>
                <input
                  type="email"
                  id="Email"
                  name="Email"
                  className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                  placeholder="Masukkan Email"
                  required
                  value={Email}
                  onChange={(e) => handleEmail(e)}
                />
              </div>
              <div className="flex flex-row items-center justify-between">
                <label
                  htmlFor="Password"
                  className="text-sm font-medium text-gray-900 dark:text-white"
                >
                  Password
                </label>
                <input
                  type="password"
                  id="Password"
                  name="Password"
                  className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                  placeholder="Masukkan Password"
                  required
                  onChange={(e) => handlePassword(e)}
                />
              </div>
            </div>
            <div className="grid grid-rows-5 gap-5">
              <div className="flex flex-row items-center justify-between">
                <label
                  htmlFor="Grup"
                  className="text-sm font-medium text-gray-900 dark:text-white"
                >
                  Grup
                </label>
                <select
                  id="Grup"
                  name="Grup"
                  className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/4 p-2.5"
                  placeholder="pilih Grup"
                  required
                  value={Grup}
                  onChange={(e) => handleGrup(e)}
                  //   disabled
                >
                  {/* <option defaultValue>{user.nama_grup}</option> */}

                  <option value="1">Administrator</option>
                  <option value="2">Pengguna BMD</option>
                  <option value="3">Verifikator</option>
                  <option value="4">Tim Penilai Aset</option>
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
                  value={idBidang}
                  disabled
                >
                  {/* <option default>{user.nama_bidang}</option> */}
                  {Bidang.map((item) => (
                    <option value={item.kode_bidang}>{item.nama_bidang}</option>
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
                  value={idUnit}
                  onChange={(e) => handleUnit(e)}
                  disabled
                >
                  <option defaultValue>{user.nama_unit}</option>
                  {Unit.map((item) => (
                    <option value={item.kode_unit}>{item.nama_unit}</option>
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
                  value={idSubUnit}
                  onChange={(e) => handleSubUnit(e)}
                  disabled
                >
                  <option defaultValue>{user.nama_sub_unit}</option>
                  {SubUnit.map((item) => (
                    <option value={item.kode_sub_unit}>
                      {item.nama_sub_unit}
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
                  value={takenUPB}
                  onChange={(e) => handleUPB(e)}
                  disabled
                >
                  <option defaultValue>{user.nama_upb}</option>
                  {UPB.map((item) => (
                    <option value={item.kode_upb}>{item.nama_upb}</option>
                  ))}
                </select>
              </div>
            </div>
          </div>
          <div className="flex flex-col items-center justify-center pt-10">
            <button
              type="submit"
              className="w-1/6 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              onClick={(e) => updateHandler(e)}
            >
              Submit
            </button>
          </div>
        </div>
      </div>
    </>
  );
};

export default ShowEditDataUser;
