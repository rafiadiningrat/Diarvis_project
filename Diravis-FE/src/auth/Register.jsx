import React from "react";
import { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import Swal from "sweetalert2";

const Register = () => {
  const [role, setRole] = useState("");
  let navigate = useNavigate();
  const registerHandler = async (e) => {
    e.preventDefault();
    if (role === "1") {
      let name = e.target.name.value;
      let nim = e.target.nim.value;
      let emailInput = e.target.email.value;
      let passwordInput = e.target.password.value;

      let checkRegister = await axios
        .post("http://localhost:8000/api/mahasiswa", {
          nama: name,
          NIM: nim,
          email: emailInput,
          password: passwordInput,
        })
        .then((res) => {
          return res.data;
        })
        .catch((err) => {
          return err.errors;
        });

      if (checkRegister.message === "Gagal Registrasi") {
        Swal.fire({
          icon: "error",
          title: "Register Gagal",
          text: "Cek Kembali Form Input",
        });
      } else if (checkRegister.message === "Registrasi Berhasil") {
        Swal.fire("Register Berhasil", "Silahkan Melakukan Login", "success");
        navigate("/login");
      }
    } else {
      let name = e.target.name.value;
      let nip = e.target.nip.value;
      let emailInput = e.target.email.value;
      let passwordInput = e.target.password.value;
      let checkRegister = await axios
        .post("http://localhost:8000/api/dosen", {
          nama: name,
          NIP: nip,
          email: emailInput,
          password: passwordInput,
        })
        .then((res) => {
          return res.data;
        })
        .catch((err) => {
          return err.errors;
        });
      if (checkRegister.message === "Login Gagal") {
        Swal.fire({
          icon: "error",
          title: "Register Gagal",
          text: "Cek Kembali Form Input",
        });
      } else if (checkRegister.message === "Registrasi Berhasil") {
        Swal.fire("Register Berhasil", "Silahkan Melakukan Login", "success");
        navigate("/login");
      }
    }
  };

  return (
    <>
      <div className="min-h-screen flex items-center justify-center bg-emerald-800">
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 md:p-8">
          <form class="space-y-6" onSubmit={registerHandler}>
            <h5 class="text-2xl font-bold text-emerald-500">
              Sign up to Leplace
            </h5>
            <div>
              <label
                for="role"
                class="block mb-2 text-sm font-medium text-gray-900"
              >
                Role
              </label>
              <select
                type="text"
                name="role"
                id="role"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                placeholder="Select Role"
                required
                value={role}
                onChange={(e) => setRole(e.target.value)}
              >
                <option selected>Select a Role</option>
                <option value="1">Mahasiswa</option>
                <option value="2">Dosen</option>
              </select>
            </div>

            {role == "1" && (
              <>
                <div>
                  <label
                    for="name"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    Name
                  </label>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    htmlFor="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                    placeholder="Input Name"
                    required
                  />
                </div>
                <div>
                  <label
                    for="nim"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    NIM
                  </label>
                  <input
                    type="number"
                    name="nim"
                    id="nim"
                    htmlFor="nim"
                    placeholder="Input NIM"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                    required
                  />
                </div>
                <div>
                  <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    Email
                  </label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    htmlFor="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                    placeholder="Input Email"
                    required
                  />
                </div>
                <div>
                  <label
                    for="password"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    Password
                  </label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    htmlFor="password"
                    placeholder="Input Password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                    required
                  />
                </div>
              </>
            )}

            {role == "2" && (
              <>
                <div>
                  <label
                    for="name"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    Name
                  </label>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    htmlFor="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                    placeholder="Input Name"
                    required
                  />
                </div>
                <div>
                  <label
                    for="nip"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    NIP
                  </label>
                  <input
                    type="number"
                    name="nip"
                    id="nip"
                    htmlFor="nip"
                    placeholder="Input NIP"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                    required
                  />
                </div>
                <div>
                  <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    Email
                  </label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    htmlFor="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                    placeholder="Input Email"
                    required
                  />
                </div>
                <div>
                  <label
                    for="password"
                    class="block mb-2 text-sm font-medium text-gray-900"
                  >
                    Password
                  </label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    htmlFor="password"
                    placeholder="Input Password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                    required
                  />
                </div>
              </>
            )}

            <button
              type="submit"
              class="w-full text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            >
              Register your Account
            </button>
            <div class="text-sm font-medium text-gray-500">
              Already have an Account?{" "}
              <a href="/login" class="text-emerald-700 hover:underline ">
                Login
              </a>
            </div>
          </form>
        </div>
      </div>
    </>
  );
};

export default Register;
