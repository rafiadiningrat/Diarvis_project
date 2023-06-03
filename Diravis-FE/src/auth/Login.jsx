import React, { useEffect, useRef, useState, useContext } from "react";
import { UserContext } from "../App";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import Swal from "sweetalert2";

const Login = () => {
  const isLoggedIn = useContext(UserContext);
  let navigate = useNavigate();

  //remove session storage
  useEffect(() => {
    sessionStorage.removeItem("user");
    sessionStorage.removeItem("isLogin");
  }, []);
  
  const loginHandler = async (e) => {
    e.preventDefault();
    let emailInput = e.target.email.value;
    let passwordInput = e.target.password.value;
    let checkLogin = await axios
      .post("http://localhost:8000/api/login", {
        email: emailInput,
        password: passwordInput,
      })
      .then((res) => {
        return res.data;
      })
      .catch((err) => {
          Swal.fire({
            icon: "error",
            title: "Login Gagal",
            text: "Email atau Password salah!",
          });
      });

    if (checkLogin.success === true ){
      Swal.fire("Login Berhasil", "Selamat Datang di Leplace", "success");
      isLoggedIn.setUser(true);
      sessionStorage.setItem("isLogin", JSON.stringify(isLoggedIn));
      sessionStorage.setItem("user", JSON.stringify(checkLogin.data));
      navigate("/");
    } else{
      Swal.fire({
        icon: "error",
        title: "Login Gagal",
        text: "Email atau Password salah!",
      });
    }
    console.log(emailInput);
    console.log(passwordInput);
  };


  return (
    <>
      <div className="bg-auto bg-no-repeat bg-left-top min-h-screen flex items-center justify-center bg-[url('images/login-bg2.png')]">
        <div class="absolute right-0 w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 md:p-8 lg:mr-28">
          <form class="space-y-6" onSubmit={loginHandler}>
            <img src="/images/diarvis-logo.png" className="mx-auto w-96" />
            <div>
              <label
                for="email"
                class="block mb-2 text-sm font-medium text-gray-900"
              >
                Your email
              </label>
              <input
                type="email"
                name="email"
                id="email"
                htmlFor="email"
                autoComplete="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                placeholder="name@company.com"
                required
              />
            </div>
            <div>
              <label
                for="password"
                class="block mb-2 text-sm font-medium text-gray-900"
              >
                Your password
              </label>
              <input
                type="password"
                name="password"
                id="password"
                htmlFor="password"
                placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 "
                required
              />
            </div>
            <button
              type="submit"
              class="w-full text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
            >
              Login to your account
            </button>
          </form>
        </div>
      </div>
    </>
  );
};

export default Login;
