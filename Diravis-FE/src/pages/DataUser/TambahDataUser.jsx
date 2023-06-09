import React, { useContext, useState, useEffect } from "react";
import { useLocation, useNavigate } from "react-router-dom";
import axios from "axios";
import Layout from "../../layout/layout";
import { FaRegCheckCircle, FaBookOpen, FaChartBar } from "react-icons/fa";
import { BsCashStack } from "react-icons/bs";
import { UserContext } from "../../App";
import Swal from "sweetalert2";

const ShowTambahDataUser = (props) => {
  const isLoggedIn = useContext(UserContext);
  const navigate = useNavigate();
  const location = useLocation();
  const [Nama, setNama] = useState("");
  const [NIP, setNIP] = useState("");
  const [Email, setEmail] = useState("");
  const [Password, setPassword] = useState("");
  const [NoTelepon, setNoTelepon] = useState("");
  const [Grup, setGrup] = useState();
  const [Bidang, setBidang] = useState([]);
  const [idBidang, setIdBidang] = useState();
  const [Unit, setUnit] = useState([]);
  const [idUnit, setIdUnit] = useState();
  const [SubUnit, setSubUnit] = useState([]);
  const [idSubUnit, setIdSubUnit] = useState();
  const [UPB, setUPB] = useState([]);
  const [takenUPB, setTakenUPB] = useState();

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
  console.log(formData);

  useEffect(() => {
    axios.get("http://localhost:8000/api/bidang").then((res) => {
      setBidang(res.data);
    });
  }, []);

  const createHandler = async (e) => {
    e.preventDefault();
    const createUser = await axios
      .post("http://localhost:8000/api/create/user", formData)
      .then((res) => {
        console.log(res);
        Swal.fire({
          icon: "success",
          title: "Tambah User Berhasil",
          text: "User Ditambahkan",
        }).then(function () {
          navigate("/data-user");
        });
        return res.data;
      })
      .catch((err) => {
        console.log(err);
        Swal.fire({
          icon: "error",
          title: "Tambah User Gagal",
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
    setGrup(+e.target.value);
  };

  const handleBidang = (e) => {
    setIdBidang(+e.target.value);
    axios
      .get(`http://localhost:8000/api/unit/${e.target.value}`)
      .then((res) => {
        setUnit(res.data.data);
      });
  };

  const handleUnit = (e) => {
    setIdUnit(+e.target.value);
    axios
      .get(`http://localhost:8000/api/sub-unit/${e.target.value}`)
      .then((res) => {
        setSubUnit(res.data.data);
      });
  };

  const handleSubUnit = (e) => {
    setIdSubUnit(+e.target.value);
    axios.get(`http://localhost:8000/api/upb/${e.target.value}`).then((res) => {
      setUPB(res.data.data);
    });
  };

  const handleUPB = (e) => {
    setTakenUPB(+e.target.value);
  };
  return (
    <>
      <Layout />
      <div className="lg:ml-64 mt-[118px] px-5 pt-5 w-auto min-h-[52.688rem]">
        <div className="block p-6 bg-white border border-gray-200 rounded-lg shadow">
          <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            Tambah Data User
          </h5>
          <form >
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
                    onChange={(e) => handleGrup(e)}
                  >
                    <option defaultValue>Pilih Grup</option>

                    <option value="1">Administrator</option>
                    <option value="2">Pengguna BMD</option>
                    <option value="3">Penilai Aset</option>
                    <option value="4">Verifikator</option>
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
                  >
                    <option defaultValue>Pilih Bidang</option>
                    {Bidang.map((item) => (
                      <option value={item.kode_bidang}>
                        {item.nama_bidang}
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
            </div>
            <div className="flex flex-col items-center justify-center pt-10">
              <button
                // type="submit"
                onClick={(e) => createHandler(e)}
                className="w-1/6 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </>
  );
};

export default ShowTambahDataUser;
